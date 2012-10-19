<?php

//------------------------------------------------------------

/* Maak Dbconnectie */ require('../includes/dbconnect2.inc');

//------------------------------------------------------------



// voor iedereen: naam, voornaam, functie, organisatie, contactadres, gemeente, tel, fax, gsm, email

// voor zvl: riziv + rekeningnummer (niet direct verplicht)

// voor zelfstandige hvl, xvlp: rekeningnummer (verplicht)



$paginanaam="HVL,ZVL of XVL(P of NP) toevoegen of aanpassen";



if (true || (isset($_SESSION["toegang"] ) && ($_SESSION["toegang"]=="toegestaan")) )
  // DEZE PAGINA MAG ALTIJD WANT IEMAND KAN ZICH VRIJWILLIG AANMELDEN!

    {

    require("../includes/html_html.inc");

    print("<head>");

    print("\n<script type=\"text/javascript\" src=\"../javascript/prototype.js\"></script>\n");



    require("../includes/html_head.inc");

    require("../includes/checkForNumbersOnly.inc");

    require("../includes/checkCheque.inc");


    if (isset($_GET['a_backpage'])) $a_backpage = $_GET['a_backpage'];

    if (isset($_POST['a_backpage'])) $a_backpage = $_POST['a_backpage'];

    if (isset($_GET['backpage'])) $a_backpage = $_GET['backpage'];

    if (isset($_POST['backpage'])) $a_backpage = $_POST['backpage'];



    if (isset($_POST['controleOverleg'])) $a_backpage .= "&overleg={$_POST['controleOverleg']}";

    // controle of er ? is
    if (isset($_GET['menos']) || isset($_POST['menos']))
      if (strpos($a_backpage, "?") > 0)
         $backpage .= "&menos=1";
      else
         $backpage .= "?menos=1";


    if (!isset($a_backpage)) {
      $a_backpage = $_SERVER['HTTP_REFERER'];
    }
    

    //------------------------------------------------------------

    // Postcodelijst Opstellen voor javascript



    print("<script type=\"text/javascript\">");



    $query = "

        SELECT

            dlzip,

			dlnaam,

			id

        FROM

           gemeente

      ORDER BY

         dlzip

	";



    if ($result=mysql_query($query)){

        

        print ("var gemeenteList = Array(");



        for ($i=0; $i < mysql_num_rows ($result); $i++){

            

            $records= mysql_fetch_array($result);



            print ("\"".$records[0]." ".$records[1]."\",\"".$records[2]."\",\n");



        }



      print ("\"9999 onbekend\",\"9999\");");



    }

	else{print(mysql_error());}

  /** functie maken die zegt of een organisatie mobiele_equipe is **/
  $qryMob = "select * from organisatie where mobiele_equipe = 1";
  $resultMob = mysql_query($qryMob) or die("kan de mobiele equipes niet ophalen");
  for ($i = 0; $i < mysql_num_rows($resultMob); $i++) {
     $mob = mysql_fetch_assoc($resultMob);
     $casesMobieleEquipe .= "        case {$mob['id']}: \n";
  }
?>

  function isMobieleEquipe(org_id) {
     switch (org_id) {
<?= $casesMobieleEquipe ?>
           return true;
           break;
        default:
           return false;
     }
  }
<?php
   print("</script>");

    //----------------------------------------------------------



if ($_POST['readonly']==1 || isset($_GET['readOnly'])) {

?>

<style type="text/css">

 input {
   border: 0px;
   background-color: #FDE79D;
 }

</style>



<?php

}
?>

<style type="text/css">
 .mainblock { height: auto;}
</style>

<?php
    print("</head>");

    print("<body onload=\"hideCombo('IIPostCodeS');pasFormAan();\">");

    print("<div align=\"center\">");

    print("<div class=\"pagina\">");



    require("../includes/header.inc");

    require("../includes/kruimelpad.inc");



    print("<div class=\"contents\">");



    require("../includes/menu.inc");



    print("<div class=\"main\">");

    print("<div class=\"mainblock\">");



    if ( issett($_POST['hvl_id'])){ $a_hvl_id=$_POST['hvl_id']; }

    if ( isset($_GET['id']) ){ $a_hvl_id=$_GET['id']; }



//------------------------------------------------------------

// Deze pagina kan gebruikt worden om nieuwe hulpverleners aan 

// de tabel HULPVERLENERS toe te voegen of om een bestaande

// record van deze tabel aan te passen. Indien a_hvl_id per

// URL wordt doorgegeven dan moeten de gegevens aangepast

// worden anders wordt er een nieuwe record aangemaakt. Delen

// van deze pagina worden niet weergegeven indien de login

// dit niet toestaat. Deze pagina verlangt ook een per URL

// doorgegeven pagina-naam om na afloop terug naar te springen.

//------------------------------------------------------------



    if (!isset($_POST['action']) && ($_POST['wis'] != 1) ){ // $action niet gezet, en niet wissen,  dus formulier weergeven

        

        if ( isset($a_hvl_id) ){

            $nieuwePersoon = false;
            $gegevensAanvullen = " false ";

            //------------------------------------------------------------ 

            // $a_hvl_id gezet dus gegevens ophalen om formulier te vullen

            $bevestigChanges = "&& bevestigVeranderingen('edithvlform',velden)";

            $action="Aanpassen";



            $query = "

                SELECT
                    h.id AS hid,
					h.naam AS hnaam,
					h.login,
					h.geheime_vraag,
					h.geheim_antwoord,
					h.validatiestatus,
					h.aanvraagdatum,
					h.validatiedatum,
					h.weigerdatum,
					h.voornaam,
                    h.adres,
					h.fnct_id,
          h.sociale_kaart,
          h.sociale_functie,
          h.sociale_email,
          h.sociale_tel,
          h.sociale_fax,
					h.tel,
					h.gem_id,
					h.email,
                    h.reknr,
                    h.iban,
                    h.bic,
					h.riziv1,
                    h.riziv2,
					h.riziv3,
					h.organisatie,
					organisatie.naam as orgNaam,
                    h.fax,
					h.gsm,
          h.is_organisator,
					h.vervangt,
					g.id AS gid,
                    g.dlnaam,
					g.dlzip,
					f.naam AS fnaam,
                    fg.naam AS fgnaam,
					fg.id AS fgid,
					h.gedetacheerd_ggz,
					organisatie.mobiele_equipe

                FROM
                    functies f,
                    functiegroepen fg,
                    gemeente g,
                    hulpverleners h left join organisatie on (organisatie.id = organisatie)

                WHERE
                    g.id = h.gem_id AND
                    f.id=h.fnct_id AND
                    fg.id=f.groep_id AND
                    h.id=".$a_hvl_id;

            $result = mysql_query($query) or die($query . "<br/>" . mysql_error());

            if (mysql_num_rows($result)<>0 ){



                $records= mysql_fetch_array($result);



                $valID=             $records['hid'];

                $valNaam=           $records['hnaam'];

                $valVoornaam=       $records['voornaam'];
                $valLogin =         $records['login'];
                $valGeheimeVraag = $records['geheime_vraag'];
                $valGeheimAntwoord  = $records['geheim_antwoord'];
                $valValidatieStatus =         $records['validatiestatus'];
                if ($valValidatieStatus == "")
                  $valValidatieStatus = "geenkeuze";
                $valIsOrganisator =  $records['is_organisator'];

                $valDatumAanvraag = $records['aanvraagdatum'];
                $valDatumValidatie = $records['validatiedatum'];
                $valDatumWeigering = $records['weigerdatum'];

                $valAdres=          $records['adres'];



                $valGemeente=       $records['dlzip']." ".$records['dlnaam'];



                $valTel=            $records['tel'];

                $valFax=            $records['fax'];

                $valGsm=            $records['gsm'];

                $valEmail=          $records['email'];

                $valSocialeKaart = $records['sociale_kaart'];
                $valSociaalFunctie = $records['sociale_functie'];
                $valSociaalEmail = $records['sociale_email'];
                $valSociaalFax = $records['sociale_fax'];
                $valSociaalTel = $records['sociale_tel'];



                $valReknr1=         substr($records['reknr'],0,3);
                $valReknr2=         substr($records['reknr'],4,7);
                $valReknr3=         substr($records['reknr'],12,2);

                $valBIC = $records['bic'];
                $valIBAN = $records['iban'];
                $valGedetacheerd = $records['gedetacheerd_ggz'];
                $valMobiel = $records['mobiele_equipe'];
                
                if ($valIBAN == "" && $valReknr1 > 0) {
                   // effe IBAN en BIC berekenen
                   $valBIC = bankcode2bic($valReknr1);

                   $eersteGetal = "{$valReknr3}{$valReknr3}111400";
                   $modulo97 = fmod($eersteGetal,97);
                   $controleIBAN = 98-$modulo97;
                   if ($controleIBAN<10) $controleIBAN = "0" . $controleIBAN;
                   $valIBAN = "BE{$controleIBAN}{$valReknr1}{$valReknr2}{$valReknr3}";
                }


                $valVervangt =      $records['vervangt'];

                $valOrganisatieNaam = $records['orgNaam'];


                $valRizivNr1=       substr($records['riziv1'],0,1);
                $valRizivNr2=       substr($records['riziv1'],1,5);
                $valRizivNr3=       ($records['riziv2']<10)?"0".$records['riziv2']:$records['riziv2'];
                $valRizivNr4=       ($records['riziv3']<100)?"0".$records['riziv3']:$records['riziv3'];
                $valRizivNr4=       ($records['riziv3']<10)?"0".$valRizivNr4:$valRizivNr4;

                $valFunctie=        $records['fnct_id'];
                $valFunctieGroep=   $records['fgid'];





                $valOrganisatie =   $records['organisatie'];

                $valGem2=           $records['gid'];   



                }



            else{

                print("Geen record gevonden");

				//print(mysql_error());

			}

            //------------------------------------------------------------

            }

        

        else{

             

            //-------------------------------------------------------------

            // Variabelen vullen met niets om fouten te voorkomen 



            $action="toevoegen";

            $valID=-1;

            $valNaam="";

            $valVoornaam="";

            $valAdres="";

            $valGemeente="";

            $valTel="";

            $valFax="";

            $valGsm="";

            $valEmail="";
            $valSocialeKaart = $valSociaalEmail = $valSociaalFax = $valSociaalTel = 0;

            $valReknr1="";

            $valReknr2="";

            $valReknr3="";

            $valRizivNr1="";

            $valRizivNr2="";

            $valRizivNr3="";

            $valRizivNr4="";

            $valFunctie="";

            $valFunctieGroep="";

            $valOrganisatie = -1;


            $nieuwePersoon = true;
            $gegevensAanvullen = " true ";


            $valGem2="9999"; 



            //-------------------------------------------------------------

            } 

?>



<script language="javascript" src="../includes/formuliervalidatie.js">

</script>



<script language="javascript" type="text/javascript">
var gegevensAanvullen = <?= $gegevensAanvullen ?>;

function toonLoginVelden(modus) {
   document.getElementById('loginSter').style.display = modus;
   document.getElementById('loginReeks').style.display = modus;
}

function testPWD() {
   var f = document.edithvlform;
   if (f.setpasswd.checked) {
     if (f.passwd1.value != f.passwd2.value) {
       alert("De paswoorden zijn niet gelijk!");
       return false;
     }
     else if (f.passwd1.value.length < 5)
       alert("Het paswoord is niet lang genoeg!");
   }
   return true;
}

function voorstelPWD() {
  var een = new Array("kat","poes","hond","schaap","mens","aap","paard","vrouw","man","boer","muis","mus","zwaluw","giraf","geit","wolf","vos","koe","stier");
  var twee = new Array("eet","verstopt","koopt","verkoopt","ziet","hoort","ruikt","kust","verleidt","voelt");
  var getal1 = Math.floor(Math.random()*een.length);
  var getal2 = Math.floor(Math.random()*twee.length);
  var getal3 = Math.floor(Math.random()*een.length);
  var woord = een[getal1] + twee[getal2] + een[getal3]+ Math.ceil(Math.random()*1000) + "x";
  document.getElementById("voorstelPWD").innerHTML = "<em>" + woord + "</em>";
  document.edithvlform.passwd1.value = woord;
  document.edithvlform.passwd2.value = woord;
}

var loginIsOk = true;
function isUniekeLogin() {
   var div = $('login');
   if ($F('login').length == 0)  {
      div.style.backgroundColor='#eee';
      loginIsOk = true;
      return true;
   }
   else if ($F('login').length >= 6)  {
       var url = "isUniekeLogin.php?rand=" + parseInt(Math.random()*999999)
                  + "&login=" + $F('login')
                  + "&tabel=hulpverleners&id=" + <?= $valID ?>;
       var http = createREQ();

       // de call-back functie
       http.onreadystatechange = function() {
         if (http.readyState == 4 && http.responseText.indexOf("OK") >= 0) {
           div.style.backgroundColor='#88ff88';
           loginIsOk = true;
           return true;
         }
         else {
           div.style.backgroundColor='#ff8888';
           loginIsOk = false;
           return false;
         }
       }
       // en nu nog de request uitsturen
       http.open("GET", url);

       http.send(null);

   }
   else {
     div.style.backgroundColor='#ff8888';
     loginIsOk = false;
     return false;
   }
}

function testLogin() {
  if ((!document.getElementById('paswoordInvullen').checked
        || document.getElementById('passwd1').value == "")
      && (document.getElementById('validatieHalfweg') != null
            && document.getElementById('validatieHalfweg').checked)) {
     alert("Wanneer je beperkte toegangsrechten toekent, moet je ook een login en paswoord geven.");
     return false;
  }
  if (loginIsOk) return testPWD();
  else {
    alert('De login is ofwel te kort (min. 6 letters), ofwel niet uniek.\nKies een andere login.');
    return false;
  }
}

function createREQ() {

    try {

      req = new XMLHttpRequest(); // firefox, safari, …

    }

    catch (err1) { try {

      req = new ActiveXObject("Msxml2.XMLHTTP"); // sommige IE

    }

    catch (err2) { try {

      req = new ActiveXObject("Microsoft.XMLHTTP"); // meeste IE

    }

    catch (err3) {

      req = false;

      alert("Deze browser ondersteunt geen Ajax. Dikke pech!");

    }}}

  return req;

}


<?php
  if ($_GET['geenDubbelsZoeken']==1
      || $valValidatieStatus == "aanvraag" || $valValidatieStatus == "halfweg" || $valValidatieStatus == "gevalideerd"
      || ($_SESSION['isOrganisator']==0)) $zoek = "false";
  else $zoek = "true";
?>
var nogDubbelsZoeken = <?= $zoek ?>;

function zoekDubbelePersonen() {

   if (($F('naam') != "") &&

       ($F('voornaam') != "" &&

       nogDubbelsZoeken)) {

       // alle vakjes zijn ingevuld, dus nu alle gelijkenissen ophalen

       var url = "zoekDubbeleHulpverleners.php?rand=" + parseInt(Math.random()*999999)

                  + "&naam=" + $F('naam') + "&voornaam=" + $F('voornaam')

                  + "&backpage=<?= $a_backpage ?>";



       var http = createREQ();



       // de call-back functie

       http.onreadystatechange = function() {

         if (http.readyState == 4) {
           var response = http.responseText;
           response = response.replace(/(^\s*)|(\s*$)/gi,"");

           if (response != "") {

              // er zijn dubbels!

              var div = $('kiesPersoon');

              div.innerHTML = http.responseText;

              div.style.display='block';

              $('opslaan').style.display='none';

           }

         }

       }



       // en nu nog de request uitsturen

       http.open("GET", url);

       http.send(null);

   }

}

function zoekZelfdeZVL() {
   if (gegevensAanvullen) {
     var riziv1DB = document.edithvlform.riziv1.value + document.edithvlform.riziv2.value;
     var riziv2DB = document.edithvlform.riziv3.value;
     var riziv3DB = document.edithvlform.riziv4.value;
     var iban = document.edithvlform.elements['IBAN'].value
     if (riziv1DB == "" || riziv2DB == "" || riziv3DB == "" || iban == "") return;

       // alle vakjes zijn ingevuld, dus nu alle gelijkenissen ophalen
       var url = "zoekZelfdeZVL.php?rand=" + parseInt(Math.random()*999999)
                  + "&riziv1=" + riziv1DB
                  + "&riziv2=" + riziv2DB
                  + "&riziv3=" + riziv3DB
                  + "&iban=" + iban
                  ;
       var http = createREQ();

       // de call-back functie
       http.onreadystatechange = function() {
         if (http.readyState == 4) {
           var response = http.responseText;
           response = response.replace(/(^\s*)|(\s*$)/gi,"");
           if (response != "") {
              // ik heb er ene gevonden!
              var tekst = response;
              var vorigeMarkering = 0;
              var volgendeMarkering = tekst.indexOf("!!--!!");
              $('naam').value = tekst.substring(vorigeMarkering, volgendeMarkering);

              vorigeMarkering = volgendeMarkering+6;
              volgendeMarkering = tekst.indexOf("!!--!!", vorigeMarkering);
              $('voornaam').value = tekst.substring(vorigeMarkering, volgendeMarkering);

              vorigeMarkering = volgendeMarkering+6;
              volgendeMarkering = tekst.indexOf("!!--!!", vorigeMarkering);
              $('adresInput').value = tekst.substring(vorigeMarkering, volgendeMarkering);

              vorigeMarkering = volgendeMarkering+6;
              volgendeMarkering = tekst.indexOf("!!--!!", vorigeMarkering);
              var gemeenteId = parseInt(tekst.substring(vorigeMarkering, volgendeMarkering))
              vulInPC(gemeenteId);
              //$('gem_id').value = tekst.substring(vorigeMarkering, volgendeMarkering);

              vorigeMarkering = volgendeMarkering+6;
              volgendeMarkering = tekst.indexOf("!!--!!", vorigeMarkering);
              invoer('tel');
              $('telInput').value = tekst.substring(vorigeMarkering, volgendeMarkering);

              vorigeMarkering = volgendeMarkering+6;
              volgendeMarkering = tekst.indexOf("!!--!!", vorigeMarkering);
              invoer('fax');
              $('faxInput').value = tekst.substring(vorigeMarkering, volgendeMarkering);

              vorigeMarkering = volgendeMarkering+6;
              volgendeMarkering = tekst.indexOf("!!--!!", vorigeMarkering);
              invoer('gsm');
              $('gsmInput').value = tekst.substring(vorigeMarkering, volgendeMarkering);

              vorigeMarkering = volgendeMarkering+6;
              volgendeMarkering = tekst.indexOf("!!--!!", vorigeMarkering);
              invoer('email');
              $('emailInput').value = tekst.substring(vorigeMarkering, volgendeMarkering);

              vorigeMarkering = volgendeMarkering+6;
              volgendeMarkering = tekst.indexOf("!!--!!", vorigeMarkering);
              $('hvl_id').value = parseInt(tekst.substring(vorigeMarkering, volgendeMarkering));

              $('action').value = "Aanpassen";
              gegevensAanvullen = false;
           }

         }

       }



       // en nu nog de request uitsturen

       http.open("GET", url);

       http.send(null);

   }

}


function verstop() {

  $('kiesPersoon').style.display='none';

  $('opslaan').style.display='inline';

}





var persoonGenre = "";

var zelfstandig = false;
var soortZelfstandig = "";
var consequent = true;

<?php
  if ($valSocialeKaart == 0 && $_SESSION['profiel']=="hulp" && $_SESSION['usersid']==$valID) {
    print("var verwittigdVanSocialeKaart = false;");
  }
  else {
    print("var verwittigdVanSocialeKaart = true;");
  }
?>


function toonSocialeDiv() {
<?php
  if ((!isset($_SESSION['profiel']))  // iemand registreert zichzelf, en mag/moet dus sociale kaart invullen
       || ($_SESSION['profiel']=="listel") // listel mag sociale kaart zien (en aanpassen)
       || ($_SESSION['profiel']=="hulp" && $_SESSION['usersid']==$valID)  // hvl zelf mag zien en aanpassen (natuurlijk)
      ) {
?>
   $('socialeDiv').style.display='block';
   if (!verwittigdVanSocialeKaart) {
     verwittigdVanSocialeKaart = true;
     alert("Maak een keuze voor opname in de sociale kaart.\nIndien u geen keuze maakt, wordt u opgenomen\nen dit met de minimale gegevens (naam, adres en functie).");
     $('socialeKaartWel').checked = true;
   }
<?php
  }
?>
}



function pasFormAan() {

  // eerst organisatie proberen

  persoonGenre = "";

  var orgNr = parseInt($FF('organisatie'));

  if (!isNaN(orgNr)) {
<?php
   if ($_SESSION['profiel']=="listel") {
?>
    // mobiele equipe laten zien indien nodig!
    if (isMobieleEquipe(orgNr)) {
      $('gedetacheerd_ggz').style.display="block";
    }
    else {
      $('gedetacheerd_ggz').style.display="none";
    }
<?php
  }
  else {
?>
    // mobiele equipe laten zien indien nodig!
    if (isMobieleEquipe(orgNr)) {
      $('checkMobieleEquipe').value=1;
    }
    else {
      $('checkMobieleEquipe').value=0;
    }
<?php
  }
?>
    persoonGenre = organisaties[orgNr]['genre'];

    if (orgNr == 997 || orgNr == 998) { // zelfstandig HVL of XVLP
      if (orgNr == 997) soortZelfstandig = "XVLP";
      else soortZelfstandig = "HVL"

      zelfstandig = true;

      $('riziv').style.display='none';

      $('bankrek').style.display='block';
      invoerReknr();
      toonSocialeDiv();

      //invoer('adres');

    }

    else if (organisaties[orgNr]['genre']=="ZVL") {

      zelfstandig = false;

      $('riziv').style.display='block';
      $('bankrek').style.display='block';
      toonSocialeDiv();
    }

    else {

      zelfstandig = false;

      $('riziv').style.display='none';

      $('bankrek').style.display='none';
      $('socialeDiv').style.display='none';

    }

  }

  // dan functie proberen (eigenlijk alleen voor ZVL)

  var functie = parseInt($FF('fnct_id'));

  consequent = true;

  if (!isNaN(functie)) {

    if (functieLijst[functie]==2) {

      if (isNaN(orgNr)) {

        // zelfstandig ZVL selecteren

        document.edithvlform.organisatieInput.value = "Zelfstandig ZVL";

        refreshListOveral('edithvlform','organisatieInput','organisatie',1,'OrganisatieS',orgList,20);

        invoerReknr();

        invoer('adres');

      }

      else if (persoonGenre != "" && persoonGenre != "ZVL") {

         alert("De organisatie die u selecteerde is geen organisatie van zorgverleners.\nMaak a.u.b. een consequente keuze!");

         consequent = false;

      }

      persoonGenre = "ZVL";

      $('riziv').style.display='block';

      $('bankrek').style.display='block';
      toonSocialeDiv();
    }

    else if (persoonGenre == "ZVL" && orgNr == 999) {

         alert("Deze functie is geen zelfstandige zorgverlener.\nKies de juiste organisatie.");

         consequent = false;

    }

    else if (persoonGenre == "ZVL") {

         alert("Deze functie is geen zorgverlener, terwijl de organisatie enkel zorgverleners bevat.");

         consequent = false;

    }

    /*

    else if (functieLijst[functie]==3 || functieLijst[functie]==4) {

      if (persoonGenre != "" && persoonGenre != "XVLP" && persoonGenre != "XVLNP") {

         alert("In de organisatie (" + persoonGenre + ") die u selecteerde komt de door u gekozen functie (" + functie + ") niet voor.\nMaak a.u.b. een consequente keuze!");

         consequent = false;

      }

    }

    else if (functieLijst[functie]==1 ) {

      if (persoonGenre != "" && persoonGenre != "HVL") {

         alert("In de organisatie die u selecteerde komt de door u gekozen functie niet voor.\nMaak a.u.b. een consequente keuze!");

         consequent = false;

      }

    }

    */

  }

  

  if (!consequent) {

      $('riziv').style.display='none';

      $('bankrek').style.display='none';
      $('socialeDiv').style.display='none';

      persoonGenre = "";

  }

  

  if (persoonGenre == "ZVL") {
      $('persoonGenre').innerHTML = "zorgverlener";
  }
  else if (zelfstandig) {
    if (soortZelfstandig == "XVLP")
      $('persoonGenre').innerHTML = "hulpverlener niet opgenomen in GDT";
    else
      $('persoonGenre').innerHTML = "hulpverlener opgenomen in GDT";
  }
  else if (persoonGenre == "") {
      $('persoonGenre').innerHTML = "";
  }
  else if (persoonGenre == "HVL") {
      $('persoonGenre').innerHTML = "hulpverlener opgenomen in GDT";
  }
  else if (persoonGenre == "XVLP") {
      $('persoonGenre').innerHTML = "hulpverlener niet opgenomen in GDT";
  }
  else if (persoonGenre == "XVLNP") {
      $('persoonGenre').innerHTML = "niet-professionele hulpverlener";
  }
  else {
      $('persoonGenre').innerHTML = "";
  }

  $('persoonGenre').innerHTML += " (" + persoonGenre + ")";

}



function bevestigWeigering() {
  return confirm("Ben je zeker dat deze login niet langer toegang wil tot het e-zorgplan en daardoor ook geen toegang meer heeft tot het e-zorgplan?");
}


function checkFormZvl()

	{

  if (document.getElementById('geweigerd') && document.getElementById('geweigerd').checked && !bevestigWeigering()) {
    return false;
  }
	fouten = "";

	

	fouten = fouten + checkLeeg 	('edithvlform', 'naam', 	'- Vul een achternaam in');

	fouten = fouten + checkLeeg 	('edithvlform', 'voornaam', '- Vul een voornaam in');

	

  functie = $FF('fnct_id');

  if (isNaN(parseInt(functie)) || functie < 0) fouten = fouten + "- Selecteer een functie\n";

  organisatie = $FF('organisatie');

  if (isNaN(parseInt(organisatie))) {

     if (document.edithvlform.organisatieInput.value ==  "<?= $valOrganisatieNaam ?>" && "<?= $valOrganisatieNaam ?>" !=  "") {

       organisatie = <?= $valOrganisatie ?>;

       document.getElementById('organisatie').value = <?= $valOrganisatie ?>;

     }

     else {

       fouten = fouten + "- Selecteer een organisatie\n";

     }

  }

  

  if (!consequent) {

    alert("In de organisatie die u selecteerde komt de door u gekozen functie niet voor.\nMaak a.u.b. een consequente keuze!");

    fouten = fouten + "- De gekozen organisatie en functie zijn niet cumuleerbaar.\n";

  }

<?php
  if (($_SESSION['profiel']=="hulp" && $_SESSION['usersid'] == $valID)) {
?>

	fouten = fouten + checkLeeg 	('edithvlform', 'email', 	'- Vul een persoonlijk emailadres in');

<?php
  }
  else if ( $valValidatieStatus == "" || $valValidatieStatus == "geenkeuze") {
?>
  if (document.getElementById("adres").style.display == "none")  {
	  fouten = fouten + checkLeeg 	('edithvlform', 'adres', 	'- Vul een adres in');
	  fouten = fouten + checkLeeg 	('edithvlform', 'postCodeInput','- Vul een geldige postcode in');
    //fouten = fouten + checkLeeg 	('edithvlform', 'tel', 		'- Vul een geldig telefoonnummer in');
  }
  else if (document.getElementById("adresInput").value != "") {
    if (document.edithvlform.gem_id.value == 9999) {
      fouten = fouten + "- Vul een geldige postcode in";
    }
  }
  else if (document.getElementById("adresInput").value != "") {
    if (document.edithvlform.gem_id.value == 9999) {
      fouten = fouten + "- Vul een geldige postcode in";
    }
  }
  if (document.getElementById("vraagLoginAan")) {
	  if (document.getElementById("vraagLoginAan").checked) {
	    fouten = fouten + checkLeeg 	('edithvlform', 'email', 	'- Vul een persoonlijk emailadres in');
      fouten = fouten + checkLeeg 	('edithvlform', 'login', 	'- Kies een originele login');
       if (document.edithvlform.passwd1.value != document.edithvlform.passwd2.value) {
         fouten = fouten + ("- De paswoorden zijn niet gelijk!\n");
       }
       else if (document.edithvlform.passwd1.value.length < 5)
         fouten = fouten + ("- Het paswoord is niet lang genoeg!\n");
	    fouten = fouten + checkLeeg 	('edithvlform', 'geheimeVraag', 	'- Vul een geheime vraag in');
	    fouten = fouten + checkLeeg 	('edithvlform', 'geheimAntwoord', 	'- Vul een antwoord op de geheime vraag in');
    }
    else if (!document.getElementById("vraagGeenLoginAan").checked) {
       fouten = fouten + "- Je hebt geen keuze gemaakt of je al dan niet een login wil.\n";
    }
  }
<?php
  }
?>

	if (persoonGenre == "ZVL") {

	  fouten = fouten + checkLeeg 	('edithvlform', 'riziv1', '- Vul het 1ste vakje van het RIZIV-nummer in');

	  fouten = fouten + checkLeeg 	('edithvlform', 'riziv2', '- Vul het 2de vakje van het RIZIV-nummer in');

	  fouten = fouten + checkLeeg 	('edithvlform', 'riziv3', '- Vul het 3de vakje van het RIZIV-nummer in');

	  fouten = fouten + checkLeeg 	('edithvlform', 'riziv4', '- Vul het 4de vakje van het RIZIV-nummer in');

    r1 = document.edithvlform.riziv1.value;

    r2 = document.edithvlform.riziv2.value;

    r3 = document.edithvlform.riziv3.value;

    r4 = document.edithvlform.riziv4.value;

    //alert(checkRiziv(functie, r1, r2, r3, r4));



    if (!checkRiziv(functie, r1, r2, r3, r4))

      fouten = fouten + "- Vul een geldig RIZIV-nummer in\n";

  }

  



	if (zelfstandig) {  // zelfstandig HVL of XVLP

   	  fouten = fouten + checkBank 	('edithvlform', 'reknr1', 'reknr2', 'reknr3');

  }

  else if (persoonGenre == "ZVL") {  // ZVL en iets van bankrek ingevuld

    if (checkLeeg('edithvlform','reknr1',"a") == "" ||

        checkLeeg('edithvlform','reknr2',"a") == "" ||

        checkLeeg('edithvlform','reknr3',"a") == "")

   	  fouten = fouten + checkBank 	('edithvlform', 'reknr1', 'reknr2', 'reknr3');

	}

	//fouten = fouten + checkLeeg 	('edithvlform', 'adres', 	'- Vul een adres in');

	//fouten = fouten + checkLeeg 	('edithvlform', 'tel', 		'- Vul een geldig telefoonnummer in');

	//fouten = fouten + checkLeeg 	('edithvlform', 'postCodeInput','- Vul een geldige postcode in');




  if (persoonGenre == "ZVL")

    var velden = Array('email','gsm','fax','tel','postcode','adres','organisatie','reknr3','reknr2','reknr1','riziv4','riziv3','riziv2','riziv1','_fnct_id','voornaam','naam');

  else if (zelfstandig)

    var velden = Array('email','gsm','fax','tel','postcode','adres','organisatie','reknr3','reknr2','reknr1','_fnct_id','voornaam','naam');

  else

    var velden = Array('email','gsm','fax','tel','postcode','adres','organisatie','_fnct_id','voornaam','naam');

	//alert(bevestigVeranderingen('edithvlform',velden));



  if (persoonGenre != "")

    document.edithvlform.persoonGenre.value = "" + persoonGenre;

  if (document.edithvlform.email.value != "") {
    var emailControle = document.edithvlform.email.value;
    if (emailControle.indexOf("@") >= emailControle.lastIndexOf(".")) {
      alert("Het emailadres is niet geldig.");
      return false;
    }
  }


	return valideer(); // <?= $bevestigChanges ?>;

}





var origineel = new Array();



</script>

<div id="kiesPersoon" style="z-index: 10; display:none; background-color: #ffc; border: 1px black solid; position: absolute; top: 80px; left: 45px; width:465px; min-height:315px; padding: 8px;"></div>



<form action="edit_verlener.php" method="post" name="edithvlform" onsubmit="return checkFormZvl();"  autocomplete="off">

<?php

  if (isset($_GET['overleg']))

    print("<input type=\"hidden\" name=\"controleOverleg\" value=\"{$_GET['overleg']}\" />\n");
  if (isset($_GET['menos']))

    print("<input type=\"hidden\" name=\"menos\" value=\"1\" />\n");

?>

<input type="hidden" name="veranderd" value="-1" />

<input type="hidden" id="persoonGenreVeld" name="persoonGenre"  />

<fieldset>

    <div class="legende">Gegevens persoon: <span id="persoonGenre"></span></div>

    <div>&nbsp;</div>

    <div class="label160">Functie<div class="reqfield">*</div>&nbsp;: </div>

    <div class="waarde">

        <select size="1" id="fnct_id" name="fnct_id" onchange="pasFormAan();" >

        <option value="-1">Selecteer een functie</option>



<?php

//------------------------------------------------------------------

// Vul Input-select-element vanuit dbase: functies



$query = "

    SELECT

        f.id,

        f.naam,

        f.groep_id

    FROM

        functies f

    WHERE

		f.actief <> 0

    ORDER BY

        f.naam";



$functieLijst = "";

if ($result=mysql_query($query)){

    for ($i=0; $i < mysql_num_rows ($result); $i++){

      $records= mysql_fetch_array($result);

      $selected=($valFunctie==$records['id'])?"selected=\"selected\"":"";

  		print ("<option value=\"".$records['id']."\" ".$selected.">".$records[1]."</option>\n");

      $functieLijst .= "functieLijst[{$records['id']}]={$records['groep_id']};\n";

    }

}



print("<script type=\"text/javascript\">\nfunctieLijst = Array();\n$functieLijst</script>\n");



// ZVL:        (f.groep_id = 2



//------------------------------------------------------------------

?>

        </select>

    </div><!--Functie -->


<?php

    toonZoekOrganisatie("edithvlform", $valOrganisatieNaam, "", "toonOrganisatie(\$FF('organisatie'));pasFormAan();");

?>



    <div class="label160">Naam<div class="reqfield">*</div>&nbsp;: </div>

    <div class="waarde">

        <input type="text" size="35" value="<?php print($valNaam)?>" name="naam" id="naam" onchange="zoekDubbelePersonen()" />

    </div><!--Naam -->

    <div class="label160">Voornaam<div class="reqfield">*</div>&nbsp;: </div>

    <div class="waarde">

        <input type="text" size="35" value="<?php print($valVoornaam)?>" name="voornaam" id="voornaam" onchange="zoekDubbelePersonen()" />

    </div><!--Voornaam -->




<script language="javascript">

function toonOrganisatie(nr) {

   if (nr == 999 || nr == 998 || nr == 997) {

     invoerReknr();
     invoer('adres');
     invoer('tel');
     invoer('fax');
     invoer('gsm');
     invoer('email');
     invoerPC();
     return;

   }

   verbergInvoer(nr, 'adres');

   verbergInvoer(nr, 'tel');

   verbergInvoer(nr, 'fax');

   verbergInvoer(nr, 'gsm');

   verbergInvoer(nr, 'email');

   verbergReknr(nr);

   toonPC(nr);

}



function startWaarde() {

<?php

   if ($valOrganisatie != "" && $valOrganisatie != 999 && $valOrganisatie != 1000) {

     if ($valReknr1 == "") {

       print("   verbergReknr($valOrganisatie);\n");

     }

     if ($valAdres == "") {

       print("   verbergInvoer($valOrganisatie, 'adres');\n");

     }

     if ($valTel == "") {

       print("   verbergInvoer($valOrganisatie, 'tel');\n");

     }

     if ($valGsm == "") {

       print("   verbergInvoer($valOrganisatie, 'gsm');\n");

     }

     if ($valEmail == "" && $valValidatieStatus != "") {

       print("   verbergInvoer($valOrganisatie, 'email');\n");

     }

     if ($valFax == "") {

       print("   verbergInvoer($valOrganisatie, 'fax');\n");

     }

     if ($valGem2 == "" || $valGem2 == 9999) {

       print("   toonPC($valOrganisatie);");

     }

   }

?>

}

var bewaarreknr = new Array();

bewaarreknr[1] = "<?= $valReknr1 ?>";

bewaarreknr[2] = "<?= $valReknr2 ?>";

bewaarreknr[3] = "<?= $valReknr3 ?>";

bewaarreknr[4] = "<?= $valIBAN ?>";
bewaarreknr[5] = "<?= $valBIC ?>";


function verbergReknr(nr) {

  bewaarreknr[1] = document.edithvlform.elements['reknr1'].value;

  document.edithvlform.elements['reknr1'].value = "";

  bewaarreknr[2] = document.edithvlform.elements['reknr2'].value;

  document.edithvlform.elements['reknr2'].value = "";

  bewaarreknr[3] = document.edithvlform.elements['reknr3'].value;

  document.edithvlform.elements['reknr3'].value = "";

  bewaarreknr[4] = document.edithvlform.elements['IBAN'].value;
  document.edithvlform.elements['IBAN'].value = "";
  bewaarreknr[5] = document.edithvlform.elements['BIC'].value;
  document.edithvlform.elements['BIC'].value = "";


  document.getElementById('bankrekgroep').style.display='none';
  document.getElementById('IBANinvul').style.display='none';
  document.getElementById('BICinvul').style.display='none';



  document.getElementById('reknr').style.display='block';
  document.getElementById('IBAN').style.display='block';
  document.getElementById('BIC').style.display='block';

  if (nr != -1)  {
    document.getElementById('reknr').innerHTML=organisaties[nr]['reknr'];
    document.getElementById('IBAN').innerHTML=organisaties[nr]['iban'];
    document.getElementById('BIC').innerHTML=organisaties[nr]['bic'];
  }
  else {
    document.getElementById('reknr').innerHTML="";
    document.getElementById('IBAN').innerHTML="";
    document.getElementById('BIC').innerHTML="";
  }
}

function invoerReknr() {

  document.edithvlform.elements['reknr1'].value = bewaarreknr[1];

  document.edithvlform.elements['reknr2'].value = bewaarreknr[2];

  document.edithvlform.elements['reknr3'].value = bewaarreknr[3];
  document.edithvlform.elements['IBAN'].value = bewaarreknr[4];
  document.edithvlform.elements['BIC'].value = bewaarreknr[5];

  document.getElementById('bankrekgroep').style.display='inline';
  document.getElementById('IBANinvul').style.display='inline';
  document.getElementById('BICinvul').style.display='inline';

  document.getElementById('reknr').style.display='none';
  document.getElementById('IBAN').style.display='none';
  document.getElementById('BIC').style.display='none';

}



function verbergInvoer(nr,id) {
  if (nr == -1) return;
  if (organisaties[nr][id] == "")  return;

  document.edithvlform.elements[id].value = "";

  document.getElementById(id).style.display='block';

  if (nr != -1 )

    document.getElementById(id).innerHTML=organisaties[nr][id];

  else

    document.getElementById(id).innerHTML="";

  document.edithvlform.elements[id].style.display='none';

}

function invoer(id) {
  document.edithvlform.elements[id].value = "";
  document.getElementById(id).style.display='none';
  document.edithvlform.elements[id].style.display='block';
}



function zoekGemeente(nr) {

   for (i=1; i< gemeenteList.length; i=i+2) {

     if (nr == gemeenteList[i])

       return gemeenteList[i-1];

   }

}

function toonPC(nr) {

 if (nr == -1) return;

 gemeente = zoekGemeente(organisaties[nr]['gem_id']);

 selectObj = document.edithvlform.gem_id;

 selectObj.length = 0;  // maak selectlijst leeg

 selectObj[0] = new Option(gemeente,organisaties[nr]['gem_id']);

 selectObj[1] = new Option("Onbepaald",9999);

 selectObj.options[1].selected = true;

 //handleSelectClick('edithvlform','postCodeInput','hvl_gem_id',1,'IIPostCodeS')

 //alert(1);

 document.getElementById("postcodeinvoer").style.display='none';

 document.getElementById("postcodevast").style.display='block';

 document.getElementById("postcodevast").innerHTML=gemeente;

 document.edithvlform.elements['postCodeInput'].value = gemeente;

}

function vulInPC(gemeente_id) {
 gemeente = zoekGemeente(gemeente_id);
 selectObj = document.edithvlform.gem_id;
 selectObj.length = 0;  // maak selectlijst leeg
 selectObj[0] = new Option(gemeente,gemeente_id);
 selectObj[1] = new Option("Onbepaald",9999);
 selectObj.options[1].selected = true;
 document.getElementById("postcodeinvoer").style.display='none';
 document.getElementById("postcodevast").style.display='block';
 document.getElementById("postcodevast").innerHTML=gemeente;
 document.edithvlform.elements['postCodeInput'].value = gemeente;
}


function invoerPC(id) {

 selectObj = document.edithvlform.gem_id;

 selectObj.options[0].selected = true;

  document.getElementById("postcodeinvoer").style.display='block';

  document.getElementById("postcodevast").style.display='none';

}

</script>

<script language="javascript">

origineel['organisatie'] = "<?= $valOrganisatieNaam ?>";

</script>



<script language="javascript">

origineel['fnct_id'] = document.edithvlform.fnct_id.selectedIndex;

</script>



<div id="riziv" style="display:none">

    <div class="label160">RIZIV nummer<div class="reqfield">*</div>&nbsp;: </div>

    <div class="waarde">



        <input type="text" size="1" value="<?php print($valRizivNr1)?>" name="riziv1"

            onkeyup="checkForNumbersOnly(this,1,0,10,'edithvlform','riziv2')" />

            &nbsp;/&nbsp;

        <input type="text" size="5" value="<?php print($valRizivNr2)?>" name="riziv2"

            onkeyup="checkForNumbersOnly(this,5,0,100000,'edithvlform','riziv3')" />

            &nbsp;/&nbsp;

        <input type="text" size="2" value="<?php print($valRizivNr3)?>" name="riziv3"

            onkeyup="checkForNumbersOnly(this,2,0,100,'edithvlform','riziv4')" />

            &nbsp;/&nbsp;

        <input type="text" size="3" value="<?php print($valRizivNr4)?>" name="riziv4"

            onkeyup="checkForNumbersOnly(this,3,0,1000,'edithvlform','reknr1')"
            onblur="zoekZelfdeZVL();" />

      </div><!--RIZIV -->

</div>



<div id="bankrek" style="display:none">

    <div class="label160" ondblclick="invoerReknr();">Bankrekeningnummer (oud)&nbsp;: </div>

    <div class="waarde">

      <span id="bankrekgroep">

        <input type="text" size="3" value="<?php print($valReknr1)?>" name="reknr1"

            onKeyup="checkForNumbersOnly(this,3,-1,1000,'edithvlform','reknr2')" />

            &nbsp;-&nbsp;

        <input type="text" size="7" value="<?php print($valReknr2)?>" name="reknr2"

            onKeyup="checkForNumbersOnly(this,7,-1,10000000,'edithvlform','reknr3')" />

            &nbsp;-&nbsp;

        <input type="text" size="2" value="<?php print($valReknr3)?>" name="reknr3"

            onKeyup="checkForNumbersOnly(this,2,-1,100,'edithvlform','organisatie')" onblur="checkCheque();bankrek2iban('edithvlform');zoekZelfdeZVL();" />

        </span>

        <span  id="reknr" style="display:none" ondblclick="invoerReknr();"></span>
      &nbsp;&nbsp;</div><!--Bankrekening -->


    <div class="label160" ondblclick="invoerReknr();">IBAN&nbsp;: </div>
    <div class="waarde">
        <input id="IBANinvul" type="text" size="34" value="<?php print($valIBAN)?>" name="IBAN"  onblur="iban2bankrek('edithvlform');checkCheque();zoekZelfdeZVL();" />
        <span  id="IBAN" style="display:none" ondblclick="invoerReknr();" ></span>
      &nbsp;&nbsp;</div><!--IBAN -->


    <div class="label160" ondblclick="invoerReknr();">BIC&nbsp;: </div>
    <div class="waarde">
        <input id="BICinvul"  type="text" size="34" value="<?php print($valBIC)?>" name="BIC" />
        <span  id="BIC" style="display:none" ondblclick="invoerReknr();"></span>
      &nbsp;&nbsp;</div><!--BIC -->
</div>

<div id="socialeDiv" style="display:none">
    <div class="label160">Sociale kaart&nbsp;: </div>
    <div class="waarde">
        <input type="radio" name="socialeKaart" value="-1"
               onclick="$('sociaalExtra').style.display='none';"
               <?php printChecked($valSocialeKaart,-1); ?> />
               Ik wens <strong>niet</strong> vermeld te worden in de sociale kaart<br/>
        <input type="radio" name="socialeKaart" id="socialeKaartWel" value="1"
               onclick="$('sociaalExtra').style.display='block';"
               <?php printChecked($valSocialeKaart,1); ?>/>
               Ik wens <strong>w&eacute;l</strong> vermeld te worden in de sociale kaart<br/>

<style type="text/css">
  #sociaalExtra {
    margin:5px;
    margin-left:15px;
    width: 300px;
  }
  .aanvinken {
    margin-right:40px;
  }
</style>
           <div id="sociaalExtra" <?php if ($valSocialeKaart == -1) print(" style=\"display:none\" "); ?> >
              <p>Bij opname in de sociale kaart nemen we naam, adres en functie sowieso over.
                 Bijkomend kan je hieronder een preciezere omschrijving
                 van je functie geven, en aanvinken of telefoon, gsm en email ook opgenomen mogen worden. <br/>
                 Andere gegevens zoals riziv, bankrekening, ... worden nooit vermeld in de sociale kaart.
              </p>
              Vrije omschrijving <input type="text" name="sociaalFunctie" value="<?= $valSociaalFunctie ?>" style="width:175px;" />
              <span class="aanvinken">
                <input type="checkbox" name="sociaalEmail" value="1" <?php printChecked($valSociaalEmail,1); ?> />email
              </span>
              <span class="aanvinken">
                <input type="checkbox" name="sociaalTel" value="1" <?php printChecked($valSociaalTel,1); ?> />telefoon
              </span>
              <span class="aanvinken">
                <input type="checkbox" name="sociaalFax" value="1" <?php printChecked($valSociaalFax,1); ?> />fax
              </span>

           </div>
    </div><!--sociale kaart -->
</div>




    <div class="label160" ondblclick="invoer('adres');invoerPC();">Contactadres<div class="reqfield">*</div>&nbsp;: </div>

    <div class="waarde">

        <input type="text" size="35" value="<?php print($valAdres)?>" name="adres" id="adresInput" />

        <span  id="adres" style="display:none" ondblclick="invoer('adres');invoerPC();"></span>

    </div>





    <div class="inputItem" id="IIPostCode">

        <div class="label160" ondblclick="invoer('adres');invoerPC();">Postcode<div class="reqfield">*</div>&nbsp;: </div>

        <div class="waarde">

            <span id="postcodeinvoer">

            <input onKeyUp="refreshList('edithvlform','postCodeInput','hvl_gem_id',1,'IIPostCodeS',gemeenteList,20)"

            onmouseUp="showCombo('IIPostCodeS',100)" 

            onfocus="refreshList('edithvlform','postCodeInput','hvl_gem_id',1,'IIPostCodeS',gemeenteList,20)" 

            type="text" name="postCodeInput" value="<?php print($valGemeente)?>">

            <input type="button"  value="<<"

            onClick="resetList('edithvlform','postCodeInput','hvl_gem_id',1,'IIPostCodeS',gemeenteList,20,100)" />

           </span>

           <span id="postcodevast" ondblclick="invoer('adres');invoerPC()"></span>

        </div>

    </div>





    <div class="inputItem" id="IIPostCodeS">

        <div class="label160">Kies eventueel&nbsp;:</div>

        <div class="waarde">

            <select onClick="handleSelectClick('edithvlform','postCodeInput','hvl_gem_id',1,'IIPostCodeS')" 

            name="gem_id" id="hvl_gem_id" size="5">

            </select>

        </div>

    </div><!--Contactadres -->











    <div class="label160" ondblclick="invoer('tel')">Tel.&nbsp;: </div>

    <div class="waarde">

        <input type="text" size="35" value="<?php print($valTel)?>" name="tel" id="telInput"/>

        <span  id="tel" style="display:none" ondblclick="invoer('tel')"></span>

    </div><!--Tel -->





    <div class="label160" ondblclick="invoer('fax')">Fax&nbsp;: </div>

    <div class="waarde">

        <input type="text" size="35" value="<?php print($valFax)?>" name="fax" id="faxInput"/>

        <span  id="fax" style="display:none" ondblclick="invoer('fax')"></span>

    </div><!--Fax -->





    <div class="label160" ondblclick="invoer('gsm')">GSM&nbsp;: </div>

    <div class="waarde">

        <input type="text" size="35" value="<?php print($valGsm)?>" name="gsm" id="gsmInput"/>

        <span  id="gsm" style="display:none" ondblclick="invoer('gsm')"></span>

    </div><!--GSM -->





    <div class="label160" ondblclick="invoer('email')">E-mail<span class="reqfield" style="display:none;" id="loginSter">*</span>&nbsp;:

    </div>

    <div class="waarde">

        <input type="text" size="35" value="<?php print($valEmail)?>" name="email" id="emailInput"/>

        <span  id="email" style="display:none" ondblclick="invoer('email')"></span>

    </div><!--E-mail -->





<?php

  if (isset($valVervangt)) {

?>

      <div class="label160">Vervangt : </div>

      <div class="waarde">

         <a href="edit_verlener.php?readOnly=1&id=<?= $valVervangt ?>">hulpverlener <?= $valVervangt ?></a>

      </div><!--vervangt -->

<?php

}
?>

<!-- validatiestatus -->

      <div class="label160">Registratiestatus&nbsp;: </div>

      <div class="waarde" style="height:auto;">
<?php
         if ($valValidatieStatus == "geenkeuze") {
           print("Papieren nog niet opgestuurd of nog niet verwerkt.<br/><a href=\"$siteadresPDF/php/print_registratiepdf.php?id=$a_hvl_id&tabel=hulpverleners\" target=\"_blank\">Druk hier</a> deze papieren af.");
           // listel kan status veranderen in "halfweg"
           if ($_SESSION['profiel']=="listel") {
              print("<br/><input type=\"radio\" name=\"validatiestatusCheck\" id=\"validatieHalfweg\" value=\"halfweg\" onclick=\"toonLoginVelden('inline')\"  /> Geef <strong>beperkte</strong> toegangsrechten.\n");
           }
         }
         else if ($valValidatieStatus == "aanvraag") {
           print("Zelf ingevuld en papieren opgestuurd op $valDatumAanvraag.");
           // listel kan status veranderen in "validatie"
           if ($_SESSION['profiel']=="listel") {
              print("<br/><input type=\"radio\" name=\"validatiestatusCheck\" value=\"gevalideerd\" onclick=\"toonLoginVelden('inline')\"/> Geef <strong>volledige</strong> toegangsrechten.\n");
           }
         }
         else if ($valValidatieStatus == "halfweg") {
           print("Voorlopige login sinds $valDatumAanvraag.");
           //if ($_SESSION['profiel']=="hulp") print("<br/>Duid je keuze voor de sociale kaart aan om volledige toegang te krijgen. (alleen voor zelfstandigen!)");
           if (($_SESSION['profiel']=="hulp" && $_SESSION['usersid'] == $valID)) {
             print("<br/><input type=\"radio\" name=\"validatiestatusCheck\" value=\"gevalideerd\" onclick=\"toonLoginVelden('inline')\"/> Ik activeer mijn login volledig.\n");
           }
           // listel kan status veranderen in "validatie"
           if ($_SESSION['profiel']=="listel") {
              print("<br/><input type=\"radio\" name=\"validatiestatusCheck\" value=\"gevalideerd\" onclick=\"toonLoginVelden('inline')\"/> Geef <strong>volledige</strong> toegangsrechten.\n");
           }
         }
         else if ($valValidatieStatus == "gevalideerd") {
           print("Actieve login sinds $valDatumValidatie.");
         }

         if ($valValidatieStatus == "") {
            print("<input type=\"hidden\" name=\"validatiestatus\" value=\"geenkeuze\"/>\n");
            print("<input type=\"radio\" name=\"validatiestatusCheck\" id=\"vraagLoginAan\" value=\"aanvraag\" onclick=\"toonLoginVelden('inline')\"/> Ik vraag WEL een login aan voor het e-zorgplan.\n");
            print("<br/><input type=\"radio\" name=\"validatiestatusCheck\" id=\"vraagGeenLoginAan\" value=\"\" onclick=\"toonLoginVelden('none')\"/> Ik vraag (nog) GEEN login aan voor het e-zorgplan.\n");
         }
         else if ($valValidatieStatus == "weigering") {
           print("Neemt niet deel aan het communicatieplatform. <br/>Weigering op $valDatumWeigering.<br/>");
           print("Indien deze persoon toch terug een login wil, <br/><a href=\"$siteadresPDF/php/print_registratiepdf.php?id=$a_hvl_id&tabel=hulpverleners\" target=\"_blank\">druk hier</a> de nodige papieren af.");
           print("<input type=\"hidden\" name=\"validatiestatus\" value=\"$valValidatieStatus\" />");
           // listel kan status veranderen in "halfweg"
           if ($_SESSION['profiel']=="listel") {
              print("<br/><input type=\"radio\" name=\"validatiestatusCheck\" id=\"validatieHalfweg\" value=\"halfweg\" onclick=\"toonLoginVelden('inline')\"/> Geef beperkte toegangsrechten\n");
              print("<br/><input type=\"radio\" name=\"validatiestatusCheck\" id=\"weigeringaf\" value=\"\" onclick=\"toonLoginVelden('inline')\"/> Behoud deze status.\n");
           }
         }
         else {
            print("<input type=\"hidden\" name=\"validatiestatus\" value=\"$valValidatieStatus\" />");
           if ($_SESSION['profiel']=="listel"
               || $_SESSION['isOrganisator']==1
               || ($_SESSION['profiel']=="hulp" && $_SESSION['usersid'] == $valID)) {
             // status veranderen in "weigering"
             print("<br/><input type=\"radio\" name=\"validatiestatusCheck\" value=\"weigering\" id=\"geweigerd\"");
             print("onclick=\"if(!bevestigWeigering()) { $('weigeringaf').checked=true; toonLoginVelden('inline'); } else toonLoginVelden('none');\" /> Noteer keuze om geen login aan te vragen.\n");
             print("<br/><input type=\"radio\" name=\"validatiestatusCheck\" id=\"weigeringaf\" value=\"\"/ onclick=\"toonLoginVelden('none')\"> Behoud deze status.\n");
           }
         }
?>
<br/>
<br/>
      </div><!--validatiestatus -->

<?php
if ($_SESSION['profiel']==""
    || ($valValidatieStatus == "")
    || $_SESSION['profiel']=="listel"
    || ($_SESSION['profiel'] =="hulp" && $valID == $_SESSION['usersid'])) {

  if ($valValidatieStatus == "" || $valValidatieStatus == "geenkeuze" || $valValidatieStatus == "weigering") $zichtbaar = "none";
  else $zichtbaar = "inline";

?>


<span id="loginReeks" style="display: <?= $zichtbaar ?>">
<!-- login en paswoord -->
      <div class="label160">Login&nbsp;: </div>

      <div class="waarde">

         <input

            type="text"

            size="35"

            value="<?php print($valLogin)?>"

            name="login"
            id ="login"
            onkeyup="isUniekeLogin();"
         />

      </div><!--login -->

<?php
}

if ($_SESSION['profiel']=="listel"
    || ($_SESSION['profiel'] =="hulp" && $valID == $_SESSION['usersid'])) {

?>


      <div class="label160">Verander paswoord&nbsp;: </div>

      <div class="waarde">

         <input

            type="checkbox"

            value="1"

            name="setpasswd"
            id ="paswoordInvullen"

            onclick="if (this.checked) document.getElementById('pwd').style.visibility = 'visible'; else document.getElementById('pwd').style.visibility = 'hidden'; " />

      </div><!--pwd -->

    <div id="pwd" classs="waarde" style="visibility:hidden">
      <div class="label160"><input type="button" onclick="voorstelPWD()" value="voorstel voor paswoord" /></div>
      <div class="waarde" id="voorstelPWD"></div>

      <div class="label160">Nieuw paswoord&nbsp;: </div>

      <div class="waarde">

         <input

            type="password"

            name="passwd1"
            id = "passwd1" />

      </div><!--pwd1 -->

      <div class="label160">Nieuw paswoord (herhaling)&nbsp;: </div>

      <div class="waarde">

         <input

            type="password"

            name="passwd2" />

      </div><!--pwd2 -->

<!--

          Vul hier <b>2x</b> het nieuwe paswoord in. <br />

          (Een oud paswoord kunnen we niet ophalen<br /> omdat het versleuteld bewaard wordt.)<br />

-->

    </div>
<?php
}
else if ($valValidatieStatus == "") {

?>

         <input

            type="hidden"

            value="1"

            name="setpasswd"
            id ="paswoordInvullen"
             />

    <div id="pwd" classs="waarde">

      <div class="label160">Kies een paswoord&nbsp;: </div>

      <div class="waarde">

         <input

            type="password"

            name="passwd1"
            id = "passwd1" />

      </div><!--pwd1 -->

      <div class="label160">Paswoord (ter controle)&nbsp;: </div>

      <div class="waarde">

         <input

            type="password"

            name="passwd2" />

      </div><!--pwd2 -->

<!--

          Vul hier <b>2x</b> het nieuwe paswoord in. <br />

          (Een oud paswoord kunnen we niet ophalen<br /> omdat het versleuteld bewaard wordt.)<br />

-->

    </div>
<?php
}
if ($_SESSION['profiel'] =="listel"
   || ($valValidatieStatus == "")
   || ($_SESSION['profiel'] =="hulp" && $valID == $_SESSION['usersid'])) {

?>
<!-- geheime vraag en antwoord -->

      <input type="hidden" name="geheimeVraagIsAanwezig" value="1" />
      <div class="label160" style="width:470px;height:34px;text-align:left;"><em>Wanneer je je paswoord vergeet, kan je een nieuwe paswoord bekomen aan de hand van deze geheime vraag.
      </em></div>
      <div class="label160">Geheime vraag&nbsp;: </div>

      <div class="waarde">

         <input

            type="text"

            size="35"

            value="<?php print($valGeheimeVraag)?>"

            name="geheimeVraag"
         />

      </div>
      <div class="label160">Geheim antwoord&nbsp;: </div>

      <div class="waarde">

         <input

            type="text"

            size="35"

            value="<?php print($valGeheimAntwoord)?>"

            name="geheimAntwoord"
         />

      </div>
</span>
<?php
}

  if ($valIsOrganisator == 1 || ($_SESSION['profiel']=="listel")) {
?>

<!-- is organisator -->

      <div class="label160">Is organisator&nbsp;: </div>

      <div class="waarde">

         <input

            type="checkbox"
            <?php if ($valIsOrganisator == 1) print(" checked=\"checked\" "); ?>
            <?php if ($_SESSION['profiel']!="listel") print(" disabled=\"disabled\" "); ?>
            value="1"
            name="isOrganisator"
         />

      </div>


<?php
  }
  //-- gedetacheerd_ggz --
  if (($valGedetacheerd==1 || $valMobiel==1) && ($_SESSION['profiel']=="listel")) {
     $toon = "block";
  }
  else {
     $toon = "none";
  }
?>

<span id="gedetacheerd_ggz" style="display:<?= $toon ?>;">
      <div class="label160">Gedetacheerd vanuit art.107&nbsp;: </div>
      <div class="waarde">
         <input
            type="checkbox"
            <?php if ($valGedetacheerd == 1) print(" checked=\"checked\" "); ?>
            value="1"
            name="gedetacheerdGGZ"
         />
      </div>
</span>

<input type="hidden" name="checkMobieleEquipe" id="checkMobieleEquipe" value="0" />
<input type="hidden" name="oudGedetacheerd" id="oudGedetacheerd" value="<?= $valGedetacheerd ?>" />

<?php

  if ($valIsOrganisator == 1 && $action == "Aanpassen") {
          $soort = "hulp";
          $id = $valID;
?>
      <div class="label160">Organisator van &nbsp;: </div>
      <div class="waarde">
         <a href="patientenVoorOrganisator.php?naam=<?= $valNaam . " " . $valVoornaam ?>&soort=<?= $soort ?>&id=<?= $id ?>"><?php print(aantalPatientenVanOrganisator($soort, $id)) ?> pati&euml;nten</a>
      </div><!--aantal patienten -->
<?php
  }
?>

<?php
  if ($_SESSION['profiel']=="listel")  {
?>
      <div class="label160">&nbsp;</div>
      <div class="waarde"><br/>
         <a href="toonEnWisDubbeleHulpverleners.php?naam=<?= $valNaam ?>&voornaam=<?= $valVoornaam ?>&id=<?= $valID ?>&functie_id=<?= $valFunctie ?>">Zoek 'dezelfde' hulpverleners</a>
      </div><!--aantal patienten -->
<?php
  }
?>


</fieldset>



<?php

  if ((!isset($_GET['readOnly'])) && ($_POST['readonly']==0)) {

?>



<fieldset id="opslaan">

    <div class="label160">Deze gegevens</div>

        <div class="waarde">

            <input type="hidden" name="action" id="action" value="<?php print($action)?>" />

            <input type="hidden" name="hvl_id" id="hvl_id" value="<?php print($valID)?>" />

            <input type="hidden" name="gem2_id" value="<?php print($valGem2)?>" />

            <input type="hidden" name="backpage" value="<?php print($a_backpage)?>" />

<?php
  if (($action == "Aanpassen") && (!($valValidatieStatus == "" || $valValidatieStatus == "geenkeuze" || $valValidatieStatus == "weigering"))
       && ($_SESSION['profiel']!="listel")
       && !($_SESSION['profiel'] == "hulp" && $_SESSION['usersid'] == $valID)) {
       // je bent het niet zelf, maar deze login is in eigen beheer, en géén listel-beheerder
    //print("<input type=\"submit\" value=\"worden beheerd door de persoon zelf.\" onclick=\"return false;\"  />\n");
    print("<span class=\"label280\" style=\"text-align: left;\">worden beheerd door de persoon zelf.<br/></span>\n");
  }
  else {
    print("<input type=\"submit\" value=\"$action\" onclick=\"return testLogin();\"  />\n");
  }

?>
         </div>

    <!--Button opslaan -->

</fieldset>

<?php

}
?>

</form>

<?php
if ($valValidatieStatus == "") {
?>

<h3>Korte handleiding</h3>

<p>Om jezelf te registreren als gebruiker van het LISTEL e-zorgplan, gebruik je volgend stappenplan:</p>

<ol>
<li>Selecteer eerst je <strong>Functie</strong> (dit is je discipline, indien niet aanwezig in de keuze gelieve contact op te nemen met LISTEL vzw).</li>
<li>Indien je functie impliceert dat je een RIZIV nummer hebt wordt bij <strong>Organisatie</strong> automatisch 'Zelfstandig ZVL' ingevuld,dit kan je nog aanpassen indien je bij een zorgverleners-organisatie aangesloten bent. Voor alle anders functies dien je de juiste organisatie zelf te selecteren.Hiervoor typ je een aantal letters van je organisatie om te zoekfuncite te gebruiken selecteer je de juiste uit de aangeboden lijst.
Als je op zelfstandige basis werkt  selecteer je "Zelfstandig HVL/XVLP/XVLNP" naargelang je discipline.</li>
<li>Vul je <strong>Naam en Voornaam</strong> in.</li>
<li>Vul indien van toepassing je <strong>RIZIV nummer</strong> en je <strong>Bankrekeningnummer</strong> in.</li>
<li>Vul nu de andere velden in, je <strong>E-mail</strong> is verplicht om je registratie te kunnen aanvragen.</li>
<li>Als je gegevens van de organisatie wil veranderen in je persoonlijke gegevens
(bv. het centraal telefoonnummer vervangen door je eigen rechtstreeks nummer), klik dan 2x op dat telefoonnummer en vul de juiste waarde in.</li>
<li>Na het opslaan van de gegevens door te klikken op <strong>toevoegen</strong>, druk je de bijhorende pdf af en volg je de richtlijnen die dan getoond worden.</li>
<li>Zodra je login gevalideerd is door LISTEL vzw, ontvang je een bevestigingsemail.</li>

</ol>


<p>En dan ben je<br/>Welkom bij het LISTEL e-zorgplan!</p>

<?php
}

?>







<script type="text/javascript">

  document.forms['edithvlform'].elements['naam'].focus();

  startWaarde();

</script>



<?php



  if ($valOrganisatieNaam != "") {

   echo <<< EINDE

     <script type="text/javascript">

        document.edithvlform.organisatieInput.value = "$valOrganisatieNaam";

        refreshListOveral('edithvlform','organisatieInput','organisatie',1,'OrganisatieS',orgList,20);

     </script>

EINDE;

  }



        }





    else{



        



        // ofwel is er een actie gezet, ofwel heeft de post-variabele wis de waarde 1





    if ($_POST['wis'] == 1 && $_POST['hvl_id'] > 0){        // wissen
   		changeActive($_POST['hvl_id'], $a_backpage);
    }
    else if (isset($_POST['action'])) {  // actie gedefinieerd
      $gem_idstring=(!isset($_POST['gem_id']))?$_POST['gem2_id']:$_POST['gem_id'];
      if ($gem_idstring == "0" ||  $gem_idstring == "") $gem_idstring = "9999";

      if( ($_POST['reknr1']<>"") && ($_POST['reknr2']<>"") && ($_POST['reknr3']<>"") ){
   			$reknrstring = $_POST['reknr1']."-".$_POST['reknr2']."-".$_POST['reknr3'];
  		}
      else {
  			$reknrstring="";
  		}

      if ($_POST['validatiestatus']!=$_POST['validatiestatusCheck'] && $_POST['validatiestatusCheck']!="") {
        // validatiestatus veranderd
        if ($_POST['validatiestatusCheck']=="aanvraag") {
          $mailSturen = true;
          $mailTo = "{$_POST['email']},$gegevens_email_contact";
          $mailOnderwerp = "LISTEL e-zorgplan : registratie halfweg";
          $mailInhoud = "<p>Beste " . utf8_decode($_POST['voornaam']) . " " .  utf8_decode($_POST['naam']) . ",<br/></p><p>uw registratie voor het LISTEL e-zorgplan is genoteerd. Zodra de papieren bij ";
          $mailInhoud .= "LISTEL vzw aankomen, krijg je bevestiging van jouw registratie en kan je het e-zorgplan ten volle gebruiken.<br/>";
          $mailInhoud .= "<br/>Inloggen doe je dan op <a href='$siteadres'>$siteadres</a>.<br/><br/></p>";
          $mailInhoud .= "<p>Ben je vergeten de papieren af te drukken, dan kan je die <a href=\"$siteadresPDF/php/print_registratiepdf.php?id=";
          $mailInhoud2 = "&tabel=hulpverleners\">hier</a> terug afhalen.<br/><br/></p>";
          $mailInhoud2 .= "<p><br/>Anick Noben, LISTEL vzw</p>";
          $mailTweeStukken = true;

          $datumVeld = "aanvraagdatum, ";
          $datumWaarde = " NOW(),";
          $datumAanpassing = " aanvraagdatum = NOW(), ";
          
          $laatPapierenAfdrukken=true;
        }
        else if ($_POST['validatiestatusCheck']=="halfweg") {
          $mailSturen = true;
          $mailTo = "{$_POST['email']},$gegevens_email_contact";
          $mailOnderwerp = "LISTEL e-zorgplan : registratie halfweg";
          $mailInhoud = "<p>Beste " . utf8_decode($_POST['voornaam']) . " " .  utf8_decode($_POST['naam']) . ",<br/></p><p>uw registratie voor het LISTEL e-zorgplan is nu halfweg. Dat betekent dat je ";
          $mailInhoud .= "kan inloggen om je persoonlijke gegevens te controleren en eventueel aan te passen.<br/>";
          $mailInhoud .= "Je login hiervoor is <em>{$_POST['login']}</em> en je paswoord <em>{$_POST['passwd1']}</em>.<br/>";
          $mailInhoud .= "Inloggen doe je op <a href='$siteadres'>$siteadres</a>.<br/><br/>";
//          $mailInhoud .= "Zodra je aangeduid hebt welke gegevens op de sociale kaart mogen, heb je volledige toegang tot de zorgplannen.";
//          $mailInhoud .= "Breng dit dan ook zo snel mogelijk in orde.<br/></p>";
          $mailInhoud .= "<p><br/>Anick Noben, LISTEL vzw</p>";
          
          $datumVeld = "aanvraagdatum, ";
          $datumWaarde = " NOW(),";
          $datumAanpassing = " aanvraagdatum = NOW(), ";
        }
        else if ($_POST['validatiestatusCheck']=="gevalideerd") {
          $mailSturen = true;
          $mailTo = "{$_POST['email']}";
          $mailOnderwerp = "LISTEL e-zorgplan : registratie gevalideerd";
          $mailInhoud = "<p>Beste " . utf8_decode($_POST['voornaam']) . " " .  utf8_decode($_POST['naam']) . ",<br/></p><p>uw registratie voor het LISTEL e-zorgplan is nu volledig. Dat betekent dat je ";
          $mailInhoud .= "nu volledige toegang hebt tot de zorgplannen.<br/>";
          $mailInhoud .= "Inloggen doe je op <a href='$siteadres'>$siteadres</a>.<br/><br/></p>";
          $mailInhoud .= "<p><br/>Anick Noben, LISTEL vzw</p>";

          $datumVeld = "validatiedatum, ";
          $datumWaarde = " NOW(),";
          $datumAanpassing = " validatiedatum = NOW(), ";
          
          // en nu de vervangt ketting volgen!
          magWeg($_POST['hvl_id'],$_POST['hvl_id']);
          
        }
        else if ($_POST['validatiestatusCheck']=="weigering") {
          if ($_POST['validatiestatus']=="" || $_POST['validatiestatus']=="geenkeuze") {
             $mailSturen = false;
          }
          else {
             $mailSturen = true;
          }
          $mailTo = "{$_POST['email']},$gegevens_email_contact";
          $mailOnderwerp = "LISTEL e-zorgplan : registratie geweigerd";
          $mailInhoud = "<p>Beste " . utf8_decode($_POST['voornaam']) . " " .  utf8_decode($_POST['naam']) . ",<br/></p><p>uw login voor het LISTEL e-zorgplan is afgesloten. Dat betekent dat je ";
          $mailInhoud .= "geen elektronische toegang hebt tot de zorgplannen.<br/>";
          $mailInhoud .= "Indien dit een fout is, neem dan zo snel mogelijk contact op met Anick Noben, tel. 011/81.94.70.<br/><br/></p>";
          $mailInhoud .= "<p><br/>Anick Noben, LISTEL vzw</p>";

          $datumVeld = "weigerdatum, ";
          $datumWaarde = " NOW(),";
          $datumAanpassing = " weigerdatum = NOW(), ";
          $oorspronkelijkeStatus = $_POST['validatiestatus'];
        }


        $_POST['validatiestatus']=$_POST['validatiestatusCheck'];
      }

      if ($_POST['geheimeVraagIsAanwezig']==1) {
        $geheimVeld = "geheime_vraag, geheim_antwoord, ";
        $geheimWaarde = "'{$_POST['geheimeVraag']}', '{$_POST['geheimAntwoord']}', ";
        $geheimUpdate = " geheime_vraag = '{$_POST['geheimeVraag']}', geheim_antwoord = '{$_POST['geheimAntwoord']}', ";
      }

      $rizivstring = $_POST['riziv1'].$_POST['riziv2'];

      if ($_POST['socialeKaart']==0) {
        $socialeKaart = 0;
        $socialeTel = 0;
        $socialeFax = 0;
        $socialeEmail = 0;
      }
      else if ($_POST['socialeKaart']==-1) {
        $socialeKaart = -1;
        $socialeTel = 0;
        $socialeFax = 0;
        $socialeEmail = 0;
      }
      if ($_POST['socialeKaart']==1) {
        $socialeKaart = 1;
        $socialeTel = 0+$_POST['sociaalTel'];
        $socialeFax = 0+$_POST['sociaalFax'];
        $socialeEmail = 0+$_POST['sociaalEmail'];
        $socialeFunctie = $_POST['sociaalFunctie'];
      }
      if ($_SESSION['profiel']=="listel") {
        if (!isset($_POST['gedetacheerdGGZ'])) {
          $_POST['gedetacheerdGGZ'] = 0;
        }
        $gedetacheerdField = " , gedetacheerd_ggz ";
        $gedetacheerdValue = " , {$_POST['gedetacheerdGGZ']} ";
        $gedetacheerdUpdate = " , gedetacheerd_ggz = {$_POST['gedetacheerdGGZ']}";
      }
      else {
        if ($_POST['oudGedetacheerd'] == 1) {
          $gedetacheerdField = " , gedetacheerd_ggz ";
          $gedetacheerdValue = " , 1 ";
          $gedetacheerdUpdate = " , gedetacheerd_ggz = 1";
        }
      }
      if (isset($_POST['action']) && ($_POST['veranderd']==0)) {
            print("<script>
                function redirect()
                    {document.location = \"".$a_backpage."\";}
                setTimeout(\"redirect()\",1000);
                </script>");
			      print("Je hebt niks veranderd in het formulier en <br/>dus hebben we de gegevens van deze zorg- of hulpverlener behouden.</b><br>");
            die();
      }
      else if( isset($_POST['action']) && ($_POST['action'] == "toevoegen") && $_SESSION['profiel']!="listel" && $_POST['checkMobieleEquipe']==1){
         print("<div style=\"background-color:#f44;\">Alleen Listel mag mensen toevoegen aan mobiele equipes.</div>");
      }
      else if( isset($_POST['action']) && ($_POST['action'] == "toevoegen") ){
            //----------------------------------------------------------
            // query om een nieuwe hulpverlener toe te voegen
        $organi = $_POST['organisatie'];
        preset($_POST['isOrganisator']);
        
        if ($_POST['setpasswd']==1 && $_POST['passwd1'] != "" && $_POST['passwd1'] == $_POST['passwd2'])  {
          $passwdVeld = " paswoord, ";
          $passwdWaarde = " '" . shA1($_POST['passwd1']) . "', ";
        }
        

				$sql = "
            INSERT INTO
                hulpverleners
                    (
                    naam,
                    voornaam,
                    login, $passwdVeld
                    $geheimVeld
                    tel,
                    fax,
                    gsm,
                    adres,
                    gem_id,
                    email,
                    riziv1,
                    riziv2,
                    riziv3,
                    fnct_id,
                    organisatie,
                    reknr,
                    iban,
                    bic,
                    $datumVeld
                    validatiestatus,
                    is_organisator,
                    sociale_kaart,
                    sociale_functie,
                    sociale_email,
                    sociale_fax,
                    sociale_tel
                    $gedetacheerdField
                    )
            VALUES
                (
                \"{$_POST['naam']}\",
                \"{$_POST['voornaam']}\",
                '".$_POST['login'].  "', $passwdWaarde
                $geheimWaarde
                '".$_POST['tel'].       "',
                '".$_POST['fax'].       "',
                '".$_POST['gsm'].       "',
                \"{$_POST['adres']}\",
                '".$gem_idstring.       "',
                '".$_POST['email'].     "',
                '".$rizivstring.        "',
                '".$_POST['riziv3'].    "',
                '".$_POST['riziv4'].    "',
                '".$_POST['fnct_id'].   "',
                $organi,
                '".$reknrstring.        "',
                '".$_POST['IBAN'].    "',
                '".$_POST['BIC'].   "',
                $datumWaarde
                '".$_POST['validatiestatus'].   "',
                {$_POST['isOrganisator']},
                $socialeKaart,
                \"$socialeFunctie\",
                $socialeEmail,
                $socialeFax,
                $socialeTel
                $gedetacheerdValue
                )";
             $ok=mysql_query($sql);
             $nieuweHVLid = $nieuwID = mysql_insert_id();
            //----------------------------------------------------------
            }

        else if (($_POST['validatiestatus']=="")||($_POST['validatiestatus']=="geenkeuze")
                 || ($_POST['validatiestatus']=="weigering" && $oorspronkelijkeStatus != "gevalideerd")){
            //----------------------------------------------------------
            // query om een hulpverlener aan te "passen"
              $organi = $_POST['organisatie'];

        if ($_POST['setpasswd']==1 && $_POST['passwd1'] != "" && $_POST['passwd1'] == $_POST['passwd2'])  {
          $passwdVeld = " paswoord, ";
          $passwdWaarde = " '" . shA1($_POST['passwd1']) . "', ";
        }

        preset($_POST['isOrganisator']);
        $sqlNieuw = "
            INSERT INTO
                hulpverleners
                    (
                    naam,
                    voornaam,
                    login, $passwdVeld
                    $geheimVeld
                    tel,
                    fax,
                    gsm,
                    adres,
                    gem_id,
                    email,
                    riziv1,
                    riziv2,
                    riziv3,
                    fnct_id,
                    organisatie,
                    reknr,
                    iban,
                    bic,
                    $datumVeld
                    validatiestatus,
                    is_organisator,
                    vervangt,
                    sociale_kaart,
                    sociale_functie,
                    sociale_email,
                    sociale_fax,
                    sociale_tel
                    $gedetacheerdField
                    )
            VALUES
                (
                \"{$_POST['naam']}\",
                \"{$_POST['voornaam']}\",
                '".$_POST['login'].  "', $passwdWaarde
                $geheimWaarde
                '".$_POST['tel'].       "',
                '".$_POST['fax'].       "',
                '".$_POST['gsm'].       "',
                \"{$_POST['adres']}\",
                '".$gem_idstring.       "',
                '".$_POST['email'].     "',
                '".$rizivstring.        "',
                '".$_POST['riziv3'].    "',
                '".$_POST['riziv4'].    "',
                '".$_POST['fnct_id'].   "',
                $organi,
                '".$reknrstring.        "',
                '".$_POST['IBAN'].    "',
                '".$_POST['BIC'].   "',
                $datumWaarde
                '".$_POST['validatiestatus'].   "',
                {$_POST['isOrganisator']},
                {$_POST['hvl_id']},
                $socialeKaart,
                \"$socialeFunctie\",
                $socialeEmail,
                $socialeFax,
                $socialeTel
                $gedetacheerdValue
                )";

              $ok=mysql_query($sqlNieuw);
              $nieuweHVLid = $nieuwID = mysql_insert_id();
              $sqlUpdate = "
                UPDATE
                  hulpverleners
                SET
                  actief = 0
                WHERE
                  id=".$_POST['hvl_id'];
              $ok = $ok && mysql_query($sqlUpdate);

              $sqlPasAan = " update huidige_betrokkenen
                             set persoon_id = $nieuwID
                             where persoon_id = {$_POST['hvl_id']}
                             and genre = 'hulp'";
              $sqlOverlegContact = " update overleg
                             set contact_hvl = $nieuwID
                             where contact_hvl = {$_POST['hvl_id']}
                             and afgerond = 0";
              $ok = $ok && mysql_query($sqlPasAan) && mysql_query($sqlOverlegContact);
            //----------------------------------------------------------
            }
        else {
            //----------------------------------------------------------
            // query om een hulpverlener ECHT aan te passen

              $organi = $_POST['organisatie'];

        if ($_POST['setpasswd']==1 && $_POST['passwd1'] != "" && $_POST['passwd1'] == $_POST['passwd2'])  {
          $passwdUpdate = " paswoord = '" . shA1($_POST['passwd1']) . "', ";
        }
        
        if ($_POST['validatiestatus'] != "")
          $validatieVerandering = "                    validatiestatus = '".$_POST['validatiestatus'].   "', ";
        else
          $validatieVerandering = "";

        preset($_POST['isOrganisator']);
				$sqlUpdate = "
            UPDATE
                hulpverleners
            SET
                    naam = \"{$_POST['naam']}\",
                    voornaam = \"{$_POST['voornaam']}\",
                    login = '".$_POST['login'].  "',
                    $passwdUpdate
                    $geheimUpdate
                    tel = '".$_POST['tel'].       "',
                    fax = '".$_POST['fax'].       "',
                    gsm = '".$_POST['gsm'].       "',
                    adres = \"{$_POST['adres']}\",
                    gem_id = '".$gem_idstring.       "',
                    email = '".$_POST['email'].     "',
                    riziv1 = '".$rizivstring.        "',
                    riziv2 = '".$_POST['riziv3'].    "',
                    riziv3 = '".$_POST['riziv4'].    "',
                    fnct_id = '".$_POST['fnct_id'].   "',
                    organisatie = $organi,
                    reknr = '".$reknrstring.        "',
                    iban = '".$_POST['IBAN'].    "',
                    bic = '".$_POST['BIC'].   "',
                    $datumAanpassing
                    $validatieVerandering
                    is_organisator = {$_POST['isOrganisator']},
                    sociale_kaart = $socialeKaart,
                    sociale_functie = \"$socialeFunctie\",
                    sociale_email = $socialeEmail,
                    sociale_fax = $socialeFax,
                    sociale_tel = $socialeTel
                    $gedetacheerdUpdate
           WHERE id = {$_POST['hvl_id']}
            ";

              $ok = mysql_query($sqlUpdate);
            //----------------------------------------------------------
            }

        if ($ok){

          if ($laatPapierenAfdrukken) {
             print("<p>De gegevens van het formulier zijn <b>succesvol</b> ingevoegd.<br/>");
             if ($mailOnderwerp != "" && $mailTo != "") {  // WAT ALS ER ENKEL EEN EMAILADRES IS VAN DE ORGANISATIE???
               if (!isset($nieuweHVLid) || $nieuweHVLid==0) $nieuweHVLid = $_POST['hvl_id'];
               if ($mailTweeStukken) {
                 $mailInhoud = $mailInhoud . $nieuweHVLid . $mailInhoud2;
               }
               if ($mailSturen) {
                 htmlmailZonderCopy($mailTo,$mailOnderwerp, $mailInhoud);
                 print("Zowel jijzelf als LISTEL ontvangen nu een email omtrent jouw aanvraag.<br/>\n");
                 //print($mailInhoud);
               }
             }
             print("Je moet wel nog volgende <a href=\"$siteadresPDF/php/print_registratiepdf.php?id=$nieuweHVLid&tabel=hulpverleners\">papieren afdrukken</a>, handtekenen en opsturen naar LISTEL.\n");
             print("<br/>Pas daarna kan je login geactiveerd worden.</p>\n");
             print("<div style='display:none'>$mailOnderwerp<br/>$mailInhoud</div>");
          }
          else {
             if ($a_backpage!="edit_verlener.php")
               print("<script>
                function redirect()
                    {document.location = \"".$a_backpage."\";}
                setTimeout(\"redirect()\",2000);
                </script>");

             print("De gegevens van het formulier zijn <b>succesvol ingevoegd.</b><br>");
             if ($mailOnderwerp != "" && $mailTo != "" && $mailSturen) {  // WAT ALS ER ENKEL EEN EMAILADRES IS VAN DE ORGANISATIE???
               htmlmailZonderCopy($mailTo,$mailOnderwerp, $mailInhoud);
               print("De zorg-/hulpverlener is verwittigd van zijn statusverandering in <em>{$_POST['validatiestatus']}</em>.<br/>");
               print("<div style='display:none'>$mailOnderwerp<br/>$mailInhoud</div>");
             }
           }

        }

        else{

            

            print("De gegevens van het formulier zijn <b>niet</b> succesvol ingevoegd,<br>");

			      print(mysql_error() . $sqlNieuw . $sqlUpdate . $sqlPasAan);

         }

        }

    }





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

/* Sluit Dbconnectie */ require("../includes/dbclose.inc");

//---------------------------------------------------------



//---------------------------------------------------------

/* Geen Toegang */ //require("../includes/check_access.inc");

//---------------------------------------------------------

?>