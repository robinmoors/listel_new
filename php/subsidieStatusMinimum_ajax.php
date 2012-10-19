<?php
session_start();
   require("../includes/dbconnect2.inc");
   if (IsSet($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan"))
      {

      $qry = "update patient set minimum_subsidiestatus = '{$_GET['status']}' where code = '{$_GET['code']}'";
      if (mysql_query($qry)) {
        print("OK");
      }
      else {
        print($qry . " gaf volgende fout: <br/>" . mysql_error());
      }

      require("../includes/dbclose.inc");
      }

//---------------------------------------------------------
/* Geen Toegang */ require("../includes/check_access.inc");
//---------------------------------------------------------

//---------------------------------------------------------
/* Sluit Dbconnectie */ require("../includes/dbclose.inc");
//---------------------------------------------------------
?>