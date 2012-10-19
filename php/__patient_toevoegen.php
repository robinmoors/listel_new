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
$zoek = mysql_query("select * from patient left join huidige_betrokkenen hb
                            on patient.code = hb.patient_code and genre = 'patient'
                           where genre is null ");

print("<ol>");
for ($i=0; $i<mysql_num_rows($zoek); $i++) {
  $patient = mysql_fetch_assoc($zoek);
  $voegtoe = "insert into huidige_betrokkenen (patient_code, genre, overleggenre)
              VALUES (\"{$patient['code']}\",'patient', 'gewoon')";
  mysql_query($voegtoe);
  print("<li>{$patient['code']} is gelukt.</li>\n");
}
print("</ol>");






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