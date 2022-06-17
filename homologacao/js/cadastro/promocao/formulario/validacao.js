$('select').select2({
    width: 99999
})

$('#data-inicio-promocao').mask('00/00/0000');
$('#data-fim-promocao').mask('00/00/0000');

function validarFormulario(){

	var produto = document.querySelector("#produto-promocao").value;
    var dataInicio = document.querySelector("#data-inicio-promocao").value;
    var dataFim = document.querySelector("#data-fim-promocao").value;
    var status = document.querySelector("#status-promocao").value;

	if(produto == 'nulo'){
		document.querySelector('.p-produto').style.color = 'red';
		document.querySelector('.p-produto').innerHTML = 'Produto (Obrigatório)';
	}else{
		document.querySelector('.p-produto').style.color = 'green';
		document.querySelector('.p-produto').innerHTML = 'Produto';
	}

    if(dataInicio == ''){
		document.querySelector('.p-data-inicio').style.color = 'red';
		document.querySelector('.p-data-inicio').innerHTML = 'Data - Início (Obrigatório)';
        
	}else if(dataInicio.length < 10){
		document.querySelector('.p-data-inicio').style.color = 'red';
		document.querySelector('.p-data-inicio').innerHTML = 'Data - Início (Inválido)';
	}else{
		document.querySelector('.p-data-inicio').style.color = 'green';
		document.querySelector('.p-data-inicio').innerHTML = 'Data - Início';
	}

    if(dataFim == ''){
		document.querySelector('.p-data-fim').style.color = 'red';
		document.querySelector('.p-data-fim').innerHTML = 'Data - Fim (Obrigatório)';
        
	}else if(dataFim.length < 10){
		document.querySelector('.p-data-fim').style.color = 'red';
		document.querySelector('.p-data-fim').innerHTML = 'Data - Fim (Inválido)';
	}else{
		document.querySelector('.p-data-fim').style.color = 'green';
		document.querySelector('.p-data-fim').innerHTML = 'Data - Fim';
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

    
	var produto = document.querySelector("#produto-promocao").value;
    var dataInicio = document.querySelector("#data-inicio-promocao").value;
    var dataFim = document.querySelector("#data-fim-promocao").value;
    var status = document.querySelector("#status-promocao").value;

    var liberBTN = '';

	if(produto == 'nulo'){
		document.querySelector('.p-produto').style.color = 'red';
		document.querySelector('.p-produto').innerHTML = 'Produto (Obrigatório)';
        liberBTN = '1';
	}else{
		document.querySelector('.p-produto').style.color = 'green';
		document.querySelector('.p-produto').innerHTML = 'Produto';
	}

    if(dataInicio == ''){
		document.querySelector('.p-data-inicio').style.color = 'red';
		document.querySelector('.p-data-inicio').innerHTML = 'Data - Início (Obrigatório)';
        liberBTN = '1';
        
	}else if(dataInicio.length < 10){
		document.querySelector('.p-data-inicio').style.color = 'red';
		document.querySelector('.p-data-inicio').innerHTML = 'Data - Início (Inválido)';
        liberBTN = '1';
	}else{
		document.querySelector('.p-data-inicio').style.color = 'green';
		document.querySelector('.p-data-inicio').innerHTML = 'Data - Início';
	}

    if(dataFim == ''){
		document.querySelector('.p-data-fim').style.color = 'red';
		document.querySelector('.p-data-fim').innerHTML = 'Data - Fim (Obrigatório)';
        liberBTN = '1';
	}else if(dataFim.length < 10){
		document.querySelector('.p-data-fim').style.color = 'red';
		document.querySelector('.p-data-fim').innerHTML = 'Data - Fim (Inválido)';
        liberBTN = '1';
	}else{
		document.querySelector('.p-data-fim').style.color = 'green';
		document.querySelector('.p-data-fim').innerHTML = 'Data - Fim';
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

const myDatePicker1 = MCDatepicker.create({ 
    el: '#data-inicio-promocao',
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
    el: '#data-fim-promocao',
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