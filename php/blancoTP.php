<?php
ob_start();
session_start();




   require("../includes/dbconnect2.inc");
   require("../includes/clearSessie.inc");

   $paginanaam="TP: ";

   if (isset($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan")

          && ($_SESSION['profiel'] == "hoofdproject" || $_SESSION['profiel'] == "bijkomend project"))

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

    $tp_basisgegevens = tp_record($_SESSION['tp_project']);



// begin mainblock

?>

   <h1>Gegevens <?= tp_roepnaam($tp_basisgegevens) ?></h1>

<form method="post">

<table class="form">

<tr>

  <td class="label">Nummer: </td>

  <td class="input"><input type="text" name="nummer" /></td>

</tr>



<tr>

  <td class="label">Gegevens: </td>

  <td class="input"><input type="submit" value="opslaan" /></td>

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