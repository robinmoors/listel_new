<?php



//----------------------------------------------------------

/* Maak Dbconnectie */ include('../includes/dbconnect2.inc');

//----------------------------------------------------------



   $paginanaam="Lijst Organisaties";



   if (isset($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan")){

      

      include("../includes/html_html.inc");



      print("<head>");



      include("../includes/html_head.inc");

      include("../includes/bevestigdel.inc");



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



if (!isset($_GET['genre'])) {

   $beperking = "";

}

else switch ($_GET['genre']) {

   case 'ZVL':

     $beperking = " AND genre = 'ZVL' ";

     $info = " met zorgverleners ";

     break;

   case 'HVL':

     $beperking = " AND genre = 'HVL' ";

     $info = " met hulpverleners opgenomen in GDT";

     break;

   case 'XVLP':

     $beperking = " AND genre = 'XVLP' ";

     $info = " met hulpverleners niet opgenomen in GDT";

     break;

   case 'XVLNP':

     $beperking = " AND genre = 'XVLNP' ";

     $info = " met niet-professionelen";

     break;

/*
   case 'rdc':

     $beperking = " AND genre = 'rdc' ";

     $info = " met RDC";

     break;
*/
   case 'GGZ':
     $beperking = " AND ggz = 1 ";
     $info = " GGZ";
     break;
   case 'ART107':
     $beperking = " AND art107 = 1 ";
     $info = " art. 107";
     break;
   case 'mobiele_equipe':
     $beperking = " AND mobiele_equipe = 1 ";
     $info = " mobiele equipe";
     break;
   case '0':
   default:

     $beperking = " AND genre is NULL ";

     $info = " wiens werkingsgebied nog niet bepaald is";

     break;

}



		if (isset($a_partner_id)){

			

/*

			$query="

				 UPDATE

					hulpverleners

					SET

						hvl_partner_id=76

					WHERE

						hvl_partner_id=".$a_partner_id;

*/



			$doe=mysql_query($query);



			$query="

				update

           organisatie

        set

          actief = 0

        WHERE

					id=".$a_partner_id;



			$doe=mysql_query($query);

		} // einde isset $a_partner_id







      print ("<h1>Lijst Organisaties $info</h1>  ");

      



   if($_SESSION["profiel"]=="listel"){



      print("<a href=\"edit_partners.php\">TOEVOEGEN</a><br /><br />");

}



  print("

			 <table class=\"klein\">

				<tr> ");



   if($_SESSION["profiel"]=="listel"){

				print("<th>Wissen</th>");

   }

				print("

					<!-- <th>ok</th> -->

					<th>Naam</th>

			    </tr>

	 ");





      $query = "

			SELECT

         *

			FROM

        organisatie

      where actief = 1  $beperking

			ORDER BY

				naam";

//			WHERE	partner_id<>76 AND partner_id<>73



      if ($result=mysql_query($query))

         {

         $teller = 0;

         for ($i=0; $i < mysql_num_rows ($result); $i++)

            {

            $records= mysql_fetch_array($result);

            $veld00=($records['id']!="")?				$records['id']:"";

            $veld01=($records['naam']!="")?			$records['naam']:"";

            $veld02=($records['adres']!="")?			$records['adres']:"";

            $veld03=($records['gem_id']!="")?			$records['gem_id']:"";

            $veld04=($records['tel']!="")?				$records['tel']:"";

/*

				if (

					$veld01=="" ||

					$veld02=="" ||

					$veld03=="" ||

					$veld04=="")

					{

					$okstring="<input type=\"checkbox\" />";

					}

				else

					{

					$okstring="<input type=\"checkbox\" checked=\"checked\" />";

					}

*/





   if($_SESSION["profiel"]=="listel"){



		print("

            <tr>

               <td style=\"text-align: center;\"><a href=\"lijst_partners.php?a_partner_id=".$veld00."\" onclick=\"return bevestigdel('lijst_partners.php?a_partner_id=".$veld00."')\"><img src='../images/wis.gif' alt='wis' style='border: 0px;'></a></td>

					<!-- <td>".$okstring."</td>  --> ");

  }



     print("

					<td><a href=\"edit_partners.php?a_partner_id=".$veld00."\">".$veld01."</a></td>

				</tr>");

            }

			print("</table>");

         }

      else

         {

         print ("Er werden geen records gevonden");
			   print("</table>");

       }



?>

      <div class="label160">Terug</div>

      <div class="waarde">

         <input type="button" onclick="window.location='lijst_partners.php' "value="naar de zoekfunctie">&nbsp;

       </div>



<?php

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

