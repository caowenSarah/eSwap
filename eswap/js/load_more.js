"use strict"
// the category string
var cat = "";

// the number of the items that should be skipped
var num_skip = 6;

// the number of the items that should be queried
var num_sql = 6;

// the boolean variable that shows whether the category item is clicked
var cat_is_click = false;

function gebi(objId){
	return document.getElementById(objId);
}

// add an error message when ajax request fails
function on_failure(request) {
	console.log("Load failure!");
}

// show the result of the AJAX request as the new content
// of each column when category is clicked
function on_success_cat(request) {
	var obj = JSON.parse(request.responseText);
	gebi("left_col").innerHTML = obj.left;
	gebi("mid_col").innerHTML = obj.middle;
	gebi("right_col").innerHTML = obj.right;	
}

// add the result of the AJAX request as the new content
// of each column when loading more content
function on_success_more(request) {
	var obj = JSON.parse(request.responseText);
	gebi("left_col").innerHTML += obj.left;
	gebi("mid_col").innerHTML += obj.middle;
	gebi("right_col").innerHTML += obj.right;	
}

// do the AJAX request to get more content
function load_more(){
	new SimpleAjax('php/more.php', 'GET', 'skip='+num_skip+'&number='+num_sql+'&cat='+cat+'&is_idx_page=0', on_success_more, on_failure);
	num_skip += num_sql;
}

// do the AJAX request to show the content according to the category
function cat_click(obj){
	if (!cat_is_click) {
		cat_is_click = true;
	};
	if (cat != obj.id) {
		num_skip = 0;
	};
	new SimpleAjax('php/more.php', 'GET', 'skip='+num_skip+'&number='+num_sql+'&cat='+obj.id+'&is_idx_page=0', on_success_cat, on_failure);
	num_skip += num_sql;
	cat = obj.id;
}

// function show_list(objId){
// 	gebi(objId).style.visibility = 'visible';
// }

// function hide_list(objId){
// 	gebi(objId).style.visibility = 'hidden';
// }

// make all the elements with id 'more' and all the elements 
// with class 'cat_item' clickable
function init(){
	gebi("more").onclick = load_more;
	var cats = document.getElementsByClassName("cat_item");
	for (var i = 0; i < cats.length; i++) {
		cats[i].onclick = function(){
			cat_click(this);
		}
	};
	
	// gebi("user_name").onmouseover = function(){
	// 	show_list("user_nav");
	// }
	// gebi("user_name").onmouseout = function(){
	// 	hide_list("user_nav");
	// }
}
window.onload = init;