$('select').select2({
    width: 99999
})

function validarFormulario(){

	var nome = document.querySelector("#nome-locais-produtos").value;
	var status = document.querySelector("#status-locais-produtos").value;

	if(nome == ''){
		document.querySelector('.p-nome').style.color = 'red';
		document.querySelector('.p-nome').innerHTML = 'Nome / Razão social (Obrigatório)';
	}else if(nome.length < 2){
		document.querySelector('.p-nome').style.color = 'red';
		document.querySelector('.p-nome').innerHTML = 'Nome / Razão social (Min. 2 letras)';
	}else{
		document.querySelector('.p-nome').style.color = 'green';
		document.querySelector('.p-nome').innerHTML = 'Nome / Razão social';
	}

	if(status != 'ativo' && status != 'inativo'){
		document.querySelector('.p-status').style.color = 'red';
		document.querySelector('.p-status').innerHTML = 'Status (Inválido)';
        liberBTN = '1';
	}else{
		document.querySelector('.p-status').style.color = 'green';
		document.querySelector('.p-status').innerHTML = 'Status';
	}

}

document.querySelector('#btn-enviar-form').onclick = function(){

	var nome = document.querySelector("#nome-locais-produtos").value;
    var status = document.querySelector("#status-locais-produtos").value;

    var liberBTN = '';

	if(nome == ''){
		document.querySelector('.p-nome').style.color = 'red';
		document.querySelector('.p-nome').innerHTML = 'Nome / Razão social (Obrigatório)';
        liberBTN = '1';
	}else if(nome.length < 2){
		document.querySelector('.p-nome').style.color = 'red';
		document.querySelector('.p-nome').innerHTML = 'Nome / Razão social (Min. 2 letras)';
        liberBTN = '1';
	}else{
		document.querySelector('.p-nome').style.color = 'green';
		document.querySelector('.p-nome').innerHTML = 'Nome / Razão social';
	}

    if(status != 'ativo' && status != 'inativo'){
		document.querySelector('.p-status').style.color = 'red';
		document.querySelector('.p-status').innerHTML = 'Status (Inválido)';
        liberBTN = '1';
	}else{
		document.querySelector('.p-status').style.color = 'green';
		document.querySelector('.p-status').innerHTML = 'Status';
	}

	if(liberBTN == ''){
		return true; //habilita
	}else{
        $('html,body').animate({'scrollTop':'0'},800);
		//window.scrollTo({top: 0, behavior: 'smooth'});
		return false; //desabilita
	}

};
