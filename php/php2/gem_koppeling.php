<?php
//----------------------------------------------------------
/* Maak Dbconnectie */ require('../includes/dbconnect2.inc');
//----------------------------------------------------------

$paginanaam="Overlegcoordinators toevoegen aan gemeenten";
require("../includes/clearSessie.inc");
if (IsSet($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan"))
    {
    require("../includes/html_html.inc");
    print("<head>");
    require("../includes/html_head.inc");

//-----------------------------------------------------------------------------
/* Controle numerieke velden */ require("../includes/checkForNumbersOnly.inc");
//-----------------------------------------------------------------------------
//-----------------------------------------------------------------
/* Maak gemeenteLijst */ require('../includes/list_gemeentes.php');
//-----------------------------------------------------------------
//---------------------------------------------------------------------
/* Maak mutLijst */ require('../includes/list_mutualiteiten.php');
//---------------------------------------------------------------------

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

//---------------------------------------------------------------------
echo "<fieldset>";
echo "<div class=\"legende\">Overlegcoordinators toevoegen aan gemeenten</div><br />";
echo "U kan meerdere gemeentes selecteren dmv CTRL + aanklikken / Selecteren dmv muis selectie of slepen.<br /><br />";

// Als men op de knop toevoegen duwt voer dit uit
if($_POST['do_add']) {

// Haal lijstje op van gekozen gemeenten
foreach($_POST['gid'] as $key => $value) { 
 	$insert_sql = "INSERT INTO gemeentekoppeling (overlegcoord_id, gemeente_id) VALUES ('".$_GET['oid']."', '".$value."')";
	$insert_query = mysql_query($insert_sql);
   } 
	// Spring terug naar pagina
	header("Location: gem_koppeling.php?oid=".$_GET['oid']."");
	
} elseif($_GET['actie'] == "delete") {
	$delete_sql = "DELETE FROM gemeentekoppeling WHERE gemeente_id='".$_GET['gid']."'";
	$delete_query = mysql_query($delete_sql) or die(mysql_error());
	// Spring terug naar pagina
	header("Location: gem_koppeling.php?oid=".$_GET['oid']."");

} else {


// Select Gemeenten
if(!isset($_GET['oid'])) {
	$_GET['oid'] = -1;
}
$select_gem = "SELECT gemeente.id, dlzip, dlnaam FROM gemeente, logins WHERE logins.profiel = 'OC' and gemeente.sit_id = logins.sit_id AND logins.id = ".$_GET['oid']." ORDER BY dlnaam ASC";
$query_gem = mysql_query($select_gem) or die(mysql_error());

// Select Coord
$select_coor = "SELECT id, sit_id, naam, voornaam FROM logins  ORDER BY naam ASC";
$query_coor = mysql_query($select_coor) or die(mysql_error());

// Tabel weergeven
echo "<form method=\"post\" name='form'>";
echo "<table>";
echo "<tr>";


echo "<td valign=\"top\">";
echo "<strong>Overlegcoordinator:</strong><br />";
echo "<select name=\"oid\" style=\"width: 200px;\" onChange=\"window.location.href='gem_koppeling.php?oid=' + this.value\">\n";

// Coordinators weergeven
while($coor = mysql_fetch_object($query_coor)) {
	if($coor->id == $_GET['oid']) {
		$selected = "selected=\"selected\"";
	} else {
		$selected = "";
	}
	echo "<option value=\"".$coor->id."\" $selected>".$coor->naam." ".$coor->voornaam."</option>\n";
}
echo "</select>\n";
echo "<br /><br />";
echo "<strong>Overzicht Gemeentes door deze Overlegcoordinator:</strong><br />";


// Geef de lijst van gemeentekoppelingen weer
$select_gemkop = "SELECT l.id AS l_id, l.dlzip AS l_dlzip, l.dlnaam AS l_dlnaam FROM gemeentekoppeling gk LEFT JOIN gemeente l on l.id=gk.gemeente_id WHERE overlegcoord_id = ".$_GET['oid']."";
$query_gemkop = mysql_query($select_gemkop);

// Rijen tellen en melding geven
$rows = mysql_num_rows($query_gemkop);
if($rows == "0") {
	echo "Aan deze overlegcoordinator zijn nog geen gemeentes toegewezen.";
}

while($row = mysql_fetch_object($query_gemkop)) {
	echo $row->l_dlzip ." ".$row->l_dlnaam." - <a href=\"?actie=delete&gid=".$row->l_id."&oid=".$_GET['oid']."\">wis</a><br />";
}

echo "</td>";


echo "<td>";
echo "<strong>Overzicht gemeentes SIT:</strong><br />";
echo "<select name=\"gid[]\" size=\"10\" multiple=\"multiple\" style=\"width: 300px;\">";
// Gemeentes weergeven
while($gem = mysql_fetch_object($query_gem)) {
	echo "<option value=\"".$gem->id."\">".$gem->dlzip." ".$gem->dlnaam."</option>";
}
echo "</select>";
echo "<input type=\"submit\" value=\"VOEG TOE\" name=\"do_add\"><br /><br />";

echo "</td>";

// Tabel sluiten
echo "</tr>";
echo "</table>";
echo "</form>";

echo "</fieldset>";
}


//---------------------------------------------------------------------

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