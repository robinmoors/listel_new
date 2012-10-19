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

$pdf =& new Cezpdf('A4', 'landscape');
$pdf->selectFont('../ezpdf/fonts/Droid-Sans/DroidSans.afm');

  $deelvzw = $persoon['deelvzw'];
  $pdf->ezImage("../images/Sel{$deelvzw}.jpg", 30, 200, "none", "left");


//  $pdf->ezSetY(297*$mm-12*$mm);
  $pdf->ezSetY(210*$mm-12*$mm);
  $options = array('aleft'=>110*$mm,
                 'aright' => 297*$mm-12*$mm,  // was 595.28
                 'justification' => 'left');
  $pdf->ezText("<u>BIJLAGE 1 (deel 2)</u>", 11, $options);
  $pdf->selectFont('../ezpdf/fonts/Droid-Sans/DroidSans-Bold.afm');
  $pdf->ezText("VERKLARING ORGANISATOR", 11, $options);
  $pdf->selectFont('../ezpdf/fonts/Droid-Sans/DroidSans.afm');
  $pdf->ezText("bedoeld voor de volgende geïntegreerde dienst voor thuisverzorging: ", 11, $options);
  $pdf->selectFont('../ezpdf/fonts/Droid-Sans/DroidSans-Bold.afm');
  $pdf->ezText("SEL/GDT HASSELT 947-046-62-001", 11, $options);
  $pdf->selectFont('../ezpdf/fonts/Droid-Sans/DroidSans.afm');
  $overlegDatum = mooieDatum($overleg['datum']);
  $pdf->ezText("Datum overleg: $overlegDatum", 11, $options);



  $options = array('aleft'=>12*$mm,
                 'aright' => 297*$mm-12*$mm, // was 595.28
                 'justification' => 'left');

  $options1 = array('aleft'=>24*$mm,
                 'aright' => 297*$mm-12*$mm,  // idem
                 'justification' => 'left');
  $options2 = array('aleft'=>60*$mm,
                 'aright' => 297*$mm-12*$mm,   //idem
                 'justification' => 'left');

  $pdf->ezSetY(210*$mm-60*$mm);     // was 297
  $pdf->ezText("Het bijgevoegd  begeleidingsplan is opgemaakt in het kader van het overleg rond personen met een psychiatrische problematiek. ",10,$options);


  $pdf->ezSetDy(-5*$mm);
  $pdf->ezText("<u>1. Identificatiegegevens van de patiënt</u>", 10, $options);
  $pdf->ezText("Naam en voornaam: {$persoon['naam']} {$persoon['voornaam']}", 10, $options);
  $pdf->ezText("Adres: {$persoon['adres']} - {$persoon['dlzip']} {$persoon['dlnaam']}", 10, $options);
  $gebdatum = mooieDatum($persoon['gebdatum']);
  $pdf->ezText("Geboortedatum: $gebdatum", 10, $options);
  $pdf->ezText("Inschrijvingsnummer VI: {$persoon['mutnr']}", 10, $options);

  $pdf->ezSetDy(-5*$mm);
  $pdf->ezText("<u>2. Deelnemers aan het multidisciplinair overleg</u>\n", 10, $options);


    $qryCrisis ="select * from psy_crisis where overleg_id = {$_POST['id']} order by id desc";
    $crisisResult = mysql_query($qryCrisis) or die("kan het crisisplan van dit overleg niet ophalen");
    if (mysql_num_rows($crisisResult)>0) {
      $crisis = mysql_fetch_assoc($crisisResult);
      foreach ($crisis as $key => $value) {
        $crisis[$key] = pdfaccenten($crisis[$key]);
      }
    }

    if ($_POST['tabel']=="huidige") {
      $tabel1 = (tabelDeelnemers(getQueryHVLHuidig($_SESSION['pat_code'],-1,1),$overleg['contact_hvl'],"{$persoon['naam']} {$persoon['voornaam']}",getQueryMZHuidig($_SESSION['pat_code'],-1)));
// komt van tabelCrisisPlan maar extra laatste parameter, nl. de MZ
    }
    else {
      $tabel1 = (tabelDeelnemers(getQueryHVLAfgerond($_POST['id'],-1,1),$overleg['contact_hvl'],"{$persoon['naam']} {$persoon['voornaam']}",getQueryMZAfgerond($_POST['id'],-1)));
    }
    
  $pdf->ezTable($tabel1);
  
  $pdf->ezText("Een duplicaat van dit begeleidingsplan  wordt administratief bewaard volgens de wet dd. 08/12/92 op de bescherming van de persoonlijke levenssfeer t.o.v. de verwerking van persoonsgegevens. U hebt inzage in de gegevens die betrekking hebben op uw persoon, en kan ze steeds laten verbeteren. De door u verstrekte gegevens zullen door LISTEL vzw met zetel te 3500 Hasselt, A. Rodenbachstraat 29/1, worden verwerkt. Zij zullen uitsluitend worden gebruikt voor administratieve afhandeling van het begeleidingsplan  en desgevallend voor facturatie van multidisciplinair overleg.\nU tekent voor toestemming om de op de elektronische en/of papieren invulformulier  vermelde persoonsgegevens, op het beveiligde gedeelte van de website van LISTEL vzw te plaatsen.Deze elektronische/papieren formulieren zijn: begeleidingsplan, crisisplan, verklaring huisarts en verklaring organisator.\nOndergetekende patiënt/vertegenwoordiger heeft kennis genomen van dit zorgplan en geeft toestemming aan LISTEL vzw om de door hem/haar verstrekte gegevens te verwerken voor bovenvermelde doeleinden.", 10, $options);


  $pdf->ezSetDy(-5*$mm);
  if ($overleg['locatie']==0) $plaats = "bij de patiënt/cliënt thuis";
  else $plaats = "elders";
  $pdf->ezText("Het overleg vond <b>plaats</b>: $plaats", 10, $options);

//  $pdf->ezSetDy(-5*$mm);
//  $pdf->ezText("Duurtijd van het overleg: . . . . . .", 10, $options);

  $pdf->ezSetDy(-5*$mm);
//  $pdf->ezText("Opvolging:    O Geen overleg", 10, $options);
//  $volgendeDatum = mooieDatum($overleg['volgende_datum']);
//  $pdf->ezText("                      O Datum volgende overleg $volgendeDatum\n", 10, $options);

  $volgendeDatum = mooieDatum($overleg['volgende_datum']);
  $pdf->ezText("Opvolging: datum <b>volgende overleg</b> $volgendeDatum\n", 10, $options);

  $pdf->setStrokeColor(0,0,0);

  $aanvraag = getFirstRecord("select * from aanvraag_overleg where overleg_id = {$_POST['id']}");
      foreach ($aanvraag as $key => $value) {
        $aanvraag[$key] = pdfaccenten($aanvraag[$key]);
      }

  $pdf->ezSetDy(-5*$mm);
  $pdf->ezText("<u>3. Identificatie aanvrager multidisciplinair overleg</u>", 10, $options);
  $pdf->ezText("Naam: {$aanvraag['naam_aanvrager']}", 10, $options);

  $aanvraag['organisatie_aanvrager'] = str_replace("Ã«","ë", $aanvraag['organisatie_aanvrager']);
  $aanvraag['discipline_aanvrager'] = str_replace("Ã«","ë", $aanvraag['discipline_aanvrager']);

  $pdf->ezText("Organisatie/discipline: {$aanvraag['organisatie_aanvrager']}/{$aanvraag['discipline_aanvrager']}", 10, $options);
  $datumAanvraag = date("d/m/Y", $aanvraag['timestamp']);
  $pdf->ezText("Datum aanvraag: $datumAanvraag", 10, $options);

  switch ($aanvraag['keuze_organisator']) {
    case 'ocmw':
       $soortOrganisator = "OCTGZ OCMW";
       $orgpersoon = getFirstRecord("select logins.*, org.naam as orgnaam, iban,
                                         org.tel as orgtel, org.email_inhoudelijk as orgemail
                                  from logins  inner join overleg on ({$aanvraag['overleg_id']} = overleg.id and logins.actief = 1 and logins.naam not like '%help%')
                                               inner join organisatie org on logins.organisatie = org.id where logins.id = overleg.coordinator_id");
       break;

    case 'rdc':
       $soortOrganisator = "OCTGZ RDC";
       if ($aanvraag['id_organisator_user']==0) {
         $orgpersoon = getFirstRecord("select logins.*, org.naam as orgnaam,
                                         org.tel as orgtel, org.email_inhoudelijk as orgemail
                                   from logins inner join organisatie org on logins.organisatie = org.id where logins.id = {$_SESSION['usersid']}");
       }
       else {
         $orgpersoon = getFirstRecord("select logins.*, org.naam as orgnaam,
                                         org.tel as orgtel, org.email_inhoudelijk as orgemail
                                  from logins inner join organisatie org on logins.organisatie = org.id and {$aanvraag['id_organisator_user']} = logins.id
                                              ");
       }
       break;
    case 'hulp':
       $soortOrganisator = "OCTGZ Zorg-/hulpverlener";
       if ($aanvraag['id_organisator_user']==0) {
         $orgpersoon = getFirstRecord("select hulpverleners.*, org.naam as orgnaam, hulpverleners.iban as iban_hvl, org.iban,
                                         org.tel as orgtel, org.email_inhoudelijk as orgemail
                                   from hulpverleners inner join organisatie org on hulpverleners.organisatie = org.id where hulpverleners.id = {$_SESSION['usersid']}");
       }
       else {
         $orgpersoon = getFirstRecord("select hulpverleners.*, org.naam as orgnaam, hulpverleners.iban as iban_hvl, org.iban,
                                         org.tel as orgtel, org.email_inhoudelijk as orgemail
                                  from hulpverleners inner join organisatie org on hulpverleners.organisatie = org.id and {$aanvraag['id_organisator_user']} = hulpverleners.id
                                              ");
       }
       //altid rekeningnummer van organisatie. Anders: if ($persoon['iban_hvl'] != "") $persoon['iban'] = $persoon['iban_hvl'];
       break;
  }
// DE UITEINDELIJKE ORGANISATOR
      foreach ($orgpersoon as $key => $value) {
        $orgpersoon[$key] = pdfaccenten($orgpersoon[$key]);
      }



  $pdf->ezSetDy(-5*$mm);
  $pdf->ezText("<u>4. Identificatie organisator multidisciplinair overleg</u>", 10, $options);
  $pdf->ezText("Naam en voornaam: {$orgpersoon['voornaam']} {$orgpersoon['naam']}", 10, $options);
  $pdf->ezText("Organisatie: {$orgpersoon['orgnaam']}", 10, $options);
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