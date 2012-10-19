<?php

session_start();

   require("../includes/dbconnect2.inc");

   if (isset($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan")) {
   if (isset($_GET['overleg'])) {
   $qry="
    SELECT
        distinct(bl.persoon_id)
    FROM
        ((psy_plan pl inner join psy_plan_mens pm on pl.overleg_id = {$_GET['overleg']} and pm.genre = 'hulp' and pl.id = pm.plan)
          inner join huidige_betrokkenen bl on bl.persoon_id = pm.persoon_id and bl.genre = pm.genre),
        (hulpverleners h inner join organisatie o on h.organisatie = o.id)
    WHERE
        bl.overleggenre = 'gewoon' AND
        bl.patient_code='".$_SESSION['pat_code']."' AND
        bl.genre = 'hulp' AND
        bl.persoon_id=h.id AND
        ((o.ggz = 1) or h.fnct_id in (62,76,117))
        ";
   $result=mysql_query($qry) or print("KO;$qry" . mysql_error());
   $aantalGGZ=mysql_num_rows($result);

   if ($aantalGGZ == 0) {
     print("KO;Niemand uit de geestelijke gezondheidszorg heeft een taak in het begeleidingsplan.");
   }
   else {
     print("OK");
   }
 }
 else print("KO");
  }

  require("../includes/dbclose.inc");



//---------------------------------------------------------

/* Geen Toegang */ require("../includes/check_access.inc");

//---------------------------------------------------------



//---------------------------------------------------------

/* Sluit Dbconnectie */ require("../includes/dbclose.inc");

//---------------------------------------------------------

?>