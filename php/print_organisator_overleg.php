<?php

session_start();





   require("../includes/dbconnect2.inc");

if (isset($_GET['aanvraag'])) {
  $aanvraagNr = $_GET['aanvraag'];
}
else {
  $aanvraagNr = $_POST['aanvraag'];
}
   $aanvraag = getUniqueRecord("select * from aanvraag_overleg where id = $aanvraagNr");

   if (isset($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan"))
   {



//die($qryPartners);
//mainblock

$mm = 595.28/210;
include('../ezpdf/class.ezpdf.php');

$pdf =& new Cezpdf('A4');
//$pdf->ezSetMargins(0,0,0,0);

//$pdf->selectFont('../ezpdf/fonts/php_Calibri.afm');
  $pdf->selectFont('../ezpdf/fonts/calibri_all/calibri.ttf');


  $pdf->ezSetY(297*$mm-7*$mm);
  $pdf->ezImage("../images/SelG.jpg", 30, 100, "none", "left");
  $pdf->ezSetY(297*$mm+0*$mm);
  $pdf->ezImage("../images/SelH.jpg", 50, 100, "none", "right");

  $pdf->ezSetY(297*$mm-42*$mm);
  $options = array('aleft'=>25*$mm,
                 'aright' => 595.28-35*$mm,
                 'justification' => 'left');
  $pdf->ezText("Verklaring organisator multidisciplinair overleg",15,$options);
  $pdf->line(25*$mm, 297*$mm-44*$mm, 133*$mm, 297*$mm-44*$mm);

  $pdf->ezSetY(297*$mm-55*$mm);
  $options = array('aleft'=>25*$mm,
                 'aright' => 595.28-35*$mm,
                 'justification' => 'left');
  if ($aanvraag['doel']=="opvolgoverleg (default)") {
    $pdf->ezText("Identificatie aanvrager binnen het opvolgteam",12,$options);
    $pdf->line(25*$mm, 297*$mm-56.5*$mm, 111*$mm, 297*$mm-56.5*$mm);
  }
  else {
    $pdf->ezText("Identificatie aanvrager",12,$options);
    $pdf->line(25*$mm, 297*$mm-56.5*$mm, 67*$mm, 297*$mm-56.5*$mm);
  }

  $pdf->ezSetY(297*$mm-62*$mm);
  $pdf->ezText("{$aanvraag['naam_aanvrager']} - {$aanvraag['discipline_aanvrager']}",12,$options);
  $pdf->ezSetDy(-15);
  $pdf->ezText("{$aanvraag['organisatie_aanvrager']}",12,$options);

// ONTVANGER VAN DE AANVRAAG
//Identificatie van de ontvanger van de aanvraag
//Naam: 	………………………………………………	Discipline : OCTGZ ………………………………………………
//Tel:	………………………………………………	Organisatie: ……………………………..…………………………
//E-mail: …………………………………………………………………………………………………………………………..……
  $pdf->ezSetY(297*$mm-78*$mm);
  $pdf->ezText("Identificatie van de ontvanger van de aanvraag", 12, $options);
  $pdf->line(25*$mm, 297*$mm-79.5*$mm, 113*$mm, 297*$mm-79.5*$mm);
  $pdf->ezSetDy(-15);

if ($aanvraag['bron']==0) {
  switch ($aanvraag['keuze_organisator']) {
    case 'ocmw':
       $soortOrganisator = "OCTGZ OCMW";
       if ($aanvraag['id_organisator_user']==0) {
         $persoon = getFirstRecord("select logins.*, org.naam as orgnaam,
                                         org.tel as orgtel, org.email_inhoudelijk as orgemail
                                  from logins inner join gemeente on ({$aanvraag['gemeente_id']} = gemeente.id and zip= overleg_gemeente  and logins.actief = 1 and logins.naam not like '%help%')
                                              inner join organisatie org on logins.organisatie = org.id
                                              ");
       }
       else {
         $persoon = getFirstRecord("select logins.*, org.naam as orgnaam,
                                         org.tel as orgtel, org.email_inhoudelijk as orgemail
                                  from logins inner join organisatie org on logins.organisatie = org.id and {$aanvraag['id_organisator_user']} = logins.id
                                              ");
       }
       break;
    case 'rdc':
       $soortOrganisator = "OCTGZ RDC";
       if ($aanvraag['id_organisator_user']==0) {
         $persoon = getFirstRecord("select logins.*, org.naam as orgnaam,
                                         org.tel as orgtel, org.email_inhoudelijk as orgemail
                                   from logins inner join organisatie org on logins.organisatie = org.id where logins.id = {$_SESSION['usersid']}");
       }
       else {
         $persoon = getFirstRecord("select logins.*, org.naam as orgnaam,
                                         org.tel as orgtel, org.email_inhoudelijk as orgemail
                                  from logins inner join organisatie org on logins.organisatie = org.id and {$aanvraag['id_organisator_user']} = logins.id
                                              ");
       }
       break;
    case 'hulp':
       $soortOrganisator = "OCTGZ Zorg-/hulpverlener";
       if ($aanvraag['id_organisator_user']==0) {
         $persoon = getFirstRecord("select hulpverleners.*, org.naam as orgnaam,
                                         org.tel as orgtel, org.email_inhoudelijk as orgemail
                                   from hulpverleners inner join organisatie org on hulpverleners.organisatie = org.id where hulpverleners.id = {$_SESSION['usersid']}");
       }
       else {
         $persoon = getFirstRecord("select hulpverleners.*, org.naam as orgnaam,
                                         org.tel as orgtel, org.email_inhoudelijk as orgemail
                                  from hulpverleners inner join organisatie org on hulpverleners.organisatie = org.id and {$aanvraag['id_organisator_user']} = hulpverleners.id
                                              ");
       }
       break;
  }
  $pdf->ezText("{$persoon['voornaam']} {$persoon['naam']} - $soortOrganisator",12,$options);
  if (strlen($persoon['orgnaam'])>0) {
    $pdf->ezSetDy(-15);
    $pdf->ezText("{$persoon['orgnaam']}",12,$options);
  }
  $pdf->ezSetDy(-15);
  if (strlen($persoon['tel'])>0)
    $tel = $persoon['tel'];
  else
    $tel = $persoon['orgtel'];
  if (strlen($persoon['email'])>0)
    $email = $persoon['email'];
  else
    $email = $persoon['orgemail'];

  $pdf->ezText("{$tel} {$email}",12,$options);
  if ($aanvraag['motivatie_organisator'] != "") {
    $pdf->ezSetDy(-15);
    $pdf->ezText("{$aanvraag['motivatie_organisator']}",12,$options);
  }
}
else {
  // gebruik de oorspronkelijke bron!!!
  // HIER HIER HIER
  $bron = getUniqueRecord("select * from aanvraag_overleg where id = {$aanvraag['bron']}");
  if ($bron['keuze_organisator']=="ocmw") {
    $pdf->ezText("OCMW van de woonplaats",12,$options);
  }
  else {
    $org = getUniqueRecord("select * from organisatie where id = {$bron['id_organisator']}");
    $pdf->ezText("{$bron['keuze_organisator']} : {$org['naam']}",12,$options);
    $pdf->ezSetDy(-15);
    $pdf->ezText("{$org['tel']} {$org['email_inhoudelijk']}",12,$options);
  }
  if ($bron['motivatie_organisator'] != "") {
    $pdf->ezSetDy(-15);
    $pdf->ezText("{$bron['motivatie_organisator']}",12,$options);
  }
//Reden van doorgeven aanvraag aan andere organisator overleg
//…………………………………………………………………………………………………………………………………....
  $pdf->ezSetY(297*$mm-110*$mm);
  $pdf->ezText("Reden van doorgeven aanvraag aan andere organisator overleg", 12, $options);
  $pdf->line(25*$mm, 297*$mm-111.5*$mm, 145*$mm, 297*$mm-111.5*$mm);
  $pdf->ezSetDy(-15);
  $pdf->ezText("{$bron['reden_status']}", 12, $options);
}

//Datum van ontvangst van de aanvraag bij de organisator (OC TGZ)
//……… / ……… / ………              of opvolgteam van          ……… / ……… / ………
  $pdf->ezSetY(297*$mm-134.4*$mm);
  $ontvangstDatum = date("d/m/Y", $aanvraag['timestamp']);
  if ($aanvraag['doel']=="opvolgoverleg (default)") {
    $ontvangst = "opvolgteam van $ontvangstDatum";
  }
  else {
    $ontvangst = "$ontvangstDatum";
  }
  $pdf->ezText("Datum van ontvangst van de aanvraag bij de organisator (OC TGZ): $ontvangst", 12, $options);
  $pdf->line(25*$mm, 297*$mm-135.9*$mm, 152*$mm, 297*$mm-135.9*$mm);

// DE UITEINDELIJKE ORGANISATOR
  $pdf->ezSetY(297*$mm-145*$mm);
  $pdf->ezText("Identificatie van de organisator", 12, $options);
  $pdf->line(25*$mm, 297*$mm-146.5*$mm, 83*$mm, 297*$mm-146.5*$mm);
  $pdf->ezSetDy(-15);
  switch ($aanvraag['keuze_organisator']) {
    case 'ocmw':
       $soortOrganisator = "OCTGZ OCMW";
       $persoon = getFirstRecord("select logins.*, org.naam as orgnaam, iban,
                                         org.tel as orgtel, org.email_inhoudelijk as orgemail
                                  from logins  inner join overleg on ({$aanvraag['overleg_id']} = overleg.id and logins.actief = 1 and logins.naam not like '%help%')
                                               inner join organisatie org on logins.organisatie = org.id where logins.id = overleg.coordinator_id");
       break;

    case 'rdc':
       $soortOrganisator = "OCTGZ RDC";
       if ($aanvraag['id_organisator_user']==0) {
         $persoon = getFirstRecord("select logins.*, org.naam as orgnaam,
                                         org.tel as orgtel, org.email_inhoudelijk as orgemail
                                   from logins inner join organisatie org on logins.organisatie = org.id where logins.id = {$_SESSION['usersid']}");
       }
       else {
         $persoon = getFirstRecord("select logins.*, org.naam as orgnaam,
                                         org.tel as orgtel, org.email_inhoudelijk as orgemail
                                  from logins inner join organisatie org on logins.organisatie = org.id and {$aanvraag['id_organisator_user']} = logins.id
                                              ");
       }
       break;
    case 'hulp':
       $soortOrganisator = "OCTGZ Zorg-/hulpverlener";
       if ($aanvraag['id_organisator_user']==0) {
         $persoon = getFirstRecord("select hulpverleners.*, org.naam as orgnaam, hulpverleners.iban as iban_hvl, org.iban,
                                         org.tel as orgtel, org.email_inhoudelijk as orgemail
                                   from hulpverleners inner join organisatie org on hulpverleners.organisatie = org.id where hulpverleners.id = {$_SESSION['usersid']}");
       }
       else {
         $persoon = getFirstRecord("select hulpverleners.*, org.naam as orgnaam, hulpverleners.iban as iban_hvl, org.iban,
                                         org.tel as orgtel, org.email_inhoudelijk as orgemail
                                  from hulpverleners inner join organisatie org on hulpverleners.organisatie = org.id and {$aanvraag['id_organisator_user']} = hulpverleners.id
                                              ");
       }
       //altid rekeningnummer van organisatie. Anders: if ($persoon['iban_hvl'] != "") $persoon['iban'] = $persoon['iban_hvl'];
       break;
  }

  $pdf->ezText("{$persoon['voornaam']} {$persoon['naam']} - $soortOrganisator",12,$options);
  if (strlen($persoon['orgnaam'])>0) {
    $pdf->ezSetDy(-15);
    $pdf->ezText("{$persoon['orgnaam']}",12,$options);
  }
  $pdf->ezSetDy(-15);
  if (strlen($persoon['tel'])>0)
    $tel = $persoon['tel'];
  else
    $tel = $persoon['orgtel'];
  if (strlen($persoon['email'])>0)
    $email = $persoon['email'];
  else
    $email = $persoon['orgemail'];

  $pdf->ezText("{$tel} {$email}",12,$options);
// DE UITEINDELIJKE ORGANISATOR


// overleg-gegevens
  $overleg = getUniqueRecord("select p.*, o.*, p.type as patient_type, m.naam as mutualiteit from
                                overleg o inner join patient p on (o.patient_code = p.code and o.id = {$aanvraag['overleg_id']})
                                          inner join verzekering m on p.mut_id = m.id");
  //print_r($overleg);die();
  $mooieDatum = substr($overleg['datum'],6,2) . "/" . substr($overleg['datum'],4,2) . "/" . substr($overleg['datum'],0,4);
  $pdf->ezSetY(297*$mm-171*$mm);
  $pdf->ezText("Datum van het overleg: $mooieDatum", 12, $options);
  $pdf->line(25*$mm, 297*$mm-172.5*$mm, 68*$mm, 297*$mm-172.5*$mm);

  $pdf->ezSetY(297*$mm-181*$mm);
  $pdf->ezText("Doel van het overleg", 12, $options);
  $pdf->line(25*$mm, 297*$mm-182.5*$mm, 64*$mm, 297*$mm-182.5*$mm);
  $pdf->ezSetDy(-15);

      $doel = "";
      if ($aanvraag['doel_informeren']==1) {
        if ($doel != "") $doel .= ", informeren";
        else $doel = "informeren";
      }
      if ($aanvraag['doel_overtuigen']==1) {
        if ($doel != "") $doel .= ", overtuigen";
        else $doel = "overtuigen";
      }
      if ($aanvraag['doel_organiseren']==1) {
        if ($doel != "") $doel .= ", organiseren";
        else $doel = "organiseren";
      }
      if ($aanvraag['doel_debriefen']==1) {
        if ($doel != "") $doel .= ", debriefen";
        else $doel = "debriefen";
      }
      if ($aanvraag['doel_beslissen']==1) {
        if ($doel != "") $doel .= ", beslissen";
        else $doel = "beslissen";
      }
      if ($aanvraag['doel_andere']!="") {
        if ($doel != "") $doel .= ", {$aanvraagRecord['doel_andere']}";
        else $doel = "{$aanvraagRecord['doel_andere']}";
      }

  $pdf->ezText($doel, 12, $options);
  
  $pdf->ezSetY(297*$mm-202*$mm);
  if ($overleg['omb_actief']==1) $omb = " met (vermoeden van) OMB";
  switch ($overleg['patient_type']) {
    case 1:
      $type = "PVS-patient";
      break;
    case 3:
      $type = "Patient verminderde psychische zelfredzaamheid met psychiatrische problematiek";
      break;
    case 7:
      $type = "Patient verminderde psychische zelfredzaamheid";
      break;
    case 4:
      $type = "Menos-patient";
      break;
    case 0:
      if ($overleg['menos']==0)
        $type = "GDT";
      else
        $type = "Menos-patient";
      break;
    default:
      $type = "Patient verminderde fysische zelfredzaamheid";
      break;
  }
  $pdf->ezText("Type patient/overleg: $type $omb", 12, $options);
  $pdf->line(25*$mm, 297*$mm-203.5*$mm, 63*$mm, 297*$mm-203.5*$mm);

  $pdf->ezSetY(297*$mm-212*$mm);
  if ($overleg['locatieTekst']!="") {
    $locatie = $overleg['locatieTekst'];
  }
  else {
    switch ($overleg['locatie']) {
     case 0:
      $locatie = "Bij de patient thuis";
      break;
     case 2:
      $locatie = "In een deskundig ziekenhuiscentrum";
      break;
     default:
      $locatie = "Elders";
      break;
    }
  }
  $pdf->ezText("Plaats van het overleg: $locatie", 12, $options);
  $pdf->line(25*$mm, 297*$mm-213.5*$mm, 67*$mm, 297*$mm-213.5*$mm);

  $pdf->line(20*$mm, 297*$mm-217*$mm, 190*$mm, 297*$mm-217*$mm);

  $pdf->ezSetDy(-35);
  $pdf->ezText("Ik, ondergetekende, {$persoon['naam']} {$persoon['voornaam']} verklaar hierbij dat ik voor de patient", 12, $options);
  $pdf->ezSetDy(-15);
  $pdf->ezText("{$overleg['naam']} {$overleg['voornaam']} op $mooieDatum een multidisciplinair teamoverleg organiseerde", 12, $options);
  $pdf->ezSetDy(-15);
  $pdf->ezText("waarbij ik mij gehouden heb aan de principes zoals geformuleerd in de Limburgse Code.", 12, $options);
  $pdf->ezSetDy(-25);
  $pdf->ezText("Organisatie: {$persoon['orgnaam']}", 12, $options);
  $pdf->ezSetDy(-15);
  $pdf->ezText("Bankrekening: {$persoon['iban']}", 12, $options);

  $pdf->ezSetDy(-35);
  $pdf->ezText("Datum : . . . . . . . . . .         Handtekening : . . . . . . . . . .", 12, $options);


  $pdf->ezSetY(15*$mm);
  $options = array('aleft'=>25*$mm,
                 'aright' => 595.28-35*$mm,
                 'justification' => 'justify');
  $pdf->ezText("Op te sturen naar: LISTEL vzw, A. Rodenbachstraat 29/1 - 3500 Hasselt", 12, $options);





$pdf->ezStream();

}



//---------------------------------------------------------

/* Geen Toegang */ require("../includes/check_access.inc");

//---------------------------------------------------------



//---------------------------------------------------------

/* Sluit Dbconnectie */ require("../includes/dbclose.inc");

//---------------------------------------------------------

?>