<?php



//------------------------------------------------------------

/* Maak Dbconnectie */ include('../includes/dbconnect2.inc');

//------------------------------------------------------------





if(isset($_GET['a_funct_id']) ){



	$a_funct_id = $_GET['a_funct_id'];



}

   $paginanaam="Aanpassen van disciplines";





   if (isset($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan") && ($_SESSION['profiel']=="listel")){



      include("../includes/html_html.inc");



      print("<head>");



      include("../includes/html_head.inc");



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







if( isset($_GET['a_fnct_delId']) && isset($_GET['backpage'])  ){



	changeActive($_GET['a_fnct_delId'], $_GET['backpage'], "functies");





}

else{





//------------------------------------------------------------

// Deze pagina kan gebruikt worden om nieuwe hulpverleners aan 

// de tabel HULPVERLENERS toe te voegen of om een bestaande

// record van deze tabel aan te passen. Indien a_hvl_id per

// URL wordt doorgegeven dan moeten de gegevens aangepast

// worden anders wordt er een nieuwe record aangemaakt.

//------------------------------------------------------------



if (!isset($_POST['action'])){



	if ( isset($a_fnct_id) ){

	//------------------------------------------------------------

	// Haal gegevens van hulpverlener op die voldoen

	//------------------------------------------------------------

		

		$action="Aanpassen";



		$query = "

			SELECT

				id,

				naam,

				groep_id,

				rangorde

			FROM

				functies

			WHERE

				id=".$a_fnct_id;



		$result = mysql_query($query);



		if (mysql_num_rows($result)<>0 ){



			//---------------------------------------------

			// een correcte record gevonden

			//---------------------------------------------

				

					$records=			mysql_fetch_array($result);

					$valID=				$records['id'];

					$valNaam=			$records['naam'];

					$valGroep=			$records['groep_id'];

					$valVolgNr=			$records['rangorde'];

		}

		else {

			//--------------------------------------------------

			// foute gegevens, geen record gevonden die voldeed

			//--------------------------------------------------

			print("Geen record gevonden");



      	}



	}// einde IF isset a_fnct_id







	else{

		

		$action = "toevoegen";

		$valID = "";

		$valNaam = "";

		$valGroep = "";

		$valVolgNr = "";



	}



?>



<form action="edit_functies.php" method="post" name="editfunctieform">



   <fieldset>

      <div class="legende">Disciplines aanpassen:</div>



      <div>&nbsp;</div>



      <div class="label220">Naam discipline&nbsp;: </div>



      <div class="waarde">



         <input type="text" size="35" value="<?php print($valNaam)?>" name="fnct_naam" />



      </div>

	  

	  <!--Naam -->

		<div class="label220">Disciplinesgroep&nbsp;: </div>

		<div class="waarde">

			<select size="1" name="fnct_groep_id" />



<?php

//----------------------------------------------------------

// Vul Input select element vanuit dbase

//----------------------------------------------------------



      $query = "

         SELECT

            id,

			naam

         FROM

            functiegroepen

         ORDER BY

            naam";



      if ($result=mysql_query($query))

         {

         for ($i=0; $i < mysql_num_rows($result); $i++)

            {

            $records= mysql_fetch_array($result);





				//$selected = ( $valGroep == $records[0] )?"selected=\"selected\"":""; // DD





				if( $valGroep == $records['id'] ){

				

					$selected = "selected=\"selected\"";

				}



				else{

					$selected = "";

				}



            print ("

               <option value=\"".$records['id']."\" ".$selected.">".$records['naam']."</option>\n");

            }



         }

//----------------------------------------------------------

?>

            </select>

         </div><!--Disciplinesgroep -->



      <div class="label220">Volgnummer discipline&nbsp;: </div>



      <div class="waarde">



         <input type="text" size="35" value="<?php print($valVolgNr)?>" name="fnct_rangorde" />



      </div><!--Volgnummer -->



   </fieldset>





   <fieldset>



      <div class="label220">Deze gegevens</div>



      <div class="waarde">



			<input type="hidden" name="action" value="<?php print($action)?>" />

			<input type="hidden" name="fnct_id" value="<?php print($valID)?>" />



         <input type="submit" value="<?php print($action)?>" />



      </div><!--Button opslaan -->



   </fieldset>

</form>



<?php

	}// einde if !isset($action)





else{

//----------------------------------------------------------

// Record wegschrijven

//----------------------------------------------------------

// Controle of sleutelvars ingegeven zijn voor wegschrijven

//----------------------------------------------------------

   if( isset($_POST['action'])&&( $_POST['action'] == "toevoegen") ){



      $sql = "

         INSERT INTO

         	functies

               (

					naam,

					groep_id,

					rangorde

               )

         VALUES

               (

               '".$_POST['fnct_naam']."',

               ".$_POST['fnct_groep_id'].",

			   ".$_POST['fnct_rangorde']."

		 )";

    }





   else{



		$sql = "

         UPDATE

         	functies

			SET

				naam='".$_POST['fnct_naam']."',

				groep_id=".$_POST['fnct_groep_id'].",

				rangorde=".$_POST['fnct_rangorde']."

			WHERE

				id=".$_POST['fnct_id'];

	}





      if ( $result=mysql_query($sql) ){



			print("Formuliergegevens zijn <b>succesvol ingevoegd</b>");



			print("



				 <script>

				 function redirect()

					{

					document.location = \"lijst_functies.php\";

					}

				 setTimeout(\"redirect()\",500);

				 </script>

			 ");



	  }

      else{



		print("Formuliergegevens zijn <b>niet succesvol ingevoegd</b>,<br />");



		//print(mysql_error());



		//print($sql);



	  }

	



}// einde if OP NON ACTIEF ZETTEN = ja



	}// einde if $_SESSION toegang



		

	



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