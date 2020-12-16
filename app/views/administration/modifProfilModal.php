<form id="my-form" class="form-inline form-validator" data-type="update" role="form" name="form"
      action="<?= WEBROOT ?>administration/updateProfil" method="post">
    <div class="modal-header">
        <button type="button" class="close" aria-hidden="true" data-dismiss="modal">×</button>
        <h4 class="modal-title"><?php echo $this->lang['modifProfil']; ?></h4>
    </div>
    <div class="modal-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-3"></div>
                <div class="col-sm-6">
                    <div class="form-group" style="width: 100%;padding: 10px;">
                        <label for="profil" class="control-label"><?php echo $this->lang['labProfil']; ?></label>
                        <input type="text" id="profil" name="profil" value="<?= $profil->profil ?>" class="form-control"
                               placeholder="profil" style="width: 100%">

                    </div>
                    <div class="form-group" style="width: 100%;padding: 10px;">
                        <label for="module" class="control-label"><?php echo $this->lang['listeTypep']; ?></label>
                        <select required id="fk_typeprofil" name="fk_typeprofil" class="form-control">
                            <?php foreach ($typep as $onetypep) { ?>
                                <option value="<?= $onetypep->id; ?>" <?php if ($profil->fk_typeprofil == $onetypep->id) echo "selected=selected" ?> > <?= $onetypep->libelle; ?></option>
                            <?php } ?>
                        </select>
                        <?php print $token; ?>
                        <input type="hidden" name="id" value="<?= base64_encode($profil->id) ?>">
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

