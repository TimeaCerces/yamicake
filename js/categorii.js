 document.querySelector("body").onload = function () {
   var request = new XMLHttpRequest();
   request.open("POST", "conectat.php");  

//  Am primit date
request.onload = function() {  
  if (this.responseText == "nu") {
    window.location.href = "login.html";
  }
};

// S-a produs o eroare
request.onerror = function () {
  alert('Hopa! Ceva n-a mers!');
};

request.send();


var xhtp = new XMLHttpRequest();
xhtp.open("GET", "categorii.php");

var lista = '<option value="0">(Alegeți din meniu)</option>'; 
        // lista va contine in final elementele <option>
        
      //  Construiesc prototipul unui element <option>
      var prototip = '<option value={id_categ}>{categoria}</option>';
      
        // S-au primit date de la scriptul de pe server
        xhtp.onload = function () {

         var sirobiecte = JSON.parse(this.responseText);

           var combo = document.querySelector("#combo");  // elemente <select>
           sirobiecte.forEach(function(cat) {

            var rind = prototip.replace('{id_categ}', cat.id_categ);
            
            rind = rind.replace('{categoria}', cat.categoria);
        // console.log(cat.id_categ+" " + cat.categoria);
        lista += rind;
      });
           combo.innerHTML = lista;
         };

    // S-a produs o eroare
    xhtp.onerror = function () {
      alert('Hopa! Ceva n-a mers!');
    };

    xhtp.send();
  };