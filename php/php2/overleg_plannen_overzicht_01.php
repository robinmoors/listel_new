<?php
session_start();
$paginanaam="Teamoverleg plannen";
if (IsSet($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan"))
	{
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

	//---------------------------------------------------------
	// Resetten van de aanwezigen (temp-veld bij de betroklijsten)
	$doe=mysql_query("UPDATE betroklijsthvl SET betrokhvl_temp=1 WHERE betrokhvl_pat_nr='".$_SESSION['pat_nr']."'");
	$doe=mysql_query("UPDATE betroklijstmz SET betrokmz_temp=1 WHERE betrokmz_pat_nr='".$_SESSION['pat_nr']."'");
	//---------------------------------------------------------

	print("<h1>Overleg plannen voor</h1>");
	print("<p><b>".$_SESSION['pat_id']." ".$_SESSION['pat_naam']."</b></p>
	<p>De volgende lijst van personen zijn betrokken bij dit zorgenplan.</p>");
	print("<p><b>Verwijder</b> uit onderstaande lijst de personen die <b>niet</b> aanwezig zullen zijn op het overleg.</p>");

	
	$OVG_OK=false;
	
	//---------------------------------------------------------
	/* Deelnemers ophalen */ include("../includes/samenstelling_overleg.php");
	//---------------------------------------------------------
	//---------------------------------------------------------
	/* Deelnemers ophalen */ include("../includes/deelnemers_ophalen.php");
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