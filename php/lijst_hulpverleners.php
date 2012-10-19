<?php



//----------------------------------------------------------

/* Maak Dbconnectie */ require('../includes/dbconnect2.inc');

//----------------------------------------------------------



$paginanaam="Lijst hulpverleners";





if ( isset($_SESSION["toegang"]) && ($_SESSION["toegang"] == "toegestaan") ){

    

    include("../includes/html_html.inc");



    print("<head>");



    include("../includes/html_head.inc");

    include("../includes/bevestigdel.inc");



    print("<script type=\"text/javascript\">");



    //----------------------------------------------------------

    // HulpverlenersLijst opvullen





    $query = "

         SELECT

            h.id,

            h.naam,

            h.voornaam,

            f.naam

         FROM

            hulpverleners h,

            organisatie o,

            functies f

         WHERE

            o.id = h.organisatie AND

            o.genre = 'HVL' AND

            h.fnct_id = f.id

		 AND

			h.actief <> 0

         ORDER BY

            h.naam, h.voornaam;";





    if ( $result = mysql_query($query) ){

         

        print ("var zvlHash = Array();//zvlHash init voor ongevulde letters \n");

        $zoek1 = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";

        for ($i=0; $i < 26; $i++) {

          $letter = substr($zoek1, 0, 1);

          print("zvlHash['$letter'] = 0;\n");

          $zoek1 = substr($zoek1,1);

        }

        $zoek = "BCDEFGHIJKLMNOPQRSTUVWXYZ_";

        $letter = "A";





         print ("var hvlList = Array(");



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



    print("function hide(){

            document.getElementById('IIHvlS').style.display=\"none\";}");





    print("</script>");

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

    print ("<h1>Lijst hulpverleners</h1>")



// --------------------------------------------------------

// Snelkeuze form

?>



   <fieldset>



      <div class="legende">Hulpverleners</div>



      <div>&nbsp;</div>



      <div class="inputItem" id="IIHulpverlener">



         <div class="label160">Naam hulpverlener&nbsp;: </div>



         <div class="waarde">

		 

		 <form autocomplete="off" action="edit_verlener.php?a_backpage=lijst_hulpverleners.php" method="post" name="hvlform">



						<input class="invoer" 

							onKeyUp="refreshListHash('hvlform','IIHvl','hvl_id',1,'IIHvlS',hvlList,999,zvlHash)"

							onmouseUp="showCombo('IIHvlS',100)" 

							onfocus="showCombo('IIHvlS',100)" 

							type="text" name="IIHvl" value=""

						/>





						<input type="button" onClick="resetList('hvlform','IIHvl','hvl_id',1,'IIHvlS',hvlList,999,100)" value="<<" />





					 </div>



				  </div>





				  <div class="inputItem" id="IIHvlS">



					 <div class="label160">Kies eventueel&nbsp;:</div>



					 <div class="waarde">



						<select class="invoer" onClick="handleSelectClick('hvlform','IIHvl','hvl_id',1,'IIHvlS')" name="hvl_id" size="5">



						</select>



					 </div>



				  </div><!--Naam hulpverlener -->







				  <div class="label160">Deze hulpverlener&nbsp;:</div>



				  <div class="waarde">



					 <input type="hidden" name="a_backpage" value="lijst_hulpverleners.php" />

					 <input type="submit" value="Aanpassen" onClick="document.hvlform.wis.value=0" >&nbsp;



				   </div><!--Button aanpassen -->





				   <div class="label160">Deze hulpverlener&nbsp;:</div>



				  <div class="waarde">



					<input type="hidden" name="wis" value="0" />



					<input type="submit" value="Op non-actief zetten" 

						onClick="var ok = confirm('Ben je zeker dat je op non-actief wilt zetten?');if (ok) document.hvlform.wis.value=1; else return false;" 

					/>&nbsp;

		

		</form>





      </div><!--Button verwijderen -->





      <div class="label160">Een hulpverlener&nbsp;:</div>





      <div class="waarde">



        <form action="edit_verlener.php?a_backpage=lijst_hulpverleners.php" method="post" name="formulier">



			<input type="submit" value="Toevoegen">&nbsp;</form>



		  </div><!--Button toevoegen -->



	   </fieldset>

      <fieldset>

         <p>HVL is de afkorting van <strong>hulpverleners opgenomen in GDT</strong>. Deze organisatie overkoepelt dan ook psychologen, psychotherapeuten, ergotherapeuten, maatschappelijk werkers, deskundigen van een dienst voor gezinszorg en deskundigen van een uitleendienst, vertegenwoordigd in of een overeenkomst hebbende met een ge&iuml;ntegreerde dienst voor thuisverzorging.<br/>In de praktijk: maatschappelijk werkers, verantwoordelijken van een dienst voor gezinszorg, verzorgenden, poetshulpen, thuisbegeleiders, di&euml;tisten, ergotherapeuten, orthopedagogen, psychologen, psychotherapeuten actief binnen de 1ste lijn, ...</p>

         <p>HVL-ers werken in de regel onder een organisatie en worden zowel bij een GDT als bij een therapeutisch project vergoed via een gepoolde pot via GDT LISTEL vzw. Slechts 1 persoon per organisatie wordt vergoed.<br/>De zelfstandige hulpverleners met een eigen rekening vallen ook onder deze regeling. HVL-ers worden vertegenwoordigd voor uitbetaling door het RIZIV-nummer van GDT Listel vzw, daarom sluit hun organisatie , of zijzelf indien ze zelfstandig werken, een convenant af met GDT Listel vzw.</p>

      </fieldset>





		</form>





<script type="text/javascript">

    hideCombo('IIHvlS');

</script>









<?php

// --------------------------------------------------------





/*if (isset($a_hvl_id)){

    

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

            hvl_id=".$a_hvl_id;



    $doe=mysql_query($query);





}*/





/*     print ("



	           <div style=\"clear: both;\"></div><br /><br />





            <a href=\"edit_verlener.php?a_backpage=lijst_hulpverleners.php\">TOEVOEGEN</a><br /><br />







         <table class=\"klein\">

            <tr>

                    <th>WIS</th>

                    <th>ok</th>

               <th><a href=\"lijst_hulpverleners.php?a_order=hvl_naam\">Naam</a></th>

                    <th><a href=\"lijst_hulpverleners.php?a_order=hvl_fnct_id\">Beroep</th>

                </tr>");







        //$a_order=(isset($a_order)&&($a_order!="h.hvl_naam"))?$a_order.",h.hvl_naam":"h.hvl_naam"; // DD





			if( isset( $a_order ) && ( $a_order != "h.naam" ) ){

			

				$a_order = $a_order . ",h.naam";

			

			}

			else{

				

				$a_order = "h.naam";

			

			}



      $query = "

            SELECT

                h.id AS hid,

                h.naam AS hnaam,

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



                g.dlnaam,

                g.dlzip,



                f.naam AS fnaam,

                fg.naam AS fgnaam,

                fg.id AS fgid



            FROM

                hulpverleners h,

                functies f,

                functiegroepen fg,

                gemeente g



            WHERE

                h.fnct_id = f.id AND 

                h.gem_id = g.id AND 

                f.groep_id = fg.id AND 

                (f.groep_id = 1 OR 

                f.groep_id = 4)



         ORDER BY "

            .$a_order."

			

		 LIMIT 0,30";



			//print($query);



      if ($result=mysql_query($query)){

         

         $teller = 0;



         for ($i=0; $i < mysql_num_rows ($result); $i++){

            

            $records= mysql_fetch_array($result);

            $teller++;



            $veld00=($records['hid']!="")?          $records['hid']:"";

            $veld01=($records['hnaam']!="")?        $records['hnaam']:"";

            $veld02=($records['voornaam']!="")?		$records['voornaam']:"";

            $veld03=($records['adres']!="")?        $records['adres']:"";

            $veld04=($records['fnct_id']!="")?      $records['fnct_id']:"";

            $veld05=($records['tel']!="")?          $records['tel']:"";

            $veld07=($records['gem_id']!="")?       $records['gem_id']:"";

            $veld08=($records['email']!="")?        $records['email']:"";

            $veld09=($records['iban']!="")?        "{$records['reknr']}<br/>\nIBAN {$records['iban']}\n<br/>BIC {$records['bic']}":"";

            $veld10=($records['convenant']!="")?    $records['convenant']:"";

            $veld11=($records['riziv1']!="")?       $records['riziv1']:"";

            $veld13=($records['dlnaam']!="")?		$records['dlnaam']:"";

            $veld14=($records['dlzip']!="")?        $records['dlzip']:"";

            $veld15=($records['fnaam']!="")?        $records['fnaam']:"";

            $veld16=($records['fgnaam']!="")?		$records['fgnaam']:"";

            $veld17=($records['fgid']!="")?			$records['fgid']:"";

                

                if ($veld01=="" || $veld02=="" || $veld03=="" || $veld04=="" || $veld05=="" || $veld07=="9999" || $veld07=="0" || $veld11==""){

                    

                    $okstring="<input type=\"checkbox\" />";



                }

                else{

                    

                    $okstring="<input type=\"checkbox\" checked=\"checked\" />";



                }



        print("

            <tr>

               <td><a href=\"lijst_hulpverleners.php?a_hvl_id=".$veld00."\" onMouseUp=\"bevestigdel('lijst_hulpverleners.php?a_hvl_id=".$veld00."')\">wis</a></td>

                    <td>".$okstring."</td>

                    <td><a href=\"edit_verlener.php?a_hvl_id=".$veld00."&a_backpage=lijst_hulpverleners.php\">".$veld01." ".$veld02."</a><br />".$veld03." ".$veld13."</td>

                    <td>".$veld15."</td>

                    <td>".$veld."</td>

                </tr>");















            }  // einde for-loop





           print("</table>");





         }

      else{

         

         print ("Er werden geen records gevonden");



      }*/



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

/* Sluit Dbconnectie */ require("../includes/dbclose.inc");

//---------------------------------------------------------





//---------------------------------------------------------

/* Geen Toegang */ require("../includes/check_access.inc");

//---------------------------------------------------------

?>