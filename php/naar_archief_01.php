<?php

session_start();

$paginanaam="zorgplan stopzetten";

if (IsSet($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan"))

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

        

    $qry_get_patient="

        SELECT

            naam,

            voornaam,

            code

        FROM

            patient

        WHERE

            code='{$_POST['pat_code']}'";

    $_SESSION['pat_code']=$_POST['pat_code'];

    $result=mysql_query($qry_get_patient);

    $records=mysql_fetch_array($result);

    $_SESSION['pat_voornaam']=$records['voornaam'];

    $_SESSION['pat_naam']=$records['naam'];

    

if (is_tp_patient()) {

  $extensie = "tp";

}

else {

  $extensie = "octgz";

}

?>





<fieldset>

<form action="naar_archief_02_<?= $extensie ?>.php" method="post" name="archiefform" onsubmit="return testAlles();">

    <div class="legende">Verplaatsen naar archief:</div>

    <div>&nbsp;</div>

    <div class="label220">Het zorgplan&nbsp;: </div>

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

                <td><input type="radio" name="pat_stopzetting_cat" value="1" /></td>

                <td>De patient is voldoende hersteld (dus katz &lt; 5)</td></tr>

                <td><input type="radio" name="pat_stopzetting_cat" value="2" /></td>

                <td>Overlijden</td></tr><tr>

                <td><input type="radio" name="pat_stopzetting_cat" value="3" checked="checked"/></td>

                <td>Opname in rustoord</td></tr><tr>

                <td><input type="radio" name="pat_stopzetting_cat" value="4" /></td>

                <td>Verhuis buiten Limburg</td></tr><tr>

                <td><input type="radio" name="pat_stopzetting_cat" value="6" /></td>

                <td>Verhuis buiten de gemeente</td></tr><tr>

                <td><input type="radio" name="pat_stopzetting_cat" value="5" /></td>

                <td>Andere</td></tr></table>

            </div>  

        </div><!--pat_type-->

    <div class="label220">Meer uitleg&nbsp;:</div>

    <div class="waarde">

        <textarea rows="5" cols="60" name="pat_stopzetting_text"></textarea>

    </div><!--Reden -->

</fieldset>

<?php

if (is_tp_patient()) {

?>

<input type="hidden" name="stopzetting" value="niks" />

<fieldset>

<!--

    <div class="waarde" style="margin-left: 50px;">

        <input style="width: 400px;" type="submit" value="Alleen excluderen uit project. zorgplan verder zetten"

               onclick="document.archiefform.stopzetting.value='tp';"/></div>

-->

    <div class="waarde" style="margin-left: 50px;">

        <input style="width: 400px;" type="submit" value="Excludeer deze pati&euml;nt"

               onclick="document.archiefform.stopzetting.value='fase1';"/></div><!--Button opslaan -->

</fieldset>

</form>



<?php

}

else {

?>

<input type="hidden" name="stopzetting" value="zorgplan" />

<fieldset>

    <div class="label220">zorgplan</div>

    <div class="waarde"><input type="submit" value="stopzetten en archiveren" /></div><!--Button opslaan -->

</fieldset>

</form>

<?php

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

/* Geen Toegang */ include("../includes/check_access.inc");

//---------------------------------------------------------

?>