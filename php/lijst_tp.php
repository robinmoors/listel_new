<?php
//----------------------------------------------------------
/* Maak Dbconnectie */ include('../includes/dbconnect2.inc');
//----------------------------------------------------------

   $paginanaam="Lijst Therapeutische projecten";

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



/*if (isset($a_mut_id)){

			$query="
				 UPDATE
					Patienten
					SET
						pat_ident_vi =1
					WHERE
						hvl_partner_id=".$a_mut_id;


			$doe=mysql_query($query);



			$query="
				DELETE FROM
					mutualiteiten
				WHERE
					mut_id=".$a_mut_id;


			$doe=mysql_query($query);

 }*/

     if (isset($_GET['verwijder'])) {
       if (mysql_query("update tp_project set actief = 0 where id = {$_GET['verwijder']}")) {
         print("<span style='background-color: #8f8'>Project succesvol verwijderd</span>");
       }
       else {
         print("<span style='background-color: #f88'>Project NIET kunnen verwijderen.</span>");
       }
     }

      print ("<h1>Lijst therapeutische projecten</h1>


            <a href=\"tp_nieuw.php\">TOEVOEGEN</a><br /><br />
				 <table class=\"klein\">
					<tr>
						<th>Wissen</th>
						<!-- <th>ok</th>  -->
					    <th><a href=\"lijst_tp.php?a_order=nummer\">Nr</a></th>
					    <th><a href=\"lijst_tp.php?a_order=naam\">Naam</a></th>
					    <th>Hoofdprojectco&ouml;rdinator</th>
					</tr>
	 ");

        //$a_order=(isset($a_order)&&($a_order!="mut_naam"))?$a_order.",mut_naam":"mut_naam"; // DD
    if (isset($_GET['a_order'])) $a_order = $_GET['a_order'];

		if( isset($a_order) && ($a_order != "nummer") ){
		
			$a_order = $a_order.",nummer";
		}

		else{
			$a_order = "nummer";
		}


      $query = "
            SELECT
                tp_project.id,
                tp_project.naam,
                tp_project.nummer,
                logins.id as login_id,
                logins.naam as login_naam,
                logins.voornaam as login_voornaam
            FROM
                tp_project,
                logins
            WHERE
               logins.profiel = 'hoofdproject'
               AND logins.tp_project = tp_project.id
               AND tp_project.actief <> 0
               AND logins.actief <> 0

         ORDER BY ". 
                $a_order;




      if ($result = mysql_query($query) ){
         
         $teller = 0;

         for ($i=0; $i < mysql_num_rows($result); $i++){
            
            $records= mysql_fetch_array($result);

			//print_r($records);
        print("
            <tr>

               <td style=\"text-align: center;\">
					<a href=\"lijst_tp.php?verwijder={$records['id']}\" onclick=\"return confirm('Bent u zeker dat u TP {$records['nummer']} wil verwijderen?');\"><img src='../images/wis.gif' alt='wis' style='border: 0px;'></a>
			   </td>

               <td>{$records['nummer']}</td>
               <td>{$records['naam']}</td>
               <td><a href=\"edit_overlegcoord.php?a_overlcrd_id={$records['login_id']}&tp=1\">{$records['login_naam']} {$records['login_voornaam']}</a>
               </td>
            </tr>");
            }
            print("</table>");
         }



      else{
         
         print ("Er werden geen records gevonden <br /><br />");
         print(mysql_error());
		 print($query);
         }

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