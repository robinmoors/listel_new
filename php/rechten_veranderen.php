<?php
session_start();


$paginanaam="NVT: rechten wijzigen met ajax";
// huidig overleg: patient, genre, persoonID, rechten
// afgerond overleg: overlegID, genre, persoonID, rechten
// evaluatie : evaluatieID, genre, persoonID, rechten
// bijlage: bijlage, genre, persoonID, rechten

if (!(isset($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan"))) {
  die("KO;Geen toegang");
}
else {
  //----------------------------------------------------------
  /* Maak Dbconnectie */ require('../includes/dbconnect2.inc');
  //----------------------------------------------------------

  if (isset($_GET['overlegGenre'])) {
    $overlegGenre = "{$_GET['overlegGenre']}";
  }
  else {
    $overlegGenre = "gewoon";
  }

  if (isset($_GET['patient']))
      mysql_query("update huidige_betrokkenen set rechten= {$_GET['rechten']}
                   where patient_code = '{$_GET['patient']}'
                     and genre = '{$_GET['genre']}'
                     and overleggenre = '$overlegGenre'
                     and persoon_id = {$_GET['persoonID']}") or die("0probleem met rechten voor huidig overleg" .
                     "update huidige_betrokkenen set rechten= {$_GET['rechten']}
                   where patient_code = '{$_GET['patient']}'
                     and genre = '{$_GET['genre']}'
                     and persoon_id = {$_GET['persoonID']}"  .
                     mysql_error());
  else if (isset($_GET['overlegID']))
      mysql_query("update afgeronde_betrokkenen set rechten= {$_GET['rechten']}
                   where overleg_id = {$_GET['overlegID']}
                     and overleggenre = '$overlegGenre'
                     and genre = '{$_GET['genre']}'
                     and persoon_id = {$_GET['persoonID']}") or die("0probleem met rechten voor afgerond overleg");
  else if (isset($_GET['evaluatieID']))
      mysql_query("update evaluatie_rechten set rechten= {$_GET['rechten']}
                   where evaluatie = {$_GET['evaluatieID']}
                     and genre = '{$_GET['genre']}'
                     and id = {$_GET['persoonID']}") or die("0probleem met rechten voor evaluatie");
  else if (isset($_GET['bijlage']))
      mysql_query("update overleg_files_rechten set rechten= {$_GET['rechten']}
                   where filename = '{$_GET['bijlage']}'
                     and genre = '{$_GET['genre']}'
                     and id = {$_GET['persoonID']}") or die("0probleem met rechten voor bijlage");
  //---------------------------------------------------------

  /* Sluit Dbconnectie */ require("../includes/dbclose.inc");

  //---------------------------------------------------------

}

     print("OK");





?>

