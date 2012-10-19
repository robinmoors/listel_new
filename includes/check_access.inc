<?php
   if (!IsSet($_SESSION["toegang"])||($_SESSION["toegang"]!="toegestaan"))
      {

//---------------------------------------------------------------
/* Open Empty Html */ include('../includes/open_empty_html.inc');
//---------------------------------------------------------------

      print("
         Toegang geweigerd
         <script>
         function redirect()
            {
            document.location = \"..\";
            }
         setTimeout(\"redirect()\",5000);
         </script>");

//-----------------------------------------------------------------
/* Close Empty Html */ include('../includes/close_empty_html.inc');
//-----------------------------------------------------------------

      }
	
?>
