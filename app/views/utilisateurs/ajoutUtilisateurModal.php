<form id="my-form" class="form-inline form-validator" data-type="update" role="form" name="form"
      action="<?= WEBROOT ?>utilisateurs/ajoutUtilisateurs" method="post">
    <div class="modal-header">
        <button type="button" class="close" aria-hidden="true" data-dismiss="modal">×</button>
        <h4 class="modal-title"><?php echo $this->lang['ajoutUtilisateur']; ?></h4>
    </div>

    <div class="modal-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-3"></div>
                <div class="col-sm-6">
                    <div class="form-group" style="width: 100%;padding: 10px;">
                        <label for="prenom" class="control-label"><?php echo $this->lang['labprenom']; ?></label>
                        <input type="text" id="prenom" name="prenom" class="form-control" placeholder="Prenom"
                               style="width: 100%" required>
                        <span class="help-block with-errors"> </span>
                    </div>
                    <div class="form-group" style="width: 100%;padding: 10px;">
                        <label for="nom" class="control-label"><?php echo $this->lang['labnom']; ?></label>
                        <input type="text" id="nom" name="nom" class="form-control" placeholder="Nom"
                               style="width: 100%" required>
                        <span class="help-block with-errors"> </span>
                    </div>
                    <div class="form-group" style="width: 100%;padding: 10px;">
                        <label for="email" class="control-label"><?php echo $this->lang['labemail']; ?></label>
                        <input type="email" id="email" name="email" class="form-control" placeholder="Adresse email"
                               style="width: 100%" onchange="verifEmail()" required>
                        <span id="msg2"></span>
                        <span class="help-block with-errors"> </span>
                    </div>
                    <div class="form-group" style="width: 100%;padding: 10px;">
                        <label for="login" class="control-label"><?php echo $this->lang['labLogin']; ?></label>
                        <input type="text" id="login" name="login" class="form-control" placeholder="Login"
                               style="width: 100%" required>
                        <span class="help-block with-errors"> </span>
                    </div>
                    <div class="form-group" style="width: 100%;padding: 10px;">
                        <label for="telephone" class="control-label"><?php echo $this->lang['labtel']; ?></label>
                        <input type="tel" id="tel" name="telephone" class="form-control" placeholder="telephone"
                               style="width: 100%" required>
                        <span class="help-block with-errors"> </span>
                    </div>
                    <div class="form-group" style="width: 100%;padding: 10px;">
                        <label for="profil" class="control-label"><?php echo $this->lang['listeProfil']; ?> </label>
                        <select id="fk_profil" name="fk_profil" class="form-control" style="width: 100%">
                            <option value="" > Selectionnez le profil</option>
                            <?php foreach ($this->data["profil"] as  $oneProfil) { ?>
                                <option value="<?= $oneProfil->id; ?>" > <?= $oneProfil->libelle ?></option>
                            <?php }  ?>
                        </select>
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

    function verifEmail(){
      //  alert(document.getElementById('email').value);
        $.ajax({
            type: "POST",
            url: "<?= WEBROOT.'utilisateurs/verifExistenceEmail'; ?>",

            data: "email="+document.getElementById('email').value,
            success: function(data) {
console.log(data)
                if(parseInt(data) == -1){
                    $('#msg2').html("<p style='color:#F00;display: inline;border: 1px solid #F00'> <?= $this->lang['email_existe']; ?></p>");
                    $("#valider").attr("disabled","disabled");
                    document.getElementById('email').value = '';
                }
                else if(data== 1){
                    $('#msg2').html("");
                    $("#valider").removeAttr("disabled","disabled");
                }
            }
        });
    }

    $('input[type="tel"]').intlTelInput({
        utilsScript: '<?= ASSETS;?>plugins/telPlug/js/utils.js',
        autoPlaceholder: true,
        preferredCountries: [ 'sn', 'mg','gm', 'gb','ci'],
        initialDialCode: true,
        nationalMode: false
    });
</script>
