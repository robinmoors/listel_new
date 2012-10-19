<?php
session_start();
$paginanaam="Patientgegevens toevoegen";
if (IsSet($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan"))
	{

//----------------------------------------------------------
/* Maak Dbconnectie */ include('../includes/dbconnect.inc');
//----------------------------------------------------------

	include("../includes/html_html.inc");
	print("<head>");
	include("../includes/html_head.inc");
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
?>
	
	<h1>Evaluatie niet mogelijk</h1>
	<p>Aangezien er nog geen goedgekeurd overleg was voor deze patient is het onmogelijk om een evaluatie te doen</p>

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
/* Geen Toegang */ include("../includes/check_access.inc");
//---------------------------------------------------------
?>