$('select').select2({
    width: 99999
});

$('#cnpj-fornecedor').mask('00.000.000/0000-00');
$('#cep-fornecedor').mask('00000-000');
$('#telefone-fornecedor').mask('(00) 0000-0000');//Aplicando máscara no telefone


function validarFormulario(){

    var cnpj = document.querySelector("#cnpj-fornecedor").value;
	var nome = document.querySelector("#nome-fornecedor").value;
    var fantasia = document.querySelector("#fantasia-fornecedor").value;
    var inscMunicipal = document.querySelector("#municipal-fornecedor").value;
    var inscEstadual = document.querySelector("#estadual-fornecedor").value;
    var cep = document.querySelector("#cep-fornecedor").value;
    var endereco = document.querySelector("#endereco-fornecedor").value;
    var numero = document.querySelector("#numero-fornecedor").value;
    var complemento = document.querySelector("#complemento-fornecedor").value;
    var bairro = document.querySelector("#bairro-fornecedor").value;
    var cidade = document.querySelector("#cidade-fornecedor").value;
    var uf = document.querySelector("#uf-fornecedor").value;
    var telefone = document.querySelector("#telefone-fornecedor").value;
    var contato = document.querySelector("#contato-fornecedor").value;
    var email = document.querySelector("#email-fornecedor").value;
    var site = document.querySelector("#site-fornecedor").value;
	var status = document.querySelector("#status-fornecedor").value;
    

    /*Informações principais*/

    if(cnpj == ''){
		document.querySelector('.p-cnpj').style.color = 'red';
		document.querySelector('.p-cnpj').innerHTML = 'CNPJ (Obrigatório)';
	}else if(cnpj.length < 18){
		document.querySelector('.p-cnpj').style.color = 'red';
		document.querySelector('.p-cnpj').innerHTML = 'CNPJ (Inválido)';
	}else{
		document.querySelector('.p-cnpj').style.color = 'green';
		document.querySelector('.p-cnpj').innerHTML = 'CNPJ';
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

    /*Endereço*/

    if(cep == ''){
		document.querySelector('.p-cep').style.color = 'red';
		document.querySelector('.p-cep').innerHTML = 'CEP (Obrigatório)';
	}else if(cep.length < 9){
		document.querySelector('.p-cep').style.color = 'red';
		document.querySelector('.p-cep').innerHTML = 'CEP (Inválido)';
	}else{
		document.querySelector('.p-cep').style.color = 'green';
		document.querySelector('.p-cep').innerHTML = 'CEP';
	}

    if(endereco == ''){
		document.querySelector('.p-endereco').style.color = 'red';
		document.querySelector('.p-endereco').innerHTML = 'Endereço (Obrigatório)';
	}else if(endereco.length < 2){
		document.querySelector('.p-endereco').style.color = 'red';
		document.querySelector('.p-endereco').innerHTML = 'Endereço (Inválido)';
	}else{
		document.querySelector('.p-endereco').style.color = 'green';
		document.querySelector('.p-endereco').innerHTML = 'Endereço';
	}

    if(numero == ''){
		document.querySelector('.p-numero').style.color = 'red';
		document.querySelector('.p-numero').innerHTML = 'Número (Obrigatório)';
	}else{
		document.querySelector('.p-numero').style.color = 'green';
		document.querySelector('.p-numero').innerHTML = 'Número';
	}

    if(complemento == ''){
		document.querySelector('.p-complemento').style.color = 'black';
		document.querySelector('.p-complemento').innerHTML = 'Complemento';
	}else{
		document.querySelector('.p-complemento').style.color = 'green';
		document.querySelector('.p-complemento').innerHTML = 'Complemento';
	}

    if(bairro == ''){
		document.querySelector('.p-bairro').style.color = 'red';
		document.querySelector('.p-bairro').innerHTML = 'Bairro (Obrigatório)';
	}else if(bairro.length < 2){
		document.querySelector('.p-bairro').style.color = 'red';
		document.querySelector('.p-bairro').innerHTML = 'Bairro (Inválido)';
	}else{
		document.querySelector('.p-bairro').style.color = 'green';
		document.querySelector('.p-bairro').innerHTML = 'Bairro';
	}

    if(cidade == ''){
		document.querySelector('.p-cidade').style.color = 'red';
		document.querySelector('.p-cidade').innerHTML = 'Cidade (Obrigatório)';
	}else if(cidade.length < 2){
		document.querySelector('.p-cidade').style.color = 'red';
		document.querySelector('.p-cidade').innerHTML = 'Cidade (Inválido)';
	}else{
		document.querySelector('.p-cidade').style.color = 'green';
		document.querySelector('.p-cidade').innerHTML = 'Cidade';
	}

    if(uf == ''){
		document.querySelector('.p-uf').style.color = 'red';
		document.querySelector('.p-uf').innerHTML = 'UF (Obrigatório)';
	}else if(uf.length < 2 || uf.length > 2){
		document.querySelector('.p-uf').style.color = 'red';
		document.querySelector('.p-uf').innerHTML = 'UF (Inválido)';
	}else{
		document.querySelector('.p-uf').style.color = 'green';
		document.querySelector('.p-uf').innerHTML = 'UF';
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

    if(contato == ''){
		document.querySelector('.p-contato').style.color = 'red';
		document.querySelector('.p-contato').innerHTML = 'Contato (Obrigatório)';
	}else if(contato.length < 2){
		document.querySelector('.p-contato').style.color = 'red';
		document.querySelector('.p-contato').innerHTML = 'Contato (Min. 2 letras)';
	}else{
		document.querySelector('.p-contato').style.color = 'green';
		document.querySelector('.p-contato').innerHTML = 'Contato';
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

    if(site == ''){
		document.querySelector('.p-site').style.color = 'red';
		document.querySelector('.p-site').innerHTML = 'Site (Obrigatório)';
	}else if(site.length < 18){
		document.querySelector('.p-site').style.color = 'red';
		document.querySelector('.p-site').innerHTML = 'Site (Inválido)';
    }else{
		document.querySelector('.p-site').style.color = 'green';
		document.querySelector('.p-site').innerHTML = 'Site';
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

    var cnpj = document.querySelector("#cnpj-fornecedor").value;
	var nome = document.querySelector("#nome-fornecedor").value;
    var fantasia = document.querySelector("#fantasia-fornecedor").value;
    var inscMunicipal = document.querySelector("#municipal-fornecedor").value;
    var inscEstadual = document.querySelector("#estadual-fornecedor").value;
    var cep = document.querySelector("#cep-fornecedor").value;
    var endereco = document.querySelector("#endereco-fornecedor").value;
    var numero = document.querySelector("#numero-fornecedor").value;
    var complemento = document.querySelector("#complemento-fornecedor").value;
    var bairro = document.querySelector("#bairro-fornecedor").value;
    var cidade = document.querySelector("#cidade-fornecedor").value;
    var uf = document.querySelector("#uf-fornecedor").value;
    var telefone = document.querySelector("#telefone-fornecedor").value;
    var contato = document.querySelector("#contato-fornecedor").value;
    var email = document.querySelector("#email-fornecedor").value;
    var site = document.querySelector("#site-fornecedor").value;
    var status = document.querySelector("#status-fornecedor").value;

    var liberBTN = '';

    /*Informações principais*/

    if(cnpj == ''){
		document.querySelector('.p-cnpj').style.color = 'red';
		document.querySelector('.p-cnpj').innerHTML = 'CNPJ (Obrigatório)';
        liberBTN = '1';
	}else if(cnpj.length < 18){
		document.querySelector('.p-cnpj').style.color = 'red';
		document.querySelector('.p-cnpj').innerHTML = 'CNPJ (Inválido)';
        liberBTN = '1';
	}else{
		document.querySelector('.p-cnpj').style.color = 'green';
		document.querySelector('.p-cnpj').innerHTML = 'CNPJ';
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
		document.querySelector('.p-estadual').innerHTML = 'Inscrição Estadual';
	}

    /*Endereço*/

    if(cep == ''){
		document.querySelector('.p-cep').style.color = 'red';
		document.querySelector('.p-cep').innerHTML = 'CEP (Obrigatório)';
        liberBTN = '1';
	}else if(cep.length < 9){
		document.querySelector('.p-cep').style.color = 'red';
		document.querySelector('.p-cep').innerHTML = 'CEP (Inválido)';
        liberBTN = '1';
	}else{
		document.querySelector('.p-cep').style.color = 'green';
		document.querySelector('.p-cep').innerHTML = 'CEP';
	}

    if(endereco == ''){
		document.querySelector('.p-endereco').style.color = 'red';
		document.querySelector('.p-endereco').innerHTML = 'Endereço (Obrigatório)';
        liberBTN = '1';
	}else if(endereco.length < 2){
		document.querySelector('.p-endereco').style.color = 'red';
		document.querySelector('.p-endereco').innerHTML = 'Endereço (Inválido)';
        liberBTN = '1';
	}else{
		document.querySelector('.p-endereco').style.color = 'green';
		document.querySelector('.p-endereco').innerHTML = 'Endereço';
	}

    if(numero == ''){
		document.querySelector('.p-numero').style.color = 'red';
		document.querySelector('.p-numero').innerHTML = 'Número (Obrigatório)';
        liberBTN = '1';
	}else{
		document.querySelector('.p-numero').style.color = 'green';
		document.querySelector('.p-numero').innerHTML = 'Número';
	}

    if(complemento == ''){
		document.querySelector('.p-complemento').style.color = 'black';
		document.querySelector('.p-complemento').innerHTML = 'Complemento';
	}else{
		document.querySelector('.p-complemento').style.color = 'green';
		document.querySelector('.p-complemento').innerHTML = 'Complemento';
	}

    if(bairro == ''){
		document.querySelector('.p-bairro').style.color = 'red';
		document.querySelector('.p-bairro').innerHTML = 'Bairro (Obrigatório)';
        liberBTN = '1';
	}else if(bairro.length < 2){
		document.querySelector('.p-bairro').style.color = 'red';
		document.querySelector('.p-bairro').innerHTML = 'Bairro (Inválido)';
        liberBTN = '1';
	}else{
		document.querySelector('.p-bairro').style.color = 'green';
		document.querySelector('.p-bairro').innerHTML = 'Bairro';
	}

    if(cidade == ''){
		document.querySelector('.p-cidade').style.color = 'red';
		document.querySelector('.p-cidade').innerHTML = 'Cidade (Obrigatório)';
        liberBTN = '1';
	}else if(cidade.length < 2){
		document.querySelector('.p-cidade').style.color = 'red';
		document.querySelector('.p-cidade').innerHTML = 'Cidade (Inválido)';
        liberBTN = '1';
	}else{
		document.querySelector('.p-cidade').style.color = 'green';
		document.querySelector('.p-cidade').innerHTML = 'Cidade';
	}

    if(uf == ''){
		document.querySelector('.p-uf').style.color = 'red';
		document.querySelector('.p-uf').innerHTML = 'UF (Obrigatório)';
        liberBTN = '1';
	}else if(uf.length < 2 || uf.length > 2){
		document.querySelector('.p-uf').style.color = 'red';
		document.querySelector('.p-uf').innerHTML = 'UF (Inválido)';
        liberBTN = '1';
	}else{
		document.querySelector('.p-uf').style.color = 'green';
		document.querySelector('.p-uf').innerHTML = 'UF';
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

    if(contato == ''){
		document.querySelector('.p-contato').style.color = 'red';
		document.querySelector('.p-contato').innerHTML = 'Contato (Obrigatório)';
        liberBTN = '1';
	}else if(contato.length < 2){
		document.querySelector('.p-contato').style.color = 'red';
		document.querySelector('.p-contato').innerHTML = 'Contato (Min. 2 letras)';
        liberBTN = '1';
	}else{
		document.querySelector('.p-contato').style.color = 'green';
		document.querySelector('.p-contato').innerHTML = 'Contato';
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

    if(site == ''){
		document.querySelector('.p-site').style.color = 'red';
		document.querySelector('.p-site').innerHTML = 'Site (Obrigatório)';
        liberBTN = '1';
	}else if(site.length < 18){
		document.querySelector('.p-site').style.color = 'red';
		document.querySelector('.p-site').innerHTML = 'Site (Inválido)';
        liberBTN = '1';
    }else{
		document.querySelector('.p-site').style.color = 'green';
		document.querySelector('.p-site').innerHTML = 'Site';
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
