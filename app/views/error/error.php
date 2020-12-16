<style type="text/css">
    body{
        font-family: 'Courgette', cursive;
    }
    body{
        background: #ffffff;
    }
    .wrap{
        margin:0 auto;
        width:1000px;
    }
    .logo{
        margin-top:50px;
    }
    .logo h1{
        font-size:200px;
        color:#8F8E8C;
        text-align:center;
        margin-bottom:1px;
        text-shadow:1px 1px 6px #fff;
    }
    .logo p{
        color:rgb(228, 146, 162);
        font-size:20px;
        margin-top:1px;
        text-align:center;
    }
    .logo p span{
        color:lightgreen;
    }
    .sub a{
        color:white;
        background:#8F8E8C;
        text-decoration:none;
        padding:7px 120px;
        font-size:13px;
        font-family: arial, serif;
        font-weight:bold;
        -webkit-border-radius:3em;
        -moz-border-radius:.1em;
        -border-radius:.1em;
    }
    .footer{
        color:#8F8E8C;
        position:absolute;
        right:10px;
        bottom:10px;
    }
    .footer a{
        color:rgb(228, 146, 162);
    }
</style>
<div class="wrap">
    <div class="logo">
        <?php switch($this->_message['MSG_ERROR']['type']) {
            case '400':
                echo "<h1>400</h1> <p>Échec de l'analyse HTTP.</p>";
                break;
            case '401':
                echo "<h1>401</h1> <p>Le pseudo ou le mot de passe n'est pas correct !</p>";
                break;
            case '402':
                echo "<h1>402</h1> <p>Le client doit reformuler sa demande avec les bonnes données de paiement.</p>";
                break;
            case '403':
                echo "<h1>403</h1> <p>Erreur sur la requête sql informer l' Administrateur SVP!</p>";
                break;
            case '404':
                echo "<h1>404</h1> <p>La page ".implode('/',$this->_message['MSG_ERROR']['alert'])." est introuvable !</p>";
                break;
            case '405':
                echo "<h1>405</h1> <p>Méthode non autorisée.</p>";
                break;
            case '500':
                echo "<h1>500</h1> <p>Erreur de connexion à la base de données</p>";
                break;
            case '501':
                echo "<h1>501</h1> <p>Le serveur ne supporte pas le service demandé.</p>";
                break;
            case '502':
                echo "<h1>502</h1> <p>Mauvaise passerelle.</p>";
                break;
            case '503':
                echo "<h1>503</h1> <p>Service indisponible.</p>";
                break;
            case '504':
                echo "<h1>504</h1> <p>Temps d'attente à la réponse épuisée.</p>";
                break;
            case '505':
                echo "<h1>505</h1> <p>Version HTTP non supportée! .";
                break;
            case 'denied':
                echo "<h1>Acces refusé</h1> <p>Vous n'etes pas autorisé à executer cette action! .";
                break;
            default:
                echo "<h1>???</h1> <p>".$this->_message['MSG_ERROR']['type']."</p>";
        } ?>
        <div class="sub">
            <p><a href="javascript:history.back();">Back</a></p>
        </div>
    </div>
</div>
<!---728x90--->
<div class="footer">
    &copy 2017. All Rights Reserved | by <a href="http://numherit.com" target="_blank">Numherit SA</a>
</div>