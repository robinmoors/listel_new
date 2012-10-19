<?php
//----------------------------------------------------------
/* Maak Dbconnectie */ require('../includes/dbconnect2.inc');
//----------------------------------------------------------
   $paginanaam="Lijst verwantschap";
   if (IsSet($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan"))
      {
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



/*if (isset($a_verwsch_id))
	{
	$query="
        UPDATE
         	mantelzorgers
		SET
			verwantschap=1
		WHERE
			verwantschap=".$a_verwsch_id;
	$doe=mysql_query($query);
	$query="
		DELETE FROM
			verwantschap
		WHERE
			id=".$a_verwsch_id;
	$doe=mysql_query($query);
	}*/



      print ("<h1>Lijst Verwantschap van Mantelzorgers</h1>
			<a href=\"edit_verwantschap.php\">TOEVOEGEN</a><br /><br />
         <table class=\"klein\">
            <tr>
					<th>Wissen</th>
					<!-- <th>ok</th> -->
               <th>Naam</th>
               <th>Rangnummer</th>
				</tr>");
      $query = "
			SELECT
				id,
				naam,
				rangorde
			FROM
				verwantschap
			WHERE
				id<>1
			AND
				actief <> 0
         ORDER BY 
				rangorde";

      if ($result=mysql_query($query))
         {
         $teller = 0;
         for ($i=0; $i < mysql_num_rows ($result); $i++)
            {
            $records= mysql_fetch_array($result);
            $veld00=($records['id']!="")?				$records['id']:"";
            $veld01=($records['naam']!="")?			$records['naam']:"";
            $veld02=($records['rangorde']!="")?		$records['rangorde']:"";
/*
				if (
					$veld01=="" ||
					$veld00=="1" ||
					$ved02="")
					{
					$okstring="<input type=\"checkbox\" />";
					}
				else
					{
					$okstring="<input type=\"checkbox\" checked=\"checked\" />";
					}
*/

		print("
            <tr>
               <td style=\"text-align: center;\"><a href=\"edit_verwantschap.php?a_verwsch_delId=".$veld00."&backpage=lijst_verwantschap.php\" onclick=\"return bevestigdel('edit_verwantschap.php?a_verwsch_delId=".$veld00."&backpage=lijst_verwantschap.php')\"><img src='../images/wis.gif' alt='wis' style='border: 0px;'></a></td>
					<!-- <td>".$okstring."</td>  -->
					<td><a href=\"edit_verwantschap.php?a_verwsch_id=".$veld00."\">".$veld01."</a></td>
					<td>".$veld02."</a></td>
				</tr>");
            }
			print("</table>");
         }
      else
         {
         Print ("Er werden geen records gevonden");
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
//---------------------------------------------------------ç
?>
