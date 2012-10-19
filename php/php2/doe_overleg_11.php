<?php
session_start();
$_SESSION['PREVPAGE'] = $_SERVER['SCRIPT_NAME'];


$paginanaam="Teamoverleg finaliseren";
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
	
//include("../includes/toonSessie.inc");


/*if (!isset($_SESSION['pat_naam']) || $_SESSION['pat_naam']=="") 
	{
	$queryPersoon = "select pat_naam, pat_voornaam from patienten, overleg 
                   where patienten.pat_nr = overleg.overleg_pat_nr 
	   			   and   overleg.overleg_id   = {$_GET['a_overleg_id']}";
	if ($result = mysql_query($queryPersoon)) 
		{ // && mysql_num_rows($result) == 1) {
		$rij = mysql_fetch_array($result);
		$_SESSION['pat_naam'] = $rij['pat_naam'];
		$_SESSION['pat_voornaam'] = $rij['pat_voornaam'];
  		}				  
	else 
		{
    	print("fout bij ophalen van patientgegeven " . mysql_error() );
		}
	}*/

	//----------------------------------------------------------
	/* Maak Dbconnectie */ include('../includes/patient_geg.php');
	//----------------------------------------------------------

	//----------------------------------------------------------
	// Hulpverleners verwijderen uit overleg
	if (isset($a_wismz_id))
		{$doe=mysql_query("UPDATE betroklijstmz SET betrokmz_temp=0 WHERE betrokmz_id=".$a_wismz_id);}
	if (isset($a_wishvl_id))
		{$doe=mysql_query("UPDATE betroklijsthvl SET betrokhvl_temp=0 WHERE betrokhvl_id=".$a_wishvl_id);}
	//----------------------------------------------------------

	//---------------------------------------------------------
	// Resetten van de aanwezigen (temp-veld bij de betroklijsten)
	if ($_POST['resetter'] == 1) 
		{
		$doe=mysql_query("UPDATE betroklijsthvl SET betrokhvl_temp=1 WHERE betrokhvl_pat_nr='".$_SESSION['pat_nr']."'");
		$doe=mysql_query("UPDATE betroklijstmz SET betrokmz_temp=1 WHERE betrokmz_pat_nr='".$_SESSION['pat_nr']."'");
		}
	//---------------------------------------------------------




	print("<h1>Overleg plannen voor</h1>");
	print("<p><b>".$_SESSION['pat_id']." ".$_SESSION['pat_naam']."</b></p>
	<p>De volgende lijst van personen zijn betrokken bij dit zorgenplan.</p>");
	print("<p><b>Verwijder</b> uit onderstaande lijst de personen die <b>niet</b> aanwezig zullen zijn op het overleg.</p>");

	//---------------------------------------------------------
	/* Deelnemers ophalen */ include("../includes/samenstelling_overleg.php");
	//---------------------------------------------------------
	
	//---------------------------------------------------------
	/* Deelnemers ophalen */ include("../includes/deelnemers_ophalen_twee.php");
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