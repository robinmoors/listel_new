<?php

    //----------------------------------------------------------

    /* Maak Dbconnectie */ include('../includes/dbconnect2.inc');

	//----------------------------------------------------------

	

include("../includes/clearSessie.inc");





if ($_SESSION['tp_project']==$_TP_FOR_K) {

  $bestemmingVerslag = "FOD";

}

else {

  $bestemmingVerslag = "RIZIV";

}



$paginanaam="Verslag $bestemmingVerslag opvragen TP";









if (isset($_SESSION["toegang"]) && ($_SESSION["toegang"]=="toegestaan")){

    

    $_SESSION['pat_code']="";

    $_SESSION['pat_naam']="";

    $_SESSION['pat_voornaam']="";



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



    print (" <h1>Verslag $bestemmingVerslag (PDF)</h1>	");



    print("<p>Druk af en vul de ontbrekende gegevens met de hand in.</p>");

    print("<ul>");



    for ($jaar = date("Y"); $jaar >= 2008; $jaar--) {

        $volgendJaar = $jaar+1;

        print("<li><a href=\"$siteadresPDF/php/stats_TP.php?beginjaar=$jaar&beginmaand=04&begindag=01&eindjaar=$volgendJaar&eindmaand=03&einddag=31\">$bestemmingVerslag-verslag van 01/04/$jaar tot 31/03/$volgendJaar</a></li>");

    }

    

    $jaar = 2007;

    $volgendJaar = $jaar+1;

    print("<li><a href=\"$siteadresPDF/php/stats_TP.php?beginjaar=$jaar&beginmaand=04&begindag=01&eindjaar=$volgendJaar&eindmaand=03&einddag=31\">$bestemmingVerslag-verslag van 01/04/$jaar tot 31/03/$volgendJaar</a></li>");





    print("</ul>");



    print (" <h1>CSV-tabelleke voor $bestemmingVerslag (CSV voor gebruik in Excel)</h1>	");



    print("<ul>");



    for ($jaar = date("Y"); $jaar >= 2008; $jaar--) {

        $volgendJaar = $jaar+1;

        print("<li><a href=\"$siteadresPDF/php/stats_TP_tabel.php?beginjaar=$jaar&beginmaand=04&begindag=01&eindjaar=$volgendJaar&eindmaand=03&einddag=31\">Tabel van 01/04/$jaar tot 31/03/$volgendJaar</a></li>");

    }



    $jaar = 2007;

    $volgendJaar = $jaar+1;

    print("<li><a href=\"$siteadresPDF/php/stats_TP_tabel.php?beginjaar=$jaar&beginmaand=04&begindag=01&eindjaar=$volgendJaar&eindmaand=03&einddag=31\">Tabel van 01/04/$jaar tot 31/03/$volgendJaar</a></li>");





    print("</ul>");



    print ("<br/><br/><br/> <h2>Statistieken over de bijkomende vragen (PDF)</h2>	");



    print("<p>Daarnaast kan je ook statistieken bekijken voor de bijkomende vragen van je project.</p>");

    print("<ul>");



    for ($jaar = date("Y"); $jaar >= 2008; $jaar--) {

        $volgendJaar = $jaar+1;

        print("<li><a href=\"$siteadresPDF/php/stats_TP_bijkomend.php?beginjaar=$jaar&beginmaand=04&begindag=01&eindjaar=$volgendJaar&eindmaand=03&einddag=31\">Statistiek van de bijkomende vragen van 01/04/$jaar tot 31/03/$volgendJaar</a></li>");

    }



    $jaar = 2007;

    $volgendJaar = $jaar+1;

    print("<li><a href=\"$siteadresPDF/php/stats_TP_bijkomend.php?beginjaar=$jaar&beginmaand=04&begindag=01&eindjaar=$volgendJaar&eindmaand=03&einddag=31\">Statistiek van de bijkomende vragen van 01/04/$jaar tot 31/03/$volgendJaar</a></li>");



    print ("</ul><br/><br/><br/> <h2>Volledig (intern) overzicht (CSV)</h2>	");



    print("<p>Ter info kan je ook alles bekijken wat er in de database opgeslagen is.</p>");

    print("<li><a href=\"stats_TP_alles_intern.php\">Intern databaseoverzicht");

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

    /* Sluit Dbconnectie */ include("../includes/dbclose.inc");

    //---------------------------------------------------------



//---------------------------------------------------------

/* Geen Toegang */ include("../includes/check_access.inc");

//---------------------------------------------------------

?>