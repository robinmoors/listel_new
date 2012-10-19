<?php

session_start();




   require("../includes/dbconnect2.inc");
   require("../includes/clearSessie.inc");



   $paginanaam="Welkom";

   if (IsSet($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan"))

      {

      require("../includes/html_html.inc");

      print("<head>");

      if ($_SESSION['profiel']=="ziekenhuis") {
        print("\n<script type=\"text/javascript\" src=\"../javascript/prototype.js\"></script>\n");
?>
<script type="text/javascript">
function toonZorgbemiddelaar(rijksregister) {
  if (rijksregister == "" || rijksregister== "typ hier het rijksregister") return;
  
  var request = createREQ();
  var rand1 = parseInt(Math.random()*9);
  var rand2 = parseInt(Math.random()*999999);
  var url = "ziekenhuis_zorgbemiddelaar_ajax.php?rr=" + rijksregister + "&rand" + rand1 + "=" + rand2;

  request.onreadystatechange = function() {
    if (request.readyState == 4) {
      var result = request.responseText;
      var spatie = 0;

      if (result.substr(0,2) == "KO") {
        alert("Er is iets ambetant misgegaan, nl. " + result);
      }
      else {
        $('uitslagOpzoeking').style.display = 'block';
        $('uitslagOpzoeking').innerHTML = result;
      }
    }
  }

  // en nu nog de request uitsturen
  request.open("GET", url);
  request.send(null);
}
</script>


<?php
      }
      require("../includes/html_head.inc");

      print("</head>");

      print("<body>");

      print("<div align=\"center\">");

      print("<div class=\"pagina\">");

      require("../includes/header.inc");

      require("../includes/kruimelpad.inc");

      print("<div class=\"contents\">");

      require("../includes/menu.inc");

      print("<div class=\"main\">");

      print("<div class=\"mainblock\">");

			print("<h1>Welkom, {$_SESSION['voornaam']}</h1>");
			
			if (strpos($_SESSION['vorigelogindatum'], "01/01/1970")== 0) {
         print("<p>Welkom op het Limburgse e-zorgplan.</p>");
      }
      else {
			  print("<p>Ter informatie: uw vorige login was op <strong>{$_SESSION['vorigelogindatum']}</strong><br />
                Indien dit niet klopt, neem dan onmiddellijk contact op met LISTEL vzw.</p>");
      }


      if ($_SESSION['profiel']!="bijkomend project") {

        $nieuw = '<li><b><a href="patient_nieuw.php">Nieuwe pati&euml;nten</a> registreren</b></li>';

      }

      if ($_SESSION['profiel']=="caw") {

        print("U kan hier registraties omb beheren.");

      }
/*

      else

      if ($_SESSION['isOrganisator']==1) {

         echo <<< EINDE
               <p>Deze site maakt het mogelijk om effici&euml;nter de gegevens van
               (vergoedbaar) multidisciplinair overleg en evaluaties rond pati&euml;nten te registreren. <br />
               U kan hier in grote lijnen volgende dingen doen:</p>
               <ul>
               $nieuw
               <li><b>Een teamoverleg <a href="select_zplan.php?actie=nieuw">voorbereiden</a>, <a href="select_zplan.php?actie=bewerken">bewerken</a>
               of <a href="select_zplan.php?actie=afsluiten">afronden</a></b></li>
               <li><a href="select_zplan.php?a_next_php=fill_evaluatie_01.php"><b>Evaluaties</b></a> bijhouden</li>
               </ul>
               <p>U kan starten door deze basisitems hierboven of uit het menu aan de linkerzijde te kiezen.
               </p>
EINDE;
      }
*/

      else if ($_SESSION['profiel']=="listel") {

         print("Bekijk hier een heleboel gegevens over alle overleggen.");

      }

      else if ($_SESSION['validatieStatus']=="halfweg") {

         print("Vul uw gegevens aan (o.a. ivm de sociale kaart) om volledige toegang te krijgen tot het e-zorgplan.");

      }
      else if ($_SESSION['profiel']=="ziekenhuis") {
?>
  <h1>Zoek een zorgplan op</h1>
  <p>Als ziekenhuis bent u gemachtigd om de zorgbemiddelaar op te zoeken van een pati&euml;nt die opgenomen is in uw ziekenhuis.</p>
  <p>Geef hieronder het rijksregisternummer in en wij geven u de gegevens van de zorgbemiddelaar.<br/>
  <em>(De knop verschijnt enkel wanneer je precies 11 cijfers ingegeven hebt.)</em></p>
  
  <form>
    <input type="text" id="rijksregister" value="typ hier het rijksregister"
           onclick="if (this.value == 'typ hier het rijksregister') this.value='';"
           onkeyup="if (this.value.length == 11) $('knop').style.display='inline'; else {$('knop').style.display='none';$('uitslagOpzoeking').style.display = 'none';}" />
    <input type="button" id="knop" value="zoek zorgbemiddelaar op" onclick="toonZorgbemiddelaar($('rijksregister').value);" />
  </form>

  <div id="uitslagOpzoeking"></div>

  <p style="font-size:80%;">
  Om misbruik te voorkomen, houden wij vanzelfsprekend een log bij van alle opzoekingen.
  </p>
<?php
      }
      
      else {

         //print("Bekijk hier een heleboel gegevens over pati&euml;nten waarbij u betrokken bent.");

         print("<h1 style=\"background-color: #f5a720\">Werkoverzicht</h1>\n");
         switch ($_SESSION['profiel']) {
            case "OC":
              updateAanvragen("OC", $_SESSION['overleg_gemeente'], $_SESSION['usersid']);
              werkVoor("OC", $_SESSION['overleg_gemeente'], $_SESSION['usersid'], true);
              break;
            case "rdc":
              updateAanvragen("rdc", $_SESSION['organisatie'], $_SESSION['usersid']);
              werkVoor("rdc", $_SESSION['organisatie'], $_SESSION['usersid'], true);
              break;
            case "menos":
              updateAanvragen("menos", -666, $_SESSION['usersid']);
              werkVoor("menos", -666, $_SESSION['usersid'], false);
              break;
            case "hulp":
              updateAanvragen("hulp", $_SESSION['usersid'], $_SESSION['usersid']);
              werkVoor("hulp", $_SESSION['usersid'], $_SESSION['usersid'], $_SESSION['isOrganisator']==1);
              break;
            case "hoofdproject":
            case "bijkomend project":
              updateAanvragen("TP", $_SESSION['tp_project'], $_SESSION['usersid']);
              werkVoor("TP", $_SESSION['tp_project'], $_SESSION['usersid'], true);
              break;
            case "psy":
              updateAanvragen("psy", $_SESSION['organisatie'], $_SESSION['usersid']);
              werkVoor("psy", $_SESSION['organisatie'], $_SESSION['usersid'], true);
              break;
         }
      }


      print("</div>");

      print("</div>");

      print("</div>");

      require("../includes/footer.inc");

      print("</div>");

      print("</div>");

      print("</body>");

      print("</html>");

      }



//---------------------------------------------------------

/* Geen Toegang */ require("../includes/check_access.inc");

//---------------------------------------------------------

?>