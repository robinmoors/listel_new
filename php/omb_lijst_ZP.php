<?php

session_start();

   require("../includes/dbconnect2.inc");
   require("../includes/clearSessie.inc");

   $paginanaam="Overzicht ZP met OMB-registraties";

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

?>

<h3>Zoek zorgenplannen met OMB-registratie</h3>



<p>Geef een jaar op waarin je wil zoeken naar zorgenplannen met registraties OMB.</p>



<form method="post">

            <select size="1" name="jaar">

<?php

  for ($i = 2008; $i <= date("Y"); $i++)

    print("                <option value=\"$i\">$i</option>\n");

?>

            </select>

<input type="submit" value="toon zorgenplannen" />

</form>





<?php



if (isset($_POST['jaar'])) {



print("<h3>Overzicht zorgenplannen met OMB-registraties in {$_POST['jaar']}</h3>\n<table>\n");




  preset($_SESSION['usersid']);
  if ($_SESSION['profiel']!="listel") $extravoorwaarde = " and auteur = {$_SESSION['usersid']} ";

  $qry = "select patient_code, naam, voornaam, dag, maand, jaar, omb.id as ombid from overleg, omb_registratie omb, patient

                 where overleg.omb_id = omb.id

                       $extravoorwaarde

                   and omb.jaar = {$_POST['jaar']}

                   and overleg.patient_code = patient.code

                   order by jaar, maand, dag";

  $result = mysql_query($qry) or die("kan patienten niet ophalen $qry");

  

  for ($i=0; $i<mysql_num_rows($result); $i++) {

     $rij = mysql_fetch_assoc($result);

     print("<tr><td><a href=\"patientoverzicht.php?pat_code={$rij['patient_code']}\">{$rij['patient_code']}</a> {$rij['naam']} {$rij['voornaam']}</td><td>Registratie <a href=\"omb_registratie.php?zoekid={$rij['ombid']}\">{$rij['dag']}/{$rij['maand']}/{$rij['jaar']}</a></td></tr>");

  }

  print("</table>");

}



?>



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