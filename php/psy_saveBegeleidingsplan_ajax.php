<?php

function wisDomeinen() {
    $deleteMensen = "delete from psy_plan_mens where plan in (select id from psy_plan where overleg_id = {$_POST['overlegID']})";
    mysql_query($deleteMensen) or die("Ik kan de oude mensen niet wissen. $deleteMensen" . mysql_error());
    
    $deletePlan = "delete from psy_plan where overleg_id = {$_POST['overlegID']}";
    mysql_query($deletePlan) or die("Ik kan de oude plannen niet wissen." . mysql_error());
}

function saveDomein($domein, $nr) {
   global $aantalDomeinen, $domeinenAl, $allesIngevuld;
   

    $persoon = "{$domein}Persoon{$nr}";
    $afspraak = "{$domein}Afspraak{$nr}";
    $einddatum = "{$domein}Einddatum{$nr}";

    if (!isset($_POST[$afspraak])) return;
    
    $afspraakTekst = $_POST[$afspraak];
    $einddatumTekst = $_POST[$einddatum];
    if ($afspraakTekst=="" && $einddatumTekst=="") {saveDomein($domein, $nr+1);}
    else {
      if (trim($afspraakTekst) == "" || trim($einddatumTekst) == "") $allesIngevuld = false;
      
      $insertPlan = "insert into psy_plan (domein, overleg_id, afspraak, einddatum) values
                                          ('$domein', {$_POST['overlegID']}, \"{$afspraakTekst}\", \"{$einddatumTekst}\")";
      mysql_query($insertPlan) or die("Je mag geen dubbele aanhalingstekens gebruiken." . mysql_error());
      $planNummer = mysql_insert_id();
      $ditDomeinOK = false;
      if (isset($_POST[$persoon])) {
        foreach ($_POST[$persoon] as $wie) {
          $streep = strpos($wie,"|");
          $genre = substr($wie, 0, $streep);
          if ($genre == "hulp") $ditDomeinOK = true;
          $persoon_id = substr($wie, $streep+1);
          $insertMens = "insert into psy_plan_mens (plan, persoon_id, genre) values ($planNummer, $persoon_id, '$genre')";
          mysql_query($insertMens) or die("Ik kan de mens niet toevoegen." . mysql_error());
        }
      }
      else {
        print("_");
      }
    }
    if ($ditDomeinOK && !in_array($domein,$domeinenAl)) {
      $aantalDomeinen++;
      $domeinenAl[$domein]=$domein;
    }
    saveDomein($domein, $nr+1);
}

session_start();

   require("../includes/dbconnect2.inc");

    // eerst nakijken of er een code is meegegeven én of die code bestaat
    // als er geen code ingegeven is, kijken we naar toegang
    if (isset($_POST['code'])) {
       $qryCode = "select * from overleg where logincode = \"{$_POST['code']}\" and contact_hvl = {$_POST['hvl_id']}";
       if ($codeResult = mysql_query($qryCode)) {
          if (mysql_num_rows($codeResult) == 1) {
            $overlegInfo = mysql_fetch_array($codeResult);
            $overlegID = $overlegInfo['id'];
            $_SESSION['pat_code'] = $overlegInfo['patient_code'];
            $binnenViaCode = true;
          }
       }
       else {
         die("stomme code-query  $qryCode");
       }
    }

   if ((isset($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan")) || $binnenViaCode) {
     if (!isset($_POST['patient']) || !isset($_POST['overlegID'])) {
       print("KO");
     }
     else {
       $aantalDomeinen = 0;
       $domeinenAl = array();
       $allesIngevuld = true;
       wisDomeinen();
       saveDomein("basis",1);
       saveDomein("woon",1);
       saveDomein("gemeenschap",1);
       saveDomein("taal",1);
       saveDomein("maatschappij",1);
       saveDomein("werk",1);
       saveDomein("gezin",1);
       saveDomein("school",1);
       saveDomein("sociaal",1);
       saveDomein("motoriek",1);
       saveDomein("persoonlijk",1);

       if (isset($_POST['volgendeDatum'])) {
         $updateVolgendeDatum = ", volgende_datum = {$_POST['volgendeDatum']}";
       }
       $qrySituatie = "update overleg set psy_algemeen = \"{$_POST['psy_algemeen']}\",
                                          psy_doelstellingen = \"{$_POST['psy_doelstellingen']}\"
                                          $updateVolgendeDatum
                        where id = {$_POST['overlegID']}";
       if (mysql_query($qrySituatie)) print("OK");
       else print("KO.Ik kan de tekstvakken niet opslaan ($qry)");

       // katz_aanvraag wissen
       $deleteKatzAanvraag = "delete from katz_aanvraag where overleg = {$_POST['overlegID']} and (wat='begeleidingsplan')";
       mysql_query($deleteKatzAanvraag);

       print("OK");
       if (!heeftGGZTaak($_POST['overlegID']) && $aantalDomeinen < 3) print("----");
       else if ($aantalDomeinen < 3) print("---");
       else if (!heeftGGZTaak($_POST['overlegID'])) print("--");
       
       if (!$allesIngevuld) {
         print("NIETALLESINGEVULD");
       }
     }
  }
  else print("KO;Geen toegang");

  require("../includes/dbclose.inc");





//---------------------------------------------------------

/* Sluit Dbconnectie */ require("../includes/dbclose.inc");

//---------------------------------------------------------

?>