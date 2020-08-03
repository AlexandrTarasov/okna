function shapePhone(phone_input)
{
	let phone = phone_input.defaultValue;
	console.log(phone_input);
	if( phone == '' ){
		return;
	}
	let p_1 = phone.slice(2, 5);
	let p_2 = phone.slice(5, 8);
	let p_3 = phone.slice(8, 10);
	let p_4 = phone.slice(10, 12);
	let usable_phone = '(' + p_1 + ')-' + p_2 + '-' + p_3 + '-' + p_4 ;
	phone_input.value = usable_phone;
}
//

//change viber binding
function changeViber(e)
{
	console.log(e.parentNode.parentNode.childNodes);
	if(e.parentNode.parentNode.childNodes['1'].value ==''){return false;};
	if(e.childNodes[1].classList[3] == 'viber_off'){
		e.childNodes[1].classList.remove("viber_off"); 
		e.childNodes[1].classList.add("viber_on"); 
	}else{
		e.childNodes[1].classList.remove("viber_on"); 
		e.childNodes[1].classList.add("viber_off"); 
	}
}
//

function makePhoneNumber(event, phone)
{
	let phone_arr_pattern = [
		"(" ,"_", "_", "_", ")", "-", "_", "_", "_","-","_", "_", "-", "_", "_"
	]
	let inputed_sign = event.data;
	let value_of_input = phone.value;
	let phone_pure_arr = [];
	let back_phone_str = '';
	for (let i = 0; i < value_of_input.length; i++ ) {
		if(value_of_input.charAt(i) == "0" || 
			value_of_input.charAt(i) == "1" ||
			value_of_input.charAt(i) == "2" ||
			value_of_input.charAt(i) == "3" ||
			value_of_input.charAt(i) == "4" ||
			value_of_input.charAt(i) == "5" ||
			value_of_input.charAt(i) == "6" ||
			value_of_input.charAt(i) == "7" ||
			value_of_input.charAt(i) == "8" ||
			value_of_input.charAt(i) == "9")
		{	
			phone_pure_arr.push(value_of_input.charAt(i));
		}
	}
	
	let inp_items = 0;
	let cursor_position = 1;
	for(let z = 0; z<phone_arr_pattern.length; z++) {
		if( value_of_input.length > 2 ){
			if(value_of_input.charAt(1) !== '0'){
				phone.value = '';
				alert("Первая цифра 0"); return false; 
			}
		}
		if( (phone_arr_pattern[z] == "_") && (phone_pure_arr.length > 0) ){
			back_phone_str += phone_pure_arr[0];
			phone_pure_arr.shift();
			inp_items++;
			if(inp_items == 4){ cursor_position = cursor_position+3;}
			else if(inp_items == 7) {cursor_position = cursor_position+2;}
			else if(inp_items == 9) {cursor_position = cursor_position+2;}
			else{cursor_position = cursor_position+1}
		}else{
			back_phone_str += phone_arr_pattern[z];
		}
	}
	phone.value = back_phone_str;
	phone.setSelectionRange(cursor_position, cursor_position);
	if (inp_items === 10) {
		return true;
    }else{
        phone.style.color = 'grey';
		return false;
    }
}
