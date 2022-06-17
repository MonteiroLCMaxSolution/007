var http = $("#http").val();
var directory = $("#directory").val();
var id_user = $("#id_user").val();
var id_company = $("#id_company").val();

// ************************************* GRAVAR / EDITAR - BRUNO R. BERNAL - 02/02/2022 ********************

function savePromotion() {
    var data = $("#formPromotion").serialize(); 



    $.ajax({

        url: "../../MaxComanda/model/promotion/promotion-model.php/?savePromotion=1&directory="+directory+'&id_user='+id_user+'&id_company='+id_company,
        type: 'POST',
        data: data,
        dataType: 'json',
        beforeSend: function () {
            loadShow();
            $("#btnSavePromotion").attr('disabled',true);
        },
        success: function (response) {
            if (response.codigo == 1) {
                showAlert(response.mensagem, 'green', 3000);
                loadHide();
                window.location.href = http + '/view/?pg=promotion';
            } else {
                showAlert('Erro: ' + response.mensagem, 'red', 3000);
                loadHide();
                $("#btnSavePromotion").attr('disabled', false);
            }
        },
        error: function () {
            showAlert('Não foi possivel completar a requisição!', 'red', 3000);
            loadHide();
            $("#btnSavePromotion").attr('disabled', false);
        }
    });



}

// ************************************ FIM - GRAVAR / EDITAR - BRUNO R. BERNAL - 02/02/2022 ****************

// *************************************** VALIDAR FORMULÁRIO - BRUNO R. BERNAL - 02/02/2022 ****************
function validaForm() {
    var lockbtn = "";
    var product = $("#product").val();
    var status = $("#status").val();
    var new_value = $("#new_value").val();
    var start_date = $("#start_date").val();
    var end_date = $("#end_date").val();

    if (new_value == "") {
        invalidInput('new_value', 'msgNewValue', 'Campo Obrigatório!*');
        lockbtn = 1;
    } else {
        validInput('new_value', 'msgNewValue', '');
    }

    if (start_date == "") {
        invalidInput('start_date', 'msgStartDate', 'Campo Obrigatório!*');
        lockbtn = 1;
    } else {
        validInput('start_date', 'msgStartDate', '');
    }

    if (end_date == "") {
        invalidInput('end_date', 'msgEndDate', 'Campo Obrigatório!*');
        lockbtn = 1;
    } else {
        validInput('end_date', 'msgEndDate', '');
    }

    if (status == "") {
        invalidInput('status', 'msgStatus', 'Campo Obrigatório!*');
        lockbtn = 1;
    } else {
        validInput('status', 'msgStatus', '');
    }

    if (product == "") {
        //invalidInput('name', 'msgName', 'Campo Obrigatório!*');
        lockbtn = 1;
    } else {
        //validInput('name', 'msgName', '');
    }

    if (lockbtn == "") {
        $("#btnSavePromotion").attr('disabled', false);
    } else {
        $("#btnSavePromotion").attr('disabled', true);
    }
    
}

// ************************************ FIM - VALIDAR FORMULÁRIO - BRUNO R. BERNAL - 02/02/2022 **************

// ********************** BUSCAR PREÇO ATUAL DO PRODUTO - BRUNO R. BERNAL - 02/02/2022 **************
function searchOldValue(){
    var product = $("#product").val();

    $.ajax({

        url: "../../MaxComanda/model/promotion/promotion-model.php/?searchOldValue=1&directory="+directory+'&product='+product+'&id_user='+id_user+'&id_company='+id_company,
        type: 'POST',
        //data: formData,
        //contentType: false,
        //processData: false,
        dataType: 'json',
        beforeSend: function () {
            loadShow();
        },
        success: function (response) {
            if (response.codigo == 1) {
                var value = response.value;
                showAlert(response.mensagem, 'green', 3000);
                loadHide();
                $("#old_value").val(value);
                M.updateTextFields();
            } else {
                showAlert('Erro: ' + response.mensagem, 'red', 3000);
                loadHide();
            }
        },
        error: function () {
            showAlert('Não foi possivel encontrar o preço atual!', 'red', 3000);
            loadHide();
        }
    });

}


// ********************** BUSCAR PREÇO ATUAL DO PRODUTO - BRUNO R. BERNAL - 02/02/2022 **************


// ******************************* PESQUISAR PROMOÇÃO - BRUNO R. BERNAL - 02/02/2022 *******************

function searchPromotion(){
    var product = $("#product").val();
    var start_date = $("#start_date").val();
    var end_date = $("#end_date").val();

    $.ajax({
		type : 'GET',
		url  : '../../MaxComanda/controller/promotion/table.php/?searchPromotion=1&product='+product+'&directory='+directory+'&start_date='+start_date+'&end_date='+end_date+'&id_user='+id_user+'&id_company='+id_company,
			//data : data,
			dataType: 'html',
			success :  function(data){
                showAlert('Pesquisa concluída com sucesso!','green',3000);
					$('#listPromotion').html(data);					
			},error: function(){
                showAlert('Não foi possível completar a requisição!','red',3000);
			}	
		});
}


// ******************************* FIM - PESQUISAR PROMOÇÃO - BRUNO R. BERNAL - 02/02/2022 *******************