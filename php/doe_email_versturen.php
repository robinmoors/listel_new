<?php
 session_start();

  //vereist: $overlegID én $_SESSION['pat_code'] hebben een waarde
  // alleen zorgverleners mogen we mailen
//include("toonSessie.inc");

    //----------------------------------------------------------
    /* Maak Dbconnectie */ include('../includes/dbconnect2.inc');
    //----------------------------------------------------------

  if (isset($_GET['adres'])) {
     $qry="
        SELECT
            datum,
            keuze_vergoeding,
            naam,
            voornaam,
            patient_code,
            logincode,
            overleg.id
        FROM
            overleg, patient
        WHERE
            patient_code = '{$_SESSION['pat_code']}'
            and afgerond = 0
            and patient_code = patient.code
        ";

      if (!$qryResult = mysql_query($qry)) {
         die("allez, nu is deze query ook al niet gelukt $qry");
      }

      $recordsOverleg = mysql_fetch_array($qryResult);
      $datum=substr($recordsOverleg['datum'],6,2)."/".substr($recordsOverleg['datum'],4,2)."/".substr($recordsOverleg['datum'],0,4);
      $link1 = "<li><a href=\"$siteadres/php/katz_invullen.php?hvl_id={$_GET['hvl_id']}&code={$recordsOverleg['logincode']}\">vul katz-score in</a></li>\n";
      $link2 = "<li><a href=\"$siteadres/php/evaluatie_instrument_nieuw.php?hvl_id={$_GET['hvl_id']}&code={$recordsOverleg['logincode']}\">vul evaluatie-instrument in</a></li>\n";

     /*
      switch ($recordsOverleg['overleg_type']) {
               case 0:
                 $overlegType = " overleg";
                 $wat = "de katz-score <strong>en het evaluatie-instrument</strong>";
                 $s = "s";
                 $links = "$link1 $link2";
                 break;
               case 1:
                 $overlegType = " huisbezoek";
                 $wat = "de katz-score";
                 $s = "";
                 $links = "$link1";
                 break;
               case 2:
                 $overlegType = " bureelbezoek";
                 $wat = "de katz-score";
                 $s = "";
                 $links = "$link1";
                 break;
              case 3:
                 $overlegType = "e telefonische evaluatie";
                 $wat = "de katz-score";
                 $s = "";
                 $links = "$link1";
                 break;
               case 4:
                 $overlegType = " overleg";
                 $wat = "de katz-score <strong>en het evaluatie-instrument</strong>";
                 $s = "s";
                 $links = "$link1 $link2";
                 break;
      }
      */

      if (is_tp_patient()) {
        $vraag = "de Katz-score";
        $overlegType = " overleg";
        $wat = "de Katz-score";
        $s = "";
        $links = "$link1";
        $vergoeding = "<p>Omdat op dit overleg een huisarts aanwezig was, moet de Katz-score ingevuld worden.</p>\n";
        $wat = "katz";
      }
      else {
        if ($_GET['genre']=="beide") {
           $vraag = "de Katz-score</strong> <u>en</u> <strong>het evaluatie-instrument";
           $overlegType = " overleg";
           $wat = "<strong>de Katz-score</strong> <u>en</u> <strong>het evaluatie-instrument</strong>";
           $s = "s";
           $links = "$link1 $link2";
           $uitlegEvaluatie = "Het evaluatie-instrument werd vereenvoudigd. U moet alle items invullen. U klikt in de bolletjes om uw antwoord op te slaan en kan de tekstvakken rechts van elk item gebruiken om bijkomende opmerkingen in te typen. ";

           if ($recordsOverleg['keuze_vergoeding'] > 0) {
             $vergoeding = "<p>Omdat voor dit overleg een vergoeding is aangevraagd, moeten <strong>beide documenten</strong> ingevuld worden.</p>\n";
             $wat = "katz+evaluatie";
           }
           else  {
             $vergoeding = "<p>Omdat voor dit overleg g&eacute;&eacute;n vergoeding is aangevraagd, is alleen de Katz-score verplicht, en is het evaluatieinstrument vrijblijvend.</p>\n";
             $wat = "katz_evaluatie";
           }
        }
        else if ($_GET['genre']=="katz") {
           $vraag = "de Katz-score";
           $overlegType = " overleg";
           $wat = "de Katz-score";
           $s = "";
           $links = "$link1";
           $wat = "katz";
        }
        else {
           $vraag = "het evaluatie-instrument";
           $overlegType = " overleg";
           $wat = "het evaluatie-instrument";
           $s = "";
           $links = "$link2";
           $wat = "evaluatie";
           $uitlegEvaluatie = "Het evaluatie-instrument werd vereenvoudigd. U moet alle items invullen. U klikt in de bolletjes om uw antwoord op te slaan en kan de tekstvakken rechts van elk item gebruiken om bijkomende opmerkingen in te typen. ";
        }
      }

     $mailBody = "<p><img src=\"http://www.listel.be/images/logo_top_pagina_klein.gif\" alt=\"logo listel\"></p>
                   <p>Beste zorg- of hulpverlener,</p>
                   <p>voor het multidisciplinair overleg op <strong>{$datum}</strong>  voor
                   <strong>{$recordsOverleg['naam']} {$recordsOverleg['voornaam']}</strong> (zorgplan {$recordsOverleg['patient_code']})
                   nodigt uw overlegcoördinator TGZ u uit om <strong>$vraag</strong> van deze patiënt in te vullen.</p>
                   
<p>Dit kan elektronisch door op onderstaande link te klikken.
Via deze link komt u automatisch terecht in het persoonlijk e-zorgplan van deze pati&euml;nt.<br/>
U heeft enkel toegang tot deze score{$s}.
</p>


                  <p>
                  <ul>$links
                  </ul></p>

                  <p><br />Indien er zich problemen voordoen kan u altijd bellen (011/81.94.70) of mailen met LISTEL vzw (Anick.Noben@listel.be).</p>

<p>Met dank voor uw medewerking, <br />
Het LISTEL e-zorgplan www.listel.be </p>
     ";

    if (htmlmail("{$_GET['adres']}", "LISTEL zorgplan vervolledigen", $mailBody)) {
       $vandaag = mktime(0,0,0,date("n"),date("j"),date("Y"));
       $aanvraagQry = "insert into katz_aanvraag (overleg, hvl, wat, wanneer) values ({$recordsOverleg['id']},{$_GET['hvl_id']}, '$wat', $vandaag)";
       if (mysql_query($aanvraagQry))
         print("OK");
       else
         print("KO");
    }
    else {
       print("KO");
    }
  }

    //---------------------------------------------------------
    /* Sluit Dbconnectie */ include("../includes/dbclose.inc");
    //---------------------------------------------------------
?>



