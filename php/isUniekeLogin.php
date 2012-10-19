<?php

session_start();




   require("../includes/dbconnect2.inc");

   //if (IsSet($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan"))

      {
         if ($_GET['tabel']=="login")
           $qry1 = "select * from logins where login = '{$_GET['login']}' and not(id = {$_GET['id']})";
         else
           $qry1 = "select * from logins where login = '{$_GET['login']}'";
         if ($_GET['tabel']=="hulpverleners")
           $qry2 = "select * from hulpverleners where login = '{$_GET['login']}' and not(id = {$_GET['id']})";
         else
           $qry2 = "select * from hulpverleners where login = '{$_GET['login']}'";
         if ($_GET['tabel']=="mantelzorgers")
           $qry3= "select * from mantelzorgers where login = '{$_GET['login']}' and not(id = {$_GET['id']})";
         else
           $qry3 = "select * from mantelzorgers where login = '{$_GET['login']}'";
         if (mysql_num_rows(mysql_query($qry1)) > 0)
           print("KO");
         else if (mysql_num_rows(mysql_query($qry2)) > 0)
           print("KO");
         else if (mysql_num_rows(mysql_query($qry3)) > 0)
           print("KO");
         else
           print("OK");
      require("../includes/dbclose.inc");

      }



//---------------------------------------------------------

/* Geen Toegang */ //require("../includes/check_access.inc");

//---------------------------------------------------------



//---------------------------------------------------------

/* Sluit Dbconnectie */ require("../includes/dbclose.inc");

//---------------------------------------------------------

?>