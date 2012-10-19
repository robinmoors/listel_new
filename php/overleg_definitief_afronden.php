<?php

session_start();

$paginanaam="Teamoverleg definitief afronden";





if (IsSet($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan"))

    {

    //----------------------------------------------------------

    /* Maak Dbconnectie */ include('../includes/dbconnect2.inc');

    //----------------------------------------------------------


  if ($_SESSION['profiel']=="menos") {
    $overlegGenreVoorwaarde = " overleggenre = 'menos' AND ";
    $menosParam = "menosPeople=1";
    $extraParameterSelectPersonen = "?menos=1";
    $extraParameterSelectPersonen2 = "&menos=1";
    $overlegVoorwaarde = " and overleg.genre = 'menos' ";
  }
  else {
    $overlegGenreVoorwaarde = " overleggenre = 'gewoon' AND ";
    $overlegVoorwaarde = " AND (overleg.genre is NULL or overleg.genre in ('gewoon','psy','TP')) ";
  }


    require('../includes/patientoverleg_geg.php');



    if (!isset($overlegInfo)) {

      die("Deze patient heeft geen afrondbaar overleg!");

    }

    

    include("../includes/html_html.inc");

    print("<head>");

    include("../includes/html_head.inc");

    print("</head>");

    print("<body>");

    print("<div align=\"center\">");

    print("<div class=\"pagina\">");

    include("../includes/header.inc");

    include("../includes/kruimelpad.inc");

    print("<div class=\"contents\">");

    include("../includes/menu.inc");

    print("<div class=\"main\">");

    print("<div class=\"mainblock\">");



//include("../includes/toonSessie.inc");



if ($_POST['verificatie']==-1) {

    print("<strong>We hebben niet kunnen testen of alles correct ingevuld is. En dat is een fout in het e-zorgplan :-(<br/>Neem zo snel mogelijk contact op met <a mailto:'Anick.Noben@listel.be,dr.Kris.Aerts@gmail.com'>Anick Noben</a> met deze foutmelding.");

    //---------------------------------------------------------

    /* Sluit Dbconnectie */ include("../includes/dbclose.inc");

    //---------------------------------------------------------

    print("</div>");

    print("</div>");

    print("</div>");

    include("../includes/footer.inc");

    print("</div>");

    print("</div>");

    print("</body>");

    print("</html>");

    die("");  // anders de rest doen.



}

else if ($_POST['verificatie']==0 && $_POST['overlegwissen']!=1 && $_POST['vergoedingTPweigeren']!='nietIncluderen') {

    print("Valsspeler. Je mag deze pagina enkel bezoeken wanneer je via de link 'Overleg afronden' gaat!");

    //---------------------------------------------------------

    /* Sluit Dbconnectie */ include("../includes/dbclose.inc");

    //---------------------------------------------------------

    print("</div>");

    print("</div>");

    print("</div>");

    include("../includes/footer.inc");

    print("</div>");

    print("</div>");

    print("</body>");

    print("</html>");

    die("");  // anders de rest doen.

}





// eerst kijken of de patient geweigerd werd voor inclusie;

if ($_POST['vergoedingTPweigeren']=='nietIncluderen') {



    // wis het overleg

    $deleteOverleg = "delete from overleg where genre = 'TP' and afgerond = 0 and patient_code ='{$_SESSION['pat_code']}' and id = $overlegID";

    $deletePlan = "delete from overleg_tp_plan where overleg = $overlegID";
    $deleteKatzAanvraag = "delete from katz_aanvraag where overleg = $overlegID";

    $deleteOMB = "delete from omb_registratie where id in (select omb_id from overleg where id = $overlegID and omb_id is not null)";

    $deleteBetrokkenen = "delete from huidige_betrokkenen where patient_code ='{$_SESSION['pat_code']}'";

    $desactiveerPatientTP = "update patient_tp set actief = 0, stopzetting_text = 'geweigerd voor inclusie' where patient = '{$_SESSION['pat_code']}'";

    $desactiveerPatient = "update patient set actief = 0 where code = '{$_SESSION['pat_code']}'";

    if (mysql_query($deleteOMB) &&

             mysql_query($deleteOverleg) &&

             mysql_query($deletePlan) &&
             mysql_query($deleteKatzAanvraag) &&

             mysql_query($deleteBetrokkenen) &&

             mysql_query($desactiveerPatientTP) &&

             mysql_query($desactiveerPatient)) {

      print("<p>Je hebt deze pati&euml;nt geweigerd voor inclusie. <br/>Daarom hebben we hem/haar en het bijhorende overleg verwijderd.<br/>Vanzelfsprekend kan je deze pati&euml;nt later terug ophalen wanneer hij toch ergens wordt opgenomen (bv. in gewoon GDT)</p>\n");

    }

    else print(mysql_error());



    //---------------------------------------------------------

    /* Sluit Dbconnectie */ include("../includes/dbclose.inc");

    //---------------------------------------------------------

    print("</div>");

    print("</div>");

    print("</div>");

    include("../includes/footer.inc");

    print("</div>");

    print("</div>");

    print("</body>");

    print("</html>");

    die("");  // anders de rest doen.

}



// dan kijken of dit overleg gewist moet worden

if ($_POST['overlegwissen']==1) {



    // wis het overleg

    $deleteOmb = "delete from omb_registratie where id in (select omb_id from overleg where afgerond = 0 and patient_code ='{$_SESSION['pat_code']}' and id = $overlegID and omb_id is not null)";

    $deleteOverleg = "delete from overleg where afgerond = 0 and patient_code ='{$_SESSION['pat_code']}' and id = $overlegID";
    $deleteKatzAanvraag = "delete from katz_aanvraag where overleg = $overlegID";

    if (mysql_query($deleteOmb) && mysql_query($deleteOverleg) && mysql_query($deleteKatzAanvraag) ) {

      print("<p>Het overleg is gewist!</p>\n");

    }

    else print(mysql_error());



    //---------------------------------------------------------

    /* Sluit Dbconnectie */ include("../includes/dbclose.inc");

    //---------------------------------------------------------

    print("</div>");

    print("</div>");

    print("</div>");

    include("../includes/footer.inc");

    print("</div>");

    print("</div>");

    print("</body>");

    print("</html>");

    die("");  // anders de rest doen.

}



$recordsOverleg = mysql_fetch_array(mysql_query("select * from overleg where id = {$overlegID}"));





if (is_tp_patient()) {

  $status = berekenTeamStatus();

  $geldVoorHVL = 0;

  if ($_POST['vergoedingTPweigeren']==1) {

    $nuAlSubsidiestatusOpslaan = true;

  }

  else if (substr($status, 0, 2) == "OK") {

    $nuAlSubsidiestatusOpslaan = false;

  }

  else {

    $nuAlSubsidiestatusOpslaan = true;

  }

}



  if (($recordsOverleg['keuze_vergoeding']==-1)

      ||

      (is_tp_patient() && $nuAlSubsidiestatusOpslaan)

     )

  {

    // geen vergoeding en dus ook geen controle.

    // en daarom moeten we hier de minimale subsidiestatus al aanpassen...



//              controleerMinimaleSubsidiestatus(" $_SESSION['pat_code'] ", overleg);  // gedefinieerd in functies.js



     $nieuweGetalStatus =  berekenGetalSubsidiestatus($patientInfo['minimum_subsidiestatus'],

                                                      $patientInfo['subsidiestatus'],

                                                      $patientInfo['code'],

                                                      "huidige",

                                                      "patient_code",

                                                      $patientInfo['code']);



      $qry = "update patient set minimum_subsidiestatus = '$nieuweGetalStatus' where code = '{$patientInfo['code']}'";

      if (mysql_query($qry)) {

        print("<p style=\"color: white;display:none;\">De nieuwe minimumsubsidiestatus is nu $nieuweGetalStatus</p>");

      }

      else {

        print($qry . " gaf volgende fout: <br/>" . mysql_error());

      }



  }





//---------------------------------------------------------

// Kopieer de gegevens van de betrokkenen

$qry1="

    SELECT *

    FROM huidige_betrokkenen

    WHERE $overlegGenreVoorwaarde patient_code='".$_SESSION['pat_code']."' order by id";

//print($qry1);

if ($result1=mysql_query($qry1))

    {

    for ($i=0; $i < mysql_num_rows ($result1); $i++)

        {

        $records1= mysql_fetch_array($result1);

        if ($records1['namens']>0) {

          $qry2a="

            INSERT INTO

                afgeronde_betrokkenen

                    (

                    overleg_id,

                    persoon_id,

                    genre,

                    aanwezig,

                    namens,
                    rechten,
                    overleggenre,
                    bereikbaarheid)

            VALUES

                ($overlegID, "

                .$records1['persoon_id'].",'"

                .$records1['genre']."',"

                .$records1['aanwezig'].","

                .$records1['namens'].",
                {$records1['rechten']},
                '{$records1['overleggenre']}',
                '{$records1['bereikbaarheid']}')";

        }

        else {

          $qry2a="

            INSERT INTO

                afgeronde_betrokkenen

                    (

                    overleg_id,

                    persoon_id,

                    genre,

                    aanwezig,
                    rechten,
                    overleggenre,
                    bereikbaarheid)

            VALUES

                ($overlegID, "

                .$records1['persoon_id'].",'"

                .$records1['genre']."',"

                .$records1['aanwezig'] . ",
                {$records1['rechten']},
                '{$records1['overleggenre']}',
                '{$records1['bereikbaarheid']}')";

        }

        $qry2b="

            UPDATE

                huidige_betrokkenen

            set

                aanwezig = 0

            where

                id = {$records1['id']}";

        if (!(mysql_query($qry2a) && mysql_query($qry2b))) {

           print("<h1>begot: $qry2a of $qry2b lukt niet <br>" . mysql_error() . "</h1>");

        }

        //print($qry2);

        }

    }

else {

  print("<h1>begot: $qry1 lukt niet <br>" . mysql_error() . "</h1>");

}

//---------------------------------------------------------





//---------------------------------------------------------

// Zet de toestand van dit overleg op afgerond



// is er geld voor de hulpverleners

if ($aantal_zvl < 4
     && $overlegInfo['keuze_vergoeding'] == 1
     && $overlegInfo['soort_problematiek']=="fysisch"
     && ($aantal_hvl > $aantal_zvl))
  $geldVoorHVL = 1;
else
  $geldVoorHVL = 0;



if (is_tp_patient()) {

  $geldVoorHVL = 0;

  if ($_POST['vergoedingTPweigeren']==1) {

    $vergoeding = " keuze_vergoeding = -1, ";

  }

  else if (substr($status, 0, 2) == "OK") {

    $vergoeding = " keuze_vergoeding = 1, ";

  }

  else {

    $vergoeding = " keuze_vergoeding = 0, ";

  }

}



$vandaag = date("Ymd");

if (isset($_POST['volgend_dd'])&& $_POST['volgend_dd']>0) {
  $volgendeDatum = " volgende_datum = {$_POST['volgend_dd']}{$_POST['volgend_dd']}{$_POST['volgend_dd']}, ";
}

$qry1="

    UPDATE overleg

    SET  $vergoeding afgerond = 1, geld_voor_hvl = $geldVoorHVL,
         $volgendeDatum
         afronddatum = '$vandaag'

    WHERE id  = $overlegID";


//print($qry1);

if (!$result1=mysql_query($qry1))    {

  print("<h1>begot: $qry1 lukt niet <br>" . mysql_error() . "</h1>");

}

$deleteKatzAanvraag = "delete from katz_aanvraag where overleg = $overlegID";
mysql_query($deleteKatzAanvraag);

// als er geen vergoeding wordt toegekend, is er geen controle

// en kunnen we direct de minimale subsidiestatus aanpassen

if ($overlegInfo['keuze_vergoeding'] == 0 || $vergoeding == " keuze_vergoeding = 0, ") {

?>

<script type="text/javascript">

   controleerMinimaleSubsidiestatus("<?= $patientInfo['code'] ?>", <?= $overlegID ?>);  // gedefinieerd in functies.js

</script>

<?php

  }





//---------------------------------------------------------?>

<h1>Status van het overleg</h1>

<p>

De gegevens met betrekking tot dit overleg werden nu definitief genoteerd. <br />



<?php

  $datum=substr($recordsOverleg['datum'],6,2)."/".substr($recordsOverleg['datum'],4,2)."/".substr($recordsOverleg['datum'],0,4);



?>



<p>De bijhorende documenten kunnen

<a href="print_overleg.php?id=<?php print($overlegID); ?>&datum=<?= $datum ?>">hier afgedrukt</a>

worden of via het menu links opgeroepen worden onder de rubriek "zorgplannen".</p>





<?php

  if ($recordsOverleg['keuze_vergoeding']>0 && $recordsOverleg['genre']<>"TP") {

     if ($recordsOverleg['keuze_vergoeding']==1)
       print("De facturatie van het vergoedbaar overleg kan nu via LISTEL vzw uitgevoerd worden.");
     else
       print("De vergoeding van de organisator kan nu via LISTEL vzw uitgevoerd worden.");


     // stuur een mail naar Listel



     /*

     $emailResult = mysql_query("select email from logins where profiel = 'listel' AND sit_id is NULL and email <> \"\" and actief=1");

     for ($i=0; $i<mysql_num_rows($emailResult); $i++) {

       $em = mysql_fetch_array($emailResult);

       $email .= ",{$em['email']}";

     }

     $email = substr($email, 1);

     */

     $emailListel = "anick.noben@listel.be";

     //NIET MEER DOEN! htmlmail("$emailListel","Nieuwe factuur voor patient {$_SESSION['pat_code']}","Nieuwe factuur voor patient {$_SESSION['pat_code']} op $siteadres.");

  }







?>

</p><p>Dank u voor het gebruik van het Listel e-zorgplan.</p>









<?php   //---------------------------------------------------------

    /* Sluit Dbconnectie */ include("../includes/dbclose.inc");

    //---------------------------------------------------------

    print("</div>");

    print("</div>");

    print("</div>");

    include("../includes/footer.inc");

    print("</div>");

    print("</div>");

    print("</body>");

    print("</html>");

    }

//---------------------------------------------------------

/* Geen Toegang */ include("../includes/check_access.inc");

//---------------------------------------------------------

?>