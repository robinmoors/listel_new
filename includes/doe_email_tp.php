   <li style="display:none;" id="emailTP">

      <p style="text-align:left">

         <input type="button" value="Mail de projectco&ouml;rdinator(en)" onclick="doeMailTP();" />  om het plan van tenlasteneming in te vullen

   <div id="emailstatusTP" style="height:24px;"></div>

   </p></li>



  <script type="text/javascript">

     function doeMailTP() {



       var request = createREQ();



       var rand1 = parseInt(Math.random()*9);

       var rand2 = parseInt(Math.random()*999999);

       var url = "doe_email_versturen_tp.php?overleg=" + <?= $overlegInfo['id'] ?>;



       request.onreadystatechange = function() {

         if (request.readyState < 4) {

           document.getElementById('emailstatusTP').innerHTML = "email wordt verstuurd ....";

         }

         else {

           var result = request.responseText;

           //var spatie = 0;

           //while ((result.charAt(spatie) != 'O') && (result.charAt(spatie) != 'K') ) spatie++;

           //result = result.substring(spatie,result.length);



           if (result.indexOf("OK") >= 0) {

             document.getElementById('emailstatusTP').innerHTML =

                   "De email naar de project-co&ouml;rdinator(en) is verstuurd!";

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



