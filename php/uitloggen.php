<?php

session_start();

$paginanaam="Uitloggen";

if (isset($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan"))

//----------------------------------------------------------

/* Maak Dbconnectie */ include('../includes/dbgegevens2.inc.php');

//----------------------------------------------------------

    {

    include("../includes/html_html.inc");

    print("<head>");

    include("../includes/html_head.inc");

    print("</head>");

    print("<body>");

    print("<div align=\"center\">");

    print("<div class=\"pagina\">");

    include("../includes/header.inc");

    include("../includes/pat_id.inc");

    print("<div class=\"contents\">");

    include("../includes/menu.inc");

    print("<div class=\"main\">");

    print("<div class=\"mainblock\">");

    

/* ---------------------------------

//

//     pagina content hier 

//

// -------------------------------*/    

/* OLD

foreach ($_SESSION as $var => $inhoud) {

    unset($_SESSION[$var]);

}

*/



$_SESSION = array();

session_destroy();

unset($_COOKIE[session_name()]);



?>



<h1>U bent nu uitgelogd.</h1>



<p>Binnen luttele tijd wordt u omgeleid naar

<?php print("<a href=\"$siteadres\">www.listel.be</a>.</p>"); ?>



<p>Dank u voor het gebruik van onze site.</p>



<script type="text/javascript">

     function redirect()

     {

         <?php print("document.location = \"$siteadres\";"); ?>

     }

     setTimeout("redirect()",3000);



</script>



<?php



//---------------------------------------------------------

/* Sluit Dbconnectie */ include("../includes/dbclose.inc");

//---------------------------------------------------------



    print("</div>");

    print("</div>");

    print("</div>");

    include("../includes/footer.inc");

    print("</div>");

    print("</div>");

    print("</body>");

    print("</html>");

    }



?>