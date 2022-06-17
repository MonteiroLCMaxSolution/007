var http = $("#http").val();
var directory = $("#directory").val();
var id_user = $("#id_user").val();
var id_company = $("#id_company").val();


// *************************************** VALIDAR FORMULÁRIO - BRUNO R. BERNAL - 14/01/2022 ****************
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
        $("#btnSaveCompany").attr('disabled', false);
    } else {
        $("#btnSaveCompany").attr('disabled', true);
    }
    
}

// *************************************** FIM - VALIDAR FORMULÁRIO - BRUNO R. BERNAL - 14/01/2022 ****************


// *************************************** GRAVAR / EDITAR - BRUNO R. BERNAL - 14/01/2022 *********************

function saveCompany() {
	var bloq = $("#bloq").val();
    var id = $("#id").val();
    var type = $("#type").val();
    var cpf_cnpj = $("#cpf_cnpj").val();
    var name_razSocial = $("#name_razSocial").val();
    var fantasia = $("#fantasia").val();
    var insc_municipal = $("#insc_municipal").val();
    var insc_estadual = $("#insc_estadual").val();
    var CEP = $("#CEP").val();
    var address = $("#address").val();
    var number = $("#number").val();
    var complement = $("#complement").val();
    var neighborhood = $("#neighborhood").val();
    var city = $("#city").val();
    var UF = $("#UF").val();
    var phone = $("#phone").val();
    var email = $("#email").val();
    var site = $("#site").val();
    var status = $("#status").val();
    var color_header = $("#color-header").val();
    var color_text = $("#color-text").val();
	var logo = $('#logo')[0].files[0];
	
	
	formData = new FormData();
	formData.append('bloq',bloq);
	formData.append('bloq',bloq);
	formData.append('bloq',bloq);
	formData.append('bloq',bloq);
	formData.append('bloq',bloq);
	formData.append('bloq',bloq);
	formData.append('bloq',bloq);
	formData.append('bloq',bloq);
	formData.append('bloq',bloq);
	formData.append('bloq',bloq);
	formData.append('bloq',bloq);
	formData.append('bloq',bloq);
	formData.append('bloq',bloq);
	formData.append('bloq',bloq);
	formData.append('bloq',bloq);
	formData.append('bloq',bloq);
	formData.append('id',id);
    formData.append('type',type);
    formData.append('cpf_cnpj',cpf_cnpj);
    formData.append('name_razSocial',name_razSocial);
    formData.append('fantasia',fantasia);
    formData.append('insc_municipal',insc_municipal);
    formData.append('insc_estadual',insc_estadual);
    formData.append('CEP',CEP);
    formData.append('address',address);
    formData.append('number',number);
    formData.append('complement',complement);
    formData.append('neighborhood',neighborhood);
    formData.append('city',city);
    formData.append('UF',UF);
    formData.append('phone',phone);
    formData.append('email',email);
    formData.append('site',site);
    formData.append('status',status);
    formData.append('color_header',color_header);
    formData.append('color_text',color_text);
    formData.append('logo',logo);
	formData.append('request',1);



    $.ajax({

        url: '../../MaxComanda/model/company/company-model.php/?saveCompany=1&directory='+directory+'&id_user='+id_user+'&id_company='+id_company,
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        dataType: 'json',
        beforeSend: function () {
            loadShow();
            $("#btnSaveCompany").attr('disabled',true);
        },
        success: function (response) {
			
            if (response.codigo == 1) {
                showAlert(response.mensagem, 'green', 3000);
                loadHide();
                window.location.href = http + '/view/?pg=company';
            } else {
               if(response.codigo == 0){
				    showAlert('Erro: ' + response.mensagem, 'red', 3000);
                	loadHide();
				   $("#btnSaveCompany").attr('disabled', false);
			   }else{
				    showAlert('Erro: ' + response.mensagem, 'red', 3000);
				   
                window.location.href = '../';
			   }
            }
        },
        error: function () {
            showAlert('Não foi possivel completar a requisição!', 'red', 3000);
            loadHide();
            $("#btnSaveCompany").attr('disabled', false);
        }
    });


}

// *************************************** FIM - GRAVAR / EDITAR - BRUNO R. BERNAL - 14/01/2022 ****************

// ********************************* PESQUISAR EMPRESA - BRUNO R. BERNAL - 16/01/2022 ************************

function searchCompany(){
	var companyName = $("#companyName").val();


	$.ajax({
		type : 'GET',
		url  : '../../MaxComanda/controller/company/table.php/?searchCompany=1&companyName='+companyName+"&directory="+directory+'&id_user='+id_user+'&id_company='+id_company,
			//data : data,
			dataType: 'html',
			success :  function(data){
                showAlert('Pesquisa concluída com sucesso!','green',3000);
					$('#listCompany').html(data);					
			},error: function(){
                showAlert('Não foi possível completar a requisição!','red',3000);
			}	
		});

}


// ****************************** FIM - PESQUISAR EMPRESA - BRUNO R. BERNAL - 16/01/2022 ***********************