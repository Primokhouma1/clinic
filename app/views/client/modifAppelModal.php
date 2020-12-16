<form id="my-form" class="form-inline form-validator" data-type="update" role="form" name="form"
      action="<?= WEBROOT ?>client/validateAppel" method="post">
    <div class="modal-header">
        <button type="button" class="close" aria-hidden="true" data-dismiss="modal">×</button>
        <h4 class="modal-title"><?php echo $this->lang['validAppel']; ?></h4>
    </div>
    <div class="modal-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-3"></div>
                <div class="col-sm-6">
                    <div class="form-group" style="width: 100%;padding: 10px;">
                        <label for="module" class="control-label"><?php echo $this->lang['utilisateur']; ?></label>
                        <input type="text" id="label1" value="<?= $appel->prenom.' '.$appel->nom?>" class="form-control" readonly style="width: 100%">
                        <label for="module" class="control-label"><?php echo $this->lang['marchand']; ?></label>
                        <input type="text" id="label2" value="<?= $appel->marchand?>" class="form-control" readonly style="width: 100%">
                        <label for="module" class="control-label"><?php echo $this->lang['labmontant']; ?></label>
                        <input type="text" id="montant" name="montant" value="<?= $appel->montant?>" class="form-control" readonly style="width: 100%">
                        <input type="hidden" name="id" value="<?= $appel->id ?>">
                    </div>
                </div>
                <div class="col-sm-3"></div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button class="btn btn-success confirm" data-form="my-form" type="submit"><i class="fa fa-check"></i> <?php echo $this->lang['btnValider']; ?>
        </button>
        <button class="btn btn-default" type="button" data-dismiss="modal"><i class="fa fa-times"></i> <?php echo $this->lang['btnFermer']; ?></button>
    </div>
</form>

