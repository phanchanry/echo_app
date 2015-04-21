<!DOCTYPE html>
<html lang="en">
<head><title>Login</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewpoint" content="width=device-width, initial-scale=1.0">
    <!--Loading bootstrap css-->
    <link type="text/css" rel="stylesheet" href="<?php echo HTTP_CSS_PATH_ADMIN; ?>font-awesome/css/font-awesome.min.css">
    <link type="text/css" rel="stylesheet" href="<?php echo HTTP_BOOTSTRAP_PATH; ?>admin/css/bootstrap.min.css">
    <!--Loading style vendors-->
   <link type="text/css" rel="stylesheet" href="<?php echo HTTP_CSS_PATH_ADMIN; ?>animate.css">
    <!--Loading style-->
    <link type="text/css" rel="stylesheet" href="<?php echo HTTP_CSS_PATH_ADMIN; ?>login.css">
    <link type="text/css" rel="stylesheet" href="<?php echo HTTP_CSS_PATH_ADMIN; ?>style.css">
    <link type="text/css" rel="stylesheet" href="<?php echo HTTP_CSS_PATH_ADMIN; ?>style-responsive.css">
    <link type="text/css" rel="stylesheet" href="<?php echo HTTP_CSS_PATH_ADMIN; ?>vendors.css">
    <link type="text/css" rel="stylesheet" href="<?php echo HTTP_CSS_PATH_ADMIN; ?>style-flatomic-ui.css" id="color-style">
    <link rel="shortcut icon" href="<?php echo HTTP_IMAGES_PATH; ?>images/favicon.ico">
</head>
<body id="login-page">
<div class="logo">Take5 Administrator</div>
<div class="login-content">
    <form role="form" action="" method="post" class="login-form form-horizontal"><h2>Login</h2>
        <hr>
        <p>Dear user, log in to access the admin area!</p>

        <div class="form-group">
            <div class="input-icon"><i class="fa fa-user"></i>
            <input type="text" placeholder="Email" name="email" class="form-control"></div>
        </div>
        <div class="form-group">
            <div class="input-icon"><i class="fa fa-key"></i>
            <input type="password" placeholder="Password"  name="password" class="form-control"></div>
        </div>
        <div class="form-group">
            <div class="checkbox"><label><input type="checkbox">&nbsp;
                Remember me</label></div>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-tertiary">Login
                &nbsp;<i class="fa fa-chevron-circle-right"></i></button>
            <a id="btn-forgot-pwd" href="#">Forgot your password ?</a></div>
        <hr>
    </form>
    <form role="form" style="display:none" class="forget-pwd-form form-horizontal"><h2>Forget Password?</h2>
        <hr>
        <p>Enter your e-mail address below to reset your password.</p>

        <div class="form-group">
            <div class="input-icon"><i class="fa fa-envelope"></i><input type="email" placeholder="Email" name="email"
                                                                         class="form-control"></div>
        </div>
        <div class="form-group">
            <button id="btn-forget-back" type="button" class="btn btn-default"><i class="fa fa-chevron-circle-left"></i>&nbsp;
                Back
            </button>
            <button type="submit" class="btn btn-tertiary pull-right">Send
                &nbsp;<i class="fa fa-chevron-circle-right"></i></button>
        </div>
        <hr>
    </form>
</div>
<div class="copyright">2014 © Petition Validator. Admin .</div>
<!--CORE JAVASCRIPT-->
<script src="<?php echo HTTP_JS_PATH_ADMIN; ?>jquery-1.10.2.min.js"></script>
<script src="<?php echo HTTP_JS_PATH_ADMIN; ?>jquery-migrate-1.2.1.min.js"></script>
<!--loading bootstrap js-->
<script src="<?php echo HTTP_BOOTSTRAP_PATH; ?>admin/js/bootstrap.min.js"></script>
<script src="<?php echo HTTP_BOOTSTRAP_PATH; ?>admin/js/bootstrap-hover-dropdown.js"></script>
<script src="<?php echo HTTP_JS_PATH_ADMIN; ?>html5shiv.js"></script>
<script src="<?php echo HTTP_JS_PATH_ADMIN; ?>respond.min.js"></script>
<script src="<?php echo HTTP_JS_PATH_ADMIN; ?>jquery-ui-1.10.3.custom.min.js"></script>
<script src="<?php echo HTTP_JS_PATH_ADMIN; ?>jquery.validate.js"></script>
<script src="<?php echo HTTP_JS_PATH_ADMIN; ?>jquery.menu.js"></script>
<!--CORE JAVASCRIPT-->
<script src="<?php echo HTTP_JS_PATH_ADMIN; ?>app.js"></script>
<script src="<?php echo HTTP_JS_PATH_ADMIN; ?>main.js"></script>
<script src="<?php echo HTTP_JS_PATH_ADMIN; ?>holder.js"></script>
<script src="<?php echo HTTP_JS_PATH_ADMIN; ?>page-login.js"></script>
</body>
</html>