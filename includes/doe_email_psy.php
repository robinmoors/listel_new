
      <p style="text-align:left">

         Als je wil, kan je <input type="button" value="de referentiepersoon mailen" onclick="doeMailTP();" />  om dit begeleidingsplan aan te vullen.
      </p>
   <div id="emailstatusTP" style="height:24px;"></div>




  <script type="text/javascript">

     function doeMailTP() {
       var request = createREQ();
       var rand1 = parseInt(Math.random()*9);
       var rand2 = parseInt(Math.random()*999999);
       var url = "doe_email_versturen_psy.php?overleg=" + <?= $overlegInfo['id'] ?>;
       request.onreadystatechange = function() {
         if (request.readyState < 4) {
           document.getElementById('emailstatusTP').innerHTML = "email wordt verstuurd ....";
         }
         else {
           var result = request.responseText;
           //var spatie = 0;
           //while ((result.charAt(spatie) != 'O') && (result.charAt(spatie) != 'K') ) spatie++;
           //result = result.substring(spatie,result.length);
           var okplaats = result.indexOf("OK");
           if (okplaats>=0) {
             var email = request.responseText.substring(okplaats+2);
             document.getElementById('emailstatusTP').innerHTML =
                   "De email naar de referentiepersoon is verstuurd naar " + email + "!";
           }

           else if (result.indexOf("NULL")>=0) {
             document.getElementById('emailstatusTP').innerHTML =
                   "Er is nog geen referentiepersoon!";
           }
           else if (result.indexOf("--")>=0) {
             document.getElementById('emailstatusTP').innerHTML =
                   "De referentiepersoon heeft geen (gekend) emailadres!";
           }

           else {

             alert("Er is iets ambetant misgegaan, nl. " + result);

             document.getElementById('emailstatusTP').innerHTML = "email NIET verstuurd." + result;

           }

         }

      }



      // en nu nog de request uitsturen

      request.open("GET", url);

      request.send(null);

    }

  </script>



