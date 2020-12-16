<!DOCTYPE html>
<html lang="<?= \app\core\Session::getAttribut('lang');?>">
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

    <!-- jQuery JavaScript -->
    <script src="<?= WEBROOT;?>assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Telephone CSS -->
    <link rel="stylesheet" href="<?= WEBROOT ?>assets/plugins/build/css/intlTelInput.css">
    <!-- Bootstrap Core CSS -->
    <link href="<?= WEBROOT;?>assets/ampleadmin/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Menu CSS -->
    <link href="<?= WEBROOT;?>assets/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css" rel="stylesheet">
    <!-- toast CSS -->
    <link href="<?= WEBROOT;?>assets/plugins/bower_components/toast-master/css/jquery.toast.css" rel="stylesheet">
    <!-- morris CSS -->
    <link href="<?= WEBROOT;?>assets/plugins/bower_components/morrisjs/morris.css" rel="stylesheet">
    <!-- chartist CSS -->

    <link href="<?= WEBROOT;?>assets/plugins/bower_components/chartist-js/dist/chartist.min.css" rel="stylesheet">
    <link href="<?= WEBROOT;?>assets/plugins/bower_components/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.css" rel="stylesheet">
    <!-- Calendar CSS -->
    <!-- animation CSS -->
    <link href="<?= WEBROOT;?>assets/ampleadmin-minimal/css/animate.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?= WEBROOT;?>assets/ampleadmin-minimal/css/styleadmin.css" rel="stylesheet"  />
    <!-- color CSS -->
    <link href="<?= WEBROOT;?>assets/ampleadmin-minimal/css/dan.css" rel="stylesheet" />
    <link href="<?= WEBROOT;?>assets/ampleadmin-minimal/css/graphe.css"  />
    <link href="<?= WEBROOT;?>assets/ampleadmin-minimal/css/colors/default.css" id="theme" rel="stylesheet">
    <link href="<?= WEBROOT ?>assets/plugins/datatables/jquery.dataTables.css">
    <link href="<?= WEBROOT ?>assets/plugins/datatables/dataTables.bootstrap.css">
    <link href="<?= WEBROOT; ?>assets/plugins/bower_components/sweetalert/sweetalert.css" rel="stylesheet" >
    <link href="<?= WEBROOT; ?>assets/plugins/jquery-timepicker-1.3.5/jquery.timepicker.min.css" rel="stylesheet">

    <!-- CSS Validation -->
    <link  href="<?= WEBROOT; ?>assets/plugins/formValidation.min.css">

    <!-- Font-awesome CSS -->
    <link href="<?= WEBROOT;?>assets/plugins/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= WEBROOT; ?>assets/plugins/jquery-wizard-master/formValidation.min.css">
    <link rel="stylesheet" href="<?= WEBROOT; ?>assets/css/dropify.min.css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->

 <!-- select2 CSS -->
    <link href="<?= WEBROOT;?>assets/plugins/select2/select2.min.css" rel="stylesheet">

    <!-- CSS DATEPICKER PLUGINS -->
    <link href="<?php echo WEBROOT; ?>assets/plugins/jquery-ui/jquery-ui.theme.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo WEBROOT; ?>assets/plugins/jquery-ui/jquery-ui.structure.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo WEBROOT; ?>assets/plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet" type="text/css" />

    <!-- Jquery-confirm CSS -->
    <link rel="stylesheet" href="<?= ASSETS ?>plugins/jconfirm/css/jquery-confirm.css"/>

</head>


<body data-racine="<?= RACINE; ?>" data-webroot="<?= WEBROOT; ?>" data-assets="<?= ASSETS; ?>" class="fix-header">
<!-- ============================================================== -->

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
                <a class="logo" href="<?= WEBROOT;?>menu/menu">
                    <b>
                        <img src="<?= WEBROOT;?>assets/plugins/images/logo.png" alt="home" height="50px" class="dark-logo"/>
                    </b>

                    <!--<span class="hidden-xs">
                        <img src="<?/*= WEBROOT;*/?>assets/plugins/images/senelec-text.png" alt="home" class="dark-logo"/>
                        <img src="<?/*= WEBROOT;*/?>assets/plugins/images/senelec-text.png" alt="home" class="light-logo"/>
                     </span>-->
                </a>
            </div>

            <!-- /Logo -->
            <!-- Search input and Toggle icon -->
            <ul class="nav navbar-top-links navbar-left">
                <li><a href="javascript:void(0)" class="open-close waves-effect waves-light"><i class="ti-menu"></i></a></li>

            </ul>

            <ul class="nav navbar-top-links navbar-right pull-right">

                <li class="dropdown">
                    <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#">
                        <img src="<?= WEBROOT;?>assets/images/user.png" alt="user-img" width="36" class="img-circle"/>
                        <b class="hidden-xs"><?php echo $this->_USER->prenom." ".$this->_USER->nom;?></b><span class="caret"></span> </a>
                    <ul class="dropdown-menu dropdown-user animated flipInY">
                        <li>
                            <div class="dw-user-box">
                                <!--<div class="u-img">
                                    <img src="<?/*= WEBROOT;*/?>assets/images/user.png" alt="<?php /*echo $this->_USER->prenom.' '.$this->_USER->nom;*/?>"/>
                                </div>-->
                                <div class="u-text" style="font-weight: 500; font-size: 13px">
                                    <!--<h4><?php /*echo $this->_USER->prenom.' '.$this->_USER->nom;*/?></h4>-->
                                    <div><?php /*echo $this->lang['solde']; */?> <!--  :  --><?php /*echo \app\core\Utils::getFormatMoney(\app\core\Utils::getModel('profil')->consulterSoldeMarchand($this->_USER->fk_marchand)).' '.$this->lang['currency']; */?></div>
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