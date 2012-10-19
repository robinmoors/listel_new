<?php

session_start();

$paginanaam="Vergoedbaar Overleg (GDT)";

if (IsSet($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan"))

    {





    $tabel = $_POST['tabel']; // "huidige" of "afgeronde"

    $overlegID = $_POST['id'];



    //----------------------------------------------------------

    /* Maak Dbconnectie */ include('../includes/dbconnect2.inc');

    //----------------------------------------------------------

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







    $overleg=mysql_fetch_assoc(mysql_query("SELECT datum, aanwezig_patient, vertegenwoordiger FROM  overleg WHERE id=$overlegID"));

    $datum = $overleg['datum'];

    include("../includes/html_html.inc");

    print("<head>");

    include("../includes/html_head.inc");

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



    <tr><td  colspan="2"><div style="text-align:center">

<?php
  if ($recordspat['deelvzw']=="G") {
    $langeDienstNaam = "SEL/GDT GENK 947-047-61-001";
print('    <table width="100%"><tr><td><img src="../images/SelG.jpg" height="100"/></td>');
  }
  else if ($recordspat['deelvzw']=="H") {
    $langeDienstNaam = "SEL/GDT HASSELT 947-046-62-001";
print('    <table width="100%"><tr><td><img src="../images/SelH.jpg" height="100"/></td>');
  }
  else {
print('    <table width="100%"><tr><td><img src="../images/logo_top_pagina_klein.gif" width="100"/></td>');
  }
?>
    <td><div align="center"><u style="font-size: 170%;">BIJLAGE 64</u><br/><h1>ZORGPLAN</h1>

    bedoeld voor de volgende ge&iuml;ntegreerde dienst voor thuisverzorging:

    <h1><?= $langeDienstNaam ?></h1></div></td></tr></table></div></td></tr>

    <tr><td colspan="2">Het <u>bijgevoegd</u> zorgplan is opgemaakt in het kader van het multidisciplinair overleg

    op datum van <?php print(substr($datum,6,2)."/".substr($datum,4,2)."/".substr($datum,0,4));?> inzake de verzorging van de volgende pati&euml;nt:</td></tr>





    <tr><td>&nbsp;</td></tr>

    <tr><td>1.</td><td><u>Identificatiegegevens van de pati&euml;nt</u></td></tr>

    <tr><td></td><td>Naam en voornaam: <?php print($recordspat['naam']." ".$recordspat['voornaam']);?><br />

    Adres: <?php print ($recordspat['adres']); ?> -

           <?php if ($recordspat['dlzip']!=-1) print ($recordspat['dlzip']); ?>

           <?php print ($recordspat['dlnaam']); ?>

           <br />

    Geboortedatum: <?php print(substr($recordspat['gebdatum'],6,2)."/".substr($recordspat['gebdatum'],4,2)."/".substr($recordspat['gebdatum'],0,4));?><br />

    Inschrijvingsnummer VI: <?php print($recordspat['mutnr']);?><br />&nbsp;</td></tr>



    <tr><td>&nbsp;</td></tr>

    <tr><td>2.</td><td><u>Deelnemers aan het multidisciplinair overleg</u></td></tr>

    <tr><td></td><td>



    <table cellpadding="15" width="100%"  class="randtable" style="margin-left:-20px;"><tr>

        <th class="rand" >Naam</th>

        <th class="rand" >Discipline</th>

        <th class="rand" >RIZIV-nr<br /><sup>(in voorkomend geval)</sup></th>

        <th class="rand" >Handtekening</th>

        </tr>

    



    <?php



    //----------------------------------------------------------

    // HulpverlenersLijst weergeven

    if ($tabel == "afgeronde")

      $voorwaarde = "bl.overleg_id = $overlegID";

    else

      $voorwaarde = "bl.patient_code = '{$_SESSION['pat_code']}'";

      

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

                h.organisatie,

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

                organisatie.genre, f.rangorde"; // Query



//SELECT *

//FROM hulpverleners

//LEFT JOIN organisatie ON ( organisatie.id = hulpverleners.organisatie )



      if ($resultHVL=mysql_query($queryHVL) or die(mysql_error()))

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

    print ("<tr>    <td class=\"rand\" valign=\"top\">".$veld1." ".$veld2."</td>

                    <td class=\"rand\" valign=\"top\">".$veld3."$orgnaam ({$recordsHVL['org_genre']})</td>

                    <td class=\"rand\">".$rizivnr."</td>

                    <td class=\"rand\" valign=\"bottom\">...................</td></tr>");}}

    //----------------------------------------------------------

    //----------------------------------------------------------

    // Blanco's weergeven

    print ("<tr>    <td class=\"rand\" valign=\"top\">...............................</td>

                    <td class=\"rand\" valign=\"top\">...............................</td>

                    <td class=\"rand\">...............................</td>

                    <td class=\"rand\" valign=\"bottom\">...................</td></tr>");

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

                bl.aanwezig = 1 AND

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

    print ("<tr>    <td class=\"rand\" valign=\"top\">...............................</td>

                    <td class=\"rand\" valign=\"top\">...............................</td>

                    <td class=\"rand\">...............................</td>

                    <td class=\"rand\" valign=\"bottom\">...................</td></tr>");

    //----------------------------------------------------------

    //----------------------------------------------------------

    // Blanco's weergeven

    print ("<tr>    <td class=\"rand\" valign=\"top\">...............................</td>

                    <td class=\"rand\" valign=\"top\">...............................</td>

                    <td class=\"rand\">...............................</td>

                    <td class=\"rand\" valign=\"bottom\">...................</td></tr>");

    //----------------------------------------------------------



/*

if ($overleg['aanwezig_patient']==2) {

   // de patient wordt vertegenwoordigd

   $vertegenwoordiger = mysql_fetch_array(mysql_query("select concat(naam, concat(' ', voornaam)) from mantelzorgers where id = {$overleg['vertegenwoordiger']}"));

   $patOfVertegenw =  $vertegenwoordiger[0];

    print ("<tr>    <td class=\"rand\" valign=\"top\">{$vertegenwoordiger[0]}</td>

                    <td class=\"rand\" valign=\"top\">Vertegenwoordig(st)er van de pati&euml;nt</td>

                    <td class=\"rand\"></td>

                    <td class=\"rand\" valign=\"bottom\">...................</td></tr>");



}

else {

   $patOfVertegenw =  "{$recordspat['naam']} {$recordspat['voornaam']}";

    print ("<tr>    <td class=\"rand\" valign=\"top\">{$recordspat['naam']} {$recordspat['voornaam']}</td>

                    <td class=\"rand\" valign=\"top\">Pati&euml;nt</td>

                    <td class=\"rand\"></td>

                    <td class=\"rand\" valign=\"bottom\">...................</td></tr>");

}

*/



   $vertegenwoordiger = mysql_fetch_array(mysql_query("select concat(naam, concat(' ', voornaam)) from mantelzorgers where id = {$overleg['vertegenwoordiger']}"));

   $vertegenw =  $vertegenwoordiger[0];

   if ($vertegenw == "" || $vertegenw == " ") $vertegenw = "...............................";

    print ("<tr>    <td class=\"rand\" valign=\"top\">{$recordspat['naam']} {$recordspat['voornaam']} / <br/>$vertegenw</td>

                    <td class=\"rand\" valign=\"top\"><strong>Pati&euml;nt/mantelzorger<strong></td>

                    <td class=\"rand\"></td>

                    <td class=\"rand\" valign=\"bottom\">...................</td></tr>");



    //----------------------------------------------------------

    /* Sluit Dbconnectie */ include("../includes/dbclose.inc");

    //----------------------------------------------------------

?>

<tr><td colspan="4"  class="rand" >Door hun handtekening te plaatsen, verklaren de deelnemende zorg- en hulpverleners dat

zij akkoord gaan met het bijgevoegd zorgplan.

<br/><br/>

<div style="font-size:10px;text-align:justify">

Een duplicaat van dit vergoedbaar overleg (GDT) wordt administratief bewaard volgens de wet dd. 08/12/92 op de bescherming van de persoonlijke levenssfeer

t.o.v. de verwerking van persoonsgegevens. U hebt inzage in de gegevens die betrekking hebben op uw persoon, en kan ze steeds laten verbeteren.

De door u  verstrekte gegevens zullen door LISTEL vzw met zetel te 3500 Hasselt, A. Rodenbachstraat 29/1, worden verwerkt.

Zij zullen uitsluitend worden gebruikt voor administratieve afhandeling van het zorgplan en desgevallend voor

 facturatie van multidisciplinair overleg.

</div>

</td></tr>

</table></td></tr>







<tr><td valign="top">3.</td><td valign="top"><u>Verklaring van

de pati&euml;nt of zijn vertegenwoordiger</u>&nbsp;</td></tr>

<tr><td></td><td><ul><li>



<p style="line-height: 20px;">Ik, .....................................................<br />

 &nbsp; &nbsp; .....................................................<br />

 &nbsp; &nbsp; .....................................................<br /></p>

(naam pati&euml;nt of naam en adres van vertegenwoordiger)

stem in met de deelnemers aan het overleg.

<br />

<br /><br />



Handtekening : .........................</li></ul></td></tr>



<tr><td><br/></td><td><br /><ul><li>Indien de pati&euml;nt of de door hem aangeduide mantelzorger <strong>niet aanwezig</strong> wenst te zijn, moet

de pati&euml;nt (of zijn vertegenwoordiger) de volgende verklaring ondertekenen: <br />

<p style="line-height: 20px;">Ik, .....................................................<br />

 &nbsp; &nbsp; .....................................................<br />

 &nbsp; &nbsp; .....................................................<br /></p>

(naam pati&euml;nt of naam en adres van vertegenwoordiger)<br />

verklaar hierbij dat mijn aanwezigheid of een door mij aangeduide mantelzorger niet vereist is

op bovenvermeld multidisciplinair overleg.</li></ul></td></tr>

<tr><td></td><td colspan="2"><br /><br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Datum  ..............................

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

Handtekening

 ..............................</td></tr>





<tr><td>&nbsp;</td></tr>



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



<tr><td valign="top"><input type="radio" checked="checked"/><span class="checkedThing">X</span></td><td valign="top">Evaluatieverslag<br />&nbsp;</td></tr>

<tr><td valign="top"><input type="radio" checked="checked"/><span class="checkedThing">X</span></td><td valign="top">

Een verklaring van de huisarts dat de pati&euml;nt een persoon is die thuis verblijft of opgenomen is in een instelling

waarbij een terugkeer naar de thuisomgeving is gepland binnen de acht dagen en waarvan verondersteld wordt dat

hij nog ten minste &eacute;&eacute;n maand thuis zal blijven met een vermindering van fysieke zelfredzaamheid.

 </td></tr>









</table>

</div></div></body></html>

<?php

    }



//---------------------------------------------------------

/* Geen Toegang */ include("../includes/check_access.inc");

//---------------------------------------------------------

?>