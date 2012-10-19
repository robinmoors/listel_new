<?php

if ($mutOnbepaald == "NIET") {
  $voorwaarde = " WHERE nr > 0 AND actief = 1";
}
else {
  $voorwaarde = "WHERE actief = 1";
}

   print("<script type=\"text/javascript\">");

   $query = "

      SELECT

			nr,naam,id

      FROM

			verzekering
			
    $voorwaarde

		ORDER BY

			nr";

	if ($result=mysql_query($query))

         {

         print ("var mutList = Array(");

         for ($i=0; $i < mysql_num_rows ($result); $i++)

            {

            $records= mysql_fetch_array($result);

            print ("\"".$records[0]." ".$records[1]."\",\"".$records[2]."\",\n");

            }

         print ("\"Mutualiteit onbekend\",\"1\");");

         }

      print("</script>");

?>