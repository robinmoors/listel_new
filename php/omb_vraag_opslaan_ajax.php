<?php
session_start();   // $_SESSION['pat_code']


$paginanaam="NVT: ombvraag opslaan met ajax";

if (!(isset($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan"))) {
  print("KO;Geen toegang");
}
else if (!(isset($_GET['code']))) {
  print("KO;Geen gegevens");
}
else {
  //----------------------------------------------------------
  /* Maak Dbconnectie */ require('../includes/dbconnect2.inc');
  //----------------------------------------------------------


  if (isset($_GET['code']))
      mysql_query("update patient set omb_actief = {$_GET['omb_actief']} where code = '{$_GET['code']}'") or die("0probleem met update overleg");
  if (isset($_GET['overlegID']))
      mysql_query("update overleg set omb_actief = {$_GET['omb_actief']} where id = '{$_GET['overlegID']}'") or die("0probleem met update overleg");

  //---------------------------------------------------------
  /* Sluit Dbconnectie */ require("../includes/dbclose.inc");
  //---------------------------------------------------------
}
     print("OK");


?>
