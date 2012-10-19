/*JAVASCRIPT----------*/

/*------LISTEL-------*/

/*------------------*/





// Formuliervalidatie algemeen v1.00



function checkAnders(form, veld) {

  if (veld == "organisatie") {

     return document.forms[form].organisatieInput.value != origineel['organisatie'];

  }

  else if (veld == "postcode") {

     return document.forms[form].postCodeInput.value != document.forms[form].postCodeInput.defaultValue ;

  }

  else if (veld == "convenant") {

     //alert(convenantOrigineel == convenant );

     return convenantOrigineel.indexOf(convenant) == -1;

  }

  else if (veld.charAt(0) == '_') {

     var veldEcht = veld.substr(1);

     return document.forms[form].elements[veldEcht].selectedIndex != origineel[veldEcht];

  }

	else if (document.forms[form].elements[veld].value == document.forms[form].elements[veld].defaultValue )

    return false;

  else

    return true;

}





function bevestigVeranderingen(form, velden) {

  var aantal = 0;

  var changes = "";

  for (nr=0; nr < velden.length; nr++) {

    veld = velden[nr];

    if (checkAnders(form, veld)) {

       aantal++;

       if (veld == "_fnct_id")

         changes = " - functie \n" + changes;

       else if (veld.charAt(0) == '_') {

         changes = " - " + veld.substr(1) + "\n" + changes;

       }

       else

         changes = " - " + veld + "\n" + changes;

    }

  }

  if (aantal == 0) {

     document.forms[form].veranderd.value = 0;

     return true;

  }

  else {

     if (aantal==1) tekst = "1 verandering";

     else tekst = aantal + " veranderingen";

     var vraag1 = confirm("Je hebt (minstens) " + tekst + " aangebracht in volgende velden \n" + changes

                         + "\n\nWil je deze veranderingen definitief opslaan?");

     if (vraag1) {

        document.forms[form].veranderd.value = 1;

        return true;

     }

     else {

        var vraag2 = confirm("Wil je die velden terug in hun oorspronkelijke toestand herstellen?");

        if (vraag2) {

          resetVelden(form, velden);

          document.forms[form].veranderd.value = 1;

          return false;

        }

        return false;

     }

  }

}



function resetVeld(form, veld) {

  if (veld == "organisatie") {

     document.edithvlform.organisatieInput.value = origineel['organisatie'];

     refreshListOveral(form,'organisatieInput','organisatie',1,'OrganisatieS',orgList,20);

  }

  else if (veld == "postcode") {

     document.forms[form].postCodeInput.value = document.forms[form].postCodeInput.defaultValue;

     refreshList(form,'postCodeInput','hvl_gem_id',1,'IIPostCodeS',gemeenteList,20);

  }

  else if (veld == "convenant") {

     convenant = convenantOrigineel;

     radioObj=document.forms[form].elements[veld];

     if (radioObj) {

       for(var i = 0; i < radioObj.length; i++) {

         if(radioObj[i].value == convenantOrigineel)  {

           radioObj[i].checked = true;

         }

       }

     }

  }

  else if (veld.charAt(0) == '_') {

     var veldEcht = veld.substr(1);

     document.forms[form].elements[veldEcht].selectedIndex = origineel[veldEcht];

  }

  else document.forms[form].elements[veld].value = document.forms[form].elements[veld].defaultValue;

}



function resetVelden(form, velden) {



  for (nr=0;nr < velden.length; nr++) {

    veld = velden[nr];

    resetVeld(form, veld);

  }

}



function checkLeeg (form, veld, foutMelding)

					{

					if (document.forms[form].elements[veld].value == "" )

								{

								return foutMelding  + "\n";

								}

					else if(document.forms[form].elements[veld].value == "undefined")

								{

								return foutMelding  + "\n";

								}

					else

								{

								return "";

								}

					}





function checkCijfers (form, veld, lengte, foutMelding)

					{

					if (document.forms[form].elements[veld].value =="" || 

						document.forms[form].elements[veld].length != lengte ||

						isNaN (document.forms[form].elements[veld].value)

						)

								{

								return foutMelding + "\n";

								}

					else

								{

								return "";

								}

					}



function checkEmail (form, veld, foutMelding)

					{

					eersteAt = document.forms[form].elements[veld].value.indexOf("@");

					laatsteAt = document.forms[form].elements[veld].value.lastIndexOf("@");

					eerstePunt = document.forms[form].elements[veld].value.indexOf(".");

					laatstePunt = document.forms[form].elements[veld].value.lastIndexOf(".");

					

					if (eersteAt == -1 || eerstePunt == -1 || eerstePunt != laatstePunt || eersteAt != laatsteAt )

									{

									return foutMelding + "\n";

									}

					else

									{

									return "";

									}

					}

					
function bankcode2bic(code) {
if (code >= 0 && code <= 0) return 'BPOT BE B1';
if (code >= 1 && code <= 40) return 'GEBA BE BB';
if (code >= 41 && code <= 45) return 'VRIJ';
if (code >= 46 && code <= 49) return 'GEBA BE BB';
if (code >= 50 && code <= 99) return 'GKCC BE BB';
if (code >= 100 && code <= 101) return 'NBBE BE BB';
if (code >= 102 && code <= 102) return 'nav';
if (code >= 103 && code <= 108) return 'NICA BE BB';
if (code >= 109 && code <= 109) return 'BKCP BE B1 BKB';
if (code >= 110 && code <= 110) return 'BKCP BE BB';
if (code >= 111 && code <= 111) return 'ABER BE 21';
if (code >= 112 && code <= 112) return 'VRIJ';
if (code >= 113 && code <= 114) return 'BKCP BE B1 BKB';
if (code >= 115 && code <= 115) return 'VRIJ';
if (code >= 116 && code <= 116) return 'VRIJ';
if (code >= 117 && code <= 118) return 'VRIJ';
if (code >= 119 && code <= 121) return 'BKCP BE B1 BKB';
if (code >= 122 && code <= 123) return 'BKCP BE B1 OBK';
if (code >= 124 && code <= 124) return 'BKCP BE B1 BKB';
if (code >= 125 && code <= 126) return 'CPHB BE 75';
if (code >= 127 && code <= 127) return 'BKCP BE B1 BKB';
if (code >= 128 && code <= 128) return 'VRIJ';
if (code >= 129 && code <= 129) return 'BKCP BE B1 BKB';
if (code >= 130 && code <= 130) return 'VRIJ';
if (code >= 131 && code <= 131) return 'BKCP BE B1 BKB';
if (code >= 132 && code <= 132) return 'BNAG BE BB';
if (code >= 133 && code <= 134) return 'BKCP BE B1 BKB';
if (code >= 135 && code <= 136) return 'VRIJ';
if (code >= 137 && code <= 137) return 'GEBA BE BB';
if (code >= 138 && code <= 138) return 'VRIJ';
if (code >= 139 && code <= 139) return 'nav';
if (code >= 140 && code <= 149) return 'GEBA BE BB';
if (code >= 150 && code <= 165) return 'VRIJ';
if (code >= 166 && code <= 166) return 'nav';
if (code >= 167 && code <= 167) return 'nav';
if (code >= 168 && code <= 170) return 'VRIJ';
if (code >= 171 && code <= 171) return 'CEVT BE 71';
if (code >= 172 && code <= 172) return 'RABO BE 22';
if (code >= 173 && code <= 175) return 'VRIJ';
if (code >= 176 && code <= 177) return 'BSCH BE BR';
if (code >= 178 && code <= 179) return 'COBA BE BX';
if (code >= 180 && code <= 182) return 'VRIJ';
if (code >= 183 && code <= 183) return 'BARB BE BB';
if (code >= 184 && code <= 184) return 'VRIJ';
if (code >= 185 && code <= 185) return 'HBKA BE 22';
if (code >= 186 && code <= 188) return 'VRIJ';
if (code >= 189 && code <= 189) return 'SMBC BE BB';
if (code >= 190 && code <= 199) return 'CREG BE BB';
if (code >= 200 && code <= 214) return 'GEBA BE BB';
if (code >= 215 && code <= 219) return 'VRIJ';
if (code >= 220 && code <= 251) return 'GEBA BE BB';
if (code >= 252 && code <= 256) return 'VRIJ';
if (code >= 257 && code <= 257) return 'GEBA BE BB';
if (code >= 258 && code <= 258) return 'VRIJ';
if (code >= 259 && code <= 298) return 'GEBA BE BB';
if (code >= 299 && code <= 299) return 'GEBA BE BB';
if (code >= 300 && code <= 399) return 'BBRU BE BB';
if (code >= 400 && code <= 499) return 'KRED BE BB';
if (code >= 500 && code <= 500) return 'SBOS BE B1';
if (code >= 501 && code <= 501) return 'DHBN BE BB';
if (code >= 502 && code <= 502) return 'VRIJ';
if (code >= 503 && code <= 503) return 'DRES BE BX';
if (code >= 504 && code <= 504) return 'VOWA BE B1';
if (code >= 505 && code <= 506) return 'NAP';
if (code >= 507 && code <= 507) return 'DIER BE 21';
if (code >= 508 && code <= 508) return 'PARB BE BZ-MDC';
if (code >= 509 && code <= 509) return 'ABNA BE BR';
if (code >= 510 && code <= 510) return 'VAPE BE 21';
if (code >= 511 && code <= 511) return 'NAP';
if (code >= 512 && code <= 512) return 'DNIB BE 21';
if (code >= 513 && code <= 513) return 'SGAB BE B2';
if (code >= 514 && code <= 514) return 'PUIL BE BB';
if (code >= 515 && code <= 515) return 'IRVT BE BB';
if (code >= 516 && code <= 516) return 'VRIJ';
if (code >= 517 && code <= 517) return 'FORD BE 21';
if (code >= 518 && code <= 518) return 'NAP';
if (code >= 519 && code <= 519) return 'BNYM BE BB';
if (code >= 520 && code <= 520) return 'AACA BE 41';
if (code >= 521 && code <= 521) return 'FVLB BE 22';
if (code >= 522 && code <= 522) return 'UTWB BE BB';
if (code >= 523 && code <= 523) return 'TRIO BE 91';
if (code >= 524 && code <= 524) return 'WAFA BE BB';
if (code >= 525 && code <= 529) return 'VRIJ';
if (code >= 530 && code <= 530) return 'SHIZ BE BB';
if (code >= 531 && code <= 531) return 'NAP';
if (code >= 532 && code <= 534) return 'VRIJ';
if (code >= 535 && code <= 535) return 'FBHL BE 22';
if (code >= 536 && code <= 537) return 'VRIJ';
if (code >= 538 && code <= 538) return 'nav';
if (code >= 539 && code <= 539) return 'NAP';
if (code >= 540 && code <= 540) return 'VRIJ';
if (code >= 541 && code <= 541) return 'BKID BE 22';
if (code >= 542 && code <= 544) return 'VRIJ';
if (code >= 545 && code <= 545) return 'NAP';
if (code >= 546 && code <= 546) return 'WAFA BE BB';
if (code >= 547 && code <= 547) return 'VRIJ';
if (code >= 548 && code <= 548) return 'LOCY BE BB';
if (code >= 549 && code <= 549) return 'CHAS BE BX';
if (code >= 550 && code <= 560) return 'GKCC BE BB';
if (code >= 561 && code <= 561) return 'BCRT BE B1';
if (code >= 562 && code <= 569) return 'GKCC BE BB';
if (code >= 570 && code <= 579) return 'CITI BE BX';
if (code >= 580 && code <= 580) return 'VRIJ';
if (code >= 581 && code <= 581) return 'MHCB BE BB';
if (code >= 582 && code <= 582) return 'VRIJ';
if (code >= 583 && code <= 583) return 'DEGR BE BB';
if (code >= 584 && code <= 584) return 'ICIC GB 2L';
if (code >= 585 && code <= 585) return 'RCBP BE BB';
if (code >= 586 && code <= 586) return 'CFFR BE B1';
if (code >= 587 && code <= 587) return 'nav';
if (code >= 588 && code <= 588) return 'CMCI BE B1';
if (code >= 589 && code <= 589) return 'VRIJ';
if (code >= 590 && code <= 594) return 'BSCH BE BB';
if (code >= 595 && code <= 601) return 'CTBK BE BX';
if (code >= 602 && code <= 602) return 'NAP';
if (code >= 603 && code <= 609) return 'VRIJ';
if (code >= 610 && code <= 613) return 'BDCH BE 22';
if (code >= 614 && code <= 623) return 'VRIJ';
if (code >= 624 && code <= 625) return 'GKCC BE BB';
if (code >= 626 && code <= 629) return 'VRIJ';
if (code >= 630 && code <= 631) return 'BBRU BE BB';
if (code >= 632 && code <= 633) return 'LOYD BE BB';
if (code >= 634 && code <= 636) return 'BNAG BE BB';
if (code >= 637 && code <= 637) return '';
if (code >= 638 && code <= 638) return 'GKCC BE BB';
if (code >= 639 && code <= 639) return 'VRIJ';
if (code >= 640 && code <= 640) return 'ADIA BE 22';
if (code >= 641 && code <= 641) return 'VRIJ';
if (code >= 642 && code <= 642) return 'BBVA BE BB';
if (code >= 643 && code <= 643) return 'BMPB BE BB';
if (code >= 644 && code <= 644) return 'VRIJ';
if (code >= 645 && code <= 645) return 'JVBA BE 22';
if (code >= 646 && code <= 647) return 'BNAG BE BB';
if (code >= 648 && code <= 650) return 'VRIJ';
if (code >= 651 && code <= 651) return 'KEYT BE BB';
if (code >= 652 && code <= 652) return 'HBKA BE 22';
if (code >= 653 && code <= 655) return 'VRIJ';
if (code >= 656 && code <= 656) return 'ETHI BE BB';
if (code >= 657 && code <= 657) return 'GKCC BE BB';
if (code >= 658 && code <= 658) return 'HABB BE BB';
if (code >= 659 && code <= 663) return 'VRIJ';
if (code >= 664 && code <= 664) return 'BCDM BE B1';
if (code >= 665 && code <= 665) return 'SPAA BE 22';
if (code >= 666 && code <= 666) return 'nav';
if (code >= 667 && code <= 667) return 'VRIJ';
if (code >= 668 && code <= 668) return 'SBIN BE 2X';
if (code >= 669 && code <= 669) return 'nav';
if (code >= 670 && code <= 670) return 'VRIJ';
if (code >= 671 && code <= 671) return 'EURB BE 99';
if (code >= 672 && code <= 672) return 'GKCC BE BB';
if (code >= 673 && code <= 673) return 'HBKA BE 22';
if (code >= 674 && code <= 674) return 'ABNA BE BR';
if (code >= 675 && code <= 675) return 'BYBB BE BB';
if (code >= 676 && code <= 676) return 'DEGR BE BB';
if (code >= 677 && code <= 677) return 'VRIJ';
if (code >= 678 && code <= 678) return 'DELE BE 22';
if (code >= 679 && code <= 679) return 'PCHQ BE BB';
if (code >= 680 && code <= 680) return 'GKCC BE BB';
if (code >= 681 && code <= 681) return 'VRIJ';
if (code >= 682 && code <= 683) return 'GKCC BE BB';
if (code >= 684 && code <= 684) return 'VRIJ';
if (code >= 685 && code <= 686) return 'BOFA BE 3X';
if (code >= 687 && code <= 687) return 'MGTC BE BE';
if (code >= 688 && code <= 688) return 'SGAB BE B2';
if (code >= 689 && code <= 689) return 'VRIJ';
if (code >= 690 && code <= 690) return 'BNPA BE BB';
if (code >= 691 && code <= 691) return 'FTSB NL 2R';
if (code >= 692 && code <= 692) return 'nav';
if (code >= 693 && code <= 693) return 'BOTK BE BX';
if (code >= 694 && code <= 694) return 'BDCH BE 22';
if (code >= 695 && code <= 695) return 'VRIJ';
if (code >= 696 && code <= 696) return 'CRLY BE BB';
if (code >= 697 && code <= 699) return 'VRIJ';
if (code >= 700 && code <= 709) return 'AXAB BE 22';
if (code >= 710 && code <= 719) return 'VRIJ';
if (code >= 720 && code <= 724) return 'ABNA BE BR';
if (code >= 725 && code <= 727) return 'KRED BE BB';
if (code >= 728 && code <= 729) return 'CREG BE BB';
if (code >= 730 && code <= 731) return 'KRED BE BB';
if (code >= 732 && code <= 732) return 'CREG BE BB';
if (code >= 733 && code <= 741) return 'KRED BE BB';
if (code >= 742 && code <= 742) return 'CREG BE BB';
if (code >= 743 && code <= 749) return 'KRED BE BB';
if (code >= 750 && code <= 774) return 'AXAB BE 22';
if (code >= 775 && code <= 799) return 'GKCC BE BB';
if (code >= 800 && code <= 816) return 'AXAB BE 22';
if (code >= 817 && code <= 824) return 'VRIJ';
if (code >= 825 && code <= 826) return 'DEUT BE BE';
if (code >= 827 && code <= 827) return 'ETHI BE BB';
if (code >= 828 && code <= 828) return 'HBKA BE 22';
if (code >= 829 && code <= 829) return 'NYA';
if (code >= 830 && code <= 839) return 'GKCC BE BB';
if (code >= 840 && code <= 840) return 'PRIB BE BB';
if (code >= 841 && code <= 841) return 'COVE BE 71';
if (code >= 842 && code <= 842) return 'UBSW BE BB';
if (code >= 843 && code <= 843) return 'BCRT BE B1';
if (code >= 844 && code <= 844) return 'RABO BE 22';
if (code >= 845 && code <= 845) return 'DEGR BE BB';
if (code >= 846 && code <= 846) return 'IRVT BE B1';
if (code >= 847 && code <= 848) return 'VRIJ';
if (code >= 849 && code <= 849) return 'BPPB BE B1';
if (code >= 850 && code <= 853) return 'SPAA BE 22';
if (code >= 854 && code <= 858) return 'VRIJ';
if (code >= 859 && code <= 863) return 'SPAA BE 22';
if (code >= 864 && code <= 864) return 'VRIJ';
if (code >= 865 && code <= 866) return 'SPAA BE 22';
if (code >= 867 && code <= 867) return 'VRIJ';
if (code >= 868 && code <= 868) return 'SPAA BE 22';
if (code >= 869 && code <= 869) return 'NAP';
if (code >= 870 && code <= 872) return 'BNAG BE BB';
if (code >= 873 && code <= 873) return 'PCHQ BE BB';
if (code >= 874 && code <= 874) return 'BNAG BE BB';
if (code >= 875 && code <= 876) return 'VRIJ';
if (code >= 877 && code <= 879) return 'BNAG BE BB';
if (code >= 880 && code <= 889) return 'HBKA BE 22';
if (code >= 890 && code <= 899) return 'VDSP BE 91';
if (code >= 900 && code <= 902) return 'NAP';
if (code >= 903 && code <= 903) return 'COBA BE BB';
if (code >= 904 && code <= 904) return 'VRIJ';
if (code >= 905 && code <= 905) return 'BHBE BE B1';
if (code >= 906 && code <= 906) return 'GOFF BE 22';
if (code >= 907 && code <= 907) return 'SPAA BE 22';
if (code >= 908 && code <= 908) return 'CEKV BE 81';
if (code >= 909 && code <= 909) return 'nav';
if (code >= 910 && code <= 910) return 'HBKA BE 22';
if (code >= 911 && code <= 911) return 'nav';
if (code >= 912 && code <= 912) return 'nav';
if (code >= 913 && code <= 919) return 'VRIJ';
if (code >= 920 && code <= 923) return 'HBKA BE 22';
if (code >= 924 && code <= 924) return 'VRIJ';
if (code >= 925 && code <= 925) return 'HBKA BE 22';
if (code >= 926 && code <= 928) return 'VRIJ';
if (code >= 929 && code <= 939) return 'HBKA BE 22';
if (code >= 940 && code <= 940) return 'CLIQ BE B1';
if (code >= 941 && code <= 941) return 'VRIJ';
if (code >= 942 && code <= 942) return 'PUIL BE BB';
if (code >= 943 && code <= 943) return 'nav';
if (code >= 944 && code <= 944) return 'VRIJ';
if (code >= 945 && code <= 945) return 'JPMG BE BB';
if (code >= 946 && code <= 946) return 'VRIJ';
if (code >= 947 && code <= 947) return 'AARB BE B1';
if (code >= 948 && code <= 948) return 'VRIJ';
if (code >= 949 && code <= 949) return 'HSBC BE BB';
if (code >= 950 && code <= 959) return 'CTBK BE BX';
if (code >= 960 && code <= 960) return 'ABNA BE BR';
if (code >= 961 && code <= 961) return 'HBKA BE 22';
if (code >= 962 && code <= 962) return 'ETHI BE BB';
if (code >= 963 && code <= 963) return 'AXAB BE 22';
if (code >= 964 && code <= 964) return 'NAP';
if (code >= 965 && code <= 965) return 'ETHI BE BB';
if (code >= 966 && code <= 966) return 'NAP';
if (code >= 967 && code <= 967) return 'VRIJ';
if (code >= 968 && code <= 968) return 'ENIB BE BB';
if (code >= 969 && code <= 969) return 'PUIL BE BB';
if (code >= 970 && code <= 971) return 'HBKA BE 22';
if (code >= 972 && code <= 972) return 'NAP';
if (code >= 973 && code <= 973) return 'ARSP BE 22';
if (code >= 974 && code <= 974) return '-';
if (code >= 975 && code <= 975) return 'AXAB BE 22';
if (code >= 976 && code <= 976) return 'HBKA BE 22';
if (code >= 977 && code <= 977) return 'VRIJ';
if (code >= 978 && code <= 980) return 'ARSP BE 22';
if (code >= 981 && code <= 984) return 'PCHQ BE BB';
if (code >= 985 && code <= 988) return 'BPOT BE B1';
if (code >= 989 && code <= 989) return 'nav';
if (code >= 990 && code <= 999) return '';
}

function bankrek2iban(form) {
    var valReknr1 = document.forms[form].elements['reknr1'].value;
    var valReknr2 = document.forms[form].elements['reknr2'].value;
    var valReknr3 = document.forms[form].elements['reknr3'].value;
    var valBIC = bankcode2bic(valReknr1);

    var eersteGetal = valReknr3 + "" + valReknr3 + "111400";
    var modulo97 = eersteGetal%97;
    var controleIBAN = 98-modulo97;
    if (controleIBAN < 10)
      document.forms[form].elements['IBAN'].value = "BE0" + controleIBAN + "" + valReknr1 + "" + valReknr2 + "" + valReknr3;
    else
      document.forms[form].elements['IBAN'].value = "BE" + controleIBAN + "" + valReknr1 + "" + valReknr2 + "" + valReknr3;

    document.forms[form].elements['BIC'].value = valBIC;
}

function iban2bankrek(form) {
  var iban = document.forms[form].elements['IBAN'].value;
  if (iban.substring(0,2) == "BE") {
    document.forms[form].elements['reknr1'].value = iban.substring(4,7);
    document.forms[form].elements['reknr2'].value = iban.substring(7,14);
    var valReknr3 = document.forms[form].elements['reknr3'].value = iban.substring(14,16);
  
    var eersteGetal = valReknr3 + "" + valReknr3 + "111400";
    var modulo97 = eersteGetal%97;
    var controleBerekend = 98-modulo97;
    var controleIngevuld = iban.substring(2,4);
    if (controleBerekend != controleIngevuld) {
      alert("Dit IBAN nummer is niet correct.");
      return false;
    }
    else {
      return true;
    }
  }
  else
    return iban.length > 11;
}

function checkBank (form, veld1, veld2, veld3)

					{

					

         /*

           x = (y*z)

           x = q*97+r

           y = q1*97 + r1

           z = q2*97 + r2

           q*97+r = (q1*97+r1)(q2*97+r2)

                  =  q1*q2*97*97+q1*97*r2+r1*q2*97+r1*r2

         */

         

          veld1 = document.forms[form].elements[veld1].value;

          while (veld1.length > 0 && veld1.charAt(0) == '0') veld1 = veld1.substr(1);

				  deel1 = parseInt(veld1);

				  if (isNaN(deel1)) deel1 = 0;

					rest1 = (deel1%97) * 76;

					

					veld2 =  document.forms[form].elements[veld2].value;

					while (veld2.length > 0 && veld2.charAt(0) == '0') veld2 = veld2.substr(1);

          deel2 = parseInt(veld2);

					rest2 = deel2 % 97;



          rest = (rest1 + rest2)%97;



        //alert(rest1 + " - " + rest2 + "- " + rest);



          if (rest == 0 &&  document.forms[form].elements[veld3].value == 97) {

              return "";

          }

					else if (rest != document.forms[form].elements[veld3].value) {

						//return "- Vul een geldig rekeningnummer in (foutcode " + rest + ")\n";

						  return "- Vul een geldig rekeningnummer in \n";

					}

          else{

						return "";

					}

					

					}





function valideer()

					{

					if (fouten != "")

							{

							fouten = 

							"Voor u deze data kan toevoegen, moet u eerst nog de volgende stappen ondernemen: \n"

							+ fouten;

							alert(fouten);

							return false;

							}

					if (fouten == "")

							{

							return true;

							}

					}

					

function rizivcodeOK(functie, code) {

  if (code==9) return true;

  switch (functie) {

    case 1: return code==1;        // huisarts

    case 2: return code==2;        // apotheker

    case 3: return code==5;        // dietist

    case 51: return code==1;        // psychiater

    case 17: return code==4;        // huisarts

    case 7: return (code==5 || code==6);        // logopedist

    case 59: return(code==5 || code==6);        // logopedist

    case 44: return (code==5 || code==6);        // logopedist 2e lijn

    case 6: return code==5;        // kinesist

    case 31: return code==5;        // kinesist 2e lijn

    case 26: return code==1;        // specialist

    default : return true;

  }

}





					

function checkRiziv(functie, r1, r2, r3, r4) {

    var getal = "" + r1 + r2;

    while (getal.length > 0 && getal.charAt(0) == '0') getal = getal.substr(1);

    var deeltal = parseInt(getal);

    var rest = deeltal%97;

    var controle = 97-rest;

    while (r3.length > 0 && r3.charAt(0) == '0') r3 = r3.substr(1);



    return (parseInt(r3)==controle) && rizivcodeOK(parseInt(functie), parseInt(r1));

}



function $FF(menu) {

  var selectMenu = document.getElementById(menu);

  var index = selectMenu.selectedIndex;

  if (index >= 0) {

    var item = selectMenu.options[index];

    return item.value;

  }

  else {

    return NaN;

  }

}