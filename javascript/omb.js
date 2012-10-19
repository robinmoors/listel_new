// vereist prototype ingeladen!



function toonHVL() {

  zichtbaar('hvl',1,'block');

}

function verbergHVL() {

  zichtbaar('hvl',1,'none');

}

function toonAnder() {

  zichtbaar('ander',1,'block');

}

function verbergAnder() {

  zichtbaar('ander',1,'none');

}

function toonJustitie() {

  zichtbaar2('justitie',2,'visible');

}

function verbergJustitie() {

  zichtbaar2('justitie',2,'hidden');

}



function zichtbaar(div, aantal, stijl) {

  for (i=1; i<= aantal; i++) {

     $(div + "deel" + i).style.display = stijl;

  }

}

function zichtbaar2(div, aantal, stijl) {

  for (i=1; i<= aantal; i++) {

     $(div + "deel" + i).style.visibility = stijl;

  }

}



var probleemfactorteller = new Array();

probleemfactorteller['slachtoffer'] = 0;

probleemfactorteller['pleger'] = 0;



function extraProbleemfactor(soort, volgnummer) {
   if (volgnummer == probleemfactorteller[soort]) {

     probleemfactorteller[soort]++;

     var nr = probleemfactorteller[soort];

     var naam = "probleemfactor[" + soort + "][" + nr + "]";

     var naam2 = "probleemdetail[" + soort + "][" + nr + "]";

     var tabel = $("tabel"+soort);

     var basisrijnr;

     if (soort == "pleger") basisrijnr = 5;

     else basisrijnr = 6;

     var rij = tabel.insertRow(basisrijnr+nr);



     var td = rij.insertCell(0);

     td.innerHTML = "<select name=\"" + naam + "\" id=\"" + naam + "\" onchange=\"extraProbleemfactor('" + soort + "'," + nr + ");\">" + $("probleemfactor[slachtoffer][0]").innerHTML + "</select><label for=\"" + naam2 + "\"> Detail : </label> <input type=\"text\" style=\"width:125px;\" name=\"" + naam2 + "\" id=\"" + naam2 + "\" />";


     $("probleemfactor["+soort+"]["+(volgnummer+1)+"]").selectedIndex = 0;
     td = rij.insertCell(0);

     td.innerHTML = "<label for=\"" + naam + "\">Probleemfactor " + (nr+1) + "</label>";

     /*

     rij = tabel.insertRow(basisrijnr+1+nr*2);

     td = rij.insertCell(0);

     td.innerHTML = "<input type=\"text\" name=\"" + naam + "\" id=\"" + naam + "\" />";

     

     td = rij.insertCell(0);

     td.innerHTML = "<label for=\"" + naam + "\">Detail : " + (nr+1) + "</label>";

     */

   }

}



function selecteerProbleemfactor(soort, nr, waarde, detail) {

     var naam = "probleemfactor[" + soort + "][" + nr + "]";

     var naam2 = "probleemdetail[" + soort + "][" + nr + "]";

     selectSetWaarde(naam, waarde);

     $(naam2).value = detail;

}



function selectSetWaarde(id, waarde) {

  var selectObject = $(id);

  for(i = 0; i < selectObject.length; i++) {

   if(selectObject[i].value == waarde)

     selectObject.selectedIndex = i;

   }

}



var mishandelvormteller = new Array();

mishandelvormteller['aanmelding'] = 0;

mishandelvormteller['opvolging'] = 0;



function extraVorm(soort, volgnummer) {

   if (volgnummer == mishandelvormteller[soort]) {

     mishandelvormteller[soort]++;

     var nr = mishandelvormteller[soort];

     var naam = "mishandelvorm[" + soort + "][" + nr + "]";

     var tabel = $("tabel"+soort);

     var rijnr;

     if (soort == 'aanmelding') rijnr = nr+2;

     else rijnr = nr+6;

     

     var rij = tabel.insertRow(rijnr);



     var td = rij.insertCell(0);

     td.innerHTML = "<select name=\"" + naam + "\" id=\"" + naam + "\" onchange=\"extraVorm('" + soort + "'," + nr + ");\">" + $("mishandelvorm[aanmelding][0]").innerHTML + "</select>";

     $("mishandelvorm["+soort+"]["+(volgnummer+1)+"]").selectedIndex = 0;

     td = rij.insertCell(0);

     td.innerHTML = "<label for=\"" + naam + "\">Vorm " + (nr+1) + "</label>";



   }

}

function selecteerVorm(soort, nr, waarde) {

     var naam = "mishandelvorm[" + soort + "][" + nr + "]";

     selectSetWaarde(naam, waarde);

}



function toonDoorverwijzing() {

  var stand = $F('bekendheid');

  if (stand == 1) {

    $('doorverwijzingrij').style.visibility="visible";

  }

  else if (stand == 2) {

    $('doorverwijzingrij').style.visibility="visible";

  }

  else {

    $('doorverwijzingrij').style.visibility="hidden";

  }

}



function zoekPersoon(tabel, id) {

  if (tabel == null) return;

  toonPersonen = function(request) {

    if (request.responseText.substring(0,5) == "-----")

      selecteerPersoon(tabel, id, request.responseText.substring(5));

    else {

      $(id + 'info').innerHTML = request.responseText;

      $(id + "id").value = "";

    }

  }

  var zoeknaam = $F(id + 'naam');

  var zoekvoornaam = $F(id + 'voornaam');

  

  new Ajax.Request( "../php/omb_zoekpersonen_ajax.php", {

     method: 'get',

     parameters: "id=" + id + "&tabel=" + tabel + "&naam=" + zoeknaam + "&voornaam=" + zoekvoornaam,

     onComplete: toonPersonen

  });

}





function selecteerPersoon(tabel, htmlid, persoonid) {

   $(htmlid + "opties").innerHTML = "";

   new Ajax.Updater(

      htmlid + "info",

      "../php/omb_geefpersoon.php?id=" + persoonid + "&tabel=" + tabel

   );

   $(htmlid + "id").value = persoonid;

   

}





var hulpteller = 0;



function extraHulp(volgnummer) {

   if (volgnummer == hulpteller) {

     hulpteller++;

     var nr = hulpteller;

     var naam = "hulp[" + nr + "]";

     var naam2 = "hulpdetail[" + nr + "]";

     var tabel = $("tabelhulp");

     var rij = tabel.insertRow(0+nr*2);



     var td = rij.insertCell(0);

     td.innerHTML = "<select name=\"" + naam + "\" id=\"" + naam + "\" onchange=\"extraHulp(" + nr + ");\">" + $("hulp[0]").innerHTML + "</select>";

     $("hulp["+(volgnummer+1)+"]").selectedIndex = 0;


     td = rij.insertCell(0);

     td.innerHTML = "<label for=\"" + naam + "\">Hulpsoort " + (nr+1) + "</label>";



     rij = tabel.insertRow(1+nr*2);

     td = rij.insertCell(0);

     td.innerHTML = "<input type=\"text\" name=\"" + naam2 + "\" id=\"" + naam2 + "\" style=\"width:333px;\" />";



     td = rij.insertCell(0);

     td.innerHTML = "<label for=\"" + naam + "\">Hulp detail " + (nr+1) + "</label>";

   }

}

function selecteerHulp(nr, waarde, detail) {

     var naam = "hulp[" + nr + "]";

     var naam2 = "hulpdetail[" + nr + "]";

     selectSetWaarde(naam, waarde);

     $(naam2).value = detail;

}







function $RF(radioGroup, aantal) {

   var i=0;

   var notFound = true;

   while (i < aantal && notFound) {

      var name = radioGroup + i;

      if ($(name).checked)

        return $(radioGroup + i).value;

      i++;

   }

   return null;

}



function testAlles() {

  var fouten = "";

  if ($F('genre')==-1) fouten += "  - geen soort melding aangeduid\n";

  if ($RF('meldersoort',3)==null) fouten += "  - niet aangeduid welk soort persoon de melding gedaan heeft\n";

  if ($RF('meldersoort',3)=="ander") {

    if ($F('melder_relatie')==-1) fouten += "  - geen relatie tussen melder en slachtoffer geselecteerd\n";

  }



  if ($RF('slachtoffergeslacht',3)==null) fouten += "  - het geslacht van het slachtoffer niet aangeduid\n";

  if ($F('slachtofferleeftijd')=="") fouten += "  - geen leeftijd van het slachtoffer ingevuld\n";

  if (parseInt($F('slachtofferleeftijd'))<55) fouten += "  - het slachtoffer is jonger dan 55. Dat is te jong voor een registratie\n";

  if ($F('slachtoffergemeenteID')=="" || $F('slachtoffergemeenteID')==null) fouten += "  - geen postcode van het slachtoffer ingevuld\n";

  if (probleemfactorteller['slachtoffer'] == 0) fouten += "  - geen probleemfactor(en) voor het slachtoffer geselecteerd\n";

  if ($RF('slachtoffer_meer',3)==null) fouten += "  - niet aangeduid hoeveel slachtoffers er zijn\n";



  if ($RF('plegergeslacht',3)==null) fouten += "  - het geslacht van de pleger niet aangeduid\n";

  if ($F('plegerleeftijd')=="") fouten += "  - geen leeftijd van de pleger ingevuld\n";

  if (probleemfactorteller['pleger'] == 0) fouten += "  - geen probleemfactor(en) voor de pleger geselecteerd\n";

  if (mishandelvormteller['aanmelding'] == 0) fouten += "  - geen mishandelvorm(en) geselecteerd\n";

  if ($F('situatieschets')=="") fouten += "  - geen situatieschets ingevuld\n";



  if ($RF('justitie_weetmelding')==1) {

    if ($F('justitie_soort') == -1) fouten += "  - niet aangeduid welke justitie op de hoogte is\n";

  }

  



  if (fouten != "") {

     alert("Opgelet. Deze registratie is nog niet volledig!\nWe slaan deze gegevens op, maar vergeet niet volgende problemen op te lossen\nvooraleer af te sluiten!\n\n"+fouten);

     return false;

  }

  return true;

}

function saveAlles(afgerond) {

   var leeftijd=parseInt($F('slachtofferleeftijd'));

   if (isNaN(leeftijd) || leeftijd<55) {

       alert('Het slachtoffer moet minstens 55 zijn voor een registratie van ouderenmis(be)handeling.\nDaarom kunnen we niet opslaan!');

       return;

   }



   //var params = $('hoofdformulier').serialize();

   //alert(params);

   // datum is echt keihard verplicht

   if ($F('dd').length != 2 || $F('mm').length != 2 || $F('jjjj').length != 4) {

      alert("De datum van de melding is niet correct ingevuld.\nBijgevolg kunnen we niet opslaan!");

      return;

   }



   var ok = testAlles();

   if (!ok) afgerond = 0;

   

   new Ajax.Request(

      "../php/omb_registratie_opslaan_ajax.php?ok=" + ok + "&afgerond=" + afgerond,

      {

        parameters : $('hoofdformulier').serialize(true),

        onComplete : saveGedaan

      }

   );

   

   return ok;

}



function saveGedaan(request) {

  var nu = new Date();

  var nuTekst = nu.getHours() + ":" + nu.getMinutes() + "." + nu.getSeconds();
  var response = request.responseText.replace(/^\s+|\s+$/g,"");
  var antwoord = response.substring(0,2);

  if (antwoord == "KO") {
     alert("Probleem : " +request.responseText);
  }
  else if (antwoord == "OK") {
    code = response.substring(2,19);
    $('volgnummer').innerHTML = code;

    if ($('omb_bron').value == "") $('omb_bron').value = code;

    $('id').value = response.substring(19,100);

    $('bewaarstatus').innerHTML = "(bewaard om " + nuTekst + ")(nieuw)";

    $('dd').disable();
    $('mm').disable();
    $('jjjj').disable();
  }
  else if (antwoord == "++") {
    $('id').value = response.substring(2,100);
    $('bewaarstatus').innerHTML = "(bewaard om " + nuTekst + ")(update)";
    $('dd').disable();
    $('mm').disable();
    $('jjjj').disable();
  }
  else {
    errorcode = parseInt(request.responseText.substring(0,1));
    switch (errorcode) {
       case 1:
          alert("Initialisatieprobleem OMB. Contacteer de ontwikkelaar via LISTEL");
          break;
       case 2:
          alert("Datum is niet correct ingevuld bij OMB.");
          break;
       case 3:
          alert("Kan geen registratie OMB aanmaken. Contacteer de ontwikkelaar via LISTEL");
          break;
       case 4:
       case 6:
       case 8:
          alert("Dit mag niet. OMBCode " + errorcode + " Contacteer de ontwikkelaar via LISTEL");
          break;
       case 5:
          alert("Sommige probleemfactoren (bij slachtoffer en/of pleger) zijn dubbel geselecteerd. \nVerwijder de dubbels en probeer opnieuw!");
          break;
       case 7:
          alert("Kan geen hulpverleners OMB aanmaken. Contacteer de ontwikkelaar via LISTEL");
          break;
       case 9:
          alert("Sommige mishandelvormen (bij mis(be)handeling of opvolging) zijn dubbel geselecteerd. \nVerwijder de dubbels en probeer opnieuw!");
          break;
       case 0:
          alert("Kan deze registratie niet koppelen aan het overleg. Contacteer de ontwikkelaar via LISTEL");
          break;
       default:
          //alert("Ander probleem: " + request.responseText);
    }
  }
}



function eindeOMB(test,afsluiten) {

    if (!test && afsluiten)

        alert("Deze registratie is nog niet voltooid. \nDaarom mag je nog niet afsluiten!");

    else {

      if (afsluiten) {

        alert("Dank u voor uw registratie. \nIndien u bijkomende informatie, advies of een interventie wenst in verband met deze melding, \nneem dan contact op met het Vlaams Meldpunt Ouderenmis(be)handeling \n078/15 15 70 of meldpuntomb@skynet.be");

      }

    

      if (terugNaarOverleg)

        setTimeout('window.location = "overleg_alles.php?tab=Attesten";', 1000);

      else

        setTimeout('window.location = "index.php";', 1000);

    }

}







function printhref() {

  var url = window.location + " ";

  if (url.indexOf("?")==-1) {

    window.location=window.location+'?print=1&zoekid=' + $('id').value

  }

  else {

    window.location=window.location+'&print=1'

  }

}





function wisOMB(id) {

  if (!confirm("Ben je zeker dat je deze registratie wil wissen?")) return;



  toonWissing = function(request) {

    if (request.responseText.indexOf("OK") >= 0) {

      alert("Registratie gewist");

      $('rij' + id).style.display = "none";

    }

    else {

      alert("Probleem met wissen nl.\n" +request.responseText);

    }

  }



  new Ajax.Request( "../php/omb_wis.php", {

     method: 'get',

     parameters: "id=" + id,

     onComplete: toonWissing

  });

}



function voorCAW(id) {

  feedback = function(request) {

    if (request.responseText.indexOf("OK") >= 0)

      $("caw" + id).innerHTML = " ";

    else {

      alert("problemo \n" + request.responseText);

    }

  }



  new Ajax.Request( "../php/omb_voorCAW_ajax.php", {

     method: 'get',

     parameters: "id=" + id,

     onComplete: feedback

  });

}

