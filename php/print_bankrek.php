<?php

session_start();

$paginanaam="Bankrekeningen";

if (IsSet($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan"))

    {



    //----------------------------------------------------------

    /* Maak Dbconnectie */ include('../includes/dbconnect2.inc');

    //----------------------------------------------------------



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

                p.code,

                p.mutnr ,

                p.type,

                deelvzw

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

    $overlegInfo=mysql_fetch_array(mysql_query("SELECT * FROM  overleg WHERE id=$overlegID"));

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

    <table width="570">

        <tr>

            <td>

                <div style="text-align:center">

                <table width="100%">

                    <tr>

                        <td><img src="../images/Sel<?= $recordspat['deelvzw'] ?>.jpg" height="100" /></td>

                        <td>

                            <div style="text-align:center">

                                <h2>Verklaring bankrekeningnummers op

                                        <?= substr($overlegInfo['datum'],6,2) . "/" . substr($overlegInfo['datum'],4,2) . "/" . substr($overlegInfo['datum'],0,4) ?>

                                </h2>

                                <?php print(strtoupper($recordspat['naam'])." ".$recordspat['voornaam']);?><br />

                                <?php print($recordspat['code']);?>

                                <?php
                                  // als dit een TP_patient is, ook TP-nummer vermelden
                                  if (is_tp_patient()) {
                                    $tpprojectje = tp_project_van_patient_op_datum($_SESSION['pat_code'],$overlegInfo['datum']);
                                    $tprecord = tp_record($tpprojectje['project']);
                                    print("(TP " . $tprecord['nummer'] . ")");
                                  }
                                ?>

                            </div>

                        </td>

                    </tr>

                </table>

                </div>

            </td>

        </tr>

<!--

        <tr>

            <td><br /><br />

                Ik,........................................ bevestig dat het opgegeven bankrekeningnummer 

                correct is en de vergoeding door de betrokken verzekeringsinstelling op dit nummer gestort 

                dient te worden.<br /><br />&nbsp;

            </td>

        </tr>

-->

        <tr><td>&nbsp;</td></tr>

        <tr><td>

<br/><br/><br/><br/>


    <table cellpadding="2" width="570" border="0" class="randtable">
<?php
if ($overlegInfo['genre'] != "TP") {
?>
        <tr>
            <th width="165" class="rand">Naam organisator </th>
            <th width="145" class="rand"></th>
            <th width="110" class="rand">Bankrekening&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br />nummer</th>
            <th width="150" class="rand">Handtekening</th>
        </tr>
<?php
$organisator = organisatorRecordVanOverleg($overlegInfo);
echo <<< ORGANISATOR
        <tr>
            <td width="165" class="rand">{$organisator['langenaam']}</td>
            <th width="145" class="rand">Organisator</th>
            <td width="110" class="rand">{$organisator['iban']}<br />BIC {$organisator['bic']}</td>
            <td width="150" class="rand">..........................</td>
        </tr>
ORGANISATOR;

}

?>
        <tr>

            <th width="165" class="rand">Naam zorgverlener + <br />Naam rekeninghouder</th>

            <th width="145" class="rand">Discipline</th>

            <th width="110" class="rand">Bankrekening&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br />nummer</th>

            <th width="150" class="rand">Handtekening</th>

        </tr>

    



    <?php



    //----------------------------------------------------------

    // ZorgverlenersLijst weergeven

    if ($tabel == "afgeronde") {

      $voorwaarde = "bl.overleg_id = $overlegID";

      $genreQry = "select genre from overleg where id = $overlegID";

      $genreRecord = mysql_fetch_assoc(mysql_query($genreQry));

      $isProject = ($genreRecord['genre']=="TP");

    }

    else {

      $voorwaarde = "bl.patient_code = '{$_SESSION['pat_code']}'";

      $isProject = is_tp_patient();

    }

    

    $queryHVL = "

         SELECT 

                h.id as hvl_id,

                h.naam as hvl_naam,

                h.voornaam as hvl_voornaam,

                f.naam as fnct_naam,

                bl.persoon_id,

                h.riziv1,

                h.riziv2,

                h.riziv3,

                bl.id as betrokhvl_id,

                o.naam as organisatie_naam,

                o.id as organisatie_id,

                h.adres as hvl_adres,

                g.dlnaam,

                g.dlzip,

                h.tel as hvl_tel,

                h.reknr,
                h.iban,
                h.bic,

                o.reknr as org_reknr,
                org2.reknr as org2_reknr,
                o.iban as org_iban,
                org2.iban as org2_iban,
                o.bic as org_bic,
                org2.bic as org2_bic,

                o.adres as organisatie_adres,

                o.gem_id as organisatie_gem_id,

                o.tel as organisatie_tel,

                o.gsm as organisatie_gsm,

                f.rangorde

            FROM 

                {$tabel}_betrokkenen bl,

                gemeente g,

                functies f,

                hulpverleners h

                LEFT JOIN organisatie o ON ( o.id = h.organisatie )
                left join organisatie org2 on (o.hoofdzetel = org2.id)
                
            WHERE
                overleggenre = 'gewoon' AND
                h.fnct_id = f.id AND

                bl.persoon_id = h.id AND

                bl.genre = 'hulp' AND

                $voorwaarde AND

                bl.aanwezig=1 AND

                g.id=h.gem_id AND

                o.genre = 'ZVL'

                

            ORDER BY 

                f.rangorde, bl.id"; // Query



      if ($resultHVL=mysql_query($queryHVL))

         {

         $rangorde = -1;

         $aantal = 0;

         if ($isProject) {

           $maxAantal = 100;

         }

         else {

           $maxAantal = 4;

         }

         for ($i=0; $i < mysql_num_rows ($resultHVL) && $aantal < $maxAantal; $i++)

            {

            $recordsHVL= mysql_fetch_array($resultHVL);

            $hvl_naam=      $recordsHVL['hvl_naam'];

            $hvl_voornaam=  $recordsHVL['hvl_voornaam'];

            $fnct_naam=     $recordsHVL['fnct_naam'];

            $hvl_adres=     $recordsHVL['hvl_adres'];

            $hvl_dlzip=     $recordsHVL['dlzip'];

            $hvl_dlnaam=    $recordsHVL['dlnaam'];

            $hvl_tel=       $recordsHVL['hvl_tel'];

            if ($recordsHVL['iban']=="") {
              $recordsHVL['reknr']=$recordsHVL['org_reknr'];
              $recordsHVL['iban']=$recordsHVL['org_iban'];
              $recordsHVL['bic']=$recordsHVL['org_bic'];
            }
            if ($recordsHVL['iban']=="") {
              $recordsHVL['reknr']=$recordsHVL['org2_reknr'];
              $recordsHVL['iban']=$recordsHVL['org2_iban'];
              $recordsHVL['bic']=$recordsHVL['org2_bic'];
            }

            $hvl_reknr=     "<br/>\n{$recordsHVL['iban']}<br/>\nBIC: {$recordsHVL['bic']}";
            


            $partner_adres= $recordsHVL['organisatie_adres'];

            $partner_tel=   $recordsHVL['organisatie_tel'];

            $partner_gsm=   $recordsHVL['organisatie_gsm'];

            //-------------------------------------------------------------------

            // indien een hvl werkt voor een partner toon deze dan

            $partner=       (($recordsHVL['organisatie_id']==999)OR($recordsHVL['organisatie_id']==1000))?"":"<br />".

                                    $recordsHVL['organisatie_naam'];

            if (isset($recordsHVL['organisatie_gem_id']) && $recordsHVL['organisatie_gem_id'] != 9999) {

                $qry8="SELECT dlzip, dlnaam FROM gemeente WHERE id=".$recordsHVL['organisatie_gem_id'];

                $gemeente=mysql_fetch_array(mysql_query($qry8));

                $partner_dlzip=$gemeente['dlzip'];

                $partner_dlnaam=$gemeente['dlnaam'];

            }

            $fnct_naam=$fnct_naam.$partner;

            //-------------------------------------------------------------------



            //-------------------------------------------------------------------

            // heeft deze hvl een rizivnr zo ja corrigeer het met voorloopnullen

            if ($recordsHVL['riziv1']==0)

                {$rizivnr=".................................";}

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

              }

            if ($hvl_dlzip == "" | $hvl_dlzip == 9999) {

                $hvl_dlzip=$partner_dlzip;

                $hvl_dlnaam=$partner_dlnaam;

                }

            //-------------------------------------------------------------------

            //-------------------------------------------------------------------

            // heeft deze hvl geen telefoon/gsm, gebruik de partner dan

            $hvl_tel=(trim($hvl_tel)=="")?$partner_tel:trim($hvl_tel);

            $hvl_gsm=(trim($hvl_gsm)==0)?$partner_gsm:$recordsHVL['hvl_gsm'];

            //-------------------------------------------------------------------

            

            if ($rangorde != $recordsHVL['rangorde']) {

               $rangorde = $recordsHVL['rangorde'];

               $aantal++;

               print ("<tr>

                        <td valign=\"center\" class=\"rand\"><br />".

                        $hvl_naam." ".$hvl_voornaam."<br />&nbsp;".

                        "</td>

                        <td valign=\"center\" class=\"rand\">".$fnct_naam."</td> ");

               print("<td class=\"rand\" valign=\"center\">$hvl_reknr</td>");

               print("<td valign=\"bottom\" class=\"rand\">..........................</td></tr>");

            }

        }}



?>



        <tr>

            <th width="165" class="rand">Naam Organisatie </th>

            <th width="145" class="rand">Vertegenwoordiger(s)</th>

            <th width="110" class="rand">Bankrekening&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br />nummer</th>

            <th width="150" class="rand">Handtekening (van &eacute;&eacute;n van de vertegenwoordigers)</th>

        </tr>



<?php



    if ($isProject) {

      $queryOrgs = "

         SELECT

              organisatie.naam, hulpverleners.naam as hvl_naam, hulpverleners.voornaam as hvl_voornaam,
              hulpverleners.reknr as hvl_reknr, hulpverleners.iban as hvl_iban, hulpverleners.bic as hvl_bic,
              organisatie.reknr, organisatie.iban, organisatie.bic,
              org2.reknr as org2_reknr, org2.iban as org2_iban, org2.bic as org2_bic

         FROM {$tabel}_betrokkenen bl,

                hulpverleners

                LEFT JOIN organisatie ON ( organisatie.id = hulpverleners.organisatie )
                LEFT JOIN organisatie org2 ON ( organisatie.hoofdzetel = org2.id )

            WHERE

                bl.persoon_id = hulpverleners.id AND

                (

                  (bl.genre = 'hulp' AND  ((organisatie.genre = 'HVL')  OR (organisatie.genre = 'XVLP')))

                    OR

                  (bl.genre = 'orgpersoon')

                ) AND

                $voorwaarde AND

                bl.aanwezig=1

            ORDER BY

                organisatie.naam, bl.id"; // Query

    }

    else {

      $queryOrgs = "

         SELECT

              organisatie.naam, hulpverleners.naam as hvl_naam, hulpverleners.voornaam as hvl_voornaam,
              hulpverleners.reknr as hvl_reknr, hulpverleners.iban as hvl_iban, hulpverleners.bic as hvl_bic,
              organisatie.reknr, organisatie.iban, organisatie.bic,
              org2.reknr as org2_reknr, org2.iban as org2_iban, org2.bic as org2_bic

         FROM {$tabel}_betrokkenen bl,

                hulpverleners

                LEFT JOIN organisatie ON ( organisatie.id = hulpverleners.organisatie )
                LEFT JOIN organisatie org2 ON ( organisatie.hoofdzetel = org2.id )


            WHERE

                bl.persoon_id = hulpverleners.id AND

                (bl.genre = 'hulp') AND

                (organisatie.genre in ('HVL')) AND

                $voorwaarde AND

                bl.aanwezig=1

            ORDER BY

                organisatie.naam, bl.id"; // Query

    }



      if ($resultOrgs=mysql_query($queryOrgs)) {

         $orgNaam = "";

         $vorigeTR ="";

         for ($i=0; $i < mysql_num_rows ($resultOrgs); $i++) {

            $orgRij = mysql_fetch_array($resultOrgs);

            //-------------------------------------------------------------------

            // indien een hvl werkt voor een partner toon deze dan



            if ($orgNaam != $orgRij['naam']) {

               $orgNaam = $orgRij['naam'];

               print("$vorigeTR\n<tr><td valign=\"center\" class=\"rand\"><br/>{$orgRij['naam']}</td><td valign=\"center\" class=\"rand\">");

            }

            print ("<br />{$orgRij['hvl_naam']} {$orgRij['hvl_voornaam']}");



            if ($orgRij['hvl_iban']!="") {
              $reknr = "\n{$orgRij['hvl_iban']}\nBIC: {$orgRij['hvl_bic']}";
            }
            else if ($orgRij['iban']!="") {
              $reknr = "\n{$orgRij['iban']}\nBIC: {$orgRij['bic']}";
            }
            else if ($orgRij['org2_iban']!="") {
              $reknr = "\n{$orgRij['org2_iban']}\nBIC: {$orgRij['org2_bic']}";
            }
            else {
              $reknr = "";
            }


            $vorigeTR = "</td><td class=\"rand\">$reknr</td><td valign=\"bottom\" class=\"rand\">..........................</td></tr>";

          }

          print("$vorigeTR");

       }

       else {

         print("dieje $queryOrgs lukt niet : <br/>" . mysql_error());

       }

       



    //----------------------------------------------------------?>







    <tr>

        <td class="rand">&nbsp;<br />.................................<br />&nbsp;</td>

        <td class="rand">&nbsp;<br />.................................<br />&nbsp;</td>

        <td class="rand">&nbsp;<br />.................................<br />&nbsp;</td>

        <td class="rand">&nbsp;<br />..........................<br />&nbsp;</td>

    </tr>

    <tr>

        <td class="rand">&nbsp;<br />.................................<br />&nbsp;</td>

        <td class="rand">&nbsp;<br />.................................<br />&nbsp;</td>

        <td class="rand">&nbsp;<br />.................................<br />&nbsp;</td>

        <td class="rand">&nbsp;<br />..........................<br />&nbsp;</td>

    </tr>

    </table>

    </td></tr>



<?php

  if (isset($overlegID)) {

     $overlegInfo = mysql_fetch_array(mysql_query("select * from overleg where id = $overlegID"));

     switch ($overlegInfo['locatie']) {

       case 0: // thuis

         $locatie = "Het overleg vond plaats <strong>ten  huize van de patient</strong>. ";

         break;

       case 1: // elders

         $locatie = "Het overleg vond <strong>elders</strong> plaats (dus niet ten  huize van de patient). ";

         break;

       case 2: // deskundig ziekenhuiscentrum

         $locatie = "Het overleg vond plaats <strong>in een deskundig ziekenhuiscentrum</strong>. ";

         break;

       default:

         $locatie = "Het overleg vond plaats: <strong>....................................................</strong>. ";

     }

  }

?>

<!--    <tr><td colspan="4"><input type="checkbox" checked="checked"/><?= $locatie ?></td></tr>



    <tr>

        <td><br /><br />

            Handtekening en naam van overlegco&ouml;rdinator TGZ, projectco&ouml;rdinator of zorgbemiddelaar<br /><br />

            ...................................................................<br /><br />

            <?php print(substr($overlegInfo['datum'],6,2)."/".substr($overlegInfo['datum'],4,2)."/".substr($overlegInfo['datum'],0,4));?>

        </td>

    </tr>

-->



<tr>

<td style="text-align:justify">

<br/><br/>

Een duplicaat van deze verklaring wordt administratief bewaard volgens de wet dd. 08/12/92

op de bescherming van de persoonlijke levenssfeer t.o.v. de verwerking van persoonsgegevens zoals gewijzigd.

U hebt inzage in de gegevens die betrekking hebben op uw persoon, en kan ze steeds laten verbeteren.

De door u verstrekte gegevens zullen door LISTEL vzw met zetel te 3500 Hasselt, Rodenbachstraat 29/1, worden verwerkt.

Zij zullen uitsluitend worden gebruikt voor facturatie van multidisciplinair vergoedbaar overleg.

</td>





</tr>



</table>

</div></div></body></html>

<?php

    }



//---------------------------------------------------------

/* Geen Toegang */ include("../includes/check_access.inc");

//---------------------------------------------------------

?>