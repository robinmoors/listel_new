<?php

ob_start();

session_start();



   require("../includes/clearSessie.inc");

   require("../includes/dbconnect2.inc");

   if (IsSet($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan"))

      {



$bestandsnaam = "evaluatie";



$query = "select count(distinct evaluatie.patient) as aantal_zorgplannen,

                 count(distinct evaluatie.id) as aantal_evaluaties,

                 sum(evaluatie.locatie='huisbezoek') as huisbezoek,

                 sum(evaluatie.locatie='bureelbezoek') as bureelbezoek,

                 sum(evaluatie.locatie='email') as email";



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

    $query .= " from patient, gemeente, evaluatie where  $effectiefBeperking evaluatie.patient = patient.code and $datumbeperking and patient.gem_id = gemeente.id and gemeente.zip = {$_SESSION['overleg_gemeente']} ";

}

else switch ($_POST['beperking']) {

  case "gemeente":

    $query .= "  , gemeente.naam as gemeente from patient, gemeente, evaluatie where  $effectiefBeperking evaluatie.patient = patient.code and $datumbeperking and patient.gem_id = gemeente.id group by  gemeente.naam order by gemeente.naam";

    break;

  case "sit":

    $query .= "  ,  concat('sit ',sit.naam) as sit from patient, gemeente, sit, evaluatie where  $effectiefBeperking evaluatie.patient = patient.code and $datumbeperking and patient.gem_id = gemeente.id and gemeente.sit_id = sit.id group by sit.naam";

    break;

  default:

    $query .= " $redenstopzetting from patient, evaluatie where  $effectiefBeperking evaluatie.patient = patient.code and $datumbeperking";

    // alles samen

}



//die($query);



$begin = "{$_POST['begindag']}/{$_POST['beginmaand']}/{$_POST['beginjaar']}";

$eind = "{$_POST['einddag']}/{$_POST['eindmaand']}/{$_POST['eindjaar']}";

$csvOutput = "Evaluaties (zorgplan {$_POST['soortzorgplan']}) van $begin tot $eind\n\n";



$result=mysql_query($query) or die(mysql_error() . "<br /> $query");



$aantalKolommen = mysql_num_fields($result);

for ($i = 0; $i < $aantalKolommen; $i++) {

  $field = mysql_fetch_field($result);

  $kolom[$i] = utf8_decode($field->name);

  $csvOutput .= '"'. $kolom[$i] . "\"$sep";

}

$csvOutput .= "\n";





for ($i=0; $i < mysql_num_rows($result); $i++) {

  $rij = mysql_fetch_array($result);

  foreach ($rij as $key => $value) {

    $rij[$key] = utf8_decode($rij[$key]);

  }

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