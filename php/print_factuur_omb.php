<?php
  session_start();
  require("../includes/dbconnect2.inc");

function printOverzicht() {
  global $pdf, $aantalOntvangers, $ontvanger, $alleInfo, $hetTarief, $kostprijs, $jaar, $mm;

  $pdf->ezImage("../images/logoke.jpg", 30, 100, "none", "left");
  $pdf->ezSetY(297*$mm-30*$mm);
  $options = array('aleft'=>100*$mm,
                 'aright' => 595.28-35*$mm,
                 'justification' => 'left');
  $pdf->ezText("Uittreksel OMB\n d.d. " . $alleInfo['omb_factuur'],15,$options);

  $pdf->ezSetY(297*$mm-75*$mm);
  $options = array('aleft'=>25*$mm,
                 'aright' => 595.28-35*$mm,
                 'justification' => 'left');

  $pdf->ezText("Volgende bedragen dienen gestort te worden voor het OMB-overleg van \n{$alleInfo['code']} {$alleInfo['naam']} {$alleInfo['voornaam']}. Dit overleg vond plaats op {$alleInfo['mooieDatum']}.",12,$options);

  $pdf->ezSetY(297*$mm-105*$mm);
  for ($i=0; $i<$aantalOntvangers; $i++) {
    $tabel[$i]['Naam'] = "{$ontvanger[$i]['naam']} {$ontvanger[$i]['voornaam']}";
    // $tabel[$i]['Gemeente'] = "{$ontvanger[$i]['dlzip']} {$ontvanger[$i]['dlnaam']}";
    if ($ontvanger[$i]['orgnaam']!="") {
       $tabel[$i]['Organisatie'] = "{$ontvanger[$i]['orgnaam']}";
    }
    else {
       $tabel[$i]['Organisatie'] = "{$ontvanger[$i]['fnaam']}";
    }

    $tabel[$i]['Rekening'] = "{$ontvanger[$i]['reknr']}";
    $tabel[$i]['Bedrag'] = "€{$hetTarief['omb']}";
  }

  $tabel[$i]['Naam'] = "Listel vzw";
  $tabel[$i]['Organisatie'] = "";
  $tabel[$i]['Rekening'] = "";
  $tabel[$i]['Bedrag'] = "€{$hetTarief['registratieomb']}";
  $i++;
  $tabel[$i]['Naam'] = "";
  $tabel[$i]['Organisatie'] = "";
  $tabel[$i]['Rekening'] = "TOTAAL";
  $tabel[$i]['Bedrag'] = "€$kostprijs";

  $pdf->ezTable($tabel);

  $huidigePot = getFirstRecord("select pot from omb_pot where jaar = $jaar");
  $options = array('aleft'=>25*$mm,
                 'aright' => 595.28-35*$mm,
                 'justification' => 'left');
  //$pdf->ezText("\n\n\nNa deze betaling zit er nog €{$huidigePot['pot']} in de pot voor $jaar", 12, $options);
  $pdf->ezText("\n\n\n\n\nMet de groeten van het Listel e-zorgplan ;-)", 12, $options);
}

function printPagina($persoon, $bedrag) {
  global $pdf, $alleInfo, $mm;
  $pdf->ezNewPage();
  $pdf->ezImage("../images/logoke.jpg", 30, 100, "none", "left");

  $pdf->ezSetY(297*$mm-30*$mm);
  $options = array('aleft'=>100*$mm,
                 'aright' => 595.28-35*$mm,
                 'justification' => 'left');
  if ($persoon['org_doel'] >= 996 && $persoon['org_doel'] <= 999) {
    $pdf->ezText("{$persoon['naam']} {$persoon['voornaam']}\n{$persoon['adres']}\n{$persoon['dlzip']} {$persoon['dlnaam']}",12,$options);
    $aanspreking = "u";
    $wieWasEr = "";
  }
  else if ($persoon['orgnaam']!="" ) {
    $extraOverOrg = " ({$persoon['orgnaam']}) ";
    $aanspreking = "uw organisatie";
    $wieWasEr = "voor de aanwezigheid van {$persoon['naam']} {$persoon['voornaam']}";
    $pdf->ezText("{$persoon['orgnaam']}\nT.a.v. Dienst Boekhouding\n{$persoon['adres']}\n{$persoon['dlzip']} {$persoon['dlnaam']}",12,$options);
  }
  else {
    $pdf->ezText("{$persoon['naam']} {$persoon['voornaam']}\n{$persoon['orgnaam']}\n{$persoon['adres']}\n{$persoon['dlzip']} {$persoon['dlnaam']}",12,$options);
    $aanspreking = "u";
    $wieWasEr = "";
  }

  $pdf->ezSetY(297*$mm-75*$mm);
  $pdf->ezSetDy(12);
  $options = array('aleft'=>25*$mm,
                 'aright' => 595.28-35*$mm,
                 'justification' => 'right');
  $pdf->ezText("d.d. " . $alleInfo['omb_factuur'],12,$options);

  $pdf->ezSetY(297*$mm-105*$mm);
  $options = array('aleft'=>25*$mm,
                 'aright' => 595.28-35*$mm,
                 'justification' => 'left');

  $pdf->ezText("Beste,\n\n\n$aanspreking ontving in de voorbije maand van Listel vzw de som van <b>€$bedrag</b> \nop rekeningnummer {$persoon['reknr']} $extraOverOrg \nals vergoeding vanwege de provincie Limburg in het kader van een overleg rond ouderenmis(be)handeling bij het zorgplan <b>{$alleInfo['code']}</b> $wieWasEr. \nDit overleg vond plaats op <b>{$alleInfo['mooieDatum']}</b>.",12,$options);

  $pdf->ezText("Voor meer informatie kan u steeds met ons contact opnemen.\n\n\n", 12, $options);
  $pdf->ezText("Met vriendelijke groet,\nKristel Vandendriessche", 12, $options);

  $pdf->ezSetY(25*$mm);
  $options = array('aleft'=>25*$mm,
                 'aright' => 595.28-35*$mm,
                 'justification' => 'justify');
  $pdf->ezText("LISTEL vzw                 A. Rodenbachstraat 29/1 - 3500 Hasselt               011/81.94.70", 12, $options);
}

   if (isset($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan")
          && ($_SESSION['profiel'] == "listel" ))
      {
    $overlegID = $_GET['id'];

    $querypat = "
         SELECT
                p.naam,
                p.voornaam,
                p.adres,
                g.dlzip,
                g.dlnaam,
                p.gebdatum,
                p.id, p.code,
                p.mutnr,
                overleg.*
            FROM
                patient p,
                gemeente g,
                overleg
            WHERE
                overleg.id = $overlegID AND
                p.code= overleg.patient_code AND
                p.gem_id=g.id"; // Query
      if ($resultpat=mysql_query($querypat))
        {
            $alleInfo= mysql_fetch_array($resultpat);
            foreach ($alleInfo as $key => $value) {
              $alleInfo[$key] = utf8_decode($alleInfo[$key]);
            }

            if ($alleInfo['omb_factuur']=="") {
               $alleInfo['omb_factuur'] = date("d/m/Y");
               mysql_query("update overleg set omb_factuur = \"{$alleInfo['omb_factuur']}\" where id = $overlegID");
               $veranderPot = true;
            }
        }
      else {
        die("dieje query $querypat alles van het patient en het overleg op te halen toch..." .mysql_error());
      }


    $datum = $alleInfo['datum'];
    $alleInfo['mooieDatum'] = substr($datum, 6,2) . "/" . substr($datum, 4,2) . "/" . substr($datum, 0,4);

//mainblock
$mm = 595.28/210;
include('../ezpdf/class.ezpdf.php');

$pdf =& new Cezpdf('A4');
//$pdf->ezSetMargins(0,0,0,0);
$pdf->selectFont('../ezpdf/fonts/Times-Roman.afm');

     $qryZVL="
      	SELECT
         h.*,
         gemeente.dlzip,
         gemeente.dlnaam,
         org.id as orgid,
         if ( hoofdzetel = - 1 , org.id , org.hoofdzetel ) as org_doel,
         functies.naam as fnaam
	      FROM
		      afgeronde_betrokkenen bl,
		      overleg,
		      gemeente,
		      hulpverleners h left join organisatie org on (h.organisatie = org.id),
		      functies
	      WHERE
          overleggenre = 'gewoon' AND
          overleg.id = $overlegID AND
          overleg.id = bl.overleg_id AND
          (bl.genre = 'hulp' or bl.genre = 'orgpersoon') AND
          bl.persoon_id=h.id AND
          h.fnct_id = functies.id AND
          gemeente.id = h.gem_id AND
          org.genre = 'ZVL' AND
		      bl.aanwezig=1
        ORDER BY org_doel, bl.id
     ";

     
$ontvanger = Array();
$aantalOntvangers = 0;
$huidigeOrg = -1;
$aantalOntvangers = 0;
$resultMensen = mysql_query($qryZVL) or die(mysql_error());
for ($i=0; $i<mysql_num_rows($resultMensen); $i++) {
  $persoon = mysql_fetch_assoc($resultMensen);
  foreach ($persoon as $key => $value) {
    $persoon[$key] = utf8_decode($persoon[$key]);
  }
    // desnoods adres van organisatie opzoeken
  if ($huidigeOrg != $persoon['org_doel'] || ($persoon['org_doel'] >= 996 && $persoon['org_doel'] <= 999)) {
    if ($persoon['organisatie'] > 0 && ($persoon['gem_id'] == 0  || $persoon['gem_id'] == 9999)) {
                 $qry8="SELECT organisatie.naam, dlzip,dlnaam, adres, reknr, iban, bic, hoofdzetel FROM gemeente, organisatie WHERE gemeente.id=organisatie.gem_id and organisatie.id = {$persoon['organisatie']}";
                  $orgInfo=mysql_fetch_array(mysql_query($qry8)) or die($qry8 . mysql_error());
                  foreach ($orgInfo as $key => $value) {
                    $orgInfo[$key] = utf8_decode($orgInfo[$key]);
                  }
                  $persoon['orgnaam'] = $orgInfo['naam'];
                  $persoon['adres'] = $orgInfo['adres'];
                  $persoon['dlzip'] = $orgInfo['dlzip'];
                  $persoon['dlnaam'] = $orgInfo['dlnaam'];
                  $persoon['reknr'] = "IBAN {$orgInfo['iban']}\nBIC: {$orgInfo['bic']}";
                  if ($orgInfo['iban'] == "" && $orgInfo['hoofdzetel'] > -1) {
                     $qry9="SELECT reknr, iban, bic FROM organisatie WHERE id = {$orgInfo['hoofdzetel']}";
                     $orgInfo=mysql_fetch_array(mysql_query($qry8)) or die($qry8 . mysql_error());
                     foreach ($orgInfo as $key => $value) {
                       $orgInfo[$key] = utf8_decode($orgInfo[$key]);
                     }
                     $persoon['reknr'] = "IBAN {$orgInfo['iban']}\nBIC: {$orgInfo['bic']}";
                  }
    }
    $ontvanger[$i] = $persoon;
    $aantalOntvangers++;
  }
}
     $qryProfnietZVL="
      	SELECT
		      h.naam as hnaam, h.voornaam,
		      h.adres,
          org.*          ,
          if ( hoofdzetel = - 1 , org.id , org.hoofdzetel ) as org_doel,
          gem_org.dlzip as org_dlzip, gem_org.dlnaam as org_dlnaam,
          gem_hvl.dlzip as hvl_dlzip, gem_hvl.dlnaam as hvl_dlnaam
	      FROM
		      afgeronde_betrokkenen bl,
		      overleg,
		      hulpverleners h left join organisatie org on (h.organisatie = org.id)
		      left join gemeente gem_org on (org.gem_id = gem_org.id)
          left join gemeente gem_hvl on (h.gem_id = gem_hvl.id)
	      WHERE
          overleggenre = 'gewoon' AND
          overleg.id = $overlegID AND
          overleg.id = bl.overleg_id AND
          (bl.genre = 'hulp' or bl.genre = 'orgpersoon') AND
          bl.persoon_id=h.id AND
          org.genre in ('HVL', 'XVLP', 'XVLNP') AND
		      bl.aanwezig=1
        ORDER BY org_doel, bl.id
     ";

/*
SELECT distinct( (hoofdzetel-sign(hoofdzetel))*hoofdzetel/(hoofdzetel-1)) FROM organisatie
*/


$huidigeOrg = -1;
$resultMensen = mysql_query($qryProfnietZVL) or die(mysql_error());
for ($i=0; $i<mysql_num_rows($resultMensen); $i++) {
  $persoon = mysql_fetch_assoc($resultMensen);
  foreach ($persoon as $key => $value) {
    $persoon[$key] = utf8_decode($persoon[$key]);
  }
  if ($huidigeOrg != $persoon['org_doel'] || ($persoon['org_doel'] >= 996 && $persoon['org_doel'] <= 999)) {
    $huidigeOrg = $persoon['org_doel'];
    $ontvanger[$aantalOntvangers] = $persoon;
    $ontvanger[$aantalOntvangers]['orgnaam']=$persoon['naam'];
    $ontvanger[$aantalOntvangers]['naam']=$persoon['hnaam'];
    if ($persoon['org_doel'] >= 996 && $persoon['org_doel'] <= 999) {
       $ontvanger[$aantalOntvangers]['dlzip']  = $persoon['hvl_dlzip'];
       $ontvanger[$aantalOntvangers]['dlnaam']  = $persoon['hvl_dlnaam'];
    }
    else {
       $ontvanger[$aantalOntvangers]['dlzip']  = $persoon['org_dlzip'];
       $ontvanger[$aantalOntvangers]['dlnaam']  = $persoon['org_dlnaam'];
    }

    $aantalOntvangers++;
  }
}



// pot aanpassen
initRiziv();
$hetTarief = rizivTarief($alleInfo['datum']);
$kostprijs = $hetTarief['omb']*$aantalOntvangers + $hetTarief['registratieomb'];
$jaar = substr($alleInfo['datum'],0,4);

if ($veranderPot) {
  mysql_query("update omb_pot set pot = pot - $kostprijs where jaar = $jaar");
}

printOverzicht();
for ($i=0;$i<$aantalOntvangers; $i++) {
  printPagina($ontvanger[$i],$hetTarief['omb']);
}

$pdf->ezStream();

      require("../includes/dbclose.inc");
      }
//---------------------------------------------------------
/* Geen Toegang */ require("../includes/check_access.inc");
//---------------------------------------------------------

//---------------------------------------------------------
/* Sluit Dbconnectie */ require("../includes/dbclose.inc");
//---------------------------------------------------------
?>