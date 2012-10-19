<?php

ob_start();
session_start();

   require("../includes/clearSessie.inc");
   require("../includes/dbconnect2.inc");
   if (IsSet($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan") && ($_SESSION['profiel']=="listel"))
      {

if ($_POST['beginjaar']<100) $_POST['beginjaar']="20".$_POST['beginjaar'];
if ($_POST['eindjaar']<100) $_POST['eindjaar']="20".$_POST['eindjaar'];
if ($_POST['sep']==",")
  $sep = ",";
else
  $sep = ";";

$bestandsnaam = "Statistieken_aanvraag_overleg";


$begindatum = "{$_POST['beginjaar']}{$_POST['beginmaand']}{$_POST['begindag']}";
$einddatum = "{$_POST['eindjaar']}{$_POST['eindmaand']}{$_POST['einddag']}";
$begindatum_ = "{$_POST['beginjaar']}-{$_POST['beginmaand']}-{$_POST['begindag']}";
$einddatum_ = "{$_POST['eindjaar']}-{$_POST['eindmaand']}-{$_POST['einddag']}";

if ($begindatum == "") {
  $begindatum = "18999999";
  $begindatum = "1899-99-99";
}
if ($einddatum == "") {
  $einddatum = "20999999";
  $einddatum = "2099-99-99";
}

$beginstamp = mktime(0,0,0,$_POST['beginmaand'],$_POST['begindag'],$_POST['beginjaar']);
$eindstamp = mktime(0,0,0,$_POST['eindmaand'],$_POST['einddag'],$_POST['eindjaar']);




$csvOutput = "Overzicht aanvragen overleg van {$_POST['begindag']}/{$_POST['beginmaand']}/{$_POST['beginjaar']} tot {$_POST['einddag']}/{$_POST['eindmaand']}/{$_POST['eindjaar']}\n\n";

$qry = "select *
        from aanvraag_overleg
        where timestamp <= $eindstamp and timestamp >= $beginstamp
        ";


  $csvOutput .= "\n\n\n";
  $csvOutput .= "{$sep}\n";
  $csvOutput .= "datum aanvraag{$sep}datum bekeken{$sep}te laat{$sep}patient{$sep}code{$sep}gemeente{$sep}indiener{$sep}functie{$sep}organisatie van indiener{$sep}";
  $csvOutput .= "keuze organisatie{$sep}OC{$sep}effectieve organisatie{$sep}OC{$sep}datum MVO{$sep}tussentijd{$sep}dringend{$sep}informeren{$sep}organiseren{$sep}beslissen{$sep}overtuigen{$sep}debriefen{$sep}andere{$sep}doorgeven aanvraag{$sep}reden{$sep}weigering{$sep}reden{$sep}\n";
  
$result = mysql_query($qry) or die($qry . mysql_error());

for ($i=0; $i<mysql_num_rows($result);$i++) {
  $record = mysql_fetch_assoc($result);
  $tussentijdNodig = true;

  //datum ontvangst{$sep}
  $aanvraagDatum = date("d/m/Y", $record['timestamp']);
  $csvOutput .= "{$aanvraagDatum} {$sep}";

  if ($record['ontvangst']=="" && ($record['overleg_id']>0)) {
    $csvOutput .= "NVT {$sep}";
    $tussentijdNodig = false;
  }
  else {
    $csvOutput .= "{$record['ontvangst']} {$sep}";
  }

  $tijdsverschil = mktime(0,0,0, intval(substr($record['ontvangst'], 3,2)), intval(substr($record['ontvangst'], 0,2)), intval(substr($record['ontvangst'], 6,4)))
                      - $record['timestamp'];
  $tijdsverschil = ($tijdsverschil/60)/60/24;
  if ($tijdsverschil > 5) {
    $csvOutput .= "X{$sep}";
  }
  else {
    $csvOutput .= " {$sep}";
  }
  //patient{$sep}
  if ($record['patient_code']!="") {
    $pat = getUniqueRecord("select naam, voornaam from patient where code = '{$record['patient_code']}'");
    $csvOutput .= "{$pat['naam']} {$pat['voornaam']}{$sep}{$record['patient_code']}{$sep}";
  }
  else {
    $csvOutput .= "{$record['rijksregister']} RR{$sep} {$sep}";
  }

  //gemeente{$sep}
  if ($record['gemeente_id']>0) {
    $gemeente = getFirstRecord("select dlzip, dlnaam from gemeente where id = {$record['gemeente_id']}");
    $csvOutput .= "{$gemeente['dlzip']} {$gemeente['dlnaam']}{$sep}";
  }
  else if ($record['patient_code']!="") {
    $gemeente = getUniqueRecord("select dlzip, dlnaam from gemeente g inner join patient on gem_id = g.id and patient.code = '{$record['patient_code']}'");
    $csvOutput .= "{$gemeente['dlzip']} {$gemeente['dlnaam']}{$sep}";
  }
  else {
    $csvOutput .= "Onbekend{$sep}";
  }

  //indiener{$sep}
    $csvOutput .= "{$record['naam_aanvrager']} {$sep}{$record['discipline_aanvrager']}{$sep}";
  //organisatie{$sep}
    $csvOutput .= "{$record['organisatie_aanvrager']} {$sep}";
  //ontvanger{$sep}
  if ($record['keuze_organisator']=="ocmw") {
    $csvOutput .= "OCMW{$sep}";
    if ($record['id_organisator_user']==0) {
      $org = getFirstRecord("select concat('OCMW woonplaats (',logins.naam, ' ', voornaam, ')') as naam from logins inner join gemeente on {$record['gemeente_id']} = gemeente.id and zip= overleg_gemeente");
    }
    else {
      $org = getFirstRecord("select concat(logins.naam, ' ', voornaam) as naam from logins where id = {$record['id_organisator_user']}");
    }
    $csvOutput .= "{$org['naam']} {$sep}";
  }
  else if ($record['keuze_organisator']=="rdc") {
    $org = getFirstRecord("select naam from organisatie where id = {$record['id_organisator']}");
    $csvOutput .= "{$record['keuze_organisator']} {$org['naam']} {$gemeente['dlnaam']}{$sep}";
    if ($record['id_organisator_user']==0) {
      $org = getFirstRecord("select concat(logins.naam, ' ', voornaam) as naam from logins where organisatie = {$record['id_organisator']} and logins.naam not like '%help%'");
    }
    else {
      $org = getFirstRecord("select concat(logins.naam, ' ', voornaam) as naam from logins where id = {$record['id_organisator_user']}");
    }
    $csvOutput .= "{$org['naam']} {$sep}";
  }
  else if ($record['keuze_organisator']=="hulp") {
    $org = getFirstRecord("select naam from organisatie where id = {$record['id_organisator']}");
    $csvOutput .= "{$record['keuze_organisator']} {$org['naam']} {$gemeente['dlnaam']}{$sep}";
    if ($record['id_organisator_user']==0) {
      $org = getFirstRecord("select concat(naam, ' ', voornaam) as naam from hulpverleners where organisatie = {$record['id_organisator']}");
    }
    else {
      $org = getFirstRecord("select concat(naam, ' ', voornaam) as naam from hulpverleners where id = {$record['id_organisator_user']}");
    }
    $csvOutput .= "{$org['naam']} {$sep}";
  }
  else {
    $csvOutput .= "Onbekend{$sep} $sep";
  }

  //organisator{$sep}
  $qry2 = "select * from aanvraag_overleg where bron = {$record['id']}";
  $resultOrganisator = mysql_query($qry2);
  if (mysql_num_rows($resultOrganisator)==0) {
    $csvOutput .= "<-- {$sep}{$sep}";
  }
  else {
    $echteOrg = mysql_fetch_assoc($resultOrganisator);
    if ($echteOrg['keuze_organisator']=="ocmw") {
      $csvOutput .= "OCMW{$sep}";
      $org = getFirstRecord("select concat(naam, ' ', voornaam) as naam from logins where id = {$record['id_organisator']}");
      $csvOutput .= "{$org['naam']} {$sep}";
    }
    else if ($echteOrg['keuze_organisator']=="rdc") {
      $org = getFirstRecord("select naam from organisatie where id = {$echteOrg['id_organisator']}");
      $csvOutput .= "{$org['keuze_organisator']} {$org['naam']} {$gemeente['dlnaam']}{$sep}";
      $org = getFirstRecord("select concat(naam, ' ', voornaam) as naam from logins where organisatie = {$record['id_organisator']}");
      $csvOutput .= "{$org['naam']} {$sep}";
    }
    else if ($record['keuze_organisator']=="hulp") {
      $org = getFirstRecord("select naam from organisatie where id = {$echteOrg['id_organisator']}");
      $csvOutput .= "{$org['keuze_organisator']} {$org['naam']} {$gemeente['dlnaam']}{$sep}";
      $org = getFirstRecord("select concat(naam, ' ', voornaam) as naam from hulpverleners where organisatie = {$record['id_organisator']}");
      $csvOutput .= "{$org['naam']} {$sep}";
    }
    else {
      $csvOutput .= "Onbekend{$sep}";
    }
  }


  //datum MVO{$sep}
  //tussentijd{$sep}
  if ($record['overleg_id']>0) {
    $overleg = getFirstRecord("select datum from overleg where id = {$record['overleg_id']}");
    $mooieDatum = substr($overleg['datum'], 6,2) . "/" . substr($overleg['datum'], 4,2) . "/" . substr($overleg['datum'], 0,4);
    $tijdsverschil = mktime(0,0,0, intval(substr($overleg['datum'], 4,2)), intval(substr($overleg['datum'], 6,2)), intval(substr($overleg['datum'], 0,4)))-
                     mktime(0,0,0, intval(substr($record['ontvangst'], 3,2)), intval(substr($record['ontvangst'], 0,2)), intval(substr($record['ontvangst'], 6,4)));
    $tijdsverschil = ($tijdsverschil/60)/60/24;
    if ($tussentijdNodig)
      $csvOutput .= "{$mooieDatum}{$sep}$tijdsverschil dagen{$sep}";
    else
      $csvOutput .= "{$mooieDatum}{$sep}NVT{$sep}";
  }
  else {
    $csvOutput .= "Geen overleg{$sep} {$sep}";
  }

  // dringend
  if ($record['dringend']==1) {
    $csvOutput .= "X{$sep}";
  }
  else {
    $csvOutput .= " {$sep}";
  }

  //informeren{$sep}
  if ($record['doel_informeren']==1) {
    $csvOutput .= "X{$sep}";
  }
  else {
    $csvOutput .= " {$sep}";
  }
  //organiseren{$sep}
  if ($record['doel_organiseren']==1) {
    $csvOutput .= "X{$sep}";
  }
  else {
    $csvOutput .= " {$sep}";
  }
  //beslissen{$sep}
  if ($record['doel_beslissen']==1) {
    $csvOutput .= "X{$sep}";
  }
  else {
    $csvOutput .= " {$sep}";
  }
  //overtuigen{$sep}
  if ($record['doel_overtuigen']==1) {
    $csvOutput .= "X{$sep}";
  }
  else {
    $csvOutput .= " {$sep}";
  }
  //debriefen{$sep}
  if ($record['doel_debriefen']==1) {
    $csvOutput .= "X{$sep}";
  }
  else {
    $csvOutput .= " {$sep}";
  }

  $csvOutput .= "{$record['doel_andere']}{$sep}";


  //doorgeven aanvraag{$sep}
  //reden{$sep}";
  if ($record['status']=="doorgestuurd") {
    $csvOutput .= "X{$sep}{$record['reden_status']} {$sep}";
  }
  else {
    $csvOutput .= " {$sep} {$sep}";
  }
  //weigering{$sep}
  //reden{$sep}
  if ($record['status']=="weiger") {
    $csvOutput .= "X{$sep}{$record['reden_status']} {$sep}";
  }
  else {
    $csvOutput .= " {$sep} {$sep}";
  }

  $csvOutput .= "\n";
}





header("Content-Type: text/csv");
header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
header("Content-Transfer-Encoding: binary");
header("Content-Disposition: attachment; filename=\"{$bestandsnaam}.csv\"");
header("Content-length: " . strlen($csvOutput));
print($csvOutput);

      }



//---------------------------------------------------------

/* Geen Toegang */ require("../includes/check_access.inc");

//---------------------------------------------------------

?>