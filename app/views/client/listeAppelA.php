
<div id="page-wrapper">
    <div class="container-fluid">


        <div class="row bg-title">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <h4 class="page-title"><?php echo $this->lang['appelfonds'];?></h4></div>

            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">

                <ol class="breadcrumb">
                    <li><a href="<?= WEBROOT.'menu/menu'; ?>"><?php echo $this->lang['accueil']; ?></a></li>
                    <li class="active"><?php echo $this->lang['appelfonds']; ?></li>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>




        <div class="row">
            <div class="col-md-12">
                <div class="white-box">
                    <div class="row">
                        <div class="col-lg-12">
                            <table class="table table-bordered table-hover table-responsive processing" data-url="<?= WEBROOT; ?>appel/listeAppelsFondsPro">
                                <thead>
                                <tr>

                                    <th><?php echo $this->lang['date']; ?></th>
                                    <th><?php echo $this->lang['labmontant']; ?></th>
                                    <th><?php echo $this->lang['marchand']; ?></th>
                                    <th><?php echo $this->lang['thEtat']; ?></th>
                                    
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




