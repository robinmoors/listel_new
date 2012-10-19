<?php

session_start();

$paginanaam="Partners selecteren";



//----------------------------------------------------------

/* Maak Dbconnectie */ include('../includes/dbconnect2.inc');

//----------------------------------------------------------





  $vanuitZorgTeam = strpos($_SERVER['HTTP_REFERER'], "zorgteam");

  $vanuitControle = strpos($_SERVER['HTTP_REFERER'], "controle");

  if (!empty($vanuitZorgTeam) || ($_POST['vanWaar'] == "zorgTeam")) {

    $vanWaar =  "zorgTeam";

    $tabel = "huidige_betrokkenen";

    $bijWieVeld = "patient_code";

    $bijWieValue = "'{$_SESSION['pat_code']}'";

    $backpage =  "overleg_plannen_select_partners_twee.php?org={$_GET['org']}&orgnaam={$_GET['orgnaam']}";

    $tpPatient =  is_tp_patient();

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

    $backpage =  "overleg_plannen_select_partners_twee.php?org={$_GET['org']}&orgnaam={$_GET['orgnaam']}&overleg={$controleOverleg}";

    $qryOverleg = "select datum from overleg where id = {$controleOverleg}";

    $resultOverleg = mysql_query($qryOverleg);

    if (mysql_num_rows($resultOverleg)==0) die("Er is zo geen overleg.");

    $rijOverleg = mysql_fetch_array($resultOverleg);

    $tpPatient =  is_tp_opgenomen_op($rijOverleg['datum']);

  }

  else {

    $vanWaar = "overleg";

    $tabel = "huidige_betrokkenen";

    $bijWieVeld = "patient_code";

    $bijWieValue = "'{$_SESSION['pat_code']}'";

    $backpage =  "overleg_plannen_select_partners_twee.php?org={$_GET['org']}&orgnaam={$_GET['orgnaam']}";

    $tpPatient =  is_tp_patient();

  }

  

  /* Zoek alle soortgelijke organisaties: de 'vijvers' */

  $qrySpecialeOrganisaties =

     "select organisatie.naam from organisatie

      where

        {$_GET['org']} = organisatie.id

        and (

               organisatie.naam LIKE 'CGG%' or

               organisatie.naam LIKE 'DAGG%' or

               organisatie.naam LIKE 'VGGZ%' or

               organisatie.naam LIKE 'RCGGZ%' or

               organisatie.naam LIKE 'ARCGGZ%' or

               organisatie.naam LIKE 'BW%' or

               organisatie.naam LIKE 'PZ%' or

               organisatie.naam LIKE 'KPZ%' or

               organisatie.naam LIKE 'PTZ%' or

               organisatie.naam LIKE 'PVT%' or

               organisatie.naam LIKE 'VCLB%' or

               organisatie.naam LIKE 'CLB%'

             )";

   $resultSpecialeOrganisaties = mysql_query($qrySpecialeOrganisaties) or die(mysql_error());

   $CGG = $DAGG = $VGGZ = $RCGGZ = $ARCGGZ = $BW = $PZ = $KPZ = $PTZ = $PVT = $CLB = $VCLB = true;

   for ($s=0; $s<mysql_num_rows($resultSpecialeOrganisaties); $s++) {

     $rijSpecialeOrganisatie = mysql_fetch_assoc($resultSpecialeOrganisaties);

     $naam = $rijSpecialeOrganisatie['naam'];

     if (substr($naam,0,3)=='CGG' && $CGG) {

       $zoekTerm .= " or org.naam LIKE 'CGG%' ";

       $CGG = false;

     }

     else if (substr($naam,0,4)=='DAGG' && $DAGG) {

       $zoekTerm .= " or org.naam LIKE 'DAGG%' ";

       $DAGG = false;

     }

     else if (substr($naam,0,4)=='VGGZ' && $VGGZ) {

       $zoekTerm .= " or org.naam LIKE 'VGGZ%' ";

       $VGGZ = false;

     }

     else if (substr($naam,0,5)=='RCGGZ' && $RCGGZ) {

       $zoekTerm .= " or org.naam LIKE 'RCGGZ%' ";

       $RCGGZ = false;

     }

     else if (substr($naam,0,6)=='ARCGGZ' && $ARCGGZ) {

       $zoekTerm .= " or org.naam LIKE 'ARCGGZ%' ";

       $ARCGGZ = false;

     }

     else if (substr($naam,0,2)=='BW' && $BW) {

       $zoekTerm .= " or org.naam LIKE 'BW%' ";

       $BW = false;

     }

     else if (substr($naam,0,2)=='PZ' && $PZ) {

       $zoekTerm .= " or org.naam LIKE 'PZ%' ";

       $PZ = false;

     }

     else if (substr($naam,0,3)=='KPZ' && $KPZ) {

       $zoekTerm .= " or org.naam LIKE 'KPZ%' ";

       $KPZ = false;

     }

     else if (substr($naam,0,3)=='PTZ' && $PTZ) {

       $zoekTerm .= " or org.naam LIKE 'PTZ%' ";

       $PTZ = false;

     }

     else if (substr($naam,0,3)=='PVT' && $PVT) {

       $zoekTerm = " or org.naam LIKE 'PVT%' ";

       $PVT = false;

     }

     else if (substr($naam,0,3)=='CLB' && $CLB) {

       $zoekTerm = " or org.naam LIKE 'CLB%' ";

       $CLB = false;

     }

     else if (substr($naam,0,4)=='VCLB' && $VCLB) {

       $zoekTerm = " or org.naam LIKE 'VCLB%' ";

       $VCLB = false;

     }



  }



    if (strlen($zoekTerm) > 0) {

      $zoekTerm = " OR (" . substr($zoekTerm, 4) . ")";

    }

    else {

      $zoekTerm = "";

    }





if (isSet($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan") && $tpPatient )

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

            WHERE persoon_id=".$_POST['hvl_id']."
            and overleggenre = 'gewoon'
            AND genre = 'orgpersoon'

            AND $bijWieVeld=$bijWieValue";

        $doeBestaatSql=mysql_query($bestaatSql);

        if (mysql_num_rows($doeBestaatSql)==0)

            {

            //--------------------------------------------------------------                

            // hvl gegevens worden opgeslaan

            $sql1 = "

                INSERT INTO

                    $tabel

                        (persoon_id, genre, $bijWieVeld, aanwezig, namens, overleggenre)

                    VALUES

                        ('".$_POST['hvl_id']."','orgpersoon',$bijWieValue, 1, {$_GET['org']}, 'gewoon')";

            if ($result=mysql_query($sql1))  {

               $melding="Vertegenwoordiger van partner is <b>succesvol ingevoegd</b>.<br>";

               if (is_tp_patient() && ($bijWieVeld != "overleg_id")) {

                $overlegRij = getHuidigOverleg();

                $overlegID = $overlegRij['id'];

                $sql1Plus = "

                    INSERT INTO overleg_tp_plan

                        (overleg, persoon, genre)

                    VALUES

                        ($overlegID, '".$_POST['hvl_id']."','orgpersoon')";

                 $result=mysql_query($sql1Plus) or die("wat is dat hier $sql1Plus " . mysql_error());

               }

            }

            else

                {$melding="Vertegenwoordiger van partner is <b>niet succesvol ingevoegd</b>,<br>".$sql1;}

            //--------------------------------------------------------------

            }

        else

            {$melding="Orgpersoon: Er ontbreken gegevens hvl_id of pat_code";}

        //--------------------------------------------------------------

        }



    if(isset($_GET['wis_id']))

        { 

        //-----------------------------------------------

        // link HVL en patient wordt verwijderd

        $sql1 = "

            DELETE FROM

                $tabel

            WHERE

                id = {$_GET['wis_id']}";

        if ($result=mysql_query($sql1))

            {$melding="Vertegenwoordiger van partner is <b>succesvol verwijderd</b>.<br>";}

        else

            {$melding="Vertegenwoordiger van partner is <b>niet succesvol verwijderd</b>,<br>".$sql1;}

        //die("$melding $sql1");

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



    $query = "

        SELECT

            distinct

            h.id as hvl_id,

            h.naam as hvl_naam,

            h.voornaam as hvl_voornaam,

                h.tel,

                h.organisatie,

              org.naam as org_naam



        FROM

            hulpverleners h,

            organisatie org,

            $tabel bl

        WHERE
            bl.overleggenre = 'gewoon' AND
            bl.$bijWieVeld = $bijWieValue AND

            (

              (

                 ({$_GET['org']} = org.id or {$_GET['org']} = org.hoofdzetel)

              )

              $zoekTerm

            )

            AND

            org.id = h.organisatie AND

            h.actief = 1

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





//die($query);



             

    if ($result=mysql_query($query))

    {

        print ("var zvlList = Array();\n");

        for ($i=0; $i < mysql_num_rows ($result); $i++)

        {

            $records= mysql_fetch_array($result);

            print("zvlList[2*$i] = \"{$records['hvl_naam']} {$records['hvl_voornaam']} - {$records['org_naam']}\";zvlList[2*$i+1]=\"{$records['hvl_id']}\"\n");

           if ($letter==substr($records['hvl_naam'],0,1) || $letter2 == substr($records['hvl_naam'],0,1)) {

              $hash .= "zvlHash['$letter'] = $i;\n";

              $hash .= "zvlHash['$letter2'] = $i;\n";

              $letter = substr($zoek,0,1);

              $letter2 = substr($zoek,1,1);

              $zoek = substr($zoek,2);

           }

        }

        print ($hash);





    } // ZorgverlenersLijst opvullen

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

    print("<h1>Overleg plannen</h1>

            <p>Selecteer uit onderstaande lijst de <b>vertegenwoordigers</b> van {$_GET['orgnaam']}

            die betrokken zijn bij deze patient.</p>");



    //---------------------------------------------------------------------------

    /* Toon form ZVL selecteren */ include('../forms/select_partner.php');

    //---------------------------------------------------------------------------



    //----------------------------------------------------------

    // ZorgverlenersLijstje weergeven

    print("<div align=\"center\">");

    $query = "

        SELECT

            bl.id as bl_id,

            h.naam as hvl_naam,

            h.voornaam as hvl_voornaam,

                h.tel,

                h.organisatie           ,

                h.*,

                org.naam as org_naam,

                g.dlzip, g.dlnaam

        FROM

            hulpverleners h,

            organisatie org,

            $tabel bl,

            gemeente g

        WHERE
            bl.overleggenre = 'gewoon' AND
            bl.persoon_id=h.id AND

            bl.genre = 'orgpersoon' AND

            h.gem_id = g.id AND

            org.id = h.organisatie AND

            bl.$bijWieVeld = $bijWieValue

        ORDER BY

            org.naam, bl.id";

?>



<p style="text-align:left;">Hieronder vindt u de lijst van de vertegenwoordigers van &aacute;lle partners <br/>

(dus niet alleen die van <?= $_GET['orgnaam'] ?>).</p>



<?php

    if ($result=mysql_query($query))

        {

        $teller=0;

        print ("

            <table width=\"96%\" style=\"float: left\">

                <tr>

                    <th width=\"10%\">Nr</th>

                    <th width=\"36%\">Naam vertegenwoordiger</th>

                    <th width=\"35%\">Organisatie</th>

                    <th width=\"15%\">Actie</th>

                </tr>");

        for ($i=0; $i < mysql_num_rows ($result); $i++)

            {

            $records= mysql_fetch_array($result);

            $veld1=($records['hvl_naam']!="")?$records['hvl_naam']:"&nbsp;&nbsp;";

            $veld2=($records['hvl_voornaam']!="")?$records['hvl_voornaam']:"&nbsp;&nbsp;";

            $hvl_naam = "$veld1 $veld2";

            $org_naam =($records['org_naam']!="")?$records['org_naam']:"&nbsp;&nbsp;";

            print ("

                <tr onMMouseMove=\"toon('zvl$i', event);\" onMMouseOut=\"zetAf('zvl$i');\">

                    <td valign=\"top\" class=\"tabellen\">".($i+1).".</td>

                    <td valign=\"top\" class=\"tabellen\">

                       <a href='edit_verlener.php?genre=xvlp&id={$records['id']}&backpage=$backpage'>$hvl_naam</a> </td>

                    <td valign=\"top\" class=\"tabellen\">$org_naam</td>

                    <td valign=\"top\" class=\"tabellen\">

                        <a href=\"overleg_plannen_select_partners_twee.php?org={$_GET['org']}&orgnaam={$_GET['orgnaam']}&wis_id={$records['bl_id']}$extraParameterWis\">wis</a>

                    </td></tr>");

/*

            echo <<< EINDE

            <div class="aankeiler" id="zvl$i">

               <div style="position:absolute;left: 5px; top: 2px;">

                   {$orgNaam['naam']}<br />Email: {$records['email']}

               </div>

               <div style="position:absolute;left: 5px; top: 25px;">

                   riziv {$rizivnr}<br />iban {$records['iban']} <br />

                   {$records['adres']}<br />{$records['dlzip']} {$records['dlnaam']}

               </div>

               <div style="position:absolute;left: 220px; top: 25px;">

                   Tel: {$records['tel']}<br />GSM: {$records['gsm']}<br />

                   Fax: {$records['fax']}<br />

                   $convenant

               </div>

            </div>

            

EINDE;

*/

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

     return confirm("De nieuwe vertegenwoordiger van een partner is nog niet opgeslagen.\nWil je toch terug gaan naar het overzicht?");

  }

}

</script>

<form action="overleg_plannen_select_partners_twee.php" method="post" name="nextform">

   <input type="hidden" name="vanWaar" value="<?= $vanWaar ?>" />

   <fieldset>

      <div style="text-align:center;">

<?php

  if ($vanWaar == "zorgTeam") {

?>

         <a style="text-decoration: none" tabindex='5' href='zorgteam_bewerken.php' onClick='return pasOp()'>

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



    print("&nbsp;<br />&nbsp;<br />");





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