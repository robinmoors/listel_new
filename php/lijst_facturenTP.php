<?php

    //----------------------------------------------------------

    /* Maak Dbconnectie */ include('../includes/dbconnect2.inc');

	//----------------------------------------------------------

	

include("../includes/clearSessie.inc");



$paginanaam="Lijst Facturen TP";









if (isset($_SESSION["toegang"]) && ($_SESSION["toegang"]=="toegestaan") && ($_SESSION["profiel"]=="listel") ){

    

    $_SESSION['pat_code']="";

    $_SESSION['pat_naam']="";

    $_SESSION['pat_voornaam']="";



    include("../includes/html_html.inc");



    print("<head>");



    include("../includes/html_head.inc");



    print("</head>");

    print("<body>");

    print("<div align=\"center\">");

    print("<div class=\"pagina\">");



    include("../includes/header.inc");

    include("../includes/kruimelpad.inc");



    print("<div class=\"contents\">");



    include("../includes/menu.inc");



    print("<div class=\"main\">");

    print("<div class=\"mainblock\">");



    print (" <h1>Therapeutische facturen</h1>	");



?>



<h3>Nieuwe factuur</h3>

<?php
function formulierNietGesplitst($jaar) {
  echo <<< EINDE1
     <form method="get" action="print_facturenTP.php" >
     <input type="submit" value="Maak een nieuwe factuur voor $jaar" />
     <input type="hidden" name="jaar" value="$jaar" />
     <input type="hidden" name="maand" value="0" />
     </form>

EINDE1;
}
function formulierGesplitst($jaar,$deelvzw, $langeDeelvzw) {
  echo <<< EINDE1
     <form method="get" action="print_facturenTP.php" >
     <input type="submit" value="Maak een nieuwe factuur voor $langeDeelvzw voor $jaar" />
     <input type="hidden" name="jaar" value="$jaar" />
     <input type="hidden" name="maand" value="0" />
     <input type="hidden" name="deelvzw" value="$deelvzw" />
     </form>

EINDE1;
}


  if ($dbnaam == "listelTP" || $dbnaam == "listelbe" || $siteadres=="http://localhost/listel") {
    $beginJaarOpsplitsing = 2009;
  }
  else {
    $beginJaarOpsplitsing = 2010;
  }

  if (date("Y") < $beginJaarOpsplitsing) {
    // oude facturen
    formulierNietGesplitst(date("Y"));
  }
  else {
    formulierGesplitst(date("Y"),"H","Hasselt");
    formulierGesplitst(date("Y"),"G", "Genk");
  }
  if (date("m")<3) {
    if (date("Y") <= $beginJaarOpsplitsing) {
      // oude facturen
      formulierNietGesplitst(date("Y")-1);
    }
    else {
      formulierGesplitst(date("Y")-1,"H", "Hasselt");
      formulierGesplitst(date("Y")-1,"G", "Genk");
    }
  }


function bestaandeFacturen($genre, $genreInfo) {
  if ($genre == "TP-H") {
    $genreCode = "H";
  }
  else if ($genre == "TP-G") {
    $genreCode = "G";
  }
  else {
    $genreCode = "";
  }

  print("<hr /><h3>Bestaande facturen voor $genreInfo</h3>");
  print("<ul>");
  $factuurQry = "select f1.nummer, f1.maand, f1.jaar, f1.factuurdatum, naam, f1.creditActief, f1.factuurFile, f1.vervangt, f1.id, f2.nummer as nummer2, f2.jaar as jaar2

               from factuurmaand f1 left join factuurmaand f2 on f1.vervangt = f2.id, verzekering

               where f1.genre = '$genre'

                 and f1.mutualiteit = verzekering.id

                 and not(f1.mutualiteit = -1)

               order by f1.id desc, jaar desc, maand desc";

  $factuurResult = mysql_query($factuurQry) or die(mysql_error() . " dankzij $factuurQry");
  $vorige = "200000";
  for ($i = 0; $i < mysql_num_rows($factuurResult); $i++) {
    $factuur = mysql_fetch_assoc($factuurResult);
    $deze = "{$factuur['jaar']}{$factuur['maand']}";
    if ($factuur['factuurFile']=="") {
      if ($deze != $vorige)
        print("<li><a href=\"print_facturenTP.php?jaar={$factuur['jaar']}&maand={$factuur['maand']}\">FactuurREEKS van MAAND {$factuur['maand']} van {$factuur['jaar']} -- factuurdatum {$factuur['factuurdatum']}</li>");
    }
    else {
      if ($factuur['vervangt']>0) {
        $extra = "(vervangt {$factuur['nummer2']}/{$factuur['jaar2']})";
      }
      else {
        $extra = "";
      }
      if ($genre == "TP-H" || $genre == "TP-G") {
        $vernieuw = "<a href=\"print_facturenTP.php?factuurID={$factuur['id']}&deelvzw=$genre&nieuwePDF=1\" style=\"font-size:8px;color:blue;\">vernieuw</a>";
        print("<li><a href=\"../factuurTPdinges17/factuur_{$factuur['jaar']}_{$genreCode}_{$factuur['nummer']}.pdf\"><!-- Factuur -->{$factuur['nummer']}/{$factuur['jaar']} : {$factuur['naam']} - dd {$factuur['factuurdatum']}</a> $extra $vernieuw");
      }
      else
        print("<li><a href=\"../factuurTPdinges17/factuur_{$factuur['jaar']}_{$factuur['nummer']}.pdf\"><!-- Factuur -->{$factuur['nummer']}/{$factuur['jaar']} : {$factuur['naam']} - dd {$factuur['factuurdatum']}</a> $extra");
    }
    if ($factuur['creditActief']==1) {
     if ($genre == "TP-H" || $genre == "TP-G") {
       print(" -- m&eacute;t <a href=\"../factuurTPdinges17/creditnota_{$factuur['jaar']}_{$genreCode}_{$factuur['nummer']}.pdf\">CREDITNOTA</a></li>\n");
     }
     else
       print(" -- m&eacute;t <a href=\"../factuurTPdinges17/creditnota_{$factuur['jaar']}_{$factuur['nummer']}.pdf\">CREDITNOTA</a></li>\n");
    }
    else {
     print("</li>\n");
    }
    $vorige = $deze;
  }
  print("</ul>");
}


    bestaandeFacturen("TP-H","Hasselt");
    bestaandeFacturen("TP-G","Genk");
    bestaandeFacturen("TP", "heel Limburg");


    print("</div>");

    print("</div>");

    print("</div>");



    include("../includes/footer.inc");



    print("</div>");

    print("</div>");

    print("</body>");

    print("</html>");



    }





    //---------------------------------------------------------

    /* Sluit Dbconnectie */ include("../includes/dbclose.inc");

    //---------------------------------------------------------



//---------------------------------------------------------

/* Geen Toegang */ include("../includes/check_access.inc");

//---------------------------------------------------------

?>