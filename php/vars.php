<?php
   session_start();
   $paginanaam="Vars";
      require("../includes/html_html.inc");
      print("<head>\n");
      require("../includes/html_head.inc");
      print("<script>\nfunction redirect()\n{document.location = \"vars.php\";}\nsetInterval(\"redirect()\",20000);\n</script>\n");
      print("</head>\n");
      print("<body>\n");
      foreach ($_POST as $index => $value)
         {
         if (isSet($_POST[$index])&&($_POST[$index]!=""))
            {
            $_SESSION[$index]=$_POST[$index];
//          print("In ".$index." staat ".$value."<br />\n");
            }
         }
         print("<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\n<tr>");
      foreach ($_SESSION as $index => $value)
         {
         print("<tr><td align=\"right\">".$index."--</td><td>".$value."</td></tr>\n");
         }
         print("<table border=\"0\">\n");
      print("</body>");
      print("</html>");
?>
