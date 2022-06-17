var http = $("#http").val();
var directory = $("#directory").val();
var id_user = $("#id_user").val();
var id_company = $("#id_company").val();

// *************************************** VALIDAR FORMULÁRIO - BRUNO R. BERNAL - 18/01/2022 ****************
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
        $("#btnSaveLocation").attr('disabled', false);
    } else {
        $("#btnSaveLocation").attr('disabled', true);
    }
    
}

// *************************************** FIM - VALIDAR FORMULÁRIO - BRUNO R. BERNAL - 18/01/2022 ****************


// *************************************** GRAVAR / EDITAR - BRUNO R. BERNAL - 18/01/2022 *********************

function saveLocation() {
    var data = $("#formLocation").serialize(); 



    $.ajax({

        url: "../../MaxComanda/model/location/location-model.php/?saveLocation=1&directory="+directory+'&id_user='+id_user+'&id_company='+id_company,
        type: 'POST',
        data: data,
        dataType: 'json',
        beforeSend: function () {
            loadShow();
            $("#btnSaveLocation").attr('disabled',true);
        },
        success: function (response) {
            if (response.codigo == 1) {
                showAlert(response.mensagem, 'green', 3000);
                loadHide();
                window.location.href = http + '/view/?pg=location';
            } else {
                showAlert('Erro: ' + response.mensagem, 'red', 3000);
                loadHide();
                $("#btnSaveLocation").attr('disabled', false);
            }
        },
        error: function () {
            showAlert('Não foi possivel completar a requisição!', 'red', 3000);
            loadHide();
            $("#btnSaveLocation").attr('disabled', false);
        }
    });



}

// *************************************** FIM - GRAVAR / EDITAR - BRUNO R. BERNAL - 18/01/2022 ****************

// ********************************* PESQUISAR LOCALIZAÇÃO - BRUNO R. BERNAL - 18/01/2022 ************************
function searchLocation(){
	var locationName = $("#locationName").val();


	$.ajax({
		type : 'GET',
		url  : '../../MaxComanda/controller/location/table.php/?searchLocation=1&locationName='+locationName+"&directory="+directory+'&id_user='+id_user+'&id_company='+id_company,
			//data : data,
			dataType: 'html',
			success :  function(data){
                showAlert('Pesquisa concluída com sucesso!','green',3000);
					$('#listLocation').html(data);					
			},error: function(){
                showAlert('Não foi possível completar a requisição!','red',3000);
			}	
		});

}


// ****************************** FIM - PESQUISAR LOCALIZAÇÃO - BRUNO R. BERNAL - 18/01/2022 ***********************