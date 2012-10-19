<?php
  // stuur een email
  function htmlmail($to, $subject, $content){
    global $gegevens_email_contact;
    $contactmail = $gegevens_email_contact;
    $from  = "LISTEL e-zorgplan";
    if (isset($_SESSION['email']) && !empty($_SESSION['email']) && ($to != "anick.noben@listel.be"))  {
      $frommail = $_SESSION['email'];
      $toFrom = "," . $_SESSION['email'];
    }
    else {
      $frommail = "$gegevens_email_contact";
      $toFrom = "";
    }
    $headers      = "MIME-Version: 1.0\n";
    $headers     .= "Content-type: text/html; charset=iso-8859-1\n";
    $headers     .= "From: ".$from." <".$frommail.">\n";
    $headers     .= "Reply-To: ".$from."<".$frommail.">\r\n";
    $headers     = trim($headers);

    $mailbody     = "<font face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"2\"><br>" . $content . "<br><br></font>";
    $ok = mail($to . $toFrom, $subject, $mailbody, $headers) or print("Ooops, ik kon de mail met kopie ($content) vanwege $frommail niet versturen. contacteer $contactmail");
    return $ok;
  }
  function htmlmailWendy($to, $subject, $content){
    global $gegevens_email_contact;
    $contactmail = $gegevens_email_contact;
    $from  = "LISTEL e-zorgplan";
    $frommail = "Wendy.Coemans@listel.be";

    $headers      = "MIME-Version: 1.0\n";
    $headers     .= "Content-type: text/html; charset=iso-8859-1\n";
    $headers     .= "From: ".$from." <".$frommail.">\n";
    $headers     .= "Reply-To: ".$from."<".$frommail.">\r\n";
    $headers     = trim($headers);

    $content = str_replace("\"", "'", $content);
    $content = stripslashes($content);

    $mailbody     = "<font face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"2\"><br>" . $content . "<br/><br/></font>";
    $ok = mail($to . $toFrom, $subject, $mailbody, $headers) or print("Ooops, ik kon de mail naar Wendy ($content) vanwege $frommail niet versturen. contacteer $contactmail");
    return $ok;
  }



  // stuur een email zonder copy naar verzender

  function htmlmailZonderCopy($to, $subject, $content){

    global $gegevens_email_contact;

    $contactmail = $gegevens_email_contact;

    $from  = "Listel e-zorgplan";

    if (isset($_SESSION['email']) && !empty($_SESSION['email']) && ($to != "anick.noben@listel.be"))  {

      $frommail = $_SESSION['email'];

    }

    else {

      $frommail = "$gegevens_email_contact";

    }

    $headers      = "MIME-Version: 1.0\n";

    $headers     .= "Content-type: text/html; charset=iso-8859-1\n";

    $headers     .= "From: ".$from." <".$frommail.">\n";

    $headers     .= "Reply-To: ".$from."<".$frommail.">\r\n";

    $headers     = trim($headers);



    $mailbody     = "<font face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"2\"><br>" . $content . "<br><br></font>";



    $ok = mail($to, $subject, $mailbody, $headers) or print("Ooops, ik kon de mail ($content) vanwege $frommail niet versturen. contacteer $contactmail");



    return $ok;

  }

?>