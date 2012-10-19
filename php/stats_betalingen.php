<?php

ob_start();

session_start();



   require("../includes/clearSessie.inc");

   require("../includes/dbconnect2.inc");



$bestandsnaam = "betaaloverzicht";



$begindatum = "{$_POST['beginjaar']}{$_POST['beginmaand']}{$_POST['begindag']}";

$einddatum = "{$_POST['eindjaar']}{$_POST['eindmaand']}{$_POST['einddag']}";



if ($begindatum == "") $begindatum = "18999999";

if ($einddatum == "") $einddatum = "20999999";



initRiziv();

$hetTarief = rizivTarief($begindatum);

$thuis = str_replace(".",",",$hetTarief['thuis']);

$elders = str_replace(".",",",$hetTarief['elders']);

$registratie = str_replace(".",",",$hetTarief['registratie']);









function doeOrganisatie($org) {

  global $csvOutput, $begindatum, $einddatum, $sep, $hetTarief;

  

  $thuis = $hetTarief['thuis'];

  $elders = $hetTarief['elders'];



  // organisatie

  // spatie datum naam voornaam bedrag totaal basisbedrag

  // Totaal te storten op x x x x totaal

  if ($org['id'] > 0) {

     $query = "

     select overleg.id as nr,

            patient.code as pat_code, patient.voornaam as pat_voornaam, patient.naam as pat_naam,

            overleg.datum as datum,

            hvl.naam as hvl_naam, hvl.voornaam as hvl_voornaam, hvl.reknr, hvl.iban, hvl.bic,

            overleg.geld_voor_hvl * 0$thuis * (overleg.locatie=1) +  overleg.geld_voor_hvl * 0$elders * (overleg.locatie=0) + overleg.geld_voor_hvl * 0$elders * (overleg.locatie=2) as basisbedrag,

            hoofdzetel



     from patient, overleg, afgeronde_betrokkenen as lijst, functies, hulpverleners as hvl, organisatie o

     where overleggenre = 'gewoon'
     and patient.code = overleg.patient_code and hvl.organisatie = {$org['id']} and lijst.overleg_id = overleg.id and lijst.genre = 'hulp'
     and lijst.persoon_id = hvl.id and hvl.fnct_id = functies.id and hvl.organisatie = o.id and o.genre = 'HVL'

     and afgerond = 1 and keuze_vergoeding = 1 and geld_voor_hvl = 1 and (overleg.datum >= $begindatum and overleg.datum <= $einddatum)

     and aanwezig = 1

     and (overleg.genre = 'gewoon' or overleg.genre is NULL)

     /* PVS: AND (type == 0 || type == 2 || type == 3)  */

     order by overleg.datum asc, patient.code, lijst.id, hvl.naam asc, hvl.voornaam asc";

    // was functies.groep_id = 1

  }

  else {

     $query = "

     select overleg.id as nr,

            patient.code as pat_code, patient.voornaam as pat_voornaam, patient.naam as pat_naam,

            overleg.datum as datum,

            hvl.naam as hvl_naam, hvl.voornaam as hvl_voornaam, hvl.reknr, hvl.iban, hvl.bic,

            overleg.geld_voor_hvl * 0$thuis * (overleg.locatie=1) +  overleg.geld_voor_hvl * 0$elders * (overleg.locatie=0) + overleg.geld_voor_hvl * 0$elders * (overleg.locatie=2) as basisbedrag,

            hoofdzetel



     from patient, overleg, afgeronde_betrokkenen as lijst, functies, hulpverleners as hvl, organisatie o

     where overleggenre = 'gewoon'
     and patient.code = overleg.patient_code and hvl.organisatie is NULL and lijst.overleg_id = overleg.id and lijst.genre = 'hulp'
     and lijst.persoon_id = hvl.id and hvl.fnct_id = functies.id and hvl.organisatie = o.id and o.genre = 'HVL'

     and afgerond = 1 and keuze_vergoeding = 1 and geld_voor_hvl = 1 and (overleg.datum >= $begindatum and overleg.datum <= $einddatum)

     and (overleg.genre = 'gewoon' or overleg.genre is NULL)

     and aanwezig = 1

      /* PVS: AND (type == 0 || type == 2 || type == 3)  */

     order by overleg.datum asc, patient.code, hvl.naam asc, hvl.voornaam asc";

     // was functies.groep_id = 1

  }



  $csvOutput .= "\n" . '"' . $org['naam'] . "\"$sep\n";



  $result=mysql_query($query) or die(mysql_error() . "<br /> $query");



  $vorigeOverleg = -1;

  $aantalOverleg = 0;

  for ($i=0; $i < mysql_num_rows($result); $i++) {

    $rij = mysql_fetch_array($result);

    foreach ($rij as $key => $value) {

      $rij[$key] = utf8_decode($rij[$key]);

    }

    if ($org['id']<0 || $org['id'] == 997 || $org['id'] == 998 || $org['id'] == 999) {

      $extraRekNr = "rekening " . $rij['reknr']  . " - IBAN {$rij['iban']} - BIC: {$rij['bic']}";

    }

    else {

      $extraRekNr = " ";

    }

    $csvOutput .= '"' . $extraRekNr . '"' . "$sep";

    $datumMooi = substr($rij['datum'],6,2) . "/" . substr($rij['datum'],4,2) . "/" . substr($rij['datum'],0,4);

    $csvOutput .= '"' . $datumMooi . "\"$sep";

    $csvOutput .= '"' . $rij['hvl_naam'] . "\"$sep";

    $csvOutput .= '"' . $rij['hvl_voornaam'] . "\"$sep";

    if  ($vorigeOverleg != $rij['nr']) {

      $aantalOverleg++;

      $vorigeOverleg = $rij['nr'];

      $csvOutput .= "\"=B10\"$sep";

      $csvOutput .= "\" \"$sep";

      //$csvOutput .= '"' . $rij['basisbedrag'] . "\"$sep";

    }

    else {

      $csvOutput .= "\" \"$sep";

      $csvOutput .= "\" \"$sep";

      //$csvOutput .= "\" \"$sep";

    }

    $csvOutput .= "\"{$rij['pat_code']}\"$sep";

    $csvOutput .= "\"{$rij['pat_naam']} {$rij['pat_voornaam']}\"$sep";

    $csvOutput .="\n";

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



  // totaal voor organisatie

  $csvOutput .= '"TOTAAL te storten op ' . $org['reknr'] . " - IBAN {$org['iban']} - BIC: {$org['bic']}" . "\"$sep\" \"$sep\" \"$sep\" \"$sep\"$aantalOverleg\"$sep\"=B10*$aantalOverleg\"$sep\" \"\n";

}



   if (IsSet($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan"))

      {





$queryOrg = "select distinct organisatie.id, organisatie.naam, organisatie.reknr, organisatie.iban, organisatie.bic

     from overleg, afgeronde_betrokkenen as lijst, functies, hulpverleners as hvl left join organisatie on (hvl.organisatie = organisatie.id)

     where  overleggenre = 'gewoon'
     and lijst.overleg_id = overleg.id and lijst.genre = 'hulp'
     and lijst.persoon_id = hvl.id and hvl.fnct_id = functies.id and organisatie.genre = 'HVL'

     and afgerond = 1 and keuze_vergoeding = 1 and geld_voor_hvl = 1 and overleg.datum >= $begindatum and overleg.datum <= $einddatum

     and not(organisatie is NULL)  and (organisatie < 997 or organisatie > 999)

     and (overleg.genre = 'gewoon' or overleg.genre is NULL)

     and aanwezig = 1

     order by organisatie.naam asc";

     // was functiegroep = 1



$queryAantallen = "select  sum(overleg.geld_voor_hvl * (overleg.locatie=1))  as aantal_dertig,

                           sum(overleg.geld_voor_hvl * (overleg.locatie=0)) + sum(overleg.geld_voor_hvl * (overleg.locatie=2)) as aantal_veertig,

                           sum(overleg.keuze_vergoeding=1) as aantal_gdt

                    from overleg

                    where

                           /* PVS : code = patient_code and (type == 0 || type == 2 || type == 3)  */

                           (overleg.genre = 'gewoon' or overleg.genre is NULL)

                           and afgerond = 1 and keuze_vergoeding = 1 and overleg.datum >= $begindatum and overleg.datum <= $einddatum";





$queryAantalHVL = "SELECT count( DISTINCT overleg.id, organisatie.id )

                   FROM overleg, afgeronde_betrokkenen AS lijst, functies, hulpverleners AS hvl

                   INNER JOIN organisatie ON ( hvl.organisatie = organisatie.id )

                   WHERE overleggenre = 'gewoon'
                   AND lijst.overleg_id = overleg.id

                   /* PVS : AND patient.code = overleg.patient_code and (type == 0 || type == 2 || type == 3)  */

                   AND lijst.genre = 'hulp'

                   AND lijst.persoon_id = hvl.id

                   AND hvl.fnct_id = functies.id

                   AND organisatie.genre = 'HVL'

                   AND afgerond =1

                   AND keuze_vergoeding = 1

                   AND geld_voor_hvl =1

                   and (overleg.genre = 'gewoon' or overleg.genre is NULL)

                   AND organisatie <> 999

                   and aanwezig = 1

                   and (overleg.datum >= $begindatum and overleg.datum <= $einddatum)";

                   // was functies.groep_id =1

$queryAantalHVL2 = "select overleg.id

     from overleg, afgeronde_betrokkenen as lijst, functies, hulpverleners as hvl inner join organisatie on (hvl.organisatie = organisatie.id)

     where  overleggenre = 'gewoon'
     AND lijst.overleg_id = overleg.id and lijst.genre = 'hulp'

     /* PVS: AND patient.code = overleg.patient_code and (type == 0 || type == 2 || type == 3)  */

     AND lijst.persoon_id = hvl.id and hvl.fnct_id = functies.id and organisatie.genre = 'HVL'

     and afgerond = 1 and keuze_vergoeding = 1 and geld_voor_hvl = 1 and overleg.datum >= $begindatum and overleg.datum <= $einddatum

     and organisatie = 999

     and (overleg.genre = 'gewoon' or overleg.genre is NULL)

     and aanwezig = 1

     group by overleg.id";

$queryAantalHVL3 = "select overleg.id

     from overleg, afgeronde_betrokkenen as lijst, functies, hulpverleners as hvl  inner join organisatie on (hvl.organisatie = organisatie.id)

     where overleggenre = 'gewoon'
     and lijst.overleg_id = overleg.id and lijst.genre = 'hulp'

     /* PVS: AND patient.code = overleg.patient_code and (type == 0 || type == 2 || type == 3)  */

     and lijst.persoon_id = hvl.id and hvl.fnct_id = functies.id and organisatie.genre = 'HVL'

     and afgerond = 1 and keuze_vergoeding = 1 and geld_voor_hvl = 1 and overleg.datum >= $begindatum and overleg.datum <= $einddatum

     and organisatie is NULL

     and (overleg.genre = 'gewoon' or overleg.genre is NULL)

     and aanwezig = 1

     group by overleg.id";





$resultAantallen = mysql_fetch_array(mysql_query($queryAantallen));

$resultAantalEchtOrg = mysql_fetch_array(mysql_query($queryAantalHVL));

$resultAantalHVL = '=' . $resultAantalEchtOrg[0] . '+'

                       . mysql_num_rows(mysql_query($queryAantalHVL2)) . '+'

                       . mysql_num_rows(mysql_query($queryAantalHVL3));





$begin = "{$_POST['begindag']}/{$_POST['beginmaand']}/{$_POST['beginjaar']}";

$eind = "{$_POST['einddag']}/{$_POST['eindmaand']}/{$_POST['eindjaar']}";

$csvOutput = "Te betalen van $begin tot $eind\n\n";





$csvOutput .= '"Aantal huisbezoek:"' . "$sep" . $resultAantallen['aantal_veertig'] . "$sep\"$thuis\"$sep\n";

$csvOutput .= '"Aantal elders:"' . "$sep" . $resultAantallen['aantal_dertig'] . "$sep\"$elders\"$sep $sep\"Aantal GDT\"$sep\"{$resultAantallen['aantal_gdt']}\"$sep\"=F7*$registratie\"$sep\n";

$csvOutput .= '"Totaalbedrag:";"=B6*C6+B7*C7"' . "$sep\n";

$csvOutput .= '"Aantal HVL:"' . "$sep"  . $resultAantalHVL . "$sep\n";

$csvOutput .= '"Bedrag per overleg per organisatie:"' . "$sep" . '"=B8/B9"' . "$sep"  . "\n\n";



$csvOutput .= '"Organisatie";"Datum";"Naam HVL";"Voornaam HVL";"Bedrag";" ";';

//$csvOutput .= '"Overleg-bedrag";';

$csvOutput .= "\n\n";









//die($query);



  $result=mysql_query($queryOrg) or die(mysql_error() . "<br /> $queryOrg");



  for ($i=0; $i < mysql_num_rows($result); $i++) {

    $rij = mysql_fetch_array($result);

    foreach ($rij as $key => $value) {

      $rij[$key] = utf8_decode($rij[$key]);

    }

    doeOrganisatie($rij);

  }



  // organisatie NVT

  $orgOnbepaald['id']="999";

  $orgOnbepaald['naam']="Zelfstandig ZVL of NVT ingevuld";

  $orgOnbepaald['reknr']="(subtotaal voor zelfstandige ZVL - of organisatie onbepaald)";

  doeOrganisatie($orgOnbepaald);



  // organisatie NVT

  $orgOnbepaald['id']="998";

  $orgOnbepaald['naam']="Zelfstandig HVL";

  $orgOnbepaald['reknr']="(subtotaal voor zelfstandige HVL)";

  doeOrganisatie($orgOnbepaald);



  // organisatie onbepaald

  $orgOnbepaald['id']=-1;

  $orgOnbepaald['naam']="Niet ingevuld";

  $orgOnbepaald['reknr']="Apart op te zoeken";

  doeOrganisatie($orgOnbepaald);



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