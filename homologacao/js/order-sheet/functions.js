$.switcher();

// *************************************** LISTAR COMANDA - BRUNO R. BERNAL - 21/01/2022 *********************

function listOrderSheet() {
	$.ajax({
		type: 'POST',
		url: http + main_directory + '/controller/order-sheet/table.php/?listOrderSheet=1',
		data : 'id_user=' + id_user + '&id_company=' + id_company + '&id_contract=' + id_contract,
		dataType: 'html',
		success: function (data) {
			$("#listOrderSheet").html(data);
			$.switcher();
		},
		error: function () {
			//showAlert('Não foi possível completar a requisição!','red',3000);
		}
	});
}



// ************************************* FIM - LISTAR COMANDA - BRUNO R. BERNAL - 21/01/2022 ****************

// ************************************ MUDAR STATUS DA COMANDA - BRUNO R. BERNAL - 21/01/2022 *****************
function statusOrderSheet(id) {
	var id = id;
	var status = $("#status" + id).is(':checked');

	if (status == true) {
		var status = "Ativo";
	} else {
		var status = "Inativo";
	}

	$.ajax({
		type: 'POST',
		url: http + main_directory + '/controller/order-sheet/table.php/?statusOrderSheet=' + status,
		data : 'id=' + id + '&id_user=' + id_user + '&id_company=' + id_company + '&id_contract=' + id_contract,
		dataType: 'json',
		success: function (response) {
			if(response.codigo == 1){
				showAlert(response.mensagem, 'green', 3000);
			}else{
				showAlert(response.mensagem, 'red', 3000);
			}
		},
		error: function () {
			showAlert('Não foi possível completar a requisição!', 'red', 3000);
		}
	});

}
// ********************************* FIM - MUDAR STATUS DA COMANDA - BRUNO R. BERNAL - 21/01/2022 *************

// *************************************** ADICIONAR COMANDA - BRUNO R. BERNAL - 21/01/2022 *********************

function addOrderSheet() {
	$.ajax({
		type: 'POST',
		url: http + main_directory + '/controller/order-sheet/table.php/?addOrderSheet=1',
		data: 'id_user=' + id_user + '&id_company=' + id_company + '&id_contract=' + id_contract,
		dataType: 'json',
		success: function (response) {
			if (response.codigo == 1) {
				showAlert(response.mensagem, 'green', 3000);
				listOrderSheet();
			} else {
				showAlert(response.mensagem, 'red', 3000);
			}
		},
		error: function () {
			showAlert('Não foi possível completar a requisição!', 'red', 3000);
		}
	});
}



// ************************************* FIM - ADICIONAR COMANDA - BRUNO R. BERNAL - 21/01/2022 ****************