

<div id="page-wrapper">
    <div class="container-fluid">

        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title"><?php echo $this->lang['listeTransaction']; ?></h4> </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

                <ol class="breadcrumb">
                    <li><a href="<?= WEBROOT.'menu/menu'; ?>">  <?php echo $this->lang['accueil']; ?></a></li>
                    <li class="active"><?php echo $this->lang['listeTransaction']; ?></li>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>


        <div class="row">

            <div class="col-md-12">
                <div class="white-box" >
                    <div class="">
                        <a href="<?= WEBROOT.'reporting/exportJ'?>" target="_blank" class="btn btn-plus pull-right m-l-20  waves-effect waves-light" >
                            <i class="fa fa-file-pdf-o"></i> <?= $this->lang['export']; ?>
                        </a>
                    </div>



            <table class="table table-bordered table-hover table-responsive processing"
                   data-url="<?= WEBROOT; ?>reporting/listeTransactionPro" >
                <thead>
                <tr>
                    <th><?php echo $this->lang['labdate_transaction']; ?></th>
                    <th><?php echo $this->lang['labnum_transaction']; ?></th>
                    <th><?php echo $this->lang['labmontant_transation']; ?></th>
                    <th><?php echo $this->lang['labnumcaisse']; ?></th>


                </tr>
                </thead>
            </table>
        </div>

            </div>


        </div>
    </div>

</div>

