var http = $("#http").val();
var directory = $("#directory").val();
var id_user = $("#id_user").val();
var id_company = $("#id_company").val();
// *************************************** LISTAR MESAS - BRUNO R. BERNAL - 21/01/2022 *********************

function listTable() {

    $.ajax({
		type : 'GET',
		url  : '../../MaxComanda/controller/table/table.php/?listTable=1&directory='+directory+'&id_user='+id_user+'&id_company='+id_company,
			//data : data,
			dataType: 'html',
			success :  function(data){
				$("#listTable").html(data);				
			},error: function(){
			}	
		});
}



// ************************************* FIM - LISTAR MESAS - BRUNO R. BERNAL - 21/01/2022 ****************

// ************************************ MUDAR STATUS DO MAPA - BRUNO R. BERNAL - 21/01/2022 *****************
function statusMap(id) {
    var id = id;
    var status = $("#status"+id).is(':checked'); 

    if(status == true){
        var status = "Ativo";
    } else{
        var status = "Inativo";
    }


    $.ajax({

        url: "../../MaxComanda/model/table/table-model.php/?statusMap=1&directory=" + directory+"&id="+id+"&status="+status+'&id_user='+id_user+'&id_company='+id_company,
        type: 'GET',
        //data: data,
        dataType: 'json',
        beforeSend: function () {
            loadShow();
        },
        success: function (response) {
            if (response.codigo == 1) {
                showAlert(response.mensagem, 'green', 3000);
                loadHide();
                //window.location.href = http + '/view/?pg=table';
            } else {
                showAlert('Erro: ' + response.mensagem, 'red', 3000);
                loadHide();
            }
        },
        error: function () {
            showAlert('Não foi possivel completar a requisição!', 'red', 3000);
            loadHide();
        }
    });
}
// ********************************* FIM - MUDAR STATUS DO MAPA - BRUNO R. BERNAL - 21/01/2022 *************

// *************************************** GRAVAR / EDITAR - BRUNO R. BERNAL - 21/01/2022 *********************

function saveMap() {
    var data = $("#formMap").serialize();


    $.ajax({

        url: "../../MaxComanda/model/table/table-model.php/?saveMap=1&directory=" + directory+'&id_user='+id_user+'&id_company='+id_company,
        type: 'POST',
        data: data,
        dataType: 'json',
        beforeSend: function () {
            loadShow();
            $("#btnSaveMap").attr('disabled', true);
        },
        success: function (response) {
            if (response.codigo == 1) {
                showAlert(response.mensagem, 'green', 3000);
                loadHide();
                window.location.href = http + '/view/?pg=data-table';
            } else {
                showAlert('Erro: ' + response.mensagem, 'red', 3000);
                loadHide();
                $("#btnSaveMap").attr('disabled', false);
            }
        },
        error: function () {
            showAlert('Não foi possivel completar a requisição!', 'red', 3000);
            loadHide();
            $("#btnSaveMap").attr('disabled', false);
        }
    });
}

function saveTable() {
    var data = $("#formTable").serialize();


    $.ajax({

        url: "../../MaxComanda/model/table/table-model.php/?saveTable=1&directory=" + directory+'&id_user='+id_user+'&id_company='+id_company,
        type: 'POST',
        data: data,
        dataType: 'json',
        beforeSend: function () {
            loadShow();
            $("#btnSaveTable").attr('disabled', true);
        },
        success: function (response) {
            if (response.codigo == 1) {
                showAlert(response.mensagem, 'green', 3000);
                loadHide();
                window.location.href = http + '/view/?pg=table';
            } else {
                showAlert('Erro: ' + response.mensagem, 'red', 3000);
                loadHide();
                $("#btnSaveTable").attr('disabled', false);
            }
        },
        error: function () {
            showAlert('Não foi possivel completar a requisição!', 'red', 3000);
            loadHide();
            $("#btnSaveTable").attr('disabled', false);
        }
    });
}

// *************************************** FIM - GRAVAR / EDITAR - BRUNO R. BERNAL - 21/01/2022 ****************

// *********************** MUDAR CARD DO LISTAR MAPA PARA O CADASTRAR MAPA ***********************************

function newMap(){
    $(".listMap").hide();
    $(".newMap").show();
}

function cancelNewMap(){
    $(".listMap").show();
    $(".newMap").hide();
}

// ********************* FIM - MUDAR CARD DO LISTAR MAPA PARA O CADASTRAR MAPA ***********************************


// ********************** VALIDAR FORMULÁRIO - BRUNO R. BERNAL - 21/01/2022 *************************************

function validaForm() {
	var lockbtn = "";
	var map = $("#map").val();

    if (map == "") {
		invalidInput('map', 'msgMap', 'Campo Obrigatório!*');
		lockbtn = 1;
	} else {
		validInput('map', 'msgMap', '');
	}



    if (lockbtn == "") {
		$("#btnSaveTable").attr('disabled', false);
	} else {
		$("#btnSaveTable").attr('disabled', true);
	}

}

function validaFormMap() {
	var lockbtnMap = "";
	var description = $("#description").val();

    if (description == "") {
		invalidInput('description', 'msgDescription', 'Campo Obrigatório!*');
		lockbtnMap = 1;
	} else {
		validInput('description', 'msgDescription', '');
	}



    if (lockbtnMap == "") {
		$("#btnSaveMap").attr('disabled', false);
	} else {
		$("#btnSaveMap").attr('disabled', true);
	}

}



// ****************************** FIM - VALIDAR FORMULÁRIO - BRUNO R. BERNAL - 21/01/2022 ***********************