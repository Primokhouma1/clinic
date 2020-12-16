<form id="validation" class="form-inline form-validator" data-type="update" role="form" name="form"
      action="<?= WEBROOT ?>administration/ajoutProfil" method="post">
    <div class="modal-header">
        <button type="button" class="close" aria-hidden="true" data-dismiss="modal">×</button>
        <h4 class="modal-title"><?php echo $this->lang['ajoutProfil']; ?></h4>
    </div>
    <div class="modal-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-3"></div>
                <div class="col-sm-6">
                    <div class="form-group" style="width: 100%;padding: 10px;">
                        <label for="profil" class="control-label"><?php echo $this->lang['labProfil']; ?></label>
                        <input type="text" id="profil" name="profil" class="form-control" placeholder="profil"
                               style="width: 100%">
                        <span class="help-block with-errors"> </span>

                    </div>
                    <div class="form-group" style="width: 100%;padding: 10px;">
                        <label for="module" class="control-label">Liste des Types de profil </label>

                        <select id="fk_typeprofil" name="fk_typeprofil" class="form-control" style="width: 100%">
                            <option value=""> Selectionnez le type de profil</option>
                            <?php foreach ($typep as $oneTypep) { ?>
                                <option value="<?= $oneTypep->id; ?>"> <?= $oneTypep->libelle; ?></option>
                            <?php } ?>
                        </select>
                        <?php print $token; ?>
                    </div>
                </div>
                <div class="col-sm-3"></div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button class="btn btn-success confirm" data-form="my-form" type="submit"><i class="fa fa-check"></i> <?php echo $this->lang['btnValider']; ?>
        </button>
        <button class="btn btn-default" type="button" data-dismiss="modal"><i class="fa fa-times"></i> <?php echo $this->lang['btnFermer']; ?> </button>
    </div>
</form>
<script>
    $('#validation').formValidation({
            framework: 'bootstrap',
            fields: {
                profil: {
                    validators: {
                        notEmpty: {
                            message: '<?= $this->lang['profilObligatoire']; ?>'
                        }
                    }
                }
            }
        }
    );
</script>