<?php

//------------------------------------------------------------

/* Maak Dbconnectie */ require('../includes/dbconnect2.inc');

//------------------------------------------------------------



   $paginanaam="Aanpassen van sitkoppelingen";



if ( isset($_SESSION["toegang"]) && ($_SESSION["toegang"]=="toegestaan") && ($_SESSION['profiel']=="listel") ){

      

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





			if( isset($_GET['a_sit_id']) && isset($_GET['a_sit_id']) ){



				$a_sit_id = $_GET['a_sit_id'];

				$a_gem_id = $_GET['a_gem_id'];



			}// einde if $GET's zijn gezet



	if( isset($_POST['action']) ){

	

		$action = $_POST['action'];

	

	}



if ( !isset($action) ){

	

	if ( isset($a_sit_id) ){





	//------------------------------------------------------------

	// Haal gegevens van hulpverlener op die voldoen

	//------------------------------------------------------------

		

		$action="Aanpassen";



		$query = "

			SELECT

				l.dlnaam,



				s.naam,

				s.id,

				s.nr

			FROM

				gemeente l,

				sit s

			WHERE

				l.id=".$a_gem_id."

			AND 

				s.id =".$a_sit_id;





		$result = mysql_query($query);



		if (mysql_num_rows($result)<>0 ){





		//---------------------------------------------

		// een correcte record gevonden

		//---------------------------------------------

			

				$records = mysql_fetch_array($result);



				$dlNaam = $records['dlnaam'];

				$sitNaam = $records['naam'];

				$sitId = $records['id'];

				$sitNr = $records['nr'];





				//print(" dlNaam : ".$dlNaam." - sitNaam : ".$sitNaam." - sitId : ".$sitId);





		}



		else {



		//--------------------------------------------------

		// foute gegevens, geen record gevonden die voldeed

		//--------------------------------------------------

      	

      		print("Geen record gevonden");





      	}// einde if er een record is



	}



	else{

		

		/*$action="toevoegen";

		$dlNaam = "";

		$sitNaam = "";

		$sitId = "";

		$sitNr = "";*/



		print("Deze pagina kan niet gebruikt worden op deze manier");



	}// einde if $GETS zijn gezet



?>





<form action="edit_sitkoppeling.php" method="post" name="editsitkoppelingform">

   <fieldset>





      <div class="legende">Gegevens POPkoppeling:</legend>

      <div>&nbsp;</div>



      <div class="label220">Gemeentenaam&nbsp;: </div>

      <div class="waarde">



			<?php print($dlNaam)?>



      </div>



		<div class="label220">POP&nbsp;: </div>

			<div class="waarde">



				<select class="invoer" name="sit_id">



					<?php



						$sitQuery = "SELECT * FROM sit";



						$sitResult = mysql_query($sitQuery);





							if (mysql_num_rows($sitResult)<>0 ){





								

								for ($x=0; $x < mysql_num_rows($sitResult); $x++){







									$sitRecords = mysql_fetch_array($sitResult);



									//print($sitRecords['id']." ".$sitRecords['nr']." ".$sitRecords['naam']);



									if( $sitRecords['id'] == $sitId){

										$selected = "selected=\"selected\"";

									}

									else{

										$selected = "";

									}



									print("<option value=".$sitRecords['id']." ".$selected.">".$sitRecords['nr']." ".$sitRecords['naam']."</option>");







								}// einde for-loop

							

							}



							else{



								print("<option value=\"\" ".$selected.">Er is een fout opgetreden</option>");

							

							

							}





					?>



				</select>



			</div>







	</fieldset>





	<fieldset>





      <div class="label220">Deze gegevens&nbsp;:</div>

      <div class="waarde">

			<input type="hidden" name="action" value="<?php print($action)?>" />

			<input type="hidden" name="gem_id" value="<?php print($a_gem_id)?>" />

         <input

            type="submit"

            value="<?php print($action)?>" />

      </div>





   </fieldset>

</form>







<?php



}// einde if !isset $action



else{ // als er wel een $action gezet is





	//----------------------------------------------------------

	// Record wegschrijven

	//----------------------------------------------------------

	// Controle of sleutelvars ingegeven zijn voor wegschrijven

	//----------------------------------------------------------



	if($action == "Aanpassen"){

		

		$sql = "UPDATE

           gemeente

				SET

					sit_id = ".$_POST['sit_id']."

				WHERE

					id =".$_POST['gem_id'];





				if ( $result = mysql_query($sql) ){

				 

					print("Formuliergegevens zijn <b>succesvol ingevoegd</b>");

					print("

						 <script>

						 function redirect()

							{

							document.location = \"lijst_sitkoppelingen.php\";

							}

						 setTimeout(\"redirect()\",500);

						 </script>

					 ");

			   }



			  else{



				 print("FormulierGegevens zijn <b>niet succesvol ingevoegd</b>,<br>");



				 print($sql);



			  }// einde als het gelukt is

					

	

	}



	else{ // fout



		print("Er is een fout opgetreden - action kan niets anders dan aanpassen zijn");

	

	

	

	}



}



      print("</div>");

      print("</div>");

      print("</div>");



      require("../includes/footer.inc");



      print("</div>");

      print("</div>");

      print("</body>");

      print("</html>");



 }// einde if toegang = toegestaan



//---------------------------------------------------------

/* Sluit Dbconnectie */ require("../includes/dbclose.inc");

//---------------------------------------------------------



//---------------------------------------------------------

/* Geen Toegang */ require("../includes/check_access.inc");

//---------------------------------------------------------

?>