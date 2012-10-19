<?php







// gegeven $_SESSION['pat_code']



    // zet: session: pat_naam, pat_id

    // zet: lokaal: overlegID, overlegStatus, zorgplanStatus, eersteOverleg, teamStatus

    // zet: lokaal: overlegInfo en patientInfo : array met alles van overleg in DB

    // overlegStatus: - info over zorgplan opstarten + vergoedbaar indien ...

    //                - aantal resterende vergoedbare overleggen, indien ...

    //                - of vervolgoverleg zonder voorwaarden, zonder vergoeding

    //    dus alleen relevant bij nieuw overleg

    //----------------------------------------------------------



if (isset($_SESSION['tp_project']) && ($_SESSION['tp_project'] > 0)) {

  $queryPatient = "select patient.*, patient_tp.*, deelvzw from patient inner join gemeente on gem_id = gemeente.id, patient_tp where patient_tp.actief = 1 and patient.code = patient_tp.patient and code = '{$_SESSION['pat_code']}' and patient_tp.project =  {$_SESSION['tp_project']}";

}

else {

  $queryPatient = "select patient.*, patient_tp.*, deelvzw from (patient inner join gemeente on gem_id = gemeente.id) left join patient_tp on (patient_tp.actief = 1 and patient.code = patient_tp.patient) where code = '{$_SESSION['pat_code']}'";

}



if (!isset($overlegVoorwaarde)) {
  if ($_SESSION['profiel']=="menos") {
    $overlegVoorwaarde .= " and genre = 'menos' ";
  }
  else if ($_SESSION['profiel']=="psy") {
    $overlegVoorwaarde .= " and genre = 'psy' ";
  }
  else {
    $overlegVoorwaarde .= " and (genre = '' or genre is NULL or genre in ('gewoon','psy','TP'))";
  }
}


$queryOverleg = "SELECT * FROM overleg WHERE patient_code = '{$_SESSION['pat_code']}' AND afgerond=0 $overlegVoorwaarde";


//die($queryOverleg);

if (!(($resultPatient = mysql_query($queryPatient)) && ($resultOverleg = mysql_query($queryOverleg)))) {

   die("ne stoemme fout in die queries $queryOverleg of $queryPatient");

}

else {

  if (mysql_num_rows($resultPatient) != 1) {

    die("$queryPatient fout mag nooit voorkomen. Hoe is het mogelijk?");

  }

  else {

    $patientInfo = mysql_fetch_array($resultPatient);
    //print_r($patientInfo);
    if ($patientInfo['deelvzw']=="") $patientInfo['deelvzw']="H";
    $_SESSION['pat_naam'] = $patientInfo['naam'];

    $_SESSION['pat_voornaam'] = $patientInfo['voornaam'];

    $_SESSION['pat_id'] = $patientInfo['id'];

  }

  // is er een huidig overleg?
 if (mysql_num_rows($resultOverleg) == 0) {
    $overlegID = -1;
  }
  else {
    $overlegInfo = mysql_fetch_array($resultOverleg);
    $overlegID = $overlegInfo['id'];
    if (issett($overlegInfo['katz_id'])) {
      $katzInfo = mysql_fetch_array(mysql_query("select * from katz where id = {$overlegInfo['katz_id']}"));
    }
  }

  require("../includes/overleg_berekenTeamStatus.php");



  $eersteOverleg = isEersteOverleg();



  if ($eersteOverleg) {

    // ja, dit is het eerste

    $zorgplanStatus = berekenZorgplanStatus();

  }

  else {

    $zorgplanStatus = "NVT";

  }





  if ($overlegID == -1 || (!issett($overlegID))) {

    $jaarLang = date("Y");

  }

  else {

    $jaarLang = substr($overlegInfo['datum'],0,4);

    $ditOverlegNietMeetellen = " AND id <> {$overlegID} ";

  }
  


  if ($_SESSION['profiel']=="menos") {
    $overlegStatus = "__;Een menos-overleg is nooit vergoedbaar.";
  }


  else if ($jaarLang < 2003 || ($jaarLang == 2003 && substr($overlegInfo['datum'],4,2) < 7)) {

      $overlegStatus = "KO;Dit is een oud overleg zonder mogelijkheid tot vergoeding in het kader van GDT.";

  }

  else {


    if ($pvsVraag = mysql_fetch_array(mysql_query("select type from patient where code = '{$_SESSION['pat_code']}'"))) {
      $gewonePatient = (($pvsVraag['type'] != 1));
    }
    else {
      die("miljaar geen pat_type");
    }

    if ($pvsVraag['type']==16 ||  $pvsVraag['type']==18) {
       $alleenOverlegPsy = " and overleg.genre = 'psy' ";
    }

   $ditJaarQry = "select * from overleg

                  where substring(datum,1,4) = $jaarLang

                  and keuze_vergoeding = 1

                  and patient_code = '{$_SESSION['pat_code']}'
                  $overlegVoorwaarde
                  $alleenOverlegPsy
                  $ditOverlegNietMeetellen";

    $aantalDitJaar = mysql_num_rows(mysql_query($ditJaarQry)) ;


    if ($pvsVraag['type']==16 ||  $pvsVraag['type']==18) {
      $nogRechtOp = 3 - $aantalDitJaar;
    }
    else if ($gewonePatient) {
      $nogRechtOp = 1 - $aantalDitJaar;
    }
    else {
      $nogRechtOp = 4 - $aantalDitJaar;
      // pvs-patienten hebben recht op 4 vergoedbare overleggen per jaar
    }

    if ($pvsVraag['type'] == 7) {
      $overlegStatus = "__;Bij deze patient heeft enkel de organisator recht op een vergoeding (als aan alle voorwaarden voldaan is).";
    }
    else if ($nogRechtOp <= 0 && ($overlegID == -1 || (!issett($overlegID)))) {

      $overlegStatus = "__;Deze patient heeft in $jaarLang geen recht meer op een vergoeding voor de deelnemers aan een overleg.<br/>De organisator kan wel nog vergoed worden.";

    }

    else if ($nogRechtOp == 0) {

      $overlegStatus = "__;Dit is een vervolgoverleg. Er is alleen nog de mogelijkheid tot vergoeding in het kader van GDT, als aan alle voorwaarden voldaan is.";
    }

    else if ($nogRechtOp == 1) {

      $overlegStatus = "__;Tip: Deze patient heeft in $jaarLang nog recht op 1 vergoedbaar overleg voor de deelnemers.<br />De organisator kan ook nog vergoed worden."

                       ; // . "Hiervoor moeten er op het overleg minstens 3 zorg- en hulpverleners zijn waaronder een huisarts.";

    }

    else {

      $overlegStatus = "__;Tip: Deze patient heeft in $jaarLang nog recht op $nogRechtOp vergoedbare overleggen voor de deelnemers.<br />De organisator kan ook nog vergoed worden. "
                         ; // . "Hiervoor moeten er op het overleg minstens 3 zorg- en hulpverleners zijn waaronder een huisarts.";

    }

  }

  



  if (isEersteOverlegTP()) {

    if ($_SESSION['tp_project'] == $_TP_FOR_K)

      $overlegStatus = "OK;Plan nu de inclusievergadering voor For-K.";

    else

      $overlegStatus = "OK;Plan nu de inclusievergadering. Elke partner moet vertegenwoordigd zijn.";

  }

  else if (is_tp_patient()) {

    if ($_SESSION['tp_project'] == $_TP_FOR_K)

      $overlegStatus = "OK;Plan nu een vervolgoverleg voor For-K.";

    else

      $overlegStatus = "OK;Plan nu een vervolgoverleg. Minstens 3 partners moeten vertegenwoordigd zijn.";

  }
  else if ($_SESSION['profiel']=="menos") {
    $overlegStatus = "__;Een menos-overleg is nooit vergoedbaar.";
  }

  else if ($eersteOverleg) {

    if ($patientInfo['type']==16 || $patientInfo['type']==18) {
      $overlegStatus = "__;Je kan nu het eerste overleg plannen.<br />  " ;
    }
    else {
      $overlegStatus = "__;Het zorgplan rond deze pati&euml;nt kan hier opgestart worden. De Katz-score moet ingevuld worden ".
                       " en er dient met minstens de juiste partners overlegd te worden.<br />  " ;
    }
    if ($patientInfo['type']<7)
       $overlegStatus .= "Dit overleg kan bovendien vergoed worden, indien aan bepaalde voorwaarden voldaan wordt.";



 /*

    $overlegStatus = "<p>Aangezien dit het eerste overleg is voor deze hulpbehoevende en " .

        "dit dus de opstart van een zorgplan betreft, is het noodzakelijk dat er voldaan is " .

            "aan volgende eisen:</p><ul> " .

                "<li>een KATZ-score van minimaal 5</li> " .

               " <li>een vertegenwoordiging van de juiste personen op het eerste overleg</li></ul> " .

            " <p>alvorens de nodige documenten geprint kunnen worden.</p>" . $overlegStatus;

 */

  }

}





$teamStatus = berekenTeamStatus();

$nietVergoedbaar = (substr($teamStatus, 0, 2) == "KO");



if ($nietVergoedbaar) {
  $vergoedbaarheid = "false";
}
else {
  $vergoedbaarheid = "true";
}


?>

<script language="javascript">

 var vergoedbaar = <?= $vergoedbaarheid ?>;

</script>