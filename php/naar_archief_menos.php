<?php

session_start();

$paginanaam="menos-patient stopzetten";

if (IsSet($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan")&& $_SESSION['profiel']=="menos")

    {



    //----------------------------------------------------------

    /* Maak Dbconnectie */ include('../includes/dbconnect2.inc');

    //----------------------------------------------------------



    include("../includes/html_html.inc");

    print("<head>");

    include("../includes/html_head.inc");





    //-----------------------------------------------------------------------------

    /* Controle numerieke velden */ include("../includes/checkForNumbersOnly.inc");

    //-----------------------------------------------------------------------------

?>

<script type="text/javascript" src="../javascript/prototype.js"></script>

<script type="text/javascript">

function testAlles() {

  if ($F('einde_dd')=="" || $F('einde_mm')=="" || $F('einde_jj')=="") {

    alert("U hebt nog geen datum ingevuld.\nGelieve dit eerst te doen vooraleer te archiveren.");

    return false;

  }

  else

    return true;

}

</script>



<?php

    print("</head>");

    print("<body>");

    print("<div align=\"center\">");

    print("<div class=\"pagina\">");

    include("../includes/header.inc");

    include("../includes/pat_id.inc");

    print("<div class=\"contents\">");

    include("../includes/menu.inc");

    print("<div class=\"main\">");

    print("<div class=\"mainblock\">");

        
    if (isset($_POST['pat_code'])) {
      $_SESSION['pat_code']=$_POST['pat_code'];
    }

    $qry_get_patient="
        SELECT
            naam,
            voornaam,
            code
        FROM
            patient
        WHERE
            code='{$_SESSION['pat_code']}'";


    $result=mysql_query($qry_get_patient);

    $records=mysql_fetch_array($result);

    $_SESSION['pat_voornaam']=$records['voornaam'];

    $_SESSION['pat_naam']=$records['naam'];

    
if (isset($_POST['reden'])) {
  if ($_POST['reden']=="andere") {
    $reden = $_POST['andere'];
  }
  else {
    $reden = $_POST['reden'];
  }

  $stopQry = "update patient set menos = 0 where code = '{$_SESSION['pat_code']}'";
  $redenQry = "update patient_menos set reden = '$reden',
                                        einddatum = '{$_POST['einde_jj']}-{$_POST['einde_mm']}-{$_POST['einde_dd']}'
               where patient = '{$_SESSION['pat_code']}'";
  if (mysql_query($redenQry) && mysql_query($stopQry)) {
     print("<h2>{$records['naam']} {$records['voornaam']} is stopgezet vanuit menos.</h2>");
     mysql_close();
     die();
  }
  else {
    print("<div style=\"background-color: #f55;\">Kon {$records['naam']} {$records['voornaam']} niet stopzetten. Probeer opnieuw?</div>");
  }
}

?>





<fieldset>

<form action="naar_archief_menos.php" method="post" name="archiefform" onsubmit="return testAlles();">

    <div class="legende">Verplaatsen naar archief:</div>

    <div>&nbsp;</div>

    <div class="label220">Het menos-zorgplan&nbsp;: </div>

    <div class="waarde"><?php print($records['code']);?></div>

    <div class="label220">van pati&euml;nt&nbsp;:</div>

    <div class="waarde"><?php print($records['naam']." ".$records['voornaam']);?></div>

    <div class="inputItem" id="IIStartdatum">

        <div class="label220">vanaf(dd/mm/jjjj)<div class="reqfield">*</div>&nbsp;: </div>

        <div class="waarde">

            <input type="text" size="2" value="" name="einde_dd" id="einde_dd"

                onKeyup="checkForNumbersOnly(this,2,0,31,'archiefform','einde_mm')" 

                onblur="checkForNumbersLength(this,2)" />&nbsp;/&nbsp;

            <input type="text" size="2" value="" name="einde_mm" id="einde_mm"

                onKeyup="checkForNumbersOnly(this,2,0,12,'archiefform','einde_jj')" 

                onblur="checkForNumbersLength(this,2)" />&nbsp;/&nbsp;

            <input type="text" size="4" value="" name="einde_jj"  id="einde_jj"

                onKeyup="checkForNumbersOnly(this,4,1970,2069,'archiefform','pat_stopzetting_cat')"

                onblur="checkForNumbersLength(this,4)" />

        </div> 

    </div><!--einde_dd,einde_mm,einde_jj-->

    <div class="inputItem" id="IIType">

            <div class="label220" >Reden Van Stopzetting&nbsp;: </div>

                <div class="waardex"  style="float: none;">

                <table><tr>

                <td><input type="radio" name="reden" value="hersteld" /></td>

                <td>De pati&euml;nt wordt niet langer in het Menos project opgevolgd</td></tr>

                <tr>
                <td><input type="radio" name="reden" value="overlijden" /></td>
                <td>Overlijden</td></tr><tr>

                <tr>
                <td valign="top"><input type="radio" name="reden" value="andere" checked="checked" id="andereReden"/></td>
                <td>Andere: <br/>
                    <textarea rows="3" cols="30" name="andere" onchange="if (this.value!='') document.getElementById('andereReden').checked=true;"></textarea>
                </td>
                </tr>
                </table>

            </div>  

        </div><!--pat_type-->

</fieldset>


<fieldset>

    <div class="label220">Dossier </div>

    <div class="waarde"><input type="submit" value="stopzetten en archiveren" /></div><!--Button opslaan -->

</fieldset>

</form>


<?php

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
/* Geen Toegang */ include("../includes/check_access.inc");
//---------------------------------------------------------
?>