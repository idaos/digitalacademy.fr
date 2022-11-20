window.addEventListener('DOMContentLoaded', () => {

    var swiper = new Swiper(".clients-swiper", {
        slidesPerView: 1,
        slidesPerGroup: 1,
        spaceBetween: 30,
        breakpoints: {
            1000: {
                slidesPerView: 5,
                slidesPerGroup: 5,
            },
            600: {
                slidesPerView: 2,
                slidesPerGroup: 2,
            },
        },
        pagination: {
            el: ".swiper-pagination-clients",
            clickable: true
        },
    });
})