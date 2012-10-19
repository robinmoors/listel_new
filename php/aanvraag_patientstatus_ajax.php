<?php

session_start();

   require("../includes/dbconnect2.inc");

   $qry = "select actief, menos,
                  toegewezen_genre, toegewezen_id, type,
                  dlzip, dlnaam from patient inner join gemeente on gem_id = gemeente.id where rijksregister = '{$_GET['rr']}' order by patient.actief desc, startdatum desc";
   $result = mysql_query($qry);
   if (mysql_num_rows($result) == 0) echo "nieuw";
   else {
     $pat = mysql_fetch_object($result);
     $actief = $pat->actief;
     $menos = $pat->menos;
     if ($pat->toegewezen_genre == "gemeente") {
       $oc = "Het OCMW van de woonplaats";
     }
     else if ($pat->toegewezen_genre == "rdc") {
       $rdc = getUniqueRecord("select naam from organisatie where id = {$pat->toegewezen_id}");
       $oc = $rdc['naam'];
     }
     else if ($pat->toegewezen_genre == "psy") {
       $rdc = getUniqueRecord("select naam from organisatie where id = {$pat->toegewezen_id}");
       $oc = $rdc['naam'];
     }
     else {
       $hulp = getUniqueRecord("select o.naam from organisatie o, hulpverleners h where h.id = {$pat->toegewezen_id} and h.organisatie = o.id");
       $oc = $hulp['naam'];
     }
     
     if ($actief == 0 && $menos == 0) {
       echo "archief{$pat->dlzip} {$pat->dlnaam}|{$oc}|{$pat->type}";
     }
     else {
       echo "{$oc}|{$pat->type}";
     }
   }

  require("../includes/dbclose.inc");


//---------------------------------------------------------
/* Sluit Dbconnectie */ require("../includes/dbclose.inc");
//---------------------------------------------------------

?>