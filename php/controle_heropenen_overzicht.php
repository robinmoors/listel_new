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



<h1>Heropen de controle van een overleg</h1>



<ul>

<?php



$query = "select * from overleg

          where afgerond = 1

            and controle = 1

            and
            (
              (keuze_vergoeding = 1
                 and factuur_code is NULL
                 and factuur_datum is NULL
                 and datum > '20070101')
              or
              (keuze_vergoeding = 2
                 and organisatie_factuur is NULL
                 and datum > '$beginOrganisatieVergoeding')
            )

          order by overleg.patient_code";

            

$overlegResult = mysql_query($query) or die("fout in $query");

for ($i=0; $i<mysql_num_rows($overlegResult); $i++) {

   $overleg = mysql_fetch_assoc($overlegResult);

   print("<li><a href=\"controle_heropenen_doen.php?id={$overleg['id']}\">{$overleg['patient_code']} - overleg van {$overleg['datum']}</a></li>");

}

// einde mainblock



print("</ul>");



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