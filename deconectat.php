<?php
     session_start();
     $_SESSION = array();  //  S-a distrus sirul asociativ $_SESSION
     session_destroy();  //  S-a distrus sesiunea
     header('Location: http://localhost/yamicake/');  
   ?>