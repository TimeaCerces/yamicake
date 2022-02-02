<?php
    session_start();
  
    if (isset($_SESSION['conectat']) && $_SESSION['conectat'] == true)
      echo "da";
   else
     echo "nu";
?>