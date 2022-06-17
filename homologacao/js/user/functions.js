// **************** ALTERAR EMPRESAS ONDE O USUÁRIO ESTÁ CADASTRADO - BRUNO R. BERNAL - 20/05/2022 *************

function registerCompany(company){
    var checked = $("#"+company).prop( "checked" );
    var id = $("#id").val();
    $.ajax({

        url: http +  main_directory + '/model/user/user-model.php/?registerCompany=1',
        type: 'POST',
        data: 'id_company=' + id_company + '&id_user=' + id_user + '&company=' + company + '&checked=' + checked + '&id_contract=' + id_contract + '&id=' + id,
        dataType: 'json',
        beforeSend: function () {
            loadShow();
            $("#btnSaveUser").attr('disabled', true);
            $("#formUser").css('opacity',0.3);
        },
        success: function (response) {
            if (response.codigo == 1) {
                loadHide();
                showAlert(response.mensagem, 'green', 5000);                
                $("#formUser").css('opacity',1);
            } else {
                loadHide();
                showAlert('Erro: ' + response.mensagem, 'red', 5000);                
                $("#btnSaveUser").attr('disabled', false);
                $("#formUser").css('opacity',1);
                if(checked == true){
                    $("#"+company).prop("checked", false);
                }else{
                    $("#"+company).prop("checked", true);
                }
            }
        },
        error: function () {
            loadHide();
            showAlert('Não foi possivel completar a requisição!', 'red', 5000);            
            $("#btnSaveUser").attr('disabled', false);
            $("#formUser").css('opacity',1);
            if(checked == true){
                $("#"+company).prop("checked", false);
            }else{
                $("#"+company).prop("checked", true);
            }
        }
    });


}

// ************ FIM - ALTERAR EMPRESAS ONDE O USUÁRIO ESTÁ CADASTRADO - BRUNO R. BERNAL - 20/05/2022 ***********


// ************************* LOGOUT - BRUNO R. BERNAL - 04/02/2022 ********************************
function logout() {
    if (confirm('Deseja realmente sair do Sistema?')) {
        $.ajax({
            type: 'GET',
            url: http + main_directory + '/model/user/user-model.php/?logout=1',
            //data : data,
            dataType: 'html',
            success: function (data) {
                window.location.href = http + '/' + directory + '/view';

                window.location.href = http + '/' + directory + '/view';
            },
            error: function () {
                alert('Não foi possível completar sua requisição!');
            }
        });

    } else {

    }
}

// ************************* FIM - LOGOUT - BRUNO R. BERNAL - 04/02/2022 *********************************

// *************************************** GRAVAR / EDITAR - BRUNO R. BERNAL - 14/01/2022 *********************

function saveUser() {

    var id = $("#id").val();
    var cpf = $("#cpf").val();
    var name = $("#name").val();
    var surname = $("#surname").val();
    var CEP = $("#CEP").val();
    var address = $("#address").val();
    var number = $("#number").val();
    var complement = $("#complement").val();
    var district = $("#district").val();
    var city = $("#city").val();
    var UF = $("#UF").val();
    var phone = $("#phone").val();
    var email = $("#email").val();
    var status = $("#status").val();
    var profile = $("#profile").val();
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
    var company = new Array();
	$("input[name='company[]']:checked").each(function ()
	{
	   company.push( $(this).val());	
	});


 
    formData = new FormData();
    formData.append('directory', directory);
    formData.append('id_user', id_user);
    formData.append('id_company', id_company);
    formData.append('company', company);
    formData.append('id_contract', id_contract);
    formData.append('id', id);
    formData.append('cpf', cpf);
    formData.append('name', name);
    formData.append('surname', surname);
    formData.append('CEP', CEP);
    formData.append('address', address);
    formData.append('number', number);
    formData.append('complement', complement);
    formData.append('district', district);
    formData.append('city', city);
    formData.append('UF', UF);
    formData.append('phone', phone);
    formData.append('email', email);
    formData.append('status', status);
    formData.append('profile', profile);
    formData.append('password', password);
    formData.append('wage', wage);
    formData.append('comission', comission);
    formData.append('comission_status', comission_status);
    formData.append('payday', payday);
    formData.append('admission_date', admission_date);
    formData.append('resignation_date', resignation_date);
    formData.append('CNH', CNH);
    formData.append('CNH_expiration', CNH_expiration);
    formData.append('vehicle_license', vehicle_license);
    formData.append('vehicle_owner', vehicle_owner);
    formData.append('km_value', km_value);
    formData.append('img', img);
    formData.append('request', 1);
    $.ajax({

        url: http +  main_directory + '/model/user/user-model.php/?saveUser=1',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        dataType: 'json',
        beforeSend: function () {
            loadShow();
            $("#btnSaveUser").attr('disabled', true);
        },
        success: function (response) {
            if (response.codigo == 1) {
                loadHide();
                showAlert(response.mensagem, 'green', 5000);                
                window.location.href = '?pg=user';
            } else {
                loadHide();
                showAlert('Erro: ' + response.mensagem, 'red', 5000);                
                $("#btnSaveUser").attr('disabled', false);
            }
        },
        error: function () {
            loadHide();
            showAlert('Não foi possivel completar a requisição!', 'red', 5000);            
            $("#btnSaveUser").attr('disabled', false);
        }
    });
}

// *************************************** FIM - GRAVAR / EDITAR - BRUNO R. BERNAL - 17/01/2022 ****************


// *************************************** VALIDAR FORMULÁRIO - BRUNO R. BERNAL - 17/01/2022 ****************
function validaForm() {
    var lockbtn = "";
    var cpf = $("#cpf").val();
    var cep = $("#CEP").val();
    var phone = $("#phone").val();
    var email = $("#email").val();
	var company  = $("#company").val();
	if(company == ""){
		$("#company").css("border", "1px solid red");
        $("#p-company").css("color", "red");
        $("#p-company").text("Informe a empresa!*");
        lockbtn = 1;
	}else{
        $("#company").css("border", "1px solid #ccc");
        $("#p-company").css("color", "black");
        $("#p-company").text("Empresa");		
	}

    if (validaInput("profile") == false) {
        lockbtn = 1;
    }

    if (validaInput("status") == false) {
        lockbtn = 1;
    }

    if (email == "") {
        $("#email").css("border", "1px solid red");
        $("#p-email").css("color", "red");
        $("#p-email").text("Email: Campo Obrigatório!*");
        lockbtn = 1;
    } else if (validarEmail(email) == false) {
        $("#email").css("border", "1px solid red");
        $("#p-email").css("color", "red");
        $("#p-email").text("Email: Formato Inválido!*");
        lockbtn = 1;
    } else {
        $("#email").css("border", "1px solid #ccc");
        $("#p-email").css("color", "black");
        $("#p-email").text("Email");
    }


    if (phone == "") {
        $("#phone").css("border", "1px solid red");
        $("#p-phone").css("color", "red");
        $("#p-phone").text("Telefone: Campo Obrigatório!*");
        lockbtn = 1;
    } else if (phone.length < 14) {
        $("#phone").css("border", "1px solid red");
        $("#p-phone").css("color", "red");
        $("#p-phone").text("Telefone: Formato Inválido!*");
        lockbtn = 1;
    } else {
        $("#phone").css("border", "1px solid #ccc");
        $("#p-phone").css("color", "black");
        $("#p-phone").text("Telefone");
    }

    if (validaInput("UF") == false) {
        lockbtn = 1;
    }

    if (validaInput("city") == false) {
        lockbtn = 1;
    }

    if (validaInput("district") == false) {
        lockbtn = 1;
    }

    if (validaInput("number") == false) {
        lockbtn = 1;
    }

    if (validaInput("address") == false) {
        lockbtn = 1;
    }

    if (cep == "") {
        $("#CEP").css("border", "1px solid red");
        $("#p-CEP").css("color", "red");
        $("#p-CEP").text("CEP: Campo Obrigatório!*");
        lockbtn = 1;
    } else if (cep.length < 9) {
        $("#CEP").css("border", "1px solid red");
        $("#p-CEP").css("color", "red");
        $("#p-CEP").text("CEP Inválido!*");
        lockbtn = 1;
    } else if (cep.length == 9) {
        $("#CEP").css("border", "1px solid #ccc");
        $("#p-CEP").css("color", "black");
        $("#p-CEP").text("CEP");
    }

    if (cpf == "") {
        $("#cpf").css("border", "1px solid red");
        $("#p-cpf").css("color", "red");
        $("#p-cpf").text("CPF: Campo Obrigatório!*");
        lockbtn = 1;
    } else if (cpf.length < 14) {
        $("#cpf").css("border", "1px solid red");
        $("#p-cpf").css("color", "red");
        $("#p-cpf").text("CPF Inválido!*");
        lockbtn = 1;
    } else if (cpf.length == 14) {
        if (validarCPF(cpf) == false) {
            $("#cpf").css("border", "1px solid red");
            $("#p-cpf").css("color", "red");
            $("#p-cpf").text("CPF Inválido!*");
            lockbtn = 1;
        } else {
            $("#cpf").css("border", "1px solid #ccc");
            $("#p-cpf").css("color", "black");
            $("#p-cpf").text("CPF");
        }
    }

    if (validaInput("name") == false) {
        lockbtn = 1;
    }

    if (validaInput("surname") == false) {
        lockbtn = 1;
    }




    if (lockbtn == "") {
        $("#btnSaveUser").attr('disabled', false);
    } else {
        $("#btnSaveUser").attr('disabled', true);
    }

}

// *************************************** FIM - VALIDAR FORMULÁRIO - BRUNO R. BERNAL - 17/01/2022 ****************

// ********************************* PESQUISAR USUÁRIO - BRUNO R. BERNAL - 17/01/2022 ************************

function searchUser() {
    var userName = $("#userName").val();

    $.ajax({
        type: 'POST',
        url: http + main_directory + '/controller/user/table.php/?searchUser=1',
        data: 'userName=' + userName + "&directory=" + directory + '&id_user=' + id_user + '&id_company=' + id_company + '&id_contract=' + id_contract,
        dataType: 'html',
        success: function (data) {
            showAlert('Pesquisa concluída com sucesso!', 'green', 3000);
            $('#listUser').html(data);
        },
        error: function () {
            showAlert('Não foi possível completar a requisição!', 'red', 3000);
        }
    });

}


// ****************************** FIM - PESQUISAR USUÁRIO - BRUNO R. BERNAL - 17/01/2022 ***********************




// *************************************** LOGIN *************************************************************
function login() {

    var login = $('#email').val()
    var password = $("#password").val();
    var folder = directory;
    var module = $('#module').val();
	var company = $("#company").val();
	//alert(http + main_directory + '/model/user/user-model.php/?access=1');
    formData = new FormData();
    formData.append('login', login);
    formData.append('password', password);
    formData.append('directory', directory);
    formData.append('main_directory', main_directory);
    formData.append('folder', directory);
    formData.append('module', module);
	formData.append('company',company);
	
    $.ajax({
        url: 'https://maxcomanda.com.br/homologacao/model/user/user-model.php/?access=1',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function (data) {
            if (data.code == 1) {
                $("#information").css('background', 'red');
                $("#information").css('color', 'white');
                $("#information").css("text-align", "center");
                $("#information").html(data.message);

                if (data.message == 'É necessário informar os dados de sua empresa!') {
                    window.location.href = http + directory + '/view/?pg=data-company&bloq=1';
                }
            } else {
                $("#information").css('background', 'green');
                $("#information").css('color', 'white');
                $("#information").css("text-align", "center");

                window.location.href = '../' + directory + '/view';
            }
            $("#information").html(data.message);
        },
        error: function () {
            alert('Erro ao acessar a Base de Dados!');
        }

    })


    /*
	type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        dataType: 'json',
	
	
	
	/*$.ajax({
		url: '../homologacao/model/user/user-model.php/?access=1&login='+login+'&password='+password+"&directory="+directory,
		type: 'GET',
		dataType: 'json',
		success: function (data){
			alert(data.id_contract);
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
	})*/
}

// ******************************************* FIM - LOGIN **************************************************