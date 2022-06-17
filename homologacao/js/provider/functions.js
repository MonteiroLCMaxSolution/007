var http = $("#http").val();
var directory = $("#directory").val();
var id_user = $("#id_user").val();
var id_company = $("#id_company").val();
// *************************************** GRAVAR / EDITAR - BRUNO R. BERNAL - 18/01/2022 *********************

function saveProvider() {
    var data = $("#formProvider").serialize();

    $.ajax({

        url: "../../MaxComanda/model/provider/provider-model.php/?saveProvider=1&directory="+directory+'&id_user='+id_user+'&id_company='+id_company,
        type: 'POST',
        data: data,
        dataType: 'json',
        beforeSend: function () {
            loadShow();
            $("#btnSaveProvider").attr('disabled',true);
        },
        success: function (response) {
            if (response.codigo == 1) {
                showAlert(response.mensagem, 'green', 3000);
                loadHide();
                window.location.href = http + '/view/?pg=provider';
            } else {
                showAlert('Erro: ' + response.mensagem, 'red', 3000);
                loadHide();
                $("#btnSaveProvider").attr('disabled', false);
            }
        },
        error: function () {
            showAlert('Não foi possivel completar a requisição!', 'red', 3000);
            loadHide();
            $("#btnSaveProvider").attr('disabled', false);
        }
    });



}

// *************************************** FIM - GRAVAR / EDITAR - BRUNO R. BERNAL - 18/01/2022 ****************


// ********************************* PESQUISAR FORNECEDOR - BRUNO R. BERNAL - 18/01/2022 ************************

function searchProvider(){
	var providerName = $("#providerName").val();


	$.ajax({
		type : 'GET',
		url  : '../../MaxComanda/controller/provider/table.php/?searchProvider=1&providerName='+providerName+"&directory="+directory+'&id_user='+id_user+'&id_company='+id_company,
			//data : data,
			dataType: 'html',
			success :  function(data){
                showAlert('Pesquisa concluída com sucesso!','green',3000);
					$('#listProvider').html(data);					
			},error: function(){
                showAlert('Não foi possível completar a requisição!','red',3000);
			}	
		});

}


// ****************************** FIM - PESQUISAR FORNECEDOR - BRUNO R. BERNAL - 18/01/2022 ***********************


// *************************************** VALIDAR FORMULÁRIO - BRUNO R. BERNAL - 18/01/2022 ****************
function validaForm() {
    var lockbtn = "";
    var cpf_cnpj = $("#cpf_cnpj").val();
    var name_razSocial = $("#name_razSocial").val();
    var cep = $("#CEP").val();
    var address = $("#address").val();
    var number = $("#number").val();
    var neighborhood = $("#neighborhood").val();
    var city = $("#city").val();
    var uf = $("#UF").val();
    var phone = $("#phone").val();
    var email = $("#email").val();
    var status = $("#status").val();

    if (status == "") {
        invalidInput('status', 'msgStatus', 'Campo Obrigatório!*');
        lockbtn = 1;
    } else {
        validInput('status', 'msgStatus', '');
    }

    if (email == "") {
        invalidInput('email', 'msgEmail', 'Campo Obrigatório!*');
        lockbtn = 1;
    } else if (validarEmail(email) == false) {
        invalidInput('email', 'msgEmail', 'Formato Inválido!*');
        lockbtn = 1;
    } else {
        validInput('email', 'msgEmail', '');
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

    if (uf == "") {
        invalidInput('UF', 'msgUF', 'Campo Obrigatório!*');
        lockbtn = 1;
    } else {
        validInput('UF', 'msgUF', '');
    }

    if (city == "") {
        invalidInput('city', 'msgCity', 'Campo Obrigatório!*');
        lockbtn = 1;
    } else {
        validInput('city', 'msgCity', '');
    }

    if (neighborhood == "") {
        invalidInput('neighborhood', 'msgNeighborhood', 'Campo Obrigatório!*');
        lockbtn = 1;
    } else {
        validInput('neighborhood', 'msgNeighborhood', '');
    }

    if (number == "") {
        invalidInput('number', 'msgNumber', 'Campo Obrigatório!*');
        lockbtn = 1;
    } else {
        validInput('number', 'msgNumber', '');
    }

    if (address == "") {
        invalidInput('address', 'msgAddress', 'Campo Obrigatório!*');
        lockbtn = 1;
    } else {
        validInput('address', 'msgAddress', '');
    }

    if (cep == "") {
        invalidInput('CEP', 'msgCEP', 'Campo Obrigatório!*');
        lockbtn = 1;
    } else if (cep.length < 9) {
        invalidInput('CEP', 'msgCEP', 'CEP Inválido!*');
        lockbtn = 1;
    } else if (cep.length == 9) {
        validInput('CEP', 'msgCEP', '');
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

    if (lockbtn == "") {
        $("#btnSaveProvider").attr('disabled', false);
    } else {
        $("#btnSaveProvider").attr('disabled', true);
    }
    
}

// *************************************** FIM - VALIDAR FORMULÁRIO - BRUNO R. BERNAL - 18/01/2022 ****************