<?php if(count($this->_message['MSG_ALERT']) > 0){ ?>
    <script>
        $(document).ready(function () {
            var message = "<div class='container' style='position: absolute; top: 75px; width: 100%;'><div class='row'><div class='col-md-3'></div><div class='col-md-6'><div id='MSG_ALERT' class='alert alert-<?= $this->_message['MSG_ALERT']['type'] ?> alert-dismissable' role='alert'><div class='text-center'><?= $this->_message['MSG_ALERT']['alert'] ?></div></div></div><div class='col-md-3'></div></div></div>";
            $('body').append(message);
            $.get(racine+"error/unsetMessage/<?= base64_encode('ALERT') ?>", function(data, status){});
        });
    </script>
<?php }
if(strtoupper(ENV) === "DEV" && count($this->_message['MSG_ERROR']) > 0 && $this->_message['MSG_ERROR']['type'] === 'sql') { ?>
    <script>
        $(document).ready(function () {
            var message = "<div style='z-index: 9999; position: fixed; left: 0; right: 0; bottom: -19px; width: 100%;'><div class='alert alert-warning alert-dismissable' role='alert'><?= $this->_message['MSG_ERROR']['alert'] ?></div></div>";
            $('body').append(message);
            $.get(racine+"error/unsetMessage/<?= base64_encode('ERROR') ?>", function(data, status){});
        });
    </script>
<?php } ?>
<div id="modal-container"></div>

<!-- Link URL JavaScript -->