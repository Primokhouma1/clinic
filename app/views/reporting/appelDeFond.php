
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <h4 class="page-title"><?php echo $this->lang['appelDeFond'];?></h4></div>

            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">

                <ol class="breadcrumb">
                    <li><a href="#"><?php echo $this->lang['tabBord']; ?></a></li>
                    <li class="active"><?php echo $this->lang['appelDeFond']; ?></li>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="row bg-title">
            <div class="row">
            <div class="col-md-8">

                <form id="validation" class="form-inline form-validator" data-type="update" role="form" name="form" action="<?= WEBROOT ?>reporting/ajoutappelDeFond" method="post">
                    <div class="form-group" style="width: 100%;padding: 10px;">
                        <label for="montant" class="control-label"><?php echo $this->lang['labmontant']; ?></label>
                        <input type="text" id="montant" name="montant" class="form-control" placeholder="montant"
                               style="width: 100%">
                        <span class="help-block with-errors"> </span>
                        <?php print $token; ?>

                    </div>
                    <div class="pull-right">
                        <button class="btn btn-success" data-form="my-form" type="submit"><i class="fa fa-check"></i> <?php echo $this->lang['btnValider']; ?> </button>
                    </div>
                </form>
            </div>
                <div class="col-md-6"></div>
            </div>

        </div>

    </div>
</div>