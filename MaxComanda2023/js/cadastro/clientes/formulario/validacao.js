$('select').select2({
    width: 99999
})

$('#telefone-cliente').mask('(00) 0000-0000');//Aplicando máscara no telefone
$('#cpf-cliente').mask('000.000.000-00');
$('#nascimento-cliente').mask('00/00/0000');


function validarFormulario(){
    var cpf = document.querySelector("#cpf-cliente").value;
	var nome = document.querySelector("#nome-cliente").value;
    var fantasia = document.querySelector("#fantasia-cliente").value;
    var apelido = document.querySelector("#apelido-cliente").value;
    var nascimento = document.querySelector("#nascimento-cliente").value;
    var inscMunicipal = document.querySelector("#municipal-cliente").value;
    var inscEstadual = document.querySelector("#estadual-cliente").value;
    var email = document.querySelector("#email-cliente").value;
    var telefone = document.querySelector("#telefone-cliente").value;
	var login = document.querySelector("#login-cliente").value;
	var senha = document.querySelector("#senha-cliente").value;
	var status = document.querySelector("#status-cliente").value;

    /*Informações principais*/

    if(cpf == ''){
		document.querySelector('.p-cpf').style.color = 'red';
		document.querySelector('.p-cpf').innerHTML = 'CPF (Obrigatório)';
	}else if(cpf.length < 14){
		document.querySelector('.p-cpf').style.color = 'red';
		document.querySelector('.p-cpf').innerHTML = 'CPF (Inválido)';
	}else{
		document.querySelector('.p-cpf').style.color = 'green';
		document.querySelector('.p-cpf').innerHTML = 'CPF';
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

    if(fantasia == ''){
		document.querySelector('.p-fantasia').style.color = 'red';
		document.querySelector('.p-fantasia').innerHTML = 'Fantasia (Obrigatório)';
	}else if(fantasia.length < 2){
		document.querySelector('.p-fantasia').style.color = 'red';
		document.querySelector('.p-fantasia').innerHTML = 'Fantasia (Min. 2 letras)';
	}else{
		document.querySelector('.p-fantasia').style.color = 'green';
		document.querySelector('.p-fantasia').innerHTML = 'Fantasia';
	}

    if(apelido == ''){
		document.querySelector('.p-apelido').style.color = 'red';
		document.querySelector('.p-apelido').innerHTML = 'Apelido (Obrigatório)';
	}else if(apelido.length < 2){
		document.querySelector('.p-apelido').style.color = 'red';
		document.querySelector('.p-apelido').innerHTML = 'Apelido (Min. 2 letras)';
	}else{
		document.querySelector('.p-apelido').style.color = 'green';
		document.querySelector('.p-apelido').innerHTML = 'Apelido';
	}

    if(nascimento == ''){
		document.querySelector('.p-nascimento').style.color = 'red';
		document.querySelector('.p-nascimento').innerHTML = 'Data de Nascimento (Obrigatório)';
        
	}else if(nascimento.length < 10){
		document.querySelector('.p-nascimento').style.color = 'red';
		document.querySelector('.p-nascimento').innerHTML = 'Data de Nascimento (Inválido)';
	}else{
		document.querySelector('.p-nascimento').style.color = 'green';
		document.querySelector('.p-nascimento').innerHTML = 'Data de Nascimento';
	}

    if(inscMunicipal == ''){
		document.querySelector('.p-municipal').style.color = 'black';
		document.querySelector('.p-municipal').innerHTML = 'Inscrição Municipal';
	}else if(inscMunicipal.length > 0 && inscMunicipal.length < 14){
		document.querySelector('.p-municipal').style.color = 'red';
		document.querySelector('.p-municipal').innerHTML = 'Inscrição Municipal (Inválido)';
	}else{
		document.querySelector('.p-municipal').style.color = 'green';
		document.querySelector('.p-municipal').innerHTML = 'Inscrição Municipal';
	}

	if(inscEstadual == ''){
		document.querySelector('.p-estadual').style.color = 'black';
		document.querySelector('.p-estadual').innerHTML = 'Inscrição Estadual';
	}else if(inscEstadual.length > 0 && inscEstadual.length < 14){
		document.querySelector('.p-estadual').style.color = 'red';
		document.querySelector('.p-estadual').innerHTML = 'Incrição Estadual (Inválido)';
	}else{
		document.querySelector('.p-estadual').style.color = 'green';
		document.querySelector('.p-estadual').innerHTML = 'Inscrição Estadual';
	}

    /*Contato*/

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

	if(telefone == ''){
		document.querySelector('.p-telefone').style.color = 'red';
		document.querySelector('.p-telefone').innerHTML = 'Telefone (Obrigatório)';
	}else if(telefone.length < 14){
		document.querySelector('.p-telefone').style.color = 'red';
		document.querySelector('.p-telefone').innerHTML = 'Telefone (Inválido)';
	}else{
		document.querySelector('.p-telefone').style.color = 'green';
		document.querySelector('.p-telefone').innerHTML = 'Telefone';
	}

    /*Dados para login*/

	if(login == ''){
		document.querySelector('.p-login').style.color = 'red';
		document.querySelector('.p-login').innerHTML = 'Login (Obrigatório)';
	}else if(login.length < 5){
		document.querySelector('.p-login').style.color = 'red';
		document.querySelector('.p-login').innerHTML = 'Login (Min. 5 caracteres)';
	}else{
		document.querySelector('.p-login').style.color = 'green';
		document.querySelector('.p-login').innerHTML = 'Login';
	}

	if(senha == ''){
		document.querySelector('.p-senha').style.color = 'red';
		document.querySelector('.p-senha').innerHTML = 'Senha (Obrigatório)';
	}else if(senha.length < 8){
		document.querySelector('.p-senha').style.color = 'red';
		document.querySelector('.p-senha').innerHTML = 'Senha (Min. 8 caracteres)';
	}else{
		document.querySelector('.p-senha').style.color = 'green';
		document.querySelector('.p-senha').innerHTML = 'Senha';
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

    
    var cpf = document.querySelector("#cpf-cliente").value;
	var nome = document.querySelector("#nome-cliente").value;
    var fantasia = document.querySelector("#fantasia-cliente").value;
    var apelido = document.querySelector("#apelido-cliente").value;
    var nascimento = document.querySelector("#nascimento-cliente").value;
    var inscMunicipal = document.querySelector("#municipal-cliente").value;
    var inscEstadual = document.querySelector("#estadual-cliente").value;
    var email = document.querySelector("#email-cliente").value;
    var telefone = document.querySelector("#telefone-cliente").value;
	var login = document.querySelector("#login-cliente").value;
	var senha = document.querySelector("#senha-cliente").value;
	var status = document.querySelector("#status-cliente").value;

    var liberBTN = '';

    /*Informações principais*/

    if(cpf == ''){
		document.querySelector('.p-cpf').style.color = 'red';
		document.querySelector('.p-cpf').innerHTML = 'CPF (Obrigatório)';
        liberBTN = '1';
	}else if(cpf.length < 14){
		document.querySelector('.p-cpf').style.color = 'red';
		document.querySelector('.p-cpf').innerHTML = 'CPF (Inválido)';
        liberBTN = '1';
	}else{
		document.querySelector('.p-cpf').style.color = 'green';
		document.querySelector('.p-cpf').innerHTML = 'CPF';
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

    if(fantasia == ''){
		document.querySelector('.p-fantasia').style.color = 'red';
		document.querySelector('.p-fantasia').innerHTML = 'Fantasia (Obrigatório)';
        liberBTN = '1';
	}else if(fantasia.length < 2){
		document.querySelector('.p-fantasia').style.color = 'red';
		document.querySelector('.p-fantasia').innerHTML = 'Fantasia (Min. 2 letras)';
        liberBTN = '1';
	}else{
		document.querySelector('.p-fantasia').style.color = 'green';
		document.querySelector('.p-fantasia').innerHTML = 'Fantasia';
	}

    if(apelido == ''){
		document.querySelector('.p-apelido').style.color = 'red';
		document.querySelector('.p-apelido').innerHTML = 'Apelido (Obrigatório)';
        liberBTN = '1';
	}else if(apelido.length < 2){
		document.querySelector('.p-apelido').style.color = 'red';
		document.querySelector('.p-apelido').innerHTML = 'Apelido (Min. 2 letras)';
        liberBTN = '1';
	}else{
		document.querySelector('.p-apelido').style.color = 'green';
		document.querySelector('.p-apelido').innerHTML = 'Apelido';
	}

    if(nascimento == ''){
		document.querySelector('.p-nascimento').style.color = 'red';
		document.querySelector('.p-nascimento').innerHTML = 'Data de Nascimento (Obrigatório)';
        liberBTN = '1';
	}else if(nascimento.length < 10){
		document.querySelector('.p-nascimento').style.color = 'red';
		document.querySelector('.p-nascimento').innerHTML = 'Data de Nascimento (Inválido)';
        liberBTN = '1';
	}else{
		document.querySelector('.p-nascimento').style.color = 'green';
		document.querySelector('.p-nascimento').innerHTML = 'Data de Nascimento';
	}

    if(inscMunicipal == ''){
		document.querySelector('.p-municipal').style.color = 'black';
		document.querySelector('.p-municipal').innerHTML = 'Inscrição Municipal';
	}else if(inscMunicipal.length > 0 && inscMunicipal.length < 14){
		document.querySelector('.p-municipal').style.color = 'red';
		document.querySelector('.p-municipal').innerHTML = 'Inscrição Municipal (Inválido)';
        liberBTN = '1';
	}else{
		document.querySelector('.p-municipal').style.color = 'green';
		document.querySelector('.p-municipal').innerHTML = 'Inscrição Municipal';
	}

	if(inscEstadual == ''){
		document.querySelector('.p-estadual').style.color = 'black';
		document.querySelector('.p-estadual').innerHTML = 'Inscrição Estadual';
	}else if(inscEstadual.length > 0 && inscEstadual.length < 14){
		document.querySelector('.p-estadual').style.color = 'red';
		document.querySelector('.p-estadual').innerHTML = 'Incrição Estadual (Inválido)';
        liberBTN = '1';
	}else{
		document.querySelector('.p-estadual').style.color = 'green';
		document.querySelector('.p-estadual').innerHTML = 'Inscrição Estadual<b>*</b>';
	}

    /*Contato*/

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

	if(telefone == ''){
		document.querySelector('.p-telefone').style.color = 'red';
		document.querySelector('.p-telefone').innerHTML = 'Telefone (Obrigatório)';
        liberBTN = '1';
	}else if(telefone.length < 14){
		document.querySelector('.p-telefone').style.color = 'red';
		document.querySelector('.p-telefone').innerHTML = 'Telefone (Inválido)';
        liberBTN = '1';
	}else{
		document.querySelector('.p-telefone').style.color = 'green';
		document.querySelector('.p-telefone').innerHTML = 'Telefone';
	}

    /*Dados para login*/

	if(login == ''){
		document.querySelector('.p-login').style.color = 'red';
		document.querySelector('.p-login').innerHTML = 'Login (Obrigatório)';
        liberBTN = '1';
	}else if(login.length < 5){
		document.querySelector('.p-login').style.color = 'red';
		document.querySelector('.p-login').innerHTML = 'Login (Min. 5 caracteres)';
        liberBTN = '1';
	}else{
		document.querySelector('.p-login').style.color = 'green';
		document.querySelector('.p-login').innerHTML = 'Login';
	}

	if(senha == ''){
		document.querySelector('.p-senha').style.color = 'red';
		document.querySelector('.p-senha').innerHTML = 'Senha (Obrigatório)';
        liberBTN = '1';
	}else if(senha.length < 8){
		document.querySelector('.p-senha').style.color = 'red';
		document.querySelector('.p-senha').innerHTML = 'Senha (Min. 8 caracteres)';
        liberBTN = '1';
	}else{
		document.querySelector('.p-senha').style.color = 'green';
		document.querySelector('.p-senha').innerHTML = 'Senha';
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
    el: '#nascimento-cliente',
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