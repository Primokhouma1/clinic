<form enctype="multipart/form-data" class="form-inline form-validator" data-type="update" role="form" name="form" action="<?= WEBROOT ?>moyen/<?= (isset($dist->rowid)?'updateMoyen':'addMoyen') ?>" method="post">
    <div class="modal-header">
        <button type="button" class="close" aria-hidden="true" data-dismiss="modal">×</button>
        <h4 class="modal-title"><?= (isset($dist->rowid)?'Modification MOYEN DE PAIEMENT':'Nouveau MOYEN DE PAIEMENT') ?></h4>
    </div
    <div class="modal-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-2"></div>
                <div class="col-sm-8">
                    <div class="white-box">
                        <ul class="nav nav-tabs tabs customtab">
                            <li class="tab active">
                                <a href="#mesinfos" data-toggle="tab" >
                                <span class="visible-xs">
                                    <i class="fa fa-info"></i>
                                </span>
                                    <span class="hidden-xs">Informations MOYEN DE PAIEMENT</span>
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active af fa-" id="mesinfos">
                                <div class="form-group" style="width: 100%;padding: 10px;">
                                    <label for="nom" class="control-label"><?= $this->lang['moyenpaie'] ?> </label>
                                    <input required type="text" id="label" name="dist[label]" value="<?= $dist->label ?>" class="form-control" placeholder="<?= $this->lang['moyenpaie'] ?>" style="width: 100%">
                                </div>
                                <?php if(isset($dist->rowid)) { ?>
                                    <input type="hidden" name="dist[rowid]" value="<?= $dist->rowid ?>">
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2"></div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-success confirm" data-form="my-form" type="submit"><i class="fa fa-check"></i> <?= $this->lang["btnValider"] ?></button>
            <button class="btn btn-default" type="button" data-dismiss="modal"> <i class="fa fa-times"></i> <?= $this->lang["btnFermer"] ?> </button>
        </div>
</form>

<script>




</script>
