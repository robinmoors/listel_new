<?php

session_start();




   require("../includes/dbconnect2.inc");
   require("../includes/clearSessie.inc");

   $paginanaam="Paswoord resetten";


      require("../includes/html_html.inc");

      print("<head>");

      require("../includes/html_head.inc");
?>
<script type="text/javascript">
function testPWD() {
     if (document.getElementById('pwd1').value != document.getElementById('pwd2').value) {
       alert("De paswoorden zijn niet gelijk!");
       return false;
     }
     else if (document.getElementById('pwd1').value < 5) {
       alert("Het paswoord is niet lang genoeg!");
       return false;
     }
     return true;
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

// begin mainblock
function toonBasisFormulier() {
  echo <<< EINDE1
    <h1>Paswoordherstel</h1>
    <p>Om een nieuw paswoord te bekomen, vul hieronder deze gegevens in, en volg de instructies.</p>
    <form method="post">
<table>
  <tr><td><label for="naam">Achternaam</label></td><td><input type="text" name="naam" id="naam"/></td></tr>
  <tr><td><label for="email">Email</label></td><td><input type="text" name="email" id="email"/></td></tr>
  <tr><td>  </td><td><input type="submit" value="Verstuur"/></td></tr>
</table>
    </form>
EINDE1;
}

function maakPwdRecovery() {
  global $persoon;

        $passlength = 32;
        $pass = "";
        $i = 0;
        while($i <= $passlength)
        {
          $pass .= chr(rand(65,90));
          $i++;
        }

   if (mysql_query("update {$persoon['genre']} set pwd_recovery = \"$pass\" where id = {$persoon['id']}")) {
     $msg = <<< EINDE2
     <h1>Paswoordherstel</h1>
     <p>Beste {$persoon['voornaam']} {$persoon['naam']},<br/>
     <a href="https://www.listel.be/php/paswoord_recovery.php?pwd_recovery=$pass&genre={$persoon['genre']}">Klik op deze link</a> om een nieuw paswoord te bekomen.</p>
     <p>Indien je deze mail niet aangevraagd hebt, probeert er iemand jouw paswoord te resetten. Dat is niet direct een reden tot paniek
     (tenzij die persoon jouw emails kan lezen), maar je mag dit wel aan ons melden.</p>
     <p><br/>Anick Noben<br/>LISTEL vzw.</p>
EINDE2;
     htmlmail($persoon['email'],"Listel paswoordherstel",$msg);
     echo <<< EINDE3
     <h1>Mail is onderweg</h1>
     <p>Beste {$persoon['voornaam']} {$persoon['naam']},<br/>
     We hebben zonet een mail gestuurd naar {$persoon['email']} met verdere instructies voor het bekomen van een nieuw paswoord.</p>
EINDE3;
     //print($msg);
   }
   else {
     print_r($persoon);
     print("<hr/>update {$persoon['genre']} set pwd_recovery = \"$pass\" where id = {$persoon['id']}<hr/>");
     print(mysql_error());

   }
}
function toonGeheimeVraag($pwd_recovery,$genre,$vraag,$id,$naam) {
  echo <<< EINDE1
    <h1>Paswoordherstel voor $naam</h1>
    <p>Om een nieuw paswoord te bekomen, vul hieronder het antwoord op de geheime vraag in, en volg de instructies.</p>
    <form method="post">
      <label for="geheime_vraag"><strong>$vraag</strong></label><br/>
      <input type="text" name="geheime_vraag" id="geheime_vraag"/><br/>
      <input type="hidden" name="pwd_recovery" value="$pwd_recovery"/>
      <input type="hidden" name="vraag" value="$vraag"/>
      <input type="hidden" name="genre" value="$genre"/>
      <input type="hidden" name="id" value="$id"/>
      <input type="hidden" name="naam" value="$naam"/>
      <input type="submit" value="Verstuur"/>
    </form>
EINDE1;
}
function toonPWDFormulier($pwd_recovery,$genre,$vraag,$id,$naam, $login) {
  echo <<< EINDE1
    <h1>Paswoordherstel voor $naam</h1>
    <p>Vul nu een nieuw paswoord in (2x hetzelfde) voor je login (<strong>$login</strong>). </p>
    <form method="post"  onsubmit="return testPWD();">
      <input type="hidden" name="genre" value="$genre"/>
      <input type="hidden" name="id" value="$id"/>
<table>
  <tr><td><label for="pwd1">Paswoord (1e keer)</label></td><td><input type="password" name="pwd1" id="pwd1"/></td></tr>
  <tr><td><label for="pwd2">Paswoord (2e keer)</label></td><td><input type="password" name="pwd2" id="pwd2"/></td></tr>
  <tr><td>  </td><td><input type="submit" value="Verstuur"/></td></tr>
</table>
    </form>
EINDE1;
}


if (strlen($_POST['pwd1'])>5) {
   // paswoord veranderen en pwd_recovery leeg maken
   $paswoord = SHA1($_POST['pwd1']);

   mysql_query("UPDATE {$_POST['genre']} SET paswoord='$paswoord',pwd_recovery = NULL WHERE id={$_POST['id']}") or die ("Foutje!" . mysql_error());
   print("<p>Ziezo. Het paswoord is succesvol veranderd. Je kan nu (terug) <a href=\"../cmsmadesimple/index.php?page=Inloggen\">inloggen</a>.</p>");
}
else if (strlen($_POST['pwd_recovery'])>5) {
  // kijken of geheime vraag juist is
  $qry1 = "select * from {$_POST['genre']}
        where pwd_recovery = \"{$_POST['pwd_recovery']}\"
          and UCASE(geheim_antwoord) = UCASE(\"{$_POST['geheime_vraag']}\")
          and id = \"{$_POST['id']}\" ";
  $result = mysql_query($qry1) or die("probleem met $qry1, nl." . mysql_error());
  if (mysql_num_rows($result)>0) {
    // formulier met paswoord tonen (en pwd_recovery als hidden)
    $persoon = mysql_fetch_assoc($result);
    toonPWDFormulier($_POST['pwd_recovery'],$_POST['genre'],$_POST['vraag'],$_POST['id'],"{$_POST['naam']}","{$persoon['login']}");
  }
  else {
    print("<div style=\"background-color: #f88\">Dit was een fout antwoord op de geheime vraag.</div>");
    toonGeheimeVraag($_POST['pwd_recovery'],$_POST['genre'],$_POST['vraag'],$_POST['id'],"{$_POST['naam']}");
  }
}
else if (strlen($_GET['pwd_recovery'])>5) {
  // kijken of pwd_recovery juist
  $qry1 = "select * from {$_GET['genre']}
        where pwd_recovery = \"{$_GET['pwd_recovery']}\"";
  $result = mysql_query($qry1) or die("probleem met $qry1, nl." . mysql_error());
  if (mysql_num_rows($result)>0) {
    $persoon = mysql_fetch_assoc($result);
    toonGeheimeVraag($_GET['pwd_recovery'],$_GET['genre'],$persoon['geheime_vraag'],$persoon['id'],"{$persoon['voornaam']} {$persoon['naam']}");
  }
  else {
    print("<div style=\"background-color: #f88\">Dit is geen geldige link om je paswoord te resetten. Vul (terug) het formulier in.</div>");
    toonBasisFormulier();
  }
}
else if (isset($_POST['email'])) {
  // kijken of deze gegevens bestaan
  $gevonden = false;
  $qry1 = "select *, 'hulpverleners' as genre from hulpverleners
        where naam = \"{$_POST['naam']}\" and email = \"{$_POST['email']}\" and login > \"\" and actief = 1";
  $result = mysql_query($qry1) or die("probleem met $qry1, nl." . mysql_error());
  if (mysql_num_rows($result)>0) {
    // we pakken het éérste record.
    $gevonden = true;
    $persoon = mysql_fetch_assoc($result);
  }
  else {
    $qry1 = "select *, 'patient' as genre from patient
          where naam = \"{$_POST['naam']}\" and email = \"{$_POST['email']}\" and char_length(login)>2 and not(actief = 0)";
    $result = mysql_query($qry1) or die("probleem met $qry1, nl." . mysql_error());
    if (mysql_num_rows($result)>0) {
      // we pakken het éérste record.
      $gevonden = true;
      $persoon = mysql_fetch_assoc($result);
    }
    else {
      $qry1 = "select *, 'logins' as genre from logins
            where naam = \"{$_POST['naam']}\" and email = \"{$_POST['email']}\" and char_length(login)>2 and not(actief = 0)";
      $result = mysql_query($qry1) or die("probleem met $qry1, nl." . mysql_error());
      if (mysql_num_rows($result)>0) {
        // we pakken het éérste record.
        $gevonden = true;
        $persoon = mysql_fetch_assoc($result);
      }
      else {
        $qry1 = "select *, 'mantelzorgers' as genre from mantelzorgers
              where naam = \"{$_POST['naam']}\" and email = \"{$_POST['email']}\" and char_length(login)>2 and not(actief = 0)";
        $result = mysql_query($qry1) or die("probleem met $qry1, nl." . mysql_error());
        if (mysql_num_rows($result)>0) {
          // we pakken het éérste record.
          $gevonden = true;
          $persoon = mysql_fetch_assoc($result);
        }
      }
    }
  }
  
  if ($gevonden) {
    maakPwdRecovery();
  }
  else {
    print("<div style=\"background-color: #f88\">We vonden geen gebruiker met deze gegevens.</div>");
    toonBasisFormulier();
  }
}
else {
    toonBasisFormulier();
}



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





//---------------------------------------------------------

/* Sluit Dbconnectie */ require("../includes/dbclose.inc");

//---------------------------------------------------------

?>