<?php

session_start();

$paginanaam="Registratie van Ouderenmis(be)handeling";



/*

uitleg over de structuur



1. verschillende tabs voor het formulier

*/



function pprint($string) {

  if ($_GET['print']==1)

    return;

  else

    print($string);

}



function eindePagina() {

	pprint("</div>");

	pprint("</div>");

	pprint("</div>");

  if ($_GET['print']!=1)

    require("../includes/footer.inc");

	pprint("</div>");

	print("</div>");

    //---------------------------------------------------------

    /* Sluit Dbconnectie */ require("../includes/dbclose.inc");

    //---------------------------------------------------------

	print("</body>");

	print("</html>");



     //---------------------------------------------------------

     /* Geen Toegang */ require("../includes/check_access.inc");

     //---------------------------------------------------------

}





if (!(isset($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan"))) {

//---------------------------------------------------------------

/* Open Empty Html */ require('../includes/open_empty_html.inc');

//---------------------------------------------------------------



?>

    U bent niet geautoriseerd tot deze pagina.

    U wordt dadelijk terug gestuurd naar de listel-site waar u links uit het menu een keuze kan maken.

    <script type="text/javascript">

     function redirect()

     {

         <?php print("document.location = \"/\";"); ?>

     }

     setTimeout("redirect()",500);



    </script>



<?php

//-----------------------------------------------------------------

/* Close Empty Html */ require('../includes/close_empty_html.inc');

//-----------------------------------------------------------------



exit;

}





//----------------------------------------------------------

/* Maak Dbconnectie */ require('../includes/dbconnect2.inc');

//----------------------------------------------------------



	require("../includes/html_html.inc");

	print("<head>");

	require("../includes/html_head.inc");

    //-----------------------------------------------------------------------------

    /* Controle numerieke velden */ include("../includes/checkForNumbersOnly.inc");

    //-----------------------------------------------------------------------------

//-----------------------------------------------------------------

/* Maak gemeenteLijst */ require('../includes/list_alle_gemeentes.php');

//-----------------------------------------------------------------

    // --------------------------------------------------------

  print("</head>");

  if ($_GET['print']==1) {

	  print("<body>");

?>

<style type="text/css">



.tabmenu  {

 display: none;

}

.tabcontent  {

  display: inline-block;

  position: static;

}

</style>



<?php

  }

  else {

    print("<link rel=\"stylesheet\" media=\"screen\" type=\"text/css\" href=\"../css/domtab4.css\" />\n");

    if ($_SESSION['profiel']=="listel")

  	  print("<body onunload=\"eindTijd();\">");

    else

  	  print("<body>");

    print("<div align=\"center\">");

	}

	print("<div class=\"pagina\">");

	require("../includes/header.inc");

	require("../includes/pat_id.inc");



  if ($_GET['print']!=1) {

    print("<div class=\"contents\">");

	  require("../includes/menu.inc");

    if ($_SESSION['profiel']=="listel")

	    print("<div class=\"main\" id=\"main\" onclick=\"resetCountDown()\">");

    else

	    print("<div class=\"main\" id=\"main\">");

	  print("<div class=\"mainblock\">");

  }

?>

<script language="javascript" type="text/javascript" src="../javascript/prototype.js"></script>

<script language="javascript" type="text/javascript" src="../javascript/omb.js"></script>



<?php

    if ($_SESSION['profiel']=="listel") {

?>

<script language="javascript" type="text/javascript" src="../javascript/ombCountDown.js"></script>

<?php

    }

?>



<?php





// bestaand record ophalen

if (isset($_POST['zoekjjjj'])) {

  preset($_POST['zoekjjjj']);
  preset($_POST['zoekmm']);
  preset($_POST['zoekdd']);
  preset($_POST['zoekdagnummer']);
  $zoekqry = "select * from omb_registratie where jaar={$_POST['zoekjjjj']}

                                          and maand={$_POST['zoekmm']}

                                          and dag={$_POST['zoekdd']}

                                          and dagnummer={$_POST['zoekdagnummer']}";
                                          
}

else if (isset($_GET['zoekid'])) {

  $zoekqry = "select * from omb_registratie where id = abs({$_GET['zoekid']})";
  
}

if (strlen($zoekqry)>1) {

  // WE MOETEN EEN BESTAANDE REGISTRATIE OPZOEKEN

  $resultOudeRegistratie = mysql_query($zoekqry) or die("$zoekqry lukt niet");

  if (mysql_num_rows($resultOudeRegistratie)!=1) {

    die("Er is geen geldige registratie met deze gegevens! $zoekqry");

  }

  else {

    $oud = mysql_fetch_assoc($resultOudeRegistratie);

    $gevondenID = $oud['id'];

    // controleren of we dit wel mogen zien
    if (($_SESSION['profiel']!="listel") && ($_SESSION['profiel']!="caw")) {
      // als we auteur zijn is het ok
      if ($oud['auteur'] != $_SESSION['usersid']) {
         // we zijn geen auteur, geen listel en geen caw
         // dan moeten we rechten hebben op het bijhorende overleg
         $zoekOverleg = mysql_query("select id, afgerond from overleg where omb_id = abs({$oud['id']})");

         if (mysql_num_rows($zoekOverleg) == 1) {
           $gevondenOverleg = mysql_fetch_assoc($zoekOverleg);
           $overlegID = $gevondenOverleg['id'];
           if ($gevondenOverleg['afgerond'] == 1) {
             $qryRechten = "select rechten from afgeronde_betrokkenen where overleg_id = {$gevondenOverleg['id']} and persoon_id = {$_SESSION['usersid']} and genre = '{$_SESSION['profiel']}'";
           }
           else {
             $qryRechten = "select rechten from huidige_betrokkenen where patient_code = '{$gevondenOverleg['patient_code']}' and persoon_id = {$_SESSION['usersid']} and genre = '{$_SESSION['profiel']}'";
           }
         }
         
         $zoekRechten = mysql_query($qryRechten);
         if (mysql_num_rows($zoekRechten)==0) die("u hebt geen rechten voor deze omb-registratie");
         $rechtenInfo = mysql_fetch_assoc($zoekRechten);
         if ($rechtenInfo['rechten'] == 0) die("u hebt geen rechten voor deze omb-registratie");
      }
    }


    if ($oud['dag']<10) $oud['dag'] = "0" . $oud['dag'];

    $oud['daghoofd']=$oud['dag'];



    if ($oud['dagnummer']<10) $oud['dagnummer'] = "00" . $oud['dagnummer'];

    else if ($oud['dagnummer']<100) $oud['dagnummer'] = "0" . $oud['dagnummer'];

    $oud['dagnummerhoofd']=$oud['dagnummer'];



    if ($oud['maand']<10) $oud['maand'] = "0" . $oud['maand'];

    $oud['maandhoofd']=$oud['maand'];



    $oud['jaarhoofd']=$oud['jaar'];

  }

}

else if ($_GET['omb_bron']!="") {

  // WE MOETEN EEN VERVOLGREGISTRATIE MAKEN

  $oud = getFirstRecord("select * from omb_registratie

                         where (    (\"{$_GET['omb_bron']}\" like concat(jaar, '/', maand, '/', dag, '/LI%')

                                       and \"{$_GET['omb_bron']}\" like concat('%',dagnummer))

                                 or

                                    omb_bron = \"{$_GET['omb_bron']}\"

                                )

                               $extravoorwaarde

                         order by id desc");



  // om de gegevens van de vorige registratie op te halen

  $gevondenID = $oud['id'];



  // maar dan id op -1 zetten, zodat dit als een nieuwe registratie gesaved wordt

  $oud['id']=-1;

  $oud['vorige']="";

  // en ook de andere basisgevens resetten



  $oud['dagnummerhoofd']="nnn";

  $oud['daghoofd']="dd";

  $oud['maandhoofd']="mm";

  $oud['jaarhoofd']="jjjj";

  $oud['dag']=date("d");

  if (strlen($oud['dag'])<2) $oud['dag']="0".$oud['dag'];

  $oud['maand']=date("m");

  $oud['jaar']=date("Y");

  $oud['situatieschets']="";

  $oud['afgerond']=0;

}

else {

  // WE MOETEN EEN NIEUWE REGISTRATIE MAKEN

  $nieuweRegistratie = true;

  $oud['dagnummerhoofd']="nnn";

  $oud['daghoofd']="dd";

  $oud['maandhoofd']="mm";

  $oud['jaarhoofd']="jjjj";

  $oud['dag']=date("d");

  if (strlen($oud['dag'])<2) $oud['dag']="0".$oud['dag'];

  $oud['maand']=date("m");

  $oud['jaar']=date("Y");



  $oud['id']=-1;

}



// hoort hier een overleg bij???



if (isset($_GET['overlegID']) &&  $_GET['overlegID'] > 0) {

  $overlegID = $_GET['overlegID'];

  $invullen = true;

  $zoekOverleg = mysql_query("select * from overleg where id = $overlegID");

  if (mysql_num_rows($zoekOverleg) == 1) {

    $overlegInfo = mysql_fetch_assoc($zoekOverleg);

  }

  $zoekPatient = mysql_query("select * from patient where code = '{$overlegInfo['patient_code']}'");

  if (mysql_num_rows($zoekPatient) == 1) {

    $patientInfo = mysql_fetch_assoc($zoekPatient);

  }

  print("<script type=\"text/javascript\">var terugNaarOverleg=true;</script>");

}

else {

  if ($_GET['terugNaarOverleg']==1)

    print("<script type=\"text/javascript\">var terugNaarOverleg=true;</script>");

  else

    print("<script type=\"text/javascript\">var terugNaarOverleg=false;</script>");



  if ($oud['id']!=-1) {

    $zoekOverleg = mysql_query("select id, afgerond from overleg where omb_id = abs({$oud['id']})");

    if (mysql_num_rows($zoekOverleg) == 1) {

      $gevondenOverleg = mysql_fetch_assoc($zoekOverleg);

      $overlegID = $gevondenOverleg['id'];

      if ($gevondenOverleg['afgerond'] == 1) {

        $tabel = "afgeronde";

      }

      else {

        $tabel = "huidige";

      }

    }

  }

}





function value($key) {

  global $oud;

  $waarde = $oud[$key];

  return " value=\"$waarde\" ";

}

function selectvalue($key, $target) {

  global $oud;

  if ($oud[$key]==$target)

    return " selected=\"selected\" ";

  else

    return "";

}

function selectprintvalue($key, $target) {

  global $oud;

  if ($oud[$key]==$target)

    return "<span class=\"checkedThing\">X</span> ";

  else

    return "";

}

function radiovalue($key, $target) {

  global $oud;

  if ($oud[$key]==$target)

    return " checked=\"checked\" ";

  else

    return "";

}

function radioprintvalue($key, $target) {

  global $oud;

  if ($oud[$key]==$target)

    return "<span class=\"checkedThing\">X</span> ";

  else

    return "";

}



print("<div style=\"float:left;\"><h3>Registratie ouderenmis(be)handeling <span id=\"volgnummer\">" . $oud['jaarhoofd'] . "/" . $oud['maandhoofd'] . "/" . $oud['daghoofd'] . "/LI-" . $oud['dagnummerhoofd'] . "</span></h3></div>");



?>

<div style="float:right;"><a href="javascript:printhref();">print</a></div>

<div id="status" style="display:none;"></div>

<p style="clear:both;">Met de steun van de provincie Limburg.<br/>De gegevens worden anoniem ter beschikking gesteld van het <br/>Vlaams Meldpunt Ouderenmis(be)handeling (078/15 15 70)</p>



<form method="post" onsubmit="return false;" id="hoofdformulier" name="hoofdformulier">

<?php

    if ($_GET['print']!=1 && (($oud['afgerond']==0) || (($oud['afgerond']==1) && (($_SESSION['profiel']=="listel") || ($_SESSION['profiel']=="caw"))))) {

?>

   <fieldset class="normal">

        <div class="label220" style="font-size: 11px; width: 120px;">Sla gegevens op:</div>

        <div class="waarde">

            <input type="button" value="Bewaar" onclick="saveAlles(0)" />



<script type="text/javascript">

  if (terugNaarOverleg)

    document.writeln("<input type=\"button\" value=\"Bewaar & naar overleg\" onclick=\"eindeOMB(saveAlles(0),0);\" /><br/>");

</script>





            <input type="button" value="Registratie volledig afronden" onclick="eindeOMB(saveAlles(1),1);" />

            <span id="bewaarstatus"></span>

        </div><!--Button opslaan -->

   </fieldset>

<?php

   }

?>



<input type="hidden" name="id" id="id" value="<?= $oud['id'] ?>" />

<?php

  if ($invullen) print("<input type=\"hidden\" name=\"invullen\" value=\"$overlegID\" />\n");

  if (isset($_GET['patient'])) {

    print("<input type=\"hidden\" name=\"omb_bron\" id=\"omb_bron\" value=\"{$_GET['omb_bron']}\" />\n");

    print("<input type=\"hidden\" name=\"patient\" value=\"{$_GET['patient']}\" />\n");

  }

  else {

    print("<input type=\"hidden\" name=\"omb_bron\" id=\"omb_bron\" value=\"{$oud['omb_bron']}\" />\n");

  }

?>



<div id="tabcontainer"> <!-- de verschillende tabs -->

  <div class="tabmenu" id="tabMelding"><a href="javascript:toon('Melding');">Melding</a></div>

  <div class="tabmenu" id="tabSlachtoffer"><a href="javascript:toon('Slachtoffer');">Slachtoffer</a></div>

  <div class="tabmenu" id="tabPlegers"><a href="javascript:toon('Plegers');">Pleger</a></div>

  <div class="tabmenu" id="tabMishandeling"><a href="javascript:toon('Mishandeling');">Mis(be)handeling</a></div>

  <div class="tabmenu" id="tabHulp"><a href="javascript:toon('Hulp');">Hulp</a></div>

  <div class="tabmenu" id="tabMantelzorgers"><a href="javascript:toon('Mantelzorgers');">Mantelzorgers</a></div>

<?php

  if (($_SESSION['profiel']=="listel") || ($_SESSION['profiel']=="caw")) {

?>

  <div class="tabmenu" id="tabOpvolging"><a href="javascript:toon('Opvolging');">Opvolging</a></div>

<?php

  }

?>







  <div class="tabcontent" id="Melding">

    Melding

    

<table>

<tr>

  <td>

    <label for="dag">Datum (dd/mm/jjjj) <span class="reqfield">*</span></label>

  </td>

  <td>

    <input style="width:25px;" <?= $disable ?> type="text" size="2" name="dd" id="dd" <?= value('dag') ?>

       onkeyup="checkForNumbersOnly(this,2,0,31,'hoofdformulier','mm')"

       onblur="checkForNumbersLength(this,2)" />&nbsp;/&nbsp;

    <input style="width:25px;" <?= $disable ?> type="text" size="2" name="mm" id="mm" <?= value('maand') ?>

       onkeyup="checkForNumbersOnly(this,2,0,12,'hoofdformulier','jjjj')"

       onblur="checkForNumbersLength(this,2)" />&nbsp;/&nbsp;

    <input style="width:50px;"  <?= $disable ?> type="text" size="2" name="jjjj" id="jjjj" <?= value('jaar') ?>

       onkeyup="checkForNumbersOnly(this,4,2000,2069,'hoofdformulier','contactwijze')"

       onblur="checkForNumbersLength(this,4)" />

  </td>

</tr>

<tr>

  <td>

    <label for="contactwijze">Contactwijze</label>

  </td>

  <td>

    <select name="contactwijze" id="contactwijze" >

      <option value="-1">-- maak een keuze --</option>

<?php

  $contactQry = "select * from omb_contactwijze order by id";

  $resultContact = mysql_query($contactQry);

  for ($i=0; $i < mysql_num_rows($resultContact); $i++) {

    $contactRij = mysql_fetch_assoc($resultContact);

    print("<option value=\"{$contactRij['id']}\" " . selectvalue('contactwijze',$contactRij['id']) . ">{$contactRij['contactwijze']}</option>\n");

  }

?>

    </select>

  </td>

</tr>

<?php

  if (($_SESSION['profiel']=="listel") || ($_SESSION['profiel']=="caw")) {

?>

<tr>

  <td>

    <label for="genre">Soort melding <span class="reqfield">*</span></label>

  </td>

  <td>

    <select name="genre" id="genre">

      <option value="-1">-- maak een keuze --</option>

<?php

  $qry = "select * from omb_vraag order by id";

  $result = mysql_query($qry);

  for ($i=0; $i < mysql_num_rows($result); $i++) {

    $rij = mysql_fetch_assoc($result);

    print("<option value=\"{$rij['id']}\"" . selectvalue('genre_melding',$rij['id']) . ">{$rij['vraag']}</option>\n");

  }

?>

    </select>

  </td>

</tr>

<?php

}

else {

  // soort melding anders doen voor OC TGZ en TP-coordinatoren

  if ($oud['genre_melding']==3) {

    $contactnameMeldpunt = " checked=\"checked\" ";

    $waardeGenre = 3;

    $waardeOpvolging = 1;

  }

  else {

    $contactnameMeldpunt = "";

    $waardeGenre = 4;

    $waardeOpvolging = -1;

  }

?>

<tr>

  <td colspan="2">

     <input type="checkbox" <?= $contactnameMeldpunt ?> onclick="if (this.checked) {$('genre').value = 3;$('opvolging_steunpunt').value = 1;} else {$('genre').value = 4;$('opvolging_steunpunt').value = -1;}"/><label for="interventie">contactname met Vlaams Meldpunt (078/15 15 70)</label>

     <input type="hidden" name="genre" id="genre" value="<?= $waardeGenre ?>" />  <!-- registratie = 4  // interventie = 3 -->

     <input type="hidden" name="opvolging_steunpunt" id="opvolging_steunpunt" value="<?= $waardeOpvolging ?>" />

     <br/>&nbsp;

<?php

  if ($_GET['print']==1) {

    if ($waardeGenre == 4)

      print("<br/>Dit dus een registratie<br/>&nbsp;");

    else

      print("<br/>Dit is dus een interventie.<br/>Bovendien is er een opvolging door het steunpunt<br/>&nbsp;");

  }

?>

  </td>

</tr>

<?php

}



  if (($_SESSION['profiel']=="listel") || ($_SESSION['profiel']=="caw")) {

?>

<tr>

  <td>

    <label for="bekendheid">Bekendheid</label>

  </td>

  <td>

    <select name="bekendheid" id="bekendheid" onchange="toonDoorverwijzing()">

      <option value="-1">-- maak een keuze --</option>

<?php

  $bekendheidQry = "select * from omb_bekendheid order by id";

  $resultbekendheid = mysql_query($bekendheidQry);

  for ($i=0; $i < mysql_num_rows($resultbekendheid); $i++) {

    $bekendheidRij = mysql_fetch_assoc($resultbekendheid);

    print("<option value=\"{$bekendheidRij['id']}\"" . selectvalue('bekendheid',$bekendheidRij['id']) . ">{$bekendheidRij['bekendheid']}</option>\n");

  }

?>

    </select>

  </td>

</tr>

<tr id="doorverwijzingrij" style="visibility:hidden;">

  <td>

    <label for="doorverwijzingdetail1">Doorverwijzing</label>

  </td>

  <td>

   <div id="doorverwijzingdetail">

     Intern: <select name="doorverwijzing_intern">

       <option value="">-- maak een keuze --</option>

       <option <?= selectvalue('doorverwijzing_intern','huisarts'); ?> >huisarts</option>

       <option <?= selectvalue('doorverwijzing_intern','thuisverpleging'); ?> >thuisverpleging</option>

       <option <?= selectvalue('doorverwijzing_intern','dienst voor gezinszorg'); ?> >dienst voor gezinszorg en aanvullende gezinszorg</option>

       <option <?= selectvalue('doorverwijzing_intern','dienst voor oppashulp'); ?> >dienst voor oppashulp</option>

       <option <?= selectvalue('doorverwijzing_intern','POP/SEL'); ?> >SEL</option>

       <option <?= selectvalue('doorverwijzing_intern','OCMW'); ?> >OCMW</option>

       <option <?= selectvalue('doorverwijzing_intern','paramedische hulp'); ?> >paramedische hulp</option>

       <option <?= selectvalue('doorverwijzing_intern','ziekenfonds'); ?> >ziekenfonds</option>

       <option <?= selectvalue('doorverwijzing_intern','CAW - slachtofferhulp'); ?> >CAW - slachtofferhulp</option>

       <option <?= selectvalue('doorverwijzing_intern','CGG'); ?> >CGG</option>

       <option <?= selectvalue('doorverwijzing_intern','expertisecentrum dementie'); ?> >expertisecentrum dementie</option>

       <option <?= selectvalue('doorverwijzing_intern','dienstencentrum'); ?> >dienstencentrum</option>

       <option <?= selectvalue('doorverwijzing_intern','dienst voor kortverblijf'); ?> >dienst voor kortverblijf</option>

       <option <?= selectvalue('doorverwijzing_intern','dagverzorgingscentrum'); ?> >dagverzorgingscentrum</option>

       <option <?= selectvalue('doorverwijzing_intern','ziekenhuis'); ?> >ziekenhuis</option>

       <option <?= selectvalue('doorverwijzing_intern','RVT'); ?> >woonzorgcentra</option>

       <option <?= selectvalue('doorverwijzing_intern','andere'); ?> >andere</option>

     </select>

   <br/>

     Extern: <select name="doorverwijzing_extern">

       <option value="">-- maak een keuze --</option>

       <option <?= selectvalue('doorverwijzing_extern','Antwerpen'); ?> >Antwerpen</option>

       <option <?= selectvalue('doorverwijzing_extern','Limburg'); ?> >Limburg</option>

       <option <?= selectvalue('doorverwijzing_extern','Oost-Vlaanderen'); ?> >Oost-Vlaanderen</option>

       <option <?= selectvalue('doorverwijzing_extern','Vlaams-Brabant'); ?> >Vlaams-Brabant</option>

       <option <?= selectvalue('doorverwijzing_extern','West-Vlaanderen'); ?> >West-Vlaanderen</option>

       <option <?= selectvalue('doorverwijzing_extern','Brussel'); ?> >Brussel</option>

       <option <?= selectvalue('doorverwijzing_extern','Vlaams Meldpunt'); ?> >Vlaams Meldpunt</option>

     </select>

   </div>



  </td>

</tr>

<?php

  if ($oud['bekendheid']==1 || $oud['bekendheid']==2) {

    print("<script type=\"text/javascript\">toonDoorverwijzing();</script>");

  }

}

else {

  // g��n bekendheid voor OC TGZ

}

?>

<tr>

  <td valign="top">Melder-soort <span class="reqfield">*</span></td>

  <td>

     <input type="radio" name="meldersoort" id="meldersoort0" value="hulpverleners"  <?= radiovalue('melder_soort','hulpverleners') ?>

            onclick="toonHVL();verbergAnder();"/><?= radioprintvalue('melder_soort','hulpverleners') ?>hulpverlener

       -- <input type="radio" name="meldersoort" id="meldersoort1" value="slachtoffer"  <?= radiovalue('melder_soort', 'slachtoffer') ?>

                 onclick="verbergHVL();verbergAnder();"/><?= radioprintvalue('melder_soort', 'slachtoffer') ?>slachtoffer zelf

       -- <input type="radio" name="meldersoort" id="meldersoort2" value="ander"  <?= radiovalue('melder_soort', 'ander') ?>

                 onclick="verbergHVL();toonAnder();"/><?= radioprintvalue('melder_soort', 'ander') ?>ander

  </td>

</tr>

</table>

<table id="hvldeel1" style="display:none;">

<?php

  if (!isset($overlegID) ||  $overlegID == 0) {

?>

<tr>

  <td><label for="meldernaam">Naam</label></td>

  <td>

      <input type="text" name="meldernaam" id="meldernaam" onclick="zoekPersoon($RF('meldersoort',3),'melder');" onkeyup="zoekPersoon($RF('meldersoort',3),'melder');"/>

  </td>

</tr>

<tr>

  <td valign="top" rowspan="2"><label for="meldervoornaam">Voornaam</label></td>

  <td>

      <input type="text" name="meldervoornaam" id="meldervoornaam" onclick="zoekPersoon($RF('meldersoort',3),'melder');" onkeyup="zoekPersoon($RF('meldersoort',3),'melder');"/>

  </td>

</tr>

<tr>

  <td>

     <input type="hidden" name="melderid" id="melderid" <?= value('melderhvl_id') ?> /><br/>

     <div id="melderinfo">

<?php

     // HIER MELDERGEGEVENS TOEVOEGEN!!

     if ($oud['melderhvl_id'] > 0) {

         $query = "select hulpverleners.*, gemeente.dlzip, gemeente.dlnaam,

                          concat(functies.naam, ' <br/>') as discipline,

                          org.naam as orgnaam

              from (hulpverleners left join gemeente on hulpverleners.gem_id = gemeente.id)

                   left join organisatie org on org.id = organisatie

                   ,functies

             where functies.id = fnct_id and hulpverleners.id = {$oud['melderhvl_id']}";

         $result = mysql_query($query);

         $aantal = mysql_num_rows($result);

         $rij = mysql_fetch_assoc($result);

         if ($rij['adres']=="") {

           $rij['adres']=$rij['orgnaam'];

           $rij['dlzip']=$rij['dlnaam']="";

         }



         print("<p style=\"font-weight:bold\">{$rij['naam']} {$rij['voornaam']} <br/>

                                           {$rij['discipline']}

                                           {$rij['adres']}<br/>

                                           {$rij['dlzip']} {$rij['dlnaam']}<br/>

                                           {$rij['tel']}<br/> {$rij['email']} </p>");

   }

?>



     </div>

    <div id="melderopties"></div>

  </td>

</tr>

<?php

  }

  else {

    if (!(isset($tabel))) {

      $tabel = "huidige";

    }

    if ($tabel == "huidige") {

       $voorwaarde = " bl.patient_code='{$_SESSION['pat_code']}' ";

    }

    else {

      $voorwaarde = " bl.overleg_id = $overlegID";

    }

    print("<tr><td>Selecteer de hulpverlener</td></tr>\n");

/********************************* begin opsomming hulpverleners ************************************/

    $queryHVL = "

         SELECT

                h.id,

                h.naam as hulpverlener_naam,

                h.voornaam as voornaam,

                f.naam as functie_naam,

                bl.persoon_id,

                h.riziv1,

                h.riziv2,

                h.riziv3,

                h.reknr,
                h.iban,
                h.bic,

                h.tel,

                h.organisatie,

                h.fnct_id,

                f.groep_id,

                aanwezig

            FROM

                {$tabel}_betrokkenen bl,

                functies f,

                hulpverleners h

                left join organisatie o on h.organisatie = o.id

            WHERE

                (bl.genre = 'hulp' or bl.genre = 'orgpersoon') AND

                h.fnct_id = f.id AND

                bl.persoon_id = h.id AND

                $voorwaarde

            ORDER BY

                f.rangorde, bl.id"; //



      if ($resultHVL=mysql_query($queryHVL))

         {

         for ($i=0; $i < mysql_num_rows ($resultHVL); $i++)

            {

            $recordsHVL= mysql_fetch_array($resultHVL);



            $veld1=($recordsHVL['hulpverlener_naam']!="")    ?$recordsHVL['hulpverlener_naam']    :"&nbsp;";

            $veld2=($recordsHVL['voornaam']!="")?$recordsHVL['voornaam']:"&nbsp;";

            $veld3=($recordsHVL['functie_naam']!="")   ?$recordsHVL['functie_naam']   :"&nbsp;";

            //$veld3=($recordsHVL['betrokhvl_zb']==1) ?$veld3."<br />Zorgbemiddelaar" :$veld3;

            if (isset($recordsHVL['riziv1']) && $recordsHVL['riziv1'] != 0) {

              $titel = $rizivnr=   "rizivnr : " . substr($recordsHVL['riziv1'],0,1)."-".

                                   substr($recordsHVL['riziv1'],1,5)."-".

                                   $recordsHVL['riziv2']."-".$recordsHVL['riziv3'];

            }

            else {

              // organisatie ophalen

              if (issett($recordsHVL['organisatie'])) {

                 $orgNaam = mysql_fetch_array(mysql_query("select naam from organisatie where id = {$recordsHVL['organisatie']}"));

                 $titel = $orgNaam['naam'];

              }

              else

                $titel = $recordsHVL['tel'];

            }



            print ("



                <tr title=\"$titel\">

                <td>

                    <input type=\"radio\" name=\"melderid\" id=\"melderid$i\"

                           value=\"{$recordsHVL['id']}\" " . radiovalue('melderhvl_id',$recordsHVL['id'])  . "

                           onclick=\"$('meldernaam').value=\'{$recordsHVL['hulpverlener_naam']}\'$('meldervoornaam').value=\'{$recordsHVL['voornaam']}\';;\"

                           />".

                           radioprintvalue('melderhvl_id',$recordsHVL['id']) . "

                    $veld1 $veld2 -- $veld3

                </td>

                </tr>\n");

           }

      }

/********************************* einde opsomming hulpverleners ************************************/

  }

?>

</table>

<table id="anderdeel1" style="display:none;">

<tr>

  <td>

    <label for="meldernaam">Naam en voornaam</label>

  </td>

  <td>

    <input type="text" name="meldernaam" id="meldernaam"  <?= value('melder_naam') ?> />

  </td>

</tr>

<tr>

  <td>

    <label for="melderadres">Adres</label>

  </td>

  <td>

    <input type="text" name="melderadres" id="melderadres"  <?= value('melder_adres') ?> />

  </td>

</tr>

<tr>

  <td>

    <label for="meldergemeente">Postcode</label>

  </td>

  <td>

<?php

  if ($oud['melder_gemeente']>0) {

     $qry1 = "select dlzip, dlnaam from gemeente where id = {$oud['melder_gemeente']}";

     $pc = mysql_fetch_assoc(mysql_query($qry1));

     $oudegemeente = "{$pc['dlzip']} {$pc['dlnaam']}";

  }

?>

      <input size="28"

                    onkeyup="refreshList('hoofdformulier','meldergemeente','meldergemeenteID',1,'IIPostCodeS',gemeenteList,20)"

                    onmouseup="showCombo('IIPostCodeS',100)" onfocus="showCombo('IIPostCodeS',100)"

                    type="text" name="meldergemeente" value="<?= $oudegemeente ?>" />

      <input type="button" onclick="resetList('hoofdformulier','meldergemeente','meldergemeenteID',1,'IIPostCodeS',gemeenteList,20,100)" value="<<" />

      <div id="IIPostCodeS" style="display:none;">

        <div style="float:left;">Kies eventueel : &nbsp; &nbsp;</div>

        <div style="float:left;"><select

                  onclick="handleSelectClick('hoofdformulier','meldergemeente','meldergemeenteID',1,'IIPostCodeS')"

                  onblur="handleSelectClick('hoofdformulier','meldergemeente','meldergemeenteID',1,'IIPostCodeS')"

                  name="meldergemeenteID" size="5">

<?php

  if ($oud['melder_gemeente']>0) {

     print("<option value=\"{$oud['melder_gemeente']}\" selected=\"selected\" class=\"printselected\">$oudegemeente</option>");

  }

?>

                  </select>

        </div>

      </div>

  </td>

</tr>

<tr>

  <td>

    <label for="meldertelefoon">Telefoon</label>

  </td>

  <td>

    <input type="text" name="meldertelefoon" id="meldertelefoon"  <?= value('melder_telefoon') ?> />

  </td>

</tr>

<tr>

  <td>

    <label for="melderemail">Email</label>

  </td>

  <td>

    <input type="text" name="melderemail" id="melderemail"  <?= value('melder_email') ?> />

  </td>

</tr>

<tr>

  <td>

    <label for="melder_relatie">Relatie met slachtoffer <span class="reqfield">*</span></label>

  </td>

  <td>

    <select name="melder_relatie" id="melder_relatie">

      <option value="-1">-- maak een keuze --</option>

<?php

  $qry = "select * from omb_hoofdrelatie order by id";

  $result = mysql_query($qry);

  for ($i=0; $i < mysql_num_rows($result); $i++) {

    $rij = mysql_fetch_assoc($result);

    print("<option value=\"{$rij['id']}\"" . selectvalue('melder_relatie',$rij['id']) . ">{$rij['hoofdrelatie']}</option>\n");

  }

?>

    </select>

  </td>

</tr>

<tr>

  <td>

    <label for="melder_relatiedetail">Relatiedetail</label>

  </td>

  <td>

    <input type="text" name="melder_relatiedetail" id="melder_relatiedetail"   <?= value('melder_relatiedetail') ?>/>

  </td>

</tr>

</table>

<?php

  if ($oud['melder_soort']=='hulpverleners') {

    print("<script type=\"text/javascript\">toonHVL();</script>");

  }

  if ($oud['melder_soort']=='ander') {

    print("<script type=\"text/javascript\">toonAnder();</script>");

  }

?>



  </div>



  <div class="tabcontent" id="Slachtoffer">

    Slachtoffer

<table id="tabelslachtoffer">

<tr>

  <td>

    <label for="slachtoffernaam">Naam en voornaam</label>

  </td>

  <td>

    <input type="text" name="slachtoffernaam" id="slachtoffernaam" <?= value('slachtoffer_naam') ?> />

  </td>

</tr>

<tr>

  <td>

    <label for="slachtofferleeftijd">Leeftijd  <span class="reqfield">*</span> - Geslacht <span class="reqfield">*</span></label>

  </td>

  <td>

    <input type="text" name="slachtofferleeftijd" id="slachtofferleeftijd" style="width:40px;" <?= value('slachtoffer_leeftijd') ?>

        onblur="if (parseInt(this.value)<54) alert('Het slachtoffer moet minstens 55 zijn voor een registratie van ouderenmis(be)handeling.');" /> &nbsp;

    <input type="radio" name="slachtoffergeslacht" id="slachtoffergeslacht0" value="M" <?= radiovalue('slachtoffer_geslacht','M') ?> /><?= radioprintvalue('slachtoffer_geslacht','M') ?>M &nbsp;&nbsp;

    <input type="radio" name="slachtoffergeslacht" id="slachtoffergeslacht1" value="V" <?= radiovalue('slachtoffer_geslacht','V') ?> /><?= radioprintvalue('slachtoffer_geslacht','V') ?>V &nbsp;&nbsp;

    <input type="radio" name="slachtoffergeslacht" id="slachtoffergeslacht2" value=""  <?= radiovalue('slachtoffer_geslacht','') ?> /><?= radioprintvalue('slachtoffer_geslacht','') ?>onbekend &nbsp;&nbsp;

  </td>

</tr>

<tr>

  <td>

    <label for="slachtofferadres">Adres</label>

  </td>

  <td>

    <input type="text" name="slachtofferadres" id="slachtofferadres" <?= value('slachtoffer_adres') ?> />

  </td>

</tr>

<tr>

  <td>

    <label for="slachtoffergemeente">Postcode <span class="reqfield">*</span></label>

  </td>

  <td>

<?php

  if ($oud['slachtoffer_gemeente']>0) {

     $qryS = "select dlzip, dlnaam from gemeente where id = {$oud['slachtoffer_gemeente']}";

     $pcS = mysql_fetch_assoc(mysql_query($qryS));

     $oudegemeenteS = "{$pcS['dlzip']} {$pcS['dlnaam']}";

  }

?>

      <input size="28"

                    onkeyup="refreshList('hoofdformulier','slachtoffergemeente','slachtoffergemeenteID',1,'IIPostCodeS2',gemeenteList,20)"

                    onmouseup="showCombo('IIPostCodeS2',100)" onfocus="showCombo('IIPostCodeS2',100)"

                    type="text" name="slachtoffergemeente" id="slachtoffergemeente" value="<?= $oudegemeenteS ?>" />

      <input type="button" onclick="resetList('hoofdformulier','slachtoffergemeente','slachtoffergemeenteID',1,'IIPostCodeS2',gemeenteList,20,100)" value="<<" />

      <div id="IIPostCodeS2" style="display:none;">

        <div style="float:left;">Kies eventueel : &nbsp; &nbsp;</div>

        <div style="float:left;"><select

                  onclick="handleSelectClick('hoofdformulier','slachtoffergemeente','slachtoffergemeenteID',1,'IIPostCodeS2')"

                  onblur="handleSelectClick('hoofdformulier','slachtoffergemeente','slachtoffergemeenteID',1,'IIPostCodeS2')"

                  name="slachtoffergemeenteID" id="slachtoffergemeenteID" size="5">

<?php

  if ($oud['slachtoffer_gemeente']>0) {

     print("<option value=\"{$oud['slachtoffer_gemeente']}\" selected=\"selected\" class=\"printselected\">$oudegemeenteS</option>");

  }

?>

                  </select>

        </div>

      </div>

  </td>

</tr>

<tr>

  <td>

    <label for="slachtoffertelefoon">Telefoon</label>

  </td>

  <td>

    <input type="text" name="slachtoffertelefoon" id="slachtoffertelefoon" <?= value('slachtoffer_telefoon') ?> />

  </td>

</tr>

<tr>

  <td>

    <label for="slachtofferemail">Email</label>

  </td>

  <td>

    <input type="text" name="slachtofferemail" id="slachtofferemail" <?= value('slachtoffer_email') ?> />

  </td>

</tr>

<tr>

  <td>

    <label for="probleemfactor[slachtoffer][0]">Probleemfactor 1  <span class="reqfield">*</span></label>

  </td>

  <td>

    <select name="probleemfactor[slachtoffer][0]" id="probleemfactor[slachtoffer][0]" onchange="extraProbleemfactor('slachtoffer',0);">

      <option value="-1">-- maak een keuze --</option>

<?php

  $qry = "select * from omb_probleemfactor order by id";

  $result = mysql_query($qry);

  for ($i=0; $i < mysql_num_rows($result); $i++) {

    $rij = mysql_fetch_assoc($result);

    print("<option value=\"{$rij['id']}\">{$rij['probleemfactor']}</option>\n");

  }

?>

    </select>

    <label for="probleemdetail[slachtoffer][0]">Detail : </label>

    <input type="text" style="width:125px;" name="probleemdetail[slachtoffer][0]" id="probleemdetail[slachtoffer][0]" />

  </td>

</tr>

<tr>

  <td>

    Is hij/zij op de hoogte<br/>van de melding?

  </td>

  <td>

    <input type="radio" name="slachtoffer_weetmelding" id="slachtoffer_weetmelding0" value="1" <?= radiovalue('slachtoffer_weetmelding','1') ?> /><?= radioprintvalue('slachtoffer_weetmelding','1') ?>ja &nbsp;

    <input type="radio" name="slachtoffer_weetmelding" id="slachtoffer_weetmelding1" value="-1" <?= radiovalue('slachtoffer_weetmelding','-1') ?> /><?= radioprintvalue('slachtoffer_weetmelding','-1') ?>nee &nbsp;

    <input type="radio" name="slachtoffer_weetmelding" id="slachtoffer_weetmelding2" value="" <?= radiovalue('slachtoffer_weetmelding','') ?> /><?= radioprintvalue('slachtoffer_weetmelding','') ?>onbekend &nbsp;

  </td>

</tr>

<tr>

  <td>

    Beleeft hij/zij dit<br/> als mis(be)handeling?

  </td>

  <td>

    <input type="radio" name="slachtoffer_ervaartmishandeling" id="slachtoffer_ervaartmishandeling0" value="1" <?= radiovalue('slachtoffer_ervaartmishandeling','1') ?> /><?= radioprintvalue('slachtoffer_ervaartmishandeling','1') ?>ja &nbsp;

    <input type="radio" name="slachtoffer_ervaartmishandeling" id="slachtoffer_ervaartmishandeling1" value="-1" <?= radiovalue('slachtoffer_ervaartmishandeling','-1') ?> /><?= radioprintvalue('slachtoffer_ervaartmishandeling','-1') ?>nee &nbsp;

    <input type="radio" name="slachtoffer_ervaartmishandeling" id="slachtoffer_ervaartmishandeling2" value="" <?= radiovalue('slachtoffer_ervaartmishandeling','') ?> /><?= radioprintvalue('slachtoffer_ervaartmishandeling','') ?>onbekend &nbsp;

  </td>

</tr>

<tr>

  <td>

    Leeft hij/zij samen?

  </td>

  <td>

    <input type="radio" name="samenwonen" id="samenwonen0" value="1" <?= radiovalue('samenwonen','1') ?> /><?= radioprintvalue('samenwonen','1') ?>ja &nbsp;

    <input type="radio" name="samenwonen" id="samenwonen1" value="-1" <?= radiovalue('samenwonen','-1') ?> /><?= radioprintvalue('samenwonen','-1') ?>nee &nbsp;

    <input type="radio" name="samenwonen" id="samenwonen2" value="" <?= radiovalue('samenwonen','') ?> /><?= radioprintvalue('samenwonen','') ?>onbekend &nbsp;

    <input type="radio" name="samenwonen" id="samenwonen1" value="2" <?= radiovalue('samenwonen','2') ?> /><?= radioprintvalue('samenwonen','2') ?>andere vorm (vul in)

  </td>

</tr>

<tr>

  <td>

    <label for="samenwonen_detail">Details over samenwonen<br/> (vooral voor 'andere vorm')</label>

  </td>

  <td>

    <input type="text" name="samenwonen_detail" id="samenwonen_detail" <?= value('samenwonen_detail') ?> />

  </td>

</tr>

<tr>

  <td>

    Meerdere slachtoffers? <span class="reqfield">*</span>

  </td>

  <td>

    <input type="radio" name="slachtoffer_meer" id="slachtoffer_meer0" value="1" <?= radiovalue('slachtoffer_meer','1') ?> /><?= radioprintvalue('slachtoffer_meer','1') ?>ja &nbsp;

    <input type="radio" name="slachtoffer_meer" id="slachtoffer_meer1" value="-1" <?= radiovalue('slachtoffer_meer','-1') ?> /><?= radioprintvalue('slachtoffer_meer','-1') ?>nee &nbsp;

    <input type="radio" name="slachtoffer_meer" id="slachtoffer_meer2" value="" <?= radiovalue('slachtoffer_meer','') ?> /><?= radioprintvalue('slachtoffer_meer','') ?>onbekend &nbsp;

  </td>

</tr>

<tr>

  <td>

    <label for="slachtoffer_meer_detail">Wie exact?</label>

  </td>

  <td>

    <input type="text" name="slachtoffer_meer_detail" id="slachtoffer_meer_detail" <?= value('slachtoffer_meer_detail') ?> />

  </td>

</tr>

</table>



  </div>



  <div class="tabcontent" id="Plegers">

    Pleger

<table id="tabelpleger">

<tr>

  <td>

    <label for="plegernaam">Naam en voornaam</label>

  </td>

  <td>

    <input type="text" name="plegernaam" id="plegernaam" <?= value('pleger_naam') ?> />

  </td>

</tr>

<tr>

  <td>

    <label for="plegerleeftijd">Leeftijd  <span class="reqfield">*</span> - Geslacht  <span class="reqfield">*</span></label>

  </td>

  <td>

    <input type="text" name="plegerleeftijd" id="plegerleeftijd" style="width:40px;" <?= value('pleger_leeftijd') ?> /> &nbsp;

    <input type="radio" name="plegergeslacht" id="plegergeslacht0" value="M" <?= radiovalue('pleger_geslacht','M') ?> /><?= radioprintvalue('pleger_geslacht','M') ?>M &nbsp;&nbsp;

    <input type="radio" name="plegergeslacht" id="plegergeslacht1" value="V" <?= radiovalue('pleger_geslacht','V') ?> /><?= radioprintvalue('pleger_geslacht','V') ?>V &nbsp;&nbsp;

    <input type="radio" name="plegergeslacht" id="plegergeslacht2" value="" <?= radiovalue('pleger_geslacht','') ?> /><?= radioprintvalue('pleger_geslacht','') ?>onbekend &nbsp;&nbsp;

  </td>

</tr>

<tr>

  <td>

    <label for="plegeradres">Adres</label>

  </td>

  <td>

    <input type="text" name="plegeradres" id="plegeradres" <?= value('pleger_adres') ?> />

  </td>

</tr>

<tr>

  <td>

    <label for="plegergemeente">Postcode</label>

  </td>

  <td>

<?php

  if ($oud['pleger_gemeente']>0) {

     $qryP = "select dlzip, dlnaam from gemeente where id = {$oud['pleger_gemeente']}";

     $pcP = mysql_fetch_assoc(mysql_query($qryP));

     $oudegemeenteP = "{$pcP['dlzip']} {$pcP['dlnaam']}";

  }

?>

      <input size="28"

                    onkeyup="refreshList('hoofdformulier','plegergemeente','plegergemeenteID',1,'IIPostCodeS3',gemeenteList,20)"

                    onmouseup="showCombo('IIPostCodeS3',100)" onfocus="showCombo('IIPostCodeS3',100)"

                    type="text" name="plegergemeente" value="<?= $oudegemeenteP ?>" />

      <input type="button" onclick="resetList('hoofdformulier','plegergemeente','plegergemeenteID',1,'IIPostCodeS3',gemeenteList,20,100)" value="<<" />

      <div id="IIPostCodeS3" style="display:none;">

        <div style="float:left;">Kies eventueel : &nbsp; &nbsp;</div>

        <div style="float:left;"><select

                  onclick="handleSelectClick('hoofdformulier','plegergemeente','plegergemeenteID',1,'IIPostCodeS3')"

                  onblur="handleSelectClick('hoofdformulier','plegergemeente','plegergemeenteID',1,'IIPostCodeS3')"

                  name="plegergemeenteID" size="5">

<?php

  if ($oud['pleger_gemeente']>0) {

     print("<option value=\"{$oud['pleger_gemeente']}\" selected=\"selected\" class=\"printselected\">$oudegemeenteP</option>");

  }

?>

                  </select>

        </div>

      </div>

  </td>

</tr>

<tr>

  <td>

    <label for="plegertelefoon">Telefoon</label>

  </td>

  <td>

    <input type="text" name="plegertelefoon" id="plegertelefoon" <?= value('pleger_telefoon') ?> />

  </td>

</tr>

<tr>

  <td>

    <label for="probleemfactor[pleger][0]">Probleemfactor 1  <span class="reqfield">*</span></label>

  </td>

  <td>

    <select name="probleemfactor[pleger][0]" id="probleemfactor[pleger][0]" onchange="extraProbleemfactor('pleger',0);">

      <option value="-1">-- maak een keuze --</option>

<?php

  $qry = "select * from omb_probleemfactor order by id";

  $result = mysql_query($qry);

  for ($i=0; $i < mysql_num_rows($result); $i++) {

    $rij = mysql_fetch_assoc($result);

    print("<option value=\"{$rij['id']}\">{$rij['probleemfactor']}</option>\n");

  }

?>

    </select>

    <label for="probleemdetail[pleger][0]">Detail : </label>

    <input type="text" style="width:125px;" name="probleemdetail[pleger][0]" id="probleemdetail[pleger][0]" />

  </td>

</tr>

<tr>

  <td>

    Is hij/zij op de hoogte<br/>van de melding?

  </td>

  <td>

    <input type="radio" name="pleger_weetmelding" id="pleger_weetmelding0" value="1" <?= radiovalue('pleger_opdehoogte','1') ?> /><?= radioprintvalue('pleger_opdehoogte','1') ?>ja &nbsp;&nbsp;

    <input type="radio" name="pleger_weetmelding" id="pleger_weetmelding1" value="-1" <?= radiovalue('pleger_opdehoogte','-1') ?> /><?= radioprintvalue('pleger_opdehoogte','-1') ?>nee &nbsp;&nbsp;

    <input type="radio" name="pleger_weetmelding" id="pleger_weetmelding2" value="" <?= radiovalue('pleger_opdehoogte','') ?> /><?= radioprintvalue('pleger_opdehoogte','') ?>onbekend &nbsp;&nbsp;

  </td>

</tr>

<tr>

  <td>

    <label for="pleger_relatie">Relatie<br/> met slachtoffer</label> <span class="reqfield">*</span>

  </td>

  <td>

    <select name="pleger_relatie" id="pleger_relatie">

      <option value="-1">-- maak een keuze --</option>

<?php

  $qry = "select * from omb_hoofdrelatie where id > 1 order by id";

  $result = mysql_query($qry);

  for ($i=0; $i < mysql_num_rows($result); $i++) {

    $rij = mysql_fetch_assoc($result);

    print("<option value=\"{$rij['id']}\"" . selectvalue('pleger_relatie',$rij['id']) . ">{$rij['hoofdrelatie']}</option>\n");

  }

?>

    </select>

  </td>

</tr>

<tr>

  <td>

    <label for="pleger_relatiedetail">Relatiedetail</label>

  </td>

  <td>

    <input type="text" name="pleger_relatiedetail" id="pleger_relatiedetail" <?= value('pleger_relatiedetail') ?> />

  </td>

</tr>

<tr>

  <td>

    Aantal plegers

  </td>

  <td>

    <input type="radio" name="pleger_aantal" id="pleger_aantal0" value="1" <?= radiovalue('plegers_aantal','1') ?> /><?= radioprintvalue('plegers_aantal','1') ?>1 &nbsp;&nbsp;

    <input type="radio" name="pleger_aantal" id="pleger_aantal1" value="2" <?= radiovalue('plegers_aantal','2') ?> /><?= radioprintvalue('plegers_aantal','2') ?>2 &nbsp;&nbsp;

    <input type="radio" name="pleger_aantal" id="pleger_aantal2" value="meer" <?= radiovalue('plegers_aantal','meer') ?> /><?= radioprintvalue('plegers_aantal','meer') ?>meer &nbsp;&nbsp;

    <input type="radio" name="pleger_aantal" id="pleger_aantal3" value="" <?= radiovalue('plegers_aantal','') ?> /><?= radioprintvalue('plegers_aantal','') ?>onbekend &nbsp;&nbsp;

  </td>

</tr>

<tr>

  <td>

    <label for="pleger_aantaldetail">Meer info over<br/>de plegers</label>

  </td>

  <td>

    <input type="text" name="pleger_aantaldetail" id="pleger_aantaldetail" <?= value('plegers_extra') ?> />

  </td>

</tr>

</table>



  </div>



  <div class="tabcontent" id="Mishandeling">

    Details over de mis(be)handeling

<table id="tabelaanmelding">

<tr>

  <td valign="top">

    <label for="situatieschets">Situatieschets <span class="reqfield">*</span></label>

  </td>

  <td>

    <textarea name="situatieschets" id="situatieschets" ><?= $oud['situatieschets'] ?></textarea>

  </td>

</tr>



<tr>

  <td valign="top">

    <label for="vorige">Al een melding gedaan?<br/>Geef dan hier het nummer</label>

  </td>

  <td>

    <input type="text" name="vorige" id="vorige" <?= value('vorige') ?>  style="margin-left: -1px;"/>

  </td>

</tr>



<tr>

  <td>

    <label for="mishandelvorm[aanmelding][0]">Vorm 1  <span class="reqfield">*</span></label>

  </td>

  <td>

    <select name="mishandelvorm[aanmelding][0]" id="mishandelvorm[aanmelding][0]" onchange="extraVorm('aanmelding',0);">

      <option value="-1">-- maak een keuze --</option>

<?php

  $qry = "select * from omb_mishandeling order by id";

  $result = mysql_query($qry);

  for ($i=0; $i < mysql_num_rows($result); $i++) {

    $rij = mysql_fetch_assoc($result);

    print("<option value=\"{$rij['id']}\">{$rij['mishandeling']}</option>\n");

  }

?>

    </select>

  </td>

</tr>

<?php

  if ($_GET['print']==1) {

    // aangemelde vorm

    $qryVorm = "select omb_mishandeling.mishandeling from omb_mishandelvorm, omb_mishandeling

                     where registratie_id = {$oud['id']}

                       and genre = 'aanmelding'

                       and omb_mishandelvorm.mishandeling = omb_mishandeling.id";

    $resultVorm = mysql_query($qryVorm) or die($qryVorm);

    if (mysql_num_rows($resultVorm)>2) {

      print("<tr><td colspan=\"2\">Multiple probleem: <strong>ja</strong></td></tr>");

    }

  }

?>

<tr>

  <td>

    Is justitie op de hoogte?  <span class="reqfield">*</span>

  </td>

  <td>

    <input type="radio" name="justitie_weetmelding" id="justitie_weetmelding0" value="1" onclick="toonJustitie();" <?= radiovalue('justitie_weetmelding','1') ?>/><?= radioprintvalue('justitie_weetmelding','1') ?>ja &nbsp;

    <input type="radio" name="justitie_weetmelding" id="justitie_weetmelding1" value="-1" onclick="verbergJustitie();" <?= radiovalue('justitie_weetmelding','-1') ?> /><?= radioprintvalue('justitie_weetmelding','-1') ?>nee &nbsp;

    <input type="radio" name="justitie_weetmelding" id="justitie_weetmelding2" value=""  onclick="verbergJustitie();" <?= radiovalue('justitie_weetmelding','') ?>/><?= radioprintvalue('justitie_weetmelding','') ?>onbekend &nbsp;

  </td>

</tr>

<tr id="justitiedeel1" style="visibility:hidden">

  <td>

    <label for="justitie_soort">Welke justitie?  <span class="reqfield">*</span></label>

  </td>

  <td>

    <select name="justitie_soort" id="visibility:hidden">

      <option value="-1">-- maak een keuze --</option>

<?php

  $qry = "select * from omb_justitie order by id";

  $result = mysql_query($qry);

  for ($i=0; $i < mysql_num_rows($result); $i++) {

    $rij = mysql_fetch_assoc($result);

    print("<option value=\"{$rij['id']}\" " . selectvalue('justitie_soort',$rij['id']) . ">{$rij['justitie']}</option>\n");

  }

?>

    </select>

  </td>

</tr>

<tr id="justitiedeel2" style="visibility:hidden">

  <td valign="top">

    <label for="justitie_detail">Details over justitie (wie, ...)</label>

  </td>

  <td>

    <textarea name="justitie_detail" id="justitie_detail" ><?= $oud['justitie_detail'] ?></textarea>

  </td>

</tr>

<?php

  if ($oud['justitie_weetmelding']==1) {

    print("<script type=\"text/javascript\">toonJustitie();</script>");

  }

?>

</table>

  </div>



  <div class="tabcontent" id="Hulp">

    Hulp

<table id="tabelhulp">

<tr>

  <td>

    <label for="hulp[0]">Hulpsoort 1</label>

  </td>

  <td>

    <select name="hulp[0]" id="hulp[0]" onchange="extraHulp(0);">

      <option value="-1">-- maak een keuze --</option>

<?php

  $qry = "select * from omb_hulpvorm order by id";

  $result = mysql_query($qry);

  for ($i=0; $i < mysql_num_rows($result); $i++) {

    $rij = mysql_fetch_assoc($result);

    print("<option value=\"{$rij['id']}\">{$rij['hulpvorm']}</option>\n");

  }

?>

    </select>

  </td>

</tr>

<tr>

  <td>

    <label for="hulpdetail[0]">Hulpdetail 1</label>

  </td>

  <td>

    <input type="text" name="hulpdetail[0]" id="hulpdetail[0]" style="width:333px;"/>

  </td>

</tr>

</table>

  </div>



  <div class="tabcontent" id="Mantelzorgers">

    Mantelzorgers &amp; contactpersonen

<table>

<tr>

  <td>

    Zijn er mantelzorgers aanwezig?

  </td>

  <td>

    <input type="radio" name="mantelzorgers_aanwezig" id="mantelzorgers_aanwezig0" value="1" <?= radiovalue('mantelzorgers_aanwezig','1') ?> /><?= radioprintvalue('mantelzorgers_aanwezig','1') ?>ja &nbsp;&nbsp;

    <input type="radio" name="mantelzorgers_aanwezig" id="mantelzorgers_aanwezig1" value="-1" <?= radiovalue('mantelzorgers_aanwezig','-1') ?> /><?= radioprintvalue('mantelzorgers_aanwezig','-1') ?>nee &nbsp;&nbsp;

    <input type="radio" name="mantelzorgers_aanwezig" id="mantelzorgers_aanwezig2" value="" <?= radiovalue('mantelzorgers_aanwezig','') ?> /><?= radioprintvalue('mantelzorgers_aanwezig','') ?>onbekend &nbsp;&nbsp;

  </td>

</tr>

<tr>

  <td valign="top">

    <label for="mantelzorgers_detail">Details over mantelzorgers (wie, ...)</label>

  </td>

  <td>

    <textarea name="mantelzorgers_detail" id="mantelzorgers_detail" ><?= $oud['mantelzorgers_detail'] ?></textarea>

  </td>

</tr>

<tr>

  <td>

    Zijn er andere contactpersonen aanwezig?

  </td>

  <td>

    <input type="radio" name="contactpersonen_aanwezig" id="contactpersonen_aanwezig0" value="1" <?= radiovalue('contactpersonen_aanwezig','1') ?> /><?= radioprintvalue('contactpersonen_aanwezig','1') ?>ja &nbsp;&nbsp;

    <input type="radio" name="contactpersonen_aanwezig" id="contactpersonen_aanwezig1" value="-1" <?= radiovalue('contactpersonen_aanwezig','-1') ?> /><?= radioprintvalue('contactpersonen_aanwezig','-1') ?>nee &nbsp;&nbsp;

    <input type="radio" name="contactpersonen_aanwezig" id="contactpersonen_aanwezig2" value="" <?= radiovalue('contactpersonen_aanwezig','') ?> /><?= radioprintvalue('contactpersonen_aanwezig','') ?>onbekend &nbsp;&nbsp;

  </td>

</tr>

<tr>

  <td valign="top">

    <label for="contactpersonen_detail">Details over deze contactpersonen (wie, ...)</label>

  </td>

  <td>

    <textarea name="contactpersonen_detail" id="contactpersonen_detail" ><?= $oud['contactpersonen_detail'] ?></textarea>

  </td>

</tr>

</table>

  </div>



<?php

  if (($_SESSION['profiel']=="listel") || ($_SESSION['profiel']=="caw")) {

?>

  <div class="tabcontent" id="Opvolging">

    Opvolging en afsluiting



<p>Download eventueel ook <a href="/opvolgingsformulierOMB.doc">het opvolgingsformulier</a> in Word-versie.</p>

    

<table id="tabelopvolging">

<tr>

  <td>

    Is er opvolging door het steunpunt?

  </td>

  <td>

    <input type="radio" name="opvolging_steunpunt" id="opvolging_steunpunt0" value="1" <?= radiovalue('opvolging_steunpunt','1') ?> /><?= radioprintvalue('opvolging_steunpunt','1') ?>ja &nbsp;&nbsp;

    <input type="radio" name="opvolging_steunpunt" id="opvolging_steunpunt1" value="-1" <?= radiovalue('opvolging_steunpunt','-1') ?> /><?= radioprintvalue('opvolging_steunpunt','-1') ?>nee &nbsp;&nbsp;

    <input type="radio" name="opvolging_steunpunt" id="opvolging_steunpunt2" value="" <?= radiovalue('opvolging_steunpunt','') ?> /><?= radioprintvalue('opvolging_steunpunt','') ?>onbekend &nbsp;&nbsp;

  </td>

</tr>

<tr>

  <td>

    <label for="standvanzaken">Stand van zaken</label>

  </td>

  <td>

    <select name="standvanzaken" id="standvanzaken" >

      <option value="-1">-- maak een keuze --</option>

<?php

  $qry = "select * from omb_standvanzaken order by id";

  $result = mysql_query($qry);

  for ($i=0; $i < mysql_num_rows($result); $i++) {

    $rij = mysql_fetch_assoc($result);

    print("<option value=\"{$rij['id']}\" " . selectvalue('standvanzaken',$rij['id']) . ">{$rij['standvanzaken']}</option>\n");

  }

?>

    </select>

  </td>

</tr>





<tr>

  <td>

    <label for="afronddag">Datum (dd/mm/jjjj)</label>

  </td>

  <td>

    <input style="width:25px;" <?= $disable ?> type="text" size="2" <?= value('afsluiten_dag') ?> name="afronddd" id="afronddd"

       onkeyup="checkForNumbersOnly(this,2,0,31,'hoofdformulier','afrondmm')"

       onblur="checkForNumbersLength(this,2)" />&nbsp;/&nbsp;

    <input style="width:25px;" <?= $disable ?> type="text" size="2" <?= value('afsluiten_maand') ?> name="afrondmm" id="afrondmm"

       onkeyup="checkForNumbersOnly(this,2,0,12,'hoofdformulier','afrondjjjj')"

       onblur="checkForNumbersLength(this,2)" />&nbsp;/&nbsp;

    <input style="width:50px;"  <?= $disable ?> type="text" size="2" <?= value('afsluiten_jaar') ?> name="afrondjjjj" id="afrondjjjj"

       onkeyup="checkForNumbersOnly(this,4,2000,2069,'hoofdformulier','afrondjjjj')"

       onblur="checkForNumbersLength(this,4)" />

  </td>

</tr>

<tr>

  <td>

    <label for="afronddetail">Meer info </label>

  </td>

  <td>

    <textarea id="afronddetail" name="afronddetail"><?= $oud['afsluiten_detail'] ?></textarea>



  </td>

</tr>

<tr>

  <tr>

    <td colspan="2">

    Uiteindelijke vorm(en) van ouderenmis(be)handeling<br/>

    </td>

  </tr>

</tr>

<tr>

  <td valign="top">

    <label for="mishandelvorm[opvolging][0]">Vorm 1</label>

  </td>

  <td valign="bottom">

    <select name="mishandelvorm[opvolging][0]" id="mishandelvorm[opvolging][0]" onchange="extraVorm('opvolging',0);">

      <option value="-1">-- maak een keuze --</option>

<?php

  $qry = "select * from omb_mishandeling order by id";

  $result = mysql_query($qry);

  for ($i=0; $i < mysql_num_rows($result); $i++) {

    $rij = mysql_fetch_assoc($result);

    print("<option value=\"{$rij['id']}\">{$rij['mishandeling']}</option>\n");

  }

?>

    </select>

  </td>

</tr>

<?php

  if ($_GET['print']==1) {

    // aangemelde vorm

    $qryVorm = "select omb_mishandeling.mishandeling from omb_mishandelvorm, omb_mishandeling

                     where registratie_id = {$oud['id']}

                       and genre = 'opvolging'

                       and omb_mishandelvorm.mishandeling = omb_mishandeling.id";

    $resultVorm = mysql_query($qryVorm) or die($qryVorm);

    if (mysql_num_rows($resultVorm)>2) {

      print("<tr><td colspan=\"2\">Multiple probleem: <strong>ja</strong></td></tr>");

    }

  }

?>

</table>

  </div>

<?php

  }

?>



<script type="text/javascript">

<?php

/****************************************

   bestaande mishandelvormen en zo

*****************************************/

  $qryFactor = "select * from omb_aanwezigeprobleemfactor

                     where registratie_id = 0$gevondenID

                       and wie = 'slachtoffer'";

  $resultFactor = mysql_query($qryFactor) or die($qryFactor);

  if (mysql_num_rows($resultFactor)>0) {

    //print("alert(" . mysql_num_rows($resultSlachtoffer) . ");");

    for ($i=0;$i <  mysql_num_rows($resultFactor);  $i++) {

      $rijFactor = mysql_fetch_assoc($resultFactor);

      print("  extraProbleemfactor('{$rijFactor['wie']}',$i); ");

      print("  selecteerProbleemfactor('{$rijFactor['wie']}',$i,'{$rijFactor['probleemfactor']}','{$rijFactor['detail']}'); ");

    }

  }

  $qryFactor = "select * from omb_aanwezigeprobleemfactor

                     where registratie_id = 0$gevondenID

                       and wie = 'pleger'";

  $resultFactor = mysql_query($qryFactor) or die($qryFactor);

  if (mysql_num_rows($resultFactor)>0) {

    //print("alert(" . mysql_num_rows($resultSlachtoffer) . ");");

    for ($i=0;$i <  mysql_num_rows($resultFactor);  $i++) {

      $rijFactor = mysql_fetch_assoc($resultFactor);

      print("  extraProbleemfactor('{$rijFactor['wie']}',$i); ");

      print("  selecteerProbleemfactor('{$rijFactor['wie']}',$i,'{$rijFactor['probleemfactor']}','{$rijFactor['detail']}'); ");

    }

  }



  $qryVorm = "select * from omb_mishandelvorm

                     where registratie_id = 0$gevondenID

                       and genre = 'aanmelding'";

  $resultVorm = mysql_query($qryVorm) or die($qryVorm);

  if (mysql_num_rows($resultVorm)>0) {

    //print("alert(" . mysql_num_rows($resultSlachtoffer) . ");");

    for ($i=0;$i <  mysql_num_rows($resultVorm);  $i++) {

      $rijVorm = mysql_fetch_assoc($resultVorm);

      print("  extraVorm('{$rijVorm['genre']}',$i); ");

      print("  selecteerVorm('{$rijVorm['genre']}',$i,'{$rijVorm['mishandeling']}'); ");

    }

  }



/* NOG TOE TE VOEGEN VOOR PRINT

  if (mysql_num_rows($resultVorm)>1) {

    $csvOutput .= '"' . "WAAR" . "\"$sep";

  }

  else {

    $csvOutput .= '"' . "ONWAAR" . "\"$sep";

  }

*/



  $qryVorm = "select * from omb_mishandelvorm

                     where registratie_id = 0$gevondenID

                       and genre = 'opvolging'";

  $resultVorm = mysql_query($qryVorm) or die($qryVorm);

  if (mysql_num_rows($resultVorm)>0) {

    //print("alert(" . mysql_num_rows($resultSlachtoffer) . ");");

    for ($i=0;$i <  mysql_num_rows($resultVorm);  $i++) {

      $rijVorm = mysql_fetch_assoc($resultVorm);

      print("  extraVorm('{$rijVorm['genre']}',$i); ");

      print("  selecteerVorm('{$rijVorm['genre']}',$i,'{$rijVorm['mishandeling']}'); ");

    }

  }



  $qryHulp = "select * from omb_hulp

                     where registratie_id = 0$gevondenID";

  $resultHulp = mysql_query($qryHulp) or die($qryHulp);

  if (mysql_num_rows($resultHulp)>0) {

    //print("alert(" . mysql_num_rows($resultSlachtoffer) . ");");

    for ($i=0;$i <  mysql_num_rows($resultHulp);  $i++) {

      $rijHulp = mysql_fetch_assoc($resultHulp);

      print("  extraHulp($i); ");

      print("  selecteerHulp($i,'{$rijHulp['genre']}','{$rijHulp['detail']}'); ");

    }

  }



function genreHulp($naam) {

  switch ($naam) {

     case "Huisarts":

       return 2;

       break;

     case "Thuisverpleegkundige":

       return 3;

       break;

     case "Deskundige ziekenhuiscentrum":

       return 16;

       break;

     default:

       return 1;

       break;

  }

}



if ($invullen) {

  // gegevens van het overleg invullen

  $leeftijd = date("Y")-substr($patientInfo['gebdatum'],0,4);

  if (date("m") < substr($patientInfo['gebdatum'],4,2)) $leeftijd--;

  else if ((date("m") == substr($patientInfo['gebdatum'],4,2)) && (date("d") < substr($patientInfo['gebdatum'],6,2))) $leeftijd--;



  $qryS = "select dlzip, dlnaam from gemeente where id = {$patientInfo['gem_id']}";

  $pcS = mysql_fetch_assoc(mysql_query($qryS));

  $oudegemeenteS = "{$pcS['dlzip']} {$pcS['dlnaam']}";

?>

  $('dd').value = "<?= substr($overlegInfo['datum'],6,2) ?>";

  $('mm').value = "<?= substr($overlegInfo['datum'],4,2) ?>";

  $('jjjj').value = <?= substr($overlegInfo['datum'],0,4) ?>;

  $('slachtoffernaam').value = "<?= $patientInfo['naam'] . " " . $patientInfo['voornaam'] ?>";

<?php

  if ($patientInfo['sex']==0) {

?>

    $('slachtoffergeslacht0').checked=true;

<?php

  }

  else if ($patientInfo['sex']==1) {

?>

    $('slachtoffergeslacht1').checked=true;

<?php

  }

?>



  $('slachtofferleeftijd').value = <?= $leeftijd ?>;

  $('slachtoffertelefoon').value = "<?= $patientInfo['tel'] . " " . $patientInfo['gsm'] ?>";

  $('slachtofferadres').value = "<?= $patientInfo['adres'] ?>";

  $('slachtofferemail').value = "<?= $patientInfo['email'] ?>";

  resetList('hoofdformulier','slachtoffergemeente','slachtoffergemeenteID',1,'IIPostCodeS2',gemeenteList,20,100);

  $('slachtoffergemeente').value = "<?= $oudegemeenteS ?>";

  refreshList('hoofdformulier','slachtoffergemeente','slachtoffergemeenteID',1,'IIPostCodeS2',gemeenteList,20);

  // hulp

<?php





/********************************* begin opsomming hulpverleners ************************************/

    $queryHVL = "

         SELECT

                h.naam as hulpverlener_naam,

                h.voornaam as voornaam,

                f.naam as functie_naam

            FROM

                huidige_betrokkenen bl,

                functies f,

                hulpverleners h

            WHERE

                (bl.genre = 'hulp' or bl.genre = 'orgpersoon') AND

                h.fnct_id = f.id AND

                bl.persoon_id = h.id AND

                bl.patient_code='{$_SESSION['pat_code']}'

            ORDER BY

                f.rangorde, bl.id"; //



      if ($resultHVL=mysql_query($queryHVL))

         {

           //die($queryHVL . "" . mysql_num_rows($resultHVL));

         for ($i=0; $i < mysql_num_rows ($resultHVL); $i++)

            {

            $recordsHVL= mysql_fetch_array($resultHVL);



            $veld1=($recordsHVL['hulpverlener_naam']!="")    ?$recordsHVL['hulpverlener_naam']    :"&nbsp;";

            $veld2=($recordsHVL['voornaam']!="")?$recordsHVL['voornaam']:"&nbsp;";

            $veld3=($recordsHVL['functie_naam']!="")   ?$recordsHVL['functie_naam']   :"&nbsp;";

            $nummer = genreHulp($recordsHVL['functie_naam']);

            print("  extraHulp($i); \n");

            print("  selecteerHulp($i,$nummer,\"$veld1 $veld2 -- $veld3\"); \n");

           }

      }

      else {

        print(mysql_error());

      }

/********************************* einde opsomming hulpverleners ************************************/



  // mantelzorgers

    $queryHVL = "

         SELECT

                h.naam as naam,

                h.voornaam as voornaam,

                w.naam as soort

            FROM

                huidige_betrokkenen bl,

                mantelzorgers h,

                verwantschap w

            WHERE

                bl.genre = 'mantel' AND

                bl.persoon_id = h.id AND

                bl.genre = 'mantel' AND

                h.verwsch_id = w.id AND

                bl.patient_code='{$_SESSION['pat_code']}'

            ORDER BY

                w.rangorde desc, bl.id"; //



      if ($resultHVL=mysql_query($queryHVL))

         {

         for ($i=0; $i < mysql_num_rows($resultHVL); $i++)

            {

            $recordsHVL= mysql_fetch_array($resultHVL);



            $mz .= $recordsHVL['naam'] . " " . $recordsHVL['voornaam'] . " -- " . $recordsHVL['soort'] . "\\n";

           }

      }

      else {

        print(mysql_error());

      }

      if (mysql_num_rows($resultHVL)>0) {

         print("$('mantelzorgers_detail').value=\"$mz\";\n");

         print("document.hoofdformulier.mantelzorgers_aanwezig[0].checked = true;\n");

      }

}

?>

</script>









</div> <!-- einde opties -->



</form>



<?php





if (isset($_GET['tab'])) {

  $actieveTab = $_GET['tab'];

}

else {

  $actieveTab = "Melding";

}



?>

<script type="text/javascript">



  var alleItems = new Array("Melding",

                            "Slachtoffer",

                            "Plegers",

                            "Mishandeling",

                            "Hulp",

                            "Mantelzorgers"

<?php

  if (($_SESSION['profiel']=="listel") || ($_SESSION['profiel']=="caw")) {

?>

                            ,"Opvolging"

<?php

  }

?>

                           );

                           

  function activeer(item) {

    var elem = document.getElementById(item);

    var tab = document.getElementById("tab"+item).firstChild;

    elem.style.display = 'block';

    tab.style.fontStyle = 'normal';

    //tab.style.color = 'black';

    tab.style.backgroundColor = '#FFCC66';

  }





  function desactiveer(item) {

<?php

  if ($_GET['print']!=1) {

?>

    var elem = document.getElementById(item);

    var tab = $("tab"+item);

    var tabje = document.getElementById("tab"+item).firstChild;

    elem.style.display = 'none';

    //tab.style.color = '#D58700';

    tabje.style.fontStyle = 'normal';

    tabje.style.backgroundColor = 'white';

<?php

  }

?>

  }



  function disableTab(item) {

    desactiveer(item);

    var tab = document.getElementById("tab"+item).firstChild;

    tab.style.fontStyle = "italic";

    tab.style.color = '#D5CCCC';

  }



  function enableTab(item) {

    var tab = document.getElementById("tab"+item).firstChild;

    tab.style.color = '#D58700';

  }

</script>



<script type="text/javascript">

  function toon(item) {

    // alleen wanneer er een andere tab dan Basisgegevens geselecteerd is

    // kan er �cht geklikt worden op de verschillende tabs

    for (nr in alleItems) {

      if (alleItems[nr]!= item && nr < 7)          // HIERHIER gebeurt iets geks! alleItems heeft een element te veel als ik prototype gebruik!??

        desactiveer(alleItems[nr]);

    }

    activeer(item);

  }





  // af laten hangen van welke tab geopend moet worden

  toon("<?= $actieveTab ?>");



<?php

  if ($oud['id']>0) {

?>

    $('dd').disable();

    $('mm').disable();

    $('jjjj').disable();

<?php

  }

?>

</script>



<?php

  eindePagina();

  if ($_GET['print']==1) {

    print("\n\n<script type=\"text/javascript\">window.print();</script>");

  }

?>



