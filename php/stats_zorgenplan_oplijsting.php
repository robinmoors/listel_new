<?php

ob_start();

session_start();



   require("../includes/clearSessie.inc");

   require("../includes/dbconnect2.inc");

   if (IsSet($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan"))

      {



$bestandsnaam = "oplijsting_zorgplannen";







$begindatum = "{$_POST['beginjaar']}{$_POST['beginmaand']}{$_POST['begindag']}";

$einddatum = "{$_POST['eindjaar']}{$_POST['eindmaand']}{$_POST['einddag']}";



if ($begindatum == "") $begindatum = "18999999";

if ($einddatum == "") $einddatum = "20999999";





switch ($_POST['soortzorgplan']) {

  case "nieuw":

    $datumbeperking = " (startdatum >= $begindatum and startdatum <= $einddatum) ";

    break;

  case "doorlopend":

    $datumbeperking = " (startdatum < $begindatum and (einddatum is NULL or einddatum = 0 or einddatum >= $begindatum)) ";

    break;

  case "stopgezet":

    $datumbeperking = " (einddatum >= $begindatum and einddatum <= $einddatum) ";

    break;

  case "effectief" :

    $queryEffectief = "select distinct(patient.code) from patient, overleg where patient.code = overleg.patient_code and

                              overleg.datum >= $begindatum and overleg.datum <= $einddatum ";

    $resultEffectief = mysql_query($queryEffectief) or die($queryEffectief);

    $effectieven = "";

    for ($i=0; $i < mysql_num_rows($resultEffectief); $i++) {

      $patient = mysql_fetch_array($resultEffectief);

      foreach ($patient as $key => $value) {

        $patient[$key] = utf8_decode($patient[$key]);

      }

      $effectieven .= ",'{$patient['code']}'";

    }

    $effectieven = "(" . substr($effectieven, 1) . ")";

    $effectiefBeperking = " patient.code in $effectieven and";

  default:

    $datumbeperking = " (startdatum <= $einddatum and (einddatum is NULL or einddatum = 0 or einddatum >= $begindatum)) ";

}



          

if (isset($_SESSION['overleg_gemeente'])) {

    $namen = "code";

    $aantalKolommen = 1;

    $from = " , gemeente ";

    $groepering = " and patient.gem_id = gemeente.id and gemeente.zip = {$_SESSION['overleg_gemeente']} order by code";

}

else switch ($_POST['beperking']) {

  case "gemeente":

    $namen = "gemeente$sep code";

    $aantalKolommen = 2;

    $from = " , gemeente ";

    $veld = " gemeente.naam, ";

    $groepering = " and patient.gem_id = gemeente.id order by gemeente.naam, code";

    break;

  case "sit":

    $namen = "sit$sep code";

    $aantalKolommen = 2;

    $from = " ,gemeente, sit ";

    $veld = "  concat('sit ',sit.naam) as sit_naam, ";

    $groepering = " and patient.gem_id = gemeente.id and gemeente.sit_id = sit.id order by sit.naam, code";

    break;

  default:

    $namen = "code";

    $aantalKolommen = 1;

    $groepering = "order by code";

    // alles samen

}





$query = "select distinct $veld code from patient $from

          where $effectiefBeperking $datumbeperking $groepering ";

//die($query);





$result=mysql_query($query) or die(mysql_error() . "<br /> $query");



$begin = "{$_POST['begindag']}/{$_POST['beginmaand']}/{$_POST['beginjaar']}";

$eind = "{$_POST['einddag']}/{$_POST['eindmaand']}/{$_POST['eindjaar']}";



$beginLang = "{$_POST['beginjaar']}{$_POST['beginmaand']}{$_POST['begindag']}";

$beginVoorRechten = "{$_POST['beginjaar']}-{$_POST['beginmaand']}-{$_POST['begindag']}";

$eindLang =  "{$_POST['eindjaar']}{$_POST['eindmaand']}{$_POST['einddag']}";



$csvOutput = "Oplijsting van zorgplannen ({$_POST['soortzorgplan']}) van $begin tot $eind\n\n";









//$csvOutput .= "$query\n";





$csvOutput .= "$namen \n";



function ooitTPrechten($code) {

  global $beginLang, $eindLang, $eindVoorRechten;

  $qry = "select * from overleg where patient_code = '$code' and genre = 'TP' and datum <= $eindLang and datum >= $beginLang order by datum desc";

  $result = mysql_query($qry);

  if (mysql_num_rows($result) == 0) {

    // geen TP-overleggen dus

    return "GDT";

  }

  else {

    $qry2 = "select * from overleg where patient_code = '$code' and genre = 'TP' and tp_rechtenOC = 1 and datum <= $eindLang and datum >= $beginLang order by datum desc";

    $result2 = mysql_query($qry2);

    if (mysql_num_rows($result2) == 0) {

      // geen TP_rechten dus kijken naar gewone overleggen

      $qry3 = "select * from overleg where patient_code = '$code' and (genre = 'gewoon' or genre is NULL) and datum <= $eindLang and datum >= $beginLang order by datum desc";

      $result3 = mysql_query($qry3);

      if (mysql_num_rows($result3) == 0) {

        // geen gewone overleggen, dus NIET tonen

        return "NIET";

      }

      else {

        return "GDT";

      }

    }

    else {

       // er  zijn TP overleggen MET rechten, dus een nummerke zoeken

       $rij = mysql_fetch_assoc($result2);

       foreach ($rij as $key => $value) {

         $rij[$key] = utf8_decode($rij[$key]);

       }

       return patient_roepnaam_opOverleg($code, $rij['id']);

    }

  }

  /*

  $qryOudeRechten = "select patient_tp.id from tp_oude_rechten, patient_tp

          where patient_tp.patient = '$code'

            and patient_tp.id = tp_oude_rechten.patient_tp_id

            and start < $eindVoorRechten

            and einde > $beginVoorRechten ";

  */



}



for ($i=0; $i < mysql_num_rows($result); $i++) {

  $rij = mysql_fetch_array($result);

       foreach ($rij as $key => $value) {

         $rij[$key] = utf8_decode($rij[$key]);

       }



  $tpNR = ooitTPrechten($rij['code']);

  if ($tpNR == "NIET") {

  }

  else {

    if ($tpNR == "GDT") {

    }

    else {

      $rij[$aantalKolommen-1] = $tpNR;

    }

    for ($j = 0; $j < $aantalKolommen; $j++) {

      $csvOutput .= '"' . $rij[$j] . " \"$sep";

    }

    $csvOutput .="\n";

    $aantalZP++;

  }



}





$csvOutput .= '"Aantal zorgplannen:"' . $sep . '"' . $aantalZP . '"' . " \n\n";









header("Content-Type: text/csv");

header("Cache-Control: must-revalidate, post-check=0,pre-check=0");

header("Content-Transfer-Encoding: binary");

header("Content-Disposition: attachment; filename=\"{$bestandsnaam}.csv\"");

header("Content-length: " . strlen($csvOutput));



print($csvOutput);



      }



//---------------------------------------------------------

/* Geen Toegang */ require("../includes/check_access.inc");

//---------------------------------------------------------

?>