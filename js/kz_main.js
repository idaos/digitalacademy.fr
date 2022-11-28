
window.onload = function() { 
    var isReinit = false; 	
    window.onscroll = function() { reinitCarousel() };
    function reinitCarousel() {
        if (document.body.scrollTop > 1350 || document.documentElement.scrollTop > 1350) {
            if(isReinit == false){
                isReinit = true;
                var owl = jQuery('.owl-carousel');
                owl.trigger('destroy.owl.carousel');
                owl.owlCarousel({
                    loop:true,
                    items:3,
                    dots:false,
                    nav:false,
                    autoplay:true,
                    autoplayTimeout:0,
                    autoplaySpeed:3000,
                    lazyLoad : true,
                    onTranslated:next,
                    responsive : {
                        768 : {
                            items : 5
                        }
                    }
                });
                function next(){
                    owl.trigger('next.owl.carousel', 3000);
                }
            }
        }
    }
    jQuery('#section-offre h3 > span').each(function(){
        var me = jQuery(this);
        me.html( me.text().replace(/(^\w+)/,'<strong>$1</strong>') );
    });
};
