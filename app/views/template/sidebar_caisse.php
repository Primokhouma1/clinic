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


                <li>
                    <a href="<?php echo WEBROOT; ?>encaissement/listeEncaissement">
                        <i data-icon="/" class="linea-icon linea-basic fa-fw"></i>
                        <span class="hide-menu"><?php echo $this->lang['encaissement']; ?></span>
                    </a>
                </li>


                <li>
                    <a href="<?php echo WEBROOT; ?>affectationcaisse/affectationcaisse">
                        <i data-icon="/" class="linea-icon linea-basic fa-fw"></i>
                        <span class="hide-menu"><?php echo $this->lang['affectationcaisse']; ?></span>
                    </a>
                </li>


                <li>
                    <a href="<?php echo WEBROOT; ?>affectationcaisse/calendrierAffectationCaisse">
                        <i data-icon="/" class="linea-icon linea-basic fa-fw"></i>
                        <span class="hide-menu"><?php echo $this->lang['calendrieraffectation']; ?></span>
                    </a>
                </li>


        </ul>
    </div>
</div>