<?php

ob_start();

session_start();



   require("../includes/clearSessie.inc");

   require("../includes/dbconnect2.inc");

   if (IsSet($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan"))

      {



$bestandsnaam = "zorgplan";



$jaar = intval(date("Y"));

$nulJaar = date("Ymd");

$tienJaar = ($jaar-10) . date("md");

$twintigJaar = ($jaar-20) . date("md");

$dertigJaar = ($jaar-30) . date("md");

$veertigJaar = ($jaar-40) . date("md");

$vijftigJaar = ($jaar-50) . date("md");

$zestigJaar = ($jaar-60) . date("md");

$zeventigJaar = ($jaar-70) . date("md");

$tachtigJaar = ($jaar-80) . date("md");

$negentigJaar = ($jaar-90) . date("md");

$honderdJaar = ($jaar-100) . date("md");



$query = "select count(distinct patient.code) as aantal_patienten_met_effectief_overleg ";

          

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

  default:

    $datumbeperking = " (startdatum <= $einddatum and (einddatum is NULL or einddatum = 0 or einddatum >= $begindatum)) ";

}

          

$overlegvoorwaarde = " patient.code = overleg.patient_code and overleg.datum >= $begindatum and overleg.datum <= $einddatum and ";

if (isset($_SESSION['overleg_gemeente'])) {

    $query .= " from overleg, patient, gemeente where $overlegvoorwaarde $datumbeperking and patient.gem_id = gemeente.id and gemeente.zip = {$_SESSION['overleg_gemeente']} ";

}

else switch ($_POST['beperking']) {

  case "gemeente":

    $query .= " , gemeente.naam as gemeente from overleg, patient, gemeente where $overlegvoorwaarde $datumbeperking and patient.gem_id = gemeente.id group by  gemeente.naam order by gemeente.naam";

    break;

  case "sit":

    $query .= " ,  concat('sit ',sit.naam) as sit from patient, overleg, gemeente, sit where $overlegvoorwaarde $datumbeperking and patient.gem_id = gemeente.id and gemeente.sit_id = sit.id group by sit.naam";

    break;

  default:

    $query .= " from patient, overleg where $overlegvoorwaarde $datumbeperking";

    // alles samen

}



//die($query);



$begin = "{$_POST['begindag']}/{$_POST['beginmaand']}/{$_POST['beginjaar']}";

$eind = "{$_POST['einddag']}/{$_POST['eindmaand']}/{$_POST['eindjaar']}";

$csvOutput = "zorgplannen met actieve overleggen ({$_POST['soortzorgplan']}) van $begin tot $eind\n\n";





$result=mysql_query($query) or die(mysql_error() . "<br /> $query");



$aantalKolommen = mysql_num_fields($result);

for ($i = 0; $i < $aantalKolommen; $i++) {

  $field = mysql_fetch_field($result);

  $kolom[$i] = $field->name;

  $csvOutput .= '"'. $kolom[$i] . "\"$sep";

}

$csvOutput .= "\n";





for ($i=0; $i < mysql_num_rows($result); $i++) {

  $rij = mysql_fetch_array($result);

  for ($j = 0; $j < $aantalKolommen; $j++) {

    $csvOutput .= '"' . $rij[$kolom[$j]] . "\"$sep";

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