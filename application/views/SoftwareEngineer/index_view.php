<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>

        <title><?= isset($pageTitle) ? $pageTitle : '' ?></title>

        <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>

        <meta name="description" content="<?= $data->personalInfo->name->local . ' ' . $data->personalInfo->surname->local ?> <?= $data->personalInfo->title ?> Personal Web Page" />

        <!-- CSS | bootstrap -->
        <!-- Credits: http://getbootstrap.com/ -->
        <link rel="stylesheet" type="text/css" href="<?= SOFTWARE_ENGINEER_ROOT_URI ?>css/bootstrap.min.css" />

        <!-- CSS | font-awesome -->
        <!-- Credits: http://fortawesome.github.io/Font-Awesome/icons/ -->
        <link rel="stylesheet" type="text/css" href="<?= SOFTWARE_ENGINEER_ROOT_URI ?>css/font-awesome.min.css" />

        <!-- CSS | animate -->
        <!-- Credits: http://daneden.github.io/animate.css/ -->
        <link rel="stylesheet" type="text/css" href="<?= SOFTWARE_ENGINEER_ROOT_URI ?>css/animate.min.css" />

        <!-- CSS | Normalize -->
        <!-- Credits: http://manos.malihu.gr/jquery-custom-content-scroller -->
        <link rel="stylesheet" type="text/css" href="<?= SOFTWARE_ENGINEER_ROOT_URI ?>css/jquery.mCustomScrollbar.css" />
       	
        <!-- CSS | Colors -->
        <link rel="stylesheet" type="text/css" href="<?= utility_helper::includeVersionedReference(SOFTWARE_ENGINEER_ROOT_URI . 'css/colors/DarkBlue.css') ?>" id="colors-style" /><!-- [DarkBlue,lightseagreen] -->
        
        <!-- CSS | Style -->
        <link rel="stylesheet" type="text/css" href="<?= utility_helper::includeVersionedReference(SOFTWARE_ENGINEER_ROOT_URI . 'css/main.css') ?>" />

        <!-- CSS | prettyPhoto -->
        <!-- Credits: http://www.no-margin-for-errors.com/ -->
        <link rel="stylesheet" type="text/css" href="<?= SOFTWARE_ENGINEER_ROOT_URI ?>css/prettyPhoto.css"/>

		<!-- CSS | Google Fonts -->
        <link href='https://fonts.googleapis.com/css?family=Lato:300,400' rel='stylesheet' type='text/css'>

        <!-- favicon -->
        <link rel="shortcut icon" type="image/png" href="/img/frt-favicon.png"/>

        <!--[if IE 7]>
                <link rel="stylesheet" type="text/css" href="<?= SOFTWARE_ENGINEER_ROOT_URI ?>css/icons/font-awesome-ie7.min.css"/>
        <![endif]-->

        <style>
            @media only screen and (max-width : 991px){
                .resp-vtabs .resp-tabs-container {
                    margin-left: 13px;
                }
            }
			
			@media only screen and (min-width : 801px) and (max-width : 991px){
                .resp-vtabs .resp-tabs-container {
                    margin-left: 13px;
					width:89%;
                }
                .wrapper {
                    top: unset;
                    margin: 10px auto;
                }
            }		

        </style>

    </head>

    <body>

        <!--[if lt IE 7]>
                <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <!-- Laoding page -->
        <div id="preloader"><div id="spinner"></div></div>

        <!-- .wrapper --> 
        <div class="wrapper">

            <!--- .Content --> 
            <section class="tab-content">
                <div class="container">

                    <div class="row">

                        <div class="col-md-12">

                            <div class="row">   

                                <div class="col-md-3 widget-profil">
                                    <div class="row">

    <!-- Profile Image -->
    <div class="col-lg-12 col-md-12 col-sm-3 col-xs-12 ">
        
        <!-- style for simple image profile -->		
   		<div class="circle-img" id="pic_prof_2" style="display:block"></div>
    
    </div>
    <!-- End Profile Image -->
  
    <div class="col-lg-12 col-md-12 col-sm-9 col-xs-12">
    
    
        <!-- Profile info -->
        <div id="profile_info">
            <h1 id="name" class="transition-02"><?= $data->personalInfo->name->global . ' ' . $data->personalInfo->surname->global ?></h1>
            <h4 class="line"><?= $data->personalInfo->title ?></h4>
            <h6 style="cursor: pointer;" title="Click to see where <?= $data->personalInfo->city ?> is" onclick="window.open('https://www.google.com/maps/place/<?= $data->personalInfo->city ?>','_blank')"><span class="fa fa-map-marker"></span>&nbsp; <?= $data->personalInfo->city ?>, <?= $data->personalInfo->country ?></h6>
        </div>
        <!-- End Profile info -->  
    	
        
        <!-- Profile Description -->
        <div id="profile_desc">
            <?php foreach ($data->personalInfo->profileDesc as $p) { ?>
                <p>
                    <?= $p ?>
                </p>
            <?php } ?>
        </div>
        <!-- End Profile Description -->  
    	
        
        <!-- Name -->
         <div id="profile_social">
            <h6>My Social Profiles</h6>
            <?php /*<a href="#"><i class="fa fa-facebook"></i></a>
            <a href="#"><i class="fa fa-twitter"></i></a>
            <a href="#"><i class="fa fa-linkedin"></i></a>
            <a href="#"><i class="fa fa-dribbble"></i></a>
            <a href="#"><i class="fa fa-foursquare"></i></a>*/ ?>
             <?php foreach ($data->personalInfo->socialProfiles as $p) { ?>
                 <a href="<?= $p->link ? $p->link : '#' ?>" target="_blank" title="Visit my <?= $p->nameFancy ?> profile"><i class="fa fa-<?= $p->faIcon ?>"></i></a>
             <?php } ?>
            <div class="clear"></div>
        </div>
        <!-- End Name -->  
      
    
    
    </div>
  
</div>                                </div>

                                <div class="col-md-9 site_content" style="padding-left: 0;padding-right: 0;">

                                    <!-- verticalTab menu -->
                                    <div id="verticalTab">

                                        <ul class="resp-tabs-list">

                                            <?php if (!$isBlog) { ?>

                                                <li class="tabs-profile hi-icon-wrap hi-icon-effect-5 hi-icon-effect-5a profile" data-tab-name="profile" title="Profile">
                                                    <span class="tite-list">profile</span>
                                                    <i class="fa fa-user icon_menu icon_menu_active"></i>
                                                </li>

                                                <li class="tabs-resume hi-icon-wrap hi-icon-effect-5 hi-icon-effect-5a" data-tab-name="resume" title="Resume">
                                                    <span class="tite-list">resume</span>
                                                    <i class="fa fa-tasks icon_menu"></i>
                                                </li>

                                                <li class="tabs-portfolio hi-icon-wrap hi-icon-effect-5 hi-icon-effect-5a" data-tab-name="portfolio" title="Portfolio">
                                                    <span class="tite-list">portfolio</span>
                                                    <i class="fa fa-briefcase icon_menu"></i>
                                                </li>

                                                <li class="tabs-contact hi-icon-wrap hi-icon-effect-5 hi-icon-effect-5a" data-tab-name="contact" title="Contact">
                                                    <span class="tite-list">contact</span>
                                                    <i class="fa fa-envelope icon_menu"></i>
                                                </li>

                                                <li class="tabs-blog hi-icon-wrap hi-icon-effect-5 hi-icon-effect-5a put-downside" data-tab-name="blog" title="Blog Site">
                                                    <span class="tite-list">blog</span>
                                                    <i class="fa fa-bullhorn icon_menu"></i>
                                                </li>

                                            <?php } else { ?>

                                                <li class="tabs-blog hi-icon-wrap hi-icon-effect-5 hi-icon-effect-5a" data-tab-name="blog" title="Blog">
                                                    <span class="tite-list">blog</span>
                                                    <i class="fa fa-bullhorn icon_menu icon_menu_active"></i>
                                                </li>

                                                <li class="tabs-blog hi-icon-wrap hi-icon-effect-5 hi-icon-effect-5a put-downside" data-tab-name="home" title="Back to Home Site">
                                                    <span class="tite-list">home</span>
                                                    <i class="fa fa-home icon_menu"></i>
                                                </li>

                                            <?php } ?>

                                            <a href="#" id="print" style="display: none;"><i class="fa fa-print icon_print"></i> </a>
                                            <a href="#" id="downlowd" style="display: none;"><i class="fa fa-download icon_print"></i> </a>
                                        </ul>
                                        <!-- /resp-tabs-list -->



                                        <!-- resp-tabs-container --> 
                                        <div class="resp-tabs-container">

                                            <?php if (!$isBlog) { ?>

                                                <!-- profile -->
                                                <div id="profile" class="content_2">
                                                    <!-- .title -->
                                                    <h1 class="h-bloc">Profile - About Me</h1>

                                                    <div class="row top-p">
                                                        <div class="col-md-6 profile-l">

                                                            <!--About me-->
                                                            <div class="title_content">
                                                                <div class="text_content"><?= $data->personalInfo->name->global . ' ' . $data->personalInfo->surname->global ?></div>
                                                                <div class="clear"></div>
                                                            </div>

                                                            <ul class="about">

                                                                <li>
                                                                    <i class="glyphicon glyphicon-user"></i>
                                                                    <label>Name</label>
                                                                    <span class="value" title="Click to search me on Google"><a href="https://www.google.com/search?q=%22<?= $data->personalInfo->name->local . ' ' . $data->personalInfo->surname->local ?>%22" target="_blank"><?= $data->personalInfo->name->local . ' ' . $data->personalInfo->surname->local ?></a>&nbsp; <span style="font-size: 10px;">(original)</span></span>
                                                                    <div class="clear"></div>
                                                                </li>

                                                                <li>
                                                                    <i class="glyphicon glyphicon-calendar"></i>
                                                                    <label>Date of birth</label>
                                                                    <span class="value" title="Click to check what happened on <?= $data->personalInfo->birthDate->formatted ?>"><a href="https://www.google.com/search?q=What happened on <?= $data->personalInfo->birthDate->formatted ?>" target="_blank"><?= $data->personalInfo->birthDate->formatted ?></a></span>
                                                                    <div class="clear"></div>
                                                                </li>

                                                                <li>
                                                                    <i class="glyphicon glyphicon-map-marker"></i>
                                                                    <label>Location</label>
                                                                    <span class="value" title="Click to see where <?= $data->personalInfo->city ?> is"><a href="https://www.google.com/maps/place/<?= $data->personalInfo->city ?>" target="_blank"><?= $data->personalInfo->city ?>, <?= $data->personalInfo->country ?></a></span>
                                                                    <div class="clear"></div>
                                                                </li>

                                                                <li>
                                                                    <i class="glyphicon glyphicon-envelope"></i>
                                                                    <label>Email</label>
                                                                    <span class="value" title="Click to e-mail me about anything">
                    <a href="mailto:<?= $data->contactInfo->email ?>?subject=<?= 'E-mail from '.$data->siteInfo->domainName->short.' visitor' ?>&body=<?= 'Hey '.$data->personalInfo->preferredName->global.'! I just visited your web site and I would like to talk to you about...' ?>"><?= $data->contactInfo->email ?></a>
                </span>
                                                                    <div class="clear"></div>
                                                                </li>

                                                                <li>
                                                                    <i class="glyphicon glyphicon-comment"></i>
                                                                    <label>Skype</label>
                                                                    <span class="value" title="Click to add me as a contact on Skype"><a href="skype:<?= $data->contactInfo->skype ?>?userinfo"><?= $data->contactInfo->skype ?></a></span>
                                                                    <div class="clear"></div>
                                                                </li>

                                                                <li>
                                                                    <i class="glyphicon glyphicon-globe"></i>
                                                                    <label>GitHub</label>
                                                                    <span class="value" title="Click to take a look at my GitHub account"><a href="https://github.com/<?= $data->contactInfo->github ?>" target="_blank">github.com/<?= $data->contactInfo->github ?></a></span>
                                                                    <div class="clear"></div>
                                                                </li>

                                                            </ul>

                                                            <?php foreach ($data->personalInfo->aboutMeText->left as $a) { ?>
                                                                <p style="margin-bottom:20px">
                                                                    <i class="fa fa-quote-left"></i>&nbsp;&nbsp;<?= $a ?>
                                                                </p>
                                                            <?php } ?>

                                                        </div>
                                                        <!-- End left-wrap -->

                                                        <div class="col-md-6 profile-r">

                                                            <div class="cycle-slideshow">
                                                                <img src="<?= SOFTWARE_ENGINEER_ROOT_URI ?>images/img-profile/about_1.jpg" alt="" />
                                                                <img src="<?= SOFTWARE_ENGINEER_ROOT_URI ?>images/img-profile/about_2.jpg" alt="" />
                                                                <img src="<?= SOFTWARE_ENGINEER_ROOT_URI ?>images/img-profile/about_3.jpg" alt="" />
                                                            </div>

                                                        </div>

                                                    </div>

                                                    <div>
                                                        <?php foreach ($data->personalInfo->aboutMeText->center as $a) { ?>
                                                            <p style="margin-bottom:20px">
                                                                <i class="fa fa-quote-left"></i>&nbsp;&nbsp;<?= $a ?>
                                                            </p>
                                                        <?php } ?>
                                                    </div>

                                                    <div class="title_content">
                                                        <div class="text_content">What kind of developer / engineer am I..?</div>
                                                        <div class="clear"></div>
                                                    </div>

                                                    <div>
                                                        <?php foreach ($data->personalInfo->aboutMeText->wkodeiam as $a) { ?>
                                                            <p style="margin-bottom:20px">
                                                                <i class="fa fa-quote-left"></i>&nbsp;&nbsp;<?= $a ?>
                                                            </p>
                                                        <?php } ?>

                                                        <a class="download" href="#!tab=contact">
                                                            <span data-hover="Hire me / Get services from me"><i class="glyphicon glyphicon-user"></i> &nbsp;&nbsp;Hire me / Get services from me</span>
                                                        </a>
                                                    </div>

                                                    <div class="clear"></div>


                                                    <div class="row" id="services" style="display: none;">
                                                        <div class="col-md-12">
                                                            <div class="title_content">
                                                                <div class="text_content">My Services 1</div>
                                                                <div class="clear"></div>
                                                            </div>


                                                            <div class="col-md-4 pack-service">
                                                                <div class="service">
                                                                    <div class="service-icon"><i class="fa fa-tag"></i></div>
                                                                    <div class="service-detail">
                                                                        <h6>Making Money</h6>
                                                                        <p>Fusce quis interdum ipsum.Suspendi suscipit vehicula sapienid mattis. Lorem ipsum amet consectetur.</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4 pack-service">
                                                                <div class="service">
                                                                    <div class="service-icon"><i class="fa fa-cogs"></i></div>
                                                                    <div class="service-detail">
                                                                        <h6>Easy to Customize</h6>
                                                                        <p>Fusce quis interdum ipsum.Suspendi suscipit vehicula sapienid mattis. Lorem ipsum amet consectetur.</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4 pack-service">
                                                                <div class="service">
                                                                    <div class="service-icon"><i class="fa fa-arrows-alt"></i></div>
                                                                    <div class="service-detail">
                                                                        <h6>Moving Let Us Help</h6>
                                                                        <p>Fusce quis interdum ipsum.Suspendi suscipit vehicula sapienid mattis. Lorem ipsum amet consectetur.</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div><!-- End Services -->


                                                    <div class="clear"></div>
                                                    <div class="border-list" style="display: none;"></div>

                                                    <div class="row" style="display: none;">
                                                        <div class="col-md-12">
                                                            <div class="bottom-p">
                                                                <div class="title_content">
                                                                    <div class="text_content">My Services 2</div>
                                                                    <div class="clear"></div>
                                                                </div>

                                                                <div class="panel-group" id="accordion">
                                                                    <div class="panel panel-default">
                                                                        <div class="panel-heading">
                                                                            <h4 class="panel-title">
                                                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" class="collapse_tabs">
                                                                                    Making Money
                                                                                    <i class="glyphicon glyphicon-chevron-up" style="float: right;font-size: 13px;"></i>
                                                                                </a>
                                                                            </h4>
                                                                        </div>
                                                                        <div id="collapseOne" class="panel-collapse collapse in">
                                                                            <div class="panel-body">
                                                                                <i class="fa fa-quote-left"></i>  Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="panel panel-default">
                                                                        <div class="panel-heading">
                                                                            <h4 class="panel-title">
                                                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" class="collapse_tabs">
                                                                                    Easy to Customize
                                                                                    <i class="glyphicon glyphicon-chevron-down" style="float: right;font-size: 13px;"></i>
                                                                                </a>
                                                                            </h4>
                                                                        </div>
                                                                        <div id="collapseTwo" class="panel-collapse collapse">
                                                                            <div class="panel-body">
                                                                                <i class="fa fa-quote-left"></i>  Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="panel panel-default">
                                                                        <div class="panel-heading">
                                                                            <h4 class="panel-title">
                                                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree" class="collapse_tabs">
                                                                                    Moving Let Us Help
                                                                                    <i class="glyphicon glyphicon-chevron-down" style="float: right;font-size: 13px;"></i>
                                                                                </a>
                                                                            </h4>
                                                                        </div>
                                                                        <div id="collapseThree" class="panel-collapse collapse">
                                                                            <div class="panel-body">
                                                                                <i class="fa fa-quote-left"></i>  Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>


                                                    </div>
                                                    <div class="clear"></div>
                                                </div>
                                                <!-- End .profile -->

                                                <!-- .resume -->
                                                <div id="resume" class="content_2">
                                                    <!-- .title -->
                                                    <h1 class="h-bloc">Resume - Personal Info</h1>

                                                    <div class="row">

                                                        <!-- .resume-left -->
                                                        <div class="col-md-12 resume-left">
                                                            <!-- .title_content -->
                                                            <div class="title_content">
                                                                <div class="text_content">Experience</div>
                                                                <div class="clear"></div>
                                                            </div>
                                                            <!-- /.title_content -->

                                                            <!-- .attributes -->
                                                            <ul class="attributes">

                                                                <?php foreach ($data->resume->experience as $e) { ?>
                                                                    <li>
                                                                        <h5><span class="experience-title"><?= $e->title ?></span><span class="duration"><i class="fa fa-calendar color"></i> <?= $e->startDate ?> - <?= $e->endDate ?></span></h5>
                                                                        <h6><span class="fa fa-briefcase"></span>&nbsp;&nbsp; <?= $e->companyName ?></h6>
                                                                        <h6><span><i class="fa fa-map-marker color"></i>&nbsp;&nbsp; <?= $e->companyLocation ?></span></h6>
                                                                        <?php foreach ($e->description as $d) { ?>
                                                                            <p style="margin-bottom: 10px;"><?= $d ?></p>
                                                                        <?php } ?>
                                                                    </li>
                                                                <?php } ?>

                                                            </ul>
                                                            <!-- /.attributes -->
                                                            <br>

                                                            <!-- .title_content -->
                                                            <div class="title_content">
                                                                <div class="text_content">Education</div>
                                                                <div class="clear"></div>
                                                            </div>
                                                            <!-- /.title_content -->

                                                            <!-- .attributes -->
                                                            <ul class="attributes">

                                                                <?php foreach ($data->resume->education as $e) { ?>
                                                                    <li>
                                                                        <h5><span class="education-title"><?= $e->degreeName ?><?= isset($e->majorName) && $e->majorName ? ', ' . $e->majorName : '' ?></span> <span class="duration"><i class="fa fa-calendar color"></i> <?= $e->startDate ?> - <?= $e->endDate ?></span></h5>
                                                                        <h6><span class="fa fa-book"></span>&nbsp;&nbsp; <?= $e->schoolName ?></h6>
                                                                        <?php foreach ($e->description as $d) { ?>
                                                                            <p style="margin-bottom: 10px;"><?= $d ?></p>
                                                                        <?php } ?>
                                                                    </li>
                                                                <?php } ?>

                                                            </ul>
                                                            <!-- /.attributes -->
                                                            <br>


                                                            <?php /*<!-- .title_content -->
        <div class="title_content">
            <div class="text_content">Awards</div>
            <div class="clear"></div>
        </div>
        <!-- /.title_content -->

        <!-- .attributes -->
        <ul class="attributes">
            <li class="first">
                <h5>Graphic &amp; Art Direction <span class="duration"><i class="fa fa-calendar color"></i> 2013 - 2014</span></h5>
                <h6><span class="fa fa-trophy"></span> Name of Institute</h6>
                <p>Emi Phasellus congue auctor risuspon, eget males. Pellentes que un imperdiet, odio quis orn sollicitud. Sed vitae lectus elementum mauris.</p>
            </li>
            <li>
                <h5>Design &amp; Art Direction <span class="duration"><i class="fa fa-calendar color"></i> 2012 - 2013</span></h5>
                <h6><span class="fa fa-trophy"></span> Name of Institute</h6>
                <p>Emi Phasellus congue auctor risuspon, eget males. Pellentes que un imperdiet, odio quis orn sollicitud. Sed vitae lectus elementum mauris.</p>
            </li>

        </ul>
        <!-- /.attributes -->
        <br>*/ ?>

                                                        </div>
                                                        <!-- /.resume-left -->

                                                        <!-- .resume-right -->
                                                        <div class="col-md-12">

                                                            <?php foreach ($data->resume->skillsets as $ss) { ?>
                                                                <!-- .title_content -->
                                                                <div class="title_content" style="float: none;">
                                                                    <div class="text_content"><?= $ss->skillsetName ?> skills</div>
                                                                    <div class="clear"></div>
                                                                </div>
                                                                <!-- /.title_content -->

                                                                <div class="skills">
                                                                    <?php foreach ($ss->skills as $ss) { ?>
                                                                        <!-- .skillbar -->
                                                                        <div class="skillbar clearfix" data-percent="<?= $ss->percent ?>%">
                                                                            <div class="skillbar-title"><span><?= $ss->skillName ?></span></div>
                                                                            <div class="skillbar-bar"></div>
                                                                            <div class="skill-bar-percent"><?= $ss->percent ?>%</div>
                                                                        </div>
                                                                        <!-- /.skillbar -->
                                                                    <?php } ?>
                                                                </div>
                                                            <?php } ?>

                                                            <!-- .title_content -->
                                                            <div class="title_content" style="float: none;">
                                                                <div class="text_content">My Resume</div>
                                                                <div class="clear"></div>
                                                            </div>
                                                            <!-- /.title_content -->

                                                            <!-- .download_resume -->
                                                            <a class="download" style="margin:0;float: left;" href="#">
                                                                <span data-hover="Download My Resume"><i class="glyphicon glyphicon-download-alt"></i> Download My Resume</span>
                                                            </a>
                                                            <!-- /.download_resume -->

                                                        </div>
                                                        <!-- /.resume-right -->

                                                    </div>

                                                    <div style="clear: both"></div>


                                                    <?php /*<!-- client reference -->
<div class="row">
    <div class="col-md-12">

<div class="reference clearfix">

         <!-- .title_content -->
        <div class="title_content" style="margin-bottom:5px">
            <div class="text_content">Client reference</div>
            <div class="clear"></div>
        </div>
        <!-- /.title_content -->


        <ul>
            <li class="clearfix">
                <img src="https://placehold.it/100x100" class="img_reference" width="100" height="100" alt="">
                <p>“Many desktop publishing packages and web page editors now use Lorem Ipsum as their default will model text, and a search for 'lorem ipsum' hope is uncover many web sites still”</p>
                <span>John Doe, UX Designer</span>
            </li>
            <li class="clearfix">
                <img src="https://placehold.it/100x100" class="img_reference" width="100" height="100" alt="">
                <p>“very nice colleague she always helped me out if i didnt know something editors now use Lorem Ipsum as their default”</p>
                <span>Leia Calvi, UX Designer</span>
            </li>
            <li class="clearfix">
                <img src="https://placehold.it/100x100" class="img_reference" width="100" height="100" alt="">
                <p>“old colleague and now close friend, she is really sweet and helpfull packages and web page editors now use Lorem Ipsum as their default will model text”</p>
                <span>Maria Callas, UX Designer</span>
            </li>
        </ul>
</div>
 </div>




     <div style="clear: both"></div>
</div>*/ ?>

                                                </div>
                                                <!-- End .resume -->

                                                <!-- .portfolio -->
                                                <div id="portfolio" class="content_2">

                                                    <!-- .title -->
                                                    <h1 class="h-bloc">Portfolio - My Works</h1>

                                                    <!-- .container-portfolio -->
                                                    <div class="container-portfolio">

                                                        <!-- #filters -->
                                                        <ul id="filters" class="clearfix">
                                                            <li><span class="filter active" data-filter="all">All</span></li>
                                                            <?php foreach ($data->portfolio->filters as $f) { ?>
                                                                <li><span class="filter" data-filter="<?= $f->key ?>"><?= $f->value ?></span></li>
                                                            <?php } ?>
                                                        </ul>
                                                        <!-- /#filters -->

                                                        <!-- #portfoliolist -->
                                                        <div id="portfoliolist">

                                                            <?php foreach ($data->portfolio->projects as $p) { ?>
                                                                <!-- .portfolio -->
                                                                <div class="portfolio <?= implode(" ", $p->categories) ?>" data-cat="<?= implode(" ", $p->categories) ?>" project-id="<?= $p->id ?>" data-project="<?= htmlspecialchars(json_encode($p), ENT_QUOTES, 'UTF-8') ?>">
                                                                    <!-- .portfolio-wrapper -->
                                                                    <div class="portfolio-wrapper">
                                                                        <a href="<?= $p->projectLink ? $p->projectLink : "#" ?>" rel="portfolio" title="<?= $p->name ?>">
                                                                            <img src="<?= isset($p->images) && is_array($p->images) && count($p->images) > 0 && isset($p->images[0]->thumbImg) && $p->images[0]->thumbImg ? SOFTWARE_ENGINEER_ROOT_URI . $p->images[0]->thumbImg : '/img/no-img.jpg' ?>" alt="alt text" />
                                                                            <div class="label">
                                                                                <div class="label-text">
                                                                                    <a class="text-title"><?= $p->name ?></a>
                                                                                    <span class="text-category"><?= $p->startDate ?> – <?= $p->endDate ?></span>
                                                                                </div>
                                                                                <div class="label-bg"></div>
                                                                            </div>
                                                                        </a>
                                                                    </div>
                                                                    <!-- /.portfolio-wrapper -->
                                                                </div>
                                                                <!-- /.portfolio -->
                                                            <?php } ?>

                                                            <div class="clear"></div>

                                                        </div>
                                                        <!-- #portfoliolist -->
                                                    </div>
                                                    <!-- /.container-portfolio -->

                                                    <!-- .container-portfolio-detail -->
                                                    <div class="container-portfolio-detail" style="display: none;">
                                                        <div>
                                                            <a href="#" class="portfolio-backbutton">< Back to List</a>
                                                            <span name="project-share">
                                                            <b>Project Share: </b>
                                                            <span project-share-val="team">Team Project<br /><span style="color: #AAA; font-size: 11px;">(developed with other team members)</span></span>
                                                            <span project-share-val="individual">Individual Project<br /><span style="color: #AAA; font-size: 11px;">(developed by myself)</span></span>
                                                        </span>
                                                        </div>
                                                        <div class="title_content">
                                                            <div class="text_content" entity="project" column="name"></div>
                                                            <span class="duration"><i class="fa fa-calendar color"></i>&nbsp;&nbsp; <span entity="project" column="startDate"></span> - <span entity="project" column="endDate"></span></span>
                                                            <div class="clear"></div>
                                                        </div>
                                                        <div entity="project" column="description"></div>
                                                        <a href="#" target="_blank" class="portfolio-seeprojectbutton">See project &nbsp;<i class="fa fa-external-link color"></i></a>
                                                        <div name="images-wrapper">
                                                            <div class="title_content">
                                                                <div class="text_content" style="text-transform: unset;">Images of this project</div>
                                                                <div class="clear"></div>
                                                            </div>
                                                            <div entity="project" column="images"></div>
                                                        </div>
                                                        <div name="related-to-wrapper">
                                                            <div class="title_content">
                                                                <div class="text_content" style="text-transform: unset;">Related to this <span name="related-to-kind"></span>:</div>
                                                                <div class="clear"></div>
                                                            </div>
                                                            <div style="position: relative; top: -13px;"><span name="related-to-text"></span></div>
                                                        </div>
                                                        <div class="title_content">
                                                            <div class="text_content" style="text-transform: unset;">My roles / tasks in this project</div>
                                                            <div class="clear"></div>
                                                        </div>
                                                        <div entity="project" column="categories"></div>
                                                    </div>
                                                    <!-- /.container-portfolio-detail -->

                                                </div>
                                                <!-- End .portfolio -->

                                                <!-- .contact -->
                                                <div id="contact" class="content_2">

                                                    <h1 class="h-bloc">Contact - Contact Me</h1>


                                                    <div class="row">

                                                        <div class="col-lg-12" style="display: none;">
                                                            <div id="map"></div>
                                                        </div>

                                                        <div class="col-lg-12">
                                                            <div class="row" id="contact-user">
                                                                <div class="col-md-5">
                                                                    <div class="contact-info">
                                                                        <!--<h3 class="main-heading"><span>Contact info</span></h3>-->

                                                                        <div class="title_content" style="float: none;">
                                                                            <div class="text_content">Contact info</div>
                                                                            <div class="clear"></div>
                                                                        </div>

                                                                        <ul>
                                                                            <li><span class="span-info" style="margin-bottom: 4px; display: inline-block;" title="Click to see where <?= $data->personalInfo->city ?> is"><i class="glyphicon glyphicon-map-marker"></i>&nbsp; Location:&nbsp;
                                                                    <a href="https://www.google.com/maps/place/<?= $data->personalInfo->city ?>" target="_blank"><?= $data->personalInfo->city ?>, <?= $data->personalInfo->country ?></a>
                                                                    <br /><br />
                                                                </span></li>
                                                                            <li><span class="span-info" style="margin-bottom: 4px; display: inline-block;" title="Click to e-mail me about anything"><i class="glyphicon glyphicon-envelope"></i>&nbsp; Email:&nbsp;
                                                                    <a href="mailto:<?= $data->contactInfo->email ?>?subject=<?= 'E-mail from '.$data->siteInfo->domainName->short.' visitor' ?>&body=<?= 'Hey '.$data->personalInfo->preferredName->global.'! I just visited your web site and I would like to talk to you about...' ?>"><?= $data->contactInfo->email ?></a>
                                                                </span></li>
                                                                            <li><span class="span-info" style="margin-bottom: 4px; display: inline-block;" title="Click to add me as a contact on Skype"><i class="glyphicon glyphicon-comment"></i>&nbsp; Skype:&nbsp;
                                                                    <a href="skype:<?= $data->contactInfo->skype ?>?userinfo"><?= $data->contactInfo->skype ?></a>
                                                                </span></li>
                                                                            <li><span class="span-info" style="margin-bottom: 4px; display: inline-block;" title="Click to take a look at my GitHub account"><i class="glyphicon glyphicon-globe"></i>&nbsp; GitHub:&nbsp;
                                                                    <a href="https://github.com/<?= $data->contactInfo->github ?>" target="_blank">github.com/<?= $data->contactInfo->github ?></a>
                                                                </span></li>
                                                                            <li><span class="span-info" title="Click to take a look at my LinkedIn account"><i class="glyphicon glyphicon-paperclip"></i>&nbsp; LinkedIn:&nbsp;
                                                                    <a href="https://www.linkedin.com/in/<?= $data->contactInfo->linkedin ?>" target="_blank">linkedin.com/in/<?= $data->contactInfo->linkedin ?></a>
                                                                </span></li>
                                                                        </ul>
                                                                    </div>
                                                                    <!-- /Contact Info -->
                                                                    <div class="clear"></div>

                                                                    <!--<h3 class="main-heading" style="margin-left: 22px;"><span>Follow me</span></h3>-->

                                                                    <div class="title_content tiltle_contacts" style="float: none;">
                                                                        <div class="text_content">Follow me</div>
                                                                        <div class="clear"></div>
                                                                    </div>



                                                                    <div id="profile_social" style="display: block !important; margin-bottom: 30px;">
                                                                        <?php /*<a href="#"><i class="fa fa-facebook"></i></a>
                                                                <a href="#"><i class="fa fa-twitter"></i></a>
                                                                <a href="#"><i class="fa fa-linkedin"></i></a>
                                                                <a href="#"><i class="fa fa fa-dribbble"></i></a>
                                                                <a href="#"><i class="fa fa-foursquare"></i></a>*/ ?>
                                                                        <?php foreach ($data->personalInfo->socialProfiles as $p) { ?>
                                                                            <a href="<?= $p->link ? $p->link : '#' ?>" target="_blank" title="Visit my <?= $p->nameFancy ?> profile"><i class="fa fa-<?= $p->faIcon ?>"></i></a>
                                                                        <?php } ?>
                                                                        <div class="clear"></div>
                                                                    </div>



                                                                </div>

                                                                <div class="col-md-7">
                                                                    <!-- Contact Form -->
                                                                    <div class="title_content" style="float: none;">
                                                                        <div class="text_content">Hire me / Get services from me</div>
                                                                        <div class="clear"></div>
                                                                    </div>

                                                                    <div class="contact-form">
                                                                        <!--<h3 class="main-heading"><span>Let's keep in touch</span></h3>-->

                                                                        <div id="contact-status"></div>

                                                                        <form action="#" id="contactform">
                                                                            <p class="form-group" column="name">
                                                                                <label for="name">Your Name</label>
                                                                                <input type="text" name="name" class="form-control" placeholder="Name..." />
                                                                                <span class="error-messages">
                                                                        <span error-type="required">&bull; Please enter your name.</span>
                                                                    </span>
                                                                            </p>
                                                                            <p class="form-group" column="companyName">
                                                                                <label for="name">Company Name (optional)</label>
                                                                                <input type="text" name="companyName" class="form-control" placeholder="Company Name..." />
                                                                            </p>
                                                                            <p class="form-group" column="email">
                                                                                <label for="email">Your Email (I'll reply to this address)</label>
                                                                                <input type="text" name="email" class="form-control" placeholder="Email..." />
                                                                                <span class="error-messages">
                                                                        <span error-type="required">&bull; Please enter your e-mail.</span>
                                                                        <span error-type="invalid">&bull; Entered e-mail doesn't seem to be a valid one. Please fix.</span>
                                                                    </span>
                                                                            </p>
                                                                            <p class="form-group" column="serviceTypes">
                                                                                <label for="email">What kind of services you're willing to get? <span class="pick-one-note">(Pick at least 1)</span></label>
                                                                                <?php foreach ($data->portfolio->filters as $s) { ?>
                                                                                    <span class="service-type" service-id="<?= $s->key ?>"><?= $s->value ?></span>
                                                                                <?php } ?>
                                                                                <span class="error-messages">
                                                                        <span error-type="required">&bull; Please pick at least 1 service type.</span>
                                                                    </span>
                                                                            </p>
                                                                            <p class="form-group" column="employType">
                                                                                <label for="employType">Employment Type</label>
                                                                                <select name="employType" class="form-control">
                                                                                    <option>I want to get services from you (as a freelancer)</option>
                                                                                    <option>I want to hire you (as an employee of my company)</option>
                                                                                </select>
                                                                                <span style="color: darkblue; font-size: 12px;">
                                                                        <span for-option="0">...which means you'll get services from me and make payment. That's it!</span>
                                                                        <span for-option="1">...which means you are making me a "Job Offer" for a permanent job.</span>
                                                                    </span>
                                                                            </p>
                                                                            <p class="form-group" column="budget">
                                                                                <label for="budget">Your Budget (Optional) <span style="font-size: 10px; font-weight: bold;">(You can enter an approximate value)</span></label>
                                                                                <input type="number" name="budgetAmount" class="form-control" placeholder="Amount..." min="0" step="0.01" style="display: inline-block; width: calc(35% - 2px);" />
                                                                                <select name="budgetCurrency" class="form-control" style="display: inline-block; width: calc(32% - 2px);">
                                                                                    <option>USD ($)</option>
                                                                                    <option>Euro (€)</option>
                                                                                    <option>TL (₺)</option>
                                                                                </select>
                                                                                <select name="budgetPeriod" class="form-control" style="display: inline-block; width: calc(33% - 2px);">
                                                                                    <option>per hour</option>
                                                                                    <option>per month</option>
                                                                                    <option>per year</option>
                                                                                </select>
                                                                            </p>
                                                                            <p class="form-group" column="message">
                                                                                <label for="message">Your Message <span style="font-size: 10px; font-weight: bold;">(You can explain the details of the project you want me to work on)</span></label>
                                                                                <textarea name="message" cols="88" rows="6" class="form-control" placeholder="Message..."></textarea>
                                                                                <span class="error-messages">
                                                                        <span error-type="required">&bull; Please enter your message.</span>
                                                                    </span>
                                                                            </p>
                                                                            <div id="contactform-message"></div>
                                                                            <input type="reset" name="btnReset" value="CLEAR" class="reset">
                                                                            <!-- <input type="submit" name="submit" value="SEND MESSAGE" class="submit">-->

                                                                            <section class="button-demo" style="display: inline-block;">
                                                                                <button class="ladda-button submit send_email" name="btnSubmit" data-color="green" data-style="expand-left">SEND MESSAGE</button>
                                                                            </section>

                                                                        </form>
                                                                    </div>
                                                                    <!-- /Contact Form -->
                                                                </div>
                                                            </div>
                                                        </div>



                                                    </div>                                            </div>
                                                <!-- End .contact -->

                                                <!-- .blog (not actual content, just redirect) -->
                                                <div id="blog" class="content_2">
                                                    <div style="text-align: center; margin: 80px 0px; font-size: 18px;">Redirecting to blog site...</div>
                                                </div>
                                                <!-- End .blog (not actual content, just redirect) -->

                                            <?php } else { ?>

                                                <!-- .blog -->
                                                <div id="blog" class="content_2">

                                                    <?php $this->load->view('SoftwareEngineer/blog/' . $blogData->blogViewName, (object)["blogData" => $blogData]); ?>

                                                </div>
                                                <!-- End .blog -->

                                                <!-- .home (not actual content, just redirect) -->
                                                <div id="home" class="content_2">
                                                    <div style="text-align: center; margin: 80px 0px; font-size: 18px;">Redirecting to home site...</div>
                                                </div>
                                                <!-- End .home (not actual content, just redirect) -->

                                            <?php } ?>

                                        </div>
                                        <!-- End #resp-tabs-container --> 

                                    </div><!-- End verticalTab -->

                                </div><!-- End site_content -->


                            </div><!-- End row -->

                        </div><!-- End col-md-12 -->

                    </div><!-- End row -->

                </div><!-- End container -->

            </section>
            <!-- End Content -->

        </div>
        <!-- End wrapper -->



        <!-- jquery | jQuery 1.11.0 -->
        <!-- Credits: http://jquery.com -->
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
 		
        <!-- Js | bootstrap -->
        <!-- Credits: http://getbootstrap.com/ -->
        <script type="text/javascript" src="<?= SOFTWARE_ENGINEER_ROOT_URI ?>js/bootstrap.min.js"></script>
        
        <!-- Js | jquery.cycle -->
        <!-- Credits: https://github.com/malsup/cycle2 -->
        <script type="text/javascript" src="<?= SOFTWARE_ENGINEER_ROOT_URI ?>js/jquery.cycle2.min.js"></script>
        
        <!-- jquery | rotate and portfolio -->
        <!-- Credits: http://jquery.com -->
        <script type="text/javascript" src="<?= SOFTWARE_ENGINEER_ROOT_URI ?>js/jquery.mixitup.min.js"></script>

        <!-- Js | easyResponsiveTabs -->
        <!-- Credits: http://webtrendset.com/demo/easy-responsive-tabs/Index.html -->
        <script type="text/javascript">
            var tab_icons = []; // generating tab_icons array (used in easyResponsiveTabs.min.js) (for mobile mode)
            $("ul.resp-tabs-list li").each(function () {
                tab_icons.push($(this).find("i").attr("class"));
            });
        </script>
        <script type="text/javascript" src="<?= SOFTWARE_ENGINEER_ROOT_URI ?>js/easyResponsiveTabs.min.js"></script>

        <!-- Js | mCustomScrollbar -->
        <!-- Credits: http://manos.malihu.gr/jquery-custom-content-scroller -->
        <script type="text/javascript" src="<?= SOFTWARE_ENGINEER_ROOT_URI ?>js/jquery.mCustomScrollbar.concat.min.js"></script>

        <!-- jquery | prettyPhoto -->
        <!-- Credits: http://www.no-margin-for-errors.com/ -->
        <script type="text/javascript" src="<?= SOFTWARE_ENGINEER_ROOT_URI ?>js/jquery.prettyPhoto.js"></script>

 		<!-- Js | Js -->
        <script type="text/javascript">
            var siteData = {
                isBlog:<?=isset($isBlog) && $isBlog ? 'true' : 'false' ?>,
                softwareEngineerRootUri: "<?= SOFTWARE_ENGINEER_ROOT_URI ?>",
                blogSiteSuffix: "<?= SOFTWARE_ENGINEER_BLOG_SUFFIX ?>"
            };
            console.log("siteData: ", siteData);
        </script>
        <script type="text/javascript" src="<?= utility_helper::includeVersionedReference(SOFTWARE_ENGINEER_ROOT_URI . 'js/main.js') ?>"></script>

        <!--[if lt IE 9]>
            <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

        <script type="text/javascript">
            $(function () {
                //console.log($("#verticalTab div.resp-tabs-container h2"));

                // hide some unused tabs (for mobile mode)
                //$("#verticalTab div.resp-tabs-container h2").eq(1).hide(); // resume
                //$("#verticalTab div.resp-tabs-container h2").eq(2).hide(); // portfolio
                //$("#verticalTab div.resp-tabs-container h2").eq(3).hide(); // blog
            });
        </script>

    </body>
</html>