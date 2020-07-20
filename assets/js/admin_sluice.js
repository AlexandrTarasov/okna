function goSluice(id = false, value, from_node){
	// var data = 'a';
	let formData = new FormData(),
	url = '/sluice';
	formData.append('id', id);
	formData.append('val', value);
	formData.append('from_node', from_node);
	return fetch(url, {
		method: 'POST',
		body: formData
	});
}
