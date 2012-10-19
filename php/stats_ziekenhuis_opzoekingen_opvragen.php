<?php

session_start();

   require("../includes/dbconnect2.inc");
   require("../includes/clearSessie.inc");

   $paginanaam="Statistieken opvragen voor opvragingen zorgplan door ziekenhuizen";

   if (IsSet($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan") && $_SESSION['profiel']=="listel")

      {

      require("../includes/html_html.inc");

      print("<head>");

      require("../includes/html_head.inc");
?>

<style type="text/css">
 .mainblock { height: auto;}
</style>

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

?>





<h1>Welke rijkregisters zijn opgevraagd door welke ziekenhuizen?</h1>


<p>Vul begin- en einddatum in: </p>

<form method="post" action="stats_ziekenhuis_opzoekingen.php">

<table>

<tr>

<td>

Begindatum (dd/mm/jjjj)

</td>

<td>

<input type="text" name="begindag" size="3" style="width: 30px;" value="01"/> /

<input type="text" name="beginmaand" size="3"  style="width: 30px;" value="01"/> /

<input type="text" name="beginjaar" size="3"  style="width: 60px;" value="2004"/>

</td>

</tr>

<tr>

<td>

Einddatum (dd/mm/jjjj)

</td>

<td>

<input type="text" name="einddag" size="3"  style="width: 30px;" value="31"/> /

<input type="text" name="eindmaand" size="3"  style="width: 30px;" value="12"/> /

<input type="text" name="eindjaar" size="3"  style="width: 60px;" value="2033"/>

</td>

</tr>

<tr>

<td colspan="2">

<input type="submit" value=".csv-bestand opvragen" />

</td>

</tr>

<tr>

<td colspan="2">

<input type="checkbox" name="sep"  value="," /> Selecteer wanneer Excel geen kolommen maakt.

</td>

</td>

</tr>

</table>

</form>




<?php



      print("</div>");

      print("</div>");

      print("</div>");

      require("../includes/footer.inc");

      print("</div>");

      print("</div>");

      print("</body>");

      print("</html>");

      }



//---------------------------------------------------------

/* Geen Toegang */ require("../includes/check_access.inc");

//---------------------------------------------------------

?>