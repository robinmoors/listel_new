<?php



//------------------------------------------------------------

/* Maak Dbconnectie */ require("../includes/dbconnect2.inc");

//------------------------------------------------------------







if(isset($_GET['a_burgstaat_id']) ){



	$a_burgstaat_id = $_GET['a_burgstaat_id'];



}



   $paginanaam="Aanpassen of ingeven van de Burgerlijke Stand";



   if (isset($_SESSION["toegang"]) && ($_SESSION["toegang"]=="toegestaan") && ($_SESSION['profiel']=='listel')){

      

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





if( isset($_GET['a_burgstaat_delId']) && isset($_GET['backpage'])  ){



	changeActive($_GET['a_burgstaat_delId'], $_GET['backpage'], "burgstaat");





}

else{







//------------------------------------------------------------ //DD

// Deze pagina kan gebruikt worden om nieuwe hulpverleners aan //DD

// de tabel HULPVERLENERS toe te voegen of om een bestaande	   //DD

// record van deze tabel aan te passen. Indien a_hvl_id per    //DD

// URL wordt doorgegeven dan moeten de gegevens aangepast      //DD

// worden anders wordt er een nieuwe record aangemaakt.        //DD

//------------------------------------------------------------ //DD



if (!isset($_POST['action'])){

	

	if (isset($a_burgstaat_id)){

	//------------------------------------------------------------

	// Haal gegevens van hulpverlener op die voldoen

	//------------------------------------------------------------

		

		$action="Aanpassen";



		$query = "

			SELECT

				id,

				omschr

			FROM

				burgstaat

			WHERE

				id=".$a_burgstaat_id;



		$result = mysql_query($query);



		if (mysql_num_rows($result)<>0 ){

		//---------------------------------------------

		// een correcte record gevonden

		//---------------------------------------------

			

			$records= mysql_fetch_array($result);

			$valID=				$records['id'];

			$valNaam=			$records['omschr'];

		}





			else {

		//--------------------------------------------------

		// foute gegevens, geen record gevonden die voldeed

		//--------------------------------------------------

      	

      			print("Geen record gevonden");

      		}

		}// einde if isset $a_burgstaat_id



	else{

		

		$action="toevoegen";

		$valID="";

		$valNaam="";

	}

?>



<form action="edit_burgstaat.php" method="post" name="editburgstaatform">



   <fieldset>



      <div class="legende">Gegevens burgerlijke stand:</div>



      <div>&nbsp;</div>

      <div class="label220">Omschrijving Burgerlijke Stand&nbsp;: </div>



      <div class="waarde">



         <input type="text" size="35" value="<?php print($valNaam)?>" name="burgstaat_omschr" />



      </div><!--Omschrijving -->



   </fieldset>





   <fieldset>



      <div class="label220">Deze gegevens</div>



      <div class="waarde">

			<input type="hidden" name="action" value="<?php print($action)?>" />

			<input type="hidden" name="burgstaat_id" value="<?php print($valID)?>" />



         <input type="submit" value="<?php print($action)?>" />



      </div><!--Button opslaan -->



   </fieldset>





</form>



<?php

	}// einde if isset $action







else{

	

//----------------------------------------------------------

// Record wegschrijven

//----------------------------------------------------------

// Controle of sleutelvars ingegeven zijn voor wegschrijven

//----------------------------------------------------------



   if( isset($_POST['action']) && ($_POST['action'] == "toevoegen") ){

      

      $sql = "

         INSERT INTO

         	burgstaat

               (omschr)

         VALUES

               ('".$_POST['burgstaat_omschr']."')";

      }



   else{

      

		$sql = "

         UPDATE

         	burgstaat

			SET

				omschr='".$_POST['burgstaat_omschr']."'

			WHERE

				id=".$_POST['burgstaat_id'];

	}



      if ( $result=mysql_query($sql) ){

         

			print("Formuliergegevens zijn <b>succesvol ingevoegd</b>");



			print("

				 <script>

				 function redirect()

					{

					document.location = \"lijst_burgstaat.php\";

					}

				 setTimeout(\"redirect()\",500);

				 </script>

			");

	  }

      else{

         

			print("FormulierGegevens zijn <b>niet succesvol ingevoegd</b>,<br />");



			print($sql);

	}

  }



} //einde if ITEM OP NON ACTIEF ZETTEN = JA



		

		

		

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