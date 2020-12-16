<form id="validation" class="form-inline form-validator" data-type="update" role="form" name="form"
      action="<?= WEBROOT ?>administration/updatepwdUtilisateur" method="post">
    <div class="modal-header">
        <button type="button" class="close" aria-hidden="true" data-dismiss="modal">×</button>
        <h4 class="modal-title"><?php echo $this->lang['modifpwdUtilisateur']; ?></h4>
    </div>
    <div class="modal-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-3"></div>
                <div class="col-sm-6">
                <div class="form-group" style="width: 100%;padding: 10px;">
                        <label for="motdepasse" class="control-label"><?php echo $this->lang['labpwd']; ?></label>
                        <div style="width: 100%">
                            <input type="password" id="password" name="password"
                                   class="form-control" placeholder="Mot de passe" style="width: 90%" onchange="verifPassword()" onclick="clear(this)">
                            <span id="passError1"></span>
                        </div>

<!--                        <div id="msg"></div>-->
                    </div>
                    <div class="form-group" style="width: 100%;padding: 10px;">
                        <label for="password" class="control-label"><?php echo $this->lang['labnpwd']; ?></label>
                        <input type="password" id="npassword" name="npassword"  class="form-control" placeholder="Nouveau mot de passe" style="width: 90%">
                    </div>
                    <div class="form-group" style="width: 100%;padding: 10px;">
                        <label for="cpassword" class="control-label"><?php echo $this->lang['labcnpwd']; ?></label>
                        <div style="width: 100%">
                            <input type="password" id="cpassword" name="cpassword" class="form-control" placeholder="Confirmation nouveau mot de passe" style="width: 90%">
                            <span id="passError2"></span>
                        </div>
                         <?php print $token; ?>
                        <input type="hidden" name="id" value="<?= base64_encode($this->_USER->id) ?>">
                    </div>
                   
                </div>
                <div class="col-sm-3"></div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button class="btn btn-success confirm" data-form="my-form" type="submit" id="btnValid"><i class="fa fa-check"></i> <?php echo $this->lang['btnValider']; ?>
        </button>
        <button class="btn btn-default" type="button" data-dismiss="modal"><i class="fa fa-times"></i> <?php echo $this->lang['btnFermer']; ?></button>
    </div>
</form>
<script>
    $('#validation').formValidation({
        framework: 'bootstrap' ,
        fields: {
            password: {
                validators: {
                    notEmpty: {
                        message: '<?= $this->lang['pwdObligatoire']; ?>'
                    }
                }
            },
            npassword: {
                validators: {
                    notEmpty: {
                        message: '<?= $this->lang['npasswordObligatoire']; ?>'
                    }
                }
            },

            cpassword: {
                validators: {
                    notEmpty: {
                        message: '<?= $this->lang['cpasswordObligatoire']; ?>'
                    }
                }
            }
        }
    });
</script>
<script>
    function verifPassword(){  //identifiant
        $.ajax({
            type: "POST",
            url: "<?= WEBROOT.'administration/verifAncienpassword'; ?>",

            data: "password="+document.getElementById('password').value,
            success: function(data) {
                if(data == 1){
                    $('#passError1').html("<p style='color:green;display: inline;'><i class='fa fa-check'></i></p>");
                    $("#password").parent().parent().addClass('has-success')
                }
                else if(data== -1){
                    $('#passError1').html("<p style='color:red;display: inline;'><i class='fa fa-times'></i></p>");
                    $("#password").parent().parent().removeClass('has-success')
                    $("#password").parent().parent().addClass('has-error')
                }
            }
        });
    }

    $('#password').click(function() {
       if($(this).val() != ''){
           $(this).val('')
           $('#passError1').empty()
           $("#password").parent().parent().removeClass('has-success')
           $("#password").parent().parent().removeClass('has-error')
       }
    })

    $('#npassword').click(function() {
        if($(this).val() != ''){
            $(this).val('')
            $('#cpassword').val('')
            $('#passError2').empty()
            $("#cpassword").parent().parent().removeClass('has-success')
            $("#cpassword").parent().parent().removeClass('has-error');
            $("#btnValid").prop('disabled', true)
        }
    })



    $('#cpassword').keyup(function (){
        var npass = $('#npassword').val()


        if ($(this).val() === npass) {
            $('#passError2').html("<p style='color:green;display: inline;'><i class='fa fa-check'></i></p>");
            $("#cpassword").parent().parent().removeClass('has-error');
            $("#cpassword").parent().parent().addClass('has-success');
        }else {
            $('#passError2').html("<p style='color:red;display: inline;'><i class='fa fa-times'></i></p>");
            $("#cpassword").parent().parent().removeClass('has-success')
            $("#cpassword").parent().parent().addClass('has-error')
            $("#btnValid").prop('disabled', true)
        }

    })
</script>