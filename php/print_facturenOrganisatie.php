<?php
ob_start();
session_start();



function printFactuur($factuurNummer, $jaar, $deelvzw, $nieuwePagina) {
   $record = getFirstRecord("select overleg.*, deelvzw, gemeente.zip
                                    from overleg inner join patient on overleg.patient_code = patient.code
                                                 inner join gemeente on gemeente.id = gem_id
                                    where organisatie_factuur = $factuurNummer and (overleg.genre is NULL or overleg.genre = 'gewoon')
                                          and gemeente.deelvzw = '$deelvzw'
                                          and overleg.datum like '{$jaar}%' ");

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
        //print_r($record);
        $octgz = getFirstRecord("select organisatie from logins
                                    where overleg_gemeente = {$records['zip']}");
        $orgID = $hvl['organisatie'];
     }
     else {
       $hvl = getUniqueRecord("select organisatie from logins where id = $loginID");
       $orgID = $hvl['organisatie'];
     }
   }

   printOrganisatie($orgID, $factuurNummer, $jaar, $record['deelvzw'], $record['organisatie_factuur_datum'], $nieuwePagina);
 }
}

function printPersonen($organisatieID, $factuurID, $jaar, $deelvzw, $datum, $nieuwePagina) {
  global $mm, $pdf;

  if ($nieuwePagina) {
    $pdf->ezNewPage();
  }

  $overlegQuery = "select patient.rijksregister, patient.naam as pnaam, patient.voornaam as pvoornaam,
                          overleg.datum, hvl.*, dlzip, dlnaam
                     from patient, overleg inner join hulpverleners hvl on
                                                  hvl.id = overleg.toegewezen_id
                                                  and hvl.organisatie = $organisatieID
                                                  and overleg.toegewezen_genre = 'hulp'
                                            inner join gemeente on gemeente.id = hvl.gem_id
                   where overleg.patient_code = patient.code
                     and overleg.organisatie_factuur = $factuurID
                     and (overleg.genre is NULL or overleg.genre = 'gewoon')
                     and deelvzw = '$deelvzw'
                     and overleg.datum like '{$jaar}%'
                   order by datum, hvl.id, patient_code";
die($overlegQuery);
  $vorigeHVL = -1;
  $resultOverleg = mysql_query($overlegQuery) or die(mysql_error());
  for ($i=0; $i<mysql_num_rows($resultOverleg); $i++) {
    $rij = mysql_fetch_assoc($resultOverleg);
    foreach ($rij as $key => $value) {
      $rij[$key] = utf8_decode($rij[$key]);
    }

    if ($vorigeHVL != $rij['id']) {
      if ($vorigeHVL != -1) {
        $tabel[$index]["Datum van\n het overleg"]= "TOTAAL";
        $tabel[$index]["Bedrag in €"]="€ $totaal";

        $pdf->ezTable($tabel);
        $pdf->ezText("\n\nDit bedrag van € $totaal wordt gestort op {$rij['iban']} (BIC {$rij['bic']})",10,$options);
        //$pdf->ezText("Rekeningnummer Listel : IBAN BE31735010958055 - BIC: KRED BE BB",11,$options);
        $pdf->ezText("\n\nKarla Segers, administratie LISTEL vzw",10,$options);
        $pdf->ezText("Handtekening : ",10,$options);
        $pdf->ezNewPage();
      }

      $vorigeHVL = $rij['id'];
      $tabel = array();
      $index = 0;
      $totaal = 0;
      $pdf->ezImage("../images/SEL{$deelvzw}.jpg", 30, 200, "none", "left");

      $pdf->ezSetY(297*$mm-25*$mm);

      $options = array('aleft'=>120*$mm,
                 'aright' => 210*$mm-25*$mm,
                 'justification' => 'left');

      $pdf->ezText("$factuurID {$rij['naam']} {$rij['voornaam']}\n{$rij['adres']}\n{$rij['dlzip']} {$rij['dlnaam']}",11,$options);
      $pdf->ezSetY(297*$mm-45*$mm);
      $options = array('aleft'=>35*$mm,
                 'aright' => 210*$mm-25*$mm,
                 'justification' => 'left');

      if ($deelvzw == "H")
        $sel = "SEL Hasselt";
      else
        $sel = "SEL Genk";

      $pdf->ezText("Listel vzw ($sel)\nondernemingsnummer 0446.055.785",10,$options);
      $pdf->ezText("A. Rodenbachstraat 29 bus 1",10,$options);
      $pdf->ezText("B-3500  HASSELT",10,$options);
      $pdf->ezText("011/81.94.70",10,$options);


      $jaar = substr($datum, strlen($jaar)-4);
      $pdf->ezText("\nFactuurnummer: $jaar/OV/$deelvzw/$factuurID - Factuurdatum: $datum - Ons kenmerk: $jaar/OV/$deelvzw/$factuurID\n",10,$options);

      //$pdf->ezText("\n\n\nOns kenmerk : Organisatievergoeding $factuurID\nBetalingsopdracht van $datum\n\n",10,$options);

      $pdf->ezText("\n\nGeachte Heer/Mevrouw,\n\nVoor de organisatie van volgende overleggen ontvangt u een vergoeding.\n\n",10,$options);

    }

    $tabel[$index]["Identificatie\nvan de patiënt\n(naam)"]= "{$rij['pnaam']} {$rij['pvoornaam']}";
    $tabel[$index]["Rijksregisternummer\nvan de patiënt"]= "{$rij['rijksregister']}";
    $tabel[$index]["Datum van\n het overleg"]= mooieDatum($rij['datum']);


    // bepaal het te gebruiken tarief
    $hetTarief = rizivTarief($rij['datum']);
    if ($rij['organisatie_dubbel']==1) {
      $bedrag = 2*$hetTarief['organisatie'];
    }
    else {
      $bedrag = $hetTarief['organisatie'];
    }

    $tabel[$index]["Bedrag in €"]="€ $bedrag";

    $totaal += $bedrag;
    $index++;
  }

  // en nu de laatste pagina afsluiten
  $tabel[$index]["Datum van\n het overleg"]= "TOTAAL";
  $tabel[$index]["Bedrag in €"]="€ $totaal";
  $pdf->ezTable($tabel);
  $pdf->ezText("\n\nDit bedrag van € $totaal wordt gestort op {$rij['iban']} (BIC {$rij['bic']})",10,$options);
  //$pdf->ezText("Rekeningnummer Listel : IBAN BE31735010958055 - BIC: KRED BE BB",11,$options);
  $pdf->ezText("\n\nKarla Segers, administratie LISTEL vzw",10,$options);
  $pdf->ezText("Handtekening : ",10,$options);
}

function printOrganisatie($organisatieID, $factuurID, $jaar, $deelvzw, $datum, $nieuwePagina) {
  global $mm, $pdf;

  if ($organisatieID >= 996 && $organisatieID <= 999) {
    printPersonen($organisatieID, $factuurID, $jaar, $deelvzw, $datum, $nieuwePagina);
    return;
  }

  if ($nieuwePagina) {
    $pdf->ezNewPage();
  }

  $pdf->ezImage("../images/SEL{$deelvzw}.jpg", 30, 200, "none", "left");

  $organisatie = getUniqueRecord("select organisatie.*, dlnaam, dlzip from organisatie inner join gemeente on gem_id = gemeente.id where organisatie.id = $organisatieID");

  $pdf->ezSetY(297*$mm-25*$mm);

  $options = array('aleft'=>120*$mm,
                 'aright' => 210*$mm-25*$mm,
                 'justification' => 'left');

  $tav = "T.a.v. Dienst Boekhouding";

/*
  if ($organisatie['contact_administratie']=="") {
    $tav = "T.a.v. Dienst Boekhouding";
  }
  else {
    $tav = "T.a.v. {$organisatie['contact_administratie']} (boekhouding) ";
  }
*/
  $pdf->ezText("{$organisatie['naam']}\n{$tav}\n{$organisatie['adres']}\n{$organisatie['dlzip']} {$organisatie['dlnaam']}",11,$options);

  $pdf->ezSetY(297*$mm-45*$mm);
  $options = array('aleft'=>35*$mm,
                 'aright' => 210*$mm-25*$mm,
                 'justification' => 'left');


  if ($deelvzw == "H")
    $sel = "SEL Hasselt";
  else
    $sel = "SEL Genk";

  $pdf->ezText("Listel vzw ($sel)\nondernemingsnummer 0446.055.785",10,$options);
  $pdf->ezText("A. Rodenbachstraat 29 bus 1",10,$options);
  $pdf->ezText("B-3500  HASSELT",10,$options);
  $pdf->ezText("011/81.94.70",10,$options);


//  $jaar = substr($datum, strlen($jaar)-4);
  $pdf->ezText("\nFactuurnummer: $jaar/OV/$deelvzw/$factuurID - Factuurdatum: $datum - Ons kenmerk: $jaar/OV/$deelvzw/$factuurID\n",10,$options);
  //$pdf->ezText("\n\n\nOns kenmerk : Organisatievergoeding $factuurID\nBetalingsopdracht van $datum\n\n",10,$options);

  $pdf->ezText("\n\nGeachte Heer/Mevrouw,\n\nVoor de organisatie van volgende overleggen ontvangt u een vergoeding.\n\n",10,$options);

  $totaal = 0;

  $overlegQuery = "select overleg.*, patient.* from overleg, patient inner join gemeente on patient.gem_id = gemeente.id
                   where overleg.patient_code = patient.code
                     and overleg.organisatie_factuur = $factuurID
                     and overleg.datum like '{$jaar}%'
                     and (overleg.genre is NULL or overleg.genre = 'gewoon')
                     and gemeente.deelvzw = '$deelvzw'
                   order by datum, patient_code asc";
//die($overlegQuery);
  $resultOverleg = mysql_query($overlegQuery);
  for ($i=0; $i<mysql_num_rows($resultOverleg); $i++) {
    $rij = mysql_fetch_assoc($resultOverleg);
    foreach ($rij as $key => $value) {
      $rij[$key] = utf8_decode($rij[$key]);
    }


    $tabel[$i]["Identificatie\nvan de patiënt\n(naam)"]= "{$rij['naam']} {$rij['voornaam']}";
    $tabel[$i]["Rijksregisternummer\nvan de patiënt"]= "{$rij['rijksregister']}";
    $tabel[$i]["Datum van\n het overleg"]= mooieDatum($rij['datum']);

    if ($rij['toegewezen_genre']=="gemeente" || $rij['toegewezen_genre']=="rdc") {
      $zoekPersoon = "select naam, voornaam from logins where id = {$rij['coordinator_id']}";
    }
    else {
      $zoekPersoon = "select naam, voornaam from hulpverleners where id = {$rij['coordinator_id']}";
    }
    
    $persoon = getUniqueRecord($zoekPersoon);

    $tabel[$i]["Organisator"]="{$persoon['naam']} {$persoon['voornaam']}";

    // bepaal het te gebruiken tarief
    $hetTarief = rizivTarief($rij['datum']);
    if ($rij['organisatie_dubbel']==1) {
      $bedrag = 2*$hetTarief['organisatie'];
    }
    else {
      $bedrag = $hetTarief['organisatie'];
    }

    $tabel[$i]["Bedrag in €"]="€ $bedrag";

    $totaal += $bedrag;
  }

  $tabel[$i]["Organisator"]="TOTAAL";
  $tabel[$i]["Bedrag in €"]="€ $totaal";

  $pdf->ezTable($tabel);



  $pdf->ezText("\n\nDit bedrag van € $totaal wordt gestort {$organisatie['iban']} (BIC {$organisatie['bic']})",10,$options);

  //$pdf->ezText("Rekeningnummer Listel : IBAN BE31735010958055 - BIC: KRED BE BB",11,$options);

  $pdf->ezText("\n\nKarla Segers, administratie LISTEL vzw",10,$options);

  $pdf->ezText("Handtekening : ",10,$options);



}


function bepaalOverleggen($jaar, $deelvzw) {
   global $beginOrganisatieVergoeding, $pdf;

   $nummerRecord = getUniqueRecord("select max(maximum) as maxNr from factuur_organisatie where datum like '%$jaar%' and deelvzw = '$deelvzw'");
   if ($nummerRecord['maxNr']=="")
     $factuurNummer = 1;
   else
     $factuurNummer = $nummerRecord['maxNr'];

   $minimumFactuurNummer = $factuurNummer;

   $qryGemeente = "select distinct organisatie as org, overleg.*
                     from logins, overleg inner join patient on overleg.patient_code = patient.code
                                          inner join gemeente on patient.gem_id = gemeente.id and deelvzw = '$deelvzw'
                   where organisatie_factuur is NULL
                     and datum >= '$beginOrganisatieVergoeding'
                     and datum like '$jaar%'
                     and keuze_vergoeding >= 1
                     and controle = 1
                     and overleg.toegewezen_genre = 'gemeente'
                     and coordinator_id = logins.id
                     and organisatie is not null
                     and (overleg.genre is NULL or overleg.genre = 'gewoon')
                     ";
   $qryRDC = "select distinct overleg.toegewezen_id as org, overleg.*
                from overleg inner join patient on overleg.patient_code = patient.code
                             inner join gemeente on patient.gem_id = gemeente.id and deelvzw = '$deelvzw'
                   where organisatie_factuur is NULL
                     and datum >= '$beginOrganisatieVergoeding'
                     and datum like '$jaar%'
                     and keuze_vergoeding >= 1
                     and controle = 1
                     and overleg.toegewezen_genre = 'rdc'
                     and (overleg.genre is NULL or overleg.genre = 'gewoon')
                     ";
   $qryZA = "select distinct organisatie as org, overleg.*
               from hulpverleners hvl, overleg inner join patient on overleg.patient_code = patient.code
                                               inner join gemeente on patient.gem_id = gemeente.id and deelvzw = '$deelvzw'
              where organisatie_factuur is NULL
                and datum >= '$beginOrganisatieVergoeding'
                and datum like '$jaar%'
                and keuze_vergoeding >= 1
                and controle = 1
                and overleg.toegewezen_genre = 'hulp'
                and overleg.toegewezen_id = hvl.id
                and (overleg.genre is NULL or overleg.genre = 'gewoon')
                ";
   $qryOrgs = "$qryGemeente union $qryRDC union $qryZA order by org, datum, id";

   $orgsResult = mysql_query($qryOrgs) or die("Kan de te vergoeden overleggen niet bepalen ($qryOrgs)<br/>" . mysql_error());
   $organisatie = array();

   $vorigeOrg = -1;
   $factuurNummer--; // omdat we direct een nieuwe organsatie hebben, en dan ook direct het factuurnr verhogen.
                     // anders hebben we een gat tussen 2 factuurreeksen

   if (mysql_num_rows($orgsResult) == 0)
     die("Er zijn geen openstaande overleggen meer.<div style='color:white'>$qryOrgs</div>");

   for ($i=0; $i < mysql_num_rows($orgsResult); $i++) {
     $overleg = mysql_fetch_assoc($orgsResult);
     if ($vorigeOrg != $overleg['org']) {
       $factuurNummer++;
       $organisatie[$factuurNummer] = $overleg['org'];
     }
     $vorigeOrg = $overleg['org'];

     if (dubbeleOrganisatorVergoeding($overleg)) {
        $dubbel = 1;
     }
     else {
       $dubbel = 0;
     }
     
     if ($jaar < date("Y")) {
       $factuurDatum = "31/12/$jaar";
     }
     else {
       $vandaag = date("d/m/Y");
       $factuurDatum = $vandaag;
     }
     mysql_query("update overleg set organisatie_factuur = $factuurNummer,
                                     organisatie_factuur_datum = \"$factuurDatum\",
                                     organisatie_dubbel = $dubbel
                                 where id = {$overleg['id']}") or die("kan vergoeding niet toekennen aan overleg {$overleg['id']}" . mysql_error());
   }
   
   $maximumFactuurNummer = $factuurNummer+1;
   if ($minimumFactuurNummer < $maximumFactuurNummer)
     mysql_query("insert into factuur_organisatie (minimum, maximum, datum, deelvzw) values ($minimumFactuurNummer, $maximumFactuurNummer, '$factuurDatum', '$deelvzw')");
   
   return $organisatie;
}



   require("../includes/clearSessie.inc");

   require("../includes/dbconnect2.inc");

   $paginanaam="Aanmaak betalingsopdrachten voor de organisator van het overleg";

   if (IsSet($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan") && ($_SESSION['profiel']=="listel"))
      {

   initRiziv();


$mm = 595.28/210;

include('../ezpdf/class.ezpdf.php');

$pdf =& new Cezpdf('A4');
$pdf->selectFont('../ezpdf/fonts/Helvetica.afm');

if (isset($_GET['factuurID'])) {
   // factuur van één organisatie
   printFactuur($_GET['factuurID'], date("Y"), $_GET['deelvzw'], false);
}
else if (isset($_GET['minFactuurID']) && isset($_GET['maxFactuurID']) && isset($_GET['datum']) && isset($_GET['deelvzw'])) {
   // voorpagina
/*
      $record = getFirstRecord("select overleg.*, deelvzw
                                    from overleg inner join patient on overleg.patient_code = patient.code
                                                 inner join gemeente on gemeente.id = gem_id
                                    where organisatie_factuur = {$_GET['minFactuurID']}
                                      and gemeente.deelvzw = '{$_GET['deelvzw']}'
                                      and (overleg.genre is NULL or overleg.genre = 'gewoon')");
      $pdf->ezImage("../images/SEL{$record['deelvzw']}.jpg", 30, 200, "none", "left");
      $pdf->ezSetY(297*$mm-100*$mm);
      $options = array('aleft'=>25*$mm,
                 'aright' => 210*$mm-25*$mm,
                 'justification' => 'center');
      $pdf->ezText("Betalingsopdrachten\nOrganisatievergoeding\n{$_GET['minFactuurID']} tot " . ($_GET['maxFactuurID']-1),20,$options);
*/
   $nieuwePagina = false;
   $jaar = substr($_GET['datum'],6);

   for ($i=$_GET['minFactuurID']; $i < $_GET['maxFactuurID']; $i++) {
     printFactuur($i, $jaar, $_GET['deelvzw'], $nieuwePagina);
     $nieuwePagina = true;
   }
}
else if (isset($_GET['jaar'])) {
   $organisatie = bepaalOverleggen($_GET['jaar'],$_GET['deelvzw']);
   
   // voorpagina
/*
      $pdf->ezImage("../images/SEL{$_GET['deelvzw']}.jpg", 30, 200, "none", "left");
      $pdf->ezSetY(297*$mm-100*$mm);
      $options = array('aleft'=>25*$mm,
                 'aright' => 210*$mm-25*$mm,
                 'justification' => 'center');
      $pdf->ezText("Betalingsopdrachten\nOrganisatievergoeding\n" . date("d/m/Y"),20,$options);
*/

   $nieuwePagina = false;
   foreach ($organisatie as $factuurNummer => $organisatieID) {
     printOrganisatie($organisatieID, $factuurNummer, $_GET['jaar'], $_GET['deelvzw'], date("d/m/Y"), $nieuwePagina);
     $nieuwePagina = true;
   }
}
else {
  die("Ik weet niet voor welk jaar ik betalingsopdrachten moet maken.");
}

$pdf->ezStream();

// einde mainblock
      require("../includes/dbclose.inc");
      require("../includes/footer.inc");
      }

//---------------------------------------------------------

/* Geen Toegang */ require("../includes/check_access.inc");

//---------------------------------------------------------



//---------------------------------------------------------

/* Sluit Dbconnectie */ require("../includes/dbclose.inc");

//---------------------------------------------------------

?>