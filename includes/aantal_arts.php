<?php 		

//----------------------------------------------------------

// bereken het aantal betrokken artsen (ZVL fnct_id=1)

$qry="

	SELECT

		count(bl.persoon_id)

	FROM

		huidige_betrokkenen bl,

		hulpverleners h,

		functies f

	WHERE
    bl.overleggenre = 'gewoon' AND
		bl.patient_code='".$_SESSION['pat_code']."' AND

		bl.persoon_id=h.id AND

		bl.genre = 'hulp'  AND

		h.fnct_id=f.id AND

		f.id=1 AND

		bl.aanwezig=1

		";

$result=mysql_query($qry);

$records=mysql_fetch_array($result);

$aantal_arts=$records[0];

//----------------------------------------------------------

?>