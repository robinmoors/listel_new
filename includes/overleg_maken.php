<?php

  /*********************************
   * en nog alle aanvragen overleg voor deze patient die nog niet de juiste status hebben
     status 'overleg' geven ********
   *********************************/


if (IsSet($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan"))

	{

  if ($_SESSION['profiel']=="menos") {
    $overlegGenre = 'menos';
    $overlegVoorwaarde = " and overleg.genre = 'menos' ";
  }
  else if ($_SESSION['profiel']=="psy") {
    $overlegGenre = 'psy';
    $overlegVoorwaarde = " and overleg.genre = 'psy' ";
  }
  else {
    $overlegVoorwaarde = " AND (overleg.genre is NULL or overleg.genre in ('gewoon','psy','TP')) ";
  }


  // kijken of er een overleg op dezelfde datum is

  $zoekQry = "select * from overleg

              where datum = {$_POST['overleg_jj']}{$_POST['overleg_mm']}{$_POST['overleg_dd']}

              and patient_code = '{$_SESSION['pat_code']}'
              $overlegVoorwaarde
              order by datum desc

              limit 0,1";



  $overlegZelfdeDagResult = mysql_query($zoekQry);

  if (mysql_num_rows($overlegZelfdeDagResult) > 0) {

     die("<h3>Er is al een overleg op deze dag ({$_POST['overleg_dd']}/{$_POST['overleg_mm']}/{$_POST['overleg_jj']}) ingegeven.</h3>

            <p>Je mag maar &eacute;&eacute;n overleg per dag per pati&euml;nt plannen. </p>");

  }



  // kijken of er een vorig overleg is om de coordinatoren op te halen

  $zoekQry = "select * from overleg

              where datum < {$_POST['overleg_jj']}{$_POST['overleg_mm']}{$_POST['overleg_dd']}

              and patient_code = '{$_SESSION['pat_code']}'
              $overlegVoorwaarde
              order by datum desc

              limit 0,1";



  $vorigOverlegResult = mysql_query($zoekQry);

  if (mysql_num_rows($vorigOverlegResult) == 1) {

    $vorigOverleg = mysql_fetch_array($vorigOverlegResult);

    if (isset($vorigOverleg['contact_hvl'])) {

      $extraV = " contact_hvl, ";

      $extraI = " {$vorigOverleg['contact_hvl']}, ";

    }

    if (isset($vorigOverleg['contact_mz'])) {

      $extraV .= " contact_mz, ";

      $extraI .= " {$vorigOverleg['contact_mz']}, ";

    }
    if (isset($vorigOverleg['psy_algemeen'])) {
      $extraV .= " psy_algemeen, ";
      $extraI .= " \"{$vorigOverleg['psy_algemeen']}\", ";
    }
    if (isset($vorigOverleg['psy_doelstellingen'])) {
      $extraV .= " psy_doelstellingen, ";
      $extraI .= " \"{$vorigOverleg['psy_doelstellingen']}\", ";
    }

  }


  if ($_SESSION['profiel']=="menos") {
    $genreVeld = " genre, ";
    $genreValue = " 'menos', ";
    $tp_rechtenOC = 0;
  }
  else if ($patient['type']==16 || $patient['type']==18) {
    $genreVeld = " genre, ";
    $genreValue = " 'psy', ";
    $tp_rechtenOC = 1;
  }
  else if ($patient['actief']==-1) {
    $aanwezigVeld = " aanwezig_patient, ";
    $aanwezigValue = " \"{$_POST['aanwezig_patient']}\", ";
    $genreVeld = " genre, ";
    $genreValue = " 'TP', ";
    $vandaag = date("Ymd");
    $qryRechtenOC = "select * from patient_tp
                     where patient = \"{$_SESSION['pat_code']}\"   and actief = 1
                       and rechtenOC > 0 and rechtenOC <= $vandaag";
    // tp_rechtenOC nog zetten
    if (mysql_num_rows(mysql_query($qryRechtenOC)) == 1) {
       $tp_rechtenOC = 1;
    }
    else {
       $tp_rechtenOC = 0;
    }
  }
  else {
    $tp_rechtenOC = 1;
  }



	//----------------------------------------------------------

	// een overlegrecord starten



        $passlength = 16;

        $pass = "";

        $i = 0;

        while($i <= $passlength)

        {

          $pass .= chr(rand(65,90));

          $i++;

        }



  $datum =  $_POST['overleg_jj'].$_POST['overleg_mm'].$_POST['overleg_dd'];



  if ($_POST['ombvermoeden'] == 1) {

    $ombactief = 1;

  }

  else if ($_POST['ombvermoeden'] == -1)  {

    $ombactief = -1;

  }

  else {

    $ombactief = 0;

  }
  
  if ($_SESSION['profiel']=="OC") {
    $toegewezenGenre = "gemeente";
    $toegewezenID = 0;
  }
  else if ($_SESSION['profiel']=="rdc") {
    $toegewezenGenre = "rdc";
    $toegewezenID = $_SESSION['organisatie'];
  }
  else if ($_SESSION['profiel']=="hulp") {
    $toegewezenGenre = "hulp";
    $toegewezenID = $_SESSION['usersid'];
  }
  else if ($_SESSION['profiel']=="menos") {
    $toegewezenGenre = "menos";
    $toegewezenID = 0;
  }
  else if ($_SESSION['profiel']=="psy") {
    $toegewezenGenre = "psy";
    $toegewezenID = $_SESSION['organisatie'];
  }
  else {
    $toegewezenGenre = "TP";
    $toegewezenID = $_SESSION['usersid'];
  }

  if ($_POST['patient_type']==7 || $_POST['patient_type']==16 || $_POST['patient_type']==18) {
    $soortProblematiek = "psychisch";
  }
  else {
    $soortProblematiek = "fysisch";
  }

	$overlegQry="

		INSERT INTO

			overleg

				(datum,

				patient_code,

        coordinator_id,

        $extraV

        logincode,

        $aanwezigVeld

        $genreVeld

        tp_rechtenOC,

        locatieTekst,

        tijdstip,

        omb_actief,

        toegewezen_genre,
        toegewezen_id,
        soort_problematiek
        )

		VALUES

				($datum,

				\"{$_SESSION['pat_code']}\",

        {$_SESSION['usersid']},

        $extraI

        '$pass',

        $aanwezigValue

        $genreValue

        $tp_rechtenOC,

        \"{$_POST['overleg_locatie']}\",

        \"{$_POST['overleg_uur']}\",

        $ombactief,

        '$toegewezenGenre',
        $toegewezenID,
        '$soortProblematiek')";

		$result=mysql_query($overlegQry);

		if ($result) {

      $overlegID=mysql_insert_id();
      if (!isset($vorigOverleg)) {
         mysql_query("update patient set startdatum = $datum where code = '{$_SESSION['pat_code']}'");
         $qryBeginDatum = "update patient_psy
                        set startdatum = $datum
                        where (startdatum > $datum or startdatum is null or startdatum = 0)
                          and code = '{$_SESSION['pat_code']}' ";
         mysql_query($qryBeginDatum) or die("Problemen met het instellen van de startdatum");
      }

      if ($patient['actief']==-1) {

        // overleg_tp_plan invullen op basis van huidige betrokkenen en organisaties

        // GDT Listel is organisatie 13

        $selectBetrokkenen = "select * from huidige_betrokkenen where overleggenre = 'gewoon' AND patient_code = '{$_SESSION['pat_code']}'";

        $resultBetrokkenen = mysql_query($selectBetrokkenen) or die("kan de huidige betrokkenen niet ophalen");

        $values = "";

        for ($b = 0;  $b < mysql_num_rows($resultBetrokkenen); $b++) {

          $rijB = mysql_fetch_assoc($resultBetrokkenen);

          $values .= ", ($overlegID,{$rijB['persoon_id']},\"{$rijB['genre']}\") ";

        }

        $insertPlan = "insert into overleg_tp_plan (overleg, persoon, genre) values ($overlegID, 13, 'org') $values"; // gdt listel is organisatie 13

        mysql_query($insertPlan) or die("projectplan niet geinitialiseerd omwille van $insertPlan<br/>" . mysql_error());

        

        if (isEersteOverlegTP_op($datum)) {

           $datedatum = substr($datum, 0, 4) . "-" . substr($datum, 4, 2) . "-" . substr($datum, 6, 2);

           $updatePatientTP = "update patient_tp set begindatum = \"$datedatum\" where patient = \"{$_SESSION['pat_code']}\" and actief = 1";

           mysql_query($updatePatientTP) or die("$updatePatientTP geeft volgende fout: ". mysql_error());

           //  print($updatePatientTP );

        }

        // else print("dit is NIET het eerste overleg");

      }

      if ($_POST['patient_type']==16 || $_POST['patient_type']==18) {
        if ($vorigOverleg['id'] > 0) {
          // begeleidingsplan overkopieren!
          // $overlegID  -- $vorigOverleg
          $zoekBPQ = "select * from psy_plan where overleg_id = {$vorigOverleg['id']} order by id";
          $zoekBP = mysql_query($zoekBPQ) or die("kan het vorige begeleidingsplan niet ophalen" .$zoekBPQ);
          for ($bpi = 0; $bpi < mysql_num_rows($zoekBP); $bpi++) {
            $oudPlan = mysql_fetch_assoc($zoekBP);
            $nieuwBPQ = "insert into psy_plan (domein, overleg_id, afspraak, einddatum)
                            values (\"{$oudPlan['domein']}\",$overlegID,\"{$oudPlan['afspraak']}\",\"{$oudPlan['einddatum']}\")";
            mysql_query($nieuwBPQ) or die("kan het begeleidingsplan niet overkopieren.");
            $planId = mysql_insert_id();
            $zoekPersoonQ = "select * from psy_plan_mens where plan = {$oudPlan['id']}";
            $personen = mysql_query($zoekPersoonQ) or die("kan het vorige begeleidingsplan niet ophalen. $zoekPersoonQ");
            for ($m = 0; $m < mysql_num_rows($personen); $m++) {
              $oudMens = mysql_fetch_assoc($personen);
              $mensQ = "insert into psy_plan_mens (plan, persoon_id, genre)
                            values ($planId,{$oudMens['persoon_id']},\"{$oudMens['genre']}\")";
              mysql_query($mensQ) or die("kan de uitvoerder van het begeleidingsplan niet overkopieren. $mensQ");
            }
          }
          // crisisplan overkopieren!
          $zoekCQ = "select * from psy_crisis where overleg_id = {$vorigOverleg['id']} order by id";
          $zoekC = mysql_query($zoekCQ) or die("kan het vorige crisisplan niet ophalen" .$zoekCQ);
          if (mysql_num_rows($zoekC) ==1) {
            $oudCrisis = mysql_fetch_assoc($zoekC);
            $nieuwCQ = "insert into psy_crisis (overleg_id, crisis_id, crisis_genre, crisissituatie)
                            values ($overlegID,{$oudCrisis['crisis_id']},\"{$oudCrisis['crisis_genre']}\",\"{$oudCrisis['crisissituatie']}\")";
            mysql_query($nieuwCQ) or die("kan het crisisplan niet overkopieren.");
            
          }
        }
      }

    }

    else

      die($overlegQry . mysql_error());

  }

  /*********************************
   * en nog alle aanvragen overleg voor deze patient die nog niet de juiste status hebben
     status 'overleg' geven ********
   *********************************/
   
   $rr = getUniqueRecord("select rijksregister from patient where code = '{$_SESSION['pat_code']}'");

   if (isset($_POST['laat'])) {
     $reden_status = ", reden_status = '{$_POST['laat']}' ";
   }

   $qryAanvraagOverleg = "update aanvraag_overleg set status = 'overleg', overleg_id = $overlegID, id_organisator_user = {$_SESSION['usersid']}
                                                      $reden_status
                          where rijksregister = {$rr['rijksregister']} and status in ('aanvraag','overname','overname_aangevraagd')";
   mysql_query($qryAanvraagOverleg) or print("<h1>Ik kan niet aanduiden dat alle aanvragen voor een overleg voor deze patient vervuld zijn.</h1>");

   //print_r($_POST);
   // als het direct een nieuw overleg is, alles juist invullen alsof de aanvraag direct gebeurd is
   if ($_POST['zonderAanvraag']==1) {
       $nu = time();
       
       $stuk = explode("|",$_POST['aanvrager_complex']);
       $orgAanvrager = $stuk[0];
       $genre = $stuk[1];
       $naamAanvrager = $stuk[2];
       $datum = date("d/m/Y");
       
       $insert = "insert into aanvraag_overleg (
                     timestamp,
                     rijksregister,
                     patient_code,
                     discipline_aanvrager,
                     organisatie_aanvrager,
                     doel,
                     naam_aanvrager,
                     status,
                     overleg_id,
                     ontvangst
                  )
                  values (
                     $nu,
                     {$rr['rijksregister']},
                     '{$_SESSION['pat_code']}',
                     '$genre',
                     '$orgAanvrager',
                     'opvolgoverleg (default)',
                     '$naamAanvrager',
                     'overleg',
                     $overlegID,
                     '$datum'
                  )";
       mysql_query($insert) or die("probleem met $insert" .mysql_error());
   }

	//----------------------------------------------------------

	//----------------------------------------------------------



	

//---------------------------------------------------------

/* Geen Toegang */ include("../includes/check_access.inc");

//---------------------------------------------------------

?>