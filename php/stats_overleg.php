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
    $extraBasisGegevens = "sum(locatie = 0) as thuis, sum(locatie <> 0) as elders,sum(aanwezig_patient=1) as aanwezig,
          sum(aanwezig_patient = 0) as afwezig, sum(aanwezig_patient != 1 && aanwezig_patient != 0) as vertegenwoordiger, ";
    $beperking = " and keuze_vergoeding = 1 ";
    $opsplitsing = "sum(type=1) as aantal_pvs, sum(type=3) as aantal_psychiatrische_problematiek, sum(type=4) as aantal_pat_therapeutisch_project,
          sum(overleg.genre = 'TP') as aantal_TP_overleg,
          sum(type=0) as aantal_gewoon_gdt,";
    break;
  case "geenVergoeding":
    $beperking = " and keuze_vergoeding < 1 ";
    $opsplitsing = "";
    break;
  default:
    $beperking = "";
    $opsplitsing = "";
}
if (isset($_SESSION['overleg_gemeente'])) {
    $velden = "";
    $from = " , gemeente ";
    $where = " and patient.gem_id = gemeente.id and gemeente.zip = {$_SESSION['overleg_gemeente']} ";
}
else switch ($_POST['beperking']) {
  case "gemeente":
    $aantalKolommen++;
    $namen = "gemeente; $namen";
    $from = " right join gemeente on patient.gem_id = gemeente.id";
    $velden = " gemeente.naam as gemeente, ";
    $where = " ";
    $group = " group by gemeente.naam order by gemeente.naam";
    break;
  case "sit":
    $aantalKolommen++;
    $namen = "sit; $namen";
    $from = "  , gemeente, sit ";
    $velden = " concat('sit ',sit.naam) as sit, ";
    $where = " and patient.gem_id = gemeente.id and gemeente.sit_id = sit.id ";
    $group = " group by sit.naam order by sit.naam";
    break;
  default:
    // alles samen
}


$query = "select $velden  $opsplitsing  $extraBasisGegevens count(overleg.id) as aantal_overleg, sum(katz_id is not null) as aantal_katz, sum(katz_id is not null and katz.totaal = 1) as katz_1,
          sum(katz_id is not null and katz.totaal = 2) as katz_2, sum(katz_id is not null and katz.totaal = 3) as katz_3,
          sum(katz_id is not null and katz.totaal = 4) as katz_4, sum(katz_id is not null and katz.totaal = 5) as katz_5,
          sum(katz_id is not null and katz.totaal = 6) as katz_6, sum(katz_id is not null and katz.totaal = 7) as katz_7,
          sum(katz_id is not null and katz.totaal = 8) as katz_8, sum(katz_id is not null and katz.totaal = 9) as katz_9,
          sum(katz_id is not null and katz.totaal = 10) as katz_10, sum(katz_id is not null and katz.totaal = 11) as katz_11,
          sum(katz_id is not null and katz.totaal = 12) as katz_12, sum(katz_id is not null and katz.totaal = 13) as katz_13,
          sum(katz_id is not null and katz.totaal = 14) as katz_14, sum(katz_id is not null and katz.totaal = 15) as katz_15
          from overleg left join katz on (overleg.katz_id = katz.id), patient $from
          where patient.code = overleg.patient_code and overleg.datum >= $begindatum  and overleg.datum <= $einddatum
          $beperking $where
          $group ";

if ($_POST['soortOverleg'] == "geenVergoeding" && $_POST['beperking'] == "gemeente") {
  $query = "select gemeente.naam as gemeente, count(overleg.id) as aantal_overleg, sum(katz_id is not null) as aantal_katz, sum(katz_id is not null and katz.totaal = 1) as katz_1,
            sum(katz_id is not null and katz.totaal = 2) as katz_2, sum(katz_id is not null and katz.totaal = 3) as katz_3,
            sum(katz_id is not null and katz.totaal = 4) as katz_4, sum(katz_id is not null and katz.totaal = 5) as katz_5,
            sum(katz_id is not null and katz.totaal = 6) as katz_6, sum(katz_id is not null and katz.totaal = 7) as katz_7,
            sum(katz_id is not null and katz.totaal = 8) as katz_8, sum(katz_id is not null and katz.totaal = 9) as katz_9,
            sum(katz_id is not null and katz.totaal = 10) as katz_10, sum(katz_id is not null and katz.totaal = 11) as katz_11,
            sum(katz_id is not null and katz.totaal = 12) as katz_12, sum(katz_id is not null and katz.totaal = 13) as katz_13,
            sum(katz_id is not null and katz.totaal = 14) as katz_14, sum(katz_id is not null and katz.totaal = 15) as katz_15
            from gemeente left join patient on patient.gem_id = gemeente.id left join overleg on
               (patient.code = overleg.patient_code and overleg.datum >= $begindatum and overleg.datum <= $einddatum and keuze_vergoeding <> 1)
               left join katz on (overleg.katz_id = katz.id)
            where gemeente.sit_id > -1
               group by gemeente.naam order by gemeente.naam";
}


$begin = "{$_POST['begindag']}/{$_POST['beginmaand']}/{$_POST['beginjaar']}";
$eind = "{$_POST['einddag']}/{$_POST['eindmaand']}/{$_POST['eindjaar']}";
$csvOutput = "Overleggen ({$_POST['soortOverleg']}) van $begin tot $eind\n\n";


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