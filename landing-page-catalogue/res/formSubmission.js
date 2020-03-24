// register form submission event to Google Analyics
 jQuery(document).ready(function() {
   jQuery(document).bind("gform_confirmation_loaded", function(event, formID) {
       console.log('SENT !!');
     if(formID == 1)     {var formName = 'page-Contact';}
     else if(formID == 2){var formName = 'page-Demande-de-Catalogue';}
     else if(formID == 6){var formName = 'landing-page-catalog_PhoneHeader'; window.scrollTo(0, 0);}
     else if(formID == 8){var formName = 'landing-page-catalog_PhoneFooter';}
     else if(formID == 7){var formName = 'landing-page-catalog_CatalogRequest';}
     else if(formID == 5){var formName = 'landing-page-catalog_Contact';}
     else if(formID == 9){var formName = 'page-Digital-Learning';}
     else if(formID == 3){var formName = 'newsletter-request';}
     else if(formID == 4){var formName = 'recruitment-request';}
     else{                var formName = 'form_Unknown';}
       
     window.dataLayer = window.dataLayer || [];
     window.dataLayer.push({
       event: "formSubmission",
       formID: formName
     });
   });
 });