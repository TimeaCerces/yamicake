<?php
   session_start();

 
   function corectez($sir) {
   $sir = trim($sir);
   $sir = stripslashes($sir);
   $sir = htmlspecialchars($sir);
   return $sir;
   }

   // preiau valorile din campurile formularului (numeletau, parolata)
   $numele = corectez($_POST["nume"]);
   $parola = corectez($_POST["parola"]);
     
   $parolacriptata = md5($parola);
   
   include("conn.php");
  
   $cda = "SELECT nume, parola FROM util WHERE numele = '$nume' and parola = '$parolacriptata'";

   $raspuns = [];
   $raspuns['nume'] = $nume;
      
   if ($rez=mysqli_query($cnx,$cda)) {
  $rowcount=mysqli_num_rows($rez);
    
  if ($rowcount != 0) {
      $raspuns['autentificat'] = 'da';
      $_SESSION['conectat'] = true;
  } else {
     $raspuns['autentificat'] = 'nu';
      }
   }
     
   echo json_encode($raspuns);
?>
