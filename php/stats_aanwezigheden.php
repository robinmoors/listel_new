<?php

ob_start();

session_start();



   require("../includes/clearSessie.inc");

   require("../includes/dbconnect2.inc");

   if (IsSet($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan"))

      {



$bestandsnaam = "aanwezigheidslijst";



$begindatum = "{$_POST['beginjaar']}{$_POST['beginmaand']}{$_POST['begindag']}";

$einddatum = "{$_POST['eindjaar']}{$_POST['eindmaand']}{$_POST['einddag']}";



if ($begindatum == "") $begindatum = "18999999";

if ($einddatum == "") $einddatum = "20999999";





$queryAllesGecontroleerd = "

     select * from overleg

     where (genre = 'gewoon' or genre is NULL) and keuze_vergoeding = 1 and controle != 1 and (overleg.datum >= $begindatum and overleg.datum <= $einddatum)";





if (mysql_num_rows(mysql_query($queryAllesGecontroleerd))>0) {

  $csvOutput = "Nog niet alle overleggen uit deze periode zijn afgerond én gecontroleerd!!\n";

  $csvOutput .= "$csvOutput";

  $csvOutput .= "$csvOutput";

  $csvOutput .= "$csvOutput\n\n";

}



initRiziv();

$hetTarief = rizivTarief($begindatum);
preset($hetTarief['thuis']);
preset($hetTarief['elders']);






/************* EERST VOOR HVL *****************/



$query = "

     select gemeente.naam as gemeente, overleg.datum as datum, patient.code as ZP, patient.naam as patient_naam, patient.voornaam as patient_voornaam,

            v.nr as mut, patient.mutnr as id_patient, overleg.factuur_code as fac,

            overleg.factuur_datum as factuurdatum_oud, factuurmaand.factuurdatum as factuurdatum_nieuw,

            organisatie.naam as org_hvl, functies.naam as discipline, hvl.naam as hvl_naam, hvl.voornaam as hvl_voornaam,

            overleg.geld_voor_hvl * {$hetTarief['thuis']} * (overleg.locatie<>0) +  overleg.geld_voor_hvl * {$hetTarief['elders']} * (overleg.locatie=0) as BEDRAG



     from (overleg left join factuurmaand on overleg.factuur_code = factuurmaand.id), patient, verzekering as v, afgeronde_betrokkenen as lijst, functies, hulpverleners as hvl left join organisatie on (hvl.organisatie = organisatie.id),

          gemeente



     where  overleggenre = 'gewoon'
     and patient.gem_id = gemeente.id and overleg.patient_code = patient.code and patient.mut_id = v.id and lijst.overleg_id = overleg.id and lijst.genre = 'hulp'
     and lijst.persoon_id = hvl.id and hvl.fnct_id = functies.id and organisatie.genre = 'HVL'

     and afgerond = 1 and keuze_vergoeding = 1 and (overleg.datum >= $begindatum and overleg.datum <= $einddatum)

     and (overleg.genre = 'gewoon' or overleg.genre is NULL)

     and aanwezig = 1

     order by gemeente.naam, ZP, overleg.datum, org_hvl, lijst.id asc";



     // was functies.groep_id = 1





//die($query);



$begin = "{$_POST['begindag']}/{$_POST['beginmaand']}/{$_POST['beginjaar']}";

$eind = "{$_POST['einddag']}/{$_POST['eindmaand']}/{$_POST['eindjaar']}";

$csvOutput .= "Aanwezigheden HVL op te vergoeden overlegggen van $begin tot $eind\n\n";





$result=mysql_query($query) or die(mysql_error() . "<br /> $query");



$aantalKolommen = mysql_num_fields($result);

for ($i = 0; $i < $aantalKolommen; $i++) {

  $field = mysql_fetch_field($result);

  $kolom[$i] = utf8_decode($field->name);

  $csvOutput .= '"'. $kolom[$i] . "\"$sep";

}

$csvOutput .= "GDT$sep\n";







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

    $vorigeDatum = $rij['datum'];

    $vorigePatient = $rij['ZP'];

    $vorigeOrg = $rij['org_hvl'];

    $gdt = $hetTarief['registratie'];

  }

  else { // dit overleg heeft al een bedrag gekregen

     $gdt = "";

     if ($vorigeOrg != $rij['org_hvl']) {

       // een nieuwe organisatie, dus bedrag leeg maken

       $vorigeOrg = $rij['org_hvl'];

       $rij['BEDRAG'] = "-- deelt in de pot --";

     }

     else {

       // dezelfde organisatie als daarnet

       $rij['BEDRAG'] = "-- telt NIET mee in de pot -- ";

     }



  }

  for ($j = 0; $j < $aantalKolommen; $j++) {

    $csvOutput .= '"' . $rij[$kolom[$j]] . "\"$sep";

  }

  $csvOutput .="$gdt$sep\n";

}



/******************* EINDE HVL ********************/



/************* DAN VOOR ZVL *****************/



$query = "

     select gemeente.naam as gemeente, overleg.datum as datum, patient.code as ZP, patient.naam as patient_naam, patient.voornaam as patient_voornaam,

            v.nr as mut, patient.mutnr as id_patient, overleg.factuur_code as fac,

            overleg.factuur_datum as factuurdatum_oud, factuurmaand.factuurdatum as factuurdatum_nieuw,

            organisatie.naam as org_hvl, hvl.naam as hvl_naam, hvl.voornaam as hvl_voornaam,

            functies.id as functie_id, functies.naam as functie,

            {$hetTarief['thuis']} * (overleg.locatie<>0) +  {$hetTarief['elders']} * (overleg.locatie=0) as BEDRAG



     from (overleg left join factuurmaand on overleg.factuur_code = factuurmaand.id), patient, verzekering as v, afgeronde_betrokkenen as lijst, functies, hulpverleners as hvl left join organisatie on (hvl.organisatie = organisatie.id)

          , gemeente

     where  overleggenre = 'gewoon'
     and patient.gem_id = gemeente.id and overleg.patient_code = patient.code and patient.mut_id = v.id and lijst.overleg_id = overleg.id and lijst.genre = 'hulp'
     and lijst.persoon_id = hvl.id and hvl.fnct_id = functies.id and organisatie.genre = 'ZVL'

     and afgerond = 1 and keuze_vergoeding = 1 and (overleg.datum >= $begindatum and overleg.datum <= $einddatum)

     and (overleg.genre = 'gewoon' or overleg.genre is NULL)

     and aanwezig = 1

     order by gemeente.naam, ZP, overleg.datum, functies.id, org_hvl, lijst.id asc";



//die($query);





$csvOutput .= "\n\n\n\n\n\nAanwezigheden ZVL op te vergoeden overlegggen van $begin tot $eind\n\n";





$result=mysql_query($query) or die(mysql_error() . "<br /> $query");



$aantalKolommen = mysql_num_fields($result);

for ($i = 0; $i < $aantalKolommen; $i++) {

  $field = mysql_fetch_field($result);

  $kolom[$i] = utf8_decode($field->name);

  $csvOutput .= '"'. $kolom[$i] . "\"$sep";

}



$csvOutput .= "\n";







$vorigeDatum = -1;

$vorigePatient = -1;

$vorigeFunctie = -1;



for ($i=0; $i < mysql_num_rows($result); $i++) {

  $rij = mysql_fetch_array($result);

  foreach ($rij as $key => $value) {

    $rij[$key] = utf8_decode($rij[$key]);

  }

  if ($vorigeDatum != $rij['datum'] || $vorigePatient != $rij['ZP']) {

    // nieuw overleg

    $vorigeDatum = $rij['datum'];

    $vorigePatient = $rij['ZP'];

    $vorigeFunctie = $rij['functie_id'];

  }

  else { // dit overleg hebben we al gehad, dus misschien zelfde functie

     if ($vorigeFunctie != $rij['functie_id']) {

       // een nieuwe functie, dus bedrag laten staan

       $vorigeFunctie = $rij['functie_id'];

     }

     else {

       // dezelfde functie als daarnet

       $rij['BEDRAG'] = "-- krijgt GEEN vergoeding (zelfde functie als hierboven) -- ";

     }



  }

  for ($j = 0; $j < $aantalKolommen; $j++) {

    $csvOutput .= '"' . $rij[$kolom[$j]] . "\"$sep";

  }

  $csvOutput .="\n";

}



/******************* EINDE ZVL ********************/





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