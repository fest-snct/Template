document.addEventListener('DOMContentLoaded', function () {
    const trigger = document.querySelector('.menu');
    const menu = document.getElementById('hamburger-menu');
    const body = document.body;
    const drop = document.querySelector('.drop');
    const wave = document.querySelector('.wave');
    const menuItems = menu?.querySelectorAll('.hamburger-menu__item, .hamburger-menu .title');

    if (!trigger || !menu) return;

    let hasPlayedDrop = false; // アニメーション再生済みかどうかのフラグ

    function playOnceAnimation(el) {
        if (!el) return;
        el.style.display = 'block';
        el.style.animation = 'none';
        el.offsetHeight; // 再描画
        el.style.animation = ''; // CSSの定義通りに戻す
        el.style.animationPlayState = 'running'; // 再生開始
    }

    function toggleMenu() {
        const isOpening = !menu.classList.contains('is-open');

        menu.classList.toggle('is-open');
        trigger.classList.toggle('is-active');
        body.classList.toggle('is-menu-open');

        if (isOpening && !hasPlayedDrop) {
            playOnceAnimation(drop);
            playOnceAnimation(wave);
            hasPlayedDrop = true;
        } else if (!isOpening) {
            // メニューが閉じられた場合の処理（アニメーション初期化）
            hasPlayedDrop = false;
            drop.style.display = 'block'; // 次回に備えて再表示
        }
    }

    drop?.addEventListener('animationend', () => {
        drop.style.display = 'none';
    });

    trigger.addEventListener('click', toggleMenu);

    menuItems?.forEach(item => {
        item.addEventListener('click', () => {
            menu.classList.remove('is-open');
            trigger.classList.remove('is-active');
            body.classList.remove('is-menu-open');

            // メニューを閉じたときにアニメーション初期化
            hasPlayedDrop = false;
            drop.style.display = 'block';
        });
    });
});