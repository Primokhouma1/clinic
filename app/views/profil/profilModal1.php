<form enctype="multipart/form-data" class="form-inline form-validator" data-type="update" role="form" name="form" action="<?= WEBROOT ?>profil/<?= (isset($dist->rowid)?'updateProfil':'addProfil') ?>" method="post">
    <div class="modal-header">
        <button type="button" class="close" aria-hidden="true" data-dismiss="modal">×</button>
        <h4 class="modal-title"><?= (isset($dist->rowid)?'Modification PROFIL':'Nouveau PROFIL') ?></h4>
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
                                    <span class="hidden-xs">Informations PROFIL</span>
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active af fa-" id="mesinfos">
                                <div class="form-group" style="width: 100%;padding: 10px;">
                                    <label for="nom" class="control-label"><?= $this->lang['profils'] ?> </label>
                                    <input required type="text" id="libelle" name="dist[libelle]" value="<?= $dist->libelle ?>" class="form-control" placeholder="<?= $this->lang['profils'] ?>" style="width: 100%">
                                </div>
                                <div class="form-group" style="width: 100%;padding: 10px;">
                                    <label for="module" class="control-label"><?php echo $this->lang['listeModule']; ?> </label>
                                    <select id="fk_modulemarchand" name="fk_modulemarchand" class="form-control" style="width: 100%" required>
                                        <option value="" > Selectionnez le module</option>
                                        <?php foreach ($this->data["profil"] as $oneModule) { ?>
                                            <option value="<?= $oneModule->id; ?>" > <?= $oneModule->libelle; ?></option>
                                        <?php }  ?>
                                    </select>
                                </div>
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
