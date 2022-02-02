<?php
   function corectez($sir)
  {
   $sir = trim($sir);
   $sir = stripslashes($sir);
   $sir = htmlspecialchars($sir);
   return $sir;
  }
  //print_r($_POST);
  
  if (corectez($_FILES["fisiermic"]["error"]) > 0) {
      echo "Error: " . $_FILES["fisiermic"]["error"] . "
"; 
      exit; 
   }
  
   $numeimagine = corectez($_FILES["fisiermic"]["name"]); 
   $poz = strrpos($numeimagine, "."); 
   $extensie = substr ($numeimagine, $poz); 
   $nmtmp = $_FILES["fisiermic"]["tmp_name"]; 
   
   
   
    $img = 'a.png'; // Pentru poze initial folosesc un nume generic (a.png)
   $categoria = corectez($_POST["combo"]); 
   $nume = corectez($_POST["nume"]); 
   $pretul = corectez($_POST["pret"]);
   $descriere = corectez($_POST["descriere"]);
   
   include("conn.php");
 
   $raspuns = [];
   $cda = "INSERT INTO produse (id_categ, denumire, imagine, descriere, pret) VALUES (?, ?, ?, ?, ? )"; //cheia primara e un camp de tip autoincrement
   $stmt = mysqli_prepare($cnx, $cda);
   mysqli_stmt_bind_param($stmt, 'isssd', $categoria, $nume, $img,  $descriere, $pretul);
   mysqli_stmt_execute($stmt);
        
   $id = mysqli_insert_id($cnx);  //  ID-ul ultimului articol introdus
   // Generez un nume dependent de id si transfer fisierul cu imaginea in directorul "meniu"
   $numenou = 'img' . (string)$id.strtolower($extensie);
  
   //  Inlocuiesc numele implicit cu cel real
   $cdaa = "UPDATE produse SET imagine = '" . $numenou . "'  WHERE id_produs = $id";
   mysqli_query($cnx, $cdaa);
   //  Mut fisierele din directorul temporar
   $cale = 'img/meniu/'.$numenou;
   $rezultat = move_uploaded_file($nmtmp, $cale);
    
    $raspuns['mesaj'] ='da';
    $raspuns['nume'] = $nume;
    
    if (!$rezultat)
    {
      die('Eroare la incarcarea fisierului.');
      $raspuns['mesaj'] ='nu';
        $raspuns['nume'] = $nume;
    }
    
    
  
    //  Inchid $stmt si $cnx
    mysqli_stmt_close($stmt);
    mysqli_close($cnx);
      
    
    
   
    
    echo json_encode($raspuns);
   ?>
