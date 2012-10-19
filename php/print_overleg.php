<?php

session_start();

$paginanaam="Print een teamoverleg";







function eindePagina() {

	print("</div>");

	print("</div>");

	print("</div>");

	require("../includes/footer.inc");

	print("</div>");

	print("</div>");

    //---------------------------------------------------------

    /* Sluit Dbconnectie */ require("../includes/dbclose.inc");

    //---------------------------------------------------------

	print("</body>");

	print("</html>");



     //---------------------------------------------------------

     /* Geen Toegang */ require("../includes/check_access.inc");

     //---------------------------------------------------------

}





if (!(isset($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan"))) {

//---------------------------------------------------------------

/* Open Empty Html */ require('../includes/open_empty_html.inc');

//---------------------------------------------------------------



?>

    U bent niet geautoriseerd tot deze pagina.

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

/* Close Empty Html */ require('../includes/close_empty_html.inc');

//-----------------------------------------------------------------



exit;

}



//----------------------------------------------------------

/* Maak Dbconnectie */ require('../includes/dbconnect2.inc');

//----------------------------------------------------------



if (isset($_POST['pat_code']))

  $_SESSION['pat_code'] = $_POST['pat_code'];



$overlegID = $_GET['id'];

require("../includes/patientViaOverleg_geg.php");



if (!isset($_SESSION['pat_code'])) {

//---------------------------------------------------------------

/* Open Empty Html */ require('../includes/open_empty_html.inc');

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

/* Close Empty Html */ require('../includes/close_empty_html.inc');

//-----------------------------------------------------------------



exit;

}



// we hebben toegang tot de pagina én er is een patient geselecteerd







	require("../includes/html_html.inc");

	print("<head>");

	require("../includes/html_head.inc");

  print("<link rel=\"stylesheet\" type=\"text/css\" href=\"../css/domtab4.css\" />\n");

	print("</head>");

	print("<body>");

	print("<div align=\"center\">");

	print("<div class=\"pagina\">");

	require("../includes/header.inc");

	require("../includes/pat_id.inc");

	print("<div class=\"contents\">");

	require("../includes/menu.inc");

	print("<div class=\"main\">");

	print("<div class=\"mainblock\">");

	





   $patientHeader = patient_roepnaam_opOverleg($_SESSION['pat_code'], $_GET['id']);

   print("<h2 align=\"left\">Het zorgplan van $patientHeader</h2>");



   print("<h3>De afdrukbare documenten bij het overleg van {$_GET['datum']}.</h3>");

   $overlegInfo = getUniqueRecord("select * from overleg where id = {$_GET['id']}");
   
   if ($overlegInfo['afgerond']==1) {
     $tabel = "afgeronde";
     $voorwaarde = " bl.overleg_id = {$_GET['id']} ";
   }
   else {
     $tabel = "huidige";
     $voorwaarde = " bl.patient_code = \"{$_SESSION['pat_code']}\" ";
   }
   
   if ($overlegInfo['genre']=="psy")
     require("../includes/overleg_printoverzicht_psy.php");
   else
     require("../includes/overleg_printoverzicht.php");



  eindePagina();

?>

