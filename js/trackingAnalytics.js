// Tracking cookies conf
//----------------------

// On Load
jQuery(document).ready(function () {

    // Disable tracking by default
    if (getCookie('CookieLawInfoConsent') == null) {
        disableGoogleAnalytics();
    }
    // Disable tracking if user has opted out
    else if (getCookie("cookielawinfo-checkbox-analytics") == "no") {
        disableGoogleAnalytics();
    }
    // Enable tracking if user has opted in
    else if (getCookie("cookielawinfo-checkbox-analytics") == "yes") {
        enableGoogleAnalytics();
    }

    // YOutube embed cookies managements
    if (getCookie('cookielawinfo-checkbox-functional') != 'yes') {
        // Foreach iframe
        jQuery('iframe').each(function () {
            // If iframe has a src attributes including the string 'youtube'
            if (jQuery(this).attr('src').includes("youtube")) {
                // Wrap element in a new div with a paragraph and a button / attach click event on the button
                jQuery(this).wrap('<div class="iframe-wrapper"></div>')
                jQ_iframeRequestApproval = jQuery('<div class="iframe-request-approval"/>')
                    .append(jQuery('<p>Vous devez accepter les cookies relatifs aux réseaux sociaux pour lire cette vidéo. Pour plus d\'informations, consultez notre <a href="https://www.digitalacademy.fr/mentions-legales">Politique de confidentialité et de protection des données personnelles Digital Academy.</a></p>'))
                    .append(jQuery('<button onclick="acceptSocialCookies()" class="btn btn-red-alt-neg">Accepter</button>'))
                jQuery(this).before(jQ_iframeRequestApproval)
            }
        })

    }

});

function acceptSocialCookies() {
    // Remove overlays
    jQuery('.iframe-request-approval').remove()
    // Remember user choice for the next time
    setCookie('cookielawinfo-checkbox-functional', 'yes', 365)
}

// On user set cookies, reload page
jQuery("#cookie_action_close_header, #wt-cli-privacy-save-btn").click(function (event) {
    history.go(0);
});

// Enable cookies on accept all
jQuery("#cookie_action_close_header").click(function (event) {
    setCookie('cookielawinfo-checkbox-analytics', 'yes', 330)
    setCookie('cookielawinfo-checkbox-functional', 'yes', 330)
    setCookie('cookielawinfo-checkbox-necessary', 'yes', 330)
    enableGoogleAnalytics();
});
// Disable cookies on reject all
jQuery("#cookie_action_close_header_reject").click(function (event) {
    setCookie('cookielawinfo-checkbox-analytics', 'no', 330)
    setCookie('cookielawinfo-checkbox-functional', 'no', 330)
    setCookie('cookielawinfo-checkbox-necessary', 'no', 330)
    enableGoogleAnalytics();
});

function disableGoogleAnalytics() {
    window['ga-disable-UA-1188124-3'] = true;
    console.log("tracking is disable");
}
function enableGoogleAnalytics() {
    window['ga-disable-UA-1188124-3'] = false;
    console.log("tracking is enable");
}
function getCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
    }
    return null;
}
function setCookie(name, value, days) {
    var expires = "";
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "") + expires + "; path=/";
}