<?php



//----------------------------------------------------------

/* Maak Dbconnectie */ include('../includes/dbconnect2.inc');

//----------------------------------------------------------



   $paginanaam="Lijst Organisaties";



   if (isset($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan")){

      

      include("../includes/html_html.inc");



      print("<head>");



      include("../includes/html_head.inc");

      include("../includes/bevestigdel.inc");

?>



<script type="text/javascript" src="../javascript/prototype.js"></script>

<script type="text/javascript">

var zvl = "<p>ZVL is de afkorting van <strong>zorgverleners</strong>. ";

zvl += " Deze organisatie overkoepelt de doctors in de geneeskunde, heelkunde- en verloskunde, de artsen, de licentiaten in de tandheelkunde en de tandartsen, de apothekers, de vroedvrouwen, die wettelijk gemachtigd zijn om hun kunst uit te oefenen; ";

zvl += " de kinesitherapeuten, de verpleegkundigen, de paramedische medewerkers en de ge&iuml;ntegreerde diensten voor thuisverzorging. In de praktijk: huisartsen, apothekers, kinesitherapeuten, thuisverpleegkundigen, logopedisten, ...</p>";

zvl += " <p>ZVL-ers hebben een eigen RIZIV- en rekeningnummer en worden bij een GDT dan ook rechtstreeks vergoed. Door deze aansluiting bij het RIZIV zijn ze in orde met de regelgeving, dus is het niet (meer) nodig hen een convenant te laten ondertekenen. Voor therapeutische projecten krijgen ze een vergoeding uit een gepoolde pot via GDT LISTEL vzw (SEL Hasselt en SEL Genk), zoals alle professionele deelnemers die aan een overleg van een therapeutisch project deelnemen. Slechts 1 persoon per discipline wordt vergoed.";

zvl += " </p>";



var hvl = "<p>HVL is de afkorting van <strong>hulpverleners opgenomen in GDT</strong>. Deze organisatie overkoepelt dan ook psychologen, psychotherapeuten, ergotherapeuten, maatschappelijk werkers, deskundigen van diensten voor gezinszorg en aanvullende gezinszorg of deskundigen van een uitleendienst, vertegenwoordigd in of een overeenkomst hebbende met een ge&iuml;ntegreerde dienst voor thuisverzorging.<br/>In de praktijk: maatschappelijk werkers, verantwoordelijken van diensten voor gezinszorg en aanvullende gezinszorg, verzorgenden, poetshulpen, thuisbegeleiders, di&euml;tisten, ergotherapeuten, orthopedagogen - psychologen, psychotherapeuten actief binnen de 1ste lijn, ...</p> ";

hvl += "<p>HVL-ers werken in de regel onder een organisatie en worden zowel bij een GDT als bij een therapeutisch project vergoed via een gepoolde pot via GDT LISTEL vzw (SEL Hasselt en SEL Genk). Slechts 1 persoon per organisatie wordt vergoed.<br/>De zelfstandige hulpverleners met een eigen rekening vallen ook onder deze regeling.HVL-ers worden vertegenwoordigd voor uitbetaling door het RIZIV-nummer van GDT Listel vzw (SEL Hasselt en SEL Genk), daarom sluit hun organisatie , of zijzelf indien ze zelfstandig werken, een convenant af met GDT Listel vzw (SEL Hasselt en SEL Genk).</p>";



var xvlp = "<p>XVLP is de afkorting van <strong>professionele 'andere' hulpverleners</strong>. Deze organisatie overkoepelt sociale diensten van ziekenhuizen en woonzorgcentra, diensten pati&euml;ntenbegeleiding, specialistische artsen (geriaters, psychiaters, cardiologen, neurologen, ...), palliatief deskundigen, psychologen, ergotherapeuten, kinesitherapeuten, verpleegkundigen of verzorgenden van ziekenhuizen en woonzorgcentra, co&ouml;rdinerend geneesheren van rustoorden, ...</p>    ";

xvlp += "<p>XVLP-ers worden <strong>niet</strong> vergoed bij een GDT, maar w&eacute;l bij een therapeutisch project, en dit via een gepoolde pot via GDT LISTEL vzw (SEL Hasselt en SEL Genk). Slechts 1 persoon per organisatie wordt vergoed. ";

xvlp += "<!--<br/>De zelfstandige hulpverleners met een eigen rekening vallen ook onder deze regeling.--></p>";

xvlp += "<p>In tegenstelling tot vroeger moet nu ook voor deze organisaties een convenant met rekening nummer ondertekend worden, omdat ook deze mensen voor een overleg van een therapeutisch project een vergoeding krijgen.  </p>";



var xvlnp = "<p>XVLNP is de afkorting van <strong>niet-professionele 'andere' hulpverleners</strong>. Deze organisatie overkoepelt (o.a.) vrijwilligers van niet-erkende oppas- en gezelschapsdiensten, ";

xvlnp += " maar ook professionelen die niet werkzaam zijn in de Gezondheids- of Welzijnssector.<br/> In de praktijk: commerci&euml;le instellingen zoals interim kantoren, advocaten, niet-erkende gezelschapsdiensten.</p>";

xvlnp += "<p>XVLNP-ers worden <strong>nooit</strong> vergoed, daarom sluiten zij geen convenant af. </p>";

var rdc = "<p>Regionaal Dienstencentrum is er alleen om overleggen te plannen en zorgplannen te beheren.</p>";

var ggz = "<p>Organisaties verbonden aan de geestelijke gezondheidszorg</p>";
var art107 = "<p>Organisaties die passen binnen art. 107.</p>";
var mobiele_equipe = "<p>Organisaties die een mobiele equipe vormen binnen de geestelijke gezondheidszorg.</p>";

function infoOrganisatie(id) {
   $('info').innerHTML = "";
   if (organisaties[id]['genre']=="ZVL")
     $('info').innerHTML += zvl;
   else if (organisaties[id]['genre']=="HVL")
     $('info').innerHTML += hvl;
   else if (organisaties[id]['genre']=="XVLP")
     $('info').innerHTML += xvlp;
   else if (organisaties[id]['genre']=="XVLNP")
     $('info').innerHTML += xvlnp;

   var extra = "";
   if (organisaties[id]['ggz']==1) {
     $('info').innerHTML += ggz;
     extra = " ggz ";
   }
   if (organisaties[id]['art107']==1) {
     $('info').innerHTML += art107;
     extra += " art107 ";
   }
   if (organisaties[id]['mobiele_equipe']==1) {
     $('info').innerHTML += mobiele_equipe;
     extra += " mobiele equipe ";
   }

   $('info').innerHTML = "<h3>'" + organisaties[id]['naam'] + "' is een organisatie " + organisaties[id]['genre'] + extra + "</h3>" + $('info').innerHTML;

//   else if (organisaties[id]['genre']=="rdc")
//     $('info').innerHTML += rdc;

}





</script>



<?



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





		if (isset($a_partner_id)){



/*

			$query="

				 UPDATE

					hulpverleners

					SET

						hvl_partner_id=76

					WHERE

						hvl_partner_id=".$a_partner_id;

*/







			$query="

				update

           organisatie

        set

          actief = 0

        WHERE

					id=".$a_partner_id;



			$doe=mysql_query($query);

			if ($doe) print("<h3>Succesvol verwijderd</h3>");



		} // einde isset $a_partner_id





    print("<script type='text/javascript'>function hide(){}");

    print("//var orgList = orgListAlles;\n</script>");



?>



   <fieldset>





      <div class="legende">Zoek naar een organisatie</div>



      <div>&nbsp;</div>



      <div class="inputItem" id="IIZorgverlener">





		 <form autocomplete="off" action="edit_partners.php?a_backpage=lijst_partners.php" method="post" name="zvlform">



<?php

    toonZoekOrganisatie("zvlform", "", "", "infoOrganisatie(\$F('organisatie'));");

?>




     <div class="inputItem" id="IISoortZvlS">



         <div class="label160">Lijsten</div>



         <div class="waarde">

           <table style="margin-left: 160px;position:relative; top: -32px;">

             <tr>

               <td style="font-size: 11px;"><a href="lijst_partners2.php?genre=ZVL">Organisaties ZVL</a></td>

               <td style="font-size: 11px;">Zorgverleners</td>

             </tr>

             <tr>

               <td style="font-size: 11px;"><a href="lijst_partners2.php?genre=HVL">Organisaties HVL</a></td>

               <td style="font-size: 11px;">Hulpverleners opgenomen in GDT</td>

             </tr>

             <tr>

               <td style="font-size: 11px;"><a href="lijst_partners2.php?genre=XVLP">Organisaties XVLP</a></td>

               <td style="font-size: 11px;">Hulpverleners <strong>niet</strong> opgenomen in GDT</td>

             </tr>

             <tr>

               <td style="font-size: 11px;"><a href="lijst_partners2.php?genre=XVLNP">Organisaties XVLNP</a></td>

               <td style="font-size: 11px;">Niet-professionelen</td>

             </tr>
             <tr>
               <td style="font-size: 11px;"><a href="lijst_partners2.php?genre=GGZ">Organisaties GGZ</a></td>
               <td style="font-size: 11px;">&nbsp;</td>
             </tr>
             <tr>
               <td style="font-size: 11px;"><a href="lijst_partners2.php?genre=ART107">Organisaties art.107</a></td>
               <td style="font-size: 11px;">&nbsp;</td>
             </tr>
             <tr>
               <td style="font-size: 11px;"><a href="lijst_partners2.php?genre=mobiele_equipe">Mobiele Equipe GGZ</a></td>
               <td style="font-size: 11px;">&nbsp;</td>
             </tr>

<!--
             <tr>
               <td style="font-size: 11px;"><a href="lijst_partners2.php?genre=rdc">Organisaties RDC</a></td>
               <td style="font-size: 11px;">Regionale Dienstencentra</td>
             </tr>
-->
             <tr>

               <td style="font-size: 11px;"><a href="lijst_partners2.php">De volledige lijst</a></td>

               <td style="font-size: 11px;"></td>

             </tr>

           </table>

         </div>



      </div><!--Soort organisatie -->



<?php

   if($_SESSION["profiel"]!="listel"){

?>

      <div class="label160">Deze organisatie&nbsp;:</div>

      <div class="waarde">

         <input type="hidden" name="a_backpage" value="lijst_partners.php" />

         <input type="submit" value="Bekijken">&nbsp;

       </div><!--Button aanpassen -->

      </form>

<?php

   }

   else {

?>



      <div class="label160">Deze organisatie&nbsp;:</div>

      <div class="waarde">

         <input type="hidden" name="a_backpage" value="lijst_partners.php" />

         <input type="submit" value="Aanpassen" onClick="document.zvlform.wis.value=0" >&nbsp;

       </div><!--Button aanpassen -->





       <div class="label160">Deze organisatie&nbsp;:</div>

      <div class="waarde">

        <input type="hidden" name="wis" value="0" />

        <input type="submit" value="Op non-actief zetten"

               onclick="var ok = confirm('Ben je zeker dat je op non-actief wil zetten?');if (ok) document.zvlform.wis.value=1; else return false;" />&nbsp;

      </div><!--Button verwijderen -->

      </form>





       <div class="label160">Een organisatie&nbsp;:</div>

      <div class="waarde">

        <form action="edit_partners.php?a_backpage=lijst_partners.php" method="post" name="formulier"><input type="submit" value="Toevoegen">&nbsp;</form>

      </div><!--Button toevoegen -->

<?php

   }

?>





   </fieldset>



<!--  <p>Of bekijk de <a href="lijst_partners2.php">volledige lijst</a> van organisaties.</p>   -->





<fieldset id="info"></fieldset>



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



//---------------------------------------------------------

/* Geen Toegang */ include("../includes/check_access.inc");

//---------------------------------------------------------

?>

