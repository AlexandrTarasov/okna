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
			add_enquery_modal_body.innerHTML = 'Запрос добавлен';
		}else{
			back_message_enquery_modal.innerHTML = text;
		}
		console.log(text);
	});
};



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
};



// fetch(myRequest).then(response => {
//   const contentType = response.headers.get("content-type");
//   if (contentType && contentType.indexOf("application/json") !== -1) {
//     return response.json().then(data => {
//       // process your JSON data further
//     });
//   } else {
//     return response.text().then(text => {
//       // this is text, do something with it
//     });
//   }
// });
