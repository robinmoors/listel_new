<?php
session_start();

   require("../includes/clearSessie.inc");
   require("../includes/dbconnect2.inc");
   $paginanaam="Af te ronden overleggen";
   if (IsSet($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan")&&($_SESSION['profiel']=="listel"))
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
     if ($_GET['overleg']=="") {
       print("Ik weet niet van welk overleg ik de factuur moet schrappen.<br/>In principe mag dit niet voorkomen als je flink bent.");
     }
     else if (mysql_query("update overleg set factuur_datum = NULL, factuur_code = NULL, controle = 0 where id = {$_GET['overleg']}")) {
       print("De factuur voor dit overleg is gereset. Je kan dit nu opnieuw controleren, en na controle wordt dit opnieuw opgenomen in de volgende factuur.");
     }
     else {
       print("Er ging iets geks mis met overleg {$_GET['overleg']}, nl. " . mysql_error());
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
      }

//---------------------------------------------------------
/* Geen Toegang */ require("../includes/check_access.inc");
//---------------------------------------------------------

//---------------------------------------------------------
/* Sluit Dbconnectie */ require("../includes/dbclose.inc");
//---------------------------------------------------------
?>