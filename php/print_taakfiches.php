<?php

session_start();



function zoekNaam($menscode) {

    switch ($menscode['mens_type']) {

        case "oc":

           $qry2 = "select naam, voornaam from logins

                    where id = {$menscode['mens_id']}";

           $functie = "Overlegcoordinator ";

           break;

        case "hvl":

           $qry2 = "select h.naam, voornaam, f.naam as func_naam from hulpverleners h, functies f

                    where h.id = {$menscode['mens_id']} and f.id = h.fnct_id";

           break;

        case "mz":

           $qry2 = "select naam, voornaam from mantelzorgers

                    where id = {$menscode['mens_id']}";

           $functie = "Mantelzorger ";

           break;

        case "pat":

           $qry2 = "select naam, voornaam from patient

                    where id = {$menscode['mens_id']}";

           $functie = "Patient ";

           break;

    }

    $mens = mysql_fetch_array(mysql_query($qry2));

    //print($qry2);

    if (!isset($functie)) $functie = $mens['func_naam'];

    return "<strong>$functie</strong> " . $mens['naam'] . " " . $mens['voornaam'];

}



$paginanaam="Taakfiches";

if (IsSet($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan"))  {



  if (!isset($_GET['refID'])) {

     die("<h1>Ik heb geen idee welke taakfiches ik moet afdrukken.</h1>");

  }



    //----------------------------------------------------------

    /* Maak Dbconnectie */ include('../includes/dbconnect2.inc');

    //----------------------------------------------------------



  if (isset($_GET['nr'])) {

    $extra = " LIMIT {$_GET['nr']},1";

  }



if (isset($_GET['mens_id'])) {

  $menscode['mens_id'] = $_GET['mens_id'];

  $menscode['mens_type'] = $_GET['mens_type'];

  $mens = zoekNaam($menscode);

  $aantalMensen = 1;

}

else {

  $qry = "SELECT DISTINCT mens_id, mens_type

          FROM taakfiche_mensen, taakfiche

          WHERE ref_id = '{$_GET['refID']}'

          AND taakfiche_id = id

          $extra ";

  $menskeuze = mysql_query($qry);

  if (mysql_num_rows($menskeuze) > 0) {

    $menscode = mysql_fetch_array($menskeuze);

    $mens = zoekNaam($menscode);

  }

  $aantalMensen = mysql_num_rows($menskeuze);

}

  if (isset($_GET['nr'])) {

    $volgend = $_GET['nr']+1;

    if ($volgend < $_GET['totaal'])

      $verder = "window.location = 'print_taakfiches.php?refID={$_GET['refID']}&nr=$volgend&totaal={$_GET['totaal']}';" ;

    else

      $verder = "";

  }

  else if ($aantalMensen > 1) {

    $verder = "window.location = 'print_taakfiches.php?refID={$_GET['refID']}&nr=1&totaal=" .

                 mysql_num_rows($menskeuze) . "';"  ;

  }

  else {

    $verder = "";

  }



  if (substr($_GET['refID'], 0, 7) == "overleg") {

    $ref = " het overleg";

    $overlegID =   substr($_GET['refID'], 7);

    require("../includes/patientViaOverleg_geg.php");

    $datumQuery = "select datum from overleg where id = $overlegID"  ;

  }

  else {

    $ref = " de evaluatie";

    $evalID =   substr($_GET['refID'], 9);

    require("../includes/patientViaEvaluatie_geg.php");

    $datumQuery = "select datum from evaluatie where id = $evalID"  ;

  }



  $datumRij = mysql_fetch_array(mysql_query($datumQuery));

  $datum = $datumRij[0];



    include("../includes/html_html.inc");

    print("<head>");

    include("../includes/html_head.inc");

    ?>

    <style type="text/css">

      .rand{border-bottom:1px solid black;border-right:1px solid black;}

      .randtable{border-top:1px solid black;border-left:1px solid black;}

    </style>

    </head>

    <body onLoad="parent.print();//<?= $verder ?>">

    <div align="center">

    <div class="pagina">



      <div style="text-align:center">

   <img src="../images/logo_top_pagina_klein.gif" width="100" style="float:left;">



<?php

if (!isset($mens))

  print("<h2>Er zijn nog geen taakfiches ingevuld ");

else

  print("<h2>$mens <br />");




print("Zorg- en taakafspraken, dd. " . substr($datum,6,2) . "/" . substr($datum,4,2) . "/" . substr($datum,0,4) . "</h2>");

?>

    <h2><?php echo  strtoupper($_SESSION['pat_naam']) . ' ' . $_SESSION['pat_voornaam'] . ' (' . $_SESSION['pat_code'] . ')';?></h2></div></td></tr></table></div></td></tr>

  </div>

<p>
De taakfiches zijn een werkdocument dat valt onder het beroepsgeheim. Het kan niet doorgegeven worden aan anderen
zonder de uitdrukkelijke toestemming van de overlegco&ouml;rdinator thuisgezondheidszorg.
</p>




    <table bgcolor="#FFFFFF" cellpadding="5" border="1" style="clear: both">





      <tr>

       <th>

       Domein

       </th>

       <th>

       Frequentie

       </th>

       <th>

       Zorg- en taakafspraken

       </th>

       <th>

       Betrokkene(n)

       </th>

      </tr>



<?php

if (isset($mens)) {

   $takenQry = "select * from taakfiche, taakfiche_mensen

                where id = taakfiche_id

                and ref_id = '{$_GET['refID']}'

                and mens_id = {$menscode['mens_id']}

                and mens_type = '{$menscode['mens_type']}'";

   $taken = mysql_query($takenQry);

   

   for ($i = 0; $i < mysql_num_rows($taken); $i++) {

     $taak = mysql_fetch_array($taken);

     print("<tr><td>{$taak['categorie']}</td>

                <td>{$taak['frequentie']}</td>

                <td>" . nl2br($taak['taak']) . "</td><td>");

     $deelnemersQry = "select * from taakfiche_mensen

                       where taakfiche_id = {$taak['id']}

                       and not (mens_id = {$menscode['mens_id']}

                            and mens_type = '{$menscode['mens_type']}')";

     $deelnemersResult = mysql_query($deelnemersQry);

     for ($j=0; $j < mysql_num_rows($deelnemersResult); $j++) {

       $deelnemer = mysql_fetch_array($deelnemersResult);

       $deelnemerNaam = zoekNaam($deelnemer);

       print("$deelnemerNaam &nbsp;<br />");

     }

     print("</td></tr>\n");

   }



}

?>

</table>



</table>

</div></div></body></html>

<?php

    }



//---------------------------------------------------------

/* Geen Toegang */ include("../includes/check_access.inc");

//---------------------------------------------------------

?>