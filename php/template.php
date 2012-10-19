<?php
require('../includes/dbconnect2.inc');
$paginanaam="Evaluatie ingeven";
if (isset($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan"))

	{
	require("../includes/html_html.inc");
	print("<head>");
	require("../includes/html_head.inc");
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
	
/* ---------------------------------
//
//     pagina content hier 
//
// -------------------------------*/	
	
	
	
//---------------------------------------------------------
/* Sluit Dbconnectie */ require("../includes/dbclose.inc");
//---------------------------------------------------------

	print("</div>");
	print("</div>");
	print("</div>");
	require("../includes/footer.inc");
	print("</div>");
	print("</div>");
	print("</body>");
	print("</html>");
	}

//---------------------------------------------------------
/* Geen Toegang */ require("../includes/check_access.inc");
//---------------------------------------------------------
?>