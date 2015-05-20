function alertForm() {
    var name = document.forms["fcon"]["fname"].value;
    var phone = document.forms["fcon"]["fphone"].value;
    var option = document.forms["fcon"]["foption"].value;
    var controller = document.forms["fcon"]["fform"].value;
    if (controller==null || controller=="") {
        return false;
    }
    if (name==null || name=="") {
        alert("Make sure you write your full name!");
    }
	else if (phone==null || phone=="") {
        alert("Make sure you write your phone number!");
    }
    else if (option==null || option=="" || option == -1) {
        alert("Make sure you select a valid option!");
    }
    else{
    	
        $.ajax({
          url: "ajax/main.php",
          type: "POST",
          headers:{
            OpenAuth:"mAi8WeZuMRUnY3XhTEl9JAta4h7HcRYz1c8KqUROOGSFlIjLX"
          },
          data: {
            controller: controller,
            name : name,
            phone: phone,
            option: option
          },
          dataType: "html"
        }).done(function(res) {            
          alert("Thank you for submitting a Free Consultation!");
	        $('#target').get(0).reset();
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
