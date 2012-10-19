// vereist prototype ingeladen!
var startTeller = 100;
var teller = startTeller;
var afsluiten=0;

function tick() {
  teller--;
  //document.getElementById('teller').innerHTML = teller;
  if (teller == 0) {
    afsluiten = 1;
    eindTijd();
  }
}

function resetCountDown() {
  teller = startTeller;
}


var intervalID = setInterval("tick()",1000);

var tijdRecordID;

function startTijd() {
  new Ajax.Request( "../php/omb_tijd_opslaan_ajax.php", {
     method: 'get',
     parameters: "start=1",
     onComplete: bewaarRecordID
  });
}

function bewaarRecordID(request) {
  tijdRecordID = parseInt(request.responseText);
}

function eindTijd() {
  new Ajax.Request( "../php/omb_tijd_opslaan_ajax.php", {
     method: 'get',
     parameters: "stop=" + tijdRecordID,
     onComplete: eindePagina
  });
}

function eindePagina(request) {
  if (afsluiten==1) {
    alert("Uw tijd is verstreken. De registratie wordt automatisch afgesloten.\nZONDER te saven!");
    window.location= "index.php";
  }
}

startTijd();
