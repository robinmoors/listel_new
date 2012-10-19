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



function getFactuurInfoVanCreditNota($maand, $jaar, $mutualiteit, $factuurID , $genre) {

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
    if ($genre != "gewoon") {
      $joinGemeente = " inner join gemeente on patient.gem_id = gemeente.id ";
      $vwGemeente = " and deelvzw = '$genre' ";
    }
    $zoekFactuurOverleggen =  "select overleg.id from overleg, patient $joinGemeente
                               where overleg.patient_code = patient.code and mut_id = {$mutualiteit['id']}
                                 and factuur_code = '$factuurID'
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
  /********* eerst het factuurnummer zoeken al dan niet ophalen ********/
  $zoekFactuurQry = "select * from factuurmaand where genre = '$genre'
                     and maand = $maand and jaar = $jaar
                     and mutualiteit = {$mutualiteit['id']}
                     order by id desc";
  $zoekFactuur = mysql_query($zoekFactuurQry) or die($zoekFactuurQry . "<br/>" . mysql_error());
  if (mysql_num_rows($zoekFactuur) > 0) {
    // factuur is al gemaakt geweest , dus gewoon id ophalen
    $zoekFactuurRij = mysql_fetch_assoc($zoekFactuur);
    foreach ($zoekFactuurRij as $key => $value) {
      $zoekFactuurRij[$key] = utf8_decode($zoekFactuurRij[$key]);
    }
    $factuurInfo['id'] = $zoekFactuurRij['id'];
    $factuurInfo['datum'] = $zoekFactuurRij['factuurdatum'];
    $factuurInfo['nr'] = $zoekFactuurRij['nummer'];
    $factuurInfo['factuurFile'] = $zoekFactuurRij['factuurFile'];
    return $factuurInfo;
  }
  else {
    // factuur is  nog niet gemaakt.
    // eerst kijken of er wel overleggen zijn voor deze mutualiteit
    if ($genre != "gewoon") {
      $joinGemeente = " inner join gemeente on patient.gem_id = gemeente.id ";
      $vwGemeente = " and deelvzw = '$genre' ";
    }
    $zoekFactuurOverleggen =  "select overleg.id from overleg, patient $joinGemeente
                               where overleg.patient_code = patient.code and mut_id = {$mutualiteit['id']}
                               and (overleg.datum > '20070100' and overleg.datum LIKE '$jaar%')
                               and ((factuur_datum is NULL or factuur_datum = '')
                               and (genre = 'gewoon' or genre is NULL)
                               and controle = 1 and keuze_vergoeding = 1)
                               and soort_problematiek = 'fysisch'
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
  /********* eerst het factuurnummer zoeken al dan niet ophalen ********/
  $zoekFactuurQry = "select * from factuurmaand where id = $nummer
                                       and mutualiteit = {$mutualiteit['id']}";
  $zoekFactuur = mysql_query($zoekFactuurQry) or die($zoekFactuurQry . "<br/>" . mysql_error());
  if (mysql_num_rows($zoekFactuur) > 0) {
    // factuur is al gemaakt geweest , dus gewoon id ophalen
    $zoekFactuurRij = mysql_fetch_assoc($zoekFactuur);
    foreach ($zoekFactuurRij as $key => $value) {
      $zoekFactuurRij[$key] = utf8_decode($zoekFactuurRij[$key]);
    }

    $factuurInfo['id'] = $zoekFactuurRij['id'];
    $factuurInfo['datum'] = $zoekFactuurRij['factuurdatum'];
    $factuurInfo['nr'] = $zoekFactuurRij['nummer'];
    $factuurInfo['factuurFile'] = $zoekFactuurRij['factuurFile'];
  }
  else {
    // factuur is  nog niet gemaakt.
    // eerst kijken of er wel overleggen zijn voor deze mutualiteit
    if ($genre != "gewoon") {
      $joinGemeente = " inner join gemeente on patient.gem_id = gemeente.id ";
      $vwGemeente = " and deelvzw = '$genre' ";
    }
    $zoekFactuurOverleggen =  "select overleg.id from overleg, patient $joinGemeente
                               where overleg.patient_code = patient.code and mut_id = {$mutualiteit['id']}
                               and (overleg.datum > '20070100' and overleg.datum LIKE '$jaar%')
                               and ((factuur_datum is NULL or factuur_datum = '')
                               and (genre = 'gewoon' or genre is NULL)
                               and controle = 1 and keuze_vergoeding = 1)
                               and soort_problematiek = 'fysisch'
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
  if ($factuurInfo['factuurFile'] != "" && $_GET['nieuwePDF']!=1) {
     print("<li><a href=\"../factuurdinges17/factuur_{$factuurInfo['factuurFile']}\">factuur {$factuurInfo['nummer']}/{$factuurInfo['jaar']}</a></li>");
     return;
  }

  global $mm, $factuurMaand, $factuurJaar;

$pdf =& new Cezpdf('A4', 'landscape');
$pdf2 =& new Cezpdf('A4', 'landscape');
//$pdf->ezSetMargins(0,0,0,0);
$pdf->selectFont('../ezpdf/fonts/Times-Roman.afm');
$pdf2->selectFont('../ezpdf/fonts/Times-Roman.afm');

  $factuurID = $factuurInfo['id'];
  $factuurNr = $factuurInfo['nr'];
  $factuurDatum = $factuurInfo['datum'];

  if ($genre == "gewoon" || $genre == "") {
    $rizivListel = "9-47011-97-001";
    $titelListel = "GDT LISTEL vzw";
    $genreCode = "";
  }
  else if ($genre == "H") {
    $rizivListel = "947-046-62-001";
    $titelListel = "LISTEL vzw - SEL Hasselt";
    $genreCode = "H/";
  }
  else {
    $rizivListel = "947-047-61-001";
    $titelListel = "LISTEL vzw - SEL Genk";
    $genreCode = "G/";
  }
  $kenmerk = "GDT/$factuurMaand/$factuurJaar/{$genreCode}{$mutualiteit['nr']}";

  $pdf->ezSetY(210*$mm-15*$mm);

  $pdf2->ezSetY(210*$mm-15*$mm);



  $mutualiteitNr = $pdf->ezStartPageNumbers(275*$mm,15*$mm,10,'','p.{PAGENUM}/{TOTALPAGENUM}',1);

  $mutualiteitNr2 = $pdf2->ezStartPageNumbers(275*$mm,15*$mm,10,'','p.{PAGENUM}/{TOTALPAGENUM}',1);



  $options = array('aleft'=>35*$mm,

                 'aright' => 841.89-35*$mm,

                 'justification' => 'center');

  $pdf->ezText("<b>BIJLAGE 65</b>",11,$options);

  $pdf2->ezText("<b>BIJLAGE 65</b>",11,$options);

  $pdf->ezText("Geïntegreerde diensten voor thuisverzorging: factuur",11,$options);

  $pdf2->ezText("Geïntegreerde diensten voor thuisverzorging: CREDITNOTA",11,$options);



  $pdf->ezSetY(210*$mm-25*$mm);

  $pdf2->ezSetY(210*$mm-25*$mm);

  $options = array('aleft'=>210*$mm,

                 'aright' => 841.89-35*$mm,

                 'justification' => 'left');

  $pdf->ezText("{$mutualiteit['naam']}",11,$options);

  $pdf2->ezText("{$mutualiteit['naam']}",11,$options);

  $pdf->ezText("{$mutualiteit['dienst']}",11,$options);

  $pdf2->ezText("{$mutualiteit['dienst']}",11,$options);

  $pdf->ezText("{$mutualiteit['adres']}",11,$options);

  $pdf2->ezText("{$mutualiteit['adres']}",11,$options);

  $pdf->ezText("{$mutualiteit['dlzip']} {$mutualiteit['dlnaam']}",11,$options);

  $pdf2->ezText("{$mutualiteit['dlzip']} {$mutualiteit['dlnaam']}",11,$options);



  $pdf->ezSetY(210*$mm-25*$mm);

  $pdf2->ezSetY(210*$mm-25*$mm);

  $options = array('aleft'=>35*$mm,

                 'aright' => 841.89-35*$mm,

                 'justification' => 'left');

  $pdf->ezText("RIZIV-nr: $rizivListel",11,$options);
  $pdf2->ezText("RIZIV-nr: $rizivListel",11,$options);

  $pdf->ezText("$titelListel - ondernemingsnummer 0446.055.785",11,$options);
  $pdf2->ezText("$titelListel - ondernemingsnummer 0446.055.785",11,$options);

  $pdf->ezText("A. Rodenbachstraat 29 bus 1",11,$options);

  $pdf2->ezText("A. Rodenbachstraat 29 bus 1",11,$options);

  $pdf->ezText("B-3500  HASSELT",11,$options);

  $pdf2->ezText("B-3500  HASSELT",11,$options);

  $pdf->ezText("011/81.94.70",11,$options);

  $pdf2->ezText("011/81.94.70",11,$options);

  $pdf->ezText("\nFactuurnummer: $factuurJaar/{$genreCode}$factuurNr-{$mutualiteit['nr']} - Factuur datum: $factuurDatum - Ons kenmerk : $factuurJaar/{$genreCode}$factuurNr-{$mutualiteit['nr']}\n",11,$options);

  $pdf2->ezText("\nCREDITNOTA-nr:                          /                       - Oorspronkelijke factuur: $factuurJaar/{$genreCode}$factuurNr-{$mutualiteit['nr']} van $factuurDatum\n",11,$options);





  $overlegQuery = "select overleg.id, locatie, code, datum, naam, voornaam, rijksregister, patient.type, geld_voor_hvl
                   from overleg, patient
                   where overleg.patient_code = patient.code

                         and patient.mut_id = {$mutualiteit['id']}

                         and overleg.factuur_code = '$factuurID' order by datum asc";


//die($overlegQuery);


  $resultOverleg = mysql_query($overlegQuery);



  $listelElders = $listelEldersPVS = $listelregistratie = $listelregistratiePVS = $listelThuis = $listelThuisPVS = 0;

  for ($i=0; $i<mysql_num_rows($resultOverleg); $i++) {

    $rij = mysql_fetch_assoc($resultOverleg);

    foreach ($rij as $key => $value) {

      $rij[$key] = utf8_decode($rij[$key]);

    }



    $tabel[$i]["Identificatie\nvan de patiënt\n(naam)"]= "{$rij['naam']} {$rij['voornaam']}";

    $tabel[$i]["Rijksregisternummer\nvan de patiënt"]= "{$rij['rijksregister']}";

    $tabelBis[$i]["Identificatie\nvan de patiënt\n(naam)"]= "{$rij['naam']} {$rij['voornaam']}";

    $tabelBis[$i]["Rijksregisternummer\nvan de patiënt"]= "{$rij['rijksregister']}";





    $mooieDatum = substr($rij['datum'],6,2) . "/" . substr($rij['datum'],4,2) . "/" . substr($rij['datum'],0,4);

    $tabel[$i]["Datum van\n het overleg"]= $mooieDatum;

    $tabelBis[$i]["Datum van\n het overleg"]= $mooieDatum;



    if ($rij['locatie']==0) $locatieNummer = 1; else $locatieNummer = 2;

    $tabel[$i]["Overleg\nthuis=1\nelders=2"]= $locatieNummer;

    $tabelBis[$i]["Overleg\nthuis=1\nelders=2"]= $locatieNummer;



    // bepaal het te gebruiken tarief

    $hetTarief = rizivTarief($rij['datum']);

    if ($rij['type']==1) {

      // PVS-patient

      if ($rij['locatie'] == 0 || $rij['locatie'] == 2) {

        $overlegTarief = "thuisPVS";

        $registratieTarief = "registratiePVS";

      }

      else {

        $overlegTarief = "eldersPVS";

        $registratieTarief = "registratiePVS";

      }

    }

    else {

      if ($rij['locatie'] == 0) {

        $overlegTarief = "thuis";

        $registratieTarief = "registratie";

      }

      else {

        $overlegTarief = "elders";

        $registratieTarief = "registratie";

      }

    }

    // listel registratievergoeding toekennen

    $aantalKeer["$rizivListel ($titelListel)"][$registratieTarief]++;

    $vergoeding["$rizivListel ($titelListel)"] += $hetTarief[$registratieTarief];

    $reknr["$rizivListel ($titelListel)"] = "IBAN BE31735010958055\nBIC: KRED BE BB";

    // riziv-nummers ophalen van alle ZVL-ers

    $queryZVL = "

         SELECT

               concat(h.naam, ' ' , h.voornaam) as naam,

                h.riziv1,

                h.riziv2,

                h.riziv3,

                h.reknr,
                h.iban,
                h.bic,

                org.reknr as org_reknr,
                org2.reknr as org2_reknr,
                org.iban as org_iban,
                org2.iban as org2_iban,
                org.bic as org_bic,
                org2.bic as org2_bic,

                f.rangorde

            FROM

                afgeronde_betrokkenen bl,

                hulpverleners h,

                functies f,

                organisatie org left join organisatie org2 on (org.hoofdzetel = org2.id)

            WHERE
                overleggenre = 'gewoon' AND
                h.fnct_id = f.id AND

                bl.persoon_id = h.id AND

                bl.genre = 'hulp' AND

                bl.overleg_id = {$rij['id']} AND

                bl.aanwezig=1 AND

                h.organisatie = org.id AND

                org.genre = 'ZVL'

            ORDER BY

                f.rangorde, bl.id"; // Query



      if ($resultZVL=mysql_query($queryZVL))

         {

         $rangorde = -1;

         $aantal = 0;

         $rizivTotaal = "";

         for ($ii=0; $ii < mysql_num_rows ($resultZVL) && $aantal < 4; $ii++)

            {

            $recordsZVL= mysql_fetch_array($resultZVL);

            if ($recordsZVL['iban']=="") {
              $recordsZVL['reknr']=$recordsZVL['org_reknr'];
              $recordsZVL['iban']=$recordsZVL['org_iban'];
              $recordsZVL['bic']=$recordsZVL['org_bic'];
            }
            if ($recordsZVL['iban']=="") {
              $recordsZVL['reknr']=$recordsZVL['org2_reknr'];
              $recordsZVL['iban']=$recordsZVL['org2_iban'];
              $recordsZVL['bic']=$recordsZVL['org2_bic'];
            }

            foreach ($recordsZVL as $key => $value) {

              $recordsZVL[$key] = utf8_decode($recordsZVL[$key]);

            }

            //-------------------------------------------------------------------

            // heeft deze hvl een rizivnr zo ja corrigeer het met voorloopnullen

            if ($recordsZVL['riziv1']==0)

                {$rizivnr="ONBEKEND!!";}

            else

                {

                $rizivnr1=substr($recordsZVL['riziv1'],0,1)."-".substr($recordsZVL['riziv1'],1,5)."-";

                $rizivnr2=      ($recordsZVL['riziv2']<10)      ?"0".$recordsZVL['riziv2']:$recordsZVL['riziv2'];

                $rizivnr3=      ($recordsZVL['riziv3']<100)     ?"0".$recordsZVL['riziv3']:$recordsZVL['riziv3'];

                $rizivnr3=      ($recordsZVL['riziv3']<10)      ?"0".$rizivnr3:$rizivnr3;

                $rizivnr=$rizivnr1.$rizivnr2."-".$rizivnr3;

                }



            if ($rangorde != $recordsZVL['rangorde']) {

               $rangorde = $recordsZVL['rangorde'];

               $aantal++;

               $rizivTotaal = $rizivTotaal . " $rizivnr ";

               $aantalKeer["$rizivnr ({$recordsZVL['naam']})"][$overlegTarief]++;

               $vergoeding["$rizivnr ({$recordsZVL['naam']})"] += $hetTarief[$overlegTarief];

               $reknr["$rizivnr ({$recordsZVL['naam']})"] = "IBAN {$recordsZVL['iban']}\nBIC: {$recordsZVL['bic']}";

            }

        }

     }

     $rizivTotaal = $rizivTotaal . " $rizivListel ";

     $tabel[$i]["Deelnemende zorgverleners (RIZIV-nummers)"]=$rizivTotaal;

     $tabelBis[$i]["Deelnemende zorgverleners (RIZIV-nummers)"]=$rizivTotaal;

     if ($aantal < 4) {
       if ($rij['geld_voor_hvl']==1) {
         $aantal++; // Listel krijgt een vergoeding voor de pot
         $aantalKeer["$rizivListel ($titelListel)"][$overlegTarief]++;
         $vergoeding["$rizivListel ($titelListel)"] += $hetTarief[$overlegTarief];
       }
     }



    //----------------------------------------------------------

    $subtotaal = $aantal * $hetTarief[$overlegTarief]+$hetTarief[$registratieTarief];

    $tabel[$i]["Bedrag in €\nper patiënt\n(Incl. Registratie-\ntegemoetkoming)"]="€$subtotaal";

    $tabelBis[$i]["Bedrag in €\nper patiënt\n(Incl. Registratie-\ntegemoetkoming)"]="-€$subtotaal";

    $totaal += $subtotaal;







  }

  $tabel[$i]["Deelnemende zorgverleners (RIZIV-nummers)"]="TOTAAL";

  $tabel[$i]["Bedrag in €\nper patiënt\n(Incl. Registratie-\ntegemoetkoming)"]="€$totaal";

  $tabelBis[$i]["Deelnemende zorgverleners (RIZIV-nummers)"]="TOTAAL";

  $tabelBis[$i]["Bedrag in €\nper patiënt\n(Incl. Registratie-\ntegemoetkoming)"]="-€$totaal";









  $pdf->ezTable($tabel);

  $pdf2->ezTable($tabelBis);



  



  // en nu een tabel per zorgverlener

  $pdf->ezSetDy(-5*$mm);

  $pdf2->ezSetDy(-5*$mm);



  $nr = 0;

  foreach ($vergoeding as $zvl => $bedrag) {

    $refNr = $nr + 1;

    $tabel2[$nr]["Referentie"] = "$factuurJaar/{$genreCode}$factuurNr\n-{$mutualiteit['nr']}-$refNr";

    $tabel2[$nr]["Identificatie\nvan de zorgverlener\n(RIZIV-nummer)"]= "$zvl";

    $tabel2[$nr]["Aantal\nPseudocodes\n773172 en 776532"] = max(0,$aantalKeer[$zvl]['thuis']) . " + " . max(0,$aantalKeer[$zvl]['thuisPVS']) . " = " . ($aantalKeer[$zvl]['thuis'] + $aantalKeer[$zvl]['thuisPVS']);

    $tabel2[$nr]["Aantal\nPseudocodes\n773216 en 776554"] = max(0,$aantalKeer[$zvl]['elders']) . " + " . max(0,$aantalKeer[$zvl]['eldersPVS']) . " = " . ($aantalKeer[$zvl]['elders'] + $aantalKeer[$zvl]['eldersPVS']);

    $tabel2[$nr]["Aantal\nPseudocodes\n773290 en 776576"] = max(0,$aantalKeer[$zvl]['registratie']) . " + ". max(0,$aantalKeer[$zvl]['registratiePVS']) . " = " . ($aantalKeer[$zvl]['registratie'] + $aantalKeer[$zvl]['registratiePVS']);

    $tabel2[$nr]["Rekeningnummer"] = $reknr[$zvl];

    $tabel2[$nr]["Bedrag in €\nper zorgverlener"] = "€$bedrag";

    $tabel2Bis[$nr]["Referentie"] = "$factuurJaar/$factuurNr-{$mutualiteit['nr']}-$refNr";

    $tabel2Bis[$nr]["Identificatie\nvan de zorgverlener\n(RIZIV-nummer)"]= "$zvl";

    $tabel2Bis[$nr]["Aantal\nPseudocodes\n773172 en 776532"] = max(0,$aantalKeer[$zvl]['thuis']) . " + " . max(0,$aantalKeer[$zvl]['thuisPVS']) . " = " . ($aantalKeer[$zvl]['thuis'] + $aantalKeer[$zvl]['thuisPVS']);

    $tabel2Bis[$nr]["Aantal\nPseudocodes\n773216 en 776554"] = max(0,$aantalKeer[$zvl]['elders']) . " + " . max(0,$aantalKeer[$zvl]['eldersPVS']) . " = " . ($aantalKeer[$zvl]['elders'] + $aantalKeer[$zvl]['eldersPVS']);

    $tabel2Bis[$nr]["Aantal\nPseudocodes\n773290 en 776576"] = max(0,$aantalKeer[$zvl]['registratie']) . " + ". max(0,$aantalKeer[$zvl]['registratiePVS']) . " = " . ($aantalKeer[$zvl]['registratie'] + $aantalKeer[$zvl]['registratiePVS']);

    $tabel2Bis[$nr]["Rekeningnummer"] = $reknr[$zvl];

    $tabel2Bis[$nr]["Bedrag in €\nper zorgverlener"] = "-€$bedrag";

    $totaal2 += $bedrag;

    $nr++;

  }





  $tabel2[$nr]["Rekeningnummer"]="TOTAAL";

  $tabel2[$nr]["Bedrag in €\nper zorgverlener"]="€$totaal2";

  $tabel2Bis[$nr]["Rekeningnummer"]="TOTAAL";

  $tabel2Bis[$nr]["Bedrag in €\nper zorgverlener"]="-€$totaal2";



  $pdf->ezTable($tabel2);

  $pdf2->ezTable($tabel2Bis);





  $pdf->ezText("\n\nDe verschuldigde bedragen storten met de vermelding : zie kolom referentie",11,$options);

  $pdf->ezText("Rekeningnummer / facturerende instelling : 735-0109580-55 - IBAN BE31735010958055 - BIC: KRED BE BB",11,$options);

  $pdf->ezText("Datum, naam en hoedanigheid van de ondertekenaar : $factuurDatum, Anick Noben, administratie LISTEL vzw",11,$options);

  $pdf->ezText("Handtekening : ",11,$options);

  //$pdf2->ezText("\n\nDe verschuldigde bedragen storten met de vermelding : zie kolom referentie",11,$options);

  //$pdf2->ezText("Rekeningnummer GDT / facturerende instelling : 735-0109580-55",11,$options);

  $pdf2->ezText("Datum, naam en hoedanigheid van de ondertekenaar :            /              /        , Anick Noben, administratie LISTEL vzw",11,$options);

  $pdf2->ezText("Handtekening : ",11,$options);



  $pdf2->ezStopPageNumbers(1,1,$mutualiteitNr);

  $pdf2->ezStopPageNumbers(1,1,$mutualiteitNr2);



/******************************************/

/*  PDF WEGSCHRIJVEN NAAR BESTAND  */

/******************************************/



  $pdfcode = $pdf->ezOutput();

  $dir = '../factuurdinges17';

  //save the file
  if ($genre == "gewoon") $genreInfo = "";
  else $genreInfo = "_$genre";

  $fname = $dir."/factuur_{$factuurJaar}{$genreInfo}_{$factuurNr}.pdf";

  $fp = fopen($fname,'w');

  fwrite($fp,$pdfcode);

  fclose($fp);



  $pdfcode2 = $pdf2->ezOutput();

  $dir = '../factuurdinges17';

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



  print("<li><a href=\"../factuurdinges17/factuur_{$factuurJaar}{$genreInfo}_{$factuurNr}.pdf\">factuur  {$factuurNr} van {$factuurJaar} voor {$mutualiteit['naam']} {$genreInfo}</a></li>");



}





   require("../includes/clearSessie.inc");

   require("../includes/dbconnect2.inc");

   $paginanaam="Aanmaak facturen GDT";

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

if (isset($_GET['deelvzw'])) {
  $genre = $_GET['deelvzw'];
}
else {
  $genre = "gewoon";
}


$pdf =& new Cezpdf('A4', 'landscape');

//$pdf->ezSetMargins(0,0,0,0);

$pdf->selectFont('../ezpdf/fonts/Times-Roman.afm');



$zoekViaNummer = false;

if (isset($_GET['factuurID'])) {

  $zoekViaNummer = true;

  $zoekFactuurMaandQry = "select * from factuurmaand where id = {$_GET['factuurID']}";

  $zoekFactuurMaand =  mysql_query($zoekFactuurMaandQry) or die ($zoekFactuurMaandQry . "<br/>" . mysql_error());

  if (mysql_num_rows($zoekFactuurMaand)==0) die ("Deze factuur bestaat niet!");

  if (mysql_num_rows($zoekFactuurMaand)>1) die ("Hey: er zijn zo meer facturen???");

  $factuurMaandRecord = mysql_fetch_assoc($zoekFactuurMaand);

  $factuurMaand = $factuurMaandRecord['maand'];

  $factuurJaar = $factuurMaandRecord['jaar'];

  $factuurMut = $factuurMaandRecord['mutualiteit'];



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




  $activeerCreditQry = "update factuurmaand

                            set creditActief = 1

                         where id = {$_POST['teCrediterenFactuur']}";

  $getCreditNotaQry = "select * from factuurmaand where id = {$_POST['teCrediterenFactuur']}";



  if ((mysql_query($activeerCreditQry)) && ($creditNotaResult = mysql_query($getCreditNotaQry))) {

    $creditNotaRij = mysql_fetch_assoc($creditNotaResult);
    print("<h4>Creditnota  van factuur <a href=\"../factuurdinges17/creditnota_{$creditNotaRij['factuurFile']}\">{$creditNotaRij['nummer']} van {$creditNotaRij['jaar']}</a></h4>\n");

    // facturen na creditnota's moeten in het voorgaande jaar blijven
    if ($creditNotaRij['jaar'] < date("Y")) {
      $factuurJaar = $creditNotaRij['jaar']; // het oorspronkelijke jaar van de creditnota
      $factuurMaand = 13; // de 13e maand voor de nieuwe maand bij creditnota's na het einde van het jaar
    }
    else {
      $factuurJaar = date("Y"); // het jaar waarover de overleggen gaan
      $factuurMaand = date("m"); // de maand waarover de overleggen gaan
    }
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

    $factuurInfo = getFactuurInfoVanCreditNota($factuurMaand,$factuurJaar, $rijMutualiteit, $_POST['teCrediterenFactuur'], $_POST['genre']);

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