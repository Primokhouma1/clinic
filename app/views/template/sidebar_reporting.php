<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav slimscrollsidebar">
        <div class="sidebar-head">
            <h3>
                <span class="fa-fw open-close"><i class="ti-menu hidden-xs"></i>
                    <i class="ti-close visible-xs"></i>
                </span>
                <span class="hide-menu">Navigation</span>
            </h3>
        </div>
        <?php include("profil_user.php"); ?>
        <ul class="nav" id="side-menu">

            <?php if($admin == 1 || \app\core\Utils::getModel('profil')->__authorized($profil, 'reporting', 'transaction_du_jour') > 0) { ?>

            <li>
                <a href="<?php echo WEBROOT; ?>reporting/transaction_du_jour">
                    <i data-icon="/" class="linea-icon linea-basic fa-fw"></i>
                    <span class="hide-menu"><?php echo $this->lang['transacjr']; ?></span>
                </a>
            </li>

            <?php } if($admin == 1 || \app\core\Utils::getModel('profil')->__authorized($profil, 'reporting', 'listeTransactionP') > 0) { ?>

            <li>
                <a href="<?php echo WEBROOT; ?>reporting/listeTransactionP">
                    <i data-icon="/" class="linea-icon linea-basic fa-fw"></i>
                    <span class="hide-menu"><?php echo $this->lang['transencp']; ?></span>
                </a>
            </li>
            <?php }?>
        </ul>
    </div>
</div>


