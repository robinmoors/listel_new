<?php

//----------------------------------------------------------

/* Maak Dbconnectie */ include('../includes/dbconnect2.inc');

//----------------------------------------------------------



$paginanaam="Lijst zorgverleners";







if ( isset($_SESSION["toegang"]) && ($_SESSION["toegang"]=="toegestaan") ){

    

    include("../includes/html_html.inc");



    print("<head>");



    include("../includes/html_head.inc");

    include("../includes/bevestigdel.inc");



    print("<script type=\"text/javascript\">");



//----------------------------------------------------------

    $query = "

        SELECT

            h.id,

            h.naam,

            h.voornaam,

            f.naam  as f_naam

        FROM

            hulpverleners h,

            functies f,

            organisatie org

        WHERE

            h.organisatie = org.id AND

            org.genre = 'ZVL' AND

            h.fnct_id = f.id

	     AND

			 h.actief <> 0

		AND

			f.actief <> 0

        ORDER BY

             h.naam, h.voornaam;";







        print ("var zvlHash = Array();//zvlHash init voor ongevulde letters \n");

        $zoek1 = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";

        for ($i=0; $i < 26; $i++) {

          $letter = substr($zoek1, 0, 1);

          print("zvlHash['$letter'] = 0;\n");

          $zoek1 = substr($zoek1,1);

        }

        $zoek = "BCDEFGHIJKLMNOPQRSTUVWXYZ_";

        $letter = "A";



        print ("var zvlList = Array(");



      if ($result=mysql_query($query)){

         

         for ($i=0; $i < mysql_num_rows ($result); $i++){

            

				   $records= mysql_fetch_array($result);

				   print ("\"".$records[1]." ".$records[2]."  -  ".$records[3]."\",\"".$records[0]."\",\n");



           if ($letter==substr($records['naam'],0,1)) {

              $hash .= "zvlHash['$letter'] = $i;\n";

              $letter = substr($zoek,0,1);

              $zoek = substr($zoek,1);

           }



          }

      }



		 //else{print(mysql_error());}



        print ("\"9999 onbekend\",\"9999\");\n"); // ZorgverlenersLijst opvullen

        print ($hash);



//----------------------------------------------------------



    print("function hide(){

            document.getElementById('IIZvlS').style.display=\"none\";}");

    print("</script>");

    print("</head>");

    print("<body onload=\"hide()\">");

    print("<div align=\"center\">");

    print("<div class=\"pagina\">");



    include("../includes/header.inc");

    include("../includes/kruimelpad.inc");



    print("<div class=\"contents\">");



    include("../includes/menu.inc");



    print("<div class=\"main\">");

    print("<div class=\"mainblock\">");

    print ("<h1>Lijst zorgverleners</h1>")



// --------------------------------------------------------

// Snelkeuze form



?>

   <fieldset>





      <div class="legende">Zorgverleners</div>



      <div>&nbsp;</div>



      <div class="inputItem" id="IIZorgverlener">



         <div class="label160">Naam zorgverlener&nbsp;: </div>



         <div class="waarde">

		 

		 <form autocomplete="off" action="edit_verlener.php?a_backpage=lijst_zorgverleners.php" method="post" name="zvlform">



            <input class="invoer" onKeyUp="refreshListHash('zvlform','IIZvl','hvl_id',1,'IIZvlS',zvlList,50,zvlHash )" onmouseUp="showCombo('IIZvlS',100)" onfocus="showCombo('IIZvlS',100)" type="text" name="IIZvl" value="" />



            <input type="button" onClick="resetList('zvlform','IIZvl','hvl_id',1,'IIZvlS',zvlList,999,100)" value="<<">



         </div>

      </div>



      <div class="inputItem" id="IIZvlS">



         <div class="label160">Kies eventueel&nbsp;:</div>



         <div class="waarde">



            <select class="invoer" onClick="handleSelectClick('zvlform','IIZvl','hvl_id',1,'IIZvlS')" name="hvl_id" size="5">

            </select>



         </div>



      </div><!--Naam zorgverlener -->







      <div class="label160">Deze zorgverlener&nbsp;:</div>

      <div class="waarde">

         <input type="hidden" name="a_backpage" value="lijst_zorgverleners.php" />

         <input type="submit" value="Aanpassen" onClick="document.zvlform.wis.value=0" >&nbsp;

       </div><!--Button aanpassen -->





       <div class="label160">Deze zorgverlener&nbsp;:</div>

      <div class="waarde">

        <input type="hidden" name="wis" value="0" />

        <input type="submit" value="Op non-actief zetten" onClick="var ok = confirm('Ben je zeker dat je op non-actief wil zetten?');if (ok) document.zvlform.wis.value=1; else return false;" />&nbsp;</form>

      </div><!--Button verwijderen -->





       <div class="label160">Een zorgverlener&nbsp;:</div>

      <div class="waarde">

        <form action="edit_verlener.php?a_backpage=lijst_zorgverleners.php" method="post" name="formulier"><input type="submit" value="Toevoegen">&nbsp;</form>

      </div><!--Button toevoegen -->





   </fieldset>

   <fieldset>

     <p>ZVL is de afkorting van <strong>zorgverleners</strong>.

     Deze organisatie overkoepelt de doctors in de geneeskunde, heelkunde- en verloskunde, de artsen, de licentiaten in de tandheelkunde en de tandartsen, de apothekers, de vroedvrouwen, die wettelijk gemachtigd zijn om hun kunst uit te oefenen;

     de kinesitherapeuten, de verpleegkundigen, de paramedische medewerkers en de ge&iuml;ntegreerde diensten voor thuisverzorging. In de praktijk: huisartsen, apothekers, kinesitherapeuten, thuisverpleegkundigen, logopedisten, ...</p>

     <p>ZVL-ers hebben een eigen RIZIV- en rekeningnummer en worden bij een GDT dan ook rechtstreeks vergoed. Door deze aansluiting bij het RIZIV zijn ze in orde met de regelgeving, dus is het niet (meer) nodig hen een convenant te laten ondertekenen. Voor therapeutische projecten krijgen ze een vergoeding uit een gepoolde pot via GDT LISTEL vzw, zoals alle professionele deelnemers die aan een overleg van een therapeutisch project deelnemen. Slechts 1 persoon per discipline wordt vergoed.

     </p>

   </fieldset>



<?php

// --------------------------------------------------------



// --------------------------------------------------------

// Opbouw van de lijst van zorgverleners







/*if ( isset($a_hvl_id) ){

    

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

}*/









     /*print ("

         <div style=\"clear: both;\"></div><br /><br />

		 

		 <table class=\"klein\">

            <tr>

                    <th>WIS</th>

                    <th>ok</th>

					<th><a href=\"lijst_zorgverleners.php?a_order=h.naam\">Naam</a></th>

                    <th><a href=\"lijst_zorgverleners.php?a_order=h.fnct_id\">Beroep</th>

                </tr>

	");





        $a_order=(isset($a_order)&&($a_order!="h.naam"))?$a_order.",h.naam":"h.naam";



		if(isset($a_order) && ($a_order != "h.naam")){



				$a_order = $a_order.", h.naam";

		

		}

		else{

		

			$a_order = " h.naam";

		

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

                h.riziv2,

                h.riziv3,



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



                (f.groep_id = 2 OR 

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



            $veld00 = ($records['hid']!="")?			$records['hid']:"";

            $veld01 = ($records['hnaam']!="")?			$records['hnaam']:"";

            $veld02 = ($records['voornaam']!="")?		$records['voornaam']:"";

            $veld03 = ($records['adres']!="")?			$records['adres']:"";

            $veld04 = ($records['fnct_id']!="")?		$records['fnct_id']:"";

            $veld05 = ($records['tel']!="")?			$records['tel']:"";

            $veld07 = ($records['gem_id']!="")?			$records['gem_id']:"";

            $veld08 = ($records['email']!="")?			$records['email']:"";

            $veld09=($records['iban']!="")?        "{$records['reknr']}<br/>\nIBAN {$records['iban']}\n<br/>BIC {$records['bic']}":"";

            $veld10 = ($records['convenant']!="")?		$records['convenant']:"";

            $veld11 = ($records['riziv1']!="")?			$records['riziv1']:"";



            $veld13 = ($records['dlnaam']!="")?			$records['dlnaam']:"";

            $veld14 = ($records['dlzip']!="")?			$records['dlzip']:"";



            $veld15 = ($records['fnaam']!="")?			$records['fnaam']:"";

            $veld16 = ($records['fgnaam']!="")?			$records['fgnaam']:"";

            $veld17 = ($records['fgid']!="")?			$records['fgid']:"";

                

                if ($veld01=="" || $veld02=="" || $veld03=="" || $veld04=="" || $veld05=="" || $veld07=="9999" || $veld07=="0" || $veld11==""){

                    

                    $okstring="<input type=\"checkbox\" />";



                }

                else{

                    

                    $okstring="<input type=\"checkbox\" checked=\"checked\" />";

                }



        print("

            <tr>



               <td>

					<a href=\"lijst_zorgverleners.php?a_hvl_id=".$veld00."\" onMouseUp=\"bevestigdel('lijst_zorgverleners.php?a_hvl_id=".$veld00."')\">wis</a>

			   </td>



               <td>".$okstring."</td>



               <td><a href=\"edit_verlener.php?a_hvl_id=".$veld00."&a_backpage=lijst_zorgverleners.php\">".$veld01." ".$veld02."</a><br />".$veld03." ".$veld13."</td>



               <td>".$veld15."</td>



               <td>".$veld18."</td>



            </tr>

		");



            }

            print("</table>");

         }



      else{

         

         Print ("Er werden geen records gevonden");

         }*/

// --------------------------------------------------------







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