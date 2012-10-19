<?php

 session_start();

 

  //vereist: $_GET['overleg']



    //----------------------------------------------------------

    /* Maak Dbconnectie */ include('../includes/dbconnect2.inc');

    //----------------------------------------------------------







  if (isset($_GET['overleg'])) {

     $qry="

        SELECT

            *, patient_tp.id as ptpid

        FROM

            overleg, patient, patient_tp

        WHERE

            patient_code = patient

            and patient = code

            and overleg.id = {$_GET['overleg']}

        ";



      if (!$qryResult = mysql_query($qry)) {

         die("allez, nu is deze query ook al niet gelukt $qry");

      }

      $recordsOverleg = mysql_fetch_array($qryResult);

      $update = "update patient_tp set in_email = 1

                 where patient = \"{$_GET['patient']}\"

                   and project = {$recordsOverleg['project']}";

      mysql_query($update) or die("KO;Kan emailverwitting niet sturen.");

      

      $datum=substr($recordsOverleg['datum'],6,2)."/".substr($recordsOverleg['datum'],4,2)."/".substr($recordsOverleg['datum'],0,4);

      

      $link1 = "<h4><a href=\"$siteadres/php/print_tp_inclusie.php?id={$recordsOverleg['ptpid']}\">druk inclusiedocument af</a></h4>\n";







     $mailBody = "<p><img src=\"http://www.listel.be/images/logo_top_pagina_klein.gif\" alt=\"logo listel\"></p>

                   <p>Beste Anick,</p><p>{$_GET['patient']} is zopas officieel geincludeerd. Dat betekent dat je op

                   <a href='http://www.listel.be'>de site</a> het inclusiedocument kan afdrukken, ondertekenen en verwerken.



                   <p>Zie ook</p>

                   $link1



<p>Met dank voor uw medewerking, <br />

Het LISTEL e-zorgplan www.listel.be </p>



     ";



    $tpRecord = tp_record($recordsOverleg['project']);

    if (htmlmailZonderCopy("$gegevens_email_contact", "LISTEL inclusie TP-{$tpRecord['nummer']} van {$_GET['patient']}", $mailBody)) {

       print("OK");

    }

    else {

       print("KO");

    }

  }





    //---------------------------------------------------------

    /* Sluit Dbconnectie */ include("../includes/dbclose.inc");

    //---------------------------------------------------------



?>



