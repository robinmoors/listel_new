<?php
ob_start();
session_start();



/*********************************************

           rizivtarieven

           thuis        elders                registratie

gewoon     773172       773216                773290

PVS        776532       776554                776576



           niet-        wel-

           ziekenhuis   ziekenhuis            niet-ZH   wel-ZH

TP         427350       427361                427372     427383



**********************************************/



function getFactuurInfoVanCreditNota($maand, $jaar, $factuurID, $genre) {

  global $_TP_FOR_K;

  /********* eerst het factuurnummer zoeken al dan niet ophalen ********/

  $zoekFactuurQry = "select * from factuurmaand where genre = '$genre'

                     and id = $factuurID";

  $zoekFactuur = mysql_query($zoekFactuurQry) or die($zoekFactuurQry . "<br/>" . mysql_error());

  if (mysql_num_rows($zoekFactuur) == 0) {

    // die factuur bestaat niet. Dit is een fout

    print("Deze factuur bestaat niet!");

  }

  else {

    // factuur is gevonden.

    // eerst zoeken welke overleggen er NU zijn voor TP_FOR_K
    if ($genre == "ForK-H") {
      $joinGemeente = " inner join gemeente on patient.gem_id = gemeente.id ";
      $vwGemeente = " and deelvzw = 'H' ";
    }
    else if ($genre == "ForK-G") {
      $joinGemeente = " inner join gemeente on patient.gem_id = gemeente.id ";
      $vwGemeente = " and deelvzw = 'G' ";
    }
    else {
      $joinGemeente = $vwGemeente = "";
    }

    $zoekFactuurOverleggen =  "select overleg.id from overleg, patient $joinGemeente, patient_tp

                               where overleg.patient_code = patient.code

                               and factuur_code = '$factuurID'

                               and patient.code = patient_tp.patient

                               and (patient_tp.project = $_TP_FOR_K)
                               $vwGemeente";



    $resultFactuurOverleggen = mysql_query($zoekFactuurOverleggen) or die($zoekFactuurOverleggen . "<br/>" . mysql_error());

    if (mysql_num_rows($resultFactuurOverleggen) == 0)

      return 0; // geen te facturen overleggen voor deze mutualiteit, dus geen factuur maken


    // creditnota's moeten in het voorgaande jaar blijven!
    $oudeFactuur = mysql_fetch_assoc($zoekFactuur);
    if ($jaar > $oudeFactuur['jaar']) $jaar = $oudeFactuur['jaar'];


    // er bestaan overleggen voor deze mutualiteit en dus maken we een factuurnummer aan

    $zoekFactuurQry = "select max(nummer) as maxnr from factuurmaand where genre = '$genre' and jaar = $jaar";

    $zoekFactuur = mysql_query($zoekFactuurQry) or die($zoekFactuurQry . "<br/>" . mysql_error());



    if ($jaar < date("Y")) {

      $factuurInfo['datum'] = "31/12/$jaar";

    }

    else {

      $factuurInfo['datum'] = date("d/m/Y");

    }



    if (mysql_num_rows($zoekFactuur) > 0) {

      // er is dit jaar al een factuur geweest, dus nummer verhogen

      $zoekFactuurRij = mysql_fetch_assoc($zoekFactuur);

      $factuurInfo['nr'] = $zoekFactuurRij['maxnr']+1;

    }

    else {

      // eerste factuur van dit jaar

      $factuurInfo['nr'] = 1;

    }

    // Factuurnummer wegschrijven

    $insertFactuurmaandQry = "insert into factuurmaand (genre, maand, jaar, nummer, factuurdatum, mutualiteit, vervangt)

                              values ('$genre', $maand, $jaar,{$factuurInfo['nr']}, \"{$factuurInfo['datum']}\", -1, $factuurID)";

    mysql_query($insertFactuurmaandQry) or die(mysql_error . "<br/>$insertFactuurmaandQry");

    $factuurInfo['id'] = mysql_insert_id();



    for ($ff = 0; $ff < mysql_num_rows($resultFactuurOverleggen); $ff++) {

      $factuurOverleg = mysql_fetch_assoc($resultFactuurOverleggen);

      foreach ($factuurOverleg as $key => $value) {

        $factuurOverleg[$key] = utf8_decode($factuurOverleg[$key]);

      }

      $insertFactuurOverleg = "update overleg

                               set factuur_code = '{$factuurInfo['id']}',

                                   factuur_datum = 'via factuurid-2-'

                               where id = {$factuurOverleg['id']}";

      mysql_query($insertFactuurOverleg) or die(mysql_error . "<br/>$insertFactuurOverleg");

    }

  }

  return $factuurInfo;

}



function getFactuurInfo($maand, $jaar, $genre) {

  global $_TP_FOR_K;

  /********* eerst het factuurnummer zoeken al dan niet ophalen ********/

  $zoekFactuurQry = "select * from factuurmaand where genre = '$genre'

                     and maand = $maand and jaar = $jaar

                     and mutualiteit = -1"; // mutualiteit = -1 ==> FOD

  $zoekFactuur = mysql_query($zoekFactuurQry) or die($zoekFactuurQry . "<br/>" . mysql_error());

  if (mysql_num_rows($zoekFactuur) > 0) {

    // factuur is al gemaakt geweest , dus gewoon id ophalen

    $zoekFactuurRij = mysql_fetch_assoc($zoekFactuur);

    foreach ($zoekFactuurRij as $key => $value) {

      $zoekFactuurRij[$key] = utf8_decode($zoekFactuurRij[$key]);

    }

    $factuurInfo = $zoekFactuurRij;

    $factuurInfo['id'] = $zoekFactuurRij['id'];

    $factuurInfo['datum'] = $zoekFactuurRij['factuurdatum'];

    $factuurInfo['nr'] = $zoekFactuurRij['nummer'];

  }

  else {
    // factuur is  nog niet gemaakt.
    // eerst kijken of er wel overleggen zijn voor TP_FOR_K voor de FOD
    if ($genre == "ForK-H") {
      $joinGemeente = " inner join gemeente on patient.gem_id = gemeente.id ";
      $vwGemeente = " and deelvzw = 'H' ";
    }
    else if ($genre == "ForK-G") {
      $joinGemeente = " inner join gemeente on patient.gem_id = gemeente.id ";
      $vwGemeente = " and deelvzw = 'G' ";
    }
    else {
      $joinGemeente = $vwGemeente = "";
    }
    $zoekFactuurOverleggen =  "select overleg.id from overleg, patient $joinGemeente, patient_tp

                               where overleg.patient_code = patient.code

                               and overleg.datum LIKE '$jaar%'

                               and ((factuur_datum is NULL or factuur_datum = '') and genre = 'TP' and keuze_vergoeding = 1 and controle = 1)

                               and patient.code = patient_tp.patient

                               and (patient_tp.project = $_TP_FOR_K)
                               $vwGemeente";



    $resultFactuurOverleggen = mysql_query($zoekFactuurOverleggen) or die($zoekFactuurOverleggen . "<br/>" . mysql_error());

    if (mysql_num_rows($resultFactuurOverleggen) == 0)

      return 0; // geen te facturen overleggen voor deze mutualiteit, dus geen factuur maken



    // er bestaan overleggen voor TP_FOR_K en dus maken we een factuurnummer aan

    $zoekFactuurQry = "select max(nummer) as maxnr from factuurmaand where genre = '$genre' and jaar = $jaar";

    $zoekFactuur = mysql_query($zoekFactuurQry) or die($zoekFactuurQry . "<br/>" . mysql_error());



    if ($jaar < date("Y")) {

      $factuurInfo['datum'] = "31/12/$jaar";

    }

    else {

      $factuurInfo['datum'] = date("d/m/Y");

    }



    if (mysql_num_rows($zoekFactuur) > 0) {

      // er is dit jaar al een factuur geweest, dus nummer verhogen

      $zoekFactuurRij = mysql_fetch_assoc($zoekFactuur);

      $factuurInfo['nr'] = $zoekFactuurRij['maxnr']+1;

    }

    else {

      // eerste factuur van dit jaar

      $factuurInfo['nr'] = 1;

    }

    // Factuurnummer wegschrijven

    $insertFactuurmaandQry = "insert into factuurmaand (genre, maand, jaar, nummer, factuurdatum, mutualiteit)

                              values ('$genre', $maand, $jaar,{$factuurInfo['nr']}, \"{$factuurInfo['datum']}\", -1)";

    mysql_query($insertFactuurmaandQry) or die(mysql_error . "<br/>$insertFactuurmaandQry");

    $factuurInfo['id'] = mysql_insert_id();



    for ($ff = 0; $ff < mysql_num_rows($resultFactuurOverleggen); $ff++) {

      $factuurOverleg = mysql_fetch_assoc($resultFactuurOverleggen);

      foreach ($factuurOverleg as $key => $value) {

        $factuurOverleg[$key] = utf8_decode($factuurOverleg[$key]);

      }

      $insertFactuurOverleg = "update overleg

                               set factuur_code = '{$factuurInfo['id']}',

                                   factuur_datum = 'via factuurid'

                               where id = {$factuurOverleg['id']}";

      mysql_query($insertFactuurOverleg) or die(mysql_error . "<br/>$insertFactuurOverleg");

    }

  }

  return $factuurInfo;

}

function getFactuurInfoViaNummer($nummer, $genre) {

  global $_TP_FOR_K;

  /********* eerst het factuurnummer zoeken al dan niet ophalen ********/

  $zoekFactuurQry = "select * from factuurmaand where id = $nummer

                     and mutualiteit = -1"; // mutualiteit = -1 ==> FOD

  $zoekFactuur = mysql_query($zoekFactuurQry) or die($zoekFactuurQry . "<br/>" . mysql_error());

  if (mysql_num_rows($zoekFactuur) > 0) {

    // factuur is al gemaakt geweest , dus gewoon id ophalen

    $zoekFactuurRij = mysql_fetch_assoc($zoekFactuur);

    foreach ($zoekFactuurRij as $key => $value) {

      $zoekFactuurRij[$key] = utf8_decode($zoekFactuurRij[$key]);

    }

    $factuurInfo = $zoekFactuurRij;

    $factuurInfo['id'] = $zoekFactuurRij['id'];

    $factuurInfo['datum'] = $zoekFactuurRij['factuurdatum'];

    $factuurInfo['nr'] = $zoekFactuurRij['nummer'];

  }

  else {

    // factuur is  nog niet gemaakt.

    // eerst kijken of er wel overleggen zijn voor TP_FOR_K voor de FOD
    if ($genre == "ForK-H") {
      $joinGemeente = " inner join gemeente on patient.gem_id = gemeente.id ";
      $vwGemeente = " and deelvzw = 'H' ";
    }
    else if ($genre == "ForK-G") {
      $joinGemeente = " inner join gemeente on patient.gem_id = gemeente.id ";
      $vwGemeente = " and deelvzw = 'G' ";
    }
    else {
      $joinGemeente = $vwGemeente = "";
    }

    $zoekFactuurOverleggen =  "select overleg.id from overleg, patient $joinGemeente, patient_tp

                               where overleg.patient_code = patient.code

                               and overleg.datum LIKE '$jaar%'

                               and ((factuur_datum is NULL or factuur_datum = '') and genre = 'TP' and keuze_vergoeding = 1 and controle = 1)

                               and patient.code = patient_tp.patient

                               and (patient_tp.project = $_TP_FOR_K)
                               $vwGemeente";



    $resultFactuurOverleggen = mysql_query($zoekFactuurOverleggen) or die($zoekFactuurOverleggen . "<br/>" . mysql_error());

    if (mysql_num_rows($resultFactuurOverleggen) == 0)

      return 0; // geen te facturen overleggen voor deze mutualiteit, dus geen factuur maken



    // er bestaan overleggen voor TP_FOR_K en dus maken we een factuurnummer aan

    $zoekFactuurQry = "select max(nummer) as maxnr from factuurmaand where genre = '$genre' and jaar = $jaar";

    $zoekFactuur = mysql_query($zoekFactuurQry) or die($zoekFactuurQry . "<br/>" . mysql_error());



    if ($jaar < date("Y")) {

      $factuurInfo['datum'] = "31/12/$jaar";

    }

    else {

      $factuurInfo['datum'] = date("d/m/Y");

    }



    if (mysql_num_rows($zoekFactuur) > 0) {

      // er is dit jaar al een factuur geweest, dus nummer verhogen

      $zoekFactuurRij = mysql_fetch_assoc($zoekFactuur);

      $factuurInfo['nr'] = $zoekFactuurRij['maxnr']+1;

    }

    else {

      // eerste factuur van dit jaar

      $factuurInfo['nr'] = 1;

    }

    // Factuurnummer wegschrijven

    $insertFactuurmaandQry = "insert into factuurmaand (genre, maand, jaar, nummer, factuurdatum, mutualiteit)

                              values ('$genre', $maand, $jaar,{$factuurInfo['nr']}, \"{$factuurInfo['datum']}\", -1)";

    mysql_query($insertFactuurmaandQry) or die(mysql_error . "<br/>$insertFactuurmaandQry");

    $factuurInfo['id'] = mysql_insert_id();



    for ($ff = 0; $ff < mysql_num_rows($resultFactuurOverleggen); $ff++) {

      $factuurOverleg = mysql_fetch_assoc($resultFactuurOverleggen);

      foreach ($factuurOverleg as $key => $value) {

        $factuurOverleg[$key] = utf8_decode($factuurOverleg[$key]);

      }

      $insertFactuurOverleg = "update overleg

                               set factuur_code = '{$factuurInfo['id']}',

                                   factuur_datum = 'via factuurid'

                               where id = {$factuurOverleg['id']}";

      mysql_query($insertFactuurOverleg) or die(mysql_error . "<br/>$insertFactuurOverleg");

    }

  }

  return $factuurInfo;

}



function printFOD($factuurInfo, $genre) {

  global $_TP_FOR_K;

  

  if ($factuurInfo['factuurFile'] != "" && $_GET['nieuwePDF']!=1) {

     print("<li><a href=\"../factuurForKdinges17/factuur_{$factuurInfo['factuurFile']}\">factuur {$factuurInfo['nummer']}/{$factuurInfo['jaar']}</a></li>");

     return;

  }



  global $mm, $factuurMaand, $factuurJaar;



  $pdf =& new Cezpdf('A4', 'portrait');

  $pdf2 =& new Cezpdf('A4', 'portrait');

  $pdf->selectFont('../ezpdf/fonts/Times-Roman.afm');

  $pdf2->selectFont('../ezpdf/fonts/Times-Roman.afm');





  $factuurID = $factuurInfo['id'];

  $factuurNr = $factuurInfo['nr'];

  $factuurDatum = $factuurInfo['datum'];






  if ($genre == "ForK") {
    $rizivListel = "9-47011-97-001";
    $titelListel = "GDT LISTEL vzw";
    $genreCode = "";
  }
  else if ($genre == "ForK-H") {
    $rizivListel = "947-046-62-001";
    $titelListel = "LISTEL vzw - SEL Hasselt";
    $genreCode = "H/";
  }
  else {
    $rizivListel = "947-047-61-001";
    $titelListel = "LISTEL vzw - SEL Genk";
    $genreCode = "G/";
  }

  $kenmerk = "GDT/$factuurMaand/$factuurJaar/{$genreCode}For-K";



  $pdf->ezSetY(297*$mm-15*$mm);

  $pdf2->ezSetY(297*$mm-15*$mm);



  $mutualiteitNr = $pdf->ezStartPageNumbers(275*$mm,15*$mm,10,'','p.{PAGENUM}/{TOTALPAGENUM}',1);

  $mutualiteitNr2 = $pdf2->ezStartPageNumbers(275*$mm,15*$mm,10,'','p.{PAGENUM}/{TOTALPAGENUM}',1);



  $options = array('aleft'=>22*$mm,

                 'aright' => (210-22)*$mm,

                 'justification' => 'center');

                 

//   $pdf->ezText("Terug te sturen naar de FOD Volksgezondheid, ter attentie van de Dienst Psychosociale Gezondheidszorg, op onderstaand adres :", 8, $options);

  $options = array('aleft'=>110*$mm,

                 'aright' => (210-22)*$mm,

                 'justification' => 'left');

/*

   $pdf->ezText("\n\nFOD Volksgezondheid", 11, $options); //, Veiligheid van de Voedselketen en Leefmilieu", 11, $options);

   $pdf->ezText("Directoraat-Generaal Org. Gezondheidszorgvoorzieningen", 11, $options);

   $pdf->ezText("Bestuursdirectie Gezondheidszorgbeleid", 11, $options);

   $pdf->ezText("T.a.v. de heer M. MOREELS", 11, $options);

   $pdf->ezText("Victor Hortaplein 40 bus 10", 11, $options);

   $pdf->ezText("bureau 1 D 08 A", 11, $options);

   $pdf->ezText("1060 BRUSSEL.", 11, $options);

*/

   $pdf->ezText("\n\nPZ Sancta Maria vzw", 11, $options); //, Veiligheid van de Voedselketen en Leefmilieu", 11, $options);

   $pdf->ezText("Tav Dirk Wynants", 11, $options);

   $pdf->ezText("Melveren centrum 111", 11, $options);

   $pdf->ezText("3800 Sint-Truiden", 11, $options);

   $pdf->ezText("  ", 11, $options);

   $pdf->ezText("  ", 11, $options);

   $pdf->ezText("  ", 11, $options);



   $pdf->ezText(" ", 11, $options);

  $options = array('aleft'=>22*$mm,

                 'aright' => (210-22)*$mm,

                 'justification' => 'center');



   $pdf->ezText("Op te sturen binnen de maand volgend op het trimester waarop de factuur betrekking heeft.", 11, $options);



   $pdf2->ezText("NIET te sturen naar de FOD Volksgezondheid, ter attentie van de Dienst Psychosociale Gezondheidszorg, op onderstaand adres :", 11, $options);

/*

   $pdf2->ezText("\n\nFOD Volksgezondheid", 11, $options); //, Veiligheid van de Voedselketen en Leefmilieu", 11, $options);

   $pdf2->ezText("Directoraat-Generaal Org. Gezondheidszorgvoorzieningen", 11, $options);

   $pdf2->ezText("Bestuursdirectie Gezondheidszorgbeleid", 11, $options);

   $pdf2->ezText("T.a.v. de heer M. MOREELS", 11, $options);

   $pdf2->ezText("Victor Hortaplein 40 bus 10", 11, $options);

   $pdf2->ezText("bureau 1 D 08 A         ", 11, $options);

   $pdf2->ezText("1060 BRUSSEL.", 11, $options);

*/

   $pdf2->ezText("\n\nPZ Sancta Maria vzw", 11, $options); //, Veiligheid van de Voedselketen en Leefmilieu", 11, $options);

   $pdf2->ezText("Tav Dirk Wynants", 11, $options);

   $pdf2->ezText("Melveren centrum 111", 11, $options);

   $pdf2->ezText("3800 Sint-Truiden", 11, $options);

   $pdf2->ezText("  ", 11, $options);

   $pdf2->ezText("  ", 11, $options);

   $pdf2->ezText("  ", 11, $options);



   $pdf2->ezText(" ", 11, $options);

   $pdf2->ezText("CREDITNOTA nav foute factuur voor de verstrekkingen in het kader van de therapeutische projecten",11,$options);



   $pdf->ezText("\n\n<b>Driemaandelijkse facturering van de overlegvergaderingen</b>", 13, $options);

   $pdf->ezText("<b>die in het raam van een therapeutisch project worden georganiseerd</b>", 13, $options);



   $pdf2->ezText("\n\n<b>Driemaandelijkse facturering van de overlegvergaderingen</b>", 13, $options);

   $pdf2->ezText("<b>die in het raam van een therapeutisch project worden georganiseerd</b>", 13, $options);





  $options = array('aleft'=>22*$mm,

                 'aright' => (210-22)*$mm,

                 'justification' => 'left');



   $tpInfo = tp_record($_TP_FOR_K);



   $pdf->ezText("\n\nIdentificatiegegevens van het therapeutische project", 12, $options);

   $pdf->ezText("Benaming project: {$tpInfo['naam']}", 11,$options);

   $pdf->ezText("Nummer project: {$tpInfo['nummer']}", 11,$options);

   $pdf->ezText("Naam van de administratieve coördinator: $titelListel",11,$options);

/*

   $pdf->ezText("Ondernemingsnummer 0446.055.785",11,$options);

   $pdf->ezText("A. Rodenbachstraat 29 bus 1",11,$options);

   $pdf->ezText("B-3500  HASSELT",11,$options);

   $pdf->ezText("011/81.94.70",11,$options);

*/

   $pdf->ezText("Rekeningnummer : IBAN BE31735010958055 - BIC: KRED BE BB",11,$options);



   $pdf2->ezText("Identificatiegegevens van het therapeutische project", 12, $options);

   $pdf2->ezText("Benaming project: {$tpInfo['naam']}", 11,$options);

   $pdf2->ezText("Nummer project: {$tpInfo['nummer']}", 11,$options);

   $pdf2->ezText("Naam van de administratieve coördinator: $titelListel",11,$options);

/*

   $pdf2->ezText("ondernemingsnummer 0446.055.785",11,$options);

   $pdf2->ezText("A. Rodenbachstraat 29 bus 1",11,$options);

   $pdf2->ezText("B-3500  HASSELT",11,$options);

   $pdf2->ezText("011/81.94.70",11,$options);

*/

   $pdf2->ezText("Rekeningnummer : IBAN BE31735010958055 - BIC: KRED BE BB",11,$options);







   $overlegQuery = "select min(datum) as min_datum, max(datum) as max_datum, count(overleg.id) as aantal from overleg, patient, patient_tp

                   where overleg.patient_code = patient.code

                         and overleg.factuur_code = '$factuurID'

                               and patient.code = patient_tp.patient

                               and (patient_tp.project = $_TP_FOR_K)";

   $resultOverleg = mysql_query($overlegQuery);



   $datumRij = mysql_fetch_assoc($resultOverleg);

   $datumRij['min_datum'] = substr($datumRij['min_datum'],6,2) . "/" . substr($datumRij['min_datum'],4,2) . "/" . substr($datumRij['min_datum'],0,4);

   $datumRij['max_datum'] = substr($datumRij['max_datum'],6,2) . "/" . substr($datumRij['max_datum'],4,2) . "/" . substr($datumRij['max_datum'],0,4);



   $pdf->ezText("\n\nPeriode (3 kalendermaanden), waarop deze factuur betrekking heeft: <b>{$datumRij['min_datum']} tot {$datumRij['max_datum']}</b>", 11, $options);

   $pdf2->ezText("\n\nPeriode (3 kalendermaanden), waarop deze factuur betrekking heeft: <b>{$datumRij['min_datum']} tot {$datumRij['max_datum']}</b>", 11, $options);



   $pdf->ezText("\n\nTotaal aantal overlegvergaderingen die in deze factuur zijn opgenomen: {$datumRij['aantal']}",11, $options);

   $pdf2->ezText("\n\nTotaal aantal overlegvergaderingen die in deze factuur zijn opgenomen: {$datumRij['aantal']}",11, $options);



   $pdf->ezText("\n\nGedetailleerd overzicht van de gefactureerde overlegvergaderingen:\n",11,$options);

   $pdf2->ezText("\n\nGedetailleerd overzicht van de gefactureerde overlegvergaderingen:\n",11,$options);





  $overlegQuery = "select overleg.id as overleg_id,  locatie, code, datum, naam, voornaam, rijksregister from overleg, patient, patient_tp

                   where overleg.patient_code = patient.code

                         and overleg.factuur_code = '$factuurID'

                               and patient.code = patient_tp.patient

                               and (patient_tp.project = $_TP_FOR_K)

                   order by datum asc";

  $resultOverleg = mysql_query($overlegQuery);



  for ($i=0; $i<mysql_num_rows($resultOverleg); $i++) {

    $rij = mysql_fetch_assoc($resultOverleg);

    foreach ($rij as $key => $value) {

      $rij[$key] = utf8_decode($rij[$key]);

    }

    //and patient.code = patient_tp.patient

    //                     and (einddatum is NULL or einddatum < concat(substring(



    $mooieDatum = substr($rij['datum'],6,2) . "/" . substr($rij['datum'],4,2) . "/" . substr($rij['datum'],0,4);

    $dateDatum = substr($rij['datum'],0,4) . "-" . substr($rij['datum'],4,2) . "-" . substr($rij['datum'],6,2);

    $tabel[$i]["Minstens 30 \npatiënten die\naan de criteria\nvoldoen om\nrechthebbende van\ndeze overeenkomst\nte zijn"]= "Patient " . ($i+1) . ":\n{$rij['code']}" ; //": {$rij['naam']} {$rij['voornaam']}\nINSZ: {$rij['rijksregister']}";

    $tabel2[$i]["Minstens 30 \npatiënten die\naan de criteria\nvoldoen om\nrechthebbende van\ndeze overeenkomst\nte zijn"]= "Patient " . ($i+1) . ":\n{$rij['code']}" ; //": {$rij['naam']} {$rij['voornaam']}\nINSZ: {$rij['rijksregister']}";





    $tabel[$i]["Datum van\n het overleg"]= $mooieDatum;

    $tabel2[$i]["Datum van\n het overleg"]= $mooieDatum;



    $qryPartners = "select org.naam as org_naam, concat(h.naam,' ',h.voornaam) as mens_naam from afgeronde_betrokkenen bl, hulpverleners h, organisatie org

                    where bl.overleg_id = {$rij['overleg_id']}
                      and overleggenre = 'gewoon'
                      and bl.persoon_id  = h.id

                      and h.organisatie = org.id

                      and bl.genre = 'orgpersoon'

                      and aanwezig = 1";

    $resultPartners = mysql_query($qryPartners);

    for ($j=0; $j<mysql_num_rows($resultPartners); $j++) {

      $rijPartner = mysql_fetch_assoc($resultPartners);

      foreach ($rijPartner as $key => $value) {

        $rijPartner[$key] = utf8_decode($rijPartner[$key]);

      }

      $tabel[$i]["Aanwezige partners\nop de overlegvergadering"] .= "\n{$rijPartner['org_naam']}";

      $tabel[$i]["Naam van de vertegenwoordiger\nvan de partner die aanwezig\nis op de overlegvergadering"] .= "\n{$rijPartner['mens_naam']}";

    }



    $qryPartners = "select org.naam as org_naam, concat(h.naam,' ',h.voornaam) as mens_naam from afgeronde_betrokkenen bl, hulpverleners h, organisatie org

                    where bl.overleg_id = {$rij['overleg_id']}
                      and overleggenre = 'gewoon'
                      and bl.persoon_id  = h.id

                      and h.organisatie = org.id

                      and (org.genre = 'ZVL' or org.genre = 'HVL' or org.genre = 'XVL' or org.genre = 'XVLP')

                      and bl.genre = 'hulp'

                      and aanwezig = 1";

    $resultPartners = mysql_query($qryPartners);

    for ($j=0; $j<mysql_num_rows($resultPartners); $j++) {

      $rijPartner = mysql_fetch_assoc($resultPartners);

      foreach ($rijPartner as $key => $value) {

        $rijPartner[$key] = utf8_decode($rijPartner[$key]);

      }

      $tabel[$i]["Aanwezige partners\nop de overlegvergadering"] .= "\nGDT Listel vzw";

      $tabel[$i]["Naam van de vertegenwoordiger\nvan de partner die aanwezig\nis op de overlegvergadering"] .= "\n{$rijPartner['mens_naam']}";

    }



    $tabel[$i]["Aanwezige partners\nop de overlegvergadering"] = substr($tabel[$i]["Aanwezige partners\nop de overlegvergadering"],1);

    $tabel[$i]["Naam van de vertegenwoordiger\nvan de partner die aanwezig\nis op de overlegvergadering"] = substr($tabel[$i]["Naam van de vertegenwoordiger\nvan de partner die aanwezig\nis op de overlegvergadering"],1);

    $tabel2[$i]["Aanwezige partners\nop de overlegvergadering"] = $tabel[$i]["Aanwezige partners\nop de overlegvergadering"];

    $tabel2[$i]["Naam van de vertegenwoordiger\nvan de partner die aanwezig\nis op de overlegvergadering"] = $tabel[$i]["Naam van de vertegenwoordiger\nvan de partner die aanwezig\nis op de overlegvergadering"];



    $hetTarief = rizivTarief($rij['datum']);

    if ($rij['locatie'] == 2) {

      //$tabel[$i]["Overlegcode\n(**)"]="427361";

      //$tabel[$i]["Registratie"]="427383";

      //$tabel2[$i]["Overlegcode\n(**)"]="427361";

      //$tabel2[$i]["Registratie"]="427383";

      $subtotaal = $hetTarief["zhTP"]; //+$hetTarief["registratie_zhTP"];

    }

    else {

      //$tabel[$i]["Overlegcode\n(**)"]="427350";

      //$tabel[$i]["Registratie"]="427372";

      //$tabel2[$i]["Overlegcode\n(**)"]="427350";

      //$tabel2[$i]["Registratie"]="427372";

      $subtotaal = $hetTarief["nietzhTP"]; //+$hetTarief["registratie_nietzhTP"];

    }

    //$tabel[$i]["Bedrag voor dit overleg"]="€$subtotaal";

    //$tabel2[$i]["Bedrag voor dit overleg"]="-€$subtotaal";

    $totaal += $subtotaal;

    

  }



  $tabel[$i]["Aanwezige partners\nop de overlegvergadering"] = "TOTAAL";

  $tabel[$i]["Naam van de vertegenwoordiger\nvan de partner die aanwezig\nis op de overlegvergadering"]="€$totaal";

  $tabel2[$i]["Aanwezige partners\nop de overlegvergadering"] = "TOTAAL";

  $tabel2[$i]["Naam van de vertegenwoordiger\nvan de partner die aanwezig\nis op de overlegvergadering"]="-€$totaal";





  $pdf->ezTable($tabel);

  $pdf2->ezTable($tabel2);







  $pdf->ezText("\n\nIk bevestig te beschikken over documenten die het volledige en exacte karakter van de hierboven opgenomen informatie aantonen.",11,$options);

  $pdf2->ezText("\n\nIk bevestig te beschikken over documenten die het volledige en exacte karakter van de hierboven opgenomen informatie aantonen.",11,$options);





  $pdf->ezText("\n\nHet verschuldigde bedrag van €$totaal storten met de vermelding : $factuurJaar/ForK/{$genreCode}$factuurNr",11,$options);

  $pdf->ezText("Rekeningnummer GDT / facturerende instelling : IBAN BE31735010958055 - BIC: KRED BE BB",11,$options);

  $pdf->ezText("\nGedaan te Hasselt,\nop $factuurDatum\nKristel Vanden Driessche, handelend in de hoedanigheid van administratief coördinator.",11,$options);

  $pdf->ezText("Handtekening : ",11,$options);

  //$pdf2->ezText("\n\nDe verschuldigde bedragen storten met de vermelding : $kenmerk",11,$options);

  //$pdf2->ezText("Rekeningnummer GDT / facturerende instelling : 735-0109580-55",11,$options);

  $pdf2->ezText("\nGedaan te Hasselt,\nop $factuurDatum\nKristel Vanden Driessche, handelend in de hoedanigheid van administratief coördinator.",11,$options);

  $pdf2->ezText("Handtekening : ",11,$options);



//  $pdf->ezStopPageNumbers(1,1,$mutualiteitNr);

//  $pdf2->ezStopPageNumbers(1,1,$mutualiteitNr2);

  

/******************************************/

/*  PDF WEGSCHRIJVEN NAAR BESTAND  */

/******************************************/





  $pdfcode = $pdf->ezOutput();

  $dir = '../factuurForKdinges17';

  if ($genre == "ForK") $genreInfo = "";
  else if ($genre == "ForK-H") $genreInfo = "_H";
  else $genreInfo = "_G";

  //save the file

  $fname = $dir."/factuur_{$factuurJaar}{$genreInfo}_{$factuurNr}.pdf";

  $fp = fopen($fname,'w');

  fwrite($fp,$pdfcode);

  fclose($fp);



  $pdfcode2 = $pdf2->ezOutput();

  $dir = '../factuurForKdinges17';

  //save the file

  $fname2 = $dir."/creditnota_{$factuurJaar}{$genreInfo}_{$factuurNr}.pdf";

  $fp2 = fopen($fname2,'w');

  fwrite($fp2,$pdfcode2);

  fclose($fp2);





/******************************************/

/*  verwijzing wegschrijven in database   */

/******************************************/

  $updateQry = "update factuurmaand

                   set factuurFile = '{$factuurJaar}{$genreInfo}_{$factuurNr}.pdf'

                 where id = $factuurID";

  mysql_query($updateQry) or die(mysql_error . "<br/>$updateQry");



  print("<li><a href=\"../factuurForKdinges17/factuur_{$factuurJaar}{$genreInfo}_{$factuurNr}.pdf\">factuur  {$factuurNr} van {$factuurJaar} voor FOD</a></li>");





}



   require("../includes/clearSessie.inc");

   require("../includes/dbconnect2.inc");

   $paginanaam="Aanmaak facturen TP-ForK";

   if (IsSet($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan") && ($_SESSION['profiel']=="listel"))

      {

      require("../includes/html_html.inc");

      print("<head>");

      require("../includes/html_head.inc");

      print("</head>");

      print("<body>");

      print("<div align=\"center\">");

      print("<div class=\"pagina\">");

      require("../includes/header.inc");

      require("../includes/kruimelpad.inc");

      print("<div class=\"contents\">");

      require("../includes/menu.inc");

      print("<div class=\"main\">");

      print("<div class=\"mainblock\">");



   initRiziv();







//die($qryPartners);

//mainblock



$mm = 595.28/210;









include('../ezpdf/class.ezpdf.php');



$pdf =& new Cezpdf('A4', 'portrait');

//$pdf->ezSetMargins(0,0,0,0);

$pdf->selectFont('../ezpdf/fonts/Times-Roman.afm');

if ($_GET['deelvzw']=="H") {
  $genre = "ForK-H";
}
else if ($_GET['deelvzw']=="G") {
  $genre = "ForK-G";
}
else {
  $genre = "ForK";
}


$zoekViaNummer = false;

if (isset($_GET['factuurID'])) {

  $zoekViaNummer = true;

  $zoekFactuurMaandQry = "select * from factuurmaand where id = {$_GET['factuurID']}";

  $zoekFactuurMaand =  mysql_query($zoekFactuurMaandQry) or die ($zoekFactuurMaandQry . "<br/>" . mysql_error());

  if (mysql_num_rows($zoekFactuurMaand)==0) die ("Deze factuur bestaat niet!");

  $factuurMaandRecord = mysql_fetch_assoc($zoekFactuurMaand);

  $factuurMaand = $factuurMaandRecord['maand'];

  $factuurJaar = $factuurMaandRecord['jaar'];

  $factuurMut = $factuurMaandRecord['mutualiteit'];





}

else if (isset($_GET['jaar'])) {

  $factuurJaar = $_GET['jaar']; // het jaar waarover de overleggen gaan

  $factuurMaand = $_GET['maand']; // de maand waarover de overleggen gaan

  if ($factuurMaand == 0) {

    // zoek het nummer van de volgende maand

    $zoekFactuurMaandQry = "select max(maand) as maxmaand from factuurmaand where genre = '$genre' and jaar = $factuurJaar";

    $zoekFactuurMaand = mysql_query($zoekFactuurMaandQry) or die($zoekFactuurMaandQry . "<br/>" . mysql_error());

    if (mysql_num_rows($zoekFactuurMaand) > 0) {

      // er is dit jaar al een factuur geweest, dus nummer verhogen

      $zoekFactuurMaandRij = mysql_fetch_assoc($zoekFactuurMaand);

      $factuurMaand = $zoekFactuurMaandRij['maxmaand']+1;

    }

    else {

      // eerste factuur van dit jaar

      $factuurMaand = 1;

    }

    if ($factuurMaand == 0) die("Er is geen factuurmaand gemaakt.");

  }



}





if (!isset($_POST['teCrediterenFactuur'])) { // als het niet om een factuur na creditnota gaat

    if ($zoekViaNummer)

      $factuurInfo = getFactuurInfoViaNummer($_GET['factuurID'], $genre);

    else

      $factuurInfo = getFactuurInfo($factuurMaand, $factuurJaar, $genre);

    if ($factuurInfo != 0) {

       printFOD($factuurInfo, $genre);

    }

}

else {

  // via creditnota

  // eerst creditnota activeren

  $factuurJaar = date("Y"); // het jaar waarover de overleggen gaan

  $factuurMaand = date("m"); // de maand waarover de overleggen gaan



  $activeerCreditQry = "update factuurmaand

                            set creditActief = 1

                         where id = {$_POST['teCrediterenFactuur']}";

  $getCreditNotaQry = "select * from factuurmaand where id = {$_POST['teCrediterenFactuur']}";

  if ((mysql_query($activeerCreditQry)) && ($creditNotaResult = mysql_query($getCreditNotaQry))) {

    $creditNotaRij = mysql_fetch_assoc($creditNotaResult);

    print("<h4>Creditnota  van factuur <a href=\"../factuurForKdinges17/creditnota_{$creditNotaRij['factuurFile']}\">{$creditNotaRij['nummer']} van {$creditNotaRij['jaar']}</a></h4>\n");

  }

  else {

     die("debug-info: " . mysql_error());

  }



  // dan nieuwe factuur voor FOD maken

    $factuurInfo = getFactuurInfoVanCreditNota(date("m"),date("Y"), $_POST['teCrediterenFactuur'], $_POST['genre']);

    if ($factuurInfo != 0) {

       printFOD($factuurInfo, $_POST['genre']);

    }







}





// einde mainblock



      print("</div>");

      print("</div>");

      print("</div>");

      require("../includes/dbclose.inc");

      require("../includes/footer.inc");

      print("</div>");

      print("</div>");

      print("</body>");

      print("</html>");



      }



//---------------------------------------------------------

/* Geen Toegang */ require("../includes/check_access.inc");

//---------------------------------------------------------



//---------------------------------------------------------

/* Sluit Dbconnectie */ require("../includes/dbclose.inc");

//---------------------------------------------------------

?>