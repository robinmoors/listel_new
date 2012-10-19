<?php

ob_start();
session_start();

   require("../includes/clearSessie.inc");
   require("../includes/dbconnect2.inc");
   if (IsSet($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan") && ($_SESSION['profiel']=="listel"))
      {

if ($_POST['beginjaar']<100) $_POST['beginjaar']="20".$_POST['beginjaar'];
if ($_POST['eindjaar']<100) $_POST['eindjaar']="20".$_POST['eindjaar'];
if ($_POST['sep']==",")
  $sep = ",";
else
  $sep = ";";

$bestandsnaam = "Statistieken_zorgtraject";


$begindatum = "{$_POST['beginjaar']}{$_POST['beginmaand']}{$_POST['begindag']}";
$einddatum = "{$_POST['eindjaar']}{$_POST['eindmaand']}{$_POST['einddag']}";
$begindatum_ = "{$_POST['beginjaar']}-{$_POST['beginmaand']}-{$_POST['begindag']}";
$einddatum_ = "{$_POST['eindjaar']}-{$_POST['eindmaand']}-{$_POST['einddag']}";

if ($begindatum == "") {
  $begindatum = "18999999";
  $begindatum = "1899-99-99";
}
if ($einddatum == "") {
  $einddatum = "20999999";
  $einddatum = "2099-99-99";
}

$beginstamp = mktime(0,0,0,$_POST['beginmaand'],$_POST['begindag'],$_POST['beginjaar']);
$eindstamp = mktime(0,0,0,$_POST['eindmaand'],$_POST['einddag'],$_POST['eindjaar']);




$csvOutput = "Overzicht zorgtrajecten DIABETES van {$_POST['begindag']}/{$_POST['beginmaand']}/{$_POST['beginjaar']} tot {$_POST['einddag']}/{$_POST['eindmaand']}/{$_POST['eindjaar']}\n\n";

$qry = "select distinct p.code, p.naam, p.voornaam, p.gebdatum, gemeente.dlnaam, p.zorgtraject_diabetes, p.zorgtraject_datum
        from (patient p inner join gemeente on p.gem_id = gemeente.id) left join patient_zorgtraject z on p.code = z.patient
        where (p.zorgtraject_diabetes = 1 or z.diabetes = 1)
        order by p.naam
        ";



  $csvOutput .= "\n\n";
  $csvOutput .= "code{$sep}naam{$sep}voornaam{$sep}geboorte{$sep}woonplaats{$sep}details\n";

$result = mysql_query($qry) or die($qry . mysql_error());
$aantal = 0;

for ($i=0; $i<mysql_num_rows($result);$i++) {
  $record = mysql_fetch_assoc($result);
  //gemeente{$sep}
  $zorg = zorgtraject($record, "diabetes", $begindatum, $einddatum);
  if ($zorg != "") {
    $datum = mooieDatum($record['gebdatum']);
    $csvOutput .= "{$record['code']}{$sep}{$record['naam']}{$sep}{$record['voornaam']}{$sep}{$datum}{$sep}{$record['dlnaam']}{$sep}$zorg\n";
    $aantal++;
  }
}

$csvOutput .= "$aantal{$sep}patienten met zorgtraject diabetes\n\n\n";



$csvOutput .= "\n\n";
$csvOutput .= "Overzicht zorgtrajecten CHRONISCHE NIERINSUFFICIENTIE van {$_POST['begindag']}/{$_POST['beginmaand']}/{$_POST['beginjaar']} tot {$_POST['einddag']}/{$_POST['eindmaand']}/{$_POST['eindjaar']}\n\n";

$qry = "select distinct p.code, p.naam, p.voornaam, p.gebdatum, gemeente.dlnaam, p.zorgtraject_nieren, p.zorgtraject_datum
        from (patient p inner join gemeente on p.gem_id = gemeente.id) left join patient_zorgtraject z on p.code = z.patient
        where (p.zorgtraject_nieren = 1 or z.nieren = 1)
        order by p.naam
        ";



$csvOutput .= "\n\n";
$csvOutput .= "code{$sep}naam{$sep}voornaam{$sep}geboorte{$sep}woonplaats{$sep}details\n";

$result = mysql_query($qry) or die($qry . mysql_error());
$aantal = 0;

for ($i=0; $i<mysql_num_rows($result);$i++) {
  $record = mysql_fetch_assoc($result);
  //gemeente{$sep}
  $zorg = zorgtraject($record, "nieren", $begindatum, $einddatum);
  if ($zorg != "") {
    $datum = mooieDatum($record['gebdatum']);
    $csvOutput .= "{$record['code']}{$sep}{$record['naam']}{$sep}{$record['voornaam']}{$sep}{$datum}{$sep}{$record['dlnaam']}{$sep}$zorg\n";
    $aantal++;
  }
}

$csvOutput .= "$aantal{$sep}patienten met zorgtraject CHRONISCHE NIERINSUFFICIENTIE\n\n\n";




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