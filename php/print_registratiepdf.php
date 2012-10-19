<?php

session_start();





   require("../includes/dbconnect2.inc");












//if (isset($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan"))
{


    $datum = date("d/m/Y");

    if ($_GET['tabel'] == "hulpverleners") {
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
					g.dlzip,
					f.naam AS fnaam,
                    fg.naam AS fgnaam,
					fg.id AS fgid
                FROM
                    functies f,
                    functiegroepen fg,
                    gemeente g,
                    hulpverleners h left join organisatie on (organisatie.id = organisatie)
                                    left join gemeente gem2 on organisatie.gem_id = gem2.id
                WHERE
                    g.id = h.gem_id AND
                    f.id=h.fnct_id AND
                    fg.id=f.groep_id AND
                    h.id=".$_GET['id'];
     }
     else {
       $query = "select persoon.*, g.dlzip, g.dlnaam from {$_GET['tabel']} persoon left join gemeente g
                    on persoon.gem_id = g.id
                 where persoon.id = {$_GET['id']}";
     }

     $result = mysql_query($query) or die($query . "<br/>" . mysql_error());
     if (mysql_num_rows($result)<>0 ){
       $persoon= mysql_fetch_array($result);
       foreach ($persoon as $key => $value) {
         $persoon[$key] = utf8_decode($persoon[$key]);
       }
     }
     else{
       print("Geen record gevonden");
		   //print(mysql_error());
     }





$mm = 595.28/210;

include('../ezpdf/class.ezpdf.php');



$pdf =& new Cezpdf('A4');

//$pdf->ezSetMargins(0,0,0,0);

$pdf->selectFont('../ezpdf/fonts/Helvetica.afm');




  $pdf->ezImage("../images/logoke.jpg", 30, 100, "none", "left");
  $pdf->ezSetY(297*$mm-30*$mm);

  $options = array('aleft'=>100*$mm,
                 'aright' => 595.28-35*$mm,
                 'justification' => 'left');

  $pdf->ezText("LISTEL vzw \nA. Rodenbachstraat 29 bus 1\n3500 Hasselt", 11, $options);
  
  
  $pdf->ezSetY(297*$mm-60*$mm);

  $options = array('aleft'=>25*$mm,
                 'aright' => 595.28-35*$mm,
                 'justification' => 'left');

  $pdf->ezText("Betreft: aanvraag login voor het e-zorgplan", 11, $options);


  $options = array('aleft'=>25*$mm,
                 'aright' => 595.28-35*$mm,
                 'justification' => 'full');

  $pdf->ezSetY(297*$mm-80*$mm);
  $pdf->ezText("Beste,\n\nmet deze brief vraag ik, {$persoon['naam']} {$persoon['voornaam']}, een login voor het e-zorgplan op https://www.listel.be.\n", 11, $options);
  
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



$pdf->ezStream();



      require("../includes/dbclose.inc");

      }



//---------------------------------------------------------

/* //Geen Toegang */ require("../includes/check_access.inc");

//---------------------------------------------------------



//---------------------------------------------------------

/* Sluit Dbconnectie */ require("../includes/dbclose.inc");

//---------------------------------------------------------

?>