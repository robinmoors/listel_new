<?php
//----------------------------------------------------------
/* Maak Dbconnectie */ include('../includes/dbconnect2.inc');
//----------------------------------------------------------

   $paginanaam="Lijst Mutualiteiten";

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


      print ("<h1>Verzekeringsinstellingen</h1>


            <a href=\"edit_mutualiteiten.php\">TOEVOEGEN</a><br /><br />
				 <table class=\"klein\">
					<tr>
						<th>Wissen</th>
						<!-- <th>ok</th>  -->
					    <th>Nr</th>
					    <th>Naam</th>
						<th>Dienst</th>
					</tr>
	 ");

        //$a_order=(isset($a_order)&&($a_order!="mut_naam"))?$a_order.",mut_naam":"mut_naam"; // DD

		if( isset($a_order) && ($a_order != "naam") ){
		
			$a_order = $a_order.",v.naam";
		}

		else{
			$a_order = "v.naam";
		}


      $query = "
            SELECT
                v.id,  
                v.nr,  
                v.naam,  
                v.dienst,  
                v.adres,  
                v.gem_id,  
                v.tel,  
                v.fax,  
                v.gsm,  
                v.email,
                l.dlnaam  
            FROM
                verzekering v,
                gemeente l
            WHERE
                v.id<>1 AND
                v.gem_id = l.id
			AND 
				v.actief <> 0

         ORDER BY ". 
                $a_order;




      if ($result = mysql_query($query) ){
         
         $teller = 0;

         for ($i=0; $i < mysql_num_rows($result); $i++){
            
            $records= mysql_fetch_array($result);

			//print_r($records);



            /*$veld00 = ($records['mut_id']!="")?       $records['mut_id']:"";
            $veld01 = ($records['mut_nr']!="")?       $records['mut_nr']:"";
            $veld02 = ($records['mut_naam']!="")?     $records['mut_naam']:"";
            $veld03 = ($records['mut_dienst']!="")?   $records['mut_dienst']:"";
            $veld04 = ($records['mut_adres']!="")?    $records['mut_adres']:"";
            $veld05 = ($records['mut_gem_id']!="")?   $records['mut_gem_id']:"";
            $veld06 = ($records['mut_tel']!="")?      $records['mut_tel']:"";
            $veld09 = ($records['mut_fax']!="")?      $records['mut_fax']:"";
            $veld10 = ($records['mut_gsm']!="")?      $records['mut_gsm']:"";
            $veld07 = ($records['mut_email']!="")?    $records['mut_email']:"";
            $veld08 = ($records['gemte_dlnaam']!="")? $records['gemte_dlnaam']:"";*/

			$veld00 = ($records['id']!="")?       $records['id']:"";
            $veld01 = ($records['nr']!="")?       $records['nr']:"";
            $veld02 = ($records['naam']!="")?     $records['naam']:"";
            $veld03 = ($records['dienst']!="")?   $records['dienst']:"";
            $veld04 = ($records['adres']!="")?    $records['adres']:"";
            $veld05 = ($records['gem_id']!="")?   $records['gem_id']:"";
            $veld06 = ($records['tel']!="")?      $records['tel']:"";
            $veld09 = ($records['fax']!="")?      $records['fax']:"";
            $veld10 = ($records['gsm']!="")?      $records['gsm']:"";
            $veld07 = ($records['email']!="")?    $records['email']:"";
            $veld08 = ($records['dlnaam']!="")?   $records['dlnaam']:"";



/*
                if ($veld01 == "" || $veld02 == "" || $veld03 == "" || $veld04 == "" || $veld05 == "" || $veld06 == ""){
                    
                    $okstring="<input type=\"checkbox\" />";
                }
                else{
                    
                    $okstring="<input type=\"checkbox\" checked=\"checked\" />";
                }
*/
        print("
            <tr>

               <td style=\"text-align: center;\">
					<a href=\"edit_mutualiteiten.php?a_mut_delId=".$veld00."&backpage=lijst_mutualiteiten.php\" onclick=\"return bevestigdel('edit_mutualiteiten.php?a_mut_delId=".$veld00."&backpage=lijst_mutualiteiten.php')\"><img src='../images/wis.gif' alt='wis' style='border: 0px;'></a>
			   </td>

               <!-- <td>".$okstring."</td> -->
               <td>".$veld01."</td>

               <td><a href=\"edit_mutualiteiten.php?a_mut_id=".$veld00."\">".$veld02."</a></td>

               <td>".$veld03."</td>
               <td>".$veld08."</td>

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