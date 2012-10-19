<?php

session_start();



function gelijkenis($nr1, $nr2) {

  global $pat;

  $pat1 = $pat[$nr1];

  $pat2 = $pat[$nr2];

  if ($pat1['nabij'] < $pat2['nabij'])

    return 1;

  elseif ($pat1['nabij'] > $pat2['nabij'])

    return -1;

  else

    return 0;

}



   require("../includes/dbconnect2.inc");

   if (isset($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan"))

      {

$mededelingZelfde = " is op dezelfde dag geboren ";
$magTochNieuwZeggen = true;
$erIsEenBestaande = false;

if ($_SESSION['profiel']=="hoofdproject") {

  $qry = "select patient.*, project, dlnaam from gemeente, patient left join patient_tp on (patient.code = patient_tp.patient and patient_tp.actief = 1)

          where patient.gem_id = gemeente.id

          AND sex = {$_GET['geslacht']}

          AND gebdatum = {$_GET['datum']}";

  $werkwoord = "includeren";

}
else if (isset($_GET['rr'])) {

  $qry = "select patient.*, project, dlnaam from gemeente, patient left join patient_tp on (patient.code = patient_tp.patient and patient_tp.actief = 1)

          where patient.gem_id = gemeente.id

          AND rijksregister = {$_GET['rr']}";
  $werkwoord = "aanmaken of overnemen";
  $mededelingZelfde = " heeft hetzelfde rijksregisternummer ";
  $magTochNieuwZeggen = false;
}

else {

  $qry = "select patient.*, project, dlnaam from gemeente, patient left join patient_tp on (patient.code = patient_tp.patient and patient_tp.actief = 1)

          where patient.gem_id = gemeente.id

          AND sex = {$_GET['geslacht']}

          AND gebdatum = {$_GET['datum']}";

  $werkwoord = "aanmaken of overnemen";

}



$pats = mysql_query($qry);





if (mysql_num_rows($pats)==0) die("");



for ($i=0; $i<mysql_num_rows($pats); $i++) {


  $pat[$i] = mysql_fetch_assoc($pats);

  similar_text($pat[$i]['voornaam'],$_GET['voornaam'], $voor);

  similar_text($pat[$i]['naam'],$_GET['naam'], $achter);

  $pat[$i]['nabij'] = round(($voor + $achter)/2,2);
  


}



uksort($pat, "gelijkenis");

if (isset($_GET['naam']) && $_GET['naam']!="") {
  $infoNaam = "(<strong><?= \"{$_GET['naam']} {$_GET['voornaam']}\" ?></strong>)";
}
else {
  $infoNaam = "";
}
?>



<p>Deze "nieuwe" pati&euml;nt <?= $infoNaam ?>  <?= $mededelingZelfde ?> als

volgende bestaande of inactieve pati&euml;nten:

</p>



<p>Klik op een van de pati&euml;nten als je deze wil <?= $werkwoord ?>

<?php
if ($magTochNieuwZeggen) print(" , of bevestig onderaan dat dit een &eacute;cht nieuwe patient is.</p>\n");
?>


<ol>

<?php

$psyPatienten = false;

foreach ($pat as $patient) {

  $magOvernemen = true;
  // als psy, dan mag niemand iets doen
  if ($_SESSION['profiel']=="menos") {
    if ($patient['menos']==1) {
      $status = " (al actief bij menos)";
      $heractiveren = "&vanMenos=1&activeer=1";
    }
    else {
      $status = " (al aangemaakt bij SEL)";
      $heractiveren = "&eigenlijkNieuw=1";
    }
  }
  else if ($patient['actief']==0) {
    if ($patient['menos']==1) {
      $heractiveren = "&vanMenos=1";
      $status = " (actief bij menos)";
    }
    else {
      $heractiveren = "&activeer=1";
      $status = " (over te nemen uit archief)";
    }
    if (!$erIsEenBestaande) $magTochNieuwZeggen = true;
  }
  else {
    $erIsEenBestaande = true;
    $magTochNieuwZeggen = false;
    $status = "";
    $heractiveren = "";
  }
  if ($patient['nabij']==0) {
   $nabijheid = "";
  }
  else {
   $nabijheid = " {$patient['nabij']}% gelijkenis ";
  }
  if ($_SESSION['profiel']=="hoofdproject") {
    print("<li><strong><a href=\"patient_aanpassen.php?patient={$patient['code']}&eigenlijkNieuw=1\">{$patient['naam']} {$patient['voornaam']}</a></strong> uit {$patient['dlnaam']}<strong></strong>: $nabijheid $status</li>");
  }
  else if ($_SESSION['profiel']=="menos") {
    print("<li><strong><a href=\"patient_aanpassen.php?patient={$patient['code']}$heractiveren\">{$patient['naam']} {$patient['voornaam']}</a></strong> uit {$patient['dlnaam']}<strong></strong>: $nabijheid $status</li>");
  }
  else if ($patient['actief']!= -1) { // patient zit niet in TP
    if (($patient['toegewezen_genre']=="gemeente" && $_SESSION['profiel'] == "OC")
        || ($patient['toegewezen_genre']=="rdc"   && $_SESSION['profiel'] == "rdc"   && $patient['toegewezen_id']==$_SESSION['organisatie'])
        || ($patient['toegewezen_genre']=="hulp"  && $_SESSION['profiel'] == "hulp"  && $patient['toegewezen_id']==$_SESSION['usersid'])
       ) {
      if ($magOvernemen) {
         print("<li><strong><a href=\"patient_aanpassen.php?patient={$patient['code']}$heractiveren\">{$patient['naam']} {$patient['voornaam']}</a></strong> uit {$patient['dlnaam']}: $nabijheid $status</li>");
      }
      else {
         print("<li><strong>{$patient['naam']} {$patient['voornaam']}</strong> uit {$patient['dlnaam']}: $nabijheid $status</li>");
      }
    }
    else {
      if ($magOvernemen) {
        $status = "(over te nemen)";
        print("<li><strong><a href=\"patient_aanpassen.php?overnemen=1&patient={$patient['code']}$heractiveren\">{$patient['naam']} {$patient['voornaam']}</a></strong> uit {$patient['dlnaam']}: $nabijheid $status</li>");
      }
      else {
         print("<li><strong>{$patient['naam']} {$patient['voornaam']}</strong> uit {$patient['dlnaam']}: $nabijheid $status</li>");
      }
    }
  }
  else if ($patient['actief'] == -1) {  // overname van TP door psy
     $status = " (overname vanuit TP) ";
     print("<li><strong><a href=\"patient_aanpassen.php?overnemen=psy&patient={$patient['code']}\">{$patient['naam']} {$patient['voornaam']}</a></strong> uit {$patient['dlnaam']}: $nabijheid $status</li>");
  }
/*
  else {

    $contactQry = "select naam, voornaam, email from logins where profiel = 'hoofdproject' AND tp_project = {$patient['project']} and actief = 1";

    $contactResult = mysql_query($contactQry);

    //print($contactQry);

    $contactP = mysql_fetch_assoc($contactResult);

    $contact = "Neem contact op met {$contactP['naam']} {$contactP['voornaam']} ({$contactP['email']}) voor meer info.";

    print("<li><strong><a href=\"#\" onclick=\"alert('Deze patient is opgenomen in een therapeutisch project.\\nJe kan hem/haar niet opnemen in het GDT.\\n\\n$contact');return false;\">{$patient['naam']} {$patient['voornaam']}</a></strong> uit {$patient['dlnaam']}<strong></strong>: $nabijheid  $status</li>");

  }
*/
}

?>

</ol>

<?php
if ($psyPatienten) {
?>
<p>
   Pati&euml;nten met een beschermd statuut mag je niet overnemen.
   Neem contact op met LISTEL vzw als je toch een overleg voor deze pati&euml;nt wil plannen.
</p>
<?php
}

if ($magTochNieuwZeggen) {
?>
<p>Dit is een <a href="#" onclick="ditIsEenNieuwe=true;verstop();return false;">nieuwe pati&euml;nt</a> (of een pati&euml;nt die verhuisd is naar een andere gemeente). Ik ga verder met het invullen van dit formulier.
</p>
<?php
}
?>
<?php

      }



//---------------------------------------------------------

/* Geen Toegang */ require("../includes/check_access.inc");

//---------------------------------------------------------



//---------------------------------------------------------

/* Sluit Dbconnectie */ require("../includes/dbclose.inc");

//---------------------------------------------------------

?>