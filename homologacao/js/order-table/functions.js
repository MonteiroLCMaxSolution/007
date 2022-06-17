var conectado = $("#conect").val();

function valid_btnIncludeProduct(){
	var order_sheet = $("#order-sheet").val();
	var id_produto = $("#id_produto").val();
	var liberar = '';
	if(order_sheet == ''){
		liberar = 1;
	}
	if(id_produto ==''){
		liberar = 1;
	}
	if(liberar == 1){
		$("#btnIncludeProduct").hide();
	}else{
		$("#btnIncludeProduct").show();
	}
}


function verifica(){
	var flovers = new Array();
	$("input[name='checks[]']:checked").each(function ()
	{
	   flovers.push( $(this).val());	
	});
	
	var complement = new Array();
	$("input[name='checksCom[]']:checked").each(function ()
	{
	   complement.push( $(this).val());	
	});
};

function checkFlower(str){
	var selected_flover = $("#selected_flover").val();
	var fraction = $("#fraction").text();
	
	if($('#'+str).is(":checked")) {
		selected_flover = parseInt(selected_flover) + 1;
		if(fraction >= selected_flover){
			$("#selected_flover").val(selected_flover);
		}else{
			$('#'+str).prop('checked', false);
		}  
      } else {
		  selected_flover = parseInt(selected_flover) - 1;
		  $("#selected_flover").val(selected_flover);
      }
}
function dataProduct(){
	var id_product = $(".product").val();
	var uniqid = $("#uniqid").val();
  	var conect = $("#conect").val();
  	formData = new FormData();
	formData.append('uniqid', uniqid);
  	formData.append('id_product', id_product);
  	formData.append('conect', conect);
  $.ajax({

    url: '../../MaxComanda/controller/order-table/modal_data_product.php/?dataProducts=1',
    type: 'POST',
    data: formData,
    contentType: false,
    processData: false,
    dataType: 'html',
    success: function (data) {
      $("#dataProductTemp").html(data);
    },
    error: function () {
      showAlert('Não foi possivel completar a requisição!', 'red', 3000);
      loadHide();
      $("#btnSaveCompany").attr('disabled', false);
    }
  });
	
}

function minStock() {

  var qtdeProduct = $(".product").val();
  var quantity = $("#quantity").val();
  qtdeProduct = qtdeProduct.split('|');
  if (parseFloat(qtdeProduct[1]) != 0) {
    if (parseFloat(qtdeProduct[1]) >= parseFloat(quantity)) {
    } else {
      $("#quantity").val('');
    }
  }
}
/* Incluir produto temporariamente antes de fechar o produto - Leônidas Monteiro - 30/01/2022 */
function include_temp() {
	var liberar = '';
  var table = $("#table").val();
  var uniqid = $("#uniqid").val();
  var waiter = $("#waiter").val();
  var id_product = $(".product").val();
  var quantity = $("#quantity").val();
  var order_sheet = $("#order-sheet").val();
  var observation = $("#observation").val();
  var flovers = new Array();
	$("input[name='checks[]']:checked").each(function ()
	{
	   flovers.push( $(this).val());	
	});
	var complement = new Array();
	$("input[name='checksCom[]']:checked").each(function ()
	{
	   complement.push( $(this).val());	
	});
	
	
  waiter = waiter.split('/');
  waiter = waiter[0];

  id_product = id_product.split('|');
  id_product = id_product[0];
	
		if(parseInt($('#selected_flover').val()) == 0){
			showAlert('Erro: ' + 'selecione o sabor!', 'red', 3000);
			liberar = 1;
		}
		if(quantity == ''){
			
			showAlert('Erro: ' + 'Informe a quantidade!', 'red', 3000);
			liberar = 1;
		}
		if(order_sheet == ''){
			
			showAlert('Erro: ' + 'Informe o número da comanda!', 'red', 3000);
			liberar = 1;
		}
	if(liberar == ''){
		formData = new FormData();
  formData.append('uniqid', uniqid);
  formData.append('conect', conectado);
  formData.append('table', table);
  formData.append('waiter', waiter);
  formData.append('id_product', id_product);
  formData.append('quantity', quantity);
  formData.append('order_sheet', order_sheet);
  formData.append('observation', observation);
  formData.append('flovers', flovers);
  formData.append('complement', complement);

  //alert(table + ',' + uniqid + ',' + waiter + ',' + id_product + ',' + quantity + ',' + order_sheet + ',' + observation);

  if (table == '' || uniqid == '' || waiter == '' || id_product == '' || order_sheet == '' || quantity == '') {
	  showAlert('Erro: ' + 'Confira os campos informados!', 'red', 3000);
  } else {
    $.ajax({
      url: "../../MaxComanda/model/order-table/order-table-model.php/?include_temp=1", //&table="+table+"&uniqid="+uniqid+"&waiter="+waiter+"&id_product="+id_product+"&quantity="+quantity+"&order_sheet="+order_sheet+"&observation="+observation,
      type: 'POST',
      data: formData,
      contentType: false,
      processData: false,
      dataType: 'json',
      beforeSend: function () {
        $("#btn_salve").attr('disabled', true);
        loadShow();
      },
      success: function (response) {
        if (response.codigo == 1) {
          showAlert(response.message, 'green', 3000);
          $(".produto").val('');
			$('#id_produto').val('').select2('');
          $("#quantity").val('');
          //$("#order-sheet").val('');
          $("#observation").val('');
		$("#btnIncludeProduct").hide();
          loadHide();
          // window.location.href = http + '/view/?pg=company';
        } else {

          showAlert('Erro: ' + response.message, 'red', 3000);
          loadHide();
          $("#btnSaveCompany").attr('disabled', false);

        }
      },
      error: function () {
        showAlert('Não foi possivel completar a requisição!', 'red', 3000);
        $("#btnSaveCompany").attr('disabled', false);
        loadHide();
      }
    });
  }
	}
	
	
/*

  */

}
/* .Incluir produto temporariamente antes de fechar o produto */
// LISTAR OS PRODUTOS DO PEDITO TEMP - LEÔNIDAS MONTEIRO - 31/01/2022
function listProduct(str) {
  var uniqid = str;
  var conect = $("#conect").val();
  formData = new FormData();

  formData.append('uniqid', str);
  formData.append('conect', conect);
  $.ajax({

    url: '../../MaxComanda/controller/order-table/modal_table_list.php/?listProducts=1',
    type: 'POST',
    data: formData,
    contentType: false,
    processData: false,
    dataType: 'html',
    success: function (data) {
      $("#listProductTemp").html(data);
    },
    error: function () {
      showAlert('Não foi possivel completar a requisição!', 'red', 3000);
      loadHide();
      $("#btnSaveCompany").attr('disabled', false);
    }
  });
}

// .LISTAR OS PRODUTOS DO PEDIDO TEMPO 
// EXCLUIR PRODUTO TEMPORARIO - LEÔNIDAS MONTEIRO - 01/02/2022
function delProductTem(str) {
  var uniqid = $("#uniqid").val();
  $.ajax({
    url: "../../MaxComanda/model/order-table/order-table-model.php/?delProductTem=1&temp=" + str,
    type: 'GET',
    dataType: 'json',
    success: function (data) {
      showAlert(data.message, 'green', 5000);
      listProduct(uniqid);
    },
    error: function () {
      showAlert('Não foi possivel completar a requisição!', 'red', 5000);
    }

  })
}

// .EXCLUIR PRODUTO TEMPORARIO
// GRAVAR REALIZAR O PEDIDO DA MESA - LEÔNIDAS MONTEIRO - 01/02/2022
function btnSaveProduct() {
  var uniqid = $("#uniqid").val();
  var conect = $("#conect").val();
  var table = $("#table").val();
  formData = new FormData();
  formData.append('uniqid', uniqid);
  formData.append('conect', conect);
  formData.append('table', table);
  formData.append('people', $("#people").val());
  $.ajax({

    url: '../../MaxComanda/model/order-table/order-table-model.php/?btnSaveProduct=1',
    type: 'POST',
    data: formData,
    contentType: false,
    processData: false,
    dataType: 'html',
    success: function (data) {
      list_ordem_items(uniqid);
    },
    error: function () {
      showAlert('Não foi possivel completar a requisição!', 'red', 3000);
      loadHide();
      $("#btnSaveCompany").attr('disabled', false);
    }
  });
}

// .GRAVAR REALIZAR O PEDIDO DA MESA
// LISTAR PEDIDOS DA MESA - LEÔNIDAS MONTEIRO - 01/02/2022
function list_ordem_items(uniqid) {
  var conect = $("#conect").val();
	formData = new FormData();
	
	formData.append('uniqid',uniqid);
	formData.append('conect',conect);
	$.ajax({

       url: '../../MaxComanda/controller/order-table/modal_table_list_order.php/?list_ordem_items=1',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        dataType: 'html',
        success: function (data) {
			$("#list_order_items").html(data);
        },
        error: function () {
            showAlert('Não foi possivel completar a requisição!', 'red', 3000);
            loadHide();
            $("#btnSaveCompany").attr('disabled', false);
        }
    });	
}
// .LISTAR PEDIDOS DA MESA - 
