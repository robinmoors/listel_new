<?php
//----------------------------------------------------------
/* Maak Dbconnectie */ require('../includes/dbconnect2.inc');
//----------------------------------------------------------
   $paginanaam="Lijst Gemeentes";
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
      


      $query = "
         SELECT
            dlzip
			dlnaam
			id
         FROM
            gemeente
         ORDER BY
            dlzip";

      if ($result=mysql_query($query))
         {
         print ("var functionlist = Array(");
         $teller = 0;
         for ($i=0; $i < mysql_num_rows ($result); $i++)
            {
            $records= mysql_fetch_array($result);
            print ("\"".$records[0]." ".$records[1]."\",\"".$records[2]."\",<br/>");
            }
         print (");");
         }
      else
         {
         print("niets gevonden voor ".$query);
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
/* Check Access */ require("../includes/check_access.inc");
//---------------------------------------------------------
//---------------------------------------------------------
/* Sluit Dbconnectie */ require("../includes/dbclose.inc");
//---------------------------------------------------------
?>
