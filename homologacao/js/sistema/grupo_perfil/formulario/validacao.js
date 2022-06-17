// FORMULÁRIO PRINCIPAL

function validarFormulario(){

    var nomePerfil = document.querySelector("#nome-perfil-grupo-perfil").value;
    var status = document.querySelector('#select-status-grupo-perfil').value;

	if(nomePerfil == ''){
		document.querySelector('.p-nome-perfil').style.color = 'red';
		document.querySelector('.p-nome-perfil').innerHTML = 'Nome do perfil (Obrigatório)';
	}else if(nomePerfil.length < 2){
        document.querySelector('.p-nome-perfil').style.color = 'red';
		document.querySelector('.p-nome-perfil').innerHTML = 'Nome do perfil (Min. 2 caracteres)';
    }else{
		document.querySelector('.p-nome-perfil').style.color = 'green';
		document.querySelector('.p-nome-perfil').innerHTML = 'Nome do perfil';
	}

    if(status != 'ativo' && status != 'inativo'){
		document.querySelector('.p-status').style.color = 'red';
		document.querySelector('.p-status').innerHTML = 'Status (Obrigatório)';
    }else{
		document.querySelector('.p-status').style.color = 'green';
		document.querySelector('.p-status').innerHTML = 'Status';
	}

}

document.getElementById('btn-enviar-form').onclick = function(){
    var nomePerfil = document.querySelector("#nome-perfil-grupo-perfil").value;
    var status = document.querySelector('#select-status-grupo-perfil').value;

    var liberBTN = '';

	if(nomePerfil == ''){
		document.querySelector('.p-nome-perfil').style.color = 'red';
		document.querySelector('.p-nome-perfil').innerHTML = 'Nome do perfil (Obrigatório)';
        liberBTN = '1';
	}else if(nomePerfil.length < 2){
        document.querySelector('.p-nome-perfil').style.color = 'red';
		document.querySelector('.p-nome-perfil').innerHTML = 'Nome do perfil (Min. 2 caracteres)';
        liberBTN = '1';
    }else{
		document.querySelector('.p-nome-perfil').style.color = 'green';
		document.querySelector('.p-nome-perfil').innerHTML = 'Nome do perfil';
	}

    if(status != 'ativo' && status != 'inativo'){
		document.querySelector('.p-status').style.color = 'red';
		document.querySelector('.p-status').innerHTML = 'Status (Obrigatório)';
        liberBTN = '1';
    }else{
		document.querySelector('.p-status').style.color = 'green';
		document.querySelector('.p-status').innerHTML = 'Status';
	}

    if(liberBTN == ''){
        return true;
    }else{
        return false;
    }
}