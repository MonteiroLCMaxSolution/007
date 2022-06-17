var http = $("#http").val();
var directory = $("#directory").val();
var id_user = $("#id_user").val();
var id_company = $("#id_company").val();

// **************************** FINALIZAR PEDIDO - BRUNO R. BERNAL - 31/01/2022 ***************************
function finishOrder(id){
    var id = id;
	
	if (confirm('Deseja realmente entregar o item?')) {

    $.ajax({
		type : 'GET',
		url  : '../../MaxComanda/model/order-kitchen/order-kitchen-model.php/?finishOrder=1&directory='+directory+'&id='+id+'&id_user='+id_user+'&id_company='+id_company,
			//data : data,
			dataType: 'html',
			success :  function(data){
                showAlert('Item Finalizado com sucesso!','green',3000);
				window.location.href = http + '/view/?pg=order-kitchen';				
			},error: function(){
                showAlert('Não foi possível finalizar o Item!','red',3000);
			}	
		});

	} else {

    }

}
// **************************** FIM - FINALIZAR PEDIDO - BRUNO R. BERNAL - 31/01/2022 ***************************