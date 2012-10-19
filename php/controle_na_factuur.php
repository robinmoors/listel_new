<?php

session_start();

   require("../includes/dbconnect2.inc");
   require("../includes/clearSessie.inc");

   $paginanaam="Af te ronden overleggen";

   if (IsSet($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan") && ($_SESSION['profiel']=="listel"))

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



if ($_SESSION['profiel']!="listel")

  die("Gij hebt hier niks te zoeken!");



?>



<h1>Pas de gegevens aan van een overleg dat al gefactureerd is en dat na een creditnota opnieuw gefactureerd moet worden.</h1>



<p>

Geef volgende gegevens in:

<form method="get" action="controle.php">

Patient-code <input type="text" name="code" /><br/>

Overlegnummer <input type="text" name="overleg" /> <br/>

<input type="hidden" name="forceer" value="1"    /><br/>

<input type="submit" value="Op naar de controle!" />

</form>

</p>



<p>

<em>Het overlegnummer vind je terug via volgende stappen:

<ol>

<li>Kies <a href="select_zplan.php?a_next_php=patientoverzicht.php">Inhoud zorgplan</a>.</li>

<li>Eventueel: open het gewenste overleg door op de datum te klikken.</li>

<li>Ga met de muis op de 'print'-link staan, en kijk naar de statusbalk linksonderaan.</li>

<li>Het nummer dat achter "id=" staat, is het overlegnummer.</li>

</ol>

</em>

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