<?php
session_start();

//----------------------------------------------------------

/* Maak Dbconnectie */ require('../includes/dbconnect2.inc');

//----------------------------------------------------------



$paginanaam="Patientgegevens aanpassen";

if (IsSet($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan"))

	{

	require("../includes/html_html.inc");

	print("<head>");

	require("../includes/html_head.inc");



//------------------------------------------------------------------------------------

/* Haal patientgegevens op basis van pat_nr */ //require("../includes/patient_geg.php");

//------------------------------------------------------------------------------------

//-----------------------------------------------------------------------------

/* Controle numerieke velden */ require("../includes/checkForNumbersOnly.inc");

//-----------------------------------------------------------------------------

//-----------------------------------------------------------------

/* Maak gemeenteLijst */ require('../includes/list_gemeentes.php');

//-----------------------------------------------------------------

//---------------------------------------------------------------------

/* Maak mutLijst */ require('../includes/list_mutualiteiten.php');

//---------------------------------------------------------------------

	print("</head>");

	print("<body>");

	print("<div align=\"center\">");

	print("<div class=\"pagina\">");

	include("../includes/header.inc");

	include("../includes/pat_id.inc");

	print("<div class=\"contents\">");

	include("../includes/menu.inc");

	print("<div class=\"main\">");

	print("<div class=\"mainblock\">");

		

	if(isset($_GET['nr'])){$_SESSION['nr']=$_GET['nr'];}

	if(isset($_POST['nr'])){$_SESSION['nr']=$_POST['nr'];}


//---------------------------------------------
// Haal de patientengegevens op

if (isset($_POST['code']))  {
  $_SESSION['pat_code']=$_POST['code'];
}

if (isset($_POST['pat_code'])) {
  $_SESSION['pat_code']=$_POST['pat_code'];
}

if (isset($_GET['patient'])) {
  $_SESSION['pat_code'] = $_GET['patient'];
}
if (isset($_GET['code']))  {
  $_SESSION['pat_code']=$_GET['code'];
}

    $query = "
        SELECT
          p.*,
          l.dlnaam, l.dlzip, l.zip,
          v.naam as verz_naam ,
          v.nr as verz_nr
        FROM
            patient p,
            gemeente l,
            verzekering v
        WHERE
            p.code='".$_SESSION['pat_code']."'   AND
            p.gem_id=l.id AND
            (v.id=p.mut_id OR (p.mut_id = 0 AND v.id = 1))";

	// nr=".$_SESSION['nr']." AND
    if ($result = mysql_query($query) or die("$query " . mysql_error()))
    {// Een uitvoerbare Query
        if (mysql_num_rows($result)<>0 )
        {
           //---------------------------------------------
           // een correcte record gevonden
           //---------------------------------------------
           $records= mysql_fetch_assoc($result);
           //print_r($records);
         }
         else {
           //---------------------------------------------------------
           /* Sluit Dbconnectie */ require("../includes/dbclose.inc");
           //---------------------------------------------------------
           die("$query geen patient gevonden!");
         }
     }

// optie 1: uit archief halen of van Menos halen
if ($_GET['activeer']==1 || $_GET['vanMenos']==1) {
  mysql_query("update patient set actief = 1, einddatum = 0 where code = \"{$_GET['patient']}\"") or print("Het heractiveren van deze pati&euml;nt is niet gelukt.");
  //die("geactiveerd");
}
// optie 2: van gewoon bijkomend naar Menos
else if (($_GET['eigenlijkNieuw']==1) && ($_SESSION['profiel']=="menos")) {
  // een bestaande patient opnemen bij menos
  $qryActiveerMenos = "update patient set menos = 1 where code = \"{$_GET['patient']}\"";
  $qryMenos = "insert into patient_menos (patient, begindatum) values (\"{$_GET['patient']}\", NOW())";

  /******** overname van zorgteam ********/
  $qry1="
    SELECT *
    FROM huidige_betrokkenen
    WHERE overleggenre = 'gewoon' and patient_code=\"{$_GET['patient']}\" order by id";
  //print($qry1);
  if ($result1=mysql_query($qry1))
  {
    for ($i=0; $i < mysql_num_rows ($result1); $i++)
    {
      $records1= mysql_fetch_array($result1);
      if ($records1['namens']>0) {
        $qry2a="
            INSERT INTO
                huidige_betrokkenen
                    (
                    patient_code,
                    persoon_id,
                    genre,
                    aanwezig,
                    namens,
                    rechten,
                    overleggenre)
            VALUES
                (\"{$_GET['patient']}\","
                .$records1['persoon_id'].",'"
                .$records1['genre']."',
                0,"
                .$records1['namens'].",
                {$records1['rechten']},
                'menos')";
      }
      else {
        $qry2a="
            INSERT INTO
                huidige_betrokkenen
                    (
                    patient_code,
                    persoon_id,
                    genre,
                    aanwezig,
                    rechten,
                    overleggenre)
            VALUES
                (\"{$_GET['patient']}\","
                .$records1['persoon_id'].",'"
                .$records1['genre']."',
                0,
                {$records1['rechten']},
                'menos')";
      }
      $testQry = "select * from huidige_betrokkenen where   overleggenre = 'menos'
                                                            and patient_code = \"{$_GET['patient']}\"
                                                            and persoon_id = {$records1['persoon_id']}
                                                            and genre = '{$records1['genre']}'";
      $testResult = mysql_query($testQry) or die("kan niet nagaan of deze huidige betrokkenen al bestaat $testQry" . mysql_error());
      if (mysql_num_rows(mysql_query($testQry))==0) {
        if (!(mysql_query($qry2a))) {
          print("<h1>begot: $qry2a ukt niet <br>" . mysql_error() . "</h1>");
        }
      }
      //print($qry2);
    }
  }
  /******** einde overname van zorgteam ********/

  if (bestaatInMenos($_GET['patient'])) {
    if (!(mysql_query($qryMenos))) {
      print("<p>Er was een probleempje met het includeren in Menos, maar als je ons dat laat weten, gaan we het snel fixen!</p>");
    }
  }
  else {
    if (!(mysql_query($qryActiveerMenos) && mysql_query($qryMenos))) {
      print("<p>Er was een probleempje met het includeren in Menos, maar als je ons dat laat weten, gaan we het snel fixen!</p>");
    }
  }

}
// optie 3: van gewoon naar TP
else if (($_GET['eigenlijkNieuw']==1) && ($_SESSION['profiel']=="hoofdproject")) {
  // een nieuwe opname in het therapeutisch project
  $qryActiefMinEen = "update patient set actief = -1, einddatum = 0 where code = \"{$_GET['patient']}\"";
  $alTP = "select * from patient_tp where patient = \"{$_GET['patient']}\" AND actief = 1";
  $resultAL = mysql_query($alTP);
  if (mysql_num_rows($resultAL) > 0) {
    die("<strong>Deze patient is al opgenomen in een therapeutisch project. E&eacute;ntje is al genoeg! Deze patient kan je dus niet includeren.</strong>");
  }

  $nogOpenOverleg = "select * from overleg where patient_code = \"{$_GET['patient']}\" AND afgerond = 0";
  $resultAL = mysql_query($nogOpenOverleg);
  if (mysql_num_rows($resultAL) > 0) {
    die("<strong>Deze patient heeft nog een openstaand overleg. Zolang dit niet afgesloten is, mag en kan je deze pati&euml;nt niet includeren. Neem eventueel contact op met de OC TGZ om dat overleg af te laten ronden.</strong>");
  }

  $qryTP = "insert into patient_tp (patient, project, begindatum) values (\"{$_GET['patient']}\", {$_SESSION['tp_project']}, NOW())";
  mysql_query($qryTP);

  // en nu verwijzing naar TP-record opslaan in patient
          $qryUpdatePatient = "update patient set tp_record = " . mysql_insert_id() . " where code = '{$_GET['patient']}'";
          if (!(mysql_query($qryUpdatePatient))) {
            print("<p>Kan geen verwijzing naar het tp-record opslaan.</p>");
          }
  mysql_query($qryActiefMinEen);
  // alle partners toevoegen aan de huidige_betrokkenen van de patient
          $qryPrefix = "insert into huidige_betrokkenen (patient_code, genre, overleggenre, persoon_id) values (\"{$_GET['patient']}\", 'org', 'gewoon', ";
          $qryPartners = "select * from tp_partner where tp = {$_SESSION['tp_project']}";
          $resultPartners  = mysql_query($qryPartners);
          $ok = true;
          for ($i=0; $i<mysql_num_rows($resultPartners); $i++) {
              $partner = mysql_fetch_assoc($resultPartners);
              $qryInsert = $qryPrefix . " {$partner['partner']});";
              $ok = $ok && mysql_query($qryInsert);
          }
          if (!$ok) print("<p><strong>FOUT</strong>. Kan de partners niet opslaan :-(. " . mysql_error());

  // een mail sturen naar OC en hoofdprojectcoordinator met melding dat patient is overgenomen
  $alGDToverleg = "select * from overleg where patient_code = \"{$_GET['patient']}\" AND (genre is NULL or genre = 'gewoon')";
  $resultALgdt = mysql_query($alGDToverleg);

  if (mysql_num_rows($resultALgdt) > 0) {
    $qryOC = "select logins.* from logins, gemeente, patient where profiel = 'OC'
              and overleg_gemeente = zip and patient.gem_id = gemeente.id and patient.code =  \"{$_GET['patient']}\"
              and login not like '%help%' and logins.actief = 1";
    $resultOC = mysql_query($qryOC);
    for ($i=0; $i<mysql_num_rows($resultOC); $i++) {
       $oc  = mysql_fetch_assoc($resultOC);
       $namen .= ", {$oc['naam']} {$oc['voornaam']}";
       $adressen .= ", {$oc['email']}";
    }

    $qryPC = "select logins.* from logins, patient_tp where profiel = 'hoofdproject'
              and patient_tp.project = logins.tp_project and patient_tp.patient =  \"{$_GET['patient']}\"
              and login not like '%help%' and logins.actief = 1";
    $resultPC = mysql_query($qryPC);

    for ($i=0; $i<mysql_num_rows($resultPC); $i++) {
       $pc  = mysql_fetch_assoc($resultPC);
       $namen .= ", {$pc['naam']} {$pc['voornaam']}";
       $adressen .= ", {$pc['email']}";
    }

    $namen = substr($namen, 1);
    $adressen = substr($adressen, 1);

    htmlmail($adressen,"Listel: Opname patient in therapeutisch project","Beste $namen<br/>De pati&euml;nt {$_GET['patient']} is opgenomen in een therapeutisch project o.l.v.
       {$pc['naam']} {$pc['voornaam']}. Hierdoor kan de overlegco&ouml;rdinator g&eacute;&eacute;n overleggen plannen tot de hoofdprojectco&ouml;rdinator hiervoor
       expliciet toestemming geeft. \n<br />Voor meer inlichtingen kan je via elkaars emailadressen ($adressen) contact opnemen met elkaar.<br/><p>Met dank voor uw medewerking, <br />Het LISTEL e-zorgplan www.listel.be </p>");
  }
}
// optie4: van TP naar psy
else if ($_GET['overnemen']=="psy" || ($records['actief']==-1 && $_SESSION["profiel"]=="psy") ) {

  $nogOpenOverleg = "select * from overleg where patient_code = \"{$_GET['patient']}\" AND afgerond = 0";
  $resultAL = mysql_query($nogOpenOverleg);
  if (mysql_num_rows($resultAL) > 0) {
    die("<strong>Deze patient heeft nog een openstaand overleg. Zolang dit niet afgesloten is, mag en kan je deze pati&euml;nt niet includeren. Neem eventueel contact op met de OC TGZ om dat overleg af te laten ronden.</strong>");
  }

  $vanTP = "<input type=\"hidden\" name=\"vanTP\" value=\"1\"/>\n";
  
  
  if ($_SESSION['profiel']=="OC") {
    $toegewezenGenre = "gemeente";
  }
  else {
    $toegewezenGenre = $_SESSION['profiel'];
  }
  if ($_SESSION['profiel']=="rdc" || $_SESSION['profiel']=="psy") {
    $toegewezenId = $_SESSION['organisatie'];
  }
  else {
    $toegewezenId = $_SESSION['usersid'];
  }

  $qryNaarPsy = "update patient set actief = 1, toegewezen_genre = '$toegewezenGenre', toegewezen_id = $toegewezenId where code = \"{$_GET['patient']}\"";
  mysql_query($qryNaarPsy);
  $datum  = date("Y-m-d");
  $qryStopTP = "update patient_tp set actief = 0, einddatum = '$datum', stopzetting_text = 'overgestapt naar gewone psy' where patient = \"{$_GET['patient']}\"";
  mysql_query($qryStopTP);

  /******** overname van zorgteam is automatisch ********/
  // maar wel orgpersoon veranderen in hulp
  $qryUpdateOrgPersoon = "
            UPDATE
                huidige_betrokkenen
                set genre = 'hulp'
            where genre = 'orgpersoon' and patient_code = \"{$_GET['patient']}\"  ";
   mysql_query($qryUpdateOrgPersoon) or die("kan de orgpersonen niet veranderen in gewone hulp");

  // nog iemand verwittigen per email???


}
		

//---------------------------------------------------------------------------

/* Toon form patientgegevens */ require('../forms/patientgegevens_aanpassen.php');

//---------------------------------------------------------------------------



/*
if (project_van_patient($_SESSION['pat_code']) == 0) {

	print("&nbsp;<br />&nbsp;<br /><div style=\"text-align:left\">

			<p>(*) Onder <b>PVS-pati&euml;nt</b> verstaat men de persoon die tengevolge van een

			acute hersenbeschadiging (ernstige schedeltrauma, hartstilstand, aderbloeding, ...),

			gevolgd door een coma, waarbij de ontwaaktechnieken de situatie niet hebben kunnen 

			verbeteren, een volgende status behoudt:<ul>

			<li>ofwel een persisterende neurovegetatieve status, waarbij de pati&euml;nt getuigt van

			geen enkele vorm van bewustzijn van zichzelf of de omgeving en niet in staat is 

			om met anderen te communiceren en dat sinds minstens 3 maanden;</li>

			<li>ofwel een minimaal responsieve status (MRS), die verschilt van de 

			neurovegetatieve status, omdat de pati&euml;nt zich in een bepaald opzicht van

			zichzelf en de omgeving bewust is.</li></ul></p></div>");

}
*/

?>

<div style="text-align:left">
<?php
if ($_SESSION['profiel']!="psy") {
?>
  <p>
      (*) Voor pati&euml;nten met verminderde psychische zelfdredzaamheid is er <strong>NOOIT vergoeding voor deelnemers</strong>,
      enkel een vergoeding voor de organisator van het overleg indien
      het voldoet aan de dezelfde voorwaarden als voor MVO.<br/>
 </p>
<?php
}
?>
   <p>
      (**) De pati&euml;nt geeft toestemming aan het ziekenhuis om zijn identificatiegegevens en de gegevens van zijn zorgbemiddelaar
      op te vragen bij opname in het ziekenhuis met als doel informatie uit te wisselen tussen het ziekenhuis en het zorgteam.
<!--
      Sinds oktober 2011 kunnen ziekenhuizen opzoeken of een pati&euml;nt een zorgplan heeft
      om het zorgteam in te lichten bij ontslag. De pati&euml;nt moet hiervoor zijn toestemming geven.
-->
   </p>
</div>


<?php

      print("</div>");

      print("</div>");

      print("</div>");

      require("../includes/footer.inc");

      print("</div>");

      print("</div>");

      print("</body>");

      print("</html>");

//---------------------------------------------------------

/* Sluit Dbconnectie */ require("../includes/dbclose.inc");

//---------------------------------------------------------

      }



//---------------------------------------------------------

/* Geen Toegang */ require("../includes/check_access.inc");

//---------------------------------------------------------

?>