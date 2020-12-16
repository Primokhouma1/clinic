<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <h4 class="page-title">
                    <?php use app\core\Utils;

                    echo $this->lang['infoUser'];?>
                </h4>
            </div>

            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">

                <ol class="breadcrumb">
                    <li><a href="#"> <?php echo $this->lang['accueil']; ?></a></li>
                    <li class="active"><?php echo $this->lang['infoUser']; ?></li>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="row">
            <div class="col-xs-12 col-md-12">
                <div class="white-box">
                    <?php print $token; ?>

                        <fieldset class="scheduler-border">
                            <legend class="scheduler-border"><?php echo $this->lang['infoUser']?></legend>

                            <br>

                            <table align="center" class="table table-no-bordered table-striped" style="width:95%;">
                                <tbody>

                                <!--<tr>
                                    <td><strong><?php /*echo $this->lang['labmarchand']. ' :'; */?></strong></td>
                                    <td  align="right"><?php /*echo  $utilisateur->nom_marchand; */?></td>

                                </tr>-->

                                <tr>
                                    <td><strong><?php echo $this->lang['labprenom']. ' :'; ?></strong> </td>
                                    <td  align="right"><?php echo  $utilisateur->prenom; ?></td>
                                </tr>

                                <tr>
                                    <td><strong><?php echo $this->lang['labnom']. ' :'; ?></strong></td>
                                    <td  align="right"><?php echo  $utilisateur->nom; ?></td>
                                </tr>

                                <tr>
                                    <td><strong><?php echo $this->lang['profils']. ' :'; ?></strong></td>
                                    <td  align="right"><?php echo   $utilisateur->profil->libelle; ?></td>
                                </tr>

                                <tr>
                                    <td ><strong><?= $this->lang['labemail']; ?></strong></td>
                                    <td  align="right"><?= $utilisateur->email; ?></td>
                                </tr>

                                <!--<tr>
                                    <td><strong><?/*= $this->lang['labcodemarchand']; */?></strong></td>
                                    <td  align="right"><?/*= $utilisateur->guichet; */?></td>
                                </tr>-->

                                <tr>
                                    <td><strong><?= $this->lang['labtel']; ?></strong> </td>
                                    <td  align="right"><?= $utilisateur->telephone; ?></td>
                                </tr>

                                <tr>
                                    <td><strong><?= $this->lang['solde']; ?></strong> </td>
                                    <td  align="right"><?= Utils::getFormatMoney($soldeavant); ?></td>
                                </tr>

                                </tbody>
                            </table>

                            <br/>

                            <table align="center" style="width:75%;">
                                <tr>
                                    <td  colspan="2" align="center" valign="middle">
                                        <div class="row">

                                            <div class="col-sm-6 col-xs-6 pull-left">

                                                <a href="javascript:history.back()"><button class="btn btn-default"><?= $this->lang['btnRetour'] ; ?></button></a>

                                            </div>

                                            <div class="col-sm-6 col-xs-6 pull-right">
                                                <button type="button" class="open-modal btn btn-default" data-modal-controller="administration/modifpwdUtilisateurModal"
                                                        data-modal-view="administration/modifpwdUtilisateurModal">
                                                    <?php echo $this->lang['btnmodifpwd']; ?>
                                                </button>
                                            </div>

                                        </div>
                                    </td>
                                </tr>
                            </table>





                            <br>
                        </fieldset>

                </div>
            </div>
        </div>

    </div>
</div>
