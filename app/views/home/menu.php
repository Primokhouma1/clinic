<?php
$admin = $this->_USER->admin;
$type = $this->_USER->type;
$profil = $this->_USER->fk_profil;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta charset="utf-8">
    <!---------- Dan Enriqué ----------->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= WEBROOT;?>assets/plugins/images/favicon.ico">
    <title><?= $this->lang['titre3'] ?></title>
    <!-- Bootstrap Core CSS -->
    <link href="<?= WEBROOT;?>assets/ampleadmin-minimal/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Menu CSS -->
    <link href="<?= WEBROOT;?>assets/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css" rel="stylesheet">
    <!-- toast CSS -->
    <link href="<?= WEBROOT;?>assets/plugins/bower_components/toast-master/css/jquery.toast.css" rel="stylesheet">
    <!-- morris CSS -->
    <link href="<?= WEBROOT;?>assets/plugins/bower_components/morrisjs/morris.css" rel="stylesheet">
    <!-- chartist CSS -->
    <link href="<?= WEBROOT;?>assets/plugins/bower_components/chartist-js/dist/chartist.min.css" rel="stylesheet">
    <link href="<?= WEBROOT;?>assets/plugins/bower_components/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.css"
          rel="stylesheet">
    <!-- Calendar CSS -->
    <link href="<?= WEBROOT;?>assets/plugins/bower_components/calendar/dist/fullcalendar.css" rel="stylesheet"/>
    <!-- animation CSS -->
    <link href="<?= WEBROOT;?>assets/ampleadmin-minimal/css/animate.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?= WEBROOT;?>assets/ampleadmin-minimal/css/style.css" rel="stylesheet">
    <!-- color CSS -->
    <link href="<?= WEBROOT;?>assets/ampleadmin/css/colors/blue-dark.css" id="theme" rel="stylesheet">
    <link href="<?= WEBROOT;?>assets/ampleadmin-minimal/css/dan.css" rel="stylesheet" type="text/css"/>

    <!-- Font-awesome CSS -->
    <link href="<?= WEBROOT;?>assets/plugins/font-awesome/css/font-awesome.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <![endif]-->
</head>

<body class="fix-header">
<!-- ============================================================== -->
<!-- Preloader -->
<!-- ============================================================== -->
<!--<div class="preloader">
    <svg class="circular" viewBox="25 25 50 50">
        <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"/>
    </svg>
</div>-->
<!-- ============================================================== -->
<!-- Wrapper -->
<!-- ============================================================== -->
<div id="wrapper">
    <!-- ============================================================== -->
    <!-- Topbar header - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <nav class="navbar navbar-default navbar-static-top m-b-0">
        <div class="navbar-header">
            <div class="top-left-part">
                <!-- Logo -->
                <a class="logo" href="#">

                    <b>
                        <img src="<?= WEBROOT;?>assets/plugins/images/bg_cli.jpg" alt="home"  height="100px" class="dark-logo"/>
                    </b>

                    <!--<span class="hidden-xs">
                        <img src="<?/*= WEBROOT;*/?>assets/plugins/images/senelec-text.png" alt="home" class="dark-logo"/>
                        <img src="../plugins/images/admin-text-dark.png" alt="home" class="light-logo"/>
                     </span>-->
                </a>
            </div>
            <!-- /Logo -->
            <!-- Search input and Toggle icon -->
            <ul class="nav navbar-top-links navbar-left">
                <li><a href="javascript:void(0)" class="open-close waves-effect waves-light visible-xs"><i
                                class="ti-close ti-menu"></i></a></li>
                <li class="dropdown">
                    <a class="dropdown-toggle waves-effect waves-light" data-toggle="dropdown" href="#"> <i
                                class="mdi mdi-gmail"></i>
                        <div class="notify"><span class="heartbit"></span> <span class="point"></span></div>
                    </a>
                    <!--<ul class="dropdown-menu mailbox animated bounceInDown">

                        <li>
                            <div class="message-center">

                            </div>
                        </li>

                    </ul>-->
                    <!-- /.dropdown-messages -->
                </li>

            </ul>
            <ul class="nav navbar-top-links navbar-right pull-right">

                <li class="dropdown">
                    <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#">
                        <img src="<?= WEBROOT;?>assets/images/user.png" alt="<?php echo $this->_USER->prenom.' '.$this->_USER->nom;?>" width="36" class="img-circle">
                        <b class="hidden-xs"><?php echo $this->_USER->nom_marchand; ?></b><span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-user animated flipInY">
                        <li>
                            <div class="dw-user-box">
                                <div class="u-img"><img src="<?= WEBROOT;?>assets/images/user.png" alt="<?php echo $this->_USER->nom_marchand;?>"/></div>
                                <div class="u-text">
                                    <h4><?php echo
                                        $this->_USER->prenom.' '.$this->_USER->nom; ?></h4>
                                </div>
                            </div>
                        </li>

                        <li><a href="<?php echo WEBROOT."home/unlogin" ?>"><i class="fa fa-power-off"></i>&nbsp;&nbsp;<?php echo $this->lang['se_deconnecter']; ?></a></li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>

                <!-- /.dropdown -->
            </ul>
        </div>
        <!-- /.navbar-header -->
        <!-- /.navbar-top-links -->
        <!-- /.navbar-static-side -->
    </nav>
    <!-- End Top Navigation -->
    <!-- ============================================================== -->
    <!-- Left Sidebar - style you can find in sidebar.scss  -->
    <!-- ============================================================== -->

    <!-- ============================================================== -->
    <!-- End Left Sidebar -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Page Content -->
    <!-- ============================================================== -->
    <div id="page-wrapper" style="margin: 50px 0px;min-height: 840px;">
        <div class="container-fluid">
            <div class="row ">
                <div class="row white-box" style="margin-top:0px; margin-bottom: 40px">
                    <div class="col-lg-2 col-sm-6  text-white"
                         style="height: 0px; vertical-align: middle; padding-top:0px">
                        <center><b></b></center>
                    </div>
                    <div class="col-lg-10 col-sm-6 annulation">


                    </div>
                </div>

            </div>
            <!-- ============================================================== -->
            <!-- Different data widgets -->
            <!-- ============================================================== -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="white-box">
                        <div class="row row-in">
                            <div class="col-sm-4 row-in-br">
                                <ul class="col-in">
                                    <li>
                                        <span class="circle circle-md bg-ico"><i
                                                    class="mdi mdi-folder-upload fa-fw"></i></span>
                                    </li>
                                    <li class="col-last"><h4 class="counter text-right m-t-15"><b><?= $nombreT; ?></b></h4></li>
                                    <li class="col-middle">
                                        <h4>Nombre de transactions</h4>

                                    </li>

                                </ul>
                            </div>
                            <div class="col-sm-4 row-in-br  b-r-none">
                                <ul class="col-in">
                                    <li>
                                        <span class="circle circle-md bg-ico"><i
                                                    class="mdi mdi-security-home fa-fw"></i></span>
                                    </li>
                                    <li class="col-last"><h4 class="text-right m-t-15"><b><?= $montantT." ".$this->lang['Fcfa']; ?></b></h4></li>
                                    <li class="col-middle">
                                        <h4>Montant global des paiements</h4>

                                    </li>

                                </ul>
                            </div>

                            <div class="col-sm-4 row-in-br">
                                <ul class="col-in">
                                    <li>
                                        <span class="circle circle-md bg-ico"><i class="mdi mdi-timer"></i></span>
                                    </li>
                                    <li class="col-last"><h4 class="text-right m-t-15"><b><?= $soldeavant." ".$this->lang['Fcfa'];; ?></b></h4></li>
                                    <li class="col-middle">
                                        <h4>Solde actuel du compte</h4>
                                    </li>

                                </ul>
                            </div>

                        </div>
                    </div>
                </div>
            </div>


            <!-- ======================== Event ==============================-->

            <!-- ============= Blocs du menu ========= -->
            <div class="row">



                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 big_team_grid">
                    <a href="<?= WEBROOT; ?>utilisateurs/listeUtilisateurs">
                        <div class="big_text text1-big">
                            <h3><i class="mdi mdi-settings fa-fw icones-big"></i></h3>
                            <p><?php echo strtoupper($this->lang['administration']); ?></p>
                        </div>
                    </a>
                </div>



                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <a href="<?= WEBROOT; ?>encaissement/listeEncaissement">
                        <div class="big_text text1-big">
                            <h3><i class="mdi mdi-television-guide icones-big"></i></h3>
                            <p><?php echo strtoupper($this->lang['gestion_caisse']); ?></p>
                        </div>
                    </a>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">

                        <a href="<?= WEBROOT; ?>appel/appelDeFond">
                        <div class="big_text text1-big">
                            <h3><i class="mdi mdi-cash fa-fw icones-big"></i></h3>
                            <p><?php echo strtoupper($this->lang['appelfonds']); ?></p>
                        </div>
                    </a>
                </div>



                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 big_team_grid">
                    <a href="<?php echo WEBROOT; ?>reporting/transaction_du_jour">
                        <div class="big_text text1-big">
                            <h3><i class="mdi mdi-view-list fa-fw icones-big"></i></h3>
                            <p><?php echo strtoupper($this->lang['reporting']); ?></p>
                        </div>
                    </a>
                </div>


            </div>
            <!-- ============= Blocs du menu ========= -->

        </div>
    </div>
    <!-- /.container-fluid -->
    <footer class="footer text-center"> © <?php echo $this->lang['copyright']; ?></footer>
</div>

</div>

<!-- ============================================================== -->
<!-- End Page Content -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- End Wrapper -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- All Jquery -->
<!-- ============================================================== -->

<script>
    function fermer(){
        $("#tteactu").modal('hide');
    }
    function fermer2(){
        $("#ttevent").modal('hide');
    }
</script>
<script src="<?= WEBROOT;?>assets/plugins/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="<?= WEBROOT;?>assets/ampleadmin/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Menu Plugin JavaScript -->
<script src="<?= WEBROOT;?>assets/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>
<!--slimscroll JavaScript -->
<script src="<?= WEBROOT;?>assets/ampleadmin/js/jquery.slimscroll.js"></script>
<!--Wave Effects -->
<script src="<?= WEBROOT;?>assets/ampleadmin/js/waves.js"></script>
<!--Counter js -->
<script src="<?= WEBROOT;?>assets/plugins/bower_components/waypoints/lib/jquery.waypoints.js"></script>
<script src="<?= WEBROOT;?>assets/plugins/bower_components/counterup/jquery.counterup.min.js"></script>
<!--Morris JavaScript -->
<script src="<?= WEBROOT;?>assets/plugins/bower_components/raphael/raphael-min.js"></script>
<script src="<?= WEBROOT;?>assets/plugins/bower_components/morrisjs/morris.js"></script>
<!-- chartist chart -->
<script src="<?= WEBROOT;?>assets/plugins/bower_components/chartist-js/dist/chartist.min.js"></script>
<script src="<?= WEBROOT;?>assets/plugins/bower_components/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.min.js"></script>
<!-- Calendar JavaScript -->
<script src="<?= WEBROOT;?>assets/plugins/bower_components/moment/moment.js"></script>
<script src="<?= WEBROOT;?>assets/plugins/bower_components/calendar/dist/fullcalendar.min.js"></script>
<script src="<?= WEBROOT;?>assets/plugins/bower_components/calendar/dist/cal-init.js"></script>
<!-- Custom Theme JavaScript -->
<script src="<?= WEBROOT;?>assets/ampleadmin/js/custom.min.js"></script>
<script src="<?= WEBROOT;?>assets/ampleadmin/js/dashboard1.js"></script>
<!-- Custom tab JavaScript -->
<script src="<?= WEBROOT;?>assets/ampleadmin/js/cbpFWTabs.js"></script>
<script type="text/javascript">
    (function () {
        [].slice.call(document.querySelectorAll('.sttabs')).forEach(function (el) {
            new CBPFWTabs(el);
        });
    })();
</script>
<script src="<?= WEBROOT;?>assets/plugins/bower_components/toast-master/js/jquery.toast.js"></script>
<!--Style Switcher -->
<script src="<?= WEBROOT;?>assets/plugins/bower_components/styleswitcher/jQuery.style.switcher.js"></script>
</body>

</html>
<!-- Localized -->