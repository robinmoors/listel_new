<?php
$magAltijd = true;

//------------------------------------------------------------

/* Maak Dbconnectie */ require('../includes/dbconnect2.inc');

//------------------------------------------------------------


function infoAndereSelectieMogelijkheden() {
    if ($_SESSION['profiel']=="" || $_SESSION['profiel']=="patient" || $_SESSION['profiel']=="mantel"){
      return "";
    }
    echo <<< TOTHIER

 <div class="inputItem">
   <div class="label220" style="width:700px;">
      Vul <strong>ofwel</strong> een rijksregisternummer, <strong>of</strong>, voor bestaande pati&euml;nten, het zorgplannummer <strong>of</strong> de naam.
   </div>
 </div>

TOTHIER;
  return "wisNaam();wisDossier();";

}

function toonAndereSelectieMogelijkheden() {
  global $wisAndere;
  
    if ($_SESSION['profiel']=="" || $_SESSION['profiel']=="patient" || $_SESSION['profiel']=="mantel"){
      return;
    }

        $dossierList="\n\nvar dossierList = Array(\n";
        $patientList="\n\nvar patientList = Array(\n";

        $vandaag = date("Ymd");
        // patient en mantelzorger nog toevoegen!!
        switch ($_SESSION['profiel']) {
           case "OC":
             $actief = "(patient.einddatum=0 AND patient.actief=1)";
             $beperkingTabel = "gemeente, ";
             $beperking = "   AND patient.toegewezen_genre = 'gemeente'
                              AND gem_id=gemeente.id and gemeente.zip =  {$_SESSION['overleg_gemeente']}
                          ";
             $overlegBeperking = "   (overleg.toegewezen_genre = 'gemeente'
                                     AND gem_id=gemeente.id and gemeente.zip =  {$_SESSION['overleg_gemeente']} )
                                     AND (overleg.genre is NULL or overleg.genre in ('gewoon','psy', 'TP'))
                          ";
             $tpTabel = "LEFT JOIN patient_tp on patient.code = patient_tp.patient";
             $tpRechten = "or (patient.actief=-1 and patient_tp.actief = 1 and patient_tp.rechtenOC > 0 and patient_tp.rechtenOC <= $vandaag)";
             break;
           case "rdc":
             $actief = "(patient.einddatum=0 AND patient.actief=1)";
             $beperkingTabel = "";
             $beperking = "   AND patient.toegewezen_genre = 'rdc'
                              AND patient.toegewezen_id = {$_SESSION['organisatie']}
                          ";
             $overlegBeperking = "   (overleg.toegewezen_genre = 'rdc'
                                     AND overleg.toegewezen_id = {$_SESSION['organisatie']})
                                     AND (overleg.genre is NULL or overleg.genre in ('gewoon','psy', 'TP'))
                          ";
             $tpTabel = "LEFT JOIN patient_tp on patient.code = patient_tp.patient";
             $tpRechten = "or (patient.actief=-1 and patient_tp.actief = 1 and patient_tp.rechtenOC > 0 and patient_tp.rechtenOC <= $vandaag)";
             break;
           case "hulp":
             $actief = "(patient.einddatum=0 AND patient.actief=1)";
             $beperkingTabel = "";
             $beperking = "   AND patient.toegewezen_genre = 'hulp'
                              AND patient.toegewezen_id = {$_SESSION['usersid']}
                          ";
             $tpTabel = "";
             $tpRechten = "";
             break;
           case "listel":
             $actief = "einddatum=0 AND (actief=1 or actief = -1)";
             $beperkingTabel = "";
             $beperking = "";
             $tpTabel = "";
             $tpRechten = "";
             break;
           case "hoofdproject":
             $actief = "(patient_tp.einddatum is NULL AND patient.actief=-1 AND patient_tp.actief = 1)";
             $beperkingTabel = "";
             $beperking = "";
             $tpTabel = "LEFT JOIN patient_tp on patient.code = patient_tp.patient";
             $tpRechten = "AND patient_tp.project = {$_SESSION['tp_project']}";
             break;
           case "bijkomend project":
             $actief = "(patient_tp.einddatum is NULL AND patient.actief=-1 AND patient_tp.actief = 1)";
             $beperkingTabel = "";
             $beperking = "";
             $tpTabel = "LEFT JOIN patient_tp on patient.code = patient_tp.patient";
             $tpRechten = "AND patient_tp.project = {$_SESSION['tp_project']}";
             break;
           case "menos":
             $actief = "menos=1 and patient_menos.einddatum is NULL";
             $beperkingTabel = " ";
             $beperking = " ";
             $tpTabel = "INNER JOIN patient_menos on patient.code = patient_menos.patient";
             $tpRechten = "";
             break;
           case "psy":  // alleen zijn eigen patienten, en ook geen menos
             $actief = "(patient.einddatum=0 AND patient.actief=1)";
             $beperking = "   AND patient.toegewezen_genre = 'psy'
                              AND patient.toegewezen_id = {$_SESSION['organisatie']}
                          ";
             $beperkingTabel = " ";
             $tpTabel = "";
             $tpRechten = "";
             break;
        }

               if ($_SESSION['profiel']=="hulp") {
                 $query2 = "(SELECT distinct patient.* FROM (patient inner join huidige_betrokkenen on patient.code = huidige_betrokkenen.patient_code
                                                                          and (patient.actief = 1 or patient.actief = 1 or patient.menos = 1)
                                                                          and genre = 'hulp' and persoon_id = {$_SESSION['usersid']} and (rechten = 1 or  overleggenre in ('menos','psy'))))
                            union
                            (select distinct * from patient where patient.toegewezen_genre = 'hulp' and patient.toegewezen_id = {$_SESSION['usersid']}
                                                                  and patient.actief = 1)
                            order by naam asc, voornaam asc, (actief*10)+5 desc";
               }
               else {
                  $query2 = "SELECT patient.*  FROM $beperkingTabel
                                              (patient $tpTabel)
                       WHERE ($actief $tpRechten)
                             $beperking
                       ORDER BY
                         naam asc, voornaam asc, (patient.actief*10)+5 desc";
               }
//print("<h3>$query2</h3>");

      $result2=mysql_query($query2) or die("We kunnen de juiste zorgplannen niet selecteren dankzij de fout " . mysql_error() . " in <br/>$query2");
      for ($i=0; $i < mysql_num_rows ($result2); $i++) {
        $records= mysql_fetch_array($result2);
        while (strrpos($records['naam']," ")==strlen($records['naam'])-1) {
          $records['naam'] = substr($records['naam'],0,strlen($records['naam'])-1);
        }
        //$dossierList=$dossierList."\"".$records['code']." ".$records['naam']." ".$records['voornaam']."\",\"".$records['code']."\",\n";
        $dossierList=$dossierList."\"".patient_roepnaam($records['code'])."\",\"".$records['rijksregister']."\",\n";
        $patientList=$patientList."\"".$records['naam']." ".$records['voornaam']."\",\"".$records['rijksregister']."\",\n";
      }
      $dossierList=$dossierList."\" \",\" \")\n\n";
      $patientList=$patientList."\" \",\" \")\n\n";


    print("<script type=\"text/javascript\">");
    print($dossierList);
    print($patientList);
    print("</script>");

?>
    <div class="inputItem" id="IIDossierCode">
        <div class="label220">Volgnummer&nbsp;: SO98-</div>
        <div class="waarde">
            <input
                class="invoer"
                onKeyUp="refreshList('f','dossierCodeInput','pat_code',1,'IIDossierCodeS',dossierList,20)"
                onmouseUp="showCombo('IIDossierCodeS',100)"
                onfocus="wisNaam();wisRR();resetList('f','dossierCodeInput','pat_code',1,'IIDossierCodeS',dossierList,20,100)"
                type="text"
                name="dossierCodeInput"
                value="">
            <input
                type="button"
                onClick="wisNaam();wisRR();resetList('f','dossierCodeInput','pat_code',1,'IIDossierCodeS',dossierList,20,100)"
                value="<< lijst">
            <input
                type="button"
                value="Go >>"
                onclick="wisNaam();wisRR();checkDossier();"
            />
        </div>
    </div>
    <div class="inputItem" id="IIDossierCodeS" style="display:none;">
        <div class="label220">Kies eventueel&nbsp;:</div>
        <div class="waarde">
            <select
                class="invoer"
                onClick="wisNaam();wisRR();handleSelectClick('f','dossierCodeInput','pat_code',1,'IIDossierCodeS')"
                onBlur="wisNaam();wisRR();handleSelectClick('f','dossierCodeInput','pat_code',1,'IIDossierCodeS')"
                name="pat_code"
                size="5">
            </select>
        </div>
    </div><!--Dossiercode -->
    
    
    <div class="inputItem" id="IIPatientnaam">
    <div class="label220">Pati&euml;ntnaam&nbsp;: </div>
        <div class="waarde">
            <input
                class="invoer"
                onKeyUp="refreshList('f','patientNaamInput','pat_code2',1,'IIPatientnaamS',patientList,20)"
                onmouseUp="showCombo('IIPatientnaamS',100)"
                onfocus="wisDossier();wisRR();resetList('f','patientNaamInput','pat_code2',1,'IIPatientnaamS',patientList,20,100)"
                type="text"
                name="patientNaamInput"
                value="">
            <input
                type="button"
                onClick="wisDossier();wisRR();resetList('f','patientNaamInput','pat_code2',1,'IIPatientnaamS',patientList,20,100)"
                value="<< lijst">
            <input
                type="button"
                value="Go >>"
                onclick="wisDossier();wisRR();checkPatient();"
            />
        </div>
    </div>
    <div class="inputItem" id="IIPatientnaamS" style="display:none;">
        <div class="label220">Kies eventueel&nbsp;: </div>
        <div class="waarde">
            <select
                class="invoer"
                onClick="wisDossier();wisRR();handleSelectClick('f','patientNaamInput','pat_code2',1,'IIPatientnaamS')"
                onblur="wisDossier();wisRR();handleSelectClick('f','patientNaamInput','pat_code2',1,'IIPatientnaamS')"
                name="pat_code2"
                size="5">
            </select>
        </div>
    </div><!--Naam Patient -->


<?php
//----------------------------------------------------------
}


$paginanaam="Vraag een multidisciplinair overleg aan";



if (true || (isset($_SESSION["toegang"] ) && ($_SESSION["toegang"]=="toegestaan")) )
  // DEZE PAGINA MAG ALTIJD WANT IEMAND KAN ZICH VRIJWILLIG AANMELDEN!

    {

    require("../includes/html_html.inc");
    print("<head>");
    print("\n<script type=\"text/javascript\" src=\"../javascript/prototype.js\"></script>\n");



    require("../includes/html_head.inc");
    require("../includes/checkForNumbersOnly.inc");
    require("../includes/checkCheque.inc");


    print("<script type=\"text/javascript\">var origineelStap4='';");

    if ($_SESSION['isOrganisator']==1) {

?>

function toonBetrokkenenInStap4(rijksregister) {
     var request = createREQ();

     var rand1 = parseInt(Math.random()*9);
     var rand2 = parseInt(Math.random()*999999);
     var url = "aanvraag_overleg_getBetrokkenen_ajax.php?rr=" + rijksregister + "&rand" + rand1 + "=" + rand2;

     request.onreadystatechange = function() {
      if (request.readyState == 4) {
        var response = request.responseText;
        if (response.indexOf("KO!!") == -1) {
           $('stap4').innerHTML = response;
           relatieGekozen = true;
        }
      }
     }
     // en nu nog de request uitsturen
     request.open("GET", url);
     request.send(null);

}
function resetBetrokkenenInStap4() {
  $('stap4').innerHTML = origineelStap4;
  relatieGekozen = false;
}
<?php
    }
    else {
?>

function toonBetrokkenenInStap4(rijksregister) {
  // niks doen, want geen organisator en dus moet stap 4 hetzelfde blijven
}
function resetBetrokkenenInStap4() {}
<?php
    }
    
    if ($_SESSION['profiel']=="OC") {
?>
function waarschuwing(rijksregister) {
  zoekWaarschuwing(rijksregister, <?= $_SESSION['overleg_gemeente'] ?>);
}
<?php
    }
    else {
?>
function waarschuwing(rijksregister) {
  zoekWaarschuwing(rijksregister, 0);
}
<?php
    }

    //------------------------------------------------------------
    // Postcodelijst Opstellen voor javascript
    $query = "
        SELECT
            dlzip,
      			dlnaam,
			      id
        FROM
           gemeente
        where sit_id > 0
      ORDER BY
         dlzip
	";

    if ($result=mysql_query($query)){
        print ("var gemeenteList = Array(");
        for ($i=0; $i < mysql_num_rows ($result); $i++){
           $records= mysql_fetch_array($result);
           print ("\"".$records[0]." ".$records[1]."\",\"".$records[2]."\",\n");
        }
      print ("\"9999 onbekend\",\"9999\");");
    }
	else{print(mysql_error());}
  print("</script>");
    //----------------------------------------------------------

?>

<style type="text/css">
 .mainblock { height: auto;}

  fieldset {width: 700px;}
</style>

<?php
    print("</head>");
    print("<body onload=\"if ($('stap4')!=null) origineelStap4=$('stap4').innerHTML;\">");
    print("<div align=\"center\">");
    print("<div class=\"pagina\">");

    require("../includes/header.inc");
    require("../includes/kruimelpad.inc");
    print("<div class=\"contentsAanvraag\">");
    print("<div class=\"mainAanvraag\">");

    if ($_POST['action']=="opslaan"){
       //print_r($_POST);
       if ($_POST['typePat']=="psy" && $_POST['organisator']=="hulp") {
         $_POST['organisator']="psy";
       }
       
       
       if ($_POST['doel'] == "andere") {
         $_POST['doel'] = $_POST['ander_doel'];
       }


       if (issett($_POST['jjjj'])) {
         $nu = mktime(date("H"),date("i"),date("s"),$_POST['mm'],$_POST['dd'],$_POST['jjjj']);
       }
       else {
         $nu = time();
       }
       $zoekPat = mysql_query("select * from patient where rijksregister = '{$_POST['rijksregister']}' order by actief desc");
       if (mysql_num_rows($zoekPat)>0) {
         $patCodeVeld  = "patient_code, ";
         $pat = mysql_fetch_object($zoekPat);
         $patCodeValue = "'{$pat->code}', ";
       }
       if (issett($_POST['gem_id'])) {
         $gemVeld  = "gemeente_id, ";
         $gemValue = "{$_POST['gem_id']}, ";
       }
       if (!isset($_POST['organisator']) || $_POST['organisator']=="") { // de gewone organisator
         preset($pat->toegewezen_id);
         $org1Veld  = "keuze_organisator, id_organisator, ";
         if ($pat->toegewezen_genre == "gemeente") $pat->toegewezen_genre = "ocmw";
         $org1Value = "'{$pat->toegewezen_genre}', {$pat->toegewezen_id}, ";
         $gemVeld  = "gemeente_id, ";
         $gemValue = "{$pat->gem_id}, ";
       }
       else {
         $org1Veld  = "keuze_organisator, reden_organisator, id_organisator, ";
         preset($_POST['organisatorOrg']);
         $org1Value = "'{$_POST['organisator']}', '{$_POST['reden_organisator']}', {$_POST['organisatorOrg']}, ";
         if ($_POST['reden_organisator'] == "andere") {
           $andereVeld  = "andere_reden_organisator, ";
           $andereValue = "'{$_POST['andere_reden_organisator1']}{$_POST['andere_reden_organisator2']}', ";
         }
       }
       
       if ($_POST['functie'] == "andere") {
         $functie = $_POST['andereFunctie'];
       }
       else {
         $functie = $_POST['functie'];
       }

       if (!isset($_POST['Informeren']) || $_POST['Informeren']=="") {
         $_POST['Informeren'] = 0;
       }
       if (!isset($_POST['Overtuigen']) || $_POST['Overtuigen']=="") {
         $_POST['Overtuigen'] = 0;
       }
       if (!isset($_POST['Organiseren']) || $_POST['Organiseren']=="") {
         $_POST['Organiseren'] = 0;
       }
       if (!isset($_POST['Debriefen']) || $_POST['Debriefen']=="") {
         $_POST['Debriefen'] = 0;
       }
       if (!isset($_POST['Beslissen']) || $_POST['Beslissen']=="") {
         $_POST['Beslissen'] = 0;
       }
       if (!isset($_POST['Doel_ander']) || $_POST['Doel_ander']=="") {
         $doel_ander = "";
       }
       else {
         $doel_ander = $_POST['ander_doel'];
       }

       preset($_POST['dringend']);
       
       $insert = "insert into aanvraag_overleg (
                     timestamp,
                     rijksregister,
                     $patCodeVeld
                     $gemVeld
                     $org1Veld
                     $andereVeld
                     doel_informeren,
                     doel_overtuigen,
                     doel_organiseren,
                     doel_debriefen,
                     doel_beslissen,
                     doel_andere,
                     naam_aanvrager,
                     discipline_aanvrager,
                     organisatie_aanvrager,
                     info_aanvrager,
                     dringend,
                     status
                  )
                  values (
                     $nu,
                     '{$_POST['rijksregister']}',
                     $patCodeValue
                     $gemValue
                     $org1Value
                     $andereValue
                     {$_POST['Informeren']},
                     {$_POST['Overtuigen']},
                     {$_POST['Organiseren']},
                     {$_POST['Debriefen']},
                     {$_POST['Beslissen']},
                     \"{$_POST['ander_doel']}\",
                     \"{$_POST['naam']}\",
                     \"{$functie}\",
                     \"{$_POST['organisatieAanvrager']}\",
                     \"{$_POST['telefoon']} {$_POST['email']}\",
                     {$_POST['dringend']},
                     'aanvraag'
                  )";

       if (!mysql_query($insert)) {print("$insert is mislukt : " . mysql_error());}
       $aanvraagNr = mysql_insert_id();
       if ($_POST['activeer']==1) {
         mysql_query("update patient set actief = 1 where code = '{$pat->code}';") or die("kan niet activeren " . mysql_error());
       }

       /******** mail versturen *******/
                       $iemandAnders = true;
                       $mensen = organisatorenVanAanvraag($_POST, $pat);
                       for ($i=0; $i<mysql_num_rows($mensen); $i++) {
                         $pc  = mysql_fetch_assoc($mensen);
                         if ($pc['email']!="") {
                           $namen .= ", {$pc['naam']} {$pc['voornaam']}";
                           $adressen .= ", {$pc['email']}";
                         }
                         if ($pc['id'] == $_SESSION['usersid'] && $pc['overleggenre'] == $_POST['organisator']) {
                           $iemandAnders = false;
                         }
                       }

                       $namen = substr($namen, 1);
                       $adressen = substr($adressen, 1);
                       if ($_POST['dringend']==1) {
                         $extra = "<br/><br/>Deze patient is zopas uit het ziekenhuis ontslagen, of het overleg moet binnen de week georganiseerd worden.";
                       }
                       if ($adressen != "" && $iemandAnders) {
                          htmlmail($adressen,"LISTEL: aanvraag voor een overleg","Beste $namen<br/>Vanuit het LISTEL e-zorgplan is er een aanvraag verstuurd om een overleg te organiseren.
                                                   Wanneer u inlogt op $siteadres kan u deze aanvraag verder afhandelen.
                                                   $extra
                                                   <br/><br />Het LISTEL e-zorgplan www.listel.be </p>");
                       }
       /****** einde mail *********/

       if (isset($_SESSION['naam'])) {
         $naamPersoon = "{$_SESSION['voornaam']} {$_SESSION['naam']}";
       }
       else {
         $naamPersoon = $_POST['naam'];
       }

       if (date("H")<11) $begroeting = "Goeiemorgen {$naamPersoon},<br/>";
       else if (date("H")<15) $begroeting = "Goeiemiddag {$naamPersoon},<br/>";
       else if (date("H")<18) $begroeting = "Goeienamiddag {$naamPersoon},<br/>";
       else $begroeting = "Goedenavond {$naamPersoon},<br/>";

if ($_POST['vervolg']=="patient_nieuw") {
// ***** BEGIN AANVRAAG VOOR NIEUWE PATIENT
echo <<< EINDE
<h1>De eerste fase in het aanmaken van een nieuwe pati&euml;nt is afgerond</h1>
<p>$begroeting
<br/>
<br/>
Vul nu <a href="patient_nieuw.php?rr={$_POST['rijksregister']}">de pati&euml;ntgegevens</a> in
of ga naar het <a href="welkom.php">hoofdmenu</a> van het e-zorgplan, waar je
in het werkoverzicht <br/>
een verwijzing naar deze nieuwe pati&euml;nt vindt zodat je ook
later de gegevens kan invullen.</p>
EINDE;
// ***** EINDE AANVRAAG VOOR NIEUWE PATIENT
}
else if ($_POST['vervolg']=="overleg" && isset($pat->code) && strlen($pat->code)>5) {
// ***** BEGIN AANVRAAG VOOR OVERLEG
echo <<< EINDE
<h1>De basisgegevens voor het nieuwe overleg zijn klaar</h1>
<p>$begroeting
<br/>
<br/>
De eerste stap is gezet. <a href="overleg_alles.php?patient={$pat->code}&aanvraag={$aanvraagNr}">Plan nu het overleg</a>
of ga naar het <a href="welkom.php">hoofdmenu</a> van het e-zorgplan, waar je
in het werkoverzicht <br/>
een aanvraag voor pati&euml;nt {$pat->code} vindt zodat je ook
later de gegevens kan invullen.</p>
EINDE;
// ***** EINDE AANVRAAG VOOR OVERLEG
}
else {
// ***** BEGIN GEWONE AANVRAAG
echo <<< EINDE
<h1>Uw aanvraag is goedgekeurd</h1>
<p>$begroeting
<br/>
<br/>
uw aanvraag voor een overleg is doorgestuurd naar de gekozen organisator<br/> en wordt zo spoedig mogelijk
door hem/haar behandeld.
</p>
<p>Wij danken u voor het gebruik van het Listel-e-zorgplan.</p>

<p>Klik <a href="aanvraag_overleg.php">hier</a> als je nog een overleg wil aanvragen.</p>
EINDE;
  if (isset($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan")) {
     print("<p>Of ga terug naar het gewone <a href=\"welkom.php\">e-zorgplan</a></p>");
  }
// ***** EINDE GEWONE AANVRAAG
}
    }
    else {
      // toon het formulier en de hele speelgoedwinkel aan javascript
?>

<script type="text/javascript" src="../includes/formuliervalidatie.js">
</script>

<script type="text/javascript" src="../javascript/aanvraagOverleg.js">
</script>

<script type="text/javascript">
var activeer = false;
var oudeOC = "";
var organisatieGekozen = false;
var organisatieReden = false;
var relatieGekozen = false;
var mantel = false;
</script>




<?php
  if ($_GET['vervolg']=="patient_nieuw") {
?>
<h1>Maak een nieuw zorgplan voor een nieuwe pati&euml;nt.</h1>

<p>Vul eerst de basisgegevens in voor dit nieuwe zorgplan. <br/>
Daarna kan je de volledige pati&euml;ntgegevens invullen
en via het werkoverzicht een nieuw overleg maken.  <br/>
Om terug te gaan naar het menu, kan je de <em>terug</em>-knop van je browser gebruiken.
</p>
<?php
  }
  else if ($_GET['vervolg']=="overleg") {
?>
<h1>Plan een overleg.</h1>

<p>Vul eerst de basisgegevens in voor dit nieuwe overleg. <br/>
Daarna kan je het volledige overleg plannen zoals vroeger.
</p>
<?php
  }
  else {
?>

<h1>Vraag hier een multidisciplinair overleg aan</h1>

<p>Om uw aanvraag zo snel mogelijk te kunnen verwerken, is het belangrijk dat alle gegevens correct ingevuld worden.
<br/>Onze gebruiksvriendelijke toepassing helpt je elke stap juist te zetten.
</p>

<?php
  }
  if (isset($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan")) {
     print("<p>Je kan ook steeds terug naar de <a href=\"welkom.php\">startpagina van het e-zorgplan</a>.</p>");
  }

?>


<img style="position:fixed; left: 50%; top:300px;display:none;" id="loading" src="../images/loading.gif" />

<form method="post" name="f" autocomplete="off">
     <input type="hidden" name="vervolg" value="<?= $_GET['vervolg'] ?>" />
<fieldset>

    <div class="legende">Stap 1: de pati&euml;nt<br/>&nbsp;</div>
<?php
  $wisAndere = infoAndereSelectieMogelijkheden();
?>


    <div class="inputItem" id="BlokRijksregister">
            <div class="label220">Rijksregisternummer&nbsp;: </div>
            <div class="waarde">
                <input tabindex="6" type="text" size="12" value="" name="rijksregister" id="rijksregister"
                       onfocus="<?= $wisAndere ?>"
                       onkeyup="checkForNumbersOnly(this,11,0,99999999999,'f','rijksregister');testRR(this.value);"
                        /> (11 cijfers zonder leestekens)
            </div>
<?php
 toonAndereSelectieMogelijkheden();
?>
    </div><!--rijksregister-->

    <div class="inputItem" id="BlokOudePostCode" style="display:none;">
            <div class="label220">Laatste gekende woonplaats&nbsp;: </div>
            <div class="waarde">
              <div id="laatsteWoonplaats"></div>
              <div>Is dit nog steeds de woonplaats?
                   <input type="button" value="ja" onclick="toonOC(false);"/>
                   <input type="button" value="nee" onclick="toonHuidigeGemeente();"/>
              </div>
            </div>
    </div><!-- oude woonplaats -->

    <div class="inputItem" id="BlokTypePatient" style="display:none;">
        <div class="label220">Soort problematiek&nbsp;: </div>
        <div class="waarde">
           Is de pati&euml;nt
             <input type="radio" value="fy" name="typePat" onclick="zetTypePatient(false);" /> fysisch   of
             <input type="radio" value="psy" name="typePat" onclick="zetTypePatient(true);" /> psychiatrisch?
        </div>
    </div>

    <div class="inputItem" id="BlokPostCode" style="display:none;">
        <div class="label220" id="postcodeTekst">Postcode woonplaats&nbsp;: </div>
        <div class="waarde">
            <span id="postcodeinvoer">
            <input onkeyup="refreshListAanvraag('f','postCodeInput','gem_id',1,'IIPostCodeS',gemeenteList,20)"
            onmouseup="showCombo('IIPostCodeS',100)"
            onfocus="refreshListAanvraag('f','postCodeInput','gem_id',1,'IIPostCodeS',gemeenteList,20)"
            type="text" name="postCodeInput" id="postCodeInput" value="<?php print($valGemeente)?>">
            <input type="button"  value="<<"
            onclick="resetList('f','postCodeInput','gem_id',1,'IIPostCodeS',gemeenteList,20,100)" />
           </span>
        </div>
    </div>

    <div class="inputItem" id="IIPostCodeS" style="display:none;">
        <div class="label220">Kies eventueel&nbsp;:</div>
        <div class="waarde">
            <select onclick="handleSelectClickAanvraag('f','postCodeInput','gem_id',1,'IIPostCodeS')"
            name="gem_id" id="gem_id" size="5">
            </select>
        </div>
    </div><!--woonplaats -->

</fieldset>

<fieldset id="waarschuwing" style="background-color: #f88;display:none" >
</fieldset>

<fieldset id="stap2Keuze" style="display:none;">
    <div class="legende">Stap 2: de organisator van het overleg<br/>&nbsp;</div>

    <div class="inputItem" id="toonOC" style="display:none;">
            <div class="label220" id="ocTekst">???&nbsp;: </div>
            <div class="waarde">
              <div id="laatsteOC"></div>
              <div>Is deze organisator OK?
                   <input type="button" value="ja" onclick="$('keuzeOC').style.display = 'none';toonStap3();"/>
                   <input type="button" value="nee" onclick="toonStap2Keuze();"/>
              </div>
            </div>
    </div><!--toon huidige oc-->

    <div class="inputItem" id="keuzeOC" style="display:none;">
            <div class="label220">Kies een organisator&nbsp;: </div>
            <div class="waarde" style="width:400px;">
              <div>Volgens de afspraken van de Limburgse code geniet het <strong>OCMW</strong> van de woonplaats de voorkeur, maar indien
                   het OCMW het niet opneemt, of u verkiest dat het regionaal dienstencentrum verbonden aan uw mutualiteit
                   het overleg voor u organiseert, mag u ook een regionaal dienstencentrum (<strong>RDC</strong>) kiezen.
                   Ook een andere zorgaanbieder kan het overleg organiseren. <br/>&nbsp;</div>
                <div style="float:left;width:30px;">&nbsp;</div>
                <div style="float:left;width:120px;"><input type="radio" name="organisator" value="ocmw" onclick="selecteerOCMW();toonStap3();"/>
                     Het OCMW van de woonplaats</div>
                <div style="float:left;width:120px;"><input type="radio" name="organisator" value="rdc"  onclick="selecteerRDC();"/>
                     Een regionaal dienstencentrum</div>
                <div style="float:left;width:120px;"><input type="radio" name="organisator" value="hulp" onclick="selecteerHulpOfPsy();" />
                     Zorgaanbieder</div>

                <div id="kiesRDC" style="display:none;margin:10px 0px 10px 30px;clear:both;padding: 10px 0px;">
                 <h3>Selecteer het uitverkoren centrum.</h3>
<?php
  $qryRDC = "select distinct o.naam, o.id from organisatie o inner join logins where o.id = logins.organisatie and logins.profiel = 'rdc' AND o.actief = 1 AND logins.actief = 1 order by o.naam;";
  $resultRDC = mysql_query($qryRDC) or die("Kan de rdc's niet vinden: " . mysql_error());
  for ($i=0; $i<mysql_num_rows($resultRDC); $i++) {
    $rdc = mysql_fetch_assoc($resultRDC);
    print("<input type=\"radio\" name=\"organisatorOrg\" value=\"{$rdc['id']}\" onclick=\"kiesOrg();\" />{$rdc['naam']}</br>\n");
  }
?>
                  <div>
                    <h4>Ik kies voor dit centrum omdat</h4>
                    <input type="radio" name="reden_organisator" value="expliciete vraag van patient" onclick="kiesRedenOrg();" />
                       de pati&euml;nt het expliciet gevraagd heeft  <br/>
                    <input type="radio" name="reden_organisator" value="ocmw niet binnen 30 dagen" onclick="kiesRedenOrg();" />
                       het OCMW dit overleg niet binnen de 30 dagen kan organiseren  <br/>
                    <input type="radio" name="reden_organisator" value="andere" id="andere1" disabled="disabled"
                           onclick="if ($('reden1').value.length == 0) organisatieReden = false; else kiesRedenOrg();" />
                       andere: <textarea id="reden1" name="andere_reden_organisator1" style="width:200px; height:30px;" onkeyup="if (this.value.length > 0) {$('andere1').disabled=false;$('andere1').checked=true;kiesRedenOrg();} else {organisatieReden = false;}"
                       ></textarea>
                    <input type="button" value="Bevestig deze keuze" onclick="bevestigKeuze();" />
                  </div>
               </div>
               <div id="kiesHulp" style="display:none;margin:10px 0px 10px 30px;clear:both;padding: 10px 0px;">
                 <h3>Selecteer de uitverkoren organisatie.</h3>
<?php
  $qryZA = "select distinct o.naam, o.id from organisatie o inner join hulpverleners h where o.id = h.organisatie and h.is_organisator = 1 and o.actief = 1 and h.actief = 1 order by o.naam;";
  $resultZA = mysql_query($qryZA) or die("Kan de za's niet vinden: " . mysql_error());
  for ($i=0; $i<mysql_num_rows($resultZA); $i++) {
    $org = mysql_fetch_assoc($resultZA);
    print("<input type=\"radio\" name=\"organisatorOrg\" value=\"{$org['id']}\" onclick=\"kiesOrg();\" />{$org['naam']}</br>\n");
  }
?>
                  <div>
                    <h4>Ik kies voor deze organisatie omdat</h4>
                    <input type="radio" name="reden_organisator" value="al betrokken in de zorg" onclick="kiesRedenOrg();" />
                       zij al betrokken is in de zorg  <br/>
                    <input type="radio" name="reden_organisator" value="andere" id="andere2" disabled="disabled"
                           onclick="if ($('reden2').value.length == 0) organisatieReden = false; else kiesRedenOrg();" />
                       andere: <textarea id="reden2" name="andere_reden_organisator2" style="width:200px; height:30px;" onkeyup="if (this.value.length > 0) {$('andere2').disabled=false;$('andere2').checked=true;kiesRedenOrg();} else {organisatieReden = false;}"
                       ></textarea>
                    <input type="button" value="Bevestig deze keuze" onclick="bevestigKeuze();" />
                  </div>
               </div>

               <div id="kiesPsy" style="display:none;margin:10px 0px 10px 30px;clear:both;padding: 10px 0px;">
                 <h3>Selecteer de uitverkoren organisatie.</h3>
<?php
  $qryZA = "select distinct o.naam, o.id from organisatie o inner join logins l where o.id = l.organisatie and l.profiel = 'psy' and o.actief = 1 and l.actief = 1 order by o.naam;";
  $resultZA = mysql_query($qryZA) or die("Kan de za's niet vinden: " . mysql_error());
  for ($i=0; $i<mysql_num_rows($resultZA); $i++) {
    $org = mysql_fetch_assoc($resultZA);
    print("<input type=\"radio\" name=\"organisatorOrg\" value=\"{$org['id']}\" onclick=\"kiesOrg();\" />{$org['naam']}</br>\n");
  }
?>
                  <div>
                    <h4>Ik kies voor deze organisatie omdat</h4>
                    <input type="radio" name="reden_organisator" value="al betrokken in de zorg" onclick="kiesRedenOrg();" />
                       zij al betrokken is in de zorg  <br/>
                    <input type="radio" name="reden_organisator" value="andere" id="andere2" disabled="disabled"
                           onclick="if ($('reden2').value.length == 0) organisatieReden = false; else kiesRedenOrg();" />
                       andere: <textarea id="reden2" name="andere_reden_organisator2" style="width:200px; height:30px;" onkeyup="if (this.value.length > 0) {$('andere2').disabled=false;$('andere2').checked=true;kiesRedenOrg();} else {organisatieReden = false;}"
                       ></textarea>
                    <input type="button" value="Bevestig deze keuze" onclick="bevestigKeuze();" />
                  </div>
           </div>
    </div><!--keuze oc-->
</fieldset>

<fieldset style="display:none" id="stap3">

    <div class="legende">Stap 3: doel van het overleg<br/>&nbsp;</div>

    <div class="inputItem">
        <div class="label220">Doel : </div>
        <div class="waarde">
            <table>
              <tr>
                <td title="De deelnemers aan het overleg informeren over alle relevante gebeurtenissen rond de thuiszorgsituatie.">
                    <input type="checkbox" value="1" name="Informeren" id="Informeren" onclick="checkToonStap4();" />Informeren
                </td>
                <td title="Het cli&euml;ntsysteem en/of zorg- en hulpverleners overtuigen om een bepaalde beslissing te nemen ">
                    <input type="checkbox" value="1" name="Overtuigen" id="Overtuigen" onclick="checkToonStap4();" />Overtuigen
                </td>
              </tr>
              <tr>
                <td title="De huidige zorgen bespreken en op elkaar afstemmen; taakafspraken en weekplanning opmaken.">
                    <input type="checkbox" value="1" name="Organiseren" id="Organiseren" onclick="checkToonStap4();" />Organiseren
                </td>
                <td title="De moeilijkheden, zorgen, grenzen van de zorg- en hulpverleners onderling delen.">
                    <input type="checkbox" value="1" name="Debriefen" id="Debriefen" onclick="checkToonStap4();" />Debriefen
                </td>
              </tr>
              <tr>
                <td title="Samen met de cli&euml;nt en zijn/haar familie en de betrokken zorg- en hulpverleners een beslissing nemen met betrekking tot de situatie bv. rusthuisopname.">
                    <input type="checkbox" value="1" name="Beslissen" id="Beslissen" onclick="checkToonStap4();" />Beslissen
                </td>
                <td valign="top">
                    <input type="checkbox" value="1" name="Doel_ander" id="Doel_ander" disabled="disabled"
                           onclick="if ($('doel2').value.length < 3) {$('Doel_ander').checked=false;};checkToonStap4();" />Ander doel:
                              <textarea id="doel2" name="ander_doel" style="width:200px; height:18px;"
                                        onclick="if (this.value.length > 3) {$('Doel_ander').disabled=false;$('Doel_ander').checked=true;checkToonStap4();} else {$('Doel_ander').checked=false;checkToonStap4();}"
                                        onkeyup="if (this.value.length > 3) {$('Doel_ander').disabled=false;$('Doel_ander').checked=true;checkToonStap4();} else {$('Doel_ander').checked=false;checkToonStap4();}"
                       ></textarea>
                </td>
              </tr>
            </table>
               

<!--
            <textarea name="doel" style="width:400px; height:70px;"
                      onkeyup="if (this.value.length > 5) {toonStap4('block');} else {toonStap4('none');}"
                       ></textarea>
            <br/>&nbsp;
-->
        </div>
    </div>

    <div class="inputItem">
        <div class="label220" id="postcodeTekst">Ontslag ziekenhuis of dringend? </div>
        <div class="waarde">
            <input type="checkbox" name="dringend" value="1" /> Selecteer indien de pati&euml;nt uit het ziekenhuis ontslagen wordt<br/> of indien het overleg binnen de week
            georganiseerd moet worden.
        </div>
    </div>
</fieldset>


<?php
  if ($_SESSION['profiel']=="hulp") {
//  if (isset($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan") && ($_SESSION['profiel']!="listel")) {
    // een verborgen veld met de gegevens van de ingelogde
    if ($_SESSION['organisatie']>0) {
       $orgRecord = getUniqueRecord("select naam from organisatie where id = {$_SESSION['organisatie']} and actief = 1");
       $orgNaam = $orgRecord['naam'];
    }
    else {
      $orgNaam = $_SESSION['profiel'];
    }
    if ($_SESSION['profiel']=="hulp") {
       $funRecord = getFirstRecord("select f.naam from functies f inner join hulpverleners h on f.id = h.fnct_id and h.id = {$_SESSION['usersid']}");
       $functie = $funRecord['naam'];
    }
    else {
      $functie = $_SESSION['profiel'];
    }
?>
<!--<div id="stap4" style="display:none;width:100px;height:0px;">-->
<div style="display:none;" id="stap4">
<input type="hidden" name="naam" id="naam" value="<?= $_SESSION['voornaam'] . " " . $_SESSION['naam'] ?>" />
<input type="hidden" name="functie" id="functie" value="<?= $functie ?>" />
<input type="hidden" name="organisatieAanvrager" id="organisatieAanvrager" value="<?= $orgNaam ?>" />
</div>
<script type="text/javascript">
relatieGekozen = true;
</script>
<?php
  }
  else {
    // De inhoud van deze fieldset komt ook voor in aanvraag_overleg_getBetrokkenen.php
?>
<fieldset style="display:none" id="stap4">
    <div class="legende">Stap 4: de aanvrager<br/>&nbsp;</div>

    <div class="inputItem" id="BlokAanvrager">
            <div class="label220">Naam en voornaam&nbsp;: </div>
            <div class="waarde">
                <input size="40" name="naam" id="naam" />
            </div>
    </div><!-- naam en voornaam aanvrager -->

    <div class="inputItem" id="functie" >
            <div class="label220">Relatie tot pati&euml;nt&nbsp;: </div>
            <div class="waarde">
               <h4>Zorg- of hulpverlener</h4>
                 <input type="radio" name="functie" value="Huisarts" onclick="geenMantel();"/>Huisarts<br/>
                 <input type="radio" name="functie" value="Thuisverpleging" onclick="geenMantel();"/>Thuisverpleging<br/>
                 <input type="radio" name="functie" value="Kinesitherapeut" onclick="geenMantel();"/>Kinesitherapeut<br/>
                 <input type="radio" name="functie" value="Gezinszorg" onclick="geenMantel();"/>Gezinszorg<br/>
                 <input type="radio" name="functie" value="Sociale dienst" onclick="geenMantel();"/>Sociale Dienst<br/>
                 <input type="radio" name="functie" value="Dienst Pati&euml;ntenbegeleiding" onclick="geenMantel();"/>Dienst Pati&euml;ntenbegeleiding<br/>
                 <input type="radio" name="functie" value="andere" onclick="geenMantel();" disabled="disabled" id="andereFunctie"/>Andere:
                 <select name="andereFunctie" onchange="if (this.selectedIndex==0) {$('andereFunctie').disabled=true;$('andereFunctie').checked=false;} else {$('andereFunctie').disabled=false;$('andereFunctie').checked=true;geenMantel();}">
                   <option>-- selecteer --</option>
                   <option>Logopedist</option>
                   <option>Apotheker</option>
                   <option>Di&euml;tist</option>
                   <option>Ergotherapeut</option>
                   <option>Geriater</option>
                   <option>Oppasdienst</option>
                   <option>Palliatief deskundige</option>
                   <option>Poetshulp</option>
                   <option>Psychiater</option>
                   <option>Psycholoog</option>
                   <option>Zorgkundige</option>
                   <option value="Overige ZVL/HVL">Overige</option>
                 </select>
            <h4>Mantelzorger</h4>
               <input type="radio" name="functie" value="Partner" onclick="welMantel();"/>Partner <br/>
               <input type="radio" name="functie" value="Echtgeno(o)t(e)" onclick="welMantel();"/>Echtgeno(o)t(e) <br/>
               <input type="radio" name="functie" value="Dochter/zoon" onclick="welMantel();"/>Dochter/zoon <br/>
               <input type="radio" name="functie" value="Schoondochter/schoonzoon" onclick="welMantel();"/>Schoondochter/schoonzoon <br/>
               <input type="radio" name="functie" value="Kleinkind" onclick="welMantel();"/>Kleinkind <br/>
               <input type="radio" name="functie" value="Broer/zus" onclick="welMantel();"/>Broer/zus <br/>
               <input type="radio" name="functie" value="Schoonbroer/schoonzus" onclick="welMantel();"/>Schoonbroer/schoonzus <br/>
               <input type="radio" name="functie" value="Vader/moeder" onclick="welMantel();"/>Vader/moeder <br/>
               <input type="radio" name="functie" value="Buur" onclick="welMantel();"/>Buur <br/>
               <input type="radio" name="functie" value="Grootouder" onclick="welMantel();"/>Grootouder <br/>
               <input type="radio" name="functie" value="Oom/tante" onclick="welMantel();"/>Oom/tante <br/>
               <input type="radio" name="functie" value="Neef/nicht" onclick="welMantel();"/>Neef/nicht <br/>
               <input type="radio" name="functie" value="Vriend(in)" onclick="welMantel();"/>Vriend(in) <br/>
               <input type="radio" name="functie" value="Stiefdochter/stiefzoon" onclick="welMantel();"/>Stiefdochter/stiefzoon <br/>
               <input type="radio" name="functie" value="Schoonouder" onclick="welMantel();"/>Schoonouder <br/>
               <input type="radio" name="functie" value="Pleegouder" onclick="welMantel();"/>Pleegouder<br/>
               <input type="radio" name="functie" value="Stiefouder" onclick="welMantel();"/>Stiefouder <br/>
               <input type="radio" name="functie" value="Ex_partner" onclick="welMantel();"/>Ex_partner <br/>
               <input type="radio" name="functie" value="Kennis" onclick="welMantel();"/>Kennis <br/>
               <input type="radio" name="functie" value="Aanverwant" onclick="welMantel();"/>Aanverwant <br/>    &nbsp;
            </div>
    </div><!-- relatie tot patient -->

    <div class="inputItem" id="mantelInfo" style="display:block;">
            <div class="label220">Telefoon : </div>
            <div class="waarde">
               <input type="text" id="telefoon" name="telefoon" />
            </div>
            <div class="label220">Email : </div>
            <div class="waarde">
               <input type="text" id="email" name="email" />
            </div>
            <div class="label220">Telefoon <strong>of</strong> email is verplicht. </div>
    </div><!-- info mantelzorger -->

    <div class="inputItem" id="orgInfo" style="display:none;">
            <div class="label220">Organisatie : </div>
            <div class="waarde">
               <input type="text" id="organisatieAanvrager" name="organisatieAanvrager" />
            </div>
    </div><!-- info organisatie -->

</fieldset>
<?php
}
?>

<fieldset style="display:none" id="stap5">
<?php
  if ($_SESSION['profiel']!="") {
?>

      <div class="inputItem" id="IIStartdatum">
         <div class="label220">Datum van de aanvraag&nbsp;: </div>
         <div class="waarde">
            <input type="text" size="2" value="<?= date("d"); ?>" name="dd"
                onkeyup="checkForNumbersOnly(this,2,0,31,'f','mm')"
                onblur="checkForNumbersLength(this,2)" />&nbsp;/&nbsp;
            <input type="text" size="2" value="<?= date("m"); ?>" name="mm"
                onkeyup="checkForNumbersOnly(this,2,0,12,'f','jjjj')"
                onblur="checkForNumbersLength(this,2)" />&nbsp;/&nbsp;
            <input type="text" size="2" value="<?= date("Y"); ?>" name="jjjj"
                onkeyup="checkForNumbersOnly(this,4,2010,2069,'f','jjjj')"
                onblur="checkForNumbersLength(this,4)" />
         </div>
      </div><!--overleg_dd,overleg_mm,overleg_jj-->
<?php
  }
?>
    <div class="label220">&nbsp;</div>

        <div class="waarde">

            <input type="hidden" name="action" value="opslaan" />
            <input type="hidden" name="activeer" id="activeer" value="0" />
            <input type="submit" value="Vraag dit overleg aan!" onclick="return testFormulier();"  />
         </div>

    <!--Button opslaan -->

</fieldset>
</form>
<?php


}






    print("</div>");
    print("</div>");

    include("../includes/footer.inc");
    print("</div>");
    print("</div>");
    print("</body>");
    print("</html>");
    }

//---------------------------------------------------------
/* Sluit Dbconnectie */ require("../includes/dbclose.inc");
//---------------------------------------------------------


?>