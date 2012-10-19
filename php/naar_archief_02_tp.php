<?php

session_start();



//include("../includes/toonSessie.inc");



$paginanaam="Dossier wegschrijven in archief";

if (IsSet($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan"))

{





    //----------------------------------------------------------

    /* Maak Dbconnectie */ include('../includes/dbconnect2.inc');

    //----------------------------------------------------------



    include("../includes/html_html.inc");

    print("<head>");

    include("../includes/html_head.inc");

?>



<script type="text/javascript">

 function printLogo() {

   document.images[2].width=0;document.images[2].height=0;

   document.images[2].src='/images/logo_top_pagina_klein.gif';

 }

</script>



<?php

    print("</head>");

    print("<body onLoad=\"if (magPrinten) {printLogo();print();}\">");

    print("<div align=\"center\">");

    print("<div class=\"pagina\">");

    include("../includes/header.inc");

    include("../includes/kruimelpad.inc");

    print("<div class=\"contents\">");

    include("../includes/menu.inc");

    print("<div class=\"main\">");

    print("<div class=\"mainblock\">");

    if (strlen($_POST['einde_jj']) == 2) {

       $_POST['einde_jj'] = "20" . $_POST['einde_jj'];

    }



$patientInfo=mysql_fetch_assoc(mysql_query("SELECT patient.*, patient_tp.id as tp_id, patient_tp.rechtenOC FROM patient, patient_tp WHERE code='{$_SESSION['pat_code']}' and patient_tp.actief = 1 and code = patient"));



$stopzettenMag = false;



if ($_POST['bevestiging']=="ja") {

  // er is bevestigd dat het niet-afgeronde overleg gewist moet worden

  $deleteOmb = "delete from omb_registratie where id in (select omb_id from overleg where afgerond = 0 and patient_code = '{$_SESSION['pat_code']}' and omb_id is not null)";



  $deleteOverleggen = "delete from overleg where afgerond = 0 and patient_code = '{$_SESSION['pat_code']}'";

  if (mysql_query($deleteOmb) && mysql_query($deleteOverleggen)) {

  	$stopzettenMag = true;

  }

  else {

    print(mysql_error());

  }

}

else {

  $qryHangendeOverleggen = "select overleg.* from overleg where afgerond = 0 and patient_code = '{$_SESSION['pat_code']}' order by datum asc";

  $resultHangendeOverleggen = mysql_query($qryHangendeOverleggen);

  if (mysql_num_rows($resultHangendeOverleggen)==0) {

    // we kunnen veilig wissen

    $stopzettenMag = true;

  }

  else {

    // lijst de overleggen op, en vraag bevestiging!

    print("<p>Deze pati&euml;nt <strong>{$_SESSION['pat_code']} {$patientInfo['naam']} {$patientInfo['voornaam']}</strong> heeft nog een niet-afgerond overleg!</p>\n");

    print("<table><tr><th>Datum</th><th>Locatie</th><th>Soort</th></tr>\n");

    for ($i=0;$i<mysql_num_rows($resultHangendeOverleggen); $i++) {

      $rijOverleg = mysql_fetch_assoc($resultHangendeOverleggen);

      $mooieDatum = substr($rijOverleg['datum'],6,2)."/".substr($rijOverleg['datum'],4,2)."/".substr($rijOverleg['datum'],0,4);

      if ($rijOverleg['locatie']==0) $locatie = "thuis";

      else if ($rijOverleg['locatie']==1) $locatie = "elders";

      else if ($rijOverleg['locatie']==2) $locatie = "centrum";

      else $locatie = $rijOverleg['locatieTekst'];

      print("<tr><td>$mooieDatum</td><td>$locatie</td><td>{$rijOverleg['genre']}</td></tr>");

    }

?>

    </table>



    <p>Je moet dit overleg eerst

    <ul>

      <li>

        ofwel <a href="overleg_alles.php?tab=Basisgegevens2&wissen=1&patient=<?= $_SESSION['pat_code'] ?>">wissen</a> (dan is er g&eacute;&eacute;n vergoeding voor dit overleg)

      </li>

      <li>

        ofwel <a href="overleg_alles.php?tab=Teamoverleg&afronden=1&patient=<?= $_SESSION['pat_code'] ?>">afronden</a> (dan <strong>kan</strong> er eventueel w&eacute;l een vergoeding zijn

      )

      </li>

    </ul>

    </p>



    <p>Daarna kan je terug naar deze pagina komen om de pati&euml;nt echt stop te zetten.</p>



<!--

    <p>Ben je h&eacute;&eacute;l h&eacute;&eacute;l zeker dat je deze pati&euml;nt wil stopzetten <strong>&eacute;n</strong> dit overleg wil wissen?<br/>

    <form name="f" method="post">

       <input type="hidden" name="bevestiging" value="ja" />

       <input type="hidden" name="pat_stopzetting_cat" value="<?= $_POST['pat_stopzetting_cat'] ?>" />

       <input type="hidden" name="pat_stopzetting_text" value="<?= $_POST['pat_stopzetting_text'] ?>" />

       <input type="hidden" name="einde_jj" value="<?= $_POST['einde_jj'] ?>" />

       <input type="hidden" name="einde_dd" value="<?= $_POST['einde_dd'] ?>" />

       <input type="hidden" name="einde_mm" value="<?= $_POST['einde_mm'] ?>" />

       <input type="hidden" name="stopzetting" value="<?= $_POST['stopzetting'] ?>" />

       <input type="submit" value="Ja, ik ben zeker" />

    </form>



    <form method="get" action="select_zplan.php">

       <input type="hidden" name="a_next_php" value="naar_archief_01.php" />

       <input type="submit" value="Neen, geen denken aan. Breng mij terug naar de pre-archiefpagina" />

    </form>

-->



<?php

  }

}







if ($stopzettenMag && $_POST['stopzetting']=="fase1") {

  // we mogen en kunnen stopzetten want er zijn geen niet-afgeronde overleggen.

  $qryZoekGewoneOverleggen = "select id from overleg

                              where patient_code = '{$_SESSION['pat_code']}'

                                and (genre is NULL or genre = 'gewoon')";

  // we zijn nog wel in de eerste fase. Dus vragen wat hij precies wil.

  if (mysql_num_rows(mysql_query($qryZoekGewoneOverleggen))>0) {

     // er zijn gewone overleggen

     $vraag = "Deze pati&euml;nt heeft al GDT-overleggen gehad in de periode voor de opname in het TP. Moet hij/zij terug naar GDT of helemaal stopgezet?";

     $antwoord1 = "<input type=\"submit\" value=\"naar GDT\" onclick=\"document.f.stopzetting.value='naarGDTmetEmail'\" />";

     $antwoord2 = "<input type=\"submit\" value=\"helemaal stopzetten\" onclick=\"document.f.stopzetting.value='stopzettenMetEmail'\" />";

  }

  else {

     // geen overleggen GDT

     // kijken of OC TGZ rechten gehad heeft

     $rechtenGehad = false;

     if (strlen($patientInfo['rechtenOC']) > 2) {

       $rechtenGehad = true;

     }

     else {

       $qryOudeRechten = "select * from tp_oude_rechten where patient_tp_id = {$patientInfo['tp_id']}";

       if (mysql_num_rows(mysql_query($qryOudeRechten)) > 0) {

         $rechtenGehad = true;

       }

     }

     if ($rechtenGehad) {

       $vraag = "De overlegco&ouml;rdinator had (ooit) rechten voor deze pati&euml;nt. Moet deze pati&euml;nt naar GDT of helemaal stopgezet?";

       $antwoord1 = "<input type=\"submit\" value=\"naar GDT\" onclick=\"document.f.stopzetting.value='naarGDTmetEmail'\" />";

       $antwoord2 = "<input type=\"submit\" value=\"helemaal stopzetten\" onclick=\"document.f.stopzetting.value='stopzettenMetEmail'\" />";

     }

     else {

       $vraag = "De overlegco&ouml;rdinator heeft <strong>nooit</strong> rechten gehad voor deze pati&euml;nt en kent hem/haar in principe dus niet. Toch kan je hem/haar gerust naar de OC TGZ sturen. Wil je dit doen? Of wil je hem/haar helemaal stopzetten?";

       $antwoord1 = "<input type=\"submit\" value=\"naar GDT\" onclick=\"document.f.stopzetting.value='naarGDTmetEmail'\" />";

       $antwoord2 = "<input type=\"submit\" value=\"helemaal stopzetten\" onclick=\"document.f.stopzetting.value='stopzettenZonderEmail'\" />";

     }

  }

  

  print($vraag);

?>



    <form name="f" method="post">

       <input type="hidden" name="bevestiging" value="ja" />

       <input type="hidden" name="pat_stopzetting_cat" value="<?= $_POST['pat_stopzetting_cat'] ?>" />

       <input type="hidden" name="pat_stopzetting_text" value="<?= $_POST['pat_stopzetting_text'] ?>" />

       <input type="hidden" name="einde_jj" value="<?= $_POST['einde_jj'] ?>" />

       <input type="hidden" name="einde_dd" value="<?= $_POST['einde_dd'] ?>" />

       <input type="hidden" name="einde_mm" value="<?= $_POST['einde_mm'] ?>" />

       <input type="hidden" name="stopzetting" value="<?= $_POST['stopzetting'] ?>" />

       <?= "$antwoord1 <br /> $antwoord2" ?>

    </form>

    

    <form method="get" action="select_zplan.php">

       <input type="hidden" name="a_next_php" value="naar_archief_01.php" />

       <input type="submit" value="Niet stopzetten. Breng mij terug naar de pre-archiefpagina" />

    </form>



<?php



  $qryOC = "select logins.* from logins, gemeente, patient where profiel = 'OC'

              and overleg_gemeente = zip and patient.gem_id = gemeente.id and patient.code =  \"{$_SESSION['pat_code']}\"

              and logins.login not like '%help%'

              and logins.actief = 1";

  $resultOC = mysql_query($qryOC);

  if (mysql_num_rows($resultOC) == 0) {

     print("<p>Voor deze patient is er op dit moment g&eacute;&eacute;n overlegco&ouml;rdinator gekend in het systeem.<br/>Je kan dus best helemaal stopzetten, maar dat is niet verplicht.");

  }

  else {

    print("<p>Ter informatie, dit zijn de overlegco&ouml;rdinatoren voor deze pati&euml;nt: </p><ul>");



    for ($i=0; $i<mysql_num_rows($resultOC); $i++) {

       $oc  = mysql_fetch_assoc($resultOC);

       print("<li>{$oc['naam']} {$oc['voornaam']}, {$oc['email']}, {$oc['tel']} </li>");

    }

    print("</ul>");

  }

}

else if ($stopzettenMag) {



    switch ($_POST['pat_stopzetting_cat']) {

       case 1:

         $reden = "De patient is voldoende hersteld (dus katz &lt; 5)";

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

       case 6:

         $reden = "Verhuis buiten gemeente";

         break;

       case 5:

         $reden = "Andere";

         break;

    }



  require("../includes/tp_exclusie_sturen_listel.inc.php");

  // stopzetten mag én er is een tweede keuze gemaakt.

  switch ($_POST['stopzetting']) {

    case "naarGDTmetEmail":

      require("../includes/tp_exclusie_sturen_oc.inc.php");

      $writePatientQry = "

        UPDATE

            patient_tp

        SET

            actief = 0,

            stopzetting_text='".$_POST['pat_stopzetting_text']."',

            stopzetting_cat='".$_POST['pat_stopzetting_cat']."',

            einddatum='".$_POST['einde_jj']."-".$_POST['einde_mm']."-".$_POST['einde_dd']."'

        WHERE

            patient='{$_SESSION['pat_code']}'

            and actief=1";

      $writePatientQry2 = "

        UPDATE

            patient

        SET

            actief = 1,

            tp_record = NULL

        WHERE

            code='{$_SESSION['pat_code']}'";

      $deletePartners = "

        DELETE FROM

           huidige_betrokkenen

        WHERE
           overleggenre = 'gewoon'
           and patient_code='{$_SESSION['pat_code']}'

           and (genre = 'org' or genre = 'orgpersoon')";



      $doe=(mysql_query($writePatientQry) && mysql_query($writePatientQry2) && mysql_query($deletePartners))

               or die("tpstopzettingsprobleem dankzij $writePatientQry of $writePatientQry2<br/>" . mysql_error());

    break;

    case "stopzettenMetEmail":

      require("../includes/tp_exclusie_sturen_oc.inc.php");

    case "stopzettenZonderEmail":

      $writePatientQry = "

        UPDATE

            patient_tp

        SET

            actief = 0,

            stopzetting_text='".$_POST['pat_stopzetting_text']."',

            stopzetting_cat='".$_POST['pat_stopzetting_cat']."',

            einddatum='".$_POST['einde_jj']."-".$_POST['einde_mm']."-".$_POST['einde_dd']."'

        WHERE

            patient='{$_SESSION['pat_code']}' and actief=1";

      $writePatientQry2 = "

         UPDATE

            patient

        SET

            actief = 0,

            stopzetting_text='".$_POST['pat_stopzetting_text']."',

            stopzetting_cat='".$_POST['pat_stopzetting_cat']."',

            einddatum=".$_POST['einde_jj'].$_POST['einde_mm'].$_POST['einde_dd']."

        WHERE

            code='{$_SESSION['pat_code']}'";

      $deletePartners = "

        DELETE FROM

           huidige_betrokkenen

        WHERE
           overleggenre = 'gewoon'
           and patient_code='{$_SESSION['pat_code']}'

           and (genre = 'org' or genre = 'orgpersoon')";



      $doe=(mysql_query($writePatientQry) && mysql_query($writePatientQry2) && mysql_query($deletePartners))

               or die("allesstopzettingsprobleem dankzij $writePatientQry of $writePatientQry2<br/>" . mysql_error());

    break;

    default:

      print_r($_POST);

      die("dit mag niet ");

  }



    if ($doe) {

      echo <<< EINDE

      <table><tr><td><div class="hidden" style="float:left;"><img src="../images/logo_top_pagina_klein.gif" width="100" height="120">&nbsp;</div></td>

    <td><h1>Archivering zorgplan<br /> {$_SESSION['pat_code']}</h1>

      <h2>op naam van {$_SESSION['pat_naam']} {$_SESSION['pat_voornaam']}</h2> </td></tr></table>



      <p>Met ingang van {$_POST['einde_dd']}/{$_POST['einde_mm']}/{$_POST['einde_jj']} werd dit

      dossier gearchiveerd om volgende reden:</p>



      <ul>

      <li><p>$reden</p></li>

EINDE;

      if ($_POST['pat_stopzetting_text'] !="") print("<li><p><em>{$_POST['pat_stopzetting_text']}</em></p> </li>");

      print("</ul>");

      $boodschap="<h3>Dit dossier is succesvol gearchiveerd.</h3></div>";

      $magPrinten = true;



    }

    else {

      $boodschap="We hebben dit dossier niet kunnen archiveren.";



    }

    print($boodschap);

    if ($magPrinten) print("<script type=\"text/javascript\">magPrinten = true;</script>");



  

}





    //---------------------------------------------------------

    /* Sluit Dbconnectie */ include("../includes/dbclose.inc");

    //---------------------------------------------------------



    print("</div>");

    print("</div>");

    print("</div>");

    include("../includes/footer.inc");

//    print("<div class=\"hidden\" style=\"float:left;\"><img src=\"../images/logo_top_pagina_klein.gif\" width=\"100\" height=\"120\"></div> ");

    print("</div>");

    print("</div>");

    print("</body>");

    print("</html>");

    }



//---------------------------------------------------------

/* Geen Toegang */ include("../includes/check_access.inc");

//---------------------------------------------------------

?>