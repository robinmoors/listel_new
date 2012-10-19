<?php

 session_start();

 

  //vereist: $_GET['overleg'] heeft een waarde

  // mail naar project of hoofdproject-coordinatoren



    //----------------------------------------------------------

    /* Maak Dbconnectie */ include('../includes/dbconnect2.inc');

    //----------------------------------------------------------







     $qry="

        SELECT

            overleg.id,
            datum,

            p.naam,

            p.voornaam,

            hulpverleners.email,
            hulpverleners.id as hvl_id,
            logincode,
            patient_code

        FROM

            overleg inner join hulpverleners on contact_hvl = hulpverleners.id, patient p

        WHERE

            overleg.id = {$_GET['overleg']}

            and patient_code = p.code

        ";





      if (!$qryResult = mysql_query($qry)) {

         die("allez, nu is deze query ook al niet gelukt $qry" . mysql_error());

      }
      if (mysql_num_rows($qryResult) == 0) {print("NULL");}

      else {

      $recordsOverleg = mysql_fetch_array($qryResult);
      if ($recordsOverleg['email']=="") print("--");
      else {
      $datum=substr($recordsOverleg['datum'],6,2)."/".substr($recordsOverleg['datum'],4,2)."/".substr($recordsOverleg['datum'],0,4);





      $link1 = "$siteadres/php/begeleidingsplan_invullen.php?hvl_id={$recordsOverleg['hvl_id']}&code={$recordsOverleg['logincode']}";




     $mailBody = "<p><img src=\"http://www.listel.be/images/logo_top_pagina_klein.gif\" alt=\"logo listel\"></p>

                   <p>Beste referentiepersoon,</p><p>gelieve het begeleidingsplan bij het overleg voor <br />

                  <strong>{$recordsOverleg['naam']} {$recordsOverleg['voornaam']}</strong> (zorgplan {$recordsOverleg['patient_code']}) op

                  {$datum} (datum overleg) in te vullen.<p/>

<p>Dit kan elektronisch door op <a href=\"$link1\">deze link</a> te klikken.
Via deze link komt u automatisch terecht in het persoonlijk e-zorgplan van deze pati&euml;nt.<br/>
U heeft enkel toegang tot dit begeleidingsplan.
</p>







                  <p><br />Indien er zich problemen voordoen kan u altijd bellen (011/81.94.70) of mailen met LISTEL (Anick.Noben@listel.be).</p>



<p>Met dank voor uw medewerking, <br />

Het LISTEL e-zorgplan www.listel.be </p>



     ";




    

    if (htmlmail("{$recordsOverleg['email']}", "LISTEL begeleidingsplan invullen", $mailBody)) {
       $vandaag = mktime(0,0,0,date("n"),date("j"),date("Y"));
       $aanvraagQry = "insert into katz_aanvraag (overleg, hvl, wat, wanneer) values ({$recordsOverleg['id']},{$recordsOverleg['hvl_id']}, 'begeleidingsplan', $vandaag)";
       if (mysql_query($aanvraagQry))
         print("OK {$recordsOverleg['email']}");
       else
         print("KO");

    }

    else {

       print("KO");

    }

   }
  }





    //---------------------------------------------------------

    /* Sluit Dbconnectie */ include("../includes/dbclose.inc");

    //---------------------------------------------------------



?>



