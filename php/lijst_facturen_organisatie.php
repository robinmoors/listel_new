<?php

    //----------------------------------------------------------

    /* Maak Dbconnectie */ include('../includes/dbconnect2.inc');

	//----------------------------------------------------------

	

include("../includes/clearSessie.inc");



$paginanaam="Lijst Uittreksels Organisatievergoeding";









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


function formulierGesplitst($jaar,$deelvzw, $langeDeelvzw) {
  echo <<< EINDE1
     <form method="get" action="print_facturenOrganisatie.php" >
     <input type="submit" value="Maak een nieuwe factuur voor $langeDeelvzw voor $jaar" />
     <input type="hidden" name="jaar" value="$jaar" />
     <input type="hidden" name="maand" value="0" />
     <input type="hidden" name="deelvzw" value="$deelvzw" />
     </form>
     
EINDE1;
}

?>

    

<h3>Nieuwe betalingsopdracht voor organisatoren</h3>



<?php
  if ($dbnaam == "listelTP" || $dbnaam == "listelbe" || $siteadres=="http://localhost/listel") {
    $beginJaarOpsplitsing = 2009;
  }
  else {
    $beginJaarOpsplitsing = 2010;
  }




  formulierGesplitst(date("Y"),"H","Hasselt");
  formulierGesplitst(date("Y"),"G", "Genk");
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


  function toonFacturen($genre, $genreInfo) {
    print("<hr /><h3>Bestaande betalingsopdrachten voor $genreInfo</h3>");
    print("<ul>");
    $factuurQry = "select * from factuur_organisatie where deelvzw = '$genre' order by id desc";
    $factuurResult = mysql_query($factuurQry) or die(mysql_error() . " dankzij $factuurQry");
    for ($i = 0; $i < mysql_num_rows($factuurResult); $i++) {
      $factuur = mysql_fetch_assoc($factuurResult);
      $aantal = $factuur['maximum'] - $factuur['minimum'];
      print("<li><a href=\"{$siteadresPDF}print_facturenOrganisatie.php?minFactuurID={$factuur['minimum']}&maxFactuurID={$factuur['maximum']}&datum={$factuur['datum']}&deelvzw=$genre\">$aantal organisaties op {$factuur['datum']}</a></li>");
    }
    print("</ul>");
  }
?>

<hr />

<form method="post" action="stats_facturenOrganisatie.php">
<select name="jaar">
<option>2009</option>
<option selected="selected">2010</option>
<option>2011</option>
<option>2012</option>
<option>2013</option>
<option>2014</option>
</select>
<input type="radio" name="deelvzw" value="H"/>SEL Hasselt --
<input type="radio" name="deelvzw" value="G"/>SEL Genk
<input type="submit" value="csv opvragen"/>
<input type="hidden" name="sep" value=";"/>

</form>

<?php
    toonFacturen("H","Hasselt");
    toonFacturen("G","Genk");

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