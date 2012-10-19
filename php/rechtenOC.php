<?php

session_start();







   require("../includes/dbconnect2.inc");

   $paginanaam="TP: Rechten toekennen aan OC";

   if (isset($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan")

          && ($_SESSION['profiel'] == "hoofdproject"))

      {

      require("../includes/html_html.inc");

      print("<head>");

      require("../includes/html_head.inc");

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

    $tp_basisgegevens = tp_record($_SESSION['tp_project']);



// begin mainblock

?>

   <h1><?= tp_roepnaam($tp_basisgegevens) ?><br />Rechten voor overlegco&ouml;rdinatoren</h1>

   

<p>Op deze pagina kan je aan de overlegco&ouml;rdinatoren het recht toekennen of ontzeggen

om overleggen voor een patient te organiseren.</p>



<?php







if ($_POST['pat_code'] != "")

  $_SESSION['pat_code'] = $_POST['pat_code'];



if (isset($_POST['namen'])) {

  if ($_POST['rechtenOC'] == "") {

    $qryGetRechten = "select id, rechtenOC from patient_tp

                      where project = {$_SESSION['tp_project']}

                      and patient = '{$_SESSION['pat_code']}'

                      and actief = 1";

    $resultGetRechten = mysql_query($qryGetRechten) or die("$resultGetRechten geeft fout: " . mysql_error());

    $rijGetRechten = mysql_fetch_assoc($resultGetRechten);

    

    $qryRechtenArchief = "insert into tp_oude_rechten (patient_tp_id, start, einde)

                          values ({$rijGetRechten['id']},'{$rijGetRechten['rechtenOC']}',NOW())";

    $okRechtenArchief = mysql_query($qryRechtenArchief) or die("$qryRechtenArchief geeft fout: " . mysql_error());

  }

  else {

    $okRechtenArchief = true;

  }

  $qryUpdate = "update patient_tp set rechtenOC = \"{$_POST['rechtenOC']}\"

                where project = {$_SESSION['tp_project']}

                and patient = '{$_SESSION['pat_code']}'

                and actief = 1";

  if ($okRechtenArchief && mysql_query($qryUpdate)) {

    print("<p style='background-color: #8f8'>De rechten zijn succesvol aangepast.</p>");

  }

  else

    print($qryRechtenArchief. " -- " . $qryUpdate . mysql_error());

  

  if ($_POST['rechtenOC'] == "")

    $msg = "Door de opname van de patient {$_SESSION['pat_code']} in het therapeutisch project kan de overlegco&ouml;rdinator

       g&eacute;&eacute;n overleggen meer plannen tot de hoofdprojectco&ouml;rdinator hiervoor opnieuw toestemming geeft.";

  else {

    $msg = "De hoofdprojectco&ouml;rdinator geeft toestemming aan de overlegco&ouml;rdinator

       om (opnieuw) overleggen te plannen voor de patient {$_SESSION['pat_code']}.";

    htmlmail($_POST['adressen'],"Listel: patient {$_SESSION['pat_code']}","Beste {$_POST['namen']}<br/>$msg \n<br />Voor meer inlichtingen kan je via elkaars emailadressen ({$_POST['adressen']}) contact opnemen met elkaar.<br/><p>Met dank voor uw medewerking, <br />Het LISTEL e-zorgplan www.listel.be </p>");



    $vandaag = date("Ymd");

    $zoekToekomstigeOverleggen = "update overleg set tp_rechtenOC = 1 where patient_code = '{$_SESSION['pat_code']}' and  datum >= '$vandaag'";

    mysql_query($zoekToekomstigeOverleggen);

  }

}



require("../includes/patientoverleg_geg.php");







  $qryOC = "select logins.* from logins, gemeente, patient where profiel = 'OC'

              and overleg_gemeente = zip and patient.gem_id = gemeente.id and patient.code =  \"{$_SESSION['pat_code']}\"

              and logins.login not like '%help%'

              and logins.actief = 1";

  $resultOC = mysql_query($qryOC);

  if (mysql_num_rows($resultOC) == 0) {

     print("Voor deze patient is er echter g&eacute;&eacute;n overlegco&ouml;rdinator gekend in het systeem.<br/>Bijgevolg kunnen we geen rechten toekennen aan de niet-bestaande overlegco&ouml;rdinator.");

  }

  else {

    for ($i=0; $i<mysql_num_rows($resultOC); $i++) {

       $oc  = mysql_fetch_assoc($resultOC);

       $namen .= ", {$oc['naam']} {$oc['voornaam']}";

       $adressen .= ", {$oc['email']}";

    }

    $namenOC = substr($namen, 1);



    $qryPC = "select logins.* from logins, patient_tp where profiel = 'hoofdproject'

              and patient_tp.project = logins.tp_project and patient_tp.patient =  \"{$_GET['patient']}\"

              and patient_tp.actief = 1

              and logins.login not like '%help%'

              and logins.actief = 1";



    $namen = " en $namenOC";

    $resultPC = mysql_query($qryPC);

    for ($i=0; $i<mysql_num_rows($resultPC); $i++) {

       $pc  = mysql_fetch_assoc($resultPC);

       $namen .= ", {$pc['naam']} {$pc['voornaam']}";

       $adressen .= ", {$pc['email']}";

    }

    $namen = substr($namen, 1);

    $adressen = substr($adressen, 1);



    if ($patientInfo['rechtenOC'] == "") {

      $rechtenOC = "GEEN";

      $rechtenOC2 = "";

      $rechtenOC3 = "toekennen";

      $rechtenPOST = date("Ymd");

    }

    else {

      $rechtenOC = "WEL";

      $datum = $patientInfo['rechtenOC'];

      $rechtenOC2 = "(sinds " . substr($datum,6,2) . "/" . substr($datum,4,2) . "/". substr($datum,0,4) . ")";

      $rechtenOC3 = "afnemen";

      $rechtenPOST = "";

    }

    echo <<< EINDE

      <p>Momenteel hebben de overlegco&ouml;rdinator(en) $namenOC  $rechtenOC rechten $rechtenOC2 om overleggen te organiseren.</p>

      <form method="post">

         <input type="hidden" name="namen" value="$namen" />

         <input type="hidden" name="adressen" value="$adressen" />

         <input type="hidden" name="rechtenOC" value="$rechtenPOST" />

         <input type="submit" value="rechten $rechtenOC3" />

      </form>



EINDE;





  }

?>





<?php



// einde mainblock



      print("</div>");

      print("</div>");

      print("</div>");

      require("../includes/dbclose.inc");

      require("../includes/footer.inc");

      print("</div>");

      print("</div>");

      print("</body>");

      print("</html>");

      }



//---------------------------------------------------------

/* Geen Toegang */ require("../includes/check_access.inc");

//---------------------------------------------------------



//---------------------------------------------------------

/* Sluit Dbconnectie */ require("../includes/dbclose.inc");

//---------------------------------------------------------

?>