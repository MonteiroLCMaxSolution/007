var directory = $("#directory").val();
var http = $("#http").val();
var id_user = $("#id_user").val();
var id_company = $("#id_company").val();

// ********* DELETAR ENDEREÇO CLIENTE - BRUNO R. BERNAL - 18/01/2022 ***********

function deleteClientAddress(id, client_id) {

    var id = id;
    var client_id = client_id;



    if (confirm('Deseja realmente deletar o endereço ?')) {
        $.ajax({
            type: 'POST',
            url: "../../MaxComanda/controller/client/table-address.php/?deleteClientAddress=1&directory=" + directory+'&id_user='+id_user+'&id_company='+id_company,
            data: '&client_id=' + client_id + '&id= ' + id,
            dataType: 'html',
            beforeSend: function () {
                loadShow();
            },
            success: function (data) {
                loadHide();
                showAlert('Endereço deletado com Sucesso!', 'green', 3000);
                $('#listClientAddress').html(data);
                $('.modal').modal();
            },
            error: function () {
                loadHide();
                showAlert('Falha ao deletar o endereço!', 'red', 3000);
                $('#listClientAddress').html(data);
                $('.modal').modal();
            }
        });
    } else {

        showAlert('O endereço não será deletado!', 'green', 3000);
        $('.modal').modal();
    }

}

// ********* FIM - DELETAR ENDEREÇO CLIENTE - BRUNO R. BERNAL - 18/01/2022 ***********

// ************************** BUSCA CEP ENDEREÇO CLIENTE - BRUNO R. BERNAL - 18/01/2022 *****************

function buscaCEPCliente(id) {
    var id = id;
    var cep = $("#CEP" + id).val();
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
            $("#address" + id).val = ("Aguarde...");
            $("#complement" + id).val = ("Aguarde...");
            $("#neighborhood" + id).val = ("Aguarde...");
            $("#city" + id).val = ("Aguarde...");
            $("#UF" + id).val = ("Aguarde...");
            //$("#ibge_entrega"+id).val=("Aguarde...");
            $("#number" + id).val = ("Aguarde...");
        },
        //SUCESS é referente a função que será executada caso
        //ele consiga ler a fonte de dados com sucesso.
        //O parâmetro dentro da função se refere ao nome da variável
        //que você vai dar para ler esse objeto.
        success: function (resposta) {
            //Agora basta definir os valores que você deseja preencher
            //automaticamente nos campos acima.
            $("#address" + id).val(resposta.logradouro);
            $("#complement" + id).val(resposta.complemento);
            $("#neighborhood" + id).val(resposta.bairro);
            $("#city" + id).val(resposta.localidade);
            $("#UF" + id).val(resposta.uf);
            //$("#ibge_entrega"+id).val(resposta.ibge);
            $("#number" + id).val(resposta.numero);
            //Vamos incluir para que o Endereço seja focado automaticamente
            //melhorando a experiência do usuário
            $("#address" + id).focus();
        },
        errorerror: function () {
            //mostraDialogo('CEP não Encontrado!', 'warning', 3000);
        }
    });
}

// ********************* FIM - BUSCA CEP ENDEREÇO CLIENTE - BRUNO R. BERNAL - 18/01/2022 ****************

// ******************************* EDITAR ENDEREÇO CLIENTE - BRUNO R. BERNAL - 18/01/2022 *************

function editClientAddress(id, client_id) {
    var client_id = client_id;
    var id = id;
    var CEP = $("#CEP" + id).val();
    var address = $("#address" + id).val();
    var number = $("#number" + id).val();
    var complement = $("#complement" + id).val();
    var neighborhood = $("#neighborhood" + id).val();
    var city = $("#city" + id).val();
    var UF = $("#UF" + id).val();


    $.ajax({

        url: "../../MaxComanda/controller/client/table-address.php/?editClientAddress=1&directory=" + directory + "&id=" + id + "&client_id=" + client_id + "&CEP=" + CEP + "&address=" + address + "&number=" + number + "&complement=" + complement + "&neighborhood=" + neighborhood + "&city=" + city + "&UF=" + UF+'&id_user='+id_user+'&id_company='+id_company,
        type: 'GET',
        //data: data,
        dataType: 'html',
        beforeSend: function () {
            loadShow();
            $("#btnEditClientAddress" + id).attr('disabled', true);
        },
        success: function (data) {
            loadHide();
            showAlert('Endereço Adicionado com Sucesso!', 'green', 3000);
            $('#listClientAddress').html(data);
            $('.modal').modal();
        },
        error: function () {
            loadHide();
            showAlert('Não foi possível completar a requisição!', 'red', 3000);
            $("#btnEditClientAddress" + id).attr('disabled', false);
            $('.modal').modal();
        }
    });


}

// *************************** FIM - EDITAR ENDEREÇO CLIENTE - BRUNO R. BERNAL - 18/01/2022 *************

// ******************************* LISTAR ENDEREÇOS - BRUNO R. BERNAL - 18/01/2022 *********************

function searchAddress(id) {
    var id = id;





    $.ajax({

        url: "../../MaxComanda/controller/client/table-address.php/?searchClientAddress=1&directory=" + directory + "&id=" + id+'&id_user='+id_user+'&id_company='+id_company,
        type: 'POST',
        //data: data,
        dataType: 'html',
        success: function (data) {
            $('#listClientAddress').html(data);
            $('.modal').modal();
        },
        error: function () {
            showAlert('Não foi possível encontrar os Endereços deste Cliente!', 'red', 3000);
        }
    });



}

// ************************** FIM - LISTAR ENDEREÇOS - BRUNO R. BERNAL - 18/01/2022 ****************

// ************************* GRAVAR / EDITAR ENDEREÇO - BRUNO R. BERNAL - 18/01/2022 *********************

function addClientAddress(id) {
    var data = $("#formClientAddress").serialize();
    var id = id;




    $.ajax({

        url: "../../MaxComanda/controller/client/table-address.php/?saveClientAddress=1&directory=" + directory + "&id=" + id+'&id_user='+id_user+'&id_company='+id_company,
        type: 'POST',
        data: data,
        dataType: 'html',
        beforeSend: function () {
            loadShow();
            $("#btnSaveClientAddress").attr('disabled', true);
        },
        success: function (data) {
            loadHide();
            showAlert('Endereço Adicionado com Sucesso!', 'green', 3000);
            $('#listClientAddress').html(data);
            $('.modal').modal();
            $("#CEP").val("");
            $("#address").val("");
            $("#number").val("");
            $("#complement").val("");
            $("#neighborhood").val("");
            $("#city").val("");
            $("#UF").val("");
        },
        error: function () {
            loadHide();
            showAlert('Não foi possível completar a requisição!', 'red', 3000);
            $("#btnSaveClientAddress").attr('disabled', false);
            $('.modal').modal();
        }
    });



}

// ************************ FIM - GRAVAR / EDITAR ENDEREÇO - BRUNO R. BERNAL - 18/01/2022 ****************

// ************************* VALIDAR FORMULÁRIO ENDEREÇO - BRUNO R. BERNAL - 18/01/2022 ****************
function validaFormAddress() {
    var lockbtnAddress = "";
    var cep = $("#CEP").val();
    var address = $("#address").val();
    var number = $("#number").val();
    var neighborhood = $("#neighborhood").val();
    var city = $("#city").val();
    var uf = $("#UF").val();


    if (uf == "") {
        invalidInput('UF', 'msgUF', 'Campo Obrigatório!*');
        lockbtnAddress = 1;
    } else {
        validInput('UF', 'msgUF', '');
    }

    if (city == "") {
        invalidInput('city', 'msgCity', 'Campo Obrigatório!*');
        lockbtnAddress = 1;
    } else {
        validInput('city', 'msgCity', '');
    }

    if (neighborhood == "") {
        invalidInput('neighborhood', 'msgNeighborhood', 'Campo Obrigatório!*');
        lockbtnAddress = 1;
    } else {
        validInput('neighborhood', 'msgNeighborhood', '');
    }

    if (number == "") {
        invalidInput('number', 'msgNumber', 'Campo Obrigatório!*');
        lockbtnAddress = 1;
    } else {
        validInput('number', 'msgNumber', '');
    }

    if (address == "") {
        invalidInput('address', 'msgAddress', 'Campo Obrigatório!*');
        lockbtnAddress = 1;
    } else {
        validInput('address', 'msgAddress', '');
    }

    if (cep == "") {
        invalidInput('CEP', 'msgCEP', 'Campo Obrigatório!*');
        lockbtnAddress = 1;
    } else if (cep.length < 9) {
        invalidInput('CEP', 'msgCEP', 'CEP Inválido!*');
        lockbtnAddress = 1;
    } else if (cep.length == 9) {
        validInput('CEP', 'msgCEP', '');
    }




    if (lockbtnAddress == "") {
        $("#btnSaveClientAddress").attr('disabled', false);
    } else {
        $("#btnSaveClientAddress").attr('disabled', true);
    }

}


function validaFormEditAddress(id) {
    var id = id;
    var lockbtnEditAddress = "";
    var cep = $("#CEP" + id).val();
    var address = $("#address" + id).val();
    var number = $("#number" + id).val();
    var neighborhood = $("#neighborhood" + id).val();
    var city = $("#city" + id).val();
    var uf = $("#UF" + id).val();


    if (uf == "") {
        invalidInput('UF' + id, 'msgUF' + id, 'Campo Obrigatório!*');
        lockbtnEditAddress = 1;
    } else {
        validInput('UF' + id, 'msgUF' + id, '');
    }

    if (city == "") {
        invalidInput('city' + id, 'msgCity' + id, 'Campo Obrigatório!*');
        lockbtnEditAddress = 1;
    } else {
        validInput('city' + id, 'msgCity' + id, '');
    }

    if (neighborhood == "") {
        invalidInput('neighborhood' + id, 'msgNeighborhood' + id, 'Campo Obrigatório!*');
        lockbtnEditAddress = 1;
    } else {
        validInput('neighborhood' + id, 'msgNeighborhood' + id, '');
    }

    if (number == "") {
        invalidInput('number' + id, 'msgNumber' + id, 'Campo Obrigatório!*');
        lockbtnEditAddress = 1;
    } else {
        validInput('number' + id, 'msgNumber' + id, '');
    }

    if (address == "") {
        invalidInput('address' + id, 'msgAddress' + id, 'Campo Obrigatório!*');
        lockbtnEditAddress = 1;
    } else {
        validInput('address' + id, 'msgAddress' + id, '');
    }

    if (cep == "") {
        invalidInput('CEP' + id, 'msgCEP' + id, 'Campo Obrigatório!*');
        lockbtnEditAddress = 1;
    } else if (cep.length < 9) {
        invalidInput('CEP' + id, 'msgCEP' + id, 'CEP Inválido!*');
        lockbtnEditAddress = 1;
    } else if (cep.length == 9) {
        validInput('CEP' + id, 'msgCEP' + id, '');
    }




    if (lockbtnEditAddress == "") {
        $("#btnEditClientAddress" + id).attr('disabled', false);
    } else {
        $("#btnEditClientAddress" + id).attr('disabled', true);
    }

}

// *********************** FIM - VALIDAR FORMULÁRIO ENDEREÇO - BRUNO R. BERNAL - 18/01/2022 **************

// ******************************** GRAVAR / EDITAR - BRUNO R. BERNAL - 18/01/2022 *********************

function saveClient() {
    var data = $("#formClient").serialize();



    $.ajax({

        url: "../../MaxComanda/model/client/client-model.php/?saveClient=1&directory=" + directory+'&id_user='+id_user+'&id_company='+id_company,
        type: 'POST',
        data: data,
        dataType: 'json',
        beforeSend: function () {
            loadShow();
            $("#btnSaveClient").attr('disabled', true);
        },
        success: function (response) {
            if (response.codigo == 1) {
                var pg = response.pg;
                showAlert(response.mensagem, 'green', 3000);
                loadHide();
                window.location.href = http + '/view/?pg='+pg;
                if(pg != 'client'){
                    hideBtn();
                }
            } else {
                showAlert('Erro: ' + response.mensagem, 'red', 3000);
                loadHide();
                $("#btnSaveClient").attr('disabled', false);
            }
        },
        error: function () {
            showAlert('Não foi possivel completar a requisição!', 'red', 3000);
            loadHide();
            $("#btnSaveClient").attr('disabled', false);
        }
    });



}

// ********************************* FIM - GRAVAR / EDITAR - BRUNO R. BERNAL - 18/01/2022 ****************

// ********************************** VALIDAR FORMULÁRIO - BRUNO R. BERNAL - 18/01/2022 ****************
function validaForm() {
    var lockbtn = "";
    var cpf_cnpj = $("#cpf_cnpj").val();
    var name_razSocial = $("#name_razSocial").val();
    var surname = $("#surname").val();
    var phone = $("#phone").val();
    var email = $("#email").val();
    var login = $("#login").val();

    if (email == "") {
        invalidInput('email', 'msgEmail', 'Campo Obrigatório!*');
        lockbtn = 1;
    } else if (validarEmail(email) == false) {
        invalidInput('email', 'msgEmail', 'Formato Inválido!*');
        lockbtn = 1;
    } else {
        validInput('email', 'msgEmail', '');
    }

    if (login == "") {
        invalidInput('login', 'msgLogin', 'Campo Obrigatório!*');
        lockbtn = 1;
    } else {
        validInput('login', 'msgLogin', '');
    }

    if (phone == "") {
        invalidInput('phone', 'msgPhone', 'Campo Obrigatório!*');
        lockbtn = 1;
    } else if (phone.length < 14) {
        invalidInput('phone', 'msgPhone', 'Formato Inválido!*');
        lockbtn = 1;
    } else {
        validInput('phone', 'msgPhone', '');
    }


    if (cpf_cnpj == "") {
        invalidInput('cpf_cnpj', 'msgCPFCNPJ', 'Campo Obrigatório!*');
        $("#type").val("");
        lockbtn = 1;
    } else if (cpf_cnpj.length < 14 || (cpf_cnpj > 14 && cpf_cnpj < 18)) {
        invalidInput('cpf_cnpj', 'msgCPFCNPJ', 'CPF / CNPJ Inválido!*');
        $("#type").val("");
        lockbtn = 1;
    } else if (cpf_cnpj.length == 14) {
        if (validarCPF(cpf_cnpj) == false) {
            invalidInput('cpf_cnpj', 'msgCPFCNPJ', 'CPF Inválido!*');
            $("#type").val("");
            lockbtn = 1;
        } else {
            validInput('cpf_cnpj', 'msgCPFCNPJ', 'CPF Válido!');
            $("#type").val("Física");
        }
        $("#lCPFCNPJ").text('CPF');
        $("#lName_RazSocial").text('Nome');
        $(".formCNPJ").hide();
    } else if (cpf_cnpj.length == 18) {
        if (validarCNPJ(cpf_cnpj) == false) {
            invalidInput('cpf_cnpj', 'msgCPFCNPJ', 'CNPJ Inválido!*');
            $("#type").val("");
            lockbtn = 1;
        } else {
            validInput('cpf_cnpj', 'msgCPFCNPJ', 'CNPJ Válido!');
            $("#type").val("Jurídica");
        }
        $("#lCPFCNPJ").text('CNPJ');
        $("#lName_RazSocial").text('Razão Social');
        $(".formCNPJ").show();
    }

    if (name_razSocial == "") {
        invalidInput('name_razSocial', 'msgNameRazSocial', 'Campo Obrigatório!*');
        lockbtn = 1;
    } else {
        validInput('name_razSocial', 'msgNameRazSocial', '');
    }

    if (surname == "") {
        invalidInput('surname', 'msgSurname', 'Campo Obrigatório!*');
        lockbtn = 1;
    } else {
        validInput('surname', 'msgSurname', '');
    }


    if (lockbtn == "") {
        $("#btnSaveClient").attr('disabled', false);
    } else {
        $("#btnSaveClient").attr('disabled', true);
    }

}

function hideBtn(){
    $(".actionBtn").hide();
}

function showBtn(){
    $(".actionBtn").show();
}

// ***************************** FIM - VALIDAR FORMULÁRIO - BRUNO R. BERNAL - 18/01/2022 ****************


// ************************** PESQUISAR CLIENTE - BRUNO R. BERNAL - 18/01/2022 ************************

function searchClient() {
    var clientName = $("#clientName").val();


    $.ajax({
        type: 'GET',
        url: '../../MaxComanda/controller/client/table.php/?searchClient=1&clientName=' + clientName+"&directory="+directory+'&id_user='+id_user+'&id_company='+id_company,
        //data : data,
        dataType: 'html',
        success: function (data) {
            showAlert('Pesquisa concluída com sucesso!', 'green', 3000);
            $('#listClient').html(data);
        },
        error: function () {
            showAlert('Não foi possível completar a requisição!', 'red', 3000);
        }
    });

}


// ************************ FIM - PESQUISAR CLIENTE - BRUNO R. BERNAL - 18/01/2022 ***********************