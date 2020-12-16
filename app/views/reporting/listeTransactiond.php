<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <h4 class="page-title"><?php echo $this->lang['listeTransaction']; ?></h4></div>
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">

                <ol class="breadcrumb">
                    <li><a href="#"> <?php echo $this->lang['tabBord']; ?></a></li>
                    <li class="active"><?php echo $this->lang['listeTransaction']; ?></li>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>

        <div class="row bg-title">
            <form class="form-horizontal" method="POST" action="<?= WEBROOT ?>reporting/listeTransactiond">

                <div  style="width: 30%"  class="col-lg-4 col-md-3 col-sm-6 col-xs-12">

                    <div class="form-group">
                        <label for="nom" class="col-lg-3 col-sm-4 control-label"><?= $this->lang['du']; ?></label>
                        <div class="col-lg-9 col-sm-8">
                            <input type="text" class="form-control" placeholder="yyyy-mm-dd" name="datedebut" id="datedebut1" value="<?= $datedebut ?>" />
                        </div>
                    </div>
                </div>
                <div   style="width: 30%" class="col-lg-4 col-md-3 col-sm-6 col-xs-12">

                    <div class="form-group">
                        <label for="nom" class="col-lg-3 col-sm-4 control-label"><?= $this->lang['au']; ?></label>
                        <div class="col-lg-9  col-sm-8">
                            <input type="text" class="form-control" placeholder="yyyy-mm-dd" name="datefin" id="datefin1" value="<?= $datefin ?>" />

                        </div>
                    </div>
                </div>
                <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
                    <button type="submit" class="btn btn-success btn-circle btn-lg" title="Rechercher"><i class="ti-search"></i></button>
                </div>

            </form>
            <div class="row">

                <div class="col-md-12">
                    <div class="">
                        <a href="<?= WEBROOT.'reporting/export/'.$datedebut.'/'.$datefin; ?>" target="_blank" class="btn btn-plus pull-right m-l-20  waves-effect waves-light" >
                            <i class="fa fa-file-pdf-o"></i> <?= $this->lang['export']; ?>
                        </a>
                    </div>
                    <table class="table table-bordered table-hover table-responsive processing"
                           data-url="<?= WEBROOT; ?>reporting/listeTransactiondPro/<?= $datedebut; ?>/<?= $datefin; ?>" >
                    <thead>
                    <tr>
                        <th><?php echo $this->lang['labpnum_transaction']; ?></th>
                        <th><?php echo $this->lang['labdate_transaction']; ?></th>
                        <th><?php echo $this->lang['labmontant_transation']; ?></th>
                        <th><?php echo $this->lang['labemail_acheteur']; ?></th>
                        <th><?php echo $this->lang['labnum_transac_marchand']; ?></th>
                        <th><?php echo $this->lang['labAction']; ?></th>

                    </tr>
                    </thead>
                    </table>
                </div> </div>


        </div>
    </div>

</div>

<script>
    $('document').ready(function(){

        jQuery('#datedebut1').datepicker({
            autoclose: true,
            todayHighlight: true,
            format: 'yyyy-mm-dd',
            days: ["dimanche", "lundi", "mardi", "mercredi", "jeudi", "vendredi", "samedi"],
            daysShort: ["dim.", "lun.", "mar.", "mer.", "jeu.", "ven.", "sam."],
            daysMin: ["d", "l", "ma", "me", "j", "v", "s"],
            months: ["janvier", "février", "mars", "avril", "mai", "juin", "juillet", "août", "septembre", "octobre", "novembre", "décembre"],
            monthsShort: ["janv.", "févr.", "mars", "avril", "mai", "juin", "juil.", "août", "sept.", "oct.", "nov.", "déc."],
            today: "Aujourd'hui",
            monthsTitle: "Mois",
            clear: "Effacer",
            weekStart: 1,

        });

        jQuery('#datefin1').datepicker({
            autoclose: true,
            todayHighlight: true,
            format: 'yyyy-mm-dd',
            days: ["dimanche", "lundi", "mardi", "mercredi", "jeudi", "vendredi", "samedi"],
            daysShort: ["dim.", "lun.", "mar.", "mer.", "jeu.", "ven.", "sam."],
            daysMin: ["d", "l", "ma", "me", "j", "v", "s"],
            months: ["janvier", "février", "mars", "avril", "mai", "juin", "juillet", "août", "septembre", "octobre", "novembre", "décembre"],
            monthsShort: ["janv.", "févr.", "mars", "avril", "mai", "juin", "juil.", "août", "sept.", "oct.", "nov.", "déc."],
            today: "Aujourd'hui",
            monthsTitle: "Mois",
            clear: "Effacer",
            weekStart: 1,

        });


    });
</script>