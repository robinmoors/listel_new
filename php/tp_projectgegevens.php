<?php

session_start();

   require("../includes/dbconnect2.inc");
   require("../includes/clearSessie.inc");

   $paginanaam="Projectgegevens van het therapeutisch project";

   if (isset($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan")

          && ($_SESSION['profiel'] == "hoofdproject"))

      {

      require("../includes/html_html.inc");

      print("<head>");

      require("../includes/html_head.inc");
?>
<style type="text/css">
  .mainblock {
    height: auto;
  }
</style>
<?php
      print("</head>");

      print("<body>");

      print("<div align=\"center\">");

      print("<div class=\"pagina\">");

      require("../includes/header.inc");

      require("../includes/kruimelpad.inc");

      print("<div class=\"contents\">");

      require("../includes/menu.inc");

      print("<div class=\"main\">");

      print("<div class=\"mainblock\">");



    $tp_basisgegevens = tp_record($_SESSION['tp_project']);

?>

      <h1>Gegevens <?= tp_roepnaam($tp_basisgegevens) ?></h1>



<?php

   if ($_POST['action'] == "update") {

     $updateProject = "update tp_project

                        set naam = \"{$_POST['naam']}\",

                            doelgroep = \"{$_POST['doelgroep']}\",

                            bijkomend_complexiteit = \"{$_POST['bijkomend_complexiteit']}\",

                            bijkomend_langdurig = \"{$_POST['bijkomend_langdurig']}\",

                            diagnosegenre = \"{$_POST['diagnosegenre']}\",

                            aanvullend1 = \"{$_POST['aanvullend1']}\",

                            aanvullend2 = \"{$_POST['aanvullend2']}\",

                            aanvullend3 = \"{$_POST['aanvullend3']}\",

                            aanvullend4 = \"{$_POST['aanvullend4']}\",

                            aanvullend5 = \"{$_POST['aanvullend5']}\",

                            aanvullend6 = \"{$_POST['aanvullend6']}\",

                            aanvullend7 = \"{$_POST['aanvullend7']}\",

                            aanvullend8 = \"{$_POST['aanvullend8']}\"

                        where id = {$_SESSION['tp_project']}";

     $resetDSM = "delete from tp_dsm where tp = {$_SESSION['tp_project']}";

     $valuesDSM = "";



     if ($_POST['diagnosegenre'] ==  'icd') {

       foreach ($_POST['icdcodes'] as $code) {

          $valuesDSM .= ", ({$_SESSION['tp_project']}, \"$code\")";

       }

       $valuesDSM = substr($valuesDSM, 1);

       $insertDSM = "insert into tp_dsm values $valuesDSM";

     }

     else {

       foreach ($_POST['dsmcodes'] as $code) {

          $valuesDSM .= ", ({$_SESSION['tp_project']}, \"$code\")";

       }

       $valuesDSM = substr($valuesDSM, 1);

       $insertDSM = "insert into tp_dsm values $valuesDSM";

     }



     $resetWG = "delete from tp_werkingsgebied where tp = {$_SESSION['tp_project']}";

     if ($_POST['werkingsgebied1'] == "limburg") {

       $insertWG = "insert into tp_werkingsgebied values ({$_SESSION['tp_project']}, -1)";

     }

     else if ($_POST['werkingsgebied1'] == "antwerpenlimburg") {

       $insertWG = "insert into tp_werkingsgebied values ({$_SESSION['tp_project']}, -2)";

     }

     else if (count($_POST['gemeenten']) == 0) {

       $insertWG = "";

     }

     else {

       $valuesWG = "";

       foreach ($_POST['gemeenten'] as $zip) {

          $valuesWG .= ", ({$_SESSION['tp_project']}, $zip)";

       }

       $valuesWG = substr($valuesWG, 1);

       $insertWG = "insert into tp_werkingsgebied values $valuesWG";

     }



     if (mysql_query($updateProject)

         && mysql_query($resetDSM) && mysql_query($insertDSM)

         && mysql_query($resetWG) && mysql_query($insertWG)) {

       print("<p style='background-color: #8F8'>De gegevens zijn succesvol opgeslagen!</p>");

     }

     else {

       print("<p style='background-color: #F22'>De gegevens zijn NIET opgeslagen!<br/>Heb je alles correct ingevuld? Doe dit en probeer opnieuw.</p><p style='color: #FFF'>dedju:" . mysql_error() . "</p>");

     }

   }



// begin mainblock

   $tp_basisgegevens = tp_record($_SESSION['tp_project']);

?>

<form method="post">

<table class="form">



<tr>

  <td class="label">Nummer: </td>

  <td class="input"><input type="text" name="nummer" value="<?= $tp_basisgegevens['nummer'] ?>" disabled="disabled"/></td>

</tr>



<tr>

  <td class="label">Naam: </td>

  <td class="input"><input type="text" class="lang" maxlength="120" name="naam" value="<?= $tp_basisgegevens['naam'] ?>" /></td>

</tr>



<tr>

  <td class="label">Doelgroep: </td>

  <td class="input">

    <input type="radio" name="doelgroep" value="kinderen en jongeren" <?= printChecked($tp_basisgegevens['doelgroep'],"kinderen en jongeren"); ?> />

       kinderen en jongeren <br />

    <input type="radio" name="doelgroep" value="volwassenen" <?= printChecked($tp_basisgegevens['doelgroep'],"volwassenen"); ?> />

       volwassenen <br />

    <input type="radio" name="doelgroep" value="ouderen" <?= printChecked($tp_basisgegevens['doelgroep'],"ouderen"); ?> />

       ouderen <br />

    <input type="radio" name="doelgroep" value="forensische kinderen" <?= printChecked($tp_basisgegevens['doelgroep'],"forensische kinderen"); ?> />

       forensische kinderen <br />

  </td>

</tr>



<tr>

  <td class="label" valign="top">Type psychiatrisch probleem: <br />(selecteer met ctrl+muisklik)</td>

  <td class="input">

<?php

   if ($tp_basisgegevens['diagnosegenre'] == 'dsm') {

      $dsmcodeDisplay = "";

      $icdcodeDisplay = " style='display:none' ";

      $dsmSelect = " checked='checked' ";

      $icdSelect = "";

   }

   else if ($tp_basisgegevens['diagnosegenre'] == 'icd') {

      $icdcodeDisplay = "";

      $dsmcodeDisplay = " style='display:none' ";

      $icdSelect = " checked='checked' ";

      $dsmSelect = "";

   }

   else {

      $icdcodeDisplay = " style='display:none' ";

      $dsmcodeDisplay = " style='display:none' ";

   }

?>

  Duid aan welk soort diagnose je wil kiezen: <br/>



  <div>

  <div style="float:left; width:100px;">

    ICD10 : <input type="radio" name="diagnosegenre" value="icd" <?= $icdSelect ?> onclick="document.getElementById('icdcodes').style.display='block';document.getElementById('dsmcodes').style.display='none';"/>

   <select id="icdcodes" name="icdcodes[]" size="10" multiple="multiple" <?= $icdcodeDisplay ?> >

<?php

   $qryDSM = "select * from tp_dsm where tp = {$_SESSION['tp_project']} and 'icd' = '{$tp_basisgegevens['diagnosegenre']}' order by dsm";

   $qryAlle = "select * from tp_alle_dsm where genre = 'icd' order by dsm";

   $resultDSM = mysql_query($qryDSM);

   $resultAlle = mysql_query($qryAlle);

   $j = 0;

   $aantalDSM = mysql_num_rows($resultDSM);

   if ($j < $aantalDSM) {

     $rijDSM = mysql_fetch_assoc($resultDSM);

   }

   for ($i=0; $i < mysql_num_rows($resultAlle); $i++) {

     $rijAlle = mysql_fetch_assoc($resultAlle);

     if (($j < $aantalDSM) && ($rijDSM['dsm'] == $rijAlle['dsm'])) {

       $selected = " selected=\"selected\" ";

       $j++;

       $rijDSM = mysql_fetch_assoc($resultDSM);

     }

     else {

       $selected = " ";

     }

     print("<option $selected>{$rijAlle['dsm']}</option>");

   }

?>



   </select>

  </div>

  <div style="float:left; width:100px;">

    DSM : <input type="radio" name="diagnosegenre" value="dsm" <?= $dsmSelect ?> onclick="document.getElementById('dsmcodes').style.display='block';document.getElementById('icdcodes').style.display='none';"/>

   <select id="dsmcodes" name="dsmcodes[]" size="10" multiple="multiple" <?= $dsmcodeDisplay ?> >

<?php

   $qryDSM = "select * from tp_dsm where tp = {$_SESSION['tp_project']} and 'dsm' = '{$tp_basisgegevens['diagnosegenre']}' order by dsm";

   $qryAlle = "select * from tp_alle_dsm where genre = 'dsm' order by dsm";

   $resultDSM = mysql_query($qryDSM);

   $resultAlle = mysql_query($qryAlle);

   $j = 0;

   $aantalDSM = mysql_num_rows($resultDSM);

   if ($j < $aantalDSM) {

     $rijDSM = mysql_fetch_assoc($resultDSM);

   }

   for ($i=0; $i < mysql_num_rows($resultAlle); $i++) {

     $rijAlle = mysql_fetch_assoc($resultAlle);

     if (($j < $aantalDSM) && ($rijDSM['dsm'] == $rijAlle['dsm'])) {

       $selected = " selected=\"selected\" ";

       $j++;

       $rijDSM = mysql_fetch_assoc($resultDSM);

     }

     else {

       $selected = " ";

     }

     print("<option $selected>{$rijAlle['dsm']}</option>");

   }

?>

   </select>







  



  </div>

  </div>

  </td>

</tr>



<tr>

  <td class="label">Bijkomende elementen die <br/>de complexiteit van het <br/> beoogde psychiatrische probleem kenmerken: </td>

  <td class="input"><textarea name="bijkomend_complexiteit"><?= $tp_basisgegevens['bijkomend_complexiteit'] ?></textarea> </td>

</tr>



<tr>

  <td class="label">Bijkomende elementen die de langdurige tenlasteneming kenmerken: </td>

  <td class="input"><textarea name="bijkomend_langdurig"><?= $tp_basisgegevens['bijkomend_langdurig'] ?></textarea> </td>

</tr>



<tr>

<td colspan="2">

Vul hieronder tot 8 aanvullende bepalende socio-economische elementen en omgevingsfactoren in.

Later, wanneer je pati&euml;nten aanmaakt, moet je voor elke pati&euml;nt aanduiden aan welke van deze aanvullende factoren hij/zij voldoet.

</td>

</tr>



<tr>

  <td class="label">- element 1 : </td>

  <td class="input"><input type="text" class="lang" maxlength="120" name="aanvullend1" value="<?= $tp_basisgegevens['aanvullend1'] ?>" /> </td>

</tr>

<tr>

  <td class="label">- element 2 : </td>

  <td class="input"><input type="text" class="lang" maxlength="120" name="aanvullend2" value="<?= $tp_basisgegevens['aanvullend2'] ?>" /> </td>

</tr>

<tr>

  <td class="label">- element 3 : </td>

  <td class="input"><input type="text" class="lang" maxlength="120" name="aanvullend3" value="<?= $tp_basisgegevens['aanvullend3'] ?>" /> </td>

</tr>

<tr>

  <td class="label">- element 4 : </td>

  <td class="input"><input type="text" class="lang" maxlength="120" name="aanvullend4" value="<?= $tp_basisgegevens['aanvullend4'] ?>" /> </td>

</tr>

<tr>

  <td class="label">- element 5 : </td>

  <td class="input"><input type="text" class="lang" maxlength="120" name="aanvullend5" value="<?= $tp_basisgegevens['aanvullend5'] ?>" /> </td>

</tr>

<tr>

  <td class="label">- element 6 : </td>

  <td class="input"><input type="text" class="lang" maxlength="120" name="aanvullend6" value="<?= $tp_basisgegevens['aanvullend6'] ?>" /> </td>

</tr>

<tr>

  <td class="label">- element 7 : </td>

  <td class="input"><input type="text" class="lang" maxlength="120" name="aanvullend7" value="<?= $tp_basisgegevens['aanvullend7'] ?>" /> </td>

</tr>

<tr>

  <td class="label">- element 8 : </td>

  <td class="input"><input type="text" class="lang" maxlength="120" name="aanvullend8" value="<?= $tp_basisgegevens['aanvullend8'] ?>" /> </td>

</tr>



<tr>

  <td class="label" style="vertical-align: top">Werkingsgebied: </td>

<?php

   $qryGemeenten= "select distinct(tp_werkingsgebied.gemeente) from tp_werkingsgebied, gemeente

                   where tp = {$_SESSION['tp_project']} and gemeente.zip = tp_werkingsgebied.gemeente order by gemeente.naam";

   $resultWG = mysql_query($qryGemeenten) or die(mysql_error());

   $aantalWerkingsgebied = mysql_num_rows($resultWG);



   $j = 0;

   if ($aantalWerkingsgebied > 1) {

     $werking = "gemeenten";

     $rijWG = mysql_fetch_assoc($resultWG);

   }

   else if ($aantalWerkingsgebied == 0) {

     $werking = "gemeenten";

   }

   else{

     $rijWG = mysql_fetch_assoc($resultWG);

     $eersteGemeente = $rijWG['gemeente'];

     if ($eersteGemeente == -1) {

       $werking = "limburg";

     }

     else if ($eersteGemeente == -2) {

       $werking = "antwerpenlimburg";

     }

     else {

       $werking = "gemeenten";

     }

   }

?>

  <td class="input">

    <input type="radio" name="werkingsgebied1" value="limburg" <?= printChecked($werking,"limburg"); ?> />

       provincie Limburg <br />

    <input type="radio" name="werkingsgebied1" value="antwerpenlimburg" <?= printChecked($werking,"antwerpenlimburg"); ?> />

       provincies Antwerpen &amp; Limburg <br />

    <input type="radio" name="werkingsgebied1" value="gemeentes" <?= printChecked($werking,"gemeenten"); ?> />

       selecteer gemeenten <br />

    <div style="margin-left:20px;">

        <p>Duid de gemeenten van het werkingsgebied aan met ctrl+muisklik: </p>

        <select name="gemeenten[]" multiple="multiple">

<?php

   $qryAlleGemeenten = "select distinct zip, naam from gemeente where id >= 542 and id < 760 order by naam";

   $resultAlleGemeenten = mysql_query($qryAlleGemeenten);



   for ($i=0; $i < mysql_num_rows($resultAlleGemeenten); $i++) {

     $rijGemeente = mysql_fetch_assoc($resultAlleGemeenten);

     if (($j < $aantalWerkingsgebied) && ($rijWG['gemeente'] == $rijGemeente['zip'])) {

       $selected = " selected=\"selected\" ";

       $j++;

       $rijWG = mysql_fetch_assoc($resultWG);

     }

     else {

       $selected = " ";

     }

     print("<option $selected value=\"{$rijGemeente['zip']}\">{$rijGemeente['zip']} {$rijGemeente['naam']} (+ deelgemeenten) </option>");

   }

?>

        </select>

    </div>



  </td>

</tr>



<tr>

  <td class="label">Gegevens: </td>

  <td class="input"><input type="submit" value="opslaan" /></td>

</tr>

</table>

<input type="hidden" name="action" value="update" />

</form>

<?php

// einde mainblock



      print("</div>");

      print("</div>");

      print("</div>");

      require("../includes/dbclose.inc");

      require("../includes/footer.inc");

      print("</div>");

      print("</div>");

      print("</body>");

      print("</html>");

      }



//---------------------------------------------------------

/* Geen Toegang */ require("../includes/check_access.inc");

//---------------------------------------------------------



//---------------------------------------------------------

/* Sluit Dbconnectie */ require("../includes/dbclose.inc");

//---------------------------------------------------------

?>