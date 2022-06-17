function buscaCNPJ(cnpj, func = null) {

	var main_directory = $("#main_directory").val();
	var http = $("#http").val();

	if (cnpj.length == 18) {
		//Início do Comando AJAX
		$.ajax({

			//O campo URL diz o caminho de onde virá os dados
			//É importante concatenar o valor digitado no CNPJ
			url: http + main_directory + '/lib/buscaCNPJ.php?cnpj=' + cnpj,

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
			if(resposta != null){
					//Agora basta definir os valores que você deseja preencher
					//automaticamente nos campos acima.
					$("#name_razSocial").val(resposta.nome);
					$("#fantasia").val(resposta.fantasia);
					$("#email").val(resposta.email);
					$("#address").val(resposta.logradouro);
					$("#number").val(resposta.numero);
					$("#complement").val(resposta.complemento);
					$("#district").val(resposta.bairro);


					if (resposta.cep != "" && resposta.cep != null && resposta.cep != 'undefined' && resposta.cep != undefined) {
						var cep = resposta.cep.replace('.', '');
						$("#CEP").val(cep);
						buscaCEP(null,1);
					}
					if (func != null) {
						window[func]();
					}

				}
				

			},
			error: function () {
				/*$("#name_razSocial").val("");
				$("#fantasia").val("");
				$("#email").val("");
				$("#address").val("");
				$("#complement").val("");
				$("#district").val("");
				$("#number").val("");
				$("#CEP").val("");
				if(func != null){
                    window[func]();
                }*/
			}
		});
	}

}