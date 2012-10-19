<?php
session_start();   // $_SESSION['pat_code']

$paginanaam="NVT: ombvergoedbaarheid instellen";

if (!(isset($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan"))||($_SESSION['profiel']!="listel")) {
  print("KO;Geen toegang");
}
else if (!(isset($_GET['overlegID']))) {
  print("KO;Geen gegevens");
}
else if (!(isset($_GET['patient']))) {
  print("KO;Geen gegevens");
}
else {
  $overlegID = $_GET['overlegID'];
  //----------------------------------------------------------
  /* Maak Dbconnectie */ require('../includes/dbconnect2.inc');
  //----------------------------------------------------------
  
  if (ombvergoedbaar($overlegID)) {
    $datum = getFirstRecord("select datum from overleg where id = $overlegID");
    $jaar = substr($datum['datum'],0,4);
    $maxRecordQry =  "select max(omb_rangorde) as max_rangorde from overleg where not(id=$overlegID) and patient_code = \"{$_GET['patient']}\" and omb_id > 0 and substring(datum,1,4) = $jaar";
    $maxRecord = getFirstRecord($maxRecordQry);
    $rangorde = $maxRecord['max_rangorde']+1;
    mysql_query("update overleg set omb_rangorde = $rangorde where id = $overlegID");
    print($rangorde);
    //print($maxRecordQry);
  }
  else {
    print("0");
  }

  //---------------------------------------------------------
  /* Sluit Dbconnectie */ require("../includes/dbclose.inc");
  //---------------------------------------------------------
}
?>
