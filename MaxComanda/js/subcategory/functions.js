var http = $("#http").val();
var directory = $("#directory").val();
var id_user = $("#id_user").val();
var id_company = $("#id_company").val();
// *************************************** VALIDAR FORMULÁRIO - BRUNO R. BERNAL - 18/01/2022 ****************
function validaForm() {
    var lockbtn = "";
    var name = $("#name").val();
    var status = $("#status").val();
    var category = $("#category").val();

    if (category == "") {
        invalidInput('category', 'msgCategory', 'Campo Obrigatório!*');
        lockbtn = 1;
    } else {
        validInput('category', 'msgCategory', '');
    }

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
        $("#btnSaveSubcategory").attr('disabled', false);
    } else {
        $("#btnSaveSubcategory").attr('disabled', true);
    }
    
}

// *************************************** FIM - VALIDAR FORMULÁRIO - BRUNO R. BERNAL - 18/01/2022 ****************


// *************************************** GRAVAR / EDITAR - BRUNO R. BERNAL - 18/01/2022 *********************

function saveSubcategory() {
    var data = $("#formSubcategory").serialize(); 



    $.ajax({

        url: "../../MaxComanda/model/subcategory/subcategory-model.php/?saveSubcategory=1&directory="+directory+'&id_user='+id_user+'&id_company='+id_company,
        type: 'POST',
        data: data,
        dataType: 'json',
        beforeSend: function () {
            loadShow();
            $("#btnSaveSubcategory").attr('disabled',true);
        },
        success: function (response) {
            if (response.codigo == 1) {
                showAlert(response.mensagem, 'green', 3000);
                loadHide();
                window.location.href = http + '/view/?pg=subcategory';
            } else {
                showAlert('Erro: ' + response.mensagem, 'red', 3000);
                loadHide();
                $("#btnSaveSubcategory").attr('disabled', false);
            }
        },
        error: function () {
            showAlert('Não foi possivel completar a requisição!', 'red', 3000);
            loadHide();
            $("#btnSaveSubcategory").attr('disabled', false);
        }
    });



}

// *************************************** FIM - GRAVAR / EDITAR - BRUNO R. BERNAL - 18/01/2022 ****************

// ********************************* PESQUISAR SUBCATEGORIA - BRUNO R. BERNAL - 18/01/2022 ************************

function searchSubcategory(){
	var subcategoryName = $("#subcategoryName").val();


	$.ajax({
		type : 'GET',
		url  : '../../MaxComanda/controller/subcategory/table.php/?searchSubcategory=1&subcategoryName='+subcategoryName+"&directory="+directory+'&id_user='+id_user+'&id_company='+id_company,
			//data : data,
			dataType: 'html',
			success :  function(data){
                showAlert('Pesquisa concluída com sucesso!','green',3000);
					$('#listSubcategory').html(data);					
			},error: function(){
                showAlert('Não foi possível completar a requisição!','red',3000);
			}	
		});

}


// ****************************** FIM - PESQUISAR SUBCATEGORIA - BRUNO R. BERNAL - 18/01/2022 ***********************