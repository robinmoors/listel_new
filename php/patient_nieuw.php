<?php



	// robin

//----------------------------------------------------------

/* Maak Dbconnectie */ require('../includes/dbconnect2.inc');

//----------------------------------------------------------



$paginanaam="Patientgegevens toevoegen";



include("../includes/clearSessie.inc");



if ( isset($_SESSION["toegang"]) && ($_SESSION["toegang"] == "toegestaan") ){

    



    include("../includes/html_html.inc");



    print("<head>");



    include("../includes/html_head.inc");



//-----------------------------------------------------------------------------

/* Controle numerieke velden */ require("../includes/checkForNumbersOnly.inc");

//-----------------------------------------------------------------------------

//-----------------------------------------------------------------

/* Maak gemeenteLijst */ require('../includes/list_gemeentes.php');

//-----------------------------------------------------------------

//---------------------------------------------------------------------

$mutOnbepaald = "NIET";
/* Maak mutLijst */ require('../includes/list_mutualiteiten.php');

//---------------------------------------------------------------------



    print("</head>");

    print("<body>");

    print("<div align=\"center\">");

    print("<div class=\"pagina\">");



    include("../includes/header.inc");

    include("../includes/pat_id.inc");



    print("<div class=\"contents\">");



    include("../includes/menu.inc");



    print("<div class=\"main\">");

    print("<div class=\"mainblock\">");



//---------------------------------------------------------------------

/* Toon form patientgegevens */ require('../forms/patientgegevens.php');

//---------------------------------------------------------------------



//---------------------------------------------------------

/* Sluit Dbconnectie */ require("../includes/dbclose.inc");

//---------------------------------------------------------

?>

<div style="text-align:left">
<?php
if ($_SESSION['profiel']!="psy") {
?>
   <p>
(*) Onder <b>PVS-pati&euml;nt</b> verstaat men de persoon die tengevolge van een
            acute hersenbeschadiging (ernstige schedeltrauma, hartstilstand, aderbloeding, ...),
            gevolgd door een coma, waarbij de ontwaaktechnieken de situatie niet hebben kunnen
            verbeteren, een volgende status behoudt:
            <ul style="display:inline;">
            <li>ofwel een persisterende neurovegetatieve status, waarbij de pati&euml;nt getuigt van
            geen enkele vorm van bewustzijn van zichzelf of de omgeving en niet in staat is
            om met anderen te communiceren en dat sinds minstens 3 maanden;</li>
            <li>ofwel een minimaal responsieve status (MRS), die verschilt van de
            neurovegetatieve status, omdat de pati&euml;nt zich in een bepaald opzicht van
            zichzelf en de omgeving bewust is.</ul>
</p>
<!--
<p>
(**) Voor pati&euml;nten met verminderde psychische zelfredzaamheid is er <strong>NOOIT vergoeding voor deelnemers</strong>,
    enkel een vergoeding voor de organisator van het overleg indien
    het voldoet aan de dezelfde voorwaarden als voor MVO.<br/>
</p>
-->
<?php
}
?>
<p>
(***) De pati&euml;nt geeft toestemming aan het ziekenhuis om zijn identificatiegegevens en de gegevens van zijn zorgbemiddelaar
      op te vragen bij opname in het ziekenhuis met als doel informatie uit te wisselen tussen het ziekenhuis en het zorgteam.
<br/>
<!--
      Sinds oktober 2011 kunnen ziekenhuizen opzoeken of een pati&euml;nt een zorgplan heeft
      om het zorgteam in te lichten bij ontslag. De pati&euml;nt moet hiervoor zijn toestemming geven.
-->
   </p>
</div>
            
            
<?php
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
/* Geen Toegang */ require("../includes/check_access.inc");
//---------------------------------------------------------

?>