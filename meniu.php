 <?php
  include ("conn.php");  
  // preiau categoria
  $categ = $_POST['categorie']; 
  $articole = [];  //  Un sir vid
  $cda= "SELECT id_produs,  denumire, imagine, descriere, pret FROM produse WHERE id_categ = $categ";
  
  if ($rez=mysqli_query($cnx,$cda)) {
    // Se preiau liniile pe rand
    while ($linie = mysqli_fetch_assoc($rez)) {
      $articole[] = $linie;
    }
  }
  /* Eliberez memoria ocupata de multimea de selectie */
  mysqli_free_result($rez);

  /* Inchid conexiunea cu serverul MySQL */
  mysqli_close($cnx);
  echo json_encode($articole);
?>