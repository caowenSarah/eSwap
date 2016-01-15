"use strict"
// the number of the items that should be skipped
var num_skip = 6;

// the number of the items that should be queried
var num_sql = 6;

var idx = 0;

function gebi(objId){
	return document.getElementById(objId);
}

// show the result of the AJAX request as the new content
// of each column
function on_success_more(request) {
	var obj = JSON.parse(request.responseText);
	gebi("first_col").innerHTML = obj.left;
	gebi("sec_col").innerHTML = obj.right;
}

// add an error message when ajax request fails
function on_failure(request) {
	console.log("Load failure!");
}

function get_data(){
	if (idx >= 5) {
		num_skip = 0;
		idx = 0;
	};
	new SimpleAjax('php/more.php', 'GET', 'skip='+num_skip+'&number='+num_sql+'&cat=&is_idx_page=1', on_success_more, on_failure);
	num_skip += num_sql;
	idx++;
}

function init(){
	setInterval(get_data, 5000);
}
window.onload = init;