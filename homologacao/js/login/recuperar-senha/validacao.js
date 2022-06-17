// BOTÃO PARA CONFIRMAR A NOVA SENHA DO USUÁRIO - MONTEIRO - 16/05/2022
	function confirmNewPassword(){	
		var password1 = $("#password1").val();
		var recover = $("#recover").val();
		var https = $("#https").val();
		$.ajax({
		url: https+'/model/recover-password/recover-password.php/?confirmNewPassword='+password1+'&recover='+recover,
		type: 'GET',
		dataType: 'json',
		success: function(data){
			if(data.cod == 1){				
				$("#msgFinal").html(data.msg);
				$("#msgFinal").css('color','red');
			}
			if(data.cod == 2){				
				$("#msgFinal").html(data.msg);
				$("#msgFinal").css('color','green');
				window.location.href = '?recover-password=';
			}
			
			//window.location.href = '?recover-password=';
		},
		error: function(){
			alert('Erro ao acessar dados!');
		}
	})
	}
// FIM BOTÃO PARA CONFIRMAR A NOVA SENHA DO USUÁRIO
// VALIDAR A SENHA E LIBERAR O ACESSO PARA EDITAR A SENHA - MONTEIRO - 16/05/2022
function ConfirmPassword(){
	var password1 = $("#password1").val();
	var password2 = $("#password2").val();
	
	if(password1 == ''){
		$("#msgErrorPassword1").html('É necessário o campo estar preenchido!');
		$("#msgErrorPassword1").css('color', 'red');
	}else{
		
		$("#msgErrorPassword1").html('OK!');
		$("#msgErrorPassword1").css('color', 'green');
		if(password1 != password2){
			$("#msgErrorPassword2").html('As duas senhas informadas, não conferem!');
			$("#msgErrorPassword2").css('color', 'red');
			
			$("#btnConfirmNewPassword").hide();
		}else{
			
			$("#msgErrorPassword2").html('Senha válida!');
			$("#msgErrorPassword2").css('color', 'green');
			
			$("#btnConfirmNewPassword").show();
		}
	}
	
	
	
}

// FIM - VALIDAR A SENHA E LIBERAR O ACESSO PARA EDITAR A SENHA
function recover_password(str){
	
	var https = $("#https").val();
	var directory = $("#directory").val();
	
	$.ajax({
		url: https+'/send_mail_recover.php/?recover_password='+str,
		type: 'GET',
		dataType: 'json',
		success: function(data){
			showAlert(data.msg, 'green', 8000); 
			window.location.href = '?recover-password=';
		},
		error: function(){
			alert('Erro ao acessar dados!');
		}
	})
}

function searchMail(){
	var https = $("#https").val();
	var directory = $("#directory").val();
	var email = document.getElementById('email-recuperar-senha').value;
    var liberBTN = '';

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

    if(liberBTN == '1'){
        document.querySelector('div.recuperar-senha-result').style.display = 'none';
		$(".recuperar-senha-result").html('');

    }else{
        document.querySelector('div.recuperar-senha-result').style.display = 'block';
		$.ajax({
			url: https+'/list_mail.php/?recover_mail='+email+'&directory='+directory,
			type: 'GET',
			dataType: 'html',
			success: function(data){
				$(".recuperar-senha-result").html(data);
			},
			error: function(){
				alert('erro ao requisitar lista de emails');
			}
		})
	}
}


function validarFormulario(){
    var email = document.getElementById('email-recuperar-senha').value;

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
}
/*
document.getElementById('pesquisar-email-recuperar-senha').onclick = function(){
    var email = document.getElementById('email-recuperar-senha').value;
    var liberBTN = '';

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

    if(liberBTN == '1'){
        document.querySelector('div.recuperar-senha-result').style.display = 'none';
		return false;
    }else{
        document.querySelector('div.recuperar-senha-result').style.display = 'block';
		
		
		
		
		
		
		
		
		return false;
    }
}*/