<?php
session_start();   // $_SESSION['pat_code']

$paginanaam="NVT: ombvergoedbaarheid instellen";

if (!(isset($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan"))||($_SESSION['profiel']!="listel")) {
  print("KO;Geen toegang");
}
else if (!(isset($_GET['id']))) {
  print("KO;Geen gegevens");
}
else {
  //----------------------------------------------------------
  /* Maak Dbconnectie */ require('../includes/dbconnect2.inc');
  //----------------------------------------------------------

  if (mysql_query("update omb_registratie set voorCAW = 1 where id = {$_GET['id']}")) {
    print("OK");
  }
  else {
    print(mysql_error());
  }

  //---------------------------------------------------------
  /* Sluit Dbconnectie */ require("../includes/dbclose.inc");
  //---------------------------------------------------------
}
?>
