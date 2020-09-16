let client = {
	id: id.value,
	name :'',
	phone:'',
	phone2: '',
	address: '',
	comment: '',
	email: '',
	viber_is : 0,
};

client_viber_id.onclick=(e)=>{
	let cl_viber_icon = clickOnViberIcon(e);
	if( typeof cl_viber_icon === 'object' ){
		if(client.viber_is == 0){
			changeViberState(cl_viber_icon, 'on');
			client.viber_is = 1;
			let resp = goSluice(client.id, client.viber_is, 'client_update_viber_is');
		} else{
			changeViberState(cl_viber_icon, 'off');
			client.viber_is = 0;
			goSluice(client.id, client.viber_is, 'client_update_viber_is');
		}
	}
}

if( null !== document.getElementById("client_phone_1") ){
	shapePhone(client_phone_1);
	client_phone_1.addEventListener("input", function(event){
		makePhoneNumber(event, client_phone_1);
	});
}

shapePhone(client_phone_2);
client_phone_2.addEventListener("input", function(event){
	makePhoneNumber(event, client_phone_2);
});

name_input.oninput=(e)=>{
	client.name = name_input.value;
	let res = goSluice(client.id, client.name, 'client_update_name');
	responseHendler(res, name_input);
}

address_input.oninput=(e)=>{
	client.address = address_input.value;
	let res = goSluice(client.id, client.address, 'client_update_address');
	responseHendler(res, address_input);
}


client_phone_1.oninput=(e)=>{
	client.phone = client_phone_1.value;
	let res = goSluice(client.id, client.phone, 'client_update_phone');
	responseHendler(res, client_phone_1);
}



client_phone_2.oninput=(e)=>{
	client.phone2 = client_phone_2.value;
	let res = goSluice(client.id, client.phone2, 'client_update_phone2');
	responseHendler(res, client_phone_2);
}


email_input.oninput=(e)=>{
	client.email = email_input.value;
	let res = goSluice(client.id, client.email, 'client_update_email');
	responseHendler(res, email_input);
}


comment_input.oninput=(e)=>{
	client.comment = comment_input.value;
	let res = goSluice(client.id, client.comment, 'client_update_comment');
	responseHendler(res, comment_input);
}


function responseHendler(res, node)
{
	res.then(data => {
		data.text().then( function(text) {
			if( text == '1' ){
				showSavedCase(node);
			}
			else{ 
				console.log('Resp:'+text); 
			}
		})
	}).catch(err => {
		console.error('Error: ', err);
	})
}

