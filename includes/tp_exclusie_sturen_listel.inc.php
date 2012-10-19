<?php





      $qry = "select id from patient_tp 

                 where patient = \"{$_SESSION['pat_code']}\"

                   and actief = 1";



      if (!$qryResult = mysql_query($qry)) {

         die("allez, nu is deze query ook al niet gelukt $qry");

      }

      $recordsOverleg = mysql_fetch_array($qryResult);







      $update = "update patient_tp set uit_email = 1

                 where patient = \"{$_SESSION['pat_code']}\"

                   and actief = 1";

      mysql_query($update) or die("KO;Kan emailverwitting niet sturen.");

      

      $link1 = "<h4><a href=\"$siteadres/php/print_tp_inclusie.php?id={$recordsOverleg['id']}&exclusie=1\">druk exclusiedocument af</a></h4>\n";







     $mailBody = "<p><img src=\"http://www.listel.be/images/logo_top_pagina_klein.gif\" alt=\"logo listel\"></p>

                   <p>Beste Anick,</p><p>{$_SESSION['pat_code']} is zopas officieel geexcludeerd. Dat betekent dat je op

                   <a href='http://www.listel.be'>de site</a> het exclusiedocument kan afdrukken, ondertekenen en verwerken.

                   

                   <p>Zie ook</p>

                   $link1



<p>Met dank voor uw medewerking, <br />

Het e-zorgplan www.listel.be </p>



     ";

     



    $tpRecord = tp_record($_SESSION['project']);

    $tpCode = $tpRecord['nummer'];



    if (htmlmailZonderCopy("$gegevens_email_contact", "LISTEL exclusie TP-$tpCode van {$_SESSION['pat_code']}", $mailBody)) {

       print("OK");

    }

    else {

       print("KO");

    }





?>



