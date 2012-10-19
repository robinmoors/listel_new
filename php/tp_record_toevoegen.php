<?php

session_start();

   require("../includes/dbconnect2.inc");
   require("../includes/clearSessie.inc");



$qryStopgezetteTP = "select patient_tp.id, code from patient, patient_tp

                  where code = patient

                  and patient.einddatum = patient_tp.einddatum";

//74

$result = mysql_query($qryStopgezetteTP);

for ($i=0; $i < mysql_num_rows($result); $i++) {

  $rij = mysql_fetch_assoc($result);

  mysql_query("update patient set tp_record = {$rij['id']} where code = '{$rij['code']}'");

}

                  

$qryActieveTP = "select patient_tp.id, code from patient, patient_tp

                  where code = patient

                  and patient_tp.einddatum is NULL";

//364

$result = mysql_query($qryActieveTP);

for ($i=0; $i < mysql_num_rows($result); $i++) {

  $rij = mysql_fetch_assoc($result);

  mysql_query("update patient set tp_record = {$rij['id']} where code = '{$rij['code']}'");

}





$qrySpeciale = "select id,code from patient_tp where code in (

'04/HO-07-670107-B','06/HA-07-671112-H','07/GE-07-700609-L','07/GE-07-740612-T',

'07/GE-07-800828-P','07/GE-07-871107-M','10/SI-07-370303-V'

)";

$result = mysql_query($qrySpeciale);

for ($i=0; $i < mysql_num_rows($result); $i++) {

  $rij = mysql_fetch_assoc($result);

  mysql_query("update patient set tp_record = {$rij['id']} where code = '{$rij['code']}'");

}







/* niet goed

select *¨from patient_tp where id not in (select patient_tp.id from patient, patient_tp

                  where code = patient

                  and patient.einddatum = patient_tp.einddatum) and id not in (select patient_tp.id from patient, patient_tp

                  where code = patient

                  and patient_tp.einddatum is NULL)



dit zijn er idd 19

En nu kijken of die in een ander TP zitten



select * from patient_tp where patient in

(

select patient from patient_tp where id not in (select patient_tp.id from patient, patient_tp

                  where code = patient

                  and patient.einddatum = patient_tp.einddatum) and id not in (select patient_tp.id from patient, patient_tp

                  where code = patient

                  and patient_tp.einddatum is NULL)

)

order by patient

limit 0,50



dit zijn



*/





      print("</div>");

      print("</div>");

      print("</div>");

      require("../includes/dbclose.inc");

      require("../includes/footer.inc");

      print("</div>");

      print("</div>");

      print("</body>");

      print("</html>");



//---------------------------------------------------------

/* Sluit Dbconnectie */ require("../includes/dbclose.inc");

//---------------------------------------------------------

?>