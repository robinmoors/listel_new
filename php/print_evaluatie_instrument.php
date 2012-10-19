<?php

session_start();



//------------------------------------------------------------------------------

function markselected($fieldval,$fieldname,$value)

    {

    //if ($fieldval == $value) print("yeah");

    $selected=($fieldval==$value)?"checked=\"checked\"":"";

    print("<td valign=\"top\" align=\"center\"><input onclick=\"return false;\" type=\"radio\" name=\"".$fieldname."\"

    value=\"".$value."\" ".$selected." /></td>\n");

    }

function check4empty($PostValue)

    {$qrystring=(!isset($_POST[$PostValue]))?"0":$_POST[$PostValue];

    return $qrystring;}

//------------------------------------------------------------------------------

//------------------------------------------------------------

/* Maak Dbconnectie */ include('../includes/dbconnect2.inc');

//------------------------------------------------------------







    $evalinstrID = $_POST['id'];









   // als er nog geen evalinstr in de database zit, maken we een lege



   $paginanaam="Evaluatieinstrument";





    if (isset($_SESSION["toegang"]) && ($_SESSION["toegang"]=="toegestaan"))

      {

      include("../includes/html_html.inc");

      print("<head>");

      include("../includes/html_head.inc");

?>



<style type="text-css">

fieldset {

  min-height: auto;

  overflow:visible;

}

</style>



<?php

      print("</head>");





        if ($_GET['actie']=="print" || $_POST['actie']=="print") {

           print("<body onload=\"parent.print();\">");

        }

        else{print("<body>");}

        if ($_GET['actie'] != "print" && $_POST['actie']!="print") {

          print("<div align=\"center\">");

          print("<div class=\"pagina\">");

          include("../includes/header.inc");

          include("../includes/kruimelpad.inc");

          print("<div class=\"contents\">");

          include("../includes/menu.inc");

          print("<div class=\"main\">");

          print("<div class=\"mainblock\">");

        }



        $dd = substr($_POST['datum'],6,2);

        $mm = substr($_POST['datum'],4,2);

        $jj = substr($_POST['datum'],0,4);


       $patientInfo=mysql_fetch_array(mysql_query("SELECT deelvzw FROM  patient inner join gemeente on gemeente.id = gem_id WHERE code='{$_SESSION['pat_code']}'"));


echo <<< EINDE

                <div style="text-align:center">

                <table width="100%">

                    <tr>

                        <td valign="top"><img src="../images/Sel{$patientInfo['deelvzw']}.jpg" height="100" /></td>

                        <td valign="top">

                            <div style="text-align:center">

                                   <h1>{$_SESSION['pat_naam']} {$_SESSION['pat_voornaam']} ({$_SESSION['pat_code']})</h1>

                                   <h2>Het evaluatie-instrument bij het overleg van $dd/$mm/$jj</h2>

                            </div>

                        </td>

                    </tr>

                </table>

                </div>

EINDE;





            //---------------------------

            $qry="

                SELECT *

                FROM

                    evalinstr

                WHERE

                    ei_id=$evalinstrID";

            $result=mysql_query($qry);

            $records=mysql_fetch_array($result); // Get record

            //---------------------------

            //-------------------------------------------------

            $Var_ei_01_01_s=$records['ei_01_01_s'];

            $Var_ei_01_01_t=$records['ei_01_01_t'];

            $Var_ei_01_02_s=$records['ei_01_02_s'];

            $Var_ei_01_02_t=$records['ei_01_02_t'];

            $Var_ei_01_03_s=$records['ei_01_03_s'];

            $Var_ei_01_03_t=$records['ei_01_03_t'];

            $Var_ei_01_04_s=$records['ei_01_04_s'];

            $Var_ei_01_04_t=$records['ei_01_04_t'];

            $Var_ei_01_05_s=$records['ei_01_05_s'];

            $Var_ei_01_05_t=$records['ei_01_05_t'];

            $Var_ei_01_06_s=$records['ei_01_06_s'];

            $Var_ei_01_06_t=$records['ei_01_06_t'];

            $Var_ei_01_07_s=$records['ei_01_07_s'];

            $Var_ei_01_07_t=$records['ei_01_07_t']; // Update values according to dbase

            $Var_ei_02_01_s=$records['ei_02_01_s'];

            $Var_ei_02_01_t=$records['ei_02_01_t'];

            $Var_ei_02_02_s=$records['ei_02_02_s'];

            $Var_ei_02_02_t=$records['ei_02_02_t'];

            $Var_ei_02_03_s=$records['ei_02_03_s'];

            $Var_ei_02_03_t=$records['ei_02_03_t'];

            $Var_ei_02_04_s=$records['ei_02_04_s'];

            $Var_ei_02_04_t=$records['ei_02_04_t'];

            $Var_ei_02_05_s=$records['ei_02_05_s'];

            $Var_ei_02_05_t=$records['ei_02_05_t'];

            $Var_ei_02_06_s=$records['ei_02_06_s'];

            $Var_ei_02_06_t=$records['ei_02_06_t'];

            $Var_ei_02_07_s=$records['ei_02_07_s'];

            $Var_ei_02_07_t=$records['ei_02_07_t'];

            $Var_ei_02_08_s=$records['ei_02_08_s'];

            $Var_ei_02_08_t=$records['ei_02_08_t'];

            $Var_ei_02_09_s=$records['ei_02_09_s'];

            $Var_ei_02_09_t=$records['ei_02_09_t']; // Update values according to dbase

            //-------------------------------------------------

            $Var_ei_031_01_s=$records['ei_031_01_s'];

            $Var_ei_031_01_t=$records['ei_031_01_t'];

            $Var_ei_031_02_s=$records['ei_031_02_s'];

            $Var_ei_031_02_t=$records['ei_031_02_t'];

            $Var_ei_031_03_s=$records['ei_031_03_s'];

            $Var_ei_031_03_t=$records['ei_031_03_t'];

            $Var_ei_031_04_s=$records['ei_031_04_s'];

            $Var_ei_031_04_t=$records['ei_031_04_t'];

            $Var_ei_031_05_s=$records['ei_031_05_s'];

            $Var_ei_031_05_t=$records['ei_031_05_t'];

            $Var_ei_031_06_s=$records['ei_031_06_s'];

            $Var_ei_031_06_t=$records['ei_031_06_t'];

            $Var_ei_031_07_s=$records['ei_031_07_s'];

            $Var_ei_031_07_t=$records['ei_031_07_t'];

            $Var_ei_031_08_s=$records['ei_031_08_s'];

            $Var_ei_031_08_t=$records['ei_031_08_t']; // Update values according to dbase

            $Var_ei_032_01_s=$records['ei_032_01_s'];

            $Var_ei_032_01_t=$records['ei_032_01_t'];

            $Var_ei_032_02_s=$records['ei_032_02_s'];

            $Var_ei_032_02_t=$records['ei_032_02_t'];

            $Var_ei_032_03_s=$records['ei_032_03_s'];

            $Var_ei_032_03_t=$records['ei_032_03_t'];

            $Var_ei_032_04_s=$records['ei_032_04_s'];

            $Var_ei_032_04_t=$records['ei_032_04_t'];

            $Var_ei_032_05_s=$records['ei_032_05_s'];

            $Var_ei_032_05_t=$records['ei_032_05_t'];

            $Var_ei_032_06_s=$records['ei_032_06_s'];

            $Var_ei_032_06_t=$records['ei_032_06_t'];

            $Var_ei_032_07_s=$records['ei_032_07_s'];

            $Var_ei_032_07_t=$records['ei_032_07_t'];

            $Var_ei_032_08_s=$records['ei_032_08_s'];

            $Var_ei_032_08_t=$records['ei_032_08_t'];

            $Var_ei_032_09_s=$records['ei_032_09_s'];

            $Var_ei_032_09_t=$records['ei_032_09_t'];

            $Var_ei_032_10_s=$records['ei_032_10_s'];

            $Var_ei_032_10_t=$records['ei_032_10_t'];

            $Var_ei_032_11_s=$records['ei_032_11_s'];

            $Var_ei_032_11_t=$records['ei_032_11_t'];

            $Var_ei_032_12_s=$records['ei_032_12_s'];

            $Var_ei_032_12_t=$records['ei_032_12_t'];

            $Var_ei_032_13_s=$records['ei_032_13_s'];

            $Var_ei_032_13_t=$records['ei_032_13_t'];

            $Var_ei_032_14_s=$records['ei_032_14_s'];

            $Var_ei_032_14_t=$records['ei_032_14_t']; // Update values according to dbase

            $Var_ei_033_01_s=$records['ei_033_01_s'];

            $Var_ei_033_01_t=$records['ei_033_01_t'];

            $Var_ei_033_02_s=$records['ei_033_02_s'];

            $Var_ei_033_02_t=$records['ei_033_02_t'];

            $Var_ei_033_03_s=$records['ei_033_03_s'];

            $Var_ei_033_03_t=$records['ei_033_03_t'];

            $Var_ei_033_04_s=$records['ei_033_04_s'];

            $Var_ei_033_04_t=$records['ei_033_04_t'];

            $Var_ei_033_05_s=$records['ei_033_05_s'];

            $Var_ei_033_05_t=$records['ei_033_05_t'];

            $Var_ei_033_06_s=$records['ei_033_06_s'];

            $Var_ei_033_06_t=$records['ei_033_06_t'];

            $Var_ei_033_07_s=$records['ei_033_07_s'];

            $Var_ei_033_07_t=$records['ei_033_07_t'];

            $Var_ei_033_08_s=$records['ei_033_08_s'];

            $Var_ei_033_08_t=$records['ei_033_08_t']; // Update values according to dbase

            $Var_ei_04_01_s=$records['ei_04_01_s'];

            $Var_ei_04_01_t=$records['ei_04_01_t'];

            $Var_ei_04_02_s=$records['ei_04_02_s'];

            $Var_ei_04_02_t=$records['ei_04_02_t'];

            $Var_ei_04_03_s=$records['ei_04_03_s'];

            $Var_ei_04_03_t=$records['ei_04_03_t'];

            $Var_ei_04_04_s=$records['ei_04_04_s'];

            $Var_ei_04_04_t=$records['ei_04_04_t'];

            $Var_ei_04_05_s=$records['ei_04_05_s'];

            $Var_ei_04_05_t=$records['ei_04_05_t'];

            $Var_ei_04_06_s=$records['ei_04_06_s'];

            $Var_ei_04_06_t=$records['ei_04_06_t'];

            $Var_ei_04_07_s=$records['ei_04_07_s'];

            $Var_ei_04_07_t=$records['ei_04_07_t'];

            $Var_ei_04_08_s=$records['ei_04_08_s'];

            $Var_ei_04_08_t=$records['ei_04_08_t'];

            $Var_ei_04_09_s=$records['ei_04_09_s'];

            $Var_ei_04_09_t=$records['ei_04_09_t'];

            $Var_ei_04_10_s=$records['ei_04_10_s'];

            $Var_ei_04_10_t=$records['ei_04_10_t'];

            $Var_ei_04_11_s=$records['ei_04_11_s'];

            $Var_ei_04_11_t=$records['ei_04_11_t'];

            $Var_ei_04_12_s=$records['ei_04_12_s'];

            $Var_ei_04_12_t=$records['ei_04_12_t'];

            $Var_ei_04_13_s=$records['ei_04_13_s'];

            $Var_ei_04_13_t=$records['ei_04_13_t'];

            $Var_ei_04_14_s=$records['ei_04_14_s'];

            $Var_ei_04_14_t=$records['ei_04_14_t']; // Update values according to dbase

            $Var_ei_05_01_s=$records['ei_05_01_s'];

            $Var_ei_05_01_t=$records['ei_05_01_t'];

            $Var_ei_05_02_s=$records['ei_05_02_s'];

            $Var_ei_05_02_t=$records['ei_05_02_t'];

            $Var_ei_05_03_s=$records['ei_05_03_s'];

            $Var_ei_05_03_t=$records['ei_05_03_t'];

            $Var_ei_05_04_s=$records['ei_05_04_s'];

            $Var_ei_05_04_t=$records['ei_05_04_t'];

            $Var_ei_05_05_s=$records['ei_05_05_s'];

            $Var_ei_05_05_t=$records['ei_05_05_t'];

            $Var_ei_05_06_s=$records['ei_05_06_s'];

            $Var_ei_05_06_t=$records['ei_05_06_t'];

            $Var_ei_05_07_s=$records['ei_05_07_s'];

            $Var_ei_05_07_t=$records['ei_05_07_t'];

            $Var_ei_05_08_s=$records['ei_05_08_s'];

            $Var_ei_05_08_t=$records['ei_05_08_t'];

            $Var_ei_05_09_s=$records['ei_05_09_s'];

            $Var_ei_05_09_t=$records['ei_05_09_t'];

            $Var_ei_05_10_s=$records['ei_05_10_s'];

            $Var_ei_05_10_t=$records['ei_05_10_t'];

            $Var_ei_05_11_s=$records['ei_05_11_s'];

            $Var_ei_05_11_t=$records['ei_05_11_t'];

            $Var_ei_05_12_s=$records['ei_05_12_s'];

            $Var_ei_05_12_t=$records['ei_05_12_t'];

            $Var_ei_05_13_s=$records['ei_05_13_s'];

            $Var_ei_05_13_t=$records['ei_05_13_t'];

            $Var_ei_05_14_s=$records['ei_05_14_s'];

            $Var_ei_05_14_t=$records['ei_05_14_t']; // Update values according to dbase

            $Var_ei_06_01_s=$records['ei_06_01_s'];

            $Var_ei_06_01_t=$records['ei_06_01_t'];

            $Var_ei_06_02_s=$records['ei_06_02_s'];

            $Var_ei_06_02_t=$records['ei_06_02_t'];

            $Var_ei_06_03_s=$records['ei_06_03_s'];

            $Var_ei_06_03_t=$records['ei_06_03_t'];

            $Var_ei_06_04_s=$records['ei_06_04_s'];

            $Var_ei_06_04_t=$records['ei_06_04_t'];

            $Var_ei_06_05_s=$records['ei_06_05_s'];

            $Var_ei_06_05_t=$records['ei_06_05_t'];

            $Var_ei_06_06_s=$records['ei_06_06_s'];

            $Var_ei_06_06_t=$records['ei_06_06_t'];

            $Var_ei_06_07_s=$records['ei_06_07_s'];

            $Var_ei_06_07_t=$records['ei_06_07_t'];

            $Var_ei_06_08_s=$records['ei_06_08_s'];

            $Var_ei_06_08_t=$records['ei_06_08_t'];

            $Var_ei_06_09_s=$records['ei_06_09_s'];

            $Var_ei_06_09_t=$records['ei_06_09_t'];

            $Var_ei_06_10_s=$records['ei_06_10_s'];

            $Var_ei_06_10_t=$records['ei_06_10_t'];

            $Var_ei_06_11_s=$records['ei_06_11_s'];

            $Var_ei_06_11_t=$records['ei_06_11_t']; // Update values according to dbase

            $Var_ei_07_01_s=$records['ei_07_01_s'];

            $Var_ei_07_01_t=$records['ei_07_01_t'];

            $Var_ei_07_02_s=$records['ei_07_02_s'];

            $Var_ei_07_02_t=$records['ei_07_02_t'];

            $Var_ei_07_03_s=$records['ei_07_03_s'];

            $Var_ei_07_03_t=$records['ei_07_03_t'];

            $Var_ei_07_04_s=$records['ei_07_04_s'];

            $Var_ei_07_04_t=$records['ei_07_04_t'];

            $Var_ei_07_05_s=$records['ei_07_05_s'];

            $Var_ei_07_05_t=$records['ei_07_05_t'];

            $Var_ei_07_06_s=$records['ei_07_06_s'];

            $Var_ei_07_06_t=$records['ei_07_06_t'];

            $Var_ei_07_07_s=$records['ei_07_07_s'];

            $Var_ei_07_07_t=$records['ei_07_07_t'];

            $Var_ei_07_08_s=$records['ei_07_08_s'];

            $Var_ei_07_08_t=$records['ei_07_08_t']; // Update values according to dbase

            $Var_ei_081_01_s=$records['ei_081_01_s'];

            $Var_ei_081_01_t=$records['ei_081_01_t'];

            $Var_ei_081_02_s=$records['ei_081_02_s'];

            $Var_ei_081_02_t=$records['ei_081_02_t'];

            $Var_ei_081_03_s=$records['ei_081_03_s'];

            $Var_ei_081_03_t=$records['ei_081_03_t'];

            $Var_ei_081_04_s=$records['ei_081_04_s'];

            $Var_ei_081_04_t=$records['ei_081_04_t'];

            $Var_ei_081_05_s=$records['ei_081_05_s'];

            $Var_ei_081_05_t=$records['ei_081_05_t'];

            $Var_ei_081_06_s=$records['ei_081_06_s'];

            $Var_ei_081_06_t=$records['ei_081_06_t'];

            $Var_ei_081_07_s=$records['ei_081_07_s'];

            $Var_ei_081_07_t=$records['ei_081_07_t'];

            $Var_ei_081_08_s=$records['ei_081_08_s'];

            $Var_ei_081_08_t=$records['ei_081_08_t'];

            $Var_ei_081_09_s=$records['ei_081_09_s'];

            $Var_ei_081_09_t=$records['ei_081_09_t'];

            $Var_ei_081_10_s=$records['ei_081_10_s'];

            $Var_ei_081_10_t=$records['ei_081_10_t'];

            $Var_ei_081_11_s=$records['ei_081_11_s'];

            $Var_ei_081_11_t=$records['ei_081_11_t'];

            $Var_ei_081_12_s=$records['ei_081_12_s'];

            $Var_ei_081_12_t=$records['ei_081_12_t'];

            $Var_ei_081_13_s=$records['ei_081_13_s'];

            $Var_ei_081_13_t=$records['ei_081_13_t'];

            $Var_ei_081_14_s=$records['ei_081_14_s'];

            $Var_ei_081_14_t=$records['ei_081_14_t']; 

            $Var_ei_081_15_s=$records['ei_081_15_s'];

            $Var_ei_081_15_t=$records['ei_081_15_t']; 

            $Var_ei_081_16_s=$records['ei_081_16_s'];

            $Var_ei_081_16_t=$records['ei_081_16_t']; 

            $Var_ei_081_17_s=$records['ei_081_17_s'];

            $Var_ei_081_17_t=$records['ei_081_17_t']; 

            $Var_ei_081_18_s=$records['ei_081_18_s'];

            $Var_ei_081_18_t=$records['ei_081_18_t']; 

            $Var_ei_081_19_s=$records['ei_081_19_s'];

            $Var_ei_081_19_t=$records['ei_081_19_t']; 

            // Update values according to dbase

            $Var_ei_082_01_s=$records['ei_082_01_s'];

            $Var_ei_082_01_t=$records['ei_082_01_t'];

            $Var_ei_082_02_s=$records['ei_082_02_s'];

            $Var_ei_082_02_t=$records['ei_082_02_t'];

            $Var_ei_082_03_s=$records['ei_082_03_s'];

            $Var_ei_082_03_t=$records['ei_082_03_t'];

            $Var_ei_082_04_s=$records['ei_082_04_s'];

            $Var_ei_082_04_t=$records['ei_082_04_t'];

            $Var_ei_082_05_s=$records['ei_082_05_s'];

            $Var_ei_082_05_t=$records['ei_082_05_t'];

            $Var_ei_082_06_s=$records['ei_082_06_s'];

            $Var_ei_082_06_t=$records['ei_082_06_t'];

            $Var_ei_082_07_s=$records['ei_082_07_s'];

            $Var_ei_082_07_t=$records['ei_082_07_t'];

            $Var_ei_082_08_s=$records['ei_082_08_s'];

            $Var_ei_082_08_t=$records['ei_082_08_t'];

            $Var_ei_082_09_s=$records['ei_082_09_s'];

            $Var_ei_082_09_t=$records['ei_082_09_t'];

            $Var_ei_082_10_s=$records['ei_082_10_s'];

            $Var_ei_082_10_t=$records['ei_082_10_t'];

            $Var_ei_082_11_s=$records['ei_082_11_s'];

            $Var_ei_082_11_t=$records['ei_082_11_t'];

            $Var_ei_082_12_s=$records['ei_082_12_s'];

            $Var_ei_082_12_t=$records['ei_082_12_t'];

            $Var_ei_082_13_s=$records['ei_082_13_s'];

            $Var_ei_082_13_t=$records['ei_082_13_t'];

            $Var_ei_082_14_s=$records['ei_082_14_s'];

            $Var_ei_082_14_t=$records['ei_082_14_t']; 

            $Var_ei_082_15_s=$records['ei_082_15_s'];

            $Var_ei_082_15_t=$records['ei_082_15_t']; 

            $Var_ei_082_16_s=$records['ei_082_16_s'];

            $Var_ei_082_16_t=$records['ei_082_16_t']; 

            $Var_ei_082_17_s=$records['ei_082_17_s'];

            $Var_ei_082_17_t=$records['ei_082_17_t']; 

            $Var_ei_082_18_s=$records['ei_082_18_s'];

            $Var_ei_082_18_t=$records['ei_082_18_t']; 

            $Var_ei_082_19_s=$records['ei_082_19_s'];

            $Var_ei_082_19_t=$records['ei_082_19_t']; 

            $Var_ei_082_20_s=$records['ei_082_20_s'];

            $Var_ei_082_20_t=$records['ei_082_20_t']; 

            $Var_ei_082_21_s=$records['ei_082_21_s'];

            $Var_ei_082_21_t=$records['ei_082_21_t']; 

            $Var_ei_082_22_s=$records['ei_082_22_s'];

            $Var_ei_082_22_t=$records['ei_082_22_t']; 

            $Var_ei_082_23_s=$records['ei_082_23_s'];

            $Var_ei_082_23_t=$records['ei_082_23_t']; 

            $Var_ei_082_24_s=$records['ei_082_24_s'];

            $Var_ei_082_24_t=$records['ei_082_24_t']; 

            $Var_ei_082_25_s=$records['ei_082_25_s'];

            $Var_ei_082_25_t=$records['ei_082_25_t']; 

            $Var_ei_082_26_s=$records['ei_082_26_s'];

            $Var_ei_082_26_t=$records['ei_082_26_t']; 

            $Var_ei_082_27_s=$records['ei_082_27_s'];

            $Var_ei_082_27_t=$records['ei_082_27_t']; 

            // Update values according to dbase

            $Var_ei_09_01_t=$records['ei_09_01_t']; // Update values according to dbase



?>

   <fieldset style="min-height: 183px;">

      <div class="legende">1. Communicatie</div>

      <div>&nbsp;</div>

      <div class="waarde">

            <table cellpadding="0" cellspacing="0">

                <tr>

                    <th align="center">&nbsp;-&nbsp;</th>

                    <th align="center">&nbsp;&plusmn;&nbsp;</th>

                    <th align="center">&nbsp;+&nbsp;</th>

                    <th align="center">&nbsp;NVT&nbsp;</th>

                    <th>Item</th>

                    <th>Bijkomende opmerkingen</th>

                </tr>

                <tr>

<?php 

markselected($Var_ei_01_01_s,"ei_01_01_s",1);

markselected($Var_ei_01_01_s,"ei_01_01_s",2);

markselected($Var_ei_01_01_s,"ei_01_01_s",3);

markselected($Var_ei_01_01_s,"ei_01_01_s",4);

?>

                    <td valign="top">Anderstalig</td>

                    <td valign="top" align="center">

                    <?php print($Var_ei_01_01_t);?></td>

                </tr>

            <tr>

<?php 

markselected($Var_ei_01_02_s,"ei_01_02_s",1);

markselected($Var_ei_01_02_s,"ei_01_02_s",2);

markselected($Var_ei_01_02_s,"ei_01_02_s",3);

markselected($Var_ei_01_02_s,"ei_01_02_s",4);

?>

                    <td valign="top">Dialect</td>

                    <td valign="top" align="center">

                    <?php print($Var_ei_01_02_t);?></td>

                </tr>

            <tr>

<?php 

markselected($Var_ei_01_03_s,"ei_01_03_s",1);

markselected($Var_ei_01_03_s,"ei_01_03_s",2);

markselected($Var_ei_01_03_s,"ei_01_03_s",3);

markselected($Var_ei_01_03_s,"ei_01_03_s",4);

?>

                    <td valign="top">Afasie</td>

                    <td valign="top" align="center">

                    <?php print($Var_ei_01_03_t);?></td>

                </tr>

            <tr>

<?php 

markselected($Var_ei_01_04_s,"ei_01_04_s",1);

markselected($Var_ei_01_04_s,"ei_01_04_s",2);

markselected($Var_ei_01_04_s,"ei_01_04_s",3);

markselected($Var_ei_01_04_s,"ei_01_04_s",4);

?>

                    <td valign="top">Hoorproblemen</td>

                    <td valign="top" align="center">

                    <?php print($Var_ei_01_04_t);?></td>

                </tr>

            <tr>

<?php 

markselected($Var_ei_01_05_s,"ei_01_05_s",1);

markselected($Var_ei_01_05_s,"ei_01_05_s",2);

markselected($Var_ei_01_05_s,"ei_01_05_s",3);

markselected($Var_ei_01_05_s,"ei_01_05_s",4);

?>

                    <td valign="top">Spraakproblemen</td>

                    <td valign="top" align="center">

                    <?php print($Var_ei_01_05_t);?></td>

                </tr>

            <tr class="verplicht">

<?php 

markselected($Var_ei_01_06_s,"ei_01_06_s",1);

markselected($Var_ei_01_06_s,"ei_01_06_s",2);

markselected($Var_ei_01_06_s,"ei_01_06_s",3);

markselected($Var_ei_01_06_s,"ei_01_06_s",4);

?>

                    <td valign="top">Gebruik telecommunicatie</td>

                    <td valign="top" align="center">

                    <?php print($Var_ei_01_06_t);?></td>

                </tr>

            <tr>

<?php 

markselected($Var_ei_01_07_s,"ei_01_07_s",1);

markselected($Var_ei_01_07_s,"ei_01_07_s",2);

markselected($Var_ei_01_07_s,"ei_01_07_s",3);

markselected($Var_ei_01_07_s,"ei_01_07_s",4);

?>

                    <td valign="top">Individuele aandachtspunten</td>

                    <td valign="top" align="center">

                    <?php print($Var_ei_01_07_t);?></td>

                </tr>

            </table>

      </div>

   </fieldset>

   <fieldset style="min-height: 223px;">

      <div class="legende">2. Woon-en leefomstandigheden</div>

      <div>&nbsp;</div>

      <div class="waarde">

            <table cellpadding="0" cellspacing="0">

                <tr>

                    <th align="center">&nbsp;-&nbsp;</th>

                    <th align="center">&nbsp;&plusmn;&nbsp;</th>

                    <th align="center">&nbsp;+&nbsp;</th>

                    <th align="center">&nbsp;NVT&nbsp;</th>

                    <th>Item</th>

                    <th>Bijkomende opmerkingen</th>

                </tr>

            <tr>

<?php 

markselected($Var_ei_02_01_s,"ei_02_01_s",1);

markselected($Var_ei_02_01_s,"ei_02_01_s",2);

markselected($Var_ei_02_01_s,"ei_02_01_s",3);

markselected($Var_ei_02_01_s,"ei_02_01_s",4);

?>

                    <td valign="top">Hygi&euml;nische toestand pati&euml;nt</td>

                    <td valign="top" align="center"><?php print($Var_ei_02_01_t);?></td>

                </tr>

            <tr>

<?php 

markselected($Var_ei_02_02_s,"ei_02_02_s",1);

markselected($Var_ei_02_02_s,"ei_02_02_s",2);

markselected($Var_ei_02_02_s,"ei_02_02_s",3);

markselected($Var_ei_02_02_s,"ei_02_02_s",4);

?>

                    <td valign="top">Hygi&euml;nische toestand woning</td>

                    <td valign="top" align="center"><?php print($Var_ei_02_02_t);?></td>

                </tr>

            <tr>

<?php 

markselected($Var_ei_02_03_s,"ei_02_03_s",1);

markselected($Var_ei_02_03_s,"ei_02_03_s",2);

markselected($Var_ei_02_03_s,"ei_02_03_s",3);

markselected($Var_ei_02_03_s,"ei_02_03_s",4);

?>

                    <td valign="top">Comfort woning</td>

                    <td valign="top" align="center"><?php print($Var_ei_02_03_t);?></td>

                </tr>

            <tr>

<?php 

markselected($Var_ei_02_04_s,"ei_02_04_s",1);

markselected($Var_ei_02_04_s,"ei_02_04_s",2);

markselected($Var_ei_02_04_s,"ei_02_04_s",3);

markselected($Var_ei_02_04_s,"ei_02_04_s",4);

?>

                    <td valign="top">Veiligheid woning</td>

                    <td valign="top" align="center"><?php print($Var_ei_02_04_t);?></td>

                </tr>

            <tr class="verplicht">

<?php 

markselected($Var_ei_02_05_s,"ei_02_05_s",1);

markselected($Var_ei_02_05_s,"ei_02_05_s",2);

markselected($Var_ei_02_05_s,"ei_02_05_s",3);

markselected($Var_ei_02_05_s,"ei_02_05_s",4);

?>

                    <td valign="top">Toegankelijkheid woning</td>

                    <td valign="top" align="center"><?php print($Var_ei_02_05_t);?></td>

                </tr>

            <tr class="verplicht">

<?php 

markselected($Var_ei_02_06_s,"ei_02_06_s",1);

markselected($Var_ei_02_06_s,"ei_02_06_s",2);

markselected($Var_ei_02_06_s,"ei_02_06_s",3);

markselected($Var_ei_02_06_s,"ei_02_06_s",4);

?>

                    <td valign="top">Doorgankelijkheid woning</td>

                    <td valign="top" align="center"><?php print($Var_ei_02_06_t);?></td>

                </tr>

            <tr class="verplicht">

<?php 

markselected($Var_ei_02_07_s,"ei_02_07_s",1);

markselected($Var_ei_02_07_s,"ei_02_07_s",2);

markselected($Var_ei_02_07_s,"ei_02_07_s",3);

markselected($Var_ei_02_07_s,"ei_02_07_s",4);

?>

                    <td valign="top">Bruikbaarheid woning</td>

                    <td valign="top" align="center"><?php print($Var_ei_02_07_t);?></td>

                </tr>

            <tr>

<?php 

markselected($Var_ei_02_08_s,"ei_02_08_s",1);

markselected($Var_ei_02_08_s,"ei_02_08_s",2);

markselected($Var_ei_02_08_s,"ei_02_08_s",3);

markselected($Var_ei_02_08_s,"ei_02_08_s",4);

?>

                    <td valign="top">Huisdieren</td>

                    <td valign="top" align="center"><?php print($Var_ei_02_08_t);?></td>

                </tr>

            <tr>

<?php 

markselected($Var_ei_02_09_s,"ei_02_09_s",1);

markselected($Var_ei_02_09_s,"ei_02_09_s",2);

markselected($Var_ei_02_09_s,"ei_02_09_s",3);

markselected($Var_ei_02_09_s,"ei_02_09_s",4);

?>

                    <td valign="top">Individuele aandachtspunten</td>

                    <td valign="top" align="center"><?php print($Var_ei_02_09_t);?></td>

                </tr>

            </table>

      </div>

   </fieldset>

    <fieldset style="min-height: 225px;">

      <div class="legende">3.1. Medische verzorging</div>

      <div>&nbsp;</div>

      <div class="waarde">

            <table cellpadding="0" cellspacing="0">

                <tr>

                    <th align="center">&nbsp;-&nbsp;</th>

                    <th align="center">&nbsp;&plusmn;&nbsp;</th>

                    <th align="center">&nbsp;+&nbsp;</th>

                    <th align="center">&nbsp;NVT&nbsp;</th>

                    <th>Item</th>

                    <th>Bijkomende opmerkingen</th>

                </tr>

            <tr>

<?php 

markselected($Var_ei_031_01_s,"ei_031_01_s",1);

markselected($Var_ei_031_01_s,"ei_031_01_s",2);

markselected($Var_ei_031_01_s,"ei_031_01_s",3);

markselected($Var_ei_031_01_s,"ei_031_01_s",4);

?>

                    <td valign="top">Controle parameters</td>

                    <td valign="top" align="center"><?php print($Var_ei_031_01_t);?></td>

                </tr>

            <tr>

<?php 

markselected($Var_ei_031_02_s,"ei_031_02_s",1);

markselected($Var_ei_031_02_s,"ei_031_02_s",2);

markselected($Var_ei_031_02_s,"ei_031_02_s",3);

markselected($Var_ei_031_02_s,"ei_031_02_s",4);

?>

                    <td valign="top">Observatie</td>

                    <td valign="top" align="center"><?php print($Var_ei_031_02_t);?></td>

                </tr>

            <tr class="verplicht">

                    <td valign="top" colspan="6" class="titel"><b>Medicatie verzorgingsmateriaal :&nbsp;</b></td>

                </tr>

            <tr class="verplicht">

<?php 

markselected($Var_ei_031_03_s,"ei_031_03_s",1);

markselected($Var_ei_031_03_s,"ei_031_03_s",2);

markselected($Var_ei_031_03_s,"ei_031_03_s",3);

markselected($Var_ei_031_03_s,"ei_031_03_s",4);

?>

                    <td valign="top">&nbsp;&nbsp;&bull;&nbsp;Aanschaf</td>

                    <td valign="top" align="center"><?php print($Var_ei_031_03_t);?></td>

                </tr>

            <tr class="verplicht">

<?php 

markselected($Var_ei_031_04_s,"ei_031_04_s",1);

markselected($Var_ei_031_04_s,"ei_031_04_s",2);

markselected($Var_ei_031_04_s,"ei_031_04_s",3);

markselected($Var_ei_031_04_s,"ei_031_04_s",4);

?>

                    <td valign="top">&nbsp;&nbsp;&bull;&nbsp;Klaarzetten/Pillendoos?</td>

                    <td valign="top" align="center"><?php print($Var_ei_031_04_t);?></td>

                </tr>

            <tr class="verplicht">

<?php 

markselected($Var_ei_031_05_s,"ei_031_05_s",1);

markselected($Var_ei_031_05_s,"ei_031_05_s",2);

markselected($Var_ei_031_05_s,"ei_031_05_s",3);

markselected($Var_ei_031_05_s,"ei_031_05_s",4);

?>

                    <td valign="top">&nbsp;&nbsp;&bull;&nbsp;Innemen/Gebruiken</td>

                    <td valign="top" align="center"><?php print($Var_ei_031_05_t);?></td>

                </tr>

            <tr class="verplicht">

<?php 

markselected($Var_ei_031_06_s,"ei_031_06_s",1);

markselected($Var_ei_031_06_s,"ei_031_06_s",2);

markselected($Var_ei_031_06_s,"ei_031_06_s",3);

markselected($Var_ei_031_06_s,"ei_031_06_s",4);

?>

                    <td valign="top">&nbsp;&nbsp;&bull;&nbsp;Overige...</td>

                    <td valign="top" align="center"><?php print($Var_ei_031_06_t);?></td>

                </tr>

            <tr>

<?php 

markselected($Var_ei_031_07_s,"ei_031_07_s",1);

markselected($Var_ei_031_07_s,"ei_031_07_s",2);

markselected($Var_ei_031_07_s,"ei_031_07_s",3);

markselected($Var_ei_031_07_s,"ei_031_07_s",4);

?>

                    <td valign="top">Allergische reacties</td>

                    <td valign="top" align="center"><?php print($Var_ei_031_07_t);?></td>

                </tr>



            <tr>

<?php 

markselected($Var_ei_031_08_s,"ei_031_08_s",1);

markselected($Var_ei_031_08_s,"ei_031_08_s",2);

markselected($Var_ei_031_08_s,"ei_031_08_s",3);

markselected($Var_ei_031_08_s,"ei_031_08_s",4);

?>

                    <td valign="top">Individuele aandachtspunten</td>

                    <td valign="top" align="center"><?php print($Var_ei_031_08_t);?></td>

                </tr>

            </table>

      </div>

   </fieldset>

   <fieldset style="min-height: 415px;">

      <div class="legende">3.2. Hygi&euml;nische verzorging</div>

      <div>&nbsp;</div>

      <div class="waarde">

            <table cellpadding="0" cellspacing="0">

                <tr>

                    <th align="center">&nbsp;-&nbsp;</th>

                    <th align="center">&nbsp;&plusmn;&nbsp;</th>

                    <th align="center">&nbsp;+&nbsp;</th>

                    <th align="center">&nbsp;NVT&nbsp;</th>

                    <th>Item</th>

                    <th>Bijkomende opmerkingen</th>

                </tr>

            <tr>

                    <td valign="top" colspan="6" class="titel">Wassen :</td>

                </tr>

            <tr>

<?php 

markselected($Var_ei_032_01_s,"ei_032_01_s",1);

markselected($Var_ei_032_01_s,"ei_032_01_s",2);

markselected($Var_ei_032_01_s,"ei_032_01_s",3);

markselected($Var_ei_032_01_s,"ei_032_01_s",4);

?>

                    <td valign="top">&nbsp;&nbsp;&bull;&nbsp;Locatie</td>

                    <td valign="top" align="center"><?php print($Var_ei_032_01_t);?></td>

                </tr>

            <tr>

<?php 

markselected($Var_ei_032_02_s,"ei_032_02_s",1);

markselected($Var_ei_032_02_s,"ei_032_02_s",2);

markselected($Var_ei_032_02_s,"ei_032_02_s",3);

markselected($Var_ei_032_02_s,"ei_032_02_s",4);

?>

                    <td valign="top">&nbsp;&nbsp;&bull;&nbsp;Tijdstip</td>

                    <td valign="top" align="center"><?php print($Var_ei_032_02_t);?></td>

                </tr>

            <tr>

<?php 

markselected($Var_ei_032_03_s,"ei_032_03_s",1);

markselected($Var_ei_032_03_s,"ei_032_03_s",2);

markselected($Var_ei_032_03_s,"ei_032_03_s",3);

markselected($Var_ei_032_03_s,"ei_032_03_s",4);

?>

                    <td valign="top">&nbsp;&nbsp;&bull;&nbsp;Frequentie</td>

                    <td valign="top" align="center"><?php print($Var_ei_032_03_t);?></td>

                </tr>

            <tr>

                    <td valign="top" colspan="6">&nbsp;</td>

                </tr>

            <tr>

<?php 

markselected($Var_ei_032_04_s,"ei_032_04_s",1);

markselected($Var_ei_032_04_s,"ei_032_04_s",2);

markselected($Var_ei_032_04_s,"ei_032_04_s",3);

markselected($Var_ei_032_04_s,"ei_032_04_s",4);

?>

                    <td valign="top">Haar- en baardverzorging</td>

                    <td valign="top" align="center"><?php print($Var_ei_032_04_t);?></td>

                </tr>

            <tr>

<?php 

markselected($Var_ei_032_05_s,"ei_032_05_s",1);

markselected($Var_ei_032_05_s,"ei_032_05_s",2);

markselected($Var_ei_032_05_s,"ei_032_05_s",3);

markselected($Var_ei_032_05_s,"ei_032_05_s",4);

?>

                    <td valign="top">Hand- en voetverzorging</td>

                    <td valign="top" align="center"><?php print($Var_ei_032_05_t);?></td>

                </tr>

            <tr>

<?php 

markselected($Var_ei_032_06_s,"ei_032_06_s",1);

markselected($Var_ei_032_06_s,"ei_032_06_s",2);

markselected($Var_ei_032_06_s,"ei_032_06_s",3);

markselected($Var_ei_032_06_s,"ei_032_06_s",4);

?>

                    <td valign="top">Tand- en mondverzorging</td>

                    <td valign="top" align="center"><?php print($Var_ei_032_06_t);?></td>

                </tr>

            <tr>

<?php 

markselected($Var_ei_032_07_s,"ei_032_07_s",1);

markselected($Var_ei_032_07_s,"ei_032_07_s",2);

markselected($Var_ei_032_07_s,"ei_032_07_s",3);

markselected($Var_ei_032_07_s,"ei_032_07_s",4);

?>

                    <td valign="top">Prothesen</td>

                    <td valign="top" align="center"><?php print($Var_ei_032_07_t);?></td>

                </tr>

            <tr class="verplicht">

                    <td valign="top" colspan="6" class="titel">Kleding :</td>

                </tr>

            <tr class="verplicht">

<?php 

markselected($Var_ei_032_08_s,"ei_032_08_s",1);

markselected($Var_ei_032_08_s,"ei_032_08_s",2);

markselected($Var_ei_032_08_s,"ei_032_08_s",3);

markselected($Var_ei_032_08_s,"ei_032_08_s",4);

?>

                    <td valign="top">&nbsp;&nbsp;&bull;&nbsp;Aantrekken</td>

                    <td valign="top" align="center"><?php print($Var_ei_032_08_t);?></td>

                </tr>

            <tr class="verplicht">

<?php 

markselected($Var_ei_032_09_s,"ei_032_09_s",1);

markselected($Var_ei_032_09_s,"ei_032_09_s",2);

markselected($Var_ei_032_09_s,"ei_032_09_s",3);

markselected($Var_ei_032_09_s,"ei_032_09_s",4);

?>

                    <td valign="top">&nbsp;&nbsp;&bull;&nbsp;Uittrekken</td>

                    <td valign="top" align="center"><?php print($Var_ei_032_09_t);?></td>

                </tr>

            <tr class="verplicht">

                    <td valign="top" colspan="6" class="titel">Voetbekleding :</td>

                </tr>

            <tr class="verplicht">

<?php 

markselected($Var_ei_032_10_s,"ei_032_10_s",1);

markselected($Var_ei_032_10_s,"ei_032_10_s",2);

markselected($Var_ei_032_10_s,"ei_032_10_s",3);

markselected($Var_ei_032_10_s,"ei_032_10_s",4);

?>

                    <td valign="top">&nbsp;&nbsp;&bull;&nbsp;Aantrekken</td>

                    <td valign="top" align="center"><?php print($Var_ei_032_10_t);?></td>

                </tr>

            <tr class="verplicht">

<?php 

markselected($Var_ei_032_11_s,"ei_032_11_s",1);

markselected($Var_ei_032_11_s,"ei_032_11_s",2);

markselected($Var_ei_032_11_s,"ei_032_11_s",3);

markselected($Var_ei_032_11_s,"ei_032_11_s",4);

?>

                    <td valign="top">&nbsp;&nbsp;&bull;&nbsp;Uittrekken</td>

                    <td valign="top" align="center"><?php print($Var_ei_032_11_t);?></td>

                </tr>

            <tr>

                    <td valign="top" colspan="6">&nbsp;</td>

                </tr>

            <tr>

<?php 

markselected($Var_ei_032_12_s,"ei_032_12_s",1);

markselected($Var_ei_032_12_s,"ei_032_12_s",2);

markselected($Var_ei_032_12_s,"ei_032_12_s",3);

markselected($Var_ei_032_12_s,"ei_032_12_s",4);

?>

                    <td valign="top">Incontinentie</td>

                    <td valign="top" align="center"><?php print($Var_ei_032_12_t);?></td>

                </tr>

            <tr class="verplicht">

<?php 

markselected($Var_ei_032_13_s,"ei_032_13_s",1);

markselected($Var_ei_032_13_s,"ei_032_13_s",2);

markselected($Var_ei_032_13_s,"ei_032_13_s",3);

markselected($Var_ei_032_13_s,"ei_032_13_s",4);

?>

                    <td valign="top">Zorg dragen voor menstruatie</td>

                    <td valign="top" align="center"><?php print($Var_ei_032_13_t);?></td>

                </tr>

            <tr>

<?php 

markselected($Var_ei_032_14_s,"ei_032_14_s",1);

markselected($Var_ei_032_14_s,"ei_032_14_s",2);

markselected($Var_ei_032_14_s,"ei_032_14_s",3);

markselected($Var_ei_032_14_s,"ei_032_14_s",4);

?>

                    <td valign="top">Individuele aandachtspunten</td>

                    <td valign="top" align="center"><?php print($Var_ei_032_14_t);?></td>

                </tr>

            </table>

      </div>

   </fieldset>

   <fieldset style="min-height: 270px;">

      <div class="legende">3.3. Mobiliteit</div>

      <div>&nbsp;</div>

      <div class="waarde">

            <table cellpadding="0" cellspacing="0">

                <tr>

                    <th align="center">&nbsp;-&nbsp;</th>

                    <th align="center">&nbsp;&plusmn;&nbsp;</th>

                    <th align="center">&nbsp;+&nbsp;</th>

                    <th align="center">&nbsp;NVT&nbsp;</th>

                    <th>Item</th>

                    <th>Bijkomende opmerkingen</th>

                </tr>

            <tr class="verplicht">

                    <td valign="top" colspan="6" class="titel">Transfer :</td>

                </tr>

            <tr class="verplicht">

<?php 

markselected($Var_ei_033_01_s,"ei_033_01_s",1);

markselected($Var_ei_033_01_s,"ei_033_01_s",2);

markselected($Var_ei_033_01_s,"ei_033_01_s",3);

markselected($Var_ei_033_01_s,"ei_033_01_s",4);

?>

                    <td valign="top">&nbsp;&nbsp;&bull;&nbsp;In zit</td>

                    <td valign="top" align="center"><?php print($Var_ei_033_01_t);?></td>

                </tr>

            <tr class="verplicht">

<?php 

markselected($Var_ei_033_02_s,"ei_033_02_s",1);

markselected($Var_ei_033_02_s,"ei_033_02_s",2);

markselected($Var_ei_033_02_s,"ei_033_02_s",3);

markselected($Var_ei_033_02_s,"ei_033_02_s",4);

?>

                    <td valign="top">&nbsp;&nbsp;&bull;&nbsp;In lig</td>

                    <td valign="top" align="center"><?php print($Var_ei_033_02_t);?></td>

                </tr>

            <tr class="verplicht">

                    <td valign="top" colspan="6" class="titel">Verplaatsen :</td>

                </tr>

            <tr>

<?php 

markselected($Var_ei_033_03_s,"ei_033_03_s",1);

markselected($Var_ei_033_03_s,"ei_033_03_s",2);

markselected($Var_ei_033_03_s,"ei_033_03_s",3);

markselected($Var_ei_033_03_s,"ei_033_03_s",4);

?>

                    <td valign="top">&nbsp;&nbsp;&bull;&nbsp;Binnen</td>

                    <td valign="top" align="center"><?php print($Var_ei_033_03_t);?></td>

                </tr>

            <tr class="verplicht">

                    <td valign="top" class="begincel" colspan="4"></td>

                    <td valign="top" colspan="2">&nbsp;&nbsp;&bull;&nbsp;Buiten</td>

                </tr>

            <tr class="verplicht">

<?php 

markselected($Var_ei_033_04_s,"ei_033_04_s",1);

markselected($Var_ei_033_04_s,"ei_033_04_s",2);

markselected($Var_ei_033_04_s,"ei_033_04_s",3);

markselected($Var_ei_033_04_s,"ei_033_04_s",4);

?>

                    <td valign="top">&nbsp;&nbsp;&nbsp;&nbsp;&loz;&nbsp;Met vervoermiddel</td>

                    <td valign="top" align="center"><?php print($Var_ei_033_04_t);?></td>

                </tr>

            <tr class="verplicht">

<?php 

markselected($Var_ei_033_05_s,"ei_033_05_s",1);

markselected($Var_ei_033_05_s,"ei_033_05_s",2);

markselected($Var_ei_033_05_s,"ei_033_05_s",3);

markselected($Var_ei_033_05_s,"ei_033_05_s",4);

?>

                    <td valign="top">&nbsp;&nbsp;&nbsp;&nbsp;&loz;&nbsp;Zonder vervoermiddel</td>

                    <td valign="top" align="center"><?php print($Var_ei_033_05_t);?></td>

                </tr>

            <tr>

<?php 

markselected($Var_ei_033_06_s,"ei_033_06_s",1);

markselected($Var_ei_033_06_s,"ei_033_06_s",2);

markselected($Var_ei_033_06_s,"ei_033_06_s",3);

markselected($Var_ei_033_06_s,"ei_033_06_s",4);

?>

                    <td valign="top">Valpreventie</td>

                    <td valign="top" align="center"><?php print($Var_ei_033_06_t);?></td>

                </tr>

            <tr>

<?php 

markselected($Var_ei_033_07_s,"ei_033_07_s",1);

markselected($Var_ei_033_07_s,"ei_033_07_s",2);

markselected($Var_ei_033_07_s,"ei_033_07_s",3);

markselected($Var_ei_033_07_s,"ei_033_07_s",4);

?>

                    <td valign="top">Tilprotocol</td>

                    <td valign="top" align="center"><?php print($Var_ei_033_07_t);?></td>

                </tr>

            <tr>

<?php 

markselected($Var_ei_033_08_s,"ei_033_08_s",1);

markselected($Var_ei_033_08_s,"ei_033_08_s",2);

markselected($Var_ei_033_08_s,"ei_033_08_s",3);

markselected($Var_ei_033_08_s,"ei_033_08_s",4);

?>

                    <td valign="top">Individuele aandachtspunten</td>

                    <td valign="top" align="center"><?php print($Var_ei_033_08_t);?></td>

                </tr>

            </table>

      </div>

   </fieldset>

   <fieldset style="min-height: 370px;">

      <div class="legende">4. Huishoudelijke ondersteuning</div>

      <div>&nbsp;</div>

      <div class="waarde">

            <table cellpadding="0" cellspacing="0">

                <tr>

                    <th align="center">&nbsp;-&nbsp;</th>

                    <th align="center">&nbsp;&plusmn;&nbsp;</th>

                    <th align="center">&nbsp;+&nbsp;</th>

                    <th align="center">&nbsp;NVT&nbsp;</th>

                    <th>Item</th>

                    <th>Bijkomende opmerkingen</th>

                </tr>

            <tr class="verplicht">

                    <td valign="top" colspan="6" class="titel">Bereiding :</td>

                </tr>

            <tr class="verplicht">

<?php 

markselected($Var_ei_04_01_s,"ei_04_01_s",1);

markselected($Var_ei_04_01_s,"ei_04_01_s",2);

markselected($Var_ei_04_01_s,"ei_04_01_s",3);

markselected($Var_ei_04_01_s,"ei_04_01_s",4);

?>

                    <td valign="top">&nbsp;&nbsp;&bull;&nbsp;Ontbijt</td>

                    <td valign="top" align="center"><?php print($Var_ei_04_01_t);?></td>

                </tr>

            <tr class="verplicht">

<?php 

markselected($Var_ei_04_02_s,"ei_04_02_s",1);

markselected($Var_ei_04_02_s,"ei_04_02_s",2);

markselected($Var_ei_04_02_s,"ei_04_02_s",3);

markselected($Var_ei_04_02_s,"ei_04_02_s",4);

?>

                    <td valign="top">&nbsp;&nbsp;&bull;&nbsp;Warme maaltijd</td>

                    <td valign="top" align="center"><?php print($Var_ei_04_02_t);?></td>

                </tr>

            <tr class="verplicht">

<?php 

markselected($Var_ei_04_03_s,"ei_04_03_s",1);

markselected($Var_ei_04_03_s,"ei_04_03_s",2);

markselected($Var_ei_04_03_s,"ei_04_03_s",3);

markselected($Var_ei_04_03_s,"ei_04_03_s",4);

?>

                    <td valign="top">&nbsp;&nbsp;&bull;&nbsp;Avondmaal</td>

                    <td valign="top" align="center"><?php print($Var_ei_04_03_t);?></td>

                </tr>

            <tr>

                    <td valign="top" colspan="6">&nbsp;</td>

                </tr>

            <tr class="verplicht">

<?php 

markselected($Var_ei_04_04_s,"ei_04_04_s",1);

markselected($Var_ei_04_04_s,"ei_04_04_s",2);

markselected($Var_ei_04_04_s,"ei_04_04_s",3);

markselected($Var_ei_04_04_s,"ei_04_04_s",4);

?>

                    <td valign="top">Vaat doen</td>

                    <td valign="top" align="center"><?php print($Var_ei_04_04_t);?></td>

                </tr>

            <tr class="verplicht">

<?php 

markselected($Var_ei_04_05_s,"ei_04_05_s",1);

markselected($Var_ei_04_05_s,"ei_04_05_s",2);

markselected($Var_ei_04_05_s,"ei_04_05_s",3);

markselected($Var_ei_04_05_s,"ei_04_05_s",4);

?>

                    <td valign="top">Bediening huishoudapp.</td>

                    <td valign="top" align="center"><?php print($Var_ei_04_05_t);?></td>

                </tr>

            <tr class="verplicht">

<?php 

markselected($Var_ei_04_06_s,"ei_04_06_s",1);

markselected($Var_ei_04_06_s,"ei_04_06_s",2);

markselected($Var_ei_04_06_s,"ei_04_06_s",3);

markselected($Var_ei_04_06_s,"ei_04_06_s",4);

?>

                    <td valign="top">Onderhoud woning / keuken</td>

                    <td valign="top" align="center"><?php print($Var_ei_04_06_t);?></td>

                </tr>

            <tr>

<?php 

markselected($Var_ei_04_07_s,"ei_04_07_s",1);

markselected($Var_ei_04_07_s,"ei_04_07_s",2);

markselected($Var_ei_04_07_s,"ei_04_07_s",3);

markselected($Var_ei_04_07_s,"ei_04_07_s",4);

?>

                    <td valign="top">Onderhoud tuin</td>

                    <td valign="top" align="center"><?php print($Var_ei_04_07_t);?></td>

                </tr>

            <tr class="verplicht">

<?php 

markselected($Var_ei_04_08_s,"ei_04_08_s",1);

markselected($Var_ei_04_08_s,"ei_04_08_s",2);

markselected($Var_ei_04_08_s,"ei_04_08_s",3);

markselected($Var_ei_04_08_s,"ei_04_08_s",4);

?>

                    <td valign="top">Verwijderen afval</td>

                    <td valign="top" align="center"><?php print($Var_ei_04_08_t);?></td>

                </tr>

            <tr class="verplicht">

<?php 

markselected($Var_ei_04_09_s,"ei_04_09_s",1);

markselected($Var_ei_04_09_s,"ei_04_09_s",2);

markselected($Var_ei_04_09_s,"ei_04_09_s",3);

markselected($Var_ei_04_09_s,"ei_04_09_s",4);

?>

                    <td valign="top">Wassen / drogen kleding</td>

                    <td valign="top" align="center"><?php print($Var_ei_04_09_t);?></td>

                </tr>

            <tr class="verplicht">

<?php 

markselected($Var_ei_04_10_s,"ei_04_10_s",1);

markselected($Var_ei_04_10_s,"ei_04_10_s",2);

markselected($Var_ei_04_10_s,"ei_04_10_s",3);

markselected($Var_ei_04_10_s,"ei_04_10_s",4);

?>

                    <td valign="top">Strijken</td>

                    <td valign="top" align="center"><?php print($Var_ei_04_10_t);?></td>

                </tr>

            <tr class="verplicht">

<?php 

markselected($Var_ei_04_11_s,"ei_04_11_s",1);

markselected($Var_ei_04_11_s,"ei_04_11_s",2);

markselected($Var_ei_04_11_s,"ei_04_11_s",3);

markselected($Var_ei_04_11_s,"ei_04_11_s",4);

?>

                    <td valign="top">Boodschappen doen</td>

                    <td valign="top" align="center"><?php print($Var_ei_04_11_t);?></td>

                </tr>

            <tr class="verplicht">

<?php 

markselected($Var_ei_04_12_s,"ei_04_12_s",1);

markselected($Var_ei_04_12_s,"ei_04_12_s",2);

markselected($Var_ei_04_12_s,"ei_04_12_s",3);

markselected($Var_ei_04_12_s,"ei_04_12_s",4);

?>

                    <td valign="top">Administratieve verrichtingen</td>

                    <td valign="top" align="center"><?php print($Var_ei_04_12_t);?></td>

                </tr>

            <tr class="verplicht">

<?php 

markselected($Var_ei_04_13_s,"ei_04_13_s",1);

markselected($Var_ei_04_13_s,"ei_04_13_s",2);

markselected($Var_ei_04_13_s,"ei_04_13_s",3);

markselected($Var_ei_04_13_s,"ei_04_13_s",4);

?>

                    <td valign="top">Financi&euml;le verrichtingen</td>

                    <td valign="top" align="center"><?php print($Var_ei_04_13_t);?></td>

                </tr>

            <tr>

<?php 

markselected($Var_ei_04_14_s,"ei_04_14_s",1);

markselected($Var_ei_04_14_s,"ei_04_14_s",2);

markselected($Var_ei_04_14_s,"ei_04_14_s",3);

markselected($Var_ei_04_14_s,"ei_04_14_s",4);

?>

                    <td valign="top">Individuele aandachtspunten</td>

                    <td valign="top" align="center"><?php print($Var_ei_04_14_t);?></td>

                </tr>

            </table>

      </div>

   </fieldset>

   <fieldset style="min-height: 400px;">

      <div class="legende">5. Psychologische ondersteuning</div>

      <div>&nbsp;</div>

      <div class="waarde">

            <table cellpadding="0" cellspacing="0">

                <tr>

                    <th align="center">&nbsp;-&nbsp;</th>

                    <th align="center">&nbsp;&plusmn;&nbsp;</th>

                    <th align="center">&nbsp;+&nbsp;</th>

                    <th align="center">&nbsp;NVT&nbsp;</th>

                    <th>Item</th>

                    <th>Bijkomende opmerkingen</th>

                </tr>

            <tr>

<?php 

markselected($Var_ei_05_01_s,"ei_05_01_s",1);

markselected($Var_ei_05_01_s,"ei_05_01_s",2);

markselected($Var_ei_05_01_s,"ei_05_01_s",3);

markselected($Var_ei_05_01_s,"ei_05_01_s",4);

?>

                    <td valign="top">Begripsvermogen / com&shy;mu&shy;ni&shy;ca&shy;tie&shy;mogelijk&shy;heden</td>

                    <td valign="top" align="center"><?php print($Var_ei_05_01_t);?></td>

                </tr>

            <tr class="verplicht">

<?php 

markselected($Var_ei_05_02_s,"ei_05_02_s",1);

markselected($Var_ei_05_02_s,"ei_05_02_s",2);

markselected($Var_ei_05_02_s,"ei_05_02_s",3);

markselected($Var_ei_05_02_s,"ei_05_02_s",4);

?>

                    <td valign="top">Bewustzijn</td>

                    <td valign="top" align="center"><?php print($Var_ei_05_02_t);?></td>

                </tr>

            <tr class="verplicht">

<?php 

markselected($Var_ei_05_03_s,"ei_05_03_s",1);

markselected($Var_ei_05_03_s,"ei_05_03_s",2);

markselected($Var_ei_05_03_s,"ei_05_03_s",3);

markselected($Var_ei_05_03_s,"ei_05_03_s",4);

?>

                    <td valign="top">Geheugen</td>

                    <td valign="top" align="center"><?php print($Var_ei_05_03_t);?></td>

                </tr>

            <tr>

<?php 

markselected($Var_ei_05_04_s,"ei_05_04_s",1);

markselected($Var_ei_05_04_s,"ei_05_04_s",2);

markselected($Var_ei_05_04_s,"ei_05_04_s",3);

markselected($Var_ei_05_04_s,"ei_05_04_s",4);

?>

                    <td valign="top">Ori&euml;ntatie in tijd</td>

                    <td valign="top" align="center"><?php print($Var_ei_05_04_t);?></td>

                </tr>

            <tr>

<?php 

markselected($Var_ei_05_05_s,"ei_05_05_s",1);

markselected($Var_ei_05_05_s,"ei_05_05_s",2);

markselected($Var_ei_05_05_s,"ei_05_05_s",3);

markselected($Var_ei_05_05_s,"ei_05_05_s",4);

?>

                    <td valign="top">Ori&euml;ntatie in ruimte</td>

                    <td valign="top" align="center"><?php print($Var_ei_05_05_t);?></td>

                </tr>

            <tr>

<?php 

markselected($Var_ei_05_06_s,"ei_05_06_s",1);

markselected($Var_ei_05_06_s,"ei_05_06_s",2);

markselected($Var_ei_05_06_s,"ei_05_06_s",3);

markselected($Var_ei_05_06_s,"ei_05_06_s",4);

?>

                    <td valign="top">Handelingen / gedragingen</td>

                    <td valign="top" align="center"><?php print($Var_ei_05_06_t);?></td>

                </tr>

            <tr>

<?php 

markselected($Var_ei_05_07_s,"ei_05_07_s",1);

markselected($Var_ei_05_07_s,"ei_05_07_s",2);

markselected($Var_ei_05_07_s,"ei_05_07_s",3);

markselected($Var_ei_05_07_s,"ei_05_07_s",4);

?>

                    <td valign="top">Stemming</td>

                    <td valign="top" align="center"><?php print($Var_ei_05_07_t);?></td>

                </tr>

            <tr>

<?php 

markselected($Var_ei_05_08_s,"ei_05_08_s",1);

markselected($Var_ei_05_08_s,"ei_05_08_s",2);

markselected($Var_ei_05_08_s,"ei_05_08_s",3);

markselected($Var_ei_05_08_s,"ei_05_08_s",4);

?>

                    <td valign="top">Inzicht in ziekte / problematiek</td>

                    <td valign="top" align="center"><?php print($Var_ei_05_08_t);?></td>

                </tr>

            <tr>

<?php 

markselected($Var_ei_05_09_s,"ei_05_09_s",1);

markselected($Var_ei_05_09_s,"ei_05_09_s",2);

markselected($Var_ei_05_09_s,"ei_05_09_s",3);

markselected($Var_ei_05_09_s,"ei_05_09_s",4);

?>

                    <td valign="top">Nood aan extra professionele begeleiding</td>

                    <td valign="top" align="center"><?php print($Var_ei_05_09_t);?></td>

                </tr>

            <tr>

<?php 

markselected($Var_ei_05_10_s,"ei_05_10_s",1);

markselected($Var_ei_05_10_s,"ei_05_10_s",2);

markselected($Var_ei_05_10_s,"ei_05_10_s",3);

markselected($Var_ei_05_10_s,"ei_05_10_s",4);

?>

                    <td valign="top">Indiv. aandachtspunten</td>

                    <td valign="top" align="center"><?php print($Var_ei_05_10_t);?></td>

                </tr>

            <tr class="verplicht">

                    <td valign="top" colspan="6" class="titel">Decorum :</td>

                </tr>

            <tr class="verplicht">

<?php 

markselected($Var_ei_05_11_s,"ei_05_11_s",1);

markselected($Var_ei_05_11_s,"ei_05_11_s",2);

markselected($Var_ei_05_11_s,"ei_05_11_s",3);

markselected($Var_ei_05_11_s,"ei_05_11_s",4);

?>

                    <td valign="top">&nbsp;&nbsp;&bull;&nbsp;Sociale regels toepassen</td>

                    <td valign="top" align="center"><?php print($Var_ei_05_11_t);?></td>

                </tr>

            <tr class="verplicht">

                    <td valign="top" colspan="4" class="begincel"></td>

                    <td valign="top" colspan="2">&nbsp;&nbsp;&bull;&nbsp;Aangaan / onderhouden</td>

                </tr> 

            <tr class="verplicht">

<?php 

markselected($Var_ei_05_12_s,"ei_05_12_s",1);

markselected($Var_ei_05_12_s,"ei_05_12_s",2);

markselected($Var_ei_05_12_s,"ei_05_12_s",3);

markselected($Var_ei_05_12_s,"ei_05_12_s",4);

?>

                    <td valign="top">&nbsp;&nbsp;&nbsp;&nbsp;&loz;&nbsp;Sociale relaties</td>

                    <td valign="top" align="center"><?php print($Var_ei_05_12_t);?></td>

                </tr>

            <tr class="verplicht">

<?php 

markselected($Var_ei_05_13_s,"ei_05_13_s",1);

markselected($Var_ei_05_13_s,"ei_05_13_s",2);

markselected($Var_ei_05_13_s,"ei_05_13_s",3);

markselected($Var_ei_05_13_s,"ei_05_13_s",4);

?>

                    <td valign="top">&nbsp;&nbsp;&nbsp;&nbsp;&loz;&nbsp;Familiale relaties</td>

                    <td valign="top" align="center"><?php print($Var_ei_05_13_t);?></td>

                </tr>

            <tr class="verplicht">

<?php 

markselected($Var_ei_05_14_s,"ei_05_14_s",1);

markselected($Var_ei_05_14_s,"ei_05_14_s",2);

markselected($Var_ei_05_14_s,"ei_05_14_s",3);

markselected($Var_ei_05_14_s,"ei_05_14_s",4);

?>

                    <td valign="top">&nbsp;&nbsp;&nbsp;&nbsp;&loz;&nbsp;Relaties medebewoners</td>

                    <td valign="top" align="center"><?php print($Var_ei_05_14_t);?></td>

                </tr>

            </table>

      </div>

   </fieldset>

   <fieldset style="min-height: 360px;">

      <div class="legende">6. (Ped)agogische ondersteuning</div>

      <div>&nbsp;</div>

      <div class="waarde">

            <table cellpadding="0" cellspacing="0">

                <tr>

                    <th align="center">&nbsp;-&nbsp;</th>

                    <th align="center">&nbsp;&plusmn;&nbsp;</th>

                    <th align="center">&nbsp;+&nbsp;</th>

                    <th align="center">&nbsp;NVT&nbsp;</th>

                    <th>Item</th>

                    <th>Bijkomende opmerkingen</th>

                </tr>

            <tr>

                    <td valign="top" colspan="6" class="titel">School :</td>

                </tr>

            <tr>

<?php 

markselected($Var_ei_06_01_s,"ei_06_01_s",1);

markselected($Var_ei_06_01_s,"ei_06_01_s",2);

markselected($Var_ei_06_01_s,"ei_06_01_s",3);

markselected($Var_ei_06_01_s,"ei_06_01_s",4);

?>

                    <td valign="top">&nbsp;&nbsp;&bull;&nbsp;Aanwezigheid</td>

                    <td valign="top" align="center"><?php print($Var_ei_06_01_t);?></td>

                </tr>

            <tr>

<?php 

markselected($Var_ei_06_02_s,"ei_06_02_s",1);

markselected($Var_ei_06_02_s,"ei_06_02_s",2);

markselected($Var_ei_06_02_s,"ei_06_02_s",3);

markselected($Var_ei_06_02_s,"ei_06_02_s",4);

?>

                    <td valign="top">&nbsp;&nbsp;&bull;&nbsp;Huiswerk</td>

                    <td valign="top" align="center"><?php print($Var_ei_06_02_t);?></td>

                </tr>

            <tr>

<?php 

markselected($Var_ei_06_03_s,"ei_06_03_s",1);

markselected($Var_ei_06_03_s,"ei_06_03_s",2);

markselected($Var_ei_06_03_s,"ei_06_03_s",3);

markselected($Var_ei_06_03_s,"ei_06_03_s",4);

?>

                    <td valign="top">&nbsp;&nbsp;&bull;&nbsp;Leerproblemen</td>

                    <td valign="top" align="center"><?php print($Var_ei_06_03_t);?></td>

                </tr>

            <tr>

                    <td valign="top" colspan="6">&nbsp;</td>

                </tr>

            <tr>

<?php 

markselected($Var_ei_06_04_s,"ei_06_04_s",1);

markselected($Var_ei_06_04_s,"ei_06_04_s",2);

markselected($Var_ei_06_04_s,"ei_06_04_s",3);

markselected($Var_ei_06_04_s,"ei_06_04_s",4);

?>

                    <td valign="top">Werk</td>

                    <td valign="top" align="center"><?php print($Var_ei_06_04_t);?></td>

                </tr>

            <tr class="verplicht">

                    <td valign="top" colspan="6" class="titel">Recreatie: deelname aan activiteiten :</td>

                </tr>

            <tr class="verplicht">

<?php 

markselected($Var_ei_06_05_s,"ei_06_05_s",1);

markselected($Var_ei_06_05_s,"ei_06_05_s",2);

markselected($Var_ei_06_05_s,"ei_06_05_s",3);

markselected($Var_ei_06_05_s,"ei_06_05_s",4);

?>

                    <td valign="top">&nbsp;&nbsp;&bull;&nbsp;Binnenhuis</td>

                    <td valign="top" align="center"><?php print($Var_ei_06_05_t);?></td>

                </tr>

            <tr class="verplicht">

<?php 

markselected($Var_ei_06_06_s,"ei_06_06_s",1);

markselected($Var_ei_06_06_s,"ei_06_06_s",2);

markselected($Var_ei_06_06_s,"ei_06_06_s",3);

markselected($Var_ei_06_06_s,"ei_06_06_s",4);

?>

                    <td valign="top">&nbsp;&nbsp;&bull;&nbsp;Buitenhuis</td>

                    <td valign="top" align="center"><?php print($Var_ei_06_06_t);?></td>

                </tr>

            <tr>

                    <td valign="top" colspan="6">&nbsp;</td>

                </tr>

            <tr class="verplicht">

<?php 

markselected($Var_ei_06_07_s,"ei_06_07_s",1);

markselected($Var_ei_06_07_s,"ei_06_07_s",2);

markselected($Var_ei_06_07_s,"ei_06_07_s",3);

markselected($Var_ei_06_07_s,"ei_06_07_s",4);

?>

                    <td valign="top">Eventuele bezoekregeling(en)</td>

                    <td valign="top" align="center"><?php print($Var_ei_06_07_t);?></td>

                </tr>

            <tr>

<?php 

markselected($Var_ei_06_08_s,"ei_06_08_s",1);

markselected($Var_ei_06_08_s,"ei_06_08_s",2);

markselected($Var_ei_06_08_s,"ei_06_08_s",3);

markselected($Var_ei_06_08_s,"ei_06_08_s",4);

?>

                    <td valign="top">Problematische handelingen of gedragingen</td>

                    <td valign="top" align="center"><?php print($Var_ei_06_08_t);?></td>

                </tr>

            <tr>

<?php 

markselected($Var_ei_06_09_s,"ei_06_09_s",1);

markselected($Var_ei_06_09_s,"ei_06_09_s",2);

markselected($Var_ei_06_09_s,"ei_06_09_s",3);

markselected($Var_ei_06_09_s,"ei_06_09_s",4);

?>

                    <td valign="top">Verslavingsproblematiek</td>

                    <td valign="top" align="center"><?php print($Var_ei_06_09_t);?></td>

                </tr>

            <tr>

<?php 

markselected($Var_ei_06_10_s,"ei_06_10_s",1);

markselected($Var_ei_06_10_s,"ei_06_10_s",2);

markselected($Var_ei_06_10_s,"ei_06_10_s",3);

markselected($Var_ei_06_10_s,"ei_06_10_s",4);

?>

                    <td valign="top">Nood aan extra professionele begeleiding</td>

                    <td valign="top" align="center"><?php print($Var_ei_06_10_t);?></td>

                </tr>

            <tr>

<?php 

markselected($Var_ei_06_11_s,"ei_06_11_s",1);

markselected($Var_ei_06_11_s,"ei_06_11_s",2);

markselected($Var_ei_06_11_s,"ei_06_11_s",3);

markselected($Var_ei_06_11_s,"ei_06_11_s",4);

?>

                    <td valign="top">Individule aandachtspunten</td>

                    <td valign="top" align="center"><?php print($Var_ei_06_11_t);?></td>

                </tr>

            </table>

      </div>

   </fieldset>

   <fieldset style="min-height: 280px;">

      <div class="legende">7. Sociale ondersteuning</div>

      <div>&nbsp;</div>

      <div class="waarde">

            <table cellpadding="0" cellspacing="0">

                <tr>

                    <th align="center">&nbsp;-&nbsp;</th>

                    <th align="center">&nbsp;&plusmn;&nbsp;</th>

                    <th align="center">&nbsp;+&nbsp;</th>

                    <th align="center">&nbsp;NVT&nbsp;</th>

                    <th>Item</th>

                    <th>Bijkomende opmerkingen</th>

                </tr>

            <tr class="verplicht">

<?php 

markselected($Var_ei_07_01_s,"ei_07_01_s",1);

markselected($Var_ei_07_01_s,"ei_07_01_s",2);

markselected($Var_ei_07_01_s,"ei_07_01_s",3);

markselected($Var_ei_07_01_s,"ei_07_01_s",4);

?>

                    <td valign="top">Naaste familie</td>

                    <td valign="top" align="center"><?php print($Var_ei_07_01_t);?></td>

                </tr>

            <tr class="verplicht">

<?php 

markselected($Var_ei_07_02_s,"ei_07_02_s",1);

markselected($Var_ei_07_02_s,"ei_07_02_s",2);

markselected($Var_ei_07_02_s,"ei_07_02_s",3);

markselected($Var_ei_07_02_s,"ei_07_02_s",4);

?>

                    <td valign="top">Verre familie</td>

                    <td valign="top" align="center"><?php print($Var_ei_07_02_t);?></td>

                </tr>

            <tr class="verplicht">

<?php 

markselected($Var_ei_07_03_s,"ei_07_03_s",1);

markselected($Var_ei_07_03_s,"ei_07_03_s",2);

markselected($Var_ei_07_03_s,"ei_07_03_s",3);

markselected($Var_ei_07_03_s,"ei_07_03_s",4);

?>

                    <td valign="top">Vrienden</td>

                    <td valign="top" align="center"><?php print($Var_ei_07_03_t);?></td>

                </tr>

            <tr class="verplicht">

                    <td valign="top" colspan="6" class="titel">Persoonlijke verzorgers en assistenten (incl. vrijwilligers)</td>

                </tr>

            <tr class="verplicht">

<?php 

markselected($Var_ei_07_04_s,"ei_07_04_s",1);

markselected($Var_ei_07_04_s,"ei_07_04_s",2);

markselected($Var_ei_07_04_s,"ei_07_04_s",3);

markselected($Var_ei_07_04_s,"ei_07_04_s",4);

?>

                    <td valign="top">&nbsp;&nbsp;&bull;&nbsp;Aan huis</td>

                    <td valign="top" align="center"><?php print($Var_ei_07_04_t);?></td>

                </tr>

            <tr class="verplicht">

<?php 

markselected($Var_ei_07_05_s,"ei_07_05_s",1);

markselected($Var_ei_07_05_s,"ei_07_05_s",2);

markselected($Var_ei_07_05_s,"ei_07_05_s",3);

markselected($Var_ei_07_05_s,"ei_07_05_s",4);

?>

                    <td valign="top">&nbsp;&nbsp;&bull;&nbsp;Buitenhuis</td>

                    <td valign="top" align="center"><?php print($Var_ei_07_05_t);?></td>

                </tr>

            <tr class="verplicht">

                    <td valign="top" colspan="6" class="titel">Hulpverleners in de gezondheidszorg</td>

                </tr>

            <tr class="verplicht">

<?php 

markselected($Var_ei_07_06_s,"ei_07_06_s",1);

markselected($Var_ei_07_06_s,"ei_07_06_s",2);

markselected($Var_ei_07_06_s,"ei_07_06_s",3);

markselected($Var_ei_07_06_s,"ei_07_06_s",4);

?>

                    <td valign="top">&nbsp;&nbsp;&bull;&nbsp;Aan huis</td>

                    <td valign="top" align="center"><?php print($Var_ei_07_06_t);?></td>

                </tr>

            <tr class="verplicht">

<?php 

markselected($Var_ei_07_07_s,"ei_07_07_s",1);

markselected($Var_ei_07_07_s,"ei_07_07_s",2);

markselected($Var_ei_07_07_s,"ei_07_07_s",3);

markselected($Var_ei_07_07_s,"ei_07_07_s",4);

?>

                    <td valign="top">&nbsp;&nbsp;&bull;&nbsp;Buitenhuis</td>

                    <td valign="top" align="center"><?php print($Var_ei_07_07_t);?></td>

                </tr>

            <tr>

                    <td valign="top" colspan="6">&nbsp;</td>

                </tr>

            <tr>

<?php 

markselected($Var_ei_07_08_s,"ei_07_08_s",1);

markselected($Var_ei_07_08_s,"ei_07_08_s",2);

markselected($Var_ei_07_08_s,"ei_07_08_s",3);

markselected($Var_ei_07_08_s,"ei_07_08_s",4);

?>

                    <td valign="top">Individuele aandachtspunten</td>

                    <td valign="top" align="center"><?php print($Var_ei_07_08_t);?></td>

                </tr>

            </table>

      </div>

   </fieldset>

   <fieldset style="min-height: 470px;">

      <div class="legende">8.1. Financi&euml;le ondersteuning</div>

      <div>&nbsp;</div>

      <div class="waarde">

            <table cellpadding="0" cellspacing="0">

                <tr>

                    <th align="center">&nbsp;-&nbsp;</th>

                    <th align="center">&nbsp;&plusmn;&nbsp;</th>

                    <th align="center">&nbsp;+&nbsp;</th>

                    <th align="center">&nbsp;NVT&nbsp;</th>

                    <th>Item</th>

                    <th>Bijkomende opmerkingen</th>

                </tr>

            <tr>

<?php 

markselected($Var_ei_081_01_s,"ei_081_01_s",1);

markselected($Var_ei_081_01_s,"ei_081_01_s",2);

markselected($Var_ei_081_01_s,"ei_081_01_s",3);

markselected($Var_ei_081_01_s,"ei_081_01_s",4);

?>

                    <td valign="top">Vergoedingen / tussenkomsten<br />nationaal, provinciaal, gemeentelijk</td>

                    <td valign="top" align="center"><?php print($Var_ei_081_01_t);?></td>

                </tr>

            <tr>

<?php 

markselected($Var_ei_081_02_s,"ei_081_02_s",1);

markselected($Var_ei_081_02_s,"ei_081_02_s",2);

markselected($Var_ei_081_02_s,"ei_081_02_s",3);

markselected($Var_ei_081_02_s,"ei_081_02_s",4);

?>

                    <td valign="top">Hulp aan bejaarden</td>

                    <td valign="top" align="center"><?php print($Var_ei_081_02_t);?></td>

                </tr>

            <tr>

<?php 

markselected($Var_ei_081_03_s,"ei_081_03_s",1);

markselected($Var_ei_081_03_s,"ei_081_03_s",2);

markselected($Var_ei_081_03_s,"ei_081_03_s",3);

markselected($Var_ei_081_03_s,"ei_081_03_s",4);

?>

                    <td valign="top">Kankerfonds</td>

                    <td valign="top" align="center"><?php print($Var_ei_081_03_t);?></td>

                </tr>

            <tr>

<?php 

markselected($Var_ei_081_04_s,"ei_081_04_s",1);

markselected($Var_ei_081_04_s,"ei_081_04_s",2);

markselected($Var_ei_081_04_s,"ei_081_04_s",3);

markselected($Var_ei_081_04_s,"ei_081_04_s",4);

?>

                    <td valign="top">Kine: tussenkomst voor zware pathologie&euml;n</td>

                    <td valign="top" align="center"><?php print($Var_ei_081_04_t);?></td>

                </tr>

            <tr>

<?php 

markselected($Var_ei_081_05_s,"ei_081_05_s",1);

markselected($Var_ei_081_05_s,"ei_081_05_s",2);

markselected($Var_ei_081_05_s,"ei_081_05_s",3);

markselected($Var_ei_081_05_s,"ei_081_05_s",4);

?>

                    <td valign="top">Mantelzorgtoelage</td>

                    <td valign="top" align="center"><?php print($Var_ei_081_05_t);?></td>

                </tr>

            <tr>

<?php 

markselected($Var_ei_081_06_s,"ei_081_06_s",1);

markselected($Var_ei_081_06_s,"ei_081_06_s",2);

markselected($Var_ei_081_06_s,"ei_081_06_s",3);

markselected($Var_ei_081_06_s,"ei_081_06_s",4);

?>

                    <td valign="top">Parkeerkaart</td>

                    <td valign="top" align="center"><?php print($Var_ei_081_06_t);?></td>

                </tr>

            <tr>

<?php 

markselected($Var_ei_081_07_s,"ei_081_07_s",1);

markselected($Var_ei_081_07_s,"ei_081_07_s",2);

markselected($Var_ei_081_07_s,"ei_081_07_s",3);

markselected($Var_ei_081_07_s,"ei_081_07_s",4);

?>

                    <td valign="top">Sociaal telefoontarief</td>

                    <td valign="top" align="center"><?php print($Var_ei_081_07_t);?></td>

                </tr>

            <tr>

<?php 

markselected($Var_ei_081_08_s,"ei_081_08_s",1);

markselected($Var_ei_081_08_s,"ei_081_08_s",2);

markselected($Var_ei_081_08_s,"ei_081_08_s",3);

markselected($Var_ei_081_08_s,"ei_081_08_s",4);

?>

                    <td valign="top">Vermindering Kabel TV</td>

                    <td valign="top" align="center"><?php print($Var_ei_081_08_t);?></td>

                </tr>

            <tr>

<?php 

markselected($Var_ei_081_09_s,"ei_081_09_s",1);

markselected($Var_ei_081_09_s,"ei_081_09_s",2);

markselected($Var_ei_081_09_s,"ei_081_09_s",3);

markselected($Var_ei_081_09_s,"ei_081_09_s",4);

?>

                    <td valign="top">Vlaams Fonds</td>

                    <td valign="top" align="center"><?php print($Var_ei_081_09_t);?></td>

                </tr>

            <tr>

<?php 

markselected($Var_ei_081_10_s,"ei_081_10_s",1);

markselected($Var_ei_081_10_s,"ei_081_10_s",2);

markselected($Var_ei_081_10_s,"ei_081_10_s",3);

markselected($Var_ei_081_10_s,"ei_081_10_s",4);

?>

                    <td valign="top">WIGW-Statuut</td>

                    <td valign="top" align="center"><?php print($Var_ei_081_10_t);?></td>

                </tr>

            <tr>

<?php 

markselected($Var_ei_081_11_s,"ei_081_11_s",1);

markselected($Var_ei_081_11_s,"ei_081_11_s",2);

markselected($Var_ei_081_11_s,"ei_081_11_s",3);

markselected($Var_ei_081_11_s,"ei_081_11_s",4);

?>

                    <td valign="top">Zorgverzekering</td>

                    <td valign="top" align="center"><?php print($Var_ei_081_11_t);?></td>

                </tr>

            <tr>

<?php 

markselected($Var_ei_081_12_s,"ei_081_12_s",1);

markselected($Var_ei_081_12_s,"ei_081_12_s",2);

markselected($Var_ei_081_12_s,"ei_081_12_s",3);

markselected($Var_ei_081_12_s,"ei_081_12_s",4);

?>

                    <td valign="top">Tussenkomst voor incontinentiemateriaal</td>

                    <td valign="top" align="center"><?php print($Var_ei_081_12_t);?></td>

                </tr>

            <tr>

<?php 

markselected($Var_ei_081_13_s,"ei_081_13_s",1);

markselected($Var_ei_081_13_s,"ei_081_13_s",2);

markselected($Var_ei_081_13_s,"ei_081_13_s",3);

markselected($Var_ei_081_13_s,"ei_081_13_s",4);

?>

                    <td valign="top">Tussenkomst voor palliatieve zorg</td>

                    <td valign="top" align="center"><?php print($Var_ei_081_13_t);?></td>

                </tr>

            <tr>

<?php 

markselected($Var_ei_081_14_s,"ei_081_14_s",1);

markselected($Var_ei_081_14_s,"ei_081_14_s",2);

markselected($Var_ei_081_14_s,"ei_081_14_s",3);

markselected($Var_ei_081_14_s,"ei_081_14_s",4);

?>

                    <td valign="top">Tussenkomst voor rolstoel</td>

                    <td valign="top" align="center"><?php print($Var_ei_081_14_t);?></td>

                </tr>

            <tr>

<?php 

markselected($Var_ei_081_15_s,"ei_081_15_s",1);

markselected($Var_ei_081_15_s,"ei_081_15_s",2);

markselected($Var_ei_081_15_s,"ei_081_15_s",3);

markselected($Var_ei_081_15_s,"ei_081_15_s",4);

?>

                    <td valign="top">Tussenkomst voor prothesen</td>

                    <td valign="top" align="center"><?php print($Var_ei_081_15_t);?></td>

                </tr>

            <tr>

<?php 

markselected($Var_ei_081_16_s,"ei_081_16_s",1);

markselected($Var_ei_081_16_s,"ei_081_16_s",2);

markselected($Var_ei_081_16_s,"ei_081_16_s",3);

markselected($Var_ei_081_16_s,"ei_081_16_s",4);

?>

                    <td valign="top">Tussenkomst voor medische kosten, medicatie</td>

                    <td valign="top" align="center"><?php print($Var_ei_081_16_t);?></td>

                </tr>

            <tr>

<?php 

markselected($Var_ei_081_17_s,"ei_081_17_s",1);

markselected($Var_ei_081_17_s,"ei_081_17_s",2);

markselected($Var_ei_081_17_s,"ei_081_17_s",3);

markselected($Var_ei_081_17_s,"ei_081_17_s",4);

?>

                    <td valign="top">Tussenkomst voor water / elektriciteit</td>

                    <td valign="top" align="center"><?php print($Var_ei_081_17_t);?></td>

                </tr>

            <tr>

<?php 

markselected($Var_ei_081_18_s,"ei_081_18_s",1);

markselected($Var_ei_081_18_s,"ei_081_18_s",2);

markselected($Var_ei_081_18_s,"ei_081_18_s",3);

markselected($Var_ei_081_18_s,"ei_081_18_s",4);

?>

                    <td valign="top">Tussenkomst voor vuilniszakken</td>

                    <td valign="top" align="center"><?php print($Var_ei_081_18_t);?></td>

                </tr>

            <tr>

<?php 

markselected($Var_ei_081_19_s,"ei_081_19_s",1);

markselected($Var_ei_081_19_s,"ei_081_19_s",2);

markselected($Var_ei_081_19_s,"ei_081_19_s",3);

markselected($Var_ei_081_19_s,"ei_081_19_s",4);

?>

                    <td valign="top">Tussenkomst voor ............</td>

                    <td valign="top" align="center"><?php print($Var_ei_081_19_t);?></td>

                </tr>

            </table>

      </div>

   </fieldset>

   <fieldset style="min-height: 710px;">

      <div class="legende">8.2. Hulpmiddelen: producten en technologie <br/>voor persoonlijk gebruik dagelijks leven</div>

      <div>&nbsp;</div>

      <div class="waarde">

            <table cellpadding="0" cellspacing="0">

                <tr>

                    <th valign="top" align="center">&nbsp;-&nbsp;</th>

                    <th valign="top" align="center">&nbsp;&plusmn;&nbsp;</th>

                    <th valign="top" align="center">&nbsp;+&nbsp;</th>

                    <th valign="top" align="center">&nbsp;NVT&nbsp;</th>

                    <th valign="top">Item</th>

                    <th valign="top">Bijkomende opmerkingen</th>

                </tr>

            <tr class="verplicht">

                    <td valign="top" valign="top" colspan="6" class="titel">Slapen / Rusten</td>

                </tr>

            <tr class="verplicht">

<?php 

markselected($Var_ei_082_01_s,"ei_082_01_s",1);

markselected($Var_ei_082_01_s,"ei_082_01_s",2);

markselected($Var_ei_082_01_s,"ei_082_01_s",3);

markselected($Var_ei_082_01_s,"ei_082_01_s",4);

?>

                    <td valign="top" valign="top">&nbsp;&nbsp;&bull;&nbsp;Speciale matras (gel, vezel)</td>

                    <td valign="top" valign="top" align="center"><?php print($Var_ei_082_01_t);?></td>

                </tr>

            <tr class="verplicht">

<?php 

markselected($Var_ei_082_02_s,"ei_082_02_s",1);

markselected($Var_ei_082_02_s,"ei_082_02_s",2);

markselected($Var_ei_082_02_s,"ei_082_02_s",3);

markselected($Var_ei_082_02_s,"ei_082_02_s",4);

?>

                    <td valign="top" valign="top">&nbsp;&nbsp;&bull;&nbsp;Decubitusmateriaal</td>

                    <td valign="top" valign="top" align="center"><?php print($Var_ei_082_02_t);?></td>

                </tr>

            <tr class="verplicht">

<?php 

markselected($Var_ei_082_03_s,"ei_082_03_s",1);

markselected($Var_ei_082_03_s,"ei_082_03_s",2);

markselected($Var_ei_082_03_s,"ei_082_03_s",3);

markselected($Var_ei_082_03_s,"ei_082_03_s",4);

?>

                    <td valign="top" valign="top">&nbsp;&nbsp;&bull;&nbsp;Bed / zijsponden</td>

                    <td valign="top" valign="top" align="center"><?php print($Var_ei_082_03_t);?></td>

                </tr>

            <tr class="verplicht">

<?php 

markselected($Var_ei_082_04_s,"ei_082_04_s",1);

markselected($Var_ei_082_04_s,"ei_082_04_s",2);

markselected($Var_ei_082_04_s,"ei_082_04_s",3);

markselected($Var_ei_082_04_s,"ei_082_04_s",4);

?>

                    <td valign="top" valign="top">&nbsp;&nbsp;&bull;&nbsp;Bedtafel</td>

                    <td valign="top" valign="top" align="center"><?php print($Var_ei_082_04_t);?></td>

                </tr>

            <tr class="verplicht">

<?php 

markselected($Var_ei_082_05_s,"ei_082_05_s",1);

markselected($Var_ei_082_05_s,"ei_082_05_s",2);

markselected($Var_ei_082_05_s,"ei_082_05_s",3);

markselected($Var_ei_082_05_s,"ei_082_05_s",4);

?>

                <td valign="top" valign="top">&nbsp;&nbsp;&bull;&nbsp;Bedverhoger</td>

                    <td valign="top" valign="top" align="center"><?php print($Var_ei_082_05_t);?></td>

                </tr>

            <tr class="verplicht">

<?php 

markselected($Var_ei_082_06_s,"ei_082_06_s",1);

markselected($Var_ei_082_06_s,"ei_082_06_s",2);

markselected($Var_ei_082_06_s,"ei_082_06_s",3);

markselected($Var_ei_082_06_s,"ei_082_06_s",4);

?>

                    <td valign="top" valign="top">&nbsp;&nbsp;&bull;&nbsp;Oprichter</td>

                    <td valign="top" valign="top" align="center"><?php print($Var_ei_082_06_t);?></td>

                </tr>

            <tr class="verplicht">

<?php 

markselected($Var_ei_082_07_s,"ei_082_07_s",1);

markselected($Var_ei_082_07_s,"ei_082_07_s",2);

markselected($Var_ei_082_07_s,"ei_082_07_s",3);

markselected($Var_ei_082_07_s,"ei_082_07_s",4);

?>

                    <td valign="top" valign="top">&nbsp;&nbsp;&bull;&nbsp;Rugsteun</td>

                    <td valign="top" valign="top" align="center"><?php print($Var_ei_082_07_t);?></td>

                </tr>

            <tr class="verplicht">

<?php 

markselected($Var_ei_082_08_s,"ei_082_08_s",1);

markselected($Var_ei_082_08_s,"ei_082_08_s",2);

markselected($Var_ei_082_08_s,"ei_082_08_s",3);

markselected($Var_ei_082_08_s,"ei_082_08_s",4);

?>

                    <td valign="top" valign="top">&nbsp;&nbsp;&bull;&nbsp;Fixatiegordel</td>

                    <td valign="top" valign="top" align="center"><?php print($Var_ei_082_08_t);?></td>

                </tr>

            <tr>

<?php 

markselected($Var_ei_082_09_s,"ei_082_09_s",1);

markselected($Var_ei_082_09_s,"ei_082_09_s",2);

markselected($Var_ei_082_09_s,"ei_082_09_s",3);

markselected($Var_ei_082_09_s,"ei_082_09_s",4);

?>

                    <td valign="top" valign="top">&nbsp;&nbsp;&bull;&nbsp;Overige ...</td>

                    <td valign="top" valign="top" align="center"><?php print($Var_ei_082_09_t);?></td>

                </tr>

            <tr class="verplicht">

                    <td valign="top" colspan="6" class="titel">Verplaatsen</td>

                </tr>

            <tr class="verplicht">

<?php 

markselected($Var_ei_082_10_s,"ei_082_10_s",1);

markselected($Var_ei_082_10_s,"ei_082_10_s",2);

markselected($Var_ei_082_10_s,"ei_082_10_s",3);

markselected($Var_ei_082_10_s,"ei_082_10_s",4);

?>

                    <td valign="top" valign="top">&nbsp;&nbsp;&bull;&nbsp;Tillift</td>

                    <td valign="top" valign="top" align="center"><?php print($Var_ei_082_10_t);?></td>

                </tr>

            <tr class="verplicht">

<?php 

markselected($Var_ei_082_11_s,"ei_082_11_s",1);

markselected($Var_ei_082_11_s,"ei_082_11_s",2);

markselected($Var_ei_082_11_s,"ei_082_11_s",3);

markselected($Var_ei_082_11_s,"ei_082_11_s",4);

?>

                    <td valign="top" valign="top">&nbsp;&nbsp;&bull;&nbsp;Rolstoel</td>

                    <td valign="top" valign="top" align="center"><?php print($Var_ei_082_11_t);?></td>

                </tr>

            <tr class="verplicht">

<?php 

markselected($Var_ei_082_12_s,"ei_082_12_s",1);

markselected($Var_ei_082_12_s,"ei_082_12_s",2);

markselected($Var_ei_082_12_s,"ei_082_12_s",3);

markselected($Var_ei_082_12_s,"ei_082_12_s",4);

?>

                    <td valign="top" valign="top">&nbsp;&nbsp;&bull;&nbsp;Gaankader</td>

                    <td valign="top" valign="top" align="center"><?php print($Var_ei_082_12_t);?></td>

                </tr>

            <tr class="verplicht">

<?php 

markselected($Var_ei_082_13_s,"ei_082_13_s",1);

markselected($Var_ei_082_13_s,"ei_082_13_s",2);

markselected($Var_ei_082_13_s,"ei_082_13_s",3);

markselected($Var_ei_082_13_s,"ei_082_13_s",4);

?>

                    <td valign="top" valign="top">&nbsp;&nbsp;&bull;&nbsp;Vierpikkel / kruk</td>

                    <td valign="top" valign="top" align="center"><?php print($Var_ei_082_13_t);?></td>

                </tr>

            <tr class="verplicht">

<?php 

markselected($Var_ei_082_14_s,"ei_082_14_s",1);

markselected($Var_ei_082_14_s,"ei_082_14_s",2);

markselected($Var_ei_082_14_s,"ei_082_14_s",3);

markselected($Var_ei_082_14_s,"ei_082_14_s",4);

?>

                    <td valign="top" valign="top">&nbsp;&nbsp;&bull;&nbsp;Wandelstok</td>

                    <td valign="top" valign="top" align="center"><?php print($Var_ei_082_14_t);?></td>

                </tr>

            <tr>

<?php 

markselected($Var_ei_082_15_s,"ei_082_15_s",1);

markselected($Var_ei_082_15_s,"ei_082_15_s",2);

markselected($Var_ei_082_15_s,"ei_082_15_s",3);

markselected($Var_ei_082_15_s,"ei_082_15_s",4);

?>

                    <td valign="top" valign="top">&nbsp;&nbsp;&bull;&nbsp;Overige ...</td>

                    <td valign="top" valign="top" align="center"><?php print($Var_ei_082_15_t);?></td>

                </tr>

            <tr class="verplicht">

                    <td valign="top" colspan="6" class="titel">Toiletbezoek / incontinentie :</td>

                </tr>

            <tr class="verplicht">

<?php 

markselected($Var_ei_082_16_s,"ei_082_16_s",1);

markselected($Var_ei_082_16_s,"ei_082_16_s",2);

markselected($Var_ei_082_16_s,"ei_082_16_s",3);

markselected($Var_ei_082_16_s,"ei_082_16_s",4);

?>

                    <td valign="top" valign="top">&nbsp;&nbsp;&bull;&nbsp;Sonde / stoma</td>

                    <td valign="top" valign="top" align="center"><?php print($Var_ei_082_16_t);?></td>

                </tr>

            <tr class="verplicht">

<?php 

markselected($Var_ei_082_17_s,"ei_082_17_s",1);

markselected($Var_ei_082_17_s,"ei_082_17_s",2);

markselected($Var_ei_082_17_s,"ei_082_17_s",3);

markselected($Var_ei_082_17_s,"ei_082_17_s",4);

?>

                    <td valign="top" valign="top">&nbsp;&nbsp;&bull;&nbsp;Urinaal / bedpan</td>

                    <td valign="top" valign="top" align="center"><?php print($Var_ei_082_17_t);?></td>

                </tr>

            <tr class="verplicht">

<?php 

markselected($Var_ei_082_18_s,"ei_082_18_s",1);

markselected($Var_ei_082_18_s,"ei_082_18_s",2);

markselected($Var_ei_082_18_s,"ei_082_18_s",3);

markselected($Var_ei_082_18_s,"ei_082_18_s",4);

?>

                    <td valign="top" valign="top">&nbsp;&nbsp;&bull;&nbsp;WC-stoel</td>

                    <td valign="top" valign="top" align="center"><?php print($Var_ei_082_18_t);?></td>

                </tr>

            <tr class="verplicht">

<?php 

markselected($Var_ei_082_19_s,"ei_082_19_s",1);

markselected($Var_ei_082_19_s,"ei_082_19_s",2);

markselected($Var_ei_082_19_s,"ei_082_19_s",3);

markselected($Var_ei_082_19_s,"ei_082_19_s",4);

?>

                    <td valign="top" valign="top">&nbsp;&nbsp;&bull;&nbsp;WC-verhoger</td>

                    <td valign="top" valign="top" align="center"><?php print($Var_ei_082_19_t);?></td>

                </tr>

            <tr class="verplicht">

<?php 

markselected($Var_ei_082_20_s,"ei_082_20_s",1);

markselected($Var_ei_082_20_s,"ei_082_20_s",2);

markselected($Var_ei_082_20_s,"ei_082_20_s",3);

markselected($Var_ei_082_20_s,"ei_082_20_s",4);

?>

                    <td valign="top" valign="top">&nbsp;&nbsp;&bull;&nbsp;Grijpstaven</td>

                    <td valign="top" valign="top" align="center"><?php print($Var_ei_082_20_t);?></td>

                </tr>

            <tr class="verplicht">

<?php 

markselected($Var_ei_082_21_s,"ei_082_21_s",1);

markselected($Var_ei_082_21_s,"ei_082_21_s",2);

markselected($Var_ei_082_21_s,"ei_082_21_s",3);

markselected($Var_ei_082_21_s,"ei_082_21_s",4);

?>

                    <td valign="top" valign="top" rowspan="2">&nbsp;&nbsp;&bull;&nbsp;Incontinentiemateriaal<br />

                    &nbsp;&nbsp;&nbsp;&nbsp;(onderleggers, luiers,<br/>

                    &nbsp;&nbsp;&nbsp;&nbsp;conveen, broekjes)</td>

                    <td valign="top" valign="top" align="center"><?php print($Var_ei_082_21_t);?></td>

                </tr>

            <tr class="verplicht">

                    <td valign="top" valign="top" class="begincel" colspan="4"></td>

                    <td valign="top" valign="top" align="center"></td>

                </tr>

            <tr>

<?php 

markselected($Var_ei_082_22_s,"ei_082_22_s",1);

markselected($Var_ei_082_22_s,"ei_082_22_s",2);

markselected($Var_ei_082_22_s,"ei_082_22_s",3);

markselected($Var_ei_082_22_s,"ei_082_22_s",4);

?>

                    <td valign="top" valign="top">&nbsp;&nbsp;&bull;&nbsp;Overige ...</td>

                    <td valign="top" valign="top" align="center"><?php print($Var_ei_082_22_t);?></td>

                </tr>

            <tr>

                    <td valign="top" colspan="6" class="titel">Specifieke hulpmiddelen :</td>

                </tr>

            <tr>

<?php 

markselected($Var_ei_082_23_s,"ei_082_23_s",1);

markselected($Var_ei_082_23_s,"ei_082_23_s",2);

markselected($Var_ei_082_23_s,"ei_082_23_s",3);

markselected($Var_ei_082_23_s,"ei_082_23_s",4);

?>

                    <td valign="top" valign="top">&nbsp;&nbsp;&bull;&nbsp;Eten</td>

                    <td valign="top" valign="top" align="center"><?php print($Var_ei_082_23_t);?></td>

                </tr>

            <tr>

<?php 

markselected($Var_ei_082_24_s,"ei_082_24_s",1);

markselected($Var_ei_082_24_s,"ei_082_24_s",2);

markselected($Var_ei_082_24_s,"ei_082_24_s",3);

markselected($Var_ei_082_24_s,"ei_082_24_s",4);

?>

                    <td valign="top" valign="top">&nbsp;&nbsp;&bull;&nbsp;Kleden</td>

                    <td valign="top" valign="top" align="center"><?php print($Var_ei_082_24_t);?></td>

                </tr>

            <tr>

<?php 

markselected($Var_ei_082_25_s,"ei_082_25_s",1);

markselected($Var_ei_082_25_s,"ei_082_25_s",2);

markselected($Var_ei_082_25_s,"ei_082_25_s",3);

markselected($Var_ei_082_25_s,"ei_082_25_s",4);

?>

                    <td valign="top" valign="top">&nbsp;&nbsp;&bull;&nbsp;Vrijetijdsbesteding</td>

                    <td valign="top" valign="top" align="center"><?php print($Var_ei_082_25_t);?></td>

                </tr>

            <tr>

<?php 

markselected($Var_ei_082_26_s,"ei_082_26_s",1);

markselected($Var_ei_082_26_s,"ei_082_26_s",2);

markselected($Var_ei_082_26_s,"ei_082_26_s",3);

markselected($Var_ei_082_26_s,"ei_082_26_s",4);

?>

                    <td valign="top" valign="top">&nbsp;&nbsp;&bull;&nbsp;Overige ...</td>

                    <td valign="top" valign="top" align="center"><?php print($Var_ei_082_26_t);?></td>

                </tr>

            <tr>

<?php 

markselected($Var_ei_082_27_s,"ei_082_27_s",1);

markselected($Var_ei_082_27_s,"ei_082_27_s",2);

markselected($Var_ei_082_27_s,"ei_082_27_s",3);

markselected($Var_ei_082_27_s,"ei_082_27_s",4);

?>

                    <td valign="top" valign="top">&nbsp;&nbsp;&bull;&nbsp;Specifieke hulpmiddelen<br />

                     &nbsp;&nbsp;&nbsp;&nbsp;voor ziekte of aandoening</td>

                    <td valign="top" valign="top" align="center"><?php print($Var_ei_082_27_t);?></td>

                </tr>

            </table>

      </div>

   </fieldset>

   <fieldset style="min-height: 170px;">

      <div class="legende">9. Bijkomende aandachtspunten</div>

      <div>&nbsp;</div>

      <div class="waarde">

            <p><?php print($Var_ei_09_01_t);?>

      </div>

      <div>&nbsp;</div>

   </fieldset>

<!-- Einde Formulier -->

<?php

//---------------------------------------------------------

/* Sluit Dbconnectie */ include("../includes/dbclose.inc");

//---------------------------------------------------------

      print("</div>");

      if ($_GET['actie']!="print" && $_POST['actie']!="print") {

      print("</div>");

      print("</div>");

        include("../includes/footer.inc");

        print("</div>");

        print("</div>");

      }

      print("</body>");

      print("</html>");

      }



//---------------------------------------------------------

/* Geen Toegang */ include("../includes/check_access.inc");

//---------------------------------------------------------

?>