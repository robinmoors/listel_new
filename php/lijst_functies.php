<?php



//----------------------------------------------------------

/* Maak Dbconnectie */ include('../includes/dbconnect2.inc');

//----------------------------------------------------------





   $paginanaam="Lijst Functies";



if(isset($_GET['a_order']) ){



	$a_order = $_GET['a_order'];



}





   if ( isset($_SESSION["toegang"]) && $_SESSION["toegang"]=="toegestaan"){





      include("../includes/html_html.inc");





      print("<head>");





      include("../includes/html_head.inc");

      include("../includes/bevestigdel.inc");


?>
<style type="text/css">
  .mainblock { height: auto;}
</style>
<?php


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





/*if ( isset($_GET['a_fnct_id']) ){



	$query="UPDATE hulpverleners SET fnct_id = 22 WHERE fnct_id = ".$a_fnct_id;



	$doe = mysql_query($query);





	$query="DELETE FROM functies WHERE id=".$a_fnct_id;



	$doe = mysql_query($query);





}// einde isset $a_fnct_id*/

    

	  

	  

	  print ("<h1>Disciplines</h1>



			<a href=\"edit_functies.php\">TOEVOEGEN</a><br /><br />



         <table class=\"klein\">

            <tr>

				<th>Wissen</th>

				<!-- <th>ok</th> -->

				<th><a href=\"lijst_functies.php?a_order=naam\">Naam</a></th>

				<th><a href=\"lijst_functies.php?a_order=groep_id\">ZVL HVL XVL</th>

				<th><a href=\"lijst_functies.php?a_order=rangorde\">Volgorde</th>

			</tr>

				

	 ");



		//$a_order=( isset($_GET['a_order']) ) && ($_GET['a_order']!="f.fnct_naam")) ? $a_order.",f.fnct_naam":"f.fnct_naam";  // DD





		if( isset($a_order) && ($a_order != "f.naam") ){

		

			$a_order = $a_order.",f.naam";

		}



		else{

			$a_order = "f.naam";

		}









      $query = "

			SELECT

				f.id AS fid,

				f.naam AS fnaam,

				f.groep_id,

				fg.id,

				fg.naam,

				f.rangorde

			FROM

				functies f,

				functiegroepen fg

			WHERE

				f.groep_id = fg.id AND

				f.id<>22

			AND

				f.actief <> 0

         ORDER BY "

            .$a_order;







      if ($result = mysql_query($query) ){





         $teller = 0;



         for ($i=0; $i < mysql_num_rows($result); $i++){





            $records= mysql_fetch_array($result);



           /* $veld00 = ( $records['fnct_id'] != "")?				$records['fnct_id']:"";

            $veld01 = ( $records['fnct_naam'] != "")?			$records['fnct_naam']:"";

            $veld02 = ( $records['fnct_groep_naam'] != "")?		$records['fnct_groep_naam']:"";

            $veld03 = ( $records['fnct_rangorde'] != "")?		$records['fnct_rangorde']:"";*/ //DD





//--------------------enkele variabelen declareren





			//print_r($records);





			if( $records['fid'] != "" ){

				$functie_id = $records['fid'];

			}

			else{

				$functie_id = "";

			}



				if( $records['fnaam'] != "" ){

					$functie_naam = $records['fnaam'];

				}

				else{

					$functie_naam = "";

				}



			if( $records['naam'] != "" ){

				$fg_naam = $records['naam'];

			}

			else{

				$fg_naam = "";

			}



				if( $records['rangorde'] != "" ){

					$functie_rangorde = $records['rangorde'];

				}

				else{

					$functie_rangorde = "";

				}









/*

			if ($functie_naam == "" || $fg_naam == "" || $fg_naam == "Onbepaald"){

					

				$okstring="<input type=\"checkbox\" />";



			}



			else{



				$okstring="<input type=\"checkbox\" checked=\"checked\" />";



			}

*/





		print("

				<tr>

					<td style=\"text-align: center;\">

						<a href=\"edit_functies.php?a_fnct_delId=".$functie_id."&backpage=lijst_functies.php\" onclick=\"return bevestigdel('edit_functies.php?a_fnct_delId=".$functie_id."&backpage=lijst_functies.php')\"><img src='../images/wis.gif' alt='wis' style='border: 0px;'></a>

					</td>



					<!-- <td>".$okstring."</td> -->



					<td><a href=\"edit_functies.php?a_fnct_id=".$functie_id."\">".$functie_naam."</a></td>



					<td>".$fg_naam."</td>



					<td>".$functie_rangorde."</td>

				</tr>

		");



       }



		print("</table>");



         }//einde if $result = mysql_query($query) 





      else{



			print("Er werden geen records gevonden");



         }





		  print("</div>");

		  print("</div>");

		  print("</div>");



		  include("../includes/footer.inc");



		  print("</div>");

		  print("</div>");

		  print("</body>");

		  print("</html>");





      }// einde if isset $_SESSION toegang



//---------------------------------------------------------

/* Sluit Dbconnectie */ include("../includes/dbclose.inc");

//---------------------------------------------------------





//---------------------------------------------------------

/* Geen Toegang */ include("../includes/check_access.inc");

//---------------------------------------------------------

?>

