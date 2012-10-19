<?php       

//----------------------------------------------------------

// bereken het aantal betrokken thuisverpleegkundigen (ZVL fnct_id=17)

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

        bl.genre = 'hulp' AND

        bl.persoon_id=h.id AND

        h.fnct_id=f.id AND

        f.id=17 AND

        bl.aanwezig=1

        ";

        

$result=mysql_query($qry);

$records=mysql_fetch_array($result);

$aantal_tvp = $aantal_tvp_aanwezig=$records[0];



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

        bl.genre = 'hulp' AND

        bl.persoon_id=h.id AND

        h.fnct_id=f.id AND

        f.id=17

    ";

$result=mysql_query($qry);

$records=mysql_fetch_array($result);

$aantal_tvp_betrokken=$records[0];



//----------------------------------------------------------

?>