function gebi(objId){
	return document.getElementById(objId);
}

function show_list(objId){
	gebi(objId).style.visibility = 'visible';
}

function hide_list(objId){
	gebi(objId).style.visibility = 'hidden';
}
