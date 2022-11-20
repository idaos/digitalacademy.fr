window.addEventListener('DOMContentLoaded', () => {

    var swiper = new Swiper(".clients-swiper", {
        slidesPerView: 5,
        slidesPerGroup: 5,
        spaceBetween: 30,
        // breakpoints: {
        //     769: {
        //         slidesPerView: 2,
        //         slidesPerGroup: 2,
        //     },
        // },
        pagination: {
            el: ".swiper-pagination-clients",
            clickable: true
        },
    });
})