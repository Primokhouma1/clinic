<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <h4 class="page-title"><?php echo $this->lang['listeClient']; ?></h4></div>
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">

                <ol class="breadcrumb">
                    <li><a href="#"> <?php echo $this->lang['tabBord']; ?></a></li>
                    <li class="active"><?php echo $this->lang['listeClient']; ?></li>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="row bg-title">
            <div class="row col-lg-12">

                <table class="table table-bordered table-hover table-responsive dataTable">
                    <thead>
                      <tr>
                        <th><?php echo $this->lang['labphoto']; ?></th>
                        <th><?php echo $this->lang['labprenom']; ?></th>
                        <th><?php echo $this->lang['labnom']; ?></th>
                          <th><?php echo $this->lang['labadresse']; ?></th>
                        <th><?php echo $this->lang['labidcarte']; ?></th>
                        <?php if ($this->_USER) {
                            if ($this->_USER->admin == 1 || \app\core\Utils::getModel('client')->__authorized($this->_USER->idprofil, 'client', 'modifClientModal') > 0) { ?>
                                <th><?php echo $this->lang['labAction']; ?></th><?
                            }
                        } ?>
                    </tr>
                    </thead>
                    <tbody>

                    <?php foreach ($client as $oneClient) { ?>
                        <tr>
                             <td><img src="<?=$oneClient->photoPATH;?>" style="width: 50px;height: 50px;"/></td>
                            <td><?= $oneClient->FirstName; ?></td>
                            <td><?= $oneClient->LastName; ?></td>
                            <td><?= $oneClient->Address; ?></td>
                            <td><?= $oneClient->id_carte; ?></td>
                            <?php if ($this->_USER) {
                            if ($this->_USER->admin == 1 || \app\core\Utils::getModel('client')->__authorized($this->_USER->idprofil, 'client', 'modifClientModal') > 0) { ?>
                                <td><a href="<?= WEBROOT."client/detailClient/".base64_encode($oneClient->id);?>"> <i class="fa fa-search"></i> </a></td>
                                <?php }
                            } ?>
                        </tr>
                    <?php }  ?>
                    </tbody>
                </table>
                <?php print $token;?>
            </div>
        </div>
    </div>

</div>

