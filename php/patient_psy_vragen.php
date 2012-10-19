<?php

session_start();



function komtVoorInAntwoorden($antwoordenArray, $antwoord) {

   if (!is_array($antwoordenArray))

     return 0;

   if (in_array($antwoord, $antwoordenArray))

     return 1;

   else

     return 0;

}


   require("../includes/dbconnect2.inc");
   require("../includes/clearSessie.inc");

   $paginanaam="Psychiatrie-gerelateerde vragen";

   if (isset($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan"))
   {
      require("../includes/html_html.inc");
      print("<head>");
      require("../includes/html_head.inc");
?>
<style type="text/css">
td {
  font-size:11px;
}
</style>

<?
      print("\n<script type=\"text/javascript\" src=\"../javascript/prototype.js\"></script>\n");
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



if ($_SESSION['code']!=$_GET['code'] && (isset($_GET['code']))) {
  $_SESSION['pat_code']=$_GET['code'];
}

$qryPatient = "select * from patient where code = \"{$_SESSION['pat_code']}\"";

$resultPatient = mysql_query($qryPatient) or die(mysql_error());
if (mysql_num_rows($resultPatient) > 0) {
  $patient=mysql_fetch_assoc($resultPatient);
}

$qryPatientPsy = "select * from patient_psy where code = \"{$_SESSION['pat_code']}\"";
$resultPatientPsy = mysql_query($qryPatientPsy) or die(mysql_error());
if (mysql_num_rows($resultPatientPsy) > 0) {
  $patientPsy=mysql_fetch_assoc($resultPatientPsy);
}


if (isset($_POST['patient'])) {
  if ($patientPsy['domeinen']==0) {
    $zoekOverlegQry = "select * from overleg where genre = 'psy' and patient_code = \"{$_POST['patient']}\" order by datum asc";
    $zoekOverlegResult = mysql_query($zoekOverlegQry) or die("ik kan niet zien of er al een overleg gepland is" .mysql_error());
    if (mysql_num_rows($zoekOverlegResult) >= 1) {
      $zoekOverleg = mysql_fetch_assoc($zoekOverlegResult);
      $_POST['datum'] = $zoekOverleg['datum'];
    }
  }
 /*
  if (strlen($_POST['begindag'])<2) $startdatum = "0" . $_POST['begindag'];
  else $startdatum = $_POST['begindag'];
  
  if (strlen($_POST['beginmaand'])<2) $startdatum = $_POST['beginjaar'] . "0" . $_POST['beginmaand'] . $startdatum;
  else $startdatum = $_POST['beginjaar'] . "" . $_POST['beginmaand'] . $startdatum;
 */
 
  if (isset($_POST['tp_nummer'])) {
    $extraFields .= ",tp_nummer";
    $extraValues .= ",{$_POST['tp_nummer']}";
  }
  if (!isset($_POST['hoofddiagnose'])) $_POST['hoofddiagnose'] = "";
  if (!isset($_POST['nood_begeleidingsplan'])) $_POST['nood_begeleidingsplan'] = "0";
  if (!isset($_POST['toename_symptonen'])) $_POST['toename_symptonen'] = 0;
  if (!isset($_POST['ziekenhuis'])) $_POST['ziekenhuis'] = 0;
  if (!isset($_POST['ziekenhuis_ander'])) $_POST['ziekenhuis_ander'] = 0;
  if (!isset($_POST['persoonlijk'])) $_POST['persoonlijk'] = 0;

  if (!isset($_POST['politie'])) $_POST['politie'] = 0;
  if (!isset($_POST['cgg'])) $_POST['cgg'] = 0;
  if (!isset($_POST['outreach'])) $_POST['outreach'] = 0;
  if (!isset($_POST['art107'])) $_POST['art107'] = 0;

  // eerst domeinen opslaan en dan het id in psy_domeinen opslaan in patient_psy
  if ($_POST['patient_psy'] > 0) {
     //$domeinenID = updateDomeinen($_POST, $patientPsy['domeinen']);
     $domeinenID = saveDomeinen($_POST);
     //$_POST['datum'] = $startdatum;
     $qryPsy = "update patient_psy set
               /* startdatum =$startdatum, */
               hoofddiagnose = \"{$_POST['hoofddiagnose']}\",
               nood_begeleidingsplan = {$_POST['nood_begeleidingsplan']},
               toename_symptonen = {$_POST['toename_symptonen']},
               ziekenhuis = {$_POST['ziekenhuis']},
               ziekenhuis_ander = {$_POST['ziekenhuis_ander']},
               domeinen = $domeinenID,
               politie = {$_POST['politie']},
               cgg = {$_POST['cgg']},
               outreach = {$_POST['outreach']},
               art107 = {$_POST['art107']}
               where code = \"{$_POST['patient']}\"
     ";
     
  }
  else {
     $domeinenID = saveDomeinen($_POST);
     $qryPsy = "insert into patient_psy
                       (code, /* startdatum, */ hoofddiagnose,
                       nood_begeleidingsplan, toename_symptonen,
                       ziekenhuis, ziekenhuis_ander, domeinen,
                       politie,cgg,outreach,art107
                       $extraFields)
                values (\"{$_POST['patient']}\", /* $startdatum, */ \"{$_POST['hoofddiagnose']}\",
                       {$_POST['nood_begeleidingsplan']},{$_POST['toename_symptonen']},
                       {$_POST['ziekenhuis']},{$_POST['ziekenhuis_ander']}, $domeinenID,
                       {$_POST['politie']},{$_POST['cgg']},{$_POST['outreach']},{$_POST['art107']}
                       $extraValues)";
  }

  $patientPsy['domeinen'] = $domeinenID;

  if (isset($_POST['secundairediagnose'])) {
    $resetSecundair = "delete from psy_comorbiditeit where patient = \"{$_POST['patient']}\" ";
    $values = "";
    foreach ($_POST['secundairediagnose'] as $dsm) {
      $values .= ", (\"{$_POST['patient']}\", '$dsm', '')";
    }
    $values = substr($values, 1);
    $insertSecundair = "insert into psy_comorbiditeit (patient, diagnose, genre) values $values";
    $okSecundair = mysql_query($resetSecundair) && mysql_query($insertSecundair);
  }
  else
    $okSecundair = true;



  if (mysql_query($qryPsy) && $okSecundair) {
    print("<p style='background-color: #8f8'>Gegevens succesvol opgeslagen.</p>");
    // en effe terug de meest recente toestand ophalen
    foreach ($_POST as $index => $value) {
      $patientPsy[$index] = $value;
    }
  }

  else  {
    print("$qryPsy - $okSecundair " .mysql_error());

  }

}








// begin mainblock

    if (isset($patientPsy) && $patientPsy['tp_nummer']!=0) {
      $tp_nummer = $patientPsy['tp_nummer'];
    }
    else if ($_GET['vanTP']==1) {
       $einddatumTP = date("Y-m-d");
       $tp_Record = getUniqueRecord("select tp_project.*, hoofddiagnose from tp_project inner join patient_tp on tp_project.id = patient_tp.project and patient = \"{$_SESSION['pat_code']}\" and einddatum =\"$einddatumTP\"");
       $tp_basisgegevens = tp_record($tp_Record['id']);
       $tp_nummer = $tp_basisgegevens['nummer'];
       if ($tp_nummer == 7) {
         die("Van TP-7 mag je geen patiënten zomaar overnemen");
       }
    }
    else {
      $tp_nummer = -1;
    }

?>

   <h1>Psychiatrie-gerelateerde gegevens <?= $_SESSION['pat_code'] ?></h1>



<form method="post" onsubmit="return voldoetPatientPsy(<?= $patient['type'] ?>);">
<?php
    if ($tp_nummer != -1) {
        $nummer = " TP-$tp_nummer";
        if (isset($tp_Record)) {
          $infoTP = "$nummer ({$tp_Record['naam']})";
          $werkwoordTP = "wordt";
        }
        else {
          $infoTP = $nummer;
          $werkwoordTP = "is";
        }

        print("<p>Deze pati&euml;nt $werkwoordTP overgenomen van project $infoTP,<br/> en moet (daarom) niet aan alle opnamecriteria voldoen.</p>\n");
        print(" <input type=\"hidden\" id=\"tp_nummer\" name=\"tp_nummer\" value=\"$tp_nummer\" /> ");
    }
?>

<!--
<table class="form">

<tr>

  <td class="label">Datum eerste overleg </td>

<?php
  if ($patientPsy['startdatum']=="")
    $patientPsy['startdatum'] = date("Ymd");
?>

  <td class="input">
     <input type="text" style="width: 33px;" name="begindag" value="<?= substr($patientPsy['startdatum'],6,2) ?>" />-
     <input type="text" style="width: 33px;" name="beginmaand" value="<?= substr($patientPsy['startdatum'],4,2) ?>" />-
     <input type="text" style="width: 58px;" name="beginjaar" value="<?= substr($patientPsy['startdatum'],0,4) ?>" />
  </td>

</tr>
</table>
-->

<ol>
<li style="list-style-image:none;"><strong>Hoofddiagnose</strong>: deze hoofddiagnose moet van (potentieel) herhalende aard zijn. <br/>
<table>
<tr>
<td style="width:110px;">DSM IV of ICD10</td>
<td>
   <select name="hoofddiagnose" id="hoofddiagnose" size="4" >
<?php


   $qryAlle = "select * from psy_dsm order by code";
   $qrySecundair = "select diagnose from psy_comorbiditeit
               where patient = '{$_SESSION['pat_code']}'
               order by diagnose";
   $resultAlle = mysql_query($qryAlle);
   $resultSecundair = mysql_query($qrySecundair) or die(mysql_error());
   $nogSecundair = mysql_num_rows($resultSecundair);
   
   //als 'm van TP komt.
   if ($nogSecundair == 0 && $tp_nummer > 0) {
     $qrySecundair = "select dsm as diagnose from patient_secundair
               where patient = '{$_SESSION['pat_code']}'
               order by dsm";
     $resultSecundair = mysql_query($qrySecundair) or die(mysql_error());
     $nogSecundair = mysql_num_rows($resultSecundair);
   }
   if ($patientPsy['hoofddiagnose']=="") {
     $patientPsy['hoofddiagnose'] = $tp_Record['hoofddiagnose'];
   }
   
   if ($nogSecundair > 0) {
      $huidigeDSM = mysql_fetch_assoc($resultSecundair);
      $nogSecundair--;
   }
   else {
     $huidigeDSM['diagnose'] = "den deze bestaat zeker niet";
   }

   for ($i=0; $i < mysql_num_rows($resultAlle); $i++) {
     $rijAlle = mysql_fetch_assoc($resultAlle);
     if ($patientPsy['hoofddiagnose'] == $rijAlle['code']) {
       $selected = " selected=\"selected\" ";
     }
     else {
       $selected = " ";
     }
     if ($rijAlle['hoofddiagnose']==1) {
       print("<option $selected>{$rijAlle['code']}</option>");
     }
     if ($huidigeDSM['diagnose'] == $rijAlle['code']) {
       $selected = " selected=\"selected\" ";
       if ($nogSecundair > 0) {
         $huidigeDSM = mysql_fetch_assoc($resultSecundair);
         $nogSecundair--;
       }
     }
     else {
       $selected = " ";
     }

     $select2 .= "<option $selected>{$rijAlle['code']}</option>\n";
   }
?>
   </select>
</td>
<td>
<em>niet opgenomen in deze lijst</em>
<ul>
<li>Dementie</li>
<li>Andere cognitieve stoornissen van medische, vasculaire of traumatische oorsprong</li>
<li>Epilepsie</li>
<li>Mentale retardatie</li>
<li>Neurologische stoornis</li>
</ul>
</td>
</tr>
</table>

</li>

<li style="list-style-image:none;">
<strong>Comorbiditeit</strong>:
Er is minstens &eacute;&eacute;n bijkomende psychiatrische problematiek<br/>
(Gebruik ctrl-klik voor meervoudige selectie)<br/>
<table>
<tr>
<td style="width:110px;">DSM IV of ICD10<br/>
</td>
<td>
<select name="secundairediagnose[]" id="comorbiditeit" size="4" multiple="multiple">
<?=  $select2 ?>
</select>
</td>
<td>
<em>zonder uitzonderingen</em>
</td>
</tr>
</table>
</li>

<li style="list-style-image:none;">
<strong>Begeleidingsplan</strong>: er is nood aan een begeleidingsplan waarbij de zorgen op elkaar worden afgestemd  volgens minstens 3 betrokken zorg- en hulpverleners en de duurtijd bedraagt minstens 12 maanden.
<input style="position:relative; top:3px;margin-top:-3px;" type="checkbox" value="1" id="nood_begeleidingsplan" name="nood_begeleidingsplan" <?= printChecked(1,$patientPsy['nood_begeleidingsplan']) ?> />
</li>

<li style="list-style-image:none;">
Er is <strong>toename</strong> van de intensiteit of frequentie van de symptonen.
<input type="checkbox" value="1" id="toename_symptonen" name="toename_symptonen" <?= printChecked(1,$patientPsy['toename_symptonen']) ?> />
</li>


<?php
psyContactZiekenhuis($patient, $patientPsy);
psyDomeinenStart($patient, $patientPsy);

?>
<li style="list-style-type:none;list-style-image:none;"><strong>Let op.</strong> Deze domeinen hierboven gelden tijdens het eerste overleg van de pati&euml;nt. Indien de toestand wijzigt, moeten de domeinen bij een overleg aangepast worden (en niet hier).  </li>
</ol>



<!--
<tr>
  <td class="label" valign="top"></td>
  <td class="input"><input type="checkbox" value="1" name="" <?= printChecked(1,$patientPsy['']) ?> /> </td>
</tr>


<tr>
  <td class="label" valign="top"></td>
  <td class="input"><input type="checkbox" value="1" name="" <?= printChecked(1,$patientPsy['']) ?> /> </td>
</tr>
<tr>
  <td class="label" valign="top"></td>
  <td class="input"><input type="checkbox" value="1" name="" <?= printChecked(1,$patientPsy['']) ?> /> </td>
</tr>
<tr>
  <td class="label" valign="top"></td>
  <td class="input"><input type="checkbox" value="1" name="" <?= printChecked(1,$patientPsy['']) ?> /> </td>
</tr>
-->




<table class="form">
<tr>
  <td class="label">Gegevens: </td>
  <td class="input"><input type="submit" value="opslaan" /></td>
</tr>
</table>

<input type="hidden" name="patient_psy" value="<?= $patientPsy['id'] ?>" />
<input type="hidden" name="patient" value="<?= $_SESSION['pat_code'] ?>" />

</form>

<br/>
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

    else {

      print("Alleen logins voor psychiatrische pati&euml;nten kunnen dit doen.");

    }



//---------------------------------------------------------

/* Geen Toegang */ require("../includes/check_access.inc");

//---------------------------------------------------------



//---------------------------------------------------------

/* Sluit Dbconnectie */ require("../includes/dbclose.inc");

//---------------------------------------------------------

?>