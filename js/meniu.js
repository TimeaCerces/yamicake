 window.onload = function() {
 
    var formData = new FormData(); 
    formData.append('categorie', 1); 

    var request = new XMLHttpRequest();
    request.open("POST", "meniu.php");  
  
    //  Am primit date
    request.onload = function() {  
    var sirObj = JSON.parse(this.responseText);  //  Sir de obiecte
   
    //  O macheta pentru adaugarea unui obiect in bloc
   
    var macheta = '<div class="shadow-lg p-3 mb-5 bg-white rounded single-menu-product mb-30"><div class="menu-product-img"><img src="img/meniu/{imagine}" id="{id_produs}" /></div><div class="menu-product-content"><div class="menu-title-price"><div class="menu-title"><h4>{denumire}</h4></div><div class="menu-price"><span>{pret} lei</span></div></div><p class="descriere">Descriere:</p><p> {descriere}</p></div></div>';
    continut = "";  //  Sir vid

    sirObj.forEach(function(item) {
      //  Inlocuiesc in macheta valorile primite si adaug rezultatul in "continut"

      continut += macheta.replace('{imagine}', item.imagine)            
                         .replace('{denumire}', item.denumire)
                         .replace('{descriere}', item.descriere)
                         .replace('{pret}', item.pret)
            
    });
    document.querySelector("#afiseaza_meniu").innerHTML = continut;  
  };
      
    // S-a produs o eroare
    request.onerror = function() {
        alert('Hopa! Ceva n-a mers!');
    };

    request.send(formData);
};
