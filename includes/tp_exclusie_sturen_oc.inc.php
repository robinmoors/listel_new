<?php

  // een mail sturen naar OC en hoofdprojectcoordinator met melding dat patient is geexcludeerd

  $qryOC = "select logins.* from logins, gemeente, patient, patient_tp where profiel = 'OC'

              and overleg_gemeente = zip and patient.gem_id = gemeente.id and patient.code =  \"{$_SESSION['pat_code']}\"

              and patient_tp.patient =  \"{$_SESSION['pat_code']}\"

              and ((rechtenOC is NOT NULL) or rechtenOC > '20000000')

              and logins.login not like '%help%'

              and logins.actief = 1";

  $resultOC = mysql_query($qryOC);

  for ($i=0; $i<mysql_num_rows($resultOC); $i++) {

     $oc  = mysql_fetch_assoc($resultOC);

     $namen .= ", {$oc['naam']} {$oc['voornaam']}";

     $adressen .= ", {$oc['email']}";

  }

  $qryPC = "select logins.* from logins, patient_tp where profiel = 'hoofdproject'

              and patient_tp.project = logins.tp_project and patient_tp.patient =  \"{$_SESSION['pat_code']}\"

              and logins.login not like '%help%'

              and logins.actief = 1";

  $resultPC = mysql_query($qryPC);

  for ($i=0; $i<mysql_num_rows($resultPC); $i++) {

     $pc  .= " " . mysql_fetch_assoc($resultPC);

     $namen .= ", {$pc['naam']} {$pc['voornaam']}";

     $adressen .= ", {$pc['email']}";

  }

  $namen = substr($namen, 1);

  $adressen = substr($adressen, 1);

  if ($_POST['stopzetting']=="stopzettenMetEmail") {

     $extra = "Ook het zorgplan van de patient is stopgezet. U dient dus geen verdere stappen te nemen.";

  }

  else if ($_POST['stopzetting']=="naarGDTmetEmail") {

     $extra = "Het zorgplan van de patient verhuist naar uw diensten. Vanaf nu plant u dus zelfstandig overleggen.";

  }



    $tpRecord = tp_record($_SESSION['project']);

    $tpCode = $tpRecord['nummer'];



  htmlmail($adressen,"Listel: Exclusie patient uit therapeutisch project TP-$tpCode","Beste $namen<br/>

     De pati&euml;nt {$_SESSION['pat_code']} is ge&euml;xcludeerd uit het therapeutisch project o.l.v.

     {$pc['naam']} {$pc['voornaam']} omwille van <br/>$reden ({$_POST['pat_stopzetting_text']}). <br />$extra\n<br />Voor meer inlichtingen kan je via elkaars emailadressen ($adressen) contact opnemen met elkaar.");

?>



