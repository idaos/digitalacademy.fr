// -------------------------------------
// ------ Angular module ---------------
// -------------------------------------

// prevent display before module full load
angular.element(document).ready(function () {
    jQuery('#nos-formations div > #search-helper, #nos-formations div > #formations, #nos-formations div > .container').css('display','block');
});

angular.module('courseFilteringApp', ['ngSanitize','ngAnimate'])
    .controller('courseFilteringController', function($scope, $animate, $timeout, $filter) {
    var courses = this;
    $scope.search = '';     // set the default search/filter term
    $scope.thema = {
        t1:false,
        t2:false,
        t3:false,
        t4:false,
        t5:false,
        t6:false
    }
    // disable all thema checkboxes on first click on a checkbox
    $scope.enableThemaFilter = false;
    $scope.onCheckboxEvent = function(event) {
        // clear keyword filtering
        $scope.search = '';
        $scope.database_course = [];
        // prevent happening next time
        $scope.enableThemaFilter = true;
        // toggle checkboxes
        if(event.target.id.slice(-1) != '1'){$scope.thema.t1 = false;}else{$scope.thema.t1 = true;}
        if(event.target.id.slice(-1) != '2'){$scope.thema.t2 = false;}else{$scope.thema.t2 = true;}
        if(event.target.id.slice(-1) != '3'){$scope.thema.t3 = false;}else{$scope.thema.t3 = true;}
        if(event.target.id.slice(-1) != '4'){$scope.thema.t4 = false;}else{$scope.thema.t4 = true;}
        if(event.target.id.slice(-1) != '5'){$scope.thema.t5 = false;}else{$scope.thema.t5 = true;}
        if(event.target.id.slice(-1) != '6'){$scope.thema.t6 = false;}else{$scope.thema.t6 = true;}
    }
    courses.course = [];
    response.forEach(function (element, index) {
        var thisElt = {
            id:                   element.course_id, 
            link:                 element.course_link, 
            image:                element.course_image, 
            new:                  element.course_new, 
            top:                  element.course_top, 
            title:                element.course_title, 
            description:          element.course_description, 
            goals:                element.course_goals, 
            sessions:             element.course_sessions,
            trainer_name:         element.trainer_name,
            trainer_image:        element.trainer_image,
            thema:                element.course_thema
        };  
        courses.course.push(thisElt);
    });
    courses.themas = response_themas;
    // call function after animation ending
    $scope.scrolltoA = function(event) {
        $scope.$apply();
    }
    $scope.spinner = true;
    $scope.$on('ngRepeatFinished', function(ngRepeatFinishedEvent) {
        $scope.spinner = false;

        // if query parameter in URL, load result from DB
        if((phpSearchTerm) && (phpSearchIni == true)) {
            phpSearchIni = false;
            $scope.queryDatabase();
        }
    });
    // ini var noResult
    $scope.noResult = false;
    // ini array for database response
    $scope.database_course = [];
    // ini course placeholder (spinner kind of)
    $scope.seekingDB = false;
    //color button if courses are filter by thema
    $scope.selectBtnClass = function(){
     if($scope.thema.t1)
         return "btn-t1"
     else if($scope.thema.t2)
         return "btn-t2";
     else if($scope.thema.t3)
         return "btn-t3";
     else if($scope.thema.t4)
         return "btn-t4";
     else if($scope.thema.t5)
         return "btn-t5";
     else if($scope.thema.t6)
         return "btn-t6";
    }
    // call getCoursesFromQuery fn if keypress
    // delay it if another key is pressed within a delay
    var delayExpire;
    $scope.queryDatabase = function(keyEvent) {
        keyEvent = keyEvent || 0;
        $scope.seekingDB = true;
        $scope.database_course = [];
        function delayQuery() { 
            $scope.getCoursesFromQuery();
        }
        clearTimeout(delayExpire);
        delayExpire = setTimeout(delayQuery, 500);   
        //                        if (keyEvent.which === 13){ clearTimeout(delayExpire);$scope.getCoursesFromQuery(); } // ENTER keypress
    }     
    // search courses related to keywords into database (including ACF fields)
    // this method call "kz_search" php function into the function.php file
    $scope.getCoursesFromQuery = function(){

        if(jQuery("#search input").val()!=""){
            $scope.seekingDB = true;
            $scope.noResult = false;

            // clear array
            $scope.database_course = [];
            jQuery.post(
                ajaxurl,
                {
                    'action': 'kz_search',
                    'keywords': jQuery("#search input").val()
                },
                function(response){

                    var database_response = removeLast0(response);
                    database_response = JSON.parse(database_response);
                    if(database_response.courses.length > 0){
                        $scope.noResult = false;
                    }else{
                        $scope.noResult = true;
                    }
                    database_response.courses.forEach(function (element, index) {
                        $scope.database_course.push(element.course_id);
                    });
                }
            ).done(function() {
                // disable spinner
                $scope.seekingDB = false;
                // tell angular scope is modified
                $scope.$apply();
            });
            // fn: check if last char is a 0 and if it is, remove it. (ugly stuff)
            function removeLast0 (str){
                if (str.substring(str.length-1) == "0")
                {
                    str = str.substring(0, str.length-1);
                }
                return str;
            }
        }else{
            $scope.database_course = [];
            $scope.$apply();
        }
    }
})
    .directive('onFinishRender', function ($timeout) {
    return {
        restrict: 'A',
        link: function (scope, element, attr) {
            if (scope.$last === true) {
                $timeout(function () {
                    scope.$emit(attr.onFinishRender);
                });
            }
        }
    }
})
    .directive('animationend', function() {
    return {
        restrict: 'A',
        scope: {
            animationend: '&'
        },
        link: function(scope, element) {
            var callback = scope.animationend(),
                events = 'animationend webkitAnimationEnd MSAnimationEnd' + 'transitionend webkitTransitionEnd';
            element.on(events, function(event) {
                callback.call(element[0], event);
            });
        }
    };
})
    .filter('highlight', function($sce) {
    return function(input, phrase) {

        // IE 11 exception
        if(!!window.MSInputMethodContext && !!document.documentMode){
            return input;
        }                    
        // Edge exveption
        if(window.navigator.userAgent.indexOf("Edge") > -1){
            return input;
        }

        // regex : not in an html <tag>
        if (phrase && input) input = input.replace(new RegExp('(?<!<[^>]*)('+phrase+')', 'gi'),
                                                   '<span class="highlighted">$1</span>')
        return $sce.trustAsHtml(input)
    }
})
    .filter('level_hl', function($sce) {
    return function(input) {
        if(input != null){
            input = input.replace('&#8211; ', '');
            input = input.replace(new RegExp('('+'Niveau perfectionnement'+')', 'gi'),
                                  '<span class="level_hl">$1</span>')
            input = input.replace(new RegExp('('+'Niveau initiation'+')', 'gi'),
                                  '<span class="level_hl">$1</span>')
            return input
        }
    }
})
    .filter('searchFor', function(){
    return function(arr, searchString){
        if(!searchString){
            return arr;
        }
        var result = [];
        searchString = searchString.toLowerCase();
        angular.forEach(arr, function(item){
            if(item.title.toLowerCase().indexOf(searchString) !== -1){
                result.push(item);
            }else if(item.description.toLowerCase().indexOf(searchString) !== -1){
                result.push(item);
            }
        });
        return result;
    }
})
// inject additional search result from database query 
    .filter('databaseQuery', function(){
    return function(arr, scope){
        function isInArray(value, array) {
            return array.indexOf(value) > -1;
        }        
        // compare displayed list (arr) with database result  (scope.database_course)
        // and add to arr the dif
        temp_arr = [];
        arr.forEach(function(element) {
            temp_arr.push(element.id);
        });
        temp_arr_2 = [];
        scope.database_course.forEach(function(element) {
            if( isInArray(element, temp_arr) ){}else{
                temp_arr_2.push(element);
            }
        });
        // add additional result to output
        temp_arr_2.forEach(function(element2) {
            scope.courses.course.forEach(function(element) {
                if(element.id == element2){ 
                    arr.push(element);
                }
            });
        });  

        if(arr.length == 0){
            return scope.courses.course;
        }else{
            return arr;
        }
    }
})
    .filter('searchThema', function(){
    return function(items, thema, scope) {
        var result = [];
        var th1 = 'reseaux-sociaux';
        var th2 = 'webmarketing';
        var th3 = 'contenus-site-web';
        var th4 = 'e-publicite-acquisition';
        var th5 = 'ressources-humaines-web';
        var th6 = 'e-reputations-relation-client-web';
        angular.forEach(items, function(item) {
            // if checkbox is checked for this thematique..
            if(thema.t1 != false) {
                // loop through item themas
                for (var i = 0; i < item.thema.length; i++) {
                    // check if item thema is set
                    if(typeof item.thema[i] != 'undefined') {
                        // check if item thema has a slug
                        if (item.thema[i].hasOwnProperty('slug')){
                            // if checked thematique = item thematique, keep it
                            if ( item.thema[i].slug == th1 ){
                                // check duplicated objects
                                if ( result.indexOf(item) > -1 ) {
                                }else{
                                    result.push(item);
                                }
                            }
                        }
                    }
                }
            }
            else if(thema.t2 != false) {
                for (var i = 0; i < item.thema.length; i++) {
                    if(typeof item.thema[i] != 'undefined') {
                        if (item.thema[i].hasOwnProperty('slug')){
                            if ( item.thema[i].slug == th2 ){
                                if ( result.indexOf(item) > -1 ) {
                                }else{
                                    result.push(item);
                                }
                            }
                        }
                    }
                }
            }
            else if(thema.t3 != false) {
                for (var i = 0; i < item.thema.length; i++) {
                    if(typeof item.thema[i] != 'undefined') {
                        if (item.thema[i].hasOwnProperty('slug')){
                            if ( item.thema[i].slug == th3 ){
                                if ( result.indexOf(item) > -1 ) {
                                }else{
                                    result.push(item);
                                }
                            }
                        }
                    }
                }
            }
            else if(thema.t4 != false) {
                for (var i = 0; i < item.thema.length; i++) {
                    if(typeof item.thema[i] != 'undefined') {
                        if (item.thema[i].hasOwnProperty('slug')){
                            if ( item.thema[i].slug == th4 ){   
                                if ( result.indexOf(item) > -1 ) {
                                }else{
                                    result.push(item);
                                }
                            }
                        }
                    }
                }
            }
            else if(thema.t5 != false) {
                for (var i = 0; i < item.thema.length; i++) {
                    if(typeof item.thema[i] != 'undefined') {
                        if (item.thema[i].hasOwnProperty('slug')){
                            if ( item.thema[i].slug == th5 ){
                                if ( result.indexOf(item) > -1 ) {
                                }else{
                                    result.push(item);
                                }
                            }
                        }
                    }
                }
            }
            else if(thema.t6 != false) {
                for (var i = 0; i < item.thema.length; i++) {
                    if(typeof item.thema[i] != 'undefined') {
                        if (item.thema[i].hasOwnProperty('slug')){
                            if ( item.thema[i].slug == th6 ){
                                if ( result.indexOf(item) > -1 ) {
                                }else{
                                    result.push(item);
                                }
                            }
                        }
                    }
                }
            }else{
                scope.enableThemaFilter = false;
            }
        });
        if (scope.enableThemaFilter == true){
            return result;
        }else{
            return items;
        }
    };
});
// scroll on filter press
var filterLabels = document.querySelectorAll("#thematiques-input label");
filterLabels = Array.from(filterLabels); // IE11 compatibility
filterLabels.forEach(function(button) {
    button.addEventListener('click', function(event) {
        scrollToResults();
    })
});
// scroll on search button clicked
document.querySelector("#search .btn").onclick = function(event){
    scrollToResults();
}
// scroll on enter key press
var txtbox = document.querySelector("#search input");
txtbox.onkeydown = function(e) {
    if (e.key == "Enter") {
        scrollToResults();
    }
};
function scrollToResults(){
    var menuHeight = document.getElementById('kz-menu-wrapper').offsetHeight;
    var searchHelper = document.getElementById('search-helper');
    var searchHelperPos = searchHelper.getBoundingClientRect();
    window.scrollBy(0, searchHelperPos.top - menuHeight);
}



// -------------------------------------
// ------ Calendar ---------------------
// -------------------------------------


// rerender calendar on thematique selection
jQuery('[id^=thematique-checkbox-]').on('change',function(){
    jQuery('#calendar').fullCalendar('rerenderEvents');
})