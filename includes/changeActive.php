<?php


	function changeActive($id, $backpage, $table ="hulpverleners"){
	/*if( !isset($table) ){

		$table = "hulpverleners";
	
	}*/

	$query2 = "UPDATE
				".$table."
				SET
				actief = 0
				WHERE
				id = ".$id;

    $doe2 = mysql_query($query2);


        if ($doe2){
            
          print("Het item is <b>succesvol op non-actief gezet</b>

				 <script>
				 function redirect()
					{
					document.location = \"".$backpage."\";
					}
				 setTimeout(\"redirect()\",1500);
				 </script>
		   ");
           }

        else{
            
            print("Dit item is <b>niet</b> succesvol op non-actief gezet<br />");

			//print($query2);

        }
	
		
	
	
	}


?>