<?php

require("../includes/aantal_arts.php"); //$aantal_arts

require("../includes/aantal_tvp.php"); //$aantal_tvp

require("../includes/aantal_zvl.php"); //$aantal_zvl

require("../includes/aantal_hvl.php"); //$aantal_hvl

require("../includes/aantal_xvl.php"); //$aantal_xvl

require("../includes/aantal_mz.php"); //$aantal_mz



require("../includes/aantal_orgpersoon.php"); //$aantal_orgpersoon





/*

print("<h1>arts, zvl, hvl, xvl, mz, atvp, btvp:

        $aantal_arts, $aantal_zvl, $aantal_hvl, $aantal_xvl, $aantal_mz,

        $aantal_tvp_aanwezig, $aantal_tvp_betrokken</h1>");

*/



function isEersteOverleg() {

  global $zorgplanStatus;

  // is dit het allereerste overleg voor deze patient?

  // of maw is er nog géén afgerond overleg?

  $queryElkOverleg = "SELECT * FROM overleg WHERE patient_code = '{$_SESSION['pat_code']}' AND afgerond=1";

  if (mysql_num_rows(mysql_query($queryElkOverleg)) == 0) {

    // ja, dit is het eerste

    $zorgplanStatus = berekenZorgplanStatus();

    return true;

  }

  else {

    $zorgplanStatus = "NVT";

    return false;

  }

}





function berekenZorgplanStatus() {

   return "OK;";  // nieuwe regelgeving sinds 1/1/2010
   
   global $aantal_arts, $aantal_zvl, $aantal_hvl, $aantal_xvl, $aantal_mz;

   $totaalAantal =  $aantal_hvl+

                    $aantal_xvl+

                    $aantal_mz;

                    

   if ($aantal_arts < 1) {

     return "KO;Wat betreft het zorgplan is er geen huisarts aanwezig. ";

   }

   else if ($aantal_zvl == 1)  {

     return "KO;Wat betreft het zorgplan is er buiten de huisarts geen andere zorgverlener aanwezig. ";

   }

   else if ($totaalAantal < 3) {

     return "KO;Wat betreft het zorgplan zijn er slechts $totaalAantal soorten zorg- en hulpverleners aanwezig ipv minstens 3. ";

   }

   else

     return "OK;Voor het zorgplan is de teamsamenstelling in orde. ";

}





function berekenTeamStatusTP($recordPatientTP) {

   global $aantal_arts, $aantal_zvl, $aantal_hvl, $aantal_xvl, $aantal_mz,

          $aantal_tvp_aanwezig, $aantal_tvp_betrokken, $aantal_orgpersoon,

          $overlegID, $overlegInfo;



   // eerst de overlegdatum bepalen of gokken

   if ($overlegID == -1 || (!issett($overlegID))) {

     $overlegDatum = date("Ymd");

   }

   else {

     $ditOverlegNietMeetellen = " AND id <> {$overlegID} ";

     $overlegDatum = $overlegInfo['datum'];

   }



   // dan bepalen wat de begindatum van het werkjaar is
   $beginDatum =  $recordPatientTP['begindatum'];

   $beginJaar = substr($beginDatum,0,4);

   $echteBeginMaand = substr($beginDatum, 5,2);

   switch ($echteBeginMaand) {

       case 1:

       case 2:

       case 3:

         $trimesterBeginMaand = "01";

         $trimesterEindMaand = "03";

       break;

       case 4:

       case 5:

       case 6:

         $trimesterBeginMaand = "04";

         $trimesterEindMaand = "06";

       break;

       case 7:

       case 8:

       case 9:

         $trimesterBeginMaand = "07";

         $trimesterEindMaand = "09";

       break;

       case 10:

       case 11:

       case 12:

         $trimesterBeginMaand = "10";

         $trimesterEindMaand = "12";

       break;

   }



   //$restBeginDatum = substr($beginDatum, 5,2) . substr($beginDatum,8,2);

   $restBeginDatum = $trimesterBeginMaand . "01";

   $eindeEersteTrimester = ($beginJaar) . $trimesterEindMaand . "31";



   $eindeWerkjaar = Array();

   $eindeWerkjaar[0] = ($beginJaar) . $restBeginDatum;

   $eindeWerkjaar[1] = ($beginJaar+1) . $restBeginDatum;

   $jaar = 1;

   while (!($eindeWerkjaar[$jaar-1]>= $overlegDatum && $eindeWerkjaar[$jaar]>$overlegDatum)) {

     $jaar++;

     $eindeWerkjaar[$jaar] = ($beginJaar+$jaar) . $restBeginDatum;

   }



   if ($jaar <= 1) {

     $jaar = 1;

     $beginDitWerkjaar = $eindeWerkjaar[0];

   }

   else {

     $jaar--;

     $beginDitWerkjaar = $eindeWerkjaar[$jaar-1];

   }







   // viel het vorig overleg in een vroeger trimester?

   // als er nog geen overleg is geweest, is het antwoord ook 'true'

      $vorigOverleg = voorgaandOverlegTP_datum($overlegInfo['datum'],true);

      if ($vorigOverleg != -1) {

        $vorigeDag = substr($vorigOverleg['datum'],6,2);

        $vorigeMaand = substr($vorigOverleg['datum'],4,2);

        $vorigJaar = substr($vorigOverleg['datum'],0,4);

        $huidigeMaand = substr($overlegInfo['datum'],4,2);

        $huidigJaar = substr($overlegInfo['datum'],0,4);



        if ($huidigJaar > $vorigJaar) {

          $vorigOverlegVorigTrimester = true;

        }

        else {

          if ($huidigeMaand > 9 && $vorigeMaand < 10) {

            $vorigOverlegVorigTrimester = true;

          }

          else if ($huidigeMaand > 6 && $vorigeMaand < 7) {

            $vorigOverlegVorigTrimester = true;

          }

          else if ($huidigeMaand > 3 && $vorigeMaand < 4) {

            $vorigOverlegVorigTrimester = true;

          }

          else {

            $vorigOverlegVorigTrimester = false;

          }

        }



        /* oude code voor drie maanden geleden

        $vorigeMaand = $vorigeMaand + 3;

        if ($vorigeMaand > 12) {

          $vorigeMaand = $vorigeMaand - 12;

          $vorigJaar++;

        }

        if ($vorigeMaand < 10) $vorigeMaand = "0$vorigeMaand";



        $drieMaandenNaVorigOverleg = "{$vorigJaar}{$vorigeMaand}{$vorigeDag}";

        if ($overlegInfo['datum'] < $drieMaandenNaVorigOverleg) {

        //   einde drie maanden geleden */

      }

      else {

        $vorigOverlegVorigTrimester = true;

      }



   // heeft de patient nog recht op een vergoeding?

   $ditJaarQry = "select * from overleg

                  where datum < $overlegDatum

                    and datum >= $beginDitWerkjaar

                  and keuze_vergoeding = 1

                  and genre = 'TP'

                  and patient_code = '{$_SESSION['pat_code']}'

                  $ditOverlegNietMeetellen";



   $aantalDitJaar = mysql_num_rows(mysql_query($ditJaarQry)) ;



   $ditJaarZonderEnMetVergoedingQry = "select * from overleg

                  where datum < $overlegDatum

                    and datum >= $beginDitWerkjaar

                  and genre = 'TP'

                  and patient_code = '{$_SESSION['pat_code']}'

                  $ditOverlegNietMeetellen";



   $aantalDitJaarZonderEnMetVergoeding = mysql_num_rows(mysql_query($ditJaarZonderEnMetVergoedingQry)) ;





   if ($jaar > 1) {

      $nogRechtOp = 3 - $aantalDitJaar;

      $zelfdeTrimesterAlsInclusie = false;

   }

   else {

     $nogRechtOp = 4 - $aantalDitJaar;

/*****************************************************

   CODE VOOR 5 VERGOEDBARE OVERLEGGEN

   OP VOORWAARDE DAT HET 1e INCLUSIE WAS

   EN HET TWEEDE IN HETZELFDE TRIMESTER

 *****************************************************/

     // het eerste jaar.

     if ($aantalDitJaar == 1 && $aantalDitJaarZonderEnMetVergoeding == 1 && !$vorigOverlegVorigTrimester) {

       // er is dit jaar alleen een inclusievergadering geweest

       // en dit was er eentje mét vergoeding

       // en dit overleg valt in hetzelfde trimester

       // dan mag je dit overleg ook vergoeden (en kom je dus aan 5 per jaar)

       $zelfdeTrimesterAlsInclusie = true;

       $nogRechtOp = 5 - $aantalDitJaar;

     }

     else {

       $zelfdeTrimesterAlsInclusie = false;



       // heeft de patient in het eerste trimester twee vergoede overleggen gehad?

       $eersteTrimesterQry = "select * from overleg

                  where datum <= $eindeEersteTrimester

                    and datum >= $beginDitWerkjaar

                  and keuze_vergoeding = 1

                  and genre = 'TP'

                  and patient_code = '{$_SESSION['pat_code']}'";



       $aantalEersteTrimester = mysql_num_rows(mysql_query($eersteTrimesterQry)) ;



       if ($aantalEersteTrimester == 2)

         $nogRechtOp = 5 - $aantalDitJaar;

       else

         $nogRechtOp = 4 - $aantalDitJaar;

     }

/*****************************************************

   CODE VOOR 5 VERGOEDBARE OVERLEGGEN

   OP VOORWAARDE DAT HET 1e INCLUSIE WAS

   EN HET TWEEDE IN HETZELFDE TRIMESTER

 *****************************************************/

   }



   if ($nogRechtOp <= 0) {

     return "KO;Deze patient heeft voor dit werkjaar (start $beginDitWerkjaar) g&egrave;&egrave;n recht meer op een vergoeding " .

            "voor een overleg in het kader van het therapeutisch project omdat er in dit {$jaar}e jaar al $aantalDitJaar overleggen vergoed zijn.";

   }



   // en dan nu de gewone voorwaarden voor het therapeutisch project

   if (isset($overlegInfo['datum'])) {

     $queryElkOverleg = "SELECT overleg.* FROM overleg, patient_tp

        WHERE overleg.patient_code = '{$_SESSION['pat_code']}' AND

              overleg.patient_code = patient_tp.patient AND

              patient_tp.actief = 1    AND

              afgerond=1 AND genre = 'TP' AND

              datum <= {$overlegInfo['datum']}";

   }

   else {

     $queryElkOverleg = "SELECT overleg.* FROM overleg, patient_tp

        WHERE overleg.patient_code = '{$_SESSION['pat_code']}' AND

              overleg.patient_code = patient_tp.patient AND

              patient_tp.actief = 1    AND

              afgerond=1 AND genre = 'TP'";

   }



   if ($aantal_zvl > 0 || $aantal_hvl > 0) $plusGDT = 1; else $plusGDT = 0;



   if (mysql_num_rows(mysql_query($queryElkOverleg)) == 0) {

      // alle organisaties moeten vertegenwoordigd zijn

      $qryOrgs = "select persoon_id from huidige_betrokkenen where overleggenre = 'gewoon' AND genre = 'org' and patient_code = \"{$_SESSION['pat_code']}\"";

      $resultOrgs = mysql_query($qryOrgs);

      if (mysql_num_rows($resultOrgs) < 2) {

        return "KO;Een therapeutisch project moet minstens 3 interne partners hebben en dat is hier niet het geval. <br /> Dit is een <b>groot</b> probleem: g&eacute;&eacute;n enkel overleg wordt vergoed voor TP. ";

      }

      else if ((mysql_num_rows($resultOrgs)+1) == ($aantal_orgpersoon + $plusGDT)) {

        return "OK;Alle interne partners zijn vertegenwoordigd op deze inclusievergadering.<br/>Bijgevolg is dit overleg vergoedbaar in het kader van TP. ";

      }

      else {

        return "KO;Op de inclusievergadering moeten alle interne partners (inclusief GDT LISTEL via een zorg- of hulpverlener) vertegenwoordigd zijn, en dat is (nog) niet het geval ";

      }

   }

   else {

      // de datum moet goed zijn

      if (!$vorigOverlegVorigTrimester && !$zelfdeTrimesterAlsInclusie) {

         return "KO;Er is al een overleg gepland dit trimester. Bijgevolg is dit overleg niet vergoedbaar in kader van TP.<br/>Je kan het plannen, maar er is geen TP-vergoeding. ";

      }





      // er moeten minstens 3 orgpersonen + GDT zijn

      if (($aantal_orgpersoon + $plusGDT)>=3) {

        return "OK;Er zijn minstens drie interne partners vertegenwoordigd. Dit overleg is vergoedbaar in het kader van TP. ";

      }

      else {

        $totaalAantalPartners = $aantal_orgpersoon + $plusGDT;

        return "KO;Er moeten minstens drie interne partners  (inclusief GDT LISTEL via een zorg- of hulpverlener) vertegenwoordigd zijn voor een vergoeding van TP, en dat is (nog) niet het geval (er zijn er maar $totaalAantalPartners). Je kan dit overleg zo plannen, maar er is dan geen vergoeding. ";

      }



   }



}



function berekenTeamStatusTP_ForK($recordPatientTP) {

   global $aantal_arts, $aantal_zvl, $aantal_hvl, $aantal_xvl, $aantal_mz,

          $aantal_tvp_aanwezig, $aantal_tvp_betrokken, $aantal_orgpersoon,

          $overlegID, $overlegInfo;



   // eerst de overlegdatum bepalen of gokken

   if ($overlegID == -1 || (!issett($overlegID))) {

     $overlegDatum = date("Ymd");

   }

   else {

     $ditOverlegNietMeetellen = " AND id <> {$overlegID} ";

     $overlegDatum = $overlegInfo['datum'];

   }



   // dan bepalen wat de begindatum van het werkjaar is

   $beginDatum =  $recordPatientTP['begindatum'];



   $beginJaar = substr($beginDatum,0,4);

   $echteBeginMaand = substr($beginDatum, 5,2);

   switch ($echteBeginMaand) {

       case 1:

       case 2:

       case 3:

         $trimesterBeginMaand = 1;

         $trimesterEindMaand = 3;

       break;

       case 4:

       case 5:

       case 6:

         $trimesterBeginMaand = 4;

         $trimesterEindMaand = 6;

       break;

       case 7:

       case 8:

       case 9:

         $trimesterBeginMaand = 7;

         $trimesterEindMaand = 9;

       break;

       case 10:

       case 11:

       case 12:

         $trimesterBeginMaand = 10;

         $trimesterEindMaand = 12;

       break;

   }



   //$restBeginDatum = substr($beginDatum, 5,2) . substr($beginDatum,8,2);

   $restBeginDatum = $trimesterBeginMaand . "01";

   $eindeEersteTrimester = ($beginJaar) . $trimesterEindMaand . "31";



   $eindeWerkjaar = Array();

   $eindeWerkjaar[0] = ($beginJaar) . $restBeginDatum;

   $eindeWerkjaar[1] = ($beginJaar+1) . $restBeginDatum;

   $jaar = 1;

   while (!($eindeWerkjaar[$jaar-1]>= $overlegDatum && $eindeWerkjaar[$jaar]>$overlegDatum)) {

     $jaar++;

     $eindeWerkjaar[$jaar] = ($beginJaar+$jaar) . $restBeginDatum;

   }



   if ($jaar <= 1) {

     $jaar = 1;

     $beginDitWerkjaar = $eindeWerkjaar[0];

   }

   else {

     $jaar--;

     $beginDitWerkjaar = $eindeWerkjaar[$jaar-1];

   }







   // viel het vorig overleg in een vroeger trimester?

   // als er nog geen overleg is geweest, is het antwoord ook 'true'

      $vorigOverleg = voorgaandOverlegTP_datum($overlegInfo['datum'],true);

      if ($vorigOverleg != -1) {

        $vorigeDag = substr($vorigOverleg['datum'],6,2);

        $vorigeMaand = substr($vorigOverleg['datum'],4,2);

        $vorigJaar = substr($vorigOverleg['datum'],0,4);

        $huidigeMaand = substr($overlegInfo['datum'],4,2);

        $huidigJaar = substr($overlegInfo['datum'],0,4);



        if ($huidigJaar > $vorigJaar) {

          $vorigOverlegVorigTrimester = true;

        }

        else {

          if ($huidigeMaand > 9 && $vorigeMaand < 10) {

            $vorigOverlegVorigTrimester = true;

          }

          else if ($huidigeMaand > 6 && $vorigeMaand < 7) {

            $vorigOverlegVorigTrimester = true;

          }

          else if ($huidigeMaand > 3 && $vorigeMaand < 4) {

            $vorigOverlegVorigTrimester = true;

          }

          else {

            $vorigOverlegVorigTrimester = false;

          }

        }



        /* oude code voor drie maanden geleden

        $vorigeMaand = $vorigeMaand + 3;

        if ($vorigeMaand > 12) {

          $vorigeMaand = $vorigeMaand - 12;

          $vorigJaar++;

        }

        if ($vorigeMaand < 10) $vorigeMaand = "0$vorigeMaand";



        $drieMaandenNaVorigOverleg = "{$vorigJaar}{$vorigeMaand}{$vorigeDag}";

        if ($overlegInfo['datum'] < $drieMaandenNaVorigOverleg) {

        //   einde drie maanden geleden */

      }

      else {

        $vorigOverlegVorigTrimester = true;

      }



   // heeft de patient nog recht op een vergoeding?

   $ditJaarQry = "select * from overleg

                  where datum < $overlegDatum

                    and datum >= $beginDitWerkjaar

                  and keuze_vergoeding = 1

                  and genre = 'TP'

                  and patient_code = '{$_SESSION['pat_code']}'

                  $ditOverlegNietMeetellen";



   $aantalDitJaar = mysql_num_rows(mysql_query($ditJaarQry)) ;



   $ditJaarZonderEnMetVergoedingQry = "select * from overleg

                  where datum < $overlegDatum

                    and datum >= $beginDitWerkjaar

                  and genre = 'TP'

                  and patient_code = '{$_SESSION['pat_code']}'

                  $ditOverlegNietMeetellen";



   $aantalDitJaarZonderEnMetVergoeding = mysql_num_rows(mysql_query($ditJaarZonderEnMetVergoedingQry)) ;





   if ($jaar > 1) {

      $nogRechtOp = 3 - $aantalDitJaar;

      $zelfdeTrimesterAlsInclusie = false;

   }

   else {

     $nogRechtOp = 4 - $aantalDitJaar;

/*****************************************************

   CODE VOOR 5 VERGOEDBARE OVERLEGGEN

   OP VOORWAARDE DAT HET 1e INCLUSIE WAS

   EN HET TWEEDE IN HETZELFDE TRIMESTER

 *****************************************************/

     // het eerste jaar.

     if ($aantalDitJaar == 1 && $aantalDitJaarZonderEnMetVergoeding == 1 && !$vorigOverlegVorigTrimester) {

       // er is dit jaar alleen een inclusievergadering geweest

       // en dit was er eentje mét vergoeding

       // en dit overleg valt in hetzelfde trimester

       // dan mag je dit overleg ook vergoeden (en kom je dus aan 5 per jaar)

       $zelfdeTrimesterAlsInclusie = true;

       $nogRechtOp = 5 - $aantalDitJaar;

     }

     else {

       $zelfdeTrimesterAlsInclusie = false;



       // heeft de patient in het eerste trimester twee vergoede overleggen gehad?

       $eersteTrimesterQry = "select * from overleg

                  where datum <= $eindeEersteTrimester

                    and datum >= $beginDitWerkjaar

                  and keuze_vergoeding = 1

                  and genre = 'TP'

                  and patient_code = '{$_SESSION['pat_code']}'";



       $aantalEersteTrimester = mysql_num_rows(mysql_query($eersteTrimesterQry)) ;



       if ($aantalEersteTrimester == 2)

         $nogRechtOp = 5 - $aantalDitJaar;

       else

         $nogRechtOp = 4 - $aantalDitJaar;

     }

/*****************************************************

   CODE VOOR 5 VERGOEDBARE OVERLEGGEN

   OP VOORWAARDE DAT HET 1e INCLUSIE WAS

   EN HET TWEEDE IN HETZELFDE TRIMESTER

 *****************************************************/

   }



   if ($nogRechtOp <= 0) {

     return "KO;Deze patient heeft voor dit werkjaar g&egrave;&egrave;n recht meer op een vergoeding " .

            "voor een overleg in het kader van het therapeutisch project For-K. ";

   }



   // en dan nu de voorwaarden van ForK

   if (isset($overlegInfo['datum'])) {

     $queryElkOverleg = "SELECT overleg.* FROM overleg, patient_tp

        WHERE overleg.patient_code = '{$_SESSION['pat_code']}' AND

              overleg.patient_code = patient_tp.patient AND

              patient_tp.actief = 1    AND

              afgerond=1 AND genre = 'TP' AND

              datum <= {$overlegInfo['datum']}";

   }

   else {

     $queryElkOverleg = "SELECT overleg.* FROM overleg, patient_tp

        WHERE overleg.patient_code = '{$_SESSION['pat_code']}' AND

              overleg.patient_code = patient_tp.patient AND

              patient_tp.actief = 1    AND

              afgerond=1 AND genre = 'TP'";

   }





   if (mysql_num_rows(mysql_query($queryElkOverleg)) > 0) {

       // er is al een overleg geweest. Het huidige mag dus niet in hetzelfde trimester



      if (!$vorigOverlegVorigTrimester && !$zelfdeTrimesterAlsInclusie) {

         return "KO;Er is al een overleg gepland dit trimester. Bijgevolg is dit overleg niet vergoedbaar in kader van TP.<br/>Je kan het plannen, maar er is geen TP-vergoeding. ";

      }

   }

      if (($aantal_orgpersoon + $aantal_hvl + $aantal_xvl)>=2) {

        return "OK;Dit overleg is vergoedbaar in het kader van TP. ";

      }

      else {

        return "KO;Er moeten minstens twee aanwezigen zijn om van een overleg te kunnen praten.<br/> Dat is hier niet het geval en daarom is er geen vergoeding in het kader van TP. ";

      }





}







function berekenTeamStatusGDT() {

   global $aantal_arts, $aantal_zvl, $aantal_hvl, $aantal_xvl, $aantal_mz,

          $aantal_tvp_aanwezig, $aantal_tvp_betrokken, $aantal_orgpersoon,

          $overlegID, $overlegInfo;


   if ($overlegInfo['genre']=="menos") return "KO;Een menos-overleg is nooit vergoedbaar";


   $eersteOverleg = isEersteOverleg();


/*
   if ($eersteOverleg) {

     $extraZorgplan = berekenZorgplanStatus();

     $extraZorgplan = substr($extraZorgplan, 3);

     $zorgplanOK = "Ook aan de voorwaarden voor een subsidieerbaar zorgplan is voldaan.";

     $ookZorgplan = "Dit geldt zowel voor vergoedbaarheid in het kader van GDT als voor het zorgplan.";

     $ookZorgplan2 = " en voor de opstart van het zorgplan";

   }

   else {

     $extraZorgplan = "";

     $zorgplanOK = "";

     $ookZorgplan = "";

   }
*/


   if ($overlegID == -1 || (!issett($overlegID))) {

     $jaarLang = date("Y");

   }

   else {

     $jaarLang = substr($overlegInfo['datum'],0,4);

     $ditOverlegNietMeetellen = " AND id <> {$overlegID} ";

   }

   // heeft de patient nog recht op een vergoeding?
   $ditJaarQry = "select * from overleg
                  where substring(datum,1,4) = $jaarLang
                  and keuze_vergoeding = 1
                  and (genre = 'gewoon' or genre is null)
                  and patient_code = '{$_SESSION['pat_code']}'
                  $ditOverlegNietMeetellen";



   $aantalDitJaar = mysql_num_rows(mysql_query($ditJaarQry)) ;

   if ($pvsVraag = mysql_fetch_assoc(mysql_query("select type from patient where code = '{$_SESSION['pat_code']}'"))) {

      $gewonePatient = ($pvsVraag['type'] != 1);

   }

   else {

      die("miljaar geen pat_type");

   }
   if ($gewonePatient) {
      $nogRechtOp = 1 - $aantalDitJaar;
   }
   else {
      $nogRechtOp = 4 - $aantalDitJaar;
      // pvs-patienten hebben recht op 4 vergoedbare overleggen per jaar
   }

   if ($pvsVraag['type']==7) {
     $kader = "organisator";
     $soort = "psychisch";
   }
   else {
     $soort = "fysiek";
     if ($nogRechtOp > 0)
       $kader = "GDT";
     else
       $kader = "organisator";
   }




   if (isset($overlegInfo['akkoord_patient']) && ($overlegInfo['akkoord_patient'] == 0)) {
     return "KO;Omdat de patient niet akkoord gaat met de samenstelling van het overleg, is er geen vergoeding mogelijk.";
   }
   else if ($jaarLang < 2003 || ($jaarLang == 2003 && substr($overlegInfo['datum'],4,2) < 7)) {
     return "KO;Een overleg van voor 1 juli 2003 kan niet vergoed worden.<br/>" .
                $extraZorgplan;
   }
/*
   else if ($nogRechtOp <= 0) {
     return "KO;Deze patient heeft in $jaarLang geen recht meer op een vergoeding " .
            "voor een multidisciplinair overleg in het kader van $kader. ";
   }
*/
   else if ($aantal_arts < 1) {
     if ($kader == "GDT" || $eersteOverleg)
       return "KO;Er is geen huisarts aanwezig. <br />Dit is een vereiste voor de vergoedbaarheid van het overleg. {$ookZorgplan2}. ";
     else
       return "KO;Er is geen huisarts aanwezig. <br/>Dit is een vereiste om de organisator te mogen vergoeden.";
   }

   else if ($aantal_zvl == 1 && $eersteOverleg)  {
     // deze voorwaarde komt eigenlijk uit zorgplan, maar is ook relevant voor GDT
     return "KO;Buiten de huisarts is er geen andere zorgverlener aanwezig. Dit is een vereiste voor de vergoedbaarheid van de deelnemers aan het overleg $ookZorgplan2. ";
   }
   else if ($aantal_tvp_aanwezig==0 && $aantal_tvp_betrokken>0) {
     if ($kader == "GDT" || $eersteOverleg)
       return "KO;Dit overleg kan <b>NIET</b> vergoed worden, omdat de thuisverpleegkundige niet aanwezig is.<br/>" .
             $extraZorgplan;
     else
       return "KO;De organisator van dit overleg kan <b>NIET</b> vergoed worden, omdat de thuisverpleegkundige niet aanwezig is.<br/>";
   }
   else if ($aantal_zvl >= 2 && $aantal_hvl >= 3) {
     if ($kader == "GDT" || $eersteOverleg)
       return "OK;De samenstelling van het team voldoet aan de voorwaarden voor vergoeding van het overleg.<br/>" .
            $zorgplanOK ;
     else
       return "OK;De samenstelling van het team voldoet aan de voorwaarden voor vergoeding. De organisator kan dus vergoed worden.<br/>" .
            $zorgplanOK ;
   }
   else {
     if ($kader == "GDT")
       return "KO;Om de deelnemers aan dit overleg te kunnen vergoeden, zijn er onvoldoende juiste deelnemers aanwezig.<br/>" .
            $extraZorgplan;
     else if ($eersteOverleg)
       return "KO;Er zijn onvoldoende juiste deelnemers aanwezig. Daarom kan de organisator geen vergoeding krijgen.<br/>" .
            $extraZorgplan;
     else
       return "KO;Er zijn onvoldoende juiste deelnemers aanwezig. Daarom kan de organisator geen vergoeding krijgen.";
   }
}

function berekenTeamStatusPsy() {
   global $aantal_arts, $aantal_zvl, $aantal_hvl, $aantal_xvl, $aantal_mz,
          $aantal_tvp_aanwezig, $aantal_tvp_betrokken, $aantal_orgpersoon,
          $overlegID, $overlegInfo, $_TP_FOR_K;
   // maar 3 overleggen per werkjaar!
   // eesrst bepalen wat de begindatum van het werkjaar is

   $resultPsy = mysql_query("select * from patient_psy where code = \"{$_SESSION['pat_code']}\"");
   if (mysql_num_rows($resultPsy) == 1) {
     $patientPsy = getUniqueRecord("select * from patient_psy where code = \"{$_SESSION['pat_code']}\"");
     $beginDatum =  $patientPsy['startdatum'];
   }
   else {
     $beginDatum = date("Ymd");
   }
   
   $beginJaar = substr($beginDatum,0,4);
   $restBeginDatum = substr($beginDatum, 4,4);
   $eindeWerkjaar = Array();
   $eindeWerkjaar[0] = ($beginJaar) . $restBeginDatum;
   $eindeWerkjaar[1] = ($beginJaar+1) . $restBeginDatum;
   $jaar = 1;
   while (!($eindeWerkjaar[$jaar-1]>= $overlegDatum && $eindeWerkjaar[$jaar]>$overlegDatum)) {
     $jaar++;
     $eindeWerkjaar[$jaar] = ($beginJaar+$jaar) . $restBeginDatum;
   }

   if ($jaar <= 1) {
     $jaar = 1;
     $beginDitWerkjaar = $eindeWerkjaar[0];
   }
   else {
     $jaar--;
     $beginDitWerkjaar = $eindeWerkjaar[$jaar-1];
   }

   // eerst de overlegdatum bepalen of gokken
   if ($overlegID == -1 || (!issett($overlegID))) {
     $overlegDatum = date("Ymd");
   }
   else {
     $ditOverlegNietMeetellen = " AND id <> {$overlegID} ";
     $overlegDatum = $overlegInfo['datum'];
   }

   // heeft de patient nog recht op een vergoeding?
   $ditJaarQry = "select * from overleg
                  where datum < $overlegDatum
                    and datum >= $beginDitWerkjaar
                  and keuze_vergoeding = 1
                  and genre = 'psy'
                  and patient_code = '{$_SESSION['pat_code']}'
                  $ditOverlegNietMeetellen";
   $aantalDitJaar = mysql_num_rows(mysql_query($ditJaarQry));
   if ($aantalDitJaar >= 3) return "KO;Er zijn maar 3 overleggen vergoedbaar per werkjaar.";


   // eerst zelfstandige ZVL/HVL
   $qry="
    SELECT
        count(bl.persoon_id)
    FROM
        huidige_betrokkenen bl,
        hulpverleners h
    WHERE
        bl.overleggenre = 'gewoon' AND
        bl.patient_code='".$_SESSION['pat_code']."' AND
        bl.genre = 'hulp' AND
        bl.persoon_id=h.id AND
        bl.aanwezig=1 AND
        h.organisatie in (998,999)
   GROUP BY
         h.fnct_id
        ";
   $result=mysql_query($qry);
   $aantalZelfstandig=mysql_num_rows($result);
   // dan het aantal organisaties
   $qry="
    SELECT
        count(bl.persoon_id)
    FROM
        huidige_betrokkenen bl,
        (hulpverleners h inner join organisatie o on h.organisatie = o.id)
    WHERE
        bl.overleggenre = 'gewoon' AND
        bl.patient_code='".$_SESSION['pat_code']."' AND
        bl.genre = 'hulp' AND
        bl.persoon_id=h.id AND
        bl.aanwezig=1 AND
        (o.genre = 'HVL' or o.genre = 'ZVL' or o.genre = 'XVLP') AND
        h.organisatie not in (998,999)
   GROUP BY
         h.organisatie
        ";
   $result=mysql_query($qry);
   $aantalOrganisatie=mysql_num_rows($result);

   $aantalSoorten =$aantalZelfstandig + $aantalOrganisatie;

   if ($aantalSoorten == 1) {
     return "KO;Er moeten minstens 3 soorten zorg- en hulpverleners zijn, en er zijn maar 1 soort.";
   }
   else if ($aantalSoorten < 3) {
     return "KO;Er moeten minstens 3 soorten zorg- en hulpverleners zijn, en er zijn er maar $aantalSoorten.";
   }

/*
   // dan kijken of er ne ggz NIET IN DE EERSTE LIJN is
   $qry="
    SELECT
        count(bl.persoon_id)
    FROM
        huidige_betrokkenen bl,
        (hulpverleners h inner join organisatie o on h.organisatie = o.id)
    WHERE
        bl.overleggenre = 'gewoon' AND
        bl.patient_code='".$_SESSION['pat_code']."' AND
        bl.genre = 'hulp' AND
        bl.persoon_id=h.id AND
        bl.aanwezig=1 AND
        ((o.ggz = 1) or h.fnct_id in (62,76,117)) AND
        not (h.fnct_id in (1,2,4,6,7,8,10,13,17,65,125,126,127))
   GROUP BY
         h.organisatie
        ";
   $result=mysql_query($qry);
   $aantalGGZ1eLijn=mysql_num_rows($result);

   // dan kijken of er ne ggz WEL IN DE EERSTE LIJN is
   $qry="
    SELECT
        count(bl.persoon_id)
    FROM
        huidige_betrokkenen bl,
        (hulpverleners h inner join organisatie o on h.organisatie = o.id)
    WHERE
        bl.overleggenre = 'gewoon' AND
        bl.patient_code='".$_SESSION['pat_code']."' AND
        bl.genre = 'hulp' AND
        bl.persoon_id=h.id AND
        bl.aanwezig=1 AND
        ((o.ggz = 1) or h.fnct_id in (62,76,117)) AND
        not (h.fnct_id in (1,2,4,6,7,8,10,13,17,65,125,126,127))
   GROUP BY
         h.organisatie
        ";
   $result=mysql_query($qry);
   $aantalGGZ2eLijn=mysql_num_rows($result);

   if ($aantalGGZ1eLijn + $aantalGGZ2eLijn == 0) {
     return "KO;Er is niemand uit de geestelijke gezondheidszorg.";
   }
*/


   // dan kijken of er ne ggz is
   $qry="
    SELECT
        count(bl.persoon_id)
    FROM
        huidige_betrokkenen bl,
        (hulpverleners h inner join organisatie o on h.organisatie = o.id)
    WHERE
        bl.overleggenre = 'gewoon' AND
        bl.patient_code='".$_SESSION['pat_code']."' AND
        bl.genre = 'hulp' AND
        bl.persoon_id=h.id AND
        bl.aanwezig=1 AND
        NOT (o.genre = 'XVLNP') AND
        ((o.ggz = 1) or (h.fnct_id in (62,76,117)))
   GROUP BY
         h.organisatie
        ";
   $result=mysql_query($qry);
   $aantalGGZ=mysql_num_rows($result);

   if ($aantalGGZ == 0) {
     return "KO;Er is niemand uit de geestelijke gezondheidszorg.";
   }

   // ten slotte kijken naar 1e lijn NIET IN GGZ
   $qry="
    SELECT
        count(bl.persoon_id)
    FROM
        huidige_betrokkenen bl,
        hulpverleners h inner join organisatie o on h.organisatie = o.id
    WHERE
        bl.overleggenre = 'gewoon' AND
        bl.patient_code='".$_SESSION['pat_code']."' AND
        bl.genre = 'hulp' AND
        bl.persoon_id=h.id AND
        bl.aanwezig=1 AND
        (o.genre = 'ZVL' or (o.genre = 'HVL' and h.fnct_id in (4,6,7,8,10,13,17,65,125,126,127) )) AND
        o.ggz = 0
   GROUP BY
         h.organisatie
        ";
   $result=mysql_query($qry);
   $aantalEersteLijnNietGGZ=mysql_num_rows($result);

   //volgens mij een logischere regel, maar volgens de regelgeving niet ;-)
   //als er iemand is uit eerstelijnNietGGZ => OK
   //als er minstens 2 eersteLijnGGZ is, dan telt één als GGZ en de andere als eerstelijn
   //als er maar 1 eersteLijnGGZ is, maar er is ook een tweedeLijnGGZ dan telt die eerste als eerstelijn, en de tweede als GGZ
   /*if (!(
         $aantalEersteLijnNietGGZ > 0 ||
         ($aantalEersteLijnNietGGZ == 0 && $aantalGGZ1eLijn > 1) ||
         ($aantalEersteLijnNietGGZ == 0 && $aantalGGZ1eLijn == 1 && $aantalGGZ2eLijn >= 1)
        )) {
    */
    if ($aantalEersteLijnNietGGZ == 0) {
     return "KO;Er is g&eacute;&eacute;n zorgverlener of maatschappelijk werker, klinisch psycholoog, orthopedagoog uit de hulpverleners aanwezig.";
   }

   // aantal arts
   $qry="
   	SELECT
		count(bl.persoon_id)
	FROM
		huidige_betrokkenen bl,
		hulpverleners h,
		functies f
	WHERE
    bl.overleggenre = 'gewoon' AND
		bl.patient_code='".$_SESSION['pat_code']."' AND
		bl.persoon_id=h.id AND
		bl.genre = 'hulp'  AND
		h.fnct_id=f.id AND
		f.id=1
		";
    $result=mysql_query($qry);
    $records=mysql_fetch_array($result);
    $aantal_artsBetrokken=$records[0];
    if ($aantal_artsBetrokken == 0) {
      return "OK;Het overleg is vergoedbaar. De regelgeving schrijft voor dat de huisarts uitgenodigd moet worden op het overleg en opgenomen wordt in het team.";
    }
    else {
      if ($aantal_arts == 0)
        return "OK;Het overleg is vergoedbaar als je de huisarts uitnodigt.";
      else
        return "OK;Het overleg is vergoedbaar.";
    }

   
}


function berekenTeamStatus() {
   global $aantal_arts, $aantal_zvl, $aantal_hvl, $aantal_xvl, $aantal_mz,
          $aantal_tvp_aanwezig, $aantal_tvp_betrokken, $aantal_orgpersoon,
          $overlegID, $overlegInfo, $_TP_FOR_K;

 $qryInTP = "select * from patient_tp where patient = \"{$_SESSION['pat_code']}\" and actief = 1";
 $resultInTP = mysql_query($qryInTP);
 if ((mysql_num_rows($resultInTP)==1)) {
   // TP-overleg
   $recordPatientTP = mysql_fetch_assoc($resultInTP);
   if ($recordPatientTP['project'] == $_TP_FOR_K) {// FOR-K
     $status = berekenTeamStatusTP_ForK($recordPatientTP);
   }
   else {
     $status = berekenTeamStatusTP($recordPatientTP);
   }
 }
 else if ($overlegInfo['genre']=="psy") {
    $status = berekenTeamstatusPsy();
 }
 else {
   $status= berekenTeamStatusGDT();
 }

 if (substr($status, 0, 2) == "KO") {
   if (($overlegID > -1) && ombvergoedbaar($overlegID)) {
     $status = "OK;" . substr($status, 3, strlen($status)-2) . " voor de deelnemers. Voor OMB is er wel een vergoeding mogelijk (afhankelijk van de subsidiepot). ";
     setOrganisatorVergoeding($overlegID);
   }
 }
 else if (organisatorVergoeding($status)) {
   if (($overlegID != -1) && ombvergoedbaar($overlegID)) {
     $status = $status . " Daarnaast is er ook voor OMB een vergoeding mogelijk (afhankelijk van de subsidiepot). ";
   }
 }

 return $status;

}

function setOrganisatorVergoeding($overlegID) {
  mysql_query("update overleg set keuze_vergoeding = 2 where id = $overlegID and keuze_vergoeding = 1");
}

function organisatorVergoeding($status) {
  if (strpos($status, "organisator") === FALSE) {return false;}
  else return true;
}


/* hieronder vond je een aanzet om de teamstatus te herberekenen

   maar dit moest niet van LISTEL.  Ik denk dat het zou werken

   als je aantal_arts e.d. correct berekent en dus niet via de globale variabelen

function herberekenTeamStatus($overlegInfo) {

  // alleen voor overleggen die al vergoedbaar waren.

  // we moeten dus niet meer controleren of het aantal overleggen dit jaar nog in orde is.

  $overlegID = $overlegInfo['id'];

  

   global $aantal_arts, $aantal_zvl, $aantal_hvl, $aantal_xvl, $aantal_mz,

          $aantal_tvp_aanwezig, $aantal_tvp_betrokken, $aantal_orgpersoon;

          

 $eersteOverleg = isEersteOverleg();



 if ($overlegInfo['genre']=="TP") {

   // TP-overleg



   $recordPatientTP = mysql_fetch_assoc(mysql_query("select * from patient_tp where patient = '{$overlegInfo['patient_code']}'"));



   // en dan nu de gewone voorwaarden voor het therapeutisch project

   if (isset($overlegInfo['datum'])) {

     $queryElkOverleg = "SELECT overleg.* FROM overleg, patient_tp

        WHERE overleg.patient_code = '{$overlegInfo['patient_code']}' AND

              overleg.patient_code = patient_tp.patient AND

              patient_tp.actief = 1    AND

              afgerond=1 AND genre = 'TP' AND

              datum < {$overlegInfo['datum']}";

   }

   else {

     $queryElkOverleg = "SELECT overleg.* FROM overleg, patient_tp

        WHERE overleg.patient_code = '{$overlegInfo['patient_code']}' AND

              overleg.patient_code = patient_tp.patient AND

              patient_tp.actief = 1    AND

              afgerond=1 AND genre = 'TP'";

   }



   if ($aantal_zvl > 0 || $aantal_hvl > 0) $plusGDT = 1; else $plusGDT = 0;



   if (mysql_num_rows(mysql_query($queryElkOverleg)) == 0) {

      // alle organisaties moeten vertegenwoordigd zijn

      $qryOrgs = "select persoon_id from huidige_betrokkenen where overleggenre = 'gewoon' AND genre = 'org' and patient_code = \"{$_SESSION['pat_code']}\"";

      $resultOrgs = mysql_query($qryOrgs);

      if (mysql_num_rows($resultOrgs) < 2) {

        return "KO;Een therapeutisch project moet minstens 3 interne partners hebben en dat is hier niet het geval.<br /> Dit is een <b>groot</b> probleem: g&eacute;&eacute;n enkel overleg wordt vergoed.";

      }

      else if ((mysql_num_rows($resultOrgs)+1) == ($aantal_orgpersoon + $plusGDT)) {

        return "OK;Alle interne partners zijn vertegenwoordigd op deze inclusievergadering.<br/>Bijgevolg is dit overleg vergoedbaar.";

      }

      else {

        return "KO;Op de inclusievergadering moeten alle interne partners (inclusief GDT LISTEL via een zorg- of hulpverlener) vertegenwoordigd zijn, en dat is (nog) niet het geval";

      }

   }

   else {

      // er moeten minstens 3 orgpersonen + GDT zijn

      if (($aantal_orgpersoon + $plusGDT)>=3) {

        return "OK;Er zijn minstens drie interne partners vertegenwoordigd. Dit overleg is vergoedbaar.";

      }

      else {

        return "KO;Er moeten minstens drie interne partners  (inclusief GDT LISTEL via een zorg- of hulpverlener) vertegenwoordigd zijn, en dat is (nog) niet het geval.<br/>Je kan dit overleg zo plannen, maar er is dan geen vergoeding.";

      }

   }

 }

 else { // gewoon overleg

   if (isset($overlegInfo['akkoord_patient']) && ($overlegInfo['akkoord_patient'] == 0)) {

     return "KO;Omdat de patient niet akkoord gaat met de samenstelling van het overleg, is er geen vergoeding mogelijk.";

   }

   else if ($aantal_arts < 1) {

     return "KO;Er is geen huisarts aanwezig. <br />Dit is een vereiste voor de vergoedbaarheid van het overleg{$ookZorgplan2}. ";

   }

   else if ($aantal_zvl == 1)  {

     // deze voorwaarde komt eigenlijk uit zorgplan, maar is ook relevant voor GDT

     return "KO;Buiten de huisarts is er geen andere zorgverlener aanwezig. Dit is een vereiste voor de vergoedbaarheid van het overleg.";

   }

   else if ($aantal_tvp_aanwezig==0 && $aantal_tvp_betrokken>0) {

     return "KO;Dit overleg kan <b>NIET</b> vergoed worden, omdat de thuisverpleegkundige niet aanwezig is.<br/>";

   }

   else if ($aantal_zvl >= 2 && $aantal_hvl >= 3) {

     return "OK;De samenstelling van het team voldoet aan de voorwaarden voor vergoeding van het overleg.<br/>";

   }

   else {

     return "KO;Om dit overleg te kunnen vergoeden, zijn er onvoldoende juiste deelnemers aanwezig.<br/>";

   }

 }

}

*/



?>



