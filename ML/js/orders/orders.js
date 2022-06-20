function listOrders() {
    var status = $("#status").val();

    var url = "controller/orders/tableOrders.php";
    $.ajax({
        method: "POST",
        url: url,
        dataType: 'html',
        data: {
            "status": status
        },
        success: function(resposta) {
            $("#listOrders").html(resposta);



        },
        error: function() {
            $("#listOrders").html("");
        }
    });
}