<?php

session_start();

$paginanaam="Verklaring huisarts";

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

                p.id,

                p.mutnr,

                p.code,

                p.type,
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

    $datum=mysql_fetch_array(mysql_query("SELECT datum, soort_problematiek, verklaring_huisarts FROM  overleg WHERE id=$overlegID")) or die("kan den datum niet ophalen");
    if ($datum['soort_problematiek']=="fysisch" || $datum['soort_problematiek']=="")
      $soortProblematiek = "fysieke";
    else
      $soortProblematiek = "psychische";
    
    $mooieDatum = substr($datum[0],6,2)."/".substr($datum[0],4,2)."/".substr($datum[0],0,4);

    include("../includes/html_html.inc");

    print("<head>");

    include("../includes/html_head.inc");

    ?>

    <style type="text/css">

    .rand{border-bottom:1px solid black;border-right:1px solid black;}

    .randtable{border-top:1px solid black;border-left:1px solid black;}

    * {line-height: 150%;}

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

                                <h2>Verklaring Huisarts </h2>

                                <?php print(strtoupper($recordspat['naam'])." ".$recordspat['voornaam']);?><br />

                                <?php print($recordspat['code']);?>

                            </div>

                        </td>

                    </tr>

                </table>

                </div>

            </td>

        </tr>

        <tr><td>



    <table cellpadding="2" width="570" border="0">

    <tr><td> <p>&nbsp; <br />



    Ik, ondergetekende, <br />





    <?php



   //----------------------------------------------------------

    // Huisartsen weergeven

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

                bl.persoon_id,

                h.organisatie,

                h.riziv1,

                h.riziv2,

                h.riziv3,

                org.naam as partner_naam,

                org.id,

                h.adres as hvl_adres,

                g.dlnaam,

                g.dlzip,

                h.tel as hvl_tel,

                h.reknr,
                h.iban,
                h.bic,

                org.reknr as org_reknr,
                org2.reknr as org2_reknr,
                org.iban as org_iban,
                org2.iban as org2_iban,
                org.bic as org_bic,
                org2.bic as org2_bic,

                org.adres as partner_adres,

                org.gem_id as partner_gem_id,

                org.tel as partner_tel,

                org.tel as partner_gsm

            FROM

                {$tabel}_betrokkenen bl,

                functies f,

                gemeente g,

                hulpverleners h

                LEFT JOIN organisatie org ON ( org.id = h.organisatie )
                left join organisatie org2 on (org.hoofdzetel = org2.id)
                
            WHERE
                overleggenre = 'gewoon' AND
                h.fnct_id = f.id AND

                bl.persoon_id = h.id AND

                bl.genre = 'hulp' AND

                bl.aanwezig = 1 AND

                g.id=h.gem_id AND

                f.id = 1 AND

                $voorwaarde

            ORDER BY

                f.rangorde"; // Query



      if ($resultHVL=mysql_query($queryHVL))

         {

         if (mysql_num_rows ($resultHVL) > 1 ) {

           $li = "<li>";

           $ster = "(*)</li>\n";

           $sterLang = "<div style=\"width: 100%;text-align: right;\">(*) schrappen wat niet past</div>";

         }

         for ($i=0; $i < mysql_num_rows ($resultHVL); $i++)

            {

            $recordsHVL= mysql_fetch_array($resultHVL);

            $hvl_naam=      $recordsHVL['hvl_naam'];

            $hvl_voornaam=  $recordsHVL['voornaam'];

            $fnct_naam=     $recordsHVL['fnct_naam'];

            //$fnct_naam=     ($recordsHVL['betrokhvl_zb']==1)    ?$fnct_naam."<br />Zorgbemiddelaar" :$fnct_naam;

            $hvl_adres=     $recordsHVL['hvl_adres'];

            $hvl_dlzip=     $recordsHVL['dlzip'];

            $hvl_dlnaam=    $recordsHVL['dlnaam'];

            $hvl_tel=       $recordsHVL['hvl_tel'];

            if ($recordsHVL['iban']=="") {
              $recordsHVL['reknr']=$recordsHVL['org_reknr'];
              $recordsHVL['iban']=$recordsHVL['org_iban'];
              $recordsHVL['bic']=$recordsHVL['org_bic'];
            }
            if ($recordsZVL['iban']=="") {
              $recordsHVL['reknr']=$recordsHVL['org2_reknr'];
              $recordsHVL['iban']=$recordsHVL['org2_iban'];
              $recordsHVL['bic']=$recordsHVL['org2_bic'];
            }

            $hvl_reknr=     "IBAN {$recordsHVL['iban']}\nBIC {$recordsHVL['bic']}";

            $partner_adres= $recordsHVL['partner_adres'];

            $partner_tel=   $recordsHVL['partner_tel'];

            $partner_gsm=   $recordsHVL['partner_gsm'];

            //-------------------------------------------------------------------

            // indien een hvl werkt voor een partner toon deze dan

            $partner=       (($recordsHVL['organisatie']==999)OR($recordsHVL['organisatie']==1000))?"":"<br />".

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

            if ($hvl_dlzip == -1) $hvl_dlzip = 0;



            //-------------------------------------------------------------------

            //-------------------------------------------------------------------

            // heeft deze hvl geen telefoon/gsm, gebruik de partner dan

            $hvl_tel=(trim($hvl_tel)=="")?$partner_tel:trim($hvl_tel);

            $hvl_gsm=(trim($hvl_gsm)==0)?$partner_gsm:$recordsHVL['hvl_gsm'];

            //-------------------------------------------------------------------



   if ($rizivnr == "") $rizivnr = ".................................";



    echo <<< EINDE

    <br />$li

    $hvl_naam $hvl_voornaam, $hvl_adres te $hvl_dlzip $hvl_dlnaam

    - RIZIVnr  $rizivnr $ster

EINDE;

     }

      if ($datum['verklaring_huisarts']=="thuis") {
        $checkedThuis = " checked=\"checked\" ";
      }
      else if ($datum['verklaring_huisarts']=="opgenomen") {
        $checkedOpgenomen = " checked=\"checked\" ";
      }


    echo <<< EINDE

    $sterLang

    <br />

    verklaar hierbij dat de pati&euml;nt <strong>{$recordspat['naam']} {$recordspat['voornaam']}</strong> <br />

    op $mooieDatum, datum waarop het multidisciplinair teamoverleg plaatsvond, <br />

    <br />

    <input type="radio" $checkedThuis> thuis verblijft. Er wordt verondersteld dat hij/zij nog ten minste 1 maand thuis zal blijven met een vermindering van $soortProblematiek zelfredzaamheid.

    <br /><br />

    <input type="radio" $checkedOpgenomen> opgenomen is in een instelling waarbij een terugkeer naar de thuisomgeving is gepland binnen de 8 dagen. Er wordt verondersteld dat hij nog ten minste 1 maand thuis zal blijven met een vermindering van $soortProblematiek zelfredzaamheid.

    <br /> <br /><br />



    Datum &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Handtekening

    <br />

    $mooieDatum

    </td></tr>

EINDE;



   }

   else print("iets mis met  $queryHVL");

?>



    </table>



</table>

</div></div></body></html>

<?php

    }



//---------------------------------------------------------

/* Geen Toegang */ include("../includes/check_access.inc");

//---------------------------------------------------------

?>