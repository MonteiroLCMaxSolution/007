$('#select-caixa-listar-relatorios').select2({
    width: 99999
});

$('#data-inicio-listar-relatorios').mask('00/00/0000');
$('#data-fim-listar-relatorios').mask('00/00/0000');

function validarFormulario(){

    var status = document.querySelector('#select-status-listar-relatorios').value;
    var dataInicio = document.querySelector("#data-inicio-listar-relatorios").value;
    var dataFim = document.querySelector('#data-fim-listar-relatorios').value;

    if(status != 'aberto' && status != 'fechado' && status != 'todos'){
		document.querySelector('.p-status').style.color = 'red';
		document.querySelector('.p-status').innerHTML = 'Status (Inválido)';
    }else{
		document.querySelector('.p-status').style.color = 'green';
		document.querySelector('.p-status').innerHTML = 'Status';
	}

	if(dataInicio == ''){
		document.querySelector('.p-data-inicio').style.color = 'black';
		document.querySelector('.p-data-inicio').innerHTML = 'Data - Início';
	}else if(dataInicio.length > 0 && dataInicio.length != 10){
        document.querySelector('.p-data-inicio').style.color = 'red';
		document.querySelector('.p-data-inicio').innerHTML = 'Data - Início (Inválido)';
    }else{
		document.querySelector('.p-data-inicio').style.color = 'green';
		document.querySelector('.p-data-inicio').innerHTML = 'Data - Início';
	}

    if(dataFim == ''){
		document.querySelector('.p-data-fim').style.color = 'black';
		document.querySelector('.p-data-fim').innerHTML = 'Data - Fim';
	}else if(dataFim.length > 0 && dataFim.length != 10){
        document.querySelector('.p-data-fim').style.color = 'red';
		document.querySelector('.p-data-fim').innerHTML = 'Data - Fim (Inválido)';
    }else{
		document.querySelector('.p-data-fim').style.color = 'green';
		document.querySelector('.p-data-fim').innerHTML = 'Data - Fim';
	}

}

document.getElementById('btn-pesquisar').onclick = function(){

    var status = document.querySelector('#select-status-listar-relatorios').value;
    var dataInicio = document.querySelector("#data-inicio-listar-relatorios").value;
    var dataFim = document.querySelector('#data-fim-listar-relatorios').value;

    var liberBTN = '';

    if(status != 'aberto' && status != 'fechado' && status != 'todos'){
		document.querySelector('.p-status').style.color = 'red';
		document.querySelector('.p-status').innerHTML = 'Status (Inválido)';
        liberBTN = '1';
    }else{
		document.querySelector('.p-status').style.color = 'green';
		document.querySelector('.p-status').innerHTML = 'Status';
	}

	if(dataInicio == ''){
		document.querySelector('.p-data-inicio').style.color = 'black';
		document.querySelector('.p-data-inicio').innerHTML = 'Data - Início';
	}else if(dataInicio.length > 0 && dataInicio.length != 10){
        document.querySelector('.p-data-inicio').style.color = 'red';
		document.querySelector('.p-data-inicio').innerHTML = 'Data - Início (Inválido)';
        liberBTN = '1';
    }else{
		document.querySelector('.p-data-inicio').style.color = 'green';
		document.querySelector('.p-data-inicio').innerHTML = 'Data - Início';
	}

    if(dataFim == ''){
		document.querySelector('.p-data-fim').style.color = 'black';
		document.querySelector('.p-data-fim').innerHTML = 'Data - Fim';
	}else if(dataFim.length > 0 && dataFim.length != 10){
        document.querySelector('.p-data-fim').style.color = 'red';
		document.querySelector('.p-data-fim').innerHTML = 'Data - Fim (Inválido)';
        liberBTN = '1';
    }else{
		document.querySelector('.p-data-fim').style.color = 'green';
		document.querySelector('.p-data-fim').innerHTML = 'Data - Fim';
	}

    if(liberBTN == ''){
        document.querySelector('div.results-box').style.display = 'block';
        return true;
    }else{
        document.querySelector('div.results-box').style.display = 'none';
        return false;
    }
}

function abrirResultSingle(id){
    if($('#content'+id).is(':hidden')){
        $('div.result-single-content').css('display','none');
        $('#content'+id).fadeIn();
    }else{
        $('#content'+id).fadeOut();
    }
}

const myDatePicker1 = MCDatepicker.create({ 
    el: '#data-inicio-listar-relatorios',
    dateFormat: 'DD/MM/YYYY',
    customWeekDays: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'],
    customMonths: [
        'Janeiro',
        'Fevereiro',
        'Março',
        'Abril',
        'Maio',
        'Junho',
        'Julho',
        'Agosto',
        'Setembro',
        'Outubro',
        'Novembro',
        'Dezembro'
        ]
})

const myDatePicker2 = MCDatepicker.create({ 
    el: '#data-fim-listar-relatorios',
    dateFormat: 'DD/MM/YYYY',
    customWeekDays: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'],
    customMonths: [
        'Janeiro',
        'Fevereiro',
        'Março',
        'Abril',
        'Maio',
        'Junho',
        'Julho',
        'Agosto',
        'Setembro',
        'Outubro',
        'Novembro',
        'Dezembro'
        ]
})