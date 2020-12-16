<style>
    .form-control::placeholder{
        color: #6e6e6e;
    }
</style>
<section id="wrapper" class="login-register3">
    <div class="login-box" style="opacity: 0.9">
        <div class="transparent-box">
            <form class="form-horizontal form-material" id="loginform" data-type="update" role="form" name="form" action="<?= WEBROOT ?>home/updatepassword" method="post">
                <div class="text-center db" style="color: #D86B33; font-size: 16px; font-weight: 400">Modification de votre mot de passe<br/></div>

                <div class="form-group m-t-40">
                    <div class="col-xs-12">
                        <input type="password" id="password1" name="password1" required class="form-control" placeholder="Entrer le nouveau mot de passe" autocomplete="off" style="color: white; width: 100%">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-12">
                        <input type="password" id="password2" name="password2" required class="form-control" placeholder="Confirmer le nouveau mot de passe" autocomplete="off" style="color: white; width: 100%">
                    </div>
                    <?//= $token;?>
                </div>
                <div class="form-group">
                    <div class="col-md-12">
                    </div>
                </div>
                <div class="form-group text-center m-t-20">
                    <div class="col-xs-12" id="msg">
                    </div>
                </div>

                <div class="form-group text-center m-t-20">
                    <div class="col-xs-12">
                        <button type="submit"  class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light">Modifier</button>
                    </div>
                </div>

            </form>

        </div>
        <footer class="footer text-center"> © <?php echo $this->lang['copyright']; ?></footer>
    </div>

</section>

