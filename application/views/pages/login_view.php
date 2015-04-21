
    <link rel="stylesheet" href="<?php echo HTTP_CSS_PATH; ?>pages/page_log_reg_v2.css">
    <script src="http://fgnass.github.io/spin.js/spin.js"></script>
    <style>
        .input-group {
            width: 100%;
        }
        .input-group .input-icon {
            display: table;
        }
    </style>
    <div class="container">
        <!--Reg Block-->
        <div class="reg-block" style="margin: 10% auto;border: solid 1px #eee; box-shadow: 0 0 3px #eee;">
            <div class="reg-block-header">
                <h2>Login to your account</h2>
                <!--<ul class="list-inline style-icons text-center">
                    <li><a href="<?php /*echo base_url();*/?>"><i class="fa fa-home icon-custom icon-sm rounded-x icon-color-grey"></i></a></li>
                </ul>-->
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
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <a id="login" class="btn-u btn-u-green btn-block" style="text-align: center;">Log In</a>
                </div>
            </div>
            <div class="custom-hr">
                <hr>
                <div class="custom-hr-text">
                    or
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-md-offset-1">
                    <a href="#" class="btn-u-blue btn-block text-center btn-u" id="fb_login"><i class="fa fa-facebook"></i></a>
                </div>
                <div class="col-md-4 col-md-offset-2">
                    <a href="#" class="btn-u-aqua btn-block text-center btn-u" id="tw_login"><i class="fa fa-twitter"></i></a>
                </div>
            </div>
        </div>
        <!--End Reg Block-->
    </div><!--/container-->
    <script type="text/javascript" src="<?php echo HTTP_PLUGIN_PATH; ?>countdown/jquery.countdown.js"></script>
    <script type="text/javascript" src="<?php echo HTTP_PLUGIN_PATH; ?>backstretch/jquery.backstretch.min.js"></script>

    <script src="http://connect.facebook.net/en_US/all.js"></script>
    <script>
        FB.init({ appId:'1586799264887801',cookie:true, status:true, xfbml:true });
    </script>
    <!-- JS Page Level -->
    <script type="text/javascript">
        jQuery(document).ready(function() {
            App.init();
        });
    </script>
    <script type="text/javascript" src="<?php echo HTTP_JS_PATH; ?>jquery.validate.js"></script>
    <script src="<?php echo HTTP_JS_PATH; ?>pages/login.js"></script>
