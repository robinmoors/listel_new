<?php

require('../includes/dbconnect2.inc');

$paginanaam="zorgplan selecteren";

require("../includes/clearSessie.inc");

$_SESSION['actie'] = $_GET['actie'];

//require("../includes/toonSessie.inc");



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



//----------------------------------------------------------

// Haal alle patienten op van een Regionale SIT (origineel)

/*

    $sitbeperking=($_SESSION['bheer_sitnr']=='00')?"":" AND substring(p.pat_id,1,2)=substring('".$_SESSION['bheer_sitnr']."',1,2)";

   $query = " 

        SELECT

            code,

            voornaam,

            naam,

            id

        FROM

            patient

        WHERE

            einddatum=0 AND

            actief<>1 ".

            $sitbeperking."

        ORDER BY

            naam,voornaam";

    if ($result=mysql_query($query))

        {

        $dossierList="\n\nvar dossierList = Array(\n";

        $patientList="\n\nvar patientList = Array(\n";

        for ($i=0; $i < mysql_num_rows ($result); $i++)

            {

            $records= mysql_fetch_array($result);

            $dossierList=$dossierList."\"".$records[3]." ".$records[2]." ".$records[1]."\",\"".$records[0]."\",\n";

            $patientList=$patientList."\"".$records[2]." ".$records[1]."\",\"".$records[0]."\",\n";

            }

        $dossierList=$dossierList."\" \",\" \")\n\n";

        $patientList=$patientList."\" \",\" \")\n\n";

        }

        */

        

        

        $dossierList="\n\nvar dossierList = Array(\n";

        $patientList="\n\nvar patientList = Array(\n";



        if($_SESSION["profiel"]=="OC"){

          $vandaag = date("Ymd");

          if ($_SESSION['actie'] == "nieuw")  {

            $query2 = "SELECT patient.*  FROM gemeente,

                                              (patient LEFT JOIN patient_tp on patient.code = patient_tp.patient)

                                              LEFT JOIN overleg ON (patient.code = overleg.patient_code)

                       WHERE ((patient.einddatum=0 AND patient.actief=1) or

                              (patient.actief=-1 and patient_tp.actief = 1 and patient_tp.rechtenOC > 0 and patient_tp.rechtenOC <= $vandaag))

                              AND gem_id=gemeente.id and gemeente.zip =  {$_SESSION['overleg_gemeente']}

            GROUP BY

              patient.code

            HAVING

              min(afgerond) = 1 OR max(afgerond) is NULL

            ORDER BY

              naam,voornaam";

          }

          else if (($_SESSION['actie'] == "bewerken")  || ($_SESSION['actie'] == "afsluiten") || ($_SESSION['actie'] == "wissen"))  {

            $query2 = "SELECT patient.*  FROM gemeente,

                                              (patient LEFT JOIN patient_tp on patient.code = patient_tp.patient)

                                              LEFT JOIN overleg ON (patient.code = overleg.patient_code)

                       WHERE ((patient.einddatum=0 AND patient.actief=1) or

                              (patient.actief=-1 and patient_tp.actief = 1 and patient_tp.rechtenOC > 0 and patient_tp.rechtenOC <= $vandaag))

                              AND gem_id=gemeente.id and gemeente.zip =  {$_SESSION['overleg_gemeente']}

            GROUP BY

              patient.code

            HAVING

              min(afgerond) = 0   and count(overleg.id) >= 1

            ORDER BY

              naam,voornaam";

          }

          else if ($_GET['a_next_php'] == "naar_archief_01.php") {

            $query2 = "SELECT patient.* FROM patient, gemeente WHERE einddatum=0 AND actief=1 AND gem_id=gemeente.id and gemeente.zip = {$_SESSION['overleg_gemeente']}

                       ORDER BY naam,voornaam";

          }

          else if ($_GET['a_next_php'] == "patientoverzicht.php") {

            $query2 = "

SELECT patient.*, max(patient_tp.rechtenOC) FROM gemeente, (patient left join patient_tp on patient.code = patient)

left join overleg on patient_code = code WHERE gem_id=gemeente.id and gemeente.zip = {$_SESSION['overleg_gemeente']}

group by patient.code

having patient.actief = 1

or (patient.actief = -1 and

((sum(overleg.genre is null) + sum(overleg.genre ='gewoon') > 0)  or max(patient_tp.rechtenOC) is not NULL))

                       ORDER BY naam,voornaam    ";



//            $query2 = "SELECT patient.* FROM patient, gemeente WHERE einddatum=0 AND (actief=1 or actief=-1) AND gem_id=gemeente.id and gemeente.zip = {$_SESSION['overleg_gemeente']}

//                       ORDER BY naam,voornaam";

          }

          else {

            $query2 = "SELECT patient.*  FROM gemeente,

                                              (patient LEFT JOIN patient_tp on patient.code = patient_tp.patient)

                       WHERE ((patient.einddatum=0 AND patient.actief=1) or

                              (patient.actief=-1 and patient_tp.actief = 1 and patient_tp.rechtenOC > 0 and patient_tp.rechtenOC <= $vandaag))

                              AND gem_id=gemeente.id and gemeente.zip =  {$_SESSION['overleg_gemeente']}

                       ORDER BY naam,voornaam";

          }

        

        }

        else if($_SESSION["profiel"]=="hoofdproject"){

// begin queries voor hoofdproject

          if ($_SESSION['actie'] == "nieuw")  {

            $query2 = "SELECT patient.* FROM patient_tp, patient LEFT JOIN overleg ON (patient.code = overleg.patient_code)

                       WHERE patient_tp.einddatum is NULL AND patient.actief=-1 AND patient_tp.actief = 1

                       AND patient_tp.patient = patient.code AND

                             patient_tp.project = {$_SESSION['tp_project']}

            GROUP BY

              patient.code

            HAVING

              min(afgerond) = 1 OR max(afgerond) is NULL

            ORDER BY

              naam,voornaam";

          }

          else if (($_SESSION['actie'] == "bewerken")  || ($_SESSION['actie'] == "afsluiten") || ($_SESSION['actie'] == "wissen"))  {

            $query2 = "SELECT patient.* FROM patient_tp, patient LEFT JOIN overleg ON (patient.code = overleg.patient_code)

                       WHERE patient_tp.einddatum is NULL AND patient.actief=-1 AND patient_tp.actief = 1

                       AND patient_tp.patient = patient.code AND

                             patient_tp.project = {$_SESSION['tp_project']}

            GROUP BY

              patient.code

            HAVING

              min(afgerond) = 0   and count(overleg.id) >= 1

            ORDER BY

              naam,voornaam";

          }

          else if ($_SESSION['actie'] == "weigeren")  {

            $query2 = "SELECT patient.* FROM patient_tp, patient LEFT JOIN overleg ON (patient.code = overleg.patient_code)

                       WHERE patient_tp.einddatum is NULL AND patient.actief=-1 AND patient_tp.actief = 1

                       AND patient_tp.patient = patient.code AND

                             patient_tp.project = {$_SESSION['tp_project']}

            GROUP BY

              patient.code

            HAVING

              min(afgerond) = 0   and count(overleg.id) = 1

            ORDER BY

              naam,voornaam";

          }

          else if ($_GET['a_next_php'] == "rechtenOC.php") {

            $query2 = "SELECT patient.* FROM patient_tp, patient LEFT JOIN overleg ON (patient.code = overleg.patient_code)

                       WHERE patient_tp.einddatum is NULL AND patient.actief=-1 AND patient_tp.actief = 1

                       AND patient_tp.patient = patient.code AND

                             patient_tp.project = {$_SESSION['tp_project']}

            GROUP BY

              patient.code

            HAVING

              max(afgerond) = 1

            ORDER BY

              naam,voornaam";

          }

          else {

            $query2 = "SELECT patient.* FROM patient_tp, patient

                       WHERE patient_tp.einddatum is NULL AND patient.actief=-1 AND patient_tp.actief = 1

                       AND patient_tp.patient = patient.code AND

                             patient_tp.project = {$_SESSION['tp_project']}

            ORDER BY

              naam,voornaam";

          }



// einde queries voor hoofdproject

        }

        else if($_SESSION["profiel"]=="bijkomend project"){

// begin queries voor bijkomend project

          if ($_SESSION['actie'] == "nieuw")  {

            $query2 = "SELECT patient.* FROM patient_tp, patient LEFT JOIN overleg ON (patient.code = overleg.patient_code)

                       WHERE patient_tp.einddatum is NULL AND patient.actief=-1 AND patient_tp.actief = 1

                       AND patient_tp.patient = patient.code AND

                             patient_tp.project = {$_SESSION['tp_project']}

            GROUP BY

              patient.code

            HAVING

              min(afgerond) = 1

            ORDER BY

              naam,voornaam";

          }

          else if (($_SESSION['actie'] == "bewerken")  || ($_SESSION['actie'] == "afsluiten") || ($_SESSION['actie'] == "wissen"))  {

            $query2 = "SELECT patient.* FROM patient_tp, patient LEFT JOIN overleg ON (patient.code = overleg.patient_code)

                       WHERE patient_tp.einddatum is NULL AND patient.actief=-1 AND patient_tp.actief = 1

                       AND patient_tp.patient = patient.code AND

                             patient_tp.project = {$_SESSION['tp_project']}

            GROUP BY

              patient.code

            HAVING

              min(afgerond) = 0   and count(overleg.id) >= 2

            ORDER BY

              naam,voornaam";

          }

          else if ($_SESSION['actie'] == "weigeren")  {

            $query2 = "SELECT patient.* FROM patient_tp, patient LEFT JOIN overleg ON (patient.code = overleg.patient_code)

                       WHERE patient_tp.einddatum is NULL AND patient.actief=-1 AND patient_tp.actief = 1

                       AND patient_tp.patient = patient.code AND

                             patient_tp.project = {$_SESSION['tp_project']}

            GROUP BY

              patient.code

            HAVING

              min(afgerond) = 0   and count(overleg.id) = 1

            ORDER BY

              naam,voornaam";

          }

          else {

            $query2 = "SELECT patient.* FROM patient_tp, patient

                       WHERE patient_tp.einddatum is NULL AND patient.actief=-1 AND patient_tp.actief = 1

                       AND patient_tp.patient = patient.code AND

                             patient_tp.project = {$_SESSION['tp_project']}

            ORDER BY

              naam,voornaam";

          }



// einde queries voor bijkomend project

        }

        else if($_SESSION["profiel"]=="listel") {



        if ($_SESSION['actie'] == "nieuw")  {

          $query2 = "

             SELECT

            code,

            voornaam,

            naam,

            id

          FROM

            patient, overleg

          WHERE

            einddatum=0 AND

            actief=1  AND

            patient.code = overleg.patient_code

          GROUP BY

            patient.code

          HAVING

            min(afgerond) = 1

          ORDER BY

            naam,voornaam";

        }

        else if (($_SESSION['actie'] == "bewerken")  || ($_SESSION['actie'] == "afsluiten") || ($_SESSION['actie'] == "wissen"))  {

          $query2 = "

             SELECT

            code,

            voornaam,

            naam,

            id

          FROM

            patient, overleg

          WHERE

            einddatum=0 AND

            actief=1  AND

            patient.code = overleg.patient_code

          GROUP BY

            patient.code

          HAVING

            min(afgerond) = 0

          ORDER BY

            naam,voornaam";

        }

        else {

          $query2 = "

             SELECT

            code,

            voornaam,

            naam,

            id

          FROM

            patient

          WHERE

            einddatum=0 AND

            (actief=1 or actief = -1)

          ORDER BY

            naam,voornaam";

        }

      }





      $result2=mysql_query($query2);

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

  if (isNaN(parseInt(document.selectDossier.pat_code.value))) {

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

  print("<form action=\"overleg_alles.php\" method=\"post\" name=\"selectPatient\" onSubmit=\"return checkPatient();\">");

}

else if ($_SESSION['actie'] == "bewerken")  {

  print("<form action=\"overleg_alles.php?tab=Teamoverleg\" method=\"post\" name=\"selectPatient\" onSubmit=\"return checkPatient();\">");

}

else if ($_SESSION['actie'] == "afsluiten")  {

  print("<form action=\"overleg_alles.php?tab=Teamoverleg&afronden=1\" method=\"post\" name=\"selectPatient\" onSubmit=\"return checkPatient();\">");

}

else if ($_SESSION['actie'] == "wissen")  {

  print("<form action=\"overleg_alles.php?tab=Basisgegevens2&wissen=1\" method=\"post\" name=\"selectPatient\" onSubmit=\"return checkPatient();\">");

}

else if ($_SESSION['actie'] == "weigeren")  {

  print("<form action=\"overleg_alles.php?tab=Basisgegevens2&weigeren=1\" method=\"post\" name=\"selectPatient\" onSubmit=\"return checkPatient();\">");

}

else {

  print("<form action=\"".$a_next_php."\" method=\"post\" name=\"selectPatient\" onSubmit=\"return checkPatient();\">");

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

