<?php
  /********** crisisplan
   Je kan dit crisisplan ook readOnly-modus lezen.
   In dit geval moet de variabele $readOnly waarde 1 hebben.
   
   Moeten een waarde hebben: $overlegID, $overlegInfo['id'], $overlegInfo['afgerond'], $overlegInfo['contact_hvl'], $_SESSION['pat_code']
  */

  if ($overlegID > -1) {
    $qryCrisis ="select * from psy_crisis where overleg_id = $overlegID order by id desc";
    $crisisResult = mysql_query($qryCrisis) or die("kan het crisisplan van dit overleg niet ophalen");
    if (mysql_num_rows($crisisResult)>0) {
      $crisis = mysql_fetch_assoc($crisisResult);
    }
  }
  if ($readOnly == 1) {
?>
<style type="text/css">
  #formCrisisPlan textarea {
    border: 0px;
    background-color: inherit;
  }
</style>
<?php
  }

?>

<form name="formCrisisPlan" id="formCrisisPlan">
<?php
  if (!isset($readOnly) || $readOnly == 0) {
?>

<p>Duid aan wie gecontacteerd moet worden in het geval van een crisissituatie.
De referentiepersoon staat standaard aangeduid, maar je mag ook een andere hulpverlener kiezen.</p>

<?php
  $qryHVL = getQueryHVLHuidig($_SESSION['pat_code']);
  $qryMantel = getQueryMZHuidig($_SESSION['pat_code']);

  $gekozen = false;
  $resultHVL = mysql_query($qryHVL) or die("fout met het ophalen van de mensen voor een de crisissituatie $qryHVL " .mysql_error());
  $txt = "";
  for ($i=0; $i < mysql_num_rows($resultHVL); $i++) {
    $mens = mysql_fetch_assoc($resultHVL);
    if ($mens['id']==$crisis['crisis_id'] && $crisis['crisis_genre']=="hulp") {
      $selected = " selected=\"selected\" ";
      $gekozen = true;
    }
    else {
      $selected = "";
    }
    $txt .= "<option value='hulp|{$mens['id']}' $selected>{$mens['naam']}</option>";
  }
  $offset = $i;
  $resultMantel = mysql_query($qryMantel) or die("fout met het ophalen van de mensen voor een crisissituatie $qryMantel " .mysql_error());
  for ($i=0; $i < mysql_num_rows($resultMantel); $i++) {
    $mens = mysql_fetch_assoc($resultMantel);
    if ($mens['id']==$crisis['crisis_id'] && ($crisis['crisis_genre']=="mantel")) {
      $selected = " selected=\"selected\" ";
      $gekozen = true;
    }
    else {
      $selected = "";
    }
    $txt .= "<option value='mantel|{$mens['id']}' $selected>{$mens['naam']}</option>";
  }
  if (!$gekozen || $crisis['crisis_genre']=="referentie") {
    $txt = "<option value='referentie|{$patient['contact_hvl']}' selected=\"selected\">Referentiepersoon</option>" . $txt;
  }
  else {
    $txt = "<option value='referentie|{$patient['contact_hvl']}'>Referentiepersoon</option>" . $txt;
  }
?>
  <select name="crisispersoon"><?= $txt ?></select>
<p style="text-align:left;">
Hieronder kan je de bereikbaarheid van het zorgteam invullen.
De gegevens zoals telefoon en email moet je aanvullen bij de zorg- of hulpverlener of bij de mantelzorger.
<br/>
De referentiepersoon hieronder verwijst naar de referentiepersoon toen je dit overleg opende. Als je ondertussen de referentiepersoon
in het tab "Teamoverleg" gewijzigd hebt, moet je het overleg terug openen om de juiste referentiepersoon in dit crisisplan te zien staan.
</p>

<?php
}
else {
  // readOnly: alleen contactgevens laten zien
  if ($crisis['crisis_genre']=="referentie") {
    $crisis['crisis_genre'] = "hulp";
    $crisis['crisis_id'] = $overlegInfo['contact_hvl'];
  }
  if ($crisis['crisis_genre'] == "hulp") {
    $qryCrisisContact="select * from hulpverleners where id = {$crisis['crisis_id']}";
  }
  else {
    $qryCrisisContact="select * from mantelzorgers where id = {$crisis['crisis_id']}";
  }
  if ($crisisContactResult = mysql_query($qryCrisisContact)) {
    $crisisContact = mysql_fetch_assoc($crisisContactResult);
    if ($crisis['crisis_genre'] == "hulp") {
      $crisisContact = vervolledigGegevensHVL($crisisContact);
    }
    if ($crisisContact['gsm']!="") {
      $gsmTekst="<tr><td>GSM</td><td>{$crisisContact['gsm']}</td></tr>";
    }
    if ($crisisContact['tel']!="") {
      $telTekst="<tr><td>Telefoon</td><td>{$crisisContact['tel']}</td></tr>";
    }

    $txt .= <<< EINDE
<div style="background-color:yellow; id="crisisContactGegevens">
<h1>Contacteer deze persoon in het geval van een crisissituatie.</h1>
<table>
  <tr><td colspan="2"><strong>{$crisisContact['functie']}</strong></td></tr>
  <tr><td>Naam</td><td>{$crisisContact['naam']} {$crisisContact['voornaam']}</td></tr>
  <tr><td>Adres</td><td>$orgOok{$crisisContact['adres']}<br/>{$crisisContact['dlzip']} {$crisisContact['dlnaam']}</td></tr>
  $telTekst
  $gsmTekst
  <tr><td>Email</td><td>{$crisisContact['email']}</td></tr>
  <tr><td>Bereikbaarheid</td><td><textarea style="width:300px;height:30px;">{$crisisContact['bereikbaarheid']}</textarea></td></tr>
</table>
</div>
EINDE;
  print($txt);
  }
  else {
    print("<p><em>Er is nog niet aangeduid wie gecontacteerd moet worden in geval van crisis.</em></p>");
  }
}
?>



<p style="text-decoration: underline;">
Gegevens van belang indien crisissituatie
</p>
<textarea id="crisissituatie" name="crisissituatie" style="width:500px;"><?= $crisis['crisissituatie']?></textarea> <br/>&nbsp;<br/>
<?php

if ($crisis['crisissituatie']=="") {
  print("<script type=\"text/javascript\">var crisisSituatieIngevuld = false;</script>\n");
}
else {
  print("<script type=\"text/javascript\">var crisisSituatieIngevuld = true;</script>\n");
}


if ($overlegID > 0) {
    $allesIngevuld = true;
    $alleBereikbaarheden = true;

    if ($overlegInfo['afgerond']==0) {
      print(toonCrisisPlan(getQueryHVLHuidig($_SESSION['pat_code'],-1),$overlegInfo['contact_hvl'],true));
      print(toonCrisisPlan(getQueryMZHuidig($_SESSION['pat_code'],-1),0,false));
    }
    else {
      print(toonCrisisPlan(getQueryHVLAfgerond($overlegID,-1),$overlegInfo['contact_hvl'],true));
      print(toonCrisisPlan(getQueryMZAfgerond($overlegID,-1),0,false));
    }

    if (!$allesIngevuld) {
      print("<div style=\"background-color: yellow;\">Er ontbreken nog emailadressen en telefoonnummers!</div>\n");
      print("<script type=\"text/javascript\">var crisisPlanVolledig = false;</script>\n");
    }
    else {
      print("<script type=\"text/javascript\">var crisisPlanVolledig = true;</script>\n");
    }
    if (!($alleBereikbaarheden)) {
      print("<div style=\"background-color: yellow;\" id=\"ontbrekendeBereikbaarheden\">Er ontbreken nog bereikbaarheden!</div>\n");
      print("<script type=\"text/javascript\">var alleBereikbaarheden = false;</script>\n");
    }
    else {
      print("<div style=\"background-color: yellow;display:none;\" id=\"ontbrekendeBereikbaarheden\">Er ontbreken nog bereikbaarheden!</div>\n");
      print("<script type=\"text/javascript\">var alleBereikbaarheden = true;</script>\n");
    }
}

  if (!isset($readOnly) || $readOnly == 0) {

?>
<div style="text-align:right">
Dit crisisplan <input type="submit" id="crisisOpslaan" value="opslaan" onclick="crisisplanOpslaan(<?= $overlegInfo['id'] ?>,<?= $overlegInfo['afgerond'] ?>);return false;"/>
</div>

<?php
   }
?>
</form>
