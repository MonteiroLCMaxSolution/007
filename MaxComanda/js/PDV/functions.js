var http = $("#http").val();
var directory = $("#directory").val();
var id_user = $("#id_user").val();
var id_company = $("#id_company").val();

// ********** RELATÓRIO DE FECHAMENTO DE CAIXA - BRUNO R. BERNAL - 17/02/2022 *******************************

function printCloseCashier(cashierID){
	var cashierID = cashierID;
	var userName = $("#userName").val();

	window.open('../../MaxComanda/controller/PDV/print-close-cashier.php?pdfCloseCashier=1&directory=' + directory + '&id_user=' + id_user + '&id_company=' + id_company + '&cashierID=' + cashierID + '&userName=' + userName);
}

// ********** FIM - RELATÓRIO DE FECHAMENTO DE CAIXA - BRUNO R. BERNAL - 17/02/2022 **************************

// *********** MULTIPLICAR VALOR AO MUDAR A QUANTIDADE NO MODAL EDIT ITEM - BRUNO R. BERNAL - 15/02/2022 ******

function calcQuantityEdit(orderItemID) {
	var orderItemID = orderItemID;

	var quantity = $("#quantity" + orderItemID).val();

	var value = $("#total" + orderItemID).val().replace('.', '');
	var value = (value).replace('.', '');
	var value = (value).replace(',', '.');
	var value = parseFloat(value);


	var newValue = value * quantity;
	var newValue = (newValue).toLocaleString("pt-BR", {
		minimumFractionDigits: 2,
		maximumFractionDigits: 2
	});
	$("#totalFinal" + orderItemID).val(newValue);
}

// ****** FIM - MULTIPLICAR VALOR AO MUDAR A QUANTIDADE NO MODAL EDIT ITEM - BRUNO R. BERNAL - 15/02/2022 ******

// ************** LISTAR DADOS DO PRODUTO NO MODAL EDIT ITEM PDV - BRUNO R. BERNAL - 15/02/2022 *********

function modalEditItem(orderItemID) {
	var orderItemID = orderItemID;


	$.ajax({
		type: 'GET',
		url: '../../MaxComanda/controller/PDV/modal-edit-item.php/?modalEditItemPDV=1&directory=' + directory + '&id_user=' + id_user + '&id_company=' + id_company + '&orderItemID=' + orderItemID,
		//data : data,
		dataType: 'html',
		success: function (data) {
			//showAlert('Pesquisa concluída com sucesso!','green',3000);
			$('#listModalEditItem' + orderItemID).html(data);
			M.updateTextFields();
			//addItemPDVTemp(product_id);
		},
		error: function () {
			//showAlert('Não foi possível completar a requisição!','red',3000);
		}
	});



}


// ************** FIM - LISTAR DADOS DO PRODUTO NO MODAL EDIT ITEM PDV - BRUNO R. BERNAL - 15/02/2022 *********

// *********** MULTIPLICAR VALOR AO MUDAR A QUANTIDADE NO MODAL ADDITEM - BRUNO R. BERNAL - 15/02/2022 ******

function calcQuantity(product_id) {
	var product_id = product_id;

	var quantity = $(".quantity" + product_id).val();

	var value = $(".total" + product_id).val().replace('.', '');
	var value = (value).replace('.', '');
	var value = (value).replace(',', '.');
	var value = parseFloat(value);

	var newValue = value * quantity;
	var newValue = (newValue).toLocaleString("pt-BR", {
		minimumFractionDigits: 2,
		maximumFractionDigits: 2
	});
	$(".totalFinal" + product_id).val(newValue);
}

// ******** FIM - MULTIPLICAR VALOR AO MUDAR A QUANTIDADE NO MODAL ADDITEM - BRUNO R. BERNAL - 15/02/2022 ******

// ************** LISTAR DADOS DO PRODUTO NO MODAL ADD ITEM PDV - BRUNO R. BERNAL - 15/02/2022 *********

function modalAddItemPDVTemp(product_id) {
	var product_id = product_id;


	$.ajax({
		type: 'GET',
		url: '../../MaxComanda/controller/PDV/modal-add-product.php/?modalAddItemPDVTemp=1&directory=' + directory + '&id_user=' + id_user + '&id_company=' + id_company + '&product_id=' + product_id,
		//data : data,
		dataType: 'html',
		success: function (data) {
			//showAlert('Pesquisa concluída com sucesso!','green',3000);
			$('#listModalAddItem' + product_id).html(data);
			M.updateTextFields();
			//addItemPDVTemp(product_id);
		},
		error: function () {
			//showAlert('Não foi possível completar a requisição!','red',3000);
		}
	});



}


// ************** FIM - LISTAR DADOS DO PRODUTO NO MODAL ADD ITEM PDV - BRUNO R. BERNAL - 15/02/2022 *********

// *************** DELETAR ITEM NO PDV - BRUNO R. BERNAL - 11/02/2022 ******************************
function deleteItemPDV(orderItemID) {
	var orderItemID = orderItemID;
	var orderSheet = $("#orderSheet").val();
	var uniqID = $("#uniqID").val();

	$("#listProduct").html("");



	if (confirm("Deseja realmente Remover o Item?")) {

		$.ajax({
			type: 'GET',
			url: '../../MaxComanda/model/PDV/PDV-model.php/?deleteItemPDV=1&directory=' + directory + '&id_user=' + id_user + '&id_company=' + id_company + '&orderItemID=' + orderItemID,
			//data : data,
			dataType: 'json',
			beforeSend: function () {
				loadShow();
			},
			success: function (response) {
				if (response.codigo == 1) {
					//showAlert(response.mensagem, 'green', 3000);
					loadHide();

					if (orderSheet != "") {
						showOrderSheet();
					} else if (uniqID != undefined) {
						listPDV(uniqID);
					}

				} else {
					showAlert('Erro: ' + response.mensagem, 'red', 3000);
					loadHide();
				}
			},
			error: function () {
				loadHide();
				showAlert('Não foi possível completar a requisição!', 'red', 3000);
			}
		});

	} else {

	}
}
// *************** FIM - DELETAR ITEM NO PDV - BRUNO R. BERNAL - 11/02/2022 ******************************

// ****************** LISTAR PEDIDO DE BALCÃO - BRUNO R. BERNAL - 10/02/2022 *****************************

function listPDV(uniqid) {
	var uniqID = uniqid;


	$.ajax({
		type: 'GET',
		url: '../../MaxComanda/controller/PDV/table-PDV.php/?listPDV=1&directory=' + directory + '&id_user=' + id_user + '&id_company=' + id_company + '&uniqID=' + uniqID,
		//data : data,
		dataType: 'html',
		success: function (data) {
			//showAlert('Alteração realizada com sucesso!', 'green', 3000);
			$('#listPDV').html(data);
			$("#btnModalCloseOrder").attr('disabled', false);
			$("#numberTable").val("");
			$(".btnCategory").attr('disabled', false);
		},
		error: function () {
			//showAlert('Não foi possível completar a requisição!', 'red', 3000);
		}
	});


}

// ****************** FIM - LISTAR PEDIDO DE BALCÃO - BRUNO R. BERNAL - 10/02/2022 *****************************

// ******************* SELECIONAR COMPLEMENTO NO PDV - BRUNO R. BERNAL - 10/02/2022 ***************************
// 					----- MODAL EDITAR ITEM -----
function selectAddition(addition_id, product_id, itemID) {
	var itemID = itemID;
	var addition_id = addition_id;
	var product_id = product_id;
	var orderItemID = $("#idOrderItem" + itemID).val();
	var addition = $("#addition" + addition_id + itemID).is(':checked');
	var value = $("#total" + itemID).val();

	if (addition == true) {
		// --- ADICIONAR COMPLEMENTO ---

		$.ajax({
			type: 'GET',
			url: '../../MaxComanda/model/PDV/PDV-model.php/?addAddition=1&directory=' + directory + '&id_user=' + id_user + '&id_company=' + id_company + '&orderItemID=' + orderItemID + '&product_id=' + product_id + '&addition_id=' + addition_id + '&value=' + value,
			//data : data,
			dataType: 'json',
			beforeSend: function () {
				loadShow();
			},
			success: function (response) {
				if (response.codigo == 1) {
					var value = response.value;
					//showAlert(response.mensagem, 'green', 3000);
					loadHide();
					$("#total" + itemID).val(value);
					calcQuantityEdit(orderItemID);
				} else {
					showAlert('Erro: ' + response.mensagem, 'red', 3000);
					loadHide();
					$("#addition" + addition_id + itemID).prop("checked", false);
				}
			},
			error: function () {
				loadHide();
				showAlert('Não foi possível completar a requisição!', 'red', 3000);
				$("#addition" + addition_id + itemID).prop("checked", false);
			}
		});



	} else {
		// --- REMOVER COMPLEMENTO ---

		$.ajax({
			type: 'GET',
			url: '../../MaxComanda/model/PDV/PDV-model.php/?removeAddition=1&directory=' + directory + '&id_user=' + id_user + '&id_company=' + id_company + '&orderItemID=' + orderItemID + '&product_id=' + product_id + '&addition_id=' + addition_id + '&value=' + value,
			//data : data,
			dataType: 'json',
			beforeSend: function () {
				loadShow();
			},
			success: function (response) {
				if (response.codigo == 1) {
					var value = response.value;
					//showAlert(response.mensagem, 'green', 3000);
					loadHide();
					$("#total" + itemID).val(value);
					calcQuantityEdit(orderItemID);
				} else {
					showAlert('Erro: ' + response.mensagem, 'red', 3000);
					loadHide();
					$("#addition" + addition_id + itemID).prop("checked", true);
				}
			},
			error: function () {
				loadHide();
				showAlert('Não foi possível completar a requisição!', 'red', 3000);
				$("#addition" + addition_id + itemID).prop("checked", true);
			}
		});



	}
}

//					----- MODAL NOVO ITEM -----
function selectAdditionNew(addition_id, product_id) {
	var addition_id = addition_id;
	var product_id = product_id;
	var orderItemID = $(".idOrderItem" + product_id).val();

	var additionValue = $(".additionValue" + addition_id).val();
	var additionValue = (additionValue).replace('.', '');
	var additionValue = (additionValue).replace(',', '.');
	var additionValue = parseFloat(additionValue);

	var value = $(".total" + product_id).val().replace('.', '');
	var value = (value).replace('.', '');
	var value = (value).replace(',', '.');
	var value = parseFloat(value);


	if ($(".addition" + addition_id).is(":checked")) {
		var newValue = value + additionValue;
		var newValue = (newValue).toLocaleString("pt-BR", {
			minimumFractionDigits: 2,
			maximumFractionDigits: 2
		});
		$(".total" + product_id).val(newValue);
	} else {
		var newValue = value - additionValue;
		var newValue = (newValue).toLocaleString("pt-BR", {
			minimumFractionDigits: 2,
			maximumFractionDigits: 2
		});
		$(".total" + product_id).val(newValue);
	}

	calcQuantity(product_id);


	/*

		if (addition == true) {
			// --- ADICIONAR COMPLEMENTO ---

			$.ajax({
				type: 'GET',
				url: '../../MaxComanda/model/PDV/PDV-model.php/?addAddition=1&directory=' + directory + '&id_user=' + id_user + '&id_company=' + id_company + '&orderItemID=' + orderItemID + '&product_id=' + product_id + '&addition_id=' + addition_id + '&value=' + value,
				//data : data,
				dataType: 'json',
				beforeSend: function () {
					loadShow();
				},
				success: function (response) {
					if (response.codigo == 1) {
						var value = response.value;
						//showAlert(response.mensagem, 'green', 3000);
						loadHide();
						$(".total" + product_id).val(value);
					} else {
						showAlert('Erro: ' + response.mensagem, 'red', 3000);
						loadHide();
						$(".addition" + addition_id).prop("checked", false);
					}
				},
				error: function () {
					loadHide();
					showAlert('Não foi possível completar a requisição!', 'red', 3000);
					$(".addition" + addition_id).prop("checked", false);
				}
			});



		} else {
			// --- REMOVER COMPLEMENTO ---

			$.ajax({
				type: 'GET',
				url: '../../MaxComanda/model/PDV/PDV-model.php/?removeAddition=1&directory=' + directory + '&id_user=' + id_user + '&id_company=' + id_company + '&orderItemID=' + orderItemID + '&product_id=' + product_id + '&addition_id=' + addition_id + '&value=' + value,
				//data : data,
				dataType: 'json',
				beforeSend: function () {
					loadShow();
				},
				success: function (response) {
					if (response.codigo == 1) {
						var value = response.value;
						//showAlert(response.mensagem, 'green', 3000);
						loadHide();
						$(".total" + product_id).val(value);
					} else {
						showAlert('Erro: ' + response.mensagem, 'red', 3000);
						loadHide();
						$(".addition" + addition_id).prop("checked", true);
					}
				},
				error: function () {
					loadHide();
					showAlert('Não foi possível completar a requisição!', 'red', 3000);
					$(".addition" + addition_id).prop("checked", true);
				}
			});



		}

		*/

}


// ***************** FIM - SELECIONAR COMPLEMENTO NO PDV - BRUNO R. BERNAL - 10/02/2022 ************************

// ****************** FECHAR MODAL ADD ITEM PDV - BRUNO R. BERNAL - 10/02/2022 **************************
/*
function deleteItemTemp(product_id) {
	var product_id = product_id;
	var orderItemID = $(".idOrderItem" + product_id).val();
	var orderSheet = $("#orderSheet").val();
	var uniqID = $("#uniqID").val();

	$("#listProduct").html("");



	if (confirm("Deseja realmente Cancelar?")) {

		$.ajax({
			type: 'GET',
			url: '../../MaxComanda/model/PDV/PDV-model.php/?deleteItemTemp=1&directory=' + directory + '&id_user=' + id_user + '&id_company=' + id_company + '&orderItemID=' + orderItemID,
			//data : data,
			dataType: 'json',
			beforeSend: function () {
				loadShow();
			},
			success: function (response) {
				if (response.codigo == 1) {
					//showAlert(response.mensagem, 'green', 3000);
					loadHide();

					if (orderSheet != "") {
						showOrderSheet();
					} else if (uniqID != undefined) {
						listPDV(uniqID);
					}

				} else {
					showAlert('Erro: ' + response.mensagem, 'red', 3000);
					loadHide();
				}
			},
			error: function () {
				loadHide();
				showAlert('Não foi possível completar a requisição!', 'red', 3000);
			}
		});

	} else {

	}
}
*/
// ****************** FIM - FECHAR MODAL ADD ITEM PDV - BRUNO R. BERNAL - 10/02/2022 **************************

// ******************* SELECIONAR SABOR NO PDV - BRUNO R. BERNAL - 10/02/2022 ***************************
//					----- MODAL EDITAR PRODUTO -----
function selectFlavor(flavor_id, product_id, itemID) {
	var itemID = itemID;
	var flavor_id = flavor_id;
	var product_id = product_id;
	var orderItemID = $("#idOrderItem" + itemID).val();
	var flavor = $("#flavor" + flavor_id + itemID).is(':checked');

	if (flavor == true) {
		// --- ADICIONAR SABOR ---

		$.ajax({
			type: 'GET',
			url: '../../MaxComanda/model/PDV/PDV-model.php/?addFlavor=1&directory=' + directory + '&id_user=' + id_user + '&id_company=' + id_company + '&orderItemID=' + orderItemID + '&product_id=' + product_id + '&flavor_id=' + flavor_id,
			//data : data,
			dataType: 'json',
			beforeSend: function () {
				loadShow();
			},
			success: function (response) {
				if (response.codigo == 1) {
					//showAlert(response.mensagem, 'green', 3000);
					loadHide();
				} else {
					showAlert('Erro: ' + response.mensagem, 'red', 3000);
					loadHide();
					$("#flavor" + flavor_id + itemID).prop("checked", false);
				}
			},
			error: function () {
				loadHide();
				showAlert('Não foi possível completar a requisição!', 'red', 3000);
				$("#flavor" + flavor_id + itemID).prop("checked", false);
			}
		});





	} else {
		// --- REMOVER SABOR ---

		$.ajax({
			type: 'GET',
			url: '../../MaxComanda/model/PDV/PDV-model.php/?removeFlavor=1&directory=' + directory + '&id_user=' + id_user + '&id_company=' + id_company + '&orderItemID=' + orderItemID + '&product_id=' + product_id + '&flavor_id=' + flavor_id,
			//data : data,
			dataType: 'json',
			beforeSend: function () {
				loadShow();
			},
			success: function (response) {
				if (response.codigo == 1) {
					//showAlert(response.mensagem, 'green', 3000);
					loadHide();
				} else {
					showAlert('Erro: ' + response.mensagem, 'red', 3000);
					loadHide();
					$("#flavor" + flavor_id + itemID).prop("checked", true);
				}
			},
			error: function () {
				loadHide();
				showAlert('Não foi possível completar a requisição!', 'red', 3000);
				$("#flavor" + flavor_id + itemID).prop("checked", true);
			}
		});



	}
}

//					----- MODAL NOVO PRODUTO -----
function selectFlavorNew(product_id, flavor_id) {
	var product_id = product_id;
	var flavor_id = flavor_id;
	var selectedFlavor = $(".selectedFlavor" + product_id).val();
	var fraction = $(".fraction" + product_id).val();


	if ($('.flavor' + flavor_id).is(":checked")) {
		var selectedFlavor = parseInt(selectedFlavor) + 1;
		if (fraction >= selectedFlavor) {
			$(".selectedFlavor" + product_id).val(selectedFlavor);
		} else {
			$('.flavor' + flavor_id).prop('checked', false);
		}
	} else {
		var selectedFlavor = parseInt(selectedFlavor) - 1;
		$(".selectedFlavor" + product_id).val(selectedFlavor);
	}


	/*

	if (flavor == true) {
		// --- ADICIONAR SABOR ---

		$.ajax({
			type: 'GET',
			url: '../../MaxComanda/model/PDV/PDV-model.php/?addFlavor=1&directory=' + directory + '&id_user=' + id_user + '&id_company=' + id_company + '&orderItemID=' + orderItemID + '&product_id=' + product_id + '&flavor_id=' + flavor_id,
			//data : data,
			dataType: 'json',
			beforeSend: function () {
				loadShow();
			},
			success: function (response) {
				if (response.codigo == 1) {
					//showAlert(response.mensagem, 'green', 3000);
					loadHide();
				} else {
					showAlert('Erro: ' + response.mensagem, 'red', 3000);
					loadHide();
					$(".flavor" + flavor_id).prop("checked", false);
				}
			},
			error: function () {
				loadHide();
				showAlert('Não foi possível completar a requisição!', 'red', 3000);
				$(".flavor" + flavor_id).prop("checked", false);
			}
		});

		



	} else {
		// --- REMOVER SABOR ---

		$.ajax({
			type: 'GET',
			url: '../../MaxComanda/model/PDV/PDV-model.php/?removeFlavor=1&directory=' + directory + '&id_user=' + id_user + '&id_company=' + id_company + '&orderItemID=' + orderItemID + '&product_id=' + product_id + '&flavor_id=' + flavor_id,
			//data : data,
			dataType: 'json',
			beforeSend: function () {
				loadShow();
			},
			success: function (response) {
				if (response.codigo == 1) {
					//showAlert(response.mensagem, 'green', 3000);
					loadHide();
				} else {
					showAlert('Erro: ' + response.mensagem, 'red', 3000);
					loadHide();
					$(".flavor" + flavor_id).prop("checked", true);
				}
			},
			error: function () {
				loadHide();
				showAlert('Não foi possível completar a requisição!', 'red', 3000);
				$(".flavor" + flavor_id).prop("checked", true);
			}
		});



	} */
}


// ******************* FIM - SELECIONAR SABOR NO PDV - BRUNO R. BERNAL - 10/02/2022 ***************************

// ********************* CALCULAR O TROCO AO FECHAR PEDIDO - BRUNO R. BERNAL - 08/02/2022 ****************

function calcChange() {

	var totalValue = $("#totalValue").val().replace(',', '.');
	var totalValue = parseFloat(totalValue);

	var paymentMoney = $("#paymentMoney").val();
	if (paymentMoney == "") {
		var paymentMoney = 0.0;
	} else {
		var paymentMoney = (paymentMoney).replace('.', '');
		var paymentMoney = (paymentMoney).replace(',', '.');
		var paymentMoney = parseFloat(paymentMoney);
	}


	var paymentCredit = $("#paymentCredit").val();
	if (paymentCredit == "") {
		var paymentCredit = 0.0;
	} else {
		var paymentCredit = (paymentCredit).replace('.', '');
		var paymentCredit = (paymentCredit).replace(',', '.');
		var paymentCredit = parseFloat(paymentCredit);
	}

	var paymentDebit = $("#paymentDebit").val();
	if (paymentDebit == "") {
		var paymentDebit = 0.0;
	} else {
		var paymentDebit = (paymentDebit).replace('.', '');
		var paymentDebit = (paymentDebit).replace(',', '.');
		var paymentDebit = parseFloat(paymentDebit);
	}

	var paymentPIX = $("#paymentPIX").val();
	if (paymentPIX == "") {
		var paymentPIX = 0.0;
	} else {
		var paymentPIX = (paymentPIX).replace('.', '');
		var paymentPIX = (paymentPIX).replace(',', '.');
		var paymentPIX = parseFloat(paymentPIX);
	}



	// --- CALCULAR TROCO ---
	if (totalValue < (paymentMoney + paymentCredit + paymentDebit + paymentPIX)) {
		var change = (paymentMoney + paymentCredit + paymentDebit + paymentPIX) - totalValue;
		var change = (change).toLocaleString("pt-BR", {
			minimumFractionDigits: 2,
			maximumFractionDigits: 2
		});
		$("#paymentChange").val(change);
		M.updateTextFields();
	} else {
		$("#paymentChange").val("");
	}

	// --- CALCULAR DESCONTO ---
	if (totalValue > (paymentMoney + paymentCredit + paymentDebit + paymentPIX)) {
		var discount = totalValue - (paymentMoney + paymentCredit + paymentDebit + paymentPIX);
		var discount = (discount).toLocaleString("pt-BR", {
			minimumFractionDigits: 2,
			maximumFractionDigits: 2
		});
		$("#paymentDiscount").val(discount);
		M.updateTextFields();
	} else {
		$("#paymentDiscount").val("");
	}




}

// ********************* FIM - CALCULAR O TROCO AO FECHAR PEDIDO - BRUNO R. BERNAL - 08/02/2022 ****************

// ******************************** RETIRAR DINHEIRO DO CAIXA - BRUNO R. BERNAL - 01/02/2022 ************

function withdraw() {
	var cashier_origin = $("#cashier").val();
	var cashier_destiny = $("#cashier_destiny").val();
	var value = $("#value").val();
	var description = $("#reason").val();


	$.ajax({
		type: 'GET',
		url: '../../MaxComanda/model/PDV/PDV-model.php/?withdraw=1&directory=' + directory + '&cashier_origin=' + cashier_origin + '&cashier_destiny=' + cashier_destiny + '&value=' + value + '&description=' + description + '&id_user=' + id_user + '&id_company=' + id_company,
		//data : data,
		dataType: 'json',
		beforeSend: function () {
			loadShow();
		},
		success: function (response) {
			if (response.codigo == 1) {
				showAlert(response.mensagem, 'green', 3000);
				loadHide();
				window.location.href = http + '/view/?pg=PDV';
			} else {
				showAlert('Erro: ' + response.mensagem, 'red', 3000);
				loadHide();
			}
		},
		error: function () {
			showAlert('Não foi possível completar a requisição!', 'red', 3000);
			loadHide();
		}
	});

}

// ***************************** FIM - RETIRAR DINHEIRO DO CAIXA - BRUNO R. BERNAL - 01/02/2022 ************

// ********************************* IMPRIMIR COMPROVANTE - BRUNO R. BERNAL - 01/02/2022 *******************
function print() {
	var uniqID = $("#uniqID").val();
	var orderSheet = $("#orderSheet").val();
	var numberTable = $("#numberTable").val();

	if (uniqID != undefined || orderSheet != "" || numberTable != "") {

		window.open('../../MaxComanda/controller/PDV/print.php?pdf=1&uniqID=' + uniqID + '&orderSheet=' + orderSheet + '&numberTable=' + numberTable + '&directory=' + directory + '&id_user=' + id_user + '&id_company=' + id_company);
		//window.location.href = http + '/view/?pg=PDV';

		/*	$.ajax({
				type: 'GET',
				url: '../../MaxComanda/controller/PDV/ticket.php/?print=1&directory=' + directory + '&uniqID=' + uniqID + '&orderSheet=' + orderSheet + '&table=' + numberTable,
				//data : data,
				dataType: 'html',
				success: function (data) {
					$("#listPDV").html(data);


				},
				error: function () {
					showAlert('Não foi possível listar o valor total do Pedido!', 'red', 3000);
				}
			});*/


	} else {
		showAlert('Informe uma Mesa, Comanda ou Faça um Novo Pedido!', 'red', 3000);
	}






}


// ***************************** FIM - IMPRIMIR COMPROVANTE - BRUNO R. BERNAL - 01/02/2022 *******************

// ********************************* MODAL PARA FECHAR PEDIDO - BRUNO R. BERNAL - 28/01/2022 *****************
function modalCloseOrder() {

	var total = $("#total").val();





	$.ajax({
		type: 'GET',
		url: '../../MaxComanda/controller/PDV/modal-close-order.php/?modalCloseOrder=1&directory=' + directory + '&total=' + total + '&id_user=' + id_user + '&id_company=' + id_company,
		//data : data,
		dataType: 'html',
		success: function (data) {
			$("#modalCloseOrder").modal('open');
			//showAlert('Pesquisa concluída com sucesso!','green',3000);
			$('#closeOrder').html(data);
		},
		error: function () {
			showAlert('Não foi possível listar o valor total do Pedido!', 'red', 3000);
		}
	});




}



// *********************** FIM - MODAL PARA FECHAR PEDIDO - BRUNO R. BERNAL - 28/01/2022 ********************

// ********************************* LISTAR PEDIDOS DA MESA- BRUNO R. BERNAL - 28/01/2022 *****************
function showTable() {


	var table = $("#numberTable").val();

	if (table == "") {
		showAlert('Informe uma Mesa para Listar!', 'red', 3000);
		$('#listPDV').html("");
		$("#orderSheet").val("");

	} else {
		$("#orderSheet").val("");



		$.ajax({
			type: 'GET',
			url: '../../MaxComanda/controller/PDV/show-table.php/?showTable=1&table=' + table + '&directory=' + directory + '&id_user=' + id_user + '&id_company=' + id_company,
			//data : data,
			dataType: 'html',
			success: function (data) {
				//showAlert('Pesquisa concluída com sucesso!','green',3000);
				$('#listPDV').html(data);
				$("#orderSheet").val("");
				$(".btnCategory").attr('disabled', true);
				$("#listProduct").html("");
				$("#btnModalCloseOrder").attr('disabled', false);
			},
			error: function () {
				showAlert('Não foi possível completar a requisição!', 'red', 3000);
			}
		});
	}



}



// *********************** FIM - LISTAR PEDIDOS DA MESA - BRUNO R. BERNAL - 28/01/2022 ********************

// ************************************ EXIBIR COMANDA - BRUNO R. BERNAL - 28/01/2022 ************************

function showOrderSheet() {
	$('#cashier').focus();


	var id = $("#orderSheet").val();
	if (id == "") {
		showAlert('Informe uma Comanda para Consultar!', 'red', 3000);
		$("#numberTable").val("");
	} else {
		$("#numberTable").val("");








		$.ajax({
			type: 'GET',
			url: '../../MaxComanda/controller/PDV/table-PDV.php/?showOrderSheet=1&id=' + id + '&directory=' + directory + '&id=' + id + '&id_user=' + id_user + '&id_company=' + id_company,
			//data : data,
			dataType: 'html',
			success: function (data) {
				//showAlert('Alteração realizada com sucesso!', 'green', 3000);
				$('#listPDV').html(data);
				$("#btnModalCloseOrder").attr('disabled', false);
				$("#numberTable").val("");
				$(".btnCategory").attr('disabled', false);
			},
			error: function () {
				//showAlert('Não foi possível completar a requisição!', 'red', 3000);
			}
		});

	}


}

// --- EXIBIR COMANDA PELA MESA ---
function showOrderSheetbyTable(id) {


	var id = id;







	$.ajax({
		type: 'GET',
		url: '../../MaxComanda/controller/PDV/table-PDV.php/?showOrderSheet=1&id=' + id + '&directory=' + directory + '&id=' + id + '&id_user=' + id_user + '&id_company=' + id_company,
		//data : data,
		dataType: 'html',
		success: function (data) {
			//showAlert('Alteração realizada com sucesso!', 'green', 3000);
			$('#listPDV').html(data);
			$("#btnModalCloseOrder").attr('disabled', false);
			$(".btnCategory").attr('disabled', false);
			$('#numberTable').val("");
			$('#orderSheet').val(id);
		},
		error: function () {
			//showAlert('Não foi possível completar a requisição!', 'red', 3000);
		}
	});


}




// ****************************** FIM - EXIBIR COMANDA - BRUNO R. BERNAL - 28/01/2022 *********************


// *********************************** FINALIZAR PEDIDO - BRUNO R. BERNAL - 27/01/2022 **************************

function closeOrder() {
	var cpf_cnpj = $("#cpf_cnpj").val();

	var money = $("#paymentMoney").val();
	var credit = $("#paymentCredit").val();
	var debit = $("#paymentDebit").val();
	var PIX = $("#paymentPIX").val();
	var discount = $("#paymentDiscount").val();
	var cashier = $("#cashier").val();

	var uniqID = $("#uniqID").val();

	var orderSheet = $("#orderSheet").val();
	var numberTable = $("#numberTable").val();

	if (confirm('Deseja realmente Finalizar o Pedido?')) {

		if (confirm('Deseja imprimir o Cupom?')) {

			print();

		} else {

		}

		$.ajax({
			type: 'GET',
			url: '../../MaxComanda/controller/PDV/table-PDV.php/?closeOrder=1&directory=' + directory + '&cpf_cnpj=' + cpf_cnpj + '&uniqID=' + uniqID + '&money=' + money + '&credit=' + credit + '&debit=' + debit + '&PIX=' + PIX + '&discount=' + discount + '&cashier=' + cashier + '&orderSheet=' + orderSheet + '&numberTable=' + numberTable + '&id_user=' + id_user + '&id_company=' + id_company,
			//data : data,
			dataType: 'html',
			beforeSend: function () {
				loadShow();
			},
			success: function (data) {
				showAlert('Pedido Fechado com Sucesso', 'green', 3000);
				loadHide();
				window.location.href = http + '/view/?pg=PDV';
			},
			error: function () {
				loadHide();
				showAlert('Não foi possível completar a requisição!', 'red', 3000);
			}
		});

	} else {

	}


}




// *************************** FIM - FINALIZAR PEDIDO - BRUNO R. BERNAL - 27/01/2022 *********************

// ************************************ DELETAR ITEM - BRUNO R. BERNAL - 27/01/2022 *****************

function deleteItem(id) {
	var id = id;
	var uniqID = $("#uniqID").val();


	if (confirm('Deseja realmente deletar o Item ?')) {

		$.ajax({
			type: 'GET',
			url: '../../MaxComanda/controller/PDV/table-PDV.php/?deleteItem=1&id=' + id + '&directory=' + directory + '&uniqID=' + uniqID + '&id_user=' + id_user + '&id_company=' + id_company,
			//data : data,
			dataType: 'html',
			success: function (data) {
				$("#modalItem" + id).modal('close');
				showAlert('Item Deletado com sucesso!', 'green', 3000);
				showTable
				$("#btnModal").attr('disabled', false);
			},
			error: function () {
				showAlert('Não foi possível completar a requisição!', 'red', 3000);
			}
		});


	} else {

		showAlert('O Item não foi deletado!', 'green', 3000);
		$("#modalItem" + id).modal('close');

	}


}




// *************************** FIM - DELETAR ITEM - BRUNO R. BERNAL - 27/01/2022 *********************

// ************************* ALTERAR INFORMAÇÕES DO ITEM - BRUNO R. BERNAL - 27/01/2022 **************

function changeItem(id) {
	var id = id;
	var quantity = $("#quantity" + id).val();
	var observation = $("#observation" + id).val();
	var uniqID = $("#uniqID").val();
	var orderSheet = $("#orderSheet").val();


	$.ajax({
		type: 'GET',
		url: '../../MaxComanda/controller/PDV/table-PDV.php/?changeItem=1&id=' + id + '&directory=' + directory + '&quantity=' + quantity + '&observation=' + observation + '&uniqID=' + uniqID + '&id_user=' + id_user + '&id_company=' + id_company,
		//data : data,
		dataType: 'html',
		success: function (data) {
			$("#modalItem" + id).modal('close');
			showAlert('Alteração realizada com sucesso!', 'green', 3000);
			$("#btnModalCloseOrder").attr('disabled', false);
			if (orderSheet != "") {
				showOrderSheet();
			} else {
				listPDV(uniqID);
			}
		},
		error: function () {
			showAlert('Não foi possível completar a requisição!', 'red', 3000);
		}
	});


}




// ************************* FIM - ALTERAR INFORMAÇÕES DO ITEM - BRUNO R. BERNAL - 27/01/2022 **************

// ************* LISTAR RELATÓRIO PARA FECHAR O CAIXA NO MESMO DIA - BRUNO R. BERNAL - 26/01/2022 *********
function modalCloseCashier() {

	var id = $("#cashier").val();


	$.ajax({
		type: 'GET',
		url: '../../MaxComanda/controller/PDV/modal-close-cashier.php/?relatoryCashier=1&id=' + id + '&directory=' + directory + '&id_user=' + id_user + '&id_company=' + id_company,
		//data : data,
		dataType: 'html',
		success: function (data) {
			$("#modalCloseCashier").modal('open');
			//showAlert('Pesquisa concluída com sucesso!','green',3000);
			$('#closeCashier').html(data);
			validaFormCloseCashier()
		},
		error: function () {
			//showAlert('Não foi possível completar a requisição!','red',3000);
		}
	});




}



// ************* FIM - LISTAR RELATÓRIO PARA FECHAR O CAIXA NO MESMO DIA - BRUNO R. BERNAL - 26/01/2022 *********

// ********************* ABRIR CAIXA - BRUNO R. BERNAL - 26/01/2022 *********************************
function openCashier() {
	var cashierNumber = $("#cashierNumber").val();
	var change_money = $("#change_money").val();
	$.ajax({
		type: 'GET',
		url: '../../MaxComanda/model/PDV/PDV-model.php/?openCashier=1&directory=' + directory + '&cashierNumber=' + cashierNumber + '&change_money=' + change_money + '&id_user=' + id_user + '&id_company=' + id_company,
		//data : data,
		dataType: 'json',
		beforeSend: function () {
			loadShow();
		},
		success: function (response) {
			if (response.codigo == 1) {
				showAlert(response.mensagem, 'green', 3000);
				loadHide();
				$('#modalOpenCashier').modal('close');
				$("#cashier").val(cashierNumber);
				M.updateTextFields();
			} else {
				showAlert('Erro: ' + response.mensagem, 'red', 3000);
				loadHide();
			}
		},
		error: function () {
			showAlert('Não foi possível completar a requisição!', 'red', 3000);
			loadHide();
		}
	});
}
// ********************* FIM - ABRIR CAIXA - BRUNO R. BERNAL - 26/01/2022 *********************************



// ******************** VALIDAR FORMULÁRIO - BRUNO R. BERNAL - 26/01/2022 ****************************

function validaForm() {
	var lockbtn = "";
	var cashierNumber = $("#cashierNumber").val();
	var change_money = $("#change_money").val();

	if (cashierNumber == "") {
		invalidInput('cashierNumber', 'msgCashierNumber', 'Campo Obrigatório!*');
		lockbtn = 1;
	} else {
		validInput('cashierNumber', 'msgCashierNumber', '');
	}

	if (change_money == "") {
		invalidInput('change_money', 'msgChangeMoney', 'Campo Obrigatório!*');
		lockbtn = 1;
	} else {
		validInput('change_money', 'msgChangeMoney', '');
	}



	if (lockbtn == "") {
		$("#btnOpenCashier").attr('disabled', false);
	} else {
		$("#btnOpenCashier").attr('disabled', true);
	}
}

function validaFormCloseCashier() {
	var lockbtnCloseCashier = "";
	var money = $("#totalMoney").val();
	var credit = $("#totalCredit").val();
	var debit = $("#totalDebit").val();
	var PIX = $("#totalPIX").val();
	var compareMoney = $("#compareMoney").val();
	var compareCredit = $("#compareCredit").val();
	var compareDebit = $("#compareDebit").val();
	var comparePIX = $("#comparePIX").val();

	if (credit == "") {
		$("#msgTotalCredit").text('Campo Obrigatório!*');
		$("#msgTotalCredit").css('color', 'red');
		$("#msgTotalCredit").show();
		lockbtnCloseCashier = 1;
	} else {
		if (credit < compareCredit) {
			$("#msgTotalCredit").hide();
		} else if (credit > compareCredit) {
			$("#msgTotalCredit").hide();
		} else if (credit == compareCredit) {
			$("#msgTotalCredit").text('Valor Correto!');
			$("#msgTotalCredit").css('color', 'green');
			$("#msgTotalCredit").show();
		}
	}

	if (debit == "") {
		$("#msgTotalDebit").text('Campo Obrigatório!*');
		$("#msgTotalDebit").css('color', 'red');
		$("#msgTotalDebit").show();
		lockbtnCloseCashier = 1;
	} else {
		if (debit < compareDebit) {
			$("#msgTotalDebit").hide();
		} else if (debit > compareDebit) {
			$("#msgTotalDebit").hide();
		} else if (debit == compareDebit) {
			$("#msgTotalDebit").text('Valor Correto!');
			$("#msgTotalDebit").css('color', 'green');
			$("#msgTotalDebit").show();
		}
	}

	if (PIX == "") {
		$("#msgTotalPIX").text('Campo Obrigatório!*');
		$("#msgTotalPIX").css('color', 'red');
		$("#msgTotalPIX").show();
		lockbtnCloseCashier = 1;
	} else {
		if (PIX < comparePIX) {
			$("#msgTotalPIX").hide();
		} else if (PIX > comparePIX) {
			$("#msgTotalPIX").hide();
		} else if (PIX == comparePIX) {
			$("#msgTotalPIX").text('Valor Correto!');
			$("#msgTotalPIX").css('color', 'green');
			$("#msgTotalPIX").show();
		}
	}

	if (money == "") {
		$("#msgTotalMoney").text('Campo Obrigatório!*');
		$("#msgTotalMoney").css('color', 'red');
		$("#msgTotalMoney").show();
		lockbtnCloseCashier = 1;
	} else {
		if (money < compareMoney) {
			$("#msgTotalMoney").hide();
		} else if (money > compareMoney) {
			$("#msgTotalMoney").hide();
		} else if (money == compareMoney) {
			$("#msgTotalMoney").text('Valor Correto!');
			$("#msgTotalMoney").css('color', 'green');
			$("#msgTotalMoney").show();
		}
	}




	if (lockbtnCloseCashier == "") {
		$("#btnCloseCashier").attr('disabled', false);
	} else {
		$("#btnCloseCashier").attr('disabled', true);
	}
}

function validaFormCPF() {
	var lockbtnCloseOrder = "";
	var cpf_cnpj = $("#cpf_cnpj").val();

	if (cpf_cnpj == "") {
		validInput('cpf_cnpj', 'msgcpf_cnpj', '');
		$("#lcpf_cnpj").text('CPF / CNPJ');
	} else if (cpf_cnpj.length < 14 || (cpf_cnpj.length > 14 && cpf_cnpj.length < 18)) {
		invalidInput('cpf_cnpj', 'msgcpf_cnpj', 'CPF / CNPJ Inválido!*');
		$("#lcpf_cnpj").text('CPF / CNPJ');
		lockbtnCloseOrder = 1;
	} else if (cpf_cnpj.length == 14) {
		if (validarCPF(cpf_cnpj) == false) {
			invalidInput('cpf_cnpj', 'msgcpf_cnpj', 'CPF Inválido!*');
			$("#lcpf_cnpj").text('CPF');
			lockbtnCloseOrder = 1;
		} else {
			validInput('cpf_cnpj', 'msgcpf_cnpj', 'CPF Válido!');
			$("#lcpf_cnpj").text('CPF');
		}
	} else if (cpf_cnpj.length == 18) {
		if (validarCNPJ(cpf_cnpj) == false) {
			invalidInput('cpf_cnpj', 'msgcpf_cnpj', 'CNPJ Inválido!*');
			$("#lcpf_cnpj").text('CNPJ');
			lockbtnCloseOrder = 1;
		} else {
			validInput('cpf_cnpj', 'msgcpf_cnpj', 'CNPJ Válido!');
			$("#lcpf_cnpj").text('CNPJ');
		}
	}

	if (lockbtnCloseOrder == "") {
		$("#btnCloseOrder").attr('disabled', false);
	} else {
		$("#btnCloseOrder").attr('disabled', true);
	}
}

function validaFormModalOpenOrderSheet() {
	var lockbtnOpenOrderSheet = "";
	var orderSheet = $("#orderSheet").val();

	if (orderSheet == "") {
		invalidInput('orderSheet', 'msgOrderSheet', 'Campo Obrigatório!*');
		lockbtn = 1;
	} else {
		validInput('orderSheet', 'msgOrderSheet', '');
	}

	if (lockbtnOpenOrderSheet == "") {
		$("#btnOpenOrderSheet").attr('disabled', false);
	} else {
		$("#btnOpenOrderSheet").attr('disabled', true);
	}
}


function validaFormWithdraw() {
	var lockbtnWithdraw = "";
	var value = $("#value").val();
	var reason = $("#reason").val();

	if (value == "") {
		invalidInput('value', 'msgValue', 'Campo Obrigatório!*');
		lockbtn = 1;
	} else {
		validInput('value', 'msgValue', '');
	}

	if (reason == "") {
		invalidInput('reason', 'msgReason', 'Campo Obrigatório!*');
		lockbtn = 1;
	} else {
		validInput('reason', 'msgReason', '');
	}

	if (lockbtnWithdraw == "") {
		$("#btnWithdraw").attr('disabled', false);
	} else {
		$("#btnWithdraw").attr('disabled', true);
	}
}

// ******************** FIM - VALIDAR FORMULÁRIO - BRUNO R. BERNAL - 26/01/2022 ****************************


// ******************** LISTAR CAIXAS DISPONÍVEIS - BRUNO R. BERNAL - 16/01/2022 *********************
function listAvailableCashier() {

	$.ajax({
		type: 'GET',
		url: '../../MaxComanda/controller/PDV/modal-open-cashier.php/?listAvailableCashier=1&directory=' + directory + '&id_user=' + id_user + '&id_company=' + id_company,
		//data : data,
		dataType: 'html',
		success: function (data) {
			//showAlert('Pesquisa concluída com sucesso!','green',3000);
			$('#openCashier').html(data);

		},
		error: function () {
			//showAlert('Não foi possível completar a requisição!','red',3000);
		}
	});

}



// --- LISTAR CAIXAS DIFERENTES DO ATUAL (PARA TRANSFERIR DINHEIRO) ---

function listAvailableCashierWithdraw() {

	var cashier = $("#cashier").val();

	$.ajax({
		type: 'GET',
		url: '../../MaxComanda/controller/PDV/modal-withdraw.php/?listAvailableCashierWithdraw=1&directory=' + directory + '&cashier=' + cashier + '&id_user=' + id_user + '&id_company=' + id_company,
		//data : data,
		dataType: 'html',
		success: function (data) {
			//showAlert('Pesquisa concluída com sucesso!','green',3000);
			$('#withdraw').html(data);

		},
		error: function () {
			//showAlert('Não foi possível completar a requisição!','red',3000);
		}
	});

}


// ******************** FIM - LISTAR CAIXAS DISPONÍVEIS - BRUNO R. BERNAL - 16/01/2022 *********************


// ****************** FECHAR O CAIXA - BRUNO R. BERNAL - 26/01/2022 **********************************
function closeCashier(idCashier) {
	var id = idCashier;
	var data = $("#formCloseCashier").serialize();


	if (confirm('Deseja realmente fechar o Caixa ?')) {
		$.ajax({
			type: 'POST',
			url: '../../MaxComanda/model/PDV/PDV-model.php/?closeCashier=1&directory=' + directory + '&id=' + id + '&id_user=' + id_user + '&id_company=' + id_company,
			data: data,
			dataType: 'json',
			beforeSend: function () {
				loadShow();
			},
			success: function (response) {
				if (response.codigo == 1) {
					showAlert(response.mensagem, 'green', 3000);
					loadHide();
					window.location.href = http + '/view/?pg=dashboard';
				} else {
					showAlert('Erro: ' + response.mensagem, 'red', 3000);
					loadHide();
				}
			},
			error: function () {
				loadHide();
				showAlert('Não foi possível completar a requisição!', 'red', 3000);
			}
		});

	} else {

		showAlert('O Caixa não foi fechado!', 'green', 3000);

	}




}
// ****************** FIM - FECHAR O CAIXA - BRUNO R. BERNAL - 26/01/2022 **********************************



// ******************* VERIFICAR SE O CAIXA ESTÁ ABERTO - BRUNO R. BERNAL - 26/01/2022 ****************
function verifyCashier() {

	$.ajax({
		type: 'GET',
		url: '../../MaxComanda/model/PDV/PDV-model.php/?verifyCashier=1&directory=' + directory + '&id_user=' + id_user + '&id_company=' + id_company,
		//data : data,
		dataType: 'json',
		success: function (response) {
			if (response.codigo == 1) {
				var id = response.id;
				showAlert(response.mensagem, 'green', 3000);
				$("#modalCloseCashier").modal('open');
				validaFormCloseCashier();


				$.ajax({
					type: 'GET',
					url: '../../MaxComanda/controller/PDV/modal-close-cashier.php/?relatoryCashier=1&id=' + id + '&directory=' + directory + '&id_user=' + id_user + '&id_company=' + id_company,
					//data : data,
					dataType: 'html',
					success: function (data) {
						//showAlert('Pesquisa concluída com sucesso!','green',3000);
						$('#closeCashier').html(data);
					},
					error: function () {
						//showAlert('Não foi possível completar a requisição!','red',3000);
					}
				});

			} else if (response.codigo == 3) {
				var id = response.id;
				showAlert(response.mensagem, 'green', 3000);
				$("#cashier").val(id);
				M.updateTextFields();


			} else if (response.codigo == 2) {
				showAlert(response.mensagem, 'green', 3000);
				$("#modalOpenCashier").modal('open');
				listAvailableCashier();
			}
		},
		error: function () {
			showAlert('Não foi possível completar a requisição!', 'red', 3000);
		}
	});

}
// ******************* FIM - VERIFICAR SE O CAIXA ESTÁ ABERTO - BRUNO R. BERNAL - 26/01/2022 ****************

// ******************* ADICIONAR ITENS AO PDV - BRUNO R. BERNAL - 25/01/2022 **********************************

// --- ADICIONAR TEMPORARIAMENTE PARA ABRIR O MODAL ---
/* function addItemPDVTemp(id) {
	var id = id;
	var cashier_id = $("#cashier").val();
	var orderSheet = $("#orderSheet").val();
	var value = $(".total" + id).val();

	if (orderSheet == undefined) {
		var numberOrderSheet = "";
	} else {
		var numberOrderSheet = orderSheet;
	}


	$.ajax({
		type: 'GET',
		url: '../../MaxComanda/model/PDV/PDV-model.php/?addItemPDVTemp=1&id=' + id + '&directory=' + directory + '&cashierID=' + cashier_id + '&numberOrderSheet=' + numberOrderSheet + '&id_user=' + id_user + '&id_company=' + id_company + '&value=' + value,
		//data : data,
		dataType: 'json',
		beforeSend: function () {
			loadShow();
		},
		success: function (response) {
			if (response.codigo == 1) {
				var order_item_id = response.order_item_id;
				$(".idOrderItem" + id).val(order_item_id);
				//$("#modalAddProduct"+id).modal('open');
				//showAlert(response.mensagem, 'green', 3000);
				loadHide();
			} else {
				showAlert('Erro: ' + response.mensagem, 'red', 3000);
				loadHide();
			}
		},
		error: function () {
			loadHide();
			showAlert('Não foi possível completar a requisição!', 'red', 3000);
		}
	});

}

*/

function addItemPDV(id) {
	var id = id;
	var uniq = $("#uniqID").val();
	var quantity = $(".quantity" + id).val();
	var observation = $(".observation" + id).val();
	var orderSheet = $("#orderSheet").val();
	var total = $(".total" + id).val();
	var fraction = $(".fraction" + id).val();
	var cashier_id = $("#cashier").val();

	if (uniq == undefined) {
		var uniqID = "";
	} else {
		var uniqID = uniq;
	}

	var flavor = new Array();
	$("input[name='flavor" + id + "[]']:checked").each(function () {
		flavor.push($(this).val());
	});
	var addition = new Array();
	$("input[name='addition" + id + "[]']:checked").each(function () {
		addition.push($(this).val());
	});

	if (flavor == "" && fraction > 0) {
		showAlert('Selecione ao menos um sabor!', 'red', 3000);
	} else {




		$.ajax({
			type: 'GET',
			url: '../../MaxComanda/controller/PDV/table-PDV.php/?addItemPDV=1&id=' + id + '&directory=' + directory + '&uniqID=' + uniqID + '&id_user=' + id_user + '&id_company=' + id_company + '&quantity=' + quantity + '&observation=' + observation + '&orderSheet=' + orderSheet + '&total=' + total + '&cashier_id=' + cashier_id + '&flavor=' + flavor + '&addition=' + addition,
			//data : data,
			dataType: 'json',
			beforeSend: function () {
				loadShow();
			},
			success: function (response) {
				if (response.codigo == 1) {
					if (orderSheet != "") {
						showOrderSheet();
					} else {
						var uniqid = response.uniqID;
						listPDV(uniqid);
					}
					showAlert(response.mensagem, 'green', 3000);
					loadHide();
				} else {
					showAlert('Erro: ' + response.mensagem, 'red', 3000);
					loadHide();
				}
			},
			error: function () {
				loadHide();
				showAlert('Não foi possível completar a requisição!', 'red', 3000);
			}
		});

	}


}

// ***************** FIM - ADICIONAR ITENS AO PDV - BRUNO R. BERNAL - 25/01/2022 ********************************

// ********************* LISTAR PRODUTOS POR NOME OU CÓDIGO - BRUNO R. BERNAL - 25/01/2022 **********************
function searchProduct() {
	var name = $("#productName").val();
	$('#cashier').focus();

	$.ajax({
		type: 'GET',
		url: '../../MaxComanda/controller/PDV/table-product.php/?loadProductName=1&name=' + name + '&directory=' + directory + '&id_user=' + id_user + '&id_company=' + id_company,
		//data : data,
		dataType: 'html',
		success: function (data) {
			//showAlert('Pesquisa concluída com sucesso!','green',3000);
			$('#listProduct').html(data);
		},
		error: function () {
			//showAlert('Não foi possível completar a requisição!','red',3000);
		}
	});

}
// ****************** FIM - LISTAR PRODUTOS POR NOME OU CÓDIGO - BRUNO R. BERNAL - 25/01/2022 *********************

// ************************ LISTAR PRODUTOS POR CATEGORIA - BRUNO R. BERNAL - 25/01/2022 *************************
function listProductCategory(id) {
	var id = id;

	$.ajax({
		type: 'GET',
		url: '../../MaxComanda/controller/PDV/table-product.php/?loadProductCategory=1&idCategory=' + id + '&directory=' + directory + '&id_user=' + id_user + '&id_company=' + id_company,
		//data : data,
		dataType: 'html',
		success: function (data) {
			//showAlert('Pesquisa concluída com sucesso!','green',3000);
			$('#listProduct').html(data);
		},
		error: function () {
			//showAlert('Não foi possível completar a requisição!','red',3000);
		}
	});

}
// ******************** FIM - LISTAR PRODUTOS POR CATEGORIA - BRUNO R. BERNAL - 25/01/2022 ***********************

// ********************************* PESQUISAR CATEGORIA - BRUNO R. BERNAL - 25/01/2022 ************************

function loadCategory() {

	$.ajax({
		type: 'GET',
		url: '../../MaxComanda/controller/PDV/list-category.php/?loadCategory=1&directory=' + directory + '&id_user=' + id_user + '&id_company=' + id_company,
		//data : data,
		dataType: 'html',
		success: function (data) {
			//showAlert('Pesquisa concluída com sucesso!','green',3000);
			$('#listCategory').html(data);
		},
		error: function () {
			//showAlert('Não foi possível completar a requisição!','red',3000);
		}
	});

}


// ****************************** FIM - PESQUISAR CATEGORIA - BRUNO R. BERNAL - 25/01/2022 ***********************