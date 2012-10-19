<?php

session_start();

   require("../includes/dbconnect2.inc");
   require("../includes/clearSessie.inc");

   $paginanaam="Af te ronden overleggen";

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
         switch ($_SESSION['profiel']) {
            case "OC":
              $uitkomst = getAfTeRondenOverleg("OC", $_SESSION['overleg_gemeente'], $_SESSION['usersid'],"","");
              break;
            case "rdc":
              $uitkomst = getAfTeRondenOverleg("rdc", $_SESSION['organisatie'], $_SESSION['usersid'],"","");
              break;
            case "psy":
              $uitkomst = getAfTeRondenOverleg("psy", $_SESSION['organisatie'], $_SESSION['usersid'],"","");
              break;
            case "hulp":
              $uitkomst = getAfTeRondenOverleg("hulp", $_SESSION['usersid'], $_SESSION['usersid'],"","");
              break;
            case "hoofdproject":
            case "bijkomend project":
              $uitkomst = getAfTeRondenOverleg("TP", $_SESSION['tp_project'], $_SESSION['usersid'],"","");
              break;
            case "menos":
              $uitkomst = getAfTeRondenOverleg("menos", 0, 0,"","");
              break;
         }

         if ($uitkomst == "") {
           print("Alle overleggen zijn afgerond.");
         }
         else {
           print($uitkomst);
         }


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



//---------------------------------------------------------

/* Sluit Dbconnectie */ require("../includes/dbclose.inc");

//---------------------------------------------------------

?>