<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="chanry">
    <meta name="author" content="This site is made for petition validation">
    <title>AppEcho</title>
    <!-- main css -->
    <link rel="stylesheet" href="<?php echo HTTP_BOOTSTRAP_PATH; ?>css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo HTTP_CSS_PATH; ?>style.css">
    
    <link rel="stylesheet" href="<?php echo HTTP_CSS_PATH; ?>responsive.css">
    <link rel="stylesheet" href="<?php echo HTTP_CSS_PATH; ?>themes/red.css">
    <link rel="shortcut icon" href="favicon.ico">        
    <!-- CSS Implementing Plugins -->    
    <link rel="stylesheet" href="<?php echo HTTP_PLUGIN_PATH; ?>font-awesome/css/font-awesome.css">
    
    <!-- CSS Theme -->    
<!--     <link rel="stylesheet" href="/assets/css/themes/orange.css" id="style_color"> -->
<!--     <link rel="stylesheet" href="/assets/css/themes/headers/header1-orange.css" id="style_color-header-1"> -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">	
  	<!-- JS Global Compulsory -->			
	<script type="text/javascript" src="<?php echo HTTP_PLUGIN_PATH; ?>jquery-1.10.2.min.js"></script>
	<script type="text/javascript" src="<?php echo HTTP_PLUGIN_PATH; ?>jquery-migrate-1.2.1.min.js"></script>
	<script type="text/javascript" src="<?php echo HTTP_BOOTSTRAP_PATH; ?>js/bootstrap.min.js"></script> 
	<script type="text/javascript" src="<?php echo HTTP_PLUGIN_PATH; ?>hover-dropdown.min.js"></script> 
	<script type="text/javascript" src="<?php echo HTTP_PLUGIN_PATH; ?>back-to-top.js"></script>
	<script type="text/javascript" src="<?php echo HTTP_JS_PATH; ?>jquery.form.js"></script>
	<!-- JS Implementing Plugins -->           
	
	<!-- JS Page Level -->           
	<script type="text/javascript" src="<?php echo HTTP_JS_PATH; ?>app.js"></script>
  	<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
  	
  	<script src="<?php echo HTTP_JS_PATH; ?>jquery.validate.js"></script>
	<link type="text/css" rel="stylesheet" href="<?php echo HTTP_CSS_PATH; ?>datatables/dataTables.bootstrap.css">
	<script src="<?php echo HTTP_JS_PATH; ?>jquery.dataTables.js"></script>    
	<script src="<?php echo HTTP_JS_PATH; ?>dataTables.bootstrap.js"></script>
	<script src="<?php echo HTTP_JS_PATH; ?>table-managed-tables.js"></script>

	<!--[if lt IE 9]>-->
	    <script src="<?php echo HTTP_PLUGIN_PATH; ?>respond.js"></script>
    <!-- jquery spin js(loading bar)  -->
    <script src="http://fgnass.github.io/spin.js/spin.js"></script>
    
    
    
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&language=en&sensor=true&libraries=places&libraries=weather"></script>
  </head>
<body class="boxed-layout container">
<!--=== Top ===-->    
<div class="wrapper">
    <!--=== Header ===-->    
    <div class="header">
        <!--topbar-->
        <div class="topbar">
            <div class="container">         
                <ul class="loginbar pull-right">
                   <?php if (!$this->session->userdata('IS_FRONT_LOGIN')) {?>
                    <li>
                        <a href="<?php echo base_url();?>user/login" class="dropdown-toggle" data-delay="0" data-close-others="false">
                            Log in
                        </a>
                    </li>
                    <?php } else {?>
                    <li>
                        <a href="<?php echo base_url(); ?>user/edit_profile" class="dropdown-toggle" style="text-transform:inherit;">
                        <?php
                             echo $this->session->userdata('USER_EMAIL');
                             if ($this->session->userdata('USER_TYPE') == '0')
                                 echo " (User)";
                             else echo  " (Developer)";
                        ?>
                        </a>
                    </li>
                    <li class="topbar-devider"></li>
                    <li>
                        <a href="<?php echo base_url()?>user/logout" class="dropdown-toggle" data-delay="0" data-close-others="false">
                            Log Out
                        </a>
                    </li>
                    <?php }?> 
                </ul>
            </div>      
        </div><!--/topbar-->
         <!-- Navbar -->
        <div class="navbar navbar-default" role="navigation">
          <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
              <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="fa fa-bars"></span>
                </button>
                <a class="navbar-brand" href="/">
                    <img id="logo-header" src="<?php echo base_url(); ?>assets/img/logo.jpg" alt="Logo" style="margin-top: -20px;">
                </a>
              </div>
              
               <!-- Collect the nav links, forms, and other content for toggling -->
              <div class="collapse navbar-collapse navbar-responsive-collapse">
                  <ul class="nav navbar-nav">
                      <!-- Home -->
                      <li class="<?php if ($pageType == "home") echo 'active';?>">
                          <a href="<?php echo base_url();?>">
                                Home
                          </a>
                      </li>
                     <!-- <li class="<?php // if ($pageType == "comments") echo 'active';?>">
                          <a href="<?php echo base_url();?>application/index">
                                Comments
                          </a>
                      </li> -->
                      <?php if ($this->session->userdata('USER_TYPE') == '1' && $this->session->userdata('IS_FRONT_LOGIN')) {?>
                      <li  class="<?php if ($pageType == "add_application") echo 'active';?>">
                          <a href="<?php echo base_url()?>application/add">
                                Add Application
                          </a>
                      </li>
                      <?php }?>
                    </ul>    
              </div>        
          </div>    
       </div> 
        <!-- End Navbar -->
    </div>
    <!--=== End header ===-->    
