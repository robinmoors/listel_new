<?php

session_start();

   require("../includes/dbconnect2.inc");
   require("../includes/clearSessie.inc");

   $paginanaam="Buitenlandse gemeente toevoegen";

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

      <h1>Buitenlandse gemeente toevoegen</h1>

      

      <p>Onze databank bevat weliswaar alle Belgische gemeentes, maar niet de buitenlandse.<br />

      Wanneer je toch een hulp- of zorgverlener of een mantelzorger wil

      toevoegen, kan je hier eerst die gemeente toevoegen en daarna gebruiken.</p>

      <p>In de lijst met postcodes zal een buitenlandse gemeente steeds met -1 beginnen,

      gevolgd door de postcode en de naam zoals je ze hieronder invult.</p>

      

      <form name="f" method="post" onsubmit="if (document.f.gemeente.value.length == 0) {alert('geen gemeente ingevuld');return false;};">

         <label for="gemeente">Gemeente :</label>

         <input type="text" name="gemeente" id="gemeente" maxlen="50" />

         <br />

         <input type="submit" value="sla buitenlandse gemeente op" />

      

      </form>





<?php

  if (isset($_POST['gemeente']) &&   $_POST['gemeente']!="") {

    $query = "insert into gemeente (zip, naam, dlzip, dlnaam) values

              (-1, \"{$_POST['gemeente']}\", -1, \"{$_POST['gemeente']}\")";

    if (mysql_query($query)) {

      print("<h2 style=\"color:green\">Gemeente {$_POST['gemeente']} succesvol toegevoegd.</h2>");

    }

    else {

      print("<h2 style=\"color:red\">Gemeente {$_POST['gemeente']} NIET toegevoegd.</h2>");

      print($query . "<br /> " . mysql_error());

    }

  }

// einde mainblock



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