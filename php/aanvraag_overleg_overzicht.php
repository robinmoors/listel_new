<?php

session_start();



$paginanaam="Overzicht van alle aanvragen voor een overleg";





    if (IsSet($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan")&&($_SESSION['profiel']=="listel"))

    {

    //----------------------------------------------------------

    /* Maak Dbconnectie */ include('../includes/dbconnect2.inc');

    //----------------------------------------------------------

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

    




    print("<h1>Overzicht van alle aanvragen voor een overleg</h1>");
?>
<p>Op deze pagina vind je alleen de nog-niet verwerkte aanvragen. <br/>
Voor een volledig overzicht kan je een statistiek in .csv opvragen.</p>
<form method="post" action="stats_aanvraag_overleg.php">

<table>
 <tr>
    <td>Begindatum</td>
    <td>
        <input type="text" name="begindag" size="3" style="width: 30px;" value="01"/> /
        <input type="text" name="beginmaand" size="3"  style="width: 30px;" value="01"/> /
        <input type="text" name="beginjaar" size="3"  style="width: 60px;" value="2011"/>
    </td>
<!--
 </tr>
 <tr>
-->
   <td>Einddatum</td>
   <td>
       <input type="text" name="einddag" size="3"  style="width: 30px;" value="31"/> /
       <input type="text" name="eindmaand" size="3"  style="width: 30px;" value="12"/> /
       <input type="text" name="eindjaar" size="3"  style="width: 60px;" value="2033"/>
   </td>
 </tr>

 <tr>
    <td colspan="2"><input type="submit" value=".csv-bestand opvragen"  /></td>
 </tr>
<!--
 <tr>
     <td colspan="2"><input type="checkbox" name="sep"  value=","> Selecteer wanneer Excel geen kolommen maakt.</td>
 </tr>
-->
</table>
</form>


<?php
    print( getAangevraagdeOverleggen("listel", 0,0));
    


    //---------------------------------------------------------

    /* Sluit Dbconnectie */ include("../includes/dbclose.inc");

    //---------------------------------------------------------

    print("<br/>&nbsp;</div>");

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