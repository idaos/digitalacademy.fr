//-------------------------------------------
//-------------------------------------------
// Prevent Form submit if User has not scrolled (prevent bot form submit)
//-------------------------------------------
//-------------------------------------------
userHasScrolled = false;
window.onscroll = function (e){
    userHasScrolled = true;
}
jQuery( "#gform_1" ).submit(function( event ) {
    if(!userHasScrolled){
        event.preventDefault();
    }
});

//-------------------------------------------
//-------------------------------------------
//--------------- label anim ----------------
//-------------------------------------------
//-------------------------------------------

function formEventStyle(){

    jQuery('input, textarea').each(function( index ) {
        addClassIfNotEmpty( jQuery(this) );
    });
    jQuery('input, textarea').focus(function(){ // focus
        jQuery(this).parents('form li').addClass('focused');
    });
    jQuery('input, textarea').blur(function(){ // lose focus
        addClassIfNotEmpty( jQuery(this) );
    })  
    function addClassIfNotEmpty(elt){
        var inputValue = elt.val();
        if ( inputValue == "" ) {
            elt.removeClass('filled');
            elt.parents('form li').removeClass('focused');  
        } else {
            elt.addClass('filled');
            elt.parents('form li').addClass('focused');  
        }
    }
}

function hideValidationMessage(){

    jQuery('input').on("click", function(){  
        jQuery( this ).parents('form li').children('.validation_message').hide();
    });
    jQuery( ".validation_message" ).each(function(index) {
        jQuery(this).on("click", function(){
            jQuery( this ).parents('form li').find('input').focus();
            jQuery( this ).hide();
        });
    });
}

//-------------------------------------------
//-------------------------------------------
//-------------- spinner btn ----------------
//-------------------------------------------
//-------------------------------------------

// display spinner after element
gform.addFilter( 'gform_spinner_target_elem', function( $targetElem, formId ) {
    return jQuery( '.gform_button' );
} );


//-------------------------------------------
//-------------------------------------------
//--------- js load on form render ----------
//-------------------------------------------
//-------------------------------------------

jQuery(document).bind('gform_post_render', function(){

    jQuery( '.ginput_container_multiselect' ).parents('.gfield').children('label').hide(); // hide select label

    heading = '<span id="form-heading" class="reverse"><h2>Contactez-nous </h2><h3>Vous souhaitez en savoir plus sur nos offres de formation ?</h3></span><hr><br><br>';
    if( jQuery('#form-heading').length == 0 ){
        jQuery('#gform_wrapper_11 form, #gform_wrapper_1 form, #gform_wrapper_9 form').prepend(heading);
    } 
    jQuery('.gform_ajax_spinner').hide();

    hideValidationMessage();
    formEventStyle();
    buttonAnim(); 
    customSelect();

    // ----------------
    // -- Datepicker --
    // ----------------
    var viewportWidth = window.innerWidth || document.documentElement.clientWidth;
    if (viewportWidth > 640) {
        var xsSxreen = false;
    } else {
        var xsSxreen = true;
    }
    if (!xsSxreen) {
        if (typeof TinyDatePicker === "function") {
            // datepicker close event
            var nowFrDateformat = function nowFrDateformat() {
                var today = new Date();
                var dd = String(today.getDate()).padStart(2, '0');
                var mm = String(today.getMonth() + 1).padStart(2, '0');
                var yyyy = today.getFullYear();
                return dd + '/' + mm + '/' + yyyy;
            };

            var dateFrDateformat = function dateFrDateformat(date) {
                var dd = String(date.getDate()).padStart(2, '0');
                var mm = String(date.getMonth() + 1).padStart(2, '0');
                var yyyy = date.getFullYear();
                return dd + '/' + mm + '/' + yyyy;
            };

            var insertSelectedDateIntoDOM = function insertSelectedDateIntoDOM(selectedDate) {
                var date_inputs = document.getElementsByClassName('date-input');

                for (var i = 0; i < date_inputs.length; i++) {
                    jQuery('.date-input input').attr("value", dateFrDateformat(selectedDate));
                    formEventStyle();
                }
            };

            var dp = TinyDatePicker('.date-input', {
                lang: {
                    days: ['Dim', 'Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam'],
                    months: ['Jan', 'Fev', 'Mar', 'Avr', 'Mai', 'Jun', 'Jul', 'Aou', 'Sep', 'Oct', 'Nov', 'Dec'],
                    today: 'Aujourd\'hui',
                    clear: 'Annuler',
                    close: 'Fermer'
                },
                format: function format(date) {
                    return date.toLocaleDateString();
                },
                mode: 'dp-below',
                hilightedDate: new Date(),
                min: nowFrDateformat(),
                max: '10/1/2040',
                dayOffset: 1
            });
            dp.on('close', function () {
                return insertSelectedDateIntoDOM(dp.state.selectedDate);
            });
        }
    }
});

//-------------------------------------------
//-------------------------------------------
//-------------- custom select --------------
//-------------------------------------------
//-------------------------------------------
function customSelect(){

    var x, i, j, selElmnt, a, b, c;
    /* Look for any elements with the class "ginput_container_select" or "ginput_container_multiselect": */
    x =  document.getElementsByClassName("ginput_container_select");
    if(x.length == 0){
        x =  document.getElementsByClassName("ginput_container_multiselect");
    }

    for (i = 0; i < x.length; i++) {
        /* check if the fn is already launch */
        z = x[i].getElementsByClassName("select-selected").length;
        if(z>0){return}

        selElmnt = x[i].getElementsByTagName("select")[0];
        /* For each element, create a new DIV that will act as the selected item: */
        a = document.createElement("DIV");
        a.setAttribute("class", "select-selected");
        a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
        x[i].appendChild(a);
        /* For each element, create a new DIV that will contain the option list: */
        b = document.createElement("DIV");
        b.setAttribute("class", "select-items select-hide");
        for (j = 1; j < selElmnt.length; j++) {
            /* For each option in the original select element,
            create a new DIV that will act as an option item: */
            c = document.createElement("DIV");
            c.innerHTML = selElmnt.options[j].innerHTML;
            c.addEventListener("click", function(e) {
                /* When an item is clicked, update the original select box,
                and the selected item: */
                var y, i, k, s, h;
                s = this.parentNode.parentNode.getElementsByTagName("select")[0];
                h = this.parentNode.previousSibling;
                for (i = 0; i < s.length; i++) {
                    if (s.options[i].innerHTML == this.innerHTML) {
                        s.selectedIndex = i;
                        h.innerHTML = this.innerHTML;
                        y = this.parentNode.getElementsByClassName("same-as-selected");
                        for (k = 0; k < y.length; k++) {
                            y[k].removeAttribute("class");
                        }
                        this.setAttribute("class", "same-as-selected");
                        break;
                    }
                }
                h.click();
            });
            b.appendChild(c);
        }
        x[i].appendChild(b);
        a.addEventListener("click", function(e) {
            /* When the select box is clicked, close any other select boxes,
            and open/close the current select box: */
            e.stopPropagation();
            closeAllSelect(this);
            this.nextSibling.classList.toggle("select-hide");
            this.classList.toggle("select-arrow-active");
        });
    }

    function closeAllSelect(elmnt) {
        /* A function that will close all select boxes in the document,
        except the current select box: */
        var x, y, i, arrNo = [];
        x = document.getElementsByClassName("select-items");
        y = document.getElementsByClassName("select-selected");
        for (i = 0; i < y.length; i++) {
            if (elmnt == y[i]) {
                arrNo.push(i)
            } else {
                y[i].classList.remove("select-arrow-active");
            }
        }
        for (i = 0; i < x.length; i++) {
            if (arrNo.indexOf(i)) {
                x[i].classList.add("select-hide");
            }
        }
        updateSelect();
    }
    /* If the user clicks anywhere outside the select box,
    then close all select boxes: */
    document.addEventListener("click", closeAllSelect);

    function updateSelect(){
        selectedValue = jQuery('.select-selected').html();
        jQuery('select option').each(function(index) {
            jQuery(this).removeAttr("selected");
        });
        jQuery('select option[value="'+ selectedValue +'"]').attr('selected','selected'); // select option in the contact for
    }
}   