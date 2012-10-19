<?php
session_start();
   require("../includes/dbconnect2.inc");
   if (isset($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan")) {
     if ($_GET['alleengetal']==1)
       print "OK" . (berekenGetalSubsidiestatus($_GET['minimumStatus'], $_GET['vorigeStatus'], $_GET['code'], $_GET['tabel'], $_GET['kolom'], $_GET['waarde']));
     else
       print "OK" . (berekenSubsidiestatus($_GET['minimumStatus'], $_GET['vorigeStatus'], $_GET['code'], $_GET['tabel'], $_GET['kolom'], $_GET['waarde']));
  }
  require("../includes/dbclose.inc");

//---------------------------------------------------------
/* Geen Toegang */ require("../includes/check_access.inc");
//---------------------------------------------------------

//---------------------------------------------------------
/* Sluit Dbconnectie */ require("../includes/dbclose.inc");
//---------------------------------------------------------
?>