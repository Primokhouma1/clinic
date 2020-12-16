
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title"><?= $this->lang['gestmoyenpaie'] ?></h4>
            </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

                <ol class="breadcrumb">
                    <li><a href="<?= WEBROOT.'menu/menu'; ?>">  <?php echo $this->lang['accueil']; ?></a></li>
                    <li class="active"><?php echo $this->lang['listeMoyen']; ?></li>
                </ol>
            </div>
        </div>
        <div class="container-fluid white-box">
            <div class="row">
                <div class="col-md-12 ">
                        <button class="pull-right open-modal btn btn-default" data-modal-controller="moyen/moyenModal" data-modal-view="moyen/moyenModal"><?= $this->lang['nouvmoyen'] ?></button>
                </div>
            </div>
        </div>
        <div class="container-fluid white-box">
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered table-hover table-responsive processing" data-url="<?= WEBROOT; ?>moyen/listeMoyenProcessing" data-id="1">
                        <thead>
                        <tr>
                            <th><?= $this->lang['thMoyen'] ?></th>
                            <th><?= $this->lang['thEtat'] ?></th>
                            <th><?= $this->lang['action'] ?></th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>

        </div>
    </div>

</div>




