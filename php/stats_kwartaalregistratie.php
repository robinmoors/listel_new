<?php

ob_start();

session_start();





   require("../includes/clearSessie.inc");

   require("../includes/dbconnect2.inc");

   if (IsSet($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan"))

      {



$bestandsnaam = "kwartaalregistratie";



if ($_POST['beginjaar']<100) $_POST['beginjaar']="20".$_POST['beginjaar'];

if ($_POST['eindjaar']<100) $_POST['eindjaar']="20".$_POST['eindjaar'];

if ($_POST['sep']==",")

  $sep = ",";

else

  $sep = ";";





$begindatum = "{$_POST['beginjaar']}{$_POST['beginmaand']}{$_POST['begindag']}";

$einddatum = "{$_POST['eindjaar']}{$_POST['eindmaand']}{$_POST['einddag']}";



if ($begindatum == "") $begindatum = "18999999";

if ($einddatum == "") $einddatum = "20999999";








// was vroeger allemaal left join, maar dat is veel te traag!
  $query = "select gemeente.naam as gemeente, sum(afgerond=1) as aantal_overleg,

                    sum(keuze_vergoeding = 1 and afgerond=1) as aantal_volledige_vergoeding,
                    sum(keuze_vergoeding = 2 and afgerond=1) as aantal_organisatie_vergoeding,

                    sum((keuze_vergoeding < 1 or keuze_vergoeding > 2) and afgerond=1) as aantal_zonder

            from gemeente inner join patient on patient.gem_id = gemeente.id inner join overleg on

               (patient.code = overleg.patient_code and overleg.datum >= $begindatum and overleg.datum <= $einddatum)

            where gemeente.sit_id > -1 and (overleg.genre is NULL or overleg.genre = 'gewoon')

               group by gemeente.naam order by gemeente.naam";





$begin = "{$_POST['begindag']}/{$_POST['beginmaand']}/{$_POST['beginjaar']}";

$eind = "{$_POST['einddag']}/{$_POST['eindmaand']}/{$_POST['eindjaar']}";

$csvOutput = "Samenvattende staat van de overleggen van GDT LISTEL vzw : $begin tot $eind\n\n";





$result=mysql_query($query) or die(mysql_error() . "<br /> $query");





$csvOutput .= "\n\ngemeente $sep Met zorgplan $sep VOLLEDIGE RIZIV facturatie MVO$sep Organisatievergoeding MVO met RIZIV facturatie $sep MO zonder RIZV facturatie\n";

$kolom = Array("gemeente", "aantal_overleg", "aantal_volledige_vergoeding", "aantal_organisatie_vergoeding", "aantal_zonder");





for ($i=0; $i < mysql_num_rows($result); $i++) {

  $rij = mysql_fetch_assoc($result);

  foreach ($rij as $key => $value) {

    $rij[$key] = utf8_decode($rij[$key]);

  }

  for ($j = 0; $j < 5; $j++) {

    if ($rij[$kolom[$j]]=="") $rij[$kolom[$j]] = 0;

    $csvOutput .= '"' . $rij[$kolom[$j]] . "\"$sep";

  }

  $csvOutput .="\n";

}

if ($_POST['opsomming']==1) {

  $csvOutput .= "\n\n\nEN NU NOG EENS DE OPSOMMING VAN DE OVERLEGGEN\n";
  

  $query = "select gemeente.naam as gemeente, patient.naam, patient.voornaam, overleg.patient_code, datum, keuze_vergoeding, geld_voor_hvl
            from gemeente inner join patient on patient.gem_id = gemeente.id inner join overleg on
               (patient.code = overleg.patient_code and overleg.datum >= $begindatum and overleg.datum <= $einddatum)
            where gemeente.sit_id > -1 and (overleg.genre is NULL or overleg.genre = 'gewoon')
               order by gemeente.naam, patient_code";

  $csvOutput .= "Keuze_vergoeding heeft volgende mogelijkheden:\n";
  $csvOutput .= "{$sep}-88: geen keuze moeten maken, want niet vergoedbaar \n";
  $csvOutput .= "{$sep}-1: vergoeding geweigerd \n";
  $csvOutput .= "{$sep}1: deelnemers \n";
  $csvOutput .= "{$sep}2: organisatie \n";


  $csvOutput .= "\n\ngemeente $sep naam $sep voornaam $sep code $sep datum $sep keuze_vergoeding $sep geld_voor_hvl\n";
  $kolom = Array("gemeente", "patient_code", "naam", "voornaam", "datum", "keuze_vergoeding", "geld_voor_hvl");

  $result=mysql_query($query) or die(mysql_error() . "<br /> $query");
  for ($i=0; $i < mysql_num_rows($result); $i++) {
    $rij = mysql_fetch_assoc($result);
    foreach ($rij as $key => $value) {
      $rij[$key] = utf8_decode($rij[$key]);
    }
    for ($j = 0; $j < 7; $j++) {
      if ($rij[$kolom[$j]]=="") $rij[$kolom[$j]] = 0;
        $csvOutput .= '"' . $rij[$kolom[$j]] . "\"$sep";
    }
    $csvOutput .="\n";
  }
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