function setFilter(filter) {
    console.log(filter);
    $(".mix").hide();
    $("." + filter).show();
    $("#dialogContent").hide();

}

function setFilterElement(filter) {
    console.log(filter);
    $(".typeClass1 ").hide();
    $(".typeClass2 ").hide();
    $(".typeClass3 ").hide();
    $(".typeClass4 ").hide();
    $(".typeClass5 ").hide();
    $(".typeClass6 ").hide();
    $(".typeClass7 ").hide();
    $("." + filter).show();
    $("#dialogContent").hide();

}




jQuery(document).ready(function (e) {


    //PROD
    //var video = new Videos('http://bsnm.s3.amazonaws.com/vivatechnology2018livedata/7fc8ed0e812d8422ba342e97f05698f2',1);
    var video = new Videos('http://bsnm.s3.amazonaws.com/vivatechnology2018livedata/4594089ca6ad1844622bd5fd352cd37e', 1);
    reload_video();
    var listeExposants = $(".listeExposantsImg");
    // Autocomplete when search for exhibitors (starts when there is at least 3 characters
    $("#autocomplete").keyup(function () {
        callAutoComplete($(this).val());
    });


    // Manage mouse up events
    $(document).click(function (e) {
        var suggestions = $("#suggestions");
        var mark = $("#divMark");
        var searchInput = $("#autocomplete");
        //var virtualKeyboard_= $("#virtualKeyboard_");
        var searchEl = $(".search");
        // Hide exhibitor list when the user clicks outside of the div
        // if the target of the click isn't the container nor a descendant of the container
        if ((!suggestions.is(e.target) && suggestions.has(e.target).length === 0) &&
            (!mark.is(e.target) && mark.has(e.target).length === 0) &&
            (!searchInput.is(e.target) && searchInput.has(e.target).length === 0)) {
            suggestions.hide();
            //mark.hide();
        }

        //if(!isInsideSearchBox(e.target))
        //	virtualKeyboard_.hide();
        // If search input has focus and is empty
        if (searchInput.is(":focus")) {
            //virtualKeyboard_.show();

            mark.hide();
            if (searchInput.val().length === 0) {
                suggestions.hide();
            }
            else {
                if (suggestions.is(":hidden") && (searchInput.val().length >= 2)) {
                    callAutoComplete(searchInput.val());
                }
            }
        }

        // Manage keyboard
        var keyboard = $("#virtualKeyboard");

        // if input hasn't focus and keyboard is hidden : show it
        if (searchInput.is(":focus") && keyboard.is(":hidden")) {
            //keyboard.show();
        }
        else {
            if (!keyboard.is(":hidden")) {
                // If user click outside of keyboard and search input
                if ((!keyboard.is(e.target) && keyboard.has(e.target).length === 0) &&
                    (!searchInput.is(e.target) && searchInput.has(e.target).length === 0)) {
                    //keyboard.hide();
                }
            }
        }
    });

    // Disable the right mouse click menu
    $(document)[0].oncontextmenu = function () {
        return false;
    };

    // Init virtual keyboard
    jsKeyboard.init("virtualKeyboard");

    // First input focus
    var $firstInput = $(':input').first().focus();
    jsKeyboard.currentElement = $firstInput;
    jsKeyboard.currentElementCursorPosition = 0;

    // Reset imput
    $("#autocomplete").val('');

    // Hide keyboard if input hasn't focus
    if (!$("#autocomplete").is(":focus")) {
        //jsKeyboard.hide();
    }

    $(".reset").click(function () {
        $("#autocomplete").val('');
        $("#suggestions").hide();
    });

    //show list of exposants
    listeExposants.click(function (event) {
        //callAutoComplete($(this).val());
        showListExposants(event);
    });

    showListExposants();
    if ($("#callFunction_") && $("#callFunction_").val() != '') {
        console.log($('.selected_area'));
        $('.selected_area').trigger('mouseover');
    }

    $(document.body).bind("mousemove keypress", function (e) {
        time_hide_popup = new Date().getTime();
        time_reload_page = new Date().getTime();
        time_screen_saver = new Date().getTime();
        hide_screen_saver_animation();
        console.log(time_reload_page)
    });


    setTimeout(refresh_page, 30000);
    setTimeout(show_screen_saver, 10000);
    setTimeout(hide_popup, 10000);

    var owl = $('.owl-carousel');
    owl.owlCarousel({
        items: 7,
        loop: true,
        margin: 30,
        autoplay: true,
        autoplayTimeout: 5000,
        autoplayHoverPause: true
    });


    /*keyboard = {
        'layout': [
            // alphanumeric keyboard type
            // text displayed on keyboard button, keyboard value, keycode, column span, new row
            [
                [
                    ['`', '`', 192, 0, true], ['1', '1', 49, 0, false], ['2', '2', 50, 0, false], ['3', '3', 51, 0, false], ['4', '4', 52, 0, false], ['5', '5', 53, 0, false], ['6', '6', 54, 0, false],
                    ['7', '7', 55, 0, false], ['8', '8', 56, 0, false], ['9', '9', 57, 0, false], ['0', '0', 48, 0, false], ['-', '-', 189, 0, false], ['=', '=', 187, 0, false],
                    ['a', 'a', 65, 0, true], ['z', 'z', 90, 0, false], ['e', 'e', 69, 0, false], ['r', 'r', 82, 0, false], ['t', 't', 84, 0, false], ['y', 'y', 89, 0, false], ['u', 'u', 85, 0, false],
                    ['i', 'i', 73, 0, false], ['o', 'o', 79, 0, false], ['p', 'p', 80, 0, false], ['[', '[', 219, 0, false], [']', ']', 221, 0, false], ['&#92;', '\\', 220, 0, false],
                    ['q', 'q', 81, 0, true], ['s', 's', 83, 0, false], ['d', 'd', 68, 0, false], ['f', 'f', 70, 0, false], ['g', 'g', 71, 0, false], ['h', 'h', 72, 0, false], ['j', 'j', 74, 0, false],
                    ['k', 'k', 75, 0, false], ['l', 'l', 76, 0, false], ['m', 'm', 77, 0, false], ['&#39;', '\'', 222, 0, false], ['Enter', '13', 13, 3, false],
                    ['Shift', '16', 16, 2, true], ['w', 'w', 87, 0, false], ['x', 'x', 88, 0, false], ['c', 'c', 67, 0, false], ['v', 'v', 86, 0, false], ['b', 'b', 66, 0, false], ['n', 'n', 78, 0, false],
                    [';', ':', 186, 0, false], ['@', '@', 50, 0, false], ['.', '.', 190, 0, false], ['/', '/', 191, 0, false], ['Shift', '16', 16, 2, false],
                    ['Supp', '8', 8, 3, true], ['Space', '32', 32, 12, false], ['Clear', '46', 46, 3, false], ['Supp', '8', 8, 3, false]
            ],
            [
                ['~', '~', 192, 0, true], ['!', '!', 49, 0, false], [',', ',', 188, 0, false], ['#', '#', 51, 0, false], ['$', '$', 52, 0, false], ['%', '%', 53, 0, false], ['^', '^', 54, 0, false],
                ['&', '&', 55, 0, false], ['*', '*', 56, 0, false], ['(', '(', 57, 0, false], [')', ')', 48, 0, false], ['_', '_', 189, 0, false], ['+', '+', 187, 0, false],
                ['A', 'A', 65, 0, true],['Z', 'Z', 90, 0, false], ['E', 'E', 69, 0, false], ['R', 'R', 82, 0, false], ['T', 'T', 84, 0, false], ['Y', 'Y', 89, 0, false], ['U', 'U', 85, 0, false],
                ['I', 'I', 73, 0, false], ['O', 'O', 79, 0, false], ['P', 'P', 80, 0, false], ['{', '{', 219, 0, false], ['}', '}', 221, 0, false], ['|', '|', 220, 0, false],
                ['Q', 'Q', 81, 0, true], ['S', 'S', 83, 0, false], ['D', 'D', 68, 0, false], ['F', 'F', 70, 0, false], ['G', 'G', 71, 0, false], ['H', 'H', 72, 0, false], ['J', 'J', 74, 0, false],
                ['K', 'K', 75, 0, false], ['L', 'L', 76, 0, false], ['M', 'M', 77, 0, false], ['"', '"', 222, 0, false], ['Search', '13', 13, 3, false],
                ['Maj', '16', 16, 2, true], ['W', 'W', 87, 0, false], ['X', 'X', 88, 0, false], ['C', 'C', 67, 0, false], ['V', 'V', 86, 0, false], ['B', 'B', 66, 0, false], ['N', 'N', 78, 0, false],
                [':', ':', 186, 0, false], ['<', '<', 188, 0, false], ['>', '>', 190, 0, false], ['?', '?', 191, 0, false], ['Maj', '16', 16, 2, false],
                ['Supp', '8', 8, 3, true], ['Space', '32', 32, 12, false], ['Supp', '46', 46, 3, false],  ['Supp', '8', 8, 3, false]
            ]
            ]
        ]
    }
    $('#autocomplete').initKeypad({'keyboardLayout': keyboard});*/
});	
