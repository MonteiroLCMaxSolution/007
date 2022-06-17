var http = $("#http").val();
var directory = $("#directory").val();
var id_user = $("#id_user").val();
var id_company = $("#id_company").val();



// **************************** VALIDAR FORMULÁRIO - BRUNO R. BERNAL - 18/01/2022 ********************
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
        $("#btnSaveCategory").attr('disabled', false);
    } else {
        $("#btnSaveCategory").attr('disabled', true);
    }
    
}

// ************************* FIM - VALIDAR FORMULÁRIO - BRUNO R. BERNAL - 18/01/2022 *******************


// ******************************** GRAVAR / EDITAR - BRUNO R. BERNAL - 18/01/2022 *********************

function saveCategory() {
    var data = $("#formCategory").serialize(); 



    $.ajax({

        url: "../../MaxComanda/model/category/category-model.php/?saveCategory=1&directory="+directory+'&id_user='+id_user+'&id_company='+id_company,
        type: 'POST',
        data: data,
        dataType: 'json',
        beforeSend: function () {
            loadShow();
            $("#btnSaveCategory").attr('disabled',true);
        },
        success: function (response) {
            if (response.codigo == 1) {
                showAlert(response.mensagem, 'green', 3000);
                loadHide();
                window.location.href = http + '/view/?pg=category';
            } else {
                showAlert('Erro: ' + response.mensagem, 'red', 3000);
                loadHide();
                $("#btnSaveCategory").attr('disabled', false);
            }
        },
        error: function () {
            showAlert('Não foi possivel completar a requisição!', 'red', 3000);
            loadHide();
            $("#btnSaveCategory").attr('disabled', false);
        }
    });



}

// ******************************* FIM - GRAVAR / EDITAR - BRUNO R. BERNAL - 18/01/2022 ****************

// *************************** PESQUISAR CATEGORIA - BRUNO R. BERNAL - 18/01/2022 ************************

function searchCategory(){
	var categoryName = $("#categoryName").val();


	$.ajax({
		type : 'GET',
		url  : '../../MaxComanda/controller/category/table.php/?searchCategory=1&categoryName='+categoryName+"&directory="+directory+'&id_user='+id_user+'&id_company='+id_company,
			//data : data,
			dataType: 'html',
			success :  function(data){
                showAlert('Pesquisa concluída com sucesso!','green',3000);
					$('#listCategory').html(data);					
			},error: function(){
                showAlert('Não foi possível completar a requisição!','red',3000);
			}	
		});

}


// ************************ FIM - PESQUISAR CATEGORIA - BRUNO R. BERNAL - 18/01/2022 *********************