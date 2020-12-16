<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <h4 class="page-title">Transactions de l'année</h4></div>
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">

                <ol class="breadcrumb">
                    <li><a href="#"> <?php echo $this->lang['tabBord']; ?></a></li>
                    <li class="active">Transactions de l'année</li>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="row bg-title">
            <div class="row">
                <div class="col-md-12">

            <table class="table table-bordered table-hover table-responsive processing"
                   data-url="<?= WEBROOT; ?>client/listeTransactionPro/<?= $anne; ?>/<?= $mois; ?>/<?= $jour; ?>"" >
                <thead>
                <tr>
                    <th>N° trnasaction</th>
                    <th>Date</th>
                    <th>Montant(F CFA)</th>
                    <th>Email achéteur</th>
                    <th>N° Trans. marchand</th>
                    <th>Statut</th>
                    <th>&nbsp;</th>

                </tr>
                </thead>
            </table>
        </div>

            </div>


        </div>
    </div>

</div>

