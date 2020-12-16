<form id="validation" class="form-inline form-validator" data-type="update" role="form" name="form"
      action="<?= WEBROOT ?>administration/ajoutUtilisateur" method="post">
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
                               style="width: 100%">
                        <span class="help-block with-errors"> </span>
                    </div>
                    <div class="form-group" style="width: 100%;padding: 10px;">
                        <label for="nom" class="control-label"><?php echo $this->lang['labnom']; ?></label>
                        <input type="text" id="nom" name="nom" class="form-control" placeholder="Nom"
                               style="width: 100%">
                        <span class="help-block with-errors"> </span>
                    </div>
                    <div class="form-group" style="width: 100%;padding: 10px;">
                        <label for="email" class="control-label"><?php echo $this->lang['labemail']; ?></label>
                        <input type="email" id="email" name="email" class="form-control" placeholder="Adresse email"
                               style="width: 100%">
                        <span class="help-block with-errors"> </span>
                    </div>
                    <div class="form-group" style="width: 100%;padding: 10px;">
                        <label for="email" class="control-label"><?php echo $this->lang['lablogin']; ?></label>
                        <input type="text" id="login" name="login" class="form-control" placeholder="Login"
                               style="width: 100%">
                        <span class="help-block with-errors"> </span>
                    </div>
                    <div class="form-group" style="width: 100%;padding: 10px;">
                        <label for="login" class="control-label"><?php echo $this->lang['labLogin']; ?></label>
                        <input type="text" id="login" name="login" class="form-control" placeholder="Login"
                               style="width: 100%">
                        <span class="help-block with-errors"> </span>
                    </div>
                    <div class="form-group" style="width: 100%;padding: 10px;">
                        <label for="password" class="control-label"><?php echo $this->lang['labpassword']; ?></label>
                        <input type="password" id="password" name="password" class="form-control" placeholder="Mot de Passe"
                               style="width: 100%">
                        <span class="help-block with-errors"> </span>
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
            prenom: {
                validators: {
                    notEmpty: {
                        message: '<?= $this->lang['prenomObligatoire']; ?>'
                    },
                    regexp: {
                        regexp: /^[a-z\s]+$/i,
                        message: '<?= $this->lang['prenomLettre']; ?>'
                    }
                }

            },
            nom: {
                validators: {
                    notEmpty: {
                        message: '<?= $this->lang['nomObligatoire']; ?>'
                    },
                    regexp: {
                        regexp: /^[a-z\s]+$/i,
                        message:'<?= $this->lang['nomLettre']; ?>'
                    }
                }

            },
            email: {
                validators: {
                    notEmpty: {
                        message: '<?= $this->lang['emailObligatoire']; ?>'
                    },
                    emailAddress: {
                        message: '<?= $this->lang['emailInvalide']; ?>'
                    }
                }
            },
            login: {
                validators: {
                    notEmpty: {
                        message: '<?= $this->lang['loginObligatoire']; ?>'

                    }
                }
            },
            password: {
                validators: {
                    notEmpty: {
                        message: '<?= $this->lang['passwordObligatoire']; ?>'

                    }
                }
            }
        }
    });
</script>
