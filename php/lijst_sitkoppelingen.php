<?php



//----------------------------------------------------------

/* Maak Dbconnectie */ require('../includes/dbconnect2.inc');

//----------------------------------------------------------



if(isset($_GET['a_orderby']) ){



	$a_orderby = $_GET['a_orderby'];



}



   $paginanaam="Lijst POPkoppelingen";





   if ( isset($_SESSION["toegang"]) && ($_SESSION["toegang"]=="toegestaan") ){

      

      require("../includes/html_html.inc");



      print("<head>");



      require("../includes/html_head.inc");

      require("../includes/bevestigdel.inc");



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







      print ("<h1>POPkoppelingen</h1>



         <table class=\"klein\">



            <tr>



			   <th><a href=\"lijst_sitkoppelingen.php?a_orderby=l.dlnaam\">Deelgemeente</th>

               <th><a href=\"lijst_sitkoppelingen.php?a_orderby=s.nr\">Nr</th>

               <th><a href=\"lijst_sitkoppelingen.php?a_orderby=s.naam\">POP Naam</th>









		   </tr>

	  ");





		//$a_orderby=(!isset($a_orderby))?"l.dlnaam":$a_orderby;





		if( !isset($a_orderby) ){



			$a_orderby = "l.dlnaam";



		}

		else{

			

			$a_orderby = $a_orderby.", l.dlnaam";

		

		}





      $query = "



		SELECT

			s.naam,

			s.nr,



			l.dlnaam,

			l.sit_id,

			l.id AS lid

		FROM

			sit s,

			gemeente l

		WHERE

			l.sit_id = s.id



		ORDER BY

		".$a_orderby;







      if ( $result=mysql_query($query) ){

         

         $teller = 0;



         for ($i=0; $i < mysql_num_rows ($result); $i++){

            

            $records= mysql_fetch_array($result);



            $veld00 = ($records['naam']!="")?		$records['naam']:"";

            $veld01 = ($records['nr']!="")?			$records['nr']:"";

            $veld02 = ($records['dlnaam']!="")?		$records['dlnaam']:"";

            $veld03 = ($records['sit_id']!="")?		$records['sit_id']:"";

			$veld04 = ($records['lid']!="")?		$records['lid']:"";







		//<td><a href=\"edit_functies.php?a_fnct_id=".$functie_id."\">".$functie_naam."</a></td>



				print("

				<tr>



						<td><a href=\"edit_sitkoppeling.php?a_sit_id=".$veld03."&a_gem_id=".$veld04."\">".$veld02."</td>



						<td>".$veld01."</td>

						<td>".$veld00."</td>







					</tr>

				");



            }// einde for-loop



		print("</table>");



      }



      else{

         

         print ("Er werden geen records gevonden");



		 print(mysql_error());

      }





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

/* Geen Toegang */ require("../includes/check_access.inc");

//---------------------------------------------------------



//---------------------------------------------------------

/* Sluit Dbconnectie */ require("../includes/dbclose.inc");

//---------------------------------------------------------

?>

