<?php       

//----------------------------------------------------------

// bereken het aantal verschillende soorten betrokken hulpverleners (ZVL+HVL)

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

        f.groep_id=fg.id AND

        (o.genre = 'HVL' or o.genre = 'ZVL' or (o.genre is NULL AND fg.id = 2)) AND

        bl.aanwezig=1

   GROUP BY

         h.fnct_id

        ";

//        fg.id in (1,2) AND



$result=mysql_query($qry);

$aantal_hvl=mysql_num_rows($result);

//$records=mysql_fetch_array($result);

//$_SESSION['aantal_hvl']=$records[0];

//----------------------------------------------------------

?>





