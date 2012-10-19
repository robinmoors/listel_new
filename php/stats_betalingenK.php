<?php

ob_start();

session_start();



function doeOrganisatie($org) {

  global $csvOutput, $begindatum, $einddatum;

  

  // organisatie

  // spatie datum naam voornaam bedrag totaal basisbedrag

  // Totaal te storten op x x x x totaal

  $query = "

     select overleg.datum as datum,

            hvl.naam as hvl_naam, hvl.voornaam as hvl_voornaam,

            overleg.geld_voor_hvl * 30 * (overleg.locatie<>0) +  overleg.geld_voor_hvl * 40 * (overleg.locatie=0) as basisbedrag



     from overleg, afgeronde_betrokkenen as lijst, functies, hulpverleners as hvl

     where overleggenre = 'gewoon'
     and hvl.organisatie = {$org['id']} and lijst.overleg_id = overleg.id and lijst.genre = 'hulp'
     and lijst.persoon_id = hvl.id and hvl.fnct_id = functies.id and functies.groep_id = 1

     and afgerond = 1 and (overleg.datum >= $begindatum and overleg.datum <= $einddatum)

     order by overleg.datum asc, hvl.naam asc, hvl.voornaam asc";





  $csvOutput .= "\n" . '" ' . $org['naam'] . '"," "," "," "," "," "," ",' . "\n";



  $result=mysql_query($query) or die(mysql_error() . "<br /> $query");



  for ($i=0; $i < mysql_num_rows($result); $i++) {

    $rij = mysql_fetch_array($result);

    foreach ($rij as $key => $value) {

      $rij[$key] = utf8_decode($rij[$key]);

    }

    $csvOutput .= '" ",';

    $datumMooi = substr($rij['datum'],6,2) . "/" . substr($rij['datum'],4,2) . "/" . substr($rij['datum'],0,6);

    $csvOutput .= '"' . $datumMooi . '",';

    $csvOutput .= '"' . $rij['hvl_naam'] . '",';

    $csvOutput .= '"' . $rij['hvl_voornaam'] . '",';

    $csvOutput .= '"=B8",';

    $csvOutput .= '" ",';

    $csvOutput .= '"' . $rij['basisbedrag'] . '",';

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

  $csvOutput .= '"TOTAAL te storten op ' . $org['reknr'] . " - IBAN {$org['iban']} - BIC: {$org['bic']}" . '"," "," "," "," ","=B8*' . mysql_num_rows($result) . '"," ",' . "\n";

}



   require("../includes/clearSessie.inc");

   require("../includes/dbconnect2.inc");

   if (IsSet($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan"))

      {



$bestandsnaam = "betaaloverzicht";



$begindatum = "{$_POST['beginjaar']}{$_POST['beginmaand']}{$_POST['begindag']}";

$einddatum = "{$_POST['eindjaar']}{$_POST['eindmaand']}{$_POST['einddag']}";



if ($begindatum == "") $begindatum = "18999999";

if ($einddatum == "") $einddatum = "20999999";



$queryOrg = "select distinct organisatie.id, organisatie.naam, organisatie.reknr, organisatie.iban, organisatie.bic

     from overleg, afgeronde_betrokkenen as lijst, functies, hulpverleners as hvl left join organisatie on (hvl.organisatie = organisatie.id)

     where  overleggenre = 'gewoon'
     and lijst.overleg_id = overleg.id and lijst.genre = 'hulp'
     and lijst.persoon_id = hvl.id and hvl.fnct_id = functies.id and functies.groep_id = 1

     and afgerond = 1 and keuze_vergoeding = 1 and overleg.datum >= $begindatum and overleg.datum <= $einddatum

     order by organisatie.naam asc";



$queryAantallen = "select sum(overleg.geld_voor_hvl * (overleg.locatie<>0)) as aantal_dertig,

                           sum(overleg.geld_voor_hvl * (overleg.locatie=0)) as aantal_veertig

                    from overleg

                    where afgerond = 1 and keuze_vergoeding = 1 and overleg.datum >= $begindatum and overleg.datum <= $einddatum";





$queryAantalHVL = "select count(*)

     from overleg, afgeronde_betrokkenen as lijst, functies, hulpverleners as hvl

     where overleggenre = 'gewoon'
     and lijst.overleg_id = overleg.id and lijst.genre = 'hulp'
     and lijst.persoon_id = hvl.id and hvl.fnct_id = functies.id and functies.groep_id = 1

     and afgerond = 1 and overleg.datum >= $begindatum and overleg.datum <= $einddatum";



$resultAantallen = mysql_fetch_array(mysql_query($queryAantallen));

$resultAantalHVL = mysql_fetch_array(mysql_query($queryAantalHVL));





$begin = "{$_POST['begindag']}/{$_POST['beginmaand']}/{$_POST['beginjaar']}";

$eind = "{$_POST['einddag']}/{$_POST['eindmaand']}/{$_POST['eindjaar']}";

$csvOutput = "Te betalen van $begin tot $eind\n\n";



$csvOutput .= '"Aantal huisbezoek:",' . $resultAantallen['aantal_veertig'] . ",40,\n";

$csvOutput .= '"Aantal gewoon:",' . $resultAantallen['aantal_dertig'] . ",30,\n";

$csvOutput .= '"Totaalbedrag:","=B4*C4+B5*C5",' . "\n";

$csvOutput .= '"Aantal HVL:",' . $resultAantalHVL[0] . ",\n";

$csvOutput .= '"Bedrag per HVL:","=B6/B7",' . "\n\n";



$csvOutput .= '"Organisatie","Datum","Naam HVL","Voornaam HVL","Bedrag"," ","Overleg-bedrag",' . "\n\n";









//die($query);



  $result=mysql_query($queryOrg) or die(mysql_error() . "<br /> $queryOrg");



  for ($i=0; $i < mysql_num_rows($result); $i++) {

    $rij = mysql_fetch_array($result);

    foreach ($rij as $key => $value) {

      $rij[$key] = utf8_decode($rij[$key]);

    }

    doeOrganisatie($rij);

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