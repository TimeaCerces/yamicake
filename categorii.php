 <?php

    include("conn.php");

     $raspuns = [];

   $cda = "SELECT id_categ, categoria FROM categorii";

      if ($rez=mysqli_query($cnx,$cda)) {
       // Se preiau liniile pe rand
        while ($linie = mysqli_fetch_assoc($rez)) {

       $raspuns[] = $linie;
       
      }
    }

  // Eliberez memoria ocupata de multimea de selectie
  mysqli_free_result($rez);

  // Inchid conexiunea cu serverul MySQL
   mysqli_close($cnx);
  echo json_encode($raspuns);
?>