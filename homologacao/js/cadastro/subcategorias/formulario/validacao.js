$('select').select2({
    width: 99999
})

function validarFormulario(){

    var categoria = document.querySelector("#categoria-subcategorias").value;
	var nome = document.querySelector("#nome-subcategorias").value;
    var status = document.querySelector("#status-subcategorias").value;

    if(categoria == 'nulo'){
		document.querySelector('.p-categoria').style.color = 'red';
		document.querySelector('.p-categoria').innerHTML = 'Categoria (Obrigatório)';
	}else{
		document.querySelector('.p-categoria').style.color = 'green';
		document.querySelector('.p-categoria').innerHTML = 'Categoria';
	}

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
	}else{
		document.querySelector('.p-status').style.color = 'green';
		document.querySelector('.p-status').innerHTML = 'Status';
	}

}

document.querySelector('#btn-enviar-form').onclick = function(){

    var categoria = document.querySelector("#categoria-subcategorias").value;
	var nome = document.querySelector("#nome-subcategorias").value;
    var status = document.querySelector("#status-subcategorias").value;

    var liberBTN = '';

    if(categoria == 'nulo'){
		document.querySelector('.p-categoria').style.color = 'red';
		document.querySelector('.p-categoria').innerHTML = 'Categoria (Obrigatório)';
        liberBTN = '1';
	}else{
		document.querySelector('.p-categoria').style.color = 'green';
		document.querySelector('.p-categoria').innerHTML = 'Categoria';
	}

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
