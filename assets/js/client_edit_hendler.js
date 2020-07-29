if( null !== document.getElementById("client_phone_1") ){
	shapePhone(client_phone_1);
	client_viber1_id.onclick=()=>changeViber(client_viber1_id);
	client_phone_1.addEventListener("input", function(event){
		makePhoneNumber(event, client_phone_1);
	});
}

if( null !== document.getElementById("client_phone_2")){
	shapePhone(client_phone_2);
	client_viber2_id.onclick=()=>changeViber(client_viber2_id);
	client_phone_2.addEventListener("input", function(event){
		makePhoneNumber(event, client_phone_2);
	});
}
