<?php
session_start();
$nonce = base64_encode(random_bytes(16));
header("Content-Security-Policy:
    default-src 'self';
    script-src 'self' 'nonce-" . $nonce . "';
    style-src 'self' 'nonce-" . $nonce . "';
    frame-src 'self';
    frame-ancestors 'none';
");

// エラーを見やすくする
ini_set('display_errors', 1); // エラー表示を有効にする
error_reporting(E_ALL);     // すべてのエラーを表示する

// PHPMailerのクラスをインポート
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Composerのオートローダーを読み込む
require '../../vendor/autoload.php';

// dotenv
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../../');
$dotenv->load();

// ここは削除します。$_SESSION['nonce']はフォーム表示側でセットされるべきです。
// $_SESSION['nonce'] = $_POST['nonce'];

// --------------------------------
// ①不正なリクエストを拒否
// --------------------------------

// POSTメソッド以外のリクエストを拒否
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    exit('不正なリクエストです。');
}

// 必要なPOSTデータとセッションのnonceが存在するかチェック
// $_SESSION['nonce'] はフォーム表示側でセットされていることを前提とします
if (!isset($_POST['name'], $_POST['email'], $_POST['message'], $_POST['nonce'])) {
    exit('不正なアクセスです。必須項目が不足しています。$_POSTが設定されていません。');
}else if(!isset($_SESSION['nonce'])){
    exit('不正なアクセスです。$_SESSION[\'nonce\']が設定されていません。');
}

// nonceの検証（CSRF対策）
if (!hash_equals($_SESSION['nonce'], $_POST['nonce'])) {
    exit('不正なリクエストです。nonceが一致しません。');
}
// 一度使ったnonceは無効化する
unset($_SESSION['nonce']);

// --------------------------------
// ②入力値のサニタイズとバリデーション
// --------------------------------
$name = htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8');
$email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL); // メールアドレス形式を検証
$message = htmlspecialchars($_POST['message'], ENT_QUOTES, 'UTF-8');

// メールアドレスの形式が正しくない場合
if ($email === false) {
    exit('メールアドレスの形式が正しくありません。');
}

// --------------------------------
// ③PHPMailerでメールを送信
// --------------------------------

try {
    // --- 1通目: 管理者へのメール送信 ---
    $mail = new PHPMailer(true); // trueにすると例外をスローする
    $mail->isSMTP();
    $mail->Host       = $_ENV['SMTP_HOST'];
    $mail->SMTPAuth   = true;
    $mail->Username   = $_ENV['SMTP_USER'];
    $mail->Password   = $_ENV['SMTP_PASS'];
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // SMTPS (SSL)
    $mail->Port       = $_ENV['SMTP_PORT'];
    $mail->CharSet    = 'UTF-8';

    $mail->setFrom($_ENV['MAIL_FROM_ADDRESS'], $_ENV['MAIL_FROM_NAME']);
    $mail->addAddress($_ENV['MAIL_TO_ADDRESS'], $_ENV['MAIL_TO_NAME']);
    $mail->addReplyTo($email, $name);

    $mail->isHTML(false);
    $mail->Subject = '【お問い合わせ】' . $name . '様より';

    $body_main = <<<EOT
    --------------------------------
    お名前： {$name}
    メールアドレス： {$email}
    --------------------------------

    お問い合わせ内容：
    {$message}
    EOT;

    $body = <<<EOT
    Webサイトからお問い合わせがありました。

    {$body_main}
    EOT;
    $mail->Body = $body;

    $mail->send();
    // 1通目のメール送信が完了したら、smtpClose() を呼び出すのは適切です。
    // しかし、2通目のメールを送る場合は、PHPMailerを再設定する必要があります。
    // $mail->smtpClose(); // ここではまだ閉じないか、閉じたら完全に新しいインスタンスを再設定する


    // --- 2通目: ユーザーへの自動返信メール送信 ---
    // ここで完全に新しいPHPMailerインスタンスを作成し、
    // 再度SMTP接続設定を行う必要があります。
    $mail2 = new PHPMailer(true);
    $mail2->isSMTP();
    $mail2->Host       = $_ENV['SMTP_HOST']; // .envから取得
    $mail2->SMTPAuth   = true;
    $mail2->Username   = $_ENV['SMTP_USER'];
    $mail2->Password   = $_ENV['SMTP_PASS'];
    // GmailのSMTPでは、ポート465はENCRYPTION_SMTPS、ポート587はENCRYPTION_STARTTLSが一般的です。
    // 今回は両方を同じSMTP_USER/PASSで利用するため、同じ設定で問題ないでしょう。
    // もし465で管理者メールが送れなかった場合、ユーザーメールも送れない可能性があります。
    $mail2->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // 管理者メールと同じ設定を使用
    $mail2->Port       = $_ENV['SMTP_PORT'];       // .envから取得

    $mail2->CharSet    = 'UTF-8'; // 文字コードも設定

    $mail2->setFrom($_ENV['MAIL_FROM_ADDRESS'], $_ENV['MAIL_FROM_NAME']); // 送信元は管理者メールと同じ
    $mail2->addAddress($email, $name); // ユーザーのメールアドレスへ送る
    $mail2->addReplyTo($_ENV['MAIL_TO_ADDRESS'], $_ENV['MAIL_TO_NAME']); // 返信先は管理者

    $mail2->isHTML(false);
    $mail2->Subject = 'お問い合わせを受け付けました（自動返信）'; // 件名をわかりやすく

    $user_body = <<<EOT
    Webサイトから以下の内容でお問い合わせを受け付けました。
    お問い合わせ内容を確認後、担当者よりご返信させていただきます。

    --------------------------------
    お名前： {$name}
    メールアドレス： {$email}
    --------------------------------

    お問い合わせ内容：
    {$message}

    ※このメールは自動返信です。
    EOT;
    $mail2->Body = $user_body;

    $mail2->send();
    // 2通目のメール送信後、smtpClose() は任意ですが、しておくとリソース解放になります
    // $mail2->smtpClose(); // こちらで閉じる

    $_SESSION['body'] = $body_main;

    // 送信成功後にサンクスページへリダイレクト
    header('Location: ../thanks.php');
    exit;

} catch (Exception $e) {
    // エラー発生時の処理
    // ここで PHPMailer::ENCRYPTION_SMTPS ではなく PHPMailer::ENCRYPTION_STARTTLS を試すこともできます。
    // Port 587 と合わせて試してください。
    echo "メッセージを送信できませんでした。メーラーエラー: " . $e->getMessage() . "<br>";
    echo "PHPMailer ErrorInfo: " . $mail->ErrorInfo . "<br>"; // 1通目のエラー情報
    echo "PHPMailer2 ErrorInfo: " . $mail2->ErrorInfo . "<br>"; // 2通目のエラー情報
    echo "<pre>";
    print_r($e); // 開発中のみ
    echo "</pre>";
}