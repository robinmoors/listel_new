<?php







// gegeven $evalID



    // zet: session: pat_naam, pat_code

    // zet: lokaal: patientInfo, overlegInfo (maar eigenlijk evalInfo)

    //----------------------------------------------------------



$queryOverleg = "SELECT * FROM evaluatie WHERE id = $evalID";



if ($resultOverleg = mysql_query($queryOverleg)) {

  $overlegInfo = mysql_fetch_array($resultOverleg);

  $queryPatient = "select patient.*, deelvzw from patient inner join gemeente on gem_id = gemeente.id where code = '{$overlegInfo['patient']}'";

  $patientInfo = mysql_fetch_array(mysql_query($queryPatient));
  if ($patientInfo['deelvzw']=="") $patientInfo['deelvzw']="H";

}



    $_SESSION['pat_naam'] = $patientInfo['naam'];

    $_SESSION['pat_voornaam'] = $patientInfo['voornaam'];

    $_SESSION['pat_id'] = $patientInfo['id'];

    $_SESSION['pat_code'] = $patientInfo['code'];





?>