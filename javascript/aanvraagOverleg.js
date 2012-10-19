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


function testRR(rijksregister) {
   document.f.rijksregister.value = rijksregister;
   if (rijksregister.length == 11) {
     $('loading').style.display="block";

     var request = createREQ();

     var rand1 = parseInt(Math.random()*9);
     var rand2 = parseInt(Math.random()*999999);
     var url = "aanvraag_patientstatus_ajax.php?rr=" + rijksregister + "&rand" + rand1 + "=" + rand2;

     request.onreadystatechange = function() {
      if (request.readyState == 4) {
        $('loading').style.display="none";
        var response = request.responseText;
        var archiefPos = response.indexOf("archief");
        if (response.indexOf("nieuw")>=0) {
          vraagTypePatient();
          activeer = false;
        }
        else if (archiefPos >=0) {
          toonOudeGemeente(response.substr(archiefPos));
          activeer = true;
          // als dit een oc is, toon dan de betrokkenen in stap 4
          // de functie toonBetrokkenenInStap4(); wordt opgesteld in aanvraag_overleg.php
          toonBetrokkenenInStap4(rijksregister);
        }
        else {
          waarschuwing(rijksregister);
          var streep = response.indexOf("|");
          oudeOC = response.substr(0,streep);
          var typePatient = response.substr(streep+1);
          if (typePatient == 16 || typePatient == 18) {
            isPsy = true;
          }
          else {
            isPsy = false;
          }
          toonOC(true);
          activeer = false;
          // als dit een oc is, toon dan de betrokkenen in stap 4
          // de functie toonBetrokkenenInStap4(); wordt opgesteld in aanvraag_overleg.php
          toonBetrokkenenInStap4(rijksregister);
        }
      }
     }
     // en nu nog de request uitsturen
     request.open("GET", url);
     request.send(null);
   }
   else {
     resetStap1();
   }
}

function zoekWaarschuwing(rijksregister, overlegGemeente) {
     var request = createREQ();

     var rand1 = parseInt(Math.random()*9);
     var rand2 = parseInt(Math.random()*999999);
     var url = "aanvraag_overleg_getWaarschuwing_ajax.php?rr=" + rijksregister
                     + "&overleg_gemeente=" + overlegGemeente + "&rand" + rand1 + "=" + rand2;

     request.onreadystatechange = function() {
      if (request.readyState == 4) {
        var response = request.responseText;
        if (response.indexOf("Alles OK") == -1) {
           $('waarschuwing').style.display="block";
           $('waarschuwing').innerHTML = response;
        }
      }
     }
     // en nu nog de request uitsturen
     request.open("GET", url);
     request.send(null);
}

function resetStap1() {
     $('loading').style.display="none";
     $('BlokPostCode').style.display = "none";
     $('BlokOudePostCode').style.display = "none";
     $('postCodeInput').value = "";
     $('waarschuwing').style.display="none";
     $('stap2Keuze').style.display = "none";
     $('keuzeOC').style.display = "none";
     $('toonOC').style.display = "none";
     verbergStap3();
     toonStap4("none");
     resetBetrokkenenInStap4();
}

function checkDossier() {
  document.f.patientNaamInput.value="";
  var code = document.f.dossierCodeInput.value;
    for (i = 0; i < dossierList.length; i=i+2) {
      if (dossierList[i] == code) {
        testRR(dossierList[i+1]);
        return;
      }
    }
  alert("U hebt geen geldig volgnummer " + code + "ingegeven");
  document.f.dossierCodeInput.value="";
  return false;
}

function checkPatient() {
  document.f.dossierCodeInput.value="";
  var code = document.f.patientNaamInput.value;
   for (i = 0; i < patientList.length; i=i+2) {
      //alert(code + "-" + dossierList[i]);
      if (patientList[i].indexOf(code)!=-1) {
        testRR(patientList[i+1]);
        return;
      }
    }
  alert("U hebt geen geldige patient ingegeven");
  document.f.patientNaamInput.value="";
  return false;
}


function wisNaam() {
  document.f.patientNaamInput.value="";
  $('IIPatientnaamS').style.display = "none";
  resetStap1();
}
function wisDossier() {
  document.f.dossierCodeInput.value="";
  $('IIDossierCodeS').style.display = "none";
  resetStap1();
}
function wisRR() {
  document.f.rijksregister.value="";
  resetStap1();
}
function vraagTypePatient() {
  $('BlokTypePatient').style.display = "block";
}

function zetTypePatient(parameter) {
  isPsy = parameter;
  toonGemeente();
  if ($('stap2Keuze').style.display == "block"
      && ($('kiesPsy').style.display == "block"  || $('kiesHulp').style.display == "block") ) {
    selecteerHulpOfPsy();
  }
}

function toonGemeente() {
  $('BlokPostCode').style.display = "block";
}
function toonHuidigeGemeente() {
   $('BlokPostCode').style.display = "none";
   $('stap2Keuze').style.display = "none";
   $('postcodeTekst').innerHTML = 'Postcode huidige woonplaats&nbsp;: ';
   toonGemeente();
   $('toonOC').style.display = "none";
}
function toonOudeGemeente(response) {
  $('BlokOudePostCode').style.display = "block";
  var streep = response.indexOf("|");
  $('laatsteWoonplaats').innerHTML = response.substr(7,streep-7);
  response = response.substr(streep+1);
  var streep = response.indexOf("|");
  oudeOC = response.substr(0,streep);
  var typePatient = response.substr(streep+1);
  if (typePatient == 16 || typePatient == 18) {
    isPsy = true;
  }
  else {
    isPsy = false;
  }
}
function toonOC(huidige) {
  $('stap2Keuze').style.display = "block";
  $('keuzeOC').style.display = "none";
  $('toonOC').style.display = "block";
  if (huidige) {
    $('ocTekst').innerHTML = 'De huidige overlegco&ouml;rdinator&nbsp;: ';
  }
  else {
    $('BlokPostCode').style.display = "none";
    $('ocTekst').innerHTML = 'De overlegco&ouml;rdinator&nbsp;: ';
  }
  $('laatsteOC').innerHTML = oudeOC;
  //alert(oudeOC);
}

function toonStap2Keuze() {
  $('stap2Keuze').style.display = "block";
  $('keuzeOC').style.display = "block";
}

function selecteerOCMW() {
  $('kiesRDC').style.display = "none";
  $('kiesHulp').style.display = "none";
  $('kiesPsy').style.display = "none";
}
function selecteerRDC() {
  $('kiesRDC').style.display = "block";
  $('kiesHulp').style.display = "none";
  $('kiesPsy').style.display = "none";
  organisatieGekozen = false;
  organisatieReden = false;
}

var isPsy = false;

function selecteerHulpOfPsy() {
  if (isPsy) {selecteerPsy();}
  else selecteerHulp();
}

function selecteerHulp() {
  $('kiesRDC').style.display = "none";
  $('kiesHulp').style.display = "block";
  $('kiesPsy').style.display = "none";
  organisatieGekozen = false;
  organisatieReden = false;
}
function selecteerPsy() {
  $('kiesRDC').style.display = "none";
  $('kiesHulp').style.display = "none";
  $('kiesPsy').style.display = "block";
  organisatieGekozen = false;
  organisatieReden = false;
}

function kiesOrg() {
  organisatieGekozen = true;
}

function kiesRedenOrg() {
  organisatieReden = true;
}

function bevestigKeuze() {
  if (!organisatieGekozen) {
    alert("U hebt nog geen organisator geselecteerd.");
  }
  else   if (!organisatieReden) {
    alert("U hebt nog niet aangeduid waarom u deze organisator kiest.");
  }
  else {
    toonStap3();
  }
}
function toonStap3() {
  $('stap3').style.display = "block";
}

function verbergStap3() {
  $('stap3').style.display = "none";
  $('Informeren').checked=false;
  $('Overtuigen').checked=false;
  $('Organiseren').checked=false;
  $('Debriefen').checked=false;
  $('Beslissen').checked=false;
  $('Doel_ander').checked=false;
  $('doel2').value="";
}

function checkToonStap4() {
  if ($('Informeren').checked
      || $('Overtuigen').checked
      || $('Organiseren').checked
      || $('Debriefen').checked
      || $('Beslissen').checked
      || $('Doel_ander').checked) {
    toonStap4('block');
  }
  else {
    toonStap4('none');
  }
}
function toonStap4(stijl) {
  $('stap4').style.display = stijl;
  $('stap5').style.display = stijl;
}

function welMantel() {
  //$('mantelInfo').style.display = "block";
  $('orgInfo').style.display = "none";
  relatieGekozen = true;
  mantel = true;
}

function geenMantel() {
  //$('mantelInfo').style.display = "none";
  $('orgInfo').style.display = "block";
  relatieGekozen = true;
  mantel = false;
}


function vulAanvragerIn(waarde) {
  var delen = waarde.split("|");
  var org = delen[0];
  var functie = delen[1];
  var naam = delen[2];
  if (org=="onbenoemd") {
    relatieGekozen = false;
    return;
  }
  relatieGekozen = true;
  $('organisatieAanvrager').value = org;
  $('functie').value = functie;
  $('naam').value = naam;
}

function testFormulier() {
  var msg = "";
  if ($('naam').value == "") msg += "  - je hebt de naam van de aanvrager niet ingevuld\n";
  if (!relatieGekozen) msg += "  - je hebt je relatie tot de patient niet aangeduid\n";
  if ($('telefoon') && $('telefoon').value == "" && $('email').value == "") msg += "  - je moet ofwel een emailadres of telefoonnummer invullen.\n";
  if (!mantel && $('organisatieAanvrager').value == "") msg += "  - je hebt de organisatie van de aanvrager niet ingevuld.\n";
  if (activeer) $('activeer').value = "1";
  if (msg == "") return true;
  
  alert("De gegevens over de aanvrager zijn nog onvolledig: \n" + msg);
  return false;
}