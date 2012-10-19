<?php
//------------------------------------------------------------
/* Maak Dbconnectie */ require('../includes/dbconnect2.inc');
//------------------------------------------------------------



if(isset($_GET['a_verwsch_id']) ){

	$a_verwsch_id = $_GET['a_verwsch_id'];

}


   $paginanaam="Aanpassen of ingeven van de verwantschappenlijst";

   if (isset($_SESSION["toegang"]) && ($_SESSION["toegang"]=="toegestaan") )
      {
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



if( isset($_GET['a_verwsch_delId']) && isset($_GET['backpage'])  ){

	changeActive($_GET['a_verwsch_delId'], $_GET['backpage'], "verwantschap");


}
else{


//------------------------------------------------------------
// Deze pagina kan gebruikt worden om nieuwe hulpverleners aan 
// de tabel HULPVERLENERS toe te voegen of om een bestaande
// record van deze tabel aan te passen. Indien a_hvl_id per
// URL wordt doorgegeven dan moeten de gegevens aangepast
// worden anders wordt er een nieuwe record aangemaakt.
//------------------------------------------------------------

if ( !isset($_POST['action'] ) ){
	
	if ( isset($a_verwsch_id) ){
	//------------------------------------------------------------
	// Haal gegevens van hulpverlener op die voldoen
	//------------------------------------------------------------
		
		$action="Aanpassen";
		$query = "
			SELECT
				id,
				naam,
				rangorde
			FROM
				verwantschap
			WHERE
				id=".$a_verwsch_id;


		$result = mysql_query($query);
		if (mysql_num_rows($result)<>0 ){
		//---------------------------------------------
		// een correcte record gevonden
		//---------------------------------------------
			
			$records= mysql_fetch_array($result);
			$valID=				$records['id'];
			$valNaam=			$records['naam'];
			$valRangorde=			$records['rangorde'];

		}

		else {
		//--------------------------------------------------
		// foute gegevens, geen record gevonden die voldeed
		//--------------------------------------------------
      	
      		print("Geen record gevonden");
      	}

	}
	else{
		
		$action="toevoegen";
		$valID="";
		$valNaam="";
		$valRangorde="";

	}
?>

<form action="edit_verwantschap.php" method="post" name="editverwantschapsform">
   <fieldset>


      <div class="legende">Gegevens Verwantschap:</legend>
      <div>&nbsp;</div>
      <div class="label220">Benaming&nbsp;: </div>
      <div class="waarde">
         <input
            type="text"
            size="35"
            value="<?php print($valNaam)?>"
            name="naam" />
      </div><!--Benaming -->


      <div class="label220">Rangorde&nbsp;: </div>
      <div class="waarde">
         <input
            type="text"
            size="35"
            value="<?php print($valRangorde)?>"
            name="rangorde" />
      </div><!--Rangorde -->


	</fieldset>
	<fieldset>
      <div class="label220">Deze gegevens</div>
      <div class="waarde">
			<input type="hidden" name="action" value="<?php print($action)?>" />
			<input type="hidden" name="id" value="<?php print($valID)?>" />
         <input
            type="submit"
            value="<?php print($action)?>" />
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
   if(isset($_POST['action']) && ($_POST['action']=="toevoegen") ){
      
      $sql = "
         INSERT INTO
         	verwantschap
               (naam,rangorde)
         VALUES
               ('".$_POST['naam']."',".$_POST['rangorde'].")";
      
	}

   else{
      
		$sql = "
         UPDATE
         	verwantschap
			SET
				naam='".$_POST['naam']."',
				rangorde='".$_POST['rangorde']."'
			WHERE
				id=".$_POST['id'];

  }



      if ($result=mysql_query($sql)){
         
			print("Formuliergegevens zijn <b>succesvol ingevoegd.</b>");
			print("
				 <script>
				 function redirect()
					{
					document.location = \"lijst_verwantschap.php\";
					}
				 setTimeout(\"redirect()\",500);
				 </script>
			 ");
	   }

      else{

         print("Formuliergegevens zijn <b>niet succesvol ingevoegd</b>,<br>");

		 print($sql);
	  }
   }

		
}// einde if ITEM OP NON ACTIEF = ja	
	

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