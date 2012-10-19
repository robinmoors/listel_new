<?php

session_start();



/*********************************************

           rizivtarieven

           thuis        elders                registratie

gewoon     773172       773216                773290

PVS        776532       776554                776576



           niet-        wel-

           ziekenhuis   ziekenhuis            niet-ZH   wel-ZH

TP         427350       427361                427372     427383



**********************************************/



$paginanaam="Factuur afdrukken";

if (IsSet($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan"))

    {



    //----------------------------------------------------------

    /* Maak Dbconnectie */ include('../includes/dbconnect2.inc');

    //----------------------------------------------------------



    $overlegID = $_GET['id'];

    $overlegInfo=mysql_fetch_array(mysql_query("SELECT * FROM  overleg WHERE id=$overlegID"));

    $mooieDatum = substr($overlegInfo['datum'],6,2)."/".substr($overlegInfo['datum'],4,2)."/".substr($overlegInfo['datum'],0,4);



    $rizivListel = "9-47011-97-001";



    $querypat = "

         SELECT 

                p.*,

                g.dlzip,

                g.dlnaam

            FROM 

                patient p,

                gemeente g

            WHERE 

                p.code='".$overlegInfo['patient_code']."' AND

                p.gem_id=g.id"; // Query

      if ($resultpat=mysql_query($querypat))

        {

            $recordspat= mysql_fetch_array($resultpat);

            if ($recordspat['type']==1) {

               $factuurType = "PVS";

              $rizivThuis = 776532;

              $rizivElders = 776554;

              $rizivRegistratie = 776576;

            }

            else if ($overlegInfo['genre']=="TP") {

               $factuurType = "TP";

               // onderste dingen nog nakijken!!

              $rizivThuis = 427350;

              $rizivElders = 427361;

              $rizivRegistratie = 427372;  // of 427383

            }

            else {

              $rizivThuis = 773172;

              $rizivElders = 773216;

              $rizivRegistratie = 773290;

            }

            $querymut = "

         SELECT

                v.*,

                g.dlzip,

                g.dlnaam

            FROM

                verzekering v

                LEFT JOIN gemeente g ON (v.gem_id=g.id)

            WHERE

                v.id = {$recordspat['mut_id']}"; // Query

            $recordsmut = mysql_fetch_array(mysql_query($querymut));



            if (!isset($overlegInfo['factuur_code']))  {

               $jaar = substr($overlegInfo['datum'],0,4);

               if ($jaar < 2007) $jaar = "FAKE";

               else $jaar = date("Y");

               $factuurQry = mysql_query("select nr from factuur where jaar = '$jaar'");

               if (mysql_num_rows($factuurQry) == 0) {

                  $factuur_code = "$jaar/001";

                  mysql_query("insert into factuur values ('$jaar',1)");

               }

               else {

                 $factuurrecord = mysql_fetch_array($factuurQry);

                 $factuurNr = $factuurrecord[0]+1;

                 if ($factuurNr < 10) $factuurNr = "00$factuurNr";

                 else if ($factuurNr < 100) $factuurNr = "0$factuurNr";

                 $factuur_code = "$jaar/$factuurNr";

                 mysql_query("update factuur set nr = $factuurNr where jaar = '$jaar'");

               }

               $factuur_datum = date("d/m/Y");

               if (!mysql_query("update overleg set

                             factuur_code = '$factuur_code',

                             factuur_datum = '$factuur_datum'

                             where id = $overlegID")) {

                  print(mysql_error());

               }

            }

            else {

              $factuur_code = $overlegInfo['factuur_code'];

              $factuur_datum = $overlegInfo['factuur_datum'];

            }

        }

        

        

    //----------------------------------------------------------

    // Zorgverleners ophalen

    if (($overlegInfo['locatie']==0) || ($overlegInfo['locatie']==2)) { // thuis of ziekenhuis

      $tussenstuk = "</td><td>1</td><td>0</td><td>";

    }

    else {

      $tussenstuk = "</td><td>0</td><td>1</td><td>";

    }



    $queryZVL = "

         SELECT

                h.riziv1,

                h.riziv2,

                h.riziv3,

                h.reknr,

                f.rangorde

            FROM

                afgeronde_betrokkenen bl,

                hulpverleners h,

                functies f,

                organisatie org

            WHERE

                h.fnct_id = f.id AND

                bl.persoon_id = h.id AND

                bl.genre = 'hulp' AND

                bl.overleg_id = $overlegID AND

                bl.aanwezig=1 AND

                h.organisatie = org.id AND

                org.genre = 'ZVL'

            ORDER BY

                f.rangorde, bl.id"; // Query



      if ($resultZVL=mysql_query($queryZVL))

         {

         $rangorde = -1;

         $aantal = 0;

         $rizivTotaal = "";

         $tabelInhoud = "";

         for ($i=0; $i < mysql_num_rows ($resultZVL) && $aantal < 4; $i++)

            {

            $recordsZVL= mysql_fetch_array($resultZVL);

            $hvl_reknr=     $recordsZVL['reknr'];

            //-------------------------------------------------------------------

            // heeft deze hvl een rizivnr zo ja corrigeer het met voorloopnullen

            if ($recordsZVL['riziv1']==0)

                {$rizivnr="ONBEKEND!!";}

            else

                {

                $rizivnr1=substr($recordsZVL['riziv1'],0,1)."-".substr($recordsZVL['riziv1'],1,5)."-";

                $rizivnr2=      ($recordsZVL['riziv2']<10)      ?"0".$recordsZVL['riziv2']:$recordsZVL['riziv2'];

                $rizivnr3=      ($recordsZVL['riziv3']<100)     ?"0".$recordsZVL['riziv3']:$recordsZVL['riziv3'];

                $rizivnr3=      ($recordsZVL['riziv3']<10)      ?"0".$rizivnr3:$rizivnr3;

                $rizivnr=$rizivnr1.$rizivnr2."-".$rizivnr3;

                }



            if ($rangorde != $recordsZVL['rangorde']) {

               $rangorde = $recordsZVL['rangorde'];

               $aantal++;

               $rizivTotaal = $rizivTotaal . "{$rizivnr}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ";

               if ($aantal==2) $rizivTotaal = $rizivTotaal . "<br />";

               $tabelInhoud = $tabelInhoud . "\n<tr><td>$rizivnr $tussenstuk 0</td><td>$hvl_reknr </td></tr>";

            }

        }

     }

     if ($aantal==4) $rizivTotaal = $rizivTotaal . "<br />";

     $rizivTotaal = $rizivTotaal . "$rizivListel&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ";

     if (($aantal < 4) &&

         (mysql_num_rows(mysql_query("select bl.id from afgeronde_betrokkenen bl, functies f, hulpverleners h, organisatie org

                                      where bl.persoon_id = h.id and h.fnct_id = f.id and h.organisatie = org.id and org.genre = 'HVL' and bl.aanwezig=1

                                            and bl.genre = 'hulp' and bl.overleg_id = $overlegID")) > 0)) {

       // LISTEL toevoegen als ZVL

       $tabelInhoud = $tabelInhoud . "\n<tr><td>$rizivListel $tussenstuk 1</td><td>735-0109580-55</td></tr>";

     }

     else {

       $tabelInhoud = $tabelInhoud . "\n<tr><td>$rizivListel </td><td>0</td><td>0</td><td>1</td><td>735-0109580-55</td></tr>";

     }

    //----------------------------------------------------------







    include("../includes/html_html.inc");

    print("<head>");

    include("../includes/html_head.inc");

    ?>

    <style type="text/css">

    .rand{border-bottom:1px solid black;border-right:1px solid black;}

    .randtable{border-top:1px solid black;border-left:1px solid black;}

    .randje {border:1px solid black;}

    th {text-align:center;}

    table { border-collapse: collapse;}

    #centreer td { text-align: center;}

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

                        <td><img src="../images/logo_top_pagina_klein.gif" width="100"></td>

                        <td>

                            <div style="text-align:center">

                                <h2>Ge&iuml;ntegreerde diensten voor thuisverzorging<br />FACTUUR <?= $factuurType ?></h2>

                            </div>

                        </td>

                    </tr>

                </table>

                </div>

            </td>

        </tr>

        <tr>

            <td>

                <table width="100%">

                    <tr>

                        <td width="65%" valign="top">

                          GDT "POP LISTEL vzw" <br />

                          A. Rodenbachstraat 29 bus 1<br />

                          B-3500  HASSELT<br />

                          011/81.94.70 <br />

                          <?= $rizivListel ?>

                        </td>

                        <td width="35%" valign="top">

<?php

echo <<< EINDE

                          {$recordsmut['naam']} <br />

                          {$recordsmut['dienst']} <br />

                          {$recordsmut['adres']} <br />

                          {$recordsmut['dlzip']} {$recordsmut['dlnaam']} <br />

EINDE;

?>

                        </td>

                    </tr>

                </table>

            </td>

        </tr>

        <tr>

          <td>

              <table width="30%">

                <tr> <td style="height: 20px" colspan="2">&nbsp;</td></tr>

               <tr><td>Factuurnummer: </td><td><?= $factuur_code ?></td></tr>

               <tr><td>Factuurdatum: </td><td><?= $factuur_datum ?></td></tr>

               <tr><td>Ons kenmerk: </td><td><?= $recordspat['code'] ?></td></tr>

              </table>

          </td>

        <tr>

            <td><br /><br />

            </td>

        </tr>



        <tr><td>

    <!-- samenvattende tabel  -->

    <table cellpadding="2" width="570" border="0" class="randjetable">

        <tr>

            <th width="110" class="randje">Identificatie <br />van de pati&euml;nt</th>

            <th width="90" class="randje">Datum van<br/> het overleg</th>

            <th width="370" class="randje">Deelnemende zorgverleners (RIZIV-nummers)</th>

        </tr>

        <tr>

            <td width="110" class="randje"><?= $recordspat['mutnr'] ?></td>

            <td width="90" class="randje"><?= $mooieDatum ?></td>

            <td width="370" class="randje"><?= $rizivTotaal ?></td>

        </tr>

    </table>

    </td></tr>

        <tr>

            <td><br />

            </td>

        </tr>



        <tr><td>

      <!-- tabel met pseudcodes -->

    <table cellpadding="2" width="570" border="0" class="randje" id="centreer">

        <tr>

            <th width="120" class="randje">Identificatie van<br />de zorgverlener<br/>(RIZIV-nummer)</th>

            <th width="120" class="randje">Aantal <br/>pseudocode<br/><?= $rizivThuis ?></th>

            <th width="120" class="randje">Aantal <br/>pseudocode<br/><?= $rizivElders ?></th>

            <th width="120" class="randje">Aantal <br/>pseudocode<br/><?= $rizivRegistratie ?></th>

            <th width="370" class="randje">Rekening<br/>nummer</th>

        </tr>

<?= $tabelInhoud ?>

    </table>

    </td></tr>



    <tr>

        <td><br /><br />

            De verschuldigde bedragen storten met de vermelding: <br/>

            <strong>Teamoverleg <?php print("{$recordspat['naam']} {$recordspat['voornaam']} - $mooieDatum"); ?></strong>

            <br/><br/>

            Ik bevestig over documenten te beschikken die aantonen dat de verstrekkingen werden

            uitgevoerd door de zorgverlener wiens RIZIV-nummer ertegenover staat.<br/><br/>



            Datum, naam en hoedanigheid van de ondertekenaar: <br/><br/><br/>

            <!--

            <?php print($_SESSION['voornaam']." ".$_SESSION['naam']); ?><br/>

            P.O.P.-co&ouml;rdinator "POP LISTEL vzw"

            -->

            Anick Noben – administratie LISTEL vzw

            <br/><br/><br/><br/><br/>

            Handtekening

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