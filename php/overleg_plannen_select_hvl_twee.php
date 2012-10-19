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
    $action = "overleg_plannen_select_hvl_twee.php?menos=1";
  }
  else {
    $action = "overleg_plannen_select_hvl_twee.php";
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

    $backpage =  "overleg_plannen_select_hvl_twee.php";

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

    $backpage =  "overleg_plannen_select_partners_twee.php?overleg={$controleOverleg}";

  }

  else {

    $vanWaar = "overleg";

    $tabel = "huidige_betrokkenen";

    $bijWieVeld = "patient_code";

    $bijWieValue = "'{$_SESSION['pat_code']}'";

    $backpage =  "overleg_plannen_select_hvl_twee.php";

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

            WHERE $overlegGenreVoorwaarde
                  persoon_id=".$_POST['hvl_id']."

            AND genre = 'hulp'

            AND $bijWieVeld=$bijWieValue";

        $doeBestaatSql=mysql_query($bestaatSql);

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

               $melding="De HVLgegevens zijn <b>succesvol ingevoegd</b>.<br>";

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
        $hvl = getUniqueRecord("select hvl.* from hulpverleners hvl inner join $tabel betr
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

if ($_SESSION['isOrganisator']==1) {
  preset($_SESSION['organisatie']);
  $nietZelf = " and not (o.id = {$_SESSION['organisatie']} and h.naam = \"{$_SESSION['naam']}\" and h.voornaam = \"{$_SESSION['voornaam']}\") ";
}

//----------------------------------------------------------
    if ($records['type']==16 || $records['type']==18) {
       $controleGGZ = "not (((o.ggz = 1) or f.id in (62,76,117))) AND ";
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

            hulpverleners h,

            organisatie o,

            functies f

        WHERE
            $controleGGZ
            o.id = h.organisatie AND

            h.fnct_id = f.id AND

            h.actief = 1 AND

            o.genre = 'HVL'
            
            $nietZelf

        ORDER BY

             UCASE(h.naam),UCASE(h.voornaam)";

      if ($result=mysql_query($query) or die("<h1>$query " . mysql_error() . "</h1>"))

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





         print ("var hvlList = Array();\n");

         $hvlList = "";

         for ($i=0; $i < mysql_num_rows ($result); $i++)

            {

            $records= mysql_fetch_array($result);

            print("hvlList[2*$i] = \"{$records['hvl_naam']} {$records['hvl_voornaam']} - {$records['fnct_naam']}\";hvlList[2*$i+1]=\"{$records['hvl_id']}\"\n");

            $hvlList .= (",\"".$records[1]." ".$records[2]."  -  ".$records[3]."\",\"".$records[0]."\",\n");

           if ($letter==substr($records['hvl_naam'],0,1) || $letter2 == substr($records['hvl_naam'],0,1)) {

              $hash .= "zvlHash['$letter'] = $i;\n";

              $hash .= "zvlHash['$letter2'] = $i;\n";

              $letter = substr($zoek,0,1);

              $letter2 = substr($zoek,1,1);

              $zoek = substr($zoek,2);

           }



            }

        print ($hash);



         } // HulpverlenersLijst opvullen

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

    print("<h1>Hulpverleners toevoegen aan het {$menosToevoeging}zorgteam</h1>

            <p>Selecteer uit onderstaande lijst de <b>hulpverleners(*)</b> 

            die op het overleg aanwezig zullen zijn.</p>");





    //---------------------------------------------------------------------------

    /* Toon form ZVL selecteren */ include('../forms/select_hvl.php');

    //---------------------------------------------------------------------------



    //----------------------------------------------------------

    // HulpverlenersLijstje weergeven

    $query = "

        SELECT

            bl.id,

            h.naam as hvl_naam,

            h.voornaam as hvl_voornaam,

            f.naam as fnct_naam,

                h.riziv1,

                h.riziv2,

                h.riziv3,

                h.tel,

                h.organisatie,

                h.*

        FROM

            hulpverleners h,

            functies f,

            $tabel bl,

            organisatie o

        WHERE
            $controleGGZ
            $overlegGenreVoorwaarde
            h.organisatie = o.id AND

            o.genre = 'HVL' AND

            h.fnct_id=f.id AND

            bl.persoon_id=h.id AND

            bl.genre = 'hulp' AND

            bl.$bijWieVeld=$bijWieValue

        ORDER BY

            f.rangorde,bl.id";



    if ($result=mysql_query($query))

        {

        $teller=0;

        print ("<table width=\"96%\" style=\"float: left\">

                <tr>

                    <th width=\"10%\">Nr</th>

                    <th width=\"36%\">Naam hulpverlener (HVL)</th>

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

            switch ($records['convenant']) {

              case 'afgesloten':

                $convenant = "individuele convenant";

                break;

              case 'gezamenlijk':

                $convenant = "gezamenlijke convenant";

                break;

              case 'niet':

                $convenant = "nog geen convenant";

                break;

              default:

                $convenant = "convenant onbekend";

                break;

            }



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

                      <a href='edit_verlener.php?id={$records[id]}&backpage=overleg_plannen_select_hvl_twee.php'>$veld2 $veld3</a></td>

                    <td valign=\"top\" class=\"tabellen\">".$veld4."</td>

                    <td valign=\"top\" class=\"tabellen\">

                        <a href=\"overleg_plannen_select_hvl_twee.php?wis_id=".$veld1."$extraParameterWis{$menosExtraGetParam}\">wis</a>

                    </td></tr>");

            echo <<< EINDE

            <div class="aankeiler" id="zvl$i">

               <div style="position:absolute;left: 5px; top: 2px;">

                   {$orgNaam['naam']}<br />Email: {$records['email']}

               </div>

               <div style="position:absolute;left: 5px; top: 25px;">

                   {$adres}<br />{$dlzip} {$dlnaam} <br />

                   &nbsp; <!-- $convenant -->

               </div>

               <div style="position:absolute;left: 220px; top: 25px;">

                   Tel: {$records['tel']}<br />GSM: {$records['gsm']}<br />

                   Fax: {$records['fax']}

               </div>

            </div>



EINDE;

            }

        print ("</div></table>");

        }

    //----------------------------------------------------------



?>

<script language="javascript">

function pasOp() {  

   if (document.hvlform.IIHvl.value=='') {

       return true;

   } 

   else {

     return confirm("De nieuwe hulpverlener is nog niet opgeslagen.\nWil je toch terug gaan naar het overzicht?");

  }

}

</script>

<form onsubmit="return false;" name="nextform">

   <input type="hidden" name="vanWaar" value="<?= $vanWaar ?>" />

   <fieldset>

      <div style="text-align:center;">

<?php

  if ($vanWaar == "zorgTeam") {

?>         <a style="text-decoration: none" tabindex='5' href='zorgteam_bewerken.php<?= $menosGetParam ?>' onClick='return pasOp()'>

             <input type="button" value="Terug naar de teamsamenstelling" onclick="if (pasOp()) window.location='zorgteam_bewerken.php';" /></a>

<?php

  }

  else if ($vanWaar == "controle") {

?>
         <input type="hidden" name="overleg" value="<?= $controleOverleg ?>" />

         <a style="text-decoration: none" tabindex='5' href="controle.php?pat_code=<?= $_SESSION['pat_code'] ?>&overleg=<?= $controleOverleg ?>" onClick='return pasOp()'>

             <input type="button" value="Terug naar de controle van de teamsamenstelling" onclick="if (pasOp()) window.location='controle.php?pat_code=<?= $_SESSION['pat_code'] ?>&overleg=<?= $controleOverleg ?>';"/></a>

<?php

  }

  else {

?>

         <a style="text-decoration: none" tabindex='5' href='overleg_alles.php?tab=Teamoverleg' onclick='return pasOp()'>

             <input type="button" value="Terug naar het overzicht" onclick="if (pasOp()) window.location='overleg_alles.php?tab=Teamoverleg';" /></a>

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



    print("&nbsp;<br />&nbsp;<br /><div style=\"clear:both; text-align:left\">

            <p>(*)Onder <b>hulpverleners</b> wordt voor de toepassing van het Koninklijk Besluit 

            verstaan: psychologen, psychotherapeuten, ergotherapeuten, maatschappelijk werkers, 

            deskundigen van een dienst voor gezinszorg en deskundigen van een uitleendienst, 

            vertegenwoordigd in of een overeenkomst hebbende met een ge&iuml;ntegreerde dienst voor

            thuisverzorging.</p>

            <p>

            In de praktijk: maatschappelijk werkers, verantwoordelijken van een dienst voor 

            gezinszorg, verzorgenden, poetshulpen, thuisbegeleiders, di&euml;tisten, ergotherapeuten,

            logopedisten, orthopedagogen, psychologen, psychotherapeuten actief binnen de 1ste lijn, ...</p>

            <p>

            <p>Bekijk hier de lijst van <a href=\"lijst_partners2.php?genre=HVL\" target=\"_blank\">organisaties HULPverleners</a> opgenomen in GDT</p>

            <!--

            <b>Betrokken organisaties:</b><br />

            beschut wonen en begeleid wonen, centra voor algemeen welzijn, CAD’s, CGG’s, 

            dienstencentra, dagverzorgingscentra, maatschappelijk werk van mutualiteiten, 

            diensten voor gezinszorg, specifieke thuisbegeleiding van het Multiple Sclerose- 

            en Neurologisch Revalidatiecentrum; thuisbegeleiding van Man&eacute;, dienstverlening van OCMW’s, ...</p>

            -->

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