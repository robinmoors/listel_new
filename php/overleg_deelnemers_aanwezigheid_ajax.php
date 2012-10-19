<?php
session_start();   // $_SESSION['pat_code']

$paginanaam="NVT: aanwezigheid van deelnemers aanpassen";

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
  if ($_GET['tabel'] == "afgeronde") {
    $tabel = "afgeronde_betrokkenen";
  }
  else {
    $tabel = "huidige_betrokkenen";
  }

  $select = "select aanwezig from $tabel where id = {$_GET['id']}";
  $selectRecord = mysql_fetch_array(mysql_query($select));
  $aanwezigheid = ($selectRecord['aanwezig']+1)%2; // 0 wordt 1 ;  1 wordt 0
  
  $update = "update $tabel
             set aanwezig = $aanwezigheid
             where  id = {$_GET['id']}";
  $updateGelukt = mysql_query($update);

  $overlegID = $_GET['overlegID'];
  $overlegInfo = mysql_fetch_array(mysql_query("select * from overleg where id = $overlegID"));

  require("../includes/overleg_berekenTeamStatus.php");

  $teamStatus = berekenTeamStatus();
  if ($updateGelukt) {
    print("OK;$aanwezigheid;$teamStatus");
  }
  else {
    print("KO;foute query");
  }

  //---------------------------------------------------------
  /* Sluit Dbconnectie */ require("../includes/dbclose.inc");
  //---------------------------------------------------------
}
?>
