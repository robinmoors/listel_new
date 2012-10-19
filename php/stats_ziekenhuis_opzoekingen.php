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



$csvOutput = "Overzicht van de opzoekingen rijksregister door een ziekenhuis";
$csvOutput .= "van {$_POST['begindag']}/{$_POST['beginmaand']}/{$_POST['beginjaar']} tot {$_POST['einddag']}/{$_POST['eindmaand']}/{$_POST['eindjaar']}\n\n";


$bestandsnaam = "Statistieken_ziekenhuis_opzoekingen";

// datum, sorteerdatum, persoon, organisatie, rijksregister, code, patient naam






$qry = "select logs.timestamp,
               concat(logins.naam,' ', logins.voornaam) as opzoeker,
               org.naam as organisatie,
               logs.rijksregister,
               patient.code,
               concat(patient.naam,' ', patient.voornaam) as patient,
               toestemming_zh
        from logs_ziekenhuis logs inner join logins on logs.login = logins.id
                                  inner join organisatie org on logins.organisatie = org.id
                                  left join patient on logs.rijksregister = patient.rijksregister
        where timestamp > $beginstamp and timestamp < $eindstamp
        order by logs.id desc
        ";


$result = mysql_query($qry) or die($qry . mysql_error());
$aantal = mysql_num_rows($result);


$csvOutput .= "{$sep}\n";
$csvOutput .= "datum{$sep}sorteerdatum{$sep}persoon{$sep}organisatie{$sep}rijksregister{$sep}code{$sep}patient naam{$sep}toestemming ziekenhuis\n";


for ($i=0; $i<$aantal;$i++) {
  $record = mysql_fetch_assoc($result);
  $datum = date("d/m/Y H:i.s", $record['timestamp']);
  $csvOutput .= "{$datum} {$sep}";

  $sorteerdatum = date("Y-m-d H:i.s", $record['timestamp']);
  $csvOutput .= "{$sorteerdatum} {$sep}";

  $csvOutput .= "{$record['opzoeker']} {$sep}";
  $csvOutput .= "{$record['organisatie']} {$sep}";
  $csvOutput .= "{$record['rijksregister']} {$sep}";
  if ($record['code']!="") {
    $csvOutput .= "{$record['code']} {$sep}";
    $csvOutput .= "{$record['patient']} {$sep}";
    if ($record['toestemming_zh']==-1) {
       $csvOutput .= "GEEN toestemming {$sep}";
    }
    else if ($record['toestemming_zh']==0) {
       $csvOutput .= "geen antwoord {$sep}";
    }
    else {
       $csvOutput .= "ok {$sep}";
    }
  }
  else {
    $csvOutput .= "Geen zorgplan {$sep}";
  }


  $csvOutput .= "\n";
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