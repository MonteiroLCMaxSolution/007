var directory = $("#directory").val();
var http = $("#http").val();

var id_user = $("#id_user").val();
var id_company = $("#id_company").val();

// ************************* LOGOUT - BRUNO R. BERNAL - 04/02/2022 ********************************
function logout() {


    if (confirm('Deseja realmente sair do Sistema?')) {


        $.ajax({
            type: 'GET',
            url: '../../MaxComanda/model/user/user-model.php/?logout=1',
            //data : data,
            dataType: 'html',
            success: function(data) {
                showAlert('Até Logo!', 'green', 3000);
                window.location.reload(1);
            },
            error: function() {
                showAlert('Não foi possível completar a requisição!', 'red', 3000);
            }
        });

    } else {

    }



}

// ************************* FIM - LOGOUT - BRUNO R. BERNAL - 04/02/2022 *********************************

// *************************************** GRAVAR / EDITAR - BRUNO R. BERNAL - 14/01/2022 *********************

function saveUser() {
    var id = $("#id").val();
	var id_company = $("#id_company").val();
    var cpf = $("#cpf").val();
    var name = $("#name").val();
	var surname = $("#surname").val();
    var CEP = $("#CEP").val();
    var address = $("#address").val();
    var number = $("#number").val();
    var complement = $("#complement").val();
    var neighborhood = $("#neighborhood").val();
    var city = $("#city").val();
    var UF = $("#UF").val();
    var phone = $("#phone").val();
    var email = $("#email").val();
    var status = $("#status").val();
	var profile = $("#profile").val();
	//var login = $("#login").val();
	var password = $("#password").val();
	var wage = $("#wage").val();
	var comission = $("#comission").val();
	var comission_status = $("#comission_status").val();
	var payday = $("#payday").val();
	var admission_date = $("#admission_date").val();
	var resignation_date = $("#resignation_date").val();
	var CNH = $("#CNH").val();
	var CNH_expiration = $("#CNH_expiration").val();
	var vehicle_license = $("#vehicle_license").val();
	var vehicle_owner = $("#vehicle_owner").val();
	var km_value = $("#km_value").val();
	var img = $('#img')[0].files[0];

	

    




    formData = new FormData();
	formData.append('id',id);
	formData.append('id_company',id_company);
    formData.append('cpf',cpf);
    formData.append('name',name);
	formData.append('surname',surname);
    formData.append('CEP',CEP);
    formData.append('address',address);
    formData.append('number',number);
    formData.append('complement',complement);
    formData.append('neighborhood',neighborhood);
    formData.append('city',city);
    formData.append('UF',UF);
    formData.append('phone',phone);
    formData.append('email',email);
    formData.append('status',status);
	formData.append('profile',profile);
	//formData.append('login',login);
	formData.append('password',password);
	formData.append('wage',wage);
	formData.append('comission',comission);
	formData.append('comission_status',comission_status);
	formData.append('payday',payday);
	formData.append('admission_date',admission_date);
	formData.append('resignation_date',resignation_date);
	formData.append('CNH',CNH);
	formData.append('CNH_expiration',CNH_expiration);
	formData.append('vehicle_license',vehicle_license);
	formData.append('vehicle_owner',vehicle_owner);
	formData.append('km_value',km_value);
    formData.append('img',img);
	formData.append('request',1);




    $.ajax({

        url: "../../MaxComanda/model/user/user-model.php/?saveUser=1&directory="+directory+'&id_user='+id_user+'&company_id='+id_company,
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        dataType: 'json',
        beforeSend: function () {
            loadShow();
            $("#btnSaveUser").attr('disabled',true);
        },
        success: function (response) {
            if (response.codigo == 1) {
                showAlert(response.mensagem, 'green', 3000);
                loadHide();
                window.location.href = http + '/view/?pg=user';
            } else {
                showAlert('Erro: ' + response.mensagem, 'red', 3000);
                loadHide();
                $("#btnSaveUser").attr('disabled', false);
            }
        },
        error: function () {
            showAlert('Não foi possivel completar a requisição!', 'red', 3000);
            loadHide();
            $("#btnSaveUser").attr('disabled', false);
        }
    });



}

// *************************************** FIM - GRAVAR / EDITAR - BRUNO R. BERNAL - 17/01/2022 ****************


// *************************************** VALIDAR FORMULÁRIO - BRUNO R. BERNAL - 17/01/2022 ****************
function validaForm() {
	var lockbtnTab1 = "";
	var lockbtnTab2 = "";
    var lockbtn = "";
    var cpf = $("#cpf").val();
    var name = $("#name").val();
	var surname = $("#surname").val();
	var profile = $("#profile").val();
    var cep = $("#CEP").val();
    var address = $("#address").val();
    var number = $("#number").val();
    var neighborhood = $("#neighborhood").val();
    var city = $("#city").val();
    var uf = $("#UF").val();
    var phone = $("#phone").val();
    var email = $("#email").val();
	//var login = $("#login").val();
    var status = $("#status").val();

	if (profile == "") {
        invalidInput('profile', 'msgProfile', 'Campo Obrigatório!*');
        lockbtnTab1 = 1;
    } else {
        validInput('profile', 'msgProfile', '');
    }

    if (status == "") {
        invalidInput('status', 'msgStatus', 'Campo Obrigatório!*');
        lockbtnTab1 = 1;
    } else {
        validInput('status', 'msgStatus', '');
    }

    if (email == "") {
        invalidInput('email', 'msgEmail', 'Campo Obrigatório!*');
        lockbtnTab1 = 1;
    } else if (validarEmail(email) == false) {
        invalidInput('email', 'msgEmail', 'Formato Inválido!*');
        lockbtnTab1 = 1;
    } else {
        validInput('email', 'msgEmail', '');
    }
/*
	if (login == "") {
        invalidInput('login', 'msgLogin', 'Campo Obrigatório!*');
        lockbtnTab1 = 1;
    } else {
        validInput('login', 'msgLogin', '');
    }*/

    if (phone == "") {
        invalidInput('phone', 'msgPhone', 'Campo Obrigatório!*');
        lockbtnTab2 = 1;
    } else if (phone.length < 14) {
        invalidInput('phone', 'msgPhone', 'Formato Inválido!*');
        lockbtnTab2 = 1;
    } else {
        validInput('phone', 'msgPhone', '');
    }

    if (uf == "") {
        invalidInput('UF', 'msgUF', 'Campo Obrigatório!*');
        lockbtnTab2 = 1;
    } else {
        validInput('UF', 'msgUF', '');
    }

    if (city == "") {
        invalidInput('city', 'msgCity', 'Campo Obrigatório!*');
        lockbtnTab2 = 1;
    } else {
        validInput('city', 'msgCity', '');
    }

    if (neighborhood == "") {
        invalidInput('neighborhood', 'msgNeighborhood', 'Campo Obrigatório!*');
        lockbtnTab2 = 1;
    } else {
        validInput('neighborhood', 'msgNeighborhood', '');
    }

    if (number == "") {
        invalidInput('number', 'msgNumber', 'Campo Obrigatório!*');
        lockbtnTab2 = 1;
    } else {
        validInput('number', 'msgNumber', '');
    }

    if (address == "") {
        invalidInput('address', 'msgAddress', 'Campo Obrigatório!*');
        lockbtnTab2 = 1;
    } else {
        validInput('address', 'msgAddress', '');
    }

    if (cep == "") {
        invalidInput('CEP', 'msgCEP', 'Campo Obrigatório!*');
        lockbtnTab2 = 1;
    } else if (cep.length < 9) {
        invalidInput('CEP', 'msgCEP', 'CEP Inválido!*');
        lockbtnTab2 = 1;
    } else if (cep.length == 9) {
        validInput('CEP', 'msgCEP', '');
    }

    if (cpf == "") {
        invalidInput('cpf', 'msgCPF', 'Campo Obrigatório!*');
        lockbtnTab1 = 1;
    } else if (cpf.length < 14) {
        invalidInput('cpf', 'msgCPF', 'CPF Inválido!*');
        lockbtnTab1 = 1;
    } else if (cpf.length == 14) {
        if (validarCPF(cpf) == false) {
            invalidInput('cpf', 'msgCPF', 'CPF Inválido!*');
            lockbtnTab1 = 1;
        } else {
            validInput('cpf', 'msgCPF', 'CPF Válido!');
        }
    }

    if (name == "") {
        invalidInput('name', 'msgName', 'Campo Obrigatório!*');
        lockbtnTab1 = 1;
    } else {
        validInput('name', 'msgName', '');
    }

	if (surname == "") {
        invalidInput('surname', 'msgSurname', 'Campo Obrigatório!*');
        lockbtnTab1 = 1;
    } else {
        validInput('surname', 'msgSurname', '');
    }

	if(lockbtnTab1 != ""){
		lockbtn = 1;
		$("#tab-principais").css('color','red');
	} else{
		$("#tab-principais").css('color','black');
	}

	if(lockbtnTab2 != ""){
		lockbtn = 1;
		$("#tab-endereco").css('color','red');
	} else{
		$("#tab-endereco").css('color','black');
	}

    if (lockbtn == "") {
        $("#btnSaveUser").attr('disabled', false);
    } else {
        $("#btnSaveUser").attr('disabled', true);
    }
    
}

// *************************************** FIM - VALIDAR FORMULÁRIO - BRUNO R. BERNAL - 17/01/2022 ****************

// ********************************* PESQUISAR USUÁRIO - BRUNO R. BERNAL - 17/01/2022 ************************

function searchUser(){
	var userName = $("#userName").val();


	$.ajax({
		type : 'GET',
		url  : '../../MaxComanda/controller/user/table.php/?searchUser=1&userName='+userName+"&directory="+directory+'&id_user='+id_user+'&id_company='+id_company,
			//data : data,
			dataType: 'html',
			success :  function(data){
                showAlert('Pesquisa concluída com sucesso!','green',3000);
					$('#listUser').html(data);					
			},error: function(){
                showAlert('Não foi possível completar a requisição!','red',3000);
			}	
		});

}


// ****************************** FIM - PESQUISAR USUÁRIO - BRUNO R. BERNAL - 17/01/2022 ***********************




// *************************************** LOGIN *************************************************************
function login(){
	var login = $('#email').val()
	var password = $("#password").val();
	
	$.ajax({
		url: '../MaxComanda/model/user/user-model.php/?access=1&login='+login+'&password='+password+"&directory="+directory,
		type: 'GET',
		dataType: 'json',
		success: function (data){
			if(data.code == 1){			
				$("#information").css('background','red');
				$("#information").css('color','white');
				$("#information").css("text-align", "center");
				if(data.message == 'É necessário informar os dados de sua empresa!'){
					window.location.href = '../'+directory+'/view/?pg=data-company&bloq=1';
					
					$("#user_id").val(data.user_id);
				}
			}else{
				$("#information").css('background','green');
				$("#information").css('color','white');
				$("#information").css("text-align", "center");
				
				window.location.href = '../'+directory+'/view';
			}
			$("#information").html(data.message);
		},Error: function(){
			$("#information").html('Erro ao acessar o sistema!');
		}
	})
}

// ******************************************* FIM - LOGIN **************************************************