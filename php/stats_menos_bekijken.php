<?php

ob_start();
session_start();

   require("../includes/clearSessie.inc");
   require("../includes/dbconnect2.inc");
   if (IsSet($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan"))
      {

if ($_POST['beginjaar']<100) $_POST['beginjaar']="20".$_POST['beginjaar'];
if ($_POST['eindjaar']<100) $_POST['eindjaar']="20".$_POST['eindjaar'];
if ($_POST['sep']==",")
  $sep = ",";
else
  $sep = ";";

$bestandsnaam = "Statistieken_Menos_LISTEL";


$begindatum = "{$_POST['beginjaar']}{$_POST['beginmaand']}{$_POST['begindag']}";
$einddatum = "{$_POST['eindjaar']}{$_POST['eindmaand']}{$_POST['einddag']}";

if ($begindatum == "") $begindatum = "18999999";
if ($einddatum == "") $einddatum = "20999999";

$begindatum_ = "{$_POST['beginjaar']}-{$_POST['beginmaand']}-{$_POST['begindag']}";
$einddatum_ = "{$_POST['eindjaar']}-{$_POST['eindmaand']}-{$_POST['einddag']}";

if ($begindatum_ == "--") $begindatum = "1899-99-99";
if ($einddatum_ == "--") $einddatum = "2099-99-99";

  $csvOutput = "Statistieken Menos van {$_POST['begindag']}/{$_POST['beginmaand']}/{$_POST['beginjaar']} tot {$_POST['einddag']}/{$_POST['eindmaand']}/{$_POST['eindjaar']}\n\n";

$qry = "select count(patient) as aantal,
               sum(complexe_verzorging=1) as complex,
               sum(katz = 'A') as katzA,
               sum(katz = 'B') as katzB,
               sum(katz = 'C') as katzC,
               sum(diagnose_dementie=1) as dementie,
               sum(edmonton_schaal > 0) as edmonton,
               sum(informed_consent = 1) as informed,
               sum(informed_consent = 0) as niet_informed
        from patient_menos
        where begindatum <= '$einddatum_' and (einddatum is null or einddatum >= '$begindatum_')
        ";

$basis = getFirstRecord($qry);

  $csvOutput .= "\n\nAantallen m.i.v. uitzondering en patienten zonder informed consent.\n\n";
  $csvOutput .= "Totaal aantal{$sep}{$basis['aantal']}\n";
  $csvOutput .= "Complexe verzorging{$sep}{$basis['complex']}\n";
  $csvOutput .= "Katz A{$sep}{$basis['katzA']}\n";
  $csvOutput .= "Katz B{$sep}{$basis['katzB']}\n";
  $csvOutput .= "Katz C{$sep}{$basis['katzC']}\n";
  $csvOutput .= "Diagnose dementie{$sep}{$basis['dementie']}\n";
  $csvOutput .= "Edmonton schaal{$sep}{$basis['edmonton']}\n";
  $csvOutput .= "Met informed consent{$sep}{$basis['informed']}\n";
  $csvOutput .= "Zonder informed consent{$sep}{$basis['niet_informed']}\n";

$qry = "select count(patient) as aantal,
               sum(complexe_verzorging=1) as complex,
               sum(katz = 'A') as katzA,
               sum(katz = 'B') as katzB,
               sum(katz = 'C') as katzC,
               sum(diagnose_dementie=1) as dementie,
               sum(edmonton_schaal > 0) as edmonton,
               sum(informed_consent = 1) as informed,
               sum(informed_consent = 0) as niet_informed
        from patient_menos
        where begindatum <= '$einddatum_' and (einddatum is null or einddatum >= '$begindatum_')
        and uitzondering = 0 and informed_consent = 1
        ";

$basis = getFirstRecord($qry);

  $csvOutput .= "\n\nAantallen. Enkel volledig conform de norm en MET informed consent.\n\n";
  $csvOutput .= "Totaal aantal{$sep}{$basis['aantal']}\n";
  $csvOutput .= "Complexe verzorging{$sep}{$basis['complex']}\n";
  $csvOutput .= "Katz A{$sep}{$basis['katzA']}\n";
  $csvOutput .= "Katz B{$sep}{$basis['katzB']}\n";
  $csvOutput .= "Katz C{$sep}{$basis['katzC']}\n";
  $csvOutput .= "Diagnose dementie{$sep}{$basis['dementie']}\n";
  $csvOutput .= "Edmonton schaal{$sep}{$basis['edmonton']}\n";
  $csvOutput .= "Met informed consent{$sep}{$basis['informed']}\n";
  $csvOutput .= "Zonder informed consent{$sep}{$basis['niet_informed']}\n";


$qry = "select concat(patient.naam, ' ', patient.voornaam) as patientnaam,
               concat(hvl.naam, ' ', hvl.voornaam) as hvl, org.naam as organisatie,
               gemeente.naam as gemeente,
               gemeente.dlnaam as dlnaam,
               mi.*
        from patient_menos pm inner join patient on pm.patient = code
                              inner join gemeente on gemeente.id = patient.gem_id
                              inner join menos_interventie mi on pm.patient = mi.patient
                              inner join hulpverleners hvl on mi.uitvoerder_id = hvl.id and mi.genre = 'hulp'
                              inner join organisatie org on hvl.organisatie = org.id
        where pm.begindatum <= '$einddatum_' and (pm.einddatum is null or pm.einddatum >= '$begindatum_')
        and mi.datum >= $begindatum and mi.datum <= $einddatum
        and uitzondering = 0 and informed_consent = 1
        order by org.id, hvl.naam, hvl.voornaam";

  $csvOutput .= "\n\nInterventies per organisatie en per client. Enkel volledig conform de norm en MET informed consent.\n\n";

$result = mysql_query($qry) or die($qry . mysql_error());

$org = "niks";

for ($i=0; $i<mysql_num_rows($result);$i++) {
  $rij = mysql_fetch_assoc($result);
  if ($rij['organisatie']!= $org) {
    $org = $rij['organisatie'];
    $csvOutput .= "\n\nOrganisatie: $org\n";
    $csvOutput .= "Naam client (=geincludeerde oudere){$sep}woonplaats{$sep}datum{$sep}aard prestatie{$sep}aantal uren{$sep}uitvoerder\n";
  }

  $mooieDatum = substr($rij['datum'],6,2) . "/" . substr($rij['datum'],4,2) . "/" . substr($rij['datum'],0,4);
  if ($rij['gemeente']==$rij['dlnaam']) {
    $woonplaats = $rij['gemeente'];
  }
  else {
    $woonplaats = "{$rij['gemeente']} ({$rij['dlnaam']})";
  }
  if ($rij['subvorm']=="") {
    $vorm = $rij['vorm'];
  }
  else {
    $vorm = "{$rij['vorm']} ({$rij['subvorm']})";
  }

  $csvOutput .= "{$rij['patientnaam']} ({$rij['patient']}){$sep}{$woonplaats}{$sep}{$mooieDatum}{$sep}{$vorm}{$sep}{$rij['uren']}{$sep}{$rij['hvl']}{$sep}\n";
  
}

/*
  $aantalKolommen = mysql_num_fields($result);

  for ($i = 0; $i < $aantalKolommen; $i++) {

    $field = mysql_fetch_field($result);

    $kolom[$i] = $field->name;

    $csvOutput .= '"'. $kolom[$i] . "\"$sep";

  }


  $csvOutput .= "\n";
*/




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