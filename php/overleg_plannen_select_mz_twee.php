<?php

session_start();

$paginanaam="Mantelzorgers selecteren";



  $vanuitZorgTeam = strpos($_SERVER['HTTP_REFERER'], "zorgteam");

  $vanuitControle = strpos($_SERVER['HTTP_REFERER'], "controle");

  if ($_GET['menos']==1) {
    $overlegGenreVoorwaarde = " overleggenre = 'menos' and ";
    $overlegGenre = 'menos';
    $menosGetParam = "?menos=1";
    $menosExtraGetParam = "&menos=1";
    $vanuitZorgTeam = true;
    $menosToevoeging = "menos-";
    $action = "overleg_plannen_select_mz_twee.php?menos=1";
  }
  else {
    $action = "overleg_plannen_select_mz_twee.php";
  }

  if (!isset($overlegGenreVoorwaarde)) {
    $overlegGenreVoorwaarde = " overleggenre = 'gewoon' and ";
    $overlegGenre = 'gewoon';
  }

  if (!empty($vanuitZorgTeam) || ($_POST['vanWaar'] == "zorgTeam")) {

    $vanWaar =  "zorgTeam";

    $tabel = "huidige_betrokkenen";

    $bijWieVeld = "patient_code";

    $bijWieValue = "'{$_SESSION['pat_code']}'";

  }

  else if (!empty($vanuitControle) || ($_POST['vanWaar'] == "controle")  || isset($_GET['overleg'])) {
    if (isset($_GET['overleg'])) {
      $controleOverleg = $_GET['overleg'];
    }
    else {
      $controleOverleg = $_POST['overleg'];
    }

    $vanWaar =  "controle";

    $tabel = "afgeronde_betrokkenen";

    $bijWieVeld = "overleg_id";

    $bijWieValue = "{$controleOverleg}";

    $extraParameterWis = "&overleg={$controleOverleg}";

  }

  else {

    $vanWaar = "overleg";

    $tabel = "huidige_betrokkenen";

    $bijWieVeld = "patient_code";

    $bijWieValue = "'{$_SESSION['pat_code']}'";

  }

    if (isset($_GET['menos']) || isset($_POST['menos']))
      if (strpos($a_backpage, "?") > 0)
         $backpage .= "&menos=1";
      else
         $backpage .= "?menos=1";


if (IsSet($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan"))

//----------------------------------------------------------

/* Maak Dbconnectie */ include('../includes/dbconnect2.inc');

//----------------------------------------------------------

    {

    if ( ((isset($_POST['mzorg_naam'])&&($_POST['mzorg_naam']!=""))
            ||
          (isset($_POST['mzorg_voornaam'])&&($_POST['mzorg_voornaam']!=""))
         )
         &&($_SESSION['pat_code']!=""))
    {

        //---------------------------------------------------------

        $postcode=(isset($_POST['mzorg_gem_id']))?$_POST['mzorg_gem_id']:9999;

        $sql7 = "

            INSERT INTO

                mantelzorgers

                    (

                    naam,

                    voornaam,

                    verwsch_id,

                    tel,

                    gsm,

                    adres,

                    gem_id,

                    email,

                    actief

                    )

            VALUES

                (

                '".$_POST['mzorg_naam']."',

                '".$_POST['mzorg_voornaam']."',

                '".$_POST['mzorg_verwsch_id']."',

                '".$_POST['mzorg_tel']."',

                '".$_POST['mzorg_gsm']."',

                '".$_POST['mzorg_adres']."',

                ".$postcode.",

                '".$_POST['mzorg_email']."',

                1)";

        if ($result=mysql_query($sql7))  

            { // succesvolle toevoeging aan dbase

            $melding="Gegevens van deze mantelzorger werden <b>succesvol ingevoegd</b>.<br>";

            $lastInsert=mysql_insert_id();

               if (is_tp_patient()  && ($bijWieVeld != "overleg_id")) {

                $overlegRij = getHuidigOverleg();

                $overlegID = $overlegRij['id'];

                $sql1Plus = "

                    INSERT INTO overleg_tp_plan

                        (overleg, persoon, genre)

                    VALUES

                        ($overlegID, '$lastInsert','mantel')";

                 $result=mysql_query($sql1Plus) or die("wat is dat hier $sql1Plus " . mysql_error());

               }

            //----------------------------------------------------------

            // Na succesvol opslaan van mantelzorger-gegevens de

            // link bewaren tussen patient en mantelzorger

            //----------------------------------------------------------



            $sql = "

                INSERT INTO

                    $tabel

                    (persoon_id,

                    genre,

                    $bijWieVeld ,

                    aanwezig,
                    overleggenre)

                VALUES

                ($lastInsert,

                 'mantel',

                 $bijWieValue ,

                 1,
                 '$overlegGenre')";

            if ($result=mysql_query($sql))  // succesvolle toevoeging aan dbase
            {
               $melding="Link tussen Patient en Mantelzorger is <b>succesvol gelegd</b>.<br>";
               /************** overdracht tussen zorgteams GDT en Menos *************/
               if ($bijWieVeld == "patient_code") {
                 $zoekMenosQry = "select patient_menos.*,patient.actief, menos
                                      from patient inner join patient_menos on patient = code and patient = $bijWieValue";
                 $zoekMenosResult = mysql_query($zoekMenosQry) or die("ik kan de menos-gegevens van deze patient niet controleren $zoekMenosQry");
                 if (mysql_num_rows($zoekMenosResult) > 0) {
                   // het is een menos-patient
                   $zoekMenos = mysql_fetch_assoc($zoekMenosResult);
                   if ($overlegGenre == 'menos' && (abs($zoekMenos['actief'])==1) && $zoekMenos['menos2gdt_vraag'] == 1 && $zoekMenos['menos2gdt_toestemming'] == 1) {
                     // van menos naar gdt
                     $sqlTestGDT = "select * from huidige_betrokkenen
                                    where overleggenre = 'gewoon' and persoon_id = $lastInsert and genre = 'mantel' and $bijWieVeld = $bijWieValue";
                     $resultTestGDT = mysql_query($sqlTestGDT) or die("wat is dat hier $sqlTestGDT " . mysql_error());
                     $sqlGDT = "
                        INSERT INTO huidige_betrokkenen (persoon_id, genre, $bijWieVeld, aanwezig, overleggenre)
                        VALUES ($lastInsert,'mantel', $bijWieValue, 1, 'gewoon')";
                     if (mysql_num_rows($resultTestGDT) == 0) {
                       $resultGDT = mysql_query($sqlGDT) or die("wat is dat hier $sqlGDT " . mysql_error());
                       $melding = $melding . "<br/>De mantelzorger is ook toegevoegd aan het GDT-zorgteam.";
                       // mail versturen
                       $mensen = organisatorenVanPatient($bijWieValue);
                       for ($i=0; $i<mysql_num_rows($mensen); $i++) {
                         $pc  = mysql_fetch_assoc($mensen);
                         $namen .= ", {$pc['naam']} {$pc['voornaam']}";
                         $adressen .= ", {$pc['email']}";
                       }

                       $namen = substr($namen, 1);
                       $adressen = substr($adressen, 1);

                       htmlmail($adressen,"Listel: toevoeging aan GDT-zorgteam","Beste $namen<br/>Vanuit Menos is de mantelzorger {$_POST['mzorg_naam']} {$_POST['mzorg_voornaam']} toegevoegd aan het zorgteam van pati&euml;nt $bijWieValue.
                                                   En zoals aangeduid op het formulier met de pati&euml;nt-gegevens, is deze mantelzorger ook toegevoegd aan het GDT-zorgteam.
                                                   <br />Het LISTEL e-zorgplan www.listel.be </p>");
                     }
                   }
                   else if (($overlegGenre == 'gewoon' || $overlegGenre == 'psy') && (abs($zoekMenos['menos'])==1) && $zoekMenos['gdt2menos_vraag'] == 1 && $zoekMenos['gdt2menos_toestemming'] == 1) {
                     // van gdt naar menos
                     $sqlTestGDT = "select * from huidige_betrokkenen
                                    where overleggenre = 'menos' and persoon_id = $lastInsert and genre = 'mantel' and $bijWieVeld = $bijWieValue";
                     $resultTestGDT = mysql_query($sqlTestGDT) or die("wat is dat hier $sqlTestGDT " . mysql_error());
                     $sqlGDT = "
                        INSERT INTO huidige_betrokkenen (persoon_id, genre, $bijWieVeld, aanwezig, overleggenre)
                        VALUES ($lastInsert,'mantel', $bijWieValue, 1, 'menos')";
                     if (mysql_num_rows($resultTestGDT) == 0) {
                       $resultGDT = mysql_query($sqlGDT) or die("wat is dat hier $sqlGDT " . mysql_error());
                       $melding = $melding . "<br/>De mantelzorger is ook toegevoegd aan het Menos-zorgteam.";
                       // mail versturen
                       $mensen = menosOrganisatorenVanPatient($bijWieValue);
                       for ($i=0; $i<mysql_num_rows($mensen); $i++) {
                         $pc  = mysql_fetch_assoc($mensen);
                         $namen .= ", {$pc['naam']} {$pc['voornaam']}";
                         $adressen .= ", {$pc['email']}";
                       }

                       $namen = substr($namen, 1);
                       $adressen = substr($adressen, 1);

                       htmlmail($adressen,"Listel: toevoeging aan Menos-zorgteam","Beste $namen<br/>Vanuit GDT is de mantelzorger {$_POST['mzorg_naam']} {$_POST['mzorg_voornaam']} toegevoegd aan het zorgteam van pati&euml;nt $bijWieValue.
                                                   En zoals aangeduid op het formulier met de pati&euml;nt-gegevens, is deze mantelzorger ook toegevoegd aan het Menos-zorgteam.
                                                   <br />Het LISTEL e-zorgplan www.listel.be </p>");
                     }
                   }
                 }
               }
              /************** einde overdracht tussen zorgteams GDT en Menos *************/
            }
            else // NIET succesvolle toevoeging aan dbase

                {$melding="Link tussen Patient en Mantelzorger is <b>niet succesvol gelegd</b>.<br>

                            Er ging iets fout op databaseniveau<br>".$sql.

                            "Er ontbreken gegevens om de link tussen Patient en Mantelzorger te kunnen leggen<br>

                            mogelijk ging er iets mis met het wegschrijven van de mantelzorger-gegevens of weet het

                            e-zorgplan op dit moment niet wie de patient is <br>

                            De laatst-weggeschreven record was :".$lastInsert."<br>

                            De huidige patientcode is:".$_SESSION['pat_code'];

                }

            }

            else

                {$melding="MZgegevens zijn <b>NIET succesvol ingevoegd</b>,<br>".$sql;}

            }

        else

            {$melding="Er ontbreken gegevens: mzorg_naam of pat_id";} // Mantelzorger-gegevens wegschrijven

        //----------------------------------------------------------



        //----------------------------------------------------------

        if(isset($_GET['wis_id']))

            { 

            // koppeling wissen

         $overlegInfo = getHuidigOverleg();

        if ($overlegInfo['genre']=='TP'  && ($bijWieVeld != "overleg_id")) {

          $selectDeleteInfo = "select * from $tabel where id = {$_GET['wis_id']}";

          $deleteInfo = mysql_fetch_assoc(mysql_query($selectDeleteInfo));

          $delQuery2 = "delete from overleg_tp_plan where persoon = {$deleteInfo['persoon_id']} and genre = '{$deleteInfo['genre']}' and overleg = {$overlegInfo['id']}";

          mysql_query($delQuery2);

        }

        $hvl = getUniqueRecord("select hvl.* from mantelzorgers hvl inner join huidige_betrokkenen betr
                               on /* $overlegGenreVoorwaarde */ betr.id = {$_GET['wis_id']} and betr.persoon_id = hvl.id and betr.genre = 'mantel'");


            $sql1 = "

                DELETE FROM

                    $tabel

                WHERE

                    id = {$_GET['wis_id']}";


        if ($result=mysql_query($sql1))
        {
           $melding="Bedrijfsgegevens zijn <b>succesvol verwijderd</b>.<br>";
               /************** overdracht tussen zorgteams GDT en Menos *************/
               if ($bijWieVeld == "patient_code") {
                 $zoekMenosQry = "select patient_menos.*,patient.actief, menos
                                      from patient inner join patient_menos on patient = code and patient = $bijWieValue";
                 $zoekMenosResult = mysql_query($zoekMenosQry) or die("ik kan de menos-gegevens van deze patient niet controleren $zoekMenosQry");
                 if (mysql_num_rows($zoekMenosResult) > 0) {
                   // het is een menos-patient
                   $zoekMenos = mysql_fetch_assoc($zoekMenosResult);
                   if ($overlegGenre == 'menos' && (abs($zoekMenos['actief'])==1) && $zoekMenos['menos2gdt_vraag'] == 1 && $zoekMenos['menos2gdt_toestemming'] == 1) {
                     // van menos naar gdt
                       // mail versturen
                       $mensen = organisatorenVanPatient($bijWieValue);
                       for ($i=0; $i<mysql_num_rows($mensen); $i++) {
                         $pc  = mysql_fetch_assoc($mensen);
                         $namen .= ", {$pc['naam']} {$pc['voornaam']}";
                         $adressen .= ", {$pc['email']}";
                       }

                       $namen = substr($namen, 1);
                       $adressen = substr($adressen, 1);

                       htmlmail($adressen,"Listel: verwijdering uit GDT-zorgteam","Beste $namen<br/>Vanuit Menos is de mantelzorger {$hvl['voornaam']} {$hvl['naam']} verwijderd uit het zorgteam van pati&euml;nt $bijWieValue.
                                                   En zoals aangeduid op het formulier met de pati&euml;nt-gegevens, wordt u hiervan verwittigd, maar de verwijdering gebeurt niet automatisch.
                                                   <br />Het LISTEL e-zorgplan www.listel.be </p>");
                   }
                   else if (($overlegGenre == 'gewoon' || $overlegGenre == 'psy') && (abs($zoekMenos['menos'])==1) && $zoekMenos['gdt2menos_vraag'] == 1 && $zoekMenos['gdt2menos_toestemming'] == 1) {
                     // van gdt naar menos
                       // mail versturen
                       $mensen = menosOrganisatorenVanPatient($bijWieValue);
                       for ($i=0; $i<mysql_num_rows($mensen); $i++) {
                         $pc  = mysql_fetch_assoc($mensen);
                         $namen .= ", {$pc['naam']} {$pc['voornaam']}";
                         $adressen .= ", {$pc['email']}";
                       }

                       $namen = substr($namen, 1);
                       $adressen = substr($adressen, 1);

                       htmlmail($adressen,"Listel: verwijdering uit Menos-zorgteam","Beste $namen<br/>Vanuit GDT is de mantelzorger {$hvl['voornaam']} {$hvl['naam']} verwijderd uit het zorgteam van pati&euml;nt $bijWieValue.
                                                   En zoals aangeduid op het formulier met de pati&euml;nt-gegevens, wordt u hiervan verwittigd, maar de verwijdering gebeurt niet automatisch.
                                                   <br />Het LISTEL e-zorgplan www.listel.be </p>");
                   }
                 }
               }
              /************** einde overdracht tussen zorgteams GDT en Menos *************/
            }
            else

                {$melding="Mantelzorger-gegevens zijn <b>niet succesvol verwijderd</b>,<br>".$sql1;}

            // Mantelzorger wissen

            $sql1 = "

                UPDATE

                    mantelzorgers

                SET actief = 0

                WHERE

                    id = {$_GET['mz_id']}";

            if ($result=mysql_query($sql1))

                {$melding="Mantelzorger-gegevens zijn <b>succesvol verwijderd</b>.<br>";}

            else

                {$melding="Mantelzorger-gegevens zijn <b>niet succesvol verwijderd</b>,<br>".$sql1;}

            } // Mantelzorger-gegevens wissen

        //----------------------------------------------------------



        //----------------------------------------------------------

        print("<script type=\"text/javascript\">");

        $query = "

            SELECT

                dlzip,dlnaam,id

            FROM

                gemeente

            ORDER BY

                dlzip";

        if ($result=mysql_query($query))

            {

            print ("var gemeenteList = Array(");

            for ($i=0; $i < mysql_num_rows ($result); $i++)

                {

                $records= mysql_fetch_array($result);

                print ("\"".$records[0]." ".$records[1]."\",\"".$records[2]."\"\n");

                if ($i < mysql_num_rows ($result)-1) print(",");

                }

            print (");");

            }

        print("</script>"); // Postcodelijst Opstellen voor javascript

        //----------------------------------------------------------



        include("../includes/html_html.inc");

        print("<head>");

        include("../includes/html_head.inc");

        print("</head>");

        print("<body onload=\"hideCombo('IIPostCodeS')\">");

        print("<div align=\"center\">");

        print("<div class=\"pagina\">");

        include("../includes/header.inc");

        include("../includes/pat_id.inc");

        print("<div class=\"contents\">");

        include("../includes/menu.inc");

        print("<div class=\"main\">");

        print("<div class=\"mainblock\">");

        print("<h1>Mantelzorgers toevoegen aan het {$menosToevoeging}zorgteam</h1>

            <p>Vul onderstaand formulier in met de gegevens van de <b>mantelzorgers(*)</b> 

            die op het overleg aanwezig zullen zijn.</p>");



        //---------------------------------------------------------------------------

        /* Toon form MZ selecteren */ include('../forms/select_mz.php');

        //---------------------------------------------------------------------------



        //----------------------------------------------------------

        $query = "

        SELECT

            bl.id as betrokken_id,

            m.naam as mzorg_naam ,

            m.voornaam as mzorg_voornaam,

            v.naam as verwsch_naam,

            m.id as mzorg_id

        FROM

            mantelzorgers m,

            verwantschap v,

            $tabel bl

        WHERE
            $overlegGenreVoorwaarde
            v.id=m.verwsch_id AND

            bl.persoon_id=m.id AND

            bl.genre = 'mantel' AND

            bl.$bijWieVeld=$bijWieValue AND

            m.actief = 1

        ORDER BY

            v.rangorde,bl.id";

        if ($result=mysql_query($query))

            {

            print ("

                <div align=\"center\">

                <table width=\"96%\" style=\"ffloat: left\">

                <tr>

                    <th width=\"10%\">Nr</th>

                    <th width=\"36%\">Naam Mantelzorger</th>

                    <th width=\"25%\">Verwantschap</th>

                    <th width=\"25%\">Actie</th>

                </tr>");

            for ($i=0; $i < mysql_num_rows ($result); $i++)

                {

                $teller=$i+1;

                $records= mysql_fetch_array($result);

                $veld1=($records[0]!="")?$records[0]:"&nbsp;&nbsp;";

                $veld2=($records[1]!="")?$records[1]:"&nbsp;&nbsp;";

                $veld3=($records[2]!="")?$records[2]:"";

                $veld4=($records[3]!="")?$records[3]:"&nbsp;&nbsp;";

                $veld5=($records[4]!="")?$records[4]:"&nbsp;&nbsp;";

                if ($veld3 == "" || $veld3 == " " || $veld3 == "  " || $veld3 == "   " ) {

                  $naamveld = $veld2;

                }

                else {

                  $naamveld =  $veld2." ".$veld3;

                }

                print ("

                <tr>

                    <td valign=top class='tabellen'>".$teller."</td>

                    <td valign=top class='tabellen'>

                    <a href=\"edit_mz.php?a_mzorg_id=".$veld5."\">$naamveld</td>

                    <td valign=top class='tabellen'>".$veld4."</td>

                    <td valign=top class='tabellen'><a href=\"overleg_plannen_select_mz_twee.php?wis_id=".

                    $veld1."&mz_id=".$veld5."$extraParameterWis{$menosExtraGetParam}\">wis</a></td></tr>");

                }

            print ("

            </table></div>");

        } // MantelzorgersLijstje weergeven

        //----------------------------------------------------------

?>

<script language="javascript">

function pasOp() {  

   if (document.zorgplanform.mzorg_naam.value=='') {

       return true;

   } 

   else {

     return confirm("De nieuwe mantelzorger is nog niet opgeslagen.\nWil je toch terug gaan naar het overzicht?");

  }

}

</script>

<form action="overleg_plannen_select_xvl_twee.php" method="post" name="nextform">

   <input type="hidden" name="vanWaar" value="<?= $vanWaar ?>" />

   <fieldset>

      <div style="text-align:center;">

<?php

  if ($vanWaar == "zorgTeam") {

?>

         <a style="text-decoration: none" href='zorgteam_bewerken.php<?= $menosGetParam ?>' onClick='return pasOp()'>

             <input type="button" value="Terug naar de teamsamenstelling" onclick="if (pasOp()) window.location='zorgteam_bewerken.php';" /></a>

<?php

  }

  else if ($vanWaar == "controle") {

?>
         <input type="hidden" name="overleg" value="<?= $controleOverleg ?>" />

         <a style="text-decoration: none" tabindex='5' href="controle.php?pat_code=<?= $_SESSION['pat_code'] ?>&overleg=<?= $controleOverleg ?>" onClick='return pasOp()'>

             <input type="button" value="Terug naar de controle van de teamsamenstelling" onclick="if (pasOp()) window.location='controle.php?pat_code=<?= $_SESSION['pat_code'] ?>&overleg=<?= $controleOverleg ?>';" /></a>

<?php

  }

  else {

?>

         <a style="text-decoration: none" href='overleg_alles.php?tab=Teamoverleg' onclick='return pasOp()'>

             <input type="button" value="Terug naar het overzicht" onclick="if (pasOp()) window.location='overleg_alles.php?tab=Teamoverleg';" /></a>

<?php

  }

?>

      </div>

   </fieldset>

</form><!--Button verder -->

<?php

        }

    //---------------------------------------------------------

    /* Sluit Dbconnectie */ include("../includes/dbclose.inc");

    //---------------------------------------------------------



    print("&nbsp;<br />&nbsp;<br /><div style=\"clear: both; text-align:left\">

            (*) Onder <b>mantelzorgers</b> wordt verstaan: familieleden, buren, vrienden, kennissen, ...<br />&nbsp;</div>");



    print("</div>");

    print("</div>");

    print("</div>");

    include("../includes/footer.inc");

    print("</div>");

    print("</div>");

    print("</body>");

    print("</html>");



//---------------------------------------------------------

/* Geen Toegang */ include("../includes/check_access.inc");

//---------------------------------------------------------

?>