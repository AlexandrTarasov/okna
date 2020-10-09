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
			add_enquery_modal_body.innerHTML = '<div class="alert alert-info" role="alert">Лид добавлен</div>';
			setTimeout(function(){ location.reload(); }, 1500);
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


add_supplier_modal.onsubmit = async (e) => {
	e.preventDefault();
	let formData = new FormData(add_supplier_modal_form);
	formData.append('viber_is', supplier_form.viber);
	formData.append('from_node', 'add_supplier_modal_form');
	let response = await fetch('/sluice', {
		method: 'POST',
		body: formData
	});
	response.text().then(function (text){
		if( text === '1' ){
			add_supplier_modal_body.innerHTML = '<div class="alert alert-info" role="alert">Поставищик добавлен</div>';
		}else{
			back_message_supplier_modal.innerHTML = text;
		}
		console.log(text);
	});
}


async function checkNameExistance(fio, node){
	let formData = new FormData();
	formData.append('fio', fio);
	formData.append('from_node', node);
	let response =  await fetch('/sluice', {
		method: 'POST',
		body: formData,
	});
	let one_client_line = '<ul>';
	let usable_phone = '';

	response.json().then(data => { 
		if('number' == typeof data){ 
			client_suggestions_dropdown.innerHTML = '';
			client_suggestions_dropdown.style.display = 'none';
			return;
		}
		for (client of data) {
			if( client.phone ){
				let p_1 = client.phone.slice(2, 5);
				let p_2 = client.phone.slice(5, 8);
				let p_3 = client.phone.slice(8, 10);
				let p_4 = client.phone.slice(10, 12);
				usable_phone = '(' + p_1 + ')-' + p_2 + '-' + p_3 + '-' + p_4 ;
			}
			one_client_line += '<li><span style="color:blue;" onclick="insertCientData(\''+ client.id +'\',\'' + client.name +'\', \'' + usable_phone+'\', \''+ client.address +'\')"> '+ client.name +'</span> | '+ usable_phone +' | '+ client.address +'</li>';
		} 
		one_client_line +='</ul>';

		client_suggestions_dropdown.style.display = '';
		client_suggestions_dropdown.innerHTML = one_client_line;
	});
}

function insertCientData(id, name, phone, address)
{
	fio_enquery_input.value = name;
	client_id_input.value = id;
	phone_1_enquery_form.value = phone;
	enquery_address_input.value = address;
	client_suggestions_dropdown.style.display = 'none';

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
	if (contentType && contentType.indexOf("application/json") !== -1) { //if info about phone exists get Json otherwise get str '0'
		response.json().then(data => {
			if( node === 'enquery_phone_exists' ){
				back_message_enquery_modal.innerHTML = '<div class="alert alert-warning" role="alert">Клиент с данным номером уже существует </div>';
				add_enquiry_modal_form.elements['fio'].value = data.name;
				add_enquiry_modal_form.elements['address'].value = data.address;
				add_enquiry_modal_form.elements['email'].value = data.email;
				add_enquiry_modal_form.elements['client_id'].value = data.id;
				add_enquiry_modal_form.elements['phone_2'].defaultValue = data.phone2;
				shapePhone(add_enquiry_modal_form.elements['phone_2']);
				if (data.viber_is === '1'){
					changeViberState(enquery_viber, 'on');
				}
			}
			else if ( node === 'client_phone_exists' ){
				back_message_client_modal.innerHTML = '<div class="alert alert-danger" role="alert">Клиент с данным номером уже существует </div>';
				add_client_modal_form.elements['fio'].value = data.name;
				add_client_button.disabled = true; 
			}
		});
	} else {
		back_message_enquery_modal.innerHTML = '';
		back_message_client_modal.innerHTML = '';
		add_client_modal_form.elements['fio'].value = '';
		add_client_button.disabled = false;
		response.text().then(text => {
			console.log('text'+text);
		});
	}
}


