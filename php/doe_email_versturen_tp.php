<?php

 session_start();

 

  //vereist: $_GET['overleg'] heeft een waarde

  // mail naar project of hoofdproject-coordinatoren



    //----------------------------------------------------------

    /* Maak Dbconnectie */ include('../includes/dbconnect2.inc');

    //----------------------------------------------------------







     $qry="

        SELECT

            datum,

            naam,

            voornaam,

            patient_code

        FROM

            overleg, patient

        WHERE

            overleg.id = {$_GET['overleg']}

            and patient_code = patient.code

        ";





      if (!$qryResult = mysql_query($qry)) {

         die("allez, nu is deze query ook al niet gelukt $qry");

      }

      $recordsOverleg = mysql_fetch_array($qryResult);

      $datum=substr($recordsOverleg['datum'],6,2)."/".substr($recordsOverleg['datum'],4,2)."/".substr($recordsOverleg['datum'],0,4);









     $mailBody = "<p><img src=\"http://www.listel.be/images/logo_top_pagina_klein.gif\" alt=\"logo listel\"></p>

                   <p>Beste project-co&ouml;rdinator,</p><p>gelieve het plan van tenlasteneming bij het overleg voor <br />

                  <strong>{$recordsOverleg['naam']} {$recordsOverleg['voornaam']}</strong> (zorgplan {$recordsOverleg['patient_code']}) op

                  {$datum} (datum overleg) in te vullen.<p/>



<p>Log hiervoor in op het Listel e-zorgplan <a href=\"http://www.listel.be\">www.listel.be</a>.</p>







                  <p><br />Indien er zich problemen voordoen kan u altijd bellen (011/81.94.70) of mailen met LISTEL (Anick.Noben@listel.be).</p>



<p>Met dank voor uw medewerking, <br />

Het LISTEL e-zorgplan www.listel.be </p>



     ";



    $qryEmail = "select email from logins, patient_tp, overleg

                  where (logins.profiel = 'hoofdproject' or  logins.profiel = 'bijkomend project')

                  and logins.email > ''

                  and logins.actief = 1

                  and logins.tp_project = patient_tp.project

                  and patient = patient_code

                  and patient_tp.actief = 1

                  and overleg.id = {$_GET['overleg']}";

    $resultEmail = mysql_query($qryEmail);

    for ($i = 0; $i<mysql_num_rows($resultEmail);$i++) {

      $rijEmail = mysql_fetch_assoc($resultEmail);

      $projectemail .= ",{$rijEmail['email']}";

    }



    $projectemail = substr($projectemail,1);

    

    if (htmlmail("{$projectemail}", "LISTEL plan van tenlasteneming invullen", $mailBody)) {

       print("OK");

    }

    else {

       print("KO");

    }







    //---------------------------------------------------------

    /* Sluit Dbconnectie */ include("../includes/dbclose.inc");

    //---------------------------------------------------------



?>



