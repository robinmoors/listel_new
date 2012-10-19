<?php

session_start();

if (isset($_POST['pat_code']))

  $_SESSION['pat_code'] = $_POST['pat_code'];

if (isset($_GET['pat_code'])) {

   $_SESSION['pat_code'] = $_GET['pat_code'];

}



   require("../includes/dbconnect2.inc");

   $paginanaam="Bericht maken";

   if (IsSet($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan"))

      {

      require("../includes/html_html.inc");

      print("<head>");

      require("../includes/html_head.inc");
?>
<script type="text/javascript">
  function exclusief(bron, nr) {
    if (bron == "to" && document.getElementById("to"+nr).checked) {
      document.getElementById("cc"+nr).checked = false;
    }
    else if (bron == "cc" && document.getElementById("cc"+nr).checked) {
      document.getElementById("to"+nr).checked = false;
    }
  }
  
  var bestanden = new Array();
  bestanden[1] = true;
  
  function bestandToevoegen(nr) {
    if (document.getElementById('bestand'+nr).value != "" && bestanden[nr]) {
       bestanden[nr] = false;
       bestanden[nr+1] = true;
       var nieuwFile =
         "<a onclick=\"document.getElementById('td_bestand" + (nr+1) + "').innerHTML='';\"><img src=\"../images/wis.gif\" alt=\"wis\"/></a>\n"
         + "<input type=\"file\" name=\"bestand" + (nr+1) + "\" id=\"bestand" + (nr+1) + "\" onchange=\"bestandToevoegen(" + (nr+1) + ");\"/>";
       var tabel = document.getElementById("table_bijlagen");
       var rij = tabel.insertRow(nr);
       var td = rij.insertCell(0);
       td.innerHTML = nieuwFile;
       td.id = "td_bestand"+(nr+1);
    }
  }
</script>
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

if (isset($_GET['id'])) {
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

  $mail = getUniqueRecord("select berichten.*, patient.naam, patient.voornaam
                         from berichten_to, berichten inner join patient on patient = code
                         where berichten.id = {$_GET['id']}
                           and berichten_to.bericht = berichten.id
                           and persoon = $persoon_id
                           and genre = '$persoon_genre'");

  if ($mail['naam']=="") die("Dit bericht is niet voor uw ogen bestemd!!");
  $mail['onderwerp'] = "Re: {$mail['onderwerp']}";
  
  $bestemmingenQry = "select * from berichten_to where bericht = {$_GET['id']}";
  $bestemmingenResult = mysql_query($bestemmingenQry) or die("geen bestemmingen" .mysql_error());
  for ($i=0; $i<mysql_num_rows($bestemmingenResult); $i++) {
    $bestemmingenRij = mysql_fetch_assoc($bestemmingenResult);
    $bestemmingen[$i] = "{$bestemmingenRij['genre']}_{$bestemmingenRij['persoon']}";
    $statusBestemming["{$bestemmingenRij['genre']}_{$bestemmingenRij['persoon']}"] = $bestemmingenRij['status'];
  }
  $reply = true;
}
else {
  $reply = false;
}

if ($mail['boodschap']=="")
  $boodschap = "Typ hier uw bericht";
else
  $boodschap = $mail['boodschap'];

// begin mainblock
$patientInfo = getUniqueRecord("select * from patient where code = \"{$_SESSION['pat_code']}\"");

?>

<h2>Stuur een bericht ivm <?= $_SESSION['pat_code'] ?> <?= $patientInfo['voornaam'] ?> <?= $patientInfo['naam'] ?></h2>

<p>Bekijk eerst, indien je dit nog niet gedaan hebt, <a href="patientoverzicht.php?pat_code=<?= $_SESSION['pat_code'] ?>">het zorgplan van deze pati&euml;nt</a>.</p>

<form method="post" action="bericht_versturen.php"  enctype="multipart/form-data" >

<div id="bericht_onderwerp">
<label for="onderwerp">Onderwerp</label><input tabindex="1" type="text" style="width:333px;" name="onderwerp" id="onderwerp" value="<?= $mail['onderwerp'] ?>"/>
<input type="submit" value="verstuur bericht"/>
</div>

<div id="bericht_bestemmingen">
<table>
<tr><th>Aan</th><th>CC:</th><th>Naam</th><th>Functie</th></tr>
<?php
if ($patientInfo['menos']== 1) {
  $organisatorGenre = "menos";
  $patientInfo['toegewezen_id'] = -666;
  $patientInfo['toegewezen_genre'] = "menos";
  $organisator['naam'] = "menos";
  $zoekGenre = "menos";

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

  echo <<< MENOS
    <tr>
      <td><input type="checkbox" $toChecked name="aan[{$patientInfo['toegewezen_id']}]" id="to__" value="{$patientInfo['toegewezen_genre']}" onclick="exclusief('to','__');"/></td>
      <td><input type="checkbox" $ccChecked name="cc[{$patientInfo['toegewezen_id']}]" id="cc__" value="{$patientInfo['toegewezen_genre']}" onclick="exclusief('cc','__');"></td>
      <td>{$organisator['naam']}</td>
      <td>$organisatorGenre</td>
    </tr>
MENOS;
}

if ($patientInfo['actief']== 1 && $patientInfo['toegewezen_genre']=="gemeente") {
  $organisator = getUniqueRecord("select zip, sit.naam, 'sel' as genre from sit, gemeente where gemeente.id = {$patientInfo['gem_id']} and gemeente.sit_id = sit.id");
  $patientInfo['toegewezen_id'] = $organisator['zip'];
  $zoekGenre = "sit";
}
else if ($patientInfo['toegewezen_genre']=="rdc") {
  $organisator = getUniqueRecord("select naam, 'rdc' as genre from organisatie where id = {$patientInfo['toegewezen_id']}");
  $zoekGenre = $patientInfo['toegewezen_genre'];
}
else if ($patientInfo['toegewezen_genre']=="psy") {
  $organisator = getUniqueRecord("select naam, 'psy' as genre from organisatie where id = {$patientInfo['toegewezen_id']}");
  $zoekGenre = $patientInfo['toegewezen_genre'];
}
else if ($patientInfo['toegewezen_genre']=="hulp") {
  $organisator = getUniqueRecord("select concat(voornaam, ' ', naam) as naam, 'hulp' as genre from hulpverleners where id = {$patientInfo['toegewezen_id']}");
  $zoekGenre = $patientInfo['toegewezen_genre'];
}
else {
  $organisator['naam']= "N.N";
  $organisator['genre'] = "????";
}

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
  
  if ($organisator['genre']=="sit") {
    $organisatorGenre = "OCTGZ OCMW";
  }
  else if ($organisator['genre']=="hulp") {
    $organisatorGenre = "OCTGZ ZA";
  }
  else if ($organisator['genre']=="rdc") {
    $organisatorGenre = "OCTGZ RDC";
  }
  else if ($organisator['genre']=="psy") {
    $organisatorGenre = "OCTGZ PSY";
  }
  else {
    $organisatorGenre = $organisator['genre'];
  }
  
  if (!($organisator['naam']== "N.N" && $patientInfo['menos']==1)) {
  echo <<< ORG
    <tr>
      <td><input type="checkbox" $toChecked name="aan[{$patientInfo['toegewezen_id']}]" id="to__" value="{$patientInfo['toegewezen_genre']}" onclick="exclusief('to','__');"/></td>
      <td><input type="checkbox" $ccChecked name="cc[{$patientInfo['toegewezen_id']}]" id="cc__" value="{$patientInfo['toegewezen_genre']}" onclick="exclusief('cc','__');"></td>
      <td>{$organisator['naam']}</td>
      <td>$organisatorGenre</td>
    </tr>
ORG;
  }


// voorlopig alleen voor hulpverleners
$qry = "select distinct hvl.id, hvl.voornaam, hvl.naam, functies.naam as fnaam from huidige_betrokkenen br inner join hulpverleners hvl
            on hvl.id = br.persoon_id and br.genre = 'hulp'
           and ((overleggenre = 'gewoon' and rechten = 1) or (overleggenre = 'menos'))
           and validatiestatus = 'gevalideerd'
           and patient_code = \"{$_SESSION['pat_code']}\"
           inner join functies on hvl.fnct_id = functies.id";
$hvls = mysql_query($qry) or die("Kan de hulpverleners met rechten niet ophalen ($qry): " . mysql_error());

for ($i=0; $i< mysql_num_rows($hvls); $i++) {
  $hvl = mysql_fetch_assoc($hvls);
  if ($reply) {
    $zoekterm = "hulp_{$hvl['id']}";
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
  echo <<< HVL
    <tr>
      <td><input type="checkbox" $toChecked name="aan[{$hvl['id']}]" id="to$i" value="hulp" onclick="exclusief('to',$i);"/></td>
      <td><input type="checkbox" $ccChecked name="cc[{$hvl['id']}]" id="cc$i" value="hulp" onclick="exclusief('cc',$i);"></td>
      <td>{$hvl['voornaam']} {$hvl['naam']}</td>
      <td>{$hvl['fnaam']}</td>
    </tr>
HVL;
}
?>

</table>
<p style="font-size:9px;"><em>Aan</em>: bericht in de Listel-brievenbus m&eacute;t verwijzing per email. <br/>
<em>CC</em>:  bericht in de Listel-brievenbus zonder email (enkel 'ter info')
</p>

</div>

<div id="bericht_bijlagen" style="width:270px;">
<p>Bijlagen</p>
<table id="table_bijlagen">
<tr>
<td id="td_bestand1">
<a onclick="document.getElementById('td_bestand1').innerHTML='';"><img src="../images/wis.gif" alt="wis"/></a>
<input type="file" name="bestand1" id="bestand1" onchange="bestandToevoegen(1);"/>
</td>
</tr>
</table>
</div>

<div id="bericht_inhoud">
<p>Boodschap</p>

<textarea tabindex="2" name="boodschap"
  onclick="if (this.value=='Typ hier uw bericht') this.value='';"
><?= $boodschap ?></textarea>
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