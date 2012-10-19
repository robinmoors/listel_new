<?php
ob_start();

session_start();




   require("../includes/dbconnect2.inc");
   require("../includes/clearSessie.inc");


   if (IsSet($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan") && ($_SESSION['profiel']=="listel"))

      {



$bestandsnaam = "statistiek_organisatie_MO_2011";





  $csvOutput = "Statistiek van organisatie MO\n";
  $csvOutput .= "\n\n";
  
  
//Bij “uittreksel voor organisatie”  som toevoegen per organisatie, thuis / elders aanduiden en ook niet-vergoedbaar tellen.
//Dat is voor 3-6.

function csvRecords($query) {
  global $csvOutput;
  $result = mysql_query($query);
  for ($i=0; $i<mysql_num_rows($result); $i++) {
    $record = mysql_fetch_assoc($result);
    foreach ($record as $value) {
      $csvOutput .= "{$value};";
    }
    $csvOutput .= "\n";
  }
  $csvOutput .= "\n";
  $csvOutput .= "\n";
}

$qryOrganisatorenGemeente = "
select sum(locatie=0) as thuis, sum(locatie=1) as elders, organisatie.*
                              from overleg inner join logins on overleg.toegewezen_genre = 'gemeente' and coordinator_id = logins.id
                                           inner join organisatie on logins.organisatie = organisatie.id
                              where (overleg.genre is NULL or overleg.genre = 'gewoon')
                                and (overleg.datum > 20110000 and overleg.datum < 20111232)
                              group by organisatie.id
";
$csvOutput .= "********;**********;*******;******\n";
$csvOutput .= "Organisatoren Gemeente\n";
$csvOutput .= "thuis{$sep}elders{$sep}id van organisatie{$sep}naam org{$sep}adres{$sep}gemeente id{$sep}tel{$sep}fax{$sep}gsm{$sep}reknr{$sep}iban{$sep}bic{$sep}contact{$sep}{$sep}{$sep}{$sep}actief{$sep}genre{$sep}id hoofdzetel\n";
csvRecords($qryOrganisatorenGemeente);


$qryOrganisatorenRDC = "
select sum(locatie=0) as thuis, sum(locatie=1) as elders, gemeente.deelvzw, organisatie.*
                              from overleg inner join organisatie on overleg.toegewezen_genre = 'rdc' and toegewezen_id = organisatie.id
                                           inner join patient on overleg.patient_code = patient.code
                                           inner join gemeente on patient.gem_id = gemeente.id and gemeente.deelvzw = 'H'
                              where (overleg.genre is NULL or overleg.genre = 'gewoon')
                                and (overleg.datum > 20110000 and overleg.datum < 20111232)
                              group by organisatie.id";
$csvOutput .= "********;**********;*******;******\n";
$csvOutput .= "Organisatoren RDC Hasselt\n";
$csvOutput .= "thuis{$sep}elders{$sep}id van organisatie{$sep}naam org{$sep}adres{$sep}gemeente id{$sep}tel{$sep}fax{$sep}gsm{$sep}reknr{$sep}iban{$sep}bic{$sep}contact{$sep}{$sep}{$sep}{$sep}actief{$sep}genre{$sep}id hoofdzetel\n";
csvRecords($qryOrganisatorenRDC);



$qryOrganisatorenHulp = "
select sum(locatie=0) as thuis, sum(locatie=1) as elders, hvl.naam, hvl.voornaam, organisatie.*
                              from overleg inner join hulpverleners hvl on overleg.toegewezen_genre = 'hulp' and toegewezen_id = hvl.id
                                           inner join organisatie on hvl.organisatie = organisatie.id
                                           inner join patient on overleg.patient_code = patient.code
                                           inner join gemeente on patient.gem_id = gemeente.id and gemeente.deelvzw = 'H'
                              where (overleg.genre is NULL or overleg.genre = 'gewoon')
                                and (overleg.datum > 20110000 and overleg.datum < 20111232)
                              group by organisatie.id
";
$csvOutput .= "********;**********;*******;******\n";
$csvOutput .= "Organisatoren Hulp Hasselt\n";
$csvOutput .= "thuis{$sep}elders{$sep}naam{$sep}voornaam{$sep}id van organisatie{$sep}naam org{$sep}adres{$sep}gemeente id{$sep}tel{$sep}fax{$sep}gsm{$sep}reknr{$sep}iban{$sep}bic{$sep}contact{$sep}{$sep}{$sep}{$sep}actief{$sep}genre{$sep}id hoofdzetel\n";
csvRecords($qryOrganisatorenHulp);




/*
7-23 is via “jaarverslag GDT” (wel H en G opsplitsen) en ook niet-vergoedbaar meetellen, en ook niet ZVL, niet HVL meetellen.
*/

$from = " , gemeente ";
$where = " and patient.gem_id = gemeente.id and gemeente.deelvzw = 'H' ";
$query = "select functies.naam, count(distinct overleg.id)
          from patient, overleg, afgeronde_betrokkenen, hulpverleners hvl, functies  $from
          where overleggenre = 'gewoon'
            and patient.code = overleg.patient_code and overleg.datum >= 20110000  and overleg.datum <= 20111232
            and (overleg.genre is NULL or overleg.genre = 'gewoon')
            and overleg.id = afgeronde_betrokkenen.overleg_id
            and afgeronde_betrokkenen.persoon_id = hvl.id
            and afgeronde_betrokkenen.genre = 'hulp'
            and afgeronde_betrokkenen.aanwezig = 1
            and hvl.fnct_id = functies.id
            $where
          group by functies.id
          ";
$csvOutput .= "********;**********;*******;******\n";
$csvOutput .= "Overzicht per functie Hasselt\n";
csvRecords($query);


/*
25-30 is nieuw: voorwaarde “een overleg”

*/

$qryPatsMetOverleg = "
select count(distinct patient_code), gemeente.naam
                              from overleg inner join patient on overleg.patient_code = patient.code
                                           inner join gemeente on patient.gem_id = gemeente.id and gemeente.deelvzw = 'H'
                              where (overleg.genre is NULL or overleg.genre = 'gewoon')
                                and (overleg.datum > 20110000 and overleg.datum < 20111232)
                              group by gemeente.zip
";
$csvOutput .= "********;**********;*******;******\n";
$csvOutput .= "Patienten Per Gemeente Hasselt\n";
csvRecords($qryPatsMetOverleg);

$qryPatsMetOverleg = "
select count(distinct patient_code), sex
       from overleg inner join patient on overleg.patient_code = patient.code
                                           inner join gemeente on patient.gem_id = gemeente.id and gemeente.deelvzw = 'H'
                              where (overleg.genre is NULL or overleg.genre = 'gewoon')
                                and (overleg.datum > 20110000 and overleg.datum < 20111232)
       group by sex
";
$csvOutput .= "********;**********;*******;******\n";
$csvOutput .= "Patienten Per Soort Hasselt\n";
$csvOutput .= "Eerst aantal man, dan aantal vrouw\n";
csvRecords($qryPatsMetOverleg);


$qryPatsMetOverleg = "
select count(distinct patient_code)
                              from overleg inner join patient on overleg.patient_code = patient.code
                                           inner join gemeente on patient.gem_id = gemeente.id and gemeente.deelvzw = 'H'
                              where (overleg.genre is NULL or overleg.genre = 'gewoon')
                                and (overleg.datum > 20110000 and overleg.datum < 20111232)
                                and (gebdatum < 19470000)
";
$csvOutput .= "********;**********;*******;******\n";
$csvOutput .= "Patienten Ouder dan 65 Hasselt (geboren voor 1/1/1947)\n";
csvRecords($qryPatsMetOverleg);

$qryPatsMetOverleg = "
select count(distinct patient_code)
                              from overleg inner join patient on overleg.patient_code = patient.code
                                           inner join gemeente on patient.gem_id = gemeente.id and gemeente.deelvzw = 'H'
                              where (overleg.genre is NULL or overleg.genre = 'gewoon')
                                and (overleg.datum > 20110000 and overleg.datum < 20111232)
                                and (gebdatum > 19470000)
";
$csvOutput .= "********;**********;*******;******\n";
$csvOutput .= "Patienten Jonger dan 65 Hasselt (geboren na 1/1/1947)\n";
csvRecords($qryPatsMetOverleg);



$csvOutput .= "********;**********;*******;******\n";
$csvOutput .= "********;**********;*******;******\n";
$csvOutput .= "********;**********;*******;******\n";
$csvOutput .= "********;**********;*******;******\n";
$csvOutput .= "*    GENK    *\n";
$csvOutput .= "********;**********;*******;******\n";
$csvOutput .= "********;**********;*******;******\n";
$csvOutput .= "********;**********;*******;******\n";
$csvOutput .= "********;**********;*******;******\n";

$qryOrganisatorenRDC = "
select sum(locatie=0) as thuis, sum(locatie=1) as elders, gemeente.deelvzw, organisatie.*
                              from overleg inner join organisatie on overleg.toegewezen_genre = 'rdc' and toegewezen_id = organisatie.id
                                           inner join patient on overleg.patient_code = patient.code
                                           inner join gemeente on patient.gem_id = gemeente.id and gemeente.deelvzw = 'G'
                              where (overleg.genre is NULL or overleg.genre = 'gewoon')
                                and (overleg.datum > 20110000 and overleg.datum < 20111232)
                              group by organisatie.id";
$csvOutput .= "********;**********;*******;******\n";
$csvOutput .= "Organisatoren RDC Genk\n";
csvRecords($qryOrganisatorenRDC);


$qryOrganisatorenHulp = "
select sum(locatie=0) as thuis, sum(locatie=1) as elders, hvl.naam, hvl.voornaam, organisatie.*
                              from overleg inner join hulpverleners hvl on overleg.toegewezen_genre = 'hulp' and toegewezen_id = hvl.id
                                           inner join organisatie on hvl.organisatie = organisatie.id
                                           inner join patient on overleg.patient_code = patient.code
                                           inner join gemeente on patient.gem_id = gemeente.id and gemeente.deelvzw = 'G'
                              where (overleg.genre is NULL or overleg.genre = 'gewoon')
                                and (overleg.datum > 20110000 and overleg.datum < 20111232)
                              group by organisatie.id
";
$csvOutput .= "********;**********;*******;******\n";
$csvOutput .= "Organisatoren Hulp Genk\n";
csvRecords($qryOrganisatorenHulp);


$from = " , gemeente ";
$where = " and patient.gem_id = gemeente.id and gemeente.deelvzw = 'G' ";
$query = "select functies.naam, count(distinct overleg.id)
          from patient, overleg, afgeronde_betrokkenen, hulpverleners hvl, functies  $from
          where overleggenre = 'gewoon'
            and patient.code = overleg.patient_code and overleg.datum >= 20110000  and overleg.datum <= 20111232
            and (overleg.genre is NULL or overleg.genre = 'gewoon')
            and overleg.id = afgeronde_betrokkenen.overleg_id
            and afgeronde_betrokkenen.persoon_id = hvl.id
            and afgeronde_betrokkenen.genre = 'hulp'
            and afgeronde_betrokkenen.aanwezig = 1
            and hvl.fnct_id = functies.id
            $where
          group by functies.id
          ";
$csvOutput .= "********;**********;*******;******\n";
$csvOutput .= "Overzicht per functie Genk\n";
csvRecords($query);


$qryPatsMetOverleg = "
select count(distinct patient_code), gemeente.naam
                              from overleg inner join patient on overleg.patient_code = patient.code
                                           inner join gemeente on patient.gem_id = gemeente.id and gemeente.deelvzw = 'G'
                              where (overleg.genre is NULL or overleg.genre = 'gewoon')
                                and (overleg.datum > 20110000 and overleg.datum < 20111232)
                              group by gemeente.zip
";
$csvOutput .= "********;**********;*******;******\n";
$csvOutput .= "Patienten Per Gemeente Genk\n";
csvRecords($qryPatsMetOverleg);

$qryPatsMetOverleg = "
select count(distinct patient_code), sex
       from overleg inner join patient on overleg.patient_code = patient.code
                                           inner join gemeente on patient.gem_id = gemeente.id and gemeente.deelvzw = 'G'
                              where (overleg.genre is NULL or overleg.genre = 'gewoon')
                                and (overleg.datum > 20110000 and overleg.datum < 20111232)
       group by sex
";
$csvOutput .= "********;**********;*******;******\n";
$csvOutput .= "Patienten Per Soort Genk\n";
$csvOutput .= "Eerst aantal man, dan aantal vrouw\n";
csvRecords($qryPatsMetOverleg);


$qryPatsMetOverleg = "
select count(distinct patient_code)
                              from overleg inner join patient on overleg.patient_code = patient.code
                                           inner join gemeente on patient.gem_id = gemeente.id and gemeente.deelvzw = 'G'
                              where (overleg.genre is NULL or overleg.genre = 'gewoon')
                                and (overleg.datum > 20110000 and overleg.datum < 20111232)
                                and (gebdatum < 19470000)
";
$csvOutput .= "********;**********;*******;******\n";
$csvOutput .= "Patienten Ouder dan 65 Genk (geboren voor 1/1/1947)\n";
csvRecords($qryPatsMetOverleg);

$qryPatsMetOverleg = "
select count(distinct patient_code)
                              from overleg inner join patient on overleg.patient_code = patient.code
                                           inner join gemeente on patient.gem_id = gemeente.id and gemeente.deelvzw = 'G'
                              where (overleg.genre is NULL or overleg.genre = 'gewoon')
                                and (overleg.datum > 20110000 and overleg.datum < 20111232)
                                and (gebdatum > 19470000)
";
$csvOutput .= "********;**********;*******;******\n";
$csvOutput .= "Patienten Jonger dan 65 Genk (geboren na 1/1/1947)\n";
csvRecords($qryPatsMetOverleg);


$csvOutput .= "\n\ngegenereerd op " . date("d/m/Y H:i.s ");

header("Content-Type: text/csv");

header("Cache-Control: must-revalidate, post-check=0,pre-check=0");

header("Content-Transfer-Encoding: binary");

header("Content-Disposition: attachment; filename=\"{$bestandsnaam}.csv\"");

header("Content-length: " . strlen($csvOutput));

print($csvOutput);



      require("../includes/dbclose.inc");

      require("../includes/footer.inc");


      }



//---------------------------------------------------------

/* Geen Toegang */ require("../includes/check_access.inc");

//---------------------------------------------------------



//---------------------------------------------------------

/* Sluit Dbconnectie */ require("../includes/dbclose.inc");

//---------------------------------------------------------

?>