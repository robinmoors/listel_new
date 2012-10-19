<?php
session_start();
$paginanaam="Zorgenplan";
if (IsSet($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan"))
    {
    //----------------------------------------------------------
    /* Maak Dbconnectie */ include('../includes/dbconnect2.inc');
    //----------------------------------------------------------
    include("../includes/html_html.inc");
    print("<head>");
    include("../includes/html_head.inc");
?>
    </head>
    <body onLoad="alert('Opgelet. Je krijgt 2x het verzoek om iets af te drukken. \nEénmaal voor de handtekenlijst en een tweede maal voor de lijst met alle betrokkenen.');parent.print();parent.document.location='print_zorgenplan_02.php';">
    <div align="center">
    <div class="pagina">
    <table width=570>
    <tr><td colspan="3"><div class="hidden"><img src="../images/logo_top_pagina_zorgenplan.gif" width="600"></div></td></tr>
<?php

$overlegID = $_POST['id'];

//---------------------------------------------
// Haal de patientgegevens op
$querypatgeg = "
    SELECT
        p.naam as pat_naam,
        p.voornaam as pat_voornaam,
        p.adres,
        g.dlzip,
        g.dlnaam,
        p.gebdatum,
        v.nr as verz_nr,
        v.naam as verz_naam,
        p.tel,
        p.gsm,
        b.omschr,
        p.voornaam_echtg,
        p.naam_echtg,
        p.sex,
        p.mutnr
    FROM
        patient p,
        gemeente g,
        verzekering v,
        burgstaat b
    WHERE
        p.gem_id=g.id AND
        p.code ='".$_SESSION['pat_code']."' AND
        p.mut_id=v.id AND
        p.burgstand_id=b.id ";
$resultpatgeg = mysql_query($querypatgeg);
if (mysql_num_rows($resultpatgeg)<>0 ) 
    {// een correct record gevonden
    $pat_gegevens= mysql_fetch_array($resultpatgeg);
    }
else 
    {
    print("Geen record gevonden $querypatgeg");
    }
//---------------------------------------------


//---------------------------------------------
// Haal de overlegdatum op

$overlegDateSql="
    SELECT
        datum,
        totaal as katzscore
    FROM
        overleg, katz
    WHERE
        overleg.id=$overlegID
        and overleg.katz_id = katz.id";
$result2 = mysql_query($overlegDateSql);
if (mysql_num_rows($result2)<>0 ) 
    {// een correcte record gevonden
    $records2= mysql_fetch_array($result2);
    }
else {
  $records2 = mysql_fetch_array(mysql_query(
                 "select datum from overleg where overleg.id=$overlegID"));
  $records2['katzscore'] = " niet ingevuld.";

}
//---------------------------------------------

$overlegdatum=substr($records2[0],6,2)."/".substr($records2[0],4,2)."/".substr($records2[0],0,4);
$geboortedatum=substr($pat_gegevens[5],6,2)."/".substr($pat_gegevens[5],4,2)."/".substr($pat_gegevens[5],0,4);
$geslacht=($pat_gegevens[13]==0)?"(M)":"(V)";
?>
<tr>
<td colspan="3" valign="top">
  <table width="100%">
   <tr><td colspan="2"><p><br /><br /></td></tr>
   <tr><td style="text-align:left"><h2><?php print ($pat_gegevens['pat_naam']." ".$pat_gegevens['pat_voornaam']." ".$geslacht."</h2>"); ;?></td>
       <td style="text-align:right"><h2><?php print ($_SESSION['pat_code']);?></h2></td></tr>
  </table>
</td></tr>
<td colspan="2" valign="top">
<p><br />
<?php print ($pat_gegevens['omschr']." ".$pat_gegevens['naam_echtg']." ".$pat_gegevens['voornaam_echtg']); ?><br />
&deg;<?php print ($geboortedatum); ?><br />
<?php print ($pat_gegevens['verz_nr']." ".$pat_gegevens['verz_naam']); ?><br />
<?php print ($pat_gegevens['mutnr']); ?><br />
<?php print ($pat_gegevens['adres']); ?>
<br />
<?php print ($pat_gegevens['dlzip']." ".$pat_gegevens['dlnaam']); ?><br />
</td>
<td valign="top">
<h3><?php print($overlegdatum);?></h3>
<h3><?php print("Katz ".$records2['katzscore']);?></h3>
</td></tr>

<tr><td></td><td></td><td>Handtekening</td></tr>
<?php
    //----------------------------------------------------------
    // Overlegcoordinator weergeven
        $OCQuery1="
            SELECT
                overlegcoord.voornaam, overlegcoord.naam, adres, gem_id, tel, fax, gsm, email, sit_id, dlzip, dlnaam
            FROM
               overlegcoord, overleg, gemeente
            WHERE
               overleg.id = $overlegID
            AND
              overlegcoord.id = overleg.coordinator_id
            AND
              overlegcoord.gem_id=gemeente.id";
    $resultOCQuery1=mysql_query($OCQuery1);
    $oc_gegevens1= mysql_fetch_array($resultOCQuery1); //Query
    print ("<tr>    <td colspan=\"3\"><h3>Co&ouml;rdinatie&nbsp;van&nbsp;overleg</h3></td></tr>");
    print ("<tr>    <td valign=\"top\"><b>".$oc_gegevens1['naam']." ".$oc_gegevens1['voornaam']."</b></td>
                    <td valign=\"top\">Overlegco&ouml;rdinator TGZ</td>
                    <td valign=\"top\">................................<br />&nbsp;<br />&nbsp;</td></tr>");
    //----------------------------------------------------------

    //----------------------------------------------------------
    // HulpverlenersLijst weergeven
    print ("<tr>    <td colspan=\"3\">&nbsp;</td></tr>");
    print ("<tr>    <td colspan=\"3\"><h3>Zorg&nbsp;en&nbsp;hulpverlening</h3></td></tr>");
    $queryHVL = "
         SELECT 
                h.id,
                h.naam as hvl_naam,
                h.voornaam as hvl_voornaam,
                f.naam as fnct_naam,
                bl.persoon_id,
                h.riziv1,
                h.riziv2,
                h.riziv3,
                bl.id,
                org.naam as partner_naam,
                org.id as partner_id
            FROM 
                huidige_betrokkenen bl,
                hulpverleners h, 
                functies f,
                organisatie org
            WHERE 
                h.fnct_id = f.id AND
                bl.persoon_id = h.id AND
                bl.genre = 'hulp' AND
                bl.patient_code = '".$_SESSION['pat_code']."' AND
                org.id=h.organisatie
            ORDER BY 
                f.rangorde"; // Query
                
      if ($resultHVL=mysql_query($queryHVL))
         {
         for ($i=0; $i < mysql_num_rows ($resultHVL); $i++)
            {
            $recordsHVL= mysql_fetch_array($resultHVL);
            $veld1=($recordsHVL['hvl_naam']!="")    ?$recordsHVL['hvl_naam']    :"&nbsp;";
            $veld2=($recordsHVL['hvl_voornaam']!="")?$recordsHVL['hvl_voornaam']:"&nbsp;";
            $veld3=($recordsHVL['fnct_naam']!="")   ?$recordsHVL['fnct_naam']   :"&nbsp;";
            //$veld3=($recordsHVL['betrokhvl_zb']==1) ?$veld3."<br />Zorgbemiddelaar" :$veld3;
            $partner=(($recordsHVL['partner_id']==999)OR($recordsHVL['partner_id']==1000))?"":"<br />".$recordsHVL['partner_naam'];
            $veld3=$veld3.$partner;
            $rizivnr=   substr($recordsHVL['riziv1'],0,1)."-".
                        substr($recordsHVL['riziv1'],1,5)."-".
                        $recordsHVL['riziv2']."-".$recordsHVL['riziv3'];
            //$markering_o=($recordsHVL['betrokhvl_contact']==1)?"<b>":"";
            //$markering_s=($recordsHVL['betrokhvl_contact']==1)?"</b>":"";
    print ("<tr>    <td valign=\"top\">".$markering_o.$veld1." ".$veld2.$markering_s."</td>
                    <td valign=\"top\">".$veld3."</td>
                    <td valign=\"top\">................................<br />&nbsp;<br />&nbsp;</td></tr>");}}
    //----------------------------------------------------------

    //----------------------------------------------------------
    // MantelzorgersLijst weergeven
    print ("<tr>    <td colspan=\"3\">&nbsp;</td></tr>");
    print ("<tr>    <td colspan=\"3\"><h3>Mantelzorg</h3></td></tr>");
    $query = "
         SELECT
                m.naam as mzorg_naam,
                m.naam as mzorg_voornaam,
                bl.persoon_id,
                v.naam as verwsch_naam,
                v.rangorde
            FROM 
                huidige_betrokkenen bl,
                mantelzorgers m,
                verwantschap v
            WHERE 
                bl.persoon_id = m.id AND
                bl.genre = 'mantel' AND
                v.id = m.verwsch_id AND
                bl.patient_code='".$_SESSION['pat_code']."'
            ORDER BY
                v.rangorde,m.naam";

      if ($result=mysql_query($query))
         {
         for ($i=0; $i < mysql_num_rows ($result); $i++)
            {
            $records= mysql_fetch_array($result);
            $veld1=($records['mzorg_naam']!="")?$records['mzorg_naam']:"&nbsp;";
            $veld2=($records['mzorg_voornaam']!="")?$records['mzorg_voornaam']:"&nbsp;";
            //$markering_o=($records['betrokmz_contact']==1)?"<b>":"";
            //$markering_s=($records['betrokmz_contact']==1)?"</b>":"";
    print ("<tr>    <td valign=\"top\">".$markering_o.$veld1." ".$veld2.$markering_s."</td>
                    <td valign=\"top\">".$records['verwsch_naam']."</td>
                    <td valign=\"top\">................................<br />&nbsp;<br />&nbsp;</td></tr>");}}
    //----------------------------------------------------------

    
    print ("</table></p>");

    //---------------------------------------------------------
    /* Sluit Dbconnectie */ include("../includes/dbclose.inc");
    //---------------------------------------------------------?>
</div>
</div>
</body>
</html>
<?php
    }
//---------------------------------------------------------
/* Geen Toegang */ include("../includes/check_access.inc");
//---------------------------------------------------------
?>