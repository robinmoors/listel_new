<?php

session_start();

   require("../includes/dbconnect2.inc");

if (!isset($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan"))
{
  die("u hebt geen toegang tot deze pagina");
}



$mm = 595.28/210;
include('../ezpdf/class.ezpdf.php');

$persoon = getFirstRecord("select patient.*, gemeente.dlzip, gemeente.dlnaam, gemeente.deelvzw from patient inner join gemeente on gemeente.id = patient.gem_id and code = \"{$_SESSION['pat_code']}\"");
    foreach ($persoon as $key => $value) {
      $persoon[$key] = pdfaccenten($persoon[$key]);
    }
$overlegInfo = getFirstRecord("select contact_hvl from overleg where id = {$_POST['id']}");
    foreach ($overlegInfo as $key => $value) {
      $overlegInfo[$key] = pdfaccenten($overlegInfo[$key]);
    }


$pdf =& new Cezpdf('A4', 'landscape');
//$pdf->ezSetMargins(0,0,0,0);
//$pdf->selectFont('../ezpdf/fonts/Calibri-nieuw/Calibri.afm');
$pdf->selectFont('../ezpdf/fonts/Droid-Sans/DroidSans.afm');

//die("hee");
//  $pdf->ezImage("../images/logo_menos.png", 30, 100, "none", "left");
//  $pdf->ezSetY(297*$mm-50*$mm);

  $pdf->ezSetY(210*$mm-12*$mm);
  $options = array('aleft'=>12*$mm,
                 'aright' => 80*$mm,
                 'justification' => 'left');
  $pdf->ezText("CRISISPLAN\n\n", 14, $options);
  $pdf->ezText("Naam en voornaam: {$persoon['naam']} {$persoon['voornaam']}\nAdres: {$persoon['adres']}\n{$persoon['dlzip']} {$persoon['dlnaam']}", 10, $options);
  $gebDatum = mooieDatum($persoon['gebdatum']);
  $pdf->ezText("Geboortedatum: $gebDatum\nInschrijvingsnummer VI: {$persoon['mutnr']}", 10, $options);

    $qryCrisis ="select * from psy_crisis where overleg_id = {$_POST['id']} order by id desc";
    $crisisResult = mysql_query($qryCrisis) or die("kan het crisisplan van dit overleg niet ophalen");
    if (mysql_num_rows($crisisResult)>0) {
      $crisis = mysql_fetch_assoc($crisisResult);
      foreach ($crisis as $key => $value) {
        $crisis[$key] = pdfaccenten($crisis[$key]);
      }
    }


  $pdf->ezSetY(210*$mm-12*$mm);
  $options1 = array('aleft'=>90*$mm,
                 'aright' => 297*$mm-12*$mm,
                 'justification' => 'left');
  $pdf->ezText("<u>Ingeval van dringende opname :</u>\n\nContacteer de referentiepersoon en/of volgende hulpverlener: \n\n", 10, $options1);


  if ($crisis['crisis_genre']=="referentie") {
    $crisis['crisis_genre'] = "hulp";
    $crisis['crisis_id'] = $overlegInfo['contact_hvl'];
  }
  if ($crisis['crisis_genre'] == "hulp") {
    $qryCrisisContact="select * from hulpverleners where id = {$crisis['crisis_id']}";
  }
  else {
    $qryCrisisContact="select * from mantelzorgers where id = {$crisis['crisis_id']}";
  }
  if ($crisisContactResult = mysql_query($qryCrisisContact)) {
    $crisisContact = mysql_fetch_assoc($crisisContactResult);
    if ($crisis['crisis_genre'] == "hulp") {
      $crisisContact = vervolledigGegevensHVL($crisisContact);
    }
    if ($crisisContact['gsm']!="") {
      $telTekst="GSM: {$crisisContact['gsm']}\n";
    }
    if ($crisisContact['tel']!="") {
      $telTekst.="Tel: {$crisisContact['tel']}";
    }
  }
      foreach ($crisisContact as $key => $value) {
        $crisisContact[$key] = pdfaccenten($crisisContact[$key]);
      }


  $pdf->ezSetY(210*$mm-27*$mm);
  $pdf->ezText("Naam: {$crisisContact['naam']} {$crisisContact['voornaam']}", 10, $options1);
  $pdf->ezSetY(210*$mm-27*$mm);
  $options2 = array('aleft'=>160*$mm,
                 'aright' => 297*$mm-12*$mm,
                 'justification' => 'left');
  $pdf->ezText("$telTekst\n\n", 10, $options2);

  $pdf->ezText("<u>Gegevens van belang indien crisissituatie</u>", 10, $options1);
  $pdf->ezText(pdfaccenten(str_replace("\r","",$crisis['crisissituatie'])), 10, $options1);

  $pdf->rectangle(88*$mm,210*$mm-12*$mm,297*$mm-98*$mm,-70*$mm);



  $pdf->ezSetY(210*$mm-89*$mm);
  $pdf->ezText("<b>Zorg- en hulpverleners</b>\n", 12, $options);



    if ($_POST['tabel']=="huidige") {
      $tabel1 = (tabelCrisisPlan(getQueryHVLHuidig($_SESSION['pat_code'],-1),$overlegInfo['contact_hvl'],true));
      $tabel2 = (tabelCrisisPlan(getQueryMZHuidig($_SESSION['pat_code'],-1),0,false));
    }
    else {
      $tabel1 = (tabelCrisisPlan(getQueryHVLAfgerond($_POST['id'],-1),$overlegInfo['contact_hvl'],true));
      $tabel2 = (tabelCrisisPlan(getQueryMZAfgerond($_POST['id'],-1),0,false));
    }

  $pdf->ezTable($tabel1);
  if (isset ($tabel2[0])) {
    $pdf->ezText("\n<b>Mantelzorger(s)</b>\n", 12, $options);
    $pdf->ezTable($tabel2);
  }

$pdf->ezStream();



      require("../includes/dbclose.inc");





//---------------------------------------------------------

/* //Geen Toegang */ require("../includes/check_access.inc");

//---------------------------------------------------------



//---------------------------------------------------------

/* Sluit Dbconnectie */ require("../includes/dbclose.inc");

//---------------------------------------------------------

?>