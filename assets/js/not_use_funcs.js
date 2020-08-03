// button up start
(function() {
	'use strict';
	function trackScroll() {
		var scrolled = window.pageYOffset;
		var coords = document.documentElement.clientHeight;
		if (scrolled > 200) {
			goTopBtn.classList.add('back_to_top-show');
			top_cart_elem.classList.add('top-card-scrolled');
		}
		if (scrolled < 200) {
			goTopBtn.classList.remove('back_to_top-show');
			top_cart_elem.classList.remove('top-card-scrolled');
		}
	}
	function backToTop() {
		if (window.pageYOffset > 0) {
			window.scrollBy(0, -80);
			setTimeout(backToTop, 0);
		}
	}

	let goTopBtn = document.querySelector('.back_to_top');
	let top_cart_elem = document.getElementById('checkout').children['0'];
	console.log(top_cart_elem);

	window.addEventListener('scroll', trackScroll);
	goTopBtn.addEventListener('click', backToTop);
})();
// end button up 



function goSluise(value, from_node){
	console.log(value);
	let path = "ajax_sluice";
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "/" + path, false);
	xhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	xhttp.send(value+'&from_node='+from_node); 
	if (xhttp.status == 200 && xhttp.readyState == 4){
		return xhttp.responseText;
	}
	else{
		alert("no response from sluise");
	}
}


function showSearchbar(node){

	let parent = node.parentNode.parentNode;
	if(parent.children['0'].style.display != 'none' ){
		parent.children['0'].style.display = 'none';
		parent.children['1'].style.display = 'flex';
	}else{
		parent.children['0'].style.display = 'flex';
		parent.children['1'].style.display = 'none';
	}
}

function openCat(){
	let menu_block = document.getElementById('menu_side');
	if( menu_block ){
		menu_block.style.display = 'block';
		window.scrollTo(0, 310);
	}else{
		let cat_link = document.getElementById('cat_id');
		if( cat_link){
			console.log(cat_link);
			location.replace(cat_link.href); 
		}else{
			location.replace('/'); 
		}
	}

}
