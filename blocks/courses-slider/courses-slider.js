window.addEventListener('DOMContentLoaded', () => {

    var swiper = new Swiper(".courses-swiper", {
        slidesPerView: 3,
        slidesPerGroup: 2,
        spaceBetween: 10,
        pagination: {
            el: ".swiper-pagination-courses",
            clickable: true
        },
    });
})