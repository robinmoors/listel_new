<?php

session_start();

$paginanaam="Geestelijke gezondheidszorg selecteren";



  $vanuitZorgTeam = strpos($_SERVER['HTTP_REFERER'], "zorgteam");

  $vanuitControle = strpos($_SERVER['HTTP_REFERER'], "controle");

  if ($_GET['menos']==1) {
    $overlegGenreVoorwaarde = " overleggenre = 'menos' and ";
    $overlegGenre = 'menos';
    $menosGetParam = "?menos=1";
    $menosExtraGetParam = "&menos=1";
    $vanuitZorgTeam = true;
    $menosToevoeging = "menos-";
    $action = "overleg_plannen_select_ggz_twee.php?menos=1";
  }
  else {
    $action = "overleg_plannen_select_ggz_twee.php";
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
    $backpage =  "overleg_plannen_select_ggz_twee.php";
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
    $backpage =  "overleg_plannen_select_ggz_twee.php?overleg={$controleOverleg}";
  }
  else {
    $vanWaar = "overleg";
    $tabel = "huidige_betrokkenen";
    $bijWieVeld = "patient_code";
    $bijWieValue = "'{$_SESSION['pat_code']}'";
    $backpage =  "overleg_plannen_select_ggz_twee.php";
  }

    if (isset($_GET['menos']) || isset($_POST['menos']))
      if (strpos($a_backpage, "?") > 0)
         $backpage .= "&menos=1";
      else
         $backpage .= "?menos=1";


if (isSet($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan"))
//----------------------------------------------------------
/* Maak Dbconnectie */ include('../includes/dbconnect2.inc');
//----------------------------------------------------------
    {
    //----------------------------------------------------------
    $records=mysql_fetch_array(mysql_query("SELECT id,naam,voornaam,type FROM patient
                                            WHERE code='{$_SESSION['pat_code']}'"));
    $pat_id=$records['id'];
    $pat_naam = $records['naam'];
    $pat_voornaam=$records['voornaam'];

    //----------------------------------------------------------

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
                        ('".$_POST['hvl_id']."','hulp', $bijWieValue, 1, '$overlegGenre')";


            if ($result=mysql_query($sql1)) {
               $melding="GGZgegevens zijn <b>succesvol ingevoegd</b>.<br>";
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
                       $melding = $melding . "<br/>De zorgverlener is ook toegevoegd aan het GDT-zorgteam.";
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
                {$melding="GGZgegevens zijn <b>niet succesvol ingevoegd</b>,<br>".$sql1;}
            //--------------------------------------------------------------
            }
        else
           {$melding="GGZ Er ontbreken gegevens hvl_id of pat_code";}
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

    
if ($_SESSION['isOrganisator']==1) {
  preset($_SESSION['organisatie']);
  $nietZelf = " and not (h.organisatie = {$_SESSION['organisatie']} and h.naam = \"{$_SESSION['naam']}\" and h.voornaam = \"{$_SESSION['voornaam']}\") ";
}



    //----------------------------------------------------------

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
            functies f,
            organisatie org
        WHERE
            h.organisatie = org.id AND
            ((org.ggz = 1) or f.id in (62,76,117)) AND
            h.actief = 1 AND
            h.fnct_id=f.id
            $nietZelf
        ORDER BY
             UCASE(h.naam),UCASE(h.voornaam)";


        print ("var zvlHash = Array();//zvlHash init voor ongevulde letters \n");

        $zoek1 = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";

        for ($i=0; $i < 26; $i++) {

          $letter = substr($zoek1, 0, 1);

          print("zvlHash['$letter'] = 0;\n");

          $zoek1 = substr($zoek1,1);

        }



        $zoek = "BbCcDdEeFfGgHhIiJjKkLlMmNnOoPpQqRrSsTtUuVvWwXxYyZz__";

        $letter = "A";$letter2 = "a";







             

    if ($result=mysql_query($query))

    {
        // ZorgverlenersLijst opvullen

        print ("var zvlList = Array();\n");

        for ($i=0; $i < mysql_num_rows ($result); $i++)

        {

            $records= mysql_fetch_array($result);

            print("zvlList[2*$i] = \"{$records[1]} {$records[2]} - {$records[3]}\";zvlList[2*$i+1]=\"{$records[0]}\"\n");

           if ($letter==substr($records['hvl_naam'],0,1) || $letter2 == substr($records['hvl_naam'],0,1)) {

              $hash .= "zvlHash['$letter'] = $i;\n";

              $hash .= "zvlHash['$letter2'] = $i;\n";

              $letter = substr($zoek,0,1);

              $letter2 = substr($zoek,1,1);

              $zoek = substr($zoek,2);

           }

        }

        print ($hash);



    }
    else {
       print("Queryfout $query " . mysql_error());
    }

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

    print("<h1>GGZ-medewerkers toevoegen aan het {$menosToevoeging}zorgteam</h1>

            <p>Selecteer uit onderstaande lijst de <b>medewerkers GGZ</b>

            die betrokken zijn bij deze patient.</p>");
?>

<form method="post" action="<?= $action ?>" name="zvlform" class="select_vl"  autocomplete="off">

    <input type="hidden" name="vanWaar" value="<?= $vanWaar ?>" />
    <input type="hidden" name="overleg" value="<?= $controleOverleg ?>" />

    <fieldset>

        <div class="legende">GGZ-werkers</div>
        <div>&nbsp;</div>

<table>
<tr>
<td>
            <div class="label160">Naam GGZ-medewerker&nbsp;: </div>
</td>
<td>
            <div class="waarde">
              <input id="hierbeginnen" class="invoer" style="margin-left: -7px;" tabindex="1"

                 onKeyUp="refreshListHash('zvlform','IIZvl','hvl_id',1,'IIZvlS',zvlList,50,zvlHash)"

                 onmouseUp="showCombo('IIZvlS',100)" onfocus="showCombo('IIZvlS',100)" type="text" name="IIZvl" value="" />

              <input type="button" onClick="resetList('zvlform','IIZvl','hvl_id',1,'IIZvlS',zvlList,999,100)" value="<<">

            </div>
        <div id="IIZorgverlener">


        </div>
</td>
</tr>
</table>


        <div class="inputItem" id="IIZvlS">

            <div class="label160">Kies eventueel&nbsp;:</div>

            <div class="waarde">

                <select class="invoer" tabindex="2"

                onBlur="handleSelectClick('zvlform','IIZvl','hvl_id',1,'IIZvlS')"

                onClick="handleSelectClick('zvlform','IIZvl','hvl_id',1,'IIZvlS')" name="hvl_id" size="5">

                </select>

            </div>

        </div><!--Naam zorgverlener-->

        <div class="label160">Deze persoon&nbsp;:</div>

        <div class="waarde">

            <input type="submit" tabindex="3" value="toevoegen">&nbsp;

            <input type="button" tabindex="4" value="of een nieuwe maken"

            onClick="javascript:document.location='edit_verlener.php?a_backpage=<?= $backpage ?>'">

        </div><!--Button toevoegen -->

   </fieldset>

</form>

<script type="text/javascript">

    hideCombo('IIZvlS');

    document.getElementById('hierbeginnen').focus();

</script>

<?php
    //----------------------------------------------------------

    // ZorgverlenersLijstje weergeven

    print("<div align=\"center\">");

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

                h.organisatie           ,

                h.*,

                g.dlzip, g.dlnaam

        FROM

            hulpverleners h,

            functies f,

            $tabel bl,

            organisatie org,

            gemeente g

        WHERE
            ((org.ggz = 1) or f.id in (62,76,117)) AND
            $overlegGenreVoorwaarde
            h.organisatie = org.id AND
            h.fnct_id=f.id AND

            bl.persoon_id=h.id AND

            bl.genre = 'hulp' AND

            h.gem_id = g.id AND

            bl.$bijWieVeld = $bijWieValue

        ORDER BY

            f.rangorde,bl.id";
    if ($result=mysql_query($query))

        {

        $teller=0;

        print ("

            <table width=\"96%\" style=\"float: left\">

                <tr>

                    <th width=\"10%\">Nr</th>

                    <th width=\"36%\">Naam zorgverlener (ZVL)</th>

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

              default:

                $convenant = "convenant onbekend";

                break;

            }

            if (issett($records['organisatie']) && $records['organisatie']!=999 && $records['organisatie']!=1000) {

                 $orgNaam = mysql_fetch_array(mysql_query("select * from organisatie where id = {$records['organisatie']}"));

                 if ($records['adres'] == "" && isset($orgNaam['gem_id'])) {

                    $qry8="SELECT dlzip,dlnaam FROM gemeente WHERE id=".$orgNaam['gem_id'];

                    $gemeente=mysql_fetch_array(mysql_query($qry8));

                    $records['adres'] = $orgNaam['adres'];

                    $records['dlzip']=$gemeente['dlzip'];

                    $records['dlnaam']=$gemeente['dlnaam'];

                 }

                 if ($records['tel'] == "")  $records['tel'] = $orgNaam['tel'];

                 if ($records['fax'] == "")  $records['fax'] = $orgNaam['fax'];

                 if ($records['gsm'] == "")  $records['gsm'] = $orgNaam['gsm'];

                 if ($records['email'] == "")  $records['email'] = $orgNaam['email_inhoudelijk'];

            }

            else {

              $orgNaam['naam'] = "";

            }

            if (isset($records['riziv1']) && $records['riziv1'] != 0) {

              $rizivnr=  substr($records['riziv1'],0,1)."-".

                                   substr($records['riziv1'],1,5)."-".

                                   $records['riziv2']."-".$records['riziv3'];

              $titel = "rizivr: $rizivnr";

            }

            else {

              // organisatie ophalen

              if (issett($records['organisatie']) && $records['organisatie']!=999) {

                 $titel = $orgNaam['naam'];

              }

              else

                $titel = $records['tel'];

            }

            print ("

                <tr onMouseOver=\"toon('zvl$i', event);\"  onmousemove=\"toon('zvl$i', event);\" onMouseOut=\"zetAf('zvl$i');\">

                    <td valign=\"top\" class=\"tabellen\">".($i+1).".</td>

                    <td valign=\"top\" ttitle=\"$titel\" class=\"tabellen\">

                      <a href='edit_verlener.php?id={$records[id]}&backpage=$backpage'>$veld2 $veld3</a></td>

                    <td valign=\"top\" class=\"tabellen\">".$veld4."</td>

                    <td valign=\"top\" class=\"tabellen\">

                        <a href=\"overleg_plannen_select_zvl_twee.php?wis_id=".$veld1."{$extraParameterWis}{$extraWisParam}\">wis</a>

                    </td></tr>");

            echo <<< EINDE

            <div class="aankeiler" id="zvl$i">

               <div style="position:absolute;left: 5px; top: 2px;">

                   {$orgNaam['naam']}<br />Email: {$records['email']}

               </div>

               <div style="position:absolute;left: 5px; top: 25px;">

                   riziv {$rizivnr}<br />rek.nr {$records['iban']} <br />

                   {$records['adres']}<br />{$records['dlzip']} {$records['dlnaam']}

               </div>

               <div style="position:absolute;left: 220px; top: 25px;">

                   Tel: {$records['tel']}<br />GSM: {$records['gsm']}<br />

                   Fax: {$records['fax']}<br />

                   &nbsp; <!-- $convenant -->

               </div>

            </div>

            

EINDE;

            }

        print ("</table>");

        }

    print("</div>");   

    //----------------------------------------------------------

?>

<script language="javascript">

function pasOp() {  

   if (document.zvlform.IIZvl.value=='') {

       return true;

   } 

   else {

     return confirm("Het nieuwe teamlid is nog niet opgeslagen.\nWil je toch terug gaan naar het overzicht?");

  }

}

</script>

<form action="overleg_plannen_select_ggz_twee.php" method="post" name="nextform">

   <input type="hidden" name="vanWaar" value="<?= $vanWaar ?>" />

   <fieldset>

      <div style="text-align:center;">

<?php

  if ($vanWaar == "zorgTeam") {

?>

         <a style="text-decoration: none" tabindex='5' href='zorgteam_bewerken.php<?= $menosGetParam ?>' onClick='return pasOp()'>

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

             <input type="button" value="Terug naar het overzicht" onclick="if (pasOp()) window.location='overleg_alles.php?tab=Teamoverleg';"/></a>

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



    print("&nbsp;<br />&nbsp;<br /><div style=\"clear:both;text-align:left\">
          <!--
            <p>(*) Onder <b>zorgverleners</b> wordt voor de toepassing van het Koninklijk Besluit 

            verstaan: de doctors in de geneeskunde, heelkunde- en verloskunde, de artsen, de licentiaten 

            in de tandheelkunde en de tandartsen, de apothekers, de vroedvrouwen, die wettelijk gemachtigd 

            zijn om hun kunst uit te oefenen; de kinesitherapeuten, de verpleegkundigen, de paramedische 

            medewerkers en de ge&iuml;ntegreerde diensten voor thuisverzorging. In de praktijk: huisartsen,

            apothekers, kinesitherapeuten, thuisverpleegkundigen, ...</p>

            <p>Bekijk hier de lijst van <a href=\"lijst_partners2.php?genre=ZVL\" target=\"_blank\">organisaties ZORGverleners</a></p>
         -->
            <!--

            <p>

            <b>Betrokken organisaties:</b><br /> 

            thuisverpleging Solidariteit voor het Gezin - afd. Hasselt, afd. Tongeren; thuisverpleging

            De Eerste Lijn; thuisverpleging De Voorzorg; Wit-Gele Kruis, ...</p>

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