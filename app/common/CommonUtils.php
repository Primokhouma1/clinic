<?php
/**
 * Created by PhpStorm.
 * User: Seyni FAYE
 * Date: 31/01/2018
 * Time: 12:52
 */

namespace app\common;

trait CommonUtils
{
    /**
     * Ici vous devez créer uniquement des méthodes avec le mot clé << static >>
     * Vous pouvez acceder à votre méthode partout dans le projet en faisant
     * Utils::votre_nom_de_methode();
     */

    /**
     * @param $val
     * @return string
     */
    public static function getMois($val)
    {
        $tabMois = ["1"=>"Janvier","2"=>"Fevrier","3"=>"Mars","4"=>"Avril","5"=>"Mai","6"=>"Juin","7"=>"Juillet","8"=>"Aout","9"=>"Septembre","10"=>"Octobre","11"=>"Novembre","12"=>"Decembre"];
        return $tabMois[$val];
    }
     public static function generateNumTransactionWoocommerce()
    {
        return  mt_rand(1000000000000, 99999999999999);
    }

    static function sendMailAlert($email,$contenue,$sujet,$nom)
    {
        $destinataire = $email;
        $vers_mail = $destinataire;
        $nom_client = $nom;
        $message ='<html><body></body><table class="table_full editable-bg-color bg_color_e6e6e6 editable-bg-image" bgcolor="#e6e6e6" width="100%" align="center"  mc:repeatable="castellab" mc:variant="Header" cellspacing="0" cellpadding="0" border="0">
   <tr>
      <td>
         <table class="table1 editable-bg-color bg_color_303f9f" bgcolor="#eee" width="600" align="center" border="0" cellspacing="0" cellpadding="0" style="margin: 0 auto;">
            <tr><td height="25"></td></tr>
            <tr>
               <td>
                  <table class="table1" width="520" align="center" border="0" cellspacing="0" cellpadding="0" style="margin: 0 auto;">
                     <tr>
                        <td>
                           <table width="50%" align="left" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                 <td align="left">
                                    <a href="#" class="editable-img">
                                       <img src="" style="display:block;height: auto;" width="80" border="0" alt="" />
                                        <!--<img src="https://numherit-labs.com/cdc/assets/plugins/images/admin-cdc-jumbo.png" width="150" height="150" alt="">-->
                                    </a>
                                 </td>
                              </tr>
                           </table>
                        </td>
                     </tr>
                     <tr><td height="60"></td></tr>

                     <tr>
                        <td align="center" class="text_color_ffffff" style="color: #ffffff; font-size: 30px; font-weight: 700; font-family: lato, Helvetica, sans-serif; mso-line-height-rule: exactly;">
                           <div class="editable-text">
                              <span class="text_container">
                                 <multiline style="color: #ffbb43">
                                  '.$sujet.'
                                 </multiline>
                              </span>
                           </div>
                        </td>
                     </tr>
                     <tr><td height="30"></td></tr>
                  </table>
               </td>
            </tr>
            <tr><td height="104"></td></tr>
         </table>
      </td>
   </tr>
   <tr>
      <td>
         <table class="table1 editable-bg-color bg_color_ffffff" bgcolor="#ffffff" width="600" align="center" border="0" cellspacing="0" cellpadding="0" style="margin: 0 auto;">
            <tr><td height="60"></td></tr>
            <tr>
               <td>
                  <table class="table1" width="520" align="center" border="0" cellspacing="0" cellpadding="0" style="margin: 0 auto;">
                     <tr>
                        <td mc:edit="text011" align="left" class="center_content text_color_282828" style="color: #282828; font-size: 20px; font-weight: 700; font-family: lato, Helvetica, sans-serif; mso-line-height-rule: exactly;">
                           <div class="editable-text">
                              <span class="text_container">
                                 <multiline>
                                    Bonjour  cher(e) '.$nom_client.' ,
                                 </multiline>
                              </span>
                           </div>
                        </td>
                     </tr>
                     <tr><td height="10"></td></tr>
                     <tr>
                        <td align="left" class="center_content text_color_a1a2a5" style="color: #a1a2a5; font-size: 14px;line-height: 2; font-weight: 500; font-family: lato, Helvetica, sans-serif; mso-line-height-rule: exactly;">
                           <div class="editable-text" style="line-height: 2;">
                              <span class="text_container">
                                 <multiline>
                                     '.$contenue.'<br/>
                                 </multiline>
                              </span>
                           </div>
                        </td>
                     </tr>
                     <tr><td height="20"></td></tr>
                     <tr>
                        <td align="left" class="center_content text_color_a1a2a5" style="color: #a1a2a5; font-size: 14px;line-height: 2; font-weight: 500; font-family: lato, Helvetica, sans-serif; mso-line-height-rule: exactly;">
                           <div class="editable-text" style="line-height: 2;">
                              <span class="text_container">
                                 <multiline>
                                    Merci
                                 </multiline>
                              </span>
                           </div>
                        </td>
                     </tr>
                     <tr><td height="5"></td></tr>
                     <tr>
                        <td align="left" class="center_content text_color_a1a2a5" style="color: #a1a2a5; font-size: 14px;line-height: 2; font-weight: 500; font-family: lato, Helvetica, sans-serif; mso-line-height-rule: exactly;">
                           <div class="editable-text" style="line-height: 2;">
                              <span class="text_container">
                                 <multiline>
                                 </multiline>
                              </span>
                           </div>
                        </td>
                     </tr>
                  </table>
               </td>
            </tr>
            <tr><td height="60"></td></tr>
         </table>
      </td>
   </tr>
</table></body></html>';

        /** Envoi du mail **/
        $entete = "Content-type: text/html; charset=utf8\r\n";
        $entete .= " MIME-Version: 1.0\r\n";
        $entete .= "To: $nom_client<".$vers_mail."> \r\n";
        $entete .= "From:ALAL<no-reply@oncav-phco.sn>\r\n";
        @mail($vers_mail, $sujet, $message, $entete);
    }

    public static function date_jj_mm_aaaa($date)
    {
        $date_fr = '';
        if ($date != '') {

            $jj = substr($date, 8, 2);
            $mm = substr($date, 5, 2);
            $aa = substr($date, 0, 4);

            ////////////////
            $date_fr = $jj . '-' . $mm . '-' . $aa;
        }
        return $date_fr;
    }


    public static function date_aaaa_mm_jj($date)
    {
        $date_en = '';
        if ($date != '') {

            $jj = substr($date, 0, 2);
            $mm = substr($date, 3, 2);
            $aa = substr($date, 6, 4);

            ////////////////
            $date_en = $aa.'-'.$mm.'-'.$jj;
        }
        return $date_en;
    }

}