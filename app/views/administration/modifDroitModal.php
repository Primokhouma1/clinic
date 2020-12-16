<form id="my-form" class="form-inline form-validator" data-type="update" role="form" name="form"
      action="<?= WEBROOT ?>administration/updateDroit" method="post">
    <div class="modal-header">
        <button type="button" class="close" aria-hidden="true" data-dismiss="modal">×</button>
        <h4 class="modal-title"><?php echo $this->lang['modifDroit']; ?></h4>
    </div>
    <div class="modal-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-3"></div>
                <div class="col-sm-6">
                    <div class="form-group" style="width: 100%;padding: 10px;">
                        <label for="droit" class="control-label"><?php echo $this->lang['labDroit']; ?></label>
                        <input type="text" id="droit" name="droit" value="<?= $droit->droit ?>" class="form-control"
                               placeholder="Droit" style="width: 100%">
                    </div>
                    <!--<div class="form-group" style="width: 100%;padding: 10px;">
                        <label for="sous_module" class="control-label">Sous Module</label>
                        <input type="text" id="sous_module" name="sous_module"  value="<?php /*= $droit->sous_module */ ?>" class="form-control" placeholder="Sous Module" style="width: 100%">
                    </div>
                    <div class="form-group" style="width: 100%;padding: 10px;">
                        <label for="module" class="control-label">Module</label>
                        <input type="text" id="module" name="module"  value="<?php /*= $droit->module */ ?>" class="form-control" placeholder="Module" style="width: 100%">
                    </div>-->
                    <div class="form-group" style="width: 100%;padding: 10px;">
                        <label for="module" class="control-label"><?php echo $this->lang['listeModule']; ?></label>

                        <select required id="fk_module" name="fk_module" class="form-control">
                            <?php foreach ($module as $oneModule) { ?>
                                <option value="<?= $oneModule->id; ?>" <?php if ($droit->fk_module == $oneModule->id) echo "selected=selected" ?> > <?= $oneModule->libelle; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group" style="width: 100%;padding: 10px;">
                        <label for="controller" class="control-label"><?php echo $this->lang['labController']; ?></label>
                        <input type="text" id="controller" name="controller" value="<?= $droit->controller ?>"
                               class="form-control" placeholder="Controller" style="width: 100%">

                    </div>
                    <div class="form-group" style="width: 100%;padding: 10px;">
                        <label for="action" class="control-label"><?php echo $this->lang['labAction']; ?></label>
                        <input type="text" id="action" name="action" value="<?= $droit->action ?>" class="form-control"
                               placeholder="Action" style="width: 100%">
                        <?php print $token; ?>
                        <input type="hidden" name="id" value="<?= base64_encode($droit->id) ?>">
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

