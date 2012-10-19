<div>

<?php

  if (!isset($readOnly)) {

?>

<script type="text/javascript">

function nl2nnl(text) {

  while (text.indexOf("\n")!= -1) {

    text = text.replace("\n", "\\n");

  }

  return text;

}



function planOpslaan() {

  document.getElementById("opslaanknop").style.display="none";

  document.getElementById("opslaanknop2").style.display="inline";

  var request = createREQ();



  var rand1 = parseInt(Math.random()*9);

  var rand2 = parseInt(Math.random()*999999);



  var params = "";



  for (nr in document.planForm.elements) {

    input = document.planForm.elements[nr];
    if (input == null) {}
    else if (input.name == null) {}
    else if (!(input.name.indexOf)) {}
    else if (input.name.indexOf('plan') != -1)

      params += "&" + input.name + "=" + input.value;

    else

      break;

  }



  var url = "tp_plan_opslaan_ajax.php" +

            "?rand" + rand1 + "=" + rand2 +

            "&tp_nieuwepartners=" + nl2nnl(document.planForm.tp_nieuwepartners.value)

            + "&overleg=" + <?= $overlegInfo['id'] ?>

            + params;

  //alert("Debugboodschap: via " + url + " gaan we het plan opslaan.");



  request.onreadystatechange = function() {

    if (request.readyState < 4) {

        document.getElementById('feedbackOpslag').innerHTML = "Bezig met opslaan ... fase " + request.readyState + "<br/>" + url;

        document.getElementById('feedbackOpslag').style.backgroundColor = "#ffb";

    }

    else {

        document.getElementById('feedbackOpslag').style.color = "#fff";

        document.getElementById('feedbackOpslag').style.backgroundColor = "#fff";

      var result = request.responseText;

      var spatie = 0;

      while (result.charAt(spatie) == '') spatie++;

      result = result.substring(spatie,result.length);



      if (result.indexOf("OK")==-1) {

        alert("Er is iets ambetant misgegaan, nl. " + result);

      }

      else {

        alert("Het plan van tenlasteneming is succesvol opgeslagen.");

        document.getElementById("opslaanknop").style.display="inline";

        document.getElementById("opslaanknop2").style.display="none";

        if (result.indexOf("+")>0)

          planIngevuld = true;

        else

          planIngevuld = false;



      }

    }

  }



  // en nu nog de request uitsturen

  //request.open("GET", url);

  //request.send(null);



  request.open("POST", "tp_plan_opslaan_ajax.php");

  request.setRequestHeader('Content-Type','application/x-www-form-urlencoded');

  request.send("tp_nieuwepartners=" + nl2nnl(document.planForm.tp_nieuwepartners.value)

            + "&overleg=" + <?= $overlegInfo['id'] ?>

            + params);



}

</script>

<?php



}



$baseURL = $baseURL1 = "overleg_alles.php";



/*************************************************************************************

 * $overlegInfo bevat het overleg waarvan de deelnemers opgehaald moeten worden!!

 *  print_r($overlegInfo);

 *************************************************************************************/





print("<form name=\"planForm\"><table class=\"form\">");


preset($overlegInfo['id']);

$qryOrgs = "select overleg_tp_plan.id as nr, organisatie.naam, plan from overleg_tp_plan, organisatie

            where overleg_tp_plan.genre = \"org\"

            and persoon = organisatie.id

            and overleg = {$overlegInfo['id']}";

if (isset($readOnly)) {

  print("<tr><td colspan=\"2\"><strong>Plan van tenlasteneming</strong></td></tr>\n");

  print("<tr><td colspan=\"2\">Rol van de interne partners:</td></tr>\n");

}

else {

  print("<tr><td colspan=\"2\">Vul hieronder de rol van de interne partners in:</td></tr>\n");

}

toonPlannen($qryOrgs);





$qryZorgHulp = "select overleg_tp_plan.id as nr, concat(hulpverleners.naam, concat(' ', hulpverleners.voornaam)) as naam, plan

            from overleg_tp_plan, hulpverleners, organisatie

            where overleg_tp_plan.genre = \"hulp\"

            and hulpverleners.organisatie = organisatie.id

            and (organisatie.genre = 'ZVL' or organisatie.genre = 'HVL' or organisatie.genre = 'XVLP')

            and persoon = hulpverleners.id

            and overleg = {$overlegInfo['id']}";



if (isset($readOnly)) {

  print("<tr><td colspan=\"2\">Rol van de zorg- en hulpverleners:</td></tr>\n");

}

else {

  print("<tr><td colspan=\"2\">Vul hieronder de rol van de professionele zorg- en hulpverleners in:</td></tr>\n");

}

toonPlannen($qryZorgHulp);







if (isset($readOnly)) {

  print("<tr><td colspan=\"2\">Rol van de mantelzorgers en andere niet-professionelen:</td></tr>\n");

}

else {

  print("<tr><td colspan=\"2\">Vul hieronder de rol van de mantelzorgers en andere niet-professionelen in:</td></tr>\n");

}

$qryXVLNP = "select overleg_tp_plan.id as nr, concat(hulpverleners.naam, concat(' ', hulpverleners.voornaam)) as naam, plan

            from overleg_tp_plan, hulpverleners, organisatie

            where overleg_tp_plan.genre = \"hulp\"

            and hulpverleners.organisatie = organisatie.id

            and (organisatie.genre = 'XVLNP')

            and persoon = hulpverleners.id

            and overleg = {$overlegInfo['id']}";

toonPlannen($qryXVLNP);



$qryMantel = "select overleg_tp_plan.id as nr, concat(mantelzorgers.naam, concat(' ', mantelzorgers.voornaam)) as naam, plan from overleg_tp_plan, mantelzorgers

            where overleg_tp_plan.genre = \"mantel\"

            and persoon = mantelzorgers.id

            and overleg = {$overlegInfo['id']}";

toonPlannen($qryMantel);



$nieuwePartners = $overlegInfo['tp_nieuwepartners'];

$nieuwePartners = str_replace("\\n","\n",$nieuwePartners);



?>



<tr><td colspan="2">Vermeld hieronder de nieuwe, externe partners en hun te verwachten rol en inbreng</td></tr>

<tr><td colspan="2"><textarea style="font-size: 12px; font-family: 'Courier New' sans-serif; width:500px;height:90px;" name="tp_nieuwepartners"><?= $nieuwePartners ?></textarea></td></tr>



<?php

if (!isset($readOnly)) {

  print("<tr><td class=\"label\">Plan van tenlasteneming</td>\n");

  print("<td class=\"input\"><input id=\"opslaanknop\" name=\"verstuur\" type=\"button\" onclick=\"this.style.display='none';planOpslaan();\" value=\"opslaan\" /><span id=\"opslaanknop2\" style=\"display: none;\">Bezig met opslaan...</span></td></tr>\n");

}

print("<tr><td id='feedbackOpslag' colspan='2'></td>");

print("</table></form>");



?>



</div>