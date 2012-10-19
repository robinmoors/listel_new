<?php

session_start();   // $_SESSION['pat_code']



$paginanaam="NVT: aanvragerformulier";


if (!(isset($_GET['rr'])) || !(isset($_GET['overleg_gemeente']))) {
  die("   Alles OK");
}




  //----------------------------------------------------------

  /* Maak Dbconnectie */ require('../includes/dbconnect2.inc');

  //----------------------------------------------------------
  
$qryPat = "select patient.*, gemeente.zip, gemeente.dlzip, gemeente.dlnaam
            from patient inner join gemeente on patient.gem_id = gemeente.id and rijksregister = '{$_GET['rr']}' order by patient.actief desc, startdatum desc";
$resultPat = mysql_query($qryPat) or die("$qryPat" . mysql_error());
if (mysql_num_rows($resultPat)==0) print("  Alles OK");
else {
$pat = mysql_fetch_assoc($resultPat);

$vandaag = date("Ymd");
  
$qryOverleg = "select * from overleg where afgerond = 0 and patient_code = '{$pat['code']}' and datum > $vandaag";
$resultOverleg = mysql_query($qryOverleg) or die($qryOverleg);
$aantalOverleg = mysql_num_rows($resultOverleg);

if ($aantalOverleg >= 1) {
  $overleg = mysql_fetch_assoc($resultOverleg);
  $mooieDatum = mooieDatum($overleg['datum']);
  print("Er wordt al een overleg gepland op voor deze pati&euml;nt. Je kan deze aanvraag nog steeds vervolledigen,
       maar het is waarschijnlijk beter om dit overleg af te wachten.");
}
else if ($_GET['overleg_gemeente']>0) {
  if ($pat['zip']!= $_GET['overleg_gemeente']) {
     print("Deze pati&euml;nt woont in {$pat['dlnaam']} en dus buiten uw overleg-gemeente. Deze aanvraag wordt dan
     ook doorgestuurd naar die overlegco&ouml;rdinator (indien je kiest voor een overleg door het OCMW van de woonplaats). <br/>
     Indien de pati&euml;nt verhuisd is, moet die overlegco&ouml;rdinator
     het dossier afsluiten, waarna jij een nieuw kan opstarten.");
  }
  else {
    print("   Alles OK");
  }
}
else {
  print("  Alles OK");
}
}


  //---------------------------------------------------------

  /* Sluit Dbconnectie */ require("../includes/dbclose.inc");

  //---------------------------------------------------------




?>

