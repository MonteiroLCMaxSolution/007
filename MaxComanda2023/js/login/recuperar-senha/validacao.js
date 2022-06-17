function validarFormulario(){
    var email = document.getElementById('email-recuperar-senha').value;

    function validateEmail(email) 
    {	
		var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(email);
    }

	if(email == ''){
		document.querySelector('.p-email').style.color = 'red';
		document.querySelector('.p-email').innerHTML = 'Email (Obrigatório)';
	}
	else if(validateEmail(email) == false){
		document.querySelector('.p-email').style.color = 'red';
		document.querySelector('.p-email').innerHTML = 'Email (Inválido)';
	}else{
		document.querySelector('.p-email').style.color = 'green';
		document.querySelector('.p-email').innerHTML = 'Email';
	}
}

document.getElementById('pesquisar-email-recuperar-senha').onclick = function(){
    var email = document.getElementById('email-recuperar-senha').value;
    var liberBTN = '';

    function validateEmail(email) 
    {	
		var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(email);
    }

	if(email == ''){
		document.querySelector('.p-email').style.color = 'red';
		document.querySelector('.p-email').innerHTML = 'Email (Obrigatório)';
        liberBTN = '1';
	}
	else if(validateEmail(email) == false){
		document.querySelector('.p-email').style.color = 'red';
		document.querySelector('.p-email').innerHTML = 'Email (Inválido)';
        liberBTN = '1';
	}else{
		document.querySelector('.p-email').style.color = 'green';
		document.querySelector('.p-email').innerHTML = 'Email';
	}

    if(liberBTN == '1'){
        document.querySelector('div.recuperar-senha-result').style.display = 'none';
		return false;
    }else{
        document.querySelector('div.recuperar-senha-result').style.display = 'block';
		return false;
    }
}