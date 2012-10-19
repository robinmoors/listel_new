<?php

session_start();

if (isset($_POST['pat_code']))

  $_SESSION['pat_code'] = $_POST['pat_code'];

if (isset($_GET['pat_code'])) {

   $_SESSION['pat_code'] = $_GET['pat_code'];

}



   require("../includes/dbconnect2.inc");

   $paginanaam="Bericht lezen";

   if (IsSet($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan"))

      {

      require("../includes/html_html.inc");

      print("<head>");

      require("../includes/html_head.inc");

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
if ($_SESSION['profiel']=="hulp") {
  $persoon_genre = "hulp";
  $persoon_id = $_SESSION['usersid'];
}
else if ($_SESSION['profiel']=="rdc") {
  $persoon_genre = "rdc";
  $persoon_id = $_SESSION['organisatie'];
}
else if ($_SESSION['profiel']=="psy") {
  $persoon_genre = "psy";
  $persoon_id = $_SESSION['organisatie'];
}
else if ($_SESSION['profiel']=="menos") {
  $persoon_genre = "menos";
  $persoon_id = -666;
}
else {
  $persoon_genre = "sit";
  $persoon_id = $_SESSION['overleg_gemeente'];
}

$mail = getUniqueRecord("select berichten.*, patient.code, patient.naam, patient.voornaam
                         from berichten_to, berichten inner join patient on patient = code
                         where berichten.id = {$_GET['id']}
                           and berichten_to.bericht = berichten.id
                           and persoon = $persoon_id
                           and genre = '$persoon_genre'");

if ($mail['naam']=="") die("Dit bericht is niet voor uw ogen bestemd!!");

$_SESSION['pat_code'] = $mail['code'];

mysql_query("update berichten_to set gelezen = 1
              where bericht = {$_GET['id']}
                and persoon = $persoon_id
                and genre = '$persoon_genre'"  );
?>

<h2>Bericht ivm <?= $mail['patient'] ?> - <?= $mail['voornaam'] ?> <?= $mail['naam'] ?></h2>

<p>Bekijk eventueel <a href="patientoverzicht.php?pat_code=<?= $_SESSION['pat_code'] ?>">het zorgplan van deze pati&euml;nt</a>
of ga terug naar <a href="#" onclick="history.go(-1);">de brievenbus.</a></p>


<div id="bericht_onderwerp">
<label for="onderwerp">Onderwerp</label><input type="text" style="width:333px;" name="onderwerp" id="onderwerp" value="<?= $mail['onderwerp'] ?>" />
<input type="button" value="reageer" onclick="window.location='bericht_maken.php?id=<?= $_GET['id'] ?>';"/>
</div>

<div id="bericht_bestemmingen">
<table>
<tr><th>Aan</th><th>CC:</th><th>Naam</th><th>Functie</th></tr>
<?php
$qry = "select -666 as id, 'Menos' as voornaam, 'menos' as fnaam, br.status from berichten_to br
        WHERE
           -666 = br.persoon and br.genre = 'menos'
           and br.bericht = {$_GET['id']}";
$hvls = mysql_query($qry) or die("Kan de menos niet ophalen ($qry): " . mysql_error());

for ($i=0; $i< mysql_num_rows($hvls); $i++) {
  $hvl = mysql_fetch_assoc($hvls);
  if ($hvl['status']=="to") $toChecked = " checked=\"checked\" ";
  else $toChecked = "";
  if ($hvl['status']=="cc") $ccChecked = " checked=\"checked\" ";
  else $ccChecked = "";

  echo <<< MENOS
    <tr>
      <td><input type="checkbox" $toChecked name="aan[{$hvl['id']}]" id="to$i" value="hulp" onclick="return false;"/></td>
      <td><input type="checkbox" $ccChecked name="cc[{$hvl['id']}]" id="cc$i" value="hulp" onclick="return false;"></td>
      <td>{$hvl['voornaam']} {$hvl['naam']}</td>
      <td>{$hvl['fnaam']}</td>
    </tr>
MENOS;
}

if ($patientInfo['menos']== 1) {
  if ($reply) {
    $zoekterm = "{$zoekGenre}_{$patientInfo['toegewezen_id']}";
    if (in_array($zoekterm,$bestemmingen)) {
      if ($statusBestemming[$zoekterm] == "to") {
        $toChecked = "  checked=\"checked\" ";
        $ccChecked = "";
      }
      else {
        $toChecked = "";
        $ccChecked = "  checked=\"checked\" ";
      }
    }
    else {
      $toChecked = $ccChecked = "";
    }
  }
  else {
    $toChecked = "  checked=\"checked\" ";
    $ccChecked = "";
  }

  $organisatorGenre = "menos";
  $patientInfo['toegewezen_id'] = -666;
  $patientInfo['toegewezen_genre'] = "menos";
  $organisator['naam'] = "menos";

  echo <<< MENOS
    <tr>
      <td><input type="checkbox" $toChecked name="aan[{$patientInfo['toegewezen_id']}]" id="to__" value="{$patientInfo['toegewezen_genre']}" onclick="exclusief('to','__');"/></td>
      <td><input type="checkbox" $ccChecked name="cc[{$patientInfo['toegewezen_id']}]" id="cc__" value="{$patientInfo['toegewezen_genre']}" onclick="exclusief('cc','__');"></td>
      <td>{$organisator['naam']}</td>
      <td>$organisatorGenre</td>
    </tr>
MENOS;
}


$qry = "select naam, 'OCTGZ OCMW' as fnaam, br.status from berichten_to br inner join gemeente
            on gemeente.zip = br.persoon and br.genre = 'sit'
           and br.bericht = {$_GET['id']} limit 0,1";
$hvls = mysql_query($qry) or die("Kan de sit niet ophalen ($qry): " . mysql_error());

for ($i=0; $i< mysql_num_rows($hvls); $i++) {
  $hvl = mysql_fetch_assoc($hvls);
  if ($hvl['status']=="to") $toChecked = " checked=\"checked\" ";
  else $toChecked = "";
  if ($hvl['status']=="cc") $ccChecked = " checked=\"checked\" ";
  else $ccChecked = "";

  echo <<< HVL
    <tr>
      <td><input type="checkbox" $toChecked name="aan[{$hvl['id']}]" id="to$i" value="hulp" onclick="return false;"/></td>
      <td><input type="checkbox" $ccChecked name="cc[{$hvl['id']}]" id="cc$i" value="hulp" onclick="return false;"></td>
      <td>{$hvl['naam']}</td>
      <td>{$hvl['fnaam']}</td>
    </tr>
HVL;
}

$qry = "select hvl.id, hvl.voornaam, hvl.naam, 'rdc' as fnaam, br.status from berichten_to br inner join logins hvl
            on hvl.id = br.persoon and br.genre = 'rdc'
           and br.bericht = {$_GET['id']}";
$hvls = mysql_query($qry) or die("Kan de rdc niet ophalen ($qry): " . mysql_error());

for ($i=0; $i< mysql_num_rows($hvls); $i++) {
  $hvl = mysql_fetch_assoc($hvls);
  if ($hvl['status']=="to") $toChecked = " checked=\"checked\" ";
  else $toChecked = "";
  if ($hvl['status']=="cc") $ccChecked = " checked=\"checked\" ";
  else $ccChecked = "";

  echo <<< HVL
    <tr>
      <td><input type="checkbox" $toChecked name="aan[{$hvl['id']}]" id="to$i" value="hulp" onclick="return false;"/></td>
      <td><input type="checkbox" $ccChecked name="cc[{$hvl['id']}]" id="cc$i" value="hulp" onclick="return false;"></td>
      <td>{$hvl['voornaam']} {$hvl['naam']}</td>
      <td>{$hvl['fnaam']}</td>
    </tr>
HVL;
}

$qry = "select hvl.id, hvl.voornaam, hvl.naam, 'psy' as fnaam, br.status from berichten_to br inner join logins hvl
            on hvl.id = br.persoon and br.genre = 'psy'
           and br.bericht = {$_GET['id']}";
$hvls = mysql_query($qry) or die("Kan de psy niet ophalen ($qry): " . mysql_error());

for ($i=0; $i< mysql_num_rows($hvls); $i++) {
  $hvl = mysql_fetch_assoc($hvls);
  if ($hvl['status']=="to") $toChecked = " checked=\"checked\" ";
  else $toChecked = "";
  if ($hvl['status']=="cc") $ccChecked = " checked=\"checked\" ";
  else $ccChecked = "";

  echo <<< HVL
    <tr>
      <td><input type="checkbox" $toChecked name="aan[{$hvl['id']}]" id="to$i" value="hulp" onclick="return false;"/></td>
      <td><input type="checkbox" $ccChecked name="cc[{$hvl['id']}]" id="cc$i" value="hulp" onclick="return false;"></td>
      <td>{$hvl['voornaam']} {$hvl['naam']}</td>
      <td>{$hvl['fnaam']}</td>
    </tr>
HVL;
}

// voorlopig alleen voor hulpverleners
$qry = "select distinct hvl.id, hvl.voornaam, hvl.naam, functies.naam as fnaam, br.status from berichten_to br inner join hulpverleners hvl
            on hvl.id = br.persoon and br.genre = 'hulp'
           and br.bericht = {$_GET['id']}
           inner join functies on hvl.fnct_id = functies.id";
$hvls = mysql_query($qry) or die("Kan de hulpverleners met rechten niet ophalen ($qry): " . mysql_error());

for ($i=0; $i< mysql_num_rows($hvls); $i++) {
  $hvl = mysql_fetch_assoc($hvls);
  if ($hvl['status']=="to") $toChecked = " checked=\"checked\" ";
  else $toChecked = "";
  if ($hvl['status']=="cc") $ccChecked = " checked=\"checked\" ";
  else $ccChecked = "";

  echo <<< HVL
    <tr>
      <td><input type="checkbox" $toChecked name="aan[{$hvl['id']}]" id="to$i" value="hulp" onclick="return false;" /></td>
      <td><input type="checkbox" $ccChecked name="cc[{$hvl['id']}]" id="cc$i" value="hulp" onclick="return false;" ></td>
      <td>{$hvl['voornaam']} {$hvl['naam']}</td>
      <td>{$hvl['fnaam']}</td>
    </tr>
HVL;
}
?>

</table>

</div>

<div id="bericht_bijlagen">
<p>Bijlagen</p>
<table id="table_bijlagen">
<?php
$qry = "select * from berichten_bijlage where bericht = {$_GET['id']} order by bestand";
$bijlageResult = mysql_query($qry) or die("problemen met het ophalen van de bijlagen. $qry" . mysql_error());
$aantalBijlagen = mysql_num_rows($bijlageResult);
if ($aantalBijlagen == 0) {print("<tr><td>Geen bijlagen bij dit bericht.</td></tr>\n");}
else {
  for ($b = 0; $b<$aantalBijlagen; $b++) {
    $bijlage = mysql_fetch_assoc($bijlageResult);
    print("<tr><td><a href=\"../_berichten_bijlagen/{$bijlage['bericht']}_{$bijlage['bestand']}\" target=\"_blank\">{$bijlage['bestand']}</a></td></tr>\n");
  }
}
?>
</table>
</div>

<div id="bericht_inhoud">
<p>Boodschap</p>
<textarea name="boodschap"><?= $mail['boodschap'] ?></textarea>
</div>

</form>

<?php

// einde mainblock



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