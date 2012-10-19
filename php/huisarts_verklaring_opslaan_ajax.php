<?php

session_start();   // $_SESSION['pat_code']

$paginanaam="NVT: huisarts_verklaring_opslaan met ajax";

if (!(isset($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan"))) {
  print("KO;Geen toegang");
}
else if (!(isset($_GET['antwoord']))) {
  print("KO;Geen gegevens");
}
else {
  //----------------------------------------------------------
  /* Maak Dbconnectie */ require('../includes/dbconnect2.inc');
  //----------------------------------------------------------

      $qry = ("update overleg set verklaring_huisarts = '{$_GET['antwoord']}' where id = '{$_GET['overlegID']}'") or die("0probleem met update overleg");
      mysql_query($qry);
  //---------------------------------------------------------
  /* Sluit Dbconnectie */ require("../includes/dbclose.inc");
  //---------------------------------------------------------
}

     print("OK");

?>

