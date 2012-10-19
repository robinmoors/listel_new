<?php

ob_start();

session_start();



   require("../includes/clearSessie.inc");

   require("../includes/dbconnect2.inc");

   if (IsSet($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan"))

      {





if ($_POST['sep']==",")

  $sep = ",";

else

  $sep = ";";













$begindatum = "{$_GET['beginjaar']}{$_GET['beginmaand']}{$_GET['begindag']}";

$einddatum = "{$_GET['eindjaar']}{$_GET['eindmaand']}{$_GET['einddag']}";



$begin = "{$_GET['begindag']}/{$_GET['beginmaand']}/{$_GET['beginjaar']}";

$eind = "{$_GET['einddag']}/{$_GET['eindmaand']}/{$_GET['eindjaar']}";

switch ($_GET['beginjaar']) {
  case 2008:
    $getal = "tweede";
    $aantalTrimesters = 8;
    $kolommen = "2e trim 2008{$sep}3e trim 2008{$sep}4e trim 2008{$sep}1e trim 2009{$sep}";
    break;
  case 2009:
    $getal = "derde";
    $aantalTrimesters = 12;
    $kolommen = "2e trim 2008{$sep}3e trim 2008{$sep}4e trim 2008{$sep}1e trim 2009{$sep}";
    $kolommen .= "2e trim 2009{$sep}3e trim 2009{$sep}4e trim 2009{$sep}1e trim 2010{$sep}";
    break;
  case 2010:
    $getal = "vierde";
    $aantalTrimesters = 16;
    $kolommen = "2e trim 2008{$sep}3e trim 2008{$sep}4e trim 2008{$sep}1e trim 2009{$sep}";
    $kolommen .= "2e trim 2009{$sep}3e trim 2009{$sep}4e trim 2009{$sep}1e trim 2010{$sep}";
    $kolommen .= "2e trim 2010{$sep}3e trim 2010{$sep}4e trim 2010{$sep}1e trim 2011{$sep}";
    break;
  case 2011:
    $getal = "vijfde";
    $aantalTrimesters = 20;
    $kolommen = "2e trim 2008{$sep}3e trim 2008{$sep}4e trim 2008{$sep}1e trim 2009{$sep}";
    $kolommen .= "2e trim 2009{$sep}3e trim 2009{$sep}4e trim 2009{$sep}1e trim 2010{$sep}";
    $kolommen .= "2e trim 2010{$sep}3e trim 2010{$sep}4e trim 2010{$sep}1e trim 2011{$sep}";
    $kolommen .= "2e trim 2011{$sep}3e trim 2011{$sep}4e trim 2011{$sep}1e trim 2012{$sep}";
    break;
}



$csvOutput = "{$sep}{$sep}Verslag aan het Riziv mbt het aantal ten laste genomen patiënten\n";

$csvOutput .= "{$sep}{$sep}{$sep}{$sep}in het $getal werkingsjaar\n";



if ($_SESSION['profiel']=="OC") {

  die("Gij hebt hier niks te zoeken manneke");

}

else {

  $tprecord = tp_record($_SESSION['tp_project']);

}



function aantalPatientenMetZoveelOverleggen($begindatum, $einddatum, $aantal, $project) {

    if ($einddatum== "") {

      $qry = "select patient_code, count(datum) from patient_tp left join overleg on patient = patient_code and datum >= $begindatum and genre = 'TP'



              where (einddatum >= concat(substring($begindatum, 1, 4), '-', substring($begindatum, 5, 2) , '-', substring($begindatum, 7, 2)) or einddatum is null)

              and project = $project

              group by patient

              having count(datum) = $aantal";

    }

    else {

      $qry = "select patient_code, count(datum) from patient_tp left join overleg on patient = patient_code and datum >= $begindatum and datum < $einddatum and genre = 'TP'



              where begindatum <= concat(substring($einddatum, 1, 4), '-', substring($einddatum, 5, 2) , '-', substring($einddatum, 7, 2))

              and (einddatum >= concat(substring($begindatum, 1, 4), '-', substring($begindatum, 5, 2) , '-', substring($begindatum, 7, 2)) or einddatum is null)

              and project = $project

              group by patient

              having count(datum) = $aantal";

    }



    $aantalResult = mysql_query($qry) or die("foutje in $qry");

    return mysql_num_rows($aantalResult);

}



function printKolom($code, $begin, $einde, $begindatum, $einddatum) {

    $uitvoer = "";

    if ($einddatum== "") {

      $qry = "select keuze_vergoeding, factuur_code, datum from overleg where genre= 'TP' and patient_code = '$code'

              and datum >= $begin and datum >= $begindatum

              and datum < $einde";

    }

    else {

      $qry = "select keuze_vergoeding, factuur_code, datum from overleg where genre= 'TP' and patient_code = '$code'

              and datum >= $begin and datum >= $begindatum

              and datum <= $einddatum and datum < $einde";

    }



    $overleggen = mysql_query($qry) or die("foutje in $qry");

    for ($i=0; $i < mysql_num_rows($overleggen); $i++) {

      $overleg = mysql_fetch_assoc($overleggen);

      foreach ($overleg as $key => $value) {

        $overleg[$key] = utf8_decode($overleg[$key]);

      }

      if ($overleg['keuze_vergoeding']==1) {

        if ($overleg['factuur_code'] > 0) {

          $uitvoer .= "x";

        }

        else {

          $uitvoer .= "x";

        }

      }

      else {

        $uitvoer .= "x";

      }

    }

    return $uitvoer;

}



$csvOutput .= "\n{$sep}Algemene inlichtingen{$sep}\n";

$csvOutput .= "{$sep}Projectnummer:{$sep}{$tprecord['nummer']}\n";



$loginNaam = getFirstRecord("select * from logins where profiel = 'hoofdproject' and tp_project = {$tprecord['id']} and login not like '%help%' and actief=1");



$csvOutput .= "{$sep}Administratieve coördinator:{$sep}GDT LISTEL vzw\n";

$csvOutput .= "{$sep}Naam contactpersoon:{$sep}{$loginNaam['naam']} {$loginNaam['voornaam']}\n";

if ($loginNaam['tel'] == "")

  $csvOutput .= "{$sep}Telefoonnummer:{$sep}{$loginNaam['gsm']}\n\n\n";

else

  $csvOutput .= "{$sep}Telefoonnummer:{$sep}{$loginNaam['tel']}\n\n\n";



$queryP= "select patient.code, patient.naam, patient.voornaam, patient_tp.begindatum, patient_tp.einddatum from patient, patient_tp where code = patient

           and project = {$tprecord['id']}

           order by patient_tp.begindatum";

           

$result=mysql_query($queryP) or die(mysql_error() . "<br /> $queryP");



$csvOutput .= "\n\n{$sep} Overleg rond de patiënt (1)\n";



$csvOutput .="ter info {$sep}initialen patiënt{$sep}2e trim 2007{$sep}3e trim 2007{$sep}4e trim 2007{$sep}1e trim 2008{$sep}";


$csvOutput .= "$kolommen datum uit project\n";
$csvOutput .= "(schrap de eerste kolom vooraleer door te sturen!!)\n";



$aantalRecords = mysql_num_rows($result);

for ($iii=0; $iii < $aantalRecords ; $iii++) {

  $rij = mysql_fetch_assoc($result);

  foreach ($rij as $key => $value) {

    $rij[$key] = utf8_decode($rij[$key]);

  }

  $projectbegin = substr($rij['begindatum'], 0, 4) . substr($rij['begindatum'], 5, 2) . substr($rij['begindatum'], 8, 2);

  $projecteinde = substr($rij['einddatum'], 0, 4) . substr($rij['einddatum'], 5, 2) . substr($rij['einddatum'], 8, 2);





  $csvOutput .= '"' . $rij['code'] . " ({$rij['naam']} {$rij['voornaam']}) \"" . $sep . '"' . initiaal($rij['voornaam'], $rij['naam']) . "\"";



  $eersteOverlegAlGehad = false;

  

$jaar = 2007;
for ($trim = 0; $trim <  $aantalTrimesters; $trim++) {
   switch ($trim%4) {
     case 0:
       $beginTrimester = "{$jaar}0401";
       $eindeTrimester =  "{$jaar}0701";
       break;
     case 1:
       $beginTrimester = "{$jaar}0701";
       $eindeTrimester =  "{$jaar}1001";
       break;
     case 2:
       $beginTrimester = "{$jaar}1001";
       $jaar++;
       $eindeTrimester =  "{$jaar}0101";
       break;
     case 3:
       $beginTrimester = "{$jaar}0101";
       $eindeTrimester =  "{$jaar}0401";
       break;
   }

  $dezeKolom = printKolom($rij['code'], "$beginTrimester", "$eindeTrimester", $projectbegin, $projecteinde);
  if ((!$eersteOverlegAlGehad) && (strlen($dezeKolom) > 0)) {
    $csvOutput .=  "$sep" . mooieDatum($projectbegin);
    $eersteOverlegAlGehad = true;
  }
  else
    $csvOutput .=  "$sep" . $dezeKolom;
}


  $csvOutput .= "$sep" . '"' . $rij['einddatum'] . "\"";
  //$csvOutput .= '"' . $rij['begindatum'] . "\"$sep";
  $csvOutput .= "\n";

}



$csvOutput .="\n";
$csvOutput .="\n";
$csvOutput .="\n";
$csvOutput .="\n";



$csvOutput .="\nKalendertrimester{$sep}0{$sep}1{$sep}2{$sep}3{$sep}Aantal patiënten\n";



function printAantallen($begindatum, $einddatum, $project){

  global $csvOutput, $sep;

  $totaal = 0;



  $ditTrimester = aantalPatientenMetZoveelOverleggen($begindatum, $einddatum, 0, $project);

  $csvOutput .= $ditTrimester . $sep;

  $totaal += $ditTrimester;

  

  $ditTrimester = aantalPatientenMetZoveelOverleggen($begindatum, $einddatum, 1, $project);

  $csvOutput .= $ditTrimester . $sep;

  $totaal += $ditTrimester;



  $ditTrimester = aantalPatientenMetZoveelOverleggen($begindatum, $einddatum, 2, $project);

  $csvOutput .= $ditTrimester . $sep;

  $totaal += $ditTrimester;



  $ditTrimester = aantalPatientenMetZoveelOverleggen($begindatum, $einddatum, 3, $project);

  $csvOutput .= $ditTrimester . $sep;

  $totaal += $ditTrimester;



  $csvOutput .= $totaal . "\n";

}




$beginjaar = $_GET['beginjaar'];

$csvOutput .= "2e trim $beginjaar (april-juni)$sep";

printAantallen("{$beginjaar}0401", "{$beginjaar}0701", $tprecord['id']);



$csvOutput .= "3e trim $beginjaar (juli-september)$sep";

printAantallen("{$beginjaar}0701", "{$beginjaar}1001", $tprecord['id']);



$csvOutput .= "4e trim $beginjaar (oktober-december)$sep";

printAantallen("{$beginjaar}1001", ($beginjaar+1) . "0101", $tprecord['id']);


$beginjaar++;

$csvOutput .= "1e trim $beginjaar (januari-maart)$sep";

printAantallen("{$beginjaar}0101", "{$beginjaar}0401", $tprecord['id']);







header("Content-Type: text/csv");

header("Cache-Control: must-revalidate, post-check=0,pre-check=0");

header("Content-Transfer-Encoding: binary");

header("Content-Disposition: attachment; filename=\"TP_tabel.csv\"");

header("Content-length: " . strlen($csvOutput));



print($csvOutput);

require("../includes/dbclose.inc");



      }

?>