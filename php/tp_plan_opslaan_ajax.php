<?php

session_start();   // $_SESSION['pat_code']



$paginanaam="NVT: plan aanpassen";



$_GET = $_POST;



if (!(isset($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan"))) {

  print("KO;Geen toegang");

}

else if (!(isset($_SESSION["pat_code"]))) {

  print("KO;Geen patient");

}

else if (!(isset($_GET['plan']))) {

  print("KO;Geen gegevens");

}

else {



  //----------------------------------------------------------

  /* Maak Dbconnectie */ require('../includes/dbconnect2.inc');

  //----------------------------------------------------------



  $ok = true;

  

  foreach ($_GET['plan'] as $id =>$plan) {

    $update = "update overleg_tp_plan set plan = \"$plan\"

               where id = $id";



    $ok = $ok && mysql_query($update);

  }

    $update = "update overleg set tp_nieuwepartners = \"{$_GET['tp_nieuwepartners']}\"

               where id = {$_GET['overleg']}";

    $ok = $ok && mysql_query($update);



  if ($ok) {

    print("OK");

    $qryLeegPlan = "select * FROM overleg_tp_plan

                    WHERE  length(plan)=0 and overleg = {$_GET['overleg']}

                       AND NOT (genre = \"orgpersoon\")";

    $resultLeegPlan = mysql_query($qryLeegPlan);



    if (($_GET['overleg'] > 0) && (mysql_num_rows($resultLeegPlan) == 0)) {

        /************ email sturen naar OC TGZ ***********************/

          $qryOC = "select logins.* from logins, gemeente, patient, patient_tp where profiel = 'OC'

              and overleg_gemeente = zip and patient.gem_id = gemeente.id and patient.code =  \"{$_SESSION['pat_code']}\"

              and patient.code = patient_tp.patient

              and rechtenOC > 0

              and logins.login not like '%help%'

              and logins.actief = 1";

          $resultOC = mysql_query($qryOC) or print(mysql_error());

          $aantalMensen = 0;

          if (mysql_num_rows($resultOC) > 0) {

           for ($i=0; $i<mysql_num_rows($resultOC); $i++) {

             $aantalMensen++;

             $oc  = mysql_fetch_assoc($resultOC);

             $adressen .= ", {$oc['email']}";

           }

           if ($aantalMensen>0) $adressen = substr($adressen, 1);



          $msg = "Het plan van tenlasteneming bij patient {$_SESSION['pat_code']} is ingevuld. Je kan nu verder met het overleg af te ronden.";

          if ($aantalMensen>0)  htmlmail($adressen,"Listel: Plan van tenlasteneming {$_SESSION['pat_code']} ingevuld.","Beste overlegco&ouml;rdinator<br/>$msg \n<br /><p>Met dank voor uw medewerking, <br />Het LISTEL e-zorgplan www.listel.be </p>");

         }

        /************ email sturen naar OC TGZ ***********************/

      print('+');

    }

    else

      print("-");



  }

  else {

    print("KO;$update");

  }



  //---------------------------------------------------------

  /* Sluit Dbconnectie */ require("../includes/dbclose.inc");

  //---------------------------------------------------------

}

?>

