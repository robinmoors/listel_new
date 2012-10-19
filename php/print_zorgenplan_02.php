<?php

session_start();

$paginanaam="Betrokkenen in de thuiszorg";

if (IsSet($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan"))

    {

    //----------------------------------------------------------

    /* Maak Dbconnectie */ include('../includes/dbconnect2.inc');

    //----------------------------------------------------------

    include("../includes/html_html.inc");

    print("<head>");

    include("../includes/html_head.inc");

    

    $patientInfo=mysql_fetch_array(mysql_query("SELECT patient.*, dlnaam, dlzip, deelvzw FROM  patient inner join gemeente on gemeente.id = gem_id WHERE code='{$_SESSION['pat_code']}'"));



    if (isset($_GET['huidige'])) {

      $mooieDatum = date("d/m/Y");

      $overlegInfo=mysql_fetch_array(mysql_query("SELECT * FROM  overleg WHERE patient_code = '{$_SESSION['pat_code']}' order by datum desc"));

      //print("yeah SELECT * FROM  overleg WHERE afgerond = 0 and patient_code = '{$_SESSION['pat_code']}'" .mysql_error());print_r($overlegInfo);

    }

    else {

      $overlegInfo=mysql_fetch_array(mysql_query("SELECT * FROM  overleg WHERE id={$_GET['id']}"));

      $datum = $overlegInfo['datum'];

      $mooieDatum =substr($datum,6,2)."/".substr($datum,4,2)."/".substr($datum,0,4);

    }



    

?>

    <style type="text/css">

       td { border: 1px black solid;}

       table {

         border-collapse: collapse;

       }

       td.geenRand {

         border: 0px;

       }

    </style>

    </head>

    <body onLoad="parent.print()" style="padding-left: 10px;">

<!--
    <div align="center">
    <div class="pagina">
-->
    <table width="100%" border="0" cellpadding="5">

    <tr>

    <td class="geenRand">

      <img src="../images/Sel<?= $patientInfo['deelvzw'] ?>.jpg" height="100" />

    </td>

    <td class="geenRand" colspan="2"><div style="text-align:left"><h2>Betrokkenen in de thuiszorg <br />

                                                       op <?php print($mooieDatum); ?></h2>

                                <?php print(strtoupper($patientInfo['naam'])." ".$patientInfo['voornaam']);?><br />

                                <?php print($patientInfo['code']);?>

                    </div></td></tr>



<?php



    print ("<tr>    <td class=\"geenRand\" colspan=\"3\"><h3>Organisatie van overleg</h3></td></tr>");

    //----------------------------------------------------------

    // Overlegcoordinator weergeven

  if ($overlegInfo['id']=="") {

     print("Er is nog geen overleg geregistreerd voor deze patient en daarom kunnen wij niet laten zien wie dit overleg gepland heeft.");

  }

  else {

    if (isset($_GET['huidige'])) {
        $mooieDatum = date("d/m/Y");
    }
/*
        $OCQuery1="
            SELECT
                logins.voornaam, logins.naam, adres, gem_id, tel, fax, gsm, email,
                gemeente.dlzip, gemeente.dlnaam, overleg_gemeente, gemeente.naam as overleg_naam
            FROM
               logins, gemeente
            WHERE
               profiel = 'OC'
            AND
               login = \"{$_SESSION['login']}\"
            AND
               gemeente.zip = logins.overleg_gemeente
            AND
              logins.gem_id=gemeente.id";
        $overlegPlannerQry = "select logins.*, gemeente.dlzip, gemeente.dlnaam from logins, gemeente
                              where logins.id = {$overlegInfo['coordinator_id']} and
                                    gemeente.id = logins.gem_id" ;
    }
    else {
        $OCQuery1="
            SELECT
                logins.voornaam, logins.naam, adres, gem_id, tel, fax, gsm, email,
                gemeente.dlzip, gemeente.dlnaam, overleg_gemeente, gemeente.naam as overleg_naam
            FROM
               logins, overleg, gemeente
            WHERE
               profiel = 'OC'
            AND
               overleg.id = {$overlegInfo['id']}
            AND
               gemeente.zip = logins.overleg_gemeente
            AND
              logins.id = overleg.coordinator_id
            AND
              logins.gem_id=gemeente.id";
        $overlegPlannerQry = "select logins.*, gemeente.dlzip, gemeente.dlnaam from logins, gemeente, overleg
                              where logins.id = overleg.coordinator_id and
                                    overleg.id = {$overlegInfo['id']} and
                                    gemeente.id = logins.gem_id" ;
    }

    $resultOCQuery1=mysql_query($overlegPlannerQry) or die($overlegPlannerQry . "<br/>" . mysql_error());
    $oc_gegevens1= mysql_fetch_array($resultOCQuery1); //Query
*/
    $oc_gegevens1 = organisatorRecordVanOverleg($overlegInfo);

    if ($oc_gegevens1['organisatie'] > 0 && ($oc_gegevens1['gem_id'] == 0  || $oc_gegevens1['gem_id'] == 9999) ) {
      // adres van organisatie opzoeken
                  $qry8="SELECT dlzip,dlnaam, adres FROM gemeente, organisatie WHERE gemeente.id=organisatie.gem_id and organisatie.id = {$oc_gegevens1['organisatie']}";
                  $gemeente=mysql_fetch_array(mysql_query($qry8)) or die($qry8 . mysql_error());
                  $oc_gegevens1['adres'] = $gemeente['adres'];
                  $oc_gegevens1['dlzip'] = $gemeente['dlzip'];
                  $oc_gegevens1['dlnaam'] = $gemeente['dlnaam'];
    }
    else {
                  $qry8="SELECT dlzip,dlnaam FROM gemeente WHERE id = {$oc_gegevens1['gem_id']}";
                  $gemeente=mysql_fetch_array(mysql_query($qry8)) or die($qry8 . mysql_error());
                  $oc_gegevens1['dlzip'] = $gemeente['dlzip'];
                  $oc_gegevens1['dlnaam'] = $gemeente['dlnaam'];
    }







    if ($oc_gegevens1['dlzip'] == -1) $oc_gegevens1['dlzip'] = "";

    print ("<tr>    <td valign=\"top\">".$oc_gegevens1['naam']." ".$oc_gegevens1['voornaam']."<br />

                    {$oc_gegevens1['adres']}<br />{$oc_gegevens1['dlzip']} {$oc_gegevens1['dlnaam']} </td>\n");

    if ($oc_gegevens1['profiel']=="OC") {

       print("           <td valign=\"top\">Overlegco&ouml;rdinator TGZ</td>");

    }

    else {

       print("           <td valign=\"top\">{$oc_gegevens1['profiel']}co&ouml;rdinator</td>");

    }

    print ("        <td valign=\"top\">{$oc_gegevens1['tel']}<br />{$oc_gegevens1['email']}</td></tr>");

    //----------------------------------------------------------

  }



    if (isset($_GET['tabel']))

      $tabel = $_GET['tabel'];

    else

      $tabel = "huidige";



    if ($tabel == "afgeronde")

      $voorwaarde = "bl.overleg_id = {$_GET['id']}";

    else

      $voorwaarde = "bl.patient_code = '{$_SESSION['pat_code']}'";


if ($_GET['menos']==1) {
  $overleggenre = "menos";
}
else {
  $overleggenre = "gewoon";
}


if ($overlegInfo['genre']=="TP") {

  print ("<tr>    <td class=\"geenRand\" colspan=\"3\"><h3>Interne Partners en hun vertegenwoordigers</h3></td></tr>");



  $qryOrgs = "select persoon_id as org_id, organisatie.*, gemeente.dlzip, gemeente.dlnaam from {$tabel}_betrokkenen bl, organisatie, gemeente

              where bl.genre = 'org' AND
                overleggenre = 'gewoon' AND
                persoon_id = organisatie.id AND

                organisatie.gem_id = gemeente.id AND

                $voorwaarde" ;

  $resultOrgs = mysql_query($qryOrgs) or die("foutje met $qryOrgs " . mysql_error());

  for ($orgnr = 0; $orgnr < mysql_num_rows($resultOrgs); $orgnr++) {

    $org = mysql_fetch_assoc($resultOrgs);

    

/* oude vijversysteem



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

     if ($zoekTerm <> "") {

       $resultVijvers = mysql_query($zoekTerm);

       for ($vijver = 0; $vijver < mysql_num_rows($resultVijvers); $vijver++) {

         $bijOrg = mysql_fetch_assoc($resultVijvers);

         $orgs .= ", {$bijOrg['id']}";

       }

     }





    // de organisatie zelf toevoegen!

    $orgs = "{$org['org_id']} $orgs";



  einde oude vijvers */

    print("<tr><td><strong>{$org['naam']}</strong></td><td>{$org['adres']}<br/>{$org['dlzip']} {$org['dlnaam']}</td><td>{$org['tel']}<br/>{$org['email_inhoudelijk']}</td></tr>");

    

    $qryOrgPersonen = "

         SELECT

                bl.id,

                h.naam as hulpverlener_naam,

                h.voornaam as voornaam,

                bl.persoon_id,

                h.riziv1,

                h.riziv2,

                h.riziv3,

                h.reknr,
                h.iban,
                h.bic,

                h.tel,

                h.gsm,

                h.email,

                h.organisatie,

                h.adres,

                dlzip,

                dlnaam,

                aanwezig,

                organisatie.naam as org_naam

            FROM

                {$tabel}_betrokkenen bl,

                hulpverleners h left join gemeente g on (h.gem_id = g.id),

                organisatie

            WHERE
                overleggenre = 'gewoon' AND
                bl.genre = 'orgpersoon' AND

                bl.persoon_id = h.id AND



                bl.namens = {$org['org_id']} AND

                h.organisatie = organisatie.id AND

                

                $voorwaarde

                $beperking";

     $resultPersonen = mysql_query($qryOrgPersonen) or die("problemen met $qryOrgPersonen " . mysql_error());

     if (mysql_num_rows($resultPersonen) == 0) {

       $hoogte += 25;

       print("<tr><td colspan='3'>-- geen vertegenwoordigers voor deze organisatie -- </td></tr>");

     }

     $eersteTd =  "<td rowspan=\"" . mysql_num_rows($resultPersonen) . "\">Vertegenwoordigd door</td>";

     for ($p=0; $p<mysql_num_rows($resultPersonen); $p++) {

       $persoon = mysql_fetch_assoc($resultPersonen);

            $veld1=($persoon['hulpverlener_naam']!="")    ?$persoon['hulpverlener_naam']    :"&nbsp;";

            $veld2=($persoon['voornaam']!="")?$persoon['voornaam']:"&nbsp;";



            if ($persoon['dlzip'] == 0) {

               $persoon['dlzip'] = "";

               $persoon['dlnaam'] = "";

            }

            if ($persoon['organisatie']!=$org['org_id']) {

              $organisatieNaam = " - <b>" . $persoon['org_naam'] . "</b>";

              // en ook zijn adres en zo meenemen

              $andereOrg = getFirstRecord("select * from organisatie where id = {$persoon['organisatie']}");

              if ($persoon['email']=="") $persoon['email'] = $andereOrg['email_inhoudelijk'];

              if ($persoon['tel']=="") $persoon['tel'] = $andereOrg['tel'];

            }

            else

              $organisatieNaam = "";

            // email mag toch niet zichtbaar zijn

            $persoon['email'] ="";



            print ("

                <tr>$eersteTd

                <td>{$persoon['hulpverlener_naam']} {$persoon['voornaam']} $organisatieNaam<br/>

                    {$persoon['adres']}<br/>

                    {$persoon['dlzip']} {$persoon['dlnaam']} </td>

                <td>{$persoon['tel']}<br/>{$persoon['gsm']}<br/>{$persoon['email']}</td></tr>");

            $eersteTd = "";

     }

  }

// twee blanco lijnen

     print ("<tr>    <td valign=\"bottom\" width=\"40%\">

                    &nbsp;<br />&nbsp;<br />&nbsp;<br />.......</td>

                    <td valign=\"bottom\" width=\"40%\">&nbsp;<br />.......</td>

                    <td valign=\"bottom\" width=\"20%\">&nbsp;<br />&nbsp;<br />.......</td>

                    </tr>");

     print ("<tr>    <td valign=\"bottom\" width=\"40%\">

                    &nbsp;<br />&nbsp;<br />&nbsp;<br />.......</td>

                    <td valign=\"bottom\" width=\"40%\">&nbsp;<br />.......</td>

                    <td valign=\"bottom\" width=\"20%\">&nbsp;<br />&nbsp;<br />.......</td>

                    </tr>");

    //----------------------------------------------------------

}







    print ("<tr>    <td class=\"geenRand\" colspan=\"3\"><h3>Zorg- en hulpverleners</h3></td></tr>");

?>

    <tr>

      <th>

        Naam &amp; adres

      </th>

      <th>

       Functie &amp; organisatie

      </th>

      <th>

         Tel. / GSM / email

      </th>

    </tr>

<?php

    $huidigeGroep = 2;



    //----------------------------------------------------------

    // HulpverlenersLijst weergeven





    $queryHVL = "
         SELECT
                h.id as hvl_id,
                h.naam as hvl_naam,
                h.voornaam as hvl_voornaam,
                f.naam as fnct_naam,
                f.groep_id,
                bl.persoon_id,
                h.riziv1, h.riziv2, h.riziv3,
                bl.id as betrokhvl_id,
                org.naam as partner_naam,
                org.id as partner_id,
                h.adres,
                h.email,
                g.dlnaam,
                g.dlzip,
                h.tel,
                h.gsm,
                org.adres as partner_adres,
                org.gem_id as partner_gem_id,
                org.tel as partner_tel,
                org.gsm as partner_gsm,
                org.email_inhoudelijk as partner_email
            FROM
                {$tabel}_betrokkenen bl,
                functies f,
                gemeente g,
                hulpverleners h
                LEFT JOIN organisatie org ON ( org.id = h.organisatie )
            WHERE
                overleggenre = '$overleggenre' AND
                h.fnct_id = f.id AND
                bl.persoon_id = h.id AND
                bl.genre = 'hulp' AND
                $voorwaarde AND
                g.id=h.gem_id
            ORDER BY
                f.rangorde, bl.id"; // Query

      if ($resultHVL=mysql_query($queryHVL))

         {

         for ($i=0; $i < mysql_num_rows ($resultHVL); $i++)

            {

            $recordsHVL= mysql_fetch_array($resultHVL);

            $hvl_naam=      $recordsHVL['hvl_naam'];

            $hvl_voornaam=  $recordsHVL['hvl_voornaam'];

            $fnct_naam=     $recordsHVL['fnct_naam'];

            //$fnct_naam=     ($recordsHVL['betrokhvl_zb']==1)    ?$fnct_naam."<br />Zorgbemiddelaar" :$fnct_naam;

            $hvl_adres=     $recordsHVL['adres'];

            $hvl_dlzip=     $recordsHVL['dlzip'];

            $hvl_dlnaam=    $recordsHVL['dlnaam'];

            $hvl_tel=       $recordsHVL['tel'];

            $hvl_gsm=       $recordsHVL['gsm'];

            $hvl_email=     "  "; //$recordsHVL['email'];

            $partner_adres= $recordsHVL['partner_adres'];

            $partner_tel=   $recordsHVL['partner_tel'];

            $partner_gsm=   $recordsHVL['partner_gsm'];

            $partner_email=   $recordsHVL['partner_email'];

            //-------------------------------------------------------------------

            // indien een hvl werkt voor een partner toon deze dan

            $partner=       (($recordsHVL['partner_id']==999)OR($recordsHVL['partner_id']==1000))?"":"<br />".

                                    $recordsHVL['partner_naam'];

               if (isset($recordsHVL['partner_gem_id']) && $recordsHVL['partner_gem_id'] != 9999) {

                  $qry8="SELECT dlzip,dlnaam FROM gemeente WHERE id=".$recordsHVL['partner_gem_id'];

                  $gemeente=mysql_fetch_array(mysql_query($qry8));

                  $partner_dlzip=$gemeente['dlzip'];

                  $partner_dlnaam=$gemeente['dlnaam'];

                }

            $fnct_naam=$fnct_naam.$partner;

            //-------------------------------------------------------------------



            //-------------------------------------------------------------------

            // heeft deze hvl een rizivnr zo ja corrigeer het met voorloopnullen

            if ($recordsHVL['riziv1']==0)

                {$rizivnr="";}

            else

                {

                $rizivnr1=substr($recordsHVL['riziv1'],0,1)."-".substr($recordsHVL['riziv1'],1,5)."-";

                $rizivnr2=      ($recordsHVL['riziv2']<10)      ?"0".$recordsHVL['riziv2']:$recordsHVL['riziv2'];

                $rizivnr3=      ($recordsHVL['riziv3']<100)     ?"0".$recordsHVL['riziv3']:$recordsHVL['riziv3'];

                $rizivnr3=      ($recordsHVL['riziv3']<10)      ?"0".$rizivnr3:$rizivnr3;

                $rizivnr=$rizivnr1.$rizivnr2."-".$rizivnr3;

                }

            //-------------------------------------------------------------------

            //$markering_o=($recordsHVL['betrokhvl_contact']==1)?"<b>":"";

            //$markering_s=($recordsHVL['betrokhvl_contact']==1)?"</b>":"";

            

            //-------------------------------------------------------------------

            // heeft deze hvl geen adres, gebruik de partner dan

            if($hvl_adres=="")

                {

                $hvl_adres=$partner_adres;

                $hvl_dlzip=$partner_dlzip;

                $hvl_dlnaam=$partner_dlnaam;

              }

            if ($hvl_dlzip == -1) $hvl_dlzip = "";

            //-------------------------------------------------------------------

            //-------------------------------------------------------------------

            // heeft deze hvl geen telefoon/gsm, gebruik de partner dan

            $hvl_tel=(trim($hvl_tel)=="")?$partner_tel:trim($hvl_tel);

            $hvl_gsm=(trim($hvl_gsm)==0)?$partner_gsm:$recordsHVL['gsm'];

            $hvl_email="";//(trim($hvl_email)=="")?$partner_email:$recordsHVL['email'];

            //-------------------------------------------------------------------

            

      /*

           if ($huidigeGroep != $recordsHVL['groep_id']) {

               $huidigeGroep = $recordsHVL['groep_id'];

               if ($huidigeGroep == 1)

                   print ("<tr>    <td class=\"geenRand\" colspan=\"4\"><h3>Hulpverleners (HVL)</h3></td></tr>");

               if ($huidigeGroep == 3)

                   print ("<tr>    <td class=\"geenRand\" colspan=\"4\"><h3>Andere hulpverleners (XVL)</h3></td></tr>");

            }

     */

     //$rizivnr = ""; // bleek toch niet nodig te zijn, maar ik doe de code niet echt weg

                    // zodat we het rizivnummer snel terug zichtbaar kunnen maken

                    

     print ("<tr>    <td valign=\"top\" width=\"40%\">".

                    $markering_o.$hvl_naam." ".$hvl_voornaam.$markering_s."<br />".

                    $hvl_adres."<br />".

                    $hvl_dlzip." ".$hvl_dlnaam."<br />".

                    $rizivnr."</td>

                    <td valign=\"top\" width=\"40%\">".$fnct_naam."<br />&nbsp;</td>

                    <td valign=\"top\" width=\"20%\">".$hvl_tel."<br />".$hvl_gsm."<br />$hvl_email</td>

                    </tr>");}}



// twee blanco lijnen

     print ("<tr>    <td valign=\"bottom\" width=\"40%\">

                    &nbsp;<br />&nbsp;<br />&nbsp;<br />.......</td>

                    <td valign=\"bottom\" width=\"40%\">&nbsp;<br />.......</td>

                    <td valign=\"bottom\" width=\"20%\">&nbsp;<br />&nbsp;<br />.......</td>

                    </tr>");

     print ("<tr>    <td valign=\"bottom\" width=\"40%\">

                    &nbsp;<br />&nbsp;<br />&nbsp;<br />.......</td>

                    <td valign=\"bottom\" width=\"40%\">&nbsp;<br />.......</td>

                    <td valign=\"bottom\" width=\"20%\">&nbsp;<br />&nbsp;<br />.......</td>

                    </tr>");

    //----------------------------------------------------------



          //----------------------------------------------------------

    // MantelzorgersLijst weergeven
print("</table><table width=\"570\">\n");

    $query = "

         SELECT

                m.id as mzorg_id,

                m.naam as mzorg_naam,

                m.voornaam as mzorg_voornaam,

                bl.persoon_id,

                v.naam as verwsch_naam,

                v.rangorde,

                bl.id,

                m.adres as mzorg_adres,

                m.tel as mzorg_tel,

                m.gsm as mzorg_gsm,

                m.email ,

                m.gem_id,

                g.dlzip as gemte_dlzip ,

                g.dlnaam as gemte_dlnaam

            FROM

                {$tabel}_betrokkenen bl,

                verwantschap v,

                mantelzorgers m  LEFT JOIN gemeente g on (g.id = m.gem_id)



            WHERE
                overleggenre = '$overleggenre' AND
                bl.persoon_id = m.id AND

                bl.genre = 'mantel' AND

                v.id = m.verwsch_id AND

                $voorwaarde

            ORDER BY 

                v.rangorde,m.naam";



      if ($result=mysql_query($query))

         {

         if (mysql_num_rows ($result) > 0)  {

              print ("<tr>    <td class=\"geenRand\" colspan=\"3\"><h3>Mantelzorger(s)</h3></td></tr>");

?>

    <tr>

      <th>

        Naam &amp; adres

      </th>

      <th>

       Verwantschap

      </th>

      <th>

         Tel. / GSM / email

      </th>

    </tr>

<?php

         }

         for ($i=0; $i < mysql_num_rows ($result); $i++)

            {

            $records= mysql_fetch_array($result);

            $Naam=($records['mzorg_naam']!="")?$records['mzorg_naam']:"&nbsp;";

            $Voornaam=($records['mzorg_voornaam']!="")?$records['mzorg_voornaam']:"&nbsp;";

            if ($records['verwsch_naam']== "Echtgeno(o)t(e)" || $records['verwsch_naam']== "Partner" ) {

               $adres=($records['mzorg_adres']!="")    ?$records['mzorg_adres']    :$patientInfo['adres'];

               $gemeenteInfo = mysql_fetch_array(mysql_query("select dlzip, dlnaam from gemeente where id = {$patientInfo['gem_id']}"));

               $dlzip=($records['gem_dlzip']!="")    ?$records['gemte_dlzip']    :$gemeenteInfo['dlzip'];

               $dlnaam=($records['gem_dlzip']!="")  ?$records['gemte_dlnaam']   :$gemeenteInfo['dlnaam'];

               $tel=($records['mzorg_tel']!="")    ?$records['mzorg_tel']  :$patientInfo['tel'];

               $gsm=($records['mzorg_gsm']!="")    ?$records['mzorg_gsm']  :"&nbsp;";

               $emailX=($records['email']!="")    ?$records['email']  :"&nbsp;";

            }

            else {

               $adres=($records['mzorg_adres']!="")    ?$records['mzorg_adres']    :"&nbsp;";

               $dlzip=($records['gem_id']!="9999")    ?$records['gemte_dlzip']    :"&nbsp;";

               $dlnaam=($records['gem_id']!="9999")  ?$records['gemte_dlnaam']   :"&nbsp;";

               $tel=($records['mzorg_tel']!="")    ?$records['mzorg_tel']  :"&nbsp;";

               $gsm=($records['mzorg_gsm']!="")    ?$records['mzorg_gsm']  :"&nbsp;";

               $emailX=($records['email']!="")    ?$records['email']  :"&nbsp;";

            }

            if ($dlzip == -1) $dlzip = "";







            //$markering_o=($records['betrokmz_contact']==1)?"<b>":"";

            //$markering_s=($records['betrokmz_contact']==1)?"</b>":"";

    print ("<tr>    <td valign=\"top\">".

                    $markering_o.$Naam." ".$Voornaam.$markering_s."<br />".

                    $adres."<br />" . $dlzip." ".$dlnaam."</td>

                    <td valign=\"top\">".$records['verwsch_naam']."<br />&nbsp;</td>

                    <td valign=\"top\">".$tel."<br />".$gsm."<br />$emailX</td>

                    </tr>");}}

     else print("verkeerde mantelzorgers-query $query");

    //----------------------------------------------------------



// twee blanco lijnen

     print ("<tr>    <td valign=\"bottom\" width=\"40%\">

                    &nbsp;<br />&nbsp;<br />&nbsp;<br />.......</td>

                    <td valign=\"bottom\" width=\"40%\">&nbsp;<br />.......</td>

                    <td valign=\"bottom\" width=\"20%\">&nbsp;<br />&nbsp;<br />.......</td>

                    </tr>");

     print ("<tr>    <td valign=\"bottom\" width=\"40%\">

                    &nbsp;<br />&nbsp;<br />&nbsp;<br />.......</td>

                    <td valign=\"bottom\" width=\"40%\">&nbsp;<br />.......</td>

                    <td valign=\"bottom\" width=\"20%\">&nbsp;<br />&nbsp;<br />.......</td>

                    </tr>");



    print ("</table></p>");











    



    //---------------------------------------------------------

    /* Sluit Dbconnectie */ include("../includes/dbclose.inc");

    //---------------------------------------------------------

?>

<!--
</div>
</div>
-->

</body>

</html>

<?php

    }

//---------------------------------------------------------

/* Geen Toegang */ include("../includes/check_access.inc");

//---------------------------------------------------------

?>