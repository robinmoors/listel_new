<?php

session_start();




   require("../includes/dbconnect2.inc");

   $paginanaam="Bericht versturen";

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
?>

<h2>Bericht opslaan ivm <?= $_SESSION['pat_code'] ?></h2>
<?php


if ($_SESSION['profiel']=="hulp") {
  $auteur_genre = "hulp";
  $auteur_id = $_SESSION['usersid'];
}
else if ($_SESSION['profiel']=="rdc") {
  $auteur_genre = "rdc";
  $auteur_id = $_SESSION['organisatie'];
}
else if ($_SESSION['profiel']=="menos") {
  $auteur_genre = "menos";
  $auteur_id = -666;
}
else {
  $auteur_genre = "gemeente";
  $auteur_id = $_SESSION['usersid'];
}

$onderwerp = addslashes($_POST['onderwerp']);
$boodschap = addslashes($_POST['boodschap']);


$berichtQry = "insert into berichten (patient, onderwerp, boodschap, auteur_genre, auteur_id)
               values (\"{$_SESSION['pat_code']}\",\"$onderwerp\",\"$boodschap\",\"$auteur_genre\",$auteur_id)";

mysql_query($berichtQry) or die("Problemen met het opslaan van het bericht: " . mysql_error());

$berichtID = mysql_insert_id();

if (isset($_FILES)) {
  foreach ($_FILES as $veld => $waarde) {
    if ($_FILES[$veld]['name'] != "") {
      //print("<li>{$_FILES[$veld]['tmp_name']} -- {$_FILES[$veld]['name']}</li>");
    move_uploaded_file($_FILES[$veld]['tmp_name'],$_SERVER['DOCUMENT_ROOT'] . '/_berichten_bijlagen/' . $berichtID . '_' . $_FILES[$veld]['name']);
//      move_uploaded_file($_FILES[$veld]['tmp_name'],$_SERVER['DOCUMENT_ROOT'] . '/listel/berichten_bijlagen/' . $berichtID . '_' . $_FILES[$veld]['name']);

      // insert query
      $bijlageQry = "insert into berichten_bijlage (bericht, bestand)
               values ($berichtID, \"{$_FILES[$veld]['name']}\")";

      mysql_query($bijlageQry) or die("Problemen met het opslaan van de bijlage ($bijlageQry): " . mysql_error());
    }
  }
}

print("<div style=\"background-color:#8f8\">Het bericht is succesvol opgeslagen.</div>");

// to-personen
if (isset($_POST['aan'])) {
  print("<h3>Volgende personen zijn verwittigd van uw bericht.</h3><ul>");
  foreach ($_POST['aan'] as $id => $genre) {
     if ($genre == "gemeente") {
       $genre = "sit";
       $zoekEmailQry = "select voornaam, naam, email from logins where overleg_gemeente=$id and not (email = '') and email is not null and actief = 1";
     }
     else if ($genre == "rdc") {
       $zoekEmailQry = "select voornaam, naam, email from logins where organisatie = $id and not (email = '') and email is not null and actief = 1   ";
     }
     else if ($genre == "hulp") {
       $zoekEmailQry = "select voornaam, naam, email from hulpverleners where id = $id and not (email = '') and email is not null and actief = 1 ";
     }
     else if ($genre == "menos") {
       $zoekEmailQry = "select voornaam, naam, email from logins where profiel = 'menos' and not (email = '') and email is not null and actief = 1   ";
     }
     $toQry = "insert into berichten_to (bericht, persoon, genre, status)
              values ($berichtID, $id, \"$genre\", \"to\")";

     mysql_query($toQry) or die("Problemen met het opslaan van de bestemmeling ($toQry): " . mysql_error());

     $emailResult = mysql_query($zoekEmailQry) or die($zoekEmailQry . " lukt niet.");
     for ($i=0; $i<mysql_num_rows($emailResult); $i++) {
       $email = mysql_fetch_assoc($emailResult);
       $msg = "Beste {$email['voornaam']} {$email['naam']},<br/><br/>in het zorgplan van {$_SESSION['pat_code']} is er een bericht aan u gericht.";
       $msg.= " Om dit te lezen, dient u in te loggen op <a href=\"https://www.listel.be/nl/zorgplan-login\">https://www.listel.be</a>.<br/><br/>Met vriendelijke groeten,<br/>het Listel e-zorgplan.";
       htmlmailZonderCopy($email['email'],"Bericht van een Listelzorgenplan", $msg);
       print("<li>{$email['voornaam']} {$email['naam']} op {$email['email']}</li>\n");
     }
  }
  print("</ul>");
}

// cc-personen
if (isset($_POST['cc'])) {
  foreach ($_POST['cc'] as $id => $genre) {
     if ($genre == "gemeente") $genre = "sit";

     $toQry = "insert into berichten_to (bericht, persoon, genre, status)
              values ($berichtID, $id, \"$genre\", \"cc\")";

     mysql_query($toQry) or die("Problemen met het opslaan van de bestemmeling ($toQry): " . mysql_error());
  }
}
// einde mainblock
?>
<p>
Wil je nog een bericht maken voor <a href="bericht_maken.php">deze pati&euml;nt</a> of
<a href="select_zplan.php?a_next_php=bericht_maken.php">voor een andere pati&euml;nt</a>?<br/>
Of wil je al je <a href="berichten.php">berichten lezen</a>?
</p>

<?php


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