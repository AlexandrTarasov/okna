let order = {
	status :'',
	id:order_id.innerText,
	measure_date:'',
	removal_date:'',
	delivery_time: '',
	readiness_date: '',
	calculation_link: '',
	manager_id: '',
	supplier_id: '',
	address: '',
	installer_id: '',
	gauger_id: '', 
	square_meters: '',
	calculation_number: '',
	contract_number: '',
	vendor_number: '',
	total_price: '',
	montage_price:'',
	additional_price:'',
	measuring_price:'',
	gazda_price:'',
	balance:'',
	comment:'',
}

let client ={
	id:client_id.value,
	comment:'',
}

measurement_date_input.oninput=(e)=>{
	order.measure_date = measurement_date_input.value;
	let res = goSluice(order.id, order.measure_date, 'order_update_measurement_date');
	responseHendler(res, measurement_date_input);
}

removal_date_input.oninput=(e)=>{
	order.removal_date = removal_date_input.value;
	let res = goSluice(order.id, order.removal_date, 'order_update_removal_date');
	responseHendler(res, removal_date_input);
}

delivery_time_input.oninput=(e)=>{
	order.delivery_time = delivery_time_input.value;
	let res = goSluice(order.id, order.delivery_time, 'order_update_delivery_time');
	responseHendler(res, delivery_time_input);
}

readiness_date_input.oninput=(e)=>{
	order.readiness_date = readiness_date_input.value;
	let res = goSluice(order.id, order.readiness_date, 'order_update_readiness_date');
	responseHendler(res, readiness_date_input);
}

montage_date_input.oninput=(e)=>{
	order.montage_date = montage_date_input.value;
	let res = goSluice(order.id, order.montage_date, 'order_update_montage_date');
	responseHendler(res, montage_date_input);
}

calculation_link_input.oninput=(e)=>{
	order.calculation_link = calculation_link_input.value;
	let res = goSluice(order.id, order.calculation_link, 'order_update_calculation_link');
	responseHendler(res, calculation_link_input);
}

manager_select.oninput=(e)=>{
	order.manager_id = manager_select.options[manager_select.selectedIndex].value;
	console.log(order.manager_id);
	let res = goSluice(order.id, order.manager_id, 'order_update_manager_id');
	responseHendler(res, manager_select);
}

supplier_select.oninput=(e)=>{
	order.supplier_id = supplier_select.options[supplier_select.selectedIndex].value;
	console.log(order.supplier_id);
	let res = goSluice(order.id, order.supplier_id, 'order_update_supplier_id');
	responseHendler(res, supplier_select);
}

address_input.oninput=(e)=>{
	order.address = address_input.value;
	let res = goSluice(order.id, order.address, 'order_update_address');
	responseHendler(res, address_input);
}

installer_select.oninput=(e)=>{
	order.installer_id = installer_select.options[installer_select.selectedIndex].value;
	console.log(order.installer_id);
	let res = goSluice(order.id, order.installer_id, 'order_update_installer_id');
	responseHendler(res, installer_select);
}

gauger_select.oninput=(e)=>{
	order.gauger_id = gauger_select.options[gauger_select.selectedIndex].value;
	console.log(order.gauger_id);
	let res = goSluice(order.id, order.gauger_id, 'order_update_gauger_id');
	responseHendler(res, gauger_select);
}

discount_input.oninput=(e)=>{
	order.discount = discount_input.value;
	let res = goSluice(order.id, order.discount, 'order_update_discount');
	responseHendler(res, discount_input);
}

square_meters_input.oninput=(e)=>{
	order.square_meters = square_meters_input.value;
	let res = goSluice(order.id, order.square_meters, 'order_update_square_meters');
	responseHendler(res, square_meters_input);
}

calculation_number_input.oninput=(e)=>{
	order.calculation_number = calculation_number_input.value;
	let res = goSluice(order.id, order.calculation_number, 'order_update_calculation_number');
	responseHendler(res, calculation_number_input);
}

contract_number_input.oninput=(e)=>{
	order.contract_number = contract_number_input.value;
	let res = goSluice(order.id, order.contract_number, 'order_update_contract_number');
	responseHendler(res, contract_number_input);
}


vendor_number_input.oninput=(e)=>{
	order.vendor_number = vendor_number_input.value;
	let res = goSluice(order.id, order.vendor_number, 'order_update_vendor_number');
	responseHendler(res, vendor_number_input);
}

total_price_input.oninput=(e)=>{
	order.total_price = total_price_input.value;
	let res = goSluice(order.id, order.total_price, 'order_update_total_price');
	responseHendler(res, total_price_input);
}

montage_price_input.oninput=(e)=>{
	order.montage_price = montage_price_input.value;
	let res = goSluice(order.id, order.montage_price, 'order_update_montage_price');
	responseHendler(res, montage_price_input);
}

additional_price_input.oninput=(e)=>{
	order.additional_price = additional_price_input.value;
	let res = goSluice(order.id, order.additional_price, 'order_update_additional_price');
	responseHendler(res, additional_price_input);
}

measuring_price_input.oninput=(e)=>{
	order.measuring_price = measuring_price_input.value;
	let res = goSluice(order.id, order.measuring_price, 'order_update_measuring_price');
	responseHendler(res, measuring_price_input);
}

gazda_price_input.oninput=(e)=>{
	order.gazda_price = gazda_price_input.value;
	let res = goSluice(order.id, order.gazda_price, 'order_update_gazda_price');
	responseHendler(res, gazda_price_input);
}

comment_textarea.oninput=(e)=>{
	order.comment = comment_textarea.value;
	let res = goSluice(order.id, order.comment, 'order_update_comment');
	responseHendler(res, comment_textarea);
}

client_comment_textarea.oninput=(e)=>{
	client.comment = client_comment_textarea.value;
	let res = goSluice(client.id, client.comment, 'client_update_comment');
	responseHendler(res, client_comment_textarea);
}

function responseHendler(res, node)
{
	res.then(data => {
		data.text().then(function(text) {
			if( text == '1' ){
				showSavedCase(node);
			}
			else{ console.log(text); }
		})
	}).catch(err => {
		console.error('Error: ', err);
	});
}

//*order status color apply
var order_status_val = order_status.options[order_status.selectedIndex].value;
order_status.classList.add("status-"+order_status_val);
order_status.onblur=(e)=>{
	order.status = order_status.options[order_status.selectedIndex].value;
	let res = goSluice(order.id, order.status, 'order_update_status');
		res.then(data => {
		data.text().then(function(text) {
			if( text == '1' ){
				order_status.classList.remove(order_status.classList[order_status.classList.length-1]);
				order_status.classList.add("status-"+order.status);
			}
			else{ console.log(text); }
		})
	});
}
//


// if needed fields ain't picked
var manager_select_val = manager_select.options[manager_select.selectedIndex].value;
var supplier_select_val = supplier_select.options[supplier_select.selectedIndex].value;
var installer_select_val = installer_select.options[installer_select.selectedIndex].value;
var gauger_select_val = gauger_select.options[gauger_select.selectedIndex].value;
if( manager_select_val == 0 ){
	manager_select.style.border='1px solid red';
}
if( supplier_select_val == 0 ){
	supplier_select.style.border='1px solid red';
}
if( installer_select_val== 0 ){
	installer_select.style.border='1px solid red';
}
if( gauger_select_val== 0 ){
	gauger_select.style.border='1px solid red';
}
//



