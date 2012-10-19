<?php

session_start();

$paginanaam="zorgplan";

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

    <body onLoad="parent.print();">

    <div align="center">

    <div class="pagina">

    <table width="570">

<!--    <tr><td colspan="3"><div class="hidden"><img src="../images/logo_top_pagina_zorgenplan.gif" width="600"/></div></td></tr>   -->

<?php



$overlegID = $_POST['id'];
$overlegInfo = getUniqueRecord("select * from overleg where id = $overlegID");



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

        p.email,

        b.omschr,

        p.voornaam_echtg,

        p.naam_echtg,

        p.sex,

        p.mutnr,

        p.startdatum,

        p.rijksregister,
        g.deelvzw

    FROM

        patient p,

        gemeente g,

        verzekering v,

        burgstaat b

    WHERE

        p.gem_id=g.id AND

        p.code ='".$_SESSION['pat_code']."' AND

        (p.mut_id=v.id OR (p.mut_id = 0 AND v.id=1)) AND

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

// Haal de startkatz op



$katzSql="

    SELECT

        totaal as katzscore

    FROM

        overleg, katz

    WHERE

        overleg.patient_code =  '".$_SESSION['pat_code']."' and

        overleg.katz_id = katz.id

        and overleg.datum = {$pat_gegevens['startdatum']}";

$result2 = mysql_query($katzSql);

if (mysql_num_rows($result2)<>0 )

    {// een correcte record gevonden

    $records2= mysql_fetch_array($result2);

    }

else {

  $records2['katzscore'] = " niet ingevuld.";



}

//---------------------------------------------



$startdatum=$pat_gegevens['startdatum'];



$startdatumMooi=substr($pat_gegevens['startdatum'],6,2)."/".substr($pat_gegevens['startdatum'],4,2)."/".substr($pat_gegevens['startdatum'],0,4);

$geboortedatum=substr($pat_gegevens[5],6,2)."/".substr($pat_gegevens[5],4,2)."/".substr($pat_gegevens[5],0,4);

$geslacht=($pat_gegevens['sex']==0)?"(M)":"(V)";

  if ($pat_gegevens['deelvzw']=="G") {
    $langeDienstNaam = "SEL/GDT GENK 947-047-61-001";
print('    <tr><td colspan="3"><img src="../images/SelG.jpg" width="220"/>');
  }
  else if ($pat_gegevens['deelvzw']=="H") {
    $langeDienstNaam = "SEL/GDT HASSELT 947-046-62-001";
print('    <tr><td colspan="3"><img src="../images/SelH.jpg" width="220"/>');
  }
  else {
print('    <tr><td colspan="3"><img src="../images/logo_top_pagina_klein.gif" width="100"/>');
  }
?>
     <h1 style="float:right;">Voorpagina zorgplan</h1>
  </td>
  </tr>
<tr>

<td colspan="3" valign="top">

  <table width="100%">

   <tr><td valign="top" style="text-align:left">

   <h2>

   <?php

      print (strtoupper($pat_gegevens['pat_naam'])." <br />".$pat_gegevens['pat_voornaam']." ".$geslacht."</h2>");

   ?>

   <strong>&deg;<?php print ($geboortedatum); ?></strong> <?php print ($pat_gegevens['omschr']." ".$pat_gegevens['naam_echtg']." ".$pat_gegevens['voornaam_echtg']); ?>

   </td>

       <td valign="top" style="text-align:right"><h2>SO98-<?php print ($_SESSION['pat_code']);?></h2></td></tr>

<tr>

<td valign="top">

<p>

<?php

  if ($pat_gegevens['dlzip'] == -1)   $patdlzip = "";

  else $patdlzip = $pat_gegevens['dlzip'];

?>

<?php print ($pat_gegevens['adres']); ?><br />

<?php print ($patdlzip." ".$pat_gegevens['dlnaam']); ?><br />

<?php print ($pat_gegevens['tel']." <br /> ".$pat_gegevens['gsm']." <br /> " . $pat_gegevens['email']); ?><br />

<?php print ($pat_gegevens['verz_nr']." ".$pat_gegevens['verz_naam']); ?><br />

<?php print ($pat_gegevens['mutnr'] . " / RR: " . $pat_gegevens['rijksregister']); ?><br />

</td>

<td valign="top" style="text-align:right">

<h3>Start: <?php print($startdatumMooi);?></h3>

<h3>Katzscore bij aanvang: <?php print($records2['katzscore']);?></h3>

</td></tr>



  </table>

</td></tr>



<?php

    //----------------------------------------------------------

    // Overlegcoordinator weergeven
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

/*

        $OCQuery1="

            SELECT

                logins.voornaam, logins.naam, adres, gem_id, tel, fax, gsm, email,

                gemeente.dlzip, gemeente.dlnaam, overleg_gemeente, gemeente.naam as overleg_naam

            FROM

               logins, overleg, gemeente

            WHERE

               overleg.id = $overlegID

            AND

               logins.profiel = 'OC'

            AND

               gemeente.zip = logins.overleg_gemeente

            AND

              logins.id = overleg.coordinator_id

            AND

              logins.gem_id=gemeente.id";

    $resultOCQuery1=mysql_query($OCQuery1);

    $oc_gegevens1= mysql_fetch_array($resultOCQuery1); //Query
*/



    print ("<tr>    <td valign=\"top\"><strong>Organisator<br/>van overleg</strong></td>
                    <td valign=\"top\">".$oc_gegevens1['naam']." ".$oc_gegevens1['voornaam'].
                    "<br/>{$oc_gegevens1['adres']}<br />{$oc_gegevens1['dlzip']} {$oc_gegevens1['dlnaam']}<br/>
                    {$oc_gegevens1['tel']}<br />{$oc_gegevens1['email']}</td>
                    <td valign=\"top\">Handtekening<br/><br/><br/>.......................................</td></tr>");


    //----------------------------------------------------------





    //----------------------------------------------------------

    // contactpersonen weergeven

    $contact = mysql_fetch_array(mysql_query("select datum, contact_hvl, contact_mz from overleg where id = $overlegID"));

    $overlegdatum2=substr($contact['datum'],6,2)."/".substr($contact['datum'],4,2)."/".substr($contact['datum'],0,4);



    print ("<tr>    <td colspan=\"3\">&nbsp;</td></tr>");

//    print ("<tr>    <td colspan=\"3\"><h3>Contactpersonen <!-- (op $overlegdatum2) --> </h3></td></tr>");

    $queryHVL = "
         SELECT
                h.id,
                h.naam as hvl_naam,
                h.voornaam as hvl_voornaam,
                h.adres,
                h.tel, h.gsm, h.email,
                f.naam as fnct_naam,
                h.riziv1, h.riziv2, h.riziv3,
                org.naam as partner_naam,
                org.id as partner_id,
                org.id as organisatie,
                org.gem_id as partner_gem_id,
                org.adres as partner_adres,
                org.tel as partner_tel,
                g.dlzip,
                g.dlnaam
            FROM
                functies f,
                gemeente g,
                hulpverleners h
                LEFT JOIN organisatie org ON ( org.id = h.organisatie )
   WHERE
                h.fnct_id = f.id AND
                h.id = {$contact['contact_hvl']} AND
                g.id = h.gem_id
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



            $hvl_adres=     $recordsHVL['adres'];

            $hvl_dlzip=     $recordsHVL['dlzip'];

            $hvl_dlnaam=    $recordsHVL['dlnaam'];

            $hvl_tel=       $recordsHVL['tel'];

            $hvl_gsm=       $recordsHVL['gsm'];

            $hvl_email=     $recordsHVL['email'];

            $partner_adres= $recordsHVL['partner_adres'];

            $partner_tel=   $recordsHVL['partner_tel'];

            $partner_gsm=   $recordsHVL['partner_gsm'];

            //-------------------------------------------------------------------

            // indien een hvl werkt voor een partner toon deze dan

            $partner=       (($recordsHVL['partner_id']==999)OR($recordsHVL['partner_id']==1000))?"":"<br />".

                                    $recordsHVL['partner_naam'];

                $qry8="SELECT dlzip,dlnaam FROM gemeente WHERE id=".$recordsHVL['partner_gem_id'];

                if (isset($recordsHVL['partner_gem_id']) && $recordsHVL['partner_gem_id'] != 9999) {

                  $gemeente=mysql_fetch_array(mysql_query($qry8));

                  $partner_dlzip=$gemeente['dlzip'];

                  $partner_dlnaam=$gemeente['dlnaam'];

                }

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

            //-------------------------------------------------------------------

if ($overlegInfo['type']=="psy") {
  $soortContactperson = "Referentiepersoon";
}
else {
  $soortContactperson = "Zorgbemiddelaar";
}
    print ("<tr> <td valign=\"top\"><strong>$soortContactperson</strong></td>

                 <td valign=\"top\">$veld1 $veld2<br />

                     <!-- $hvl_adres<br /> $hvl_dlzip $hvl_dlnaam <br /> -->

                     $hvl_tel  $hvl_gsm {$recordsHVL['email']}</td>

                 <td valign=\"top\">$veld3</td>

                    </tr>");}}

    //----------------------------------------------------------



    //----------------------------------------------------------

    // Mantelzorgerscontactpersoon

    $query = "

         SELECT

                m.*,

                v.naam as verwsch_naam,

                v.rangorde,

                gemeente.dlzip, gemeente.dlnaam

            FROM 

                verwantschap v,

                mantelzorgers m

                LEFT JOIN gemeente ON (gemeente.id = m.gem_id)

            WHERE

                v.id = m.verwsch_id AND

                m.id = {$contact['contact_mz']}

            ORDER BY

                v.rangorde,m.naam";



      if ($result=mysql_query($query))

         {

         for ($i=0; $i < mysql_num_rows ($result); $i++)

            {

            $records= mysql_fetch_array($result);

            $veld1=($records['naam']!="")?$records['naam']:"&nbsp;";

            $veld2=($records['voornaam']!="")?$records['voornaam']:"&nbsp;";

            //$markering_o=($records['betrokmz_contact']==1)?"<b>":"";

            //$markering_s=($records['betrokmz_contact']==1)?"</b>":"";

    if ($records['dlzip']==-1) $records['dlzip'] = "";

    if (isset($records['adres']) && $records['adres'] != "")

      $adres =   "{$records['adres']}, {$records['dlzip']} {$records['dlgemeente']}<br />";

    print ("<tr>    <td valign=\"top\"><br /><strong>Contactpersoon<br/>voor de mantelzorgers</strong></td>

                    <td valign=\"top\"><br />$veld1 $veld2 <br />

                    <!-- $adres -->

                    {$records['tel']} {$records['gsm']} {$records['email']}</td>

                    <td valign=\"top\"><br />{$records['verwsch_naam']} </td>

                    </tr>");}}

    //----------------------------------------------------------





    // alle betrokkenen bij het eerste overleg

    // eerst dat overlegID ophalen

    //$eersteOverleg = mysql_fetch_array(mysql_query("select * from overleg where patient_code = '".$_SESSION['pat_code']."' and datum = $startdatum"));



    // vanaf nu is "eersteOverleg" (terug) gelijk aan het huidige overleg

    $eersteOverleg = mysql_fetch_array(mysql_query("select * from overleg where id = $overlegID"));

    $overlegInfo = $eersteOverleg;



    if ($eersteOverleg['afgerond']==1)

      $tabel = "afgeronde";

    else

      $tabel = "huidige";



    if ($tabel == "afgeronde")

      $voorwaarde = "bl.overleg_id = {$eersteOverleg['id']}";

    else

      $voorwaarde = "bl.patient_code = '{$_SESSION['pat_code']}'";





    print ("<tr>    <td colspan=\"3\">&nbsp;</td></tr>");

        print ("<tr>    <td class=\"geenRand\" colspan=\"3\"><h3>Betrokkenen bij de thuiszorg <!-- (bij het overleg van $overlegdatum2) --></h3></td></tr>");



?>

<tr>

<td colspan="3" style="font-size:9px;text-align: justify">

Een duplicaat van dit zorgplan wordt administratief bewaard volgens de wet dd. 08/12/92 op de bescherming van de persoonlijke levenssfeer

t.o.v. de verwerking van persoonsgegevens. U hebt inzage in de gegevens die betrekking hebben op uw persoon, en kan ze steeds laten verbeteren.

De door u  verstrekte gegevens zullen door LISTEL vzw met zetel te 3500 Hasselt, A. Rodenbachstraat 29/1, worden verwerkt.

Zij zullen uitsluitend worden gebruikt voor administratieve afhandeling van het zorgplan en desgevallend voor

 facturatie van multidisciplinair overleg.

<br/><br/>

Door ondertekening geeft u  toestemming om de op de elektronische en/of papieren invulformulieren van dit zorgplan vermelde persoonsgegevens,

op het beveiligde gedeelte van  de  website van LISTEL vzw te plaatsen. Deze elektronische/papieren formulieren zijn: zorgplan,

Vergoedbaar overleg (GDT), Betrokkenen in de thuiszorg, Verklaring huisarts, Katz-score, Evaluatie-instrument, en Verklaring Bankrekeningnummers.
<br/>
Door ondertekening geeft u ook toestemming om de gegevens van uw zorgbemiddelaar ter beschikking te stellen aan een zorg- of hulpverlener van het ziekenhuis waar u (eventueel) opgenomen bent of wordt.
<br/><br/>

Ondergetekende pati&euml;nt/vertegenwoordiger heeft kennis genomen van dit zorgplan en geeft toestemming aan LISTEL vzw om de

door hem/haar verstrekte gegevens te verwerken voor bovenvermelde doeleinden. Dit overleg is een dienstverlening die gratis is voor de pati&euml;nt.

<br/><br/>

Deelnemers onderschrijven ook de Limburgse code: iedere professionele zorg- en hulpverlener bewaakt de zorgsituatie van zijn thuiszorg-pati&euml;nt

en signaleert wanneer bijkomende zorg zou moeten ingeschakeld worden. Hij respecteert hierbij volledig de vrije keuze van de pati&euml;nt inzake

zijn zorgverstrekkers. Hij informeert de pati&euml;nt over voorzieningen, hulpmiddelen en tegemoetkomingen en verwijst door waar nodig.

</td>

</tr>





<style type="text/css">

  #tabelleke td {

    padding-top: 18px;

  }

</style>





<?php

    print("<table width=\"570\" id=\"tabelleke\">");



if ($overlegInfo['genre']=="TP") {

?>

    <tr><td>

                    <table><tr><td>&nbsp;

                    </td><td><b>Partners TP</b></td></tr></table>

                    </td></tr>



<?php

  $qryOrgs = "select organisatie.id as org_id, organisatie.naam from {$tabel}_betrokkenen bl, organisatie

              where overleggenre = 'gewoon' AND
                bl.genre = 'org' AND
                persoon_id = organisatie.id AND

                $voorwaarde";

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





    print("<tr><td colspan=\"3\"><li>

                      <b>{$org['naam']}</b></li></td></tr>");

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

                h.organisatie,

                organisatie.naam as org_naam,

                aanwezig

            FROM

                {$tabel}_betrokkenen bl,

                hulpverleners h,

                organisatie

            WHERE
                overleggenre = 'gewoon' AND
                bl.genre = 'orgpersoon' AND

                bl.persoon_id = h.id AND



                bl.namens = {$org['org_id']} AND

                h.organisatie = organisatie.id AND



                $voorwaarde

                $beperking";

// was                 h.organisatie in ($orgs) AND



     $resultPersonen = mysql_query($qryOrgPersonen) or die("problemen met $qryOrgPersonen " . mysql_error());

     if (mysql_num_rows($resultPersonen) == 0) {

       $hoogte += 25;

       print("<tr style='background-color: yellow'><td>-- geen vertegenwoordigers voor deze organisatie -- </td></tr>");

     }

     for ($p=0; $p<mysql_num_rows($resultPersonen); $p++) {

       $persoon = mysql_fetch_assoc($resultPersonen);

            $aanwezig = $persoon['aanwezig'] == 1;

            if ($aanwezig)  {

              $stijl = "aanwezig";

            }

            else {

              $stijl = "afwezig";

            }

            $hoogte += 25;

            $veld1=($persoon['hulpverlener_naam']!="")    ?$persoon['hulpverlener_naam']    :"&nbsp;";

            $veld2=($persoon['voornaam']!="")?$persoon['voornaam']:"&nbsp;";



            if ($persoon['org_naam']!=$org['naam']) {

              $organisatieNaam = $persoon['org_naam'];

            }

            else {

              $organisatieNaam = "";

            }

            print ("

                <tr class=\"$stijl\" id=\"rij{$persoon['id']}\">

                <td valign=\"top\" width=\"220\" title=\"$titel\">".$veld1." ".$veld2."</td>

                <td valign=\"top\" >&nbsp;$organisatieNaam</td>

                <td valign=\"bottom\">.......................................<br/></td>

                </tr>");

     }

// blanco lijn

    print ("<tr>    <td valign=\"bottom\">&nbsp;<br />&nbsp;<br />....</td>

                    <td valign=\"bottom\">&nbsp;<br />&nbsp;<br />....</td>

                    <td valign=\"bottom\">................................</td>

                    </tr>");



  }







}



if (!function_exists('toonBetrokkenen')) {

function toonBetrokkenen($genre, $tabel, $voorwaarde, $checkVerandering,$extraParameterSelectPersonen="", $extraParameterSelectPersonen2="", $baseURL) {

    global $beperking, $hoogte, $huisarts, $huisartsNr, $overlegInfo;



    $fouteRekeningnummers = ""; // lokale variabele

    $hoogte += 25;



    //----------------------------------------------------------

    // HulpverlenersLijst weergeven

    //print ("<tr>    <td><b>Zorg&nbsp;en&nbsp;hulpverlening</b></td></tr>");

    //print ("<tr>    <td><hr /></td></tr>");

    if ($genre == "ZVL") {

      print ("<tr><td colspan=\"2\"></br/><b>Zorgverleners</b></br/>&nbsp;

              </td><td>Handtekening</td></tr>");

      $orgGenre = "o.genre = 'ZVL' ";

    }

    else if ($genre == "HVL") {

      print ("<tr><td colspan=\"3\"><b></br/>Hulpverleners opgenomen in GDT</b></br/>&nbsp;</td>

              </td></tr>");

      $orgGenre = "o.genre = 'HVL' ";

    }

    else if ($genre == "XVL") {

      print ("<tr><td colspan=\"3\"><b></br/>Hulpverleners niet-GDT en niet-professionelen</b></br/>

              </td></tr>");

      $orgGenre = "(o.genre = 'XVLNP' or o.genre = 'XVLP') ";

    }

    else if ($genre == "XVLP") {

      print ("<tr><td colspan=\"3\"><b></br/>Hulpverleners niet opgenomen in GDT</b></br/>

              </td></tr>");

      $orgGenre = "o.genre = 'XVLP' ";

    }

    else if ($genre == "XVLNP") {

      print ("<tr><td colspan=\"3\"><b></br/>Niet-professionelen</b>  </br/>

              </td></tr>");

      $orgGenre = "o.genre = 'XVLNP' ";

    }

    else {

      $orgGenre = " 3 = 4 ";

    }

    $ggzVoorwaarde = "((o.ggz=1) or f.id in (62,76,117))";
    if ($overlegInfo['genre'] == "psy" && $genre != "GGZ") {
      $orgGenre .= " and not $ggzVoorwaarde ";
    }
    else if ($genre == "GGZ") {
      print ("<tr><td>
                    <table><tr><td><a href=\"overleg_plannen_select_ggz_twee.php$extraParameterSelectPersonen\">
                    <img src=\"../images/voegtoe.gif\" alt=\"Toevoegen\"  border=\"0\"></a>
                    </td><td><b>GGZ</b></td></tr></table>
              </td></tr>");
      $orgGenre = $ggzVoorwaarde;
    }



    $queryHVL = "
         SELECT
                bl.id,
                h.naam as hulpverlener_naam,
                h.voornaam as voornaam,
                f.naam as functie_naam,
                bl.persoon_id,
                h.riziv1,
                h.riziv2,
                h.riziv3,
                h.reknr,
                h.iban,
                h.bic,
                h.tel,
                h.organisatie,
                h.fnct_id,
                f.groep_id,
                aanwezig
            FROM
                {$tabel}_betrokkenen bl,
                functies f,
                hulpverleners h
                left join organisatie o on h.organisatie = o.id
            WHERE
                overleggenre = 'gewoon' AND
                bl.genre = 'hulp' AND
                h.fnct_id = f.id AND
                bl.persoon_id = h.id AND
                $orgGenre AND
                $voorwaarde
                $beperking
            ORDER BY
                f.rangorde, bl.id"; //



      if ($resultHVL=mysql_query($queryHVL))

         {

         for ($i=0; $i < mysql_num_rows ($resultHVL); $i++)

            {

            $recordsHVL= mysql_fetch_array($resultHVL);



            $veld1=($recordsHVL['hulpverlener_naam']!="")    ?$recordsHVL['hulpverlener_naam']    :"&nbsp;";

            $veld2=($recordsHVL['voornaam']!="")?$recordsHVL['voornaam']:"&nbsp;";

            $veld3=($recordsHVL['functie_naam']!="")   ?$recordsHVL['functie_naam']   :"&nbsp;";

            //$veld3=($recordsHVL['betrokhvl_zb']==1) ?$veld3."<br />Zorgbemiddelaar" :$veld3;

/*
            if (isset($recordsHVL['riziv1']) && $recordsHVL['riziv1'] != 0) {
                $titel = "";
            }
            else {
              // organisatie ophalen
              if (isset($recordsHVL['organisatie'])) {
                 $orgNaam = mysql_fetch_array(mysql_query("select naam from organisatie where id = {$recordsHVL['organisatie']}"));
                 $titel = $orgNaam['naam'];
              }
            }
*/
              // organisatie ophalen
              if (isset($recordsHVL['organisatie']) && $recordsHVL['organisatie'] > 0) {
                 $orgNaam = mysql_fetch_array(mysql_query("select naam from organisatie where id = {$recordsHVL['organisatie']}"));
                 $titel = $orgNaam['naam'];
              }
              else {
                $titel = "";
              }

            $aanwezig = $recordsHVL['aanwezig'] == 1;

            if ($aanwezig)  {

              $stijl = "aanwezig";

            }

            else {

              $stijl = "afwezig";

            }



            $hoogte += 27;



            print ("

                <tr class=\"$stijl\" id=\"rij{$recordsHVL['id']}\">

                <td valign=\"top\" width=\"230\" title=\"$titel\">".$veld1." ".$veld2."</td>

                <td valign=\"top\" width=\"230\">".$veld3."<br/>$titel</br/></td>

                <td valign=\"bottom\">.................................<br/></td>

                </tr>");}}

    //----------------------------------------------------------

// blanco lijn

    print ("<tr>    <td valign=\"bottom\">&nbsp;<br />&nbsp;<br />....</td>

                    <td valign=\"bottom\">&nbsp;<br />&nbsp;<br />....</td>

                    <td valign=\"bottom\">................................</td>

                    </tr>");



    //print("<h1>1: $fouteRekeningnummers</h1>");

}

}


if ($overlegInfo['genre']=="psy") {
  toonBetrokkenen("GGZ", $tabel, $voorwaarde, $checkVerandering, $extraParameterSelectPersonen, $extraParameterSelectPersonen2, $baseURL);
}


toonBetrokkenen("ZVL", $tabel, $voorwaarde, $checkVerandering, $extraParameterSelectPersonen, $extraParameterSelectPersonen2, $baseURL);

toonBetrokkenen("HVL", $tabel, $voorwaarde, $checkVerandering, $extraParameterSelectPersonen, $extraParameterSelectPersonen2, $baseURL);



if ($overlegInfo['genre']=="TP") {

  toonBetrokkenen("XVLP", $tabel, $voorwaarde, $checkVerandering, $extraParameterSelectPersonen, $extraParameterSelectPersonen2, $baseURL);

  toonBetrokkenen("XVLNP", $tabel, $voorwaarde, $checkVerandering, $extraParameterSelectPersonen, $extraParameterSelectPersonen2, $baseURL);

}

else {

  toonBetrokkenen("XVL", $tabel, $voorwaarde, $checkVerandering, $extraParameterSelectPersonen, $extraParameterSelectPersonen2, $baseURL);

}



/***********************************

  OUDE CODE



        print ("<tr>    <td class=\"geenRand\" colspan=\"2\"><h3>Zorgverleners</h3></td><td>Handtekening</td></tr>");



    $huidigeGroep = 2;



    //----------------------------------------------------------

    // HulpverlenersLijst weergeven

    if ($eersteOverleg['afgerond']==1)

      $tabel = "afgeronde";

    else

      $tabel = "huidige";



    if ($tabel == "afgeronde")

      $voorwaarde = "bl.overleg_id = {$eersteOverleg['id']}";

    else

      $voorwaarde = "bl.patient_code = '{$_SESSION['pat_code']}'";





    $queryHVL = "

         SELECT

                h.id as hvl_id,

                h.naam as hvl_naam,

                h.voornaam as hvl_voornaam,

                f.naam as fnct_naam,

                f.groep_id,

                org.naam as partner_naam,

                org.id as partner_id

            FROM

                {$tabel}_betrokkenen bl,

                functies f,

                hulpverleners h

                LEFT JOIN organisatie org ON ( org.id = h.organisatie )

            WHERE
                overleggenre = 'gewoon' AND
                h.fnct_id = f.id AND

                bl.persoon_id = h.id AND

                bl.genre = 'hulp' AND

                $voorwaarde

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

            $partner_adres= $recordsHVL['partner_adres'];

            //-------------------------------------------------------------------

            // indien een hvl werkt voor een partner toon deze dan

            $partner=       (($recordsHVL['partner_id']==999)OR($recordsHVL['partner_id']==1000))?"":"<br />".

                                    $recordsHVL['partner_naam'];

            $fnct_naam=$fnct_naam.$partner;

            //-------------------------------------------------------------------





           if ($huidigeGroep != $recordsHVL['groep_id']) {

               $huidigeGroep = $recordsHVL['groep_id'];

               if ($huidigeGroep == 1)

                   print ("<tr>    <td class=\"geenRand\" colspan=\"3\"><h3>Hulpverleners GDT</h3></td></tr>");

               if ($huidigeGroep == 3)

                   print ("<tr>    <td class=\"geenRand\" colspan=\"3\"><h3>Overige hulpverleners</h3></td></tr>");

            }



     print ("<tr>    <td valign=\"top\" width=\"40%\">

                    $hvl_naam $hvl_voornaam<br /></td>

                    <td valign=\"top\" width=\"40%\"> $fnct_naam <br />&nbsp;</td>

                    <td>................................</td>

                    </tr>");}}

    //----------------------------------------------------------

  OUDE CODE

***********************************/





          //----------------------------------------------------------


print("</table><table width=\"570\">\n");

    // MantelzorgersLijst weergeven

    $query = "

         SELECT

                m.id as mzorg_id,

                m.naam as mzorg_naam,

                m.voornaam as mzorg_voornaam,

                bl.persoon_id,

                v.naam as verwsch_naam

            FROM

                {$tabel}_betrokkenen bl,

                mantelzorgers m,

                verwantschap v

            WHERE
                overleggenre = 'gewoon' AND
                bl.persoon_id = m.id AND

                bl.genre = 'mantel' AND

                v.id = m.verwsch_id AND

                $voorwaarde

            ORDER BY

                v.rangorde,m.naam";



      if ($result=mysql_query($query))

         {

         if (mysql_num_rows ($result) > 0)

              print ("<tr>    <td class=\"geenRand\" colspan=\"3\"><h3>Mantelzorger(s)</h3></td></tr>");

         for ($i=0; $i < mysql_num_rows ($result); $i++)

            {

            $records= mysql_fetch_array($result);

            $MZnaam=($records['mzorg_naam']!="")?$records['mzorg_naam']:"&nbsp;";

            $MZvoornaam=($records['mzorg_voornaam']!="")?$records['mzorg_voornaam']:"&nbsp;";



    print ("<tr>    <td valign=\"top\">".

                    $MZnaam." ".$MZvoornaam."<br /></td>

                    <td valign=\"top\">".$records['verwsch_naam']."<br />&nbsp;</td>

                    <td>................................</td>

                    </tr>");}}

     else print("verkeerde mantelzorgers-query $query");

    //----------------------------------------------------------







// blanco lijn

    print ("<tr>    <td valign=\"bottom\">&nbsp;<br />&nbsp;<br />....</td>

                    <td valign=\"bottom\">&nbsp;<br />&nbsp;<br />....</td>

                    <td valign=\"bottom\">................................</td>

                    </tr>");



    //---------------------------------------------------------

    /* Sluit Dbconnectie */ include("../includes/dbclose.inc");

    //---------------------------------------------------------?>

    





<tr><td>&nbsp;</td></tr>

<tr><td colspan="2">Handtekening pati&euml;nt/vertegenwoordiger:</td><td>.................................</td></tr>



</table></p>



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