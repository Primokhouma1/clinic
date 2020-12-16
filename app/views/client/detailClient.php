<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <h4 class="page-title"><?php echo $this->lang['detailClient1'];
                    echo $client->FirstName . " " . $client->LastName; ?></h4></div>

            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">

                <ol class="breadcrumb">
                    <li><a href="#"> <?php echo $this->lang['client']; ?></a></li>
                    <li class="active"><?php echo $this->lang['detailClient']; ?></li>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="row bg-title">
            <div class="row col-lg-12">

                <table class="table table-striped table-hover table-responsive ">
                    <tr>
                        <th class=" "><?php echo $this->lang['labidcarte']; ?></th>
                        <td class=" "><?= $client->id_carte; ?></td>
                    </tr>
                    <tr>
                        <th class=""><?php echo $this->lang['labprenomd']; ?></th>
                        <td class=""><?= $client->FirstName; ?></td>
                        <td rowspan="12" class="text-center" style="width:400px">
                            <img src="<?= $client->photoPATH; ?>" style="width: 350px;padding: 15px;"/>
                        </td>
                    </tr>
                    <tr>
                        <th class=""><?php echo $this->lang['labnomd']; ?></th>
                        <td class=" "><?= $client->LastName; ?></td>
                    </tr>
                    <tr>
                        <th class=" "><?php echo $this->lang['labadressed']; ?></th>
                        <td class=" "><?= $client->Address; ?></td>
                    </tr>
                    <tr>
                        <th class=" "><?php echo $this->lang['labdatenaiss']; ?></th>
                        <td class=" "><?= $client->DOBLong; ?></td>
                    </tr>
                    <tr>
                        <th class=" "><?php echo $this->lang['lablieunaiss']; ?></th>
                        <td class=" "><?= $client->PlaceOfBirth; ?></td>
                    </tr>
                    <tr>
                        <th class=" "><?php echo $this->lang['labpaynaiss']; ?></th>
                        <td class=" "><?= $client->Countrylong; ?></td>
                    </tr>
                    <tr>
                        <th class=" "><?php echo $this->lang['labsexe']; ?></th>
                        <td class=" "><?= $client->sexe; ?></td>

                    </tr>
                    <tr>
                        <th class=" "><?php echo $this->lang['labtaille']; ?></th>
                        <td class=" "><?= $client->Height; ?></td>
                    </tr>
                    <tr>
                        <th class=" "><?php echo $this->lang['lablicense']; ?></th>
                        <td class=" "><?= $client->License; ?></td>
                    </tr>
                    <tr>
                        <th class=" "><?php echo $this->lang['labdatedeli']; ?></th>
                        <td class=" "><?= $client->IssueDateLong; ?></td>
                    </tr>
                    <tr>
                        <th class=" "><?php echo $this->lang['labdatedexpi']; ?></th>
                        <td class=" "><?= $client->ExpirationDateLong; ?></td>

                    </tr>
                </table>
                <?php print $token;?>

            </div>
            <div class="row col-lg-12">
                <h3 class="panel-title pull-right">
                    <button type="button" class="open-modal btn btn-success" data-modal-controller="client/modifClientModal" data-modal-view="<?= base64_encode("client") ?>/<?= base64_encode("modifClientModal") ?>/<?= base64_encode($client->id) ?>">
                        <i class="fa fa-check"></i>
                        <?php echo $this->lang['btnModifier']; ?>
                    </button>

                    <?php if ($client->statut == 1 ){  ?>
                        <a  class="action confirm-modal "  href="<?= WEBROOT."client/desactiver/".base64_encode($client->id);?>" >
                            <button type="button" class="btn btn-primary "  >
                                <i class="fa fa-check"></i>
                                <?php echo $this->lang['btnDesactiver']; ?>
                            </button></a>
                            <?php }else{  ?>
                            <a  class="action confirm-modal "  href="<?= WEBROOT."client/activer/".base64_encode($client->id);?>" >
                                <button type="button" class="btn btn-primary "  >
                                    <i class="fa fa-check"></i>
                                    <?php echo $this->lang['btnActiver']; ?>
                                </button></a>
                                <?php } ?>


                    <a href="<?= WEBROOT."client/listeClient";?>">  <button type="button" class="btn btn-default">
                            <i  class="fa fa-times"></i> <?php echo $this->lang['btnRetour']; ?> </button></a>
                </h3>
            </div>
        </div>


    </div>
</div>