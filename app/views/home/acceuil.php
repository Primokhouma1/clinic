<link href="<?php echo ASSETS;?>plugins/passtrength/passtrength.css" rel="stylesheet" type="text/css">

<!-- Preloader -->
<div class="preloader">
    <div class="cssload-speeding-wheel"></div>
</div>
<section id="wrapper" class="login-register">
    <div class="login-box login-sidebar">
        <div class="blue-box">
            <form class="form-horizontal form-material" id="loginform" data-type="update" role="form" name="form" action="<?= WEBROOT ?>home/login" method="post">
                <div class="form-group m-t-40">
                    <div class="col-xs-12">
                        <label for="profil" class="control-label"><?php echo $this->lang['labLogin']; ?></label>
                        <input class="form-control" type="text" name="login" id="login" required placeholder="<?php echo $this->lang['labLogin']; ?>" autocomplete="off" style="color: white">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-12">
                        <label for="profil" class="control-label"><?php echo $this->lang['labpwd']; ?></label>
                        <input type="password" id="mot_de_passe" name="password" required class="form-control" placeholder="<?php echo $this->lang['labpwd']; ?>" autocomplete="off" style="color: white; width: 100%">

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

                        <button type="submit"  class="btn btn-connecter btn-lg btn-block text-uppercase waves-effect waves-light"><?php echo $this->lang['btconnecter']; ?></button>

                    </div>
                </div>

            </form>

        </div>
        <footer class="footer text-center" style="background-color: #fff;color: #2e4f88" > © <?php echo $this->lang['']; ?></footer>
    </div>

</section>

<!-- Bootstrap Core JavaScript -->
<script src="<?php echo ASSETS;?>plugins/passtrength/jquery.passtrength.js"></script>

<script>

    $('#mot_de_passe').passtrength({
        tooltip: true,
        textWeak: "Faible",
        textMedium: "Moye",
        textStrong: "Fort",
        textVeryStrong: "Très fort",
        minChars: 8,
        passwordToggle: true,
        eyeImg : "<?php echo WEBROOT ?>assets/plugins/images/eye.svg" // toggle icon

    });
</script>




