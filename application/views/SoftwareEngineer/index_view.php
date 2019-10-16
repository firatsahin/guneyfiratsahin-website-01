<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>

        <title><?= $data->personalInfo->name->local . ' ' . $data->personalInfo->surname->local ?> | <?= $data->personalInfo->title ?></title>

        <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>

        <meta name="description" content="<?= $data->personalInfo->name->local . ' ' . $data->personalInfo->surname->local ?> <?= $data->personalInfo->title ?> Personal Web Page" />

        <!-- CSS | bootstrap -->
        <!-- Credits: http://getbootstrap.com/ -->
        <link  rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />

        <!-- CSS | font-awesome -->
        <!-- Credits: http://fortawesome.github.io/Font-Awesome/icons/ -->
        <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css" />

        <!-- CSS | animate -->
        <!-- Credits: http://daneden.github.io/animate.css/ -->
        <link rel="stylesheet" type="text/css" href="css/animate.min.css" />

        <!-- CSS | Normalize -->
        <!-- Credits: http://manos.malihu.gr/jquery-custom-content-scroller -->
        <link rel="stylesheet" type="text/css" href="css/jquery.mCustomScrollbar.css" />
       	
        <!-- CSS | Colors -->
        <link rel="stylesheet" type="text/css" href="css/colors/lightseagreen.css" id="colors-style" />
        <!--<link rel="stylesheet" type="text/css" href="css/switcher.css" />-->
        
        <!-- CSS | Style -->
        <link rel="stylesheet" type="text/css" href="css/main.css" />

        <!-- CSS | prettyPhoto -->
        <!-- Credits: http://www.no-margin-for-errors.com/ -->
        <link rel="stylesheet" type="text/css" href="css/prettyPhoto.css"/> 

		<!-- CSS | Google Fonts -->
        <link href='https://fonts.googleapis.com/css?family=Lato:300,400' rel='stylesheet' type='text/css'>

        <!-- favicon -->
        <link rel="shortcut icon" type="image/png" href="/img/frt-favicon.png"/>

        <!--[if IE 7]>
                <link rel="stylesheet" type="text/css" href="css/icons/font-awesome-ie7.min.css"/>
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
            }		

        </style>

    </head>

    <body>

        <!--[if lt IE 7]>
                <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <!-- Laoding page -->
        <div id="preloader"><div id="spinner"></div></div>

        <?php /*<!-- .slideshow -->
        <ul class="cb-slideshow" id="cb_slideshow" style="display: none;">
            <li><span>Image 01</span><div></div></li>
            <li><span>Image 02</span><div></div></li>
            <li><span>Image 03</span><div></div></li>
            <li><span>Image 04</span><div></div></li>
            <li><span>Image 05</span><div></div></li>
            <li><span>Image 06</span><div></div></li>
        </ul> 
        <!-- /.slideshow -->*/ ?>

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
    	 
		 
                                
         <?php /*<div class="image-holder one" id="pic_prof_1" style="display:none">
        
                <img class="head-image up circle" src="images/img/up.png" width="150" height="150" alt="" />
                <img class="head-image up-left circle" src="images/img/upleft.png" width="150" height="150" alt="" />
                <img class="head-image left circle" src="images/img/left.png" width="150" height="150" alt="" />
                <img class="head-image down-left circle" src="images/img/downleft.png" width="150" height="150" alt="" />
                <img class="head-image down circle" src="images/img/down.png" width="150" height="150" alt="" />
                <img class="head-image down-right circle" src="images/img/downright.png" width="150" height="150" alt="" />
                <img class="head-image right circle" src="images/img/right.png" width="150" height="150" alt="" />
                <img class="head-image up-right circle" src="images/img/upright.png" width="150" height="150" alt="" />
                <img class="head-image front circle" src="images/img/front.png" width="150" height="150" alt="" />
                
        </div>*/ ?>
        
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
                                            <li class="tabs-profile hi-icon-wrap hi-icon-effect-5 hi-icon-effect-5a profile" data-tab-name="profile">			
                                                <span class="tite-list">profile</span>
                                                <i class="fa fa-user icon_menu icon_menu_active"></i>
                                            </li>

                                            <li class="tabs-resume hi-icon-wrap hi-icon-effect-5 hi-icon-effect-5a" data-tab-name="resume" style="display: none;">
                                                <span class="tite-list">resume</span>
                                                <i class="fa fa-tasks icon_menu"></i>
                                            </li>

                                            <li class="tabs-portfolio hi-icon-wrap hi-icon-effect-5 hi-icon-effect-5a" data-tab-name="portfolio" style="display: none;">
                                                <span class="tite-list">portfolio</span>
                                                <i class="fa fa-briefcase icon_menu"></i>
                                            </li>

                                            <li class="tabs-blog hi-icon-wrap hi-icon-effect-5 hi-icon-effect-5a" data-tab-name="blog" style="display: none;">
                                                <span class="tite-list">blog</span>
                                                <i class="fa fa-bullhorn icon_menu"></i>
                                            </li>

                                            <li class="tabs-contact hi-icon-wrap hi-icon-effect-5 hi-icon-effect-5a" data-tab-name="contact" style="margin-bottom: 48px !important;"> 
                                                <span class="tite-list">contact</span>
                                                <i class="fa fa-envelope icon_menu"></i> 
                                            </li>

                                            <a href="#" id="print" style="display: none;"><i class="fa fa-print icon_print"></i> </a>
                                            <a href="#" id="downlowd" style="display: none;"><i class="fa fa-download icon_print"></i> </a>
                                        </ul>
                                        <!-- /resp-tabs-list -->



                                        <!-- resp-tabs-container --> 
                                        <div class="resp-tabs-container">

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

        <?php foreach ($data->personalInfo->aboutMeText as $a) { ?>
            <p style="margin-bottom:20px">
                <i class="fa fa-quote-left"></i>&nbsp;
                <?= $a ?>
            </p>
        <?php } ?>

    </div>
    <!-- End left-wrap -->

    <div class="col-md-6 profile-r">

        <div class="cycle-slideshow">
            <img src="images/img-profile/about_1.jpg" alt="" />
            <img src="images/img-profile/about_2.png" alt="" />
            <img src="images/img-profile/about_3.png" alt="" />
        </div>

    </div>

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
                                            <div id="resume" class="content_2" style="display: none;">
                                                <!-- .title -->
<h1 class="h-bloc">Resume - Personal Info</h1> 

<div class="row">

   <!-- .resume-right -->
    <div class="col-md-6">

        <!-- .title_content -->
        <div class="title_content" style="float: none;">
            <div class="text_content">Designs skills</div>
            <div class="clear"></div>
        </div>
        <!-- /.title_content -->
        
        <div class="skills">
            <!-- .skillbar -->
            <div class="skillbar clearfix" data-percent="95%">
                <div class="skillbar-title"><span>Photoshop</span></div>
                <div class="skillbar-bar"></div>
                <div class="skill-bar-percent">95%</div>
            </div>
    
            <!-- /.skillbar -->
            
            <!-- .skillbar -->
            <div class="skillbar clearfix" data-percent="90%">
                <div class="skillbar-title"><span>Illustrateur</span></div>
                <div class="skillbar-bar"></div>
                <div class="skill-bar-percent">90%</div>
            </div>
            <!-- /.skillbar -->
            
            <!-- .skillbar -->
            <div class="skillbar clearfix" data-percent="65%">
                <div class="skillbar-title"><span>Indesign</span></div>
                <div class="skillbar-bar"></div>
                <div class="skill-bar-percent">65%</div>
            </div>
            <!-- /.skillbar -->
            
            <!-- .skillbar -->
            <div class="skillbar clearfix" data-percent="35%">
                <div class="skillbar-title"><span>Flash</span></div>
                <div class="skillbar-bar"></div>
                <div class="skill-bar-percent">35%</div>
            </div>
            <!-- /.skillbar -->
        </div>
        
        
        <!-- .title_content -->
        <div class="title_content" style="float: none;">
            <div class="text_content">Programming Skills</div>
            <div class="clear"></div>
        </div>
        <!-- /.title_content -->
        
        <div class="skills">
            <!-- .skillbar -->
            <div class="skillbar clearfix" data-percent="85%">
                <div class="skillbar-title"><span>Wordpress</span></div>
                <div class="skillbar-bar"></div>
                <div class="skill-bar-percent">85%</div>
            </div>
            <!-- /.skillbar -->
            
            <!-- .skillbar -->
            <div class="skillbar clearfix" data-percent="75%">
                <div class="skillbar-title"><span>Joomla</span></div>
                <div class="skillbar-bar"></div>
                <div class="skill-bar-percent">75%</div>
            </div>
            <!-- /.skillbar -->
            
            <!-- .skillbar -->
            <div class="skillbar clearfix" data-percent="60%">
                <div class="skillbar-title"><span>Drupal</span></div>
                <div class="skillbar-bar"></div>
                <div class="skill-bar-percent">60%</div>
            </div>
            <!-- /.skillbar -->
            
             <!-- .skillbar -->
            <div class="skillbar clearfix" data-percent="89%">
                <div class="skillbar-title"><span>Php</span></div>
                <div class="skillbar-bar"></div>
                <div class="skill-bar-percent">89%</div>
            </div>
            <!-- /.skillbar --> 
        </div>
        
         
        <!-- .title_content -->
        <div class="title_content" style="float: none;">
            <div class="text_content">Office Skills</div>
            <div class="clear"></div>
        </div>
        <!-- /.title_content -->
            
        <div class="skills">       
            <!-- .skillbar -->
            <div class="skillbar clearfix" data-percent="85%">
                <div class="skillbar-title"><span>MS Excel</span></div>
                <div class="skillbar-bar"></div>
                <div class="skill-bar-percent">85%</div>
            </div>
            <!-- /.skillbar -->
            
            <!-- .skillbar -->
            <div class="skillbar clearfix " data-percent="95%">
                <div class="skillbar-title"><span>MS Word</span></div>
                <div class="skillbar-bar"></div>
                <div class="skill-bar-percent">95%</div>
            </div>
            <!-- /.skillbar -->
            
            <!-- .skillbar -->
            <div class="skillbar clearfix " data-percent="60%">
                <div class="skillbar-title"><span>Powerpoint</span></div>
                <div class="skillbar-bar"></div>
                <div class="skill-bar-percent">60%</div>
            </div>
            <!-- /.skillbar -->
            
            <!-- .skillbar -->
            <div class="skillbar clearfix " data-percent="40%">
                <div class="skillbar-title"><span>SharePoint</span></div>
                <div class="skillbar-bar"></div>
                <div class="skill-bar-percent">40%</div>
            </div>
            <!-- /.skillbar -->   
		</div>
        
        
        <!-- .title_content -->
        <div class="title_content" style="float: none;">
            <div class="text_content">Hobbies Skills</div>
            <div class="clear"></div>
        </div>
        <!-- /.title_content -->
        
        <div class="skills">
            <!-- .skillbar -->
            <div class="skillbar clearfix" data-percent="60%">
                <div class="skillbar-title"><span>Music</span></div>
                <div class="skillbar-bar"></div>
                <div class="skill-bar-percent">60%</div>
            </div>
            <!-- /.skillbar -->
            
            <!-- .skillbar -->
            <div class="skillbar clearfix " data-percent="95%">
                <div class="skillbar-title"><span>Sport</span></div>
                <div class="skillbar-bar"></div>
                <div class="skill-bar-percent">95%</div>
            </div>
            <!-- /.skillbar -->
            
            <!-- .skillbar -->
            <div class="skillbar clearfix " data-percent="85%">
                <div class="skillbar-title"><span>Reading</span></div>
                <div class="skillbar-bar"></div>
                <div class="skill-bar-percent">85%</div>
            </div>
            <!-- /.skillbar -->
            
            <!-- .skillbar -->
            <div class="skillbar clearfix " data-percent="70%">
                <div class="skillbar-title"><span>Travelling</span></div>
                <div class="skillbar-bar"></div>
                <div class="skill-bar-percent">70%</div>
            </div>
            <!-- /.skillbar -->
        </div>
        
        
        <!-- .title_content -->
        <div class="title_content" style="float: none;">
            <div class="text_content">Language Skills</div>
            <div class="clear"></div>
        </div>
        <!-- /.title_content -->
        
        <div class="skills">
            <!-- .skillbar -->
            <div class="skillbar clearfix" data-percent="90%">
                <div class="skillbar-title"><span>English</span></div>
                <div class="skillbar-bar"></div>
                <div class="skill-bar-percent">90%</div>
            </div>
            <!-- /.skillbar -->
            
            <!-- .skillbar -->
            <div class="skillbar clearfix " data-percent="80%">
                <div class="skillbar-title"><span>French</span></div>
                <div class="skillbar-bar"></div>
                <div class="skill-bar-percent">80%</div>
            </div>
            <!-- /.skillbar -->
            
            <!-- .skillbar -->
            <div class="skillbar clearfix " data-percent="50%">
                <div class="skillbar-title"><span>Spanish</span></div>
                <div class="skillbar-bar"></div>
                <div class="skill-bar-percent">50%</div>
            </div>
            <!-- /.skillbar -->
            
            <!-- .skillbar -->
            <div class="skillbar clearfix " data-percent="60%">
                <div class="skillbar-title"><span>Swiss</span></div>
                <div class="skillbar-bar"></div>
                <div class="skill-bar-percent">60%</div>
            </div>
            <!-- /.skillbar -->
        </div>
        
        
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
     
     
     
     <!-- .resume-left -->
    <div class="col-md-6 resume-left">    
        <!-- .title_content -->
        <div class="title_content" style="margin-bottom:5px">
            <div class="text_content">Experience</div>
            <div class="clear"></div>
        </div>
        <!-- /.title_content -->
        
        <!-- .attributes -->
        <ul class="attributes">
            <li class="first">
                <h5>Web Developer <span class="duration"><i class="fa fa-calendar color"></i> 2011 - 2013</span></h5>
                <h6><span class="fa fa-briefcase"></span> Name of Company</h6>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscingVivamus sit amet ligula non lectus cursus egestas. Cras erat lorem, fringilla quis sagittis in, sagittis inNam leo tortor Nam leo tortor Vivamus.</p>
            </li>
            <li>
                <h5>Front-End Developer <span class="duration"><i class="fa fa-calendar color"></i> 2010 - 2011</span></h5>
                <h6><span class="fa fa-briefcase"></span> Name of Company</h6>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscingVivamus sit amet ligula non lectus cursus egestas. Cras erat lorem, fringilla quis sagittis in, sagittis inNam leo tortor Nam leo tortor Vivamus.</p>
            </li>

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
            <li class="first">
                <h5>Master of Engineering <span class="duration"><i class="fa fa-calendar color"></i> 2011 - 2013</span></h5>
                <h6><span class="fa fa-book"></span> Name of University</h6>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscingVivamus sit amet ligula non lectus cursus egestas. Cras erat lorem, fringilla quis sagittis in, sagittis inNam leo tortor Nam leo tortor Vivamus.</p>
            </li>
            <li>
                <h5>Bachelor of Engineering <span class="duration"><i class="fa fa-calendar color"></i> 2010 - 2011</span></h5>
                <h6><span class="fa fa-book"></span> Name of University</h6>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscingVivamus sit amet ligula non lectus cursus egestas. Cras erat lorem, fringilla quis sagittis in, sagittis inNam leo tortor Nam leo tortor Vivamus.</p>
            </li>
        </ul>
        <!-- /.attributes -->
        <br>  
        
        
          <!-- .title_content -->
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
        <br>  
        
    </div>
    <!-- /.resume-left -->
</div>

  <div style="clear: both"></div>  
  
  
<!-- client reference -->
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
</div>

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
                                                        <li><span class="filter active" data-filter="catWeb catGraphic catMotion logo">All</span></li>
                                                        <li><span class="filter" data-filter="catWeb">Web Design</span></li>
                                                        <li><span class="filter" data-filter="catGraphic">Graphic Design</span></li>
                                                        <li><span class="filter" data-filter="catMotion">Motion Graphic</span></li>
                                                        <li><span class="filter" data-filter="logo">Logo</span></li>
                                                    </ul>
                                                    <!-- /#filters -->
                                    
                                                    <!-- #portfoliolist -->
                                                    <div id="portfoliolist">

                                                        <!-- .portfolio -->
                                                        <div class="portfolio logo" data-cat="logo">	
                                                            <!-- .portfolio-wrapper -->
                                                            <div class="portfolio-wrapper">		
                                                                <a href="images/portfolio/1.jpg" rel="portfolio" title="Lorem ipsum dolor sit amet, consectetur adipiscing Vivamus sit amet ligula non lectus.consectetur adipiscingVivamus sit amet">
                                                                    <img src="images/portfolio/1.jpg" alt="Visual Infography" />
                                                                    <div class="label">
                                                                        <div class="label-text">
                                                                            <a class="text-title">Project Name</a>
                                                                            <span class="text-category">Logo</span>
                                                                        </div>
                                                                        <div class="label-bg"></div>
                                                                    </div>
                                                                </a>
                                                            </div>
                                                            <!-- /.portfolio-wrapper -->
                                                        </div>		
                                                        <!-- /.portfolio -->

 

                                                        <!-- .portfolio -->
                                                        <div class="portfolio catWeb" data-cat="catWeb">	
                                                            <!-- .portfolio-wrapper -->
                                                            <div class="portfolio-wrapper">		
                                                                <a href="http://www.youtube.com/watch?v=c9MnSeYYtYY" rel="portfolio">

                                                                    <img src="images/portfolio/2.jpg" alt="Visual Infography" />
                                                                    <div class="label">
                                                                        <div class="label-text">
                                                                            <a class="text-title">Project Name</a>
                                                                            <span class="text-category">Web Design</span>
                                                                        </div>
                                                                        <div class="label-bg"></div>
                                                                    </div>
                                                                </a>
                                                            </div>
                                                            <!-- /.portfolio-wrapper -->
                                                        </div>		
                                                        <!-- /.portfolio -->
 
                                                        <!-- .portfolio -->
                                                        <div class="portfolio catWeb" data-cat="catWeb">
                                                            <!-- .portfolio-wrapper -->
                                                            <div class="portfolio-wrapper">			
                                                                <a href="images/portfolio/3.jpg" rel="portfolio">
                                                                    <img src="images/portfolio/3.jpg" alt="Sonor's Design" />
                                                                    <div class="label">
                                                                        <div class="label-text">
                                                                            <a class="text-title">Project Name</a>
                                                                            <span class="text-category">Web design</span>
                                                                        </div>
                                                                        <div class="label-bg"></div>
                                                                    </div>
                                                                </a>
                                                            </div>
                                                            <!-- /.portfolio-wrapper -->
                                                        </div>				
                                                        <!-- /.portfolio -->

                                                        <!-- .portfolio -->
                                                        <div class="portfolio catMotion" data-cat="catMotion">
                                                            <!-- .portfolio-wrapper -->
                                                            <div class="portfolio-wrapper">			
                                                                <a href="images/portfolio/4.jpg" rel="portfolio">
                                                                    <img src="images/portfolio/4.jpg" alt="Typography Company" />
                                                                    <div class="label">
                                                                        <div class="label-text">
                                                                            <a class="text-title">Project Name</a>
                                                                            <span class="text-category">Motion Graphic</span>
                                                                        </div>
                                                                        <div class="label-bg"></div>
                                                                    </div>
                                                                </a>
                                                            </div>
                                                            <!-- /.portfolio-wrapper -->
                                                        </div>	
                                                        <!-- /.portfolio -->

                                                        <!-- .portfolio -->
                                                        <div class="portfolio catWeb" data-cat="catWeb">
                                                            <!-- .portfolio-wrapper -->
                                                            <div class="portfolio-wrapper">
                                                                <a href="images/portfolio/5.jpg" title="Etiam quis mi eu elit tempor facilisis id et neque. Nulla sit amet sem sapien." rel="portfolio">
                                                                    <img src="images/portfolio/5.jpg" alt="Weatherette" />
                                                                    <div class="label">
                                                                        <div class="label-text">
                                                                            <a class="text-title">Project Name</a>
                                                                            <span class="text-category">Web Design</span>
                                                                        </div>
                                                                        <div class="label-bg"></div>
                                                                    </div>
                                                                </a>
                                                            </div>
                                                            <!-- /.portfolio-wrapper -->
                                                        </div>	
                                                        <!-- /.portfolio -->

                                                        <!-- .portfolio -->
                                                        <div class="portfolio catMotion" data-cat="catMotion">
                                                            <!-- .portfolio-wrapper -->
                                                            <div class="portfolio-wrapper">		
                                                                <a href="images/portfolio/6.jpg" rel="portfolio">				
                                                                    <img src="images/portfolio/6.jpg" alt="BMF" />
                                                                    <div class="label">
                                                                        <div class="label-text">
                                                                            <a class="text-title">Project Name</a>
                                                                            <span class="text-category">Motion Graphic</span>
                                                                        </div>
                                                                        <div class="label-bg"></div>
                                                                    </div>
                                                                </a>
                                                            </div>
                                                            <!-- /.portfolio-wrapper -->
                                                        </div>	
                                                        <!-- /.portfolio -->

                                                        <!-- .portfolio -->
                                                        <div class="portfolio catGraphic" data-cat="catGraphic">
                                                            <!-- .portfolio-wrapper -->
                                                            <div class="portfolio-wrapper">		
                                                                <a href="images/portfolio/7.jpg" title="Etiam quis mi eu elit tempor facilisis id et neque. Nulla sit amet sem sapien." rel="portfolio">				
                                                                    <img src="images/portfolio/7.jpg" alt="Techlion" />
                                                                    <div class="label">
                                                                        <div class="label-text">
                                                                            <a class="text-title">Project Name</a>
                                                                            <span class="text-category">Graphic Design</span>
                                                                        </div>
                                                                        <div class="label-bg"></div>
                                                                    </div>
                                                                </a>
                                                            </div>
                                                            <!-- /.portfolio-wrapper -->
                                                        </div>
                                                        <!-- /.portfolio -->

                                                        <!-- .portfolio -->
                                                        <div class="portfolio logo" data-cat="logo">
                                                            <!-- .portfolio-wrapper -->
                                                            <div class="portfolio-wrapper">		
                                                                <a href="images/portfolio/8.jpg" rel="portfolio" title="Etiam quis mi eu elit tempor facilisis id et neque. Nulla sit amet sem sapien.">
                                                                    <img src="images/portfolio/8.jpg" alt="KittyPic" />
                                                                    <div class="label">
                                                                        <div class="label-text">
                                                                            <a class="text-title">Project Name</a>
                                                                            <span class="text-category">Logo</span>
                                                                        </div>
                                                                        <div class="label-bg"></div>
                                                                    </div>
                                                                </a>
                                                            </div>
                                                            <!-- /.portfolio-wrapper -->
                                                        </div>	
                                                        <!-- /.portfolio -->

                                                        <!-- .portfolio -->
                                                        <div class="portfolio catWeb" data-cat="catWeb">
                                                            <!-- .portfolio-wrapper -->
                                                            <div class="portfolio-wrapper">			
                                                                <a href="images/portfolio/9.jpg" title="Etiam quis mi eu elit tempor facilisis id et neque. Nulla sit amet sem sapien." rel="portfolio">
                                                                    <img src="images/portfolio/9.jpg" alt="Graph Plotting" />
                                                                    <div class="label">
                                                                        <div class="label-text">
                                                                            <a class="text-title">Project Name</a>
                                                                            <span class="text-category">Web Design</span>
                                                                        </div>
                                                                        <div class="label-bg"></div>
                                                                    </div>
                                                                </a>
                                                            </div>
                                                            <!-- /.portfolio-wrapper -->
                                                        </div>	
                                                        <!-- /.portfolio -->

                                                        <!-- .portfolio -->
                                                        <div class="portfolio catGraphic" data-cat="catGraphic">
                                                            <!-- .portfolio-wrapper -->
                                                            <div class="portfolio-wrapper">	
                                                                <a href="images/portfolio/10.jpg" rel="portfolio">
                                                                    <img src="images/portfolio/10.jpg" alt="QR Quick Response" />
                                                                    <div class="label">
                                                                        <div class="label-text">
                                                                            <a class="text-title">Project Name</a>
                                                                            <span class="text-category">Graphic Design</span>
                                                                        </div>
                                                                        <div class="label-bg"></div>
                                                                    </div>
                                                                </a>
                                                            </div>
                                                            <!-- /.portfolio-wrapper -->
                                                        </div>	
                                                        <!-- /.portfolio -->

                                                        <!-- .portfolio -->
                                                        <div class="portfolio logo" data-cat="logo">
                                                            <!-- .portfolio-wrapper -->
                                                            <div class="portfolio-wrapper">	
                                                                <a href="images/portfolio/11.jpg" title="Etiam quis mi eu elit tempor facilisis id et neque. Nulla sit amet sem sapien." rel="portfolio">
                                                                    <img src="images/portfolio/11.jpg" alt="Mobi Sock" />
                                                                    <div class="label">
                                                                        <div class="label-text">
                                                                            <a class="text-title">Project Name</a>
                                                                            <span class="text-category">Logo</span>
                                                                        </div>
                                                                        <div class="label-bg"></div>
                                                                    </div>
                                                                </a>
                                                            </div>
                                                            <!-- /.portfolio-wrapper -->
                                                        </div>	
                                                        <!-- /.portfolio -->

                                                        <!-- .portfolio -->
                                                        <div class="portfolio logo" data-cat="logo">
                                                            <!-- .portfolio-wrapper -->
                                                            <div class="portfolio-wrapper">
                                                                <a href="images/portfolio/12.jpg" rel="portfolio">
                                                                    <img src="images/portfolio/12.jpg" alt="Village Community Church" />
                                                                    <div class="label">
                                                                        <div class="label-text">
                                                                            <a class="text-title">Project Name</a>
                                                                            <span class="text-category">Logo</span>
                                                                        </div>
                                                                        <div class="label-bg"></div>
                                                                    </div>
                                                                </a>
                                                            </div>
                                                            <!-- /.portfolio-wrapper -->
                                                        </div>	
                                                        <!-- /.portfolio -->

                                                        <div class="clear"></div>

                                                    </div>
                                                    <!-- #portfoliolist -->
                                                </div>
                                                <!-- /.container-portfolio -->
                                                                                       </div>
                                            <!-- End .portfolio -->

                                            <!-- .blog -->
                                            <div id="blog" class="content_2">
                                                <h1 class="h-bloc">Blog - My Blog</h1><br> 

<div class="col-md-12">
    <div class="row">

        <!-- Page Blog -->
        <div class="col-md-12" id="blog_page">
            <!-- start Page Blog -->
            <section id="blog-page">

                <!-- Post 1 -->	
                <article id="post-1" class="blog-article">                    

                    <div class="col-md-12">

                        <div class="row">

                            <div class="col-md-12 post_media">
                                <div class="post-format-icon">
                                    <a href="#" class="item-date"><span class="fa fa-picture-o"></span></a>
                                </div>
                                <div class="media">
                                    <div class="he-wrap tpl2">
                                        <div id="carousel-1" class="carousel slide" data-ride="carousel">

                                            <ol class="carousel-indicators">
                                                <li data-target="#carousel-1" data-slide-to="0" class="active"></li>
                                                <li data-target="#carousel-1" data-slide-to="1"></li>
                                                <li data-target="#carousel-1" data-slide-to="2"></li>
                                            </ol>

                                            <div class="carousel-inner">

                                                <div class="item active">
                                                    <img src="images/blog/blog-1.jpg" alt="" />
                                                    <div class="carousel-caption">
                                                        <h4>First Thumbnail label</h4>
                                                        <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                                                    </div>
                                                </div>


                                                <div class="item">
                                                    <img src="images/blog/blog-2.jpg" alt="" />
                                                    <div class="carousel-caption">
                                                        <h4>First Thumbnail label</h4>
                                                        <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                                                    </div>
                                                </div>

                                                <div class="item">
                                                    <img src="images/blog/blog-3.jpg" alt="" />
                                                    <div class="carousel-caption">
                                                        <h4>First Thumbnail label</h4>
                                                        <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                                                    </div>
                                                </div>

                                            </div>

                                            <a class="left carousel-control" href="#carousel-1" data-slide="prev">
                                                <span class="glyphicon glyphicon-chevron-left"></span>
                                            </a>

                                            <a class="right carousel-control" href="#carousel-1" data-slide="next">
                                                <span class="glyphicon glyphicon-chevron-right"></span>
                                            </a>

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 post_content">
                                <div class="content post_format_standart">
                                    <div class="top_c ">

                                        <div class="title_content">
                                            <div class="text_content"><a href="#post-1" class="read_more">Blog Post Gallery</a></div>
                                            <div class="clear"></div>
                                        </div>

                                        <ul class="info">
                                            <li><i class="glyphicon glyphicon-comment"></i> 2 Comments</li>
                                            <li><i class="glyphicon glyphicon-time"></i> January 31, 2014</li>
                                            <li><i class="glyphicon glyphicon-user"></i> by Jane Doe</li>
                                            <li><i class="glyphicon glyphicon-tag"></i> jquery, slider, web design</li>
                                        </ul>

                                        <div class="blog-content">
                                            <p><i class="fa fa-quote-left"></i> Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo...</p></div>
                                    </div>
                                </div>	

                                <a href="#post-1" class="read_m pull-right">Read More <i class='glyphicon glyphicon-chevron-right'></i></a>

                            </div>
                        </div>

                    </div>
                </article>
                <!-- End Post 1 -->

                <div class="clear"></div>

                <!-- Post 2 -->
                <article id="post-2" class="blog-article">                    

                    <div class="col-md-12">

                        <div class="row">

                            <div class="col-md-12 post_media">

                                <div class="post-format-icon">
                                    <a href="#" class="item-date"><span class="fa fa-pencil"></span></a>
                                </div>

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 post_content">
                                <div class="content post_format_standart">
                                    <div class="top_c ">

                                        <div class="title_content">
                                            <div class="text_content"><a href="#post-2" class="read_more">Blog Aside post</a></div>
                                            <div class="clear"></div>
                                        </div>

                                        <ul class="info">
                                            <li><i class="glyphicon glyphicon-comment"></i> 2 Comments</li>
                                            <li><i class="glyphicon glyphicon-time"></i> January 31, 2014</li>
                                            <li><i class="glyphicon glyphicon-user"></i> by Jane Doe</li>
                                            <li><i class="glyphicon glyphicon-tag"></i> php, web design</li>
                                        </ul>

                                        <div class="blog-content">
                                            <p><i class="fa fa-quote-left"></i> Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo...</p></div>
                                    </div>
                                </div>	

                                <a href="#post-2" class="read_m pull-right">Read More <i class='glyphicon glyphicon-chevron-right'></i></a>

                            </div>
                        </div>

                    </div>
                </article>
                <!-- End Post 2 -->

                <div class="clear"></div>

                <!-- Post 3 -->
                <article id="post-3" class="blog-article">                    

                    <div class="col-md-12">

                        <div class="row">

                            <div class="col-md-12 post_media">

                                <div class="post-format-icon">
                                    <a href="#" class="item-date"><span class="fa fa-picture-o"></span></a>
                                </div>

                                <div class="media">
                                    <div class="he-wrap tpl2">
                                        <img src="images/blog/blog-4.jpg" class="img-hover" alt="" />
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 post_content">
                                <div class="content post_format_standart">
                                    <div class="top_c ">

                                        <div class="title_content">
                                            <div class="text_content"><a href="#post-3" class="read_more">Blog Post Image</a></div>
                                            <div class="clear"></div>
                                        </div>

                                        <ul class="info">
                                            <li><i class="glyphicon glyphicon-comment"></i> 2 Comments</li>
                                            <li><i class="glyphicon glyphicon-time"></i> January 31, 2014</li>
                                            <li><i class="glyphicon glyphicon-user"></i> by Jane Doe</li>
                                            <li><i class="glyphicon glyphicon-tag"></i> php, web design</li>
                                        </ul>

                                        <div class="blog-content">
                                            <p><i class="fa fa-quote-left"></i> Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo...</p></div>
                                    </div>
                                </div>	

                                <a href="#post-3" class="read_m pull-right">Read More <i class='glyphicon glyphicon-chevron-right'></i></a>

                            </div>
                        </div>

                    </div>
                </article>

                <!-- End Post 3 -->

            </section>

            <!-- End Page Blog -->



            <!-- Page Blog - Post 1 -->
            <section id="post-1-page" class="content-post" style="display: none">
                <div class="row inner">

                    <div class="col-md-12" style="width: 100%;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;float: left;background: rgba(255, 255, 255, 0.8);padding-bottom: 15px;padding-top: 15px;">

                        <article class="postPage">

                            <div class="col-md-12 post_media">
                                <div class="post-format-icon">
                                    <a href="#" class="item-date"><span class="fa fa-picture-o"></span></a>
                                </div>
                                <div class="media">
                                    <div class="he-wrap tpl2">
                                        <div id="carousel-2" class="carousel slide" data-ride="carousel">

                                            <ol class="carousel-indicators">
                                                <li data-target="#carousel-2" data-slide-to="0" class="active"></li>
                                                <li data-target="#carousel-2" data-slide-to="1"></li>
                                                <li data-target="#carousel-2" data-slide-to="2"></li>
                                            </ol>

                                            <div class="carousel-inner">

                                                <div class="item active">
                                                    <img src="images/blog/blog-1.jpg" alt="">
                                                    <div class="carousel-caption">
                                                        <h4>First Thumbnail label</h4>
                                                        <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                                                    </div>
                                                </div>


                                                <div class="item">
                                                    <img src="images/blog/blog-2.jpg" alt="">
                                                    <div class="carousel-caption">
                                                        <h4>First Thumbnail label</h4>
                                                        <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                                                    </div>
                                                </div>

                                                <div class="item">
                                                    <img src="images/blog/blog-3.jpg" alt="">
                                                    <div class="carousel-caption">
                                                        <h4>First Thumbnail label</h4>
                                                        <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>


                            <div class="title_content">
                                <div class="text_content">Blog Post Gallery</div>
                                <div class="clear"></div>
                            </div>

                            <p class="caps">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with.</p>

                            <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.</p>

                            <div class="col-md-12 first">
                                <div class="info">
                                    <div>
                                        <span class="tag">#php</span>
                                        <span class="tag">#web</span>
                                        <span class="tag">#web design</span>
                                    </div>


                                    <ul class="info-post">
                                        <li><i class="glyphicon glyphicon-comment"></i> 2 Comments</li>
                                        <li><i class="glyphicon glyphicon-time"></i> January 31, 2014</li>
                                        <li><i class="glyphicon glyphicon-user"></i> by Jane Doe</li>
                                        <li><i class="glyphicon glyphicon-tag"></i> jquery, slider, web design</li>
                                    </ul>
                                </div>

                                <div class="clear"></div>      


                                <div class="about_author">
                                    <div class="title_content" style="margin-bottom:10px">
                                        <div class="text_content">BILL GATES</div>
                                        <div class="clear"></div>
                                    </div>

                                    <div class="clear"></div>

                                    <div class="prg_content">
                                        <img src="https://placehold.it/100x100" width="100" height="100" alt="img">

                                        <div class="text">
                                            Lorem ipsum dolor sit amet, consectetur
                                            adipiscing elit. Praesent condimentum sed elit
                                            vitae tristique. Aliquam erat volutpat. Nunc sit
                                            amet cursus libero. In fringilla egestas ornare.
                                        </div>

                                        <div class="nb_post" style="margin-top: 10px;">
                                            <b id="nb_post"> 15 posts</b> created by author
                                        </div>
                                    </div>

                                    <div class="clear"></div>
                                </div>

                                <div class="clear"></div>      


                                <div class="post_comments">

                                    <div class="title_content">
                                        <div class="text_content">7 Comments</div>
                                        <div class="clear"></div>
                                    </div>

                                    <div class="clear"></div>

                                    <div class="comments">

                                        <div class="comment">
                                            <img src="https://placehold.it/100x100" width="100" height="100" alt="img" />
                                            <div class="text">
                                                <div class="name">John Doe <a class="reply" href="#">Reply</a></div>
                                                <div class="date">12, September, 2013</div>
                                                Lorem ipsum dolor sit amet, consectetur
                                                adipiscing elit. Praesent condimentum sed elit
                                                vitae tristique. Aliquam erat volutpat. Nunc sit
                                                amet cursus libero. In fringilla egestas ornare.
                                            </div>
                                            <div class="comment sub">
                                                <img src="https://placehold.it/100x100" width="100" height="100" alt="img" />
                                                <div class="text">
                                                    <div class="name">Bill Gates <a class="reply" href="#">Reply</a></div>
                                                    <div class="date">12, September, 2013</div>
                                                    Lorem ipsum dolor sit amet, consectetur
                                                    adipiscing elit. Praesent condimentum sed elit
                                                    vitae tristique. Aliquam erat volutpat. Nunc sit
                                                    amet cursus libero. In fringilla egestas ornare.
                                                </div>
                                                <div class="clear"></div>
                                            </div>
                                            <div class="clear"></div>
                                        </div><!-- .comments -->

                                        <div class="comment">
                                            <img src="https://placehold.it/100x100" width="100" height="100" alt="img" />
                                            <div class="text">
                                                <div class="name">John Smith <a class="reply" href="#">Reply</a></div>
                                                <div class="date">12, September, 2013</div>
                                                Lorem ipsum dolor sit amet, consectetur
                                                adipiscing elit. Praesent condimentum sed elit
                                                vitae tristique. Aliquam erat volutpat. Nunc sit
                                                amet cursus libero. In fringilla egestas ornare.
                                            </div>
                                            <div class="comment sub">
                                                <img src="https://placehold.it/100x100" width="100" height="100" alt="img" />
                                                <div class="text">
                                                    <div class="name">Bill Gates <a class="reply" href="#">Reply</a></div>
                                                    <div class="date">12, September, 2013</div>
                                                    Lorem ipsum dolor sit amet, consectetur
                                                    adipiscing elit. Praesent condimentum sed elit
                                                    vitae tristique. Aliquam erat volutpat. Nunc sit
                                                    amet cursus libero. In fringilla egestas ornare.
                                                </div>
                                                <div class="clear"></div>
                                            </div>
                                            <div class="clear"></div>
                                        </div><!-- .comments -->

                                        <div class="comment">
                                            <img src="https://placehold.it/100x100" width="100" height="100" alt="img" />
                                            <div class="text">
                                                <div class="name">Andrian Robert <a class="reply" href="#">Reply</a></div>
                                                <div class="date">12, September, 2013</div>
                                                Lorem ipsum dolor sit amet, consectetur
                                                adipiscing elit. Praesent condimentum sed elit
                                                vitae tristique. Aliquam erat volutpat. Nunc sit
                                                amet cursus libero. In fringilla egestas ornare.
                                            </div>
                                            <div class="comment sub">
                                                <img src="https://placehold.it/100x100" width="100" height="100" alt="img" />
                                                <div class="text">
                                                    <div class="name">Bill Gates <a class="reply" href="#">Reply</a></div>
                                                    <div class="date">12, September, 2013</div>
                                                    Lorem ipsum dolor sit amet, consectetur
                                                    adipiscing elit. Praesent condimentum sed elit
                                                    vitae tristique. Aliquam erat volutpat. Nunc sit
                                                    amet cursus libero. In fringilla egestas ornare.
                                                </div>
                                                <div class="clear"></div>
                                            </div>
                                            <div class="clear"></div>
                                        </div><!-- .comments -->

                                        <div class="comment">
                                            <img src="https://placehold.it/100x100" width="100" height="100" alt="img" />
                                            <div class="text">
                                                <div class="name">Andrian Robert <a class="reply" href="#">Reply</a></div>
                                                <div class="date">12, September, 2013</div>
                                                Lorem ipsum dolor sit amet, consectetur
                                                adipiscing elit. Praesent condimentum sed elit
                                                vitae tristique. Aliquam erat volutpat. Nunc sit
                                                amet cursus libero. In fringilla egestas ornare.
                                            </div>
                                            <div class="clear"></div>
                                        </div><!-- .comments -->



                                    </div><!-- .post_comments -->

                                    <div class="clear"></div>      


                                    <div class="comment_form">
                                        <div class="title_content">
                                            <div class="text_content">Leave A Comment</div>
                                            <div class="clear"></div>
                                        </div>


                                        <form method="post" id="comment_form">
                                            <p class="form-group" id="contact-name">
                                                <label for="name">Your Name</label>
                                                <input type="text" name="name" class="form-control" id="inputSuccess" placeholder="Name*...">
                                            </p>
                                            <p class="form-group" id="contact-email"> 
                                                <label for="email">Your Email</label>
                                                <input type="text" name="email" class="form-control" id="inputSuccess" placeholder="Email*...">
                                            </p>

                                            <p class="form-group" id="contact-message">
                                                <label for="message">Your Message</label>
                                                <textarea name="message" cols="88" rows="6" class="form-control" id="inputError" placeholder="Your Comment..."></textarea>
                                            </p>
                                            <input type="reset" name="reset" value="CLEAR" class="reset">
                                            <!--<input type="submit" name="submit" value="Post Comment" class="submit">-->
                                            <button class="submit" data-toggle="modal" data-target=".bs-example-modal-sm">Post Comment</button>
                                        </form>                        
                                        <div class="clear"></div>

                                    </div>
                                </div>



                                <div class="col-md-12" style="margin-top: 20px;">
                                    <a href="#post-2" class="readmore" id="pagination"><i class="glyphicon glyphicon-chevron-right"></i></a>
                                    <a href="#" class="readmore disabled" id="pagination"><i class="glyphicon glyphicon-chevron-left"></i></a>
                                    <a href="#blog" class="readmore"><i class="glyphicon glyphicon-chevron-left"></i> All Posts</a>
                                </div>

                                <div class="clear"></div>

                        </article>
                    </div>
                    <div class="clear"></div>
                </div>
            </section>
            <!-- End Page Blog - Post 1 -->

            <!-- Page Blog - Post 2 -->
            <section id="post-2-page" class="content-post" style="display: none">
                <div class="row inner">

                    <div class="col-md-12" style="width: 100%;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;float: left;background: rgba(255, 255, 255, 0.8);padding-bottom: 15px;padding-top: 15px;">

                        <article class="postPage">

                            <div class="col-md-12 post_media">

                                <div class="post-format-icon">
                                    <a href="#" class="item-date"><span class="fa fa-pencil"></span></a>
                                </div>

                            </div>

                            <div class="title_content">
                                <div class="text_content">BLOG ASIDE POST</div>
                                <div class="clear"></div>
                            </div>


                            <p class="caps">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with.</p>

                            <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.</p>

                            <div class="col-md-12 first">
                                <div class="info">
                                    <div>
                                        <span class="tag">#php</span>
                                        <span class="tag">#web</span>
                                        <span class="tag">#web design</span>
                                    </div>


                                    <ul class="info-post">
                                        <li><i class="glyphicon glyphicon-comment"></i> 2 Comments</li>
                                        <li><i class="glyphicon glyphicon-time"></i> January 31, 2014</li>
                                        <li><i class="glyphicon glyphicon-user"></i> by Jane Doe</li>
                                        <li><i class="glyphicon glyphicon-tag"></i> php, web design</li>
                                    </ul>
                                </div>

                                <div class="clear"></div>      


                                <div class="about_author">
                                    <div class="title_content" style="margin-bottom:10px">
                                        <div class="text_content">BILL GATES</div>
                                        <div class="clear"></div>
                                    </div>

                                    <div class="clear"></div>


                                    <div class="prg_content">
                                        <img src="https://placehold.it/100x100" width="100" height="100" alt="img">

                                        <div class="text">
                                            Lorem ipsum dolor sit amet, consectetur
                                            adipiscing elit. Praesent condimentum sed elit
                                            vitae tristique. Aliquam erat volutpat. Nunc sit
                                            amet cursus libero. In fringilla egestas ornare.
                                        </div>

                                        <div class="nb_post" style="margin-top: 10px;">
                                            <b id="nb_post"> 15 posts</b> created by author
                                        </div>
                                    </div>

                                    <div class="clear"></div>
                                </div>

                                <div class="clear"></div>      


                                <div class="post_comments">

                                    <div class="title_content">
                                        <div class="text_content">7 Comments</div>
                                        <div class="clear"></div>
                                    </div>

                                    <div class="clear"></div>

                                    <div class="comments">

                                        <div class="comment">
                                            <img src="https://placehold.it/100x100" width="100" height="100" alt="img" />
                                            <div class="text">
                                                <div class="name">John Doe <a class="reply" href="#">Reply</a></div>
                                                <div class="date">12, September, 2013</div>
                                                Lorem ipsum dolor sit amet, consectetur
                                                adipiscing elit. Praesent condimentum sed elit
                                                vitae tristique. Aliquam erat volutpat. Nunc sit
                                                amet cursus libero. In fringilla egestas ornare.
                                            </div>
                                            <div class="comment sub">
                                                <img src="https://placehold.it/100x100" width="100" height="100" alt="img" />
                                                <div class="text">
                                                    <div class="name">Bill Gates <a class="reply" href="#">Reply</a></div>
                                                    <div class="date">12, September, 2013</div>
                                                    Lorem ipsum dolor sit amet, consectetur
                                                    adipiscing elit. Praesent condimentum sed elit
                                                    vitae tristique. Aliquam erat volutpat. Nunc sit
                                                    amet cursus libero. In fringilla egestas ornare.
                                                </div>
                                                <div class="clear"></div>
                                            </div>
                                            <div class="clear"></div>
                                        </div><!-- .comments -->

                                        <div class="comment">
                                            <img src="https://placehold.it/100x100" width="100" height="100" alt="img" />
                                            <div class="text">
                                                <div class="name">John Smith <a class="reply" href="#">Reply</a></div>
                                                <div class="date">12, September, 2013</div>
                                                Lorem ipsum dolor sit amet, consectetur
                                                adipiscing elit. Praesent condimentum sed elit
                                                vitae tristique. Aliquam erat volutpat. Nunc sit
                                                amet cursus libero. In fringilla egestas ornare.
                                            </div>
                                            <div class="comment sub">
                                                <img src="https://placehold.it/100x100" width="100" height="100" alt="img" />
                                                <div class="text">
                                                    <div class="name">Bill Gates <a class="reply" href="#">Reply</a></div>
                                                    <div class="date">12, September, 2013</div>
                                                    Lorem ipsum dolor sit amet, consectetur
                                                    adipiscing elit. Praesent condimentum sed elit
                                                    vitae tristique. Aliquam erat volutpat. Nunc sit
                                                    amet cursus libero. In fringilla egestas ornare.
                                                </div>
                                                <div class="clear"></div>
                                            </div>
                                            <div class="clear"></div>
                                        </div><!-- .comments -->

                                        <div class="comment">
                                            <img src="https://placehold.it/100x100" width="100" height="100" alt="img" />
                                            <div class="text">
                                                <div class="name">Andrian Robert <a class="reply" href="#">Reply</a></div>
                                                <div class="date">12, September, 2013</div>
                                                Lorem ipsum dolor sit amet, consectetur
                                                adipiscing elit. Praesent condimentum sed elit
                                                vitae tristique. Aliquam erat volutpat. Nunc sit
                                                amet cursus libero. In fringilla egestas ornare.
                                            </div>
                                            <div class="comment sub">
                                                <img src="https://placehold.it/100x100" width="100" height="100" alt="img" />
                                                <div class="text">
                                                    <div class="name">Bill Gates <a class="reply" href="#">Reply</a></div>
                                                    <div class="date">12, September, 2013</div>
                                                    Lorem ipsum dolor sit amet, consectetur
                                                    adipiscing elit. Praesent condimentum sed elit
                                                    vitae tristique. Aliquam erat volutpat. Nunc sit
                                                    amet cursus libero. In fringilla egestas ornare.
                                                </div>
                                                <div class="clear"></div>
                                            </div>
                                            <div class="clear"></div>
                                        </div><!-- .comments -->

                                        <div class="comment">
                                            <img src="https://placehold.it/100x100" width="100" height="100" alt="img" />
                                            <div class="text">
                                                <div class="name">Andrian Robert <a class="reply" href="#">Reply</a></div>
                                                <div class="date">12, September, 2013</div>
                                                Lorem ipsum dolor sit amet, consectetur
                                                adipiscing elit. Praesent condimentum sed elit
                                                vitae tristique. Aliquam erat volutpat. Nunc sit
                                                amet cursus libero. In fringilla egestas ornare.
                                            </div>
                                            <div class="clear"></div>
                                        </div><!-- .comments -->



                                    </div><!-- .post_comments -->

                                    <div class="clear"></div>      


                                    <div class="comment_form">

                                        <div class="title_content">
                                            <div class="text_content">Leave A Comment</div>
                                            <div class="clear"></div>
                                        </div>


                                        <form method="post" id="comment_form">
                                            <p class="form-group" id="contact-name">
                                                <label for="name">Your Name</label>
                                                <input type="text" name="name" class="form-control" id="inputSuccess" placeholder="Name*...">
                                            </p>
                                            <p class="form-group" id="contact-email"> 
                                                <label for="email">Your Email</label>
                                                <input type="text" name="email" class="form-control" id="inputSuccess" placeholder="Email*...">
                                            </p>

                                            <p class="form-group" id="contact-message">
                                                <label for="message">Your Message</label>
                                                <textarea name="message" cols="88" rows="6" class="form-control" id="inputError" placeholder="Your Comment..."></textarea>
                                            </p>
                                            <input type="reset" name="reset" value="CLEAR" class="reset">
                                            <!--<input type="submit" name="submit" value="Post Comment" class="submit">-->
                                            <button class="submit" data-toggle="modal" data-target=".bs-example-modal-sm">Post Comment</button>
                                        </form>                        
                                        <div class="clear"></div>

                                    </div>
                                </div>



                                <div class="col-md-12"  style="margin-top: 20px;">
                                    <a href="#post-3" class="readmore" id="pagination"><i class="glyphicon glyphicon-chevron-right"></i></a>
                                    <a href="#post-1" class="readmore" id="pagination"><i class="glyphicon glyphicon-chevron-left"></i></a>
                                    <a href="#blog" class="readmore"><i class="glyphicon glyphicon-chevron-left"></i> All Posts</a>
                                </div>

                                <div class="clear"></div>

                        </article>
                    </div>
                    <div class="clear"></div>
                </div>
            </section>
            <!-- End Page Blog - Post 2 -->

            <!-- Page Blog - Post 3 -->
            <section id="post-3-page" class="content-post" style="display: none">
                <div class="row inner">

                    <div class="col-md-12" style="width: 100%;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;float: left;background: rgba(255, 255, 255, 0.8);padding-bottom: 15px;padding-top: 15px;">

                        <article class="postPage">


                            <div class="col-md-12 post_media">

                                <div class="post-format-icon">
                                    <a href="#" class="item-date"><span class="fa fa-picture-o"></span></a>
                                </div>

                                <div class="media">
                                    <div class="he-wrap tpl2">
                                        <img src="images/blog/blog-2.jpg" class="img-hover" alt="">
                                    </div>

                                </div>
                            </div>

                            <div class="title_content">
                                <div class="text_content">BLOG POST IMAGE</div>
                                <div class="clear"></div>
                            </div>


                            <p class="caps">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with.</p>

                            <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.</p>

                            <div class="col-md-12 first">
                                <div class="info">
                                    <div>
                                        <span class="tag">#php</span>
                                        <span class="tag">#web</span>
                                        <span class="tag">#web design</span>
                                    </div>


                                    <ul class="info-post">
                                        <li><i class="glyphicon glyphicon-comment"></i> 2 Comments</li>
                                        <li><i class="glyphicon glyphicon-time"></i> January 31, 2014</li>
                                        <li><i class="glyphicon glyphicon-user"></i> by Jane Doe</li>
                                        <li><i class="glyphicon glyphicon-tag"></i> Photoshop</li>
                                    </ul>
                                </div>

                                <div class="clear"></div>      


                                <div class="about_author">
                                    <div class="title_content" style="margin-bottom:10px">
                                        <div class="text_content">BILL GATES</div>
                                        <div class="clear"></div>
                                    </div>

                                    <div class="clear"></div>


                                    <div class="prg_content">
                                        <img src="https://placehold.it/100x100" width="100" height="100" alt="img">

                                        <div class="text">
                                            Lorem ipsum dolor sit amet, consectetur
                                            adipiscing elit. Praesent condimentum sed elit
                                            vitae tristique. Aliquam erat volutpat. Nunc sit
                                            amet cursus libero. In fringilla egestas ornare.
                                        </div>

                                        <div class="nb_post" style="margin-top: 10px;">
                                            <b id="nb_post"> 15 posts</b> created by author
                                        </div>
                                    </div>

                                    <div class="clear"></div>
                                </div>

                                <div class="clear"></div>      


                                <div class="post_comments">

                                    <div class="title_content">
                                        <div class="text_content">7 Comments</div>
                                        <div class="clear"></div>
                                    </div>

                                    <div class="clear"></div>

                                    <div class="comments">

                                        <div class="comment">
                                            <img src="https://placehold.it/100x100" width="100" height="100" alt="img" />
                                            <div class="text">
                                                <div class="name">John Doe <a class="reply" href="#">Reply</a></div>
                                                <div class="date">12, September, 2013</div>
                                                Lorem ipsum dolor sit amet, consectetur
                                                adipiscing elit. Praesent condimentum sed elit
                                                vitae tristique. Aliquam erat volutpat. Nunc sit
                                                amet cursus libero. In fringilla egestas ornare.
                                            </div>
                                            <div class="comment sub">
                                                <img src="https://placehold.it/100x100" width="100" height="100" alt="img" />
                                                <div class="text">
                                                    <div class="name">Bill Gates <a class="reply" href="#">Reply</a></div>
                                                    <div class="date">12, September, 2013</div>
                                                    Lorem ipsum dolor sit amet, consectetur
                                                    adipiscing elit. Praesent condimentum sed elit
                                                    vitae tristique. Aliquam erat volutpat. Nunc sit
                                                    amet cursus libero. In fringilla egestas ornare.
                                                </div>
                                                <div class="clear"></div>
                                            </div>
                                            <div class="clear"></div>
                                        </div><!-- .comments -->

                                        <div class="comment">
                                            <img src="https://placehold.it/100x100" width="100" height="100" alt="img" />
                                            <div class="text">
                                                <div class="name">John Smith <a class="reply" href="#">Reply</a></div>
                                                <div class="date">12, September, 2013</div>
                                                Lorem ipsum dolor sit amet, consectetur
                                                adipiscing elit. Praesent condimentum sed elit
                                                vitae tristique. Aliquam erat volutpat. Nunc sit
                                                amet cursus libero. In fringilla egestas ornare.
                                            </div>
                                            <div class="comment sub">
                                                <img src="https://placehold.it/100x100" width="100" height="100" alt="img" />
                                                <div class="text">
                                                    <div class="name">Bill Gates <a class="reply" href="#">Reply</a></div>
                                                    <div class="date">12, September, 2013</div>
                                                    Lorem ipsum dolor sit amet, consectetur
                                                    adipiscing elit. Praesent condimentum sed elit
                                                    vitae tristique. Aliquam erat volutpat. Nunc sit
                                                    amet cursus libero. In fringilla egestas ornare.
                                                </div>
                                                <div class="clear"></div>
                                            </div>
                                            <div class="clear"></div>
                                        </div><!-- .comments -->

                                        <div class="comment">
                                            <img src="https://placehold.it/100x100" width="100" height="100" alt="img" />
                                            <div class="text">
                                                <div class="name">Andrian Robert <a class="reply" href="#">Reply</a></div>
                                                <div class="date">12, September, 2013</div>
                                                Lorem ipsum dolor sit amet, consectetur
                                                adipiscing elit. Praesent condimentum sed elit
                                                vitae tristique. Aliquam erat volutpat. Nunc sit
                                                amet cursus libero. In fringilla egestas ornare.
                                            </div>
                                            <div class="comment sub">
                                                <img src="https://placehold.it/100x100" width="100" height="100" alt="img" />
                                                <div class="text">
                                                    <div class="name">Bill Gates <a class="reply" href="#">Reply</a></div>
                                                    <div class="date">12, September, 2013</div>
                                                    Lorem ipsum dolor sit amet, consectetur
                                                    adipiscing elit. Praesent condimentum sed elit
                                                    vitae tristique. Aliquam erat volutpat. Nunc sit
                                                    amet cursus libero. In fringilla egestas ornare.
                                                </div>
                                                <div class="clear"></div>
                                            </div>
                                            <div class="clear"></div>
                                        </div><!-- .comments -->

                                        <div class="comment">
                                            <img src="https://placehold.it/100x100" width="100" height="100" alt="img" />
                                            <div class="text">
                                                <div class="name">Andrian Robert <a class="reply" href="#">Reply</a></div>
                                                <div class="date">12, September, 2013</div>
                                                Lorem ipsum dolor sit amet, consectetur
                                                adipiscing elit. Praesent condimentum sed elit
                                                vitae tristique. Aliquam erat volutpat. Nunc sit
                                                amet cursus libero. In fringilla egestas ornare.
                                            </div>
                                            <div class="clear"></div>
                                        </div><!-- .comments -->



                                    </div><!-- .post_comments -->

                                    <div class="clear"></div>      


                                    <div class="comment_form">

                                        <div class="title_content">
                                            <div class="text_content">Leave A Comment</div>
                                            <div class="clear"></div>
                                        </div>


                                        <form method="post" id="comment_form">
                                            <p class="form-group" id="contact-name">
                                                <label for="name">Your Name</label>
                                                <input type="text" name="name" class="form-control" id="inputSuccess" placeholder="Name*...">
                                            </p>
                                            <p class="form-group" id="contact-email"> 
                                                <label for="email">Your Email</label>
                                                <input type="text" name="email" class="form-control" id="inputSuccess" placeholder="Email*...">
                                            </p>

                                            <p class="form-group" id="contact-message">
                                                <label for="message">Your Message</label>
                                                <textarea name="message" cols="88" rows="6" class="form-control" id="inputError" placeholder="Your Comment..."></textarea>
                                            </p>
                                            <input type="reset" name="reset" value="CLEAR" class="reset">
                                            <!--<input type="submit" name="submit" value="Post Comment" class="submit">-->
                                            <button class="submit" data-toggle="modal" data-target=".bs-example-modal-sm">Post Comment</button>
                                        </form>                        
                                        <div class="clear"></div>

                                    </div>
                                </div>


                                <div class="col-md-12" style="margin-top: 20px;">
                                    <a href="#" class="readmore disabled" id="pagination"><i class="glyphicon glyphicon-chevron-right"></i></a>
                                    <a href="#post-2" class="readmore" id="pagination"><i class="glyphicon glyphicon-chevron-left"></i></a>
                                    <a href="#blog" id="blog" class="readmore"><i class="glyphicon glyphicon-chevron-left"></i> All Posts</a>
                                </div>

                                <div class="clear"></div>

                        </article>
                    </div>
                    <div class="clear"></div>
                </div>
            </section>
            <!-- End Page Blog - Post 3 -->


        </div>


        <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h3 class="modal-title h3_modal" style="color: #fff !important;">Responsive Template</h3>
                    </div>
                    <div class="modal-body">
                        <p>An impressive and professional online vcard, a beautiful portfolio with sliding effect, resume and contact information with Google map.</p>
                        <p>It’s simple! Just download and install in a few minutes, you can show your online card to your friend, customer or employer in an interview by phone or tablet. Because this is a responsive template, you can view your website on pc as well as handheld devices. You can also link to your social profiles, display your portfolio in many media format such as image, youtube video, flash...</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
                                            </div>
                                            <!-- End .blog -->

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
                                                            <div class="text_content">Let's keep in touch</div>
                                                            <div class="clear"></div>
                                                        </div>

                                                        <div class="contact-form">
                                                            <!--<h3 class="main-heading"><span>Let's keep in touch</span></h3>-->



                                                            <div id="contact-status"></div>

                                                            <form action="#" id="contactform">
                                                                <p class="form-group" id="contact-name">
                                                                    <label for="name">Your Name</label>
                                                                    <input type="text" name="name" class="form-control name-contact" id="inputSuccess" placeholder="Name..." />
                                                                </p>
                                                                <p class="form-group" id="contact-email"> 
                                                                    <label for="email">Your Email</label>
                                                                    <input type="text" name="email" class="form-control email-contact" id="inputSuccess" placeholder="Email..." />
                                                                </p>

                                                                <p class="form-group" id="contact-message">
                                                                    <label for="message">Your Message</label>
                                                                    <textarea name="message" cols="88" rows="6" class="form-control message-contact" id="inputError" placeholder="Message..."></textarea>
                                                                </p>
                                                                <input type="reset" name="reset" value="CLEAR" class="reset">
                                                                <!-- <input type="submit" name="submit" value="SEND MESSAGE" class="submit">-->

                                                                <section class="button-demo" style="display: inline-block;">
                                                                    <button class="ladda-button submit send_email" name="submit" data-color="green" data-style="expand-left">SEND MESSAGE</button>
                                                                </section>

                                                            </form>
                                                        </div>
                                                        <!-- /Contact Form -->
                                                    </div>
                                                </div>
                                            </div>  



                                        </div>                                            </div>
                                            <!-- End .contact -->

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

        <?php /*<!-- Switcher -->
        <div id="custumize-style">
            <h2>Style Selector<a href="#" class="switcher"><i class="fa fa-cogs icon-switcher"></i></a></h2>
            <div>
                <h3>Theme Color</h3>
                <ul class="colors-style" id="color1">

                    <li><a href="#" class="gray"></a></li>
                    <li><a href="#" class="green"></a></li>
                    <li><a href="#" class="blue"></a></li>
                    <li><a href="#" class="red"></a></li>
                    <li><a href="#" class="yellow"></a></li>

                    <li><a href="#" class="DarkBlue"></a></li>
                    <li><a href="#" class="orange"></a></li>
                    <li><a href="#" class="rose"></a></li>
                    <li><a href="#" class="lightseagreen"></a></li>
                    <li><a href="#" class="darkolivegreen"></a></li>

                </ul>
            </div>
            <div> 

                <h3 class="layouts">Profile Image</h3>
                <div id="show">

                    <div class="clean-check">

                        <input type="radio" id="r1" name="style_profile" value="style_profile_1" checked="checked" />
                        <label for="r1"><span></span>Rotating image</label>

                        <input type="radio" id="r2" name="style_profile" value="style_profile_2" />
                        <label for="r2"><span></span>Fixed image</label>

                    </div>
                </div>


                
                <h3 class="layouts">Page Builder</h3>
                <div id="show">
                    <div class="clean-check" style="padding-left: 30px;">

                        <input type="radio" id="pb1" name="page_builder" value="index.html"  checked />
                        <label for="pb1"><span></span>Style 1</label>

                        <input type="radio" id="pb2" name="page_builder" value="page-builder-2.html"  />
                        <label for="pb2"><span></span>Style 2</label>

                        <input type="radio" id="pb3" name="page_builder" value="page-builder-3.html"  />
                        <label for="pb3"><span></span>Style 3</label>

                        <input type="radio" id="pb4" name="page_builder" value="page-builder-4.html"  />
                        <label for="pb4"><span></span>Style 4</label>
                    </div>
                </div>      

                <h3 class="layouts">Page Animation</h3>
                <div id="show">

                    <select name="one" class="dropdown-select">
                        <optgroup label="Bouncing Entrances">
                            <option value="bounceIn" selected>bounceIn</option>
                            <option value="bounceInDown">bounceInDown</option>
                            <option value="bounceInLeft">bounceInLeft</option>
                            <option value="bounceInRight">bounceInRight</option>
                            <option value="bounceInUp">bounceInUp</option>
                        </optgroup>

                        <optgroup label="Fading Entrances">
                            <option value="fadeIn">fadeIn</option>
                            <option value="fadeInDown">fadeInDown</option>
                            <option value="fadeInLeft">fadeInLeft</option>
                            <option value="fadeInRight">fadeInRight</option>
                            <option value="fadeInUp">fadeInUp</option>
                        </optgroup>      
                    </select>

                </div>

                <h3 class="layouts" style="padding-top:5px">Background Style</h3>
                <div id="show">

                    <div class="clean-check">

						<input type="radio" id="s1" name="layout" value="bg_color" checked="checked" />
                        <label for="s1"><span></span>Color</label>
                        
                        <input type="radio" id="s2" name="layout" value="bg_slider" />
                        <label for="s2"><span></span>Slider</label>

                    </div>

                </div>

            </div>

            <div> 
                <h3>Background Color</h3>
                <ul class="colors-style bgsolid" id="bgsolid">
                    <li><a href="#" class="gray-bg"></a></li>
                    <li><a href="#" class="green-bg"></a></li>
                    <li><a href="#" class="blue-bg"></a></li>
                    <li><a href="#" class="red-bg"></a></li>
                    <li><a href="#" class="yellow-bg"></a></li>
                </ul>
            </div> 

            <div>  
                <h3>Background Image</h3>
                <ul class="colors-style bg" id="bg">
                    <li><a href="#" class="bg1"></a></li>
                    <li><a href="#" class="bg2"></a></li>
                    <li><a href="#" class="bg3"></a></li>
                    <li><a href="#" class="bg4"></a></li>
                    <li><a href="#" class="bg5"></a></li>
                </ul>
            </div>

            <div id="button-reset"><a href="#" class="button color blue boxed">Reset</a></div>
        </div>
        <!-- End Switcher -->*/ ?>



        <!-- jquery | jQuery 1.11.0 -->
        <!-- Credits: http://jquery.com -->
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
 		
        <!-- Js | bootstrap -->
        <!-- Credits: http://getbootstrap.com/ -->
        <script type="text/javascript" src="js/bootstrap.min.js"></script> 
        
        <!-- Js | jquery.cycle -->
        <!-- Credits: https://github.com/malsup/cycle2 -->
        <script type="text/javascript" src="js/jquery.cycle2.min.js"></script>
        
        <!-- jquery | rotate and portfolio -->
        <!-- Credits: http://jquery.com -->
        <script type="text/javascript" src="js/jquery.mixitup.min.js"></script> 
        <?php /*<script type="text/javascript" src="js/HeadImage.js"></script>*/ ?>

        <!-- Js | easyResponsiveTabs -->
        <!-- Credits: http://webtrendset.com/demo/easy-responsive-tabs/Index.html -->
        <script type="text/javascript" src="js/easyResponsiveTabs.min.js"></script>

        <!-- Js | jquery.cookie -->
        <!-- Credits: https://github.com/carhartl/jquery-cookie -->
        <!-- <script type="text/javascript" src="js/jsSwitcher/jquery.cookie.js"></script> -->

        <!-- Js | switcher -->
        <!-- <script type="text/javascript" src="js/jsSwitcher/switcher.js"></script> -->

        <!-- Js | mCustomScrollbar -->
        <!-- Credits: http://manos.malihu.gr/jquery-custom-content-scroller -->
        <script type="text/javascript" src="js/jquery.mCustomScrollbar.concat.min.js"></script>		

        <!-- jquery | prettyPhoto -->
        <!-- Credits: http://www.no-margin-for-errors.com/ -->
        <script type="text/javascript" src="js/jquery.prettyPhoto.js"></script>
        
        <!-- Js | gmaps -->
        <!-- Credits: http://maps.google.com/maps/api/js?sensor=true-->
        <?php /*<script type="text/javascript" src="https://maps.google.com/maps/api/js?sensor=true"></script>
        <script type="text/javascript" src="js/gmaps.min.js"></script>*/ ?>

 		<!-- Js | Js -->
        <script type="text/javascript" src="js/main.js"></script>
        
        <!-- code js for image rotate -->
        <script type="text/javascript">
            (function () {
                var mouseX;
                var mouseY;
                var imageOne;

                /* Calling the initialization function */
                $(init);

                /* The images need to re-initialize on load and on resize, or else the areas
                 * where each image is displayed will be wrong. */
                $(window).load(init);
                $(window).resize(init);

                /* Setting the mousemove event caller */
                $(window).mousemove(getMousePosition);

                /* This function is called on document ready, on load and on resize
                 * and initiallizes all the images */
                function init() {

                    /* Instanciate the mouse position variables */
                    mouseX = 0;
                    mouseY = 0;

                    /* Instanciate a HeadImage class for every image */
                    imageOne = new HeadImage("one");

                }

                /* This function is called on mouse move and gets the mouse position.
                 * It also calls the HeadImage function to display the correct image*/
                function getMousePosition(event) {

                    /* Setting the mouse position variables */
                    mouseX = event.pageX;
                    mouseY = event.pageY;

                    /*Calling the setImageDirection function of the HeadImage class
                     * to display the correct image*/
                    imageOne.setImageDirection();

                }
            })/*()*/;
        </script>


        <!--[if lt IE 9]>
            <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

        <script type="text/javascript">
            $(function () {
                //console.log($("#verticalTab div.resp-tabs-container h2"));

                // hide some unused tabs (for mobile mode)
                $("#verticalTab div.resp-tabs-container h2").eq(1).hide();
                $("#verticalTab div.resp-tabs-container h2").eq(2).hide();
                $("#verticalTab div.resp-tabs-container h2").eq(3).hide();
            });
        </script>

    </body>
</html>