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



$patientInfo=mysql_fetch_array(mysql_query("SELECT * FROM patient WHERE code='{$_SESSION['pat_code']}'"));





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

    <form method="post">

       <input type="hidden" name="bevestiging" value="ja" />

       <input type="hidden" name="pat_stopzetting_cat" value="{$_POST['pat_stopzetting_cat']}" />

       <input type="hidden" name="pat_stopzetting_text" value="{$_POST['pat_stopzetting_text']}" />

       <input type="hidden" name="einde_jj" value="{$_POST['einde_jj']}" />

       <input type="hidden" name="einde_dd" value="{$_POST['einde_dd']}" />

       <input type="hidden" name="einde_mm" value="{$_POST['einde_mm']}" />

       <input type="hidden" name="stopzetting" value="{$_POST['stopzetting']}" />

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





if ($_POST['stopzetting'] == 'zorgplan' && $stopzettenMag) {

   $writePatientQry = "

        UPDATE

            patient

        SET

            actief = 0,

            stopzetting_text='".$_POST['pat_stopzetting_text']."',

            stopzetting_cat='".$_POST['pat_stopzetting_cat']."',

            einddatum=".$_POST['einde_jj'].$_POST['einde_mm'].$_POST['einde_dd']."

        WHERE

            code='{$_SESSION['pat_code']}'";

    $doe=mysql_query($writePatientQry) or die("zorgplanstopzettingsprobleem dankzij $writePatientQry <br/>" . mysql_error());



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