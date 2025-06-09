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
//ini_set('display_errors', 1); // エラー表示を有効にする
//error_reporting(E_ALL);     // すべてのエラーを表示する

// PHPMailerのクラスをインポート

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Composerのオートローダーを読み込む
require '../../vendor/autoload.php';

// dotenv
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../../');
$dotenv->load();

$_SESSION['nonce'] = $_POST['nonce'];

// --------------------------------
// ①不正なリクエストを拒否
// --------------------------------

// POSTメソッド以外のリクエストを拒否
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    exit('不正なリクエストです。');
}

// 必要なPOSTデータとセッションのnonceが存在するかチェック
if (
    !isset($_POST['name'], $_POST['email'], $_POST['message'], $_POST['nonce']) ||
    !isset($_SESSION['nonce'])
) {
    exit('不正なアクセスです。必須項目が不足しています。');
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

$mail = new PHPMailer(true); // trueにすると例外をスローする

try {
    // --- サーバー設定 ---
    $mail->isSMTP();                                  // SMTPを使用
    $mail->Host       = $_ENV['SMTP_HOST'];           // ★SMTPサーバー名
    $mail->SMTPAuth   = true;                         // SMTP認証を有効にする
    $mail->Username   = $_ENV['SMTP_USER'];           // ★SMTPユーザー名（あなたのメールアドレス）
    $mail->Password   = $_ENV['SMTP_PASS'];           // ★SMTPパスワード（Gmailの場合はアプリパスワード）
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;  // SSLでの暗号化を有効に
    $mail->Port       = $_ENV['SMTP_PORT'];           // TCPポート

    // --- 文字コード設定 ---
    $mail->CharSet = 'UTF-8';

    // --- 送受信者の設定 ---
    // 送信元（From）: ユーザー名と同じメールアドレスを推奨
    $mail->setFrom($_ENV['MAIL_FROM_ADDRESS'], $_ENV['MAIL_FROM_NAME']);
    // 宛先（To）: あなたが受信するメールアドレス
    $mail->addAddress($_ENV['MAIL_TO_ADDRESS'], $_ENV['MAIL_TO_NAME']);
    // 返信先（Reply-To）: フォーム入力者のメールアドレスと名前
    $mail->addReplyTo($email, $name);

    // --- メールの内容 ---
    $mail->isHTML(false); // メール形式をテキスト形式に設定
    $mail->Subject = '【お問い合わせ】' . $name . '様より';

    // メールの本文
    $body = <<<EOT
    Webサイトからお問い合わせがありました。

    --------------------------------
    お名前： {$name}
    メールアドレス： {$email}
    --------------------------------

    お問い合わせ内容：
    {$message}
    EOT;
    $mail->Body = $body;

    // メール送信
    $mail->send();

    // 送信成功後にサンクスページへリダイレクト
    header('Location: ../thanks.html');
    exit;

} catch (Exception $e) {
    // エラー発生時の処理
    // 本番環境では、詳細なエラーはログファイルに記録し、ユーザーには一般的なメッセージを表示するのが望ましい
    echo "メッセージを送信できませんでした。メーラーエラー: {$mail->ErrorInfo}";
}