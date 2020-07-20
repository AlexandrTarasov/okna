let supplier_id_block = document.getElementById('supplier_id_block');
let supplier_id = '';

if( supplier_id_block !== null ){
	supplier_id = supplier_id_block.getAttribute('data-supplier-id');
}


supplier_company_name.oninput=(e)=>{
	let scn = supplier_company_name;
	let res = goSluice(supplier_id, scn.value, 'supplier_data_name');
    res.then(data => {
		data.text().then(function(text) {
			if( text == '1' ){
				showSavedCase(scn);
			}
		})
    }).catch(err => {
        console.error('Error: ', err);
    });
}

supplier_manager1_name.oninput=(e)=>{
	let sm1n = supplier_manager1_name;
	let res = goSluice(supplier_id, sm1n.value, 'supplier_manager_name');
    res.then(data => {
		data.text().then(function(text) {
			if( text == '1' ){
				showSavedCase(sm1n);
			}
		})
    }).catch(err => {
        console.error('Error: ', err);
    });
}


function showSavedCase(input_node){
	console.log(input_node);
	input_node.style.background = 'lightgreen';
	setTimeout(function(){
		input_node.style.background = 'white';
	}, 2000);
}
