<form id="validation" class="form-inline form-validator" data-type="update" role="form" name="form"
      action="<?= WEBROOT ?>encaissement/regerenereCodeMarchand" method="post">
<div class="modal-header">
    <button type="button" class="close" aria-hidden="true" data-dismiss="modal">×</button>
    <h4 class="modal-title"><?= $this->lang["regeneenc"] ?></h4>
</div>
<div class="modal-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-2"></div>
            <div class="col-sm-8 text-center">
                <p class="text-info" style="color: #0b0b0b; font-size: 14px;" ><?= $this->lang["vsregenecm"] ?><?= $enc->numcaisse ?></p>
                    <input type="hidden" id="id" name="id" class="form-control" value="<?= $enc->rowid; ?>">

            </div>
            <div class="col-sm-2"></div>
        </div>
    </div>
</div>
    <div class="modal-footer">
        <button  class="btn btn-danger pull-left" type="button" data-dismiss="modal"> <i class="fa fa-times"></i> <?= $this->lang["ref_non"] ?> </button>
        <button class="btn btn-success confirm pull-right" type="submit" > <i class="fa fa-check"></i> <?= $this->lang["ref_oui"] ?> </button>
    </div>
</form>
<style>

.modal-dialog .text-center{
    font-size: 26px;
    font-weight: 400;
}
</style>