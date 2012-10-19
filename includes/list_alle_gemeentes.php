<?php
	 /*
   // we gaan nu effe alleen die gemeentes selecteren die bij de huidige sit horen
   if ($_SESSION['bheer_sitnr']=='00') {
      // volledie login, dus alle gemeenten
      $query = "
      SELECT
            gemte_dlzip,gemte_dlnaam,gemte_id
      FROM
            gemeente
        ORDER BY
            gemte_dlzip";
   }
   else {
      $query = "
      SELECT
            gemte_dlzip,gemte_dlnaam,gemte_id
      FROM
            gemeente, sitkoppeling, sit
      where  sitkop_gem_id = gemte_id  and sit_id = sitkop_sit_id
             and  sit_nr =  substring(\"{$_SESSION['bheer_sitnr']}\", 1, 2)
      ORDER BY
            gemte_dlzip";
   }

   print("<script type=\"text/javascript\">");
    if ($result=mysql_query($query))
         {
         print ("var gemeenteList = Array(");
         for ($i=0; $i < mysql_num_rows ($result); $i++)
            {
            $records= mysql_fetch_array($result);
            print ("\"".$records[0]." ".$records[1]."\",\"".$records[2]."\",\n");
            }
         print ("\"9999 onbekend\",\"9999\");");
         }
      print("</script>");
	  */
	  
	  
	  print("<script type=\"text/javascript\">");
	  print ("var gemeenteList = Array(");
	  
			 $result3=mysql_query("SELECT dlzip,dlnaam,id FROM gemeente ORDER BY dlzip");
 					 		for ($i=0; $i < mysql_num_rows ($result3); $i++)
           					{
           			  		$records= mysql_fetch_array($result3);
           			   		print ("\"".$records[0]." ".$records[1]."\",\"".$records[2]."\",\n");
           					}

		print ("\"9999 onbekend\",\"9999\");");
		print("</script>");
      
?>