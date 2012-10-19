<?php

session_start();

$paginanaam="Plan van tenlasteneming Therapeutisch Project";

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
                g.deelvzw,

                p.gebdatum,

                p.id, p.code,

                p.mutnr,

                p.rijksregister,

                patient_tp.project,

                tp_project.naam as project_naam,

                tp_project.nummer as project_nummer,

                datum, tp_verslag, tp_auteur, tp_nieuwepartners

            FROM

                patient p, patient_tp,

                tp_project,

                gemeente g,

                overleg

            WHERE

                overleg.id = $overlegID AND

                p.code= overleg.patient_code AND

                p.code = patient_tp.patient AND

                patient_tp.project = tp_project.id AND

              datum >= replace(patient_tp.begindatum, '-', '') AND

              (  datum <= replace(patient_tp.einddatum, '-', '')

                   or

                 patient_tp.einddatum is NULL

              ) and

                p.gem_id=g.id"; // Query

      if ($resultpat=mysql_query($querypat))

        {

            $alleInfo= mysql_fetch_array($resultpat);

        }

      else {

        die("dieje query $querypat alles van het patient en project op te halen toch..." .mysql_error());

      }



    if ($tabel == "afgeronde")

      $voorwaarde = "overleg_id = $overlegID";

    else

      $voorwaarde = "patient_code = '{$alleInfo['code']}'";





    $datum = $alleInfo['datum'];

    $mooieDatum = substr($datum, 6,2) . "/" . substr($datum, 4,2) . "/" . substr($datum, 0,4);



    if (isEersteOverlegTP_op($datum)) {

      $soortVergadering = "inclusieoverleg";

      $lidwoord = "het";

    }

    else {

      $soortVergadering = "opvolgvergadering";

      $lidwoord = "de";

    }



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



    <tr><td style="valign: center;" colspan="2">

<?php
  if ($alleInfo['deelvzw']=="G") {
    $src = "SelG.jpg";
    $naamListel = "SEL Genk";
  }
  else if ($alleInfo['deelvzw']=="H") {
    $src = "SelH.jpg";
    $naamListel = "SEL Hasselt";
  }
  else {
    $src = "logo_top_pagina_klein.gif";
    $naamListel = "GDT Listel vzw";
  }
?>
               <img style="float:left;margin-right: 30px;" src="../images/<?= $src ?>" height="100" />

               <br/>Therapeutisch project nr. <?= $alleInfo['project_nummer'] ?><br/><br/>

               "<strong><?= $alleInfo['project_naam'] ?>"</strong>

           </td>

       </tr>



       <tr><td><hr /></td></tr>



       <tr>

        <td style="text-align:center">

          <h1 style="font-size: 40px;">Plan van tenlasteneming</h1>

          <h2><?= $soortVergadering ?></h2>

        </td>

       </tr>



       <tr><td><hr /></td></tr>





    <tr><td><u>Identificatiegegevens van de pati&euml;nt</u><br/>

    <span style="font-size: 9px;"><em>(Invullen of het kleefbriefje Verzekeringsinstelling (V.I.). aanbrengen)</em></span></td></tr>

    <tr><td>Naam en voornaam: <?php print($alleInfo['naam']." ".$alleInfo['voornaam']);?><br />

    Adres: <?php print ($alleInfo['adres']); ?> -

           <?php if ($alleInfo['dlzip']!=-1) print ($alleInfo['dlzip']); ?>

           <?php print ($alleInfo['dlnaam']); ?>

           <br />

    Geboortedatum: <?php print(substr($alleInfo['gebdatum'],6,2)."/".substr($alleInfo['gebdatum'],4,2)."/".substr($alleInfo['gebdatum'],0,4));?><br />

    Inschrijvingsnummer VI: <?php print($alleInfo['mutnr']);?><br />&nbsp;</td></tr>



       <tr><td><hr /></td></tr>



       <tr>

         <td>

            INSZ-nummer van pati&euml;nt: <?= $alleInfo['rijksregister'] ?>

         </td>

       </tr>



       <tr><td><hr /></td></tr>



       <tr>

         <td>

            Datum van <?= "$lidwoord $soortVergadering : $mooieDatum " ?>

         </td>

       </tr>





       <tr>

         <td>

           <table width="100%">

               <tr>

                  <th class="rand" width="50%">Aanwezige partners op <?="$lidwoord $soortVergadering"?></th>

                  <th class="rand" width="50%">Naam van de vertegenwoordiger van de partner die aanwezig is op het overleg</th>

               </tr>



<?php

     $qryPartners = "select organisatie.naam, organisatie.id from {$tabel}_betrokkenen, organisatie

                     where overleggenre = 'gewoon' AND {$tabel}_betrokkenen.genre = 'org' and persoon_id = organisatie.id and $voorwaarde";

     $resultPartners = mysql_query($qryPartners) or die($qryPartners . mysql_error());

     $partners = "";

     for ($j = 0; $j < mysql_num_rows($resultPartners); $j++) {

        $rijPartner = mysql_fetch_assoc($resultPartners);

        

/* oude vijvers

    // eerst alle subzetels/vestigingen toevoegen

    $queryVestigingen = "select id from organisatie

                         where hoofdzetel = {$rijPartner['id']}";

    $resultVestigingen = mysql_query($queryVestigingen) or die("dedoemme $queryVestigingen");

    $orgs = "";

    for ($ii=0;$ii<mysql_num_rows($resultVestigingen);$ii++) {

      $bijOrg = mysql_fetch_assoc($resultVestigingen);

      $orgs .= ", {$bijOrg['id']}";

    }





     // dan alle gelijkaardige organisatie pakken: de 'vijvers'

     $zoekTerm = "";

     $naam = $rijPartner['naam'];

     if (substr($naam,0,3)=='CGG') {

       $zoekTerm = "select id from organisatie where id <> {$rijPartner['id']} and naam LIKE 'CGG%' ";

       $CGG = false;

     }

     else if (substr($naam,0,4)=='DAGG') {

       $zoekTerm = "select id from organisatie where id <> {$rijPartner['id']} and naam LIKE 'DAGG%' ";

       $DAGG = false;

     }

     else if (substr($naam,0,4)=='VGGZ') {

       $zoekTerm = "select id from organisatie where id <> {$rijPartner['id']} and naam LIKE 'VGGZ%' ";

       $VGGZ = false;

     }

     else if (substr($naam,0,5)=='RCGGZ') {

       $zoekTerm = "select id from organisatie where id <> {$rijPartner['id']} and naam LIKE 'RCGGZ%' ";

       $RCGGZ = false;

     }

     else if (substr($naam,0,6)=='ARCGGZ') {

       $zoekTerm = "select id from organisatie where id <> {$rijPartner['id']} and naam LIKE 'ARCGGZ%' ";

       $ARCGGZ = false;

     }

     else if (substr($naam,0,2)=='BW') {

       $zoekTerm = "select id from organisatie where id <> {$rijPartner['id']} and naam LIKE 'BW%' ";

       $BW = false;

     }

     else if (substr($naam,0,2)=='PZ') {

       $zoekTerm = "select id from organisatie where id <> {$rijPartner['id']} and naam LIKE 'PZ%' ";

       $PZ = false;

     }

     else if (substr($naam,0,3)=='KPZ') {

       $zoekTerm = "select id from organisatie where id <> {$rijPartner['id']} and naam LIKE 'KPZ%' ";

       $KPZ = false;

     }

     else if (substr($naam,0,3)=='PTZ') {

       $zoekTerm = "select id from organisatie where id <> {$rijPartner['id']} and naam LIKE 'PTZ%' ";

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

    $orgs = "{$rijPartner['id']} $orgs";



        // einde vestigingen en vijvers toevoegen

 einde oude vijvers */

 

        print("<tr><td class='rand'>{$rijPartner['naam']}</td><td class='rand'>");

        $qryVertegenW = "select naam, voornaam from hulpverleners, {$tabel}_betrokkenen

                         where overleggenre = 'gewoon' AND
                           {$tabel}_betrokkenen.genre = 'orgpersoon'
                           and persoon_id = hulpverleners.id



                and namens = {$rijPartner['id']}



                           and aanwezig = 1

                           and $voorwaarde";

        $resultVertegenW = mysql_query($qryVertegenW) or die($qryVertegenW . mysql_error());

        for ($k = 0; $k < mysql_num_rows($resultVertegenW); $k++) {

          $rijPersoon = mysql_fetch_assoc($resultVertegenW);

          print("{$rijPersoon['naam']} {$rijPersoon['voornaam']}<br/>");

        }

        print("</td></tr>");

     }

     $partners .= "<span style='margin-left: 50px;'>$naamListel</span><br/>";

     

     $qryGDTmensen = "select concat(hulpverleners.naam, concat(' ', hulpverleners.voornaam)) as hvl_naam

                      from overleg_tp_plan, hulpverleners, organisatie

            where (overleg_tp_plan.genre = \"hulp\")

            and persoon = hulpverleners.id

            and organisatie.id = organisatie

            and (organisatie.genre = 'ZVL' or organisatie.genre = 'HVL')

            and overleg = $overlegID

            order by hvl_naam";

  $resultGDTmensen = mysql_query($qryGDTmensen) or die($qryGDTmensen . "<br/>" . mysql_error());

  $gdtMens = "";

  for ($i = 0; $i < mysql_num_rows($resultGDTmensen); $i++) {

     $rijOud = mysql_fetch_assoc($resultGDTmensen);

     $oud["{$rijOud['naam']}"] = "{$rijOud['plan']}";

     $gdtMens .= "{$rijOud['hvl_naam']}<br/>";

  }



?>

             <tr>

                 <td class='rand'>

                  <?= $naamListel ?>

                 </td>

                 <td class='rand'>

                   <?="$gdtMens"?>

                 </td>

             </tr>



           </table>

         </td>

       </tr>

<tr>



<?php



if ($soortVergadering == "opvolgvergadering") {

  // vorige plan ophalen

  $vorigOverleg = voorgaandOverlegTP_datum($alleInfo['datum']);
if ($vorigOverleg == -1) {
  $vorigOverleg = array();
  $vorigOverleg['id']=0;
  $vorigOverleg['datum'] = "jjjjmmdd";
}

  $vorigeDatum = $vorigOverleg['datum'];

  $mooieVorigeDatum = substr($vorigeDatum, 6,2) . "/" . substr($vorigeDatum, 4,2) . "/" . substr($vorigeDatum, 0,4);



  print("<tr><td><br/><br/>Datum <u>vorige</u> overlegvergadering rond deze pati&euml;nt: $mooieVorigeDatum.<br/><br/></td></tr>");

  $qryOud = "select overleg_tp_plan.id as nr, organisatie.naam, plan from overleg_tp_plan, organisatie

            where overleg_tp_plan.genre = \"org\"

            and persoon = organisatie.id

            and overleg = " . $vorigOverleg['id'];

  $resultOud = mysql_query($qryOud) or print("wat is dat met $qryOud ?" . mysql_error());

  for ($i = 0; $i < mysql_num_rows($resultOud); $i++) {

     $rijOud = mysql_fetch_assoc($resultOud);

     $oud["{$rijOud['naam']}"] = "{$rijOud['plan']}";

  }



  $qryOud = "select overleg_tp_plan.id as nr,

                    concat(hulpverleners.naam, concat(' ', concat(hulpverleners.voornaam, concat('<br/> ', organisatie.naam) ))) as naam,

                    plan from overleg_tp_plan, hulpverleners, organisatie

            where (overleg_tp_plan.genre = \"orgpersoon\" or overleg_tp_plan.genre = \"hulp\")

            and persoon = hulpverleners.id

            and organisatie.id = organisatie

            and overleg = " . $vorigOverleg['id'];

  $resultOud = mysql_query($qryOud);

  for ($i = 0; $i < mysql_num_rows($resultOud); $i++) {

     $rijOud = mysql_fetch_assoc($resultOud);

     $oud["{$rijOud['naam']}"] = "{$rijOud['plan']}";

  }



  $qryOud = "select overleg_tp_plan.id as nr, concat(mantelzorgers.naam, concat(' ', mantelzorgers.voornaam)) as naam, plan from overleg_tp_plan, mantelzorgers

            where (overleg_tp_plan.genre = \"mantel\" )

            and persoon = mantelzorgers.id

            and overleg = " . $vorigOverleg['id'];

  $resultOud = mysql_query($qryOud);

  for ($i = 0; $i < mysql_num_rows($resultOud); $i++) {

     $rijOud = mysql_fetch_assoc($resultOud);

     $oud["{$rijOud['naam']}"] = "{$rijOud['plan']}";

  }

  //print_r($oud);

}

?>











<tr>

<td>

Specifieke rol en inbreng van partners ten opzichte van pati&euml;nt:

</td>

</tr>



<tr>

<td>

  <table width="100%">

   <tr>

    <th class='rand'>Naam partner</th>



<?php



if ($soortVergadering == "opvolgvergadering") {

  print("<th class='rand'>Rol en inbreng volgens plan tenlasteneming laatste overlegvergadering </th>\n");

  print("  <th class='rand'>Nieuwe afspraken m.b.t. rol en inbreng</th>\n");

}

else {

  print("  <th class='rand'>Specifieke rol en inbreng van deze partner</th>\n");

}





?>

   </tr>

<?php



$qryOrgs = "select overleg_tp_plan.id as nr, organisatie.naam, plan from overleg_tp_plan, organisatie

            where overleg_tp_plan.genre = \"org\"

            and persoon = organisatie.id

            and overleg = $overlegID";



toonPlannen2($qryOrgs, ($soortVergadering == "opvolgvergadering"));



$qryZorgHulp = "select overleg_tp_plan.id as nr, concat(hulpverleners.naam, concat(' ', concat(hulpverleners.voornaam, concat('<br/> ', organisatie.naam) ))) as naam,

                       plan from overleg_tp_plan, hulpverleners, organisatie

            where overleg_tp_plan.genre = \"hulp\"

            and persoon = hulpverleners.id

            and organisatie.id = organisatie

            and overleg = $overlegID";

toonPlannen2($qryZorgHulp, ($soortVergadering == "opvolgvergadering"));





$qryMantel = "select overleg_tp_plan.id as nr, concat(mantelzorgers.naam, concat(' ', mantelzorgers.voornaam)) as naam, plan from overleg_tp_plan, mantelzorgers

            where overleg_tp_plan.genre = \"mantel\"

            and persoon = mantelzorgers.id

            and overleg = $overlegID";



toonPlannen2($qryMantel, ($soortVergadering == "opvolgvergadering"));

?>

  </table>

</td>

</tr>



<tr>

<td>

Vraag naar betrokkenheid van nieuwe, externe partners:

</td>

</tr>



<tr>

<td>

  <table width="100%">

   <tr>

    <th>Naam externe partner</th>

    <th>Te verwachten rol en inbreng van deze externe partner</th>

   </tr>



<?php

$nieuwePartners = $alleInfo['tp_nieuwepartners'];

$nieuwePartners = str_replace("\\n","\n",$nieuwePartners);

?>



<tr><td colspan="2"><p style="font-size: 11px; font-family: 'Courier New' sans-serif; width:500px;height:90px;" name="tp_nieuwepartners"><?= nl2br($nieuwePartners) ?></p></td></tr>







<?php



?>

  </table>

</td>

</tr>



</table>

</div></div></body></html>

<?php

    //----------------------------------------------------------

    /* Sluit Dbconnectie */ include("../includes/dbclose.inc");

    //----------------------------------------------------------

    }



//---------------------------------------------------------

/* Geen Toegang */ include("../includes/check_access.inc");

//---------------------------------------------------------

?>





