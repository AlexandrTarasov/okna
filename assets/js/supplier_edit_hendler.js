if( null !== document.getElementById("supplier_phone_1")){
	shapePhone(supplier_phone_1);
	supplier_viber1_id.onclick=()=>changeViber(supplier_viber1_id);
	supplier_phone_1.addEventListener("input", function(event){
		save_phone = makePhoneNumber(event, supplier_phone_1);
		if(save_phone){
			let res = goSluice(supplier_id, supplier_phone_1.value, 'supplier_phone_1');
			res.then(data => {
				data.text().then(function(text) {
					console.log(text);
					if( text == '1' ){
						supplier_phone_1.style.color = 'green';
						alert('Телефон сохранён');
					}
				})
			});
		}
	});
}

if( null !== document.getElementById("supplier_phone_2")){
	shapePhone(supplier_phone_2);
	supplier_viber2_id.onclick=()=>changeViber(supplier_viber2_id);
	supplier_phone_2.addEventListener("input", function(event){
		makePhoneNumber(event, supplier_phone_2);
	});
}


