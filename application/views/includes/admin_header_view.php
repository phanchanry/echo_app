<!DOCTYPE html>
<html lang="en">
<head><title>Admin | Take5</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewpoint" content="width=device-width, initial-scale=1.0">
    <!--Loading bootstrap css-->
    <link type="text/css" rel="stylesheet"
          href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,800italic,400,700,800">
    <link type="text/css" rel="stylesheet" href="<?php echo HTTP_CSS_PATH_ADMIN; ?>jquery-ui-1.10.3.custom.css">
    <link type="text/css" rel="stylesheet" href="<?php echo HTTP_CSS_PATH_ADMIN; ?>font-awesome/css/font-awesome.min.css">
    <link type="text/css" rel="stylesheet" href="<?php echo HTTP_BOOTSTRAP_PATH; ?>admin/css/bootstrap.min.css">
    
    <!--Loading style vendors-->
    <link type="text/css" rel="stylesheet" href="<?php echo HTTP_CSS_PATH_ADMIN; ?>animate.css">
    
    <!--Loading style-->
    <link type="text/css" rel="stylesheet" href="<?php echo HTTP_CSS_PATH_ADMIN; ?>style-flatomic-ui.css">
    <link type="text/css" rel="stylesheet" href="<?php echo HTTP_CSS_PATH_ADMIN; ?>style.css">
    <link type="text/css" rel="stylesheet" href="<?php echo HTTP_CSS_PATH_ADMIN; ?>style-responsive.css">
    <link type="text/css" rel="stylesheet" href="<?php echo HTTP_CSS_PATH_ADMIN; ?>vendors.css">
    <link type="text/css" rel="stylesheet" href="<?php echo HTTP_CSS_PATH_ADMIN; ?>themes/default.css" id="color-style">
<!--     <link rel="shortcut icon" href="images/favicon.ico"> -->
    
    <!-- JavaScript
    ================================================== -->
    <script async="" src="//www.google-analytics.com/analytics.js"></script>
    <script src="<?php echo HTTP_JS_PATH_ADMIN; ?>animation.js"></script>
    <script src="<?php echo HTTP_JS_PATH_ADMIN; ?>full-page-animation/Animations.js"></script>
    <script src="<?php echo HTTP_JS_PATH_ADMIN; ?>full-page-animation/Detection.js"></script>
    <script src="<?php echo HTTP_JS_PATH_ADMIN; ?>jquery-1.10.2.min.js"></script>
    <script src="<?php echo HTTP_JS_PATH_ADMIN; ?>jquery-migrate-1.2.1.min.js"></script>
    <!--loading bootstrap js-->
    <script src="<?php echo HTTP_BOOTSTRAP_PATH; ?>admin/js/bootstrap.min.js"></script>
    <script src="<?php echo HTTP_BOOTSTRAP_PATH; ?>admin/js/bootstrap-hover-dropdown.js"></script>
    <!--loading general js-->
    <script src="<?php echo HTTP_JS_PATH_ADMIN; ?>html5shiv.js"></script>
    <script src="<?php echo HTTP_JS_PATH_ADMIN; ?>respond.min.js"></script>
    <script src="<?php echo HTTP_JS_PATH_ADMIN; ?>jquery-ui-1.10.3.custom.min.js"></script>
    <script src="<?php echo HTTP_JS_PATH_ADMIN; ?>jquery.menu.js"></script>
    <script src="<?php echo HTTP_JS_PATH; ?>jquery.form.js"></script>
    <script src="<?php echo HTTP_JS_PATH_ADMIN; ?>app.js"></script>
    <script src="<?php echo HTTP_JS_PATH_ADMIN; ?>main.js"></script>
    <script src="<?php echo HTTP_JS_PATH_ADMIN; ?>holder.js"></script>
    <!-- jquery spin js loading -->
    <script type="text/javascript">(function (i, s, o, g, r, a, m) {
        i['GoogleAnalyticsObject'] = r;
        i[r] = i[r] || function () {
            (i[r].q = i[r].q || []).push(arguments)
        }, i[r].l = 1 * new Date();
        a = s.createElement(o),
                m = s.getElementsByTagName(o)[0];
        a.async = 1;
        a.src = g;
        m.parentNode.insertBefore(a, m)
        })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');
        ga('create', 'UA-145464-11', 'next-themes.com');
        ga('send', 'pageview');
    </script>
</head>
<body>
    <div id="wrapper">
        <div id="topbar">
            <nav role="navigation" class="navbar navbar-inverse navbar-fixed-top">
                <!--Brand and toggle get grouped for better mobile display-->
                <div class="navbar-header">
                    <button type="button" data-toggle="collapse" data-target="#sidebar-menu" class="navbar-toggle"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span>
                    <span class="icon-bar"></span><span class="icon-bar"></span></button>
                    <!--Slide and Push Menus-->
                    <a id="menu-toogle" class="navbar-brand hidden-xs"><i class="fa fa-bars"></i></a>
                    <a href="/admin" class="navbar-brand">Petition Validator</a>
                </div>
             
                <ul id="quick-menu" class="nav navbar-nav pull-right"><!-- BEGIN NOTIFICATION DROPDOWN-->
                    <!-- BEGIN LANGUAGE DROPDOWN-->
                    <li id="topbar-user" class="dropdown"><a href="#" data-toggle="dropdown" data-close-others="true" class="dropdown-toggle"><i class="fa fa-user"></i>&nbsp;
                        <?php echo $this->session->userdata('ADMIN_EMAIL');?>
                        &nbsp;<i class="fa fa-angle-down"></i></a>
                        <ul class="dropdown-menu animated fadeInUp">
                            <li><a href="#"><i class="fa fa-user"></i>&nbsp;
                                Change Password</a></li>
                            <li><a href="/admin/home/logout"><i class="fa fa-key"></i>&nbsp;
                                Log Out</a></li>
                        </ul>
                    </li>
                    <!-- END USER DROPDOWN--><!-- BEGIN FULLSCREEN-->
                    <li id="topbar-fullscreen"><a href="javascript:void(0)" title="" class="btn-fullscreen"><i class="fa fa-arrows"></i></a></li>
                    <!-- END FULLSCREEN-->
                 </ul>
            </nav>
        </div>
        <div id="main-container" style="padding-top: 50px;">
            <div id="sidebar" class="show" style="width: 225px;">
                <div id="sidebar-menu">
                    <ul class="nav nav-list">
                        <li class="nav-header"><a href="<?php echo base_url();?>admin/home" class="<?php if ($pageType == "home") echo 'active'; ?>"><span class="icon"><i class="glyphicon glyphicon-home"></i></span>
                            <span class="content">User Management</span></a>
                        </li>
                        <li class="nav-header"><a href="<?php echo base_url()?>admin/question_manage" class="<?php if ($pageType == "question") echo 'active'; ?>"><span class="icon"><i class="glyphicon glyphicon-th-list"></i></span>
                            <span class="content">Question Management</span></a>
                        </li>
                        <!--  <li class="nav-header"><a href="#" class="<?php // if ($pageType == "petition_data") echo 'active'; ?>"><span class="icon"><i class="glyphicon glyphicon-edit"></i></span>-->
<!--                             <span class="content">Petition Data Management</span></a> -->
                            <!--  <ul id="nav-layouts" class="nav nav-list collapse submenu">-->
                                <!--<li><a class="<?php // if (isset($subpageType) && $subpageType == "sheets") echo 'active'; ?>" href="/admin/petition_data_manage/petition_sheets"><span class="icons"></span><span class="contents">Petition Sheets</span></a>  -->
                             <!--    </li> 
                            </ul> -->    
<!--                         </li> -->
                    </ul>
                </div>
            </div>
        </div>
    </div>        
</body>