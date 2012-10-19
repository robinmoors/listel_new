<?php

print("<h2>sessie-inhoud</h2><ul>");
foreach ($_SESSION as $var => $inhoud) {
  print("<li>$var => $inhoud</li>");
} 
print("</ul><h2>einde sessie</h2>");

print("<h2>post-inhoud</h2><ul>");
foreach ($_POST as $var => $inhoud) {
  print("<li>$var => $inhoud</li>");
} 
print("</ul><h2>einde post</h2>");

print("<h2>GET-inhoud</h2><ul>");
foreach ($_GET as $var => $inhoud) {
  print("<li>$var => $inhoud</li>");
} 
print("</ul><h2>einde GET</h2>");

?>

