<?php
//------------------------------------------------------------------------------
function markselected($fieldval,$fieldname,$value)
    {
    $selected=($fieldval==$value)?"checked=\"checked\"":"";
    print("<td align=\"center\"><input type=\"radio\" name=\"".$fieldname."\" 
    value=\"".$value."\" ".$selected." /></td>\n");
    }
function check4empty($PostValue)
    {$qrystring=(!isset($_POST[$PostValue]))?"0":$_POST[$PostValue];
    return $qrystring;}
//------------------------------------------------------------------------------
//------------------------------------------------------------
/* Maak Dbconnectie */ include('../includes/dbconnect2.inc');
//------------------------------------------------------------


   session_start();

     // eerst nakijken of er een code is meegegeven én of die code bestaat
    // als er geen code ingegeven is, kijken we naar toegang
    if (isset($_POST['alInFormulierGeweest'])) {
      $codeRij['evalinstr_id'] = $_SESSION['evalinstr_id'];
    }
    else if (isset($_GET['code'])) {
       $qryCode = "select patient_code, id, evalinstr_id from overleg where logincode = \"{$_GET['code']}\"";
       if ($codeResult = mysql_query($qryCode)) {
          if (mysql_num_rows($codeResult) == 1) {
            $codeRij = mysql_fetch_array($codeResult);
            $overlegID = $codeRij['id'];
            $_SESSION['pat_code'] = $codeRij['patient_code'];
            $_SESSION['evalinstr_id'] = $codeRij['evalinstr_id'];
            $goedeCode = true;
            $_SESSION['binnenViaCode'] = true;
          }
       }
       else {
         die("stomme code-query  $qryCode");
       }
    }
    else if (isset($_GET['evalinstr'])) {
       $_SESSION['evalinstr_id'] = $_GET['evalinstr'];
       $overlegID = $_GET['overleg_id'];
    }
    else {
       $qryCode = "select id, evalinstr_id from overleg
                   where patient_code = \"{$_SESSION['pat_code']}\"
                   AND afgerond = 0;";
       if ($codeResult = mysql_query($qryCode)) {
          if (mysql_num_rows($codeResult) == 1) {
            $codeRij = mysql_fetch_array($codeResult);
            $overlegID = $codeRij['id'];
            $_SESSION['evalinstr_id'] = $codeRij['evalinstr_id'];
          }
       }
       else {
         die("stomme code-query  $qryCode");
       }
    }

    //print_r($_SESSION);die();
   // als er nog geen evalinstr in de database zit, maken we een lege
   if (isset($overlegID) && $_GET['action'] != "Aanpassen" && $_POST['action'] != "Aanpassen") {
     if (!isset($codeRij['evalinstr_id'])) {
            // een blanco evalinstr aanmaken
            $evalInstrQry="
                INSERT INTO
                       evalinstr
                       (ei_datum)
                VALUES
                        (NOW())";
            if (!mysql_query($evalInstrQry)) {die("<h1>Geen blanco evaluatieinstrument gemaakt. mag niet!</h1>");}
            else {
              $_SESSION['evalinstr_id'] = mysql_insert_id();
            }
      }
    }

   $paginanaam="Evaluatieinstrument Stap 1";


    if ($_SESSION['binnenViaCode'] || (isset($_GET['code']) && $goedeCode) || (!isset($_GET['code']) && isset($_SESSION["toegang"]) && ($_SESSION["toegang"]=="toegestaan")))
      {
      include("../includes/html_html.inc");
      print("<head>");
      include("../includes/html_head.inc");
?>
<script type="text/javascript">
function checkRadios() {var melding="";
    waarde=""
    var radios= new Array("ei_01_06_s");
    for (var radio=0;radio<radios.length;radio++)
        {radioObj=eval("document.forms['evaluatieInstrForm'].elements['"+radios[radio]+"']");
    for(var i = 0; i < radioObj.length; i++)
        {if(radioObj[i].checked)
            {var waarde=radioObj[i].value;
                i=radioObj.length;}}
        if (waarde!="")
            {melding=melding+radios[radio]+" - "+waarde+"\n";
            var ingevuld=true;
            waarde="";}
        else {melding="U heeft iets niet ingegeven";
            var ingevuld=false;
            i=radioObj.length;
            radio=radios.length;}}
    if (!ingevuld)
        {alert(melding);
        return false;}
    else {return true;}}
</script>
<?php
      print("</head>");
      print("<body>");
      print("<div align=\"center\">");
      print("<div class=\"pagina\">");
      include("../includes/header.inc");
      include("../includes/kruimelpad.inc");
      print("<div class=\"contents\">");
      include("../includes/menu.inc");
      print("<div class=\"main\">");
      print("<div class=\"mainblock\">");

switch(true)
    {
    case(!isset($_POST['action'])) :
    case(isset($_POST['action'])AND($_POST['action']=="Aanpassen")):
    case(isset($_GET['action'])AND($_GET['action']=="Aanpassen")):

        if (isset($_GET['overleg_id'])) {
          $_SESSION['overleg_id']=$_GET['overleg_id'];
        }
        //------------------------------
        $Var_ei_01_01_s="";
        $Var_ei_01_01_t="";
        $Var_ei_01_02_s="";
        $Var_ei_01_02_t="";
        $Var_ei_01_03_s="";
        $Var_ei_01_03_t="";
        $Var_ei_01_04_s="";
        $Var_ei_01_04_t="";
        $Var_ei_01_05_s="";
        $Var_ei_01_05_t="";
        $Var_ei_01_06_s="";
        $Var_ei_01_06_t="";
        $Var_ei_01_07_s="";
        $Var_ei_01_07_t=""; // Reset values
        //------------------------------

        if( ((isset($_GET['action']))AND($_GET['action']=="Aanpassen")) ||
            ((isset($_POST['action']))AND($_POST['action']=="Aanpassen")) ||
              ($goedeCode && isset($codeRij['evalinstr_id']) && $codeRij['evalinstr_id'] != 0)
          )
            {

            if (isset($_GET['action']))
               $_SESSION['action']=$_GET['action'];
            else if (isset($_POST['action']))
               $_SESSION['action']=$_POST['action'];
            else if  ($goedeCode && isset($codeRij['evalinstr_id']) && $codeRij['evalinstr_id'] != 0)
                $_SESSION['action']="Aanpassen";
            //---------------------------
            $qry="
                SELECT
                    ei_01_01_s,ei_01_01_t,
                    ei_01_02_s,ei_01_02_t,
                    ei_01_03_s,ei_01_03_t,
                    ei_01_04_s,ei_01_04_t,
                    ei_01_05_s,ei_01_05_t,
                    ei_01_06_s,ei_01_06_t,
                    ei_01_07_s,ei_01_07_t
                FROM
                    evalinstr
                WHERE
                    ei_id = {$_SESSION['evalinstr_id']}";
            //print($qry);
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
            //-------------------------------------------------
            }

?>
<!-- Start Formulier -->
<form action="ingeven_evaluatie_instr_01.php" method="post" name="evaluatieInstrForm" onSubmit="return checkRadios()" >
   <fieldset>
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
<?php 
markselected($Var_ei_01_01_s,"ei_01_01_s",1);
markselected($Var_ei_01_01_s,"ei_01_01_s",2);
markselected($Var_ei_01_01_s,"ei_01_01_s",3);
markselected($Var_ei_01_01_s,"ei_01_01_s",4);
?>
                    <td>Anderstalig</td>
                    <td align="center">
                    <input type="text"  name="ei_01_01_t" size="35" value="<?php print($Var_ei_01_01_t);?>" /></td>
                </tr>
            <tr>
<?php 
markselected($Var_ei_01_02_s,"ei_01_02_s",1);
markselected($Var_ei_01_02_s,"ei_01_02_s",2);
markselected($Var_ei_01_02_s,"ei_01_02_s",3);
markselected($Var_ei_01_02_s,"ei_01_02_s",4);
?>
                    <td>Dialect</td>
                    <td align="center">
                    <input type="text"  name="ei_01_02_t" size="35" value="<?php print($Var_ei_01_02_t);?>" /></td>
                </tr>
            <tr>
<?php 
markselected($Var_ei_01_03_s,"ei_01_03_s",1);
markselected($Var_ei_01_03_s,"ei_01_03_s",2);
markselected($Var_ei_01_03_s,"ei_01_03_s",3);
markselected($Var_ei_01_03_s,"ei_01_03_s",4);
?>
                    <td>Afasie</td>
                    <td align="center">
                    <input type="text"  name="ei_01_03_t" size="35" value="<?php print($Var_ei_01_03_t);?>" /></td>
                </tr>
            <tr>
<?php 
markselected($Var_ei_01_04_s,"ei_01_04_s",1);
markselected($Var_ei_01_04_s,"ei_01_04_s",2);
markselected($Var_ei_01_04_s,"ei_01_04_s",3);
markselected($Var_ei_01_04_s,"ei_01_04_s",4);
?>
                    <td>Hoorproblemen</td>
                    <td align="center">
                    <input type="text"  name="ei_01_04_t" size="35" value="<?php print($Var_ei_01_04_t);?>" /></td>
                </tr>
            <tr>
<?php 
markselected($Var_ei_01_05_s,"ei_01_05_s",1);
markselected($Var_ei_01_05_s,"ei_01_05_s",2);
markselected($Var_ei_01_05_s,"ei_01_05_s",3);
markselected($Var_ei_01_05_s,"ei_01_05_s",4);
?>
                    <td>Spraakproblemen</td>
                    <td align="center">
                    <input type="text"  name="ei_01_05_t" size="35" value="<?php print($Var_ei_01_05_t);?>" /></td>
                </tr>
            <tr class="verplicht">
<?php 
markselected($Var_ei_01_06_s,"ei_01_06_s",1);
markselected($Var_ei_01_06_s,"ei_01_06_s",2);
markselected($Var_ei_01_06_s,"ei_01_06_s",3);
markselected($Var_ei_01_06_s,"ei_01_06_s",4);
?>
                    <td>Gebruik telecommunicatie</td>
                    <td align="center">
                    <input type="text"  name="ei_01_06_t" size="35" value="<?php print($Var_ei_01_06_t);?>" /></td>
                </tr>
            <tr>
<?php 
markselected($Var_ei_01_07_s,"ei_01_07_s",1);
markselected($Var_ei_01_07_s,"ei_01_07_s",2);
markselected($Var_ei_01_07_s,"ei_01_07_s",3);
markselected($Var_ei_01_07_s,"ei_01_07_s",4);
?>
                    <td>Individuele aandachtspunten</td>
                    <td align="center">
                    <input type="text"  name="ei_01_07_t" size="35" value="<?php print($Var_ei_01_07_t);?>" /></td>
                </tr>
            </table>
      </div>
   </fieldset>
    <fieldset>
        <div class="inputItem" id="IIButton">
         <div class="label220">Deze gegevens</div>
         <div class="waarde">
         <input type="hidden" value="1" name="alInFormulierGeweest" />
         <input type="submit" value="Opslaan" name="action" />
         </div> 
      </div><!--action-->
    </fieldset>
</form>
<!-- Einde Formulier -->
<?php
        break;
    case((isset($_POST['action']))AND($_POST['action']=="Opslaan")):
            $qry="
                UPDATE evalinstr
                SET
                    ei_01_01_s=".check4empty('ei_01_01_s').",ei_01_01_t='".$_POST['ei_01_01_t']."',
                    ei_01_02_s=".check4empty('ei_01_02_s').",ei_01_02_t='".$_POST['ei_01_02_t']."',
                    ei_01_03_s=".check4empty('ei_01_03_s').",ei_01_03_t='".$_POST['ei_01_03_t']."',
                    ei_01_04_s=".check4empty('ei_01_04_s').",ei_01_04_t='".$_POST['ei_01_04_t']."',
                    ei_01_05_s=".check4empty('ei_01_05_s').",ei_01_05_t='".$_POST['ei_01_05_t']."',
                    ei_01_06_s=".check4empty('ei_01_06_s').",ei_01_06_t='".$_POST['ei_01_06_t']."',
                    ei_01_07_s=".check4empty('ei_01_07_s').",ei_01_07_t='".$_POST['ei_01_07_t']."'
                WHERE
                    ei_id = {$_SESSION['evalinstr_id']}";
            //print($qry);
            $result=mysql_query($qry); 
            // Update record
            //-------------------------------
            //}
        //--------------------------------------
         print("<script type=\"text/javascript\">document.location=\"ingeven_evaluatie_instr_02.php\"</script>"); 
         // Redirect to next page
        //--------------------------------------
        break;
    case (true):
        print("<p>Foute toegang van deze pagina</p>");
    }
//---------------------------------------------------------
/* Sluit Dbconnectie */ include("../includes/dbclose.inc");
//---------------------------------------------------------
      print("</div>");
      print("</div>");
      print("</div>");
      include("../includes/footer.inc");
      print("</div>");
      print("</div>");
      print("</body>");
      print("</html>");
      }
//---------------------------------------------------------
/* Geen Toegang */ if (!(isset($_GET['code']) && $goedeCode)) require("../includes/check_access.inc");
/* Geen Toegang */
  if ((!(isset($_GET['code']) && $goedeCode))
       && (!isset($_SESSION['binnenViaCode']) || !$_SESSION['binnenViaCode']))
     include("../includes/check_access.inc");
//---------------------------------------------------------
?>