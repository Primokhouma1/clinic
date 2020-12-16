
<div id="page-wrapper">
    <div class="container-fluid">

        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title"><?php echo $this->lang['list_com']; ?></h4> </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

                <ol class="breadcrumb">
                    <li><a href="<?= WEBROOT.'menu/menu'; ?>">  <?php echo $this->lang['accueil']; ?></a></li>
                    <li class="active"><?php echo $this->lang['list_com']; ?></li>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="white-box">

                    <!--<h3 class="box-title">Blank Starter page</h3> </div>-->

                    <div class="row">
                        <div class="col-lg-12">
                            <h3 class="panel-title pull-right">

                                <?php if ($this->_USER) {
                                    if ($this->_USER->admin == 1 || \app\core\Utils::getModel('module')->__authorized($this->_USER->idprofil, 'module', 'ajoutModuleModal') > 0) { ?>
                                        <button type="button" class="open-modal btn btn-default"
                                                data-modal-controller="module/ajoutModuleModal"
                                                data-modal-view="<?= base64_encode("administration") ?>/<?= base64_encode("ajoutModuleModal") ?>">
                                            <?php echo $this->lang['btnAjouter']; ?>
                                        </button>
                                        <?php
                                    }
                                } ?>

                            </h3>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                <table class="table table-bordered table-hover table-responsive processing"
                       data-url="<?= WEBROOT; ?>module/listeModulePro">
                    <thead>
                    <tr>

                        <th><?php echo $this->lang['thlibModule']; ?></th>
                        <th><?php echo $this->lang['thEtat']; ?></th>

                        <?php if ($this->_USER) {
                            if ($this->_USER->admin == 1 || \app\core\Utils::getModel('module')->__authorized($this->_USER->idprofil, 'module', 'modifModuleModal') > 0) { ?>
                                <th><?php echo $this->lang['labAction']; ?></th><?
                            }
                        } ?>
                    </tr>
                    </thead>
                </table>
                        </div>
                    </div>

                </div>
            </div>

        </div>

    </div>

</div>




