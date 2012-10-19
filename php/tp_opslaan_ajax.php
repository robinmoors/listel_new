<?php
session_start();   // $_SESSION['pat_code']

$paginanaam="NVT: aanwezigheid van deelnemers aanpassen";

if (!(isset($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan"))) {
  print("KO;Geen toegang");
}
else if (!(isset($_SESSION["pat_code"]))) {
  print("KO;Geen patient");
}
else if (!(isset($_POST['id'])) && !(isset($_POST['verslag'])) && !(isset($_POST['plan']))) {
  print("KO;Geen gegevens");
}
else {

  //----------------------------------------------------------
  /* Maak Dbconnectie */ require('../includes/dbconnect2.inc');
  //----------------------------------------------------------

  if (isset($_POST['verslag'])) {
    if ($_SESSION['profiel']=="OC")
      $auteur = "OC";
    else
      $auteur = "TP";
    $update = "update overleg set tp_verslag = \"{$_POST['verslag']}\",
                                  tp_auteur = \"$auteur\"
               where id = {$_POST['id']}";
  }
  else if (isset($_POST['plan'])) {
    $update = "update overleg set tp_plan = \"{$_POST['plan']}\"
               where id = {$_POST['id']}";
  }

  $updateGelukt = mysql_query($update);

  if ($updateGelukt) {
    print("OK");
  }
  else {
    print("KO;$update");
  }

  //---------------------------------------------------------
  /* Sluit Dbconnectie */ require("../includes/dbclose.inc");
  //---------------------------------------------------------
}
?>
