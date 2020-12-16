<?php $soldeavant=intval($soldeavant->data->solde);?>
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <h4 class="page-title"><?php echo $this->lang['newAppelDeFond'];?></h4></div>

            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">

                <ol class="breadcrumb">
                    <li><a href="<?= WEBROOT.'menu/menu'; ?>"><?php echo $this->lang['accueil']; ?></a></li>
                    <li class="active"><?php echo $this->lang['newAppelDeFond']; ?></li>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="white-box">


                    <div class="row">

                        <div class="col-md-2"></div>
                        <div class="col-md-8">


                            <fieldset class="scheduler-border" style="text-align: center">
                                <legend class="scheduler-border"><?php echo $this->lang['newAppelDeFond'].'   <====> '.$this->lang['solde'].' : '. \app\core\Utils::getFormatMoney($soldeavant).' '.$this->lang['Fcfa']; ?></legend>

                                <br>
                                <br>
                                <br>

                                <form class="form-inline">
                                    <div class="form-group mb-2">
                                        <label for="montant" class="sr-only"><?php echo $this->lang['labmontant']; ?></label>
                                        <input type="text" name="montant" oninput="this.value=this.value.replace(/[^0-9]/g,'');" class="form-control" id="montant" placeholder="<?php echo $this->lang['labmontant']; ?>" required>

                                    </div>

                                    <div class="label label-ganger" id="solde" style="display: none"><?= $soldeavant;?></div>

                                    <button type="button" class="btn btn-success mb-2" id="idvalider" onclick="clicked();"> <?php echo $this->lang['btnValider']; ?></button>

                                    <div class="label label-ganger" id="errorMeesage" style="color: red;display: none">
                                        Ce montant est supérieur à votre solde !!
                                    </div>
                                </form>
                                <br>
                                <br>
                                <br>
                            </fieldset>


                        </div>
                        <div class="col-md-2"></div>

                    </div>

                </div>
            </div>

        </div>



        <div class="modal fade" tabindex="-1" role="dialog" id="myModal" data-keyboard="false" data-backdrop="static">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <span><?= $this->lang['confirmontant']?></span><span style="font-weight: bold" id="showMontant"></span> <?php echo $this->lang['Fcfa']?>

                    </div>
                    <div class="modal-footer">
                        <form  id="validation" action="<?= WEBROOT ?>appel/ajoutappelDeFond" method="post">
                            <input type="hidden" name="montant_" id="montan_hide"/>
                            <button type="reset" class="btn btn-default pull-left" data-dismiss="modal">ANNULER</button>
                            <button type="button" name="valider" value="valider" class="btn btn-warning pull-right" id="validMontant">VALIDER</button>
                        </form>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>

    </div>
</div>
<script>

    $( "#montant" ).click(function() {
        if($( "#montant" ).val() != '') {
            $( "#montant" ).val('');
            $("#idvalider").attr('disabled',false);
            $("#validMontant").attr('disabled',false);
            $("#errorMeesage").hide();
        }
    })

    function clicked()
    {
        var soldeavant = $("#solde").text()
        var montant = $( "#montant" ).val()

        if(0 < parseInt(montant) && parseInt(montant) < parseInt(soldeavant))
        {
            $("#montan_hide").val(montant)
            $("#showMontant").empty()
            $("#showMontant").append( montant )
            $('#myModal').modal('show')
        }else {
            $("#idvalider").attr('disabled',true);
            $("#errorMeesage").show();
        }
    }

    $("#validMontant").click(function () {
        $("#validation").submit();
        $("#validMontant").attr('disabled',true);
    })



</script>