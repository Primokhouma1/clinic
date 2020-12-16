
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <h4 class="page-title"><?php echo $this->lang['listeAffectation']; ?></h4> </div>
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">

                <ol class="breadcrumb">
                    <li><a href="#">  <?php echo $this->lang['tabBord']; ?></a></li>
                    <li class="active"><?php echo $this->lang['listeAffectation']; ?></li>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="row bg-title">
            <div class="row col-lg-12">


                <form action="<?= WEBROOT; ?>administration/ajoutaffectation" method="post">
                    <input type="hidden" name="idProfil" value="<?= $idProfil ?>">

                    <div class="panel-heading" style="height: 55px;">
                        <h3 class="panel-title pull-right">
                            <button type="submit" class="btn btn-default"><?php echo $this->lang['btnValider']; ?></button>
                        </h3>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-bordered table-hover table-responsive dataTable">
                                <thead>
                                <tr>
                                    <th><?php echo $this->lang['thSModule']; ?></th>
                                    <th><?php echo $this->lang['thdroit']; ?></th>
                                    <th><input type="checkbox" id="select_all"> check </th>
                                </tr>
                                </thead>
                                <tbody>

                                <?php foreach ($droit as $oneDroit) { ?>
                                    <tr>
                                        <td><?= $oneDroit->sous_module; ?></td>
                                        <td><?= $oneDroit->droit; ?></td>
                                        <td><input <?php if($oneDroit->exite==1) echo 'checked'; ?> name="add[]" type="checkbox" value="<?= $oneDroit->id; ?>"></td>
                                    </tr>
                                <?php }  ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </form>
            </div>
        </div>

        <script>
            $("#select_all").change(function () {
                $("input:checkbox").prop('checked', $(this).prop("checked"));
            });

        </script>
