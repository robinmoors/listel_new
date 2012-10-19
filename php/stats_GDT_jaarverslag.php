<?php

ob_start();

session_start();



   require("../includes/clearSessie.inc");

   require("../includes/dbconnect2.inc");

   if (IsSet($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan"))

      {



$bestandsnaam = "jaarverslag_Vlaamse_overheid";





/******************************************

   eerst kijken over welke groep patienten het gaat (één gemeente, één sit, of voor alles

   ******************************************************************************************/

   

   

if (isset($_SESSION['overleg_gemeente'])) {

    $uitroep = "GEGEVENS VOOR DE GEMEENTE {$_SESSION['overleg_gemeente']}";

    $from = " , gemeente ";

    $where = " and patient.gem_id = gemeente.id and gemeente.zip = {$_SESSION['overleg_gemeente']} ";

}

else switch ($_POST['sit']) {

  case "alles":

  case "":

    $uitroep = "GEGEVENS VOOR ALLE POPS SAMEN";

    break;
  case "H":
    $uitroep = "GEGEVENS VOOR SEL HASSELT";
    $from = "  , gemeente";
    $where = " and patient.gem_id = gemeente.id and gemeente.deelvzw = 'H'";
    break;
  case "G":
    $uitroep = "GEGEVENS VOOR SEL GENK";
    $from = "  , gemeente";
    $where = " and patient.gem_id = gemeente.id and gemeente.deelvzw = 'G'";
    break;

  default:

    $uitroep = "GEGEVENS VOOR DE POP {$_POST['sit']}";

    $from = "  , gemeente, sit ";

    $where = " and patient.gem_id = gemeente.id and gemeente.sit_id = sit.id and sit.naam = '{$_POST['sit']}'";

    break;

}







/*   HET JAARVERSLAG VAN GDT -- voorlopig eerst voor de hele provincie */



// eerst alle zorgplannen met een katz van minstens 5 in dit jaar */

// aantal nieuwe, aantal doorlopende, totaal en totaal psychiatrische



$begin = "01/01/{$_POST['werkjaar']}";

$eind = "31/12/{$_POST['werkjaar']}";



$begindatum = "{$_POST['werkjaar']}0101";

$einddatum = "{$_POST['werkjaar']}1232";

if ($begindatum == "") $begindatum = "18999999";

if ($einddatum == "") $einddatum = "20999999";





$csvOutput = "Jaarverslag 'Vlaamse overheid' van $begin tot $eind\n\n";

$csvOutput .= "$uitroep\n\n";



/*

$csvOutput .= "zorgplannen waarvoor er DE LAATSTE KEER een katz-score van minstens 5 genoteerd is,\n";

$csvOutput .= "of een katz-score van minder dan 5, maar met een goedkeuring van de inspectie\n";

$csvOutput .= "Die katz-score mag zowel uit een overleg als uit een evaluatie komen.\n";

$csvOutput .= "Bovendien moet er OOIT een huisarts aanwezig geweest zijn op het overleg.\n";

$csvOutput .= "Het gaat om zorgplannen waarbij het ofwel over een gewone patient ging, ofwel de OC TGZ\n";

$csvOutput .= "rechten had in de periode dat het overleg en/of de evalutie plaatsgevonden hebben.\n";

$csvOutput .= "Het zorgplan is ofwel nog actief, ofwel afgesloten na 01/01/{$_POST['werkjaar']}.\n\n";

*/



$csvOutput .= "zorgplannen met status verdedigd of ok.\n";

$csvOutput .= "Het gaat om zorgplannen waarbij het ofwel over een gewone patient ging, ofwel de OC TGZ\n";

$csvOutput .= "rechten had in de periode dat het overleg en/of de evalutie plaatsgevonden hebben.\n";

$csvOutput .= "Het zorgplan is ofwel nog actief, ofwel afgesloten na 01/01/{$_POST['werkjaar']}.\n\n";



$kortJaar = substr($_POST['werkjaar'],2,2);

$datumbeperkingNieuw = "  substring(code,7,2) = $kortJaar";

$datumbeperkingDoorlopend = " ((substring(code,7,2) < $kortJaar) or (substring(code,7,2) > 90))

                              AND (einddatum is NULL or einddatum = 0 or einddatum >= {$_POST['werkjaar']}0000)";

//$datumbeperkingDoorlopend = " (startdatum < $begindatum and (einddatum is NULL or einddatum = 0 or einddatum >= $begindatum)) ";











function laatsteKatzOkVoor($patcode) {

  $queryKatzUnion = "(select overleg.patient_code as patcode, katz.totaal, concat(jj,mm,dd) as katzdatum, katz.goedkeuring_inspectie from overleg, katz

                      where abs(overleg.katz_id)  = katz.id

                        and overleg.patient_code = '$patcode'

                        and ((concat(jj,mm,dd) < {$_POST['werkjaar']}1232) or (overleg.datum <  {$_POST['werkjaar']}1232)))

                     union

                     (select evaluatie.patient as patcode, katz.totaal, concat(jj,mm,dd) as katzdatum, katz.goedkeuring_inspectie from evaluatie, katz

                      where abs(evaluatie.katz_id)  = katz.id

                        and evaluatie.patient = '$patcode'

                        and ((concat(jj,mm,dd) < {$_POST['werkjaar']}1232) or (evaluatie.datum <  {$_POST['werkjaar']}1232)))

                     order by katzdatum desc";

  $resultKatz = mysql_query($queryKatzUnion) or die("dedju: $queryKatzUnion<br/>" .mysql_error());

  if (mysql_num_rows($resultKatz)==0) return false;

  $rijKatz = mysql_fetch_assoc($resultKatz);

    foreach ($rijKatz as $key => $value) {

      $rijKatz[$key] = utf8_decode($rijKatz[$key]);

    }

  if ($rijKatz['totaal']>=5 || $rijKatz['goedkeuring_inspectie']==1)

    return true;

  else

    return false;

}



/*

$queryDrAfgerond = "select distinct code, type from (patient inner join overleg on code = overleg.patient_code),

                                               afgeronde_betrokkenen afg, hulpverleners hvl  $from

                    where afg.overleg_id = overleg.id and afg.persoon_id = hvl.id and afg.genre = 'hulp'

                    and afg.aanwezig = 1 and hvl.fnct_id = 1

                    and overleg.datum < {$_POST['werkjaar']}1232

                    and overleg.afgerond = 1

                    and (einddatum is NULL or einddatum >= $begindatum or einddatum = '')

                        and (overleg.genre is NULL or overleg.genre = 'GDT' or (overleg.genre = 'TP' and overleg.tp_rechtenOC = 1))

                    XXX

                    $where";

$queryDrHuidig = "select distinct code, type from (patient inner join overleg on code = overleg.patient_code), huidige_betrokkenen afg, hulpverleners hvl $from

                    where afg.patient_code = code and afg.persoon_id = hvl.id and afg.genre = 'hulp'

                    and afg.aanwezig = 1 and hvl.fnct_id = 1

                    and overleg.datum < {$_POST['werkjaar']}1232

                    and overleg.afgerond = 0

                    and (einddatum is NULL or einddatum >= $begindatum or einddatum = '')

                        and (overleg.genre is NULL or overleg.genre = 'GDT' or (overleg.genre = 'TP' and overleg.tp_rechtenOC = 1))

                    XXX

                    $where ";

$queryHuisArts = "$queryDrAfgerond UNION $queryDrHuidig order by code";





$query = $queryHuisArts;

*/



$query= "select distinct code, type, patient.naam, voornaam from (patient inner join overleg on code = overleg.patient_code)

                                         $from

         where (true or subsidiestatus  = 'ok' or subsidiestatus  = 'verdedigd')

           and tp_record is NULL

           XXX

           $where";





//$queryNieuw = "$query and $datumbeperkingNieuw";

//$queryDoorlopend = "$query and $datumbeperkingDoorlopend";

//$queryPsychiatrisch = "$query and (patient.type = 3 or patient.type = 4)";

$queryNieuw = str_replace("XXX"," and $datumbeperkingNieuw ", $query);

//die($queryNieuw);
$queryDoorlopend = str_replace("XXX"," and $datumbeperkingDoorlopend ", $query);



$resultNieuw=mysql_query($queryNieuw) or die(mysql_error() . "<br />1: $queryNieuw");

$resultDoorlopend=mysql_query($queryDoorlopend) or die(mysql_error() . "<br />2: $queryDoorlopend");

//$resultPsychiatrisch=mysql_query($queryPsychiatrisch) or die(mysql_error() . "<br /> $queryPsychiatrisch");



//$aantalNieuw = mysql_num_rows($resultNieuw);

//$aantalDoorlopend = mysql_num_rows($resultDoorlopend);

//$aantalPsychiatrisch = mysql_num_rows($resultPsychiatrisch);



$aantalNieuw = $aantalDoorlopend = $aantalPsychiatrisch = 0;



$csvOutput .= "\nNIEUWE zorgplanNEN";//\n$queryNieuw\n";



$nieuweCodes = "";



for ($i=0; $i<mysql_num_rows($resultNieuw); $i++) {

  $nieuw = mysql_fetch_assoc($resultNieuw);

    foreach ($nieuw as $key => $value) {

      $nieuw[$key] = utf8_decode($nieuw[$key]);

    }

  //if (laatsteKatzOkVoor($nieuw['code'])) {

     $aantalNieuw++;

     $csvOutput .= "\n$sep$sep$sep{$nieuw['code']}";

     $csvOutput .= "$sep{$nieuw['naam']} {$nieuw['voornaam']}";

     $nieuweCodes .= ", '{$nieuw['code']}'";

     if ($nieuw['type']==3 ||  $nieuw['type']==4)

       $aantalPsychiatrisch++;

  //}

}



$csvOutput .= "\nAantal nieuwe :$sep$aantalNieuw";

$nieuweCodes = substr($nieuweCodes, 2);



$csvOutput .= "\nDOORLOPENDE zorgplanNEN"; // $queryDoorlopend";

for ($i=0; $i<mysql_num_rows($resultDoorlopend); $i++) {

  $door = mysql_fetch_assoc($resultDoorlopend);

    foreach ($door as $key => $value) {

      $door[$key] = utf8_decode($door[$key]);

    }

  //if (laatsteKatzOkVoor($door['code'])) {

     $aantalDoorlopend++;

     $csvOutput .= "\n$sep$sep$sep{$door['code']}";

     $csvOutput .= "$sep{$door['naam']} {$door['voornaam']}";

     if ($door['type']==3 ||  $door['type']==4)

       $aantalPsychiatrisch++;

  //}

}

$csvOutput .= "\nAantal lopende :$sep$aantalDoorlopend";





$csvOutput .= "\nTotaal :$sep" . ($aantalNieuw + $aantalDoorlopend);

$csvOutput .= "\nwaarvan psychiatrisch:$sep$aantalPsychiatrisch $sep(= op dit moment patient-type 3 of 4)";







/***************************************************

 * NU DIE MET EEN EFFECTIEF OVERLEG                *

 ***************************************************/

 

$csvOutput .= "\n\nzorgplannen met effectief een overleg in de periode.\n";



//$datumbeperkingNieuw = " (startdatum >= $begindatum and startdatum <= $einddatum) ";

//$datumbeperkingDoorlopend = " (startdatum < $begindatum and (einddatum is NULL or einddatum = 0 or einddatum >= $begindatum)) ";



$query = "select distinct patient.code, patient.naam, voornaam from patient, overleg $from

                      where patient.code = overleg.patient_code

                        and (true or subsidiestatus  = 'ok' or subsidiestatus  = 'verdedigd')

           and tp_record is NULL

                        and overleg.datum >= $begindatum and overleg.datum <= $einddatum

                   /*     and (overleg.genre is NULL or overleg.genre = 'gewoon' or (overleg.genre = 'TP' and overleg.tp_rechtenOC = 1)) */

                        and (overleg.genre is NULL or overleg.genre = 'gewoon' )

          $where";



          

if ($nieuweCodes == "") {

  $queryNieuw = "$query and (1=2) and $datumbeperkingNieuw order by patient.code";

}

else {

  $queryNieuw = "$query and patient.code in ($nieuweCodes) and $datumbeperkingNieuw order by patient.code";

}



$queryDoorlopend = "$query and $datumbeperkingDoorlopend order by patient.code";



$resultNieuw=mysql_query($queryNieuw) or die(mysql_error() . "<br />3 $queryNieuw");

$resultDoorlopend=mysql_query($queryDoorlopend) or die(mysql_error() . "<br />4 $queryDoorlopend");



$aantalNieuw = mysql_num_rows($resultNieuw);

$aantalDoorlopend = mysql_num_rows($resultDoorlopend);



//$csvOutput .= "\n$queryNieuw";





$csvOutput .= "\nAantal nieuwe :$sep$aantalNieuw";



for ($i=0; $i<mysql_num_rows($resultNieuw); $i++) {

  $nieuw = mysql_fetch_assoc($resultNieuw);

    foreach ($nieuw as $key => $value) {

      $nieuw[$key] = utf8_decode($nieuw[$key]);

    }

  $csvOutput .= "\n$sep$sep$sep{$nieuw['code']}";

}



$csvOutput .= "\nAantal lopende :$sep$aantalDoorlopend";

for ($i=0; $i<mysql_num_rows($resultDoorlopend); $i++) {

  $door = mysql_fetch_assoc($resultDoorlopend);

    foreach ($door as $key => $value) {

      $door[$key] = utf8_decode($door[$key]);

    }

  $csvOutput .= "\n$sep$sep$sep{$door['code']}";

}



$csvOutput .= "\nTotaal :$sep" . ($aantalNieuw + $aantalDoorlopend);





/***************************************************

 * AANTALLEN VAN GEFACTUREERDE OVERLEGGEN          *

 ***************************************************/



$csvOutput .= "\n\nHoeveel overleggen zijn gefactureerd (zonder overleggen TP (zelfs als OC TGZ rechten had))?\n";



/*

                 sum((locatie = 0) and (overleg.genre is NULL or overleg.genre = 'gewoon')) as puur_gdt_thuis,

                 sum((locatie <> 0) and (overleg.genre is NULL or overleg.genre = 'gewoon')) as puur_gdt_elders,

                 sum((locatie = 0) and (overleg.genre = 'TP' and overleg.tp_rechtenOC = 1)) as TP_thuis,

                 sum((locatie <> 0) and (overleg.genre = 'TP' and overleg.tp_rechtenOC = 1)) as TP_elders

*/



$query = "select count(overleg.id) as totaal_aantal, sum(locatie = 0) as thuis, sum(locatie <> 0) as elders

          from overleg , patient $from

          where patient.code = overleg.patient_code and overleg.datum >= $begindatum  and overleg.datum <= $einddatum

                        and (overleg.genre is NULL or overleg.genre = 'gewoon')

                        and factuur_code is not NULL

          $where ";



$result=mysql_query($query) or die(mysql_error() . "<br /> $query");

//$csvOutput .= "$query\n";

$aantalKolommen = mysql_num_fields($result);

for ($i = 0; $i < $aantalKolommen; $i++) {

  $field = mysql_fetch_field($result);

  $kolom[$i] = utf8_decode($field->name);

  $csvOutput .= '"'. $kolom[$i] . "\"$sep";

}

$csvOutput .= "\n";





for ($i=0; $i < mysql_num_rows($result); $i++) {

  $rij = mysql_fetch_array($result);

  foreach ($rij as $key => $value) {

    $rij[$key] = utf8_decode($rij[$key]);

  }

  for ($j = 0; $j < $aantalKolommen; $j++) {

    $csvOutput .= '"' . $rij[$kolom[$j]] . "\"$sep";

  }

  $csvOutput .="\n";

}





// overzicht van functies als betrokkene bij een van die gefactureerde overleggen





/*

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

    $velden = "  concat('POP ',sit.naam) as sit, ";

    $where = " and patient.gem_id = gemeente.id and gemeente.sit_id = sit.id ";

    $group = " group by sit.naam order by sit.naam";

    $group2 = " group by sit.naam, organisatie.id order by sit.naam, organisatie.naam";

    break;

  default:

    $group2 = " group by organisatie.id order by organisatie.naam ";

    // alles samen

}

*/



/*

$query = "select  $velden  $select

          from patient, hulpverleners hvl, huidige_betrokkenen     $from

          where $effectiefBeperking $datumbeperking and patient.code = huidige_betrokkenen.patient_code and huidige_betrokkenen.persoon_id = hvl.id and huidige_betrokkenen.genre = 'hulp'

          $where

          $group ";

*/



$query = "select functies.naam, count(distinct overleg.id)

          from patient, overleg, afgeronde_betrokkenen, hulpverleners hvl, functies  $from

          where patient.code = overleg.patient_code and overleg.datum >= $begindatum  and overleg.datum <= $einddatum
            and overleggenre = 'gewoon'
            and (overleg.genre is NULL or overleg.genre = 'gewoon')

            and factuur_code is not NULL

            and overleg.id = afgeronde_betrokkenen.overleg_id

            and afgeronde_betrokkenen.persoon_id = hvl.id

            and afgeronde_betrokkenen.genre = 'hulp'

            and afgeronde_betrokkenen.aanwezig = 1

            and hvl.fnct_id = functies.id

            and (functies.groep_id = 1 or functies.groep_id = 2)

            $where

          group by functies.id

          ";





$csvOutput .= "\n\n\nHet aantal overleggen waarbij een bepaalde functie AANWEZIG was op het overleg was in de periode van $begin tot $eind\n";

$csvOutput .= "met de beperking dat de organisatie ZVL of HVL moet zijn\n\n";





$result=mysql_query($query) or die(mysql_error() . "<br /> $query");





$csvOutput .= "$namen \n";





for ($i=0; $i < mysql_num_rows($result); $i++) {

  $rij = mysql_fetch_array($result);

  foreach ($rij as $key => $value) {

    $rij[$key] = utf8_decode($rij[$key]);

  }

  for ($j = 0; $j < $aantalKolommen; $j++) {

    $csvOutput .= '"' . $rij[$j] . "\"$sep";

  }

  $csvOutput .="\n";

}





if ($_SESSION['profiel']=="listel" && $_POST['beperking'] != "gemeente" && $_POST['beperking'] != "sit") {

  // deel 3 organisaties betrokken bij zorgplan



  $orgQuery = "select organisatie.naam as org_naam, count(distinct(overleg.id)) as aantal_overleggen

               from organisatie, overleg, afgeronde_betrokkenen, hulpverleners, patient $from

               where patient.code = overleg.patient_code and overleg.datum >= $begindatum  and overleg.datum <= $einddatum
                  and overleggenre = 'gewoon'
                  and (overleg.genre is NULL or overleg.genre = 'gewoon')

                  and factuur_code is not NULL

                  and organisatie.id = hulpverleners.organisatie

                  and afgeronde_betrokkenen.persoon_id = hulpverleners.id

                  and overleg.id = afgeronde_betrokkenen.overleg_id

                  and patient.code = overleg.patient_code

               $where

               group by organisatie.id

               order by organisatie.naam";

  $csvOutput .= "\n'*** Organisaties betrokken bij een overleg'\nOrganisatie{$sep}Aantal Overleggen\n";



  $resultOrg = mysql_query($orgQuery);



  for ($i=0; $i<mysql_num_rows($resultOrg); $i++) {

    $org = mysql_fetch_assoc($resultOrg);

    foreach ($org as $key => $value) {

      $org[$key] = utf8_decode($org[$key]);

    }

    $csvOutput .= "{$org['org_naam']}$sep{$org['aantal_overleggen']}\n";

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



//////// OUDE QUERIES VOOR DOWNGRADES

//$datumbeperkingNieuw = " (startdatum >= $begindatum and startdatum <= $einddatum) ";

//$datumbeperkingDoorlopend = " (startdatum < $begindatum and (einddatum is NULL or einddatum = 0 or einddatum >= $begindatum)) ";



/*

$queryOud = "select distinct patient.code, patient.type from patient $from

          where

          NOT (

            patient.code in

              (select overleg.patient_code from overleg,katz

                      where overleg.datum >= $begindatum and overleg.datum <= $einddatum

                        and (overleg.genre is NULL or overleg.genre = 'gewoon' or (overleg.genre = 'TP' and overleg.tp_rechtenOC = 1))

                        and abs(overleg.katz_id) = katz.id

                        and (katz.totaal >= 5  or goedkeuring_inspectie = 1))

            or

            patient.code in

              (select evaluatie.patient from katz, evaluatie

                      where evaluatie.datum >= $begindatum and evaluatie.datum <= $einddatum

                        and abs(evaluatie.katz_id) = katz.id

                        and (katz.totaal >= 5  or goedkeuring_inspectie = 1)

                        and tp_rechtenOC = 1

                      )

          )

          and

          (

            patient.code in

              (select evaluatie.patient from katz, evaluatie

                      where evaluatie.datum >= $begindatum and evaluatie.datum <= $einddatum

                        and evaluatie.katz_id is NULL

                        and tp_rechtenOC = 1

                      )

          )

          $where ";

*/

/***************************************************

    STOUTE GEVALLEN, NL. MET EEN EVALUATIE ZONDER KATZ, maar de vorige katz was wel >= 5 of goedgekeurd

****************************************************/

/*

$csvOutput .= "\n\n***************************************************";

$csvOutput .= "\n    STOUTE GEVALLEN, NL. ZONDER OVERLEG, EN EVALUATIE ZONDER KATZ, maar de vorige katz was wel >= 5 of goedgekeurd ";

$csvOutput .= "\n****************************************************\n";





$query = "select distinct patient.code, patient.type from patient $from

          where

          NOT (

            patient.code in

              (select overleg.patient_code from overleg,katz

                      where overleg.datum >= $begindatum and overleg.datum <= $einddatum

                        and (overleg.genre is NULL or overleg.genre = 'gewoon' or (overleg.genre = 'TP' and overleg.tp_rechtenOC = 1))

                        and abs(overleg.katz_id) = katz.id

                        and (katz.totaal >= 5  or goedkeuring_inspectie = 1))

            or

            patient.code in

              (select evaluatie.patient from katz, evaluatie

                      where evaluatie.datum >= $begindatum and evaluatie.datum <= $einddatum

                        and abs(evaluatie.katz_id) = katz.id

                        and (katz.totaal >= 5  or goedkeuring_inspectie = 1)

                        and tp_rechtenOC = 1

                      )

          )

          and

          (

            patient.code in

              (select evaluatie.patient from katz, evaluatie

                      where evaluatie.datum >= $begindatum and evaluatie.datum <= $einddatum

                        and evaluatie.katz_id is NULL

                        and tp_rechtenOC = 1

                      )

          )

          $where ";



$queryDoorlopend = "$query and $datumbeperkingDoorlopend";



$resultDoorlopend=mysql_query($queryDoorlopend) or die(mysql_error() . "<br /> $queryDoorlopend");





$aantalDoorlopendStout = 0;

$aantalPsychiatrischStout = 0;

for ($i=0; $i<mysql_num_rows($resultDoorlopend); $i++) {

  $door = mysql_fetch_assoc($resultDoorlopend);

  $query2a = "select ((katz.totaal >= 5) or (goedkeuring_inspectie = 1)) as katz_ok, concat(jj,mm,dd) from katz

              where katz.id in (select overleg.katz_id from overleg where patient_code = '{$door['code']}')

                    and katz.jj < {$_POST['werkjaar']} order by katz.jj desc, katz.mm desc, katz.dd desc

              limit 0,1";

  $query2b = "select ((katz.totaal >= 5) or (goedkeuring_inspectie = 1)) as katz_ok, concat(jj,mm,dd) from katz

              where katz.id in (select -katz_id from evaluatie where patient = '{$door['code']}')

                    and katz.jj < {$_POST['werkjaar']} order by katz.jj desc, katz.mm desc, katz.dd desc

              limit 0,1";

  $result2a = mysql_query($query2a) or die($query2a);

  $result2b = mysql_query($query2b) or die($query2b);

  $rij2a = mysql_fetch_assoc($result2a);

  $rij2b = mysql_fetch_assoc($result2b);

  if ($rij2a['katz_ok']==1 || $rij2b['katz_ok']==1) {

     $csvOutput .= "\n$sep$sep$sep{$door['code']}";

     $aantalDoorlopendStout++;

     if ($door['type']==3 || $door['type'] == 4)

       $aantalPsychiatrischStout++;

  }

}

$csvOutput .= "\nAantal lopende :$sep$aantalDoorlopendStout";

$csvOutput .= "\nwaarvan psychiatrisch:$sep$aantalPsychiatrischStout $sep(= op dit moment patient-type 3 of 4)";



*/

/*

$queryDieVeelTeStrengIsWantDieKijktAlleenOfErEenOverlegOfEvaluatieWasInDatJaar = "select distinct patient.code from patient $from

          where

          (

            patient.code in

              (select overleg.patient_code from overleg,katz

                      where overleg.datum >= $begindatum and overleg.datum <= $einddatum

                        and (overleg.genre is NULL or overleg.genre = 'gewoon' or (overleg.genre = 'TP' and overleg.tp_rechtenOC = 1))

                        and abs(overleg.katz_id) = katz.id

                        and (katz.totaal >= 5  or goedkeuring_inspectie = 1))

            or

            patient.code in

              (select evaluatie.patient from katz, evaluatie

                      where evaluatie.datum >= $begindatum and evaluatie.datum <= $einddatum

                        and abs(evaluatie.katz_id) = katz.id

                        and (katz.totaal >= 5  or goedkeuring_inspectie = 1)

                        and tp_rechtenOC = 1

                      )

          )

          $where ";



$queryTeLosWantTestAlleenOfErOoitEenOverlegMetEenGoedeKatzWas = "select distinct patient.code from patient $from

          where

          (

            patient.code in

              (select overleg.patient_code from overleg,katz

                      where overleg.datum <= $einddatum

                        and (overleg.genre is NULL or overleg.genre = 'gewoon' or (overleg.genre = 'TP' and overleg.tp_rechtenOC = 1))

                        and abs(overleg.katz_id) = katz.id

                        and (katz.totaal >= 5  or goedkeuring_inspectie = 1))

          )

          and (einddatum is NULL or einddatum >= $begindatum or einddatum = '')

          $where ";



*/

?>