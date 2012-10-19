<?php
session_start();   // $_SESSION['pat_code']

$paginanaam="NVT: omb_registratie wissen";
// krijgt GET id --> van omb_lijst

if (false && !(isset($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan"))) {
  print("KO;Geen toegang");
}
else if (!(isset($_GET['id']))) {
  print("KO;Geen gegevens");
}
else {
  //----------------------------------------------------------
  /* Maak Dbconnectie */ require('../includes/dbconnect2.inc');
  //----------------------------------------------------------


 // eerst kijken of deze registratie de bron is
 $reg = getFirstRecord("select * from omb_registratie where id = {$_GET['id']} and not(afgerond=1)");
 if ($reg['id']==$_GET['id']) {

   $dagnummer= $reg['dagnummer'];
   if ($dagnummer < 10) $dagcode = "00$dagnummer";
   else if ($dagnummer < 100) $dagcode = "0$dagnummer";
   else $dagcode = "$dagnummer";

   $omb_bron = "{$reg['jaar']}/{$reg['maand']}/{$reg['dag']}/LI-$dagcode";

   $ok= true;
   $ok = mysql_query("update patient set omb_bron = NULL where omb_bron = '$omb_bron'");
   $ok= $ok  && mysql_query("delete from omb_registratie where id = {$_GET['id']}");
   $ok= $ok  && mysql_query("delete from omb_aanwezigeprobleemfactor where registratie_id = {$_GET['id']}");
   $ok= $ok  && mysql_query("delete from omb_hulp where registratie_id = {$_GET['id']}");
   $ok= $ok  && mysql_query("delete from omb_mishandelvorm where registratie_id = {$_GET['id']}");
   if ($ok)
     print("OK");
   else
     print("KOOnverwachte fout: " . mysql_error());
 }
 else {
   print("KODeze registratie mag je niet wissen: hij bestaat niet of is al afgerond.");
 }

  //---------------------------------------------------------
  /* Sluit Dbconnectie */ require("../includes/dbclose.inc");
  //---------------------------------------------------------
}

?>
