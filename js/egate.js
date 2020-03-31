jQuery(document).ready(function(){

	jQuery(window).on("resize", function () {

		jQuery("[id^='speechelevator-']").hide();

		if (jQuery(window).width() < 600){
			if (jQuery("#speechelevator-xs").attr("src") != "/wp-content/themes/digitalacademy/images/speechelevator-xs.jpg"){
				jQuery("#speechelevator-xs").attr("src", "/wp-content/themes/digitalacademy/images/speechelevator-xs.jpg");
			}
			jQuery("#speechelevator-xs").show();

		}else if (jQuery(window).width() < 800){
			if (jQuery("#speechelevator-sm").attr("src") != "/wp-content/themes/digitalacademy/images/speechelevator-sm.jpg"){
				jQuery("#speechelevator-sm").attr("src", "/wp-content/themes/digitalacademy/images/speechelevator-sm.jpg");
			}
			jQuery("#speechelevator-sm").show();

		}else if (jQuery(window).width() < 1200){
			if (jQuery("#speechelevator-md").attr("src") != "/wp-content/themes/digitalacademy/images/speechelevator-md.jpg"){
				jQuery("#speechelevator-md").attr("src", "/wp-content/themes/digitalacademy/images/speechelevator-md.jpg");
			}
			jQuery("#speechelevator-md").show();

		}else{
			if (jQuery("#speechelevator-lg").attr("src") != "/wp-content/themes/digitalacademy/images/speechelevator-lg.jpg"){
				jQuery("#speechelevator-lg").attr("src", "/wp-content/themes/digitalacademy/images/speechelevator-lg.jpg");
			}
			jQuery("#speechelevator-lg").show();

		}
	}).resize();
});