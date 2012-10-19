<?php

session_start();




   require("../includes/dbconnect2.inc");
   require("../includes/clearSessie.inc");

   $paginanaam="Maak een nieuw project";

   if (IsSet($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan") && ($_SESSION['profiel']=='listel'))

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



<h1>Maak een nieuw therapeutisch project aan</h1>



<p>Geef hiervoor de naam en het nummer van het therapeutisch project in.

<br />

Daarna kan je een hoofdproject-co&ouml;rdinator aanmaken die dan alle verdere

gegevens van het therapeutisch project dient in te vullen.</p>



<form method="post" action="tp_nieuw_verwerk.php">



<table class="form">

<tr>

  <td class="label">Nummer: </td>

  <td class="input"><input type="text" name="nummer" /></td>

</tr>

<tr>

  <td class="label">Naam: </td>

  <td class="input"><input type="text" name="naam" /></td>

</tr>

<tr>

  <td class="label">&nbsp; </td>

  <td class="input"><input type="submit" value="maak aan" /></td>

</tr>



</table>

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