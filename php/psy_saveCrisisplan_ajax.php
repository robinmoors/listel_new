<?php


session_start();

   require("../includes/dbconnect2.inc");

   if (isset($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan")) {
     if (!isset($_POST['afgerond'])) {
       print("KO");
     }
     else {
          $wie = $_POST['crisispersoon'];
          $streep = strpos($wie,"|");
          $genre = substr($wie, 0, $streep);
          $persoon_id = substr($wie, $streep+1);
          if ($persoon_id == "") $persoon_id = 0;

       $zoekOudeCrisisQry = "select * from psy_crisis where overleg_id = {$_POST['overleg']}";
       $zoekOudeCrisis = mysql_query($zoekOudeCrisisQry) or die("kan het vorige crisisplan niet vinden.");
       if (mysql_num_rows($zoekOudeCrisis) == 0) {
          $qrySituatie = "insert into psy_crisis (crisissituatie, crisis_id, crisis_genre, overleg_id)
                                 values (\"{$_POST['crisissituatie']}\",
                                         $persoon_id,
                                         '$genre',
                                         {$_POST['overleg']})";
       }
       else {
          $qrySituatie = "update psy_crisis set crisissituatie = \"{$_POST['crisissituatie']}\",
                                              crisis_id = $persoon_id,
                                              crisis_genre = '$genre'
                        where overleg_id = {$_POST['overleg']}";
       }
       mysql_query($qrySituatie) or print("KO.Ik kan de crisissituatie niet opslaan ($qrySituatie)");
       if ($_POST['afgerond']==0) {
         $tabel = "huidige_betrokkenen";
       }
       else {
         $tabel = "afgeronde_betrokkenen";
       }
       $iedereenBereikbaar = true;
       foreach ($_POST as $index => $bereikbaarheid) {
         if ($index != "afgerond" && $index != "crisissituatie") {
           $nummer = substr($index,1);
           $qry = "update $tabel set bereikbaarheid = '{$bereikbaarheid}' where id = $nummer";
           if (trim($bereikbaarheid) == "") {
             $iedereenBereikbaar = false;
           }
           mysql_query($qry) or print("KO.Ik kan de bereikbaarheid van $nummer niet opslaan ($qry)");
         }
       }
       print("OK");
       if (!$iedereenBereikbaar) {
         print("--");
       }
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