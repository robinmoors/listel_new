<?php

session_start();   // $_SESSION['pat_code']



$paginanaam="NVT: zorgbemiddelaar zoeken met ajax";

// krijgt GET id --> van katz

// en get overlegID van overleg



if (!(isset($_SESSION["profiel"])&&($_SESSION["profiel"]=="ziekenhuis"))) {
  die("KO;Geen toegang");
}
else if (!(isset($_GET['rr']))) {
  die("KO;Geen gegevens");
}




  //----------------------------------------------------------

  /* Maak Dbconnectie */ require('../includes/dbconnect2.inc');

  //----------------------------------------------------------
  
  $nu = time();
  mysql_query("insert into logs_ziekenhuis (login, timestamp, rijksregister) values ({$_SESSION['usersid']},$nu,'{$_GET['rr']}')") or die("KO.De logging lukt even niet en dus staan we tijdelijk geen opzoekingen toe.");

  $zorgbemiddelaar = getZorgBemiddelaarVan($_GET['rr']);
  if ($zorgbemiddelaar == -1) {
    echo "<p>Voor dit rijksregisternummer is er geen zorgplan gekend bij Listel, of heeft de pati&euml;nt (nog) geen toestemming gegeven.</p>";
  }
  else {
    echo $zorgbemiddelaar;
  }



  //---------------------------------------------------------

  /* Sluit Dbconnectie */ require("../includes/dbclose.inc");

  //---------------------------------------------------------




?>

