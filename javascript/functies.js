function switchVisible(checkbox, div) {
  if (checkbox.checked==1)
    document.getElementById(div).style.display = 'block';
  else
    document.getElementById(div).style.display = 'none';
}

function saveSubsidiestatus(id, code, status) {
  return;
  //alert("ik bewaar nu de status " + status);

  subsidieStatus = status;



  var request = createREQ();



  var rand1 = parseInt(Math.random()*9);

  var rand2 = parseInt(Math.random()*999999);

  var url = "subsidieStatus_ajax.php?code=" + code + "&status=" + status + "&rand" + rand1 + "=" + rand2;



  request.onreadystatechange = function() {

    if (request.readyState < 4) {

       document.getElementById(id).innerHTML = "Uw keuze wordt opgeslagen...";

    }

    else {

      if (request.responseText.indexOf("OK")>=0)

        toonSubsidiestatus(id, code, status)

      else {

        document.getElementById(id).innerHTML = "Shit: een fout! <br/>" + request.responseText;

      }

    }

  }

  // en nu nog de request uitsturen

  request.open("GET", url);

  request.send(null);

}



function toonSubsidiestatus(id, code, status) {
  return;

  subsidiestatusWordtBerekend = false;

  var html = "<p><strong>Vlaamse subsidiestatus</strong></p>";

  switch (status) {

    case "niet-verdedigbaar":

      html += "<p>Dit zorgplan voldoet niet aan de eisen van de Vlaamse overheid i.v.m. subsidieerbaarheid van het zorgplan.</p>";

    break;

    case "verdedigbaar":

      html += "<p>Dit zorgplan voldoet niet helemaal aan de eisen van de Vlaamse overheid i.v.m. subsidieerbaarheid van het zorgplan, ";

      html += "maar dit kan misschien toch goedgekeurd worden door de inspectie. Indien je denkt dat dit kan lukken, druk dan op de knop hieronder.</p>";

      html += "<div style=\"text-align:center\"><input type=\"button\" value=\"Ik verdedig dit.\" ";

      html += "onclick=\"saveSubsidiestatus('" + id + "','" + code + "','verdedigd')\" /></div>";

      html += "<p>Indien je overtuigd bent dat dit zorgplan in g&eacute;&eacute;n geval subsidieerbaar is, weiger dan hieronder de subsidies.</p>";

      html += "<div style=\"text-align:center\"><input type=\"button\" value=\"Weiger subsidies voor het zorgplan \n(staat los van vergoeding GDT)\" ";

      html += "onclick=\"saveSubsidiestatus('" + id + "','" + code + "','niet-verdedigd')\" /></div>";

  // hoogte aanpassen

  if (document.getElementById('main')) {

    var hoogte = document.getElementById('main').style.height;

    hoogte = parseInt(hoogte.substr(0, hoogte.length-2));

    if (isNaN(hoogte) || (hoogte < 744)) hoogte = 744;

    document.getElementById('main').style.height = hoogte + "px";

  }

  

    break;

    case "niet-verdedigd":

      html += "<p>Je hebt gekozen om voor dit zorgplan g&eacute;&eacute;n subsidies van de Vlaamse overheid aan te vragen, alhoewel dit zorgplan misschien toch verdedigbaar is.";

      html += "<br/>Indien je w&eacute;l subsidies wil aanvragen, druk dan op de knop hieronder.</p>";

      html += "<div style=\"text-align:center\"><input type=\"button\" value=\"Ik verdedig dit.\" ";

      html += "onclick=\"saveSubsidiestatus('" + id + "','" + code + "','verdedigd')\" /></div>";

    break;

    case "verdedigd":

      html += "<p>Dit zorgplan voldoet niet helemaal aan de eisen van de Vlaamse overheid, maar onze ervaring leert dat we hiervoor toch subsidies kunnen aanvragen. ";

      html += "We hebben dit dan dan ook gedaan. ";

      html += "<br/>Indien je dit een foute beslissing vindt, en je wil expliciet g&eacute;&eacute;n subsidies aanvragen, druk dan op de knop hieronder.</p>";

      html += "<div style=\"text-align:center\"><input type=\"button\" value=\"Weiger subsidies voor het zorgplan \n(staat los van vergoeding GDT)\" ";

      html += "onclick=\"saveSubsidiestatus('" + id + "','" + code + "','niet-verdedigd')\" /></div>";

    break;

    case "ok":

      html += "Dit zorgplan voldoet volledig aan de eisen van de Vlaamse overheid i.v.m. subsidieerbaarheid van het zorgplan.";

      break;

    default:

      html += "<p>Voorlopig hebben we volgende status <strong>" + status + "</strong> genoteerd, maar dit zou niet mogen voorkomen. Neem dan ook snel contact op met LISTEL vzw om dit na te kijken. Vermeld in ieder geval het zorgplannummer (" + code + ").</p>";

    break;

  }

  document.getElementById(id).innerHTML = html;

}



function berekenSubsidiestatus(id, code, tabel, kolom, waarde, forceer) {
  return;

  // vereist minimumStatus en subsidieStatus

  if (minimumStatus%180==0) {

    if (forceer == 1) toonSubsidiestatus(id, code, "ok");

    else return;

  }

  document.getElementById(id).innerHTML = "Even geduld. De nieuwe subsidiestatus wordt berekend..."

  subsidiestatusWordtBerekend = true;



  var request = createREQ();



  var rand1 = parseInt(Math.random()*9);

  var rand2 = parseInt(Math.random()*999999);

  var url = "berekenSubsidieStatus_ajax.php?code=" + code

                    + "&minimumStatus=" + minimumStatus

                    + "&vorigeStatus=" + subsidieStatus

                    + "&code=" + code

                    + "&tabel=" + tabel

                    + "&kolom=" + kolom

                    + "&waarde=" + waarde

                    + "&rand" + rand1 + "=" + rand2;



  request.onreadystatechange = function() {

    if (request.readyState == 4) {

      var ok = request.responseText.indexOf("OK");

      if (ok>=0) {

        var statusNu = request.responseText.substring(ok+2);

        toonSubsidiestatus(id, code, statusNu);

      }

      else {

        document.getElementById(id).innerHTML = "Shit: een fout! <br/>" + request.responseText;

      }

    }

  }

  // en nu nog de request uitsturen

  request.open("GET", url);

  request.send(null);

}



/*

************* DEZE FUNCTIE MAG WEG **********

function aanpassenSubsidiestatus(id, code, statusNu) {

  alert("Numerieke status: " + statusNu + "\nOude status: " + subsidieStatus);

  // vereist subsidieStatus én minimumStatus

  if ((statusNu%180==0) && (subsidieStatus == "ok")) {

      subsidiestatusWordtBerekend = false;

      toonSubsidiestatus(id, code, "ok");

  }

  else if ((statusNu%180==0)) {

    // het was nog niet ok, maar het wordt nu ok

    saveSubsidiestatus(id, code, "ok");

  }

  else if (statusNu%30==0) {  // nu verdedigbaar

    if (subsidieStatus == "ok") {

      // het is ooit ok geweest, dus we stellen sowieso verdedigbaar én verdedigd

      saveSubsidiestatus(id, code, "verdedigd");

    }

    else if (subsidieStatus == "niet-verdedigbaar") {

      // betere status

      saveSubsidiestatus(id, code, "verdedigbaar");

    }

    else {

      toonSubsidiestatus(id, code, subsidieStatus);

    }

  }

  else if (minimumStatus%30 > 0) {

    // nooit verdedigbaar geweest, en dit overleg is ook niet-verdedigbaar,

    // dus is het totaal niet-verdedigbaar

    saveSubsidiestatus(id, code, "niet-verdedigbaar");

  }

  else {

    toonSubsidiestatus(id, code, subsidieStatus);

  }

}



*/





function controleerMinimaleSubsidiestatus(code, overlegID) {
  return;

  // vereist minimumStatus

  if (minimumStatus%180==0) return;



  var request = createREQ();



  var rand1 = parseInt(Math.random()*9);

  var rand2 = parseInt(Math.random()*999999);

  var url = "berekenSubsidieStatus_ajax.php?code=" + code

                    + "&minimumStatus=" + minimumStatus

                    + "&tabel=afgeronde"

                    + "&kolom=overleg_id"

                    + "&waarde=" + overlegID

                    + "&alleengetal=1"

                    + "&rand" + rand1 + "=" + rand2;



  request.onreadystatechange = function() {

    if (request.readyState == 4) {

      var ok = request.responseText.indexOf("OK");

      if (ok>=0) {

        var statusNu = parseInt(request.responseText.substring(ok+2));

        saveMinimumSubsidiestatus(code, statusNu);

      }

      else {

        alert("Shit: een foute response <br/>" + request.responseText);

      }

    }

  }

  // en nu nog de request uitsturen

  request.open("GET", url);

  request.send(null);

}



function saveMinimumSubsidiestatus(code, status) {
  return;

  //alert("ik bewaar nu de minimumstatus " + status);

  minimumStatus = status;



  var request = createREQ();



  var rand1 = parseInt(Math.random()*9);

  var rand2 = parseInt(Math.random()*999999);

  var url = "subsidieStatusMinimum_ajax.php?code=" + code + "&status=" + status + "&rand" + rand1 + "=" + rand2;



  request.onreadystatechange = function() {

    if (request.readyState == 4) {

      if (request.responseText.indexOf("OK")==-1)

        alert("Shit: een fout in saveMinimum! <br/>" + request.responseText);

    }

  }

  // en nu nog de request uitsturen

  request.open("GET", url);

  request.send(null);

}



function toon(id, e) {

  var item = document.getElementById(id);
  var posx, posy;
  if (e.pageX || e.pageY) { // voor Firefox
       posx = e.pageX + 230 - window.innerWidth/2;
       posy = e.pageY-125;
  }
  else if (e.clientX || e.clientY) {  // voor IE
             posx = e.clientX - 390;// + document.body.scrollLeft;
             posy = e.clientY - 120;
  }
  if (isNaN(posx)) {
    posx = 0;
  }


  item.style.display = 'block';
  item.style.left = posx +"px";
  item.style.top = posy+"px";
}

function zetAf(id) {
   document.getElementById(id).style.display='none';
}

  function vertoon(id) {

     var ding = document.getElementById(id);

     if (ding.style.display == "none") {
       ding.style.display = "block";
     }
     else {
       ding.style.display = "none";
     }
  }


function veranderRechtenHuidig(code, soort, id) {
  //patient, genre, persoonID, rechten
  if (rechten['huidig_'+soort+id]<0) return;
  document.getElementById(soort + "huidig_Rechten"+ id).src = "../images/oog_half.jpg";

  if (rechten['huidig_'+soort+id]==1) nieuweRechten = 0;
  else nieuweRechten = 1;
  
  rechten['huidig_'+soort+id]=-10+rechten['huidig_'+soort+id];

  var request = createREQ();

  var rand1 = parseInt(Math.random()*9);
  var rand2 = parseInt(Math.random()*999999);
  var url = "rechten_veranderen.php?patient=" + code + "&genre=" + soort + "&persoonID=" + id + "&rechten=" + nieuweRechten + "&rand" + rand1 + "=" + rand2;

  request.onreadystatechange = function() {
    if (request.readyState < 4) {
      // feedback zit al in image oog_half
    }
    else {
      if (request.responseText.indexOf("OK")>=0) {
         if (rechten['huidig_'+soort+id]==-10) {
           rechten['huidig_'+soort+id]=1;
           document.getElementById(soort + "huidig_Rechten"+ id).src = "../images/oog_open.jpg";
           document.getElementById(soort + "huidig_Rechten"+ id).alt = "heeft leesrechten";
           document.getElementById(soort + "huidig_Rechten"+ id).title = "klik om rechten af te nemen";
         }
         else {
           rechten['huidig_'+soort+id]=0;
           document.getElementById(soort + "huidig_Rechten"+ id).src = "../images/oog_dicht.jpg";
           document.getElementById(soort + "huidig_Rechten"+ id).alt = "heeft geen rechten";
           document.getElementById(soort + "huidig_Rechten"+ id).title = "klik om rechten toe te kennen";
         }
      }
      else {
        alert("Shit: een fout! <br/>" + request.responseText);
      }
    }
  }

  // en nu nog de request uitsturen
  request.open("GET", url);
  request.send(null);
}

function veranderRechtenAfgerond(overleg, soort, id) {
  // afgerond overleg: overlegID, genre, persoonID, rechten
  if (rechten['afgerond_'+overleg+soort+id]<0) return;
  document.getElementById(soort + "afgerond_" + overleg + "Rechten"+ id).src = "../images/oog_half.jpg";

  if (rechten['afgerond_'+overleg+soort+id]==1) nieuweRechten = 0;
  else nieuweRechten = 1;

  rechten['afgerond_'+overleg+soort+id]=-10+rechten['afgerond_'+overleg+soort+id];

  var request = createREQ();

  var rand1 = parseInt(Math.random()*9);
  var rand2 = parseInt(Math.random()*999999);
  var url = "rechten_veranderen.php?overlegID=" + overleg + "&genre=" + soort + "&persoonID=" + id + "&rechten=" + nieuweRechten + "&rand" + rand1 + "=" + rand2;
  request.onreadystatechange = function() {
    if (request.readyState < 4) {
      // feedback zit al in image oog_half
    }
    else {
      if (request.responseText.indexOf("OK")>=0) {
         if (rechten['afgerond_'+overleg+soort+id]==-10) {
           rechten['afgerond_'+overleg+soort+id]=1;
           document.getElementById(soort + "afgerond_" + overleg + "Rechten"+ id).src = "../images/oog_open.jpg";
           document.getElementById(soort + "afgerond_" + overleg + "Rechten"+ id).alt = "heeft leesrechten";
           document.getElementById(soort + "afgerond_" + overleg + "Rechten"+ id).title = "klik om rechten af te nemen";
         }
         else {
           rechten['afgerond_'+overleg+soort+id]=0;
           document.getElementById(soort + "afgerond_" + overleg + "Rechten"+ id).src = "../images/oog_dicht.jpg";
           document.getElementById(soort + "afgerond_" + overleg + "Rechten"+ id).alt = "heeft geen rechten";
           document.getElementById(soort + "afgerond_" + overleg + "Rechten"+ id).title = "klik om rechten toe te kennen";
         }
      }
      else {
        alert("Shit: een fout! <br/>" + request.responseText);
      }
    }
  }

  // en nu nog de request uitsturen
  request.open("GET", url);
  request.send(null);
}

function veranderRechtenExtras(index, kolom, waarde, soort, id) {
  // afgerond overleg: overlegID, genre, persoonID, rechten
  if (rechten[index]<0) return;
  document.getElementById(index).src = "../images/oog_half.jpg";

  if (rechten[index]==1) nieuweRechten = 0;
  else nieuweRechten = 1;

  rechten[index]=-10+rechten[index];

  var request = createREQ();

  var rand1 = parseInt(Math.random()*9);
  var rand2 = parseInt(Math.random()*999999);
  var url = "rechten_veranderen.php?" + kolom + "=" + waarde + "&genre=" + soort + "&persoonID=" + id + "&rechten=" + nieuweRechten + "&rand" + rand1 + "=" + rand2;
  request.onreadystatechange = function() {
    if (request.readyState < 4) {
      // feedback zit al in image oog_half
    }
    else {
      if (request.responseText.indexOf("OK")>=0) {
         if (rechten[index]==-10) {
           rechten[index]=1;
           document.getElementById(index).src = "../images/oog_open.jpg";
           document.getElementById(index).alt = "heeft leesrechten";
           document.getElementById(index).title = "klik om rechten af te nemen";
         }
         else {
           rechten[index]=0;
           document.getElementById(index).src = "../images/oog_dicht.jpg";
           document.getElementById(index).alt = "heeft geen rechten";
           document.getElementById(index).title = "klik om rechten toe te kennen";
         }
      }
      else {
        alert("Shit: een fout! <br/>" + request.responseText);
      }
    }
  }

  // en nu nog de request uitsturen
  request.open("GET", url);
  request.send(null);
}

function testTijdigOverleg(deadline) {
  var form = document.forms['doeoverlegform'];
  var datum = form.overleg_jj.value + "" + form.overleg_mm.value + "" + form.overleg_dd.value;
  if (datum.length < 8) alert("Je hebt geen datum ingevuld.");
  if (datum > deadline) {
    document.getElementById('laatBlok').style.display="block";
    if (document.getElementById('laat').value.replace(/^\s*/, "").replace(/\s*$/, "") == "") {
      alert("Omdat het overleg niet binnen de 30 dagen georganiseerd kan worden, moet je een reden invullen.");
      return false;
    }
    else {
      return true;
    }
  }
  else {
    document.getElementById('laatBlok').style.display="none";
  }
  return true;
}

function valideerZorgtraject() {
  if ($('diabetes').checked || $('nieren').checked) {
    $('geen_zorgtraject').checked = false;
  }
  else {
    $('geen_zorgtraject').checked = true;
  }
}
function geenZorgtraject() {
  $('diabetes').checked = false;
  $('nieren').checked = false;
}

function leeftijd(rijksregister) {
  var jaar = parseInt(rijksregister.substr(0,2));
  var maand = parseInt(rijksregister.substr(2,2));
  var dag = parseInt(rijksregister.substr(4,2));

  var vandaag = new Date();

  var ouderdom;
  if (maand < 1+vandaag.getMonth()) {
     ouderdom = vandaag.getFullYear() - 1900 - jaar;
  }
  else if (maand > 1+vandaag.getMonth()) {
     ouderdom = vandaag.getFullYear() - 1900 - jaar -1;
  }
  else {
    if (dag <= vandaag.getDate()) {
      ouderdom = vandaag.getFullYear() - 1900 - jaar;
    }
    else {
      ouderdom = vandaag.getFullYear() - 1900 - jaar -1;
    }
  }

  if (ouderdom > 100) ouderdom = ouderdom - 100;
  if (ouderdom < 0) ouderdom = ouderdom + 100;
  return ouderdom;
}

// alleen geldig op forms/patient_gegevens en _aanpassen
function kiesCircuit(isPsy) {
  var rr = $F('rijksregister');
  var ouderdom = leeftijd(rr);
  if (ouderdom < 16) {
    $('pat_type_check').value = 0;
    $('pat_type_hidden').value = 16;
    $('pat_type_lang').style.display = "inline";
    $('pat_type_lang').innerHTML = "Psychiatrisch circuit jongeren";
    $('pat_type_req').style.display = "none";
    $('pat_type_keuze').style.display = "none";
    typePatientGeselecteerd=isPsy;
  }
  else if (ouderdom > 18) {
    $('pat_type_check').value = 0;
    $('pat_type_hidden').value = 18;
    $('pat_type_lang').style.display = "inline";
    $('pat_type_lang').innerHTML = "Psychiatrisch circuit volwassenen";
    $('pat_type_req').style.display = "none";
    $('pat_type_keuze').style.display = "none";
    typePatientGeselecteerd=isPsy;
  }
  else {
    $('pat_type_check').value = 1;
    $('pat_type_lang').style.display = "none";
    $('pat_type_keuze').style.display = "inline";
    $('pat_type_req').style.display = "inline";
  }

}

function aantalContactZiekenhuis() {
   var aantal = 0;
   if ($('ziekenhuis') && $('ziekenhuis').checked) aantal++;
   if ($('outreach') && $('outreach').checked) aantal++;
   if ($('art107') && $('art107').checked) aantal++;
   if ($('ziekenhuis_ander') && $('ziekenhuis_ander').checked) aantal++;
   if ($('cgg') && $('cgg').checked) aantal++;
   if ($('politie') && $('politie').checked) aantal++;

   return aantal;
}

function aantalPsyDomeinen() {
   var aantal = 0;
   if ($('basis') && $('basis').checked) aantal++;
   if ($('gemeenschap') && $('gemeenschap').checked) aantal++;
   if ($('taal') && $('taal').checked) aantal++;
   if ($('gezin') && $('gezin').checked) aantal++;
   if ($('sociaal') && $('sociaal').checked) aantal++;
   if ($('school') && $('school').checked) aantal++;
   if ($('motoriek') && $('motoriek').checked) aantal++;
   if ($('persoonlijk') && $('persoonlijk').checked) aantal++;

   if ($('woon') && $('woon').checked) aantal++;
   if ($('maatschappij') && $('maatschappij').checked) aantal++;
   if ($('werk') && $('werk').checked) aantal++;

   return aantal;
}

function voldoetPatientPsy(type) {
   if ($('tp_nummer') && $('tp_nummer').value > 0) return true;
   
   var fouten = "";
   if ($('hoofddiagnose').selectedIndex == -1) {
     fouten += "  - er is geen hoofddiagnose aangeduid\n";
   }
   if ($('comorbiditeit').selectedIndex == -1) {
     fouten += "  - er is geen comorbiditeit aangeduid\n";
   }
   if (!$('nood_begeleidingsplan').checked)  {
     fouten += "  - er is geen nood aan een begeleidingsplan\n";
   }
   if (!$('toename_symptonen').checked)  {
     fouten += "  - er is geen toename van de symptonen\n";
   }
   if (aantalContactZiekenhuis() < 1) {
     fouten += "  - er is geen voorafgaand contact met de geestelijke gezondheidszorg geweest\n";
   }
   if (aantalPsyDomeinen() < 3) {
     fouten += "  - de patient heeft in minder dan 3 domeinen een verlies van vaardigheden\n";
   }
   
   if (fouten == "") {
     return true;
   }
   else {
     alert("Deze patient kan  niet geincludeerd worden want\n\n" + fouten);
     return false;
   }
   
}

function $$$(id) {
  return document.getElementById(id);
}
var gesavedeStatus="?";

function toonStukjePlan(id) {
  if ($$$(id+"Plan") && $$$(id)) {
    if ($$$(id).checked) $$$(id+"Plan").style.display="block";
    else $$$(id+"Plan").style.display="none";
  }
}

function savePsyDomeinen(code,datum,eersteOverleg) {
   var params = "datum=" + datum + "&";
   var aantal = 0;
   if ($$$('basis') && $$$ ('basis').checked) {params += "basis=1&";aantal++;} else params += "basis=0&";
   toonStukjePlan('basis');
   if ($$$('gemeenschap') && $$$('gemeenschap').checked) {params += "gemeenschap=1&";aantal++;} else params += "gemeenschap=0&";
   toonStukjePlan('gemeenschap');
   if ($$$('taal') && $$$('taal').checked) {params += "taal=1&";aantal++;} else params += "taal=0&";
   toonStukjePlan('taal');
   if ($$$('gezin') && $$$('gezin').checked) {params += "gezin=1&";aantal++;} else params += "gezin=0&";
   toonStukjePlan('gezin');
   if ($$$('sociaal') && $$$('sociaal').checked) {params += "sociaal=1&";aantal++;} else params += "sociaal=0&";
   toonStukjePlan('sociaal');
   if ($$$('school') && $$$('school').checked) {params += "school=1&";aantal++;} else params += "school=0&";
   toonStukjePlan('school');
   if ($$$('motoriek') && $$$('motoriek').checked) {params += "motoriek=1&";aantal++;} else params += "motoriek=0&";
   toonStukjePlan('motoriek');
   if ($$$('persoonlijk') && $$$('persoonlijk').checked) {params += "persoonlijk=1&";aantal++;} else params += "persoonlijk=0&";
   toonStukjePlan('persoonlijk');

   if ($$$('woon') && $$$('woon').checked) {params += "woon=1&";aantal++;} else params += "woon=0&";
   toonStukjePlan('woon');
   if ($$$('maatschappij') && $$$('maatschappij').checked) {params += "maatschappij=1&";aantal++;} else params += "maatschappij=0&";
   toonStukjePlan('maatschappij');
   if ($$$('werk') && $$$('werk').checked) {params += "werk=1&";aantal++;} else params += "werk=0&";
   toonStukjePlan('werk');

   if (eersteOverleg) {
     if (aantal < 3) {
       alert("Pas op. Er zijn minder dan 3 domeinen met verminderde vaardigheden. Daarom is deze patient niet includeerbaar!!");
       gesavedeStatus = $$$('status').innerHTML;
       updateStatus("KO;Er zijn minder dan 3 domeinen met verminderde vaardigheden. Daarom is deze patient niet includeerbaar!!");
     }
     else if (gesavedeStatus!="?") {
       if (gesavedeStatus.indexOf("vergoedbaar")>=0) {
          updateStatus("OK;" + gesavedeStatus);
       }
       else {
          updateStatus("KO;" + gesavedeStatus);
       }
       gesavedeStatus="?";
     }
   }
  var request = createREQ();

  var url = "psy_saveDomeinen_ajax.php";

  request.onreadystatechange = function() {
    if (request.readyState < 4) {
       document.getElementById("knopPsyDomeinen").value = "wachten tijdens het opslaan...";
    }
    else {
      if (request.responseText.indexOf("OK")>=0) {
        datum = datum + "";
        var jaar = datum.substr(0,4);
        var maand = datum.substr(4,2);
        var dag = datum.substr(6,2);
        document.getElementById("domeinenInfo").innerHTML = "De (aangepaste) toestand op " + dag + "/" + maand + "/" + jaar;
        document.getElementById("knopPsyDomeinen").value = "zien dat het bewaard is.";
      }
      else {
        document.getElementById("domeinenInfo").innerHTML = "Shit: een fout! <br/>" + request.responseText;
      }
    }
  }

  if (params == "") return;
  else params = params + "patient=" + code;

  // en nu nog de request uitsturen
  request.open("POST", url, true);
  request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  request.setRequestHeader("Content-length", params.length);
  request.setRequestHeader("Connection", "close");

  request.send(params);

}

function BoxedInteger(n) {
  this.value = n;
}
BoxedInteger.prototype.add = function() {
  this.value++;
}

BoxedInteger.prototype.plus = function(n) {
  this.value = this.value + n;
}

function begeleidingsplanOpslaan(code, overlegID) {
  var formTekst =  $("#BegeleidingsplanForm").serialize();
  params = decodeURIComponent(formTekst);
  var request = createREQ();

  var url = "psy_saveBegeleidingsplan_ajax.php";

  request.onreadystatechange = function() {
    if (request.readyState < 4) {
       document.getElementById("planOpslaan").value = "wachten tijdens het opslaan...";
    }
    else {
      if (request.responseText.indexOf("OK")>=0) {
        //document.getElementById("planOpslaan").innerHTML = "De (aangepaste) toestand op " + dag + "/" + maand + "/" + jaar;
        document.getElementById("planOpslaan").value = "is opgeslagen.";
        if (request.responseText.indexOf("----")>=0) {
           ggzHeeftTaak = false;
           genoegDomeinen = false;
           alert("Pas op! Bij minstens 3 domeinen moeten ZVL/HVL betrokken zijn. \nBovendien heeft geen enkele GGZ-medewerker een taak.");
        }
        else if (request.responseText.indexOf("---")>=0) {
           ggzHeeftTaak = false;
           genoegDomeinen = false;
           alert("Pas op! Bij minstens 3 domeinen moeten ZVL/HVL betrokken zijn.");
        }
        else if (request.responseText.indexOf("--")>=0) {
           ggzHeeftTaak = false;
           genoegDomeinen = true;
           alert("Pas op! Geen enkele GGZ-medewerker heeft een taak.");
        }
        else {
           ggzHeeftTaak = true;
           genoegDomeinen = true;
        }
        if ($$$('psy_algemeen').value == "" || $$$('psy_doelstellingen').value == "") {
          tekstvakkenBegeleidingsplan = false;
        }
        else {
          tekstvakkenBegeleidingsplan = true;
        }
        if (request.responseText.indexOf("NIETALLESINGEVULD")>=0) {
           alert("Pas op! Niet alle afspraken of einddata zijn ingevuld.");
           nietAllesIngevuldOpBegeleidingsplan = true;
        }
        else if (request.responseText.indexOf("_")>=0) {
           alert("Pas op! Er zijn afspraken zonder actienemer(s).");
           nietAllesIngevuldOpBegeleidingsplan = true;
        }
        else {
           nietAllesIngevuldOpBegeleidingsplan = false;
        }
        setTimeout("document.getElementById('planOpslaan').value = 'opslaan.';",10000);
      }
      else {
        document.getElementById("planOpslaan").innerHTML = "Shit: een fout! <br/>" + request.responseText;
      }
    }
  }
  if (document.getElementById('volgend_overleg_jj')) {
    var volgendeDatum = $$$('volgend_overleg_jj').value + $$$('volgend_overleg_mm').value + $$$('volgend_overleg_dd').value;
    if (volgendeDatum != "") {
      volgendeDatum = "&volgendeDatum=" + volgendeDatum;
    }
  }
  else {
    volgendeDatum = "";
  }

  if (params == "") return;
  else params = params + "&patient=" + code + "&overlegID=" + overlegID + volgendeDatum;

  // en nu nog de request uitsturen
  request.open("POST", url, true);
  request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  request.setRequestHeader("Content-length", params.length);
  request.setRequestHeader("Connection", "close");

  request.send(params);
}

function crisisplanOpslaan(overleg,afgerond) {
  var formTekst =  $("#formCrisisPlan").serialize();
  params = decodeURIComponent(formTekst);
  var request = createREQ();

  var url = "psy_saveCrisisplan_ajax.php";

  request.onreadystatechange = function() {
    if (request.readyState < 4) {
       document.getElementById("crisisOpslaan").value = "wacht tijdens het opslaan...";
    }
    else {
      if (request.responseText.indexOf("OK")>=0) {
        //document.getElementById("planOpslaan").innerHTML = "De (aangepaste) toestand op " + dag + "/" + maand + "/" + jaar;
        document.getElementById("crisisOpslaan").value = "is opgeslagen.";
        if ($$$('crisissituatie').value == "") {
          crisisSituatieIngevuld = false;
        }
        else {
          crisisSituatieIngevuld = true;
        }
        if (request.responseText.indexOf("--")>=0) {
          $$$('ontbrekendeBereikbaarheden').style.display="block";
          alleBereikbaarheden = false;
        }
        else {
          $$$('ontbrekendeBereikbaarheden').style.display="none";
          alleBereikbaarheden = true;
        }
        setTimeout("document.getElementById('crisisOpslaan').value = 'opslaan.';",10000);
      }
      else {
        document.getElementById("crisisOpslaan").innerHTML = "Shit: een fout! <br/>" + request.responseText;
      }
    }
  }

  if (params == "") return;
  else params = params + "&overleg=" + overleg + "&afgerond=" + afgerond;
  // en nu nog de request uitsturen
  request.open("POST", url, true);
  request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  request.setRequestHeader("Content-length", params.length);
  request.setRequestHeader("Connection", "close");

  request.send(params);
}

function verwijderRij(tabel, element, object) {
  var n=$$$(element).parentNode.parentNode.rowIndex;
  document.getElementById(tabel).deleteRow(n);
  object.plus(-1);
}

function checkJaarGeleden() {
  var jaar1 = parseFloat($$$('overleg_jj').value);
  var maand1 = parseFloat($$$('overleg_mm').value);
  var dag1 = parseFloat($$$('overleg_dd').value);
  var jaar2 = parseFloat($$$('volgend_overleg_jj').value);
  var maand2 = parseFloat($$$('volgend_overleg_mm').value);
  var dag2 = parseFloat($$$('volgend_overleg_dd').value);
  if (jaar2 < jaar1) {
    alert("Het volgende overleg moet natuurlijk wel na het huidige gepland worden.");
    return false;
  }
  if (jaar1 < jaar2) {
    if (maand2 < maand1) return true;
    if (maand1 == maand2 && dag1 >= dag2) return true;
  }
  else if (jaar1 == jaar2) {
    if ((maand2 < maand1) || (maand1 == maand2 && dag2 <= dag1 ))  {
      alert("Het volgende overleg moet natuurlijk wel na het huidige gepland worden.");
      return false;
    }
    if (maand1 < maand2) return true;
    if (dag1 < dag2) return true;
  }
  alert("Het volgende overleg moet binnen het jaar georganiseerd worden!");
  return false;
}

/*
   kopieer dag, maand, jaar van het formulier op het tabblad begeleidingsplan naar het formulier afronden
*/
function kopieer(wat) {
   var bron = 'volgend_overleg_' + wat;
   var doel = 'volgend_' + wat;
   if ($$$(doel)) {
      $$$(doel).value = $$$(bron).value;
   }
}