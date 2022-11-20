window.addEventListener('DOMContentLoaded', () => {

    var swiper = new Swiper(".courses-swiper", {
        slidesPerView: 1,
        slidesPerGroup: 1,
        spaceBetween: 10,
        breakpoints: {
            1000: {
                slidesPerView: 3,
                slidesPerGroup: 2,
            },
        },
        pagination: {
            el: ".swiper-pagination-courses",
            clickable: true
        },
    });
})