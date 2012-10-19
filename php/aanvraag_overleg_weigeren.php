<?php



//----------------------------------------------------------
/* Maak Dbconnectie */ require('../includes/dbconnect2.inc');
//----------------------------------------------------------


$paginanaam="Weiger de aanvraag voor een overleg";
include("../includes/clearSessie.inc");


if ( isset($_SESSION["toegang"]) && ($_SESSION["toegang"] == "toegestaan") ){
    include("../includes/html_html.inc");
    print("<head>");
    include("../includes/html_head.inc");
    print("</head>");

    print("<body>");
    print("<div align=\"center\">");
    print("<div class=\"pagina\">");

    include("../includes/header.inc");

    print("<div class=\"contents\">");
    include("../includes/menu.inc");
    print("<div class=\"main\">");
    print("<div class=\"mainblock\">");

  $soort = $_SESSION['profiel'];
  if ($soort == "OC") {
    $id = $_SESSION['overleg_gemeente'];
  }
  else {
    $id = $_SESSION['organisatie'];
  }
  $persoon = $_SESSION['usersid'];
  $vandaag = date("Ymd");

  if ($soort=="menos") {
    $query = "select distinct a.*, p.naam as pat_naam, p.voornaam, toegewezen_genre, toegewezen_id,
                  1 as juist
              from (aanvraag_overleg a inner join patient p on p.rijksregister = a.rijksregister)
            where
               (p.actief = 0 and p.menos = 1)
               and a.status in ('aanvraag','overname','overname_aangevraagd')
               and a.id = {$_GET['aanvraag']}
            order by dringend*1000 + (toegewezen_genre = 'gemeente')*100 + length(p.code) desc, pat_naam
            ";
  }
  else if ($soort=="OC") {
    $query = "select distinct a.*, p.code, p.naam as pat_naam, p.voornaam, toegewezen_genre, toegewezen_id,
                (toegewezen_genre = 'gemeente') as juist
              from (aanvraag_overleg a left join patient p on p.rijksregister = a.rijksregister)
                                       inner join gemeente on (gemeente.id = gem_id or gemeente.id = gemeente_id)
                                       left join patient_tp on p.code = patient_tp.patient
            where
               keuze_organisator = 'ocmw'
               and gemeente.zip = $id
               and (p.actief is null or p.actief = 1 or (patient_tp.actief = 1 and rechtenOC <= $vandaag))
               and a.status in ('aanvraag','overname','overname_aangevraagd')
               and a.id = {$_GET['aanvraag']}
            order by dringend*1000 + (toegewezen_genre = 'gemeente')*100 + length(p.code) desc, pat_naam
            ";
  }
  else if ($soort=="rdc") {
    $query = "select distinct a.*, p.code, p.naam as pat_naam, p.voornaam, toegewezen_genre, toegewezen_id,
                (toegewezen_genre = 'rdc' and toegewezen_id = $id) as juist
              from (aanvraag_overleg a left join patient p on p.rijksregister = a.rijksregister)
                                       left join patient_tp on p.code = patient_tp.patient
            where
               keuze_organisator = 'rdc'
               and id_organisator = $id
               and (p.actief is null or p.actief = 1 or (patient_tp.actief = 1 and rechtenOC <= $vandaag))
               and a.status in ('aanvraag','overname','overname_aangevraagd')
               and a.id = {$_GET['aanvraag']}
            order by dringend*1000 + (toegewezen_genre = 'gemeente')*100 + length(p.code) desc, pat_naam
            ";
  }
  else if ($soort=="hulp") {
    $query = "select distinct a.*, p.code, p.naam as pat_naam, p.voornaam, toegewezen_genre, toegewezen_id,
                (toegewezen_genre = 'hulp' and toegewezen_id = $persoon) as juist
              from (aanvraag_overleg a left join patient p on p.rijksregister = a.rijksregister)
                                       left join patient_tp on p.code = patient_tp.patient
            where
               keuze_organisator = 'hulp'
               and id_organisator = $id
               and (p.actief is null or p.actief = 1 or (patient_tp.actief = 1 and rechtenOC <= $vandaag))
               and a.status in ('aanvraag','overname','overname_aangevraagd')
               and a.id = {$_GET['aanvraag']}
            order by dringend*1000 + (toegewezen_genre = 'gemeente')*100 + length(p.code) desc, pat_naam
            ";
  }
  else if ($soort=="listel") {
    $query = "select distinct a.*, p.code, p.naam as pat_naam, p.voornaam, toegewezen_genre, toegewezen_id,
                 1 as juist
              from (aanvraag_overleg a left join patient p on p.rijksregister = a.rijksregister)
            where
               a.status in ('aanvraag','overname','overname_aangevraagd')
               and a.id = {$_GET['aanvraag']}
            order by dringend*1000 + (toegewezen_genre = 'gemeente')*100 + length(p.code) desc, pat_naam
            ";
  }
  else {  // TP
    $query = "select distinct a.*, p.code, p.naam as pat_naam, p.voornaam, toegewezen_genre, toegewezen_id,
                 1 as juist
              from (aanvraag_overleg a inner join patient p on p.rijksregister = a.rijksregister)
                                       inner join patient_tp on p.code = patient_tp.patient
            where
               patient_tp.project = $id
               and (patient_tp.actief = 1 and p.actief <> 0)
               and a.status in ('aanvraag','overname','overname_aangevraagd')
               and a.id = {$_GET['aanvraag']}
            order by dringend*1000 + (toegewezen_genre = 'gemeente')*100 + length(p.code) desc, pat_naam
            ";
  }
  $pats = mysql_query($query) or die("$query " . mysql_error());

  $headerBestaande = true;
  $headerOvername = true;
  $headerNieuw = true;
  $dringend = 0;

  if (isset($_POST['postingWeigering'])) {
       $patient = mysql_fetch_assoc($pats);

       $orgStuk = explode("|",$_POST['organisatorOrg']);
       $nu = time();
       if (strlen($patient['info_aanvrager']) < 2)
         $patient['info_aanvrager'] = "--";
       $insert = "insert into aanvraag_overleg (
                     timestamp,
                     rijksregister,
                     patient_code,
                     gemeente_id,
                     keuze_organisator, id_organisator,
                     andere_reden_organisator,
                     doel,
                     naam_aanvrager,
                     discipline_aanvrager,
                     organisatie_aanvrager,
                     info_aanvrager,
                     dringend,
                     status,
                     bron
                  )
                  values (
                     $nu,
                     {$patient['rijksregister']},
                     '{$patient['patient_code']}',
                     {$patient['gemeente_id']},
                     '{$orgStuk['0']}', {$orgStuk['1']},
                     'doorgestuurd',
                     '{$patient['doel']}',
                     '{$patient['naam_aanvrager']}',
                     '{$patient['discipline_aanvrager']}',
                     '{$patient['organisatie_aanvrager']}',
                     '{$patient['info_aanvrager']}',
                     {$patient['dringend']},
                     'aanvraag',
                     {$_POST['aanvraag']}
                  )";


       $qry = "update aanvraag_overleg set status = 'doorgestuurd',
                                       reden_status = 'Doorgestuurd naar {$_POST['organisatorOrg']} -- {$_POST['redenDoorschuiven']}'
                                       , id_organisator_user = {$_SESSION['usersid']}
                                       where id = {$_POST['aanvraag']}";

       mysql_query($qry) or die("kan de status van het overleg niet updaten ($qry -- " . mysql_error());
       if (!mysql_query($insert)) {print("$insert is mislukt : " . mysql_error());}

       /******** mail versturen *******/
       $param = array();
       $param['organisator'] = $orgStuk['0'];
       $param['organisatorOrg'] = $orgStuk['1'];
       $param['gem_id'] = $patient['gemeente_id'];
                       $mensen = organisatorenVanAanvraag($param, $patient);
                       for ($i=0; $i<mysql_num_rows($mensen); $i++) {
                         $pc  = mysql_fetch_assoc($mensen);
                         if ($pc['email']!="") {
                           $namen .= ", {$pc['naam']} {$pc['voornaam']}";
                           $adressen .= ", {$pc['email']}";
                         }
                       }

                       $namen = substr($namen, 1);
                       $adressen = substr($adressen, 1);
                       if ($_POST['dringend']==1) {
                         $extra = "<br/><br/>Deze pati&eumlnt is zopas uit het ziekenhuis ontslagen en het overleg zou dan ook binnen de week georganiseerd moeten worden.";
                       }
                       if ($adressen != "") {
                          htmlmail($adressen,"LISTEL: aanvraag voor een overleg","Beste $namen<br/>Vanuit het LISTEL e-zorgplan is er een aanvraag verstuurd om een overleg te organiseren.
                                                   Wanneer u inlogt op $siteadres kan u deze aanvraag verder afhandelen.
                                                   $extra
                                                   <br/><br />Het LISTEL e-zorgplan www.listel.be </p>");
                       }
       /****** einde mail *********/
       print("Uw aanvraag is doorgestuurd naar de gevraagde organisator.");
  }
  else if (isset($_POST['postingReden'])) {
    if (!isset($_POST['reden'])) {
      print("<div style=\"background-color: #f88;\">Je moet een reden voor de weigering aanduiden.</div>");
    }
    else {
      if ($_POST['reden'] == "later") {
       $reden = "wordt georganiseerd binnen " . $_POST['termijn'];
      }
      else if ($_POST['reden'] == "andere") {
       $reden = "andere reden: " . $_POST['andereLang'];
      }
      else {
       $reden = $_POST['reden'];
      }
       $qry = "update aanvraag_overleg set status = 'weiger', reden_status = '{$reden}', id_organisator_user = {$_SESSION['usersid']}
               where id = {$_POST['aanvraag']}";
       mysql_query($qry) or die("kan de status van het overleg niet updaten ($qry -- " . mysql_error());
       print("De weigering van deze aanvraag is genoteerd.");
    }
  }
  else if (mysql_num_rows($pats)>0) {
    $patient = mysql_fetch_assoc($pats);

    if (isset($patient['pat_naam'])) {
      $patientInfo = $patient['pat_naam'] . " " . $patient['voornaam'] . " (" . $patient['code'] . ")";
    }
    else {
      $patientInfo = $patient['rijksregister'];
    }
?>
<script type="text/javascript">
var orgGekozen = false;
function kiesOrg() {
  orgGekozen = true;
}
</script>

    <h1>Weigering van een overleg voor <?= $patientInfo ?></h1>
    
<p>In bepaalde gevallen kan er een reden zijn om geen overleg te organiseren, of niet binnen de voorziene termijn.
Vul in dat geval de bovenste helft van deze pagina in.</p>

<p>Wanneer het overleg door een andere organisator gepland moet worden, dien je de <a href="#doorsturen">tweede helft</a> in te vullen.</p>
    
<hr/>

    <h3>Het overleg kan niet georganiseerd worden binnen de voorziene termijn.</h3>
    
    <p>Gelieve de reden voor deze weigering in te vullen.</p>
    
    <form method="post" onsubmit="if ((document.getElementById('later').checked && document.getElementById('termijn').value == '') || (document.getElementById('andere').checked && document.getElementById('andereLang').value == '')) {alert('Vul in het tekstvak een geldige reden in');return false;}">
       <input type="hidden" name="postingReden" value="postingReden" />
       <input type="hidden" name="aanvraag" value="<?= $_GET['aanvraag'] ?>" />
       <input type="radio" name="reden" value="niet nodig" />Er is geen overleg nodig. <br/>
       <input type="radio" name="reden" value="ziekte" />Ziekte van de organisator. <br/>
       <input type="radio" name="reden" value="verlof" />Verlof van de organisator. <br/>
       <input type="radio" name="reden" value="overlijden" />De pati&euml;nt is overleden. <br/>
       <input type="radio" name="reden" value="opname" />De pati&euml;nt is opgenomen in een residentiele setting. <br/>
       <input type="radio" name="reden" value="later" id="later"/>Het overleg wordt gepland binnen een termijn van
           <input type="text" id="termijn" name="termijn" onkeyup="if (this.value != '') {document.getElementById('later').checked=true;}"/><br/>
       <input type="radio" name="reden" value="andere" id="andere"/>Andere:
           <textarea id="andereLang" name="andereLang" style="width:200px; height:30px;"
                     onkeyup="if (this.value != '') {document.getElementById('andere').checked=true;}" ></textarea><br/>
                     
       <input type="submit" value="Bevestig de weigering van deze aanvraag" />
    </form>

    <hr/>
    
    <a name="doorsturen">&nbsp;                                      </a>

    <h3>Ik kies een andere organisator voor een overleg voor <?= $patientInfo ?></h3>

    <form method="post" onsubmit="if (!orgGekozen) {alert('Kies een nieuwe organisator.');return false;};if (document.getElementById('redenDoorschuiven').value.length < 5)  {alert('Vul in het tekstvak een geldige verklaring in');return false;}">
       <input type="hidden" name="postingWeigering" value="postingWeigering" />
       <input type="hidden" name="aanvraag" value="<?= $_GET['aanvraag'] ?>" />
       <div style="float:left;width:170px;">Kies een andere organisator: </div>
       <div style="float:left;">
         <input type="radio" name="organisatorOrg"  value="ocmw|0" onclick="kiesOrg();"/> OCMW <br/>
<?php
  $qryRDC = "select distinct o.naam, o.id from organisatie o inner join logins where o.actief = 1 and logins.actief = 1 and o.id = logins.organisatie and logins.profiel = 'rdc' order by o.naam;";
  $resultRDC = mysql_query($qryRDC) or die("Kan de rdc's niet vinden: " . mysql_error());
  for ($i=0; $i<mysql_num_rows($resultRDC); $i++) {
    $rdc = mysql_fetch_assoc($resultRDC);
    print("<input type=\"radio\" name=\"organisatorOrg\" value=\"rdc|{$rdc['id']}\" onclick=\"kiesOrg();\" />{$rdc['naam']}</br>\n");
  }
  $qryZA = "select distinct o.naam, o.id from organisatie o inner join hulpverleners h where o.actief = 1 and h.actief=1 and o.id = h.organisatie and h.is_organisator = 1 order by o.naam;";
  $resultZA = mysql_query($qryZA) or die("Kan de za's niet vinden: " . mysql_error());
  for ($i=0; $i<mysql_num_rows($resultZA); $i++) {
    $org = mysql_fetch_assoc($resultZA);
    print("<input type=\"radio\" name=\"organisatorOrg\" value=\"hulp|{$org['id']}\" onclick=\"kiesOrg();\" />{$org['naam']}</br>\n");
  }

?>

       </div>
       
       <div style="clear:both;">
           <div style="width:170px;float:left;">Geef een verklaring:</div>
           <textarea id="redenDoorschuiven" name="redenDoorschuiven" style="width:200px; height:30px;"></textarea><br/>
       </div>
       
       <input type="submit" value="Stuur deze aanvraag door" />
    </form>

<?php
  }
  else {
    print("<h1>Deze overname is al uitgevoerd of geannuleerd.</h1>");
  }


//---------------------------------------------------------
/* Sluit Dbconnectie */ require("../includes/dbclose.inc");
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
/* Geen Toegang */ require("../includes/check_access.inc");
//---------------------------------------------------------
?>