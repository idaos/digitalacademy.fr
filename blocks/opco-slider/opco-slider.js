window.addEventListener('DOMContentLoaded', () => {

    var swiper = new Swiper(".opcos-swiper", {
        slidesPerView: 5,
        slidesPerGroup: 3,
        spaceBetween: 30,
        pagination: {
            el: ".swiper-pagination-opcos",
            clickable: true
        },
    });
})