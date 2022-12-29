// -------------------------------------
// ------ Angular module ---------------
// -------------------------------------

// prevent display before module full load
angular.element(document).ready(function () {
    jQuery('#nos-formations div > #search-helper, #nos-formations div > #formations, #nos-formations div > .container, #thematiques-input').css('display', 'block');
});

angular.module('courseFilteringApp', ['ngSanitize', 'ngAnimate'])

    .controller('courseFilteringController', function ($scope, $animate, $timeout, $filter) {
        var courses = this;
        $scope.search = '';     // set the default search/filter term

        // get themas and build object
        $scope.thema = {}
        courses.themas = response_themas;
        courses.themas.forEach(function (element, index) {
            i = index + 1;
            key = "t" + i;
            element['enabled'] = false;
            $scope.thema[key] = element;
        });

        $scope.thema.selected = false;
        $scope.bythema = [];

        // disable all thema checkboxes on first click on a checkbox
        $scope.enableThemaFilter = false;
        $scope.onCheckboxEvent = function (event, selected_index) {
            // clear keyword filtering
            $scope.search = '';
            $scope.searchText = '';
            $scope.database_course = [];
            // prevent happening next time
            $scope.enableThemaFilter = true;
            // ini
            $scope.selectedColor = "red";
            // toggle checkboxes
            $i = -1;
            angular.forEach($scope.thema, function (element, index) {
                $i += 1;
                // uncheck all
                $scope.thema[index].enabled = false;
                if ($i == selected_index) {
                    // check one
                    $scope.thema[index].enabled = true;
                    $scope.selectedColor = $scope.thema[index].color;
                }
            })
        }
        courses.course = [];
        response.forEach(function (element, index) {
            var thisElt = {
                id: element.course_id,
                link: element.course_link,
                duree: element.course_duree,
                next_session: element.course_next_session,
                tarif: element.course_tarif,
                image: element.course_image,
                new: element.course_new,
                top: element.course_top,
                title: element.course_title,
                description: element.course_description,
                goals: element.course_goals,
                sessions: element.course_sessions,
                trainer_name: element.trainer_name,
                trainer_image: element.trainer_image,
                thema: element.course_thema
            };
            courses.course.push(thisElt);
        });

        // call function after animation ending
        $scope.scrolltoA = function (event) {
            $scope.$apply();
        }
        $scope.spinner = true;
        $scope.$on('ngRepeatFinished', function (ngRepeatFinishedEvent) {
            $scope.spinner = false;

            // if query parameter in URL, load result from DB
            if ((phpSearchTerm) && (phpSearchIni == true)) {
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
        $scope.selectBtnClass = function () {

            return "btn_c_" + $scope.selectedColor;
        }
        // call getCoursesFromQuery fn if keypress
        // delay it if another key is pressed within a delay
        var delayExpire;
        $scope.queryDatabase = function (keyEvent) {
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
        $scope.getCoursesFromQuery = function () {

            if (jQuery("#search input").val() != "") {
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
                    function (response) {

                        var database_response = removeLast0(response);
                        database_response = JSON.parse(database_response);
                        if (database_response.courses.length > 0) {
                            $scope.noResult = false;
                        } else {
                            $scope.noResult = true;
                        }
                        database_response.courses.forEach(function (element, index) {
                            $scope.database_course.push(element.course_id);
                        });
                    }
                ).done(function () {
                    // disable spinner
                    $scope.seekingDB = false;
                    // tell angular scope is modified
                    $scope.$apply();
                });
                // fn: check if last char is a 0 and if it is, remove it. (ugly stuff)
                function removeLast0(str) {
                    if (str.substring(str.length - 1) == "0") {
                        str = str.substring(0, str.length - 1);
                    }
                    return str;
                }
            } else {
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
    .directive('animationend', function () {
        return {
            restrict: 'A',
            scope: {
                animationend: '&'
            },
            link: function (scope, element) {
                var callback = scope.animationend(),
                    events = 'animationend webkitAnimationEnd MSAnimationEnd' + 'transitionend webkitTransitionEnd';
                element.on(events, function (event) {
                    callback.call(element[0], event);
                });
            }
        };
    })
    .filter('unsafe', function ($sce) { return $sce.trustAsHtml; })
    .filter('highlight', function ($sce) {
        return function (input, phrase) {

            // IE 11 exception
            if (!!window.MSInputMethodContext && !!document.documentMode) {
                return input;
            }
            // Edge exveption
            if (window.navigator.userAgent.indexOf("Edge") > -1) {
                return input;
            }

            // regex : not in an html <tag>
            if (phrase && input) input = input.replace(new RegExp('(?<!<[^>]*)(' + phrase + ')', 'gi'),
                '<span class="highlighted">$1</span>')
            return $sce.trustAsHtml(input)
        }
    })
    .filter('level_hl', function ($sce) {
        return function (input) {
            if (input != null) {
                input = input.replace('&#8211; ', '');
                input = input.replace(new RegExp('(' + 'Niveau perfectionnement' + ')', 'gi'),
                    '<span class="level_hl">$1</span>')
                input = input.replace(new RegExp('(' + 'Niveau initiation' + ')', 'gi'),
                    '<span class="level_hl">$1</span>')
                return input
            }
        }
    })
    .filter('searchFor', function () {
        return function (arr, searchString) {
            if (!searchString) {
                return arr;
            }
            var result = [];
            searchString = searchString.toLowerCase();
            angular.forEach(arr, function (item) {
                if (item.title.toLowerCase().indexOf(searchString) !== -1) {
                    result.push(item);
                } else if (item.description.toLowerCase().indexOf(searchString) !== -1) {
                    result.push(item);
                }
            });
            return result;
        }
    })
    // inject additional search result from database query 
    .filter('databaseQuery', function () {
        return function (arr, scope) {
            function isInArray(value, array) {
                return array.indexOf(value) > -1;
            }
            // compare displayed list (arr) with database result  (scope.database_course)
            // and add to arr the dif
            temp_arr = [];
            arr.forEach(function (element) {
                temp_arr.push(element.id);
            });
            temp_arr_2 = [];
            scope.database_course.forEach(function (element) {
                if (isInArray(element, temp_arr)) { } else {
                    temp_arr_2.push(element);
                }
            });
            // add additional result to output
            temp_arr_2.forEach(function (element2) {
                scope.courses.course.forEach(function (element) {
                    if (element.id == element2) {
                        arr.push(element);
                    }
                });
            });

            if (arr.length == 0) {
                return scope.courses.course;
            } else {
                return arr;
            }
        }
    })
    .filter('searchThema', function () {
        return function (items, thema, scope) {
            var result = [];
            // get slug of the selected thema
            angular.forEach(scope.courses.themas, function (item) {
                if (item.enabled) {
                    selectedThema = item.slug;
                }
            });
            // foreach course
            angular.forEach(items, function (item) {
                // loop through course themas
                for (var i = 0; i < item.thema.length; i++) {
                    if (typeof item.thema[i] != 'undefined') {
                        // check if item thema has a slug
                        if (item.thema[i].hasOwnProperty('slug')) {
                            // if checked thematique = item thematique, keep it
                            if (item.thema[i].slug == selectedThema) {
                                // check duplicated objects
                                if (result.indexOf(item) > -1) {
                                } else {
                                    // output it
                                    result.push(item);
                                }
                            }
                        }
                    } else {
                        scope.enableThemaFilter = false;
                    }
                }
            });

            if (scope.enableThemaFilter == true) {
                return result;
            } else {
                return items;
            }
        };
    })
    .filter('filterThema', function () {
        return function (items, thema_slug, scope) {
            var result = [];

            // foreach course
            angular.forEach(items, function (item) {
                // loop through course themas
                for (var i = 0; i < Object.keys(scope.thema).length; i++) {
                    if (typeof item.thema[i] != 'undefined') {
                        // check if item thema has a slug
                        if (item.thema[i].hasOwnProperty('slug')) {
                            // if checked thematique = item thematique, keep it
                            if (item.thema[i].slug == thema_slug) {
                                // check duplicated objects
                                if (result.indexOf(item) > -1) {
                                } else {
                                    // output it
                                    result.push(item);
                                }
                            }
                        }
                    }
                }
            });

            return result;

        };
    })


// scroll on filter press
var filterLabels = document.querySelectorAll("#thematiques-input label");
filterLabels = Array.from(filterLabels); // IE11 compatibility
filterLabels.forEach(function (button) {
    button.addEventListener('click', function (event) {
        scrollToResults();
    })
});
// scroll on search button clicked
if (document.querySelector("#search .btn"))
    document.querySelector("#search .btn").onclick = function (event) {
        scrollToResults();
    }
// scroll on enter key press
var txtbox = document.querySelector("#search input");
if (txtbox)
    txtbox.onkeydown = function (e) {
        if (e.key == "Enter") {
            scrollToResults();
        }
    };
function scrollToResults() {
    var menuHeight = document.getElementById('kz-menu-wrapper').offsetHeight;
    var searchHelper = document.getElementById('search-helper');
    var searchHelperPos = searchHelper.getBoundingClientRect();
    window.scrollBy(0, searchHelperPos.top - menuHeight);
}


// Fix nav bar on scroll
var filterNav = document.querySelector('#thematiques-input')
if (filterNav)
    window.addEventListener('scroll', () => {

        if (window.scrollY > 50) {
            if (window.innerWidth > 1200) {

                if (document.querySelector('#datadock_subheader')?.style.display == '') {
                    filterNav.style.top = '205px'
                } else {
                    filterNav.style.top = '149px'
                }
            } else {
                if (document.querySelector('#datadock_subheader')?.style.display == '') {
                    filterNav.style.top = '116px'
                } else {
                    filterNav.style.top = '53px'
                }
            }

            filterNav.classList.add('fix')
        } else {
            filterNav.style.top = 'initial'
            filterNav.classList.remove('fix')
        }
    })

// Fix nav bar on scroll
var filterNav = document.querySelector('.xs-container-menu-filtre')
if (filterNav)
    window.addEventListener('scroll', () => {

        if (window.scrollY > 50) {
            if (window.innerWidth > 1200) {

                if (document.querySelector('#datadock_subheader')?.style.display == '') {
                    filterNav.style.top = '205px'
                } else {
                    filterNav.style.top = '149px'
                }
            } else {
                if (document.querySelector('#datadock_subheader')?.style.display == '') {
                    filterNav.style.top = '137px'
                } else {
                    filterNav.style.top = '74px'
                }
            }

            filterNav.classList.add('fix')
        } else {
            filterNav.style.top = 'initial'
            filterNav.classList.remove('fix')
        }
    })