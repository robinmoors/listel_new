<?php

ob_start();

session_start();





   require("../includes/clearSessie.inc");

   require("../includes/dbconnect2.inc");

   if (IsSet($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan"))

      {



$bestandsnaam = "overleg_functies";





$queryFunctie = "select id, naam from functies order by naam";

$resultFnct = mysql_query($queryFunctie);







$begindatum = "{$_POST['beginjaar']}{$_POST['beginmaand']}{$_POST['begindag']}";

$einddatum = "{$_POST['eindjaar']}{$_POST['eindmaand']}{$_POST['einddag']}";



if ($begindatum == "") $begindatum = "18999999";

if ($einddatum == "") $einddatum = "20999999";



// deel 1 : functies als aanwezige

$select = "";

$namen = "Aantal_overleggen$sep";



$aantalKolommen = mysql_num_rows($resultFnct);



for ($i=0; $i < mysql_num_rows($resultFnct); $i++) {

  $rij = mysql_fetch_array($resultFnct);

  $select .= ", sum(fnct_id={$rij['id']}) ";

  $namen .= "{$rij['naam']}$sep ";

}



$select = substr($select, 1);





switch ($_POST['soortOverleg']) {

  case "vergoeding":

    $beperking = " and keuze_vergoeding = 1 ";

    break;

  case "geenVergoeding":

    $beperking = " and keuze_vergoeding < 1 ";

    break;

  default:

    $beperking = "";

}

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





$query = "select  $velden count(distinct overleg.id), $select

          from patient, hulpverleners hvl, overleg, afgeronde_betrokkenen     $from

          where patient.code = overleg.patient_code and overleg.id = afgeronde_betrokkenen.overleg_id and afgeronde_betrokkenen.persoon_id = hvl.id and afgeronde_betrokkenen.genre = 'hulp'
          and overleggenre = 'gewoon'
          and overleg.datum >= $begindatum  and overleg.datum <= $einddatum

          $beperking $where

          $group ";



//die($query);



$begin = "{$_POST['begindag']}/{$_POST['beginmaand']}/{$_POST['beginjaar']}";

$eind = "{$_POST['einddag']}/{$_POST['eindmaand']}/{$_POST['eindjaar']}";

$csvOutput = "Overleggen en aanwezige hulpverleners per functie({$_POST['soortOverleg']}) van $begin tot $eind\n\n";





$result=mysql_query($query) or die(mysql_error() . "<br /> $query");





$csvOutput .= "$namen \n";





for ($i=0; $i < mysql_num_rows($result); $i++) {

  $rij = mysql_fetch_array($result);

  for ($j = 0; $j < $aantalKolommen; $j++) {

    $csvOutput .= '"' . $rij[$j] . "\"$sep";

  }

  $csvOutput .="\n";

}





// *********************************************************** //

// *********************************************************** //

// *********************************************************** //

// *********************************************************** //



// deel 2 : functies als contactpersoon





// query2 heeft alleen zin voor het geval het toch ook per organisatie is

// in dat geval moeten we ook het veld organisatie toevoegen aan $namen

$query2 = "select organisatie.naam as organisatie, $velden $select

          from patient, hulpverleners hvl, overleg, organisatie     $from

          where patient.code = overleg.patient_code and overleg.contact_hvl = hvl.id

          and overleg.datum >= $begindatum  and overleg.datum <= $einddatum and hvl.organisatie = organisatie.id

          $beperking $where

          $group2 ";

$query = "select  $velden count(distinct overleg.id), $select

          from patient, hulpverleners hvl, overleg, organisatie     $from

          where patient.code = overleg.patient_code and overleg.contact_hvl = hvl.id

          and overleg.datum >= $begindatum  and overleg.datum <= $einddatum and hvl.organisatie = organisatie.id

          $beperking $where

          $group ";



//die($query);



$begin = "{$_POST['begindag']}/{$_POST['beginmaand']}/{$_POST['beginjaar']}";

$eind = "{$_POST['einddag']}/{$_POST['eindmaand']}/{$_POST['eindjaar']}";

$csvOutput .= "\n\n\nOverleggen en hulpverleners als contactpersoon({$_POST['soortOverleg']}) van $begin tot $eind\n\n";





$result=mysql_query($query) or die(mysql_error() . "<br /> $query");



$csvOutput .= "$namen \n";





for ($i=0; $i < mysql_num_rows($result); $i++) {

  $rij = mysql_fetch_array($result);

  for ($j = 0; $j < $aantalKolommen; $j++) {

    $csvOutput .= '"' . $rij[$j] . "\"$sep";

  }

  $csvOutput .="\n";

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