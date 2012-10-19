<?php

//----------------------------------------------------------

/* Maak Dbconnectie */ require('../includes/dbconnect2.inc');

//----------------------------------------------------------



   $paginanaam="Gearchiveerde patient bekijken";

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

        



$bekijk=1;
    $query = "
        SELECT
          p.*,
          l.dlnaam, l.dlzip, l.zip,
          v.naam as verz_naam ,
          v.nr as verz_nr
        FROM
            patient p,
            gemeente l,
            verzekering v
        WHERE
            p.code='".$_GET['code']."'   AND
            p.einddatum = {$_GET['einddatum']} AND
            p.gem_id=l.id AND
            (v.id=p.mut_id OR (p.mut_id = 0 AND v.id = 1))";
    if ($result = mysql_query($query) or die("$query " . mysql_error()))
    {// Een uitvoerbare Query
        if (mysql_num_rows($result)<>0 )
        {
           //---------------------------------------------
           // een correcte record gevonden
           //---------------------------------------------
           $records= mysql_fetch_assoc($result);
           //print_r($records);
         }
         else {
           //---------------------------------------------------------
           /* Sluit Dbconnectie */ require("../includes/dbclose.inc");
           //---------------------------------------------------------
           die("$query geen patient gevonden!");
         }
     }


require("../forms/patientgegevens_aanpassen.php");





//---------------------------------------------------------

/* Sluit Dbconnectie */ require("../includes/dbclose.inc");

//---------------------------------------------------------



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