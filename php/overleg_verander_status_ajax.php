<?php
session_start();   // $_SESSION['pat_code']

$paginanaam="NVT: aanwezigheid van deelnemers aanpassen";

if (!(isset($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan"))||($_SESSION['profiel']!="listel")) {
  print("KO;Geen toegang");
}
else if (!(isset($_SESSION["pat_code"]))) {
  print("KO;Geen patient");
}
else if (!(isset($_GET['veld']))) {
  print("KO;Geen gegevens");
}
else {

  //----------------------------------------------------------
  /* Maak Dbconnectie */ require('../includes/dbconnect2.inc');
  //----------------------------------------------------------

  $update = "update overleg set {$_GET['veld']} = {$_GET['waarde']} where id = {$_GET['overlegID']}";
  $updateGelukt = mysql_query($update);

  if ($updateGelukt) {
    print("OK;");
  }
  else {
    print("KO;foute query");
  }

  //---------------------------------------------------------
  /* Sluit Dbconnectie */ require("../includes/dbclose.inc");
  //---------------------------------------------------------
}
?>
