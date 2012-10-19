<?php

session_start();

   require("../includes/dbconnect2.inc");
   require("../includes/clearSessie.inc");

   $paginanaam="Statistieken opvragen";

   if (IsSet($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan"))

      {

      require("../includes/html_html.inc");

      print("<head>");

      require("../includes/html_head.inc");
?>

<style type="text/css">
 .mainblock { height: auto; padding-bottom: 20px;}
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

?>





<h1>Jaarverslag GDT-werking</h1>



<p>Vul hieronder termijnen in en bekijk de uitkomst in Excel. </p>

<form method="post" action="stats_bekijken.php">

<table>

<tr>

<td>

Werkjaar

</td>

<td>

<input type="hidden" name="stat" value="GDT_jaarverslag" />

<select name="werkjaar" >

<?php

for ($j=date("Y");$j>2005;$j--) {

  print("  <option value=\"$j\">$j</option>\n");

}

?>

</select>

</td>

</tr>









<?php

      if ($_SESSION['profiel']=="listel") {

?>



<tr>

<td>

Kies de POP (of provincie)

</td>

<td>

<select name="sit">

<option value="alles">heel de provincie</option>
<option value="H">SEL Hasselt</option>
<option value="G">SEL Genk</option>



<?php

$sitResult = mysql_query("select naam from sit order by naam");

for ($s=0; $s<mysql_num_rows($sitResult); $s++) {

  $sitRij = mysql_fetch_assoc($sitResult);

  print("<option value=\"{$sitRij['naam']}\">{$sitRij['naam']}</option>\n");

}

?>



</select>



</td>

</tr>

<?php

      }

?>





<?php

/********* toevoeging voor stats van TP  ****************/

   if ($_SESSION['profiel']!="OC") {

?>

<!--

  <tr>

  <td colspan="2">

    <hr/>

    <input type="radio" name="stat" value="TP" />  Alles van TP<br/>

  </td>

  </tr>

-->

<?php

}

/********* einde toevoeging voor stats van TP  ****************/

?>



<tr>

<td colspan="2">

<input type="submit" value=".csv-bestand opvragen" />

</td>

</tr>

<tr>

<td colspan="2">

<input type="checkbox" name="sep"  value=","> Selecteer wanneer Excel geen kolommen maakt.

</td>

</tr>

</table>

</form>



<?php

      if ($_SESSION['profiel']=="listel") {

         echo <<< EINDE



<h1>Statistiek van niet-vergoede overleggen</h1>



<p>Vul hieronder het jaar in en bekijk de uitkomst in Excel. </p>

<form method="post" action="stats_bekijken.php">

<table>

<tr>

<td>

Werkjaar

</td>

<td>

<input type="hidden" name="stat" value="aanwezigheden_nietvergoedbaar" />

<select name="werkjaar" >

EINDE;



for ($j=date("Y");$j>2005;$j--) {

  print("  <option value=\"$j\">$j</option>\n");

}



echo <<< EINDE



</select>

</td>

</tr>



<tr>

<td colspan="2">

<input type="submit" value=".csv-bestand opvragen" />

</td>

</tr>

<tr>

<td colspan="2">

<input type="checkbox" name="sep"  value=","> Selecteer wanneer Excel geen kolommen maakt.

</td>

</tr>

</table>

</form>





<hr />

<h1>Facturatiegegevens</h1>



<p>Kies de gewenste statistiek en bekijk de uitkomst in Excel. </p>

<form method="post" action="stats_bekijken.php">

<table>

<tr>

<td>

Begindatum (dd/mm/jjjj)

</td>

<td>

<input type="text" name="begindag" size="3" style="width: 30px;" value="01"/> /

<input type="text" name="beginmaand" size="3"  style="width: 30px;" value="01"/> /

<input type="text" name="beginjaar" size="3"  style="width: 60px;" value="2004"/>

</td>

</tr>

<tr>

<td>

Einddatum (dd/mm/jjjj)

</td>

<td>

<input type="text" name="einddag" size="3"  style="width: 30px;" value="31"/> /

<input type="text" name="eindmaand" size="3"  style="width: 30px;" value="12"/> /

<input type="text" name="eindjaar" size="3"  style="width: 60px;" value="2033"/>

</td>

</tr>

<tr>

<td style="background-color: #DDD">

<input type="radio" name="stat" value="aanwezigheden" />  Aanwezigheden<br/>

</td>

<td style="background-color: #DDD">

<input type="radio" name="stat" value="betalingen" />  Betaaloverzicht<br/>

</td>

<td style="background-color: #DDD">

<input type="radio" name="stat" value="betaling_TP" />  TP<br/>

<input type="radio" name="stat" value="betaling_TP_per_project" />  TP per stuk
<input type="text" style="width:40px;" name="tp_project" /><br/>
</td>

</tr>

<tr>

<td colspan="2">

<input type="submit" value=".csv-bestand opvragen" />

</td>

</tr>

<tr>

<td colspan="2">

<input type="checkbox" name="sep"  value=","> Selecteer wanneer Excel geen kolommen maakt.

</td>

</td>

</tr>

</table>

</form>



<hr />

<h1>Kwartaaloverzichten voor Storme</h1>



<form method="post" action="stats_kwartaalregistratie.php">

<table>

<tr>

<td>

Begindatum (dd/mm/jjjj)

</td>

<td>

<input type="text" name="begindag" size="3" style="width: 30px;" value="01"/> /

<input type="text" name="beginmaand" size="3"  style="width: 30px;" value="01"/> /

<input type="text" name="beginjaar" size="3"  style="width: 60px;" value="2004"/>

</td>

</tr>

<tr>

<td>

Einddatum (dd/mm/jjjj)

</td>

<td>

<input type="text" name="einddag" size="3"  style="width: 30px;" value="31"/> /

<input type="text" name="eindmaand" size="3"  style="width: 30px;" value="12"/> /

<input type="text" name="eindjaar" size="3"  style="width: 60px;" value="2033"/>

</td>

</tr>

<tr>

<td colspan="2">

<input type="checkbox" name="opsomming"  value="1"> Toon ook alle overleggen (dus niet alleen de samenvattende tabel)

</td>

</tr>


<tr>

<td colspan="2">

<input type="submit" value=".csv-bestand opvragen" />

</td>

</tr>

<tr>

<td colspan="2">

<input type="checkbox" name="sep"  value=","> Selecteer wanneer Excel geen kolommen maakt.

</td>

</tr>

</table>

</form>



<hr />

<h1>OMB-statistieken</h1>



<p>Kies de gewenste statistiek en bekijk de uitkomst in Excel. </p>

<form method="post" action="stats_omb.php">

<table>

<tr>

<td>

Begindatum (dd/mm/jjjj)

</td>

<td>

<input type="text" name="begindag" size="3" style="width: 30px;" value="01"/> /

<input type="text" name="beginmaand" size="3"  style="width: 30px;" value="01"/> /

<input type="text" name="beginjaar" size="3"  style="width: 60px;" value="2004"/>

</td>

</tr>

<tr>

<td>

Einddatum (dd/mm/jjjj)

</td>

<td>

<input type="text" name="einddag" size="3"  style="width: 30px;" value="31"/> /

<input type="text" name="eindmaand" size="3"  style="width: 30px;" value="12"/> /

<input type="text" name="eindjaar" size="3"  style="width: 60px;" value="2033"/>

</td>

</tr>

<!--

<tr>

<td style="background-color: #DDD">

<input type="radio" name="stat" value="verzamel" />  Verzamelstatistieken<br/>

</td>

<td style="background-color: #DDD">

<input type="radio" name="stat" value="opsomming" />  Opsomming (voor de provincie)<br/>

</td>

</tr>

-->

<tr>

<td colspan="2">

<input type="submit" value=".csv-bestand opvragen" onclick="alert('Vergeet niet om sebiet in Excel een replace te doen van\\n!!! door een punt-komma om de statistieken te activeren!');"/>

</td>

</tr>

<tr>

<td colspan="2">

<input type="checkbox" name="sep"  value=","> Selecteer wanneer Excel geen kolommen maakt.

</td>

</tr>

</table>

</form>


<hr />

<h1>Statistieken aanvraag overleg</h1>

<form method="post" action="stats_aanvraag_overleg.php">

<table>
 <tr>
    <td>Begindatum (dd/mm/jjjj)</td>
    <td>
        <input type="text" name="begindag" size="3" style="width: 30px;" value="01"/> /
        <input type="text" name="beginmaand" size="3"  style="width: 30px;" value="01"/> /
        <input type="text" name="beginjaar" size="3"  style="width: 60px;" value="2011"/>
    </td>
 </tr>
 <tr>
   <td>Einddatum (dd/mm/jjjj)</td>
   <td>
       <input type="text" name="einddag" size="3"  style="width: 30px;" value="31"/> /
       <input type="text" name="eindmaand" size="3"  style="width: 30px;" value="12"/> /
       <input type="text" name="eindjaar" size="3"  style="width: 60px;" value="2033"/>
   </td>
 </tr>

 <tr>
    <td colspan="2"><input type="submit" value=".csv-bestand opvragen"  /></td>
 </tr>
 <tr>
     <td colspan="2"><input type="checkbox" name="sep"  value=","> Selecteer wanneer Excel geen kolommen maakt.</td>
 </tr>
</table>
</form>
<hr/>
<h1>Pati&euml;nten opgenomen in zorgtrajecten</h1>

<form method="post" action="stats_zorgtraject.php">

<table>
 <tr>
    <td>Begindatum (dd/mm/jjjj)</td>
    <td>
        <input type="text" name="begindag" size="3" style="width: 30px;" value="01"/> /
        <input type="text" name="beginmaand" size="3"  style="width: 30px;" value="01"/> /
        <input type="text" name="beginjaar" size="3"  style="width: 60px;" value="2011"/>
    </td>
 </tr>
 <tr>
   <td>Einddatum (dd/mm/jjjj)</td>
   <td>
       <input type="text" name="einddag" size="3"  style="width: 30px;" value="31"/> /
       <input type="text" name="eindmaand" size="3"  style="width: 30px;" value="12"/> /
       <input type="text" name="eindjaar" size="3"  style="width: 60px;" value="2033"/>
   </td>
 </tr>

 <tr>
    <td colspan="2"><input type="submit" value=".csv-bestand opvragen"  /></td>
 </tr>
 <tr>
     <td colspan="2"><input type="checkbox" name="sep"  value=","> Selecteer wanneer Excel geen kolommen maakt.</td>
 </tr>
</table>
</form>

EINDE;

  }

?>



<hr/>

<h1>Gevorderde statistieken</h1>

<h6>Gebruik op eigen risico ;-)</h6>



<p>Kies de gewenste statistiek en bekijk de uitkomst in Excel. </p>

<form method="post" action="stats_bekijken.php">

<table>

<tr>

<td>

Begindatum (dd/mm/jjjj)

</td>

<td>

<input type="text" name="begindag" size="3" style="width: 30px;" value="01"/> /

<input type="text" name="beginmaand" size="3"  style="width: 30px;" value="01"/> /

<input type="text" name="beginjaar" size="3"  style="width: 60px;" value="2001"/>

</td>

</tr>

<tr>

<td>

Einddatum (dd/mm/jjjj)

</td>

<td>

<input type="text" name="einddag" size="3"  style="width: 30px;" value="31"/> /

<input type="text" name="eindmaand" size="3"  style="width: 30px;" value="12"/> /

<input type="text" name="eindjaar" size="3"  style="width: 60px;" value="2033"/>

</td>

</tr>



<?php

/********* GEWONE STATS NIET VOOR TP  ****************/

   if ($_SESSION['profiel']=="OC" || $_SESSION['profiel']=="listel") {

?>







<?php

      if ($_SESSION['profiel']=="listel") {

         echo <<< EINDE



<tr>

<td>

Opgesplitst per

</td>

<td>

<input type="radio" name="beperking" value="gemeente" />  gemeente<br/>

<input type="radio" name="beperking" value="sit" />  POP<br/>

<input type="radio" name="beperking" value="provincie" />  provincie<br/>



</td>

</tr>

EINDE;

      }

?>

<tr>



<script language="javascript">

  function toon(id){

    document.getElementById(id).style.display = 'block';

  }

  function verstop(id){

    document.getElementById(id).style.display = 'none';

  }

</script>



<td>

<a href="#" onclick="toon('overleg');verstop('zorgplan');return false;">Overleg</a>

</td>

<td>

<a href="#" onclick="verstop('overleg');toon('zorgplan');return false;">zorgplan</a>

</td>





</tr>

<table id="overleg" style="display:none">

<tr>

<td>

<input type="radio" name="stat" value="overleg" />  Overleg<br/>

<input type="radio" name="stat" value="overleg_hulpverleners" />  Hulpverleners per organisatie <br/>

<!-- <input type="radio" name="stat" value="overleg_contact_hulpverleners" />  Hulpverleners als contactpersoon <br/> -->

<input type="radio" name="stat" value="overleg_functies" />  Gegevens per functie <br/>

<input type="radio" name="stat" value="overleg_mantelzorgers" />  Mantelzorgers per verwantschap <br/>

<input type="radio" name="stat" value="overleg_contact_mantelzorgers" />  Mantelzorgers als contactpersoon <br/>

</td>

<td>

<input type="radio" name="soortOverleg" value="vergoeding" />  Vergoedbare overleggen<br/>

<input type="radio" name="soortOverleg" value="geenVergoeding" />  Niet-vergoedbaar<br/>

<input type="radio" name="soortOverleg" value="alles" />  Alles<br/>

</td>

</tr>

</table>



<table id="zorgplan"  style="display:none">

<tr>

<td>

<input type="radio" name="stat" value="zorgenplan" />  Statistische gegevens van zorgplan<br/>

<input type="radio" name="stat" value="zorgenplan_oplijsting" />  Oplijsting van zorgplannen<br/>

<input type="radio" name="stat" value="zorgenplan_mutualiteit" />  Aantal zorgplannen/verzekeringsinstelling<br/>

<br />

<input type="radio" name="stat" value="evaluatie" />  Evaluatie<br/>

</td>

<td>

<input type="radio" name="soortzorgplan" value="nieuw" />  Nieuwe zorgplannen<br/>

<input type="radio" name="soortzorgplan" value="doorlopend" />  Doorlopende zorgplannen<br/>

<input type="radio" name="soortzorgplan" value="stopgezet" />  Stopgezette zorgplannen<br/>

<input type="radio" name="soortzorgplan" value="effectief" />  zorgplannen met effectief overleg<br/>

<input type="radio" name="soortzorgplan" value="alles" />  Alle zorgplannen<br/>

</td>

</tr>

</table>

<tr>

<td colspan="2">

<input type="submit" value=".csv-bestand opvragen" />

</td>

</tr>

<tr>

<td colspan="2">

<input type="checkbox" name="sep"  value=","> Selecteer wanneer Excel geen kolommen maakt.

</td>

</tr>

</table>

<?php

/********* GEWONE STATS NIET VOOR TP  ****************/

}







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

?>