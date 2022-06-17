$('#select-perfil-usuario').select2({
    width: 99999
});

$('#cpf-usuario').mask('000.000.000-00');
$('#telefone-usuario').mask('(00) 0000-0000');//Aplicando máscara no telefone
$('#cep-usuario').mask('00000-000');
$('#data-contratacao-usuario').mask('00/00/0000');
$('#data-demissao-usuario').mask('00/00/0000');
$('#validade-cnh-usuario').mask('00/00');


function validarFormulario(){

    var cpf = document.querySelector("#cpf-usuario").value;
	var nome = document.querySelector("#nome-usuario").value;
    var apelido = document.querySelector("#apelido-usuario").value;
    var perfil = document.querySelector("#select-perfil-usuario").value;
    var email = document.querySelector("#email-usuario").value;
    var telefone = document.querySelector("#telefone-usuario").value;
    var senha = document.querySelector("#senha-usuario").value;
    var status = document.querySelector("#select-status-usuario").value;
    var imagem = document.querySelector("#imagem-usuario").value;
    var cep = document.querySelector("#cep-usuario").value;
    var endereco = document.querySelector("#endereco-usuario").value;
    var numero = document.querySelector("#numero-usuario").value;
    var complemento = document.querySelector("#complemento-usuario").value;
    var bairro = document.querySelector("#bairro-usuario").value;
    var cidade = document.querySelector("#cidade-usuario").value;
    var uf = document.querySelector("#uf-usuario").value;
    var salario = document.querySelector("#salario-usuario").value;
    var comissao = document.querySelector("#comissao-usuario").value;
    var statusComissao = document.querySelector("#select-status-comissao").value;
    var diaPagamento = document.querySelector("#dia-pagamento-usuario").value;
    var dataContratacao = document.querySelector("#data-contratacao-usuario").value;
    var dataDemissao = document.querySelector("#data-demissao-usuario").value;
    var cnh = document.querySelector("#cnh-usuario").value;
    var validadeCnh = document.querySelector("#validade-cnh-usuario").value;
    var placaVeiculo = document.querySelector("#placa-veiculo-usuario").value;
    var proprietarioVeiculo = document.querySelector("#proprietario-veiculo-usuario").value;
    var valorKm = document.querySelector("#valor-km-usuario").value;
    

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
		document.querySelector('.p-nome').innerHTML = 'Nome (Obrigatório)';
	}else if(nome.length < 2){
		document.querySelector('.p-nome').style.color = 'red';
		document.querySelector('.p-nome').innerHTML = 'Nome (Min. 2 letras)';
	}else{
		document.querySelector('.p-nome').style.color = 'green';
		document.querySelector('.p-nome').innerHTML = 'Nome';
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

    if(perfil == 'nulo'){
		document.querySelector('.p-perfil').style.color = 'red';
		document.querySelector('.p-perfil').innerHTML = 'Perfil (Obrigatório)';
	}else{
		document.querySelector('.p-perfil').style.color = 'green';
		document.querySelector('.p-perfil').innerHTML = 'Perfil';
	}

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
		document.querySelector('.p-status').innerHTML = 'Status (Obrigatório)';
	}else{
		document.querySelector('.p-status').style.color = 'green';
		document.querySelector('.p-status').innerHTML = 'Status';
	}

    if(imagem == ''){
        document.querySelector('.p-imagem').style.color = 'red';
        document.querySelector('.p-imagem').innerHTML = 'Imagem (Obrigatório)';
    }else{
        idxDot = imagem.lastIndexOf(".") + 1,
        extFile = imagem.substr(idxDot, imagem.length).toLowerCase();
    
        if (extFile=="jpg" || extFile=="jpeg" || extFile=="png"){
            document.querySelector('.p-imagem').style.color = 'green';
            document.querySelector('.p-imagem').innerHTML = 'Imagem';
        }else{
            document.querySelector('.p-imagem').style.color = 'red';
            document.querySelector('.p-imagem').innerHTML = 'Imagem (Inválido)';
        }
    }

    /*Endereço*/

    if(cep == ''){
		document.querySelector('.p-cep').style.color = 'red';
		document.querySelector('.p-cep').innerHTML = 'CEP (Obrigatório)';
	}else if(cep.length != 9){
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
	}else if(uf.length != 2){
		document.querySelector('.p-uf').style.color = 'red';
		document.querySelector('.p-uf').innerHTML = 'UF (Inválido)';
	}else{
		document.querySelector('.p-uf').style.color = 'green';
		document.querySelector('.p-uf').innerHTML = 'UF';
	}

    /*Informações adicionais*/

    if(salario == ''){
		document.querySelector('.p-salario').style.color = 'black';
		document.querySelector('.p-salario').innerHTML = 'Salário';
	}else if(salario.length > 0 && salario < 0){
		document.querySelector('.p-salario').style.color = 'red';
		document.querySelector('.p-salario').innerHTML = 'Salário (Inválido)';
	}else{
		document.querySelector('.p-salario').style.color = 'green';
		document.querySelector('.p-salario').innerHTML = 'Salário';
	}

    if(comissao == ''){
		document.querySelector('.p-comissao').style.color = 'black';
		document.querySelector('.p-comissao').innerHTML = 'Comissão';
	}else if(salario.length > 0 && salario < 0){
		document.querySelector('.p-comissao').style.color = 'red';
		document.querySelector('.p-comissao').innerHTML = 'Comissão (Min. 2 letras)';
	}else{
		document.querySelector('.p-comissao').style.color = 'green';
		document.querySelector('.p-comissao').innerHTML = 'Comissão';
	}

	if(statusComissao != 'ativo' && statusComissao != 'inativo' && statusComissao != 'nulo'){
		document.querySelector('.p-status-comissao').style.color = 'red';
		document.querySelector('.p-status-comissao').innerHTML = 'Status Comissão (Inválido)';
	}else{
		document.querySelector('.p-status-comissao').style.color = 'green';
		document.querySelector('.p-status-comissao').innerHTML = 'Status Comissão';
	}

    if(diaPagamento == ''){
		document.querySelector('.p-dia-pagamento').style.color = 'black';
		document.querySelector('.p-dia-pagamento').innerHTML = 'Dia de pagamento';
	}else if(diaPagamento.length > 0 && diaPagamento <= 0 || diaPagamento > 31){
		document.querySelector('.p-dia-pagamento').style.color = 'red';
		document.querySelector('.p-dia-pagamento').innerHTML = 'Dia de pagamento (Inválido)';
	}else{
		document.querySelector('.p-dia-pagamento').style.color = 'green';
		document.querySelector('.p-dia-pagamento').innerHTML = 'Dia de pagamento';
	}

    if(dataContratacao == ''){
		document.querySelector('.p-data-contratacao').style.color = 'black';
		document.querySelector('.p-data-contratacao').innerHTML = 'Data - Contratação';
	}else if(dataContratacao.length != 10){
		document.querySelector('.p-data-contratacao').style.color = 'red';
		document.querySelector('.p-data-contratacao').innerHTML = 'Data - Contratação (Inválido)';
	}else{
		document.querySelector('.p-data-contratacao').style.color = 'green';
		document.querySelector('.p-data-contratacao').innerHTML = 'Data - Contratação';
	}


    if(dataDemissao == ''){
		document.querySelector('.p-data-demissao').style.color = 'black';
		document.querySelector('.p-data-demissao').innerHTML = 'Data - Demissão';
	}else if(dataDemissao.length != 10){
		document.querySelector('.p-data-demissao').style.color = 'red';
		document.querySelector('.p-data-demissao').innerHTML = 'Data - Demissão (Inválido)';
	}else{
		document.querySelector('.p-data-demissao').style.color = 'green';
		document.querySelector('.p-data-demissao').innerHTML = 'Data - Demissão';
	}

    /*Delivery*/


    if(cnh == ''){
		document.querySelector('.p-cnh').style.color = 'black';
		document.querySelector('.p-cnh').innerHTML = 'CNH';
	}else if(cnh.length != 10){
		document.querySelector('.p-cnh').style.color = 'red';
		document.querySelector('.p-cnh').innerHTML = 'CNH (Inválido)';
	}else{
		document.querySelector('.p-cnh').style.color = 'green';
		document.querySelector('.p-cnh').innerHTML = 'CNH';
	}

    if(validadeCnh == ''){
		document.querySelector('.p-validade-cnh').style.color = 'black';
		document.querySelector('.p-validade-cnh').innerHTML = 'Validade CNH';
	}else if(validadeCnh.length < 5){
		document.querySelector('.p-validade-cnh').style.color = 'red';
		document.querySelector('.p-validade-cnh').innerHTML = 'Validade CNH (Inválido)';
	}else{
		document.querySelector('.p-validade-cnh').style.color = 'green';
		document.querySelector('.p-validade-cnh').innerHTML = 'Validade CNH';
	}

    if(placaVeiculo == ''){
		document.querySelector('.p-placa-veiculo').style.color = 'black';
		document.querySelector('.p-placa-veiculo').innerHTML = 'Placa do veículo';
	}else if(placaVeiculo.length > 0 && placaVeiculo.length != 7){
		document.querySelector('.p-placa-veiculo').style.color = 'red';
		document.querySelector('.p-placa-veiculo').innerHTML = 'Placa do veículo (Inválido)';
	}else{
		document.querySelector('.p-placa-veiculo').style.color = 'green';
		document.querySelector('.p-placa-veiculo').innerHTML = 'Placa do veículo';
    }

    if(proprietarioVeiculo == ''){
		document.querySelector('.p-proprietario-veiculo').style.color = 'black';
		document.querySelector('.p-proprietario-veiculo').innerHTML = 'Proprietário do veículo';
	}else if(proprietarioVeiculo.length < 2){
		document.querySelector('.p-proprietario-veiculo').style.color = 'red';
		document.querySelector('.p-proprietario-veiculo').innerHTML = 'Proprietário do veículo (Min. 2 letras)';
	}else{
		document.querySelector('.p-proprietario-veiculo').style.color = 'green';
		document.querySelector('.p-proprietario-veiculo').innerHTML = 'Proprietário do veículo';
	}

    if(valorKm == ''){
		document.querySelector('.p-valor-km').style.color = 'black';
		document.querySelector('.p-valor-km').innerHTML = 'Valor KM Rodado';
	}else if(valorKm < 0){
		document.querySelector('.p-valor-km').style.color = 'red';
		document.querySelector('.p-valor-km').innerHTML = 'Valor KM Rodado (Inválido)';
	}else{
		document.querySelector('.p-valor-km').style.color = 'green';
		document.querySelector('.p-valor-km').innerHTML = 'Valor KM Rodado';
	}

}

document.querySelector('#btn-enviar-form').onclick = function(){

    var cpf = document.querySelector("#cpf-usuario").value;
	var nome = document.querySelector("#nome-usuario").value;
    var apelido = document.querySelector("#apelido-usuario").value;
    var perfil = document.querySelector("#select-perfil-usuario").value;
    var email = document.querySelector("#email-usuario").value;
    var telefone = document.querySelector("#telefone-usuario").value;
    var senha = document.querySelector("#senha-usuario").value;
    var status = document.querySelector("#select-status-usuario").value;
    var imagem = document.querySelector("#imagem-usuario").value;
    var cep = document.querySelector("#cep-usuario").value;
    var endereco = document.querySelector("#endereco-usuario").value;
    var numero = document.querySelector("#numero-usuario").value;
    var complemento = document.querySelector("#complemento-usuario").value;
    var bairro = document.querySelector("#bairro-usuario").value;
    var cidade = document.querySelector("#cidade-usuario").value;
    var uf = document.querySelector("#uf-usuario").value;
    var salario = document.querySelector("#salario-usuario").value;
    var comissao = document.querySelector("#comissao-usuario").value;
    var statusComissao = document.querySelector("#select-status-comissao").value;
    var diaPagamento = document.querySelector("#dia-pagamento-usuario").value;
    var dataContratacao = document.querySelector("#data-contratacao-usuario").value;
    var dataDemissao = document.querySelector("#data-demissao-usuario").value;
    var cnh = document.querySelector("#cnh-usuario").value;
    var validadeCnh = document.querySelector("#validade-cnh-usuario").value;
    var placaVeiculo = document.querySelector("#placa-veiculo-usuario").value;
    var proprietarioVeiculo = document.querySelector("#proprietario-veiculo-usuario").value;
    var valorKm = document.querySelector("#valor-km-usuario").value;

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
		document.querySelector('.p-nome').innerHTML = 'Nome (Obrigatório)';
		liberBTN = '1';
	}else if(nome.length < 2){
		document.querySelector('.p-nome').style.color = 'red';
		document.querySelector('.p-nome').innerHTML = 'Nome (Min. 2 letras)';
		liberBTN = '1';
	}else{
		document.querySelector('.p-nome').style.color = 'green';
		document.querySelector('.p-nome').innerHTML = 'Nome';
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

    if(perfil == 'nulo'){
		document.querySelector('.p-perfil').style.color = 'red';
		document.querySelector('.p-perfil').innerHTML = 'Perfil (Obrigatório)';
		liberBTN = '1';
	}else{
		document.querySelector('.p-perfil').style.color = 'green';
		document.querySelector('.p-perfil').innerHTML = 'Perfil';
	}

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
		document.querySelector('.p-status').innerHTML = 'Status (Obrigatório)';
		liberBTN = '1';
	}else{
		document.querySelector('.p-status').style.color = 'green';
		document.querySelector('.p-status').innerHTML = 'Status';
	}

    if(imagem == ''){
        document.querySelector('.p-imagem').style.color = 'red';
        document.querySelector('.p-imagem').innerHTML = 'Imagem (Obrigatório)';
		liberBTN = '1';
    }else{
        idxDot = imagem.lastIndexOf(".") + 1,
        extFile = imagem.substr(idxDot, imagem.length).toLowerCase();
    
        if (extFile=="jpg" || extFile=="jpeg" || extFile=="png"){
            document.querySelector('.p-imagem').style.color = 'green';
            document.querySelector('.p-imagem').innerHTML = 'Imagem';
        }else{
            document.querySelector('.p-imagem').style.color = 'red';
            document.querySelector('.p-imagem').innerHTML = 'Imagem (Inválido)';
			liberBTN = '1';
        }
    }

    /*Endereço*/

    if(cep == ''){
		document.querySelector('.p-cep').style.color = 'red';
		document.querySelector('.p-cep').innerHTML = 'CEP (Obrigatório)';
		liberBTN = '1';
	}else if(cep.length != 9){
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
	}else if(uf.length != 2){
		document.querySelector('.p-uf').style.color = 'red';
		document.querySelector('.p-uf').innerHTML = 'UF (Inválido)';
		liberBTN = '1';
	}else{
		document.querySelector('.p-uf').style.color = 'green';
		document.querySelector('.p-uf').innerHTML = 'UF';
	}

    /*Informações adicionais*/

    if(salario == ''){
		document.querySelector('.p-salario').style.color = 'black';
		document.querySelector('.p-salario').innerHTML = 'Salário';
	}else if(salario.length > 0 && salario < 0){
		document.querySelector('.p-salario').style.color = 'red';
		document.querySelector('.p-salario').innerHTML = 'Salário (Inválido)';
		liberBTN = '1';
	}else{
		document.querySelector('.p-salario').style.color = 'green';
		document.querySelector('.p-salario').innerHTML = 'Salário';
	}

    if(comissao == ''){
		document.querySelector('.p-comissao').style.color = 'black';
		document.querySelector('.p-comissao').innerHTML = 'Comissão';
	}else if(salario.length > 0 && salario < 0){
		document.querySelector('.p-comissao').style.color = 'red';
		document.querySelector('.p-comissao').innerHTML = 'Comissão (Min. 2 letras)';
		liberBTN = '1';
	}else{
		document.querySelector('.p-comissao').style.color = 'green';
		document.querySelector('.p-comissao').innerHTML = 'Comissão';
	}

	if(statusComissao != 'ativo' && statusComissao != 'inativo' && statusComissao != 'nulo'){
		document.querySelector('.p-status-comissao').style.color = 'red';
		document.querySelector('.p-status-comissao').innerHTML = 'Status Comissão (Inválido)';
		liberBTN = '1';
	}else{
		document.querySelector('.p-status-comissao').style.color = 'green';
		document.querySelector('.p-status-comissao').innerHTML = 'Status Comissão';
	}

    if(diaPagamento == ''){
		document.querySelector('.p-dia-pagamento').style.color = 'black';
		document.querySelector('.p-dia-pagamento').innerHTML = 'Dia de pagamento';
	}else if(diaPagamento.length > 0 && diaPagamento <= 0 || diaPagamento > 31){
		document.querySelector('.p-dia-pagamento').style.color = 'red';
		document.querySelector('.p-dia-pagamento').innerHTML = 'Dia de pagamento (Inválido)';
		liberBTN = '1';
	}else{
		document.querySelector('.p-dia-pagamento').style.color = 'green';
		document.querySelector('.p-dia-pagamento').innerHTML = 'Dia de pagamento';
	}

    if(dataContratacao == ''){
		document.querySelector('.p-data-contratacao').style.color = 'black';
		document.querySelector('.p-data-contratacao').innerHTML = 'Data - Contratação';
	}else if(dataContratacao.length != 10){
		document.querySelector('.p-data-contratacao').style.color = 'red';
		document.querySelector('.p-data-contratacao').innerHTML = 'Data - Contratação (Inválido)';
		liberBTN = '1';
	}else{
		document.querySelector('.p-data-contratacao').style.color = 'green';
		document.querySelector('.p-data-contratacao').innerHTML = 'Data - Contratação';
	}


    if(dataDemissao == ''){
		document.querySelector('.p-data-demissao').style.color = 'black';
		document.querySelector('.p-data-demissao').innerHTML = 'Data - Demissão';
	}else if(dataDemissao.length != 10){
		document.querySelector('.p-data-demissao').style.color = 'red';
		document.querySelector('.p-data-demissao').innerHTML = 'Data - Demissão (Inválido)';
		liberBTN = '1';
	}else{
		document.querySelector('.p-data-demissao').style.color = 'green';
		document.querySelector('.p-data-demissao').innerHTML = 'Data - Demissão';
	}

    /*Delivery*/


    if(cnh == ''){
		document.querySelector('.p-cnh').style.color = 'black';
		document.querySelector('.p-cnh').innerHTML = 'CNH';
	}else if(cnh.length != 10){
		document.querySelector('.p-cnh').style.color = 'red';
		document.querySelector('.p-cnh').innerHTML = 'CNH (Inválido)';
		liberBTN = '1';
	}else{
		document.querySelector('.p-cnh').style.color = 'green';
		document.querySelector('.p-cnh').innerHTML = 'CNH';
	}

    if(validadeCnh == ''){
		document.querySelector('.p-validade-cnh').style.color = 'black';
		document.querySelector('.p-validade-cnh').innerHTML = 'Validade CNH';
	}else if(validadeCnh.length < 5){
		document.querySelector('.p-validade-cnh').style.color = 'red';
		document.querySelector('.p-validade-cnh').innerHTML = 'Validade CNH (Inválido)';
		liberBTN = '1';
	}else{
		document.querySelector('.p-validade-cnh').style.color = 'green';
		document.querySelector('.p-validade-cnh').innerHTML = 'Validade CNH';
	}

    if(placaVeiculo == ''){
		document.querySelector('.p-placa-veiculo').style.color = 'black';
		document.querySelector('.p-placa-veiculo').innerHTML = 'Placa do veículo';
	}else if(placaVeiculo.length > 0 && placaVeiculo.length != 7){
		document.querySelector('.p-placa-veiculo').style.color = 'red';
		document.querySelector('.p-placa-veiculo').innerHTML = 'Placa do veículo (Inválido)';
		liberBTN = '1';
	}else{
		document.querySelector('.p-placa-veiculo').style.color = 'green';
		document.querySelector('.p-placa-veiculo').innerHTML = 'Placa do veículo';
    }

    if(proprietarioVeiculo == ''){
		document.querySelector('.p-proprietario-veiculo').style.color = 'black';
		document.querySelector('.p-proprietario-veiculo').innerHTML = 'Proprietário do veículo';
	}else if(proprietarioVeiculo.length < 2){
		document.querySelector('.p-proprietario-veiculo').style.color = 'red';
		document.querySelector('.p-proprietario-veiculo').innerHTML = 'Proprietário do veículo (Min. 2 letras)';
		liberBTN = '1';
	}else{
		document.querySelector('.p-proprietario-veiculo').style.color = 'green';
		document.querySelector('.p-proprietario-veiculo').innerHTML = 'Proprietário do veículo';
	}

    if(valorKm == ''){
		document.querySelector('.p-valor-km').style.color = 'black';
		document.querySelector('.p-valor-km').innerHTML = 'Valor KM Rodado';
	}else if(valorKm < 0){
		document.querySelector('.p-valor-km').style.color = 'red';
		document.querySelector('.p-valor-km').innerHTML = 'Valor KM Rodado (Inválido)';
		liberBTN = '1';
	}else{
		document.querySelector('.p-valor-km').style.color = 'green';
		document.querySelector('.p-valor-km').innerHTML = 'Valor KM Rodado';
	}

	if(liberBTN == ''){
		return true; //habilita
	}else{
        $('html,body').animate({'scrollTop':'0'},800);
		return false; //desabilita
	}

};

const myDatePicker1 = MCDatepicker.create({ 
    el: '#data-contratacao-usuario',
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
    el: '#data-demissao-usuario',
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
