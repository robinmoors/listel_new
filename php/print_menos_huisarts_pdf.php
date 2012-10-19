<?php

session_start();





   require("../includes/dbconnect2.inc");












//if (isset($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan"))
{


    $datum = date("d/m/Y");

       $query = "
                SELECT
          h.id AS hid,
					h.naam AS naam,
					h.voornaam,
          h.adres,
					h.fnct_id,
					h.tel,
					h.gem_id,
					h.email,
          h.reknr,
          h.iban,
          h.bic,
					h.riziv1,
          h.riziv2,
					h.riziv3,
					h.fax,
          h.gsm,

          h.organisatie,
					organisatie.naam as orgNaam,
          organisatie.adres as orgAdres,
          gem2.dlzip as orgZip,
          gem2.dlnaam as orgGemeente,

          g.id AS gid,
          g.dlnaam,
					g.dlzip
			          FROM
                    gemeente g,
                    huidige_betrokkenen bl,
                    hulpverleners h left join organisatie on (organisatie.id = organisatie)
                                    left join gemeente gem2 on organisatie.gem_id = gem2.id
                WHERE
                    overleggenre = 'menos' AND
                    bl.genre = 'hulp' AND
                    bl.persoon_id = h.id AND
                    h.fnct_id = 1 AND
                    g.id = h.gem_id AND
                    bl.patient_code = '{$_SESSION['pat_code']}'";
     }

     $result = mysql_query($query) or die($query . "<br/>" . mysql_error());
     if (mysql_num_rows($result)<>0 ){
       $persoon= mysql_fetch_array($result);
       foreach ($persoon as $key => $value) {
         $persoon[$key] = utf8_decode($persoon[$key]);
       }
     }
     else{
       die("Er is geen huisarts, en dus kunnen we die geen brief sturen!");
		   //print(mysql_error());
     }


$patient = getUniqueRecord("select patient.*, patient_menos.begindatum, gemeente.dlzip, gemeente.dlnaam
                                                  from patient inner join patient_menos
                                                    on (patient = code and code = '{$_SESSION['pat_code']}')
                                                  inner join gemeente on patient.gem_id = gemeente.id");


$mm = 595.28/210;

include('../ezpdf/class.ezpdf.php');



$pdf =& new Cezpdf('A4');

//$pdf->ezSetMargins(0,0,0,0);

$pdf->selectFont('../ezpdf/fonts/Helvetica.afm');




  $pdf->ezImage("../images/logo_menos.png", 30, 100, "none", "left");
  $pdf->ezSetY(297*$mm-50*$mm);

  $options = array('aleft'=>140*$mm,
                 'aright' => 595.28-35*$mm,
                 'justification' => 'left');

  $pdf->ezText("{$persoon['naam']} {$persoon['voornaam']}\n{$persoon['adres']}\n{$persoon['dlzip']} {$persoon['dlnaam']}", 11, $options);
  
  
  $pdf->ezSetY(297*$mm-80*$mm);

  $options = array('aleft'=>25*$mm,
                 'aright' => 595.28-35*$mm,
                 'justification' => 'left');


  $gebDatum = $patient['gebdatum'];
  $geboorte = substr($gebDatum,6,2) . "/". substr($gebDatum, 4,2) . "/" . substr($gebDatum, 0,4);
  
  $beginDatum = $patient['begindatum'];
  $begin = substr($beginDatum,8,2) . "/". substr($beginDatum, 5,2) . "/" . substr($beginDatum, 0,4);
  $pdf->ezText("Betreft: doorverwijzing naar Menos sinds <b><i>$begin</b></i>", 11, $options);

  $pdf->ezSetY(297*$mm-89*$mm);
  $pdf->ezText("Patiënt:", 11, $options);
  $pdf->ezSetY(297*$mm-89*$mm);
  $options = array('aleft'=>45*$mm,
                 'aright' => 595.28-35*$mm,
                 'justification' => 'left');
  $pdf->ezText("<b><i>{$patient['voornaam']} {$patient['naam']}\n° $geboorte\n{$patient['adres']}\n{$patient['dlzip']} {$patient['dlnaam']}</i></b>", 11, $options);


  $options = array('aleft'=>25*$mm,
                 'aright' => 595.28-35*$mm,
                 'justification' => 'left');

  $pdf->ezSetY(297*$mm-120*$mm);
  $pdf->ezText("Geachte dokter,


In samenspraak met de patiënt en/of mantelzorger werd uw patiënt doorverwezen naar het samenwerkingsinitiatief Menos.
Vzw Menos richt zich naar zorgbehoevende ouderen en hun mantelzorgers en biedt hen emotionele ondersteuning en begeleiding.

Er werd vanuit Listel een uitbreiding van het e- zorgplan voor vzw Menos ontwikkeld. Via deze webapplicatie kunnen betrokken zorg- en hulpverleners met elkaar communiceren en informatie delen met elkaar. U kan inloggen via de website van Listel vzw:  www.listel.be
Indien u  niet over een login beschikt, kan u het bijgevoegd blad tekenen en terug sturen naar Listel vzw.


Wij zijn steeds bereid onze gegevens met u uitvoeriger te bespreken.



Met vriendelijke groeten,


Laila Abdelmalek
coördinator Menos/ Protocol3
gsm 0473/967583  (tel 089/329777)
fax 089/329778
l.abdelmalek@cgglitp.be
www.menosgenk.be
", 11, $options);
  
/*
  $pdf->ezText("Door hieronder mijn handtekening te zetten, bevestig ik dat onderstaande gegevens correct zijn.\n",11, $options);

  $options = array('aleft'=>40*$mm,
                 'aright' => 595.28-35*$mm,
                 'justification' => 'left');
    $pdf->ezText("{$persoon['naam']} {$persoon['voornaam']}", 11, $options);
    if ($persoon['fnaam']!="") $pdf->ezText("{$persoon['fnaam']} ({$persoon['fgnaam']})", 11, $options);
    if ($persoon['orgnaam']!="") $pdf->ezText("{$persoon['orgnaam']}", 11, $options);
    if ($persoon['adres']!=="")
       $pdf->ezText("{$persoon['adres']}\n{$persoon['dlzip']} {$persoon['dlnaam']}",11, $options);
    else
       $pdf->ezText("{$persoon['orgNaam']}\n{$persoon['orgAdres']}\n{$persoon['orgZip']} {$persoon['orgGemeente']}",11, $options);
    if ($persoon['fax']!="") $fax = "fax: {$persoon['fax']}";
    if ($persoon['email']=="") {
       $pdf->ezText("<b>Een PERSOONLIJK emailadres is noodzakelijk en verplicht!</b> \nVul het hier in: . . . . . . . . . . . . . . . . . . . . . ",11, $options);
       $pdf->ezText("{$persoon['tel']} {$persoon['gsm']} $fax",11, $options);
    }
    else
       $pdf->ezText("<b>{$persoon['email']}</b>\n{$persoon['tel']} {$persoon['gsm']} $fax",11, $options);
    if ($persoon['reknr']!="") $pdf->ezText("{$persoon['iban']} (BIC  {$persoon['bic']})", 11, $options);




  $options = array('aleft'=>25*$mm,
                 'aright' => 595.28-35*$mm,
                 'justification' => 'full');
  $pdf->ezText("\nIk geef hierbij aan dat ik het E-zorgplan zorgvuldig zal gebruiken met respect voor de patiëntgegevens. Dit houdt o.a. in:",11, $options);
  $options = array('aleft'=>25*$mm,
                 'aright' => 595.28-35*$mm,
                 'justification' => 'full');
  $pdf->ezText("  - Mijn paswoord is strikt persoonlijk en geheim.",11, $options);
  $pdf->ezText("  - Ik zal mijn login en paswoord zorgvuldig beheren en niet doorgeven aan anderen.",11, $options);
  $pdf->ezText("  - Ik kies geen paswoord dat gemakkelijk te achterhalen is.",11, $options);
  $pdf->ezText("  - Ik ben persoonlijk verantwoordelijk voor de onder mijn paswoord gedane acties. ",11, $options);
  $pdf->ezText("  - Ik log uit vooraleer ik mijn arbeidsplaats verlaat.",11, $options);
  $pdf->ezText("  - Ik weet dat ik verantwoordelijk ben voor eventueel misbruik van mijn login.",11, $options);
  $pdf->ezText("  - Patiëntgegevens behandel ik met de nodige discretie, met inachtneming van het \n    beroepsgeheim (art. 458 SWB), de wet op de patiëntenrechten en de wet\n    op de privacy.",11, $options);
  $pdf->ezText("  - Ik signaleer onmiddellijk aan de coördinatoren van LISTEL als ik niet langer\n    betrokken ben als zorg- of hulpverlener in het e-zorgplan van de patiënt/cliënt. ",11, $options);
  $options = array('aleft'=>25*$mm,
                 'aright' => 595.28-35*$mm,
                 'justification' => 'full');
  $pdf->ezText("\nIk stuur deze brief op naar bovenstaand adres, en zal via LISTEL vzw op mijn emailadres bericht ontvangen over de activatie van mijn login.\n\n",11, $options);

  $pdf->ezText("\n\nGedaan te ................................ op  ...../...../..........\n\n",11, $options);
  $pdf->ezText("\n\n\nNaam en handtekening:\n\n",11, $options);

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