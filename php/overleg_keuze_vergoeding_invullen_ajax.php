<?php
session_start();   // $_SESSION['pat_code']

$paginanaam="NVT: keuze vergoeding invullen";

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
             set keuze_vergoeding = {$_GET['keuze']}
             where id = {$_GET['id']}";
  $updateGelukt = mysql_query($update);
  if ($updateGelukt) {
    print("OK");
  }
  else {
    print("KO;foute query:" + $update);
  }

  //---------------------------------------------------------
  /* Sluit Dbconnectie */ require("../includes/dbclose.inc");
  //---------------------------------------------------------
}
?>
