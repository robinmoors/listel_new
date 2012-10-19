<?php

    //----------------------------------------------------------

    /* Maak Dbconnectie */ require('../includes/dbconnect2.inc');

    //----------------------------------------------------------



$paginanaam="Overzicht gearchiveerde dossiers";

if (IsSet($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan"))

{

    require("../includes/html_html.inc");

    print("<head>");

    require("../includes/html_head.inc");

    require("../includes/bevestigdel.inc");

    print("</head>");

    print("<body>");

    print("<div align=\"center\">");

    print("<div class=\"pagina\">");

    require("../includes/header.inc");

    require("../includes/kruimelpad.inc");

    print("<div class=\"contents\">");

    require("../includes/menu.inc");

    print("<div class=\"main\">");

    print("<div class=\"mainblock\">");

//include("../includes/toonSessie.inc");

    $a_order=(isset($a_order)&&($a_order!="p.naam"))?$a_order.",p.naam":"p.naam";



      if (isset($_POST['startjaar'])) {

        $startjaar = $_POST['startjaar'];

        $eindjaar = $_POST['eindjaar'];

      }

      else {

        $startjaar = $_GET['startjaar'];

        $eindjaar = $_GET['eindjaar'];

      }



   $startDate = substr($startjaar, 0, 4) . "-01-01";

   $eindDate = substr($eindjaar, 0, 4) . "-12-31";







   // als profiel niet listel is, moet er een beperking komen op de weergegeven patienten

   if($_SESSION["profiel"]=="OC"){
     $query = "
            SELECT
                p.id,
                p.naam,
                p.voornaam,
                p.startdatum,
                p.einddatum,
                p.stopzetting_text,
                p.code,
                p.stopzetting_cat,
                0 as project
            FROM
                patient p, gemeente, overleg
            WHERE
                p.actief = 0 AND
                p.code = overleg.patient_code AND (overleg.genre = 'gewoon' or overleg.genre is NULL or (overleg.genre = 'TP' and overleg.tp_rechtenOC = 1)) AND
                gem_id=gemeente.id and gemeente.zip = {$_SESSION['overleg_gemeente']} AND
                p.einddatum between $startjaar and $eindjaar
                and overleg.toegewezen_genre = 'gemeente'
            GROUP BY
               p.id
             /* HAVING count(overleg.id) > 0 */
         ORDER BY "
            .$a_order;
     }
     else  if ($_SESSION['profiel']=="hulp") {
                 $query = "SELECT p.*
                            FROM (patient p left join huidige_betrokkenen on p.code = huidige_betrokkenen.patient_code
                                                                       and huidige_betrokkenen.rechten = 1
                                                                       and huidige_betrokkenen.genre = 'hulp'
                                                                       and huidige_betrokkenen.persoon_id = {$_SESSION['usersid']})
                                 left join (afgeronde_betrokkenen inner join overleg on overleg.id = afgeronde_betrokkenen.overleg_id
                                                                                    and afgeronde_betrokkenen.rechten = 1
                                                                                    and afgeronde_betrokkenen.genre = 'hulp'
                                                                                    and afgeronde_betrokkenen.persoon_id = {$_SESSION['usersid']})
                                        on p.code = overleg.patient_code
                            WHERE p.einddatum between $startjaar and $eindjaar
                            group by p.code
                            having
                                max(afgeronde_betrokkenen.rechten) >=1 or max(huidige_betrokkenen.rechten) >= 1
                                or (p.toegewezen_genre = 'hulp' and p.toegewezen_id = {$_SESSION['usersid']})
                 ORDER BY $a_order";
                }
     else if ($_SESSION['profiel']=="rdc") {
             $beperkingTabel = "";
             $beperking = "   p.toegewezen_genre = 'rdc'
                              AND p.toegewezen_id = {$_SESSION['organisatie']}
                          ";
             $overlegBeperking = "   (overleg.toegewezen_genre = 'rdc'
                                     AND overleg.toegewezen_id = {$_SESSION['organisatie']})
                          ";
             $tpTabel = "LEFT JOIN patient_tp on p.code = patient_tp.patient";

                 $query = "SELECT p.*, max(patient_tp.rechtenOC) FROM $beperkingTabel (patient as p $tpTabel)
                                                                             inner join overleg on overleg.patient_code = p.code
                             WHERE ($beperking) or $overlegBeperking
                               AND p.einddatum between $startjaar and $eindjaar
                             group by p.code
                             having p.actief = 0 and
                                    ((sum((overleg.genre is null or overleg.genre ='gewoon')) > 0)  or max(patient_tp.rechtenOC) is not NULL)
                 ORDER BY $a_order";
     }
     else if($_SESSION["profiel"]=="hoofdproject" || $_SESSION["profiel"]=="bijkomend hoofdproject") {

          $query = "SELECT p.*, patient_tp.project FROM patient_tp, patient  p

                       WHERE patient_tp.einddatum between '$startDate' and '$eindDate' AND patient_tp.actief = 0

                       AND patient_tp.patient = p.code AND

                             patient_tp.project = {$_SESSION['tp_project']}

            ORDER BY

              $a_order";

     }

     else if($_SESSION["profiel"]=="listel") {

      $query = "

            SELECT

                p.id,

                p.naam,

                p.voornaam,

                p.startdatum,

                p.einddatum,

                p.stopzetting_text,

                p.code,

                p.stopzetting_cat,

                patient_tp.project,

                tp_project.nummer

            FROM

                patient p LEFT JOIN patient_tp on  (patient_tp.patient = p.code) left join tp_project on patient_tp.project = tp_project.id

            WHERE

                (p.actief = 0 AND

                 p.einddatum between $startjaar and $eindjaar)

              OR

                (patient_tp.einddatum between '$startDate' and '$eindDate' AND patient_tp.actief = 0)

         ORDER BY "

            .$a_order;

     }

    print ("<h1>Lijst gearchiveerde zorgplannen</h1>

         <table class=\"klein\">

            <tr>

                <th><a href=\"lijst_archief_02.php?a_order=code&startjaar=$startjaar&eindjaar=$eindjaar\">zorgplannummer</a></th>

                <th><a href=\"lijst_archief_02.php?a_order=naam&startjaar=$startjaar&eindjaar=$eindjaar\">Naam</a></th>

                <th><a href=\"lijst_archief_02.php?a_order=startdatum&startjaar=$startjaar&eindjaar=$eindjaar\">Startdatum</a></th>

                <th><a href=\"lijst_archief_02.php?a_order=einddatum&startjaar=$startjaar&eindjaar=$eindjaar\">Einddatum</a></th>

                <th>Reden</th>

            </tr>");


      if ($result=mysql_query($query) or die("probleem met $query"))

         {

         $teller = 0;

         for ($i=0; $i < mysql_num_rows ($result); $i++)

            {

            $records= mysql_fetch_array($result);

            $teller++;

            $veld00=($records['code']!="")?         $records['code']:"";

            $veld01=($records['naam']!="")?         $records['naam']:"";

            $veld02=($records['voornaam']!="")?     $records['voornaam']:"";

            if ($records['project']==0) {

              $project = "";

            }

            else {

              $project = " - <span style='background-color: #FFD780'>TP{$records['nummer']}</span>";

            }

            $veld03=($records['startdatum']!="")?   $records['startdatum']:"";

            $veld04=($records['einddatum']!="")?    $records['einddatum']:"";

            switch ($records['stopzetting_cat']) {

               case 1:

                 $reden = "De patient is voldoende hersteld";

                 break;

               case 2:

                 $reden = "Overlijden";

                 break;

               case 3:

                 $reden = "Opname in rustoord";

                 break;

               case 4:

                 $reden = "Verhuis buiten Limburg";

                 break;

               case 5:

                 $reden = "Andere";

                 break;

               case 6:

                 $reden = "Verhuis buiten de gemeente";

                 break;

            }

            $veld05=($records['stopzetting_text']!="")?  $records['stopzetting_text']:"";

        print("

            <tr>

               <td valign=\"top\"><a href=\"patientoverzicht.php?pat_code=".$veld00."\">".$veld00."</a> $project</td>

               <td valign=\"top\"><a href=\"lijst_archief_03.php?bekijk=1&einddatum={$records['einddatum']}&code=".$veld00."\">".$veld01." ".$veld02."</a></td>

                    <td valign=\"top\">".substr($veld03,6,2)."/".substr($veld03,4,2)."/".substr($veld03,0,4)."</td>

                    <td valign=\"top\">".substr($veld04,6,2)."/".substr($veld04,4,2)."/".substr($veld04,0,4)."</td>

                    <td valign=\"top\"><strong>$reden</strong><br />$veld05</td>

                </tr>");

            }

            print("</table>");

         }

      else

         {

         print ("<tr><td colspan=\"3\">Er werden <b>geen</b> records gevonden.");
         print("<div style=\"display:none\">Dit was de query\n$query</div>\n");
         print("</td></tr/></table>");

         }

//---------------------------------------------------------

/* Sluit Dbconnectie */ require("../includes/dbclose.inc");

//---------------------------------------------------------



      print("</div>");

      print("</div>");

      print("</div>");

      require("../includes/footer.inc");

      print("</div>");

      print("</div>");

      print("</body>");

      print("</html>");

      }



//---------------------------------------------------------

/* Geen Toegang */ require("../includes/check_access.inc");

//---------------------------------------------------------

?>