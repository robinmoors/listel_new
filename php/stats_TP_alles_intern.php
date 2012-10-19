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













$csvOutput = "{$sep}Volledig intern overzicht\n";



if ($_SESSION['profiel']=="OC") {

  die("Gij hebt hier niks te zoeken manneke");

}

else {

  $tprecord = tp_record($_SESSION['tp_project']);

}



function printKolom($code, $begindatum, $einddatum) {

   global $sep;

    $uitvoer = "";

    $uitvoerAlles = "";

    if ($einddatum == "")
      $qry = "select datum, keuze_vergoeding, factuur_code from overleg where genre= 'TP' and patient_code = '$code'
              AND  datum >= replace('$begindatum', '-', '')
      order by datum ";
    else
      $qry = "select datum, keuze_vergoeding, factuur_code from overleg where genre= 'TP' and patient_code = '$code'
           AND     datum >= replace('$begindatum', '-', '')
           AND datum <= replace('$einddatum', '-', '')
      order by datum ";

    

    $vorigeMaand = -1;

    $aantal=0;

    

    $overleggen = mysql_query($qry) or die("foutje in $qry");

    for ($i=0; $i < mysql_num_rows($overleggen); $i++) {

      $overleg = mysql_fetch_assoc($overleggen);

      foreach ($overleg as $key => $value) {

        $overleg[$key] = utf8_decode($overleg[$key]);

      }

      if ($overleg['keuze_vergoeding']==1) {

        if ($overleg['factuur_code'] > 0) {

          $ditoverleg = mooieDatum($overleg['datum']) . "F";

        }

        else {

          $ditoverleg = mooieDatum($overleg['datum']) . "f";

        }

      }

      else {

        $ditoverleg = mooieDatum($overleg['datum']) . "n";

      }



      

      $maand = substr($overleg['datum'],4,2);

      if (trimesterNummer($maand) == trimesterNummer($vorigeMaand)) {

        // zelfde trimester

        $uitvoer .= "+$ditoverleg";

        $aantal++;

      }

      else {

        if (strlen($uitvoer)>1) $uitvoerAlles .= $aantal . ":" . $uitvoer .  $sep;

        $uitvoer= $ditoverleg;

        $aantal= 1;

        $vorigeMaand = $maand;

      }

    }

    if ($aantal > 0) $uitvoerAlles .= $aantal . ":" . $uitvoer .  $sep;



    return $uitvoerAlles;

}



function trimesterNummer($maand) {

   switch ($maand) {

     case 1:

     case 2:

     case 3:

        return 1;

     case 4:

     case 5:

     case 6:

        return 2;

     case 7:

     case 8:

     case 9:

        return 3;

     case 10:

     case 11:

     case 12:

        return 4;

     default:

        return -1;

   }

}



$csvOutput .= "\nAlgemene inlichtingen{$sep}\n";

$csvOutput .= "Projectnummer:{$sep}{$tprecord['nummer']}\n";



$loginNaam = getFirstRecord("select * from logins where profiel = 'hoofdproject' and tp_project = {$tprecord['id']} and login not like '%help%' and actief=1");



$csvOutput .= "Administratieve coördinator:{$sep}GDT LISTEL vzw\n";

$csvOutput .= "Naam contactpersoon:{$sep}{$loginNaam['naam']} {$loginNaam['voornaam']}\n";

if ($loginNaam['tel'] == "")

  $csvOutput .= "Telefoonnummer:{$sep}{$loginNaam['gsm']}\n\n\n";

else

  $csvOutput .= "Telefoonnummer:{$sep}{$loginNaam['tel']}\n\n\n";



$queryP= "select patient.code, naam, voornaam, patient_tp.begindatum, patient_tp.einddatum from patient, patient_tp where code = patient
           and project = {$tprecord['id']}
           order by patient.code";

           

$result=mysql_query($queryP) or die(mysql_error() . "<br /> $queryP");



$csvOutput .= "\n\n{$sep} Overleg rond de patiënt (1)\n";



$csvOutput .="patiënt{$sep}naam{$sep}voornaam{$sep}begindatum in project{$sep}datum uit project{$sep}overleggen  \n";



$aantalRecords = mysql_num_rows($result);

for ($iii=0; $iii < $aantalRecords ; $iii++) {

  $rij = mysql_fetch_assoc($result);

  foreach ($rij as $key => $value) {

    $rij[$key] = utf8_decode($rij[$key]);

  }





  $csvOutput .= '"' . $rij['code'] . "\"$sep";

  $csvOutput .= '"' . $rij['naam'] . "\"$sep";

  $csvOutput .= '"' . $rij['voornaam'] . "\"$sep";









  $csvOutput .= '"' . $rij['begindatum'] . "\"$sep";

  $csvOutput .= '"' . $rij['einddatum'] . "\"$sep";

  $csvOutput .=  "$sep" . printKolom($rij['code'],$rij['begindatum'],$rij['einddatum']);

  $csvOutput .= "\n";

}



$csvOutput .="\n";

$csvOutput .="\n";

$csvOutput .="\n";

$csvOutput .="\n";









header("Content-Type: text/csv");

header("Cache-Control: must-revalidate, post-check=0,pre-check=0");

header("Content-Transfer-Encoding: binary");

header("Content-Disposition: attachment; filename=\"TP_tabel.csv\"");

header("Content-length: " . strlen($csvOutput));

print($csvOutput);

require("../includes/dbclose.inc");



      }

?>