
function checkpin() {
var pina = document.getElementById("investpin").value;
var pinb = document.getElementById("investpinb").value;

if (pina!==pinb){
    alert("Password do not match");
    $("#investpinb").val("");
}
}



function checkpinlength() {
    var pina = document.getElementById("investpin").value;
   var passw = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,20}$/;
  if(pina.match(passw)){
  }
    else{
        alert("Password must be between 8 - 20 characters which contain at least one numeric digit, one uppercase and one lowercase letter ");
        $("#investpin").val("");
    }
       
    }
    

   