<!DOCTYPE html>
<!--[if IE 8]><html class="ie8 no-js" lang="en"><![endif]-->
<!--[if IE 9]><html class="ie9 no-js" lang="en"><![endif]-->
<!--[if !IE]><!-->
<html class="no-js">
<!--<![endif]-->

<head>
    <title>Sistem Informasi Akademik</title>
    <link rel="shortcut icon" href="<?php echo base_url('assets/image/favicon.ico'); ?>" />
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
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- start: CSS REQUIRED FOR THIS PAGE ONLY -->
    <link href="http://www.cliptheme.com/preview/cliponeV2/Admin/bower_components/fullcalendar/dist/fullcalendar.min.css" rel="stylesheet" />
    <!-- end: CSS REQUIRED FOR THIS PAGE ONLY -->
</head>

<body>

    <!-- start: HEADER -->
    <div class="navbar navbar-inverse navbar-fixed-top">
        <!-- start: TOP NAVIGATION CONTAINER -->
        <div class="container">
            <div class="navbar-header">
                <!-- start: RESPONSIVE MENU TOGGLER -->
                <button data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle" type="button">
                <span class="clip-list-2"></span>
            </button>
                <!-- end: RESPONSIVE MENU TOGGLER -->
                <!-- start: LOGO -->
                <a class="navbar-brand" href="<?php echo base_url(); ?>">
                <i class="fa fa-graduation-cap" aria-hidden="true"></i> SMK NEGERI 2 DEPOK
            </a>
                <!-- end: LOGO -->
            </div>
            <div class="navbar-tools">
                <!-- start: TOP NAVIGATION MENU -->
                <ul class="nav navbar-right">
                    <!-- start: TO-DO DROPDOWN -->
                    
                    <!-- end: TO-DO DROPDOWN-->
                    <!-- start: NOTIFICATION DROPDOWN -->
                    
                    <!-- end: NOTIFICATION DROPDOWN -->
                    <!-- start: MESSAGE DROPDOWN -->
                    
                    <!-- end: MESSAGE DROPDOWN -->
                    <!-- start: USER DROPDOWN -->
                    <li class="dropdown current-user">
                        <a data-toggle="dropdown" class="dropdown-toggle" data-close-others="true" href="#">
                            <img src="http://www.cliptheme.com/preview/cliponeV2/Admin/clip-one-template/clip-one/assets/images/avatar-1-small.jpg" class="circle-img" alt="">
                            <span class="username">&nbsp;<?php echo $this->session->userdata('nama_lengkap') ?></span>
                            <i class="fa fa-chevron-down"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="pages_user_profile.html">
                                    <i class="fa fa-user"></i> &nbsp;My Profile
                                </a>
                            </li>                                
                            <li class="divider"></li>
                            <li>
                                <?php echo anchor('auth/logout', '<i class="fa fa-sign-out"></i> &nbsp;Log Out') ?>
                            </li>
                        </ul>
                    </li>
                        <!-- end: USER DROPDOWN -->
                </ul>
                <!-- end: TOP NAVIGATION MENU -->
            </div>
        </div>
        <!-- end: TOP NAVIGATION CONTAINER -->
    </div>
    <!-- end: HEADER -->

    <!-- start: MAIN CONTAINER -->
    <div class="main-container">
        <div class="navbar-content">
            <!-- start: SIDEBAR -->
            <div class="main-navigation navbar-collapse collapse">
                <!-- start: MAIN MENU TOGGLER BUTTON -->
                <div class="navigation-toggler">
                    <i class="fa fa-chevron-left"></i>
                    <i class="fa fa-chevron-right"></i>
                </div>
                <!-- end: MAIN MENU TOGGLER BUTTON -->

                <!-- start: MAIN NAVIGATION MENU -->
                <ul class="main-navigation-menu">

                <?php
                    $id_level_user = $this->session->userdata('id_level_user');
                    
                    $sql_menu = "SELECT * FROM tb_menu WHERE id_menu in(SELECT id_menu FROM tb_user_rule WHERE id_level_user=$id_level_user) AND is_main_menu=0";
                    $main_menu = $this->db->query($sql_menu)->result();
                    //$main_menu = $this->db->get_where('tb_menu',array('is_main_menu'=>0))->result();
                    foreach ($main_menu as $main) {
                        //checking submenu
                        $sub_menu = $this->db->get_where('tb_menu',array('is_main_menu'=>$main->id_menu));
                        
                        if($sub_menu->num_rows()>0) {
                            //show submenu
                            echo 
                                "<li>
                                    <a href='javascript:void(0)'>
                                        <i class='".$main->icon."'></i>
                                        <span class='title'>".$main->nama_menu."</span>
                                        <span class='selected'><i class='fa fa-angle-down'></i></span>        
                                    </a>

                                    <ul class='sub-menu'>";

                                    foreach($sub_menu->result() as $sub) {
                                        echo "<li>".anchor($sub->url, "<i class='".$sub->icon."'></i>  " .$sub->nama_menu)."</li>";            
                                    }

                            echo    "</ul>
                                </li>";
                        }
                        else {
                            //show main-menu
                            echo "<li>".anchor($main->url, "<i class='".$main->icon."'></i> ".$main->nama_menu)."</li>";
                        };
                    }
                ?>

                </ul>
                <!-- end: MAIN NAVIGATION MENU -->
            
            </div>
            <!-- end: SIDEBAR -->
        </div>

        <!-- start: PAGE -->
        <div class="main-content">
            <!-- start: PANEL CONFIGURATION MODAL FORM -->
            <div class="modal fade" id="panel-config" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                            <h4 class="modal-title">Panel Configuration</h4>
                        </div>
                        <div class="modal-body">
                            Here will be a configuration form
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">
                    Close
                </button>
                            <button type="button" class="btn btn-primary">
                    Save changes
                </button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->
            <!-- end: SPANEL CONFIGURATION MODAL FORM -->
            <div class="container">
                <!-- start: PAGE HEADER -->
                <div class="row">
                    <div class="col-sm-12">
                        <!-- start: STYLE SELECTOR BOX -->
                        <div id="style_selector" class="hidden-xs close-style">
                            <div id="style_selector_container" style="display:block">
                                <div class="style-main-title">
                                    Style Selector
                                </div>
                                <div class="box-title">
                                    Choose Your Layout Style
                                </div>
                                <div class="input-box">
                                    <div class="input">
                                        <select name="layout">
                                            <option value="default">Wide</option>
                                            <option value="boxed">Boxed</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="box-title">
                                    Choose Your Orientation
                                </div>
                                <div class="input-box">
                                    <div class="input">
                                        <select name="orientation">
                                            <option value="default">Default</option>
                                            <option value="rtl">RTL</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="box-title">
                                    Choose Your Header Style
                                </div>
                                <div class="input-box">
                                    <div class="input">
                                        <select name="header">
                                            <option value="fixed">Fixed</option>
                                            <option value="default">Default</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="box-title">
                                    Choose Your Footer Style
                                </div>
                                <div class="input-box">
                                    <div class="input">
                                        <select name="footer">
                                            <option value="default">Default</option>
                                            <option value="fixed">Fixed</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="box-title">
                                    Backgrounds for Boxed Version
                                </div>
                                <div class="images boxed-patterns">
                                    <a id="bg_style_1" href="#"><img alt="" src="assets/images/bg.png"></a>
                                    <a id="bg_style_2" href="#"><img alt="" src="assets/images/bg_2.png"></a>
                                    <a id="bg_style_3" href="#"><img alt="" src="assets/images/bg_3.png"></a>
                                    <a id="bg_style_4" href="#"><img alt="" src="assets/images/bg_4.png"></a>
                                    <a id="bg_style_5" href="#"><img alt="" src="assets/images/bg_5.png"></a>
                                </div>
                                <div class="box-title">
                                    5 Predefined Color Schemes
                                </div>
                                <div class="images icons-color">
                                    <a id="light" href="#"><img class="active" alt="" src="assets/images/lightgrey.png"></a>
                                    <a id="dark" href="#"><img alt="" src="assets/images/darkgrey.png"></a>
                                    <a id="black-and-white" href="#"><img alt="" src="assets/images/blackandwhite.png"></a>
                                    <a id="navy" href="#"><img alt="" src="assets/images/navy.png"></a>
                                    <a id="green" href="#"><img alt="" src="assets/images/green.png"></a>
                                </div>
                                <div style="height:25px;line-height:25px; text-align: center">
                                    <a class="clear_style" href="#">
                                        Clear Styles
                                    </a>
                                    <a class="save_style" href="#">
                                        Save Styles
                                    </a>
                                </div>
                            </div>
                            <div class="style-toggle open">
                                <i class="fa fa-cog fa-spin"></i>
                            </div>
                        </div>
                        <!-- end: STYLE SELECTOR BOX -->

<?php

$controller = $this->uri->segment(1);
$method = $this->uri->segment(2);
//$method = $CI->uri->segment(2);


if (empty($method)) {
    $url = $controller;
}else {
    $url = $controller ."/". $method;
}
//check url
$sql_nama_menu = "SELECT * FROM tb_menu where url='$url'";
$query_nama_menu = $this->db->query($sql_nama_menu)->row_array();



?>

                        <!-- start: PAGE TITLE & BREADCRUMB -->
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-home" aria-hidden="true"></i>
                                <a href="#">
                                    Home
                                </a>
                            </li>
                            <li class="active">
                                <!--Dashboard-->
                                <?php
                                    if (empty($method)) {
                                        echo $controller;
                                    }else {
                                        echo $controller ."/". $method;
                                    }
                                ?>
                            </li>
                            
                            
                        </ol>
                        <div class="page-header">
                            <h1><?php
                                    echo $query_nama_menu['nama_menu'];
                                ?> 
                        </div>
                        <!-- end: PAGE TITLE & BREADCRUMB -->
                    </div>
                </div>
                <!-- end: PAGE HEADER -->
                
                <!-- start: PAGE CONTENT -->
                <?php echo $contents ?>
                <!-- end: PAGE CONTENT-->

            </div>
        </div>
        <!-- end: PAGE -->

    </div>
    <!-- end: MAIN CONTAINER -->

    <!-- start: FOOTER -->
    <div class="footer clearfix">
        <div class="footer-inner">
            <script>
                document.write(new Date().getFullYear())
            </script> &copy; Sekolah Menengah Kejuruan Negeri 2 Depok.
        </div>
        <div class="footer-items">
            <span class="go-top"><i class="fa fa-chevron-up"></i></span>
        </div>
    </div>
    <!-- end: FOOTER -->

    <!-- start: MAIN JAVASCRIPTS -->
    <!--[if lt IE 9]>
        <script src="http://www.cliptheme.com/preview/cliponeV2/Admin/bower_components/respond/dest/respond.min.js"></script>
        <script src="http://www.cliptheme.com/preview/cliponeV2/Admin/bower_components/Flot/excanvas.min.js"></script>
        <script src="http://www.cliptheme.com/preview/cliponeV2/Admin/bower_components/jquery-1.x/dist/jquery.min.js"></script>
    <![endif]-->
    <!--[if gte IE 9]><!-->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flot/0.8.3/jquery.flot.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flot/0.8.3/jquery.flot.pie.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flot/0.8.3/jquery.flot.resize.min.js"></script>
    <script src="http://www.cliptheme.com/preview/cliponeV2/Admin/clip-one-template/clip-one/assets/plugin/jquery.sparkline.min.js"></script>
    <script src="http://www.cliptheme.com/preview/cliponeV2/Admin/bower_components/jquery.easy-pie-chart/dist/jquery.easypiechart.min.js"></script>
    <script src="http://www.cliptheme.com/preview/cliponeV2/Admin/bower_components/jqueryui-touch-punch/jquery.ui.touch-punch.min.js"></script>
    <script src="http://www.cliptheme.com/preview/cliponeV2/Admin/bower_components/moment/min/moment.min.js"></script>
    <script src="http://www.cliptheme.com/preview/cliponeV2/Admin/bower_components/fullcalendar/dist/fullcalendar.min.js"></script>
    <script src="http://www.cliptheme.com/preview/cliponeV2/Admin/clip-one-template/clip-one/assets/js/min/index.min.js"></script>
    
    <!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->

    <script>
        jQuery(document).ready(function() {
            Main.init();
            Index.init();
        });
    </script>

    <script>
        $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
        });
    </script>

</body>

</html>