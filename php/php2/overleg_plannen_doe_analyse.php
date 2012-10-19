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
	
	print("<h1>Overleg plannen</h1>");
	
	print("<p>Voor <b>".$_SESSION['pat_id']." ".$_SESSION['pat_naam']." ".$_SESSION['pat_voornaam']."</b>.</p>");
	
	//---------------------------------------------------------
	// Blanco Evaluatieinstrumentrecord aanmaken
	$doe=mysql_query("
		INSERT INTO evalinstr (ei_overleg_id) VALUES (".$_SESSION['overleg_id'].")");
		$_SESSION['ei_id']=mysql_insert_id ();
	//---------------------------------------------------------
	$katzok=($_SESSION['katz_totaal']>4)?"okay":"niet okay";
	if ($_SESSION['aantal_teamoverleg']==0)
		{
		print("
			<p>Aangezien dit het eerste overleg is voor deze hulpbehoevende en dit dus de
			opstart van een zorgenplan betreft, is het noodzakelijk dat er voldaan is
			aan volgende eisen:</p><ul>
				<li>een KATZ-score van minimaal 5 huidige score is ".$_SESSION['katz_totaal']." dus <b>".$katzok."</b></li>
				<li>een vertegenwoordiging van de juiste personen op het eerste overleg</li></ul>
			<p>alvorens de nodige documenten geprint kunnen worden.</p>");
		}
?>
<form action="ingeven_evaluatie_instr_01.php" method="post"><input type="submit" value="Vul evaluatieinstrument in" name="submit" /></form>&nbsp;&nbsp;
<form action="doe_overleg_11.php" method="post"><input type="submit" value="Evaluatieinstrument overslaan" name="submit" /></form>
<?php
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