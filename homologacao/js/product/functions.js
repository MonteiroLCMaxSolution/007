var http = $("#http").val();
var directory = $("#directory").val();
var id_user = $("#id_user").val();
var id_company = $("#id_company").val();

// ********************************** GRAVAR / EDITAR ACRÉSCIMO - BRUNO R. BERNAL - 10/02/2022 *********************

function saveAddition() {
    var id = $("#id").val();
        var data = $("#formAddition").serialize();
    
    
        $.ajax({
    
            url: "../../MaxComanda/model/product/product-model.php/?saveAddition=1&directory=" + directory+'&id_user='+id_user+'&id_company='+id_company+'&product_id='+id,
            type: 'POST',
            data: data,
            dataType: 'json',
            beforeSend: function () {
                loadShow();
                $("#btnSaveAddition").attr('disabled', true);
            },
            success: function (response) {
                if (response.codigo == 1) {
                    showAlert(response.mensagem, 'green', 3000);
                    loadHide();
                    listAddition();
                } else {
                    showAlert('Erro: ' + response.mensagem, 'red', 3000);
                    loadHide();
                    $("#btnSaveAddition").attr('disabled', false);
                }
            },
            error: function () {
                showAlert('Não foi possivel completar a requisição!', 'red', 3000);
                loadHide();
                $("#btnSaveAddition").attr('disabled', false);
            }
        });
    
    
    
    }
    
    function editAddition(id){
        var id = id;
        var value = $("#valueAddition"+id).val();
        var status = $("#statusAddition"+id).is(':checked');
    
        if (status == true) {
            var status = "Ativo";
        } else {
            var status = "Inativo";
        }
    
    
        $.ajax({
    
            url: "../../MaxComanda/model/product/product-model.php/?editAddition=1&directory=" + directory+'&id_user='+id_user+'&id_company='+id_company+'&id='+id+'&status='+status+'&value='+value,
            type: 'GET',
            //data: data,
            dataType: 'json',
            beforeSend: function () {
                loadShow();
                $("#btnEditAddition"+id).attr('disabled', true);
            },
            success: function (response) {
                if (response.codigo == 1) {
                    showAlert(response.mensagem, 'green', 3000);
                    loadHide();
                } else {
                    showAlert('Erro: ' + response.mensagem, 'red', 3000);
                    loadHide();
                    $("#btnEditAddition"+id).attr('disabled', false);
                }
            },
            error: function () {
                showAlert('Não foi possivel completar a requisição!', 'red', 3000);
                loadHide();
                $("#btnEditAddition"+id).attr('disabled', false);
            }
        });
    }
    
    // ********************************* FIM - GRAVAR / EDITAR ACRÉSCIMO - BRUNO R. BERNAL - 10/02/2022 ***************

// **************************** LISTAR ACRÉSCIMOS NO FORMULÁRIO - BRUNO R. BERNAL - 10/02/2022 ****************
function listAddition(){
    var id = $("#id").val();

    $.ajax({
        type: 'GET',
        url: '../../MaxComanda/controller/product/table-addition.php/?listAddition=1&id=' + id+"&directory="+directory+'&id_user='+id_user+'&id_company='+id_company,
        //data : data,
        dataType: 'html',
        success: function (data) {
            //showAlert('Pesquisa concluída com sucesso!', 'green', 3000);
            $('#listAddition').html(data);
        },
        error: function () {
            //showAlert('Não foi possível completar a requisição!', 'red', 3000);
        }
    });
}

// ************************ FIM - LISTAR ACRÉSCIMOS NO FORMULÁRIO - BRUNO R. BERNAL - 10/02/2022 ****************

// ********************************** GRAVAR / EDITAR SABOR - BRUNO R. BERNAL - 10/02/2022 *********************

function saveFlavor() {
var id = $("#id").val();
    var data = $("#formFlavor").serialize();


    $.ajax({

        url: "../../MaxComanda/model/product/product-model.php/?saveFlavor=1&directory=" + directory+'&id_user='+id_user+'&id_company='+id_company+'&product_id='+id,
        type: 'POST',
        data: data,
        dataType: 'json',
        beforeSend: function () {
            loadShow();
            $("#btnSaveFlavor").attr('disabled', true);
        },
        success: function (response) {
            if (response.codigo == 1) {
                showAlert(response.mensagem, 'green', 3000);
                loadHide();
                listFlavor();
            } else {
                showAlert('Erro: ' + response.mensagem, 'red', 3000);
                loadHide();
                $("#btnSaveFlavor").attr('disabled', false);
            }
        },
        error: function () {
            showAlert('Não foi possivel completar a requisição!', 'red', 3000);
            loadHide();
            $("#btnSaveFlavor").attr('disabled', false);
        }
    });



}

function editFlavor(id){
    var id = id;
    var description = $("#descriptionFlavor"+id).val();
    var status = $("#statusFlavor"+id).is(':checked');

    if (status == true) {
        var status = "Ativo";
    } else {
        var status = "Inativo";
    }


    $.ajax({

        url: "../../MaxComanda/model/product/product-model.php/?editFlavor=1&directory=" + directory+'&id_user='+id_user+'&id_company='+id_company+'&id='+id+'&description='+description+'&status='+status,
        type: 'GET',
        //data: data,
        dataType: 'json',
        beforeSend: function () {
            loadShow();
            $("#btnEditFlavor"+id).attr('disabled', true);
        },
        success: function (response) {
            if (response.codigo == 1) {
                showAlert(response.mensagem, 'green', 3000);
                loadHide();
            } else {
                showAlert('Erro: ' + response.mensagem, 'red', 3000);
                loadHide();
                $("#btnEditFlavor"+id).attr('disabled', false);
            }
        },
        error: function () {
            showAlert('Não foi possivel completar a requisição!', 'red', 3000);
            loadHide();
            $("#btnEditFlavor"+id).attr('disabled', false);
        }
    });
}

// ********************************* FIM - GRAVAR / EDITAR SABOR - BRUNO R. BERNAL - 10/02/2022 ***************

// **************************** LISTAR SABORES NO FORMULÁRIO - BRUNO R. BERNAL - 10/02/2022 ****************
function listFlavor(){
    var id = $("#id").val();

    $.ajax({
        type: 'GET',
        url: '../../MaxComanda/controller/product/table-flavor.php/?listFlavor=1&id=' + id+"&directory="+directory+'&id_user='+id_user+'&id_company='+id_company,
        //data : data,
        dataType: 'html',
        success: function (data) {
            //showAlert('Pesquisa concluída com sucesso!', 'green', 3000);
            $('#listFlavor').html(data);
        },
        error: function () {
            //showAlert('Não foi possível completar a requisição!', 'red', 3000);
        }
    });
}

// ************************** FIM - LISTAR SABORES NO FORMULÁRIO - BRUNO R. BERNAL - 10/02/2022 ****************


// ********************************** GRAVAR / EDITAR AJUSTE - BRUNO R. BERNAL - 20/01/2022 *********************

function saveAdjustment(uniqID) {
    var uniqID = uniqID;
    var data = $("#formNewAdjustment").serialize();


	





    $.ajax({

        url: "../../MaxComanda/model/product/product-model.php/?saveAdjustment=1&directory=" + directory+"&uniqID="+uniqID+'&id_user='+id_user+'&id_company='+id_company,
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

// ********************************* FIM - GRAVAR / EDITAR AJUSTE - BRUNO R. BERNAL - 20/01/2022 ***************

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
		url: '../../MaxComanda/controller/product/table-adjustment.php/?searchAdjustment=1&directory=' + directory+"&uniqID="+uniqID+'&id_user='+id_user+'&id_company='+id_company,
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
		url: '../../MaxComanda/model/product/product-model.php/?selectProvider=1&providerID=' + id + "&directory=" + directory,
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
		url: '../../MaxComanda/model/product/product-model.php/?selectProvider=1&providerID=' + id + "&directory=" + directory,
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
		url: '../../MaxComanda/controller/product/table-provider-modal.php/?searchProvider=1&providerName=' + providerName + "&directory=" + directory,
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
		url: '../../MaxComanda/controller/product/table-provider-modal.php/?searchProvider=1&providerName=' + providerName + "&directory=" + directory+"&new=1",
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
		url: '../../MaxComanda/model/product/product-model.php/?selectProvider=1&providerID=' + id + "&directory=" + directory,
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

// **************************** DELETAR IMAGEM DO PRODUTO - BRUNO R. BERNAL - 19/01/2022 **************************

function deleteProductImg(id, product_id) {

    var id = id;
    var product_id = product_id;



    if (confirm('Deseja realmente deletar a Imagem ?')) {
        $.ajax({
            type: 'POST',
            url: "../../MaxComanda/controller/product/list-img.php/?deleteProductImg=1&directory=" + directory,
            data: '&product_id=' + product_id + '&id= ' + id+'&id_user='+id_user+'&id_company='+id_company,
            dataType: 'html',
            beforeSend: function () {
                loadShow();
            },
            success: function (data) {
                loadHide();
                showAlert('Imagem deletada com Sucesso!', 'green', 3000);
                $('#listProductImg').html(data);

            },
            error: function () {
                loadHide();
                showAlert('Falha ao deletar a imagem!', 'red', 3000);
                $('#listProductImg').html(data);

            }
        });
    } else {

        showAlert('A imagem não será deletada!', 'green', 3000);

    }

}

// ******************** FIM - DELETAR IMAGEM DO PRODUTO - BRUNO R. BERNAL - 19/01/2022 **************************

// *********************************** DEFINIR IMAGEM PRINCIPAL - BRUNO R. BERNAL - 19/01/2022 ***************

function mainImg(id,id_product){
    var id = id;
    var id_product = id_product;


    $.ajax({

        url: "../../MaxComanda/controller/product/list-img.php/?mainImg=1&directory=" + directory + "&id=" + id+"&id_product="+id_product+'&id_user='+id_user+'&id_company='+id_company,
        type: 'POST',
        //data: data,
        dataType: 'html',
        success: function (data) {
            $('#listProductImg').html(data);
        },
        error: function () {
            showAlert('Não foi possível atualizar a Imagem deste Produto!', 'red', 3000);
        }
    });

}




// ********************************* FIM - DEFINIR IMAGEM PRINCIPAL - BRUNO R. BERNAL - 19/01/2022 ***************



// *************************************** LISTAR IMAGENS - BRUNO R. BERNAL - 19/01/2022 *********************

function listProductImg(id) {
    var id = id;

    $.ajax({

        url: "../../MaxComanda/controller/product/list-img.php/?listProductImg=1&directory=" + directory + "&id=" + id+'&id_user='+id_user+'&id_company='+id_company,
        type: 'POST',
        //data: data,
        dataType: 'html',
        success: function (data) {
            $('#listProductImg').html(data);
        },
        error: function () {
            showAlert('Não foi possível encontrar as Imagens deste Produto!', 'red', 3000);
        }
    });



}

// ************************************* FIM - LISTAR IMAGENS - BRUNO R. BERNAL - 19/01/2022 ****************

// *********************************** ENVIAR IMAGEM DOS PRODUTOS - BRUNO R. BERNAL - 19/01/2022 **************

function sendProductImg(id) {
    var id = id;
    var productImg = $('#productImg')[0].files[0];



    formData = new FormData();
    formData.append('productImg',productImg);
	formData.append('request',1);



    $.ajax({

        url: "../../MaxComanda/controller/product/list-img.php/?sendProductImg=1&directory="+directory+"&id="+id+'&id_user='+id_user+'&id_company='+id_company,
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        dataType: 'html',
        beforeSend: function () {
            loadShow();
            $("#btnSaveProductImg").attr('disabled',true);
        },
        success: function (data) {
                loadHide();
                $("#btnSaveProductImg").attr('disabled', false);
                $('#listProductImg').html(data);                 
        },
        error: function () {
            showAlert('Não foi possivel completar a requisição!', 'red', 3000);
            loadHide();
            $("#btnSaveProductImg").attr('disabled', false);
        }
    });




}



// *********************************** FIM - ENVIAR IMAGEM DOS PRODUTOS - BRUNO R. BERNAL - 19/01/2022 ************

// *************************************** GRAVAR / EDITAR - BRUNO R. BERNAL - 18/01/2022 *********************

function saveProduct() {
    var data = $("#formProduct").serialize();
    var local_menu = $("#local_menu").is(':checked');
    var online_menu = $("#online_menu").is(':checked');
    var morning = $("#morning").is(':checked');
    var afternoon = $("#afternoon").is(':checked');
    var night = $("#night").is(':checked');
    var defineStock = $("#defineStock").is(':checked');
    var status = $("#status").is(':checked');
    var kitchen = $("#kitchen").is(':checked');

    if (defineStock == true) {
        var defineStock = "S";
    } else {
        var defineStock = "N";
    }

    if (morning == true) {
        var morning = "S";
    } else {
        var morning = "N";
    }

    if (afternoon == true) {
        var afternoon = "S";
    } else {
        var afternoon = "N";
    }

    if (night == true) {
        var night = "S";
    } else {
        var night = "N";
    }

    if (local_menu == true) {
        var local_menu = "S";
    } else {
        var local_menu = "N";
    }

    if (online_menu == true) {
        var online_menu = "S";
    } else {
        var online_menu = "N";
    }

    if (status == true) {
        var status = "Ativo";
    } else {
        var status = "Inativo";
    }

    if (kitchen == true) {
        var kitchen = "S";
    } else {
        var kitchen = "N";
    }



    $.ajax({

        url: "../../MaxComanda/model/product/product-model.php/?saveProduct=1&directory=" + directory + "&local_menu=" + local_menu + "&online_menu=" + online_menu + "&morning=" + morning + "&afternoon=" + afternoon + "&night=" + night + "&defineStock=" +defineStock + '&status=' + status + '&kitchen=' +kitchen+'&id_user='+id_user+'&id_company='+id_company,
        type: 'POST',
        data: data,
        dataType: 'json',
        beforeSend: function () {
            loadShow();
            $("#btnSaveProduct").attr('disabled', true);
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
                $("#btnSaveProduct").attr('disabled', false);
            }
        },
        error: function () {
            showAlert('Não foi possivel completar a requisição!', 'red', 3000);
            loadHide();
            $("#btnSaveProduct").attr('disabled', false);
        }
    });



}

// *************************************** FIM - GRAVAR / EDITAR - BRUNO R. BERNAL - 18/01/2022 ****************



// ******************************** VALIDAR FORMULÁRIO - BRUNO R. BERNAL - 18/01/2022 ***********************

function validaForm() {
    var lockbtn = "";
    var location = $("#location").val();
    var subcategory = $("#subcategory").val();
    var name = $("#name").val();
    var sale_value = $("#sale_value").val();
    var defineStock = $("#defineStock").is(':checked');

    if(defineStock == true){
        $(".stock").show();
    } else{
        $(".stock").hide();
    }

    

    if (sale_value == "") {
        invalidInput('sale_value', 'msgSaleValue', 'Campo Obrigatório!*');
        lockbtn = 1;
    } else {
        validInput('sale_value', 'msgSaleValue', '');
    }

    if (subcategory == "") {
        invalidInput('subcategory', 'msgSubcategory', 'Campo Obrigatório!*');
        lockbtn = 1;
    } else {
        validInput('subcategory', 'msgSubcategory', '');
    }

    if (location == "") {
        invalidInput('location', 'msgLocation', 'Campo Obrigatório!*');
        lockbtn = 1;
    } else {
        validInput('location', 'msgLocation', '');
    }

    if (name == "") {
        invalidInput('name', 'msgName', 'Campo Obrigatório!*');
        lockbtn = 1;
    } else {
        validInput('name', 'msgName', '');
    }







    if (lockbtn == "") {
        $("#btnSaveProduct").attr('disabled', false);
    } else {
        $("#btnSaveProduct").attr('disabled', true);
    }
}


function validaFormFlavor(){
    var lockbtnFlavor = "";
    var nameFlavor = $("#nameFlavor").val();
    //var descriptionFlavor = $("#descriptionFlavor").val();


    if (nameFlavor == "") {
        invalidInput('nameFlavor', 'msgNameFlavor', 'Campo Obrigatório!*');
        lockbtnFlavor = 1;
    } else {
        validInput('nameFlavor', 'msgNameFlavor', '');
    }
/*
    if (descriptionFlavor == "") {
        invalidInput('descriptionFlavor', 'msgDescriptionFlavor', 'Campo Obrigatório!*');
        lockbtnFlavor = 1;
    } else {
        validInput('descriptionFlavor', 'msgDescriptionFlavor', '');
    }*/



    if (lockbtnFlavor == "") {
        $("#btnSaveFlavor").attr('disabled', false);
    } else {
        $("#btnSaveFlavor").attr('disabled', true);
    }
}

function validaFormAddition(){
    var lockbtnAddition = "";
    var nameAddition = $("#nameAddition").val();



    if (nameAddition == "") {
        invalidInput('nameAddition', 'msgNameAddition', 'Campo Obrigatório!*');
        lockbtnAddition = 1;
    } else {
        validInput('nameAddition', 'msgNameAddition', '');
    }


    if (lockbtnAddition == "") {
        $("#btnSaveAddition").attr('disabled', false);
    } else {
        $("#btnSaveAddition").attr('disabled', true);
    }
}


function validaEditFlavor(id){
    var id = id;

        $("#btnEditFlavor"+id).attr('disabled', false);

}

function validaEditAddition(id){
    var id = id;

        $("#btnEditAddition"+id).attr('disabled', false);

}

// ***************************** FIM - VALIDAR FORMULÁRIO - BRUNO R. BERNAL - 18/01/2022 ***********************


// ********************************* PESQUISAR PRODUTO - BRUNO R. BERNAL - 18/01/2022 ************************
function searchProduct() {
    var productName = $("#productName").val();


    $.ajax({
        type: 'GET',
        url: '../../MaxComanda/controller/product/table.php/?searchProduct=1&productName=' + productName+"&directory="+directory+'&id_user='+id_user+'&id_company='+id_company,
        //data : data,
        dataType: 'html',
        success: function (data) {
            showAlert('Pesquisa concluída com sucesso!', 'green', 3000);
            $('#listProduct').html(data);
        },
        error: function () {
            showAlert('Não foi possível completar a requisição!', 'red', 3000);
        }
    });

}


// ****************************** FIM - PESQUISAR PRODUTO - BRUNO R. BERNAL - 18/01/2022 ***********************