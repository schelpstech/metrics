
// update biodata
function bioinsert() {
    var fname = document.getElementById("firstname").value;
    var oname = document.getElementById("othername").value;
    var lname = document.getElementById("lastname").value;
    var gender = document.getElementById("gender").value;
    var  dob = document.getElementById("dateofbirth").value;
    if (fname !== ""){
        if(oname !== ""){
           if (lname !== ""){
            if (gender !== ""){
                if (dob !== ""){
    $.ajax({
        url:'../backend/recordbiodata.php',
        method:'POST',
        data:{
            firstname:fname,
            othername:oname,
            lastname:lname,
            gender:gender,
            dob:dob
        },
       success:function(data){
           
           $("#feedback").html(data);
          
       }
    });

}
else{
    alert("Enter correct date of birth");
   
}
}
else{
    alert("Select Gender");
   
}
}
else{
    alert("Last name is required");
   
}
}
else{
    alert("Other name is required");
   
}
}
else{
    alert("First name is required");
   
}
}

// modify contact information
function contactinsert() {
    var emailadd = document.getElementById("emailadd").value;
    var phonenum = document.getElementById("phonenum").value;
    var fulladd = document.getElementById("fullad").value;
    var country = document.getElementById("country").value;
    var  state = document.getElementById("state").value;
    var  lga = document.getElementById("lga").value;
    if (emailadd !== ""){
        if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(emailadd)){
        if(phonenum !== ""){
           if (fulladd !== ""){
            if (country !== ""){
                if (state !== ""){
                 if (lga !== ""){
    $.ajax({
        url:'../backend/recordcontact.php',
        method:'POST',
        data:{
            email : emailadd,
            phone:phonenum,
            fulladd:fulladd,
            country:country,
            state:state,
            lga:lga
        },
       success:function(data){
           
           $("#feedback").html(data);
          
       }
    });

}
else{
    alert("Select the local government area of your residence");
   
}
}
else{
    alert("Select your state of residence");
   
}
}
else{
    alert("Select your country of residence");
   
}
}
else{
    alert("Enter your full address");
   
}
}
else{
    alert("Phone number is required");
   
}


}
else{
    alert("invalid email address. A valid email address is required");
   
}
}
else{
    alert("Valid email address is required");
   
}
}


//get lga based on state selected

function getlgaval() {
    var stateval = $("#state").val();
        
	$.ajax({          
        	type: "GET",
        	url: "../backend/getlga.php",
        	data:'stateid='+stateval,
        	success: function(data){
           
                $("#lga").html(data);
              
        	}
	});
}



// Significant Other insert and update

function significantinsert() {
    var fullname = document.getElementById("fullname").value;
    var relationship = document.getElementById("relationship").value;
    var address = document.getElementById("address").value;
    var signphone = document.getElementById("signphone").value;
   
    if (fullname !== ""){
      if(relationship !== ""){
           if (address !== ""){
            if (signphone !== ""){
    $.ajax({
        url:'../backend/recordsign.php',
        method:'POST',
        data:{
            fullname:fullname,
            relationship:relationship,
            address:address,
            signphone:signphone
        },
       success:function(data){
           
           $("#feedback").html(data);
          
       }
    });

}
else{
    alert("Enter Phone number of your significant other");
   
}
}
else{
    alert("Enter Full Address of your significant other");
    
   
}
}
else{
    alert("Select your relationship with the provided significant other");
   
}
}
else{
    alert("Enter fullname of significant other");
   
}



}


// Withdrawal Account  insert and update

function acctinsert() {
  
    var num = document.getElementById("acctnum").value;
    var acctname = document.getElementById("acctname").value;
    var bank = document.getElementById("bank").value;
   var stand = 10;
    if(num.length == stand){
      if(num !== ""){
           if (acctname !== ""){
            if (bank !== ""){
    $.ajax({
        url:'../backend/recordacct.php',
        method:'POST',
        data:{
            
            acctnum:num,
            acct:acctname,
            bank:bank
        },
       success:function(data){
           
           $("#feedback").html(data);
          
       }
    });

}
else{
    alert("Enter bank name");
   
}
}
else{
    alert("Enter account name");
    
   
}
}
else{
    alert("Enter Account number");
   
}
}
else{
    alert("Incorrect account number! Enter correct account number");
   
}



}


function calculator(){
    var period = document.getElementById("duration").value;
    var item = document.getElementById("slots").value;
    var amount = item * 1000;
    var charges = item * 20;
    var pay = amount + charges;
    var rate = 1+(0.40*(period/12));
    var roi = rate * amount;

    $("#amountval").val(amount);
   $("#chargesval").val(charges);
    $("#payval").val(pay);
    $("#rate").val(rate);
    $("#returns").val(roi);
}


