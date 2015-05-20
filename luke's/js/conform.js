function contact_form() {
	var name = $("#contact_form #name").val();
	var email = $("#contact_form #email").val();
	var phone = $("#contact_form #phone").val();
	var message = $("#contact_form #message").val();
	if (name==null || name=="") {
        alert("Make sure you write your full name!");
    }
	else if (email==null || email=="") {
        alert("Make sure you write your email!");
    }
    else if (message==null || message=="") {
        alert("Make sure you write a message!");
    }
    else{    	
        $.ajax({
          url: "ajax/contact.php",
          type: "POST",
          headers:{
            OpenAuth:"VerySecretToken"
          },
          data: {
            controller: "contact_form",
            name : name,
            email: email,
            phone: phone,
            message: message
          },
          dataType: "html"
        }).done(function(res) {           
          alert("Thank you for submitting your message!");
          $("#contact_form").get(0).reset();
        }).fail(function(res) {            
           var response = JSON.parse(res.responseText);
           var errorText = "";
           for (var i = response.length - 1; i >= 0; i--) {
               errorText+= response[i].cause+"\n";
           };
           alert(errorText);
        });
    }
    return false;
}
