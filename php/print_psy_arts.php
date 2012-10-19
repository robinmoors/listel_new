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
  $pdf->ezText("<u>BIJLAGE 2</u> enkel opsturen bij opstart", 11, $options);
  $pdf->selectFont('../ezpdf/fonts/Droid-Sans/DroidSans-Bold.afm');
  $overlegDatum = mooieDatum($overleg['datum']);
  $pdf->ezText("VERKLARING ARTS op $overlegDatum", 11, $options);
  $pdf->selectFont('../ezpdf/fonts/Droid-Sans/DroidSans.afm');
  $pdf->ezText("{$persoon['naam']} {$persoon['voornaam']}\n{$_SESSION['pat_code']}", 11, $options);



  $options = array('aleft'=>12*$mm,
                 'aright' => 595.28-12*$mm,
                 'justification' => 'left');

  $options1 = array('aleft'=>24*$mm,
                 'aright' => 595.28-12*$mm,
                 'justification' => 'left');
  $options2 = array('aleft'=>60*$mm,
                 'aright' => 595.28-12*$mm,
                 'justification' => 'left');

  $pdf->ezSetY(297*$mm-60*$mm);
  $pdf->ezText("Ik, ondergetekende, arts, . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . \n", 10, $options);
  $pdf->ezText("met RIZIV-nummer . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . \n", 10, $options);
  $pdf->ezText("verklaar hierbij voor patiënt {$persoon['naam']} {$persoon['voornaam']}\n", 10, $options);
  $y = $pdf->ezText("dat\n", 10, $options);

  $pdf->ezSetY($y+2.3*$mm);
  $pdf->ezImage("../images/checkbox_checked.jpg", 18, 11, "none", "left");
  $pdf->ezSetY($y+3*$mm);
  
  $hoofddiag = $persoon['hoofddiagnose'];
  if (strpos($hoofddiag,".")>0) {
    $hoofddiag = "DSM IV $hoofddiag";
  }
  else {
    $hoofddiag = "ICD X $hoofddiag";
  }
  $y = $pdf->ezText("er sprake is van comorbiditeit met\nhoofddiagnose $hoofddiag ", 10, $options1);
  $pdf->ezText("en ", 10, $options1);
  $y = $pdf->ezText("bijkomende diagnose(s) ", 10, $options1);

  $bijkomendQ = "select * from psy_comorbiditeit where patient = \"{$persoon['code']}\"";
  $bijkomendR = mysql_query($bijkomendQ) or die("kan de bijkomende diagnoses niet ophalen");
  for ($i=0; $i<mysql_num_rows($bijkomendR); $i++) {
    $bijkomend = mysql_fetch_assoc($bijkomendR);
    if (strpos($bijkomend['diagnose'],".")>0) {
      $y = $pdf->ezText("DSM IV {$bijkomend['diagnose']} ", 10, $options1);
    }
    else {
      $y = $pdf->ezText("ICD X {$bijkomend['diagnose']} ", 10, $options1);
    }
  }

  $pdf->ezSetY($y-10+2.3*$mm);
  $pdf->ezImage("../images/checkbox_checked.jpg", 18, 11, "none", "left");
  $pdf->ezSetY($y-10+3*$mm);

  $y = $pdf->ezText("de problematiek van (potentieel) herhalende aard is.", 10, $options1);

  $pdf->ezSetY($y-10+2.3*$mm);
  if ($persoon['toename_symptonen']==1) {
    $pdf->ezImage("../images/checkbox_checked.jpg", 18, 11, "none", "left");
  }
  else {
    $pdf->ezImage("../images/checkbox_unchecked.jpg", 18, 11, "none", "left");
  }
  $pdf->ezSetY($y-10+3*$mm);

  $y = $pdf->ezText("de intensiteit en/ of frequentie van symptomen is toegenomen.", 10, $options1);



  $pdf->ezSetDy(-10*$mm);
  $pdf->ezText("Datum:   .  .  /  .  .  /  .  .  .  .  .", 10, $options);
  $pdf->ezSetDy(-10*$mm);
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