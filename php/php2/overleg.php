<?php

session_start();

$paginanaam="Werken aan het teamoverleg";





if (isset($_POST['pat_nr']))

  $_SESSION['pat_nr'] = $_POST['pat_nr'];



if (!isset($_SESSION['pat_nr'])) {

 //---------------------------------------------------------------

/* Open Empty Html */ include('../includes/open_empty_html.inc');

//---------------------------------------------------------------



?>

    Deze pagina is enkel toegankelijk wanneer u een patient geselecteerd hebt.

    U wordt dadelijk terug gestuurd naar de listel-site waar u links uit het menu een keuze kan maken.

    <script type="text/javascript">

     function redirect()

     {

         <?php print("document.location = \"/\";"); ?>

     }

     setTimeout("redirect()",500);



    </script>



<?php

//-----------------------------------------------------------------

/* Close Empty Html */ include('../includes/close_empty_html.inc');

//-----------------------------------------------------------------



}

else if (IsSet($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan"))

    {

    $_SESSION['katzRetour'] = "overleg.php";

    //----------------------------------------------------------

    /* Maak Dbconnectie */ include('../includes/dbconnect.inc');

    //----------------------------------------------------------

    include("../includes/html_html.inc");

    print("<head>");

    include("../includes/html_head.inc");

    print("</head>");

    print("<body>");

    print("<div align=\"center\">");

    print("<div class=\"pagina\">");

    include("../includes/header.inc");

    include("../includes/kruimelpad.inc");

    print("<div class=\"contents\">");

    include("../includes/menu.inc");

    print("<div class=\"main\">");

    print("<div class=\"mainblock\">");

    

if (isset($_GET['actie'])) $_SESSION['actie'] = $_GET['actie'];



    //----------------------------------------------------------

    /* Maak Dbconnectie */ include('../includes/patient_geg.php');

    //----------------------------------------------------------





if ($_SESSION['actie'] == "afsluiten" || $_SESSION['actie'] == "bewerken") {

    $huidigOverleg=mysql_query("SELECT * FROM overleg WHERE overleg_pat_nr=".$_SESSION['pat_nr']." AND overleg_type=0");

    if (0==mysql_num_rows($huidigOverleg)) {

       print("<h2>Probleem</h2><p>Er is g&eacute;&eacute;n overleg gepland voor <strong>{$_SESSION['pat_id']} {$_SESSION['pat_naam']}</strong>.<br />We kunnen het overleg dan ook niet {$_SESSION['actie']}.");

       print("</p><p>Maak een andere keuze uit het menu links.</p>");

           //---------------------------------------------------------

           /* Sluit Dbconnectie */ include("../includes/dbclose.inc");

           //---------------------------------------------------------

       print("</div>");

       print("</div>");

       print("</div>");

       include("../includes/footer.inc");

       print("</div>");

       print("</div>");

       print("</body>");

       die("</html>");

    }

    else {

       $overleg = mysql_fetch_array($huidigOverleg);

       $_SESSION['overleg_id'] = $overleg['overleg_id'];

    }

}



// leeg overleg maken wanneer actie == nieuw



if ($_SESSION['actie'] == "nieuw") {

    // patient_id maken adhv de datum van het eerste overleg

    $aantal=mysql_num_rows(mysql_query("SELECT * FROM overleg WHERE overleg_pat_nr=".$_SESSION['pat_nr']." AND (overleg_type=4 OR overleg_type=0)"));

    // $aantal bevat het aantal huidige of afgeronde overleggen

    if ($aantal==0)

        {

        $patient_id=substr($_SESSION['pat_id'],0,6).$_POST['overleg_jj'].$_POST['overleg_mm'].

                            $_POST['overleg_dd'].substr($_SESSION['pat_id'],12,7);

        if ($_POST['overleg_jj'] > 90 && $_POST['overleg_jj'] < 1900) {

           $startDatum = "19{$_POST['overleg_jj']}{$_POST['overleg_mm']}{$_POST['overleg_dd']}";

        }

        else if ($_POST['overleg_jj'] <= 99) {

           $startDatum = "20". "{$_POST['overleg_jj']}{$_POST['overleg_mm']}{$_POST['overleg_dd']}";

        }

        else {

           $startDatum = "{$_POST['overleg_jj']}{$_POST['overleg_mm']}{$_POST['overleg_dd']}";

        }



        $_SESSION['pat_id']=$patient_id;

        $_SESSION['eersteOverleg']=true;

        $updateQuery = "UPDATE patienten SET pat_id='$patient_id', pat_startdatum = $startDatum  WHERE pat_nr={$_SESSION['pat_nr']};";



        $doequery=mysql_query($updateQuery);

        //print("<h1>$updateQuery " . mysql_error() . "</h1>");

        }

    else {

        $_SESSION['eersteOverleg']=false;

    }



    //----------------------------------------------------------

    // een overlegrecord starten

    $overlegQry="

        INSERT INTO

            overleg

                (overleg_datum,

                overleg_pat_nr,

                overleg_instemming,

                overleg_afwezig,

                overleg_locatie_id)

        VALUES

                (20".$_POST['overleg_jj'].$_POST['overleg_mm'].$_POST['overleg_dd'].",".

                $_SESSION['pat_nr'].",{$_POST['overleg_instemming']},{$_POST['overleg_afwezig']},{$_POST['overleg_locatie_id']})";

        $_SESSION['overleg_dd'] = $_POST['overleg_dd'];

        $_SESSION['overleg_mm'] = $_POST['overleg_mm'];

        $_SESSION['overleg_jj'] = $_POST['overleg_jj'];

        $result=mysql_query($overlegQry);

        $_SESSION['overleg_id']=mysql_insert_id(); 

        $a_overleg_id = mysql_insert_id();

        //print($overlegQry);// $_SESSION['overleg_id']

    //----------------------------------------------------------

    //----------------------------------------------------------

    // een blanco taakfiche aanmaken

        $taakficheQry="

        INSERT INTO

            taakfiche

                (taakf_overleg_id)

        VALUES

                (".$_SESSION['overleg_id'].")";

        $result=mysql_query($taakficheQry);

    //----------------------------------------------------------

    //----------------------------------------------------------

    // een blanco KATZ aanmaken

        $passlength = 16;

        $pass = "";

        $i = 0;

        while($i <= $passlength)

        {

        $pass .= chr(rand(65,90));

        $i++;

        }

        $KatzQry="

        INSERT INTO

            katz

                (katz_totaal,katz_code,katz_overleg_id)

        VALUES

                (-1,'".$pass."',".$_SESSION['overleg_id'].")";

        $result=mysql_query($KatzQry);

    //----------------------------------------------------------

    $_SESSION['actie'] = "halfnieuw";

}

// einde leeg overleg aanmaken





    if (isset($_GET['a_overleg_id'])) {

      $a_overleg_id =  $_GET['a_overleg_id'];

      $_SESSION['overleg_id'] = $a_overleg_id;

    }

    else if (isset($_SESSION['overleg_id']))  {

      $a_overleg_id = $_SESSION['overleg_id'];

    }

    else {

      $qry =  mysql_query("SELECT * FROM overleg WHERE overleg_pat_nr=".$_SESSION['pat_nr']." AND overleg_type=0");

      $qryResult = mysql_fetch_array($qry);

      $a_overleg_id = $qryResult['overleg_id'];

      $_SESSION['overleg_id'] = $a_overleg_id;

    }



    // aanduiden of ze een GDT willen of niet

    if (isset($_POST['wilGDT'])) {

       $queryGDT = "update overleg set overleg_wilGDT = 1 where overleg_id = {$_SESSION['overleg_id']}";

       $_SESSION['wilGDT'] = 1;

    }

    else if (isset($_POST['geenGDT'])) {

       $queryGDT = "update overleg set overleg_wilGDT = 0 where overleg_id = {$_SESSION['overleg_id']}";

       $_SESSION['wilGDT'] = 0;

    }

    else if (isset($_POST['wisGDT'])) {

       $queryGDT = "update overleg set overleg_wilGDT = -1 where overleg_id = {$_SESSION['overleg_id']}";

       unset($_SESSION['wilGDT']);

    }



    if (isset($queryGDT)) {

       mysql_query($queryGDT);

    }

    else {

       $rijGDT = mysql_fetch_row(mysql_query("select overleg_wilGDT from overleg where overleg_id = {$_SESSION['overleg_id']}"));

       $_SESSION['wilGDT'] = $rijGDT[0];

    }







    $queryOverleg = "select * from overleg

                   where overleg.overleg_id = $a_overleg_id";

    if ($resultOverleg = mysql_query($queryOverleg))

        { // && mysql_num_rows($result) == 1) {

        $rijOverleg = mysql_fetch_array($resultOverleg);

        $huidigeDatum = $rijOverleg['overleg_datum'];

        $eersteDatum = substr($_SESSION['pat_id'],6,6);

        if ($eersteDatum > 900000) // overleg na 90, dus eigenlijk

          $eersteDatum = "19" . $eersteDatum;

        else {

          $eersteDatum = "20" . $eersteDatum;

        }

        if ($eersteDatum == $huidigeDatum) {

          $_SESSION['eersteOverleg'] = true;

        }

        else {

          $_SESSION['eersteOverleg'] = false;

        }

        

         $langeDatum = $rijOverleg['overleg_datum'];

         $_SESSION['overleg_dd'] = substr($langeDatum, 6,2);

         $_SESSION['overleg_mm'] = substr($langeDatum, 4,2);

         $_SESSION['overleg_jj'] = substr($langeDatum, 0,4);

         $katzScore = $rijOverleg['overleg_katzscore'];

        }

    else 

        {

        print("fout bij ophalen van patientgegeven $queryOverleg " . mysql_error() );

        }



        



    //----------------------------------------------------------

    // Hulpverleners aan- of afmelden op het overleg

    if (isset($a_stopmz_id))

        {$doe=mysql_query("DELETE from betroklijstmz WHERE betrokmz_pat_nr = {$_SESSION['pat_nr']} AND betrokmz_id=$a_stopmz_id");}

    if (isset($a_wismz_id))

        {$doe=mysql_query("UPDATE betroklijstmz SET betrokmz_temp=0 WHERE betrokmz_pat_nr = {$_SESSION['pat_nr']} AND betrokmz_id=$a_wismz_id");}

    if (isset($a_plusmz_id))

        {$doe=mysql_query("UPDATE betroklijstmz SET betrokmz_temp=1 WHERE betrokmz_pat_nr = {$_SESSION['pat_nr']} AND betrokmz_id=$a_plusmz_id");}

    if (isset($a_stophvl_id))

        {$doe=mysql_query("DELETE from betroklijsthvl WHERE betrokhvl_pat_nr = {$_SESSION['pat_nr']} AND betrokhvl_id=$a_stophvl_id");}

    if (isset($a_wishvl_id))

        {$doe=mysql_query("UPDATE betroklijsthvl SET betrokhvl_temp=0 WHERE betrokhvl_pat_nr = {$_SESSION['pat_nr']} AND betrokhvl_id=$a_wishvl_id");}

    if (isset($a_plushvl_id))

        {$doe=mysql_query("UPDATE betroklijsthvl SET betrokhvl_temp=1 WHERE betrokhvl_pat_nr = {$_SESSION['pat_nr']} AND betrokhvl_id=$a_plushvl_id");}

    //----------------------------------------------------------



    //---------------------------------------------------------

    // Resetten van de aanwezigen (temp-veld bij de betroklijsten)

    if ($_POST['resetter'] == 1) 

        {

        $doe=mysql_query("UPDATE betroklijsthvl SET betrokhvl_temp=1 WHERE betrokhvl_pat_nr='".$_SESSION['pat_nr']."'");

        $doe=mysql_query("UPDATE betroklijstmz SET betrokmz_temp=1 WHERE betrokmz_pat_nr='".$_SESSION['pat_nr']."'");

        }

    //---------------------------------------------------------





    $dag = $_SESSION['overleg_dd'];

    $maand = $_SESSION['overleg_mm'];

    $jaar = $_SESSION['overleg_jj'];



    $patientHeader =  "<b>".$_SESSION['pat_id']." ".$_SESSION['pat_naam']."</b></h3>";

    if ($_SESSION['eersteOverleg'] && ($_SESSION['actie']== "nieuw" || $_SESSION['actie'] == "halfnieuw")) {

       print("<h3>Plan een eerste overleg op $dag/$maand/$jaar voor $patientHeader");

       print("<p style='text-align:justify'>Selecteer hieronder de betrokkenen bij deze patient door op het plus-icoontje te klikken.<br />");

       print("Vink daarna de aanwezigen aan zodat ze in het groen komen, of voeg de nodige zorg- en hulpverleners toe.<br />");

       print("<p style='text-align:justify'>Onderaan de pagina kan je de knop indrukken om dit document af te drukken. Gebruik het tijdens het overleg;

                 aanwezigen moeten tekenen. Na het overleg breng je indien nodig correcties aan wat betreft aanwezigen. Je voegt eventuele onverwachte aanwezigen op dezelfde wijze toe

                 en/of zet hieronder de afwezigen in het rood door het vinkje af te zetten.</p>");

      print("<p style='text-align:justify'>Het systeem geeft ook aan of het overleg in aanmerking komt voor een zorgenplan of een vergoedbaar overleg.");

    }

    else if ($_SESSION['actie'] == "nieuw" ||  $_SESSION['actie'] == "halfnieuw") {

       print("<h3>Planning nieuw Overleg op $dag/$maand/$jaar voor $patientHeader");

       print("<p style='text-align:justify'>Vink de betrokken aan die aanwezig zullen zijn op het overleg zodat ze in het groen komen,<br />of voeg de nodige zorg- en hulpverleners toe.<br />");

       print("<p style='text-align:justify'>Wanneer je onderaan naar de volgende stap gaat, kan je dit document afdrukken. Gebruik het tijdens het overleg;

                 aanwezigen moeten tekenen. Na het overleg zet je hieronder de afwezigen in het rood door het vinkje af te zetten.</p>");

    }

    else if ($_SESSION['actie'] == "bewerken") {

       print("<h3>Overleg van $dag/$maand/$jaar ");

       print(" bewerken voor $patientHeader");

       print("<p>Zet in onderstaande lijst bij de aanwezigen een vinkje.");

       print("<br>De aanwezigen komen in het groen, de afwezigen in het rood.</p>");

    }

    else if ($_SESSION['actie'] == "afsluiten") {

       print("<h3>Overleg van $dag/$maand/$jaar ");

       print(" afronden voor $patientHeader");

       print("<p>Zet in onderstaande lijst bij de aanwezigen een vinkje.");

       print("<br>De aanwezigen komen in het groen, de afwezigen in het rood.</p>");

    }



    if ($_SESSION['wilGDT']==1) print("<p>Dit overleg moet uitmonden in een aanvraag tot vergoeding van het overleg.</p>");









    //---------------------------------------------------------

    /* Deelnemers ophalen */ include("samenstelling_overleg.php");

    //---------------------------------------------------------

    

    //---------------------------------------------------------

    /* Deelnemers ophalen */ include("deelnemers_ophalen_drie.php");

    //---------------------------------------------------------



    //---------------------------------------------------------

    /* Sluit Dbconnectie */ include("../includes/dbclose.inc");

    //---------------------------------------------------------

    print("</div>");

    print("</div>");

    print("</div>");

    include("../includes/footer.inc");

    print("</div>");

    print("</div>");

    print("</body>");

    print("</html>");

    }

//---------------------------------------------------------

/* Geen Toegang */ include("../includes/check_access.inc");

//---------------------------------------------------------

?>