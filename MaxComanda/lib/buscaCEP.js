function buscaCEP(cep) {
    var cep = cep;
    //Início do Comando AJAX
    $.ajax({
        //O campo URL diz o caminho de onde virá os dados
        //É importante concatenar o valor digitado no CEP
        url: 'https://viacep.com.br/ws/' + cep + '/json/unicode/',
        //Aqui você deve preencher o tipo de dados que será lido,
        //no caso, estamos lendo JSON.
        dataType: 'json',
        //BEFOREND - Limpar os campos antes de consultar
        beforeSend: function () {
            $("#city").val("Aguarde...");
            $("#UF").val("Aguarde...");
            //$("#ibge").val = ("Aguarde...");
        },
        //SUCESS é referente a função que será executada caso
        //ele consiga ler a fonte de dados com sucesso.
        //O parâmetro dentro da função se refere ao nome da variável
        //que você vai dar para ler esse objeto.
        success: function (resposta) {
            //Agora basta definir os valores que você deseja preencher
            //automaticamente nos campos acima.

           // if (resposta.logradouro != "" && $("#address").val("") == true) {
                $("#address").val(resposta.logradouro);
           // }

          //  if (resposta.complemento != "" && $("#complement").val("") == true) {
                $("#complement").val(resposta.complemento);
           // }

          //  if (resposta.bairro != "" && $("#neighborhood").val("") == true) {
                $("#neighborhood").val(resposta.bairro);
          //  }

            $("#city").val(resposta.localidade);
            $("#UF").val(resposta.uf);
            //$("#ibge").val(resposta.ibge);
            //Vamos incluir para que o Endereço seja focado automaticamente
            //melhorando a experiência do usuário
            //$("#ENDERECO").focus();
            M.updateTextFields();
            validaForm();
        },
        error: function () {
            //mostraDialogo('CEP não Encontrado!', 'warning', 3000);
            $("#address").val("");
            $("#number").val("");
            $("#complement").val("");
            $("#neighborhood").val("");
            $("#city").val("");
            $("#UF").val("");
            M.updateTextFields();
            validaForm();
        }
    });
}



function buscaCEPDelivery(cep) {
    var cep = cep;
    //Início do Comando AJAX
    if (cep.length == 9) {
        $.ajax({
            //O campo URL diz o caminho de onde virá os dados
            //É importante concatenar o valor digitado no CEP
            url: 'https://viacep.com.br/ws/' + cep + '/json/unicode/',
            //Aqui você deve preencher o tipo de dados que será lido,
            //no caso, estamos lendo JSON.
            dataType: 'json',
            //BEFOREND - Limpar os campos antes de consultar
            beforeSend: function () {
                $("#address").val("Aguarde...");
                $("#complement").val("Aguarde...");
                $("#neighborhood").val("Aguarde...");
                $("#city").val("Aguarde...");
                $("#UF").val("Aguarde...");
                //$("#ibge").val = ("Aguarde...");
            },
            //SUCESS é referente a função que será executada caso
            //ele consiga ler a fonte de dados com sucesso.
            //O parâmetro dentro da função se refere ao nome da variável
            //que você vai dar para ler esse objeto.
            success: function (resposta) {
                //Agora basta definir os valores que você deseja preencher
                //automaticamente nos campos acima.
                $("#address").val(resposta.logradouro);
                $("#complement").val(resposta.complemento);
                $("#neighborhood").val(resposta.bairro);
                $("#city").val(resposta.localidade);
                $("#UF").val(resposta.uf);
                //$("#ibge").val(resposta.ibge);
                //Vamos incluir para que o Endereço seja focado automaticamente
                //melhorando a experiência do usuário
                //$("#ENDERECO").focus();
                M.updateTextFields();
            },
            error: function () {
                //mostraDialogo('CEP não Encontrado!', 'warning', 3000);
                $("#address").val("");
                $("#number").val("");
                $("#complement").val("");
                $("#neighborhood").val("");
                $("#city").val("");
                $("#UF").val("");
                M.updateTextFields();
            }
        });
    }
}