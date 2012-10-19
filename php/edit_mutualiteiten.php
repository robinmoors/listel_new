<?php



//------------------------------------------------------------

/* Maak Dbconnectie */ require('../includes/dbconnect2.inc');

//------------------------------------------------------------



   $paginanaam="Gegevens verzekeringsinstelling";


   if ( isset($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan" && $_SESSION['profiel']=="listel") ){


      include("../includes/html_html.inc");



      print("<head>");



      include("../includes/html_head.inc");







//------------------------------------------------------------

// Postcodelijst Opstellen voor javascript

//------------------------------------------------------------



	print("<script type=\"text/javascript\">");



	$query = "

		SELECT

			dlzip, dlnaam, id

		FROM

   gemeente

      ORDER BY

         dlzip";



	if ( $result = mysql_query($query) ){

		

		print ("var gemeenteList = Array(");



		for ($i=0; $i < mysql_num_rows ($result); $i++){

			

			$records= mysql_fetch_array($result);



			print ("\"".$records['dlzip']." ".$records['dlnaam']."\",\"".$records['id']."\",\n");



		}



		print ("\"9999 onbekend\",\"9999\");");



     }



   print("</script>");



//----------------------------------------------------------

// Einde Postcodelijst Opstellen voor javascript

//----------------------------------------------------------



      print("</head>");



      print("<body onload=\"hideCombo('IIPostCodeS')\">");

      print("<div align=\"center\">");

      print("<div class=\"pagina\">");



      include("../includes/header.inc");

      include("../includes/kruimelpad.inc");



      print("<div class=\"contents\">");



      include("../includes/menu.inc");



      print("<div class=\"main\">");

      print("<div class=\"mainblock\">");







if(isset($_GET['a_order']) ){



	$a_order = $_GET['a_order'];



}







if( isset($_GET['a_mut_delId']) && isset($_GET['backpage'])  ){



	changeActive($_GET['a_mut_delId'], $_GET['backpage'], "verzekering");





}

else{



//------------------------------------------------------------ DD

// Deze pagina kan gebruikt worden om nieuwe hulpverleners aan DD

// de tabel HULPVERLENERS toe te voegen of om een bestaande    DD

// record van deze tabel aan te passen. Indien a_hvl_id per    DD

// URL wordt doorgegeven dan moeten de gegevens aangepast      DD

// worden anders wordt er een nieuwe record aangemaakt.        DD

//------------------------------------------------------------ DD



$valGemId = -1;

if (!isset($action))

	{

	if (isset($a_mut_id)){



	//------------------------------------------------------------

	// Haal gegevens van de mutualiteiten op die voldoen

	//------------------------------------------------------------

		

		$action="Aanpassen";



		$query = "

			SELECT

				v.id,  

				v.nr,  

				v.naam,  

				v.dienst,

        v.contact,

				v.adres,  

				v.gem_id,  

				v.tel,  

				v.fax,  

				v.gsm,  

				v.email,

				g.dlnaam,

				g.dlzip  

			FROM

				verzekering v,

				gemeente g

			WHERE

				g.id = v.gem_id AND

				v.id=".$a_mut_id;





		$result = mysql_query($query);



		//print($query);



		if (mysql_num_rows($result)<>0 ){



		//---------------------------------------------

		// een correcte record gevonden

		//---------------------------------------------

			

			$records = mysql_fetch_array($result);

			$valID =			$records['id'];

			$valNR =			$records['nr'];

			$valNaam =			$records['naam'];

			$valDienst =		$records['dienst'];

			$valContact =		$records['contact'];

			$valAdres =			$records['adres'];

      $valGemId = $records['gem_id'];

    	$valGemeente =		$records['dlzip']." ".$records['dlnaam'];

			$valTel =			$records['tel'];

			$valFax =			$records['fax'];

			$valGsm =			$records['gsm'];

			$valEmail =			$records['email'];

		}



		else {

		//--------------------------------------------------

		// foute gegevens, geen record gevonden die voldeed

		//--------------------------------------------------

      	

      		print("Geen record gevonden");

      	}



	}// einde if isset $a_mut_id



	else

		{

		$action="toevoegen";

		$valID="";

		$valNR="";

		$valNaam="";

		$valDienst="";

		$valAdres="";

		$valGemeente="";

		$valTel="";

		$valFax="";

		$valGsm="";

		$valEmail="";

		}

?>



<script language="javascript" src="../includes/formuliervalidatie.js">

</script>



<script language="javascript" type="text/javascript">

var gemeente = <?= $valGemId ?>;

function checkAlles()

	{

	fouten = "";



	fouten = fouten + checkLeeg 	('editmutform', 'mut_nr', 	'- Vul een nummer in');

	fouten = fouten + checkLeeg 	('editmutform', 'mut_naam', 	'- Vul een naam in');

	fouten = fouten + checkLeeg 	('editmutform', 'mut_dienst', 	'- Vul een dienst in');

	fouten = fouten + checkLeeg 	('editmutform', 'mut_adres', 	'- Vul een adres in');

	if (gemeente == -1)

    fouten = fouten + checkLeeg 	('editmutform', 'mut_gem_id', 	'- Vul een postcode in');





	return valideer();

	}

</script>



<form action="edit_mutualiteiten.php" method="post" name="editmutform" onsubmit="return checkAlles();"  autocomplete="off">



   <fieldset>



      <div class="legende">Gegevens Verzekeringsinstelling:</div>

      <div>&nbsp;</div>



      <div class="label220">Nummer<div class="reqfield">*</div>&nbsp;: </div>



      <div class="waarde">



         <input type="text" size="35" value="<?php print($valNR)?>" name="mut_nr" />



      </div><!--Nummer -->





      <div class="label220">Naam<div class="reqfield">*</div>&nbsp;: </div>



      <div class="waarde">



         <input type="text" size="35" value="<?php print($valNaam)?>" name="mut_naam" />



      </div><!--Naam -->





      <div class="label220">Dienst<div class="reqfield">*</div>&nbsp;: </div>



      <div class="waarde">



         <input type="text" size="35" value="<?php print($valDienst)?>" name="mut_dienst" />



      </div><!--Dienst -->



      <div class="label220">Contactpersoon&nbsp;: </div>



      <div class="waarde">



         <input type="text" size="35" value="<?php print($valContact)?>" name="mut_contact" />



      </div><!--Contactpersoon -->



      <div class="label220">Adres<div class="reqfield">*</div>&nbsp;: </div>



      <div class="waarde">



         <input type="text" size="35" value="<?php print($valAdres)?>" name="mut_adres" />



      </div>









      <div class="inputItem" id="IIPostCode">



         <div class="label220">Postcode<div class="reqfield">*</div>&nbsp;: </div>



         <div class="waarde">



            <input

               onKeyUp="refreshList('editmutform','postCodeInput','mut_gem_id',1,'IIPostCodeS',gemeenteList,20)"



               onmouseUp="showCombo('IIPostCodeS',100)"



               onfocus="showCombo('IIPostCodeS',100)"



               type="text"



               name="postCodeInput"



               value="<?php print($valGemeente)?>" />



            <input

               type="button"

               onClick="resetList('editmutform','postCodeInput','mut_gem_id',1,'IIPostCodeS',gemeenteList,20,100)"

               value="<<" 

			/>



         </div>

      </div>

      









      <div class="inputItem" id="IIPostCodeS">



         <div class="label220">Kies eventueel&nbsp;:</div>



         <div class="waarde">



            <select

               onClick="handleSelectClick('editmutform','postCodeInput','mut_gem_id',1,'IIPostCodeS')"

               name="mut_gem_id"

               size="5">

            </select>



         </div>



      </div><!--Adres -->







      <div class="label220">Telefoon&nbsp;: </div>



      <div class="waarde">



         <input type="text" size="35" value="<?php print($valTel)?>" name="mut_tel" />



      </div><!--Telefoon -->





      <div class="label220">Fax&nbsp;: </div>



      <div class="waarde">



         <input type="text" size="35" value="<?php print($valFax)?>" name="mut_fax" />



      </div><!--Fax -->





      <div class="label220">GSM&nbsp;: </div>



      <div class="waarde">



         <input type="text" size="35" value="<?php print($valGsm)?>" name="mut_gsm" />



      </div><!--GSM -->





	  <div class="label220">E-mail&nbsp;: </div>



      <div class="waarde">



         <input type="text" size="35" value="<?php print($valEmail)?>" name="mut_email" />



      </div><!--E-mail -->





   </fieldset>







   <fieldset>



      <div class="label220">Deze gegevens</div>



      <div class="waarde">

			<input type="hidden" name="action" value="<?php print($action)?>" />

			<input type="hidden" name="mut_id" value="<?php print($valID)?>" />



         <input type="submit" value="<?php print($action)?>" />





      </div><!--Button opslaan -->



   </fieldset>





</form>





<?php

	}

	else{

//----------------------------------------------------------

// Record wegschrijven

//----------------------------------------------------------

// Controle of sleutelvars ingegeven zijn voor wegschrijven

//----------------------------------------------------------



   if( isset($_POST['action']) && ($_POST['action']=="toevoegen" )){

      

		//$mut_gem_idstring=(!isset($_POST['mut_gem_id']))?",":",".$_POST['mut_gem_id'].",";   // DD

		//$mut_gem_idfield=(!isset($_POST['mut_gem_id']))?",":",mut_gem_id,";			       // DD





		if( !isset($_POST['mut_gem_id']) ){

			

			$mut_gem_idstring = ",";

		

		}

		else{

			$mut_gem_idstring = ",".$_POST['mut_gem_id'].",";

		}





			if( !isset($_POST['mut_gem_id']) ){

				

				$mut_gem_idfield = ",";

			

			}

			else{

				$mut_gem_idfield = ",gem_id,";

			}







      $sql = "

         INSERT INTO

         	verzekering

               (

					nr,

					naam,

					dienst,

					contact,

					tel,

					fax,

					gsm,

					adres".

					$mut_gem_idfield."

					email

               )

         VALUES

               (

               '".$_POST['mut_nr']."',

               '".$_POST['mut_naam']."',

               '".$_POST['mut_dienst']."',

               '".$_POST['mut_contact']."',

               '".$_POST['mut_tel']."',

               '".$_POST['mut_fax']."',

               '".$_POST['mut_gsm']."',

               '".$_POST['mut_adres']."'

               ".$mut_gem_idstring."

               '".$_POST['mut_email']."')";





      }// einde if action = toevoegen





	  else{

      

			//$mut_gem_idupdate=(!isset($_POST['mut_gem_id']))?",":",mut_gem_id=".$_POST['mut_gem_id'].","; // DD



			if( !isset($_POST['mut_gem_id']) ){

				

				$mut_gem_idupdate = ",";

			

			}



			else{

			

				$mut_gem_idupdate = ",gem_id=".$_POST['mut_gem_id'].",";



			}





			$sql = "

			 UPDATE

				verzekering

				SET

					nr='".$_POST['mut_nr']."',

					naam='".$_POST['mut_naam']."',

					dienst='".$_POST['mut_dienst']."',

					contact='".$_POST['mut_contact']."',

          tel='".$_POST['mut_tel']."',

					fax='".$_POST['mut_fax']."',

					gsm='".$_POST['mut_gsm']."',

					adres='".$_POST['mut_adres']."'

					".$mut_gem_idupdate."

					email='".$_POST['mut_email']."'

				WHERE

					id=".$_POST['mut_id'];



		}// einde else







      if ($result=mysql_query($sql)){

         

			print("Formuliergegevens zijn <b>succesvol ingevoegd</b>");



			print("



         <script>

         function redirect()

            {

            document.location = \"lijst_mutualiteiten.php\";

            }

         setTimeout(\"redirect()\",500);

         </script>");



			}

      else{

         

			print("FormulierGegevens zijn <b>niet succesvol ingevoegd</b>,<br />");



			print($sql);

	  }

	}



}//einde if mut op NON ACTIEF ZETTEN = ja



		



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