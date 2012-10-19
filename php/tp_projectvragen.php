<?php

session_start();

   require("../includes/dbconnect2.inc");
   require("../includes/clearSessie.inc");

   $paginanaam="Statistische vragen opstellen";

   if (isset($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan")

          && ($_SESSION['profiel'] == "hoofdproject"))

      {

      require("../includes/html_html.inc");

      print("<head>");

      require("../includes/html_head.inc");

?>



<script type="text/javascript">

var vraagNr = 0;

function voegVraagToe() {

    var rij = document.getElementById('form').insertRow(vraagNr*3);

    vraagNr++;

    var echteVraagNr = (vraagNr+nrPlus);

    var cel = rij.insertCell(0);

    cel.className="label";

    cel.innerHTML = "Vul vraag " +  echteVraagNr + " in:";

    cel = rij.insertCell(1);

    cel.className="input";

    cel.innerHTML = "<input type=\"text\" name=\"vraag[" + echteVraagNr + "]\"/>\n";



/*

    rij = document.getElementById('form').insertRow(vraagNr*3-2);

    cel = rij.insertCell(0);

    cel.className="label";

    cel.innerHTML = "Verplicht in te vullen: ";

    cel = rij.insertCell(1);

    cel.className="input";

    cel.innerHTML = "<input type=\"checkbox\" value=\"1\" name=\"verplicht[" + vraagNr + "]\"/>\n ";

*/



    rij = document.getElementById('form').insertRow(vraagNr*3-2);

    cel = rij.insertCell(0);

    cel.className="label";

    cel.innerHTML = "Kies aantal antwoorden: ";

    cel = rij.insertCell(1);

    cel.className="input";

    cel.innerHTML = "&nbsp;<select onchange=\"maakAntwoorden(" + echteVraagNr + ", this.selectedIndex);\" name=\"aantal" + vraagNr + "\"><option value=\"0\">kies</option><option>1</option><option>2</option><option>3</option><option>4</option><option>5</option><option>6</option><option>7</option><option>8</option><option>9</option><option>10</option><option>11</option></select>";

    

/*

    rij = document.getElementById('form').insertRow(vraagNr*4-2);

    cel = rij.insertCell(0);

    cel.className="label";

    cel.innerHTML = "Meervoudig antwoord? : ";

    cel = rij.insertCell(1);

    cel.className="input";

    cel.innerHTML = " <input type=\"radio\" name=\"type[" + vraagNr + "]\" value=\"meervoudig\"> ja <br/> <input type=\"radio\" name=\"type[" + vraagNr + "]\" value=\"enkel\"> nee";

*/



    rij = document.getElementById('form').insertRow(vraagNr*3-1);

    cel = rij.insertCell(0);

    cel = rij.insertCell(1);

    cel.innerHTML = "<div id=\"antwoorden" + echteVraagNr + "\"></div>";

}



function maakAntwoorden(vraag, antwoorden) {
  var div = document.getElementById('antwoorden' + vraag);

  var html="<ol>\n";

  for (i=0; i<antwoorden; i++) {

    html += "<li style='margin-left: -30px;'><input type=\"text\" name=\"antwoord["+ vraag +"][" + i + "]\" /></li>\n";

  }

  html += "</ol>\n";

  div.innerHTML =  html;

}

</script>

<style type="text/css">
  .mainblock {
    height: auto;
  }
</style>

<?php

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



     $tp_basisgegevens = tp_record($_SESSION['tp_project']);

?>

      <h1>Statistische vragen <?= tp_roepnaam($tp_basisgegevens) ?></h1>



<?php

   if ($_POST['action'] == "insert") {

    print("<p style='background-color:#8f8'>");

    foreach ($_POST['vraag'] as $nr => $vraag) {

      $ok = true;

      /*

      if ($_POST['verplicht'][$nr]==1)

        $verplicht = 1;

      else

        $verplicht = 0;

      */

      $verplicht = 0;

      $insertVraag = "insert into tp_vragen values ({$_SESSION['tp_project']},$nr, \"$vraag\")";

      $ok =  $ok && mysql_query($insertVraag);

      $values = "";

      foreach ($_POST['antwoord'][$nr] as $antwoordnr => $antwoord) {

        $values .= ", ({$_SESSION['tp_project']},$nr, $antwoordnr+1, \"$antwoord\")";

      }

      $values = substr($values,1);



      $insertAntwoorden = "insert into tp_antwoorden (tp, vraag, optie, antwoord) values $values";

      $ok = $ok && mysql_query($insertAntwoorden);

      if ($ok) print("Vraag $nr is opgeslagen.<br/>\n");

      else print(mysql_error()."<br/>");

    }

    print("</p>");

   }

   else if ($_POST['action']=="update") {

     print("<p style='background-color:#8f8'>");

     $ok = true;

     foreach ($_POST['vraag'] as $nr => $vraag) {

       /*

       if ($_POST['verplicht'][$nr]==1)

         $verplicht = 1;

       else

         $verplicht = 0;

       */

       $verplicht = 0;

       $updateVraag = "update tp_vragen set vraag = \"$vraag\" where nr = $nr and tp = {$_SESSION['tp_project']}";

       $ok = mysql_query($updateVraag);

       foreach ($_POST['antwoord'][$nr] as $antwoordnr => $antwoord) {

         $updateAntwoord = "update tp_antwoorden set antwoord = \"$antwoord\" where vraag = $nr and optie = $antwoordnr and tp = {$_SESSION['tp_project']}";

         $ok = $ok && mysql_query($updateAntwoord);

       }

       if ($ok) print("Vraag $nr is opgeslagen.<br/>\n");

    }

    print("</p>");

   }



   // nakijken of er al vragen zijn gesteld

   $qryAlVragen = "select * from tp_vragen where tp = {$_SESSION['tp_project']}";

   $resultAlVragen = mysql_query($qryAlVragen);

   if (mysql_num_rows($resultAlVragen) > 0) {

     print("<p>Hieronder zie je de statistische vragen van jouw therapeutisch project.<br/>Je kan alle teksten aanpassen, maar niet het aantal vragen of het aantal antwoorden.</p>");

     print("<form method=\"post\" ><table class=\"form\">");

     for ($i=0; $i<mysql_num_rows($resultAlVragen); $i++) {

       $vraagRij = mysql_fetch_assoc($resultAlVragen);

       //if ($vraagRij['verplicht'] == 1) $checked = " checked=\"checked\" ";

       //else $checked = "";

       $checked = "";

       echo <<< EINDE

         <tr><td class="label">Vul vraag {$vraagRij['nr']} in:</td>

             <td class="input"><input name="vraag[{$vraagRij['nr']}]" type="text" value="{$vraagRij['vraag']}" /></td></tr>

         <!-- <tr><td class="label">Verplicht in te vullen: </td><td class="input"><input value="1" name="verplicht[{$vraagRij['nr']}]" type="checkbox" $checked></td></tr> -->

         <tr class="onderlijn"><td class="label">Antwoordmogelijkheden </td><td><div><ol>

EINDE;

       $nr = $vraagRij['nr'];

       $qryAntwoorden = "select * from tp_antwoorden where tp = {$_SESSION['tp_project']} AND vraag = $nr";

       $resultAntwoorden = mysql_query($qryAntwoorden);

       for ($j=0; $j<mysql_num_rows($resultAntwoorden); $j++) {

         $antwoordRij = mysql_fetch_array($resultAntwoorden);

         print("<li style=\"margin-left: -10px;\"><input name=\"antwoord[$nr][{$antwoordRij['optie']}]\" type=\"text\" value=\"{$antwoordRij['antwoord']}\"/></li>\n");

       }

       print("</ol></div></td></tr>\n");

     }

     print("<input type=\"hidden\" name=\"action\" value=\"update\" />\n");

     print("<tr><td class=\"label\">&nbsp;<br/>Deze gegevens </td><td class=\"input\">&nbsp;<br/><input type=\"submit\" value=\"opslaan\" /></td></tr>");

     print("\n</table></form>\n");



     echo <<< EINDE

<hr/><p>Hieronder kan je nog vragen toevoegen.</p>



<script type="text/javascript">

var nrPlus = $nr;



</script>



EINDE;

   }



   else {

      echo <<< EINDE

<p>Vul hieronder de statistische vragen voor jouw therapeutisch project in.<br/>

Doe dit zorgvuldig, want eenmaal deze gegevens opgeslagen zijn, kan je alleen nog typfouten of de

formulering van de vragen en antwoorden wijzigen. Het aantal antwoorden kan je ook niet meer wijzigen.<br/>

Je kan later nog wel vragen toevoegen, maar geen vragen verwijderen.

</p>

<script type="text/javascript">

var nrPlus = 0;

</script>

EINDE;

   }





?>





<form method="post">

<input type="hidden" name="action" value="insert" />

<table class="form" id="form">



</table>

<table class="form">

<tr>

<td class="label">

<input type="button" value="Voeg een vraag toe" onclick="voegVraagToe()" />

</td>

<td class="input">

<input type="submit" value="Sla deze vragen op" />

</td>

</tr>

</table>

</form>

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