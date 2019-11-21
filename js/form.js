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
    jQuery('.validation_message').on("click", function(){  
        jQuery( this ).parents('form li').children('input').focus();
        jQuery( this ).hide();
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

    heading = '<span id="form-heading" class="reverse"><h2>Contactez-nous </h2><h3>Vous souhaitez en savoir plus sur nos offres de formation ?</h3></span><hr><br><br>';
    if( jQuery('#form-heading').length == 0 ){
        jQuery('#gform_wrapper_11 form, #gform_wrapper_1 form').prepend(heading);
    } 
    jQuery('.gform_ajax_spinner').hide();

    hideValidationMessage();
    formEventStyle();
    buttonAnim(); 
    customSelect();
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
    }
    /* If the user clicks anywhere outside the select box,
    then close all select boxes: */
    document.addEventListener("click", closeAllSelect);
}   