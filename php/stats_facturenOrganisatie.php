<?php

ob_start();

session_start();


$sep = $_POST['sep'];

   require("../includes/clearSessie.inc");

   require("../includes/dbconnect2.inc");

   if (IsSet($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan") && ($_SESSION['profiel']=="listel"))

      {



$bestandsnaam = "organisatievergoeding";


      if ($_POST['deelvzw'] == "H")
        $sel = "SEL Hasselt";
      else
        $sel = "SEL Genk";



  $csvOutput = "Overzicht van alle organisatievergoedingen {$_POST['jaar']} voor $sel\n";
  $csvOutput .= "\n\n";
  $csvOutput .= "Factuurnr{$sep}Organisatie{$sep}Patient{$sep}RR{$sep}datum{$sep}organisator{$sep}bedrag\n";




function printFactuur($factuurNummer, $deelvzw) {
   $record = getFirstRecord("select overleg.*, deelvzw, gemeente.zip
                                    from overleg inner join patient on overleg.patient_code = patient.code
                                                 inner join gemeente on gemeente.id = gem_id
                                    where organisatie_factuur = $factuurNummer and (overleg.genre is NULL or overleg.genre = 'gewoon')
                                          and datum like '{$_POST['jaar']}%' and deelvzw = '$deelvzw'");

 if ($record['id']==0) {
   // niks doen als er geen record gevonden wordt
 }
 else {
   if ($record['toegewezen_genre']=="rdc") {
     $orgID = $record['toegewezen_id'];
   }
   else if ($record['toegewezen_genre']=="hulp") {
     $hvlID = $record['toegewezen_id'];
     $hvl = getUniqueRecord("select organisatie from hulpverleners where id = $hvlID");
     $orgID = $hvl['organisatie'];
   }
   else {
     $loginID = $record['coordinator_id'];
     //print("<hr/>$factuurNummer <hr/>");
     //print_r($record);
     if ($loginID == "") {
        // toegewezen aan gemeente, maar geen specifieke organisator gekend.
        // dan pakken we even de eerste de beste OC tgz voor die gemeente
        $octgz = getFirstRecord("select organisatie from logins
                                    where overleg_gemeente = {$records['zip']}");
        $orgID = $octgz['organisatie'];
     }
     else {
       $hvl = getUniqueRecord("select organisatie from logins where id = $loginID");
       $orgID = $hvl['organisatie'];
     }
   }

   printOrganisatie($orgID, $factuurNummer, $record['deelvzw'], $record['organisatie_factuur_datum']);
 }
}

function printPersonen($organisatieID, $factuurID, $deelvzw, $datum) {
  global $csvOutput, $sep;

  $overlegQuery = "select patient.rijksregister, patient.naam as pnaam, patient.voornaam as pvoornaam,
                          overleg.datum, hvl.*, dlzip, dlnaam
                     from patient, overleg inner join hulpverleners hvl on
                                                  hvl.id = overleg.toegewezen_id
                                                  and hvl.organisatie = $organisatieID
                                                  and overleg.toegewezen_genre = 'hulp'
                                            inner join gemeente on gemeente.id = hvl.gem_id and deelvzw = '$deelvzw'
                   where overleg.patient_code = patient.code
                     and datum like '{$_POST['jaar']}%'
                     and overleg.organisatie_factuur = $factuurID
                     and (overleg.genre is NULL or overleg.genre = 'gewoon')
                   order by datum, hvl.id, patient_code";
  $vorigeHVL = -1;
  $resultOverleg = mysql_query($overlegQuery) or die(mysql_error());
  for ($i=0; $i<mysql_num_rows($resultOverleg); $i++) {
    $rij = mysql_fetch_assoc($resultOverleg);
    foreach ($rij as $key => $value) {
      $rij[$key] = utf8_decode($rij[$key]);
    }

      $csvOutput .="$factuurID";
    $csvOutput .="{$sep}zelfstandig";

      $csvOutput .="$sep{$rij['pnaam']} {$rij['pvoornaam']}";
    $csvOutput .="$sep{$rij['rijksregister']}";
    $csvOutput .="$sep " . mooieDatum($rij['datum']);
    $csvOutput .="{$sep}{$rij['naam']} {$rij['voornaam']} - {$rij['dlnaam']}";

    // bepaal het te gebruiken tarief
    $hetTarief = rizivTarief($rij['datum']);
    if ($rij['organisatie_dubbel']==1) {
      $bedrag = 2*$hetTarief['organisatie'];
    }
    else {
      $bedrag = $hetTarief['organisatie'];
    }

    $csvOutput .="$sep € $bedrag\n";
  }

}

function printOrganisatie($organisatieID, $factuurID, $deelvzw, $datum) {
  global $csvOutput, $sep;


  if ($organisatieID >= 996 && $organisatieID <= 999) {
    printPersonen($organisatieID, $factuurID, $deelvzw, $datum);
    return;
  }

  $organisatie = getUniqueRecord("select organisatie.*, dlnaam, dlzip from organisatie inner join gemeente on gem_id = gemeente.id where organisatie.id = $organisatieID");


  $overlegQuery = "select * from overleg, patient inner join gemeente on patient.gem_id = gemeente.id and deelvzw = '$deelvzw'
                   where overleg.patient_code = patient.code
                     and datum like '{$_POST['jaar']}%'
                     and overleg.organisatie_factuur = $factuurID
                     and (overleg.genre is NULL or overleg.genre = 'gewoon')
                   order by datum, patient_code asc";

  $resultOverleg = mysql_query($overlegQuery);
  for ($i=0; $i<mysql_num_rows($resultOverleg); $i++) {
    $rij = mysql_fetch_assoc($resultOverleg);
    foreach ($rij as $key => $value) {
      $rij[$key] = utf8_decode($rij[$key]);
    }


    $csvOutput .="$factuurID $sep {$organisatie['naam']}";
    $csvOutput .="$sep{$rij['naam']} {$rij['voornaam']}";
    $csvOutput .="$sep{$rij['rijksregister']}";
    $csvOutput .="$sep" . mooieDatum($rij['datum']);

    if ($rij['toegewezen_genre']=="gemeente" || $rij['toegewezen_genre']=="rdc") {
      $zoekPersoon = "select naam, voornaam from logins where id = {$rij['coordinator_id']}";
    }
    else {
      $zoekPersoon = "select naam, voornaam from hulpverleners where id = {$rij['coordinator_id']}";
    }

    $persoon = getUniqueRecord($zoekPersoon);

    $csvOutput .="$sep{$persoon['naam']} {$persoon['voornaam']}";


    // bepaal het te gebruiken tarief
    $hetTarief = rizivTarief($rij['datum']);
    if ($rij['organisatie_dubbel']==1) {
      $bedrag = 2*$hetTarief['organisatie'];
    }
    else {
      $bedrag = $hetTarief['organisatie'];
    }

    $csvOutput .="$sep € $bedrag \n";
  }

}








   initRiziv();

   $nummersRecord = getUniqueRecord("select min(minimum) as minNr, max(maximum) as maxNr from factuur_organisatie where datum like '%{$_POST['jaar']}' and deelvzw = '{$_POST['deelvzw']}'");


   for ($i=$nummersRecord['minNr']; $i < $nummersRecord['maxNr']; $i++) {
     printFactuur($i, $_POST['deelvzw']);
   }


$csvOutput .= "\n\ngegenereerd op " . date("d/m/Y H:i.s ");

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