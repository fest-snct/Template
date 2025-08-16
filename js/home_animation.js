document.addEventListener('DOMContentLoaded', () => {
    const storeItems = document.querySelectorAll('.store-item');

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-visible');
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
