<form id="my-form" class="form-inline form-validator" data-type="update" role="form" name="form"
      action="<?= WEBROOT ?>client/updateClient" method="post">
    <div class="modal-header">
        <button type="button" class="close" aria-hidden="true" data-dismiss="modal">×</button>
        <h4 class="modal-title"><?php echo $this->lang['modifClient']; ?></h4>
    </div>
    <div class="modal-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group" style="width: 100%;padding: 10px;">
                        <label for="idcarte" class="control-label"><?php echo $this->lang['labidcarte']; ?></label>
                        <input type="text" id="id_carte" name="id_carte" value="<?= $client->id_carte ?>" class="form-control"
                               placeholder="Num carte" style="width: 100%">
                    </div>
                    <div class="form-group" style="width: 100%;padding: 10px;">
                        <label for="Prenom" class="control-label"><?php echo $this->lang['labprenomd']; ?></label>
                        <input type="text" id="FirstName" name="FirstName"  value="<?= $client->FirstName ?>" class="form-control" placeholder="Prenom" style="width: 100%">
                    </div>
                    <div class="form-group" style="width: 100%;padding: 10px;">
                        <label for="LastName" class="control-label"><?php echo $this->lang['labnomd']; ?></label>
                        <input type="text" id="LastName" name="LastName"  value="<?= $client->LastName ?>" class="form-control" placeholder="Nom" style="width: 100%">
                    </div>

                    <div class="form-group" style="width: 100%;padding: 10px;">
                        <label for="adresse" class="control-label"><?php echo $this->lang['labadressed']; ?></label>
                        <input type="text" id="Address" name="Address" value="<?= $client->Address ?>"
                               class="form-control" placeholder="Address" style="width: 100%">

                    </div>
                    <div class="form-group" style="width: 100%;padding: 10px;">
                        <label for="DOBLong" class="control-label"><?php echo $this->lang['labdatenaiss']; ?></label>
                        <input type="text" id="DOBLong" name="DOBLong" value="<?= $client->DOBLong ?>" class="form-control"
                               placeholder="Date de naissance" style="width: 100%">

                    </div>
                    <div class="form-group" style="width: 100%;padding: 10px;">
                        <label for="PlaceOfBirth" class="control-label"><?php echo $this->lang['lablieunaiss']; ?></label>
                        <input type="text" id="PlaceOfBirth" name="PlaceOfBirth" value="<?= $client->PlaceOfBirth ?>" class="form-control"
                               placeholder="Lieu de Naissance" style="width: 100%">
                    </div>

                </div>
                <div class="col-sm-6">

                     <div class="form-group" style="width: 100%;padding: 10px;">
                         <label for="Countrylong" class="control-label"><?php echo $this->lang['labpaynaiss']; ?></label>
                         <input type="text" id="Countrylong" name="Countrylong" value="<?= $client->Countrylong ?>" class="form-control"
                                placeholder="Lieu de Naissance" style="width: 100%">

                    </div>
                    <div class="form-group" style="width: 100%;padding: 10px;">
                         <label for="sexe" class="control-label"><?php echo $this->lang['labsexe']; ?></label>
                         <input type="text" id="sexe" name="sexe" value="<?= $client->sexe ?>" class="form-control"
                                placeholder="Sexe" style="width: 100%">

                    </div>
                    <div class="form-group" style="width: 100%;padding: 10px;">
                         <label for="Height" class="control-label"><?php echo $this->lang['labtaille']; ?></label>
                         <input type="text" id="Height" name="Height" value="<?= $client->Height ?>" class="form-control"
                                placeholder="Height" style="width: 100%">

                    </div>
                    <div class="form-group" style="width: 100%;padding: 10px;">
                         <label for="License" class="control-label"><?php echo $this->lang['lablicense']; ?></label>
                         <input type="License" id="License" name="License" value="<?= $client->License ?>" class="form-control"
                                placeholder="License" style="width: 100%">

                    </div>
                    <div class="form-group" style="width: 100%;padding: 10px;">
                         <label for="IssueDateLong" class="control-label"><?php echo $this->lang['labdatedeli']; ?></label>
                         <input type="text" id="IssueDateLong" name="IssueDateLong" value="<?= $client->IssueDateLong ?>" class="form-control"
                                placeholder="Date delivrance" style="width: 100%">

                    </div>
                    <div class="form-group date" style="width: 100%;padding: 10px;">
                         <label for="ExpirationDateLong" class="control-label"><?php echo $this->lang['labdatedexpi']; ?></label>
                         <input type="text" id="ExpirationDateLong" name="ExpirationDateLong" value="<?= $client->ExpirationDateLong ?>" class="form-control"
                                placeholder="Date d'expiration" style="width: 100%" >


                        <?php print $token; ?>
                        <input type="hidden" name="id" value="<?= base64_encode($client->id) ?>">
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button class="btn btn-success confirm" data-form="my-form" type="submit"><i class="fa fa-check"></i> <?php echo $this->lang['btnValider']; ?>
        </button>
        <button class="btn btn-default" type="button" data-dismiss="modal"><i class="fa fa-times"></i> <?php echo $this->lang['btnFermer']; ?></button>
    </div>
</form>
<script>
    $('#ExpirationDateLong').datepicker();
    $('#IssueDateLong').datepicker();
    $('#DOBLong').datepicker();
</script>

