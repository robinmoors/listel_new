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



if (($_SESSION['profiel']!="listel") || ($_GET['id']<1))

  die("Gij hebt hier niks te zoeken!");



?>





<?php



if (date("m") == 1) {

  $maandGeleden = (date("Y")-1) . "12" . date("d");

}

else if (date("m") < 11) {

  $maandGeleden = date("Y") . "0" . (date("m")-1) . date("d");

}

else {

  $maandGeleden = date("Y") . (date("m")-1) . date("d");

}



$query = "update overleg

          set afgerond = 0

          where id = {$_GET['id']}

            and afgerond = 1

            and controle = 0";

            

mysql_query($query) or die("fout in heropenen: $query");


$queryWis = "delete from afgeronde_betrokkenen where overleg_id = {$_GET['id']}";
mysql_query($queryWis) or die("fout in dubbels wissen: $queryWis");

// einde mainblock

?>

<h1>Overleg nr. <?= $_GET['id'] ?> is heropend!</h1>



<?php

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