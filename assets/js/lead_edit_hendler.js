let lead = {
	id: lead_id.value,
	source :'',
	address: '',
	comment: '',
	advance_calculation_1: '',
	advance_calculation_2: '',
	advance_calculation_3: '',
};

address_input.oninput=(e)=>{
	lead.address = address_input.value;
	let res = goSluice(lead.id, lead.address, 'lead_update_address');
	responseHendler(res, address_input);
}
comment_input.oninput=(e)=>{
	lead.comment = comment_input.value;
	let res = goSluice(lead.id, lead.comment, 'lead_update_comment');
	responseHendler(res, comment_input);
}


advance_calculation_1.oninput=(e)=>{
	lead.advance_calculation_1 = advance_calculation_1.value;
	let res = goSluice(lead.id, lead.advance_calculation_1, 'lead_update_advance_calculation1');
	responseHendler(res, advance_calculation_1);
}
advance_calculation_2.oninput=(e)=>{
	lead.advance_calculation_2 = advance_calculation_2.value;
	let res = goSluice(lead.id, lead.advance_calculation_2, 'lead_update_advance_calculation2');
	responseHendler(res,  advance_calculation_2);
}
advance_calculation_3.oninput=(e)=>{
	lead.advance_calculation_3 = advance_calculation_3.value;
	let res = goSluice(lead.id, lead.advance_calculation_3, 'lead_update_advance_calculation3');
	responseHendler(res, advance_calculation_3);
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

function changeSource(node)
{
	let new_source = node.options[node.selectedIndex];
	let res = goSluice(lead_id.value, new_source.value, 'lead_update_source');
	res.then(data => {
		data.text().then(function(text) {
			if( text == '1' ){
				// location.reload();
			}
			console.log(text)
		})
	})
}

function changeStatus(node)
{
	let new_status = node.options[node.selectedIndex];
	let res = goSluice(lead_id.value, new_status.value, 'lead_update_status');
	res.then(data => {
		data.text().then(function(text) {
			if( text == '1' ){
				node.classList.remove(node.classList[1]);
				node.classList.add('status-'+new_status.value)
				console.log(node.classList);
				// location.reload();
			}
			console.log(new_status.value)
		})
	})
}

function del(id)
{
	console.log(id);
	let res = goSluice(id, '', 'lead_delete');
	res.then(data => {
		data.text().then(function(text) {
			if( text == '1' ){
				document.getElementById('cart_body').innerHTML = 'deleted';
			}
			console.log(text)
		})
	})
}	
