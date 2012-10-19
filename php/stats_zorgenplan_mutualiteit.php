<?php

ob_start();

session_start();



   require("../includes/clearSessie.inc");

   require("../includes/dbconnect2.inc");

   if (IsSet($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan"))

      {



$bestandsnaam = "zorgplan_per_mutualiteit";





$queryMut = "select id, naam from verzekering order by naam";

$resultMut = mysql_query($queryMut);



$select = "";

$namen = "";



$aantalKolommen = mysql_num_rows($resultMut);



for ($i=0; $i < mysql_num_rows($resultMut); $i++) {

  $rij = mysql_fetch_array($resultMut);

  $select .= ", sum(mut_id={$rij['id']}) ";

  $namen .= "{$rij['naam']}$sep ";

}



$select = substr($select, 1);



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

      $effectieven .= ",'{$patient['code']}'";

    }

    $effectieven = "(" . substr($effectieven, 1) . ")";

    $effectiefBeperking = " patient.code in $effectieven and";

  default:

    $datumbeperking = " (startdatum <= $einddatum and (einddatum is NULL or einddatum = 0 or einddatum >= $begindatum)) ";

}



          

if (isset($_SESSION['overleg_gemeente'])) {

    $velden = "";

    $from = " , gemeente ";

    $where = " and patient.gem_id = gemeente.id and gemeente.zip = {$_SESSION['overleg_gemeente']} ";

}

else switch ($_POST['beperking']) {

  case "gemeente":

    $aantalKolommen++;

    $namen = "gemeente$sep $namen";

    $from = " , gemeente ";

    $velden = " gemeente.naam, ";

    $where = " and patient.gem_id = gemeente.id ";

    $group = " group by gemeente.naam order by gemeente.naam";

    break;

  case "sit":

    $aantalKolommen++;

    $namen = "sit$sep $namen";

    $from = " ,gemeente, sit ";

    $velden = " concat('sit ',sit.naam) as sit_naam, ";

    $where = " and patient.gem_id = gemeente.id and gemeente.sit_id = sit.id ";

    $group = " group by sit.naam order by sit.naam";

    break;

  default:

    // alles samen

}





$query = "select $velden $select from patient, verzekering $from

          where $effectiefBeperking patient.mut_id = verzekering.id

          and $datumbeperking $where $group";

//die($query);





$result=mysql_query($query) or die(mysql_error() . "<br /> $query");



$begin = "{$_POST['begindag']}/{$_POST['beginmaand']}/{$_POST['beginjaar']}";

$eind = "{$_POST['einddag']}/{$_POST['eindmaand']}/{$_POST['eindjaar']}";

$csvOutput = "zorgplannen per mutualiteit ({$_POST['soortzorgplan']}) van $begin tot $eind\n\n";



$csvOutput .= "$namen \n";





for ($i=0; $i < mysql_num_rows($result); $i++) {

  $rij = mysql_fetch_array($result);

  for ($j = 0; $j < $aantalKolommen; $j++) {

    $csvOutput .= '"' . $rij[$j] . "\"$sep";

  }

  $csvOutput .="\n";

}













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