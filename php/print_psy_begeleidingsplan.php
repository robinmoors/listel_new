<?php
session_start();

   require("../includes/dbconnect2.inc");

if (!isset($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan"))
{
  die("u hebt geen toegang tot deze pagina");
}



$mm = 595.28/210;
include('../ezpdf/class.ezpdf.php');

$persoon = getFirstRecord("select patient.*, gemeente.dlnaam, gemeente.dlzip, gemeente.deelvzw from patient inner join gemeente on gemeente.id = patient.gem_id and code = \"{$_SESSION['pat_code']}\"");
      foreach ($persoon as $key => $value) {
        $persoon[$key] = pdfaccenten($persoon[$key]);
      }
$overleg = getUniqueRecord("select * from overleg where id = {$_POST['id']}");
      foreach ($overleg as $key => $value) {
        $overleg[$key] = pdfaccenten($overleg[$key]);
      }


$pdf =& new Cezpdf('A4', 'landscape');
$pdf->selectFont('../ezpdf/fonts/Droid-Sans/DroidSans.afm');

  $deelvzw = $persoon['deelvzw'];
  $pdf->ezImage("../images/Sel{$deelvzw}.jpg", 30, 200, "none", "left");


  $pdf->ezSetY(210*$mm-16*$mm);
  $options = array('aleft'=>140*$mm,
                 'aright' => 297*$mm-12*$mm,
                 'justification' => 'left');
  $pdf->selectFont('../ezpdf/fonts/Droid-Sans/DroidSans-Bold.afm');
  $pdf->ezText("<b>BEGELEIDINGSPLAN</b>", 12, $options);
  $pdf->selectFont('../ezpdf/fonts/Droid-Sans/DroidSans.afm');
  $pdf->ezText("{$persoon['naam']} {$persoon['voornaam']}\n{$_SESSION['pat_code']}", 10, $options);
  $overlegDatum = mooieDatum($overleg['datum']);
  $pdf->ezText("Overleg van $overlegDatum", 10, $options);



  $options = array('aleft'=>12*$mm,
                 'aright' => 297*$mm-12*$mm,
                 'justification' => 'left');

    $qryCrisis ="select * from psy_crisis where overleg_id = {$_POST['id']} order by id desc";
    $crisisResult = mysql_query($qryCrisis) or die("kan het crisisplan van dit overleg niet ophalen");
    if (mysql_num_rows($crisisResult)>0) {
      $crisis = mysql_fetch_assoc($crisisResult);
      foreach ($crisis as $key => $value) {
        $crisis[$key] = pdfaccenten($crisis[$key]);
      }
    }



  if ($crisis['crisis_genre']=="referentie") {
    $crisis['crisis_genre'] = "hulp";
    $crisis['crisis_id'] = $overleg['contact_hvl'];
  }
//  if ($crisis['crisis_genre'] == "hulp") {
//    $qryCrisisContact="select * from hulpverleners where id = {$crisis['crisis_id']}";
//  }
//  else {
//    $qryCrisisContact="select * from mantelzorgers where id = {$crisis['crisis_id']}";
//  }
  $qryCrisisContact="select * from hulpverleners where id = {$overleg['contact_hvl']}";
  if ($crisisContactResult = mysql_query($qryCrisisContact)) {
    $crisisContact = mysql_fetch_assoc($crisisContactResult);
      foreach ($crisisContact as $key => $value) {
        $crisisContact[$key] = pdfaccenten($crisisContact[$key]);
      }
  }

  $pdf->ezSetY(210*$mm-60*$mm);
//  $pdf->ezText("Begeleidingsplan in te vullen door <b>{$crisisContact['naam']} {$crisisContact['voornaam']}</b>.", 12, $options);
  $pdf->ezText("Overzicht contactgegevens: zie crisisplan.\n\n", 12, $options);

  $pdf->selectFont('../ezpdf/fonts/Droid-Sans/DroidSans-Bold.afm');
  $pdf->ezText("Gegevens van belang voor verdere zorg- en hulpverlening.", 12, $options);
  $pdf->selectFont('../ezpdf/fonts/Droid-Sans/DroidSans.afm');

  // eerst effe kijken of er al een plan is voor dit overleg
  $qry = "select * from psy_plan where overleg_id = {$_POST['id']} order by id asc";
  $bestaatPlanAantal = mysql_query($qry) or die("we kunnen niet controleren of er al een plan bestaat voor deze patient");
  $bestaatPlan = mysql_num_rows($bestaatPlanAantal)>0;

  if ($overleg['psy_algemeen']!="" || $overleg['psy_doelstellingen']!="") {
    $tabel1[1]['0'] = pdfaccenten(str_replace("\r","",$overleg['psy_algemeen'])) . "\n\n";
    $tabelHeaders = array();
    $tabelHeaders['0']="niks";
    $tabelOptions = array();
    $tabelOptions["showHeadings"] = 0;
    $tabelOptions["width"] = 297*$mm-34*$mm;
    $pdf->ezTable($tabel1, $tabelHeaders, "", $tabelOptions);

    $pdf->selectFont('../ezpdf/fonts/Droid-Sans/DroidSans-Bold.afm');
    $pdf->ezText("\nAlgemene doelstellingen",12,$options);
    $pdf->selectFont('../ezpdf/fonts/Droid-Sans/DroidSans.afm');

    $tabel2[1]['0'] = pdfaccenten(str_replace("\r","",$overleg['psy_doelstellingen'])) . "\n\n";
    $pdf->ezTable($tabel2, $tabelHeaders, "", $tabelOptions);

  }
  else {
    $pdf->rectangle(12*$mm,210*$mm-95*$mm,297*$mm-24*$mm,-101*$mm);
    $pdf->ezSetY(210*$mm-91*$mm);
    $pdf->ezText("\n  <i>Vul in tijdens het overleg en neem over in het e-zorgplan</i>",9,$options);
    $pdf->ezSetY(210*$mm-196*$mm);

    $pdf->selectFont('../ezpdf/fonts/Droid-Sans/DroidSans-Bold.afm');
    $pdf->ezText("\nAlgemene doelstellingen",12,$options);
    $pdf->selectFont('../ezpdf/fonts/Droid-Sans/DroidSans.afm');
    $pdf->ezText("\n  -\n",12,$options);
    $pdf->ezText("\n  -\n",12,$options);
    $pdf->ezText("\n  -\n",12,$options);
    $pdf->ezText("\n  -\n",12,$options);
    $pdf->ezText("\n\n\n\n",12,$options);
  }


  $pdf->selectFont('../ezpdf/fonts/Droid-Sans/DroidSans-Bold.afm');
  $y = $pdf->ezText("\nGemaakte en/of te evalueren taakafspraken per episode van zorg",12,$options);
  $pdf->selectFont('../ezpdf/fonts/Droid-Sans/DroidSans.afm');
  $pdf->ezSetY($y-2*$mm);
  
  $domeinQuery = "select * from psy_domeinen where code = \"{$_SESSION['pat_code']}\" and datum <= {$overleg['datum']} order by datum desc, id desc";
  $domeinResult = mysql_query($domeinQuery) or die("kan de de domeinen op datum van $datum niet ophalen.");
  if (mysql_num_rows($domeinResult) == 0) {
    $domein2Query = "select domeinen from patient_psy where code = \"{$_SESSION['pat_code']}\"";
    $domein2Result = mysql_query($domein2Query) or die("kan de basisdomeinen van de patient niet ophalen.");
    $domein2 = mysql_fetch_assoc($domein2Result);
    if ($domein2['domeinen']==0) {
      $domeinen = Array();
    }
    else {
      $domeinQuery = "select * from psy_domeinen where id = {$domein2['domeinen']}";
      $domeinResult = mysql_query($domeinQuery) or die("kan de de domeinen op datum van $datum niet ophalen.");
      if (mysql_num_rows($domeinResult) == 0) {
        $domeinen = Array();
      }
      else {
        $domeinen = mysql_fetch_assoc($domeinResult);
      }
    }
  }
  else {
    $domeinen = mysql_fetch_assoc($domeinResult);
  }

  pdfBegeleidingsplanVolledig($_POST['id'],$_POST['afgerond']);

/*
    if ($_POST['tabel']=="huidige") {
      $tabel1 = (tabelCrisisPlan(getQueryHVLHuidig($_SESSION['pat_code'],-1),$crisis['crisis_id'],true));
      $tabel2 = (tabelCrisisPlan(getQueryMZHuidig($_SESSION['pat_code'],-1),0,false));
    }
    else {
      $tabel1 = (tabelCrisisPlan(getQueryHVLAfgerond($_POST['id'],-1),$crisis['crisis_id'],true));
      $tabel2 = (tabelCrisisPlan(getQueryMZAfgerond($_POST['id'],-1),0,false));
    }
*/

$pdf->ezStream();



      require("../includes/dbclose.inc");





//---------------------------------------------------------

/* //Geen Toegang */ require("../includes/check_access.inc");

//---------------------------------------------------------



//---------------------------------------------------------

/* Sluit Dbconnectie */ require("../includes/dbclose.inc");

//---------------------------------------------------------

?>