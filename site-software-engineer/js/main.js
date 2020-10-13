// GLOBAL HELPER FUNCTIONS - BEGIN
var log = console.log;

function getViewMode() {
    return window.matchMedia("(max-width: 800px)").matches ? 1 :
        window.matchMedia("(max-width: 991px)").matches ? 2 :
            window.matchMedia("(max-width: 1199px)").matches ? 3 : 4;
}

function windowScrollTo(scrollTop) {
    $("html, body").animate({scrollTop: scrollTop}, 700);
}

// hash helper functions
function hashHasData() {
    return (location.hash != "" && location.hash.indexOf("#!") == 0 && location.hash != "#!");
}
function readHashAsObject() {
    var hashObj = {};
    if (!hashHasData()) return hashObj;
    location.hash.substring(2, location.hash.length).split("&").forEach(function (item) {
        var kvArray = item.split("=");
        if (kvArray[0] !== "") hashObj[kvArray[0]] = kvArray[1] || "";
    });
    return hashObj;
}
function writeObjectToHash(hashObj, replace) {
    if (!jQuery.isPlainObject(hashObj)) return;
    var hashVal = "#!";
    var i = 0;
    for (var key in hashObj) {
        if (hashObj.hasOwnProperty(key)) {
            hashVal += (i > 0 ? "&" : "") + key + "=" + hashObj[key];
            i++;
        }
    }
    //log(hashVal);
    if (replace) window.history.replaceState({}, document.title, hashVal); else location.href = hashVal;
}

// form data collection function
function getFormData($form) {
    var unindexed_array = $form.serializeArray();
    var indexed_array = {};

    $.map(unindexed_array, function (n, i) {
        indexed_array[n['name']] = n['value'];
    });

    return indexed_array;
}

// content scroll helpers
function getContentScroll() {
    return getViewMode() != 1 ? Math.abs(parseInt($(".content_2:visible .mCSB_container").css("top"))) : null;
}
function setContentScroll(scrollTop) {
    if (getViewMode() != 1) {
        $(".content_2:visible .mCSB_container").css("top", -scrollTop);
        $(".content_2:visible").mCustomScrollbar("update");
    }
}

// query string helper functions
function generateURIWithQueryString(o) {
    var qStr = '', qsObj = {};
    if (location.search !== '' && location.search !== '?') {
        location.search.substring(1).split("&").forEach(function (val) {
            var kv = val.split("=");
            if (kv[0]) qsObj[kv[0]] = kv[1];
        });
    }
    for (var key in o) {
        qsObj[key] = o[key];
    }
    log(qsObj);
    var i = 0;
    for (var key in qsObj) {
        if (qsObj[key] === null) continue;
        qStr += (i > 0 ? '&' : '') + key + "=" + qsObj[key];
        i++;
    }
    qStr = '?' + qStr.trim();
    log(qStr);
    if (qStr === '?') return location.pathname;
    return qStr;
}
// GLOBAL HELPER FUNCTIONS - END

jQuery(document).ready(function($) {

    /* ---------------------------------------------------------------------- */
    /*	------------------------------- Loading ----------------------------- */
    /* ---------------------------------------------------------------------- */

    /*Page Preloading*/
    $(window).load(function() {
        $('#spinner').fadeOut(200);
        $('#preloader').delay(200).fadeOut('slow');
        $('.wrapper').fadeIn(200);
        //$('#custumize-style').fadeIn(200);
        if (getViewMode() != 1) performTabChangeAnimation();
        if (localStorage.isSiteMaximized == "1") $("div[name=icon-minimize-maximize]").trigger("click");
    });

    /* ---------------------------------------------------------------------- */
    /* ------------------------------- Taps profile ------------------------- */
    /* ---------------------------------------------------------------------- */

    $('.collapse_tabs').click(function() {

        if ($(this).hasClass('collapsed')) {
            $(this).find('i.glyphicon').removeClass("glyphicon-chevron-down").addClass("glyphicon-chevron-up");
        } else {
            $(this).find('i.glyphicon').removeClass("glyphicon-chevron-up").addClass("glyphicon-chevron-down");
        }

    });

    // send e-mail to me script
    $("span.span-mt-link").click(function () {
        var mailtoLink = "mailto:" + atob($(this).attr('mt-link')); //log(mailtoLink);
        location.href = mailtoLink;
    });

    // minimize-maximize content
    $("div[name=icon-minimize-maximize]").click(function () {
        $("body").toggleClass('is-maximized');
        localStorage.isSiteMaximized = ($("body").hasClass('is-maximized') ? 1 : 0); // put miximize setting to local storage
        redimensionnement();
    });

    /* ---------------------------------------------------------------------- */
    /* -------------------------- easyResponsiveTabs ------------------------ */
    /* ---------------------------------------------------------------------- */

    $('#verticalTab').easyResponsiveTabs({
        type: 'vertical',
        width: 'auto',
        fit: true
    });

    $("h2.resp-accordion").click(function() {
        $(this).find(".icon_menu").addClass("icon_menu_active");
        $("h2.resp-accordion").not(this).find(".icon_menu").removeClass("icon_menu_active");

        /*	Scroll To */
        $('html, body').animate({scrollTop: $('h2.resp-accordion').offset().top - 50}, 600);
    });

    $(".resp-tabs-list li").click(function() {
        $(this).find(".icon_menu").addClass("icon_menu_active");
        $(".resp-tabs-list li").not(this).find(".icon_menu").removeClass("icon_menu_active");
    });

    // tab buttons > mousedown event
    $(".resp-tabs-list li").mousedown(function (e) {
        var index = $(".resp-tabs-list li").index(this);
        var urlToGo = null;
        if (e.which == 1) { // left click
            log("left clicked to tab:" + index);
            if (siteData.isBlog && siteData.blogActiveTabIndex == index) { // blog site tabs
                log("same tab");
                switch (index) {
                    case 0: urlToGo = siteData.softwareEngineerRootUri + siteData.blogSiteSuffix; break;
                    case 1: urlToGo = siteData.softwareEngineerRootUri + siteData.blogSiteSuffix + "/categories"; break;
                }
            }
            if (urlToGo) location.href = urlToGo;
        }
        if (e.which == 2) { // middle click
            log("middle clicked to tab:" + index);
            if (siteData.isBlog) { // blog site tabs
                switch (index) {
                    case 0: urlToGo = siteData.softwareEngineerRootUri + siteData.blogSiteSuffix; break;
                    case 1: urlToGo = siteData.softwareEngineerRootUri + siteData.blogSiteSuffix + "/categories"; break;
                    case 2: urlToGo = siteData.softwareEngineerRootUri; break;
                }
            } else { // main site tabs
                switch (index) {
                    case 0: case 1: case 2: case 3: urlToGo = location.pathname + "#!tab=" + $(this).attr('data-tab-name'); break;
                    case 4: urlToGo = siteData.softwareEngineerRootUri + siteData.blogSiteSuffix; break;
                }
            }
            if (urlToGo) window.open(urlToGo);
        }
    });

    $(".resp-tabs-list li").hover(function() {
        $(this).find(".icon_menu").addClass("icon_menu_hover");
    }, function() {
        $(this).find(".icon_menu").removeClass("icon_menu_hover");
    });

    $("h2.resp-accordion").hover(function() {
        $(this).find(".icon_menu").addClass("icon_menu_hover");
    }, function() {
        $(this).find(".icon_menu").removeClass("icon_menu_hover");
    });

    /* ---------------------------------------------------------------------- */
    /* --------------------------- Scroll tabs ------------------------------ */
    /* ---------------------------------------------------------------------- */

    function setCustomScrollbars() {
        $(".content_2").mCustomScrollbar({
            theme: "dark-2",
            contentTouchScroll: true,
            scrollInertia: 100,
            advanced: {
                updateOnContentResize: true,
                updateOnBrowserResize: true,
                autoScrollOnFocus: false
            }
        });
    }
    setCustomScrollbars();

    /* ---------------------------------------------------------------------- */
    /* ------------------------- Effect tabs -------------------------------- */
    /* ---------------------------------------------------------------------- */

    var animation_style = 'bounceIn';
    function performTabChangeAnimation() {
        $('.resp-tabs-container').addClass('animated ' + animation_style);
        $('.resp-tabs-container').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function () {
            $('.resp-tabs-container').removeClass('animated ' + animation_style);
        });
    }

    // non-blog zone actions
    if (!siteData.isBlog) {

        // tab change event (PC mode)
        $('ul.resp-tabs-list li[class^=tabs-]').click(function (e) {

            var tabName = $(this).attr('data-tab-name');

            if (tabName == "blog") {
                location.href = siteData.softwareEngineerRootUri + siteData.blogSiteSuffix;
                return;
            }

            performTabChangeAnimation();

            $(".content_2").mCustomScrollbar("destroy");
            setCustomScrollbars();

            var hashObj = readHashAsObject();
            if (!hashObj.tab || hashObj.tab != tabName) { // tab changed
                writeObjectToHash({tab: tabName});
            } else { // same tab clicked
                log("same tab clicked");
            }

            setTimeout(redimensionnement, 0); // to fix content height (while bounce in animation on maximized case)

            return false;
        });

        // tab change event (Mobile mode)
        $("#verticalTab h2.resp-accordion").click(function () {
            var tabName = $(this).find("span.tite-list-resp").text().trim();

            if (tabName == "blog") {
                location.href = siteData.softwareEngineerRootUri + siteData.blogSiteSuffix;
                return;
            }

            var hashObj = readHashAsObject();
            if (!hashObj.tab || hashObj.tab != tabName) writeObjectToHash({tab: tabName});
        });

        // hash change event
        var defaultHashObj = {tab: "profile"};
        var possibleTabs = ["profile", "resume", "portfolio", "contact", "blog"];
        $(window).bind("hashchange", function (e) {
            log("hash changed to: " + location.hash);

            if (!hashHasData()) {
                writeObjectToHash(defaultHashObj, true);
                return;
            } // hash shouldn't be empty AND should start with #! AND shouldn't be exactly "#!"

            var hashObj = readHashAsObject();
            log(hashObj);

            if (!hashObj.tab || possibleTabs.indexOf(hashObj.tab) == -1) { // "tab" parameter is necessary
                writeObjectToHash(defaultHashObj);
                return;
            }

            log("change tab to: " + hashObj.tab);
            var tabToGo = [];
            if (getViewMode() == 1) {
                tabToGo = $("#verticalTab h2.resp-accordion").not(".resp-tab-active").find("span.tite-list-resp").filter(function () {
                    return $(this).text().trim() === hashObj.tab;
                });
            } else {
                tabToGo = $("ul.resp-tabs-list li[data-tab-name='" + hashObj.tab + "']").not(".resp-tab-active");
            }
            tabToGo.click();

            setTimeout(redimensionnement, 400); // trigger redimensionnement (to fix content scroll height) (on mobile mode & not 1st tab case)

            // tab specific logic: [portfolio]
            if (hashObj.tab == "portfolio") {
                if (hashObj.projectId) loadProjectDetails(hashObj.projectId);
                else portfolioChangeStep(1);
            }
        }).trigger("hashchange");
    }

    /* ---------------------------------------------------------------------- */
    /* ---------------------- redimensionnement ----------------------------- */
    /* ---------------------------------------------------------------------- */

    function redimensionnement() {
        var $isMaximized = $("body").hasClass('is-maximized');

        if (getViewMode() == 1) {
            $(".content_2").mCustomScrollbar("destroy");
            $(".resp-vtabs .resp-tabs-container").css("height", "100%");
            $(".content_2").css("height", "100%");
        } else {

            if (getViewMode() == 2) {
                var h = $(window).height() - $("div.widget-profil").outerHeight(true) - parseInt($("div.wrapper").css('margin-top')) - parseInt($("div.wrapper").css('margin-bottom'));
                $(".resp-vtabs .resp-tabs-container").css("height", h);
                $(".content_2").css("height", h);
                $("ul.resp-tabs-list").height(h - parseInt($("ul.resp-tabs-list").css('margin-bottom'))); // add inline height rule
            } else {
                if (!$isMaximized) {
                    $(".resp-vtabs .resp-tabs-container").css("height", "580px");
                    $(".content_2").css("height", "580px");
                    $("ul.resp-tabs-list").height(''); // remove inline height rule
                    $(".widget-profil").height(''); // remove inline height rule
                } else { // MAXIMIZED LOGIC HERE
                    var maximizedHeight = $(window).height() - parseInt($("div.wrapper").css('margin-top')) - parseInt($("div.wrapper").css('margin-bottom'));
                    $(".resp-vtabs .resp-tabs-container").css("height", maximizedHeight + "px");
                    $(".content_2").css("height", maximizedHeight + "px");
                    $("ul.resp-tabs-list").height(maximizedHeight);
                    $(".widget-profil").height(maximizedHeight);
                }
            }

            var scrollBackup = getContentScroll();
            $(".content_2").mCustomScrollbar("destroy");
            setCustomScrollbars();
            setContentScroll(scrollBackup);

            // put downside logic
            if ($("ul.resp-tabs-list li.put-downside").length > 0) {
                var lisTotalH = $("ul.resp-tabs-list > li").length * 76;
                var space = (getViewMode() == 2 ? $("ul.resp-tabs-list").outerHeight(true) : ($isMaximized ? $("ul.resp-tabs-list").outerHeight() : 580)) - lisTotalH;
                if (space < 0) space = 0;
                $("ul.resp-tabs-list li.put-downside").first().css('margin-top', space);
            }

        }

    }

    // On lie l'événement resize à la fonction
    window.addEventListener('load', redimensionnement, false);
    window.addEventListener('resize', redimensionnement, false);

    /* ---------------------------------------------------------------------- */
    /* -------------------------- Contact Form ------------------------------ */
    /* ---------------------------------------------------------------------- */

    // Needed variables
    var $contactform = $('#contactform'),
            $successMsg = ' Your message has been sent to Firat. He\'ll reply to you soon. Thanks!';

    $contactform.submit(function (e) {
        e.preventDefault();

        // preparing form data
        var contactFormData = getFormData($contactform);
        contactFormData.serviceTypes = [];
        $contactform.find("span.service-type.is-active").each(function () {
            contactFormData.serviceTypes.push($(this).text());
        });

        // clear error states before calling
        $contactform.find("#contactform-message").empty();
        $contactform.find("p.form-group[column]").removeClass("has-error");

        $contactform.find("button[name=btnSubmit]").prop('disabled', true).text('SENDING MESSAGE...');
        $.ajax({
            type: "POST",
            url: siteData.softwareEngineerRootUri + "/contact",
            //data: $(this).serialize(),
            data: JSON.stringify(contactFormData),
            contentType: "application/json",
            success: function (result) {
                if (result.success) { // success
                    var response = '<div class="alert alert-success success-send">' +
                        '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' +
                        '<i class="glyphicon glyphicon-ok" style="margin-right: 5px;"></i> ' + $successMsg
                        + '</div>';

                    $(".reset").trigger('click');

                    // Show response message
                    $contactform.find("#contactform-message").append(response);

                    // success case > remove success message after a while
                    setTimeout(function () {
                        $contactform.find(".error-send,.success-send").fadeOut(function () {
                            $(this).remove();
                        });
                    }, 5000);
                } else { // failure
                    $contactform.find("p.form-group[column] span.error-messages span[error-type]").hide();
                    result.errors.forEach(function (error) {
                        $contactform.find("p.form-group[column='" + error.colname + "']").addClass("has-error")
                            .find("span.error-messages span[error-type='" + error.errorType + "']").show();
                    });

                    // focus to first error field
                    if (result.errors.length > 0) $contactform.find("p.form-group[column='" + result.errors[0].colname + "']").find(".form-control").focus();

                    var response = '<div class="alert alert-danger error-send">' +
                        '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' +
                        '<i class="glyphicon glyphicon-remove" style="margin-right: 5px;"></i> ' + result.message
                        + '</div>';

                    // Show response message
                    $contactform.find("#contactform-message").append(response);
                }
            }
        }).fail(function () {
            log("failure");
        }).always(function () {
            $contactform.find("button[name=btnSubmit]").prop('disabled', false).text('SEND MESSAGE');
        });
    });

    // clear button click
    $contactform.find("input[type=reset]").click(function(e) {
        e.preventDefault();
        $contactform[0].reset();
        $contactform.find("#contactform-message").empty();
        $contactform.find("p.form-group[column]").removeClass("has-error");
        $contactform.find("p.form-group[column=serviceTypes] span.service-type").removeClass('is-active');
        $contactform.find("p.form-group[column=employType] .form-control").trigger("change");
    });

    // service type > select-deselect
    $contactform.find("span.service-type").click(function () {
        $(this).toggleClass('is-active');
    });

    // employ type change > change the note
    $contactform.find("p.form-group[column=employType] .form-control").change(function () {
        var index = $(this).prop('selectedIndex');
        $contactform.find("p.form-group[column=employType] span[for-option]").hide().filter("[for-option='" + index + "']").show();
    }).trigger("change");

    // amount focus out > normalize
    $contactform.find("p.form-group[column=budget] .form-control[name=budgetAmount]").blur(function () {
        if ($(this).val()) {
            $(this).val(parseFloat($(this).val()).toFixed(2));
            log("normalized to: ", $(this).val());
        }
    });

    /* ---------------------------------------------------------------------- */
    /* ----------------------------- Portfolio ------------------------------ */
    /* ---------------------------------------------------------------------- */


    var filterList = {
        init: function() {

            // MixItUp plugin
            // http://mixitup.io
            $('#portfoliolist').mixitup({
                targetSelector: '.portfolio',
                filterSelector: '.filter',
                effects: ['fade'],
                easing: 'snap',
            });

        }

    };

    // Run the show!
    filterList.init();

    // each portfolio item click
    $("#portfolio .portfolio").click(function (e) {
        e.preventDefault();
        var projectId = $(this).attr('project-id');
        if (!projectId) return; // no project id
        if (projectId === '-1') { // new project > go to contact tab
            writeObjectToHash({tab: "contact"});
            return;
        }

        // add project id to hash
        var hashObj = readHashAsObject();
        hashObj.projectId = projectId;
        writeObjectToHash(hashObj);
    });

    function loadProjectDetails(projectId){
        var p = JSON.parse($("#portfoliolist .portfolio[project-id='" + projectId + "']").attr('data-project')); log(p);

        portfolioChangeStep(2);

        // data binding to detail section
        $("#portfolio [entity=project][column]").each(function () {
            $(this).html(p[$(this).attr('column')]);
        });

        // project share part binding
        var pShareWrapper = $("#portfolio .container-portfolio-detail span[name=project-share]");
        if (p.projectShare) {
            pShareWrapper.show();
            var valSpans = pShareWrapper.find("span[project-share-val]").hide().filter("[project-share-val='" + p.projectShare + "']").show();
            if (valSpans.length == 0) pShareWrapper.hide(); // invalid value case
        } else pShareWrapper.hide();

        // description binding
        $("#portfolio [entity=project][column=description]").empty();
        p.description.forEach(function (desc) {
            $("#portfolio [entity=project][column=description]").append('<p style="margin-bottom:20px;">' + desc + '</p>')
        });

        // project link binding
        $("#portfolio a.portfolio-seeprojectbutton")[p.projectLink ? 'show' : 'hide']().attr('href', p.projectLink || '#');

        // images binding
        var imgsWrapper = $("#portfolio .container-portfolio-detail div[name=images-wrapper]");
        if (p.images && jQuery.isArray(p.images) && p.images.length > 0) {
            imgsWrapper.show().find("[entity=project][column=images]").empty();
            p.images.forEach(function (img) {
                $("<a>").prop({href: img.bigImg || '#', target: "_blank"}).addClass('image-box').css({'background-image': 'url("' + img.thumbImg + '")'}).appendTo(imgsWrapper.find("[entity=project][column=images]"));
            });
            //imgsWrapper.find("[entity=project][column=images] a.image-box").not("[href='#']").prettyPhoto({theme: "facebook"});
        } else imgsWrapper.hide();

        // related to part binding
        var rtWrapper = $("#portfolio .container-portfolio-detail div[name=related-to-wrapper]");
        if (p.relatedExperience || p.relatedEducation) {
            rtWrapper.show();
            rtWrapper.find("span[name=related-to-kind]").text(p.relatedExperience ? 'experience' : p.relatedEducation ? 'education' : '');
            rtWrapper.find("span[name=related-to-text]").text(p.relatedExperience ? p.relatedExperience.title + ' at ' + p.relatedExperience.companyName : p.relatedEducation ? 'Student at ' + p.relatedEducation.schoolName + ', ' + p.relatedEducation.degreeName + ' ' + (p.relatedEducation.majorName || '') : '');
        } else rtWrapper.hide();

        // categories binding
        $("#portfolio [entity=project][column=categories]").empty();
        p.categories.forEach(function (cat) {
            var catName = $("#portfolio ul#filters li span[data-filter='" + cat + "']").text();
            $("#portfolio [entity=project][column=categories]").append('<span cat-key="' + cat + '">' + catName + '</span>');
        });

        // scroll to top of project detail
        if (getViewMode() == 1) windowScrollTo(564); //windowScrollTo($("a.portfolio-backbutton").offset().top - 14);
    }
    var portfolioStep1cs = null;
    function portfolioChangeStep(step) {
        switch (step) {
            case 1:
                $("#portfolio .container-portfolio-detail").hide().siblings(".container-portfolio").show();
                if (portfolioStep1cs) {
                    log("restored portfolioStep1cs:", portfolioStep1cs);
                    setContentScroll(portfolioStep1cs)
                    portfolioStep1cs = null;
                }
                break;
            case 2:
                portfolioStep1cs = getContentScroll();
                log("backed up portfolioStep1cs:", portfolioStep1cs);
                $("#portfolio .container-portfolio").hide().siblings(".container-portfolio-detail").show();
                setContentScroll(0);
                performTabChangeAnimation();
                break;
        }
    }

    // back button click
    $("#portfolio a.portfolio-backbutton").click(function () {
        // remove project id from hash
        var hashObj = readHashAsObject();
        delete hashObj.projectId;
        writeObjectToHash(hashObj);
    });

    // My roles part items click (canceled)
    /*$(document).on("click", "#portfolio div.container-portfolio-detail [entity=project][column=categories] span[cat-key]", function () {
        $("#portfolio a.portfolio-backbutton").click();
        $("#portfolio ul#filters li span[data-filter='" + $(this).attr('cat-key') + "']").click();
    });*/

    /* ---------------------------------------------------------------------- */
    /* ----------------------------- prettyPhoto ---------------------------- */
    /* ---------------------------------------------------------------------- */

    //$("a[rel^='portfolio']").prettyPhoto({
    //    animation_speed: 'fast', /* fast/slow/normal */
    //    social_tools: '',
    //    theme: 'pp_default',
    //    horizontal_padding: 5,
    //    deeplinking: false,
    //    allow_resize: false,
    //});



    /* ---------------------------------------------------------------------- */
    /* ------------------------------ Google Maps --------------------------- */
    /* ---------------------------------------------------------------------- */

    var map;
    function initialize() {
        map = new GMaps({
            div: '#map',
            lat: -37.817917,
            lng: 144.965065,
            zoom: 16

        });
        map.addMarker({
            lat: -37.81792,
            lng: 144.96506,
            title: 'Marker with InfoWindow',
            icon: 'images/pins-map/map-marker.png',
            infoWindow: {
                content: '<p>Melbourne Victoria, 300, Australia</p>'
            }
        });
    }

    /* ---------------------------------------------------------------------- */
    /* --------------------------------- Blog ------------------------------- */
    /* ---------------------------------------------------------------------- */

    // blog zone actions
    if (siteData.isBlog) {

        // tab change event (PC mode)
        $('ul.resp-tabs-list li[class^=tabs-]').click(function (e) {
            if ($('ul.resp-tabs-list li[class^=tabs-]').index(this) == siteData.blogActiveTabIndex) {
                redimensionnement();
                return; // prevent redirection to the same tab
            }

            var tabName = $(this).attr('data-tab-name');

            if (tabName == "blog") {
                location.href = siteData.softwareEngineerRootUri + siteData.blogSiteSuffix;
                return;
            }

            if (tabName == "blog categories") {
                location.href = siteData.softwareEngineerRootUri + siteData.blogSiteSuffix + "/categories";
                return;
            }

            ////////////////////////////////////////////////////////////////////

            if (tabName == "home") {
                location.href = siteData.softwareEngineerRootUri;
                return;
            }

            return false;
        });

        $('ul.resp-tabs-list li[class^=tabs-]').eq(siteData.blogActiveTabIndex).trigger("click"); // go to blogActiveTab initially

        // tab change event (Mobile mode)
        $("#verticalTab h2.resp-accordion").click(function () {
            if ($("#verticalTab h2.resp-accordion").index(this) == siteData.blogActiveTabIndex) return; // prevent redirection to the same tab

            var tabName = $(this).find("span.tite-list-resp").text().trim();

            if (tabName == "blog") {
                location.href = siteData.softwareEngineerRootUri + siteData.blogSiteSuffix;
                return;
            }

            if (tabName == "blog categories") {
                location.href = siteData.softwareEngineerRootUri + siteData.blogSiteSuffix + "/categories";
                return;
            }

            ////////////////////////////////////////////////////////////////////

            if (tabName == "home") {
                location.href = siteData.softwareEngineerRootUri;
                return;
            }
        });

        var $blogPageType = $("div#blog_page").attr('blog-page-type');
        log("$blogPageType:", $blogPageType);

        if ($blogPageType == 'list-posts') {

            if (getViewMode() == 1) $("h1.h-bloc > div > span[name=blog-title-prefix]").hide();

            // DDL: Post Set > change event and initial value set
            $("div#blog select[name=post-set-ddl]").change(function () {
                var sVal = this.value;
                if ($(this).find("option").first().val() === this.value) sVal = null;
                var urlToGo = generateURIWithQueryString({p: null, s: sVal});
                log(urlToGo);
                location.href = urlToGo;
            });
            setTimeout(function () { // this timeout needed somehow.. (to update ddl val on initial load) (especially on history nav case)
                $("div#blog select[name=post-set-ddl]").val($("div#blog select[name=post-set-ddl]").attr('post-set'));
            });

            // write first 300 chars of post's first paragraph
            $("div#blog_page").find("article[id^=post-]").each(function () {
                var firstP = $(this).find("div.blog-content > p").first();
                var firstPText = firstP.text().trim();
                firstP.html(firstPText.length > 300 ? firstPText.substr(0, 300).trim() + '...' : firstPText);
            });

        }

        if ($blogPageType == 'list-categories' || $blogPageType == 'edit-categories') {

            // Categories part
            var $blogCategories = $("#blog-categories");
            if ($blogCategories.length > 0) {
                $blogCategories.find("ul[level]").each(function () {
                    $(this).css('margin-left', $(this).attr('level') * 15);
                });
            }

            // sub categories expand-collapse
            $blogCategories.find("ul[level] > li:not([subcat-count='0'])").find("> i" + ($blogPageType == 'list-categories' ? ', > div.category' : '')).click(function (e) {
                if ($(this).find("> a.cat-link").is(e.target)) return; // exclude 'See Posts' link from expand-collapse action
                $(this).closest("li").toggleClass('is-open');
            });

            // collapse-expand all
            $("#blog-page").find("button[name=btnExpandAll], button[name=btnCollapseAll]").click(function () {
                var isExpand = $(this).attr('name') == 'btnExpandAll';
                $blogCategories.find("ul[level] > li:not([subcat-count='0'])")[isExpand ? 'addClass' : 'removeClass']('is-open');
            });
            $("#blog-page").find("button[name=btnExpandAll]").trigger("click"); // expand all initially

            if ($blogPageType == 'edit-categories') { // categories > edit mode

                function callEditCategory(data) {
                    $.ajax({
                        type: "POST",
                        url: "/SoftwareEngineerBlog/editCategory/" + $("span[name=edit-category-key]").text(),
                        data: JSON.stringify(data),
                        contentType: "application/json",
                        success: function (result) {
                            log(result);
                            if (result.success) { // success
                                if (data.whatToDo == "post_add") window.open(siteData.softwareEngineerRootUri + siteData.blogSiteSuffix + 'post-' + result.newPostId + '/some-value.html?edit_post_key=' + result.editPostKey, '_blank');
                                location.reload();
                            }
                        }
                    });
                }

                $("button[name=btnSaveCategory]").click(function () {
                    callEditCategory({
                        whatToDo: "category_update",
                        category: {
                            id: $(this).closest("li[cat-id]").attr("cat-id"),
                            name: $.trim($(this).siblings("input[name=tbxCatName]").val()),
                            parentId: $.trim($(this).siblings("input[name=tbxParentCatID]").val()) || null,
                            sortNo: $.trim($(this).siblings("input[name=tbxSortNo]").val()) || 0,
                        }
                    });
                });

                $("button[name=btnAddNewCategory]").click(function () {
                    callEditCategory({
                        whatToDo: "category_insert",
                        category: {
                            name: $.trim($(this).siblings("input[name=tbxCatName]").val()),
                            parentId: $.trim($(this).siblings("input[name=tbxParentCatID]").val()) || null,
                        }
                    });
                });

                $("button[name=btnDeleteCategory]").click(function () {
                    if (!confirm("Del Category ?")) return;
                    var catLi = $(this).closest("li[cat-id]");
                    callEditCategory({
                        whatToDo: "category_delete",
                        category: {
                            id: catLi.attr('cat-id')
                        }
                    });
                });

                $("a[name=lnkAddNewPost]").click(function () {
                    var catLi = $(this).closest("li[cat-id]");
                    if (!confirm("Add New Post to Category: [" + catLi.find("input[name=tbxCatName]").val() + "] ?")) return;
                    callEditCategory({
                        whatToDo: "post_add",
                        post: {
                            categoryId: catLi.attr('cat-id')
                        }
                    });
                });

            }

        }

        if ($blogPageType == 'show-post') {
            var postId = $("section.content-post").attr('id').replace('post-', '').replace('-page', '');

            var likedPosts = (localStorage.likedPosts ? JSON.parse(localStorage.likedPosts) : []);
            if (likedPosts.indexOf(postId) != -1) $("div.btn-like-post-div").attr('status', '1');

            // like-unlike button click
            $("div.btn-like-post-div").click(function () {
                if (!$(this).attr('status')) {
                    log("like");
                    $(this).attr('status', '1');
                    $("ul.info-post li span[name=like-count]").text(parseInt($("ul.info-post li span[name=like-count]").text()) + 1); // update front value +1
                    var likedPosts = (localStorage.likedPosts ? JSON.parse(localStorage.likedPosts) : []);
                    if (likedPosts.indexOf(postId) == -1) likedPosts.push(postId);
                    localStorage.likedPosts = JSON.stringify(likedPosts); // add like to local storage
                    $.ajax({
                        type: "POST",
                        url: "/SoftwareEngineerBlog/likePost/" + postId,
                        /*data: JSON.stringify({}),*/
                        contentType: "application/json",
                        success: function (result) {
                            log(result);
                        }
                    });
                } else {
                    /*log("unlike");
                    $(this).removeAttr('status');*/
                }
            });

            // Content Type:2 (My Custom Image Slider Implementation)
            $("div[content-type-id=2] div[name=image-slider-wrapper]").each(function () {
                var wrapperDiv = $(this), images = wrapperDiv.find("div[name=image-slider-item]");
                if (images.length == 0) return;
                if (images.filter(".active").length == 0) images.first().addClass('active');

                function updateIndexOnView() {
                    navWrapper.find(".image-slider-nav-numbers span[name=current-index]").text(images.index(images.filter(".active")) + 1);
                }
                function loadImgIfNotLoaded(index) {
                    var imgToLoad = images.find("> img").eq(index);
                    if (imgToLoad.attr('lazy-src')) imgToLoad.attr('src', imgToLoad.attr('lazy-src')).removeAttr('lazy-src');
                }

                if (images.length > 1) {
                    var navWrapper = $("<div>").html('<span style="display: inline-block; background-color: rgba(255, 255, 255, .7); padding: 0px 8px; border-radius: 0px 0px 8px 8px;"></span>').addClass('image-slider-nav-info-wrapper').prependTo(wrapperDiv);
                    $("<span>").addClass('image-slider-nav-prev').html('<i class="fa fa-chevron-left"></i>&nbsp; Prev').appendTo(navWrapper.find((">span"))).click(function () {
                        var indexToShow = (images.index(images.filter(".active")) - 1) % images.length;
                        images.removeClass('active').eq(indexToShow).addClass('active');
                        updateIndexOnView();
                        loadImgIfNotLoaded(indexToShow);
                    });
                    navWrapper.find((">span")).append("&nbsp; | &nbsp;");
                    $("<span>").addClass('image-slider-nav-numbers').html('<span name="current-index"></span> / ' + images.length).appendTo(navWrapper.find((">span")));
                    navWrapper.find((">span")).append("&nbsp; | &nbsp;");
                    $("<span>").addClass('image-slider-nav-next').html('Next &nbsp;<i class="fa fa-chevron-right"></i>').appendTo(navWrapper.find((">span"))).click(function () {
                        var indexToShow = (images.index(images.filter(".active")) + 1) % images.length;
                        images.removeClass('active').eq(indexToShow).addClass('active');
                        updateIndexOnView();
                        loadImgIfNotLoaded(indexToShow);
                    });
                    updateIndexOnView();
                }
                loadImgIfNotLoaded(0);
            });


            var $commentForm = $('form#comment_form'),
                $successMsg = ' Your comment has been sent successfully. Firat will make it visible soon (unless you wrote bad things lol). Thanks for your attention!';

            $commentForm.submit(function (e) {
                e.preventDefault();

                // preparing form data
                var commentFormData = getFormData($commentForm);

                // clear error states before calling
                $commentForm.find("#commentform-message").empty();
                $commentForm.find("p.form-group[column]").removeClass("has-error");

                $commentForm.find("button[name=btnSubmit]").prop('disabled', true).text('POSTING COMMENT...');

                $.ajax({
                    type: "POST",
                    url: "/SoftwareEngineerBlog/addCommentToPost/" + postId,
                    data: JSON.stringify(commentFormData),
                    contentType: "application/json",
                    success: function (result) {
                        log(result);
                        if (result.success) { // success
                            var response = '<div class="alert alert-success success-send">' +
                                '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' +
                                '<i class="glyphicon glyphicon-ok" style="margin-right: 5px;"></i> ' + $successMsg
                                + '</div>';

                            $(".reset").trigger('click');

                            // Show response message
                            $commentForm.find("#commentform-message").append(response);

                            // success case > remove success message after a while
                            setTimeout(function () {
                                $commentForm.find(".error-send,.success-send").fadeOut(function () {
                                    $(this).remove();
                                });
                            }, 10000);
                        } else { // failure
                            $commentForm.find("p.form-group[column] span.error-messages span[error-type]").hide();
                            result.errors.forEach(function (error) {
                                $commentForm.find("p.form-group[column='" + error.colname + "']").addClass("has-error")
                                    .find("span.error-messages span[error-type='" + error.errorType + "']").show();
                            });

                            // focus to first error field
                            if (result.errors.length > 0) $commentForm.find("p.form-group[column='" + result.errors[0].colname + "']").find(".form-control").focus();

                            var response = '<div class="alert alert-danger error-send">' +
                                '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' +
                                '<i class="glyphicon glyphicon-remove" style="margin-right: 5px;"></i> ' + result.message
                                + '</div>';

                            // Show response message
                            $commentForm.find("#commentform-message").append(response);
                        }
                    }
                }).fail(function () {
                    log("failure");
                }).always(function () {
                    $commentForm.find("button[name=btnSubmit]").prop('disabled', false).text('POST COMMENT');
                });
            });

            // clear button click
            $commentForm.find("input[type=reset]").click(function (e) {
                e.preventDefault();
                $commentForm[0].reset();
                $commentForm.find("#commentform-message").empty();
                $commentForm.find("p.form-group[column]").removeClass("has-error");
            });
        }

        if ($blogPageType == 'edit-post') {
            log("editing a post right now!");

            function callEditPost(data) {
                $.ajax({
                    type: "POST",
                    url: "/SoftwareEngineerBlog/editPost/" + $("span[name=edit-post-key]").text() + "/" + $("span[name=post-id]").text(),
                    data: JSON.stringify(data),
                    contentType: "application/json",
                    success: function (result) {
                        log(result);
                        if (result.success) { // success
                            location.reload();
                        }
                    }
                });
            }

            $("button[name=btnChangePublishStatus]").click(function () {
                callEditPost({
                    whatToDo: "post_updatePublishStatus",
                    post: {
                        isPublished: ($(this).attr('is-published') === "1" ? false : true)
                    }
                });
            });

            $("button[name=btnAddNewImage]").click(function () {
                callEditPost({
                    whatToDo: "image_add",
                });
            });

            $("button[name=btnSaveImage]").click(function () {
                var imgDiv = $(this).closest("div[post-image-id]");
                callEditPost({
                    whatToDo: "image_update",
                    image: {
                        id: imgDiv.attr('post-image-id'),
                        src: $.trim(imgDiv.find('input[name=tbxImageSrc]').val()),
                        label: $.trim(imgDiv.find('input[name=tbxImageLabel]').val()),
                        text: $.trim(imgDiv.find("textarea").val())
                    }
                });
            });

            $("button[name=btnDeleteImage]").click(function () {
                if (!confirm("Del Image ? (File stays, Mapping will be deleted)")) return;
                var imgDiv = $(this).closest("div[post-image-id]");
                callEditPost({
                    whatToDo: "image_delete",
                    image: {
                        id: imgDiv.attr('post-image-id')
                    }
                });
            });

            $("div.images-wrapper").sortable({
                items: "div[post-image-id]",
                handle: "span[name=span-move]",
                update: function () {
                    log("image sort changed");
                    var images = [];
                    $("div.images-wrapper div[post-image-id]").each(function () {
                        images.push({
                            id: $(this).attr('post-image-id')
                        });
                    });
                    callEditPost({
                        whatToDo: "images_sort",
                        images: images
                    });
                }
            });

            $("button[name=btnSaveTitle]").click(function () {
                callEditPost({
                    whatToDo: "post_updateTitle",
                    post: {
                        title: $("input[name=tbxPostTitle]").val().trim()
                    }
                });
            });

            $("button[name=btnSaveDescription]").click(function () {
                callEditPost({
                    whatToDo: "post_updateDescription",
                    post: {
                        description: $("input[name=tbxPostDescription]").val().trim()
                    }
                });
            });

            $("button[name=btnSaveCategoryId]").click(function () {
                callEditPost({
                    whatToDo: "post_updateCategoryId",
                    post: {
                        categoryId: $("select[name=ddlCategoryId]").val().trim()
                    }
                });
            });

            $("button[name=btnAddNewContent]").click(function () {
                callEditPost({
                    whatToDo: "content_add",
                    content: {
                        typeId: $("select[name=ddlContentType]").val()
                    }
                });
            });

            $("button[name=btnSaveContent]").click(function () {
                var contentDiv = $(this).closest("div[content-id]"), contentTypeId = contentDiv.attr('content-type-id'), text = null;
                if (contentTypeId == 1) {
                    text = $.trim(contentDiv.find("textarea").val());
                } else if (contentTypeId == 2) {
                    var images = [];
                    contentDiv.find("div[name=images-wrapper] > div[name=image-wrapper]").each(function () {
                        var imgUrl = $.trim($(this).find("input[name=tbxImageUrl]").val());
                        if (imgUrl) {
                            var image = {url: imgUrl};
                            image.caption = $.trim($(this).find("input[name=tbxImageCaption]").val());
                            images.push(image);
                        }
                    });
                    text = JSON.stringify({images: images});
                } else if (contentTypeId == 3) {
                    text = $.trim(contentDiv.find("textarea").val());
                } else if (contentTypeId == 4) {
                    text = JSON.stringify({
                        headerType: contentDiv.find("select[name=ddlHeaderType]").val(),
                        headerText: $.trim(contentDiv.find("input[name=tbxHeaderText]").val())
                    });
                }
                if (!text) return;
                if (text.length > 3000) {
                    console.error("Error: Content longer than maximum (3000 chars)");
                    return;
                }
                //log(text);return;
                callEditPost({
                    whatToDo: "content_update",
                    content: {
                        id: contentDiv.attr('content-id'),
                        typeId: contentTypeId,
                        text: text
                    }
                });
            });

            $("button[name=btnDeleteContent]").click(function () {
                if (!confirm("Del Content ?")) return;
                var contentDiv = $(this).closest("div[content-id]");
                callEditPost({
                    whatToDo: "content_delete",
                    content: {
                        id: contentDiv.attr('content-id')
                    }
                });
            });

            $("div.contents-wrapper").sortable({
                items: "div[content-id]",
                handle: "span[name=span-move]",
                update: function () {
                    log("content sort changed");
                    var contents = [];
                    $("div.contents-wrapper div[content-id]").each(function () {
                        contents.push({
                            id: $(this).attr('content-id')
                        });
                    });
                    callEditPost({
                        whatToDo: "contents_sort",
                        contents: contents
                    });
                }
            });

            // Content Type:1
            $("div[content-type-id=1],div[content-type-id=3]").find("textarea").on("keyup blur", function () { // textarea remaining calculation
                var remaining = $(this).attr('maxlength') - $(this).val().length;
                $(this).parent().find("span[name=remaining-chars]").text(remaining + " remaining");
            }).trigger("blur");

            // Content Type:2
            $("div[content-type-id=2] button[name=btnAddImageUrlTextbox]").click(function () {
                $('<div name="image-wrapper"><input type="text" name="tbxImageUrl" /><input type="text" name="tbxImageCaption" /><button name="btnDeleteImageDiv">Del</button><span name="content-type-2-span-move" style="cursor: move;">Move</span></div>').appendTo($(this).siblings("div[name=images-wrapper]"));
            });
            $("div[content-type-id=2] div[name=images-wrapper]").on("click", "button[name=btnDeleteImageDiv]", function () {
                $(this).closest("div[name=image-wrapper]").remove();
            });
            $("div[content-type-id=2] div[name=images-wrapper]").sortable({
                items: "div[name=image-wrapper]",
                handle: "span[name=content-type-2-span-move]",
                update: function () {
                    log("image sort changed");
                }
            });

            $("button[name=btnAddTagTextbox]").click(function () {
                $('<div><input type="text" name="tbxTagName" /></div>').appendTo("div.tags-wrapper");
            });

            $("button[name=btnSaveTags]").click(function () {
                var tags = [];
                $("div.tags-wrapper input[name=tbxTagName]").each(function () {
                    var tag = $.trim($(this).val());
                    if (tag && tags.indexOf(tag) == -1) tags.push(tag);
                });
                var tagsJson = tags.length > 0 ? JSON.stringify(tags) : null;
                if (tagsJson && tagsJson.length > 250) {
                    console.error("tagsJson too long (max:250 char)");
                    return;
                }
                log(tagsJson);
                callEditPost({
                    whatToDo: "post_updateTagsJson",
                    post: {
                        tagsJson: tagsJson
                    }
                });
            });

            $("a[name=lnkReplyToComment]").click(function () {
                $(this).closest("[comment-id]").find("div.reply-to-wrapper").toggle();
            });

            $("button[name=btnReplyToComment]").click(function () {
                var commentId = $(this).closest("[comment-id]").attr('comment-id');
                var commentText = $.trim($(this).closest("[comment-id]").find("textarea[name=commentText]").val());
                if (!commentText) return;
                callEditPost({
                    whatToDo: "comment_replyToComment",
                    comment: {
                        repliedCommentId: commentId,
                        commentText: commentText
                    }
                });
            });

            $("a[name=lnkChangePublishStatus]").click(function () {
                var isPublishedToBe = ($(this).attr('publish-status') === "1" ? 0 : 1);
                if (!confirm((isPublishedToBe ? 'Publish' : 'Unpublish') + " Comment ?")) return;
                callEditPost({
                    whatToDo: "comment_changePublishStatus",
                    comment: {
                        id: $(this).closest("[comment-id]").attr('comment-id'),
                        isPublished: isPublishedToBe
                    }
                });
            });

        }

        if ($blogPageType == 'upload-images') {
            // file input change event
            $("input[name=fileInput]").change(function () {
                log("file input change event");
            });

            // image paste event
            $("input[name=tbxToPasteImg]").on("paste", function (e) {
                e.preventDefault();
                log("tbx paste event");
                var items = (event.clipboardData || event.originalEvent.clipboardData).items;
                console.log(JSON.stringify(items)); // will give you the mime types
                for (index in items) {
                    var item = items[index];
                    if (item.kind === 'file') {
                        var blob = item.getAsFile();
                        if (!blob.type || blob.type.indexOf("image/") != 0) return; // support for only image paste
                        //log("blob:", blob);return;
                        if (blob) {
                            pastedImage = blob;
                            $("button[name=btnUploadImages]").trigger("click");
                        }
                    }
                }
            });

            // Yükle button click event
            $("button[name=btnUploadImages]").click(function () {
                log("yükle button click");
                var files = typeof pastedImage === "undefined" ? $("input[name=fileInput]")[0].files : [pastedImage]; // get pasted image (if exists)
                if (files.length == 0) return;

                var formData = new FormData();
                formData.append('whatToDo', "uploadImages");
                for (var i = 0; i < files.length; i++) {
                    formData.append('image-' + i, files[i]);
                }
                formData.append('isPasted', typeof pastedImage === "undefined" ? "0" : "1");

                var xhr = new XMLHttpRequest();
                xhr.upload.onprogress = function (evt) {
                    var percentLoaded = parseInt((evt.loaded / evt.total) * 100);
                    $("button[name=btnUploadImages]").text(percentLoaded != 100 ? 'Yükleniyor... (' + percentLoaded + '%)' : 'İşleniyor...');
                }
                xhr.onreadystatechange = function (evt) {
                    if (xhr.readyState == 4) { // request completed
                        if (xhr.status == 200) { // success
                            var o = JSON.parse(xhr.response); // parsing JSON result
                            log("upload SUCCESS", o);
                            $("button[name=btnUploadImages]").text('Tamamlandı!');
                            if (o.success) location.reload();
                        } else { // failure
                            log("upload FAILURE", xhr, xhr.response);
                            $("button[name=btnUploadImages]").text('!! Yüklemede Hata !!');
                        }
                    }
                }
                xhr.open("POST", "");
                $("button[name=btnUploadImages]").prop('disabled', true).text('Yükleniyor... (0%)');
                xhr.send(formData);
            });

            $("a[name=each-month-titles-toggle]").click(function () {
                $("div[name=each-month-title]").toggle();
            });

            $("div.upload-image-delete").click(function (e) {
                e.stopPropagation();
                var imgName = $(this).closest(".upload-image-wrapper").find("input[name=tbxImgFileName]").val();
                var dataJson = $(this).closest(".upload-image-wrapper").attr('grouped-imgs-data');
                if (!confirm("Del Image: " + imgName + " ?")) return;

                var formData = new FormData();
                formData.append('whatToDo', "deleteImage");
                formData.append('delete_images_json', dataJson);

                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function (evt) {
                    if (xhr.readyState == 4) { // request completed
                        if (xhr.status == 200) { // success
                            var o = JSON.parse(xhr.response); // parsing JSON result
                            log("delete SUCCESS", o);
                            if (o.success) location.reload();
                        } else { // failure
                            log("delete FAILURE", xhr, xhr.response);
                        }
                    }
                }
                xhr.open("POST", "");
                xhr.send(formData);
            });

            $("input[name=tbxImgFileName]").click(function (e) {
                e.stopPropagation();
            });
        }

    }


    /* ---------------------------------------------------------------------- */
    /* ---------------------------- icon menu ------------------------------- */
    /* ---------------------------------------------------------------------- */

    $(".resp-tabs-container h2.resp-accordion").each(function(){
			 
			if($(this).hasClass('resp-tab-active')){
				$(this).append("<i class='glyphicon glyphicon-chevron-up arrow-tabs'></i>");
			}else {
				$(this).append("<i class='glyphicon glyphicon-chevron-down arrow-tabs'></i>");
			}
	  });
	  
	   $(".resp-tabs-container h2.resp-accordion").click(function(){
			if($(this).hasClass('resp-tab-active')){
				$(this).find("i.arrow-tabs").removeClass("glyphicon-chevron-down").addClass("glyphicon-chevron-up");
			}
			
			$(".resp-tabs-container h2.resp-accordion").each(function(){
		 
				if(!$(this).hasClass('resp-tab-active')){
					$(this).find("i.arrow-tabs").removeClass("glyphicon-chevron-up").addClass("glyphicon-chevron-down");
				}
		  });
	  
			
	  });


    /* ---------------------------------------------------------------------- */
    /* -------------------------------- skillbar ---------------------------- */
    /* ---------------------------------------------------------------------- */

    $('.tabs-resume').click(function() {

        $('.skillbar').each(function() {
            $(this).find('.skillbar-bar').width(0);
        });

        $('.skillbar').each(function() {
            $(this).find('.skillbar-bar').animate({
                width: $(this).attr('data-percent')
            }, 2000);
        });

    });

    $('#resume').prev('h2.resp-accordion').click(function() {

        $('.skillbar').each(function() {
            $(this).find('.skillbar-bar').width(0);
        });

        $('.skillbar').each(function() {
            $(this).find('.skillbar-bar').animate({
                width: $(this).attr('data-percent')
            }, 2000);
        });
    });
	
		
	//Change for demo page
    $('input:radio[name=page_builder]').on('change', function() {
		
		$('input:radio[name=page_builder]').each(function () {

			var $this = $(this);
	
			if ($(this).prop('checked')) {
				window.location.replace($this.val());
			}
		});
		
        return false;
    });

    // FRT ADDITIONS - BEGIN
    // to prevent [scroll to top] action on "#" links
    $(document).on("click", "a[href='#']", function (e) { e.preventDefault(); });
    // FRT ADDITIONS - END

});