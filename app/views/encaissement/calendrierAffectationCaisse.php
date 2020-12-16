<!-- select2 CSS -->
<link href="<?php echo WEBROOT;?>assets/plugins/fullcalendar-3.4.0/fullcalendar.css" rel="stylesheet" type="text/css" />

<div id="page-wrapper">
    <div class="container-fluid">

        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title"><?php echo $this->lang['calendrieraffectation']; ?></h4> </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

                <ol class="breadcrumb">
                    <li><a href="<?= WEBROOT.'menu/menu'; ?>">  <?php echo $this->lang['accueil']; ?></a></li>
                    <li class="active"><?php echo $this->lang['calendrieraffectation']; ?></li>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="container">
              <div id="calendar"></div>
        </div>

    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-md">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header" style="padding:15px 20px;">
                <button type="button" class="close" data-dismiss="modal">&times;</button>

                <h4 class="modal-title"><span><?= $this->lang['detailaffectcaisse']; ?></span></h4>
            </div>
            <div class="modal-body" style="padding:10px 10px;">

                <table align="center" class="table table-no-bordered table-striped" style="width:95%;">
                    <tbody>

                    <tr>
                        <td ><strong><?php echo $this->lang['labnumcaisse']; ?></strong></td>
                        <td  align="right"><input type="text" disabled class="form-control" id="caisse" placeholder="<?php echo $this->lang['labnumcaisse']; ?>"></td>
                    </tr>

                    <tr>
                        <td ><strong><?php echo $this->lang['caissier']; ?></strong></td>
                        <td  align="right"><input type="text" disabled class="form-control" id="caissier" placeholder="<?php echo $this->lang['caissier']; ?>"></td>
                    </tr>

                    <tr>
                        <td ><strong><?php echo $this->lang['dtaffect']; ?></strong></td>
                        <td  align="right"><input type="text" disabled class="form-control" desabled id="date_affect" placeholder="<?php echo $this->lang['dtaffect']; ?>"></td>
                    </tr>

                    <tr>
                        <td ><strong><?php echo $this->lang['hrdeb']; ?></strong></td>
                        <td  align="right"><input type="text" disabled class="form-control" id="heure_debut" placeholder="<?php echo $this->lang['hrdeb']; ?>"></td>
                    </tr>

                    <tr>
                        <td ><strong><?php echo $this->lang['hrfin']; ?></strong></td>
                        <td  align="right"><input type="text" disabled class="form-control" id="heure_fin" placeholder="<?php echo $this->lang['hrfin']; ?>"></td>
                    </tr>


                    </tbody>
                </table>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-danger btn-default pull-left" data-dismiss="modal">
                    <span class="glyphicon glyphicon-remove"></span><?= $this->lang['btnFermer']; ?></button>
            </div>
        </div>

    </div>
</div>

<script src="<?= WEBROOT ?>assets/plugins/moment-js-2.18.1/moment.min.js"></script>
<script src="<?= WEBROOT ?>assets/plugins/fullcalendar-3.4.0/fullcalendar.min.js"></script>
<!--<script src="<?/*= WEBROOT */?>assets/plugins/fullcalendar-3.4.0/locale-all.js"></script>
<script src="<?/*= WEBROOT */?>assets/plugins/fullcalendar-3.4.0/locale/fr.js"></script>-->
<script src="<?= WEBROOT ?>assets/plugins/fullcalendar-3.4.0/lang-all.js"></script>


<script>
    $(document).ready(function() {
        var calendar = $('#calendar').fullCalendar({
            lang:'fr',
            editable:true,

            header:{
                left:'prev,next today',
                center:'title',
                right:'month,agendaWeek,agendaDay'
            },
            events: 'loadaffectation',

            eventRender: function(event, element, view) {
                if (event.allDay === 'true') {
                    event.allDay = true;
                } else {
                    event.allDay = false;
                }
            },

            eventClick:function(event)
            {
                var id = event.id;
                $.ajax({
                    url:"<?= WEBROOT.'affectationcaisse/detailsAffectationcaisse'; ?>",
                    type:"POST",
                    data:{id:id},
                    success:function(data)
                    {
                        calendar.fullCalendar('refetchEvents');

                        $("#myModal").modal();
                        var json = JSON.parse(data);
console.log(json);
                        if(json){
                            document.getElementById('date_affect').value=json.date_affect;
                            document.getElementById('heure_debut').value=json.heure_debut;
                            document.getElementById('heure_fin').value=json.heure_fin;
                            document.getElementById('caisse').value=json.numcaisse;
                            document.getElementById('caissier').value=json.nom;

                        }
                    }
                })
            },

        });

    });

</script>




