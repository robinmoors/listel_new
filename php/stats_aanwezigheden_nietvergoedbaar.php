<?php

ob_start();

session_start();



   require("../includes/clearSessie.inc");

   require("../includes/dbconnect2.inc");

   if (IsSet($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan"))

      {



$bestandsnaam = "aanwezigheidslijst op niet-vergoede overleggen";



$begindatum = "{$_POST['werkjaar']}0000";

$einddatum = "{$_POST['werkjaar']}1232";



if ($begindatum == "") $begindatum = "18999999";

if ($einddatum == "") $einddatum = "20999999";



/************* EERST VOOR HVL *****************/



$query = "

     select gemeente.naam as gemeente,

            overleg.datum as datum, patient.code as ZP, patient.naam as patient_naam, patient.voornaam as patient_voornaam,

            v.nr as mut, patient.mutnr as id_patient,

            organisatie.naam as org_hvl, functies.naam as discipline, hvl.naam as hvl_naam, hvl.voornaam as hvl_voornaam,

            keuze_vergoeding

     from overleg, patient, verzekering as v, afgeronde_betrokkenen as lijst, functies, hulpverleners as hvl left join organisatie on (hvl.organisatie = organisatie.id),

          gemeente

     where

     gemeente.id = patient.gem_id and
     overleggenre = 'gewoon' and
     overleg.patient_code = patient.code and patient.mut_id = v.id and lijst.overleg_id = overleg.id and lijst.genre = 'hulp' and

     lijst.persoon_id = hvl.id and hvl.fnct_id = functies.id and organisatie.genre = 'HVL'

     and afgerond = 1 and (overleg.datum >= $begindatum and overleg.datum <= $einddatum)

     and (overleg.genre = 'gewoon' or overleg.genre is NULL)

     and (keuze_vergoeding < 1)

     and aanwezig = 1

     order by gemeente.naam, patient.code, overleg.datum, ZP, org_hvl, lijst.id asc";



     // was functies.groep_id = 1





//die($query);



$begin = "01/01/{$_POST['werkjaar']}";

$eind = "31/12/{$_POST['werkjaar']}";

$csvOutput .= "Aanwezigheden HVL op NIET te vergoeden overlegggen van $begin tot $eind\n\n";





$result=mysql_query($query) or die(mysql_error() . "<br /> $query");



$aantalKolommen = mysql_num_fields($result);

for ($i = 0; $i < $aantalKolommen; $i++) {

  $field = mysql_fetch_field($result);

  $kolom[$i] = $field->name;

  if ($field->name == "keuze_vergoeding") $vergoedingskolom = $i;

  $csvOutput .= '"'. $kolom[$i] . "\"$sep";

}

$csvOutput .= "GDT$sep\n";





for ($i=0; $i < mysql_num_rows($result); $i++) {

  $rij = mysql_fetch_array($result);

  for ($j = 0; $j < $aantalKolommen; $j++) {

    if ($j== $vergoedingskolom) {

      switch ($rij[$kolom[$j]]) {

         case -88:

           $csvOutput .= "\"geen keuze\"$sep";

         break;

         case 0:

           $csvOutput .= "\"niet vergoedbaar\"$sep";

         break;

         case -1:

           $csvOutput .= "\"vergoeding geweigerd\"$sep";

         break;

      }

    }

    else

      $csvOutput .= '"' . $rij[$kolom[$j]] . "\"$sep";

  }

  $csvOutput .="$gdt$sep\n";

}



/******************* EINDE HVL ********************/



/************* DAN VOOR ZVL *****************/





$query = "

     select gemeente.naam as gemeente,

            overleg.datum as datum, patient.code as ZP, patient.naam as patient_naam, patient.voornaam as patient_voornaam,

            v.nr as mut, patient.mutnr as id_patient, 

            organisatie.naam as org_hvl, functies.naam as discipline, hvl.naam as hvl_naam, hvl.voornaam as hvl_voornaam,

            keuze_vergoeding

            

     from overleg, patient, verzekering as v, afgeronde_betrokkenen as lijst, functies, hulpverleners as hvl left join organisatie on (hvl.organisatie = organisatie.id),

          gemeente

     where

     gemeente.id = patient.gem_id and
     overleggenre = 'gewoon' and
     overleg.patient_code = patient.code and patient.mut_id = v.id and lijst.overleg_id = overleg.id and lijst.genre = 'hulp' and

     lijst.persoon_id = hvl.id and hvl.fnct_id = functies.id and organisatie.genre = 'ZVL'

     and afgerond = 1 and keuze_vergoeding < 1 and (overleg.datum >= $begindatum and overleg.datum <= $einddatum)

     and (overleg.genre = 'gewoon' or overleg.genre is NULL)

     and aanwezig = 1

     order by gemeente.naam, ZP, overleg.datum, functies.id, org_hvl, lijst.id asc";



//die($query);





$csvOutput .= "\n\n\n\n\n\nAanwezigheden ZVL op NIET te vergoeden overlegggen van $begin tot $eind\n\n";





$result=mysql_query($query) or die(mysql_error() . "<br /> $query");



$aantalKolommen = mysql_num_fields($result);

for ($i = 0; $i < $aantalKolommen; $i++) {

  $field = mysql_fetch_field($result);

  $kolom[$i] = $field->name;

  if ($field->name == "keuze_vergoeding") $vergoedingskolom = $i;

  $csvOutput .= '"'. $kolom[$i] . "\"$sep";

}



$csvOutput .= "\n";









for ($i=0; $i < mysql_num_rows($result); $i++) {

  $rij = mysql_fetch_array($result);

  for ($j = 0; $j < $aantalKolommen; $j++) {

    if ($j== $vergoedingskolom) {

      switch ($rij[$kolom[$j]]) {

         case -88:

           $csvOutput .= "\"geen keuze\"$sep";

         break;

         case 0:

           $csvOutput .= "\"niet vergoedbaar\"$sep";

         break;

         case -1:

           $csvOutput .= "\"vergoeding geweigerd\"$sep";

         break;

      }

    }

    else

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