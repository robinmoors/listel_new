<?php



//----------------------------------------------------------

/* Maak Dbconnectie */ require('../includes/dbconnect2.inc');

//----------------------------------------------------------



$paginanaam="Lijst Anderen";



if ( isset($_SESSION["toegang"]) && ($_SESSION["toegang"]=="toegestaan") ){

    

    require("../includes/html_html.inc");



    print("<head>");



    require("../includes/html_head.inc");

    require("../includes/bevestigdel.inc");



if ($_GET['genre']=='xvlp') {

  $orgJoin = " left join organisatie on h.organisatie = organisatie.id ";

  $orgVW = " organisatie.genre = 'XVLP' AND ";

  $titel = "Professionele hulpverleners niet-GDT";

   $beperkingAmp = "&genre=xvlp";

   $beperkingQ = "?genre=xvlp";

}

else if ($_GET['genre']=='xvlnp') {

  $orgJoin = " left join organisatie on h.organisatie = organisatie.id ";

  $orgVW = " organisatie.genre = 'XVLNP' AND ";

  $titel = "Niet-professionelen";

   $beperkingAmp = "&genre=xvlnp";

   $beperkingQ = "?genre=xvlnp";

}

else {

  $titel = "XVL";

}



    print("<script type=\"text/javascript\">");





//----------------------------------------------------------

// AndereLijst opvullen



    $query = "

         SELECT

            h.id,

            h.naam,

            h.voornaam,

            f.naam

         FROM

            functies f,

            hulpverleners h

            $orgJoin

         WHERE

            $orgVW

            h.fnct_id = f.id

	     AND

			 h.actief <> 0

         ORDER BY

            h.naam, h.voornaam";

/* geschrapt

            (f.groep_id = 3 OR

                f.groep_id = 4)

		 AND

*/

      if ($result=mysql_query($query)){

        print ("var zvlHash = Array();//zvlHash init voor ongevulde letters \n");

        $zoek1 = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";

        for ($i=0; $i < 26; $i++) {

          $letter = substr($zoek1, 0, 1);

          print("zvlHash['$letter'] = 0;\n");

          $zoek1 = substr($zoek1,1);

        }

        $zoek = "BCDEFGHIJKLMNOPQRSTUVWXYZ_";

        $letter = "A";



			 print ("var andereList = Array(");

			 for ($i=0; $i < mysql_num_rows ($result); $i++){

				

				$records= mysql_fetch_array($result);

				print ("\"".$records[1]." ".$records[2]."  -  ".$records[3]."\",\"".$records[0]."\",\n");

           if ($letter==substr($records['naam'],0,1)) {

              $hash .= "zvlHash['$letter'] = $i;\n";

              $letter = substr($zoek,0,1);

              $zoek = substr($zoek,1);

           }



			  }

			 print ("\"9999 onbekend\",\"9999\");");

        print ($hash);



      } 

//----------------------------------------------------------



    print("</script>");

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

    print ("<h1>Lijst $titel</h1>")



// --------------------------------------------------------

// Snelkeuze form



?>



   <fieldset>

      <div class="legende"><?= $titel ?></div>

      <div>&nbsp;</div>





        <div class="inputItem" id="IIAndereSoort">





         <div class="label160">Naam&nbsp;: </div>



         <div class="waarde">

		 

			<form autocomplete="off" action="edit_verlener.php?a_backpage=lijst_anderen.php" method="post" name="andereform">



				<input class="invoer" onKeyUp="refreshListHash('andereform','IIAndere','hvl_id',1,'IIAndereS',andereList,50,zvlHash)" onmouseUp="showCombo('IIAndereS',100)" onfocus="showCombo('IIAndereS',100)" type="text" name="IIAndere" value="">



				<input type="button" onClick="resetList('andereform','IIAndere','hvl_id',1,'IIAndereS',andereList,50,100)" value="<<">



         </div>

      </div>





      <div class="inputItem" id="IIAndereS">



         <div class="label160">Kies eventueel&nbsp;:</div>



         <div class="waarde">



            <select class="invoer" onClick="handleSelectClick('andereform','IIAndere','hvl_id',1,'IIAndereS')" name="hvl_id" size="5">

            </select>



         </div> 



      </div> <!--Naam Andere -->







        <div class="label160">Deze persoon&nbsp;:</div>

      <div class="waarde">

        <input type="hidden" name="a_backpage" value="lijst_anderen.php<?= $beperkingQ ?>" />

         <input type="submit" value="Aanpassen" onClick="document.andereform.wis.value=0" >&nbsp;

      </div><!--Button aanpassen -->





        <div class="label160">Deze persoon&nbsp;:</div>

      <div class="waarde">

        <input type="hidden" name="wis" value="0" />

        <input type="submit" value="Op non-actief zetten" onClick="var ok = confirm('Ben je zeker dat je op non-actief wil zetten?');if (ok) document.andereform.wis.value=1; else return false;" />&nbsp;

		

		</form>



      </div><!--Button verwijderen -->





        <div class="label160">Een nieuwe&nbsp;:</div>

      <div class="waarde">

        <form action="edit_verlener.php?a_backpage=lijst_anderen.php<?= $beperkingQ ?><?= $beperkingAmp ?>" method="post" name="formulier"><input type="submit" value="Toevoegen">&nbsp;</form>

      </div><!--Button toevoegen -->





   </fieldset>



   <fieldset>



   <?php

     if ($_GET['genre']=='xvlp') {

   ?>

       <p>XVLP is de afkorting van <strong>professionele 'andere' hulpverleners</strong>. Deze organisatie overkoepelt sociale diensten van ziekenhuizen en rusthuizen of RVT's, diensten pati&euml;ntenbegeleiding, specialistische artsen (geriaters, psychiaters, cardiologen, neurologen, ...), palliatief deskundigen, psychologen, ergotherapeuten, kinesitherapeuten, verpleegkundigen of verzorgenden van ziekenhuizen en rusthuizen of RVT's, co&ouml;rdinerend geneesheren van rustoorden, ...</p>

       <p>XVLP-ers worden <strong>niet</strong> vergoed bij een GDT, maar w&eacute;l bij een therapeutisch project, en dit via een gepoolde pot via GDT LISTEL vzw. Slechts 1 persoon per organisatie wordt vergoed.

       <!--<br/>De zelfstandige hulpverleners met een eigen rekening vallen ook onder deze regeling.--></p>

       <p>In tegenstelling tot vroeger moet nu ook voor deze organisaties een convenant met rekening nummer ondertekend worden, omdat ook deze mensen voor een overleg van een therapeutisch project een vergoeding krijgen.</p>



   <?php

     }

   ?>

   <?php

     if ($_GET['genre']=='xvlnp') {

   ?>

       <p>XVLNP is de afkorting van <strong>niet-professionele 'andere' hulpverleners</strong>. Deze organisatie overkoepelt (o.a.) vrijwilligers van niet-erkende oppas- en gezelschapsdiensten,

          maar ook professionelen die niet werkzaam zijn in de Gezondheids- of Welzijnssector.<br/> In de praktijk: commerci&euml;le instellingen zoals interim kantoren, advocaten, niet-erkende gezelschapsdiensten.</p>

       <p>XVLNP-ers worden <strong>nooit</strong> vergoed, daarom sluiten zij geen convenant af.</p>

   <?php

     }

   ?>







   </fieldset>



		<script type="text/javascript">

			hideCombo('IIAndereS');

		</script>



<?php

// --------------------------------------------------------



// --------------------------------------------------------

// Opbouw van de lijst van andere hulpverleners



	if ( isset($a_hvl_id) ){

		

		$query="

			DELETE FROM

				ht_hvl_zp

			WHERE

				ht_hvl_id=".$a_hvl_id;



		$doe=mysql_query($query);



		$query="

			DELETE FROM

				hulpverleners

			WHERE

				id=".$a_hvl_id;



		$doe=mysql_query($query);



	}



/* listel zag liefst de lijst niet meer afgedrukt, maar wanneer ze dit terug willen, gewoon 3x uit commentaar halen

      print ("<table class=\"klein\">

            <tr>

                    <th>WIS</th>

                    <th>ok</th>

               <th><a href=\"lijst_anderen.php?a_order=hvl_naam\">Naam</a></th>

                    <th><a href=\"lijst_anderen.php?a_order=hvl_fnct_id\">Beroep</th>

                    <th><a href=\"lijst_anderen.php?a_order=hvl_part_id\">Organisatie</th>

                </tr>");



        $a_order=(isset($a_order)&&($a_order!="h.naam"))?$a_order.",h.naam":"h.naam";

      $query = "

            SELECT

                h.id,

                h.naam,

                h.voornaam,

                h.adres,

                h.fnct_id,

                h.tel,

                h.adres,

                h.gem_id,

                h.email,

                h.reknr,
                h.iban,
                h.bic,

                h.convenant,

                h.riziv1,

                h.id,

                g.dlnaam,

                g.dlzip,

                f.naam,

                fg.groep_naam,

                fg.groep_id,

                p.naam,

                p.id

            FROM

                hulpverleners h,

                functies f,

                functiegroepen fg,

                partners p,

                gemeente g

            WHERE

                h.fnct_id = f.id AND 

                h.gem_id = g.id AND 

                f.groep_id = fg.fnct_groep_id AND 

                (f.groep_id = 3 OR 

                f.groep_id = 4) AND

                h.part_id=p.partner_id

         ORDER BY "

            .$a_order;



      if ($result=mysql_query($query))

         {

         $teller = 0;

         for ($i=0; $i < mysql_num_rows ($result); $i++)

            {

            $records= mysql_fetch_array($result);

            $teller++;

            $veld00=($records['id']!="")?           $records['id']:"";

            $veld01=($records['naam']!="")?         $records['naam']:"";

            $veld02=($records['voornaam']!="")? $records['voornaam']:"";

            $veld03=($records['adres']!="")?        $records['adres']:"";

            $veld04=($records['fnct_id']!="")?      $records['fnct_id']:"";

            $veld05=($records['tel']!="")?          $records['tel']:"";

            $veld07=($records['gem_id']!="")?       $records['gem_id']:"";

            $veld08=($records['email']!="")?        $records['email']:"";

            $veld09=($records['iban']!="")?        "{$records['reknr']}<br/>\nIBAN {$records['iban']}\n<br/>BIC {$records['bic']}":"";

            $veld10=($records['convenant']!="")?    $records['convenant']:"";

            $veld11=($records['riziv1']!="")?       $records['riziv1']:"";

            $veld12=($records['part_id']!="")?      $records['part_id']:"";

            $veld13=($records['dlnaam']!="")? $records['dlnaam']:"";

            $veld14=($records['dlzip']!="")?      $records['dlzip']:"";

            $veld15=($records['naam']!="")?        $records['naam']:"";

            $veld16=($records['groep_naam']!="")?$records['groep_naam']:"";

            $veld17=($records['groep_id']!="")?    $records['groep_id']:"";

            $veld18=($records['naam']!="")? $records['naam']:"";

            $veld19=($records['id']!="")?       $records['id']:"";

                

                if (

                    $veld01=="" ||

                    $veld02=="" ||

                    $veld03=="" ||

                    $veld04=="" ||

                    $veld05=="" ||

                    $veld07=="9999" ||

                    $veld07=="0" ||

                    $veld11=="" ||

                    $veld19=="76" ||

                    $veld12=="")

                    {

                    $okstring="<input type=\"checkbox\" />";

                    }

                else

                    {

                    $okstring="<input type=\"checkbox\" checked=\"checked\" />";

                    }

 listel zag liefst de lijst niet meer afgedrukt, maar wanneer ze dit terug willen, gewoon 3x uit commentaar halen

        print("

            <tr>

               <td><a href=\"lijst_anderen.php?a_hvl_id=".$veld00."\" onMouseUp=\"bevestigdel('lijst_anderen.php?a_hvl_id=".$veld00."')\">wis</a></td>

                    <td>".$okstring."</td>

                    <td><a href=\"edit_verlener.php?a_hvl_id=".$veld00."&a_backpage=lijst_anderen.php\">".$veld01." ".$veld02."</a><br />".$veld03."</td>

                    <td>".$veld15."</td>

                    <td>".$veld18."</td>

                </tr>");



            }



            print("</table>");



         }

      else{

         

         print ("Er werden geen records gevonden");

         }*/

//---------------------------------------------------------





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

/* Sluit Dbconnectie */ require("../includes/dbclose.inc");

//---------------------------------------------------------



//---------------------------------------------------------

/* Geen Toegang */ require("../includes/check_access.inc");

//---------------------------------------------------------

?>