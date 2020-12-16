<div class="modal-header">
    <button type="button" class="close" aria-hidden="true" data-dismiss="modal">×</button>
    <h4 class="modal-title panel-title"> Affectation droit pour le profil : <?= $this->data['profil']->libelle; ?> </h4>
</div>
<div class="modal-body">
    <div class="container-fluid">
        <form id="my-form" class="form-horizontal form-validator" data-type="update" role="form" name="form"
              action="<?= WEBROOT ?>profil/affectDroitProfil" method="post">

            <div class="row">
                <div class="col-md-12">
                    <?php
//                    print_r($this->data['actions']);
                    foreach ($droit as $key => $module) {
                        if($module->code == "MGM"){
                        $listDroit = [];
                        foreach ($module->sous_modules as $sous_module) { foreach ($sous_module->droits as $action) {  array_push($listDroit, $action->id);}}?>
                            <div class="form-group col-md-12">
                                <hr>
                                <div class="form-check checkbox checkbox-success">
                                    <input data-placement="top" data-toggle="tooltip" id="Mod_<?= $module->id ?>"
                                           data-original-title="Cocher toutes actions du module <?= $module->libelle; ?>"
                                           type="checkbox" class="cl_module" onchange="submitDroit({'profil_id':<?= $profil_id ?>, 'droit_id':'<?= implode(',', $listDroit) ?>', 'etat': (this.checked == true ? 1 : 0)}, <?= $module->id ?>)"
                                           value="">
                                    <label class="label-text" for="defaultCheck2">
                                        <b><?= 'MODULE ' . strtoupper($module->libelle).''; ?></b>
                                    </label>
                                    <i class="fa fa-eye" style="position: absolute;right: 15px;cursor: pointer" onclick="showLaw(this, <?= $key; ?>)"></i>
                                </div>
                            </div>

                            <div id="law-<?= $key; ?>" style="display: none">
                                <?php foreach ($module->sous_modules as $sous_module) {
                                foreach ($sous_module->droits as $action) {
                                    $affectation = \app\core\Utils::getModel('profil')->getAffectations($profil_id, $action->id);
                                  //  print "<pre>";var_dump($affectation);die;
                                    ?>
                                    <div class="form-group col-md-6">
                                        <div class="form-check checkbox checkbox-success">
                                            <div class="form-check ">
                                                <div class="checkbox checkbox-success">
                                                    <input id="law-<?=$action->id?>" type="checkbox" name="actions[]" onchange="submitDroit({'profil_id':<?= $profil_id ?>, 'droit_id':<?=$action->id?>, 'etat': (this.checked ? 1 : 0)})" class="m_<?= $module->id; ?>" <?= (count($affectation) == 1 && $affectation[0]->etat == 1 ? "checked" : "") ?> >
                                                    <label class="label-text" for="defaultCheck2">
                                                        <?= $action->libelle; ?>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php }
                                } ?>
                            </div>

                        <?php
                        }
                    } ?>
                </div>
            </div>
            <div class="form-group">
                <input type="hidden" id="date_creation" name="date_creation" value="<?= date('Y-m-d H:i:s'); ?>">
                <input type="hidden" id="user_creation" name="user_creation" value="<?= $this->_USER->id; ?>">
                <input type="hidden" id="idprofil" name="idprofil" value="<?= $this->data['profil']->id; ?>">
            </div>

            <div class="modal-footer" style="margin-top: 25px;">
                <div class="form-actions">
                    <button type="reset" class="btn btn-default"
                            data-dismiss="modal"><?= $this->lang['btnFermer']; ?></button>

                   <!-- <button type="submit" id="valider" class="btn btn-success"><i
                            class="fa fa-check"></i><?/*= $this->lang['btnValider']; */?></button>-->
                </div>
            </div>
        </form>

    </div>


    <script>
        function submitDroit(objLaw, c_m = 0) {
            $.post(
                "<?= WEBROOT ?>profil/affectDroitProfil",
                objLaw,
                function (data) {},
                "JSON"
            );
            if(c_m != 0) {
                var c_m_etat = $('#Mod_'+c_m)[0].checked;
                if(c_m_etat) {
                    $('.m_'+c_m).each(function (key, value) {
                        $(value)[0].checked = true;
                    })
                }
                else $('.m_'+c_m).attr("checked", false);
            }
        }

        function showLaw(btn, id) {
            let elem = $("#law-"+id);
            if(elem.css("display").toString() === 'none'){
                elem.slideDown();
                $(btn)[0].className = 'fa fa-eye-slash'
            }
            else{
                elem.slideUp();
                $(btn)[0].className = 'fa fa-eye'
            }
        }
    </script>
