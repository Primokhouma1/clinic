
<div id="page-wrapper">
    <div class="container-fluid">


        <div class="row bg-title">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <h4 class="page-title"><?php echo $this->lang['transactitre'];?></h4></div>

            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">

                <ol class="breadcrumb">
                    <li><a href="<?= WEBROOT.'menu/menu'; ?>"><?php echo $this->lang['accueil']; ?></a></li>
                    <li class="active"><?php echo $this->lang['transactitre']; ?></li>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="white-box">
                    <fieldset class="scheduler-border">
                        <legend class="scheduler-border"><?php echo $this->lang['filtre_periodiqueT']; ?></legend>
                        <br/>
                        <form class="form-horizontal" method="POST" action="<?php echo WEBROOT ?>appel/listeReleve">

                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <div class="form-group">
                                    <label for="nom"
                                           class="col-lg-3 col-sm-4 control-label"><?php echo $this->lang['du']; ?></label>
                                    <div class="col-lg-9 col-sm-8">
                                        <input type="text" class="form-control" placeholder="dd-mm-yyyy" name="datedebut" id="from" value="<?php echo $datedebut; ?>" autocomplete="off"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <div class="form-group">
                                    <label for="nom" class="col-lg-3 col-sm-4 control-label"><?php echo $this->lang['au']; ?></label>
                                    <div class="col-lg-9  col-sm-8">
                                        <input type="text" class="form-control" placeholder="dd-mm-yyyy" name="datefin" id="to" value="<?php echo $datefin; ?>" autocomplete="off"/>

                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-1">
                                <button type="submit" class="btn btn-default btn-circle btn-lg" title="Rechercher"><i
                                            class="ti-search"></i></button>
                            </div>

                        </form>
                    </fieldset>

                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="white-box">
                    <div class="">
                        <a href="<?= WEBROOT;?>appel/export<?php if(isset($datedebut) && isset($datefin)) echo "/".$datedebut."/".$datefin?>" target="_blank" class="btn btn-plus pull-right m-l-20  waves-effect waves-light" >
                            <i class="fa fa-file-pdf-o"></i> <?= $this->lang['export']; ?>
                        </a>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <table class="table table-bordered table-hover table-responsive processing" data-url="<?= WEBROOT; ?>appel/listeRelevePro<?php if(isset($datedebut) && isset($datefin)) echo "/".$datedebut."/".$datefin?>">
                                <thead>
                                <tr>

                                    <th><?php echo $this->lang['labdate_transaction']; ?></th>
                                    <th><?php echo $this->lang['labnum_transaction']; ?></th>
                                    <th><?php echo $this->lang['transacavant']; ?></th>
                                    <th><?php echo $this->lang['labmontant_transation']; ?></th>
                                    <th><?php echo $this->lang['transacapres']; ?></th>
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

<script>
    $(function () {

        $("#to").datepicker({
            defaultDate: "+1w",
            changeMonth: true,
            numberOfMonths: 1,
            onClose: function (selectedDate) {
                $("#from").datepicker("option", "maxDate", selectedDate);
            }
        });
        $("#from").datepicker({
            defaultDate: "+1w",
            changeMonth: true,
            numberOfMonths: 1,
            onClose: function (selectedDate) {
                $("#from").datepicker("option", "maxDate", selectedDate);
            }
        });
    });
</script>




