function appear(){
	ptr1 = document.getElementById("choice");
	ptr2 = document.getElementById("Item");
	ptr3 = document.getElementById("Rating");
	if (ptr1.value == "Carving" || ptr1.value == "Entree"){
		ptr2.style.display = "block";
		ptr3.style.display = "block";
	}
	else if(ptr1.value == ""){
		ptr2.style.display = "none"	;
		ptr3.style.display = "none"	;
	}
}

function checkPasswordMatch() {
    var password = $("#password").val();
    var confirmPassword = $("#password2").val();
		ptr1 = document.getElementById("PasswordCheck");
		ptr2 = document.getElementById("password");
		ptr3 = document.getElementById("password2");	
	
    if (password != confirmPassword) {
      $("#PasswordCheck").html("Passwords do not match!");
			ptr1.style.borderColor = "red";
			ptr2.style.borderColor = "red";
			ptr3.style.borderColor = "red";
		} else {
      $("#PasswordCheck").html("Passwords match.");
			ptr1.style.borderColor = "green";
			ptr2.style.borderColor = "green";
			ptr3.style.borderColor = "green";
		}
}