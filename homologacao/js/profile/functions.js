var directory = $("#directory").val();
var http = $("#http").val();
var id_user = $("#id_user").val();
var id_company = $("#id_company").val();
var main_directory = $("#main_directory").val();
var id_contract = $("#id_contract").val();

// *************************************** VALIDAR FORMULÁRIO - BRUNO R. BERNAL - 17/01/2022 ****************
function validaForm() {
    var lockbtn = "";
    var name = $("#name").val();
    var status = $("#status").val();

    if (status == "") {
        invalidInput('status', 'msgStatus', 'Campo Obrigatório!*');
        lockbtn = 1;
    } else {
        validInput('status', 'msgStatus', '');
    }

    if (name == "") {
        invalidInput('name', 'msgName', 'Campo Obrigatório!*');
        lockbtn = 1;
    } else {
        validInput('name', 'msgName', '');
    }

    if (lockbtn == "") {
        $("#btnSaveProfile").attr('disabled', false);
    } else {
        $("#btnSaveProfile").attr('disabled', true);
    }
    
}

// *************************************** FIM - VALIDAR FORMULÁRIO - BRUNO R. BERNAL - 17/01/2022 ****************


// *************************************** GRAVAR / EDITAR - BRUNO R. BERNAL - 17/01/2022 *********************

function saveProfile() {
    var data = $("#formProfile").serialize(); 



    $.ajax({

        url: "../../MaxComanda/model/profile/profile-model.php/?saveProfile=1&directory="+directory+'&id_user='+id_user+'&id_company='+id_company,
        type: 'POST',
        data: data,
        dataType: 'json',
        beforeSend: function () {
            loadShow();
            $("#btnSaveProfile").attr('disabled',true);
        },
        success: function (response) {
            if (response.codigo == 1) {
                showAlert(response.mensagem, 'green', 3000);
                loadHide();
                window.location.href = http + '/view/?pg=profile';
            } else {
                showAlert('Erro: ' + response.mensagem, 'red', 3000);
                loadHide();
                $("#btnSaveProfile").attr('disabled', false);
            }
        },
        error: function () {
            showAlert('Não foi possivel completar a requisição!', 'red', 3000);
            loadHide();
            $("#btnSaveProfile").attr('disabled', false);
        }
    });



}

// *************************************** FIM - GRAVAR / EDITAR - BRUNO R. BERNAL - 17/01/2022 ****************

// ********************************* PESQUISAR PERFIL - BRUNO R. BERNAL - 17/01/2022 ************************

function searchProfile(){
	var profileName = $("#profileName").val();

	$.ajax({
		type : 'GET',
		url  : http+ '/'+main_directory+ '/controller/profile/table.php/?searchProfile=1&profileName='+profileName+'&directory='+directory+'&id_user='+id_user+'&id_company='+id_company+'&id_contract='+id_contract,
			//data : data,
			dataType: 'html',
			success :  function(data){
                showAlert('Pesquisa concluída com sucesso!','green',3000);
					$('#listProfile').html(data);					
			},error: function(){
                showAlert('Não foi possível completar a requisição!','red',3000);
			}	
		});

}


// ****************************** FIM - PESQUISAR PERFIL - BRUNO R. BERNAL - 17/01/2022 ***********************