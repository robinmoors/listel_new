<?php

session_start();

   require("../includes/dbconnect2.inc");

if (!isset($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan"))
{
  die("u hebt geen toegang tot deze pagina");
}



$mm = 595.28/210;
include('../ezpdf/class.ezpdf.php');

$persoon = getFirstRecord("select patient.*, patient_psy.*, gemeente.dlzip, gemeente.dlnaam, gemeente.deelvzw from patient inner join gemeente on gemeente.id = patient.gem_id and patient.code = \"{$_SESSION['pat_code']}\"
                                                  inner join patient_psy on patient_psy.code = patient.code");
    foreach ($persoon as $key => $value) {
      $persoon[$key] = pdfaccenten($persoon[$key]);
    }


$overleg = getUniqueRecord("select * from overleg where id = {$_POST['id']}");
    foreach ($overleg as $key => $value) {
      $overleg[$key] = pdfaccenten($overleg[$key]);
    }

$pdf =& new Cezpdf('A4');
$pdf->selectFont('../ezpdf/fonts/Droid-Sans/DroidSans.afm');

  $deelvzw = $persoon['deelvzw'];
  $pdf->ezImage("../images/Sel{$deelvzw}.jpg", 30, 200, "none", "left");


  $pdf->ezSetY(297*$mm-16*$mm);
  $options = array('aleft'=>110*$mm,
                 'aright' => 595.28-12*$mm,
                 'justification' => 'left');
  $pdf->ezText("<u>BIJLAGE 1 (deel 1)</u> enkel opsturen bij opstart", 11, $options);
  $pdf->selectFont('../ezpdf/fonts/Droid-Sans/DroidSans-Bold.afm');
  $pdf->ezText("VERKLARING ORGANISATOR", 11, $options);
  $overlegDatum = mooieDatum($overleg['datum']);
  $pdf->ezText("op $overlegDatum", 11, $options);
  $pdf->selectFont('../ezpdf/fonts/Droid-Sans/DroidSans.afm');
  $pdf->ezText("{$persoon['naam']} {$persoon['voornaam']}\n{$_SESSION['pat_code']}", 11, $options);



  $options = array('aleft'=>12*$mm,
                 'aright' => 595.28-12*$mm,
                 'justification' => 'left');

  $options1 = array('aleft'=>24*$mm,
                 'aright' => 595.28-12*$mm,
                 'justification' => 'left');

  $pdf->ezSetY(297*$mm-60*$mm);
  $pdf->selectFont('../ezpdf/fonts/Droid-Sans/DroidSans-Bold.afm');
  $pdf->ezText("<u>Gegevens met betrekking tot de doelgroep</u>\n\n", 12, $options);
  $pdf->selectFont('../ezpdf/fonts/Droid-Sans/DroidSans.afm');

  $y = $pdf->ezText("   A)    <u>Nood aan een begeleidingsplan</u>\n", 10, $options);
  $pdf->ezSetY($y+2.3*$mm);
  if ($persoon['nood_begeleidingsplan']==1) {
    $pdf->ezImage("../images/checkbox_checked.jpg", 18, 11, "none", "left");
  }
  else {
    $pdf->ezImage("../images/checkbox_unchecked.jpg", 18, 11, "none", "left");
  }
  $pdf->ezSetY($y+3*$mm);
  
  $y = $pdf->ezText("Volgens minstens 3 betrokken zorg- en hulpverleners is een begeleidingsplan nodig waarbij de zorgen op elkaar worden afgestemd. Hierbij wordt verondersteld dat de minimale duurtijd van dit begeleidingsplan 12 maanden is. ", 10, $options1);
  
  $y = $pdf->ezText("\n   B)    <u>Voorafgaand contact geestelijke gezondheidszorg</u>\n", 10, $options);
  $pdf->ezSetY($y+2.3*$mm);
  $y = $pdf->ezText("De patiënt had voorafgaand contact met de geestelijke gezondheidszorg in het kader van de psychiatrische aandoening dat voldoet aan minstens één van de volgende voorwaarden", 10, $options1);
  $pdf->selectFont('../ezpdf/fonts/Droid-Sans/DroidSans-Bold.afm');
  $pdf->ezText("Uiterlijk één jaar geleden:\n", 10, $options1);
  $pdf->selectFont('../ezpdf/fonts/Droid-Sans/DroidSans.afm');
  
  pdfContactZiekenhuis($persoon);

  $y = $pdf->ezText("\n   C)    <u>Vaardigheden</u>\n", 10, $options);
  $pdf->ezSetY($y+2.3*$mm);
  $y = $pdf->ezText("ingevolge de psychiatrisch aandoening verlies heeft van bepaalde vaardigheden of slechts beschikt over beperkte vaardigheden in minstens drie van de volgende domeinen: basisautonomie, woonautonomie, autonomie binnen de gemeenschap, taal en communicatie, maatschappelijke aanpassing, werk, schoolse kennis, motoriek en/ of aangepast persoonlijk gedrag.", 10, $options1);

  $pdf->ezSetDy(-2.3*$mm);
  $pdf->ezImage("../images/checkbox_checked.jpg", 18, 11, "none", "left");

  $pdf->ezSetDy(10*$mm);
  $y = $pdf->ezText("ja", 10, $options1);

  $pdf->ezSetDy(-3*$mm);
  $pdf->ezImage("../images/checkbox_unchecked.jpg", 18, 11, "none", "left");

  $pdf->ezSetDy(10*$mm);
  $y = $pdf->ezText("nee", 10, $options1);

  $pdf->ezSetDy(-8*$mm);

  $pdf->ezText("<u>Organisator</u>", 10, $options);
  $pdf->ezSetDy(-3*$mm);

  $organisator = organisatorRecordVanOverleg($overleg);


  $pdf->ezText("Naam: {$organisator['loginnaam']}                                 Organisatie: {$organisator['orgnaam']}", 10, $options);
  $pdf->ezSetDy(-5*$mm);
  $pdf->ezText("Handtekening: . . . . . . . . . . . . . ", 10, $options);





$pdf->ezStream();



      require("../includes/dbclose.inc");





//---------------------------------------------------------

/* //Geen Toegang */ require("../includes/check_access.inc");

//---------------------------------------------------------



//---------------------------------------------------------

/* Sluit Dbconnectie */ require("../includes/dbclose.inc");

//---------------------------------------------------------

?>