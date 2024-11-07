<?php

session_start(); 
session_unset();
session_destroy(); // destroy session
  echo "<script type = \"text/javascript\">
  window.location = (\"index.html\");
  </script>";
  
  ?>