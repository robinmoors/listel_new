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
    $query = "select {$_GET['tabel']}.*, gemeente.dlzip, gemeente.dlnaam from {$_GET['tabel']}, gemeente
                                          where {$_GET['tabel']}.id = {$_GET['id']}
                                            and gem_id = gemeente.id";
  }
  else if ($_GET['tabel']=="hulpverleners") {
    $query = "select hulpverleners.*, gemeente.dlzip, gemeente.dlnaam,
                     concat(functies.naam, ' <br/>') as discipline,
                     org.naam as orgnaam
              from (hulpverleners left join gemeente on hulpverleners.gem_id = gemeente.id, functies)
                   left join organisatie org on org.id = organisatie
             where hulpverleners.actief = 1 and functies.id = fnct_id and {$_GET['tabel']}.id = {$_GET['id']}";
  }

  //print($query);

  
  $result = mysql_query($query);
  $aantal = mysql_num_rows($result);
  
  if ($aantal != 1) print("<p style=\"color:red\">Er zijn verschillende personen gevonden (nl. $aantal). Zoek opnieuw :-(</p>");
  else {
    for ($i=0;$i<$aantal;$i++) {
      $rij = mysql_fetch_assoc($result);
      if ($rij['adres']=="") {
         $rij['adres']=$rij['orgnaam'];
         $rij['dlzip']=$rij['dlnaam']="";
      }
      print("<p style=\"font-weight:bold\">{$rij['naam']} {$rij['voornaam']} <br/>
                                           {$rij['discipline']}
                                           {$rij['adres']}<br/>
                                           {$rij['dlzip']} {$rij['dlnaam']}<br/>
                                           {$rij['tel']}<br/> {$rij['email']} </p>");
    }
  }
  //---------------------------------------------------------
  /* Sluit Dbconnectie */ require("../includes/dbclose.inc");
  //---------------------------------------------------------
}

?>
