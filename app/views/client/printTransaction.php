
<style type="text/css">
    body, td, th {
        font-size: 13px;
        font-family: Arial, Helvetica, sans-serif;
    }

    .text_ref {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 10px;
        font-weight: 900;

    }

    a#text_ref {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 10px;
        font-weight: 900;
        text-decoration: none;
    }

    .titre {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 14px;
        font-weight: bold;
        text-align: center;
    }

    tr, td#fd {
        border-left: border: 0.2em thin #4E4E4E;
    }

    td#fi {
        border-left: border: 0.2em thin #4E4E4E;
        /*border-bottom: border:0.2em thin  #D7D7D7;*/
    }

    tr#fa {
        border-top: border: 0.2em thin #4E4E4E;
        border-bottom: border: 0.2em thin #D7D7D7;
    }

    .tiret {
        border-bottom: 1px solid #3c4451;
        border-top: 1px solid #3c4451;
        border-left: 0.5px solid #3c4451;
        border-right: 0.5px solid #3c4451;

    }

    .trait {
        border-left: border: 0.01em thin black;
        border-bottom: border: 0.01em thin black;

    }

    .ok {

        border-bottom: 1px solid #CCCCCC;
        border-top: 1px solid #CCCCCC;
        border-left: 1px solid #CCCCCC;
        border-right: 1px solid #CCCCCC;
    }
</style>
<page backtop="15mm" backbottom="20mm" backleft="10mm" backright="10mm">
    <table>
        <tr>
            <td><img src="<?= __DIR__.'/../../../assets/plugins/images/logo.png'?>" width="185" height="60" /></td>
            <td style="width: 300px"></td>
            <td>Marchand  : <span><?= $this->data['nom']->nom_marchand?></span></td>
        </tr>
    </table>
    <table  width="80%" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr >
            <td style="text-align: left; padding: 40px 10px 25px 10px" ><strong><?php echo $this->lang['transactitre'];?></strong></td>
        </tr>
    </table>

    <table  width="100%" border="0" cellspacing="0" cellpadding="0" align="center">

        <thead>

        <tr style="background-color: #f0f0f0">
            <th style="text-align: left; padding: 5px 10px 5px 10px" class="tiret">
                <strong><?php echo $this->lang['labdate_transaction']; ?></strong></th>
            <th style="text-align: left; padding: 5px 10px 5px 10px" class="tiret">
                <strong><?php echo $this->lang['labnum_transaction']; ?></strong></th>
            <th style="text-align: left; padding: 5px 10px 5px 10px" class="tiret">
                <strong><?php echo $this->lang['transacavant']; ?></strong></th>
            <th style="text-align: left; padding: 5px 10px 5px 10px" class="tiret">
                <strong><?php echo $this->lang['labmontant_transation']; ?></strong></th>
            <th style="text-align: left; padding: 5px 10px 5px 10px" class="tiret">
                <strong><?php echo $this->lang['transacapres']; ?></strong></th>

        </tr>

        </thead>
        <tbody>

        <?php foreach ($this->data['transact'] as $row1) { ?>
            <tr>
                <td style="text-align: center; padding-top: 5px; padding-bottom: 5px" class="ok"><?= \app\core\Utils::getDateFR($row1->date_transaction);?></td>
                <td style="text-align: center; padding-top: 5px; padding-bottom: 5px" class="ok"><?= $row1->num_transac;?></td>
                <td style="text-align: center; padding-top: 5px; padding-bottom: 5px" class="ok"><?= \app\core\Utils::getFormatMoney($row1->solde_avant);?></td>
                <td style="text-align: center; padding-top: 5px; padding-bottom: 5px" class="ok"><?= \app\core\Utils::getFormatMoney($row1->montant);?></td>
                <td style="text-align: center; padding-top: 5px; padding-bottom: 5px" class="ok"><?= \app\core\Utils::getFormatMoney($row1->solde_apres);?></td>
            </tr>

        <?php } ?>
        </tbody>

    </table>


</page>