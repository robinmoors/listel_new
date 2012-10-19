<?php

ob_start();

session_start();



   require("../includes/clearSessie.inc");

   require("../includes/dbconnect2.inc");

   if (IsSet($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan"))

      {



$bestandsnaam = "zorgplan";







$jaar = intval(date("Y"));

$nulJaar = date("Ymd");

$tienJaar = ($jaar-10) . date("md");

$twintigJaar = ($jaar-20) . date("md");

$dertigJaar = ($jaar-30) . date("md");

$veertigJaar = ($jaar-40) . date("md");

$vijftigJaar = ($jaar-50) . date("md");

$zestigJaar = ($jaar-60) . date("md");

$zeventigJaar = ($jaar-70) . date("md");

$tachtigJaar = ($jaar-80) . date("md");

$negentigJaar = ($jaar-90) . date("md");

$honderdJaar = ($jaar-100) . date("md");



$query = "select count(distinct patient.code) as totaal, sum(type=1) as aantal_pvs, sum(type=3) as aantal_psychiatrische_problematiek, sum(type=4) as aantal_therapeutisch_project,

          sum(type=0) as aantal_andere_patienten,sum(sex=0) as man, sum(sex=1) as vrouw,sum(gebdatum <= $nulJaar and gebdatum > $tienJaar)

          as leeftijd_0_9, sum(gebdatum <= $tienJaar and gebdatum > $twintigJaar) as leeftijd_10_19, sum(gebdatum <= $twintigJaar and

          gebdatum > $dertigJaar) as leeftijd_20_29, sum(gebdatum <= $dertigJaar and gebdatum > $veertigJaar) as leeftijd_30_39,

          sum(gebdatum <= $veertigJaar and gebdatum > $vijftigJaar) as leeftijd_40_49, sum(gebdatum <= $vijftigJaar and

          gebdatum > $zestigJaar) as leeftijd_50_59, sum(gebdatum <= $zestigJaar and gebdatum > $zeventigJaar) as leeftijd_60_69,

          sum(gebdatum <= $zeventigJaar and gebdatum > $tachtigJaar) as leeftijd_70_79, sum(gebdatum <= $tachtigJaar and

          gebdatum > $negentigJaar) as leeftijd_80_89, sum(gebdatum <= $negentigJaar and gebdatum > $honderdJaar) as leeftijd_90_99,

          sum(gebdatum <= $honderdJaar) as leeftijd_100_meer, sum(burgstand_id=2 or burgstand_id=5 or burgstand_id=8 or burgstand_id=7)

          as alleenwonend, sum(burgstand_id=3 or burgstand_id=9) as samenwonend,sum(burgstand_id=2) as ongehuwd, sum(burgstand_id=3)

          as gehuwd,sum(burgstand_id=9) as samenwonend,sum(burgstand_id=5) as weduwnaar,sum(burgstand_id=8) as wettelijk_gescheiden,

          sum(burgstand_id=7) as feitelijk_gescheiden,sum(alarm=0) as alarm_nee, sum(alarm=1) as alarm_ja  ";

$query2 = "select $functies ";



$begindatum = "{$_POST['beginjaar']}{$_POST['beginmaand']}{$_POST['begindag']}";

$einddatum = "{$_POST['eindjaar']}{$_POST['eindmaand']}{$_POST['einddag']}";



if ($begindatum == "") $begindatum = "18999999";

if ($einddatum == "") $einddatum = "20999999";





switch ($_POST['soortzorgplan']) {

  case "nieuw":

    $datumbeperking = " (startdatum >= $begindatum and startdatum <= $einddatum) ";

    break;

  case "doorlopend":

    $datumbeperking = " (startdatum < $begindatum and (einddatum is NULL or einddatum = 0 or einddatum >= $begindatum)) ";

    break;

  case "stopgezet":

    $redenstopzetting = " ,sum(stopzetting_cat = 1) as voldoende_hersteld,sum(stopzetting_cat = 2) as overleden,sum(stopzetting_cat = 3) as opname_rustoord,sum(stopzetting_cat = 4) as verhuisd,sum(stopzetting_cat = 5) as andere ";

    $datumbeperking = " (einddatum >= $begindatum and einddatum <= $einddatum) ";

    break;

  case "effectief" :

    $queryEffectief = "select distinct(patient.code) from patient, overleg where patient.code = overleg.patient_code and

                              overleg.datum >= $begindatum and overleg.datum <= $einddatum ";

    $resultEffectief = mysql_query($queryEffectief) or die($queryEffectief);

    $effectieven = "";

    for ($i=0; $i < mysql_num_rows($resultEffectief); $i++) {

      $patient = mysql_fetch_array($resultEffectief);

      $effectieven .= ",'{$patient['code']}'";

    }

    $effectieven = "(" . substr($effectieven, 1) . ")";

    $effectiefBeperking = " patient.code in $effectieven and";

  default:

    $datumbeperking = " (startdatum <= $einddatum and (einddatum is NULL or einddatum = 0 or einddatum >= $begindatum)) ";

}

          

if (isset($_SESSION['overleg_gemeente'])) {

    $query .= " $redenstopzetting from patient, gemeente where $effectiefBeperking $datumbeperking and patient.gem_id = gemeente.id and gemeente.zip = {$_SESSION['overleg_gemeente']} ";

}

else switch ($_POST['beperking']) {

  case "gemeente":

    $query .= " $redenstopzetting , gemeente.naam as gemeente from patient, gemeente  where $effectiefBeperking $datumbeperking and patient.gem_id = gemeente.id group by  gemeente.naam order by gemeente.naam";

    break;

  case "sit":

    $query .= " $redenstopzetting ,  concat('sit ',sit.naam) as sit from patient, gemeente, sit where $effectiefBeperking $datumbeperking and patient.gem_id = gemeente.id and gemeente.sit_id = sit.id group by sit.naam";

    break;

  default:

    $query .= " $redenstopzetting from patient where $effectiefBeperking $datumbeperking";

    // alles samen

}



//die($query);



$begin = "{$_POST['begindag']}/{$_POST['beginmaand']}/{$_POST['beginjaar']}";

$eind = "{$_POST['einddag']}/{$_POST['eindmaand']}/{$_POST['eindjaar']}";

$csvOutput = "zorgplannen ({$_POST['soortzorgplan']}) van $begin tot $eind\n\n";



$result=mysql_query($query) or die(mysql_error() . "<br /> $query");



$aantalKolommen = mysql_num_fields($result);

for ($i = 0; $i < $aantalKolommen; $i++) {

  $field = mysql_fetch_field($result);

  $kolom[$i] = $field->name;

  $csvOutput .= '"'. $kolom[$i] . "\"$sep";

}

$csvOutput .= "\n";





for ($i=0; $i < mysql_num_rows($result); $i++) {

  $rij = mysql_fetch_array($result);

  for ($j = 0; $j < $aantalKolommen; $j++) {

    $csvOutput .= '"' . $rij[$kolom[$j]] . "\"$sep";

  }

  $csvOutput .="\n";

}





// deel 2 : functies als huidige_betrokkene



$queryFunctie = "select id, naam from functies order by naam";

$resultFnct = mysql_query($queryFunctie);







$begindatum = "{$_POST['beginjaar']}{$_POST['beginmaand']}{$_POST['begindag']}";

$einddatum = "{$_POST['eindjaar']}{$_POST['eindmaand']}{$_POST['einddag']}";



if ($begindatum == "") $begindatum = "18999999";

if ($einddatum == "") $einddatum = "20999999";



$select = "";

$namen = "";



$aantalKolommen = mysql_num_rows($resultFnct);



for ($i=0; $i < mysql_num_rows($resultFnct); $i++) {

  $rij = mysql_fetch_array($resultFnct);

  $select .= ", sum(fnct_id={$rij['id']}) ";

  $namen .= "{$rij['naam']}$sep ";

}



$select = substr($select, 1);





if (isset($_SESSION['overleg_gemeente'])) {

    $velden = "";

    $from = " , gemeente ";

    $where = " and patient.gem_id = gemeente.id and gemeente.zip = {$_SESSION['overleg_gemeente']} ";

}

else switch ($_POST['beperking']) {

  case "gemeente":

    $aantalKolommen++;

    $namen = "gemeente$sep $namen";

    $from = " , gemeente ";

    $velden = " gemeente.naam as gemeente, ";

    $where = " and patient.gem_id = gemeente.id ";

    $group = " group by gemeente.naam order by gemeente.naam";

    $group2 = " group by gemeente.naam, organisatie.id order by gemeente.naam, organisatie.naam";

    break;

  case "sit":

    $aantalKolommen++;

    $namen = "sit$sep $namen";

    $from = " ,gemeente, sit ";

    $velden = "  concat('sit ',sit.naam) as sit, ";

    $where = " and patient.gem_id = gemeente.id and gemeente.sit_id = sit.id ";

    $group = " group by sit.naam order by sit.naam";

    $group2 = " group by sit.naam, organisatie.id order by sit.naam, organisatie.naam";

    break;

  default:

    $group2 = " group by organisatie.id order by organisatie.naam ";

    // alles samen

}





$query = "select  $velden  $select

          from patient, hulpverleners hvl, huidige_betrokkenen     $from

          where overleggenre = 'gewoon' and $effectiefBeperking $datumbeperking and patient.code = huidige_betrokkenen.patient_code and huidige_betrokkenen.persoon_id = hvl.id and huidige_betrokkenen.genre = 'hulp'

          $where

          $group ";



//die($query);



$begin = "{$_POST['begindag']}/{$_POST['beginmaand']}/{$_POST['beginjaar']}";

$eind = "{$_POST['einddag']}/{$_POST['eindmaand']}/{$_POST['eindjaar']}";

$csvOutput .= "\n\n\nzorgplannen en huidige betrokkenen per functie({$_POST['soortzorgplan']}) van $begin tot $eind\n\n";





$result=mysql_query($query) or die(mysql_error() . "<br /> $query");





$csvOutput .= "$namen \n";





for ($i=0; $i < mysql_num_rows($result); $i++) {

  $rij = mysql_fetch_array($result);

  for ($j = 0; $j < $aantalKolommen; $j++) {

    $csvOutput .= '"' . $rij[$j] . "\"$sep";

  }

  $csvOutput .="\n";

}



if ($_SESSION['profiel']=="listel" && $_POST['beperking'] != "gemeente" && $_POST['beperking'] != "sit") {

  // deel 3 organisaties betrokken bij zorgplan



  $orgQuery = "select organisatie.naam as org_naam, count(distinct(patient_code)) as aantal

               from organisatie, overleg, afgeronde_betrokkenen, hulpverleners, patient

               where
                  overleggenre = 'gewoon' and
                  $effectiefBeperking $datumbeperking

                  and organisatie.id = hulpverleners.organisatie

                  and afgeronde_betrokkenen.persoon_id = hulpverleners.id

                  and overleg.id = afgeronde_betrokkenen.overleg_id

                  and patient.code = overleg.patient_code

               group by organisatie.id

               order by organisatie.naam";

  $csvOutput .= "\n'*** Organisaties betrokken bij zorgplannen'\nOrganisatie{$sep}Aantal zorgplannen\n";



  $resultOrg = mysql_query($orgQuery);



  for ($i=0; $i<mysql_num_rows($resultOrg); $i++) {

    $org = mysql_fetch_assoc($resultOrg);

    $csvOutput .= "{$org['org_naam']}$sep{$org['aantal']}\n";

  }



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