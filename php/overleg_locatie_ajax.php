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

  $update = "update overleg
             set aanwezig_patient = {$_GET['aanwezig']},
                 datum  = {$_GET['datum']},
                 locatie  = {$_GET['locatie']},
                 locatieTekst  = \"{$_GET['locatieTekst']}\",
                 tijdstip  = \"{$_GET['tijdstip']}\",
               	 akkoord_patient  = {$_GET['instemming']},
               	 vertegenwoordiger =  {$_GET['vertegenwoordiger']}
             where  id = {$_GET['id']}";
  $updateGelukt = mysql_query($update);

  if ($updateGelukt) {
    if (is_tp_patient()) {
      $datedatum = substr($_GET['datum'], 0, 4) . "-" . substr($_GET['datum'], 4, 2) . "-" . substr($_GET['datum'], 6, 2);
      $qryBeginDatum = "update patient_tp
                        set begindatum = '$datedatum'
                        where begindatum > '$datedatum'
                          and patient = '{$_SESSION['pat_code']}' ";
      if (!(mysql_query($qryBeginDatum))) {
        print("KO;wel overlegdatum, niet begindatum");
      }
      else {
        print("OK");
      }
    }
    else {
      $qryBeginDatum = "update patient
                        set startdatum = '{$_GET['datum']}'
                        where startdatum > '{$_GET['datum']}'
                          and code = '{$_SESSION['pat_code']}' ";
      if (!(mysql_query($qryBeginDatum))) {
        print("KO;wel overlegdatum, niet begindatum");
      }
      else {
        print("OK");
      }
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
