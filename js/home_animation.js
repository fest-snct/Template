document.addEventListener('DOMContentLoaded', () => {
    const storeItems = document.querySelectorAll('.store_item');

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('is_visible');
            }
        });
    }, {
        rootMargin: '0px',
        threshold: 0.1
    });

    storeItems.forEach(item => {
        observer.observe(item);
    });
});
