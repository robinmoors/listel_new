<?php
session_start();
$paginanaam="Datum teamoverleg plannen";
if (IsSet($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan"))
    {
    //----------------------------------------------------------
    /* Maak Dbconnectie */ include('../includes/dbconnect.inc');
    //----------------------------------------------------------
    include("../includes/html_html.inc");
    print("<head>");
    include("../includes/html_head.inc");
    //-----------------------------------------------------------------------------
    /* Controle numerieke velden */ include("../includes/checkForNumbersOnly.inc");
    //-----------------------------------------------------------------------------
    // --------------------------------------------------------


    if (!isset($_SESSION['pat_id']) || empty($_SESSION['pat_id'])) {
      $_SESSION['pat_code'] = $_POST['pat_code'];
      $queryPersoon = "select naam, voornaam from patient
                   where code = '{$_SESSION['pat_code']}';";
      if ($result = mysql_query($queryPersoon))
        { // && mysql_num_rows($result) == 1) {
        $rij = mysql_fetch_array($result);
        $_SESSION['pat_naam'] = $rij['naam'];
        $_SESSION['pat_voornaam'] = $rij['voornaam'];
        $_SESSION['pat_id'] =  $rij['pat_id'];
          }                  
      else
        {
        print("fout bij ophalen van patientgegeven $queryPersoon " . mysql_error() );
        }
     }
//include("../includes/toonSessie.inc");

    $pat_type=mysql_fetch_array(mysql_query("SELECT pat_type FROM patienten WHERE code='".$_SESSION['pat_code']."'"));
    $locatie=(($pat_type['type']==1)OR($pat_type['type']==2))?
        "<td><input type=\"radio\" name=\"overleg_locatie_id\" value=\"2\" /></td>
        <td>In deskundig ziekenhuiscentrum</td></tr><tr>":""; // eventueel invoegen van een derde 
    // locatie indien het patienttype  PVS of MRS is
    // --------------------------------------------------------    
    //---------------------------------------------------------
    ?><script type="text/javascript">
<!--
function checkRadios()
    {
    var melding="";
    var waarde="";
    var radios= new Array("overleg_locatie_id");
    for (var radio=0;radio<radios.length;radio++)
        {
        radioObj=eval("document.forms['doeoverlegform'].elements['"+radios[radio]+"']");
           for(var i = 0; i < radioObj.length; i++)
              {
            if(radioObj[i].checked)
                 {
                var waarde=radioObj[i].value;
                i=radioObj.length;
                }
            }
        if (waarde!="")
            {
            //melding=melding+radios[radio]+" - "+waarde+"\n";
            var ingevuld=true;
            waarde="";
            }
        else 
            {
            melding="U hebt geen locatie opgegeven";
            var ingevuld=false;
            i=radioObj.length;
            radio=radios.length;
            }
        }
    if (document.doeoverlegform.overleg_dd.value == ""  ||
        document.doeoverlegform.overleg_mm.value == ""  ||
        document.doeoverlegform.overleg_jj.value == "") {
       ingevuld = false;
       melding = melding + "\nU hebt geen datum ingegeven.";
    }

    if (!ingevuld)
        {
        alert(melding);
        return false;
        }
    else 
        {
        return true;
        }
    }
//-->
</script><?php // check radio's
    //---------------------------------------------------------
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
    
    print("<h1>Overleg plannen</h1>");    
    print("<p>Voor <b>".$_SESSION['pat_code']." ".$_SESSION['pat_naam']."</b>.</p>");
    
  $oudOverlegResult =  mysql_query("SELECT * FROM overleg WHERE patient_id={$_SESSION['pat_id']} and afgerond = 1");


  if (mysql_num_rows($oudOverlegResult) > 0) {
     print("<h3>Er loopt al een overleg voor deze patient.</h3>");
     $oudOverleg = mysql_fetch_array($oudOverlegResult);
     $dag = $_SESSION['overleg_dd'] = substr($oudOverleg['datum'],6,2);
     $maand = $_SESSION['overleg_mm'] = substr($oudOverleg['datum'],4,2);
     $jaar = $_SESSION['overleg_jj'] = substr($oudOverleg['datum'],0,4);

     print("<p>Zolang het overleg van $dag/$maand/$jaar niet afgerond is,<br /> kunnen
               we geen nieuw overleg opstarten.</p>");

     print("<p>Hier kan je eventueel dat <a href=\"overleg.php?actie=afsluiten\">overleg afronden</a>.</p>");
  }
  else {


    //---------------------------------------------------------
    // Berekening van het hoeveelste overleg dit voor deze patient is
    include("../includes/aantal_teamoverleg.php"); //$_SESSION['aantal_teamoverleg']
    //---------------------------------------------------------


    
    if ($_SESSION['aantal_teamoverleg']==0)
        {
        print("
            <p>Aangezien dit het eerste overleg is voor deze hulpbehoevende en dit dus de
            opstart van een zorgenplan betreft, is het noodzakelijk dat er voldaan is
            aan volgende eisen:</p><ul>
                <li>een KATZ-score van minimaal 5</li>
                <li>een vertegenwoordiging van de juiste personen op het eerste overleg</li></ul>
            <p>alvorens de nodige documenten geprint kunnen worden.</p>");
        $_SESSION['eersteOverleg'] = true;
        }
    else
        {
        print("<p>Dit is een vervolgoverleg</p><p>Geef de datum van het overleg.");
        }
?>
<form action="overleg.php" method="post" name="doeoverlegform" onSubmit="return checkRadios();">
   <fieldset>
      <div class="inputItem" id="IIStartdatum">
         <div class="label220">Datum overleg (ddmmjj)<div class="reqfield">*</div>&nbsp;: </div>
         <div class="waarde">
            <input type="text" size="2" value="" name="overleg_dd" 
                onKeyup="checkForNumbersOnly(this,2,0,31,'doeoverlegform','overleg_mm')" 
                onblur="checkForNumbersLength(this,2)" />&nbsp;/&nbsp;
            <input type="text" size="2" value="" name="overleg_mm" 
                onKeyup="checkForNumbersOnly(this,2,0,12,'doeoverlegform','overleg_jj')" 
                onblur="checkForNumbersLength(this,2)" />&nbsp;/&nbsp;
            <input type="text" size="2" value="" name="overleg_jj" 
                onKeyup="checkForNumbersOnly(this,2,0,25,'doeoverlegform','submit')" 
                onblur="checkForNumbersLength(this,2)" />
         </div> 
      </div><!--overleg_dd,overleg_mm,overleg_jj-->
      <div class="inputItem" id="IIOverleg_locatie_id">
         <div class="label280">Plaats v/h overleg<sup><font color="#CC3300">*</font></sup>&nbsp;: </div>
         <div class="waardex"><table><tr>
            <td><input type="radio" name="overleg_locatie_id" value="0" /></td>
            <td>Bij pati&euml;nt thuis</td></tr><tr><?php print($locatie);?>
            <td><input type="radio" name="overleg_locatie_id" value="1" /></td>
            <td>Elders</td></tr></table>
         </div>  
      </div><!--overleg_locatie_id-->
      <div class="inputItem" id="IIAanwezig">
         <div class="label280">De pati&euml;nt of zijn vertegenwoordiger stemt in met de deelnemers van het overleg </div>
         <div class="waardex"><table><tr>
            <td><input type="radio" name="overleg_instemming" value="1" checked="checked"/></td>
            <td>Stemt in</td></tr><tr>
            <td><input type="radio" name="overleg_instemming" value="0" /></td>
            <td>Stemt niet in</td></tr></table>
         </div>  
      </div><!--overleg_aanwezig-->
      <div class="inputItem" id="IIAanwezig">
         <div class="label280">De pati&euml;nt of zijn vertegenwoordiger wenst niet aanwezig te zijn op het overleg</div>
         <div class="waardex"><table><tr>
            <td><input type="radio" name="overleg_afwezig" value="0" checked="checked"/></td>
            <td>w&eacute;l aanwezig</td></tr><tr>
            <td><input type="radio" name="overleg_afwezig" value="1" /></td>
            <td>niet aanwezig</td></tr></table>
         </div>  
      </div><!--overleg_afwezig-->
   </fieldset>
   <fieldset>        
        <div class="label220"></div>
        <div class="waarde">
            <input type="submit" value="volgende stap" name="submit" />
        </div><!--Button opslaan -->        
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