<form id="my-form" class="form-inline form-validator" data-type="update" role="form" name="form"
      action="<?= WEBROOT ?>action/updateAction" method="post">
    <div class="modal-header">
        <button type="button" class="close" aria-hidden="true" data-dismiss="modal">×</button>
        <h4 class="modal-title"><?php echo $this->lang['modifAction']; ?></h4>
    </div>
    <div class="modal-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-3"></div>
                <div class="col-sm-6">

                    <div class="form-group" style="width: 100%;padding: 10px;">
                        <label for="module" class="control-label"><?php echo $this->lang['listeModule']; ?></label>

                        <select required id="fk_modulemarchand" name="fk_modulemarchand" class="form-control" style="width: 100%">
                            <?php foreach ($module as $oneModule) { ?>
                                <option value="<?= $oneModule->rowid; ?>" <?php if ($action->fk_modulemarchand  == $oneModule->rowid) echo "selected=selected" ?> > <?= $oneModule->label; ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group" style="width: 100%;padding: 10px;">
                        <label for="action" class="control-label"><?php echo $this->lang['thdroit']; ?></label>
                        <input type="text" id="label" name="label" value="<?= $action->label ?>"
                               class="form-control" placeholder="libelle action" style="width: 100%">
                        <?php //print $token;?>
                    </div>

                    <div class="form-group" style="width: 100%;padding: 10px;">
                        <label for="action" class="control-label"><?php echo $this->lang['labController']; ?></label>
                        <input type="text" id="label" name="controller" value="<?= $action->controller ?>"
                               class="form-control" placeholder="controller" style="width: 100%">
                    </div>

                    <div class="form-group" style="width: 100%;padding: 10px;">
                        <label for="action" class="control-label"><?php echo $this->lang['labMethode']; ?></label>
                        <input type="text" id="label" name="methode" value="<?= $action->methode ?>"
                               class="form-control" placeholder="methode" style="width: 100%">
                    </div>
                    <input type="hidden" name="id" value="<?= base64_encode($action->rowid) ?>">
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

