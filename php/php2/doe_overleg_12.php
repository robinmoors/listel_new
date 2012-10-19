<?php
session_start();
$paginanaam="Evaluatie wissen";
if (isset($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan"))
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
	include("../includes/pat_id.inc");
	print("<div class=\"contents\">");
	include("../includes/menu.inc");
	print("<div class=\"main\">");
	print("<div class=\"mainblock\">");

/* ---------------------------------
//
//     pagina content hier 
//
// -------------------------------*/	

//   include("../includes/toonSessie.inc");
	
	
	$qry = "delete from overleg where overleg_id = {$_GET['a_overleg_id']}";
	if (mysql_query($qry)) {
	   print("Dit overleg is verwijderd.");
	}
	else {
	  print("Shit, dit zou niet mogen voorkomen." . mysql_error() . " door $qry");
	}
	
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