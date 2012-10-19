<?php

// $_GET['naam'] en $_GET['voornaam']

session_start();






   require("../includes/dbconnect2.inc");





/*
  $qry = "select hulpverleners.* , organisatie.naam as orgnaam, functies.naam as functie

          from hulpverleners, organisatie, functies

          where organisatie = organisatie.id

          AND fnct_id = functies.id

          AND hulpverleners.actief <> 0";
*/
$qry = "select * from hulpverleners
        where actief <> 0
          and riziv1 = {$_GET['riziv1']}
          and riziv2 = {$_GET['riziv2']}
          and riziv3 = {$_GET['riziv3']}
          and iban = '{$_GET['iban']}'";


$hvls = mysql_query($qry) or die($qry . "<br/>" . mysql_error());





if (mysql_num_rows($hvls)!=1) die(""); // geen of te veel hvls


for ($i=0; $i<mysql_num_rows($hvls); $i++) {

  $rijHVL = mysql_fetch_assoc($hvls);
  print("{$rijHVL['naam']}!!--!!");
  print("{$rijHVL['voornaam']}!!--!!");
  print("{$rijHVL['adres']}!!--!!");
  print("{$rijHVL['gem_id']}!!--!!");
  print("{$rijHVL['tel']}!!--!!");
  print("{$rijHVL['fax']}!!--!!");
  print("{$rijHVL['gsm']}!!--!!");
  print("{$rijHVL['email']}!!--!!");
  print("{$rijHVL['id']}!!--!!");
}








//---------------------------------------------------------

/* Sluit Dbconnectie */ require("../includes/dbclose.inc");

//---------------------------------------------------------

?>