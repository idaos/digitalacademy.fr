window.addEventListener('DOMContentLoaded', () => {

    var swiper = new Swiper(".opcos-swiper", {
        slidesPerView: 1,
        slidesPerGroup: 1,
        spaceBetween: 30,
        breakpoints: {
            1000: {
                slidesPerView: 5,
                slidesPerGroup: 3,
            },
            600: {
                slidesPerView: 2,
                slidesPerGroup: 2,
            },
        },
        pagination: {
            el: ".swiper-pagination-opcos",
            clickable: true
        },
    });
})