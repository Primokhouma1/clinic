
<div class="user-profile">
    <div class="dropdown user-pro-body">
        <div><img src="<?= WEBROOT;?>pictures/logoUser/user.png" alt="user-img" class="img-circle"></div>
        <a href="#" class="dropdown-toggle u-dropdown" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $this->_USER->prenom.' '.$this->_USER->nom;?><span class="caret"></span></a>
        <ul class="dropdown-menu animated flipInY">
            <li>
                <a href="<?= WEBROOT."administration/profilUser" ?>">
                    <i class="ti-user"></i>&nbsp;&nbsp;<?php echo $this->lang['infoUser']; ?>
                </a>
            </li>
            <li><a href="<?php echo WEBROOT."home/unlogin" ?>"><i class="fa fa-power-off"></i>&nbsp;&nbsp;<?php echo $this->lang['se_deconnecter']; ?></a></li>
        </ul>
    </div>
</div>


<div class="user-profile" style="font-weight: bold;padding: 1px 0 20px;color: #2e4f88;background-color: #fff">

    <?php
    $admin = $this->_USER->admin;
    $type = $this->_USER->type;
    $profil = $this->_USER->fk_profil;

    if($this->sidebar=='sidebar_admin') echo  '<br>'.mb_strtoupper($this->lang['administration']).'</br>';
    if($this->sidebar=='sidebar_client') echo  '<br>'.mb_strtoupper($this->lang['appelfonds']).'</br>';
    if($this->sidebar=='sidebar_caisse') echo  '<br>'.mb_strtoupper($this->lang['gestion_caisse']).'</br>';
    if($this->sidebar=='sidebar_reporting') echo  '<br>'.mb_strtoupper($this->lang['reporting']).'</br>';

    ?>

</div>
