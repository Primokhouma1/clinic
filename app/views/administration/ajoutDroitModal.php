<form id="validation" class="form-inline form-validator" data-type="update" role="form" name="form" action="<?= WEBROOT ?>administration/ajoutDroit" method="post">
    <div class="modal-header">
        <button type="button" class="close" aria-hidden="true" data-dismiss="modal">×</button>
        <h4 class="modal-title"><?php echo $this->lang['ajoutDroit']; ?></h4>
    </div>
    <div class="modal-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-3"></div>
                <div class="col-sm-6">
                    <div class="form-group" style="width: 100%;padding: 10px;">
                        <label for="droit" class="control-label"><?php echo $this->lang['labDroit']; ?></label>
                        <input type="text" id="droit" name="droit" class="form-control" placeholder="Droit" style="width: 100%">
                        <span class="help-block with-errors"> </span>
                    </div>
                    <div class="form-group" style="width: 100%;padding: 10px;">
                        <label for="module" class="control-label"><?php echo $this->lang['listeModule']; ?> </label>
                        <select id="fk_module" name="fk_module" class="form-control" style="width: 100%">
                            <option value="" > Selectionnez le module</option>
                            <?php foreach ($module as $oneModule) { ?>
                                <option value="<?= $oneModule->id; ?>" > <?= $oneModule->libelle; ?></option>
                            <?php }  ?>
                        </select>
                    </div>
                    <div class="form-group" style="width: 100%;padding: 10px;">
                        <label for="controller" class="control-label"><?php echo $this->lang['labController']; ?></label>
                        <input type="text" id="controller" name="controller"  class="form-control" placeholder="Controller" style="width: 100%">
                        <span class="help-block with-errors"> </span>

                    </div>
                    <div class="form-group" style="width: 100%;padding: 10px;">
                        <label for="action" class="control-label"><?php echo $this->lang['labAction']; ?></label>
                        <input type="text" id="action" name="action"  class="form-control" placeholder="Action" style="width: 100%">
                        <span class="help-block with-errors"> </span>
                        <?php print $token;?>
                    </div>

                </div>
                <div class="col-sm-3"></div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button class="btn btn-success confirm" data-form="my-form" type="submit"><i class="fa fa-check"></i> <?php echo $this->lang['btnValider']; ?></button>
        <button class="btn btn-default" type="button" data-dismiss="modal"> <i class="fa fa-times"></i> <?php echo $this->lang['btnFermer']; ?> </button>
    </div>
</form>
<script>
    $('#validation').formValidation({
        framework: 'bootstrap' ,
        fields: {
            droit: {
                validators: {
                    notEmpty: {
                        message: '<?= $this->lang['droitObligatoire']; ?>'
                    }
                }
            },
            controller: {
                validators: {
                    notEmpty: {
                        message: '<?= $this->lang['controllerObligatoire']; ?>'
                    }
                }
            },
            action: {
                validators: {
                    notEmpty: {
                        message: '<?= $this->lang['actionObligatoire']; ?>'

                    }
                }
            }
        }
    });
</script>