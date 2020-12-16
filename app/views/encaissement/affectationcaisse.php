<style>
   .styliste{
       background-color: #fff!important;
       border: 1px solid #aaa!important;
       border-radius:4px!important;
       box-sizing: border-box!important;
       cursor: pointer!important;
       display: block!important;
       height: 33px!important;
       width:100%!important;
   }

   legend.scheduler-border {
       font-size: 1.1em !important;
       font-weight: normal !important;
       text-align: left !important;
       border-bottom: none;
       background-color: #005090;
       border-color: #005090;
       color: #fff;
       padding: 5px 30px;
       display: block;
       width: auto;
       margin-bottom: auto;
       font-size: 15px;

   }
   fieldset.scheduler-border {
       border: 1px groove #005090 !important;
       padding: 0 1.4em 1.4em 1.4em !important;
       margin: 0 0 1.5em 0 !important;
       -webkit-box-shadow: 0px 0px 0px 0px #005090;
       box-shadow: 0px 0px 0px 0px #005090;
   }

</style>
<!-- select2 CSS -->
<link href="<?= WEBROOT;?>assets/plugins/select2/select2.min.css" rel="stylesheet">

<div id="page-wrapper">
    <div class="container-fluid">

        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title"><?php echo $this->lang['affectationcaisse']; ?></h4> </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

                <ol class="breadcrumb">
                    <li><a href="<?= WEBROOT.'menu/menu'; ?>">  <?php echo $this->lang['accueil']; ?></a></li>
                    <li class="active"><?php echo $this->lang['affectationcaisse']; ?></li>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>


        <div class="row">

            <div class="col-md-12">
                <div class="white-box" >

                    <fieldset class="scheduler-border">
                        <legend class="scheduler-border"><?php echo $this->lang['affectationcaisse']; ?></legend><br/>
                <form name="add_name" id="add_name" class="form-inline form-validator "   action="<?= WEBROOT ?>affectationcaisse/addAffectationCaisse" method="post">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dynamic_field">
                            <tr>
                                <td>
                                    <select class="select2 form-control" id="fk_idcaisse" name="fk_idcaisse"  style="width: 100%">
                                        <option value=""><?= $this->lang['selectcais']; ?></option>
                                        <?php foreach($caisse as $oneCaisse){ ?>
                                            <option id="ca<?php echo $oneCaisse->id ?>" value="<?php echo $oneCaisse->id ?>_<?= $oneCaisse->numcaisse ?>"><?php  echo $this->lang['numerocais'].$oneCaisse->numcaisse ?></option>
                                        <?php } ?>
                                    </select>
                                </td>

                        <td>
                            <select class="select2 form-control" id="fk_usermarchand" name="fk_usermarchand"  style="width: 100%"  >
                                <option value=""><?= $this->lang['selectcaissier']; ?></option>
                                <?php foreach($caissier as $oneCaissier){ ?>
                                    <option id="ce<?php echo $oneCaissier->id ?>" value="<?php echo $oneCaissier->id ?>_<?= $oneCaissier->prenom ?>_<?= $oneCaissier->nom ?>"><?php  echo $oneCaissier->prenom. "-" .$oneCaissier->nom ?></option>
                                <?php } ?>
                            </select>


                        </td>
                                <td>
                                    <input type="text" id="to" name="date_affect" class="form-control"  placeholder="Date" >
                                </td>

                        <td>

                            <input type="text" id="heuredeb" name="heure_debut" class="form-control timepicker timepicker-without-dropdown text-left" placeholder="Heure debut">
                        </td>

                        <td>
                            <input type="text" id="heurefin" name="heure_fin" class="form-control timepicker timepicker-without-dropdown text-left" placeholder="Heure fin">
                             <input type="hidden"  id="nbrligne" name="nbrligne" >

                        </td>
                        <td>
                            <button name="add" id="add"   type="button" class="btn btn-info btn-outline btn-circle btn-sm m-r-5" style="background-color:#ececec;margin-left: 30px;border-color: #005090;"><i class="fa fa-plus"></i></button>

                        </td>
                    </tr>

                </table>
                    <div class="col-md-12 text-right">

                        <button type="submit" id="soum" name="soum" class="btn btn-info pull-right" disabled="true"><?php echo $this->lang['btnValider'] ; ?></button>

                    </div>
                    </div>
                </form>
                    </fieldset>
            </div>
            </div>
        </div>
    </div>
</div>

<script src="<?= WEBROOT ?>assets/plugins/select2/select2.full.min.js"></script>
<script src="<?= WEBROOT ?>assets/plugins/moment-js-2.18.1/moment.min.js"></script>

<script>
    $(document).ready(function(){
        jQuery('#heuredeb').timepicker({ 'timeFormat': 'HH:mm' });
        jQuery('#heurefin').timepicker({ 'timeFormat': 'HH:mm' });


        $("#to").datepicker({
            defaultDate: "+1w",
            changeMonth: true,
            numberOfMonths: 1,
            onClose: function (selectedDate) {
                $("#from").datepicker("option", "maxDate", selectedDate);
            }
        });
    });

    $(".select2").select2();
</script>
<script>


    $(document).ready(function(){

     var i=0;

        $('#add').click(function(){

            var fk_idcaisse = $("#fk_idcaisse").val();
            var fk_usermarchand = $("#fk_usermarchand").val();
           // alert(fk_usermarchand);
            var date_affect = $("#to").val();
            var heure_debut = $("#heuredeb").val();
            var heure_fin = $("#heurefin").val() ;

            if(fk_idcaisse != '' && fk_usermarchand != '' && heure_debut != '' && heure_fin != '' && date_affect != '') {
                fk_idcaisse = fk_idcaisse.split('_');
                fk_usermarchand = fk_usermarchand.split('_');

                $.ajax({

                    type: "POST",
                    url: "<?= WEBROOT.'affectationcaisse/associateCaisse'; ?>",

                    data: "caiss="+document.getElementById('fk_idcaisse').value+"&marchand="+document.getElementById('fk_usermarchand').value+
                    "&dt="+document.getElementById('to').value+"&heure_deb="+document.getElementById   ('heuredeb').value+"&heure_fin="+document.getElementById('heurefin').value,

                    success: function(data) {
                       // alert(data);
                        if(data == '-1' || data == -1){
                            swal({
                                title: "<?= $this->lang['affectationcaisse']; ?>",
                                text: "<?= $this->lang['Msg_Ecr_caisse2']; ?>",
                                type: "warning"

                            });
                            $('#row'+i).remove();
                            i=i-1;
                            document.getElementById("nbrligne").value=parseInt(document.getElementById("nbrligne").value) - 1;

                        }
                    }
                });

                i++;
                $('#dynamic_field').append('<tr id="row' + i + '"><td>' +
                    '<select name="fk_idcaisse[]" id="fk_idcaissen['+i+']" class="form-control styliste"><option value="' + fk_idcaisse[0] + '">'
                    + fk_idcaisse[1]

                    + '</option></select>' +
                    '</td><td>   <select name="fk_usermarchand[]" id="fk_usermarchandn['+i+']" class="form-control styliste"><option value="' + fk_usermarchand[0] + '">' + fk_usermarchand[1] + '</option></select>' +
                    '</td><td>   <input  class="form-control" type="text" id="date_affect['+i+']" readonly name="date_affect[]" value="' + date_affect + '">' +
                    '</td><td>   <input  class="form-control" type="text" id="heure_debutn['+i+']" readonly name="heure_debut[]" value="' + heure_debut + '">' +
                    '</td><td>   <input class="form-control" type="text" id="heure_finn['+i+']" readonly name="heure_fin[]" value="' + heure_fin + '">' +
                    '</td>' +
                    '<td>' +
                    '<button type="button" name="remove" data-i="' + i + '" data-chapitre="' + fk_idcaisse[0] + '-' + fk_idcaisse[1] + '" data-rubrique="' + fk_usermarchand[0] + '-' + fk_usermarchand[1] + '"  class="btn btn-danger btn_remove" style="margin-left: 30px!important;">X</button></td></tr>');


                document.getElementById("nbrligne").value = i;
                var y=i;
                //alert($('#ca'+fk_idcaisse[0]).val());
                //$('#ce'+fk_usermarchand[0]).remove();*/
                $('#add_name')[0].reset();
                $('#fk_idcaisse').val('').trigger("change");
                $('#fk_usermarchand').val('').trigger("change");
                document.getElementById("soum").disabled = false;

                var j=2;
                //var y=max;
                //alert("y="+y);
                while(j<=i){
                   // alert("i="+i);
                    var n1=j-1;
                    //alert("n1="+n1);
                    var fk_caissen=document.getElementById("fk_idcaissen[" + n1 + "]").value;
                    var fk_usermarchandn=document.getElementById("fk_usermarchandn[" + n1 + "]").value;
                    var date_affectn=document.getElementById("date_affect[" + n1 + "]").value;
                    var heure_debutn=document.getElementById("heure_debutn[" + n1 + "]").value;
                    var heure_finn=document.getElementById("heure_finn[" + n1 + "]").value;
                    if(fk_idcaisse[0]==fk_caissen && fk_usermarchand[0]==fk_usermarchandn && date_affect==date_affectn && ((heure_debut>=heure_debutn && heure_debut<=heure_finn) || (heure_fin>=heure_debutn && heure_fin<=heure_finn) || (heure_debut<=heure_debutn && heure_fin>=heure_finn) || (heure_debut>=heure_debutn && heure_fin<=heure_finn))){
                        swal({
                            title: "<?= $this->lang['affectationcaisse']; ?>",
                            text: "<?= $this->lang['Msg_Ecr_caisse2']; ?>",
                            type: "warning"

                        });
                        //n=n+1;
                        $('#row'+i).remove();
                        i=i-1;
                       // alert("i-1="+i);
                        document.getElementById("nbrligne").value=parseInt(document.getElementById("nbrligne").value) - 1;

                    }
                    if (fk_usermarchand[0]==fk_usermarchandn && date_affect==date_affectn && ((heure_debut>=heure_debutn && heure_debut<=heure_finn) || (heure_fin>=heure_debutn && heure_fin<=heure_finn) || (heure_debut<=heure_debutn && heure_fin>=heure_finn) || (heure_debut>=heure_debutn && heure_fin<=heure_finn))){
                        swal({
                            title: "<?= $this->lang['affectationcaisse']; ?>",
                            text: "<?= $this->lang['Msg_Ecr_caisse3']; ?>",
                            type: "warning"

                        });
                        //n=n+1;
                        $('#row'+i).remove();
                        i=i-1;
                        //alert("i-1="+i);
                        document.getElementById("nbrligne").value=parseInt(document.getElementById("nbrligne").value) - 1;

                    }
                    j++;
                }

            }else{
                swal({
                    title: "<?= $this->lang['affectationcaisse']; ?>",
                    text: "<?= $this->lang['Msg_Ecr_caisse']; ?>",
                    type: "warning"
                });

            }
        }); 
        $(document).on('click', '.btn_remove', function(){
            var fk_idcaisse = $(this).data('chapitre'); 
            var fk_usermarchand = $(this).data('rubrique'); 
            var i = $(this).data('i'); 
            fk_idcaisse = fk_idcaisse.split('_'); 
            fk_usermarchand = fk_usermarchand.split('_'); 
            $('#row'+i).remove();
            document.getElementById("nbrligne").value=parseInt(document.getElementById("nbrligne").value) - 1;
            $('#fk_idcaisse').append('<option id="ca'+fk_idcaisse[0]+'" value="'+fk_idcaisse[0]+'-'+fk_idcaisse[1]+'">'+fk_idcaisse[1]+' </option>'); 
            $('#fk_usermarchand').append('<option id="ce'+fk_usermarchand[0]+'" value="'+fk_usermarchand[0]+'-'+fk_usermarchand[1]+'">'+fk_usermarchand[1]+' </option>');
            if(document.getElementById("nbrligne").value<=0){
                document.getElementById("soum").disabled = true;
            }else{
                document.getElementById("soum").disabled = false;
            }
        }); 

    });



</script>




