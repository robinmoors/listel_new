<?php
//----------------------------------------------------------
/* Maak Dbconnectie */ require('../includes/dbconnect2.inc');
//----------------------------------------------------------


   $paginanaam="Lijst mogelijke burgerlijke staten";

   if ( isset($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan") ){
      
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


/*if ( isset($a_burgstaat_id) ){
    
    $query="
         UPDATE
            patienten
            SET
                pat_burgstaat_id=1
            WHERE
                pat_burgstaat_id=".$a_burgstaat_id;
    $doe=mysql_query($query);


    $query="
        DELETE FROM
            burgstaat
        WHERE
            burgstaat_id=".$a_burgstaat_id;


    $doe=mysql_query($query);

}// einde if isset $a_burgstaat_id*/


      print ("<h1>Lijst burgerlijke staat</h1>
            <a href=\"edit_burgstaat.php\">TOEVOEGEN</a><br /><br />

			<table class=\"klein\">
            <tr>
                    <th>Wissen</th>
                    <!-- <th>ok</th> -->
					<th>Omschrijving</a></th>
             </tr>");


      $query = "
            SELECT
                id,
                omschr
            FROM
                burgstaat
            WHERE
                id<>1
			AND
				actief <> 0
         ORDER BY 
                omschr";



      if ($result=mysql_query($query)){
         
         $teller = 0;
         for ($i=0; $i < mysql_num_rows ($result); $i++){
            
            $records= mysql_fetch_array($result);
 
            //$veld00=($records['burgstaat_id']!="")?             $records['burgstaat_id']:"";			// DD
            //$veld01=($records['burgstaat_omschr']!="")?         $records['burgstaat_omschr']:"";		// DD


			if( $records['id'] != ""){
				
				$veld00 = $records['id'];
			
			}

			else{
				$veld00 = "";
			}

				if( $records['omschr'] != ""){
					
					$veld01 = $records['omschr'];
				
				}

				else{
					$veld01 = "";
				}


         /*
                if ($veld01=="" || $veld00=="1"){
                    
                    $okstring="<input type=\"checkbox\" />";

                }
                else{
                    
                    $okstring="<input type=\"checkbox\" checked=\"checked\" />";

                }
        */


        print("
            <tr>

               <td style=\"text-align: center;\">
					<a href=\"edit_burgstaat.php?a_burgstaat_delId=".$veld00."&backpage=lijst_burgstaat.php\" onclick=\"return bevestigdel('edit_burgstaat.php?a_burgstaat_delId=".$veld00."&backpage=lijst_burgstaat.php')\"><img src='../images/wis.gif' alt='wis' style='border: 0px;'></a>
			   </td>

              <!--  <td>".$okstring."</td>   -->

               <td><a href=\"edit_burgstaat.php?a_burgstaat_id=".$veld00."\">".$veld01."</a></td>

            </tr>
		");

            }

            print("</table>");
         }// einde if $result bestaat

      else{
         
         Print ("Er werden geen records gevonden");
         }
//---------------------------------------------------------
/* Sluit Dbconnectie */ require("../includes/dbclose.inc");
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
/* Geen Toegang */ require("../includes/check_access.inc");
//---------------------------------------------------------
?>