<?php
session_start();   // $_SESSION['pat_code']

$paginanaam="NVT: personen zoeken met ajax";
// krijgt GET id --> van katz
// en get overlegID van overleg

if (false && !(isset($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan"))) {
  print("KO;Geen toegang");
}
else if (!(isset($_GET['tabel']))) {
  print("KO;Geen gegevens");
}
else {


  //----------------------------------------------------------
  /* Maak Dbconnectie */ require('../includes/dbconnect2.inc');
  //----------------------------------------------------------
  if ($_GET['tabel']=="mantelzorgers" || $_GET['tabel']=="patient") {
    $query = "select {$_GET['tabel']}.*, concat('uit ', gemeente.dlzip) as dlzip, gemeente.dlnaam from {$_GET['tabel']}, gemeente where UCASE({$_GET['tabel']}.naam) like ucase('%{$_GET['naam']}%')
                                            and UCASE(voornaam) like ucase('%{$_GET['voornaam']}%')
                                            and gem_id = gemeente.id";
  }
  else if ($_GET['tabel']=="hulpverleners") {
    $query = "select hulpverleners.*, concat(' : ',organisatie.naam) as dlzip
                    from hulpverleners, organisatie
                    where
                           hulpverleners.actief = 1
                           and hulpverleners.organisatie = organisatie.id
                           and UCASE(hulpverleners.naam) like ucase('%{$_GET['naam']}%')
                           and UCASE(voornaam) like ucase('%{$_GET['voornaam']}%')";
  }

  //print($query);

  
  $result = mysql_query($query);
  $aantal = mysql_num_rows($result);
  
  if ($aantal == 0) {
    print("<p style=\"color:red\">Niemand gevonden met deze zoekterm</p>");
    if ($_SESSION['profiel']!="caw") {
      if ($tabel == "patient")
        print("<p>Geef eventueel <a target=\"_blank\" href=\"patient_nieuw.php\">een nieuwe pati&euml;nt</a> in.</p>");
      else if ($tabel == "hulpverleners")
        print("<p>Geef eventueel <a target=\"_blank\" href=\"edit_verlener.php\">een nieuwe hulpverlener</a> (ZVL, HVL, XVL) in.</p>");
      else if ($tabel == "mantelzorgers")
        print("<p>Mantelzorgers kan je alleen aanmaken via het overleg bij een pati&euml;nt. Doe dat eventueel daar.</p>");
    }
  }
  else if ($aantal > 10) print("<p>$aantal personen gevonden. Verfijn je zoekterm</p>");
  else if ($aantal == 1) {
    $rij = mysql_fetch_assoc($result);
    print("-----{$rij['id']}");
  }
  else {
    print("<select id=\"zoeker\" size=\"$aantal\" onchange=\"selecteerPersoon('{$_GET['tabel']}','{$_GET['id']}',this.value);\">");
    for ($i=0;$i<$aantal;$i++) {
      $rij = mysql_fetch_assoc($result);
      print("<option value=\"{$rij['id']}\">{$rij['naam']} {$rij['voornaam']} {$rij['dlzip']} {$rij['dlnaam']} </option>");
    }
    print("</select>");

  }
  //---------------------------------------------------------
  /* Sluit Dbconnectie */ require("../includes/dbclose.inc");
  //---------------------------------------------------------
}

?>
