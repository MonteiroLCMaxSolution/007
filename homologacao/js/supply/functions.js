var http = $("#http").val();
var directory = $("#directory").val();
var id_user = $("#id_user").val();
var id_company = $("#id_company").val();
// *************************************** GRAVAR / EDITAR - BRUNO R. BERNAL - 20/01/2022 *********************
function saveAdjustment(uniqID) {
    var uniqID = uniqID;
    var data = $("#formNewAdjustment").serialize();


	





    $.ajax({

        url: "../../MaxComanda/model/supply/supply-model.php/?saveAdjustment=1&directory=" + directory+"&uniqID="+uniqID+'&id_user='+id_user+'&id_company='+id_company,
        type: 'POST',
        data: data,
        dataType: 'json',
        beforeSend: function () {
            loadShow();
            $("#btnSaveAdjustment").attr('disabled', true);
        },
        success: function (response) {
            if (response.codigo == 1) {
                showAlert(response.mensagem, 'green', 3000);
                loadHide();
                window.location.reload(1);
                hideBtn();
            } else {
                showAlert('Erro: ' + response.mensagem, 'red', 3000);
                loadHide();
                $("#btnSaveAdjustment").attr('disabled', false);
            }
        },
        error: function () {
            showAlert('Não foi possivel completar a requisição!', 'red', 3000);
            loadHide();
            $("#btnSaveAdjustment").attr('disabled', false);
        }
    });



}

// *************************************** FIM - GRAVAR / EDITAR - BRUNO R. BERNAL - 20/01/2022 ****************

// *********************** MOSTRAR / OCULTAR CAMPO FORNECEDOR POR TIPO DE MOVIMENTAÇÃO *********************

function openNewAdjustment(){
    $(".search").hide();
    $(".new").show();
}

function closeNewAdjustment(){
    $(".search").show();
    $(".new").hide();
}

// *********************** FIM - MOSTRAR / OCULTAR CAMPO FORNECEDOR POR TIPO DE MOVIMENTAÇÃO *********************

// ******************************** VALIDAR FORMULÁRIO - BRUNO R. BERNAL - 19/01/2022 ***********************

function validaFormAdjustment() {
	var lockbtnAdjustment = "";
	var providerIDAdjustment = $("#providerIDAdjustment").val();
	var typeAdjustment = $("#typeAdjustment").val();
	var quantityAdjustment = $("#quantityAdjustment").val();
	var descriptionAdjustment = $("#descriptionAdjustment").val();

    if (typeAdjustment == "") {
		invalidInput('typeAdjustment', 'msgTypeAdjustment', 'Campo Obrigatório!*');
		lockbtnAdjustment = 1;
	} else {
		validInput('typeAdjustment', 'msgTypeAdjustment', '');
	}

    if(typeAdjustment == "Entrada"){
    
        if (providerIDAdjustment == "") {
            //invalidInput('providerIDAdjustment', 'msgProviderIDAdjustment', 'Campo Obrigatório!*');
            lockbtnAdjustment = 1;
        } else {
            //validInput('providerIDAdjustment', 'msgProviderIDAdjustment', '');
        }

    }


	if (descriptionAdjustment == "") {
		invalidInput('descriptionAdjustment', 'msgDescriptionAdjustment', 'Campo Obrigatório!*');
		lockbtnAdjustment = 1;
	} else {
		validInput('descriptionAdjustment', 'msgDescriptionAdjustment', '');
	}

	


	if (quantityAdjustment == "") {
		invalidInput('quantityAdjustment', 'msgQuantityAdjustment', 'Campo Obrigatório!*');
		lockbtnAdjustment = 1;
	} else {
		validInput('quantityAdjustment', 'msgQuantityAdjustment', '');
	}








	if (lockbtnAdjustment == "") {
		$("#btnSaveAdjustment").attr('disabled', false);
	} else {
		$("#btnSaveAdjustment").attr('disabled', true);
	}
}

function validaTypeAdjustment(){
    var type = $("#type").val();
    var typeAdjustment = $("#typeAdjustment").val();


    if(type == "" || type == "Saída"){
        $(".provider").hide();
    } else{
        $(".provider").show();
    }

    if(typeAdjustment == "" || typeAdjustment == "Saída"){
        $(".providerAdjustment").hide();
    } else{
        $(".providerAdjustment").show();
    }
}

function hideBtn(){
    $(".actionBtn").hide();
}

function showBtn(){
    $(".actionBtn").show();
}

// ******************************** FIM - VALIDAR FORMULÁRIO - BRUNO R. BERNAL - 19/01/2022 ***********************

// *************************** PESQUISAR MOVIMENTAÇÃO POR PRODUTO - BRUNO R. BERNAL - 19/01/2022 ************************

function searchAdjustment(uniqID) {
    var uniqID = uniqID;
	var data = $("#formSearchAdjustment").serialize();


	$.ajax({
		type: 'POST',
		url: '../../MaxComanda/controller/supply/table-adjustment.php/?searchAdjustment=1&directory=' + directory+"&uniqID="+uniqID+'&id_user='+id_user+'&id_company='+id_company,
		data: data,
		dataType: 'html',
		success: function (data) {
			showAlert('Pesquisa concluída com sucesso!', 'green', 3000);
			$('#listAdjustment').html(data);
			$('#registerStart').val("");
			$('#registerEnd').val("");
			$('#providerID').val("");
			$('#providerName').val("");
            $('#type').val("");
		},
		error: function () {
			showAlert('Não foi possível completar a requisição!', 'red', 3000);
		}
	});

}


// *********************** FIM - PESQUISAR MOVIMENTAÇÃO POR PRODUTO - BRUNO R. BERNAL - 19/01/2022 *******************

// ******************************* SELECIONAR FORNECEDOR NO MODAL - BRUNO R. BERNAL - 19/01/2022 ************************
/*
function selectProvider(id) {
	var id = id;

	$.ajax({
		type: 'GET',
		url: '../../MaxComanda/model/supply/supply-model.php/?selectProvider=1&providerID=' + id + "&directory=" + directory,
		//data : data,
		dataType: 'json',
		beforeSend: function () {
			loadShow();
		},
		success: function (response) {
			if (response.codigo == 1) {
				var name = response.name;
				var provider_id = response.id;
				showAlert(response.mensagem, 'green', 3000);
				loadHide();
				$("#providerName").val(name);
				$("#providerID").val(provider_id);
				M.updateTextFields();
				$('#modalProvider').modal('close');
			} else {
				showAlert('Erro: ' + response.mensagem, 'red', 3000);
				loadHide();
				$("#providerName").val("");
				$("#providerID").val("");
			}
		},
		error: function () {
			showAlert('Não foi possivel encontrar o Fornecedor!', 'red', 3000);
			loadHide();
			$("#providerName").val("");
			$("#providerID").val("");
		}
	});

}

function selectProviderAdjustment(id) {
	var id = id;

	$.ajax({
		type: 'GET',
		url: '../../MaxComanda/model/supply/supply-model.php/?selectProvider=1&providerID=' + id + "&directory=" + directory,
		//data : data,
		dataType: 'json',
		beforeSend: function () {
			loadShow();
		},
		success: function (response) {
			if (response.codigo == 1) {
				var name = response.name;
				var provider_id = response.id;
				showAlert(response.mensagem, 'green', 3000);
				loadHide();
				$("#providerNameAdjustment").val(name);
				$("#providerIDAdjustment").val(provider_id);
				M.updateTextFields();
				$('#modalProviderAdjustment').modal('close');
			} else {
				showAlert('Erro: ' + response.mensagem, 'red', 3000);
				loadHide();
				$("#providerNameAdjustment").val("");
				$("#providerIDAdjustment").val("");
			}
		},
		error: function () {
			showAlert('Não foi possivel encontrar o Fornecedor!', 'red', 3000);
			loadHide();
			$("#providerNameAdjustment").val("");
			$("#providerIDAdjustment").val("");
		}
	});

}

*/

// *************************** FIM - SELECIONAR FORNECEDOR NO MODAL - BRUNO R. BERNAL - 19/01/2022 *********************

// ********************************* PESQUISAR FORNECEDOR NO MODAL - BRUNO R. BERNAL - 19/01/2022 ************************
/*
function searchProvider() {
	var providerName = $("#searchProviderName").val();


	$.ajax({
		type: 'GET',
		url: '../../MaxComanda/controller/supply/table-provider-modal.php/?searchProvider=1&providerName=' + providerName + "&directory=" + directory,
		//data : data,
		dataType: 'html',
		success: function (data) {
			showAlert('Pesquisa concluída com sucesso!', 'green', 3000);
			$('#listProvider').html(data);
            
		},
		error: function () {
			showAlert('Não foi possível completar a requisição!', 'red', 3000);
           
		}
	});
}


function searchProviderAdjustment() {
	var providerName = $("#searchProviderName").val();


	$.ajax({
		type: 'GET',
		url: '../../MaxComanda/controller/supply/table-provider-modal.php/?searchProvider=1&providerName=' + providerName + "&directory=" + directory+"&new=1",
		//data : data,
		dataType: 'html',
		success: function (data) {
			showAlert('Pesquisa concluída com sucesso!', 'green', 3000);
			$('#listProvider').html(data);
            
		},
		error: function () {
			showAlert('Não foi possível completar a requisição!', 'red', 3000);
           
		}
	});
}

*/


// *********************** FIM - PESQUISAR FORNECEDOR NO MODAL - BRUNO R. BERNAL - 19/01/2022 *******************

// *************************** SELECIONAR FORNECEDOR NO MODAL - BRUNO R. BERNAL - 19/01/2022 *********************
/*
function selectProvider(id) {
	var id = id;

	$.ajax({
		type: 'GET',
		url: '../../MaxComanda/model/supply/supply-model.php/?selectProvider=1&providerID=' + id + "&directory=" + directory,
		//data : data,
		dataType: 'json',
		beforeSend: function () {
			loadShow();
		},
		success: function (response) {
			if (response.codigo == 1) {
				var name = response.name;
				var provider_id = response.id;
				showAlert(response.mensagem, 'green', 3000);
				loadHide();
				$("#providerName").val(name);
				$("#providerID").val(provider_id);
				M.updateTextFields();
				$('#modalProvider').modal('close');
			} else {
				showAlert('Erro: ' + response.mensagem, 'red', 3000);
				loadHide();
				$("#providerName").val("");
				$("#providerID").val("");
			}
		},
		error: function () {
			showAlert('Não foi possivel encontrar o Fornecedor!', 'red', 3000);
			loadHide();
			$("#providerName").val("");
			$("#providerID").val("");
		}
	});

}
*/
// *********************** FIM - SELECIONAR FORNECEDOR NO MODAL - BRUNO R. BERNAL - 19/01/2022 *******************

// *************************************** GRAVAR / EDITAR - BRUNO R. BERNAL - 18/01/2022 *********************

function saveSupply() {
    var data = $("#formSupply").serialize();





    $.ajax({

        url: "../../MaxComanda/model/supply/supply-model.php/?saveSupply=1&directory=" + directory+'&id_user='+id_user+'&id_company='+id_company,
        type: 'POST',
        data: data,
        dataType: 'json',
        beforeSend: function () {
            loadShow();
            $("#btnSaveSupply").attr('disabled', true);
        },
        success: function (response) {
            if (response.codigo == 1) {
                var pg = response.pg;
                showAlert(response.mensagem, 'green', 3000);
                loadHide();
                window.location.href = http + '/view/?pg='+pg;
            } else {
                showAlert('Erro: ' + response.mensagem, 'red', 3000);
                loadHide();
                $("#btnSaveSupply").attr('disabled', false);
            }
        },
        error: function () {
            showAlert('Não foi possivel completar a requisição!', 'red', 3000);
            loadHide();
            $("#btnSaveSupply").attr('disabled', false);
        }
    });



}

// *************************************** FIM - GRAVAR / EDITAR - BRUNO R. BERNAL - 18/01/2022 ****************



// ******************************** VALIDAR FORMULÁRIO - BRUNO R. BERNAL - 18/01/2022 ***********************

function validaForm() {
    var lockbtn = "";
    var name = $("#name").val();


    if (name == "") {
        invalidInput('name', 'msgName', 'Campo Obrigatório!*');
        lockbtn = 1;
    } else {
        validInput('name', 'msgName', '');
    }


    if (lockbtn == "") {
        $("#btnSaveSupply").attr('disabled', false);
    } else {
        $("#btnSaveSupply").attr('disabled', true);
    }
}

// ******************************** FIM - VALIDAR FORMULÁRIO - BRUNO R. BERNAL - 18/01/2022 ***********************


// ********************************* PESQUISAR SUPRIMENTO - BRUNO R. BERNAL - 18/01/2022 ************************
function searchSupply() {
    var supplyName = $("#supplyName").val();


    $.ajax({
        type: 'GET',
        url: '../../MaxComanda/controller/supply/table.php/?searchSupply=1&supplyName=' + supplyName+"&directory="+directory+'&id_user='+id_user+'&id_company='+id_company,
        //data : data,
        dataType: 'html',
        success: function (data) {
            showAlert('Pesquisa concluída com sucesso!', 'green', 3000);
            $('#listSupply').html(data);
        },
        error: function () {
            showAlert('Não foi possível completar a requisição!', 'red', 3000);
        }
    });

}


// ****************************** FIM - PESQUISAR SUPRIMENTO - BRUNO R. BERNAL - 18/01/2022 ***********************