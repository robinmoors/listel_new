<?php

session_start();

$paginanaam="Zorgverleners selecteren";



  $vanuitZorgTeam = strpos($_SERVER['HTTP_REFERER'], "zorgteam");

  $vanuitControle = strpos($_SERVER['HTTP_REFERER'], "controle");

  if ($_GET['menos']==1) {
    $overlegGenreVoorwaarde = " overleggenre = 'menos' and ";
    $overlegGenre = 'menos';
    $menosGetParam = "?menos=1";
    $menosExtraGetParam = "&menos=1";
    $vanuitZorgTeam = true;
    $menosToevoeging = "menos-";
    $action = "overleg_plannen_select_xvl_twee.php?menos=1";
  }
  else {
    $action = "overleg_plannen_select_xvl_twee.php";
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

  else if (!empty($vanuitControle) || ($_POST['vanWaar'] == "controle") || isset($_GET['overleg'])) {
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
{
     //----------------------------------------------------------
     /* Maak Dbconnectie */ include('../includes/dbconnect2.inc');
     //----------------------------------------------------------
    $records=mysql_fetch_array(mysql_query("SELECT id,naam,voornaam,type FROM patient
                                            WHERE code='{$_SESSION['pat_code']}'"));


    if(isset($_POST['hvl_id'])&&($_POST['hvl_id']!="")&&($_SESSION['pat_code']!=""))

        { 

        //--------------------------------------------------------------

        // HVL-gegevens enkel opslaan indien deze nog niet voorkomen bij

        // deze patient, anders worden dingen dubbel opgeslaan

        // dus eerst nagaan of de toe te voegen HVL reeds bestaat

        $bestaatSql="

            SELECT * 

            FROM $tabel

            WHERE $overlegGenreVoorwaarde persoon_id=".$_POST['hvl_id']."

            AND genre = 'hulp'

            AND $bijWieVeld=$bijWieValue";

        $doeBestaatSql=mysql_query($bestaatSql) or die($bestaatSql);

        if (mysql_num_rows($doeBestaatSql)==0)

            {

            //--------------------------------------------------------------                

            // hvl gegevens worden opgeslaan

            $sql1 = "

                INSERT INTO

                    $tabel

                        (persoon_id, genre, $bijWieVeld, aanwezig, overleggenre)

                    VALUES

                        ('".$_POST['hvl_id']."','hulp',$bijWieValue, 1, '$overlegGenre')";

            if ($result=mysql_query($sql1)) {

               $melding="Gegevens zijn <b>succesvol ingevoegd</b>.<br>";

               if (is_tp_patient()  && ($bijWieVeld != "overleg_id")) {

                $overlegRij = getHuidigOverleg();

                $overlegID = $overlegRij['id'];

                $sql1Plus = "

                    INSERT INTO overleg_tp_plan

                        (overleg, persoon, genre)

                    VALUES

                        ($overlegID, '".$_POST['hvl_id']."','hulp')";

                 $result=mysql_query($sql1Plus) or die("wat is dat hier $sql1Plus " . mysql_error());

               }
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
                                    where overleggenre = 'gewoon' and persoon_id = {$_POST['hvl_id']} and genre = 'hulp' and $bijWieVeld = $bijWieValue";
                     $resultTestGDT = mysql_query($sqlTestGDT) or die("wat is dat hier $sqlTestGDT " . mysql_error());
                     $sqlGDT = "
                        INSERT INTO huidige_betrokkenen (persoon_id, genre, $bijWieVeld, aanwezig, overleggenre)
                        VALUES ('".$_POST['hvl_id']."','hulp', $bijWieValue, 1, 'gewoon')";
                     if (mysql_num_rows($resultTestGDT) == 0) {
                       $resultGDT = mysql_query($sqlGDT) or die("wat is dat hier $sqlGDT " . mysql_error());
                       $melding = $melding . "<br/>De betrokkene is ook toegevoegd aan het GDT-zorgteam.";
                       // mail versturen
                       $mensen = organisatorenVanPatient($bijWieValue);
                       for ($i=0; $i<mysql_num_rows($mensen); $i++) {
                         $pc  = mysql_fetch_assoc($mensen);
                         $namen .= ", {$pc['naam']} {$pc['voornaam']}";
                         $adressen .= ", {$pc['email']}";
                       }

                       $namen = substr($namen, 1);
                       $adressen = substr($adressen, 1);

                       $hvl = getUniqueRecord("select * from hulpverleners where id = {$_POST['hvl_id']}");

                       htmlmail($adressen,"Listel: toevoeging aan GDT-zorgteam","Beste $namen<br/>Vanuit Menos is {$hvl['voornaam']} {$hvl['naam']} toegevoegd aan het zorgteam van pati&euml;nt $bijWieValue.
                                                   En zoals aangeduid op het formulier met de pati&euml;nt-gegevens, is deze betrokkene ook toegevoegd aan het GDT-zorgteam.
                                                   <br />Het LISTEL e-zorgplan www.listel.be </p>");
                     }
                   }
                   else if (($overlegGenre == 'gewoon' || $overlegGenre == 'psy') && (abs($zoekMenos['menos'])==1) && $zoekMenos['gdt2menos_vraag'] == 1 && $zoekMenos['gdt2menos_toestemming'] == 1) {
                     // van gdt naar menos
                     $sqlTestGDT = "select * from huidige_betrokkenen
                                    where overleggenre = 'menos' and persoon_id = {$_POST['hvl_id']} and genre = 'hulp' and $bijWieVeld = $bijWieValue";
                     $resultTestGDT = mysql_query($sqlTestGDT) or die("wat is dat hier $sqlTestGDT " . mysql_error());
                     $sqlGDT = "
                        INSERT INTO huidige_betrokkenen (persoon_id, genre, $bijWieVeld, aanwezig, overleggenre)
                        VALUES ('".$_POST['hvl_id']."','hulp', $bijWieValue, 1, 'menos')";
                     if (mysql_num_rows($resultTestGDT) == 0) {
                       $resultGDT = mysql_query($sqlGDT) or die("wat is dat hier $sqlGDT " . mysql_error());
                       $melding = $melding . "<br/>De betrokkene is ook toegevoegd aan het Menos-zorgteam.";
                       // mail versturen
                       $mensen = menosOrganisatorenVanPatient($bijWieValue);
                       for ($i=0; $i<mysql_num_rows($mensen); $i++) {
                         $pc  = mysql_fetch_assoc($mensen);
                         $namen .= ", {$pc['naam']} {$pc['voornaam']}";
                         $adressen .= ", {$pc['email']}";
                       }

                       $namen = substr($namen, 1);
                       $adressen = substr($adressen, 1);

                       $hvl = getUniqueRecord("select * from hulpverleners where id = {$_POST['hvl_id']}");

                       htmlmail($adressen,"Listel: toevoeging aan Menos-zorgteam","Beste $namen<br/>Vanuit GDT is {$hvl['voornaam']} {$hvl['naam']} toegevoegd aan het zorgteam van pati&euml;nt $bijWieValue.
                                                   En zoals aangeduid op het formulier met de pati&euml;nt-gegevens, is deze betrokkene ook toegevoegd aan het Menos-zorgteam.
                                                   <br />Het LISTEL e-zorgplan www.listel.be </p>");
                     }
                   }
                 }
               }
              /************** einde overdracht tussen zorgteams GDT en Menos *************/

            }

            else

                {$melding="HVLgegevens zijn <b>niet succesvol ingevoegd</b>,<br>".$sql1;}

            //--------------------------------------------------------------

            }

        else

            {$melding="HVL Er ontbreken gegevens hvl_id of pat_id";}

        //--------------------------------------------------------------

        }



    if(isset($_GET['wis_id']))

        {

        //-----------------------------------------------

        // link HVL en patient wordt verwijderd

         $overlegInfo = getHuidigOverleg();

        if ($overlegInfo['genre']=='TP'  && ($bijWieVeld != "overleg_id")) {

          $selectDeleteInfo = "select * from $tabel where id = {$_GET['wis_id']}";

          $deleteInfo = mysql_fetch_assoc(mysql_query($selectDeleteInfo));

          $delQuery2 = "delete from overleg_tp_plan where persoon = {$deleteInfo['persoon_id']} and genre = '{$deleteInfo['genre']}' and overleg = {$overlegInfo['id']}";

          mysql_query($delQuery2);

        }

        $hvl = getUniqueRecord("select hvl.* from hulpverleners hvl inner join huidige_betrokkenen betr
                                on /* $overlegGenreVoorwaarde */ betr.id = {$_GET['wis_id']} and betr.persoon_id = hvl.id and betr.genre = 'hulp'");


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

                       htmlmail($adressen,"Listel: verwijdering uit GDT-zorgteam","Beste $namen<br/>Vanuit Menos is {$hvl['voornaam']} {$hvl['naam']} verwijderd uit het zorgteam van pati&euml;nt $bijWieValue.
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

                       htmlmail($adressen,"Listel: verwijdering uit Menos-zorgteam","Beste $namen<br/>Vanuit GDT is {$hvl['voornaam']} {$hvl['naam']} verwijderd uit het zorgteam van pati&euml;nt $bijWieValue.
                                                   En zoals aangeduid op het formulier met de pati&euml;nt-gegevens, wordt u hiervan verwittigd, maar de verwijdering gebeurt niet automatisch.
                                                   <br />Het LISTEL e-zorgplan www.listel.be </p>");
                   }
                 }
               }
              /************** einde overdracht tussen zorgteams GDT en Menos *************/
        }
        else

            {$melding="Bedrijfsgegevens zijn <b>niet succesvol verwijderd</b>,<br>".$sql1;}

        }

    else

        {$melding="Er ontbreken gegevens kan niet wissen";

        //-----------------------------------------------

        } 



    include("../includes/html_html.inc");

    print("<head>");

    include("../includes/html_head.inc");

    print("<script type=\"text/javascript\">");



//----------------------------------------------------------



if ($_GET['genre']=='xvlp') {

  $orgJoin = " left join organisatie on h.organisatie = organisatie.id ";

  $orgVW = " organisatie.genre = 'XVLP' AND ";

  $titel = "Professionele hulpverleners niet-GDT";

  $selecteer = "de professionele <b>hulpverleners niet-GDT(**)</b>";

  $uitleg = "<p>

            (**)Onder <b>niet opgenomen in GDT</b> wordt verstaan: sociale diensten van ziekenhuizen en rusthuizen

            of RVT's, diensten pati&euml;ntenbegeleiding, specialistische artsen (geriaters,

            psychiaters, cardiologen, neurologen, ...), palliatief deskundigen, psychologen,

            ergotherapeuten, kinesitherapeuten, verpleegkundigen of verzorgenden van

            ziekenhuizen en rusthuizen of RVT's, co&ouml;rdinerend geneesheren van rustoorden, ...</p>";

   $lijst = "<p>Bekijk hier de lijst van <a href=\"lijst_partners2.php?genre=XVLP\" target=\"_blank\">niet-GDT </a> professionele organisaties</p> ";

   $thisPage = "overleg_plannen_select_xvl_twee.php?genre=xvlp";

   if (isset($controleOverleg))

     $thisPage .= "&overleg={$controleOverleg}";

   $beperking = "&genre=xvlp";

}

else if ($_GET['genre']=='xvlnp') {

  $orgJoin = " left join organisatie on h.organisatie = organisatie.id ";

  $orgVW = " organisatie.genre = 'XVLNP' AND ";

  $titel = "Niet-professionelen";

  $selecteer = "de <b>niet professionelen(*)</b>";

  $uitleg = "<p>(*)Onder <b>niet professionelen</b> wordt verstaan: vrijwilligers

            van oppas- en gezelschapsdiensten.</p>";

   $lijst = "<p>Bekijk hier de lijst van <a href=\"lijst_partners2.php?genre=XVLNP\" target=\"_blank\">organisaties met niet-professionelen</a></p> ";

   $thisPage = "overleg_plannen_select_xvl_twee.php?genre=xvlnp";

   if (isset($controleOverleg))

     $thisPage .= "&overleg={$controleOverleg}";

   $beperking = "&genre=xvlnp";

}

else {

  $orgJoin = " left join organisatie on h.organisatie = organisatie.id ";

  $orgVW = " (organisatie.genre = 'XVLNP' or organisatie.genre = 'XVLP') AND ";

  $titel = "niet-GDT of niet-professionelen";

  $selecteer = "de <b>niet professionelen(*)</b> en de<br /> <b>hulpverleners niet-GDT(**)</b>";

  $uitleg = "<p>(*)Onder <b>niet professionelen</b> wordt verstaan: vrijwilligers

            van oppas- en gezelschapsdiensten.<br />

            (**)Onder <b>niet-GDT</b> wordt verstaan: sociale diensten van ziekenhuizen en rusthuizen

            of RVT's, diensten pati&euml;ntenbegeleiding, specialistische artsen (geriaters,

            psychiaters, cardiologen, neurologen, ...), palliatief deskundigen, psychologen,

            ergotherapeuten, kinesitherapeuten, verpleegkundigen of verzorgenden van

            ziekenhuizen en rusthuizen of RVT's, co&ouml;rdinerend geneesheren van rustoorden, ...</p>";

   $lijst = "<p>Bekijk hier de lijst van <a href=\"lijst_partners2.php?genre=XVL\" target=\"_blank\">organisaties XVL</a></p> ";

   $thisPage = "overleg_plannen_select_xvl_twee.php";

   if (isset($controleOverleg))

     $thisPage .= "&overleg={$controleOverleg}";

}




    if ($records['type']==16 || $records['type']==18) {
       $controleGGZ = "not (((organisatie.ggz = 1) or f.id in (62,76,117))) AND ";
    }

    $query = "

        SELECT

            h.id as hvl_id,

            h.naam as hvl_naam,

            h.voornaam as hvl_voornaam,

            f.naam  as fnct_naam,

                h.riziv1,

                h.riziv2,

                h.riziv3,

                h.tel,

                h.organisatie

        FROM

            functies f,

            hulpverleners h

            $orgJoin

        WHERE
            $controleGGZ
            $orgVW

            h.fnct_id=f.id AND

            h.actief = 1

        ORDER BY

             UCASE(h.naam),UCASE(h.voornaam)";

      if ($result=mysql_query($query))

         {

        print ("var zvlHash = Array();//zvlHash init voor ongevulde letters \n");

        $zoek1 = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";

        for ($i=0; $i < 26; $i++) {

          $letter = substr($zoek1, 0, 1);

          print("zvlHash['$letter'] = 0;\n");

          $zoek1 = substr($zoek1,1);

        }

        $zoek = "BbCcDdEeFfGgHhIiJjKkLlMmNnOoPpQqRrSsTtUuVvWwXxYyZz__";

        $letter = "A";$letter2 = "a";

         print ("var andereList = Array();\n");

         $xvlList = "";

         for ($i=0; $i < mysql_num_rows ($result); $i++)

            {

            $records= mysql_fetch_array($result);

            print("andereList[2*$i] = \"{$records['hvl_naam']} {$records['hvl_voornaam']} - {$records['fnct_naam']}\";andereList[2*$i+1]=\"{$records['hvl_id']}\"\n");

           if ($letter==substr($records['hvl_naam'],0,1) || $letter2 == substr($records['hvl_naam'],0,1)) {

              $hash .= "zvlHash['$letter'] = $i;\n";

              $hash .= "zvlHash['$letter2'] = $i;\n";

              $letter = substr($zoek,0,1);

              $letter2 = substr($zoek,1,1);

              $zoek = substr($zoek,2);

           }

            }

        print ($hash);

         } // AndereLijst opvullen
         else die($query . " - "  . mysql_error());

//----------------------------------------------------------

?>

</script>

<?

    print("</head>");

    print("<body>");

    print("<div align=\"center\">");

    print("<div class=\"pagina\">");

    include("../includes/header.inc");

    include("../includes/pat_id.inc");

    print("<div class=\"contents\">");

    include("../includes/menu.inc");

    print("<div class=\"main\">");

    print("<div class=\"mainblock\">");

    print("<h1>Hulpverleners XVL toevoegen aan het {$menosToevoeging}zorgteam</h1>

            <p>Selecteer uit onderstaande lijst $selecteer die op het overleg aanwezig zullen zijn.</p>");





    //---------------------------------------------------------------------------

    /* Toon form XVL selecteren */ include('../forms/select_xvl.php');

    //---------------------------------------------------------------------------



    //----------------------------------------------------------

    // Anderen (XVL) Lijstje weergeven

    $query = "

        SELECT

            bl.id,

            h.naam as hvl_naam,

            h.voornaam as hvl_voornaam,

            f.naam as fnct_naam,

            h.organisatie,

            h.tel,

            h.riziv1, h.riziv2, h.riziv3,

            h.*

        FROM

            functies f,

            $tabel bl,

            hulpverleners h

            $orgJoin

        WHERE
            $controleGGZ
            $overlegGenreVoorwaarde
            $orgVW

            h.fnct_id=f.id AND

            bl.persoon_id=h.id AND

            bl.genre = 'hulp' AND

            bl.$bijWieVeld=$bijWieValue

        ORDER BY

            f.rangorde,bl.id";



    if ($result=mysql_query($query))

        {





        $teller=0;

        print ("

            <table width=\"96%\" style=\"float: left\">

                <tr>

                    <th width=\"10%\">Nr</th>

                    <th width=\"36%\">Naam XVL</th>

                    <th width=\"35%\">Functie</th>

                    <th width=\"15%\">Actie</th>

                </tr>");

        for ($i=0; $i < mysql_num_rows ($result); $i++)

            {

            $records= mysql_fetch_array($result);

            $veld1=($records[0]!="")?$records[0]:"&nbsp;&nbsp;";

            $veld2=($records[1]!="")?$records[1]:"&nbsp;&nbsp;";

            $veld3=($records[2]!="")?$records[2]:"&nbsp;&nbsp;";

            $veld4=($records[3]!="")?$records[3]:"&nbsp;&nbsp;";



              // organisatie ophalen

              if (issett($records['organisatie'])) {

                 $orgNaam = mysql_fetch_array(mysql_query("select * from organisatie where id = {$records['organisatie']}"));

                 $titel = $orgNaam['naam'];

                 if (!isset($records['adres']) || $records['adres']=="") {

                   $adres =  $orgNaam['adres'];

                   $gem_id = $orgNaam['gem_id'];

                 }

                 else {

                   $adres = $records['adres'];

                   $gem_id = $records['gem_id'];

                 }

                 if (issett($gem_id)) {

                   $gemeenteRecords = mysql_fetch_array(mysql_query("select dlnaam, dlzip from gemeente where id= $gem_id"));

                   $dlnaam = $gemeenteRecords['dlnaam'];

                   $dlzip = $gemeenteRecords['dlzip'];

                 }

                 if ($records['tel'] == "")  $records['tel'] = $orgNaam['tel'];

                 if ($records['fax'] == "")  $records['fax'] = $orgNaam['fax'];

                 if ($records['gsm'] == "")  $records['gsm'] = $orgNaam['gsm'];

                 if ($records['email'] == "")  $records['email'] = $orgNaam['email_inhoudelijk'];

              }

              else

                $titel = "tel. {$records['tel']}";



            print ("

                <tr onMouseMove=\"toon('zvl$i', event);\" onMouseOut=\"zetAf('zvl$i');\">

                    <td valign=\"top\" class=\"tabellen\">".($i+1).".</td>

                    <td valign=\"top\" ttitle=\"$titel\" class=\"tabellen\">

                      <a href='edit_verlener.php?id={$records[id]}&backpage=overleg_plannen_select_xvl_twee.php'>$veld2 $veld3</a></td>

                    <td valign=\"top\" class=\"tabellen\">".$veld4."</td>

                    <td valign=\"top\" class=\"tabellen\">

                        <a href=\"overleg_plannen_select_xvl_twee.php?wis_id=".$veld1."$beperking$extraParameterWis{$menosExtraGetParam}\">wis</a>

                    </td></tr>");

            echo <<< EINDE

         <div class="aankeiler" id="zvl$i">

               <div style="position:absolute;left: 6px; top: 2px;">

                   {$orgNaam['naam']}<br />Email: {$records['email']}

               </div>

               <div style="position:absolute;left: 5px; top: 25px;">



                   {$adres}<br />{$dlzip} {$dlnaam} <br />

               </div>

               <div style="position:absolute;left: 220px; top: 25px;">

                   Tel: {$records['tel']}<br />GSM: {$records['gsm']}<br />

                   Fax: {$records['fax']}

               </div>

            </div>



EINDE;

            }

        print ("</table>");

        }

    //----------------------------------------------------------

?>

<script language="javascript">

function pasOp() {  

   if (document.andereform.IIAndere.value=='') {

       return true;

   } 

   else {

     return confirm("De nieuwe hulpverlener is nog niet opgeslagen.\nWil je toch terug gaan naar het overzicht?");

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

         <a style="text-decoration: none" tabindex='5' href='zorgteam_bewerken.php<?= $menosGetParam ?>' onclick='return pasOp()'>

             <input type="button" value="Terug naar de teamsamenstelling" onclick="if (pasOp()) window.location='zorgteam_bewerken.php';" /></a>

<?php

  }

  else if ($vanWaar == "controle") {

?>
         <input type="hidden" name="overleg" value="<?= $controleOverleg ?>" />

         <a style="text-decoration: none" tabindex='5' href="controle.php?pat_code=<?= $_SESSION['pat_code'] ?>&overleg=<?= $controleOverleg ?>" onclick='return pasOp()'>

             <input type="button" value="Terug naar de controle van de teamsamenstelling"  onclick="if (pasOp()) window.location='controle.php?pat_code=<?= $_SESSION['pat_code'] ?>&overleg=<?= $controleOverleg ?>';"/></a>

<?php

  }

  else {

?>

         <a style="text-decoration: none" tabindex='5' href='overleg_alles.php?tab=Teamoverleg' onClick='return pasOp()'>

             <input type="button" value="Terug naar het overzicht"  onclick="if (pasOp()) window.location='overleg_alles.php?tab=Teamoverleg';"/></a>

<?php

  }

?>

      </div>

   </fieldset>

</form><!--Button verder -->



<?php



    //---------------------------------------------------------

    /* Sluit Dbconnectie */ include("../includes/dbclose.inc");

    //---------------------------------------------------------



    print("&nbsp;<br />&nbsp;<br /><div style=\"clear: both;text-align:left\">

            $uitleg

            <p>&nbsp;</p>

            $lijst

            &nbsp;</div>");



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