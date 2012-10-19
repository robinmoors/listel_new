<?php

session_start();


   require("../includes/dbconnect2.inc");
   require("../includes/clearSessie.inc");


   $paginanaam="Maak credit nota";

   if (IsSet($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan") && $_SESSION['profiel']=="listel")

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

if (isset($_POST['soort'])) {

// hier komt het!

  if ($_POST['soort']=="gewoon")

    $factuurURL = "print_facturenGDT.php";

  else if ($_POST['soort']=="H")

    $factuurURL = "print_facturenGDT.php";

  else if ($_POST['soort']=="G")

    $factuurURL = "print_facturenGDT.php";

  else if ($_POST['soort']=="TP")
    $factuurURL = "print_facturenTP.php";
  else if ($_POST['soort']=="TP-H")
    $factuurURL = "print_facturenTP.php";
  else if ($_POST['soort']=="TP-G")
    $factuurURL = "print_facturenTP.php";

  else if ($_POST['soort']=="ForK")
    $factuurURL = "print_facturenTP_ForK.php";
  else if ($_POST['soort']=="ForK-H")
    $factuurURL = "print_facturenTP_ForK.php";
  else if ($_POST['soort']=="ForK-G")
    $factuurURL = "print_facturenTP_ForK.php";

  else

    die("Geen soort factuur gekozen!!");

// toon factuurinfo en vraag bevestiging

  if ($_POST['soort']=="ForK")

    $getCreditNotaQry = "select factuurmaand.*, 'FOD' as naam from factuurmaand where genre = \"{$_POST['soort']}\"

                            and jaar = {$_POST['jaar']} and nummer = {$_POST['nummer']}";

  else

    $getCreditNotaQry = "select factuurmaand.*, verzekering.naam from factuurmaand, verzekering where genre = \"{$_POST['soort']}\"

                            and jaar = {$_POST['jaar']} and nummer = {$_POST['nummer']}

                            and mutualiteit = verzekering.id";



  if ($creditNotaResult = mysql_query($getCreditNotaQry)) {

    $creditNotaRij = mysql_fetch_assoc($creditNotaResult);

    if ($creditNotaRij['factuurFile']=="") {

      print("<h4>Dit gaat nog niet. </h4><p>Gelieve eerst de factuur (terug) af te drukken zodat ik de pdf met (oude) factuur en creditnota aan kan maken. Zorg er wel voor dat de oude \"foute\" gegevens er in staan!</p><p>En kom dan terug naar hier!</p>");

    }

    else

    echo <<< EINDE

    <h4>Ben je zeker?</h4>

    <p>Wil je van factuur {$creditNotaRij['nummer']} uit {$creditNotaRij['jaar']} voor {$creditNotaRij['naam']} ({$_POST['soort']}) een creditnota maken?</p>

         <form method="post" action="$factuurURL">

             <input type="hidden" name="teCrediterenFactuur" value="{$creditNotaRij['id']}" />
             <input type="hidden" name="genre" value="{$_POST['soort']}" />

             <input type="submit" value="ja" />

         </form>

         <form method="get" action="maakCreditNota.php"><input type="submit" value="neen"/></form>

EINDE;

  }

  else {

     die("debug-info: " . mysql_error());

  }



// en maak $_POST['teCrediterenFactuur'] die factuurid bevat



}

else {

?>

<h1>Maak een creditnota voor een foute factuur<br/>

en maak direct ook de nieuwe, correcte factuur</h1>



<p>

<form method="post">

Soort: <br/>
 Heel Limburg <input type="radio" value="gewoon" name="soort"/>
    of GDT Hasselt <input type="radio" value="H" name="soort"/>
    of GDT Genk <input type="radio" value="G" name="soort"/>
<br/>
    of TP heel Limburg <input type="radio" value="TP" name="soort"/>
    of TP Hasselt <input type="radio" value="TP-H" name="soort"/>
    of TP Genk <input type="radio" value="TP-G" name="soort"/>
<br/>
    of For-K heel Limburg <input type="radio" value="ForK" name="soort"/>
    of For-K Hasselt <input type="radio" value="ForK-H" name="soort"/>
    of For-K Genk <input type="radio" value="ForK-G" name="soort"/>
<br/>

Jaar <input type="text" name="jaar" size="6"/> - nummer <input type="text" name="nummer" size="6"/>           <br/>

<input type="submit" value="crediteer" />

</form>

</p>





<h5>Factuur van n&agrave; 20/3/2008?</h5>



<em>Deze procedure geldt ook voor oude facturen wanneer in het factuuroverzicht de naam van het ziekenfonds al vermeld wordt.</em>

<ol>

<li>Zorg er voor dat alle gegevens in de verbeterde toestand staan, want we maken ook direct de nieuwe, verbeterde factuur.<br/>

Hiervoor kan je eventueel de link <a href="controle_na_factuur.php">Controle na factuur</a> gebruiken, waarmee je

de nieuwe versie van een zorg- of hulpverlener kan toevoegen (verwijder oude persoon, en voeg de nieuwe versie toe).</li>

<li>Maak nu de creditnota.</li>

</ol>





<h5>Factuur van voor 20/3/2008?</h5>



<em>Deze procedure geldt enkel wanneer in het factuuroverzicht deze factuur nog als "REEKS" vermeld staat!

Volg anders de procedure hierboven.</em>

<ol>

<li>Zorg er voor dat de gegevens nog in hun foute toestand staan.</li>

<li>Druk de factuur nog een keertje af zodat de factuur in zijn oude toestand bewaard wordt.</li>

<li>Verbeter nu de gegevens. <br/>

Hiervoor kan je eventueel de link <a href="controle_na_factuur.php">Controle na factuur</a> gebruiken, waarmee je

de nieuwe versie van een zorg- of hulpverlener kan toevoegen (verwijder oude persoon, en voeg de nieuwe versie toe).</li>

<li>Maak nu de creditnota.</li>

</ol>





<?php

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