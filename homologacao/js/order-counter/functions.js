var http = $("#http").val();
var directory = $("#directory").val();
var id_user = $("#id_user").val();
var id_company = $("#id_company").val();

// ************************** ENTREGAR PEDIDO NO BALCÃO - BRUNO R. BERNAL - 31/01/2022 *************************
function deliverOrder(id){
    var id = id;

	if (confirm('Deseja realmente entregar o item?')) {

    $.ajax({
		type : 'GET',
		url  : '../../MaxComanda/model/order-counter/order-counter-model.php/?deliverOrder=1&directory='+directory+'&id='+id+'&id_user='+id_user+'&id_company='+id_company,
			//data : data,
			dataType: 'html',
			success :  function(data){
                showAlert('Item Entregue com sucesso!','green',3000);
				window.location.href = http + '/view/?pg=order-counter';				
			},error: function(){
                showAlert('Não foi possível completar a requisição!','red',3000);
			}	
		});


	} else {

    }

}
// *********************** FIM - ENTREGAR PEDIDO NO BALCÃO - BRUNO R. BERNAL - 31/01/2022 ************************