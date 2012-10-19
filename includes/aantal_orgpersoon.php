<?php       

//----------------------------------------------------------

// bereken het aantal verschillende soorten betrokken interne partners





            

     $qryOrgPersonen = "select namens from huidige_betrokkenen bl

            WHERE

                bl.overleggenre = 'gewoon' AND
                bl.genre = 'orgpersoon' AND

                bl.patient_code='".$_SESSION['pat_code']."' AND

                aanwezig = 1

            GROUP BY namens";

     $resultOrgPersonen = mysql_query($qryOrgPersonen) or die(mysql_error() . "<br/>$qryOrgPersonen");

     $aantal_orgpersoon = mysql_num_rows($resultOrgPersonen);

     



// klaar!

// de variabele $aantal_orgpersoon bevat de juiste waarde!

//die("<h1>$aantal_orgpersoon</h1>");





/* oude versie met hoofdzetels, maar geen vijvers

   ik vond die query best wel mooi en laat hem

   daarom staan als souvenir */



/*

$qry="

    SELECT

        count(bl1.persoon_id)

    FROM

        huidige_betrokkenen bl1,

        huidige_betrokkenen bl2,

        hulpverleners h,

        organisatie org

    WHERE
    bl1.overleggenre = 'gewoon' AND

        bl1.patient_code='".$_SESSION['pat_code']."' AND

        bl1.genre = 'orgpersoon' AND

        bl1.persoon_id=h.id AND

        h.organisatie = org.id AND

        bl2.patient_code='".$_SESSION['pat_code']."' AND



            (

              (  bl2.genre = 'org' AND

                 (bl.persoon_id = org.id or bl.persoon_id = org.hoofdzetel)

              )

              $zoekTerm

            )



        

        (bl2.persoon_id = org.id or bl2.persoon_id = org.hoofdzetel) AND

        bl1.aanwezig=1

   GROUP BY

        bl2.persoon_id

        ";



//die($qry);

$result=mysql_query($qry) or die("$qry geeft <br/>" . mysql_error());

$aantal_orgpersoon=mysql_num_rows($result);

*/





/****  ANDERE OUDE VERSIE ****

$aantal_orgpersoon=0;



// eerst een query over alle organisaties

  $qryOrgs = "select organisatie.id as org_id, organisatie.naam from huidige_betrokkenen bl, organisatie

              where bl.genre = 'org' AND
                    bl.overleggenre = 'gewoon' AND

                persoon_id = organisatie.id AND

                bl.patient_code='{$_SESSION['pat_code']}'";

  $resultOrgs = mysql_query($qryOrgs) or die("foutje met $qryOrgs " . mysql_error());

  for ($orgnr = 0; $orgnr < mysql_num_rows($resultOrgs); $orgnr++) {

    $org = mysql_fetch_assoc($resultOrgs);



    // eerst alle subzetels/vestigingen toevoegen

    $queryVestigingen = "select id from organisatie

                         where hoofdzetel = {$org['org_id']}";

    $resultVestigingen = mysql_query($queryVestigingen) or die("dedoemme $queryVestigingen");

    $orgs = "";

    for ($ii=0;$ii<mysql_num_rows($resultVestigingen);$ii++) {

      $bijOrg = mysql_fetch_assoc($resultVestigingen);

      $orgs .= ", {$bijOrg['id']}";

    }



     // dan alle gelijkaardige organisatie pakken: de 'vijvers'

     $zoekTerm = "";

     $naam = $org['naam'];

     if (substr($naam,0,3)=='CGG') {

       $zoekTerm = "select id from organisatie where id <> {$org['org_id']} and naam LIKE 'CGG%' ";

       $CGG = false;

     }

     else if (substr($naam,0,4)=='DAGG') {

       $zoekTerm = "select id from organisatie where id <> {$org['org_id']} and naam LIKE 'DAGG%' ";

       $DAGG = false;

     }

     else if (substr($naam,0,4)=='VGGZ') {

       $zoekTerm = "select id from organisatie where id <> {$org['org_id']} and naam LIKE 'VGGZ%' ";

       $VGGZ = false;

     }

     else if (substr($naam,0,5)=='RCGGZ') {

       $zoekTerm = "select id from organisatie where id <> {$org['org_id']} and naam LIKE 'RCGGZ%' ";

       $RCGGZ = false;

     }

     else if (substr($naam,0,6)=='ARCGGZ') {

       $zoekTerm = "select id from organisatie where id <> {$org['org_id']} and naam LIKE 'ARCGGZ%' ";

       $ARCGGZ = false;

     }

     else if (substr($naam,0,2)=='BW') {

       $zoekTerm = "select id from organisatie where id <> {$org['org_id']} and naam LIKE 'BW%' ";

       $BW = false;

     }

     else if (substr($naam,0,2)=='PZ') {

       $zoekTerm = "select id from organisatie where id <> {$org['org_id']} and naam LIKE 'PZ%' ";

       $PZ = false;

     }

     else if (substr($naam,0,3)=='KPZ') {

       $zoekTerm = "select id from organisatie where id <> {$org['org_id']} and naam LIKE 'KPZ%' ";

       $KPZ = false;

     }

     else if (substr($naam,0,3)=='PTZ') {

       $zoekTerm = "select id from organisatie where id <> {$org['org_id']} and naam LIKE 'PTZ%' ";

       $PTZ = false;

     }

     else if (substr($naam,0,3)=='PVT') {

       $zoekTerm = "select id from organisatie where id <> {$org['org_id']} and naam LIKE 'PVT%' ";

       $PVT = false;

     }

     else if (substr($naam,0,3)=='CLB') {

       $zoekTerm = "select id from organisatie where id <> {$org['org_id']} and naam LIKE 'CLB%' ";

       $CLB = false;

     }

     else if (substr($naam,0,4)=='VCLB') {

       $zoekTerm = "select id from organisatie where id <> {$org['org_id']} and naam LIKE 'VCLB%' ";

       $VCLB = false;

     }

     if ($zoekTerm <> "") {

       $resultVijvers = mysql_query($zoekTerm);

       for ($vijver = 0; $vijver < mysql_num_rows($resultVijvers); $vijver++) {

         $bijOrg = mysql_fetch_assoc($resultVijvers);

         $orgs .= ", {$bijOrg['id']}";

       }

     }



    // de organisatie zelf toevoegen!

    $orgs = "{$org['org_id']} $orgs";



    $qryOrgPersonen = "

         SELECT

                count(bl.id)

            FROM

                huidige_betrokkenen bl,

                hulpverleners h

            WHERE
    bl.overleggenre = 'gewoon' AND

                bl.genre = 'orgpersoon' AND

                bl.persoon_id = h.id AND

                h.organisatie in ($orgs) AND

                bl.patient_code='".$_SESSION['pat_code']."' AND

                aanwezig = 1

            GROUP BY namens";



     $resultOrgPersonen = mysql_query($qryOrgPersonen) or die(mysql_error() . "<br/>$qryOrgPersonen");



     if (mysql_num_rows($resultOrgPersonen) > 0)

       $aantal_orgpersoon++;

*/

?>