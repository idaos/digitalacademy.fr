window.addEventListener('DOMContentLoaded', () => {

    var swiper = new Swiper(".blog-swiper", {
        slidesPerView: 3,
        slidesPerGroup: 2,
        spaceBetween: 10,
        // breakpoints: {
        //     769: {
        //         slidesPerView: 2,
        //         slidesPerGroup: 2,
        //     },
        // },
        pagination: {
            el: ".swiper-pagination-blog",
            clickable: true
        },
    });
})