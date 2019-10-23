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

    $('.dropdown-select').change(function() {
        animation_style = $('.dropdown-select').val();
    });

    // tab change event (PC mode)
    $('ul.resp-tabs-list li[class^=tabs-]').click(function() {

        var tabName = $(this).attr('data-tab-name');

        $('.resp-tabs-container').addClass('animated ' + animation_style);
        $('.resp-tabs-container').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function () {
            $('.resp-tabs-container').removeClass('animated ' + animation_style);
        });

        $(".content_2").mCustomScrollbar("destroy");
        setCustomScrollbars();

        var hashObj = readHashAsObject();
        if (!hashObj.tab || hashObj.tab != tabName) writeObjectToHash({tab: tabName});

        return false;
    });

    // tab change event (Mobile mode)
    $("#verticalTab h2.resp-accordion").click(function () {
        var tabName = $(this).find("span.tite-list-resp").text().trim();

        var hashObj = readHashAsObject();
        if (!hashObj.tab || hashObj.tab != tabName) writeObjectToHash({tab: tabName});
    });

    // hash change event
    var defaultHashObj = {tab: "profile"};
    var possibleTabs = ["profile", "resume", "portfolio", "contact"];
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
            tabToGo = $("ul.resp-tabs-list li[data-tab-name='" + hashObj.tab + "']")/*.not(".resp-tab-active")*/;
        }
        tabToGo.click();

        // tab specific logic: [portfolio]
        if (hashObj.tab == "portfolio") {
            if (hashObj.projectId) loadProjectDetails(hashObj.projectId);
            else portfolioChangeStep(1);
        }
    }).trigger("hashchange");

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
            $success = ' Your message has been sent. Thank you!';

    $contactform.submit(function() {
        console.log("contact form submitted!", "data:", $(this).serialize());

        //return false;
        $.ajax({
            type: "POST",
            url: "contact.html",
            data: $(this).serialize(),
            success: function(msg)
            {
                var msg_error = msg.split(",");
                var output_error = '';

                if (msg_error.indexOf('error-message') != -1) {
                    $("#contact-message").addClass("has-error");
                    $("#contact-message").removeClass("has-success");
                    output_error = 'Please enter your message.';
                } else {
                    $("#contact-message").addClass("has-success");
                    $("#contact-message").removeClass("has-error");
                }

                if (msg_error.indexOf('error-email') != -1) {

                    $("#contact-email").addClass("has-error");
                    $("#contact-email").removeClass("has-success");
                    output_error = 'Please enter valid e-mail.';
                } else {
                    $("#contact-email").addClass("has-success");
                    $("#contact-email").removeClass("has-error");
                }

                if (msg_error.indexOf('error-name') != -1) {
                    $("#contact-name").addClass("has-error");
                    $("#contact-name").removeClass("has-success");
                    output_error = 'Please enter your name.';
                } else {
                    $("#contact-name").addClass("has-success");
                    $("#contact-name").removeClass("has-error");
                }


                if (msg == 'success') {

                    response = '<div class="alert alert-success success-send">' +
                            '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' +
                            '<i class="glyphicon glyphicon-ok" style="margin-right: 5px;"></i> ' + $success
                            + '</div>';


                    $(".reset").trigger('click');
                    $("#contact-name").removeClass("has-success");
                    $("#contact-email").removeClass("has-success");
                    $("#contact-message").removeClass("has-success");

                } else {

                    response = '<div class="alert alert-danger error-send">' +
                            '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' +
                            '<i class="glyphicon glyphicon-remove" style="margin-right: 5px;"></i> ' + output_error
                            + '</div>';

                }
                // Hide any previous response text
                $(".error-send,.success-send").remove();
                // Show response message
                $contactform.prepend(response);
            }
        });
        return false;
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
                // call the hover effect
                onMixEnd: filterList.hoverEffect()
            });

        },
        hoverEffect: function() {

            // Simple parallax effect
            $('#portfoliolist .portfolio').hover(
                    function() {
                        $(this).find('.label').stop().animate({bottom: 0}, 200);
                        $(this).find('img').stop().animate({top: -30}, 500);
                    },
                    function() {
                        $(this).find('.label').stop().animate({bottom: -40}, 200);
                        $(this).find('img').stop().animate({top: 0}, 300);
                    }
            );

        }

    };

    // Run the show!
    filterList.init();

    // each portfolio item click
    $("#portfolio a[rel^='portfolio']").click(function (e) {
        e.preventDefault();

        // add project id to hash
        var hashObj = readHashAsObject();
        hashObj.projectId = $(this).closest(".portfolio").attr('project-id');
        writeObjectToHash(hashObj);
    });

    function loadProjectDetails(projectId){
        var p = JSON.parse($("#portfoliolist .portfolio[project-id='" + projectId + "']").attr('data-project')); //log(p);

        portfolioChangeStep(2);

        // data binding to detail section
        $("#portfolio [entity=project][column]").each(function () {
            $(this).html(p[$(this).attr('column')]);
        });

        // description binding
        $("#portfolio [entity=project][column=description]").empty();
        p.description.forEach(function (desc) {
            $("#portfolio [entity=project][column=description]").append('<p style="margin-bottom:20px;">' + desc + '</p>')
        });

        // project link binding
        $("#portfolio a.portfolio-seeprojectbutton")[p.projectLink ? 'show' : 'hide']().attr('href', p.projectLink || '#');

        // categories binding
        $("#portfolio [entity=project][column=categories]").empty();
        p.categories.forEach(function (cat) {
            var catName = $("#portfolio ul#filters li span[data-filter='" + cat + "']").text();
            $("#portfolio [entity=project][column=categories]").append('<span cat-key="' + cat + '">' + catName + '</span>');
        });

        // scroll to top of project detail
        if (getViewMode() == "mobile") windowScrollTo(564); //windowScrollTo($("a.portfolio-backbutton").offset().top - 14);
    }
    function portfolioChangeStep(step){
        switch (step) {
            case 1:$("#portfolio .container-portfolio-detail").hide().siblings(".container-portfolio").show();break;
            case 2:$("#portfolio .container-portfolio").hide().siblings(".container-portfolio-detail").show();break;
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
            $(".tabs-blog").trigger('click');
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
            $(".tabs-blog").trigger('click');
        }

        return false;

    });

    //pagination All
    $('.content-post a').click(function() {
        var pagina = $(this).attr('href');

        if (pagina == "#blog") {

            $('.content-post').hide();
            $('#blog-page').show();
            $(".tabs-blog").trigger('click');

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
            $(".tabs-blog").trigger('click');
        }

        return false;

    });


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