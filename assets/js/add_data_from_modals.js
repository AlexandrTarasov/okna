add_enquiry_modal_form.onsubmit = async (e) => {
	e.preventDefault();
	let formData = new FormData(add_enquiry_modal_form);
	formData.append('viber_is', enquery_form.viber);
	formData.append('from_node', 'add_enquiry_modal_form');
	let response = await fetch('/sluice', {
		method: 'POST',
		body: formData
	});
	response.text().then(function (text){
		if( text === '1' ){
			add_enquery_modal_body.innerHTML = '<div class="alert alert-info" role="alert">Запрос добавлен</div>';
		}else{
			back_message_enquery_modal.innerHTML = text;
		}
		console.log(text);
	});
}



add_client_modal_form.onsubmit = async (e) => {
	e.preventDefault();
	let formData = new FormData(add_client_modal_form);
	formData.append('viber_is', client_form.viber);
	formData.append('from_node', 'add_client_modal_form');
	let response = await fetch('/sluice', {
		method: 'POST',
		body: formData
	});
	response.text().then(function (text){
		if( text === '1' ){
			add_client_modal_body.innerHTML = 'Клиент добавлен';
		}else{
			back_message_client_modal.innerHTML = text;
		}
		console.log(text);
	});
}

async function checkPhoneExistance (phone, node ){
	let formData = new FormData();
	formData.append('phone', phone);
	formData.append('from_node', node);
	let response =  await fetch('/sluice', {
		method: 'POST',
		body: formData,
	});

	const contentType = response.headers.get("content-type");
	if (contentType && contentType.indexOf("application/json") !== -1) {
		response.json().then(data => {
			back_message_enquery_modal.innerHTML = '<div class="alert alert-warning" role="alert">Клиент с данным номером уже существует </div>';
			if( node === 'check_if_client_phone_exists' ){
				add_enquiry_modal_form.elements['fio'].value = data.name;
				add_enquiry_modal_form.elements['address'].value = data.address;
				add_enquiry_modal_form.elements['email'].value = data.email;
				add_enquiry_modal_form.elements['client_id'].value = data.id;
				add_enquiry_modal_form.elements['phone_2'].defaultValue = data.phone2;
client_id_input
				shapePhone(add_enquiry_modal_form.elements['phone_2']);
				if (data.viber_is === '1'){
					changeViberState(enquery_viber, 'on');
				}
			}
		});
	} else {
		response.text().then(text => {
			console.log('text'+text);
		});
	}
}


