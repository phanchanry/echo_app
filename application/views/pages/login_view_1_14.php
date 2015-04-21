<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="chanry">
    <meta name="author" content="This site is made for petition validation">
    <title>Echo App</title>
    <!-- main css -->
    <link rel="stylesheet" href="<?php echo HTTP_BOOTSTRAP_PATH; ?>css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo HTTP_CSS_PATH; ?>style.css">

    <link rel="stylesheet" href="<?php echo HTTP_CSS_PATH; ?>responsive.css">
    <link rel="stylesheet" href="<?php echo HTTP_CSS_PATH; ?>pages/page_log_reg_v2.css">
    <link rel="stylesheet" href="<?php echo HTTP_CSS_PATH; ?>themes/default.css">
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

	<!--[if lt IE 9]>-->
	    <script src="<?php echo HTTP_PLUGIN_PATH; ?>respond.js"></script>
    <!-- jquery spin js(loading bar)  -->
    <script src="http://fgnass.github.io/spin.js/spin.js"></script>
    <style>
        .input-group {
            width: 100%;
        }
        .input-group .input-icon {
            display: table;
        }
    </style>
</head>
<body>
    <div class="container">
        <!--Reg Block-->
        <div class="reg-block" style="margin: 20% auto;">
            <div class="reg-block-header">
                <h2>Login to your account</h2>
                <ul class="list-inline style-icons text-center">
                    <li><a href="<?php echo base_url();?>"><i class="fa fa-home icon-custom icon-sm rounded-x icon-color-grey"></i></a></li>
                </ul>
            </div>
            <?php print_r($this->session->flashdata('msg')); ?>
            <form id="loginForm" role="form">
                <div class="input-group margin-bottom-20">
                    <div class="input-icon"><span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                    <input type="text" name="email" class="form-control" placeholder="Your Email"></div>
                </div>
                <div class="input-group margin-bottom-20">
                    <div class="input-icon"><span class="input-group-addon"><i class="fa fa-lock"></i></span>
                    <input type="password" name="password" class="form-control" placeholder="Password"></div>
                </div>
            </form>
            <label class="input-group margin-bottom-20">
                <p>Not a member yet ? Please Click <a href="<?php echo base_url();?>user/register">here</a></p>
            </label>
            <hr>
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <a id="login" class="btn-u btn-block" style="text-align: center;">Log In</a>
                </div>
            </div>
        </div>
        <!--End Reg Block-->
    </div><!--/container-->
    <script type="text/javascript" src="<?php echo HTTP_PLUGIN_PATH; ?>countdown/jquery.countdown.js"></script>
    <script type="text/javascript" src="<?php echo HTTP_PLUGIN_PATH; ?>backstretch/jquery.backstretch.min.js"></script>
    <script type="text/javascript">
        $.backstretch([
          "<?php echo base_url(); ?>assets/img/bg/5.jpg",
          "<?php echo base_url(); ?>assets/img/bg/4.jpg",
          ], {
            fade: 1000,
            duration: 7000
        });
    </script>
    <!-- JS Page Level -->
    <script type="text/javascript">
        jQuery(document).ready(function() {
            App.init();
        });
    </script>
    <script type="text/javascript" src="<?php echo HTTP_JS_PATH; ?>jquery.validate.js"></script>
    <script src="<?php echo HTTP_JS_PATH; ?>pages/login.js"></script>
</body>
</html>