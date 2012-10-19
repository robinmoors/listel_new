<?php

session_start();   // $_SESSION['pat_code']



$paginanaam="NVT: extra gegevens van psy aanpassen";



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
             set datum  = {$_GET['datum']},
                 locatie  = {$_GET['locatie']},
                 ambulant  = \"{$_GET['ambulant']}\",
               	 huisarts_belangrijk  = {$_GET['huisartsBelangrijk']}
             where  id = {$_GET['id']}";

  $updateGelukt = mysql_query($update);
  if ($updateGelukt) {
      $qryBeginDatum = "update patient_psy
                        set startdatum = {$_GET['datum']}
                        where (startdatum > {$_GET['datum']} or startdatum is null)
                          and code = '{$_SESSION['pat_code']}' ";
      if (!(mysql_query($qryBeginDatum))) {
        print("KO;wel overlegdatum, niet begindatum");
      }
      else {
        print("OK");
      }
  }
  else {
    print("KO;$update");
  }

  //---------------------------------------------------------
  /* Sluit Dbconnectie */ require("../includes/dbclose.inc");
  //---------------------------------------------------------
}

?>

