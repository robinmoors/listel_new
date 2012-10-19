<?php

require('../includes/dbconnect2.inc');

$paginanaam="Vergoedbaar overleg (GDT) voor een PVS-patient";

if (IsSet($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan"))

    {



    $tabel = $_POST['tabel']; // "huidige" of "afgeronde"

    $overlegID = $_POST['id'];



    $querypat = "

         SELECT

                p.naam,

                p.voornaam,

                p.adres,

                g.dlzip,

                g.dlnaam,

                p.gebdatum,

                p.id, p.code,

                p.mutnr,
                g.deelvzw

            FROM

                patient p,

                gemeente g

            WHERE

                p.code='".$_SESSION['pat_code']."' AND

                p.gem_id=g.id"; // Query

      if ($resultpat=mysql_query($querypat))

        {

            $recordspat= mysql_fetch_array($resultpat);

        }

    $datum=mysql_fetch_array(mysql_query("SELECT datum FROM  overleg WHERE id=$overlegID"));

    require("../includes/html_html.inc");

    print("<head>");

    require("../includes/html_head.inc");

    ?>

    <style type="text/css">

      .rand{border-bottom:1px solid black;border-right:1px solid black;}

      .randtable{border-top:1px solid black;border-left:1px solid black;}

    </style>



    </head>

    <body onLoad="parent.print()">

    <div align="left">

    <div class="pagina">

    <table width="530">



    <tr><td><p><br /></td></tr>




<?php
  if ($recordspat['deelvzw']=="G") {
    $langeDienstNaam = "SEL/GDT GENK 947-047-61-001";
print('    <tr><td colspan="2"><div align="center"><img src="../images/SelG.jpg" height="100" style="float:left;"/>');
  }
  else if ($recordspat['deelvzw']=="H") {
    $langeDienstNaam = "SEL/GDT HASSELT 947-046-62-001";
print('    <tr><td colspan="2"><div align="center"><img src="../images/SelH.jpg" height="100" style="float:left;"/>');
  }
  else {
print('    <tr><td colspan="2"><div class="hidden"><img src="../images/logo_top_pagina_klein.gif" width="100"/></div></td></tr><tr><td colspan="2"><div align="center">');
  }
?>
    <div><u style="font-size: 170%;">BIJLAGE 69</u><br/><h1>ZORGPLAN</h1>

    bedoeld voor de volgende ge&iuml;ntegreerde dienst voor thuisverzorging:

    <h1><?= $langeDienstNaam ?></h1></div></td></tr>

    <tr><td colspan="2">Het <u>bijgevoegde</u> zorgplan is opgemaakt in het kader van het multidisciplinair overleg<br />

    op datum van <?php print(substr($datum[0],6,2)."/".substr($datum[0],4,2)."/".substr($datum[0],0,4));?> inzake de verzorging van de volgende pati&euml;nt:</td></tr>



    <tr><td>&nbsp;</td></tr>



    <tr><td>1.</td><td><u>Identificatiegegevens van de pati&euml;nt</u></td></tr>

    <tr><td></td><td>Naam en voornaam: <?php print($recordspat['naam']." ".$recordspat['voornaam']);?><br />

<?php

  if ($recordspat['dlzip'] ==-1) $recordspat['dlzip'] = "";

?>

    Adres: <?php print($recordspat['adres']. " - ".$recordspat['dlzip']." ".$recordspat['dlnaam']);?><br />

    Geboortedatum: <?php print(substr($recordspat['gebdatum'],6,2)."/".substr($recordspat['gebdatum'],4,2)."/".substr($recordspat['gebdatum'],0,4));?><br />

    Inschrijvingsnummer VI: <?php print($recordspat['mutnr']);?><br />&nbsp;</td></tr>





    <tr><td>&nbsp;</td></tr>



    <tr><td>2.</td><td><u>Deelnemers aan het multidisciplinair overleg</u></td></tr>

    <tr><td></td><td>



    <table cellpadding="15" width="100%"  class="randtable"><tr>

        <th class="rand" >Naam</th>

        <th class="rand" >Discipline<br />Organisatie</th>

        <th class="rand" >RIZIV-nr<br /><sup>(in voorkomend geval)</sup></th>

        <th class="rand" >Handtekening</th>

        </tr>





    <?php



    //----------------------------------------------------------

    // HulpverlenersLijst weergeven

      function groep($groep) {

        // groep efkes niet meer weergeven

        return "";

        switch ($groep) {

          case 1: return "HVL: ";

          case 2: return "ZVL: ";

          case 3: return "XVL: ";

          default: return "";

        }

      }



    if ($tabel == "afgeronde")

      $voorwaarde = "bl.overleg_id = $overlegID";

    else

      $voorwaarde = "bl.patient_code = '{$_SESSION['pat_code']}'";



       $queryHVL = "

         SELECT

                h.id,

                h.naam as hvl_naam,

                h.voornaam,

                f.naam as fnct_naam,

                f.groep_id,

                bl.persoon_id,

                h.riziv1,

                h.riziv2,

                h.riziv3,

                organisatie.naam as org_naam,

                organisatie.genre as org_genre

            FROM

                {$tabel}_betrokkenen bl,

                functies f,

                hulpverleners h

                LEFT JOIN organisatie ON ( organisatie.id = h.organisatie )

            WHERE
                overleggenre = 'gewoon' AND
                h.fnct_id = f.id AND

                bl.persoon_id = h.id AND

                bl.genre = 'hulp' AND

                bl.aanwezig = 1 AND

                $voorwaarde

            ORDER BY

                f.rangorde"; // Query



      if ($resultHVL=mysql_query($queryHVL))

         {

         for ($i=0; $i < mysql_num_rows ($resultHVL); $i++)

            {

            $recordsHVL= mysql_fetch_array($resultHVL);

            $veld1=($recordsHVL['hvl_naam']!="")    ?$recordsHVL['hvl_naam']    :"&nbsp;";

            $veld2=($recordsHVL['voornaam']!="")    ?$recordsHVL['voornaam']:"&nbsp;";

            $veld3=($recordsHVL['fnct_naam']!="")   ?groep($recordsHVL['groep_id']) . $recordsHVL['fnct_naam']   :"&nbsp;";

            //-------------------------------------------------------------------

            // heeft deze hvl een rizivnr zo ja corrigeer het met voorloopnullen

            if ($recordsHVL['org_genre'] == 'XVLNP' || $recordsHVL['org_genre'] == 'XVLP') {

              $rizivnr = "";

            }

            else if ($recordsHVL['riziv1']==0 || $recordsHVL['riziv1'] == "")

                {$rizivnr="...............................";}

            else

                {

                $rizivnr1=substr($recordsHVL['riziv1'],0,1)."-".substr($recordsHVL['riziv1'],1,5)."-";

                $rizivnr2=      ($recordsHVL['riziv2']<10)      ?"0".$recordsHVL['riziv2']:$recordsHVL['riziv2'];

                $rizivnr3=      ($recordsHVL['riziv3']<100)     ?"0".$recordsHVL['riziv3']:$recordsHVL['riziv3'];

                $rizivnr3=      ($recordsHVL['riziv3']<10)      ?"0".$rizivnr3:$rizivnr3;

                $rizivnr=$rizivnr1.$rizivnr2."-".$rizivnr3;

                }

            //-------------------------------------------------------------------



    if (isset($recordsHVL['organisatie']) && $recordsHVL['organisatie'] != 999)

       $orgnaam = "<br />{$recordsHVL['org_naam']}";

    else

      $orgnaam = "";



    print ("<tr>    <td class=\"rand\">".$veld1." ".$veld2."</td>

                    <td class=\"rand\" valign=\"top\">".$veld3."$orgnaam ({$recordsHVL['org_genre']})</td>

                    <td class=\"rand\" valign=\"top\">".$rizivnr."</td>

                    <td class=\"rand\" valign=\"bottom\">...................</td></tr>");}}

    //----------------------------------------------------------

    //----------------------------------------------------------

    // Blanco's weergeven

    print ("<tr>    <td class=\"rand\">...............................</td>

                    <td class=\"rand\">...............................</td>

                    <td class=\"rand\">...............................</td>

                    <td class=\"rand\">...................</td></tr>");

    //----------------------------------------------------------

    //----------------------------------------------------------

    // MantelzorgersLijst weergeven





    if ($tabel == "afgeronde") {

      $juisteRecords = "bl.overleg_id = $overlegID";

    }

    else {

      $juisteRecords = "bl.patient_code='{$_SESSION['pat_code']}'";

    }



    $query = "

         SELECT

                m.id,

                m.naam as mzorg_naam,

                m.voornaam,

                bl.persoon_id,

                v.naam as verwsch_naam,

                v.rangorde

            FROM

                {$tabel}_betrokkenen bl,

                mantelzorgers m,

                verwantschap v

            WHERE
                overleggenre = 'gewoon' AND
                bl.persoon_id = m.id AND

                bl.genre = 'mantel' AND

                v.id = m.verwsch_id AND

                $juisteRecords

            ORDER BY

                v.rangorde,m.naam";



      if ($result=mysql_query($query))

         {

         for ($i=0; $i < mysql_num_rows ($result); $i++)

            {

            $records= mysql_fetch_array($result);

            $veld1=($records['mzorg_naam']!="")?$records['mzorg_naam']:"&nbsp;";

            $veld2=($records['voornaam']!="")?$records['voornaam']:"&nbsp;";

            //$markering_o=($records['betrokmz_contact']==1)?"<b>&gt;&gt;":"";

            //$markering_s=($records['betrokmz_contact']==1)?"&lt;&lt;</b>":"";

    print ("<tr>    <td class=\"rand\" valign=\"top\">".$veld1." ".$veld2."</td>

                    <td class=\"rand\" valign=\"top\">".$records['verwsch_naam']."</td>

                    <td class=\"rand\">&nbsp;</td>

                    <td class=\"rand\" valign=\"bottom\">...................</td></tr>");}}

      else { print("allez seg, die query was fout $query");}

    //----------------------------------------------------------

    //----------------------------------------------------------

    // Blanco's weergeven

    print ("<tr>    <td class=\"rand\">...............................</td>

                    <td class=\"rand\">...............................</td>

                    <td class=\"rand\">...............................</td>

                    <td class=\"rand\">...................</td></tr>");

    //----------------------------------------------------------

    //----------------------------------------------------------

    // Blanco's weergeven

    print ("<tr>    <td class=\"rand\">...............................</td>

                    <td class=\"rand\">...............................</td>

                    <td class=\"rand\">...............................</td>

                    <td class=\"rand\">...................</td></tr>");

    //----------------------------------------------------------

    //----------------------------------------------------------

    /* Sluit Dbconnectie */ require("../includes/dbclose.inc");

    //----------------------------------------------------------

?>

<tr><td colspan="4"  class="rand" >Door hun handtekening te plaatsen, verklaren de deelnemende zorg- en hulpverleners dat

zij akkoord gaan met het bijgevoegd zorgplan.

<br/>

<div style="font-size:9px;text-align:justify">

Een duplicaat van dit vergoedbaar overleg (GDT) wordt administratief bewaard volgens de wet dd. 08/12/92 op de bescherming van de persoonlijke levenssfeer

t.o.v. de verwerking van persoonsgegevens. U hebt inzage in de gegevens die betrekking hebben op uw persoon, en kan ze steeds laten verbeteren.

De door u  verstrekte gegevens zullen door LISTEL vzw met zetel te 3500 Hasselt, A. Rodenbachstraat 29/1, worden verwerkt.

Zij zullen uitsluitend worden gebruikt voor administratieve afhandeling van het zorgplan en desgevallend voor

 facturatie van multidisciplinair overleg.

</div>

</td></tr>

</table></td></tr>







    <tr><td><p><br /></td></tr>



<tr><td valign="top">3.</td><td valign="top"><u>Verklaring van de vertegenwoordiger</u><br /><br /><br />&nbsp;</td></tr>

<tr><td></td><td>Ik,...........................................................................<br /><br /><br />

(naam <b>en</b> adres van de vertegenwoordiger) stem in met de deelnemers aan het overleg.

<div style="text-align:right"><br />Handtekening:...........................................</div></td></tr>





    <tr><td><p><br /></td></tr>

<tr><td valign="top">4.</td>

<td>



<u>Minimale inhoud van het vergoedbaar overleg (GDT)</u>



<ul>

<li>de geplande zorg van de pati&euml;nt</li>

<li>het functioneel bilan van de activiteiten van het dagelijks leven en van de instrumentele activiteiten van

het dagelijks leven</li>

<li>het bilan van het formele en informele verzorgingsnetwerk</li>

<li>het bilan van de omgeving en de eventuele aanpassing van die omgeving</li>

<li>de taakafspraken tussen zorg- en hulpverleners</li>

<li>de handtekening en identificatie van de persoon die het vergoedbaar overleg (GDT) uitschrijft </li>

</ul>

<br/><br/>

</td></tr>



<tr><td valign="top">5.</td><td><u>Bijgevoegde documenten</u> (mogen afzonderlijk aan de GDT worden bezorgd) <br/>

<span style="font-size:9px;">(hokje aankruisen indien het document bijgevoegd is)</span> </td></tr>





<tr><td valign="top">O</td><td valign="top">Evaluatieverslag<br />&nbsp;</td></tr>

<tr><td valign="top">O</td><td valign="top">

Een medische kennisgeving opgemaakt door de verantwoordelijke arts van een deskundig

ziekenhuiscentrum, waaruit blijkt dat de betrokken pati&euml;nt een PVS-pati&euml;nt is. Die medische

kennisgeving kan worden vervangen door een kopie van het formulier, gestuurd aan de

adviserende geneesheer in het kader van het KB van ... tot vaststelling van de

tegemoetkoming van de verplichte verzekering voor geneeskundige verzorging voor

geneesmiddelen, verzorgingsmiddelen en hulpmiddelen voor pati&euml;nten in een persisterende

vegetatieve status, bedoeld in art. 34 eerste lid, 14&deg;, van de wet betreffende de verplichte

verzekering voor geneeskundige verzorging en uitkeringen, geco&ouml;rdineerd op 14 juli 1994.

</td></tr>

</table>

</div></div></body></html>

<?php

    }



//---------------------------------------------------------

/* Geen Toegang */ require("../includes/check_access.inc");

//---------------------------------------------------------

?>