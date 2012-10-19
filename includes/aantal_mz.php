<?php 		

//----------------------------------------------------------

// bereken het aantal betrokken mantelzorgers (MZ's)

$qry="

	SELECT

		count(bl.persoon_id)

	FROM

		huidige_betrokkenen bl

	WHERE
    bl.overleggenre = 'gewoon' AND
		bl.patient_code='".$_SESSION['pat_code']."' AND

		bl.genre = 'mantel' AND

                bl.aanwezig=1

		";

$result=mysql_query($qry);

$records=mysql_fetch_array($result);

$aantal_mz=$records[0]; // bereken aantal

//----------------------------------------------------------

?>