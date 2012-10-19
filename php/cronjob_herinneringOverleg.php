<?php


require("../includes/dbconnect2.inc");

switch (date("m")) {
   case 1:
   case 2:
   case 3:
     $trimesterdatum = date("Y0101");
     $vorigJaar = date("Y")-1;
     $eenJaar = "patient_tp.begindatum between '{$vorigJaar}-04-01' and '{$vorigJaar}-06-30'";
     $meerJaar = "substring(patient_tp.begindatum,5,5) between '04-01' and '06-30'";
     break;
   case 4:
   case 5:
   case 6:
     $trimesterdatum = date("Y0401");
     $vorigJaar = date("Y")-1;
     $eenJaar = "patient_tp.begindatum between '{$vorigJaar}-07-01' and '{$vorigJaar}-09-30'";
     $meerJaar = "substring(patient_tp.begindatum,5,5) between '07-01' and '09-30'";
     break;
   case 7:
   case 8:
   case 9:
     $trimesterdatum = date("Y0701");
     $vorigJaar = date("Y")-1;
     $eenJaar = "patient_tp.begindatum between '{$vorigJaar}-10-01' and '{$vorigJaar}-12-31'";
     $meerJaar = "substring(patient_tp.begindatum,5,5) between '10-01' and '12-31'";
     break;
   case 10:
   case 11:
   case 12:
     $trimesterdatum = date("Y1001");
     $ditJaar = date("Y");
     $eenJaar = "patient_tp.begindatum between '{$ditJaar}-01-01' and '{$ditJaar}-03-31'";
     $meerJaar = "substring(patient_tp.begindatum,5,5) between '01-01' and '03-31'";
     break;
}

// denk na over
if (date("m") < 10) {
  $jaardatum = "concat('$vorigJaar',substring(begindatum,6,2),substring(begindatum,9,2))";
}
else {
  $jaardatum = "concat('$ditJaar',substring(begindatum,6,2),substring(begindatum,9,2))";
}


$queryProject = "select * from  tp_project
                 where tp_project.actief = 1";
                   
$resultProject = mysql_query($queryProject);
for ($i=0; $i< mysql_num_rows($resultProject); $i++) {
  $rijProject = mysql_fetch_assoc($resultProject);
  toonProject($rijProject);
}



function toonProject($project) {
  global $trimesterdatum, $eenJaar, $meerJaar, $jaardatum;

  $queryLogins = "select * from logins
                  where actief = 1 and {$project['id']} = tp_project ";
  $resultLogins = mysql_query($queryLogins);
  if (mysql_num_rows($resultLogins) == 0) {
    print("Project {$project['nummer']} - {$project['naam']} heeft g&eacute;&eacute;n logins. <br/>\n");
    return;
  }
  
  for ($i=0; $i< mysql_num_rows($resultLogins); $i++) {
    $rijLogin = mysql_fetch_assoc($resultLogins);
    $emails .= ",{$rijLogin['email']}";
    $logins .= ", {$rijLogin['voornaam']} {$rijLogin['naam']}";
  }
  $emails = substr($emails, 1);
  $namen = substr($namen, 1);

  /* en nu alle patienten zoeken die dit trimester nog geen overleg hebben */
  $queryZonderOverleg =
    "select patient, naam, voornaam from patient, patient_tp left join overleg on overleg.patient_code = patient_tp.patient
     where patient_tp.actief = 1
     and patient.code = patient_tp.patient
     and patient_tp.project = {$project['id']}
     group by patient
     having count(overleg.datum > $trimesterdatum)=0";
  $resultZonderOverleg = mysql_query($queryZonderOverleg) or die($queryZonderOverleg . "<br/>" .  mysql_error());
  if (mysql_num_rows($resultZonderOverleg) > 0) {
    $msg .= "<p>Voor jouw project {$project['nummer']} - {$project['naam']} hebben volgende patienten dit trimester nog g&eacute;&eacute;n overleg: <br/><ul>\n";
    for ($i=0; $i< mysql_num_rows($resultZonderOverleg); $i++) {
      $rijZonderOverleg = mysql_fetch_assoc($resultZonderOverleg);
      $msg .= "<li>{$rijZonderOverleg['patient']} - {$rijZonderOverleg['voornaam']} {$rijZonderOverleg['naam']}</li>\n";
    }
    $msg .= "</ul></p>\n";
  }


  /* en nu alle patienten zoeken die in hun EERSTE jaar te weinig overleggen hebben */
  $queryZonderOverleg =
    "select patient, naam, voornaam, begindatum, count(overleg.datum > $jaardatum) as aantalWel from patient, patient_tp left join overleg on overleg.patient_code = patient_tp.patient
     where patient_tp.actief = 1
     and patient.code = patient_tp.patient
     and patient_tp.project = {$project['id']}
     and $eenJaar
     and overleg.genre = 'TP'
     group by patient
     having count(overleg.datum > $jaardatum)<4";
  $resultZonderOverleg = mysql_query($queryZonderOverleg) or die($queryZonderOverleg . "<br/>" .  mysql_error());
  if (mysql_num_rows($resultZonderOverleg) > 0) {
    $msg .= "<p>Volgende patienten zijn tussen de 6 en 9 maanden geleden gestart en hebben in hun eerste jaar (nog) minder dan de 4 verplichte overleggen!<br/><ul>\n";
    for ($i=0; $i< mysql_num_rows($resultZonderOverleg); $i++) {
      $rijZonderOverleg = mysql_fetch_assoc($resultZonderOverleg);
      $msg .= "<li>{$rijZonderOverleg['patient']} - {$rijZonderOverleg['voornaam']} {$rijZonderOverleg['naam']}, startdatum  {$rijZonderOverleg['begindatum']}: {$rijZonderOverleg['aantalWel']} overleg(gen)</li>\n";
    }
    $msg .= "</ul></p>\n";
  }

  /* en nu alle patienten zoeken die in hun VOLGENDE jaren te weinig overleggen hebben */
  $queryZonderOverleg =
    "select patient, naam, voornaam, begindatum, count(overleg.datum > $jaardatum) as aantalWel from patient, patient_tp left join overleg on overleg.patient_code = patient_tp.patient
     where patient_tp.actief = 1
     and patient.code = patient_tp.patient
     and patient_tp.project = {$project['id']}
     and $meerJaar
     and overleg.genre = 'TP'
     group by patient
     having count(overleg.datum > $jaardatum)<3";
  $resultZonderOverleg = mysql_query($queryZonderOverleg) or die($queryZonderOverleg . "<br/>" .  mysql_error());
  if (mysql_num_rows($resultZonderOverleg) > 0) {
    $msg .= "<p>Van volgende patienten is hun tweede of volgende jaar bijna ten einde en hebben ze (nog) minder dan de 3 verplichte overleggen!<br/><ul>\n";
    for ($i=0; $i< mysql_num_rows($resultZonderOverleg); $i++) {
      $rijZonderOverleg = mysql_fetch_assoc($resultZonderOverleg);
      $msg .= "<li>{$rijZonderOverleg['patient']} - {$rijZonderOverleg['voornaam']} {$rijZonderOverleg['naam']}, startdatum  {$rijZonderOverleg['begindatum']}: {$rijZonderOverleg['aantalWel']} overleg(gen)</li>\n";
    }
    $msg .= "</ul></p>\n";
  }

  // feedback geven
  if ($msg!="") {
    htmlmail($emails, "Herinnering van Listel", "Beste $namen, <br/><br/>$msg");
    print($msg);
  }
}


?>