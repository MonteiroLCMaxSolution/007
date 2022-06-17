function buscaCNPJ(valor) {
	var cnpj = valor;
	var lib = $("#lib").val();

	if (cnpj.length == 18) {
		//Início do Comando AJAX
		$.ajax({

			//O campo URL diz o caminho de onde virá os dados
			//É importante concatenar o valor digitado no CNPJ
			url: lib+'/lib/buscaCNPJ.php?cnpj=' + cnpj,

			//Atualização: caso use java, use cnpj.jsp, usando o outro exemplo.
			//Aqui você deve preencher o tipo de dados que será lido,
			//no caso, estamos lendo JSON.
			dataType: 'json',
			//SUCESS é referente a função que será executada caso
			//ele consiga ler a fonte de dados com sucesso.
			//O parâmetro dentro da função se refere ao nome da variável
			//que você vai dar para ler esse objeto.
			success: function (resposta) {
				//Confere se houve erro e o imprime
				if (resposta.status == "ERROR") {
					//alert(resposta.message + "\nPor favor, digite os dados manualmente.");
					//$("#form-inspecao-avancada #nome_raz_social").focus().select();
					//return false;
				}
				//Agora basta definir os valores que você deseja preencher
				//automaticamente nos campos acima.
				$("#name_razSocial").val(resposta.nome);
				$("#fantasia").val(resposta.fantasia);
				//$("#atividade").val(resposta.atividade_principal[0].text + " (" + resposta.atividade_principal[0].code + ")");
				//$("#NUM_TEL_1").val(resposta.telefone);
				$("#contactMail").val(resposta.email);
				$("#address").val(resposta.logradouro);
				$("#complement").val(resposta.complemento);
				$("#neighborhood").val(resposta.bairro);
				//$("#COD_CIDADE").val(resposta.municipio);
				//$("#COD_UF").val(resposta.uf);
				$("#number").val(resposta.numero);


				if (resposta.cep != "" || resposta.cep != null) {
					var cep = resposta.cep.replace('.', '');
					$("#CEP").val(cep);
					//buscaCEP(cep);
				}
				M.updateTextFields();
				validaForm();

			},
			error: function () {
				$("#name_razSocial").val("");
				$("#fantasia").val("");
				$("#contactMail").val("");
				$("#address").val("");
				$("#complement").val("");
				$("#neighborhood").val("");
				$("#number").val("");
				$("#CEP").val("");
				validaForm();
			}
		});
	} else if (cnpj.length < 18 && cnpj.length > 14) {
		$("#name_razSocial").val("");
		$("#fantasia").val("");
		$("#contactMail").val("");
		$("#address").val("");
		$("#complement").val("");
		$("#neighborhood").val("");
		$("#number").val("");
		$("#CEP").val("");
		validaForm();
	}

}