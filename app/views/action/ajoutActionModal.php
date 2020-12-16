<form id="validation" class="form-inline form-validator" data-type="update" role="form" name="form"
      action="<?= WEBROOT ?>action/ajoutAction" method="post">

    <div class="modal-header">
        <button type="button" class="close" aria-hidden="true" data-dismiss="modal">×</button>
        <h4 class="modal-title"><?php echo $this->lang['ajoutAction']; ?></h4>
    </div>
    <div class="modal-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-3"></div>
                <div class="col-sm-6">
                    <div class="form-group" style="width: 100%;padding: 10px;">
                        <label for="module" class="control-label"><?php echo $this->lang['listeModule']; ?> </label>
                        <select id="fk_modulemarchand" name="fk_modulemarchand" class="form-control" style="width: 100%" required>
                            <option value="" > Selectionnez le module</option>
                            <?php foreach ($this->data["module"] as $oneModule) { ?>
                                <option value="<?= $oneModule->id; ?>" > <?= $oneModule->libelle; ?></option>
                            <?php }  ?>
                        </select>
                    </div>
                    <div class="form-group" style="width: 100%;padding: 10px;">
                        <label for="profil" class="control-label"><?php echo $this->lang['thdroit']; ?></label>
                        <input type="text" id="label" name="label" class="form-control" placeholder="<?php echo $this->lang['thdroit']; ?>"
                               style="width: 100%" required>
                        <span class="help-block with-errors"> </span>
                        <?php //print $token;?>
                    </div>
                    <div class="form-group" style="width: 100%;padding: 10px;">
                        <label for="profil" class="control-label"><?php echo $this->lang['labController']; ?></label>
                        <input type="text" id="label" name="controller" class="form-control" placeholder="<?php echo $this->lang['labController']; ?>"
                               style="width: 100%" required>
                        <span class="help-block with-errors"> </span>
                    </div>
                    <div class="form-group" style="width: 100%;padding: 10px;">
                        <label for="profil" class="control-label"><?php echo $this->lang['labMethode']; ?></label>
                        <input type="text" id="label" name="methode" class="form-control" placeholder="<?php echo $this->lang['labMethode']; ?>"
                               style="width: 100%" required>
                        <span class="help-block with-errors"> </span>
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
<!--<script>
    $('#validation').formValidation({
            framework: 'bootstrap',
            fields: {
                libelle: {
                    validators: {
                        notEmpty: {
                            message: '<?/*= $this->lang['actionObligatoire']; */?>'
                        }
                    }
                }
            }
        }
    );
</script>-->