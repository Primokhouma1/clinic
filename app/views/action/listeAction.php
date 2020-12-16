
<div id="page-wrapper">
    <div class="container-fluid">

        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title"><?php echo $this->lang['listeAction']; ?></h4> </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

                <ol class="breadcrumb">
                    <li><a href="<?= WEBROOT.'menu/menu'; ?>">  <?php echo $this->lang['accueil']; ?></a></li>
                    <li class="active"><?php echo $this->lang['listeAction']; ?></li>
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

                               <!-- <button type="button" class="open-modal btn btn-default"
                                                data-modal-controller="action/ajoutActionModal"
                                                data-modal-view="<?/*= base64_encode("action") */?>/<?/*= base64_encode("ajoutActionModal") */?>">
                                            <?php /*echo $this->lang['btnAjouter']; */?>
                                </button>-->

                            </h3>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                <table class="table table-bordered table-hover table-responsive processing"
                       data-url="<?= WEBROOT; ?>action/listeActionPro">
                    <thead>
                    <tr>

                        <th><?php echo $this->lang['labAction']; ?></th>
                        <th><?php echo $this->lang['labController']; ?></th>
                        <th><?php echo $this->lang['listmodule']; ?></th>
                        <th><?php echo $this->lang['thEtat']; ?></th>
                         <th><?php echo $this->lang['labAction']; ?></th>
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




