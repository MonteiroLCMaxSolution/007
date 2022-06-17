$('select').select2({
    width: 99999
})

// **************************** VALIDAR FORMULÁRIO - BRUNO R. BERNAL - 18/01/2022 ********************
function validaForm() {
    var lockbtn = "";

    if(validaInput("name") == false){
        lockbtn = 1;
    }

    if(validaInput("status") == false){
        lockbtn = 1;
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

        url: http + main_directory + "/model/category/category-model.php/?saveCategory=1&directory="+directory+'&id_user='+id_user+'&id_company='+id_company+'&id_contract='+id_contract,
        type: 'POST',
        data: data,
        dataType: 'json',
        beforeSend: function () {
            loadShow();
            $("#btnSaveCategory").attr('disabled',true);
        },
        success: function (response) {
            if (response.codigo == 1) {
                loadHide();
                showAlert(response.mensagem, 'green', 3000);                
                window.location.href = '?pg=category';
            } else {
                loadHide();
                showAlert('Erro: ' + response.mensagem, 'red', 3000);
                $("#btnSaveCategory").attr('disabled', false);
            }
        },
        error: function () {
            loadHide();
            showAlert('Não foi possivel completar a requisição!', 'red', 3000);
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
		url  : http + main_directory + '/controller/category/table.php/?searchCategory=1&categoryName='+categoryName+"&directory="+directory+'&id_user='+id_user+'&id_company='+id_company+'&id_contract='+id_contract,
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