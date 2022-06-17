$('select').select2({
    width: 99999
})

function validarFormulario(){
	var nome = document.querySelector("#nome-categoria").value;
	var status = document.querySelector("#status-categoria").value;

	if(nome == ''){
		document.querySelector('.p-nome').style.color = 'red';
		document.querySelector('.p-nome').innerHTML = 'Nome (Obrigatório)';
	}else if(nome.length < 3){
		document.querySelector('.p-nome').style.color = 'red';
		document.querySelector('.p-nome').innerHTML = 'Nome (Min. 3 letras)';
	}else{
		document.querySelector('.p-nome').style.color = 'green';
		document.querySelector('.p-nome').innerHTML = 'Nome';
	}

	if(status != 'ativo' && status != 'inativo'){
		document.querySelector('.p-status').style.color = 'red';
		document.querySelector('.p-status').innerHTML = 'Status (Inválido)';
	}else{
		document.querySelector('.p-status').style.color = 'green';
		document.querySelector('.p-status').innerHTML = 'Status';
	}

}

document.querySelector('#btn-enviar-form').onclick = function(){

    var nome = document.querySelector("#nome-categoria").value;
	var status = document.querySelector("#status-categoria").value;

	var liberBTN = '';

	if(nome == ''){
		document.querySelector('.p-nome').style.color = 'red';
		document.querySelector('.p-nome').innerHTML = 'Nome (Obrigatório)';
        liberBTN = '1';
	}else if(nome.length < 3){
		document.querySelector('.p-nome').style.color = 'red';
		document.querySelector('.p-nome').innerHTML = 'Nome (Min. 3 letras)';
        liberBTN = '1';
	}else{
		document.querySelector('.p-nome').style.color = 'green';
		document.querySelector('.p-nome').innerHTML = 'Nome';
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
        // $('html,body').animate({'scrollTop':'155'},800);
		//window.scrollTo({top: 0, behavior: 'smooth'});
		return false; //desabilita
	}

};