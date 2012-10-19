<?php 		

//----------------------------------------------------------

// bereken het aantal betrokken hulpverleners (XVL)

$qry="

	SELECT

		count(bl.persoon_id)

	FROM

		huidige_betrokkenen bl,

		hulpverleners h left join organisatie o on (h.organisatie = o.id),

		functies f,

		functiegroepen fg

	WHERE
    bl.overleggenre = 'gewoon' AND
		bl.patient_code='".$_SESSION['pat_code']."' AND

                bl.genre = 'hulp' AND

                bl.persoon_id=h.id AND

		h.fnct_id=f.id AND

    (o.genre = 'XVLP' or o.genre = 'XVLNP') AND

		f.groep_id=fg.id AND

		bl.aanwezig=1

		";

//		fg.id in (3,5) AND



$result=mysql_query($qry);

$records=mysql_fetch_array($result);

$aantal_xvl=$records[0];

//----------------------------------------------------------

?>