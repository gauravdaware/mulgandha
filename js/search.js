function get_search_list(search_str){
			/*ajax code starts here*/
	var obj;
	if (window.XMLHttpRequest){
	// code for modern browsers
	obj = new XMLHttpRequest();
	} 
	else{
	// code for IE6, IE5
	obj = new ActiveXObject("Microsoft.XMLHTTP");
	}
	obj.onreadystatechange = function(){if (this.readyState == 4) {document.getElementById("result").innerHTML = this.responseText;}};
	obj.open("GET", "search_product.php?sstr="+search_str, true);// true is for asynchronus and false synchronus
	obj.send();
/*ajax code ends*/
}