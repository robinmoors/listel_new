<?php

session_start();




   require("../includes/clearSessie.inc");
   require("../includes/tp_functies.inc.php");

   $paginanaam="Inschrijving nieuwsbrief";


      require("../includes/html_html.inc");

      print("<head>");

      require("../includes/html_head.inc");

      print("</head>");

?>
<script type="text/javascript">
function testVeld(id) {
  if (document.getElementById(id).value == "")
    return "  - je hebt geen " + id + " ingevuld\n";
  else
    return "";
}
function testEmail(id) {
  var inhoud = document.getElementById(id).value;
  if (document.getElementById(id).value == "")
    return "  - je hebt geen " + id + " ingevuld\n";
  else if (inhoud.indexOf('@') >= inhoud.lastIndexOf('.'))
    return "  - dat emailadres is geen echt emailadres\n";
  else
    return "";
}

function testAlles() {
  var diagnose = "";
  diagnose +=  testVeld('voornaam');
  diagnose +=  testVeld('naam');
  diagnose +=  testVeld('discipline');
  diagnose +=  testEmail('email');
  
  if (diagnose == "")  return true;
  
  alert("Gelieve het formulier volledig in te vullen\n" + diagnose);
  return false;
}
</script>

<?php

      print("<body>");

      print("<div align=\"center\">");

      print("<div class=\"pagina\">");

      require("../includes/header.inc");

      require("../includes/kruimelpad.inc");

      print("<div class=\"contents\">");

      require("../includes/menu.inc");

      print("<div class=\"main\">");

      print("<div class=\"mainblock\">");

      if (isset($_POST['inschrijving'])) {
        if ($_POST['inschrijving'] == "in") $inschr = "inschrijving";
        else $inschr = "uitschrijving";
        $titel = "$inschr voor de LISTEL-nieuwsbrief";
        $boodschap = <<< EINDE
<h2>$titel</h2>
<p>Beste {$_POST['voornaam']} {$_POST['naam']},<br/>
je $inschr is ontvangen. Dank hiervoor.</p>
<p>We noteerden volgende bijkomende gegevens:</p>
<ul>
<li>Discipline: {$_POST['discipline']}</li>
<li>Organisatie: {$_POST['organisatie']}</li>
<li>Emailadres: {$_POST['email']}</li>
<li>Bijkomende opmerkingen: <br/> {$_POST['opmerkingen']}</li>
</ul>

<p>
met vriendelijke groeten,
Wendy Coemans</p>
EINDE;
         htmlmailWendy("Wendy.Coemans@listel.be,{$_POST['email']}", $titel, $boodschap);
         //print("$boodschap");
         print("<div style=\"background-color: #8f8\">Je $inschr is genoteerd en wordt bevestigd via email.</div>\n");
      }



// begin mainblock
?>

<h1>Inschrijving nieuwsbrief</h1>

<p>LISTEL vzw stuurt maandelijks een nieuwsbrief met weetjes rond regelgeving, nieuws over opleidingen
en allerlei nuttige tips. Interesse om deze te ontvangen? Schrijf dan nu in op de nieuwsbrief! </p>

<form method="post" onsubmit="return testAlles();">
<table>
<tr>
  <td><label for="voornaam">Voornaam <span style="color:red"><sup> *</sup></span></label></td>
  <td><input type="text" id="voornaam" name="voornaam" style="width:200px;"/>
</td>
<tr>
  <td><label for="naam">Naam <span style="color:red"><sup> *</sup></span></label></td>
  <td><input type="text" id="naam" name="naam" style="width:200px;"/>
</td>
<tr>
  <td><label for="discipline">Discipline <span style="color:red"><sup> *</sup></span></label></td>
  <td><input type="text" id="discipline" name="discipline" style="width:200px;"/>
</td>
<tr>
  <td><label for="organisatie">Organisatie</label></td>
  <td><input type="text" id="organisatie" name="organisatie"  style="width:200px;"/>
</td>
<tr>
  <td><label for="email">Emailadres <span style="color:red"><sup> *</sup></span></label></td>
  <td><input type="text" id="email" name="email" style="width:200px;"/>
</td>
<tr>
  <td><label for="opmerkingen">Opmerkingen</label></td>
  <td>&nbsp;<textarea id="opmerkingen" name="opmerkingen" style="width:200px;height:50px;"></textarea>
</td>
<tr>
  <td><input type="radio" value="in" name="inschrijving" checked="checked" onclick="document.getElementById('knop').value='Schrijf in';"/> Inschrijving</td>
  <td><input type="radio" value="uit" name="inschrijving" onclick="document.getElementById('knop').value='Schrijf uit';"/> Uitschrijving</td>
</td>
<tr>
  <td> </td>
  <td><input type="submit" value="Schrijf in" id="knop"/>
</td>
</tr>

</table>

</form>

<?php
// einde mainblock



      print("</div>");

      print("</div>");

      print("</div>");


      require("../includes/footer.inc");

      print("</div>");

      print("</div>");

      print("</body>");

      print("</html>");








?>