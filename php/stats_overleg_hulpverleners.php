<?php

ob_start();

session_start();





   require("../includes/clearSessie.inc");

   require("../includes/dbconnect2.inc");

   if (IsSet($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan"))

      {



$bestandsnaam = "overleg";



$begindatum = "{$_POST['beginjaar']}{$_POST['beginmaand']}{$_POST['begindag']}";

$einddatum = "{$_POST['eindjaar']}{$_POST['eindmaand']}{$_POST['einddag']}";



if ($begindatum == "") $begindatum = "18999999";

if ($einddatum == "") $einddatum = "20999999";







switch ($_POST['soortOverleg']) {

  case "vergoeding":

    $beperking = " and keuze_vergoeding = 1 ";

    break;

  case "geenVergoeding":

    $beperking = " and keuze_vergoeding < 1 ";

    break;

  default:

    $beperking = "";

}

if (isset($_SESSION['overleg_gemeente'])) {

    $velden = "";

    $from = " , gemeente ";

    $where = " and patient.gem_id = gemeente.id and gemeente.zip = {$_SESSION['overleg_gemeente']} ";

    $group = " group by organisatie.id order by organisatie.naam ";

}

else switch ($_POST['beperking']) {

  case "gemeente":

    $aantalKolommen++;

    $namen = "gemeente; $namen";

    $from = " , gemeente ";

    $velden = " gemeente.naam as gemeente, ";

    $where = " and patient.gem_id = gemeente.id ";

    $group = " group by gemeente.naam, organisatie.id order by gemeente.naam, organisatie.naam";

    break;

  case "sit":

    $aantalKolommen++;

    $namen = "sit; $namen";

    $from = " ,gemeente, sit ";

    $velden = "  concat('sit ',sit.naam) as sit, ";

    $where = " and patient.gem_id = gemeente.id and gemeente.sit_id = sit.id ";

    $group = " group by sit.naam, organisatie.id order by sit.naam, organisatie.naam";

    break;

  default:

    $group = " group by organisatie.id order by organisatie.naam ";

    // alles samen

}





$query = "select $velden organisatie.naam as organisatie, count(distinct hvl.fnct_id)

          as aantal_disciplines

          from afgeronde_betrokkenen lijst, patient, hulpverleners hvl, overleg, organisatie     $from

          where patient.code = overleg.patient_code and overleg.id = lijst.overleg_id and lijst.genre = 'hulp' and lijst.persoon_id = hvl.id
          and overleggenre = 'gewoon'
          and overleg.datum >= $begindatum  and overleg.datum <= $einddatum and hvl.organisatie = organisatie.id

          $beperking $where

          $group ";

          

//die($query);



$begin = "{$_POST['begindag']}/{$_POST['beginmaand']}/{$_POST['beginjaar']}";

$eind = "{$_POST['einddag']}/{$_POST['eindmaand']}/{$_POST['eindjaar']}";

$csvOutput = "Overleggen en hun hulpverleners ({$_POST['soortOverleg']}) van $begin tot $eind\n\n";





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