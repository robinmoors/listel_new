<?php

session_start();

   require("../includes/dbconnect2.inc");
   require("../includes/clearSessie.inc");

   $paginanaam="Nieuw project gemaakt?";

   if (IsSet($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan") && ($_SESSION['profiel']=='listel'))

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

    $qry = "insert into tp_project (nummer, naam) VALUES (\"{$_POST['nummer']}\",\"{$_POST['naam']}\")";

    if (mysql_query($qry)) {

       $id = mysql_insert_id();

       echo <<< EINDE

      <h1>Therapeutisch project {$_POST['nummer']} : {$_POST['naam']} is aangemaakt.</h1>

      <p>Maak nu een <a href="edit_overlegcoord.php?tp=hoofd&tp_project=$id">hoofdprojectco&ouml;rdinator</a> die dit project verder dient aan te vullen.</p>

EINDE;

    }

    else {

       echo <<< EINDE

       <h1 style="color: red">Dit therapeutisch project is niet aangemaakt!</h1>

       <p>Waarschijnlijk bestaat dit nummer al en dat mag niet.<br />

       Dit is het geval wanneer hieronder staat <em>"Duplicate entry 'xxx' for key 2"</em></p>

       <p>Of probeer anders volgende foutmelding te ontcijferen...</p>

EINDE;

       print("<p style='color:#888'>" . mysql_error() . "</p>");



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