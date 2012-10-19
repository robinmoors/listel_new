var hit =  false;

var hitValue = "";



function resetList(form_id,input_id,select_id,setvalue,togglefield,lijst,maxNumToShow,hoogte)

   {

   eval("document."+form_id+"."+input_id+".value=\"\"");

   eval("document."+form_id+"."+select_id+".style.display=\"inline\"");

   refreshList(form_id,input_id,select_id,setvalue,togglefield,lijst,maxNumToShow);

   if (togglefield!="")showCombo(togglefield,hoogte);

   eval("document."+form_id+"."+input_id+".focus()");

   }





function refreshList( form_id,input_id,select_id,setvalue,togglefield,lijst,maxNumToShow)

   {

   inputObj = eval("document."+form_id+"."+input_id);

   selectObj = eval("document."+form_id+"."+select_id);



   // postcode leegmaken

   if (inputObj.value == "0 Gemeente onbekend") inputObj.value = "";

   // toevoeging Kris om er voor te zorgen dat overbodige letters verdwijnen

   if (hit) {

     var inputValue = inputObj.value;

     if (inputValue.indexOf(hitValue) != -1) {

       inputObj.value = hitValue;

       selectObj.options[0].selected = true;

       return;

     }

     else {

        hit = false;

        hitValue = "";

     }

   }



   // einde toevoeging Kris

   

   selectObj.length = 0;  // maak selectlijst leeg

   selectObj.style.width="250px";

   var strText = "^"+inputObj.value;

   var numShown;

   re = new RegExp(strText,"gi"); // bekijk http://www.javascriptkit.com/javatutors/re2.shtml

    // http://www.somacon.com/p241.php

   var numShown = 0;

   

   if (lijst.length==0) return;

   

   for(i = 0; i < lijst.length; i+=2)

      {

      if(lijst[i].search(re) != -1)

         {

         selectObj[numShown] = new Option(lijst[i],lijst[i+1]);

         numShown++;

         }

      if(numShown == maxNumToShow)

         {

         break;

         }

      }



   if(selectObj.length == 1)

      {

      selectObj.options[0].selected = true;

      if (setvalue ==  1)

         {

         inputObj.value = selectObj.options[0].text;

         hit = true;

         hitValue = inputObj.value;

         }

      if (togglefield!="")hideCombo(togglefield);

      }



   }


function refreshListOveral( form_id,input_id,select_id,setvalue,togglefield,lijst,maxNumToShow)

   {

   inputObj = eval("document."+form_id+"."+input_id);

   selectObj = eval("document."+form_id+"."+select_id);



   // postcode leegmaken

   if (inputObj.value == "0 Gemeente onbekend") inputObj.value = "";

   // toevoeging Kris om er voor te zorgen dat overbodige letters verdwijnen

   if (hit) {

     var inputValue = inputObj.value;

     if (inputValue.indexOf(hitValue) != -1) {

       inputObj.value = hitValue;

       selectObj.options[0].selected = true;

       return;

     }

     else {

        hit = false;

        hitValue = "";

     }

   }



   // einde toevoeging Kris



   selectObj.length = 0;  // maak selectlijst leeg

   selectObj.style.width="250px";

   var strText = ""+inputObj.value;



   var pos1=0;

   var pos2 = strText.indexOf(" ", pos1);

   var regText = "";

   while (pos2 != -1) {

      regText = regText + "(" + strText.substring(pos1,pos2) + ")(.*)";

      pos1 = pos2+1;

      pos2 = strText.indexOf(" ", pos1);

   }

   regText = regText + "(" + strText.substring(pos1) + ")";

   

   //alert(regText);

   var numShown;

   re = new RegExp(regText,"gi"); // bekijk http://www.javascriptkit.com/javatutors/re2.shtml

    // http://www.somacon.com/p241.php

   var numShown = 0;



   if (lijst.length==0) return;



   for(i = 0; i < lijst.length; i+=2)

      {

      if(lijst[i].search(re) != -1)

         {

         selectObj[numShown] = new Option(lijst[i],lijst[i+1]);

         numShown++;

         }

      if(numShown == maxNumToShow)

         {

         break;

         }

      }



   if(selectObj.length == 1)

      {

      selectObj.options[0].selected = true;

      if (setvalue ==  1)

         {

         inputObj.value = selectObj.options[0].text;

         hit = true;

         hitValue = inputObj.value;

         }

      if (togglefield!="")hideCombo(togglefield);

      }



   }



function refreshListHash( form_id,input_id,select_id,setvalue,togglefield,lijst,maxNumToShow, hashlist)

   {



   inputObj = eval("document."+form_id+"."+input_id);

   selectObj = eval("document."+form_id+"."+select_id);

   // postcode leegmaken

   if (inputObj.value == "0 Gemeente onbekend") inputObj.value = "";

   // toevoeging Kris om er voor te zorgen dat overbodige letters verdwijnen

   var inputValue = inputObj.value;

   if (hit) {

     if (inputValue.indexOf(hitValue) != -1) {

       inputObj.value = hitValue;

       selectObj.options[0].selected = true;

       return;

     }

     else {

        hit = false;

        hitValue = "";

     }

   }



   // einde toevoeging Kris



   selectObj.length = 0;  // maak selectlijst leeg

   selectObj.style.width="250px";

   var strText = "^"+inputObj.value;

   var numShown;

   re = new RegExp(strText,"gi"); // bekijk http://www.javascriptkit.com/javatutors/re2.shtml

    // http://www.somacon.com/p241.php

   var numShown = 0;

   if (inputValue.length > 0) {

     startIndex = parseInt(hashlist[inputValue.charAt(0)])*2;

   }

   else

     startIndex = 0;

   if (isNaN(startIndex)) startIndex = 0;

   for(i = startIndex; i < lijst.length; i+=2)

      {

      if(lijst[i].search(re) != -1)

         {

         selectObj[numShown] = new Option(lijst[i],lijst[i+1]);

         numShown++;

         }

      if(numShown == maxNumToShow)

         {

         break;

         }

      }



   if(selectObj.length == 1)

      {

      selectObj.options[0].selected = true;

      if (setvalue ==  1)

         {

         inputObj.value = selectObj.options[0].text;

         hit = true;

         hitValue = inputObj.value;

         }

      if (togglefield!="")hideCombo(togglefield);

      }



   }



function handleSelectClick(form_id,input_id,select_id,setvalue,togglefield)

   {

   if (setvalue ==  1) // inputVeld aanpassen aan selectVeld bij 1

      {

      selectObj = eval("document."+form_id+"."+select_id);

      if (selectObj.options.length == 0) return;

      inputObj = eval("document."+form_id+"."+input_id);

      inputObj.value = selectObj.options[selectObj.selectedIndex].text;

      }

   if (togglefield!="")hideCombo(togglefield);

//   alert(functionlist[parseInt(selectObj.options[selectObj.selectedIndex].value)+1]);

   }


/** BEGIN voor gebruik in aanvraag_overleg */

function refreshListAanvraag( form_id,input_id,select_id,setvalue,togglefield,lijst,maxNumToShow)
{
   inputObj = eval("document."+form_id+"."+input_id);
   selectObj = eval("document."+form_id+"."+select_id);

   // postcode leegmaken
   if (inputObj.value == "0 Gemeente onbekend") inputObj.value = "";
   // toevoeging Kris om er voor te zorgen dat overbodige letters verdwijnen
   if (hit) {
     var inputValue = inputObj.value;
     if (inputValue.indexOf(hitValue) != -1) {
       inputObj.value = hitValue;
       selectObj.options[0].selected = true;
       return;
     }
     else {
        hit = false;
        hitValue = "";
     }
   }

   // einde toevoeging Kris

   selectObj.length = 0;  // maak selectlijst leeg
   selectObj.style.width="250px";
   var strText = "^"+inputObj.value;
   var numShown;
   re = new RegExp(strText,"gi"); // bekijk http://www.javascriptkit.com/javatutors/re2.shtml
    // http://www.somacon.com/p241.php
   var numShown = 0;

   if (lijst.length==0) return;

   for(i = 0; i < lijst.length; i+=2)
      {
      if(lijst[i].search(re) != -1)
         {
         selectObj[numShown] = new Option(lijst[i],lijst[i+1]);
         numShown++;
         }
      if(numShown == maxNumToShow)
         {
         break;
         }
      }

   if(selectObj.length == 1)
      {
      selectObj.options[0].selected = true;
      if (setvalue ==  1)
         {
         inputObj.value = selectObj.options[0].text;
         hit = true;
         hitValue = inputObj.value;
         }
      if (togglefield!="") {
        hideCombo(togglefield);
        toonStap2Keuze();
      }
   }
}
function handleSelectClickAanvraag(form_id,input_id,select_id,setvalue,togglefield)
{
   if (setvalue ==  1) // inputVeld aanpassen aan selectVeld bij 1
   {
      selectObj = eval("document."+form_id+"."+select_id);
      if (selectObj.options.length == 0) return;
      inputObj = eval("document."+form_id+"."+input_id);
      inputObj.value = selectObj.options[selectObj.selectedIndex].text;
      toonStap2Keuze();
   }
   if (togglefield!="") {
     hideCombo(togglefield);
   }
}
/** EINDE voor gebruik in aanvraag_overleg */



function showCombo(togglefield,hoogte)

   {

   document.getElementById(togglefield).style.display="block";

   document.getElementById(togglefield).style.height=hoogte+"px";

   }



function hideCombo(togglefield)

   {

   document.getElementById(togglefield).style.display="none";

   }