<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <h4 class="page-title"><?php echo $this->lang['listeTransaction']; ?></h4></div>
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">

                <ol class="breadcrumb">
                    <li><a href="#"> <?php echo $this->lang['tabBord']; ?></a></li>
                    <li class="active"><?php echo $this->lang['listeTransaction']; ?></li>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="row bg-title">
            <div class="row">
                <div class="col-md-12">

            <table class="table table-bordered table-hover table-responsive processing"
                   data-url="<?= WEBROOT; ?>reporting/listeTransactionPro/<?= $anne; ?>/<?= $mois; ?>/<?= $jour; ?>"" >
                <thead>
                <tr>
                    <th><?php echo $this->lang['labpnum_transaction']; ?></th>
                    <th><?php echo $this->lang['labdate_transaction']; ?></th>
                    <th><?php echo $this->lang['labmontant_transation']; ?></th>
                    <th><?php echo $this->lang['labemail_acheteur']; ?></th>
                    <th><?php echo $this->lang['labnum_transac_marchand']; ?></th>
                    <th><?php echo $this->lang['labAction']; ?></th>


                </tr>
                </thead>
            </table>
        </div>

            </div>


        </div>
    </div>

</div>

