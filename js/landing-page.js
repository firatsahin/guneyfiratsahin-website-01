// GLOBAL HELPER FUNCTIONS - BEGIN
// general helper functions
//function log(args){for(var i=0;i<arguments.length;i++){console.log(arguments[i]);}}
var log = console.log;
// GLOBAL HELPER FUNCTIONS - END


$(window).resize(function () {
    // mode calculation based on window width
    var width = $(window).outerWidth(), height = $(window).outerHeight(), mode;
    // Display Modes: [3: PC | 2: Tablet | 1: Phone]
    if (width >= 1150) {
        mode = 3;
    } else if (width >= 800) {
        mode = 2;
    } else {
        mode = 1;
    }
    $("body").attr("view-mode", mode).removeClass("frt-cloak");

    // dynamic min-height assignment (for mobile mode)
    $(".landing-box-div").each(function (i, elm) {
        var borderH = i != $(".landing-box-div").length - 1 ? 1 : 0;
        $(this).css('min-height', mode == 1 ? (($(window).height() / 3) - borderH) : '');
    });

    // vertical alignment for the content in each box
    $(".landing-box-div").find(".landing-box-div-inner").css('margin-top', ''); // clear existing margin first
    $(".landing-box-div").each(function () {
        var height1 = $(this).outerHeight(), height2 = $(this).find(".landing-box-div-inner").outerHeight();
        //log(height1, height2);
        $(this).find(".landing-box-div-inner").css('margin-top', (height1 - height2) / 2);
    });
});

$(function () {
    //log("doc ready", $("body"));

    less.pageLoadFinished.then(function () { // after LESS compile done
        $(window).resize(); // trigger once on first load
    });

    // landing box link action to the related inner page
    $("div.landing-box-div.has-link").click(function () {
        var linkToGo = $(this).attr('link'), target = $(this).attr('link-target');
        if (linkToGo) {
            if (target == '_blank') window.open(linkToGo); else location.href = linkToGo;
        }
    });

    // section links click event > prevent default bc outer event redirects already
    $("div.landing-box-div.has-link a.link-to-section").click(function (e) {
        e.preventDefault();
    });

    // social media links click
    $("div.landing-box-div div.landing-box-div-inner div.socmed-icons-container a.socmed-link").click(function (e) {
        e.stopPropagation();
    });
});