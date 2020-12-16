
<div id="page-wrapper">
    <div class="container-fluid">


        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title"><?php echo $this->lang['gestprofil']; ?></h4> </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

                <ol class="breadcrumb">
                    <li><a href="<?= WEBROOT.'menu/menu'; ?>">  <?php echo $this->lang['accueil']; ?></a></li>
                    <li class="active"><?php echo $this->lang['gestprofil']; ?></li>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>



        <div class="container-fluid white-box">
            <div class="row">
                <div class="col-md-12 ">
                        <<button class="pull-right open-modal btn btn-default"
                                data-modal-controller="profil/profilModal"
                                data-modal-view="profil/profilModal"><?= $this->lang['nouvprofil']?>
                        </button>
                </div>
            </div>
        </div>
        <div class="container-fluid white-box">
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered table-hover table-responsive processing" data-url="<?= WEBROOT; ?>profil/listeProfilProcessing">
                        <thead>
                        <tr>
                            <th><?= $this->lang['thProfil'] ?></th>
                            <th><?= $this->lang['thEtat'] ?></th>
                            <th><?= $this->lang['action'] ?></th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>

        </div>
    </div>

</div>




