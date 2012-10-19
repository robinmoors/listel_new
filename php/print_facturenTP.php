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



function getFactuurInfoVanCreditNota($maand, $jaar, $mutualiteit, $factuurID, $genre) {

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

    // eerst zoeken welke overleggen er NU zijn voor deze mutualiteit
    if ($genre == "TP-H") {
      $joinGemeente = " inner join gemeente on patient.gem_id = gemeente.id ";
      $vwGemeente = " and deelvzw = 'H' ";
    }
    else if ($genre == "TP-G") {
      $joinGemeente = " inner join gemeente on patient.gem_id = gemeente.id ";
      $vwGemeente = " and deelvzw = 'G' ";
    }
    else {
      $joinGemeente = $vwGemeente = "";
    }

    $zoekFactuurOverleggen =  "select overleg.id from overleg, patient $joinGemeente, patient_tp

                               where overleg.patient_code = patient.code and mut_id = {$mutualiteit['id']}

                               and factuur_code = '$factuurID'

                               and patient.code = patient_tp.patient

                               and NOT (patient_tp.project = $_TP_FOR_K)
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

      foreach ($zoekFactuurRij as $key => $value) {

        $zoekFactuurRij[$key] = utf8_decode($zoekFactuurRij[$key]);

      }

      $factuurInfo['nr'] = $zoekFactuurRij['maxnr']+1;

    }

    else {

      // eerste factuur van dit jaar

      $factuurInfo['nr'] = 1;

    }

    // Factuurnummer wegschrijven

    $insertFactuurmaandQry = "insert into factuurmaand (genre, maand, jaar, nummer, factuurdatum, mutualiteit, vervangt)

                              values ('$genre', $maand, $jaar,{$factuurInfo['nr']}, \"{$factuurInfo['datum']}\", {$mutualiteit['id']}, $factuurID)";

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



function getFactuurInfo($maand, $jaar, $mutualiteit, $genre) {

  global $_TP_FOR_K;

  /********* eerst het factuurnummer zoeken al dan niet ophalen ********/

  $zoekFactuurQry = "select * from factuurmaand where genre = '$genre'

                     and maand = $maand and jaar = $jaar

                     and mutualiteit = {$mutualiteit['id']}";

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
    // eerst kijken of er wel overleggen zijn voor deze mutualiteit
    if ($genre == "TP-H") {
      $joinGemeente = " inner join gemeente on patient.gem_id = gemeente.id ";
      $vwGemeente = " and deelvzw = 'H' ";
    }
    else if ($genre == "TP-G") {
      $joinGemeente = " inner join gemeente on patient.gem_id = gemeente.id ";
      $vwGemeente = " and deelvzw = 'G' ";
    }
    else {
      $joinGemeente = $vwGemeente = "";
    }

    $zoekFactuurOverleggen =  "select overleg.id from overleg, patient $joinGemeente, patient_tp

                               where overleg.patient_code = patient.code and mut_id = {$mutualiteit['id']}

                               and overleg.datum LIKE '$jaar%'

                               and ((factuur_datum is NULL or factuur_datum = '') and genre = 'TP' and keuze_vergoeding = 1 and controle = 1)

                               and patient.code = patient_tp.patient

                               and NOT (patient_tp.project = $_TP_FOR_K)
                               $vwGemeente";



    $resultFactuurOverleggen = mysql_query($zoekFactuurOverleggen) or die($zoekFactuurOverleggen . "<br/>" . mysql_error());

    if (mysql_num_rows($resultFactuurOverleggen) == 0)

      return 0; // geen te facturen overleggen voor deze mutualiteit, dus geen factuur maken



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

      foreach ($zoekFactuurRij as $key => $value) {

        $zoekFactuurRij[$key] = utf8_decode($zoekFactuurRij[$key]);

      }

      $factuurInfo['nr'] = $zoekFactuurRij['maxnr']+1;

    }

    else {

      // eerste factuur van dit jaar

      $factuurInfo['nr'] = 1;

    }

    // Factuurnummer wegschrijven

    $insertFactuurmaandQry = "insert into factuurmaand (genre, maand, jaar, nummer, factuurdatum, mutualiteit)

                              values ('$genre', $maand, $jaar,{$factuurInfo['nr']}, \"{$factuurInfo['datum']}\", {$mutualiteit['id']})";

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



function getFactuurInfoViaNummer($nummer, $mutualiteit, $genre) {

  global $_TP_FOR_K;

  /********* eerst het factuurnummer zoeken al dan niet ophalen ********/

  $zoekFactuurQry = "select * from factuurmaand where genre = '$genre'

                     and id = $nummer

                     and mutualiteit = {$mutualiteit['id']}";

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

    // eerst kijken of er wel overleggen zijn voor deze mutualiteit

    if ($genre == "TP-H") {
      $joinGemeente = " inner join gemeente on patient.gem_id = gemeente.id ";
      $vwGemeente = " and deelvzw = 'H' ";
    }
    else if ($genre == "TP-G") {
      $joinGemeente = " inner join gemeente on patient.gem_id = gemeente.id ";
      $vwGemeente = " and deelvzw = 'G' ";
    }
    else {
      $joinGemeente = $vwGemeente = "";
    }

    $zoekFactuurOverleggen =  "select overleg.id from overleg, patient $joinGemeente, patient_tp

                               where overleg.patient_code = patient.code and mut_id = {$mutualiteit['id']}

                               and overleg.datum LIKE '$jaar%'

                               and ((factuur_datum is NULL or factuur_datum = '') and genre = 'TP' and keuze_vergoeding = 1 and controle = 1)

                               and patient.code = patient_tp.patient

                               and NOT (patient_tp.project = $_TP_FOR_K)
                               $vwGemeente";

    $resultFactuurOverleggen = mysql_query($zoekFactuurOverleggen) or die($zoekFactuurOverleggen . "<br/>" . mysql_error());

    if (mysql_num_rows($resultFactuurOverleggen) == 0)

      return 0; // geen te facturen overleggen voor deze mutualiteit, dus geen factuur maken



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

      foreach ($zoekFactuurRij as $key => $value) {

        $zoekFactuurRij[$key] = utf8_decode($zoekFactuurRij[$key]);

      }

      $factuurInfo['nr'] = $zoekFactuurRij['maxnr']+1;

    }

    else {

      // eerste factuur van dit jaar

      $factuurInfo['nr'] = 1;

    }

    // Factuurnummer wegschrijven

    $insertFactuurmaandQry = "insert into factuurmaand (genre, maand, jaar, nummer, factuurdatum, mutualiteit)

                              values ('$genre', $maand, $jaar,{$factuurInfo['nr']}, \"{$factuurInfo['datum']}\", {$mutualiteit['id']})";

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



function printMutualiteit($mutualiteit, $factuurInfo, $genre) {

  global $_TP_FOR_K;

  

  if ($factuurInfo['factuurFile'] != "" && $_GET['nieuwePDF']!=1) {

     print("<li><a href=\"../factuurTPdinges17/factuur_{$factuurInfo['factuurFile']}\">factuur {$factuurInfo['nummer']}/{$factuurInfo['jaar']}</a></li>");

     return;

  }



  global $mm, $factuurMaand, $factuurJaar;



  $pdf =& new Cezpdf('A4', 'landscape');

  $pdf2 =& new Cezpdf('A4', 'landscape');

  $pdf->selectFont('../ezpdf/fonts/Times-Roman.afm');

  $pdf2->selectFont('../ezpdf/fonts/Times-Roman.afm');





  $factuurID = $factuurInfo['id'];

  $factuurNr = $factuurInfo['nr'];

  $factuurDatum = $factuurInfo['datum'];





  if ($genre == "TP") {
    $rizivListel = "9-47011-97-001";
    $titelListel = "GDT LISTEL vzw";
    $genreCode = "";
  }
  else if ($genre == "TP-H") {
    $rizivListel = "947-046-62-001";
    $titelListel = "LISTEL vzw - SEL Hasselt";
    $genreCode = "H/";
  }
  else {
    $rizivListel = "947-047-61-001";
    $titelListel = "LISTEL vzw - SEL Genk";
    $genreCode = "G/";
  }

  $kenmerk = "GDT/$factuurMaand/$factuurJaar/TP/{$genreCode}{$mutualiteit['nr']}";



  $pdf->ezSetY(210*$mm-15*$mm);

  $pdf2->ezSetY(210*$mm-15*$mm);



  $mutualiteitNr = $pdf->ezStartPageNumbers(275*$mm,15*$mm,10,'','p.{PAGENUM}/{TOTALPAGENUM}',1);

  $mutualiteitNr2 = $pdf2->ezStartPageNumbers(275*$mm,15*$mm,10,'','p.{PAGENUM}/{TOTALPAGENUM}',1);



  $options = array('aleft'=>35*$mm,

                 'aright' => 841.89-35*$mm,

                 'justification' => 'center');

  $pdf->ezText("<b>BIJLAGE 71</b>",11,$options);

  $pdf->ezText("Geïntegreerde diensten voor thuisverzorging",11,$options);

  $pdf->ezText("Factuur voor de verstrekkingen in het kader van de therapeutische projecten",11,$options);



  $pdf2->ezText("<b>BIJLAGE 71</b>",11,$options);

  $pdf2->ezText("Geïntegreerde diensten voor thuisverzorging",11,$options);

  $pdf2->ezText("CREDITNOTA nav foute factuur voor de verstrekkingen in het kader van de therapeutische projecten",11,$options);



  $pdf->ezSetY(210*$mm-30*$mm);

  $pdf2->ezSetY(210*$mm-30*$mm);

  $options = array('aleft'=>210*$mm,

                 'aright' => 841.89-35*$mm,

                 'justification' => 'left');

  $pdf->ezText("{$mutualiteit['naam']}",11,$options);

  $pdf->ezText("{$mutualiteit['dienst']}",11,$options);

  $pdf->ezText("{$mutualiteit['adres']}",11,$options);

  $pdf->ezText("{$mutualiteit['dlzip']} {$mutualiteit['dlnaam']}",11,$options);

  $pdf2->ezText("{$mutualiteit['naam']}",11,$options);

  $pdf2->ezText("{$mutualiteit['dienst']}",11,$options);

  $pdf2->ezText("{$mutualiteit['adres']}",11,$options);

  $pdf2->ezText("{$mutualiteit['dlzip']} {$mutualiteit['dlnaam']}",11,$options);



  $pdf->ezSetY(210*$mm-30*$mm);

  $pdf2->ezSetY(210*$mm-30*$mm);

  $options = array('aleft'=>35*$mm,

                 'aright' => 841.89-35*$mm,

                 'justification' => 'left');

  $pdf->ezText("RIZIV-nr: $rizivListel",11,$options);

  $pdf->ezText("$titelListel - ondernemingsnummer 0446.055.785",11,$options);

  $pdf->ezText("A. Rodenbachstraat 29 bus 1",11,$options);

  $pdf->ezText("B-3500  HASSELT",11,$options);

  $pdf->ezText("011/81.94.70",11,$options);

  $pdf->ezText("\nFactuurnummer: $factuurJaar/TP/{$genreCode}$factuurNr-{$mutualiteit['nr']} - Factuur datum: $factuurDatum - Ons kenmerk : $factuurJaar/TP/{$genreCode}$factuurNr-{$mutualiteit['nr']}\n",11,$options);



  $pdf2->ezText("RIZIV-nr: $rizivListel",11,$options);

  $pdf2->ezText("$titelListel - ondernemingsnummer 0446.055.785",11,$options);

  $pdf2->ezText("A. Rodenbachstraat 29 bus 1",11,$options);

  $pdf2->ezText("B-3500  HASSELT",11,$options);

  $pdf2->ezText("011/81.94.70",11,$options);

  $pdf2->ezText("\nCREDITNOTA                        /                            - Oorspronkelijke factuur: $factuurJaar/TP/{$genreCode}$factuurNr-{$mutualiteit['nr']} van $factuurDatum \n",11,$options);



  $overlegQuery = "select distinct overleg.id as overleg_id,  locatie, code, datum, naam, voornaam, rijksregister from overleg, patient, patient_tp

                   where overleg.patient_code = patient.code

                         and patient.mut_id = {$mutualiteit['id']}

                         and overleg.factuur_code = '$factuurID'

                               and patient.code = patient_tp.patient

                               and NOT (patient_tp.project = $_TP_FOR_K)

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

    $tabel[$i]["Identificatie\nvan de patiënt"]= "{$rij['naam']} {$rij['voornaam']}\nINSZ: {$rij['rijksregister']}";

    $tabel2[$i]["Identificatie\nvan de patiënt"]= "{$rij['naam']} {$rij['voornaam']}\nINSZ: {$rij['rijksregister']}";



    $tpZoektochtQry = "select tp_project.nummer from tp_project, patient_tp

                       where patient = '{$rij['code']}'

                         and patient_tp.project = tp_project.id

                         and NOT (patient_tp.project = $_TP_FOR_K)

                         and begindatum <= '$dateDatum'

                         and (einddatum is NULL or einddatum >= '$dateDatum')";

    $tpZoektocht = mysql_fetch_assoc(mysql_query($tpZoektochtQry));

    foreach ($tpZoektocht as $key => $value) {

        $tpZoektocht[$key] = utf8_decode($tpZoektocht[$key]);

    }

    $tabel[$i]["TP\n-nr\n*"]= $tpZoektocht['nummer'];

    $tabel2[$i]["TP\n-nr\n*"]= $tpZoektocht['nummer'];



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

      $tabel[$i]["Partners effectief deelgenomen\naan het overleg"] .= "\n{$rijPartner['org_naam']}";

      $tabel[$i]["Deelnemende\nvertegenwoordiger\nvan de partner"] .= "\n{$rijPartner['mens_naam']}";

      $tabel2[$i]["Partners effectief deelgenomen\naan het overleg"] .= "\n{$rijPartner['org_naam']}";

      $tabel2[$i]["Deelnemende\nvertegenwoordiger\nvan de partner"] .= "\n{$rijPartner['mens_naam']}";

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

      $tabel[$i]["Partners effectief deelgenomen\naan het overleg"] .= "\n{$titelListel}";

      $tabel[$i]["Deelnemende\nvertegenwoordiger\nvan de partner"] .= "\n{$rijPartner['mens_naam']}";

      $tabel2[$i]["Partners effectief deelgenomen\naan het overleg"] .= "\n{$titelListel}";

      $tabel2[$i]["Deelnemende\nvertegenwoordiger\nvan de partner"] .= "\n{$rijPartner['mens_naam']}";

    }



    $tabel[$i]["Partners effectief deelgenomen\naan het overleg"] = substr($tabel[$i]["Partners effectief deelgenomen\naan het overleg"],1);

    $tabel[$i]["Deelnemende\nvertegenwoordiger\nvan de partner"] = substr($tabel[$i]["Deelnemende\nvertegenwoordiger\nvan de partner"],1);

    $tabel2[$i]["Partners effectief deelgenomen\naan het overleg"] = $tabel[$i]["Partners effectief deelgenomen\naan het overleg"];

    $tabel2[$i]["Deelnemende\nvertegenwoordiger\nvan de partner"] = $tabel[$i]["Deelnemende\nvertegenwoordiger\nvan de partner"];



    $hetTarief = rizivTarief($rij['datum']);

    if ($rij['locatie'] == 2) {

      $tabel[$i]["Overlegcode\n(**)"]="427361";

      $tabel[$i]["Registratie"]="427383";

      $tabel2[$i]["Overlegcode\n(**)"]="427361";

      $tabel2[$i]["Registratie"]="427383";

      $subtotaal = $hetTarief["zhTP"]+$hetTarief["registratie_zhTP"];

    }

    else {

      $tabel[$i]["Overlegcode\n(**)"]="427350";

      $tabel[$i]["Registratie"]="427372";

      $tabel2[$i]["Overlegcode\n(**)"]="427350";

      $tabel2[$i]["Registratie"]="427372";

      $subtotaal = $hetTarief["nietzhTP"]+$hetTarief["registratie_nietzhTP"];

    }

    $tabel[$i]["Bedrag in €\nper patiënt"]="€$subtotaal";

    $tabel2[$i]["Bedrag in €\nper patiënt"]="-€$subtotaal";

    $totaal += $subtotaal;

    

  }

  $tabel[$i]["Registratie"]="TOTAAL";

  $tabel[$i]["Bedrag in €\nper patiënt"]="€$totaal";

  $tabel2[$i]["Registratie"]="TOTAAL";

  $tabel2[$i]["Bedrag in €\nper patiënt"]="-€$totaal";





  $pdf->ezTable($tabel);

  $pdf2->ezTable($tabel2);



  $pdf->ezText("*  : Identificatie van het therapeutisch project (nummer)",11,$options);

  $pdf->ezText("** : Pseudo-code Multidisciplinair overleg",11,$options);



  $pdf2->ezText("*  : Identificatie van het therapeutisch project (nummer)",11,$options);

  $pdf2->ezText("** : Pseudo-code Multidisciplinair overleg",11,$options);



  $pdf->ezText("\n\nDe verschuldigde bedragen storten met de vermelding : $factuurJaar/TP/{$genreCode}$factuurNr-{$mutualiteit['nr']}",11,$options);

  $pdf->ezText("Rekeningnummer GDT / facturerende instelling : IBAN BE31735010958055 - BIC: KRED BE BB",11,$options);

  $pdf->ezText("Datum, naam en hoedanigheid van de ondertekenaar : $factuurDatum, Anick Noben, administratie {$titelListel}",11,$options);

  $pdf->ezText("Handtekening : ",11,$options);



  //$pdf2->ezText("\n\nDe verschuldigde bedragen storten met de vermelding : $kenmerk",11,$options);

  //$pdf2->ezText("Rekeningnummer GDT / facturerende instelling : 735-0109580-55",11,$options);

  $pdf2->ezText("Datum, naam en hoedanigheid van de ondertekenaar :          /        /            , Anick Noben, administratie LISTEL vzw",11,$options);

  $pdf2->ezText("Handtekening : ",11,$options);



//  $pdf->ezStopPageNumbers(1,1,$mutualiteitNr);

//  $pdf2->ezStopPageNumbers(1,1,$mutualiteitNr2);

  

/******************************************/

/*  PDF WEGSCHRIJVEN NAAR BESTAND  */

/******************************************/





  $pdfcode = $pdf->ezOutput();

  $dir = '../factuurTPdinges17';

  //save the file
  if ($genre == "TP") $genreInfo = "";
  else if ($genre == "TP-H") $genreInfo = "_H";
  else $genreInfo = "_G";

  $fname = $dir."/factuur_{$factuurJaar}{$genreInfo}_{$factuurNr}.pdf";

  $fp = fopen($fname,'w');

  fwrite($fp,$pdfcode);

  fclose($fp);



  $pdfcode2 = $pdf2->ezOutput();

  $dir = '../factuurTPdinges17';

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



  print("<li><a href=\"../factuurTPdinges17/factuur_{$factuurJaar}{$genreInfo}_{$factuurNr}.pdf\">factuur  {$factuurNr} van {$factuurJaar} voor {$mutualiteit['naam']}</a></li>");





}



   require("../includes/clearSessie.inc");

   require("../includes/dbconnect2.inc");

   $paginanaam="Aanmaak facturen TP";

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



$pdf =& new Cezpdf('A4', 'landscape');

//$pdf->ezSetMargins(0,0,0,0);

$pdf->selectFont('../ezpdf/fonts/Times-Roman.afm');


if ($_GET['deelvzw']=="H") {
  $genre = "TP-H";
}
else if ($_GET['deelvzw']=="G") {
  $genre = "TP-G";
}
else {
  $genre = "TP";
}


$zoekViaNummer = false;

if (isset($_GET['factuurID'])) {

  $zoekViaNummer = true;

  $zoekFactuurMaandQry = "select * from factuurmaand where id = {$_GET['factuurID']}";

  $zoekFactuurMaand =  mysql_query($zoekFactuurMaandQry) or die ($zoekFactuurMaandQry . "<br/>" . mysql_error());

  if (mysql_num_rows($zoekFactuurMaand)==0) die ("Deze factuur bestaat niet!");

  $factuurMaandRecord = mysql_fetch_assoc($zoekFactuurMaand);

  foreach ($factuurMaandRecord as $key => $value) {

        $factuurMaandRecord[$key] = utf8_decode($factuurMaandRecord[$key]);

  }

  $factuurMaand = $factuurMaandRecord['maand'];

  $factuurJaar = $factuurMaandRecord['jaar'];

  $factuurMut = $factuurMaandRecord['mutualiteit'];

  $genre = $factuurMaandRecord['genre'];



  $mutualiteiten =   "select verzekering.*, g.dlzip, g.dlnaam from verzekering, gemeente g

                      where verzekering.id = $factuurMut and gem_id = g.id";

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

      foreach ($zoekFactuurMaandRij as $key => $value) {

        $zoekFactuurMaandRij[$key] = utf8_decode($zoekFactuurMaandRij[$key]);

      }

      $factuurMaand = $zoekFactuurMaandRij['maxmaand']+1;

    }

    else {

      // eerste factuur van dit jaar

      $factuurMaand = 1;

    }

    if ($factuurMaand == 0) die("Er is geen factuurmaand gemaakt.");

  }



  $mutualiteiten =   "select verzekering.*, g.dlzip, g.dlnaam from verzekering, gemeente g

                      where gem_id = g.id";

}





if (!isset($_POST['teCrediterenFactuur'])) { // als het niet om een factuur na creditnota gaat

  $resultMutualiteiten = mysql_query($mutualiteiten) or die($mutualiteiten . " wil niet <br/>" . mysql_error());



  for ($i=0; $i<mysql_num_rows($resultMutualiteiten); $i++) {

    $rijMutualiteit = mysql_fetch_assoc($resultMutualiteiten);

    foreach ($rijMutualiteit as $key => $value) {

        $rijMutualiteit[$key] = utf8_decode($rijMutualiteit[$key]);

    }



    if ($zoekViaNummer)

      $factuurInfo = getFactuurInfoViaNummer($_GET['factuurID'], $rijMutualiteit, $genre);

    else

      $factuurInfo = getFactuurInfo($factuurMaand, $factuurJaar, $rijMutualiteit, $genre);

    if ($factuurInfo != 0) {

      printMutualiteit($rijMutualiteit, $factuurInfo, $genre);

    }

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

    print("<h4>Creditnota  van factuur <a href=\"../factuurTPdinges17/creditnota_{$creditNotaRij['factuurFile']}\">{$creditNotaRij['nummer']} van {$creditNotaRij['jaar']}</a></h4>\n");

  }

  else {

     die("debug-info: " . mysql_error());

  }



  // dan alle mutualiteiten opzoeken (het zou kunnen dat patient verkeerde mutualiteit had en

  // dat we dus twee of meer nieuwe facturen moeten maken

  $mutualiteiten =   "select verzekering.*, g.dlzip, g.dlnaam from verzekering, gemeente g

                      where gem_id = g.id";

  $resultMutualiteiten = mysql_query($mutualiteiten) or die($mutualiteiten . " wil niet <br/>" . mysql_error());

  for ($i=0; $i<mysql_num_rows($resultMutualiteiten); $i++) {

    $rijMutualiteit = mysql_fetch_assoc($resultMutualiteiten);

    foreach ($rijMutualiteit as $key => $value) {

        $rijMutualiteit[$key] = utf8_decode($rijMutualiteit[$key]);

    }

    $factuurInfo = getFactuurInfoVanCreditNota(date("m"),date("Y"), $rijMutualiteit, $_POST['teCrediterenFactuur'], $_POST['genre']);

    if ($factuurInfo != 0) {

       printMutualiteit($rijMutualiteit, $factuurInfo, $_POST['genre']);

    }

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