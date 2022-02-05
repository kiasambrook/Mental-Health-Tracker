// JavaScript Document
function checkPassword(form){
	password = form.password.value;
	password2 = form.password2.value;
	
	//no password entered
	if (password == "")
		alert("Please Enter a Password");
	
	//check if password2 entered
	else if (password2 == "")
		alert("Please Enter Confirm Password");
	
	//If not same
	else if (password != password2){
		alert("\nPasswords did not match. Please try again")
		return false;
	}
	else
		return true;
}