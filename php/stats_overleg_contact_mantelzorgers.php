<?php
ob_start();
session_start();


   require("../includes/clearSessie.inc");
   require("../includes/dbconnect2.inc");
   if (IsSet($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan"))
      {

$bestandsnaam = "overleg_contactpersonen_mantelzorger";

$queryVerwantschap = "select id, naam from verwantschap order by naam";
$resultVerwantschap = mysql_query($queryVerwantschap);

$select = "";
$namen = "";

$aantalKolommen = mysql_num_rows($resultVerwantschap);

for ($i=0; $i < mysql_num_rows($resultVerwantschap); $i++) {
  $rij = mysql_fetch_array($resultVerwantschap);
  $select .= ", sum(verwsch_id={$rij['id']}) ";
  $namen .= "{$rij['naam']}$sep ";
}

$select = substr($select, 1);



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
    $velden = "  concat('sit ',sit.naam) as sit_naam, ";
    $where = " and patient.gem_id = gemeente.id and gemeente.sit_id = sit.id ";
    $group = " group by sit.naam order by sit.naam";
    break;
  default:
    // alles samen
}


$query = "select $velden $select
          from patient, mantelzorgers mz, overleg $from
          where patient.code = overleg.patient_code and overleg.contact_mz = mz.id
          and overleg.datum >= $begindatum  and overleg.datum <= $einddatum
          $beperking $where
          $group ";
          
//die($query);

$begin = "{$_POST['begindag']}/{$_POST['beginmaand']}/{$_POST['beginjaar']}";
$eind = "{$_POST['einddag']}/{$_POST['eindmaand']}/{$_POST['eindjaar']}";
$csvOutput = "Overleggen en mantelzorgers als contactpersoon({$_POST['soortOverleg']}) van $begin tot $eind\n\n";


$result=mysql_query($query) or die(mysql_error() . "<br /> $query");

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