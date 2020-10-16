async function goUserSluice(id = false, value, from_node){
	// var data = 'a';
	let formData = new FormData(),
	url = '/user_sluice';
	formData.append('id', id);
	formData.append('val', value);
	formData.append('from_node', from_node);
	return await fetch(url, {
		method: 'POST',
		body: formData
	});
}
