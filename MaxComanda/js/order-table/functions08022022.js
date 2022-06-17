function minStock() {

  var qtdeProduct = $(".product").val();
  var quantity = $("#quantity").val();
  qtdeProduct = qtdeProduct.split('|');
  if (parseFloat(qtdeProduct[1]) != 0) {
    if (parseFloat(qtdeProduct[1]) >= parseFloat(quantity)) {
      //alert('maior');
    } else {
      $("#quantity").val('');
    }
  }
}
/* Incluir produto temporariamente antes de fechar o produto - Leônidas Monteiro - 30/01/2022 */
function include_temp() {
  var table = $("#table").val();
  var uniqid = $("#uniqid").val();
  var waiter = $("#waiter").val();
  var id_product = $(".product").val();
  var quantity = $("#quantity").val();
  var order_sheet = $("#order-sheet").val();
  var observation = $("#observation").val();
  waiter = waiter.split('/');
  waiter = waiter[0];

  id_product = id_product.split('|');
  id_product = id_product[0];

  alert(table + ',' + uniqid + ',' + waiter + ',' + id_product + ',' + quantity + ',' + order_sheet + ',' + observation);

  if (table == '' || uniqid == '' || waiter == '' || id_product == '' || order_sheet == '' || quantity == '') {
    alert('Confira os campos informados');
  } else {
    $.ajax({
        url: "https://maxcomanda.com.br/MaxComanda/model/order-table/order-table-model.php/?include_temp=1&table=" + table + "&uniqid=" + uniqid + "&waiter=" + waiter + "&id_product=" + id_product + "&quantity=" + quantity + "&order_sheet=" + order_sheet + "&observation=" + observation,
        type: 'GET',
        dataType: 'html',
        beforeSend: function () {
          $("#btn_salve").attr('disabled', true);
          loadShow();
        },
        success: function (response) {
          showAlert('Produto inserido com sucesso!', 'green', 3000);
          $(".produto").val('');
          $("#quantity").val('');
          $("#order-sheet").val('');
          $("#observation").val('');
          $("#btn_salve").attr('disabled', false);
          loadHide();
		}
       });
  

  }
  /*if (response.codigo == 1) {
                showAlert(response.message, 'green', 3000);
				$(".produto").val('');
				$("#quantity").val('');
				$("#order-sheet").val('');
				$("#observation").val('');
				$("#btn_salve").attr('disabled', false);
			
			
			
                loadHide();
               // window.location.href = http + '/view/?pg=company';
            } else {
               if(response.codigo == 0){
				    showAlert('Erro: ' + response.message, 'red', 3000);
                	loadHide();
				   $("#btnSaveCompany").attr('disabled', false);
			   }//else{
				    //showAlert('Erro: ' + response.mensagem, 'red', 3000);
                //window.location.href = '../';
			  // }
            }
      },
     /*error: function () {
        showAlert('Não foi possivel completar a requisição!', 'red', 3000);
        $("#btnSaveCompany").attr('disabled', false);
        loadHide();
      }
    });*/
  //}

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
      alert(data);
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
  formData.append('uniqid', uniqid);
  formData.append('conect', conect);
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
