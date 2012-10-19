<?php

	  print("<script type=\"text/javascript\">");
	  print ("var gemeenteList = Array(");

	  // als groep nie 1 is, moet er een beperking komen op de weergegeven gemeenten
		if($_SESSION["profiel"]=="OC"){
      $gemeenteQuery = "select dlzip, dlnaam, gemeente.id from gemeente, logins
                           where logins.overleg_gemeente = gemeente.zip
                           and logins.id = {$_SESSION['usersid']} and logins.profiel = 'OC' and logins.actief = 1
                        order by dlzip";
     $result= mysql_query($gemeenteQuery);
  		for ($i=0; $i < mysql_num_rows ($result); $i++)
 			{
 	  		$records= mysql_fetch_array($result);
 	   		print ("\"".$records[0]." ".$records[1]."\",\"".$records[2]."\",\n");
 			}
		}
/*
		else if($_SESSION["profiel"]=="rdc"){
      $komtVoorQry = "select organisatie from werkingsgebied where organisatie = {$_SESSION['organisatie']}";
      $komtVoorResult = mysql_query($komtVoorQry) or die("kan werkingsgebied niet bepalen");
      if (mysql_num_rows($komtVoorResult)==0) {
        // geen beperking en dus heel Limburg
        $gemeenteQuery = "SELECT dlzip,dlnaam,id FROM gemeente ORDER BY dlzip";
      }
      else {
        // neem alleen de gemeentes uit het werkingsgebied
        $gemeenteQuery = "select dlzip, dlnaam, gemeente.id from gemeente, werkingsgebied wg
                           where wg.gemeente = gemeente.zip
                             and wg.organisatie = {$_SESSION['organisatie']} order by dlzip";
      }
     $result= mysql_query($gemeenteQuery);
  		for ($i=0; $i < mysql_num_rows ($result); $i++)
 			{
 	  		$records= mysql_fetch_array($result);
 	   		print ("\"".$records[0]." ".$records[1]."\",\"".$records[2]."\",\n");
 			}
		}
*/
		else  {
			 $result3=mysql_query("SELECT dlzip,dlnaam,id FROM gemeente ORDER BY dlzip");
 			 for ($i=0; $i < mysql_num_rows ($result3); $i++) {
	  		 $records= mysql_fetch_array($result3);
	   		 print ("\"".$records[0]." ".$records[1]."\",\"".$records[2]."\",\n");
		   }
		}


		print ("\"9999 onbekend\",\"9999\");");

		print("</script>");

      

?>