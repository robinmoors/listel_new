<?php

  //----------------------------------------------------------
  /* Maak Dbconnectie */ require('../includes/dbconnect2.inc');
  //----------------------------------------------------------

  $dag = date("d");
  $maand = date("m");
  $jaar = date("Y");
  $uur = date("H");
  $minuut = date("i");
  $sec = date("s");
  
  if ($_GET['start']==1) {
     mysql_query("insert into omb_tijd (dag, maand, jaar, uur1, min1, sec1) values ($dag, $maand, $jaar, $uur, $minuut, $sec)");
     print(mysql_insert_id());
  }
  else {
     mysql_query("update omb_tijd
                  set uur2 = $uur,
                       min2 = $minuut,
                       sec2 = $sec
                  where id = {$_GET['stop']}");
  }

  //---------------------------------------------------------
  /* Sluit Dbconnectie */ require("../includes/dbclose.inc");
  //---------------------------------------------------------

?>