// ********** JOGAR OS DADOS DO ENDEREÇO NO FORMULÁRIO PARA EDITAR - BRUNO R. BERNAL - 12/05/2022 ********

function editAddress(id, CEP, address, number, complement, district, city, UF) {

    $("#idAddress").val(id);
    $("#CEP").val(CEP);
    $("#address").val(address);
    $("#number").val(number);
    $("#complement").val(complement);
    $("#district").val(district);
    $("#city").val(city);
    $("#UF").val(UF);
    validaFormAddress();
    $("#sectionClientAddress")[0].scrollIntoView({behavior: 'smooth'});

}

// ********** JOGAR OS DADOS DO ENDEREÇO NO FORMULÁRIO PARA EDITAR - BRUNO R. BERNAL - 12/05/2022 ********


// **************** ATUALIZAR TABELA DE ENDEREÇOS - BRUNO R. BERNAL - 12/05/2022 **************************

function updateAddressTable(id) {

    $.ajax({
        type: 'GET',
        url: http + main_directory + '/controller/client/table-address.php/?updateAddressTable=1&id=' + id + "&directory=" + directory,
        //data : data,
        dataType: 'html',
        success: function (data) {
            //showAlert('Pesquisa concluída com sucesso!', 'green', 3000);
            $('#listClientAddress').html(data);
            $("#listClientAddress")[0].scrollIntoView({behavior: 'smooth'});
        },
        error: function () {
            //showAlert('Não foi possível completar a requisição!', 'red', 3000);
        }
    });

}

// **************** FIM - ATUALIZAR TABELA DE ENDEREÇOS - BRUNO R. BERNAL - 12/05/2022 **************************

// ****************************** DELETAR ENDEREÇO CLIENTE - BRUNO R. BERNAL - 18/01/2022 **********************

function deleteClientAddress(id,client_id) {


    if (confirm('Deseja realmente deletar o endereço ?')) {
        $.ajax({
            type: 'POST',
            url: http + main_directory + "/model/client/client-model.php/?deleteClientAddress=1&directory=" + directory + '&id_user=' + id_user + '&id_company=' + id_company + '&id_contract=' + id_contract,
            data: '&client_id=' + client_id + '&id= ' + id,
            dataType: 'json',
            beforeSend: function () {
                loadShow();
            },
            success: function (response) {
                if (response.codigo == 1) {
                    loadHide();
                    showAlert(response.mensagem, 'green', 3000);
                    updateAddressTable(client_id);
                } else {
                    loadHide();
                    showAlert(response.mensagem, 'red', 3000);
                }
            },
            error: function () {
                loadHide();
                showAlert('Falha ao deletar o endereço!', 'red', 3000);
            }
        });
    } else {
        showAlert('O endereço não será deletado!', 'green', 3000);
    }

}

// ******************** FIM - DELETAR ENDEREÇO CLIENTE - BRUNO R. BERNAL - 18/01/2022 ***********************


// ************************* GRAVAR / EDITAR ENDEREÇO - BRUNO R. BERNAL - 18/01/2022 *********************

function saveClientAddress() {
    var data = $("#formClientAddress").serialize();
    var id = $("#id").val();




    $.ajax({

        url: http + main_directory + "/model/client/client-model.php/?saveClientAddress=1&directory=" + directory + "&id=" + id + '&id_user=' + id_user + '&id_company=' + id_company + '&id_contract=' + id_contract,
        type: 'POST',
        data: data,
        dataType: 'json',
        beforeSend: function () {
            loadShow();
            $("#btnSaveClientAddress").attr('disabled', true);
        },
        success: function (response) {
            loadHide();
            if (response.codigo == 1) {
                loadHide();
                showAlert(response.mensagem, 'green', 3000);
                $("#btnSaveClientAddress").attr('disabled', false);
                $("#formClientAddress")[0].reset();
                updateAddressTable(id);
            } else {
                loadHide();
                showAlert(response.mensagem, 'red', 3000);
                $("#btnSaveClientAddress").attr('disabled', false);
            }
        },
        error: function () {
            loadHide();
            showAlert('Não foi possível completar a requisição!', 'red', 3000);
            $("#btnSaveClientAddress").attr('disabled', false);
        }
    });



}

// ************************ FIM - GRAVAR / EDITAR ENDEREÇO - BRUNO R. BERNAL - 18/01/2022 ****************

// ************************* VALIDAR FORMULÁRIO ENDEREÇO - BRUNO R. BERNAL - 18/01/2022 ****************
function validaFormAddress() {
    var lockbtnAddress = "";

    if (validaInput("UF") == false) {
        lockbtnAddress = 1;
    }

    if (validaInput("city") == false) {
        lockbtnAddress = 1;
    }

    if (validaInput("district") == false) {
        lockbtnAddress = 1;
    }

    if (validaInput("number") == false) {
        lockbtnAddress = 1;
    }

    if (validaInput("address") == false) {
        lockbtnAddress = 1;
    }

    if (validaInput("CEP") == false) {
        lockbtnAddress = 1;
    }




    if (lockbtnAddress == "") {
        $("#btnSaveClientAddress").attr('disabled', false);
    } else {
        $("#btnSaveClientAddress").attr('disabled', true);
    }

}

// *********************** FIM - VALIDAR FORMULÁRIO ENDEREÇO - BRUNO R. BERNAL - 18/01/2022 **************

// ******************************** GRAVAR / EDITAR - BRUNO R. BERNAL - 18/01/2022 *********************

function saveClient() {
    var data = $("#formClient").serialize();




    $.ajax({

        url: http + main_directory + "/model/client/client-model.php/?saveClient=1&directory=" + directory + '&id_user=' + id_user + '&id_company=' + id_company + '&id_contract=' + id_contract,
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
                loadHide();
                showAlert(response.mensagem, 'green', 3000);
                window.location.href = '?pg=' + pg;
                if (pg != 'client') {
                    hideBtn();
                }
            } else {
                loadHide();
                showAlert('Erro: ' + response.mensagem, 'red', 3000);
                $("#btnSaveClient").attr('disabled', false);
            }
        },
        error: function () {
            loadHide();
            showAlert('Não foi possivel completar a requisição!', 'red', 3000);
            $("#btnSaveClient").attr('disabled', false);
        }
    });



}

// ********************************* FIM - GRAVAR / EDITAR - BRUNO R. BERNAL - 18/01/2022 ****************

// ********************************** VALIDAR FORMULÁRIO - BRUNO R. BERNAL - 18/01/2022 ****************
function validaForm() {
    var lockbtn = "";
    var cpf_cnpj = $("#cpf_cnpj").val();
    var phone = $("#phone").val();
    var email = $("#email").val();

    if (validaInput("email") == false) {
        lockbtn = 1;
    }

    if (validaInput("phone") == false) {
        lockbtn = 1;
    }


    if (validaInput("cpf_cnpj") == false) {
        lockbtn = 1;
    }

    if (validaInput("name_razSocial") == false) {
        lockbtn = 1;
    }

    if (validaInput("surname") == false) {
        lockbtn = 1;
    }


    if (lockbtn == "") {
        $("#btnSaveClient").attr('disabled', false);
    } else {
        $("#btnSaveClient").attr('disabled', true);
    }

}

function hideBtn() {
    $(".actionBtn").hide();
}

function showBtn() {
    $(".actionBtn").show();
}

// ***************************** FIM - VALIDAR FORMULÁRIO - BRUNO R. BERNAL - 18/01/2022 ****************


// ************************** PESQUISAR CLIENTE - BRUNO R. BERNAL - 18/01/2022 ************************

function searchClient() {
    var clientName = $("#clientName").val();

    $.ajax({
        type: 'GET',
        url: http + main_directory + '/controller/client/table.php/?searchClient=1&clientName=' + clientName + "&directory=" + directory + '&id_user=' + id_user + '&id_company=' + id_company + '&id_contract=' + id_contract,
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