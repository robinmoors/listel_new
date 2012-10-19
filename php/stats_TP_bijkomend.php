<?php
ob_start();
session_start();


   require("../includes/clearSessie.inc");
   require("../includes/dbconnect2.inc");
   if (IsSet($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan"))
      {

$bestandsnaam = "stats_TP_bijkomende_vragen";


$begindatum = "{$_GET['beginjaar']}{$_GET['beginmaand']}{$_GET['begindag']}";
$einddatum = "{$_GET['eindjaar']}{$_GET['eindmaand']}{$_GET['einddag']}";

if ($begindatum == "") $begindatum = "18999999";
if ($einddatum == "") $einddatum = "20999999";

$beginMooi = "{$_GET['begindag']}/{$_GET['beginmaand']}/{$_GET['beginjaar']}";
$eindMooi = "{$_GET['einddag']}/{$_GET['eindmaand']}/{$_GET['eindjaar']}";

$beginDate = "{$_GET['beginjaar']}-{$_GET['beginmaand']}-{$_GET['begindag']}";
$eindDate = "{$_GET['eindjaar']}-{$_GET['eindmaand']}-{$_GET['einddag']}";

$mm = 595.28/210;


include('../ezpdf/class.ezpdf.php');

$pdf =& new Cezpdf('A4', 'portrait');
//$pdf->ezSetMargins(0,0,0,0);
$pdf->selectFont('../ezpdf/fonts/Times-Roman.afm');


   $options = array('aleft'=>35*$mm,
                 'aright' => 210*$mm-35*$mm,
                 'justification' => 'left');
   $options2 = array('aleft'=>55*$mm,
                 'aright' => 210*$mm-35*$mm,
                 'justification' => 'left');

function toonVraag($tpvraag, $nr) {
   global $pdf, $options, $options2, $beginMooi, $eindMooi,$mm, $beginDate, $eindDate;

   $pdf->ezText("\n\n\nVraag $nr: <b>{$tpvraag['vraag']}</b>\n\n",11,$options);

   $queryOpties = "select tp_antwoorden.antwoord, count(patient_tp.id) as aantal from tp_antwoorden, patient_tpvragen, patient_tp
                   where tp_antwoorden.tp = {$_SESSION['tp_project']}
                     and tp_antwoorden.vraag = {$tpvraag['nr']}
                     and tp_antwoorden.vraag = patient_tpvragen.vraag
                     and tp_antwoorden.optie = patient_tpvragen.antwoord
                     and patient_tpvragen.tp = tp_antwoorden.tp
                     and patient_tpvragen.patient = patient_tp.patient
                     and patient_tp.begindatum >= '$beginDate'  and (patient_tp.einddatum <= '$eindDate' or patient_tp.einddatum is NULL)
                     and not (patient_tp.einddatum is NULL and patient_tp.actief = 0)
                   group by tp_antwoorden.antwoord";

   //$pdf->ezText("<b>$queryOpties</b>\n\n",11,$options);

   $resultOpties = mysql_query($queryOpties);
   for ($i=0;$i<mysql_num_rows($resultOpties);$i++) {
     $optie = mysql_fetch_assoc($resultOpties);
     foreach ($optie as $key => $value) {
       $optie[$key] = utf8_decode($optie[$key]);
     }
     $tabel[$i]['Antwoord'] = $optie['antwoord'];
     $tabel[$i]['Aantal'] = $optie['aantal'];
   }
   
   $pdf->ezTable($tabel);
}


function toonX($tp) {
   global $pdf, $beginDate, $eindDate, $begindatum, $einddatum;
   $query = "";
   $pdf .= "\n\n\n********  *********\n\n";
   $query = "select
             from patient_tp
             where project = {$tp['id']}
               and patient_tp.begindatum >= '$beginDate'  and (patient_tp.einddatum <= '$eindDate' or patient_tp.einddatum is NULL)
               and not (patient_tp.einddatum is NULL and patient_tp.actief = 0)
   ";
   toonQueryResult($query);
}

function toonQueryResult($query) {
  global $pdf, $sep;
  $result=mysql_query($query) or die(mysql_error() . "<br /> $query");

  $aantalKolommen = mysql_num_fields($result);
  for ($i = 0; $i < $aantalKolommen; $i++) {
    $field = mysql_fetch_field($result);
    $kolom[$i] = utf8_decode($field->name);
    $pdf .= '"'. $kolom[$i] . "\"$sep";
  }
  $pdf .= "\n";


  for ($i=0; $i < mysql_num_rows($result); $i++) {
    $rij = mysql_fetch_array($result);
    for ($j = 0; $j < $aantalKolommen; $j++) {
      $pdf .= '"' . $rij[$kolom[$j]] . "\"$sep";
    }
    $pdf .="\n";
  }
}


if ($_SESSION['profiel']=="OC" || $_SESSION['profiel']=="listel") {
  die("Gij hebt hier niks te zoeken manneke");
}
else {
  $tpRecord = tp_record($_SESSION['tp_project']);

   $pdf->ezSetY(297*$mm-15*$mm);
  $pdf->ezText("Statistiek over de bijkomende vragen van TP-{$tpRecord['nummer']}", 14, $options);
  
  $qryTP = "select * from tp_vragen
             where tp = {$_SESSION['tp_project']}";
  $resultTP = mysql_query($qryTP);
  for ($i=0;$i<mysql_num_rows($resultTP);$i++) {
    $tpvraag = mysql_fetch_assoc($resultTP);
    foreach ($tpvraag as $key => $value) {
      $tpvraag[$key] = utf8_decode($tpvraag[$key]);
    }
    toonVraag($tpvraag, $i);
  }
}


$pdf->ezStream();
require("../includes/dbclose.inc");

      }

//---------------------------------------------------------
/* Geen Toegang */ require("../includes/check_access.inc");
//---------------------------------------------------------
?>