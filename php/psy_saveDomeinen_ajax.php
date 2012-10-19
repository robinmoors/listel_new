<?php

session_start();

   require("../includes/dbconnect2.inc");

   if (isset($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan")) {

     if (isset($_POST['basis'])) {
        saveDomeinen($_POST);
        print("OK");
     }
     else {
        print("KO Geen domeingegevens.");
     }

  }

  require("../includes/dbclose.inc");



//---------------------------------------------------------

/* Geen Toegang */ require("../includes/check_access.inc");

//---------------------------------------------------------



//---------------------------------------------------------

/* Sluit Dbconnectie */ require("../includes/dbclose.inc");

//---------------------------------------------------------

?>