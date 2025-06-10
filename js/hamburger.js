document.addEventListener('DOMContentLoaded', function() {

    // 各要素を取得
    const trigger = document.querySelector('.menu'); // メニューを開閉するトリガー
    const menu = document.getElementById('hamburger-menu'); // メニュー本体
    const body = document.body; // 背景スクロール固定用

    // トリガーまたはメニュー本体がなければ処理を終了
    if (!trigger || !menu) {
        return;
    }

    // トリガーをクリックしたときの処理
    trigger.addEventListener('click', function() {
        // is-openクラスを付け外しして、メニューの表示/非表示を切り替える
        menu.classList.toggle('is-open');

        // is-activeクラスを付け外しして、トリガーアイコンの見た目を変更可能にする（例：三本線 ⇔ ×印）
        this.classList.toggle('is-active');
        
        // is-menu-openクラスを付け外しして、背景のスクロールを制御する
        body.classList.toggle('is-menu-open');
    });

    // メニュー内の各項目を取得
    // PHPファイルのタイポ "hamburger-munu__item" を考慮し、両方のセレクタを指定しています。
    const menuItems = menu.querySelectorAll('.hamburger-menu__item, .hamburger-munu__item, .hamburger-menu .title');

    // メニュー項目がクリックされたら、メニューを閉じる
    menuItems.forEach(function(item) {
        item.addEventListener('click', function() {
            // 各クラスを削除して、メニューを閉じた状態に戻す
            menu.classList.remove('is-open');
            trigger.classList.remove('is-active');
            body.classList.remove('is-menu-open');
        });
    });
});