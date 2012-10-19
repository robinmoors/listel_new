<?php

session_start();





   require("../includes/dbconnect2.inc");





function printOverzicht() {

  global $pdf, $ontvanger, $alleInfo, $hetTarief, $kostprijs, $jaar, $mm;


  $pdf->ezImage("../images/SEL{$alleInfo['deelvzw']}.jpg", 30, 200, "none", "left");



  $pdf->ezSetY(297*$mm-30*$mm);

  $options = array('aleft'=>100*$mm,

                 'aright' => 595.28-35*$mm,

                 'justification' => 'left');

  $pdf->ezText("Uittreksel van {$alleInfo['organisatie_factuur']}\nvoor de organisatie van een overleg op {$alleInfo['mooieDatum']} " ,15,$options);



  $pdf->ezSetY(297*$mm-75*$mm);

  $options = array('aleft'=>25*$mm,

                 'aright' => 595.28-35*$mm,

                 'justification' => 'left');

  $pdf->ezText("Volgend bedrag dient gestort te worden voor de organisatie van een overleg rond \n{$alleInfo['code']} {$alleInfo['naam']} {$alleInfo['voornaam']}. Dit overleg vond plaats op {$alleInfo['mooieDatum']}.",12,$options);





  $pdf->ezSetY(297*$mm-105*$mm);
    $i=0;

    $tabel[$i]['Naam'] = "{$ontvanger['naam']} {$ontvanger['voornaam']}";

    // $tabel[$i]['Gemeente'] = "{$ontvanger[$i]['dlzip']} {$ontvanger[$i]['dlnaam']}";

    if ($ontvanger[$i]['orgnaam']!="") {

       $tabel[$i]['Organisatie'] = "{$ontvanger['orgnaam']}";

    }

    else if ($ontvanger[$i]['fnaam']!="") {

       $tabel[$i]['Functie'] = "{$ontvanger['fnaam']}";

    }

    $tabel[$i]['Rekening'] = "{$ontvanger['reknr']}";

    if ($alleInfo['organisatie_dubbel']==1) {
      $tarief = 2 * $hetTarief['organisatie'];
    }
    else {
      $tarief = $hetTarief['organisatie'];
    }
    $tabel[$i]['Bedrag'] = "€ $tarief";






  $pdf->ezTable($tabel);




  $options = array('aleft'=>25*$mm,

                 'aright' => 595.28-35*$mm,

                 'justification' => 'left');


  $pdf->ezText("\n\n\nMet de groeten van het Listel e-zorgplan ;-)", 12, $options);

}





function printPagina($persoon, $bedrag) {

  global $pdf, $alleInfo, $mm;

  $pdf->ezNewPage();

  $pdf->ezImage("../images/SEL{$alleInfo['deelvzw']}.jpg", 30, 200, "none", "left");


  $pdf->ezSetY(297*$mm-30*$mm);

  $options = array('aleft'=>100*$mm,

                 'aright' => 595.28-35*$mm,

                 'justification' => 'left');
  if ($persoon['org_doel'] >= 996 && $persoon['org_doel'] <= 999) {
    $pdf->ezText("{$persoon['naam']} {$persoon['voornaam']}\n{$persoon['adres']}\n{$persoon['dlzip']} {$persoon['dlnaam']}",12,$options);

    $aanspreking = "u";

    $wieWasEr = "";

  }
  else {

    $extraOverOrg = " ({$persoon['orgnaam']}) ";

    $aanspreking = "uw organisatie";

    $wieWasEr = "door {$persoon['naam']} {$persoon['voornaam']}";

    $pdf->ezText("{$persoon['orgnaam']}\nT.a.v. Dienst Boekhouding\n{$persoon['adres']}\n{$persoon['dlzip']} {$persoon['dlnaam']}",12,$options);

  }

/* ALS TOCH NAAM van contactpersoon VERMELDEN BIJ ORGANISATIE, IPV altijd tav Boekhouding
  else if ($persoon['orgnaam']!="" ) {

    $extraOverOrg = " ({$persoon['orgnaam']}) ";

    $aanspreking = "uw organisatie";

    $wieWasEr = "door {$persoon['naam']} {$persoon['voornaam']}";

    $pdf->ezText("{$persoon['orgnaam']}\nT.a.v. Dienst Boekhouding\n{$persoon['adres']}\n{$persoon['dlzip']} {$persoon['dlnaam']}",12,$options);

  }

  else {

    $pdf->ezText("{$persoon['naam']} {$persoon['voornaam']}\n{$persoon['orgnaam']}\n{$persoon['adres']}\n{$persoon['dlzip']} {$persoon['dlnaam']}",12,$options);

    $aanspreking = "u";

    $wieWasEr = "";

  }

*/


  $pdf->ezSetY(297*$mm-75*$mm);

  $pdf->ezSetDy(12);

  $options = array('aleft'=>25*$mm,

                 'aright' => 595.28-35*$mm,

                 'justification' => 'right');

  $pdf->ezText("d.d. " . $alleInfo['organisatie_factuur'],12,$options);



  $pdf->ezSetY(297*$mm-105*$mm);

  $options = array('aleft'=>25*$mm,

                 'aright' => 595.28-35*$mm,

                 'justification' => 'left');



  $pdf->ezText("Beste,\n\n\n$aanspreking ontving van Listel vzw de som van <b>€$bedrag</b> \nop rekeningnummer {$persoon['reknr']} $extraOverOrg \nals vergoeding voor de organisatie van een overleg bij het zorgplan <b>{$alleInfo['code']}</b> $wieWasEr. \nDit overleg vond plaats op <b>{$alleInfo['mooieDatum']}</b>.",12,$options);




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
                p.gem_id,
                g.zip,
                g.dlzip,

                g.dlnaam,
                g.deelvzw,

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
            if (($alleInfo['keuze_vergoeding'] != 1)
                    || $alleInfo['genre'] == "TP"
                    || ($alleInfo['datum'] < $beginOrganisatieVergoeding))
               die("Voor dit overleg krijg je geen organisatievergoeding!");

            if ($alleInfo['organisatie_factuur']=="") {

               $alleInfo['organisatie_factuur'] = date("d/m/Y");
               $resultAantal = mysql_query("select * from overleg where keuze_vergoeding = 1
                                                   and (genre = 'gewoon' or genre is null)
                                                   and patient_code = \"{$alleInfo['code']}\"") or die("probleem met tellen aantal al vergoede overleggen");
               if (mysql_num_rows($resultAantal) == 1) {
                 $dubbel = 1;
               }
               else {
                 $dubbel = 0;
               }
               $alleInfo['organisatie_dubbel'] = $dubbel;
               mysql_query("update overleg set organisatie_factuur = \"{$alleInfo['organisatie_factuur']}\",
                                               organisatie_dubbel = $dubbel
                                   where id = $overlegID");

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


switch ($alleInfo['toegewezen_genre']) {
   case "gemeente":
      $qryOrganisator = "select organisatie.*, dlzip, dlnaam from organisatie, logins, gemeente
                         where logins.overleg_gemeente = {$alleInfo['zip']}
                           and organisatie.id = logins.organisatie
                           and gemeente.id = organisatie.gem_id";
   break;
   case "rdc":
      $qryOrganisator = "select organisatie.*, dlzip, dlnaam from organisatie, gemeente
                         where organisatie.id = {$alleInfo['toegewezen_id']}
                           and gemeente.id = organisatie.gem_id";
   break;
   case "hulp":
     $qryOrganisator="
      	SELECT
         h.*,
         gemeente.dlzip,
         gemeente.dlnaam,
         org.id as orgid,
         org.naam as orgNaam,
         if ( hoofdzetel = - 1 , org.id , org.hoofdzetel ) as org_doel,
         functies.naam as fnaam
	      FROM
		      gemeente,
		      hulpverleners h left join organisatie org on (h.organisatie = org.id),
		      functies
	      WHERE
          {$alleInfo['toegewezen_id']}=h.id AND
          h.fnct_id = functies.id AND
          gemeente.id = h.gem_id AND
     ";
   break;
}

$ontvanger = Array();

$resultMensen = mysql_query($qryOrganisator) or die(mysql_error());
if (mysql_num_rows($resultMensen)==0) {
  print("<div style=\"display:none\">$qryOrganisator</div>");
  die("Er kon geen organisator voor dit overleg gevonden worden, bv. omdat de OC-tgz nog geen organisatie heeft.");
}

$persoon = mysql_fetch_assoc($resultMensen);

foreach ($persoon as $key => $value) {
  $persoon[$key] = utf8_decode($persoon[$key]);
}

    // desnoods adres van organisatie opzoeken
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
                  $persoon['reknr'] = $orgInfo['reknr']; // . "\nIBAN {$orgInfo['iban']}\nBIC: {$orgInfo['bic']}";
                  if ($orgInfo['iban'] == "" && $orgInfo['hoofdzetel'] > -1) {
                     $qry9="SELECT reknr, iban, bic FROM organisatie WHERE id = {$orgInfo['hoofdzetel']}";
                     $orgInfo=mysql_fetch_array(mysql_query($qry8)) or die($qry8 . mysql_error());
                     foreach ($orgInfo as $key => $value) {
                       $orgInfo[$key] = utf8_decode($orgInfo[$key]);
                     }
                     $persoon['reknr'] = $orgInfo['reknr']; // . "\nIBAN {$orgInfo['iban']}\nBIC: {$orgInfo['bic']}";
                  }
    }

    $ontvanger = $persoon;




initRiziv();

$hetTarief = rizivTarief($alleInfo['datum']);

$kostprijs = $hetTarief['organisatie']*(1+$alleInfo['organisatie_dubbel']);



printOverzicht();
printPagina($ontvanger,$kostprijs);




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