<?php

session_start();

if (isset($_POST['pat_code']))

  $_SESSION['pat_code'] = $_POST['pat_code'];

if (isset($_GET['pat_code'])) {

   $_SESSION['pat_code'] = $_GET['pat_code'];

}



$paginanaam="Taakfiches voor {$_GET['referentie']} van {$_SESSION['pat_code']}";





if (!isset($_SESSION['pat_code'])) {

 //---------------------------------------------------------------

/* Open Empty Html */ include('../includes/open_empty_html.inc');

//---------------------------------------------------------------



?>

    Deze pagina is enkel toegankelijk wanneer u een patient geselecteerd hebt.

    U wordt dadelijk terug gestuurd naar de listel-site waar u links uit het menu een keuze kan maken.

    <script type="text/javascript">

     function redirect()

     {

         <?php print("document.location = \"/\";"); ?>

     }

     setTimeout("redirect()",500);



    </script>



<?php

//-----------------------------------------------------------------

/* Close Empty Html */ include('../includes/close_empty_html.inc');

//-----------------------------------------------------------------



}

else if (IsSet($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan"))

    {

    //----------------------------------------------------------

    /* Maak Dbconnectie */ include('../includes/dbconnect2.inc');

    //----------------------------------------------------------

    //----------------------------------------------------------





//    $_SESSION['vanuitPatientOverzicht'] = true;

    include("../includes/html_html.inc");

    print("<head>");

    include("../includes/html_head.inc");

?>

<style>

    h4 {font-style:normal;margin: 10px 0 7px 10px;}

    ul.list { margin-left: 35px;}

    

    .even {

      background-color: #DDD;

    }

	

	.lijntjes {

	  border-collapse:collapse;

	  border: 1px solid black;

	}

	.lijntjes td {

	   padding: 2px;

	   border:1px solid black;

	}

</style>

<?

    print("</head>");

    print("<body>");

/*

    print("<div align=\"center\">");

    print("<div class=\"pagina\">");

    include("../includes/header.inc");

    include("../includes/kruimelpad.inc");

    print("<div class=\"contents\">");

    include("../includes/menu.inc");

    print("<div class=\"main\">");

    print("<div class=\"mainblock\">");

*/





//include("../includes/toonSessie.inc");









function zoekNaam($menscode) {

    switch ($menscode['mens_type']) {

        case "oc":

           $qry2 = "select naam, voornaam from logins

                    where id = {$menscode['mens_id']}";

           break;

        case "hvl":

           $qry2 = "select naam, voornaam from hulpverleners

                    where id = {$menscode['mens_id']}";

           break;

        case "mz":

           $qry2 = "select naam, voornaam from mantelzorgers

                    where id = {$menscode['mens_id']}";

           break;

        case "pat":

           $qry2 = "select naam, voornaam from patient

                    where id = {$menscode['mens_id']}";

           break;

    }

    $mens = mysql_fetch_array(mysql_query($qry2));

    return $mens['naam'] . " " . $mens['voornaam'];

}



function toonHeader($referentie) {

    $patientHeader =  "<b>".$_SESSION['pat_naam']." ".$_SESSION['pat_voornaam']." (".$_SESSION['pat_code'].")</b>";

echo <<< EINDE

    <h2>Taakfiches bij $referentie van $patientHeader</h2>

    <table bgcolor="#FFFFFF" cellpadding="5" class="taakfiche" style="clear: both">

      <tr>

       <th>

       Domein

       </th>

       <th>

       Frequentie van de zorg

       </th>

       <th>

       Taakafspraak

       </th>

       <th>

       Betrokkenen

       </th>

      </tr>

EINDE;

}



function toonTaakfiche($refID, $referentie) {

 //$readOnly = 1;

 //require("../includes/taakfiches.php");

 

 $takenQry = "select * from taakfiche

                where ref_id = '$refID'

                order by categorie ";



 $taken = mysql_query($takenQry);

 if (mysql_num_rows($taken) == 0) {

   print("<ul><li><b>Geen</b> taakfiches ingevuld.</li></ul>");

 }

 else {

   toonHeader($referentie);

   for ($i = 0; $i < mysql_num_rows($taken); $i++) {

     $taak = mysql_fetch_array($taken);

     if ($i%2 == 0) $class = " class=\"even\" ";

     else $class = "";

     print("<tr $class><td>{$taak['categorie']}</td>

                <td>{$taak['frequentie']}</td>

                <td>" . nl2br($taak['taak']) . "</td><td>");

     $deelnemersQry = "select * from taakfiche_mensen

                       where taakfiche_id = {$taak['id']}";

     $deelnemersResult = mysql_query($deelnemersQry);

     for ($j=0; $j < mysql_num_rows($deelnemersResult); $j++) {

       $deelnemer = mysql_fetch_array($deelnemersResult);

       $deelnemerNaam = zoekNaam($deelnemer);

       print("$deelnemerNaam &nbsp;<br />");

     }

     print("</td></tr>\n");

   }

   print("</table></li>");

  }

}
?>
<p>
De taakfiches zijn een werkdocument dat valt onder het beroepsgeheim. Het kan niet doorgegeven worden aan anderen
zonder de uitdrukkelijke toestemming van de overlegco&ouml;rdinator thuisgezondheidszorg.
</p>

<?php
   toonTaakfiche($_GET['refID'], $_GET['referentie']); //"overleg" . $overlegInfo['id']);





    //---------------------------------------------------------

    /* Sluit Dbconnectie */ include("../includes/dbclose.inc");

    //---------------------------------------------------------

/*

    print("</div>");

    print("</div>");

    print("</div>");

    include("../includes/footer.inc");

    print("</div>");

    print("</div>");

*/

    print("</body>");

    print("</html>");

    }

//---------------------------------------------------------

/* Geen Toegang */ include("../includes/check_access.inc");

//---------------------------------------------------------





?>