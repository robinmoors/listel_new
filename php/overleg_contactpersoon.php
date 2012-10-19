<?php
session_start();   // $_SESSION['pat_code']

$paginanaam="NVT: contactpersoon aanpassen";

if (!(isset($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan"))) {
  print("KO;Geen toegang");
}
else if (!(isset($_SESSION["pat_code"]))) {
  print("KO;Geen patient");
}
else if (!(isset($_GET['id']))) {
  print("KO;Geen gegevens");
}
else {

  //----------------------------------------------------------
  /* Maak Dbconnectie */ require('../includes/dbconnect2.inc');
  //----------------------------------------------------------

  $update = "update overleg
             set {$_GET['kolom']} = {$_GET['id']}
             where patient_code = '{$_SESSION['pat_code']}'";
  $updateGelukt = mysql_query($update);
  if ($updateGelukt) {
    print("OK;$aanwezigheid;$teamStatus");
  }
  else {
    print("KO;foute query $update : " . mysql_error());
  }

  //---------------------------------------------------------
  /* Sluit Dbconnectie */ require("../includes/dbclose.inc");
  //---------------------------------------------------------
}
?>
