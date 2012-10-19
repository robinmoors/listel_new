<?php

ob_start();

session_start();



   require("../includes/clearSessie.inc");

   require("../includes/dbconnect2.inc");

   if (IsSet($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan"))

      {



$bestandsnaam = "uitbetaling_TP";



$begindatum = "{$_POST['beginjaar']}{$_POST['beginmaand']}{$_POST['begindag']}";

$einddatum = "{$_POST['eindjaar']}{$_POST['eindmaand']}{$_POST['einddag']}";



if ($begindatum == "") $begindatum = "18999999";

if ($einddatum == "") $einddatum = "20999999";





$queryAllesGecontroleerd = "

     select * from overleg

     where genre = 'TP' and keuze_vergoeding = 1 and controle != 1 and (overleg.datum >= $begindatum and overleg.datum <= $einddatum)";





if (mysql_num_rows(mysql_query($queryAllesGecontroleerd))>0) {

  $csvOutput = "Nog niet alle overleggen uit deze periode zijn afgerond én gecontroleerd!!\n";

  $csvOutput .= "$csvOutput";

  $csvOutput .= "$csvOutput";

  $csvOutput .= "$csvOutput\n\n";

}


initRiziv();

$hetTarief = rizivTarief($begindatum);
preset($hetTarief['nietzhTP']);
preset($hetTarief['zhTP']);
preset($hetTarief['registratie_nietzhTP']);
preset($hetTarief['registratie_zhTP']);



/*********************************************************************/

/*   meest recente gegevens zoeken van de deelnemers aan het overleg */

/*********************************************************************/

function zoekMeestRecente($id) {

  $qry = "select * from hulpverleners where vervangt = $id";

  $result = mysql_query($qry);

  if (mysql_num_rows($result) == 0) {

    return -1;

  }

  else {

    $recenter = mysql_fetch_assoc($result);

    foreach ($recenter as $key => $value) {

      $recenter[$key] = utf8_decode($recenter[$key]);

    }

    $recursief = zoekMeestRecente($recenter['id']);

    if ($recursief == -1)

      return $recenter['id'];

    else

      return $recursief;

  }

}



$qryDeelnemers = "select hvl.* from (afgeronde_betrokkenen afg

                                   inner join overleg on (overleggenre = 'gewoon' and
                                                          overleg.genre = 'TP' and
                                                          keuze_vergoeding = 1 and

                                                          controle = 1 and

                                                          (overleg.datum >= $begindatum and overleg.datum <= $einddatum) and

                                                          overleg.id = afg.overleg_id))

                               inner join hulpverleners hvl on (hvl.id = afg.persoon_id and afg.genre = 'hulp' and hvl.actief=0) ";

// DEBUG
//$csvOutput .= $qryDeelnemers . "\n";
//die($csvOutput);

$resultDeelnemers = mysql_query($qryDeelnemers) or die("$qryDeelnemers " . mysql_error());



$vervanger = Array();



for ($m = 0; $m < mysql_num_rows($resultDeelnemers); $m++) {

  $deelnemer = mysql_fetch_assoc($resultDeelnemers);

    foreach ($deelnemer as $key => $value) {

      $deelnemer[$key] = utf8_decode($deelnemer[$key]);

    }

  $recentste = zoekMeestRecente($deelnemer['id']);

  if ($recentste != -1) {

    $vervanger[$deelnemer['id']] = $recentste;

  }

  

}

// DEBUG
//$csvOutput .= "alles vervangen door de meest recente\n";
//die($csvOutput);


//print_r($vervanger);

//die("$qryDeelnemers  : " . mysql_num_rows($resultDeelnemers));





/******************************/

/*  AANWEZIGHEDEN THERAPEUTISCHE PROJECTEN  */

/******************************/



function toonProject($projectInfo) {

/***** begin functie *****/

global $hetTarief, $begindatum, $einddatum, $sep, $csvOutput, $vervanger;



// variabelen voor de facturatie

$totaalBedrag = 0;

$totaalBedragGDT = 0;

$vergoedOverleg = Array();

// bevat alle nummers van vergoede overleggen; alleen de waarde is belangrijk



$aantalOrganisatie = Array();

// index is id van organisatie

// waarde is aantal betaalde aanwezigheden



$aantalZVL = Array();

// index is id van zorgverlener

// waarde is aantal betaalde aanwezigheden



$aantalVergoedingen = 0;

// controlegetal voor aantalVergoedingen

// zou gelijk moeten zijn aan som van $aantalOrganisatie en $aantalZVL









/*********** BEGIN ORGPERSOON ********************/

$queryOrgPersoon = "

     select overleg.id as overleg_id, overleg.datum as datum, patient.code as ZP, patient.naam as patient_naam, patient.voornaam as patient_voornaam,

            v.nr as mut, patient.mutnr as id_patient,

            factuurmaand.factuurdatum as factuurdatum,

            organisatie.naam as org_hvl, organisatie.id as org_id,  organisatie.hoofdzetel,

            (hoofdzetel=-1)*organisatie.id+(hoofdzetel<>-1)*hoofdzetel as echte_org,

            hvl.naam as hvl_naam, hvl.voornaam as hvl_voornaam,

            lijst.genre as hoedanigheid,

            {$hetTarief['zhTP']} * (overleg.locatie=2) +  {$hetTarief['nietzhTP']} * (overleg.locatie<>2) as BEDRAG,

            {$hetTarief['registratie_zhTP']} * (overleg.locatie=2) +  {$hetTarief['registratie_nietzhTP']} * (overleg.locatie<>2) as BEDRAG_GDT





     from (((((factuurmaand inner join overleg on overleg.factuur_code = factuurmaand.id and afgerond = 1
                                                  and keuze_vergoeding = 1
                                                  and (overleg.datum >= $begindatum and overleg.datum <= $einddatum)
                                                  )
           inner join patient on overleg.patient_code = patient.code and overleg.genre = 'TP')
            inner join patient_tp on patient_tp.patient = patient.code
                                  and patient_tp.project = {$projectInfo['id']}
                                  and patient_tp.begindatum <= concat(substring(overleg.datum,1,4),'-',substring(overleg.datum,5,2),'-',substring(overleg.datum,7,2))
                                  and (patient_tp.einddatum is NULL or patient_tp.einddatum >= concat(substring(overleg.datum,1,4),'-',substring(overleg.datum,5,2),'-',substring(overleg.datum,7,2)))
            )
             inner join verzekering as v on patient.mut_id = v.id)
              inner join afgeronde_betrokkenen as lijst on overleggenre = 'gewoon' and lijst.overleg_id = overleg.id and lijst.genre = 'orgpersoon' and aanwezig = 1)
               inner join hulpverleners as hvl on (lijst.persoon_id = hvl.id)
                inner /* was left */ join organisatie on (hvl.organisatie = organisatie.id)
                 left join functies on (hvl.fnct_id = functies.id)
     order by overleg.datum, ZP, (hoofdzetel=-1)*organisatie.id+(hoofdzetel<>-1)*hoofdzetel, lijst.id asc";
     // was functies.groep_id = 1
//die($query);

$result=mysql_query($queryOrgPersoon) or die(mysql_error() . "<br /> $queryOrgPersoon");



if (mysql_num_rows($result) > 0) {



  $begin = "{$_POST['begindag']}/{$_POST['beginmaand']}/{$_POST['beginjaar']}";

  $eind = "{$_POST['einddag']}/{$_POST['eindmaand']}/{$_POST['eindjaar']}";

  $csvOutput .= "\n\nAanwezigheden op te vergoeden THERAPEUTISCHE overlegggen van $begin tot $eind\nTherapeutisch project {$projectInfo['nummer']} {$projectInfo['naam']}\n\n";







  $aantalKolommen = mysql_num_fields($result);

  for ($i = 0; $i < $aantalKolommen; $i++) {

    $field = mysql_fetch_field($result);

    $kolom[$i] = $field->name;

    $csvOutput .= '"'. $kolom[$i] . "\"$sep";

  }

  $csvOutput .= "\"POT\"$sep";

  $csvOutput .= "\n";

}



$vorigeDatum = -1;

$vorigePatient = -1;

$vorigeOrg = -1;



for ($i=0; $i < mysql_num_rows($result); $i++) {

  $rij = mysql_fetch_array($result);

  foreach ($rij as $key => $value) {

    $rij[$key] = utf8_decode($rij[$key]);

  }

  if ($vorigeDatum != $rij['datum'] || $vorigePatient != $rij['ZP']) {

    // nieuw overleg

    $totaalBedrag += $rij['BEDRAG'];

    $totaalBedragGDT += $rij['BEDRAG_GDT'];

    $vergoedOverleg[$rij['overleg_id']] = $rij['overleg_id'];

    $aantalOrganisatie[$rij['echte_org']]++;

    $aantalVergoedingen++;

    

    $rij['pot'] = "JA";

    $vorigeDatum = $rij['datum'];

    $vorigePatient = $rij['ZP'];

     if ($rij['hoofdzetel']==-1) {

        $vorigeOrg = $rij['org_id'];

     }

     else {

       $vorigeOrg = $rij['hoofdzetel'];

     }

  }

  else { // dit overleg heeft al een bedrag gekregen

     $rij['BEDRAG'] = "";

     $rij['BEDRAG_GDT'] = "";

     if ($rij['hoofdzetel']==-1) {

        $huidigeOrg = $rij['org_id'];

     }

     else {

       $huidigeOrg = $rij['hoofdzetel'];

     }

     if ($vorigeOrg != $huidigeOrg || $rij['org_id'] == 999 || $rij['org_id'] == 998 || $rij['org_id'] == 997 || $rij['org_id'] == 996) {

       // een nieuwe organisatie, dus bedrag leeg maken

       $vorigeOrg = $huidigeOrg;

       $rij['pot'] = "JA";

       $aantalOrganisatie[$rij['echte_org']]++;

       $aantalVergoedingen++;

     }

     else {

       // dezelfde organisatie als daarnet

       $rij['pot'] = "nee";

     }

  }



  for ($j = 0; $j < $aantalKolommen; $j++) {

    $csvOutput .= '"' . $rij[$kolom[$j]] . "\"$sep";

  }

  $csvOutput .= '"' . $rij['pot'] . "\"$sep";

  $csvOutput .="$sep\n";

}



/*********** EINDE ORGPERSOON ********************/



/*********** BEGIN ZVL ********************/

$queryZVL = "

     select overleg.id as overleg_id, overleg.datum as datum, patient.code as ZP, patient.naam as patient_naam, patient.voornaam as patient_voornaam,

            v.nr as mut, patient.mutnr as id_patient,

            factuurmaand.factuurdatum as factuurdatum,

            organisatie.naam as org_hvl, ' ' as org_id,  functies.naam as hoofdzetel,

            hvl.id as echte_org, hvl.naam as hvl_naam, hvl.voornaam as hvl_voornaam,

            lijst.genre as hoedanigheid,

            {$hetTarief['zhTP']} * (overleg.locatie=2) +  {$hetTarief['nietzhTP']} * (overleg.locatie<>2) as BEDRAG,

            {$hetTarief['registratie_zhTP']} * (overleg.locatie=2) +  {$hetTarief['registratie_nietzhTP']} * (overleg.locatie<>2) as BEDRAG_GDT,

            functies.id as functie_id,

            hvl.id as hvl_id
     from (((((factuurmaand inner join overleg on overleg.factuur_code = factuurmaand.id
                                           and afgerond = 1 and keuze_vergoeding = 1 and (overleg.datum >= $begindatum and overleg.datum <= $einddatum)
                                           and overleg.genre = 'TP')
           inner join patient on overleg.patient_code = patient.code)
            inner join patient_tp on patient_tp.patient = patient.code
               and patient_tp.project = {$projectInfo['id']}
               and patient_tp.begindatum <= concat(substring(overleg.datum,1,4),'-',substring(overleg.datum,5,2),'-',substring(overleg.datum,7,2))
               and (patient_tp.einddatum is NULL or patient_tp.einddatum >= concat(substring(overleg.datum,1,4),'-',substring(overleg.datum,5,2),'-',substring(overleg.datum,7,2))))
             inner join verzekering as v on patient.mut_id = v.id)
              inner join afgeronde_betrokkenen as lijst on overleggenre = 'gewoon' and lijst.overleg_id = overleg.id and lijst.genre = 'hulp' and aanwezig = 1)
               inner join hulpverleners as hvl on lijst.persoon_id = hvl.id
                inner /* was left */ join organisatie on (hvl.organisatie = organisatie.id and organisatie.genre = 'ZVL')
                 left join functies on (hvl.fnct_id = functies.id)
     order by overleg.datum, ZP, functies.id, lijst.id asc";
     // was functies.groep_id = 1





//die($query);

$result=mysql_query($queryZVL) or die(mysql_error() . "<br /> $queryZVL");


//die("ok ZVL");
$vorigeDatum = -1;

$vorigePatient = -1;

$vorigeFunctie = -1;



for ($i=0; $i < mysql_num_rows($result); $i++) {

  $rij = mysql_fetch_array($result);

  foreach ($rij as $key => $value) {

    $rij[$key] = utf8_decode($rij[$key]);

  }



  if ($vervanger[$rij['hvl_id']] > 0) {

    $zvlID = $vervanger[$rij['hvl_id']];

  }

  else {

    $zvlID = $rij['hvl_id'];

  }



  if ($vorigeDatum != $rij['datum'] || $vorigePatient != $rij['ZP']) {

    // nieuw overleg

    if (!in_array($rij['overleg_id'],$vergoedOverleg)) {

      // en nog niet vergoed!

      $totaalBedrag += $rij['BEDRAG'];

      $totaalBedragGDT += $rij['BEDRAG_GDT'];

      $vergoedOverleg[$rij['overleg_id']] = $rij['overleg_id'];

    }

    else {

     $rij['BEDRAG'] = "";

     $rij['BEDRAG_GDT'] = "";

    }



    $aantalZVL[$zvlID]++;

    $aantalVergoedingen++;



    $rij['pot'] = "JA";



    $vorigeDatum = $rij['datum'];

    $vorigePatient = $rij['ZP'];

    $vorigeFunctie = $rij['functie_id'];

  }

  else { // dit overleg heeft al een bedrag gekregen

     $rij['BEDRAG'] = "";

     $rij['BEDRAG_GDT'] = "";

     $huidigeFunctie = $rij['functie_id'];



     if ($vorigeFunctie != $huidigeFunctie) {

       // een nieuwe functie, dus terug in de pot

       $vorigeFunctie = $huidigeFunctie;

       $rij['pot'] = "JA";

       $aantalZVL[$zvlID]++;

       $aantalVergoedingen++;

     }

     else {

       // dezelfde functie als daarnet

       $rij['pot'] = "nee";

     }



  }

  for ($j = 0; $j < $aantalKolommen; $j++) {

    $csvOutput .= '"' . $rij[$kolom[$j]] . "\"$sep";

  }

  $csvOutput .= '"' . $rij['pot'] . "\"$sep";

  $csvOutput .="$sep\n";

}



/*********** EINDE ZVL ********************/



/*********** BEGIN HVL ********************/

$queryHVL = "

     select overleg.id as overleg_id, overleg.datum as datum, patient.code as ZP, patient.naam as patient_naam, patient.voornaam as patient_voornaam,

            v.nr as mut, patient.mutnr as id_patient,

            factuurmaand.factuurdatum as factuurdatum,

            organisatie.naam as org_hvl, organisatie.id as org_id,  organisatie.hoofdzetel,

            (hoofdzetel=-1)*organisatie.id+(hoofdzetel<>-1)*hoofdzetel as echte_org,

            hvl.id as hvl_id, hvl.naam as hvl_naam, hvl.voornaam as hvl_voornaam,

            lijst.genre as hoedanigheid,

            {$hetTarief['zhTP']} * (overleg.locatie=2) +  {$hetTarief['nietzhTP']} * (overleg.locatie<>2) as BEDRAG,

            {$hetTarief['registratie_zhTP']} * (overleg.locatie=2) +  {$hetTarief['registratie_nietzhTP']} * (overleg.locatie<>2) as BEDRAG_GDT

     from (factuurmaand inner join overleg on overleg.factuur_code = factuurmaand.id
                                         and afgerond = 1 and keuze_vergoeding = 1
                                         and (overleg.datum >= $begindatum and overleg.datum <= $einddatum)
                                         and overleg.genre = 'TP'
          )
          inner join patient on (overleg.patient_code = patient.code)
          inner join patient_tp on (patient_tp.patient = patient.code
               and patient_tp.project = {$projectInfo['id']}
               and patient_tp.begindatum <= concat(substring(overleg.datum,1,4),'-',substring(overleg.datum,5,2),'-',substring(overleg.datum,7,2))
               and (patient_tp.einddatum is NULL or patient_tp.einddatum >= concat(substring(overleg.datum,1,4),'-',substring(overleg.datum,5,2),'-',substring(overleg.datum,7,2)))
          )
          inner join verzekering as v on (patient.mut_id = v.id)
          inner join afgeronde_betrokkenen as lijst on (overleggenre = 'gewoon'
               and lijst.overleg_id = overleg.id
               and lijst.genre = 'hulp'
               and aanwezig = 1
          )
          inner join hulpverleners as hvl on (lijst.persoon_id = hvl.id)
          inner /* was left */  join organisatie on (hvl.organisatie = organisatie.id
                                    and (organisatie.genre = 'HVL' or organisatie.genre = 'XVL' or organisatie.genre = 'XVLP'))
          left join functies on (hvl.fnct_id = functies.id)
     order by overleg.datum, ZP, (hoofdzetel=-1)*organisatie.id+(hoofdzetel<>-1)*hoofdzetel, lijst.id asc";



     // was functies.groep_id = 1





//die($query);

$result=mysql_query($queryHVL) or die(mysql_error() . "<br /> $queryHVL");





$vorigeDatum = -1;

$vorigePatient = -1;

$vorigeOrg = -1;



for ($i=0; $i < mysql_num_rows($result); $i++) {

  $rij = mysql_fetch_array($result);

  foreach ($rij as $key => $value) {

    $rij[$key] = utf8_decode($rij[$key]);

  }

  if ($vorigeDatum != $rij['datum'] || $vorigePatient != $rij['ZP']) {

    // nieuw overleg

    if (!in_array($rij['overleg_id'],$vergoedOverleg)) {

      // en nog niet vergoed!

      $totaalBedrag += $rij['BEDRAG'];

      $totaalBedragGDT += $rij['BEDRAG_GDT'];

      $vergoedOverleg[$rij['overleg_id']] = $rij['overleg_id'];

    }

    else {

     $rij['BEDRAG'] = "";

     $rij['BEDRAG_GDT'] = "";

    }



    $aantalOrganisatie[$rij['echte_org']]++;

    $aantalVergoedingen++;

    $rij['pot'] = "JA";



    $vorigeDatum = $rij['datum'];

    $vorigePatient = $rij['ZP'];

     if ($rij['hoofdzetel']==-1) {

        $vorigeOrg = $rij['org_id'];

     }

     else {

       $vorigeOrg = $rij['hoofdzetel'];

     }

  }

  else { // dit overleg heeft al een bedrag gekregen

     $rij['BEDRAG'] = "";

     $rij['BEDRAG_GDT'] = "";

     if ($rij['hoofdzetel']==-1) {

        $huidigeOrg = $rij['org_id'];

     }

     else {

       $huidigeOrg = $rij['hoofdzetel'];

     }

     if ($rij['org_id'] == 999 || $rij['org_id'] == 998 || $rij['org_id'] == 997 || $rij['org_id'] == 996) {

       // een zelfstandig iemand, dus sowieso in de pot

       $vorigeOrg = $huidigeOrg;

       $aantalZVL[$rij['hvl_id']]++;

       $aantalVergoedingen++;

       $rij['pot'] = "JA";

     }

     else if ($vorigeOrg != $huidigeOrg) {

       // een nieuwe organisatie, dus terug in de pot

       $vorigeOrg = $huidigeOrg;

       $aantalOrganisatie[$rij['echte_org']]++;

       $aantalVergoedingen++;

       $rij['pot'] = "JA";

     }

     else {

       // dezelfde organisatie als daarnet

       $rij['pot'] = "nee";

     }



  }

  for ($j = 0; $j < $aantalKolommen; $j++) {

    $csvOutput .= '"' . $rij[$kolom[$j]] . "\"$sep";

  }

  $csvOutput .= '"' . $rij['pot'] . "\"$sep";

  $csvOutput .="$sep\n";

  

}



/*********** EINDE HVL ********************/



// controle

if (array_sum($aantalOrganisatie)+array_sum($aantalZVL) != $aantalVergoedingen) {

  die("<h1>De controle wijst uit dat er een fout zit in de berekening! Contacteer Kris Aerts!</h1>");

}



if ($totaalBedrag > 0) {

  $totaalBedragString = str_replace(".",",",$totaalBedrag);

  $totaalBedragGDTString = str_replace(".",",",$totaalBedragGDT);

  $csvOutput .= "\nTOTAAL VOOR Therapeutisch project {$projectInfo['nummer']} {$projectInfo['naam']}\n";

  $csvOutput .= "€$totaalBedragString voor $aantalVergoedingen personen + $totaalBedragGDTString voor Listel.\n\n";

  $csvOutput .= "Organisatie $sep Adres $sep Postcode $sep Gemeente $sep Rekening $sep Aantal personen $sep Bedrag pp $sep Totaal\n";



  /********* TOON NU DE BEDRAGEN PER ORGANISATIE  ****/

  foreach ($aantalOrganisatie as $org_id => $aantalVoorOrg) {

    $queryOrg = "select organisatie.naam, reknr,  iban, bic, adres, dlzip, dlnaam from organisatie, gemeente where organisatie.id = $org_id and gemeente.id = gem_id";

    $resultOrg = mysql_query($queryOrg);

    if (mysql_num_rows($resultOrg) ==0) {

      $queryOrg = "select organisatie.naam, reknr, iban, bic, adres, dlzip, dlnaam from organisatie where organisatie.id = $org_id";

      $resultOrg = mysql_query($queryOrg);

      if (mysql_num_rows($resultOrg) ==0) {

        $orgRecord['naam'] = "onbekende organisatie $org_id";

        $orgRecord['reknr'] = "???";
        $orgRecord['iban'] = "???";
        $orgRecord['bic'] = "???";

        $orgRecord['adres']  = "???";

        $orgRecord['dlzip']  = "???";

        $orgRecord['dlnaam']  = "???";

      }

      else

        $orgRecord = mysql_fetch_assoc($resultOrg) or die("probleem met $queryOrg: <br />" . mysql_error());

    }

    else

      $orgRecord = mysql_fetch_assoc($resultOrg) or die("probleem met $queryOrg: <br />" . mysql_error());



  foreach ($orgRecord as $key => $value) {

    $orgRecord[$key] = utf8_decode($orgRecord[$key]);

  }



  // rekeningnummer van hoofdzetel als het zelf geen reknr heeft

  if ($org['iban'] == "") {

    $qry2 = "SELECT reknr, iban, bic FROM organisatie

            where (actief = 1 or actief = 0) $beperking

            and id = {$org['hoofdzetel']} order by actief desc";

    if ($result2=mysql_query($qry2)){

      $records2= mysql_fetch_array($result2);

      $org['iban'] = $records2['iban'];
      $org['bic'] = $records2['bic'];
      $org['reknr'] = $records2['reknr'];

    }

  }





    $csvOutput .= "{$orgRecord['naam']} $sep {$orgRecord['adres']} $sep {$orgRecord['dlzip']} $sep {$orgRecord['dlnaam']} $sep {$orgRecord['reknr']} - IBAN {$orgRecord['iban']} - BIC: {$orgRecord['bic']} $sep $aantalVoorOrg $sep=$totaalBedragString / $aantalVergoedingen$sep=($aantalVoorOrg*$totaalBedragString/$aantalVergoedingen)\n";

  }



  /********* TOON NU DE BEDRAGEN PER ZVL ****/

  foreach ($aantalZVL as $persoon_id => $aantalVoorZVL) {

    $queryOrg = "select hvl.voornaam, hvl.naam, hvl.reknr as hvl_reknr, hvl.iban as hvl_iban, hvl.bic as hvl_bic,
                        org.naam as org_naam, org.reknr as org_reknr, org.iban as org_iban, org.bic as org_bic, hvl.adres, dlzip, dlnaam, hvl.organisatie

                 from hulpverleners hvl left join organisatie org on hvl.organisatie = org.id, gemeente where hvl.id = $persoon_id and gemeente.id = hvl.gem_id";

    $orgRecord = mysql_fetch_assoc(mysql_query($queryOrg)) or die("probleem met $queryOrg: <br />" . mysql_error());

    foreach ($orgRecord as $key => $value) {

      $orgRecord[$key] = utf8_decode($orgRecord[$key]);

    }

    if ($orgRecord['hvl_iban'] == "") {

       $orgRecord['hvl_reknr'] = $orgRecord['org_reknr'] . "(" . $orgRecord['org_naam'] . ")" .
                                 " - IBAN {$orgRecord['org_iban']} - BIC: {$orgRecord['org_bic']}";

    }
    else {
       $orgRecord['hvl_reknr'] = $orgRecord['hvl_reknr'] .
                                 " - IBAN {$orgRecord['hvl_iban']}\ - BIC: {$orgRecord['hvl_bic']}";
    }

    if ($orgRecord['adres'] == "") {

      $qryAdresOrg = mysql_query("select adres, dlnaam, dlzip from organisatie, gemeente where gem_id = gemeente.id and organisatie.id = {$orgRecord['organisatie']}");

      $adresOrgResult = mysql_fetch_assoc($qryAdresOrg);

      foreach ($adresOrgResult as $key => $value) {

        $adresOrgResult[$key] = utf8_decode($adresOrgResult[$key]);

      }

      $orgRecord['adres']="organisatieadres: " . $adresOrgResult['adres'];

      $orgRecord['dlnaam']=$adresOrgResult['dlnaam'];

      $orgRecord['dlzip']=$adresOrgResult['dlzip'];

    }

    $csvOutput .= "{$orgRecord['naam']} {$orgRecord['voornaam']}  $sep {$orgRecord['adres']} $sep {$orgRecord['dlzip']} $sep {$orgRecord['dlnaam']}  $sep {$orgRecord['hvl_reknr']} $sep $aantalVoorZVL $sep=$totaalBedragString / $aantalVergoedingen$sep=($aantalVoorZVL*$totaalBedragString/$aantalVergoedingen)\n";

  }

}









/***** einde functie *****/

}





$qryTP = "select id, nummer, naam from tp_project where nummer = {$_POST['tp_project']}";

$resultTP = mysql_query($qryTP);

if (mysql_num_rows($resultTP)==0) die("geen project met dit nummer");

for ($i=0; $i<mysql_num_rows($resultTP); $i++) {

  $rijTP = mysql_fetch_assoc($resultTP);

  foreach ($rijTP as $key => $value) {

    $rijTP[$key] = utf8_decode($rijTP[$key]);

  }

  toonProject($rijTP);
  if ($i==5) die("5 projecten ok");

}






header("Content-Type: text/csv");

header("Cache-Control: must-revalidate, post-check=0,pre-check=0");

header("Content-Transfer-Encoding: binary");

header("Content-Disposition: attachment; filename=\"{$bestandsnaam}.csv\"");

header("Content-length: " . strlen($csvOutput));

print($csvOutput);



      }



//---------------------------------------------------------

/* Geen Toegang */ require("../includes/check_access.inc");

//---------------------------------------------------------

?>