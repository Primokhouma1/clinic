
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <h4 class="page-title"><?php echo $this->lang['detailTransaction1'];
                    echo $transact->num_transaction; ?></h4></div>

            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">

                <ol class="breadcrumb">
                    <li><a href="#"> <?php echo $this->lang['Transaction']; ?></a></li>
                    <li class="active"><?php echo $this->lang['detailTransact']; ?></li>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="row bg-title">
            <div class="row col-lg-12">

                <table class="table table-striped table-hover table-responsive ">
                    <tr>
                        <th >N° transaction</th>
                        <td ><?= $transact->num_transaction; ?></td>
                    </tr>
                    <tr>
                        <th >Date transaction</th>
                        <td ><?= \app\core\Utils::getDateFR($transact->date_transaction); ?></td>
                    </tr>
                    
                    <tr>
                        <th ><?php echo $this->lang['labmontant_transation']; ?></th>
                        <td ><?= \app\core\Utils::getFormatMoney($transact->montant_transation); ?></td>
                    </tr>
                    <tr>
                        <th ><?php echo $this->lang['labstatus_transaction']; ?></th>
                        <td ><?php if($transact->status_transaction == 0) echo '<span style="color: #f00">Echoué</span>'; else echo '<span style="color: green">Succès</span>' ?></td>
                    </tr>
                    <tr>
                        <th ><?php echo $this->lang['labemail_acheteur']; ?></th>
                        <td ><?= $transact->email_acheteur; ?></td>
                    </tr>
                    <!--<tr>
                        <th ><?php /*echo $this->lang['labmarchand_idmarchand']; */?></th>
                        <td ><?/*= $transact->marchand_idmarchand; */?></td>
                    </tr>-->
                    <tr>
                        <th ><?php echo $this->lang['labnum_transac_marchand']; ?></th>
                        <td ><?= $transact->num_transac_marchand; ?></td>
                    </tr>
                    <tr>
                        <th ><?php echo $this->lang['labmoyen_paiement']; ?></th>
                        <td ><?php
                            if($transact->moyen_paiement == 1) echo 'PosteCash';
                            if($transact->moyen_paiement == 2) echo 'Jula';
                            ?></td>

                    </tr>
                    <tr>
                        <th ><?php echo $this->lang['laborder_id']; ?></th>
                        <td ><?= $transact->order_id; ?></td>

                    </tr>
                    <tr>
                        <th ><?php echo $this->lang['labtrans_id']; ?></th>
                        <td ><?= $transact->trans_id; ?></td>

                    </tr>

                    <tr>
                        <th ><?php echo $this->lang['labcurrency']; ?></th>
                        <td ><?= $transact->currency; ?></td>

                    </tr>
                    <tr>
                        <th ><?php echo $this->lang['labmontant_reel']; ?></th>
                        <td ><?= \app\core\Utils::getFormatMoney($transact->montant_reel).' '.$transact->currency; ?></td>

                    </tr>
                    <tr>
                        <th ><?php echo $this->lang['labtaux_change']; ?></th>
                        <td ><?= $transact->taux_change; ?></td>

                    </tr>
                    <tr>
                        <th ><?php echo $this->lang['labmontant_converti']; ?></th>
                        <td ><?= \app\core\Utils::getFormatMoney($transact->montant_converti); ?> F CFA</td>

                    </tr>
                    <tr>
                        <th ><?php echo $this->lang['laburl_retour']; ?></th>
                        <td ><?= $transact->url_retour; ?></td>
                    </tr>
                    <tr>
                        <th ><?php echo $this->lang['laburl_cancel']; ?></th>
                        <td ><?= $transact->url_cancel; ?></td>
                    </tr>
                    <tr>
                        <th ><?php echo $this->lang['laburl_notification']; ?></th>
                        <td ><?= $transact->url_notification; ?></td>
                    </tr>
                    <tr>
                        <th ><?php echo $this->lang['labcommentaire']; ?></th>
                        <td ><?= $transact->commentaire; ?></td>

                    </tr>

                </table>
                <?php print $token; ?>

            </div>
            <!--<div class="row col-lg-12">
                <h3 class="panel-title pull-right">

                    <a href="<?/*= WEBROOT . "reporting/listeTransaction/j" */?>">
                        <button type="button" class="btn btn-default">
                            <i class="fa fa-times"></i> <?php /*echo $this->lang['btnRetour']; */?> </button>
                    </a>
                </h3>
            </div>-->
        </div>


    </div>
</div>