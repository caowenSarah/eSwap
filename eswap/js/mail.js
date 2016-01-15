"use strict"
// initialize the variables
var visitor_email = "";
var visitor_name = "";
var proposer_email = "";
var proposer_name = "";
var msg = "";

function gebi(objId){
	return document.getElementById(objId);
}

// add an error message when ajax request fails
function on_failure(request) {
	console.log("AJAX failure!");
}

// show the result of the AJAX request
function on_success_mail(request) {
	var response = request.responseText;
	if (response == 1) {
		alert("Message has been sent.");
		window.location.href = "/eSwap/home.php";
	}else{
		alert(response);
	};
}

// do the AJAX request to mail
function mail(){
	visitor_email = gebi("visitor_email").value;
	visitor_name = gebi("visitor_name").value;
	proposer_email = gebi("proposer_email").value;
	proposer_name =gebi("proposer_name").value;
	msg = gebi("msg").value;

	new SimpleAjax('php/mail.php', 
		'POST', 
		'visitor_email='+visitor_email+'&visitor_name='+visitor_name+'&proposer_email='+proposer_email+'&proposer_name='+proposer_name+'&msg='+msg, 
		on_success_mail, 
		on_failure);
}

// make the form button with id 'submit' clickable
function init(){
	gebi("submit").onclick = mail;
}
window.onload = init;