<?php
session_start();   // $_SESSION['pat_code']

$paginanaam="NVT: katz_score bij overleg laten goedkeuren";
// krijgt GET id --> van katz
// en get overlegID van overleg

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
    $update = "update katz
               set goedkeuring_inspectie = 1
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

function startFacturatie() {
  // niet meer nodig
  $overlegID = $_GET['overlegID'];
  $overlegInfo = mysql_fetch_array(mysql_query("select * from overleg where id = $overlegID"));
  if ($overlegInfo['keuze_vergoeding']==1) {
     $emailResult = mysql_query("select email from logins where profiel ='listel' and sit_id is NULL and email <> \"\" and actief=1");
     for ($i=0; $i<mysql_num_rows($emailResult); $i++) {
       $em = mysql_fetch_array($emailResult);
       $emailListel .= ";{$em['email']}";
     }
     $emailListel = substr($emailListel, 1);
     htmlmail($emailListel,"Er is een nieuwe af te drukken factuur","Nieuwe factuur voor patient {$_SESSION['pat_code']} op $siteadres.");
     print("OK;De listelcoordinatoren zijn verwittigd dat dit overleg goedgekeurd is.");
  }
  print("OK");
}


?>
