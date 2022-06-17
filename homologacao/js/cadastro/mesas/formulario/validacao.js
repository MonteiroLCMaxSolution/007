$.switcher();

function validarFormulario(){
    var localMapa = document.getElementById('local-mesa').value;
    var status = document.getElementById('status-mesa').value;

    if(localMapa == 'nulo'){
        document.querySelector('.p-local').style.color = 'red';
		document.querySelector('.p-local').innerHTML = 'Local do mapa (Obrigatório)';
    }else{
        document.querySelector('.p-local').style.color = 'green';
		document.querySelector('.p-local').innerHTML = 'Local do mapa';
    }

    if(status != 'ativo' && status != 'inativo'){
        document.querySelector('.p-status').style.color = 'red';
		document.querySelector('.p-status').innerHTML = 'Local do mapa (Obrigatório)';
    }else{
        document.querySelector('.p-status').style.color = 'green';
		document.querySelector('.p-status').innerHTML = 'Local do mapa';
    }
}

document.getElementById('btn-enviar-form').onclick = function(){
    var localMapa = document.getElementById('local-mesa').value;
    var status = document.getElementById('status-mesa').value;
    var liberBTN = '';

    if(localMapa == 'nulo'){
        document.querySelector('.p-local').style.color = 'red';
		document.querySelector('.p-local').innerHTML = 'Local do mapa (Obrigatório)';
        liberBTN = '1';
    }else{
        document.querySelector('.p-local').style.color = 'green';
		document.querySelector('.p-local').innerHTML = 'Local do mapa';
    }

    if(status != 'ativo' && status != 'inativo'){
        document.querySelector('.p-status').style.color = 'red';
		document.querySelector('.p-status').innerHTML = 'Local do mapa (Obrigatório)';
        liberBTN = '1'
    }else{
        document.querySelector('.p-status').style.color = 'green';
		document.querySelector('.p-status').innerHTML = 'Local do mapa';
    }

    if(liberBTN == ''){
        return true;
    }else{
        return false;
    }
}

function abrirNovoLocal(){
    $('body').css('overflow-y','hidden');
    $('.modal-confirm-order').css('display','block');
    $('div.modal-box-locais').css('display','block');
}

function fecharNovoLocal(){
    $('body').css('overflow-y','auto');
    $('.modal-confirm-order').css('display','none');
    $('div.modal-box-locais').css('display','none');
}

function abrirFormLocaisMapa(){
    $('div.modal-box-locais').css('display','none');
    $('div.modal-box-add-locais').css('display','block');
}

function fecharFormLocaisMapa(){
    $('div.modal-box-locais').css('display','block');
    $('div.modal-box-add-locais').css('display','none');
}

function validarFormModal(){
    var descricao = document.getElementById('descricao-mesa-modal').value;
    var andar = document.getElementById('andar-mesa-modal').value;
    var setor = document.getElementById('setor-mesa-modal').value;
    var lado = document.getElementById('lado-mesa-modal').value;
    

    if(descricao == ''){
        document.querySelector('.p-descricao-modal').style.color = 'red';
		document.querySelector('.p-descricao-modal').innerHTML = 'Descrição (Obrigatório)';
    }else{
        document.querySelector('.p-descricao-modal').style.color = 'green';
		document.querySelector('.p-descricao-modal').innerHTML = 'Descrição';
    }

    if(andar == ''){
        document.querySelector('.p-andar-modal').style.color = 'red';
		document.querySelector('.p-andar-modal').innerHTML = 'Andar (Obrigatório)';
    }else{
        document.querySelector('.p-andar-modal').style.color = 'green';
		document.querySelector('.p-andar-modal').innerHTML = 'Andar';
    }

    if(setor == ''){
        document.querySelector('.p-setor-modal').style.color = 'red';
		document.querySelector('.p-setor-modal').innerHTML = 'Setor (Obrigatório)';
    }else{
        document.querySelector('.p-setor-modal').style.color = 'green';
		document.querySelector('.p-setor-modal').innerHTML = 'Setor';
    }

    if(lado == ''){
        document.querySelector('.p-lado-modal').style.color = 'red';
		document.querySelector('.p-lado-modal').innerHTML = 'Lado (Obrigatório)';
    }else{
        document.querySelector('.p-lado-modal').style.color = 'green';
		document.querySelector('.p-lado-modal').innerHTML = 'Lado';
    }
}

document.getElementById('enviar-form-modal').onclick = function(){

    var descricao = document.getElementById('descricao-mesa-modal').value;
    var andar = document.getElementById('andar-mesa-modal').value;
    var setor = document.getElementById('setor-mesa-modal').value;
    var lado = document.getElementById('lado-mesa-modal').value;
    var liberBTN = '';


    if(descricao == ''){
        document.querySelector('.p-descricao-modal').style.color = 'red';
		document.querySelector('.p-descricao-modal').innerHTML = 'Descrição (Obrigatório)';
        liberBTN = '1';
    }else{
        document.querySelector('.p-descricao-modal').style.color = 'green';
		document.querySelector('.p-descricao-modal').innerHTML = 'Descrição';
    }

    if(andar == ''){
        document.querySelector('.p-andar-modal').style.color = 'red';
		document.querySelector('.p-andar-modal').innerHTML = 'Andar (Obrigatório)';
        liberBTN = '1';
    }else{
        document.querySelector('.p-andar-modal').style.color = 'green';
		document.querySelector('.p-andar-modal').innerHTML = 'Andar';
    }

    if(setor == ''){
        document.querySelector('.p-setor-modal').style.color = 'red';
		document.querySelector('.p-setor-modal').innerHTML = 'Setor (Obrigatório)';
        liberBTN = '1';
    }else{
        document.querySelector('.p-setor-modal').style.color = 'green';
		document.querySelector('.p-setor-modal').innerHTML = 'Setor';
    }

    if(lado == ''){
        document.querySelector('.p-lado-modal').style.color = 'red';
		document.querySelector('.p-lado-modal').innerHTML = 'Lado (Obrigatório)';
        liberBTN = '1';
    }else{
        document.querySelector('.p-lado-modal').style.color = 'green';
		document.querySelector('.p-lado-modal').innerHTML = 'Lado';
    }

    if(liberBTN == ''){
        return true;
    }else{
        return false;
    }

}