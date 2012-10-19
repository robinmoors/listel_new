<script type="text/javascript">



   //--------------------------------------------------

   function checkCheque()

   //--------------------------------------------------

      {

      var nr=document.edithvlform.reknr1.value+document.edithvlform.reknr2.value+" ";

		deel2=parseInt(nr.substring(0,1))*1000000000;

		deel2=deel2+parseInt(nr.substring(1,2))*100000000;

		deel2=deel2+parseInt(nr.substring(2,3))*10000000;

		deel2=deel2+parseInt(nr.substring(3,4))*1000000;

		deel2=deel2+parseInt(nr.substring(4,5))*100000;

		deel2=deel2+parseInt(nr.substring(5,6))*10000;

		deel2=deel2+parseInt(nr.substring(6,7))*1000;

		deel2=deel2+parseInt(nr.substring(7,8))*100;

		deel2=deel2+parseInt(nr.substring(8,9))*10;

		deel2=deel2+parseInt(nr.substring(9,10));



    controle_getal = parseInt(document.edithvlform.reknr3.value.substr(0,1))*10+ parseInt(document.edithvlform.reknr3.value.substr(1,2));



      if (!((deel2%97==controle_getal) || (deel2%97==00 && controle_getal==97)))

         {

         alert("Het rekeningnummer heeft foutieve opbouw, \n de controle klopt niet");

         }

      }

   //--------------------------------------------------

   function checkCheque2()

   //--------------------------------------------------

      {

      var nr=""+document.editpartnerform.reknr1.value+document.editpartnerform.reknr2.value+" ";

		deel2=parseInt(nr.substring(0,1))*1000000000;

		deel2=deel2+parseInt(nr.substring(1,2))*100000000;

		deel2=deel2+parseInt(nr.substring(2,3))*10000000;

		deel2=deel2+parseInt(nr.substring(3,4))*1000000;

		deel2=deel2+parseInt(nr.substring(4,5))*100000;

		deel2=deel2+parseInt(nr.substring(5,6))*10000;

		deel2=deel2+parseInt(nr.substring(6,7))*1000;

		deel2=deel2+parseInt(nr.substring(7,8))*100;

		deel2=deel2+parseInt(nr.substring(8,9))*10;

		deel2=deel2+parseInt(nr.substring(9,10));



    controle_getal = parseInt(document.editpartnerform.reknr3.value.substr(0,1))*10+ parseInt(document.editpartnerform.reknr3.value.substr(1,2));



      if (!((deel2%97==controle_getal) || (deel2%97==00 && controle_getal==97)))

         {

         alert("Het rekeningnummer heeft foutieve opbouw, \n de controle klopt niet");

         }

      }

</script>