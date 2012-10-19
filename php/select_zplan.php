<?php

require('../includes/dbconnect2.inc');

$paginanaam="zorgplan selecteren";

require("../includes/clearSessie.inc");

$_SESSION['actie'] = $_GET['actie'];

//require("../includes/toonSessie.inc");

/* volgende links worden voorafgegaan door select_zplan

Alleen voor patienten die toegewezen zijn aan persoon (zonder met verdere eisen)
  - patient_aanpassen.php
  - zorgteam_bewerken.php
  - naar_archief_01.php

Alleen voor patienten die toegewezen zijn aan persoon
plus bijkomende overlegeisen
    - overleg nieuw, bewerken, afronden, verwijderen

Alleen voor TP
  - rechtenOC.php
  - weigeren voor inclusie

Voor iedereen die ooit rechten had
  - patientoverzicht.php

Voor iedereen die nu rechten heeft
  - fill_evaluatie_01.php
  - wis_evaluatie.php
  - bericht_maken.php


*/

if (IsSet($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan"))

    {



    require("../includes/html_html.inc");

    print("<head>");

    require("../includes/html_head.inc");



//----------------------------------------------------------

// Reset de sessie-vars

    $_SESSION['pat_code']="";

    $_SESSION['pat_id']="";

    $_SESSION['pat_naam']="";

    $_SESSION['pat_voornaam']="";

//----------------------------------------------------------


        $dossierList="\n\nvar dossierList = Array(\n";

        $patientList="\n\nvar patientList = Array(\n";

        $vandaag = date("Ymd");

        // patient en mantelzorger nog toevoegen!!
        switch ($_SESSION['profiel']) {
           case "OC":
             $actief = "(patient.actief=1)";
             $beperkingTabel = "gemeente, ";
             $beperking = "   AND patient.toegewezen_genre = 'gemeente'
                              AND gem_id=gemeente.id and gemeente.zip =  {$_SESSION['overleg_gemeente']}
                          ";
             $overlegBeperking = "   ( overleg.toegewezen_genre = 'gemeente'
                                       AND gem_id=gemeente.id
                                       AND gemeente.zip =  {$_SESSION['overleg_gemeente']}
                                       AND
                                         ( (overleg.genre is NULL or overleg.genre in ('gewoon','psy'))
                                             or
                                           (overleg.genre = 'TP' and overleg.tp_rechtenOC = 1)
                                         )
                                     )
                          ";
             $tpTabel = "LEFT JOIN patient_tp on patient.code = patient_tp.patient";
             $tpRechten = "or (patient.actief=-1 and patient_tp.actief = 1 and patient_tp.rechtenOC > 0 and patient_tp.rechtenOC <= $vandaag)";
             $ofNogGeenOverleg = "OR max(afgerond) is NULL";
             $minimumAantal = 1;
             $menosBeperking = " AND (overleg.genre is NULL or overleg.genre in ('gewoon','TP','psy')) ";
             break;
           case "rdc":
             $actief = "(patient.actief=1)";
             $beperkingTabel = "";
             $beperking = "   AND patient.toegewezen_genre = 'rdc'
                              AND patient.toegewezen_id = {$_SESSION['organisatie']}
                          ";
             $overlegBeperking = "   (overleg.toegewezen_genre = 'rdc'
                                     AND overleg.toegewezen_id = {$_SESSION['organisatie']})
                                     AND (overleg.genre is NULL or overleg.genre in ('gewoon','TP','psy'))
                          ";
             $tpTabel = "LEFT JOIN patient_tp on patient.code = patient_tp.patient";
             $tpRechten = "or (patient.actief=-1 and patient_tp.actief = 1 and patient_tp.rechtenOC > 0 and patient_tp.rechtenOC <= $vandaag)";
             $ofNogGeenOverleg = "OR max(afgerond) is NULL";
             $minimumAantal = 1;
             $menosBeperking = " AND (overleg.genre is NULL or overleg.genre in ('gewoon','TP','psy')) ";
             break;
           case "hulp":
             $actief = "(patient.actief=1)";
             $beperkingTabel = "";
             $beperking = "   AND patient.toegewezen_genre = 'hulp'
                              AND patient.toegewezen_id = {$_SESSION['usersid']}
                          ";
             $tpTabel = "";
             $tpRechten = "";
             $ofNogGeenOverleg = "OR max(afgerond) is NULL";
             $minimumAantal = 1;
             break;
           case "listel":
             $actief = "(actief=1 or actief = -1)";
             $beperkingTabel = "";
             $beperking = "";
             $tpTabel = "";
             $tpRechten = "";
             $ofNogGeenOverleg = "OR max(afgerond) is NULL";
             $minimumAantal = 1;
             break;
           case "hoofdproject":
             $actief = "(patient.actief=-1 AND patient_tp.actief = 1)";
             $beperkingTabel = "";
             $beperking = "";
             $tpTabel = "LEFT JOIN patient_tp on patient.code = patient_tp.patient";
             $tpRechten = "AND patient_tp.project = {$_SESSION['tp_project']}";
             $ofNogGeenOverleg = "OR max(afgerond) is NULL";
             $minimumAantal = 1;
             $menosBeperking = " AND (overleg.genre is NULL or overleg.genre = 'gewoon' or overleg.genre = 'TP') ";
             break;
           case "bijkomend project":
             $actief = "(patient.actief=-1 AND patient_tp.actief = 1)";
             $beperkingTabel = "";
             $beperking = "";
             $tpTabel = "LEFT JOIN patient_tp on patient.code = patient_tp.patient";
             $tpRechten = "AND patient_tp.project = {$_SESSION['tp_project']}";
             $ofNogGeenOverleg = "";
             $minimumAantal = 2;
             $menosBeperking = " AND (overleg.genre is NULL or overleg.genre = 'gewoon' or overleg.genre = 'TP') ";
             break;
           case "menos":
             $actief = "menos=1 and patient_menos.einddatum is NULL";
             $beperkingTabel = " ";
             $beperking = " ";
             $tpTabel = "INNER JOIN patient_menos on patient.code = patient_menos.patient";
             $tpRechten = "";
             $ofNogGeenOverleg = "OR max(afgerond) is NULL";
             $minimumAantal = 1;
             $menosBeperking = " AND (overleg.genre = 'menos') ";
             break;
           case "psy":  // alleen zijn eigen patienten, en ook geen menos
             $actief = "(patient.actief=1)";
             $beperking = "   AND patient.toegewezen_genre = 'psy'
                              AND patient.toegewezen_id = {$_SESSION['organisatie']}
                          ";
             $overlegBeperking = " (overleg.toegewezen_genre = 'psy' AND (overleg.genre = 'psy'))";
             $tpTabel = "";
             $tpRechten = "";
             $ofNogGeenOverleg = "OR max(afgerond) is NULL";
             $minimumAantal = 1;
             $menosBeperking = "and overleg.genre = 'psy'";
             break;
        }

        if (isset($_SESSION['actie'])) {
           // overleg-acties
           if ($_SESSION['profiel']=="patient" || $_SESSION['profiel']=="mantel") die("Niet voor patienten of mantelzorgers");
           switch ($_SESSION['actie']) {
              case "nieuw":
               $query2 = "SELECT patient.*  FROM $beperkingTabel
                                              (patient $tpTabel)
                                              LEFT JOIN overleg ON (patient.code = overleg.patient_code $menosBeperking)
                       WHERE ($actief $tpRechten)
                             $beperking
                       GROUP BY
                         patient.code
                       HAVING
                         min(afgerond) = 1 $ofNogGeenOverleg
                       ORDER BY
                         naam,voornaam";
                break;
              case "bewerken":
              case "afsluiten":
              case "wissen":
                // hier stond een LEFT JOIN maar volgens mij moet dat een INNER JOIN zijn.
                // Patienten zonder overleg hebben hier immers niks te zoeken
               $query2 = "SELECT patient.*  FROM $beperkingTabel
                                              (patient $tpTabel)
                                              LEFT JOIN overleg ON (patient.code = overleg.patient_code $menosBeperking)
                       WHERE ($actief $tpRechten)
                             $beperking
                       GROUP BY
                          patient.code
                       HAVING
                          min(afgerond) = 0 and count(overleg.id) >= $minimumAantal
                       ORDER BY
                          naam,voornaam";
               break;
              case "weigeren":
                 if ($_SESSION['profiel']!="hoofdproject" && $_SESSION["profiel"]!="bijkomend project")
                   die("Alleen de hoofdprojectcoordinator mag inclusies weigeren.");
                 $query2 = "SELECT patient.* FROM patient_tp, patient LEFT JOIN overleg ON (patient.code = overleg.patient_code)
                            WHERE patient.actief=-1 AND patient_tp.actief = 1
                              AND patient_tp.patient = patient.code AND
                                  patient_tp.project = {$_SESSION['tp_project']}
                            GROUP BY
                              patient.code
                            HAVING
                              min(afgerond) = 0 and count(overleg.id) = 1
                            ORDER BY
                              naam,voornaam";
               break;
              default:
                die("verboden actie");
           }
           
        }
        else {

          switch ($_GET['a_next_php']) {
             // alleen de organisator aan wie de patient toegewezen is
             case "patient_aanpassen.php":
             case "zorgteam_bewerken.php":
             case "naar_archief_01.php":
             case "patient_menos_vragen.php":
               $query2 = "SELECT patient.*  FROM $beperkingTabel
                                              (patient $tpTabel)
                       WHERE ($actief $tpRechten)
                             $beperking
                       ORDER BY
                         naam,voornaam";
                break;

             // nu rechten (of nu organisator) voor gewoon
             case "fill_evaluatie_01.php":
             case "wis_evaluatie.php":
               if ($_SESSION['profiel']=="hulp") {
                 /*
                 $query2 = "SELECT distinct patient.*
                            FROM (patient left join huidige_betrokkenen on patient.code = huidige_betrokkenen.patient_code)
                            WHERE (
                                    (genre = 'hulp' and persoon_id = {$_SESSION['usersid']} and rechten = 1)
                                    OR
                                    (patient.toegewezen_genre = 'hulp' and patient.toegewezen_id = {$_SESSION['usersid']})
                                  )
                              AND $actief";
                 */
                 $query2 = "(SELECT distinct patient.* FROM (patient inner join huidige_betrokkenen on patient.code = huidige_betrokkenen.patient_code
                                                                          and patient.actief = 1
                                                                          and overleggenre = 'gewoon'
                                                                          and genre = 'hulp' and persoon_id = {$_SESSION['usersid']} and rechten = 1))
                            union
                            (select distinct * from patient where patient.toegewezen_genre = 'hulp' and patient.toegewezen_id = {$_SESSION['usersid']}
                                                                  and patient.actief = 1)";
               }
               else {
                  $query2 = "SELECT patient.*  FROM $beperkingTabel
                                              (patient $tpTabel)
                       WHERE ($actief $tpRechten)
                             $beperking
                       ORDER BY
                         naam,voornaam";
               }
               break;

             // nu rechten (of nu organisator) voor menos
             case "menos_interventie.php":
             case "menos_interventie_wissen.php":
               if ($_SESSION['profiel']=="hulp") {
                 /*
                 $query2 = "SELECT distinct patient.*
                            FROM (patient left join huidige_betrokkenen on patient.code = huidige_betrokkenen.patient_code)
                            WHERE (
                                    (genre = 'hulp' and persoon_id = {$_SESSION['usersid']} and rechten = 1)
                                    OR
                                    (patient.toegewezen_genre = 'hulp' and patient.toegewezen_id = {$_SESSION['usersid']})
                                  )
                              AND $actief";
                 */
                 $query2 = "(SELECT distinct patient.* FROM (patient inner join huidige_betrokkenen on patient.code = huidige_betrokkenen.patient_code
                                                                          and patient.menos = 1
                                                                          and overleggenre = 'menos'
                                                                          and genre = 'hulp' and persoon_id = {$_SESSION['usersid']} ))
                            union
                            (select distinct * from patient where patient.toegewezen_genre = 'hulp' and patient.toegewezen_id = {$_SESSION['usersid']}
                                                                  and patient.actief = 1)";
               }
               else {
                  $query2 = "SELECT patient.*  FROM $beperkingTabel
                                              (patient $tpTabel)
                       WHERE ($actief $tpRechten)
                             $beperking
                       ORDER BY
                         naam,voornaam";
               }
               break;

             // alleen voor menos-coordinator
             case "naar_archief_menos.php":
               if ($_SESSION['profiel']=="menos") {
                 $query2 = "SELECT distinct patient.* FROM patient where menos = 1";
               }
               break;

             // nu rechten (of nu organisator)  voor om het even wat
             case "bericht_maken.php":
               if ($_SESSION['profiel']=="hulp") {
                 /*
                 $query2 = "SELECT distinct patient.*
                            FROM (patient left join huidige_betrokkenen on patient.code = huidige_betrokkenen.patient_code)
                            WHERE (
                                    (genre = 'hulp' and persoon_id = {$_SESSION['usersid']} and rechten = 1)
                                    OR
                                    (patient.toegewezen_genre = 'hulp' and patient.toegewezen_id = {$_SESSION['usersid']})
                                  )
                              AND $actief";
                 */
                 $query2 = "(SELECT distinct patient.* FROM (patient inner join huidige_betrokkenen on patient.code = huidige_betrokkenen.patient_code
                                                                          and (patient.actief = 1 or patient.menos = 1)
                                                                          and genre = 'hulp' and persoon_id = {$_SESSION['usersid']} and (rechten = 1 or overleggenre = 'menos')))
                            union
                            (select distinct * from patient where patient.toegewezen_genre = 'hulp' and patient.toegewezen_id = {$_SESSION['usersid']}
                                                                  and patient.actief = 1)";
               }
               else {
                  $query2 = "SELECT patient.*  FROM $beperkingTabel
                                              (patient $tpTabel)
                       WHERE ($actief $tpRechten)
                             $beperking
                       ORDER BY
                         naam,voornaam";
               }
               break;

             // ooit rechten
             case "patientoverzicht.php":
                if ($_SESSION['profiel']=="hulp") {
                /*
                 $query2 = "SELECT patient.*
                            FROM (patient left join huidige_betrokkenen on patient.code = huidige_betrokkenen.patient_code
                                                                       and huidige_betrokkenen.rechten = 1
                                                                       and huidige_betrokkenen.genre = 'hulp'
                                                                       and huidige_betrokkenen.persoon_id = {$_SESSION['usersid']})
                                 left join (afgeronde_betrokkenen inner join overleg on overleg.id = afgeronde_betrokkenen.overleg_id
                                                                                    and afgeronde_betrokkenen.rechten = 1
                                                                                    and afgeronde_betrokkenen.genre = 'hulp'
                                                                                    and afgeronde_betrokkenen.persoon_id = {$_SESSION['usersid']})
                                        on patient.code = overleg.patient_code
                                 left join (evaluatie_rechten er inner join evaluatie on  evaluatie.patient = patient.code
                                                                                      and er.evaluatie = evaluatie.id
                                                                                      and er.rechten = 1
                                                                                      and er.genre = 'hulp'
                                                                                      and er.id = {$_SESSION['usersid']})
                                        on (evaluatie.patient = patient.code)

                            group by patient.code
                            having max(afgeronde_betrokkenen.rechten) >=1
                                or max(huidige_betrokkenen.rechten) >= 1
                                or max(er.rechten) >= 1
                                or (patient.toegewezen_genre = 'hulp' and patient.toegewezen_id = {$_SESSION['usersid']})";
                */
                   $query2a = "select patient.*
                               FROM (patient inner join huidige_betrokkenen on patient.code = huidige_betrokkenen.patient_code
                                                                       and (huidige_betrokkenen.rechten = 1 or huidige_betrokkenen.overleggenre = 'menos')
                                                                       and huidige_betrokkenen.genre = 'hulp'
                                                                       and huidige_betrokkenen.persoon_id = {$_SESSION['usersid']})";
                   $query2b = "select patient.*
                               FROM (patient inner join overleg on patient.code = overleg.patient_code)
                                    inner join afgeronde_betrokkenen on overleg.id = afgeronde_betrokkenen.overleg_id
                                                                       and (afgeronde_betrokkenen.rechten = 1 or afgeronde_betrokkenen.overleggenre = 'menos')
                                                                       and afgeronde_betrokkenen.genre = 'hulp'
                                                                       and afgeronde_betrokkenen.persoon_id = {$_SESSION['usersid']}";
                   $query2c = "select patient.*
                               FROM (patient inner join evaluatie on patient.code = evaluatie.patient)
                                    inner join evaluatie_rechten on evaluatie.id = evaluatie_rechten.evaluatie
                                                                       and evaluatie_rechten.rechten = 1
                                                                       and evaluatie_rechten.genre = 'hulp'
                                                                       and evaluatie_rechten.id = {$_SESSION['usersid']}";
                   $query2 = "($query2a) union ($query2b) union ($query2c)";

                }
                else if ($_SESSION['profiel']=="OC" || $_SESSION['profiel']=="rdc") {
                 $query2 = "SELECT patient.*, max(patient_tp.rechtenOC) FROM $beperkingTabel (patient $tpTabel)
                                                                             left join overleg on overleg.patient_code = patient.code
                             WHERE (1 $beperking) or $overlegBeperking
                             group by patient.code
                             having patient.actief = 1
                                 or (patient.actief = -1 and
                                    ((sum((overleg.genre is null or overleg.genre ='gewoon')) > 0)  or max(patient_tp.rechtenOC) is not NULL))
                            ORDER BY naam,voornaam    ";
                            //print($query2);
                }
                else if ($_SESSION['profiel']=="listel" ||
                         $_SESSION['profiel']=="hoofdproject" ||
                         $_SESSION['profiel']=="bijkomend project" ||
                         $_SESSION['profiel']=="psy" ||
                         $_SESSION['profiel']=="menos" ){
                  $query2 = "SELECT patient.*  FROM $beperkingTabel
                                              (patient $tpTabel)
                       WHERE ($actief $tpRechten)
                             $beperking
                       ORDER BY
                         naam,voornaam";
                }
                else if ($_SESSION['profiel']=="patient"){
                  // nog te doen
                }
                else if ($_SESSION['profiel']=="mantel"){
                  // nog te doen
                }
                break;
             // alleen voor TP
             case "rechtenOC.php":
               if ($_SESSION["profiel"]=="hoofdproject"){
                 $query2 = "SELECT patient.* FROM patient_tp, patient INNER JOIN overleg ON (patient.code = overleg.patient_code)
                            WHERE patient.actief=-1 AND patient_tp.actief = 1
                              AND patient_tp.patient = patient.code AND
                                  patient_tp.project = {$_SESSION['tp_project']}
                            GROUP BY
                              patient.code
                            HAVING
                              max(afgerond) = 1
                            ORDER BY
                              naam,voornaam";
               }
               else die("Dit mag alleen de hoofprojectcoordinator doen.");
               break;

             default:
                die("verboden pagina");
          }
        }


//print("<h3>$query2</h3>");


      $result2=mysql_query($query2) or die("We kunnen de juiste zorgplannen niet selecteren dankzij de fout " . mysql_error() . " in <br/>$query2");
      for ($i=0; $i < mysql_num_rows ($result2); $i++) {
        $records= mysql_fetch_array($result2);

        //$dossierList=$dossierList."\"".$records['code']." ".$records['naam']." ".$records['voornaam']."\",\"".$records['code']."\",\n";

        $dossierList=$dossierList."\"".patient_roepnaam($records['code'])."\",\"".$records['code']."\",\n";
        $patientList=$patientList."\"".$records['naam']." ".$records['voornaam']."\",\"".$records['code']."\",\n";

      }

      $dossierList=$dossierList."\" \",\" \")\n\n";

      $patientList=$patientList."\" \",\" \")\n\n";



        

        

    print("<script type=\"text/javascript\">");

    print($dossierList);

    print($patientList);

?>

function checkDossier() {

  var code = document.selectDossier.dossierCodeInput.value;

  if (isNaN(parseInt(document.selectDossier.pat_code.value)) && document.selectDossier.pat_code.value.substring(0,2)!="aa") {

    for (i = 0; i < dossierList.length; i=i+2) {

      if (dossierList[i] == code) {

        document.selectDossier.pat_code.value = dossierList[i+1];

        return true;

      }

    }

  }

  else {

    return true;

  }

  alert("U hebt geen geldig volgnummer ingegeven");

  document.selectDossier.dossierCodeInput.value="";

  return false;

}

function checkPatient() {

  var code = document.selectPatient.patientNaamInput.value;

  if (isNaN(parseInt(document.selectPatient.pat_code.value))) {

     for (i = 0; i < patientList.length; i=i+2) {

      //alert(code + "-" + dossierList[i]);

      if (patientList[i] == code) {

        document.patientNaamInput.pat_code.value = patientList[i+1];

        return true;

      }

    }

  }

  else {

    return true;

  }

  alert("U hebt geen geldige patient ingegeven");

  document.selectPatient.patientNaamInput.value="";

  return false;

}



<?php

    print("</script>");

//----------------------------------------------------------

    //print($query);

    print("</head>");

    print("<body onload=\"hideCombo('IIDossierCodeS'),hideCombo('IIPatientnaamS')\">");

    print("<div align=\"center\">");

    print("<div class=\"pagina\">");

    require("../includes/header.inc");

    require("../includes/kruimelpad.inc");

    print("<div class=\"contents\">");

    require("../includes/menu.inc");

    print("<div class=\"main\">");

    print("<div class=\"mainblock\">");


?>



<fieldset>

<?php

if ($_SESSION['actie'] == "nieuw")  {

  print("<form action=\"overleg_alles.php\" method=\"post\" name=\"selectDossier\" onSubmit=\"return checkDossier();\" autocomplete=\"off\">");

  print("<div class=\"legende\">Nieuw overleg plannen voor een zorgplan.<br /><br />");

  print("Selecteer eerst een Pati&euml;nt:</div>");

}

else if ($_SESSION['actie'] == "bewerken")  {

  print("<form action=\"overleg_alles.php?tab=Teamoverleg\" method=\"post\" name=\"selectDossier\" onSubmit=\"return checkDossier();\" autocomplete=\"off\">");

  print("<div class=\"legende\">Overleg bewerken bij een zorgplan.<br /><br />");

  print("Selecteer eerst een Pati&euml;nt:</div>");

}

else if ($_SESSION['actie'] == "afsluiten")  {

  print("<form action=\"overleg_alles.php?tab=Teamoverleg&afronden=1\" method=\"post\" name=\"selectDossier\" onSubmit=\"return checkDossier();\" autocomplete=\"off\">");

  print("<div class=\"legende\">Overleg afronden bij een zorgplan.<br /><br />");

  print("Selecteer eerst een Pati&euml;nt:</div>");

}

else if ($_SESSION['actie'] == "wissen")  {

  print("<form action=\"overleg_alles.php?tab=Basisgegevens2&wissen=1\" method=\"post\" name=\"selectDossier\" onSubmit=\"return checkDossier();\" autocomplete=\"off\">");

  print("<div class=\"legende\">Het huidig overleg verwijderen.<br />Dit kan all&egrave;&egrave;n voor een niet-afgerond overleg!!<br/><br />");

  print("Selecteer eerst een Pati&euml;nt:</div>");

}

else if ($_SESSION['actie'] == "weigeren")  {

  print("<form action=\"overleg_alles.php?tab=Basisgegevens2&weigeren=1\" method=\"post\" name=\"selectDossier\" onSubmit=\"return checkDossier();\" autocomplete=\"off\">");

  print("<div class=\"legende\">Deze pati&eacute;nt weigeren voor inclusie (en het huidig overleg verwijderen).<br/><br />");

  print("Selecteer eerst een Pati&euml;nt:</div>");

}

else if (substr($_GET['a_next_php'],0,16)=="patientoverzicht")  {

  print("<form action=\"".$_GET['a_next_php']."\" method=\"post\" name=\"selectDossier\" onSubmit=\"return checkDossier();\" autocomplete=\"off\">");

  print("<div class=\"legende\">Bekijk alle overleggen en evaluaties van een patient.<br /><br />");

  print("Selecteer eerst de Pati&euml;nt:</div>");

}

else if (substr($_GET['a_next_php'],0,17)=="patient_aanpassen")  {

  print("<form action=\"".$_GET['a_next_php']."\" method=\"post\" name=\"selectDossier\" onSubmit=\"return checkDossier();\" autocomplete=\"off\">");

  print("<div class=\"legende\">Pas de gegevens van een patient aan.<br /><br />");

  print("Selecteer eerst de Pati&euml;nt:</div>");

}

else if (substr($_GET['a_next_php'],0,13)=="wis_evaluatie")  {

  print("<form action=\"".$_GET['a_next_php']."\" method=\"post\" name=\"selectDossier\" onSubmit=\"return checkDossier();\" autocomplete=\"off\">");

  print("<div class=\"legende\">Wis een evaluatie.<br /><br />");

  print("Selecteer eerst de Pati&euml;nt:</div>");

}
else if (substr($_GET['a_next_php'],0,17)=="menos_interventie")  {
  print("<form action=\"".$_GET['a_next_php']."\" method=\"post\" name=\"selectDossier\" onSubmit=\"return checkDossier();\" autocomplete=\"off\">");
  print("<div class=\"legende\">Registreer een interventie.<br /><br />");
  print("Selecteer eerst de Pati&euml;nt:</div>");
}
else if (substr($_GET['a_next_php'],0,24)=="menos_interventie_wissen")  {
  print("<form action=\"".$_GET['a_next_php']."\" method=\"post\" name=\"selectDossier\" onSubmit=\"return checkDossier();\" autocomplete=\"off\">");
  print("<div class=\"legende\">Wis een interventie.<br /><br />");
  print("Selecteer eerst de Pati&euml;nt:</div>");
}

else  {

  print("<form action=\"".$_GET['a_next_php']."\" method=\"post\" name=\"selectDossier\" onSubmit=\"return checkDossier();\" autocomplete=\"off\">");

  print("<div class=\"legende\">Selecteer eerst een pati&euml;nt:</div>");

}

?>





    <div class="inputItem" id="IIDossierCode">

        <div class="label160">Volgnummer&nbsp;: SO98-</div>

        <div class="waarde2">

            <input

                class="invoer"

                onKeyUp="refreshList('selectDossier','dossierCodeInput','pat_code',1,'IIDossierCodeS',dossierList,20)"

                onmouseUp="showCombo('IIDossierCodeS',100)"

                onfocus="resetList('selectDossier','dossierCodeInput','pat_code',1,'IIDossierCodeS',dossierList,20,100)"

                type="text"

                name="dossierCodeInput"

                value="">

            <input

                type="button"

                onClick="resetList('selectDossier','dossierCodeInput','pat_code',1,'IIDossierCodeS',dossierList,20,100)"

                value="<< lijst">

            <input

                type="submit"

                value="Go >>">

        </div>

    </div>

    <div class="inputItem" id="IIDossierCodeS">

        <div class="label160">Kies eventueel&nbsp;:</div>

        <div class="waarde2">

            <select

                class="invoer"

                onClick="handleSelectClick('selectDossier','dossierCodeInput','pat_code',1,'IIDossierCodeS')"

                onBlur="handleSelectClick('selectDossier','dossierCodeInput','pat_code',1,'IIDossierCodeS')"

                name="pat_code"

                size="5">

            </select>

        </div>

    </div><!--Dossiercode -->

</form>



<?php

if ($_SESSION['actie'] == "nieuw")  {

  print("<form action=\"overleg_alles.php\" method=\"post\" name=\"selectPatient\" onSubmit=\"return checkPatient();\" autocomplete=\"off\">");

}

else if ($_SESSION['actie'] == "bewerken")  {

  print("<form action=\"overleg_alles.php?tab=Teamoverleg\" method=\"post\" name=\"selectPatient\" onSubmit=\"return checkPatient();\" autocomplete=\"off\">");

}

else if ($_SESSION['actie'] == "afsluiten")  {

  print("<form action=\"overleg_alles.php?tab=Teamoverleg&afronden=1\" method=\"post\" name=\"selectPatient\" onSubmit=\"return checkPatient();\" autocomplete=\"off\">");

}

else if ($_SESSION['actie'] == "wissen")  {

  print("<form action=\"overleg_alles.php?tab=Basisgegevens2&wissen=1\" method=\"post\" name=\"selectPatient\" onSubmit=\"return checkPatient();\" autocomplete=\"off\">");

}

else if ($_SESSION['actie'] == "weigeren")  {

  print("<form action=\"overleg_alles.php?tab=Basisgegevens2&weigeren=1\" method=\"post\" name=\"selectPatient\" onSubmit=\"return checkPatient();\" autocomplete=\"off\">");

}

else {

  print("<form action=\"".$_GET['a_next_php']."\" method=\"post\" name=\"selectPatient\" onSubmit=\"return checkPatient();\" autocomplete=\"off\">");

}

?>



    <div class="inputItem" id="IIPatientnaam">

    <div class="label160">Pati&euml;ntnaam&nbsp;: </div>

        <div class="waarde2">

            <input

                class="invoer"

                onKeyUp="refreshList('selectPatient','patientNaamInput','pat_code',1,'IIPatientnaamS',patientList,20)"

                onmouseUp="showCombo('IIPatientnaamS',100)"

                onfocus="resetList('selectPatient','patientNaamInput','pat_code',1,'IIPatientnaamS',patientList,20,100)"

                type="text"

                name="patientNaamInput"

                value="">

            <input

                type="button"

                onClick="resetList('selectPatient','patientNaamInput','pat_code',1,'IIPatientnaamS',patientList,20,100)"

                value="<< lijst">

            <input

                type="submit"

                value="Go >>">

        </div>

    </div>

    <div class="inputItem" id="IIPatientnaamS">

        <div class="label160">Kies eventueel&nbsp;:</div>

        <div class="waarde2">

            <select

                class="invoer"

                onClick="handleSelectClick('selectPatient','patientNaamInput','pat_code',1,'IIPatientnaamS')"

                onblur="handleSelectClick('selectPatient','patientNaamInput','pat_code',1,'IIPatientnaamS')"

                name="pat_code"

                size="5">

            </select>

        </div>

    </div><!--Naam Patient -->

</form>

</fieldset>



<?php

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

