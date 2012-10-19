<?php

session_start();




   require("../includes/dbconnect2.inc");

   $paginanaam="Berichtenoverzicht";

   if (IsSet($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan"))

      {

      require("../includes/html_html.inc");

      print("<head>");

      require("../includes/html_head.inc");
?>
<style type="text/css">
.even td {
  background-color: #ffd;
}
.oneven td {
  background-color: #eee;
}

td:hover {
  border-bottom: dotted blue 1px;
}

th {
  font-size: 11px;
}
td {
  font-size: 10px;
}

</style>


<?php
      print("</head>");

      print("<body>");

      print("<div align=\"center\">");

      print("<div class=\"pagina\">");

      require("../includes/header.inc");

      require("../includes/kruimelpad.inc");

      print("<div class=\"contents\">");

      require("../includes/menu.inc");

      print("<div class=\"main\">");

      print("<div class=\"mainblock\">");
// begin mainblock
?>


<h1>De Listel-brievenbus</h1>
<?php



if ($_SESSION['profiel']=="hulp") {
  $persoon_genre = "hulp";
  $persoon_id = $_SESSION['usersid'];
}
else if ($_SESSION['profiel']=="menos") {
  $persoon_genre = "menos";
  $persoon_id = -666;
}
else if ($_SESSION['profiel']=="rdc") {
  $persoon_genre = "rdc";
  $persoon_id = $_SESSION['organisatie'];
}
else {
  $persoon_genre = "sit";
  $persoon_id = $_SESSION['overleg_gemeente'];
}

if ($_GET['wissen']==1 && isset($_GET['wis'])) {
  $aantal = 0;
  foreach ($_GET['wis'] as $id => $on) {
    $lijst .= ", $id";
    $aantal++;
  }
  if ($aantal == 1) $aantalTxt = "1 bericht ";
  else $aantalTxt = "$aantal berichten ";
  $lijst= substr($lijst, 2);
  $wisQry = "update berichten_to set actief = 0
             where persoon = $persoon_id and genre = '$persoon_genre'
               and bericht in ($lijst)";
  if (mysql_query($wisQry)) {
    print("<div style=\"background-color:#8f8\">$aantalTxt zijn gewist.</div>\n");
    $_GET['totaal']-= $aantal;
    if ($_GET['begin']>$_GET['totaal']) $_GET['begin']= max($_GET['totaal']-50,0);
  }
  else {
    print("<div style=\"background-color:#f88\">Wisprobleem $wisQry" .mysql_error() . "</div>\n");
  }
}

?>
<form method="get" name="selecteerPatient">
<input type="hidden" name="order" value="<?= $_GET['order'] ?>" />
<input type="hidden" name="patient" value="<?= $_GET['patient'] ?>" />
<input type="hidden" name="begin" value="<?= $_GET['begin'] ?>" />
<input type="hidden" name="totaal" value="<?= $totaal ?>" />
<input type="hidden" name="wissen" value="1" />
<!-- <input type="submit" value="filter op pati&euml;nt :    "/>    -->
<select name="patient" onchange="document.selecteerPatient.submit();">
  <option value="">Alle pati&euml;nten</option>
<?php

$patQuery = "select distinct patient, naam, voornaam from berichten inner join berichten_to
                 on berichten.id = berichten_to.bericht and persoon = $persoon_id and genre = '$persoon_genre'
                 inner join patient on patient = code
                 order by patient";


$pats = mysql_query($patQuery) or die("probleem met ophalen patienten $patQuery " . mysql_error());

for ($p = 0; $p < mysql_num_rows($pats); $p++) {
  $pat = mysql_fetch_assoc($pats);
  if ($_GET['patient']==$pat['patient']) {
    $selected = " selected=\"selected\" ";
  }
  else {
    $selected = "";
  }
  print("   <option value=\"{$pat['patient']}\" $selected>{$pat['patient']} : {$pat['voornaam']} {$pat['naam']}</option>\n");
}

print("</select></form><br/><br/>\n");

if (isset($_GET['patient']) && $_GET['patient']!="") {
  $patientVW = " and patient = \"{$_GET['patient']}\" ";
  $patVeld = false;
}
else {
  $patVeld = true;
}

if (isset($_GET['begin']) && $_GET['begin'] > 0) {
  $limit = " limit {$_GET['begin']}, 50 ";
}

$mailQuery = "
select distinct auteur_id, berichten.*, berichten_to.gelezen, patient.voornaam, patient.naam
from patient inner join berichten on patient = code inner join berichten_to on berichten.id = berichten_to.bericht
              where persoon = $persoon_id and genre = '$persoon_genre'
                and berichten_to.actief = 1
              $patientVW
              order by gelezen {$_GET['order']}
              $limit";


$mailResult = mysql_query($mailQuery) or die("Kan de berichten even niet ophalen ($mailQuery).<br/>"  . mysql_error() );

if (!isset($_GET['totaal'])) {
  $totaal = mysql_num_rows($mailResult);
}
else {
  $totaal = $_GET['totaal'];
}

$urlParamsDeel = "&totaal=$totaal&patient={$_GET['patient']}";
$urlParams = "&begin={$_GET['begin']}$urlParamsDeel";

function linkNaarDeel($start) {
  global $urlParamsDeel,$totaal;
  $start1 = $start+1;
  $stop = min($start+50,$totaal);
  
  echo <<< EINDE
    <a href="berichten.php?begin=$start&order={$_GET['order']}$urlParamsDeel">$start1..$stop</a>
EINDE;
}

if ($totaal > 50) {
  print("<p>");
  for ($links = 0; $links <= $totaal; $links = $links + 50) {
    linkNaarDeel($links);
  }
  print("</p>");
}

?>
<form method="get">
<input type="hidden" name="order" value="<?= $_GET['order'] ?>" />
<input type="hidden" name="patient" value="<?= $_GET['patient'] ?>" />
<input type="hidden" name="begin" value="<?= $_GET['begin'] ?>" />
<input type="hidden" name="totaal" value="<?= $totaal ?>" />
<input type="hidden" name="wissen" value="1" />
<table>
<tr>
  <th>Wis</th>
<?php
  if ($patVeld) echo <<< PATIENT_HEADER
              <th>Pati&euml;nt <a href="berichten.php?order=,patient asc$urlParams">A..</a> <a href="berichten.php?order=,patient desc$urlParams">Z..</a></th>
PATIENT_HEADER;
?>
              <th>Auteur <a href="berichten.php?order=,auteur asc<?= $urlParams ?>">A..</a> <a href="berichten.php?order=,auteur desc<?= $urlParams ?>">Z..</a></th>
              <th>Onderwerp <a href="berichten.php?order=,onderwerp asc<?= $urlParams ?>">A..</a> <a href="berichten.php?order=,onderwerp desc<?= $urlParams ?>">Z..</a></th>
              <th>Datum  <a href="berichten.php?order=,timestamp asc<?= $urlParams ?>">A..</a> <a href="berichten.php?order=,timestamp desc<?= $urlParams ?>">Z..</a></th>
</tr>
<?php
if (mysql_num_rows($mailResult) > 50) {
  $aantalRecords = 50;
}
else {
  $aantalRecords = mysql_num_rows($mailResult);
}

for ($i=0; $i<$aantalRecords; $i++) {
  $mail = mysql_fetch_assoc($mailResult);


  if ($mail['auteur_genre']=='menos') $mail['auteur']="menos";
  else {
    if ($mail['auteur_genre']=='hulp') {
      $qryAuteur = "select concat_ws(' ', naam, ' ', voornaam) as auteur
                     from logins where id = {$mail['auteur_id']}";
    }
    else {
      $qryAuteur = "select concat_ws(' ', naam, ' ', voornaam) as auteur
                     from hulpverleners where id = {$mail['auteur_id']}";
    }
    $auteur = getFirstRecord($qryAuteur);
    $mail['auteur'] = $auteur['auteur'];
  }

  if ($i%2==0) $class = "oneven";
  else $class = "even";
  if ($mail['gelezen']==0) {
    $leesStatus = " style=\"font-weight:bold;\" title=\"ongelezen mail\" ";
  }
  else {
    $leesStatus = "";
  }
  $oudeDatum = $mail['timestamp'];
  $datum = substr($oudeDatum,8,2) . "/" .  substr($oudeDatum,5,2) . "/" .  substr($oudeDatum,0,4) . substr($oudeDatum,10);
  $klik = " onclick=\"window.location='bericht_lezen.php?id={$mail['id']}';\" ";
  print("<tr class=\"$class\" $leesStatus>
             <td><input type=\"checkbox\" name=\"wis[{$mail['id']}]\"/></td>
");
  if ($patVeld) echo <<< PATIENT_VELD
             <td $klik>{$mail['patient']}<br/>{$mail['voornaam']} {$mail['naam']}</td>
PATIENT_VELD;
  print("             <td $klik>{$mail['auteur']}</td>
             <td $klik>{$mail['onderwerp']}</td>
             <td $klik>$datum</td></tr>\n");
}
print("</table>");
print("<input type=\"submit\" value=\"wis aangevinkte berichten\" title=\"Na het wissen kunnen andere bestemmelingen nog steeds deze boodschappen lezen. Het is dus geen 'echt' wissen.\"/></form>\n");




      print("</div>");

      print("</div>");

      print("</div>");

      require("../includes/dbclose.inc");

      require("../includes/footer.inc");

      print("</div>");

      print("</div>");

      print("</body>");

      print("</html>");

      }



//---------------------------------------------------------

/* Geen Toegang */ require("../includes/check_access.inc");

//---------------------------------------------------------



//---------------------------------------------------------

/* Sluit Dbconnectie */ require("../includes/dbclose.inc");

//---------------------------------------------------------

?>