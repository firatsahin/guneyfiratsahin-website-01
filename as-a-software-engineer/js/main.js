// GLOBAL HELPER FUNCTIONS - BEGIN
var log = console.log;

function getViewMode() {
    return window.matchMedia("(max-width: 800px)").matches ? "mobile" : "pc";
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
function writeObjectToHash(hashObj) {
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
    location.href = hashVal;
}

function getFormData($form) {
    var unindexed_array = $form.serializeArray();
    var indexed_array = {};

    $.map(unindexed_array, function (n, i) {
        indexed_array[n['name']] = n['value'];
    });

    return indexed_array;
}

function getContentScroll() {
    return getViewMode() != "mobile" ? Math.abs(parseInt($(".content_2:visible .mCSB_container").css("top"))) : null;
}
function setContentScroll(scrollTop) {
    if (getViewMode() != "mobile") {
        $(".content_2:visible .mCSB_container").css("top", -scrollTop);
        $(".content_2:visible").mCustomScrollbar("update");
    }
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
        if (getViewMode() != "mobile") performTabChangeAnimation();
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
        $('ul.resp-tabs-list li[class^=tabs-]').click(function(e) {

            var tabName = $(this).attr('data-tab-name');

            if (tabName == "blog") {
                location.href = siteData.softwareEngineerRootUri + siteData.blogSiteSuffix + "index.html";
                return;
            }

            performTabChangeAnimation();

            $(".content_2").mCustomScrollbar("destroy");
            setCustomScrollbars();

            var hashObj = readHashAsObject();
            if (!hashObj.tab || hashObj.tab != tabName) writeObjectToHash({tab: tabName});

            return false;
        });

        // tab change event (Mobile mode)
        $("#verticalTab h2.resp-accordion").click(function () {
            var tabName = $(this).find("span.tite-list-resp").text().trim();

            if (tabName == "blog") {
                location.href = siteData.softwareEngineerRootUri + siteData.blogSiteSuffix + "index.html";
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
                writeObjectToHash(defaultHashObj);
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
            if (getViewMode() == "mobile") {
                tabToGo = $("#verticalTab h2.resp-accordion").not(".resp-tab-active").find("span.tite-list-resp").filter(function () {
                    return $(this).text().trim() === hashObj.tab;
                });
            } else {
                tabToGo = $("ul.resp-tabs-list li[data-tab-name='" + hashObj.tab + "']").not(".resp-tab-active");
            }
            tabToGo.click();

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

        if (getViewMode()=="mobile") {
            $(".content_2").mCustomScrollbar("destroy");
            $(".resp-vtabs .resp-tabs-container").css("height", "100%");
            $(".content_2").css("height", "100%");
        } else {

            $(".resp-vtabs .resp-tabs-container").css("height", "580px");
            $(".content_2").css("height", "580px");
            $(".content_2").mCustomScrollbar("destroy");
            setCustomScrollbars();

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

        $contactform.find("button[name=submit]").prop('disabled', true).text('SENDING MESSAGE...');
        $.ajax({
            type: "POST",
            url: "contact.html",
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
            $contactform.find("button[name=submit]").prop('disabled', false).text('SEND MESSAGE');
        });
    });

    // clear button click
    $contactform.find("input[type=reset]").click(function(e) {
        e.preventDefault();
        $contactform[0].reset();
        $contactform.find("#contactform-message").empty();
        $contactform.find("p.form-group[column]").removeClass("has-error");
        $contactform.find("p.form-group[column=serviceTypes] span.service-type").removeClass('is-active');
        log($contactform.find("p.form-group[column=employType] .form-control").val());
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

        // add project id to hash
        var hashObj = readHashAsObject();
        hashObj.projectId = $(this).attr('project-id');
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
        if (getViewMode() == "mobile") windowScrollTo(564); //windowScrollTo($("a.portfolio-backbutton").offset().top - 14);
    }
    var contentScrollBackup = null;
    function portfolioChangeStep(step) {
        switch (step) {
            case 1:
                $("#portfolio .container-portfolio-detail").hide().siblings(".container-portfolio").show();
                if (contentScrollBackup) {
                    log("restored contentScroll:", contentScrollBackup);
                    setContentScroll(contentScrollBackup)
                    contentScrollBackup = null;
                }
                break;
            case 2:
                contentScrollBackup = getContentScroll();
                log("backed up contentScroll:", contentScrollBackup);
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

    // More blog
    $('a.read_m').click(function() {
        var pagina = $(this).attr('href');
        var postdetail = pagina + '-page';

        if (pagina.indexOf("#post-") != -1) {

            $('#blog-page').hide();

            $(postdetail).show();
            //$(".tabs-blog").trigger('click');
        }

        return false;

    });

    // More blog
    $('a.read_more').click(function() {
        var pagina = $(this).attr('href');
        var postdetail = pagina + '-page';

        if (pagina.indexOf("#post-") != -1) {

            $('#blog-page').hide();

            $(postdetail).show();
            //$(".tabs-blog").trigger('click');
        }

        return false;

    });

    //pagination All
    $('.content-post a').click(function() {
        var pagina = $(this).attr('href');

        if (pagina == "#blog") {

            $('.content-post').hide();
            $('#blog-page').show();
            //$(".tabs-blog").trigger('click');

        }

        return false;

    });

    //pagination blog
    $('.content-post #pagination').click(function() {


        var pagina = $(this).attr('href');
        var postdetail = pagina + '-page';

        if (pagina.indexOf("#post-") != -1) {

            $('#blog-page').hide();
            $('.content-post').hide();

            $(postdetail).show();
            //$(".tabs-blog").trigger('click');
        }

        return false;

    });

    // blog zone actions
    if (siteData.isBlog) {

        // tab change event (PC mode)
        $('ul.resp-tabs-list li[class^=tabs-]').click(function (e) {

            var tabName = $(this).attr('data-tab-name');

            if (tabName == "home") {
                location.href = siteData.softwareEngineerRootUri + "index.html";
                return;
            }

            return false;
        });

        // tab change event (Mobile mode)
        $("#verticalTab h2.resp-accordion").click(function () {
            var tabName = $(this).find("span.tite-list-resp").text().trim();

            if (tabName == "home") {
                location.href = siteData.softwareEngineerRootUri + "index.html";
                return;
            }
        });
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