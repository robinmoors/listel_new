<?php

session_start();
ob_start();

// deze structuur komt voor een stuk ook terug in controle.php
function zoekNaam($menscode) {
    switch ($menscode['mens_type']) {
        case "oc":
        case "psy":
           $qry2 = "select naam, voornaam from logins
                    where id = {$menscode['mens_id']}";
           break;
        case "hvl":
           $qry2 = "select naam, voornaam from hulpverleners
                    where id = {$menscode['mens_id']}";
           break;
        case "mz":
           $qry2 = "select naam, voornaam from mantelzorgers
                    where id = {$menscode['mens_id']}";
           break;
        case "pat":
           $qry2 = "select naam, voornaam from patient
                    where id = {$menscode['mens_id']}";
           break;
         default:
            $qry2 = "select 'OC TGZ' as naam, '' as voornaam";
    }
    $mens = mysql_fetch_array(mysql_query($qry2));
    return $mens['naam'] . " " . $mens['voornaam'];
}

function toonHeader($nr) {
echo <<< EINDE
    <li>Taakfiches : {$nr}x<br />
    <table bgcolor="#FFFFFF" cellpadding="5" class="taakfiche" style="clear: both">
      <tr>
       <th>
       Domein
       </th>
       <th>
       Frequentie van de zorg
       </th>
       <th>
       Taakafspraak
       </th>
       <th>
       Betrokkenen
       </th>
      </tr>
EINDE;
}

function toonTaakfiche($refID) {
 //$readOnly = 1;
 //require("../includes/taakfiches.php");

 $takenQry = "select * from taakfiche
                where ref_id = '$refID'
                order by categorie ";

 $taken = mysql_query($takenQry);
 if (mysql_num_rows($taken) == 0) {
   //print("<ul><li><b>Geen</b> taakfiches ingevuld.</li></ul>");
 }
 else {
   toonHeader(mysql_num_rows($taken));

   $qryMensen = "SELECT DISTINCT mens_id, mens_type
          FROM taakfiche_mensen, taakfiche
          WHERE ref_id = '$refID'
          AND taakfiche_id = id";
   $resultMensen = mysql_query($qryMensen);
   print("Print fiche van : ");
   for ($i=0; $i<mysql_num_rows($resultMensen); $i++) {
      $mensFiche = mysql_fetch_assoc($resultMensen);
      $mensInfo = zoekNaam($mensFiche);
      if (strlen($mensInfo)<3) $mensInfo = "OC TGZ";
      print("<a target=\"_blank\" href=\"download_taakfiches.php?refID={$refID}&nr=$i\">$mensInfo</a>\n");
   }

   for ($i = 0; $i < mysql_num_rows($taken); $i++) {
     $taak = mysql_fetch_array($taken);
     if ($i%2 == 0) $class = " class=\"even\" ";
     else $class = "";
     print("<tr $class><td>{$taak['categorie']}</td>
                <td>{$taak['frequentie']}</td>
                <td>" . nl2br($taak['taak']) . "</td><td>");
     $deelnemersQry = "select * from taakfiche_mensen
                       where taakfiche_id = {$taak['id']}";
     $deelnemersResult = mysql_query($deelnemersQry);
     for ($j=0; $j < mysql_num_rows($deelnemersResult); $j++) {
       $deelnemer = mysql_fetch_array($deelnemersResult);
       $deelnemerNaam = zoekNaam($deelnemer);
       print("$deelnemerNaam &nbsp;<br />");
     }
     print("</td></tr>\n");
   }
   print("</table></li>");
  }
}


function toonOverleg($recordsOverleg) {
  global $patientInfo;

  if ($recordsOverleg['omb_id']!=0) $OMB = " (OMB)";
  if ($recordsOverleg['genre']=="psy") $OMB .= " (PSY)";

  $datum=substr($recordsOverleg['datum'],6,2)."/".substr($recordsOverleg['datum'],4,2)."/".substr($recordsOverleg['datum'],0,4);
  if ($recordsOverleg['afgerond'] == 1) {
    $overlegType = "Teamoverleg $OMB";
    $voorwaarde = " overleg_id = {$recordsOverleg['id']} "; // voor het tonen van de juiste deelnemers
    $tabel = "afgeronde";
    $rechtenFunctie = "Afgerond({$recordsOverleg['id']},";
    $rechtenArray = "afgerond_{$recordsOverleg['id']}";
  }
  else {
    $overlegType = "Huidig Overleg $OMB";
    $voorwaarde = " bl.patient_code='{$_SESSION['pat_code']}' ";
    $tabel = "huidige";
    $rechtenFunctie = "Huidig('{$_SESSION['pat_code']}',";
    $rechtenArray = "huidig_";
  }

  $printActie = "<td><a href=\"overleg_plannen_printen.php?overleg={$recordsOverleg['id']}\">print</a></td>";
  $locatie = "";
  if ($recordsOverleg['keuze_vergoeding'] == 1) {
    $vergoeding = "deelnemers ";
    if ($recordsOverleg['locatie']==0) {
      $locatie = " thuis";
    }
    else {
      $locatie = " elders";
    }
  }
  else if ($recordsOverleg['keuze_vergoeding'] == 2) {
    $vergoeding = "organisator ";
    if ($recordsOverleg['locatie']==0) {
      $locatie = " thuis";
    }
    else {
      $locatie = " elders";
    }
  }

  if ($recordsOverleg['omb_factuur']!="") {
    $vergoeding .= "(OMB)";
  }

  if (isset($recordsOverleg['katz_id'])) {
    $katz = mysql_fetch_array(mysql_query("select * from katz where id = {$recordsOverleg['katz_id']}"));
    $txtKatzScore = $katz['totaal'];
    if ($txtKatzScore < 5) {
      if ($katz['goedkeuring_inspectie']==1) {
        $txtKatzScore .= "+";
        $katzTitle = "title=\"goedgekeurd na inspectie\"";
      }
      else {
        $tdID = "td" .  $recordsOverleg['katz_id'];
        $txtKatzScore .= ""; //" <br /><input type=\"button\" value=\"inspectie\" onClick=\"keurGoed({$txtKatzScore},'$tdID',{$katz['id']}, {$recordsOverleg['id']});\" />";
        $katzTitle = " id = \"$tdID\"";
      }
    }
    $infoKatz = "<a target=\"_blank\" href=\"katz_invullen.php?bekijk=1&katzID={$recordsOverleg['katz_id']}\">$txtKatzScore</a>";
  }
  else {
    $txtKatzScore = "";
    $infoKatz = "";
  }
  $divID = "overleg{$recordsOverleg['id']}";
  $printActie = "<a target=\"_blank\" href=\"print_overleg.php?id={$recordsOverleg['id']}&datum=$datum\">print</a>";

  print ("<tr>
          <td><strong>$overlegType</strong> $locatie</td>
          <td><a href=\"#\" onClick=\"vertoon('$divID');\">".$datum."</a></td>
          <td $katzTitle>$txtKatzScore</td>
          <td>$vergoeding</td>
          <td>$printActie</td>
          </tr>");

echo <<< EINDE
              <tr ><td colspan="6"><div style="margin: 3px; border:1px solid #DDD;display:none" id="$divID">
<style>
#$divID img { display: nnone;}
</style>

EINDE;
   $alleenGroen = true;
   $checkVerandering = "return false;";
   $overlegInfo = $recordsOverleg;
   if ($overlegInfo['genre']=="menos") {
     $overlegGenre = "menos";
   }
   else if ($overlegInfo['genre']=="psy") {
     $overlegGenre = "psy";
   }
   else {
     $overlegGenre = "gewoon";
   }

   require("../includes/deelnemers_ophalen_ajax.php");

   if ($overlegInfo['genre']== "psy") {
     toonBegeleidingsplanBeknopt($overlegInfo['id']);
   }
   else {
     $readOnly = true;
     $overlegID =  $overlegInfo['id'];
     require("../includes/overleg_attesten_bijlagen.php");
     toonTaakfiche("overleg" . $overlegInfo['id']);
   }
   print("</div></td></tr>");
}

function toonOverlegTP($recordsOverleg) {
  global $patientInfo;

  if ($recordsOverleg['omb_id']!=0) $OMB = " (OMB)";

  $datum=substr($recordsOverleg['datum'],6,2)."/".substr($recordsOverleg['datum'],4,2)."/".substr($recordsOverleg['datum'],0,4);
  if ($recordsOverleg['afgerond'] == 1) {
    $overlegType = "<span style='background-color: #FFD780'>Teamoverleg TP {$recordsOverleg['nummer']} $OMB</span>";
    $voorwaarde = " overleg_id = {$recordsOverleg['id']} "; // voor het tonen van de juiste deelnemers
    $tabel = "afgeronde";
    $rechtenFunctie = "Afgerond({$recordsOverleg['id']},";
    $rechtenArray = "afgerond_{$recordsOverleg['id']}";
  }
  else {
    $overlegType = "<span style='background-color: #FFD780'>Huidig Overleg TP {$recordsOverleg['nummer']} $OMB</span>";
    $voorwaarde = " bl.patient_code='{$_SESSION['pat_code']}' ";
    $tabel = "huidige";
    $rechtenFunctie = "Huidig('{$_SESSION['pat_code']}',";
    $rechtenArray = "huidig_";
  }

  if (isEersteOverlegTP_datum($recordsOverleg['datum'])) {
    $overlegType = "<span style='background-color: #FFD780'>Inclusievergadering TP {$recordsOverleg['nummer']} $OMB</span>";
  }
  $printActie = "<td><a href=\"overleg_plannen_printen.php?overleg={$recordsOverleg['id']}\">print</a></td>";
  if ($recordsOverleg['keuze_vergoeding'] == 1) {
    $vergoeding = "deelnemers";
  }
  else if ($recordsOverleg['keuze_vergoeding'] == 2) {
    $vergoeding = "organisator";
  }
  else {
    $vergoeding = "";
  }

  if (isset($recordsOverleg['katz_id'])) {
    $katz = mysql_fetch_array(mysql_query("select * from katz where id = {$recordsOverleg['katz_id']}"));
    $txtKatzScore = $katz['totaal'];
    if ($txtKatzScore < 5) {
      if ($katz['goedkeuring_inspectie']==1) {
        $txtKatzScore .= "+";
        $katzTitle = "title=\"goedgekeurd na inspectie\"";
      }
      else {
        $tdID = "td" .  $recordsOverleg['katz_id'];
        $txtKatzScore .= "";//" <br /><input type=\"button\" value=\"inspectie\" onClick=\"keurGoed({$txtKatzScore},'$tdID',{$katz['id']}, {$recordsOverleg['id']});\" />";
        $katzTitle = " id = \"$tdID\"";
      }
    }
    $infoKatz = "<a target=\"_blank\" href=\"katz_invullen.php?bekijk=1&katzID={$recordsOverleg['katz_id']}\">$txtKatzScore</a>";
  }
  else {
    $txtKatzScore = "";
    $infoKatz = "";
  }

  $divID = "overleg{$recordsOverleg['id']}";
  $printActie = "<a target=\"_blank\" href=\"print_overleg.php?id={$recordsOverleg['id']}&datum=$datum\">print</a>";

  $locatie = $recordsOverleg['locatieTekst'];

  print ("<tr>
          <td><strong>$overlegType</strong> $locatie</td>
          <td><a href=\"#\" onClick=\"vertoon('$divID');\">".$datum."</a></td>
          <td $katzTitle>$txtKatzScore</td>
          <td>$vergoeding</td>
          <td>$printActie</td>
          </tr>");

echo <<< EINDE
              <tr ><td colspan="6"><div style="margin: 3px; border:1px solid #DDD;display:none" id="$divID">
<style>
#$divID img { display: none;}
</style>

EINDE;
   $alleenGroen = true;
   $checkVerandering = "return false;";
   $overlegInfo = $recordsOverleg;
   require("../includes/deelnemers_ophalen_ajax.php");

   $readOnly = true;
   $overlegID =  $overlegInfo['id'];
   require("../includes/overleg_attesten_bijlagen.php");

   if (is_tp_patient() && $_SESSION['profiel']!='OC') {
     require("../includes/overleg_tp_plan.php");
   }

   print("</div></td></tr>");
}


function toonEvaluatie($evaluatie) {
  global $patientInfo;
  $overlegType= $evaluatie['locatie'];
  $datum=substr($evaluatie['datum'],6,2)."/".substr($evaluatie['datum'],4,2)."/".substr($evaluatie['datum'],0,4);
  if (isset($evaluatie['katz_id'])) {
    if ($evaluatie['katz_id'] < 0)
      $evaluatie['katz_id'] = -$evaluatie['katz_id'];
    $katz = mysql_fetch_array(mysql_query("select * from katz where id = {$evaluatie['katz_id']}"));
    $txtKatzScore = $katz['totaal'];
    $infoKatz = "<a target=\"_blank\" href=\"katz_invullen.php?bekijk=1&katzID={$evaluatie['katz_id']}\">$txtKatzScore</a>";
  }
  else {
    $txtKatzScore = "";
    $infoKatz = " ";
  }
  $printActie = "<a target=\"_blank\" href=\"print_evaluatie.php?id={$evaluatie['id']}\">print</a>";
  $divID = "evaluatie{$evaluatie['id']}";
  print ("<tr>
          <td>$overlegType</td>
          <td><a href=\"#\" onClick=\"vertoon('$divID');\">".$datum."</a></td>
          <td>$txtKatzScore</td>
          <td>$vergoeding</td>
          <td>$printActie</td>
          <td>");
  print("</td></tr>");

  if ($evaluatie['genre'] == "patient") {
   $naampje[0] = $_SESSION['pat_naam'] . ' ' . $_SESSION['pat_voornaam'];
  }
  else {
    if ($evaluatie['genre'] == "mantel") {
      $tabel = "mantelzorgers";
    }
    else if ($evaluatie['genre'] == "hulp") {
      $tabel = "hulpverleners";
    }
    else if ($evaluatie['genre'] == "orgpersoon") {
      $tabel = "hulpverleners";
    }
    else {
      $tabel = "logins";
    }
    $naampje = mysql_fetch_array(mysql_query("select concat(naam, concat(' ', voornaam))
                    from $tabel where id = {$evaluatie['uitvoerder_id']}"));
  }
  echo <<< EINDE
              <tr ><td colspan="6"><div style="margin: 3px; border:1px solid #DDD;display:none" id="$divID">
                   <table cellpadding="5" width="100%">
                   <tr>
                      <th class="even" width="30%">Uitvoerder </td>
                      <th class="even" width="10%">Katz-score </td>
                      <th class="even" width="60%">Voortgang  </td>
                   </tr>
                   <tr>
                      <td valign="top">{$naampje[0]} </td>
                      <td valign="top">$infoKatz </td>
                      <td valign="top">{$evaluatie['vooruitgang']} </td>
                   </tr></table>
EINDE;
   toonTaakfiche("evaluatie" . $evaluatie['id']);

   // de huidige organisator mag de rechten van een evaluatie wijzigen
    if ($patientInfo['toegewezen_genre']=="gemeente" && $_SESSION['profiel']=="OC") {
      $magVeranderen = true;
    }
    else if ($patientInfo['toegewezen_genre']=="hulp" && $_SESSION['profiel']=="hulp"
             && $patientInfo['toegewezen_id']== $_SESSION['usersid']) {
      $magVeranderen = true;
    }
    else if ($patientInfo['toegewezen_genre']=="rdc" && $_SESSION['profiel']=="rdc"
             && $patientInfo['toegewezen_id']== $_SESSION['organisatie']) {
      $magVeranderen = true;
    }
    else if ($patientInfo['toegewezen_genre']=="psy" && $_SESSION['profiel']=="psy"
             && $patientInfo['toegewezen_id']== $_SESSION['organisatie']) {
      $magVeranderen = true;
    }
    else {
      $magVeranderen = false;
    }
   toonRechten("evaluatie", "evaluatie", $evaluatie['id'], $magVeranderen);
   print("</div><!-- einde $divID --></td></tr>");
}

function vroegste($overleg, $overlegTP, $evaluatie) {
  global $order;
  if ($order == "ASC") {
    if (($overleg <= $overlegTP) && ($overleg <= $evaluatie)) return "overleg";
    else if (($overlegTP <= $overleg) && ($overlegTP <= $evaluatie)) return "overlegTP";
    else if (($evaluatie <= $overleg) && ($evaluatie <= $overlegTP)) return "evaluatie";
    else return "overleg";
  }
  else {
    if (($overleg >= $overlegTP) && ($overleg >= $evaluatie)) return "overleg";
    else if (($overlegTP >= $overleg) && ($overlegTP >= $evaluatie)) return "overlegTP";
    else if (($evaluatie >= $overleg) && ($evaluatie >= $overlegTP)) return "evaluatie";
    else return "overleg";
  }
}


if (isset($_POST['pat_code']))
  $_SESSION['pat_code'] = $_POST['pat_code'];

if (isset($_GET['pat_code'])) {
   $_SESSION['pat_code'] = $_GET['pat_code'];
}

$paginanaam="Zorgenplan {$_SESSION['pat_code']}";

if (!isset($_SESSION['pat_code'])) {
 //---------------------------------------------------------------

/* Open Empty Html */ include('../includes/open_empty_html.inc');

//---------------------------------------------------------------



?>

    Deze pagina is enkel toegankelijk wanneer u een patient geselecteerd hebt.

    U wordt dadelijk terug gestuurd naar de listel-site waar u links uit het menu een keuze kan maken.

    <script type="text/javascript">

     function redirect()

     {

         <?php print("document.location = \"/\";"); ?>

     }

     setTimeout("redirect()",500);



    </script>



<?php

//-----------------------------------------------------------------

/* Close Empty Html */ include('../includes/close_empty_html.inc');

//-----------------------------------------------------------------



}

else if (IsSet($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan"))

    {

    //----------------------------------------------------------

    /* Maak Dbconnectie */ include('../includes/dbconnect2.inc');

    //----------------------------------------------------------

    //----------------------------------------------------------

    $patient = mysql_fetch_array(mysql_query("select * from patient where code = '{$_SESSION['pat_code']}'"));

    $patientInfo = $patient;

    $_SESSION['pat_naam'] = $patient['naam'];

    $_SESSION['pat_voornaam'] = $patient['voornaam'];



    //----------------------------------------------------------





    $_SESSION['vanuitPatientOverzicht'] = true;

    include("../includes/html_html.inc");

    print("<head>");

    include("../includes/html_head.inc");

?>

<script language="javascript">
  var rechten = new Array();




function keurGoed(katz, td, id, overleg) {

  // en dan een Ajax-request

  var request = createREQ();

  var rand1 = parseInt(Math.random()*9);

  var rand2 = parseInt(Math.random()*999999);

  var url = "katz_keurGoed_ajax.php?id=" + id +

            "&overlegID=" + overleg + "&rand" + rand1 + "=" + rand2;



  request.onreadystatechange = function() {

    if (request.readyState == 4) {

      var result = request.responseText;

      var spatie = 0;

      while ((spatie < result.length && result.charAt(spatie) != 'O') && (result.charAt(spatie) != 'K') ) spatie++;

      result = result.substring(spatie,result.length);



      if (result.substr(0,2) == "KO") {

        alert("Er is iets ambetant misgegaan, nl. " + result);

      }

      else {

        if (result.length > 3) {

          alert("De goedkeuring is genoteerd.\n" + result.substr(3));

        }

        else {

          alert("De goedkeuring door de inspectie is genoteerd.");

        }

        document.getElementById(td).innerHTML = katz + "+";

      }

    }

  }

  // en nu nog de request uitsturen

  var vraag1 = prompt("Bevestig dat deze katzscore goedgekeurd is door de inspectiediensten.\Typ hiervoor 'ja'.");

  if (vraag1 == "Ja" || vraag1 == "JA" || vraag1 == "ja") {

    request.open("GET", url);

    request.send(null);

  }

}



</script>

<style>

    h4 {font-style:normal;margin: 10px 0 7px 10px;}

    ul.list { margin-left: 35px;}

    

    .even {

      background-color: #DDD;

    }

	

	.lijntjes {

	  border-collapse:collapse;

	  border: 1px solid black;

	}

	.lijntjes td {

	   padding: 2px;

	   border:1px solid black;

	}
 .mainblock {
   height: auto;
 }

</style>

<?

    print("</head>");

    print("<body>");

    print("<div align=\"center\">");

    print("<div class=\"pagina\">");

    include("../includes/header.inc");

    include("../includes/kruimelpad.inc");

    print("<div class=\"contents\">");

    include("../includes/menu.inc");

    print("<div class=\"main\">");

    print("<div class=\"mainblock\">");

    





//include("../includes/toonSessie.inc");





    $patientHeader =  "<b>".$_SESSION['pat_naam']." ".$_SESSION['pat_voornaam']." (".$_SESSION['pat_code'].")</b>";



  if ($_SESSION['profiel'] == "hoofdproject" || $_SESSION['profiel'] == "bijkomend project") {
    $resultAantalOverleg = getUniqueRecord("select count(id) as aantal from overleg where (genre = 'TP') and patient_code = '{$_SESSION['pat_code']}'");
  }
  else if ($_SESSION['profiel']=="listel") {
    $resultAantalOverleg = getUniqueRecord("select count(id) as aantal from overleg where patient_code = '{$_SESSION['pat_code']}'");
  }
  else {
    $resultAantalOverleg = getUniqueRecord("select count(id) as aantal from overleg where (genre is NULL or genre in ('gewoon','psy')) and patient_code = '{$_SESSION['pat_code']}'");
  }

  if (true || $resultAantalOverleg['aantal'] > 0) {
    print("<h2>Het zorgplan van $patientHeader</h2>");
    print("\n<ul>\n");

    if ($patientInfo['type']==16 || $patientInfo['type']==18) {
      print("<li><a href=\"javascript:vertoon('crisisplan')\">Bekijk</a> of <a href=\"../php/print_psy_crisisplan.php?overleg=\">print</a> het crisisplan.");
      print("<div id=\"crisisplan\" style=\"display:none;\">");
      
      $readOnly = 1;
      $qryRecentsteCrisisplan = "select overleg.* from overleg inner join psy_crisis on overleg.id = psy_crisis.overleg_id
                                                                                    and overleg.patient_code = '{$_SESSION['pat_code']}' order by datum desc";
      $recentsteCrisisplan = mysql_query($qryRecentsteCrisisplan) or die("Ik kan het meest recente crisisplan niet ophalen.");
      if (mysql_num_rows($recentsteCrisisplan) == 0) {
         print("<p><em>Er is nog geen crisisplan opgesteld voor deze pati&euml;nt.</em></p>\n");
      }
      else {
         $overlegInfo = mysql_fetch_assoc($recentsteCrisisplan);
         $overlegID = $overlegInfo['id'];
         require("../includes/psy_crisisplan.php");
      }

      print("</div></li>");
    }

    // bepalen wie de huidige organisator is
    if ($patientInfo['actief']==0) {
      print("<li>Deze pati&euml;nt staat op archief.</li>");
    }
    else if ($patientInfo['actief']==-1) {
      //print("<p>De huidige organisator is de TP-co&ouml;rdinator van het therapeutisch project.</p>");
    }
    else if ($patientInfo['toegewezen_genre']=="gemeente") {
      print("<li>De huidige organisator is de OCTGZ-OCMW van de woonplaats van de pati&euml;nt.</li>");
    }
    else if ($patientInfo['toegewezen_genre']=="rdc") {
      $orgId = $patientInfo['toegewezen_id'];
      $organisatieRDC = getUniqueRecord("select naam from organisatie where id = $orgId");
      print("<li>De huidige organisator is {$organisatieRDC['naam']}.</li>");
    }
    else if ($patientInfo['toegewezen_genre']=="psy") {
      $orgId = $patientInfo['toegewezen_id'];
      $organisatieRDC = getUniqueRecord("select naam from organisatie where id = $orgId");
 //     $userId = $patientInfo['toegewezen_id'];
 //     $organisatieRDC = getUniqueRecord("select hvl.naam, hvl.voornaam, org.naam as org_naam from logins hvl inner join organisatie org on hvl.organisatie = org.id and hvl.id = $userId");
      print("<li>De huidige organisator is {$organisatieRDC['naam']}.</li>");
    }
    else if ($patientInfo['toegewezen_genre']=="hulp") {
      $hvlId = $patientInfo['toegewezen_id'];
      $orgHVL = getUniqueRecord("select voornaam, naam from hulpverleners where id = $hvlId");
      print("<li>De huidige organisator is {$orgHVL['voornaam']} {$orgHVL['naam']}.</li>");
    }

    print("<li>Druk de huidige lijst <a href=\"print_zorgenplan_02.php?huidige=1{$menosGet}\" target=\"_blank\">Betrokkenen in de thuiszorg</a> af.</li>\n");

    print("<li><a href=\"bericht_maken.php\">Maak een bericht</a> voor de betrokkenen in dit zorgplan.</li>\n");
    print("<li><a href=\"berichten.php?patient={$_SESSION['pat_code']}\">Lees de berichten</a> i.v.m. dit zorgplan.</li>\n");

    print("\n</ul>\n");

    print("<p>Afhankelijk van de inzagerechten, zie je hieronder de acties (overleg en/of evaluatie) rond deze patient.<br />

              Klik op de datum om meer info te krijgen of om die info terug weg te doen.</p>");



  if (isset($_GET['order'])) {

    $order =  $_GET['order'];

    if ($order == "ASC")

      $newOrder = "DESC";

    else

      $newOrder = "ASC";

  }

  else {

    $order = "DESC";

    $newOrder = "ASC";

  }

  $joinMetOverleg = $joinMetEvaluatie = $selectRechten = "";
  $overlegGenreInOverleg = " (o.genre in ('gewoon','psy') or o.genre is NULL) ";
  $overlegGenreVoorwaarde = " overleggenre = 'gewoon' and ";
  if ($_SESSION['profiel']=="OC") {
    //$laatsteOverleg['toegewezen_genre']=="gemeente";
    $overlegVoorwaarde = $evaluatieVoorwaarde = " AND toegewezen_genre = 'gemeente'";
    $overlegVoorwaardeTP = " AND ((toegewezen_genre = 'gemeente' and (genre is NULL or genre in ('gewoon','psy'))) OR (genre='TP' AND tp_rechtenOC = 1))";

    $joinMetEvaluatie = "inner join patient on code = \"{$_SESSION['pat_code']}\"";
  }
  else if ($_SESSION['profiel']=="rdc") {
    //($laatsteOverleg['toegewezen_genre']=="rdc") && ($laatsteOverleg['toegewezen_id']==$_SESSION['organisatie']);
    $overlegVoorwaarde = $evaluatieVoorwaarde = " AND toegewezen_genre = 'rdc'  AND toegewezen_id = {$_SESSION['organisatie']}";
    $overlegVoorwaardeTP =  " AND (toegewezen_genre = 'rdc' AND toegewezen_id = {$_SESSION['organisatie']} and (genre is NULL or genre in ('gewoon','psy')))  ";

    $joinMetEvaluatie = "inner join patient on code = \"{$_SESSION['pat_code']}\"";
  }
  else if ($_SESSION['profiel']=="psy") {
    //($laatsteOverleg['toegewezen_genre']=="rdc") && ($laatsteOverleg['toegewezen_id']==$_SESSION['organisatie']);
    $overlegVoorwaarde = $evaluatieVoorwaarde = " AND toegewezen_genre = 'psy' AND toegewezen_id = {$_SESSION['organisatie']}";
    $overlegVoorwaardeTP =  " AND toegewezen_genre = 'psy' AND (genre is NULL or genre in ('gewoon','psy')) AND toegewezen_id = {$_SESSION['organisatie']}";

    $joinMetEvaluatie = "inner join patient on code = \"{$_SESSION['pat_code']}\"";
  }
  else if ($_SESSION['profiel']=="listel") {
    $overlegVoorwaarde = $evaluatieVoorwaarde = "";
  }
  else if ($_SESSION['profiel']=="super") {
    $overlegVoorwaarde = $evaluatieVoorwaarde = "";
  }
  else if ($_SESSION['profiel']=="hulp") {
    //($laatsteOverleg['toegewezen_genre']=="hulp") && ($laatsteOverleg['toegewezen_id']==$_SESSION['usersid']);
    $selectRechten = ", af.rechten as af_rechten ";
    $joinMetOverleg = " left join afgeronde_betrokkenen af on ($overlegGenreVoorwaarde o.id = af.overleg_id
                                                               and af.persoon_id = {$_SESSION['usersid']} and af.genre = 'hulp')";
    $overlegVoorwaardeTP = $overlegVoorwaarde
                         = " AND ((toegewezen_genre = 'hulp' AND toegewezen_id = {$_SESSION['usersid']})
                                OR
                               (afgerond = 1 and af.rechten = 1)) ";

    $joinMetEvaluatie = " inner join patient on code = \"{$_SESSION['pat_code']}\"
                          inner join evaluatie_rechten r on (evaluatie.id = r.evaluatie
                                                             and r.id = {$_SESSION['usersid']} and r.genre = 'hulp')";
    $evaluatieVoorwaarde = " AND ((toegewezen_genre = 'hulp' AND toegewezen_id = {$_SESSION['usersid']})
                                  OR r.rechten = 1) ";

  }
  else if ($_SESSION['profiel']=="menos") {
    $overlegGenreInOverleg = " (o.genre = 'menos') ";
    $overlegGenreVoorwaarde = " overleggenre = 'menos' and ";
    $overlegVoorwaarde = $overlegVoorwaardeTP = "";
    $evaluatieVoorwaarde = " AND patient.menos=1";
    $joinMetEvaluatie = "inner join patient on code = \"{$_SESSION['pat_code']}\"";
  }
  else {
    // dus voor tp
    $overlegVoorwaarde = $overlegVoorwaardeTP = "";
  }

  $qryOverleg="

        SELECT

            o.*
            $selectRechten

        FROM

            overleg o
            $joinMetOverleg

        WHERE

            o.patient_code='".$_SESSION['pat_code']."'

        AND
        $overlegGenreInOverleg
        $overlegVoorwaarde

        ORDER BY

            o.datum $order";

  if ($_SESSION['profiel'] == "hoofdproject" || $_SESSION['profiel'] == "bijkomend project") {
     $qryOverlegTP="
        SELECT
            o.*, tp_project.nummer
        FROM
            overleg o
             inner join patient_tp on (o.patient_code = patient_tp.patient and patient_tp.project = {$_SESSION['tp_project']})
             inner join tp_project on patient_tp.project = tp_project.id
        WHERE
            o.datum >= replace(begindatum, '-', '')
        AND (o.datum <= replace(einddatum, '-', '')
               or
             einddatum is NULL
            )
        AND o.patient_code='".$_SESSION['pat_code']."'
        AND (o.genre = 'TP')
        ORDER BY
            o.datum $order";
  }
  else {
    $qryOverlegTP="
        SELECT
            o.*, tp_project.nummer
        FROM
           (overleg o
            $joinMetOverleg)
            , patient_tp inner join tp_project on patient_tp.project = tp_project.id


        WHERE
            o.datum >= replace(begindatum, '-', '')
        AND (o.datum <= replace(einddatum, '-', '')
               or
             einddatum is NULL
            )
        AND o.patient_code='".$_SESSION['pat_code']."'
        AND patient_tp.patient = o.patient_code
        AND (o.genre = 'TP')
        $overlegVoorwaardeTP
        /* $datumControle */
        ORDER BY
            o.datum $order";
  }
// debug
//print("<h1>$qryOverleg</h1>");
//print("<h1>$qryOverlegTP</h1>");

    $qryEvaluatie="

        SELECT

            evaluatie.*

        FROM

            evaluatie
            $joinMetEvaluatie

        WHERE

            patient='".$_SESSION['pat_code']."'
            $evaluatieVoorwaarde

        ORDER BY

            evaluatie.datum $order";







   if ($order == "ASC") $extremeDatum = "99999999";

   else $extremeDatum = "-1";



   print("<table width=\"100%\"><tr>

                    <th>Type</th>

                    <th><a href=\"patientoverzicht.php?pat_code={$_SESSION['pat_code']}&order=$newOrder\">Datum</a></th>

                    <th>Katz</th>

                    <th>Vergoeding</th>

                    <th>&nbsp;</th>

                    </tr>");

   if (($resultOverleg=mysql_query($qryOverleg)) &&

       ($resultOverlegTP=mysql_query($qryOverlegTP)) &&

       ($resultEvaluatie=mysql_query($qryEvaluatie))) {

     $aantalOverleg = mysql_num_rows($resultOverleg);

     $aantalOverlegTP = mysql_num_rows($resultOverlegTP);

     $aantalEvaluatie = mysql_num_rows($resultEvaluatie);

     if ($_GET['alleenOverleg']==1) {

       $aantalEvaluatie = 0;

     }

     $nrOverleg = $nrOverlegTP = $nrEvaluatie = 0;

     if ($nrOverleg < $aantalOverleg) {

        $huidigOverleg = mysql_fetch_array($resultOverleg);

        $overlegDatum = $huidigOverleg['datum'];

     }

     else {

       $overlegDatum = $extremeDatum;

     }

     if ($nrOverlegTP < $aantalOverlegTP) {

       $huidigOverlegTP = mysql_fetch_array($resultOverlegTP);

       $overlegTPDatum = $huidigOverlegTP['datum'];

     }

     else {

       $overlegTPDatum = $extremeDatum;

     }

     if ($nrEvaluatie < $aantalEvaluatie) {

       $huidigeEvaluatie = mysql_fetch_array($resultEvaluatie);

       $evaluatieDatum = $huidigeEvaluatie['datum'];

     }

     else {

       $evaluatieDatum = $extremeDatum;

     }

     

     $aantalDingen = $aantalEvaluatie + $aantalOverleg + $aantalOverlegTP;

     //while ($nrOverleg < $aantalOverleg || $nrOverlegTP < $aantalOverlegTP || $nrEvaluatie < $aantalEvaluatie) {

     for ($x = 0; $x < $aantalDingen; $x++) {

         $vroegste = vroegste($overlegDatum, $overlegTPDatum, $evaluatieDatum);

         if ($vroegste == "overleg") {

           toonOverleg($huidigOverleg);

           $nrOverleg++;

           if ($nrOverleg < $aantalOverleg) {

             $huidigOverleg = mysql_fetch_array($resultOverleg);

             $overlegDatum = $huidigOverleg['datum'];

           }

           else {

             $overlegDatum = $extremeDatum;

           }

         }

         else if ($vroegste == "overlegTP") {

           toonOverlegTP($huidigOverlegTP);

           $nrOverlegTP++;

           if ($nrOverlegTP < $aantalOverlegTP) {

             $huidigOverlegTP = mysql_fetch_array($resultOverlegTP);

             $overlegTPDatum = $huidigOverlegTP['datum'];

           }

           else {

             $overlegTPDatum = $extremeDatum;

           }

         }

         else if ($vroegste == "evaluatie") {

           toonEvaluatie($huidigeEvaluatie);

           $nrEvaluatie++;

           if ($nrEvaluatie < $aantalEvaluatie) {

             $huidigeEvaluatie = mysql_fetch_array($resultEvaluatie);

             $evaluatieDatum = $huidigeEvaluatie['datum'];

           }

           else {

             $evaluatieDatum = $extremeDatum;

           }

         }

         else {

           print("<h1>tis gedaan!!$vroegste</h1>");

           break;

         }



      } // einde while

      print("</table>");

    }

    else {

      print("ofwel is $qryEvaluatie ofwel $qryOverleg fout gegaan!" . mysql_error());

    }



?>



<p>Wanneer hierboven evaluaties staan, kan je <a href="print_evaluaties_allemaal.php">alle evaluaties in &eacute;&eacute;n beweging afdrukken</a>.</p>



<div id="subsidiestatusDiv" style="display:none;">

</div>

<script type="text/javascript">

  var subsidiestatusWordtBerekend = false;

  var subsidieStatus = "<?= $patientInfo['subsidiestatus'] ?>";

  var minimumStatus = "<?= $patientInfo['minimum_subsidiestatus'] ?>";
<?php
  if (date("Y") < 2010) {
?>

  toonSubsidiestatus("subsidiestatusDiv", "<?= $patientInfo['code'] ?>", subsidieStatus);
<?php
  }
?>
</script>
<?php
} // einde van het gewone zorgplan

  if ($patientInfo['menos'] == "1" && isBetrokkenBijMenos($_SESSION['pat_code'], $_SESSION['profiel'], $_SESSION['usersid'])) {
    print("<hr/>\n");
    print("<h2>Het menos-dossier van $patientHeader</h2>\n");
    $patientMenos = mysql_fetch_assoc(mysql_query("select * from patient_menos where patient = '{$_SESSION['pat_code']}'"));
    print("<li>Afspraken <div style=\"border: 1px solid #aaa;padding:4px;\">{$patientMenos['afspraken']}</div></li>\n");
    print("<li><a href=\"bericht_maken.php\">Maak een bericht</a> voor de betrokkenen in dit zorgplan.</li>\n");
    print("<li><a href=\"berichten.php?patient={$_SESSION['pat_code']}\">Lees de berichten</a> i.v.m. dit zorgplan.</li>\n");

    print("<br/>\n");
    alleInterventies($_SESSION['pat_code'], false, " van menos ");

  }

    //---------------------------------------------------------

    /* Sluit Dbconnectie */ include("../includes/dbclose.inc");

    //---------------------------------------------------------

    print("</div>");

    print("</div>");

    print("</div>");

    include("../includes/footer.inc");

    print("</div>");

    print("</div>");

    print("</body>");

    print("</html>");

    }

//---------------------------------------------------------

/* Geen Toegang */ include("../includes/check_access.inc");

//---------------------------------------------------------





?>