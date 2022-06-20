$('.money').mask('#.##0,00', {
    reverse: true
});

function confirmPreco() {
    var result = $("#result").html();
    $("#price").val(result);
    validaForm();

}

function compPreco() {

    var tipo_lucro = $("#tipo_lucro").val();

    var lucro = $("#lucro").val() != "" ? parseFloat($("#lucro").val().replace('.', '').replace(',', '.')) : 0;

    var custo = $("#custo").val() != "" ? parseFloat($("#custo").val().replace('.', '').replace(',', '.')) : 0;

    var custo_embalagem = $("#custo_embalagem").val() != "" ? parseFloat($("#custo_embalagem").val().replace('.', '').replace(',', '.')) : 0;

    var outros_custos = $("#outros_custos").val() != "" ? parseFloat($("#outros_custos").val().replace('.', '').replace(',', '.')) : 0;

    var taxa_marketplace = $("#taxa_marketplace").val() != "" ? parseFloat($("#taxa_marketplace").val().replace('.', '').replace(',', '.')) : 0;

    var taxa_impostos = $("#taxa_impostos").val() != "" ? parseFloat($("#taxa_impostos").val().replace('.', '').replace(',', '.')) : 0;

    var outras_taxas = $("#outras_taxas").val() != "" ? parseFloat($("#outras_taxas").val().replace('.', '').replace(',', '.')) : 0;

    if (tipo_lucro == "porcentagem") {

        // CARCULAR LUCRO COM BASE NO CUSTO
        var val_lucro = lucro == 0 ? 0 : custo * (lucro / 100);

        // CALCULAR IMPOSTOS SOBRE O CUSTO DO PRODUTO
        var impostos = taxa_impostos == 0 ? 0 : custo * (taxa_impostos / 100);

        // CALCULAR OUTRAS TAXAS SOBRE O CUSTO DO PRODUTO
        var val_outras_taxas = outras_taxas == 0 ? 0 : custo * (outras_taxas / 100);

        // DEFINIR VALOR MÍNIMO PARA RECEBER DO MARKET PLACE
        var value = custo + impostos + val_outras_taxas + custo_embalagem + outros_custos + val_lucro;

        // APLICAR PORCENTAGEM DO MARKETPLACE DE FORMA A RECEBER O VALOR DOS CUSTOS + O VALOR INFORMADO NO LUCRO DESEJADO
        var result = value / (100 - taxa_marketplace) * 100;


    } else {

        // CALCULAR IMPOSTOS SOBRE O CUSTO DO PRODUTO
        var impostos = taxa_impostos == 0 ? 0 : custo * (taxa_impostos / 100);

        // CALCULAR OUTRAS TAXAS SOBRE O CUSTO DO PRODUTO
        var val_outras_taxas = outras_taxas == 0 ? 0 : custo * (outras_taxas / 100);

        // DEFINIR VALOR MÍNIMO PARA RECEBER DO MARKET PLACE
        var value = custo + impostos + val_outras_taxas + custo_embalagem + outros_custos + lucro;

        // APLICAR PORCENTAGEM DO MARKETPLACE DE FORMA A RECEBER O VALOR DOS CUSTOS + O VALOR INFORMADO NO LUCRO DESEJADO
        var result = value / (100 - taxa_marketplace) * 100;



    }


    var result = result.toLocaleString("pt-BR", {
        // Ajustando casas decimais
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
    });

    $("#result").html(result);


}

function validaForm() {
    var isValid = true;
    $(".required").each(function () {

        var element = $(this);
        var id = element.attr('id');
        if (element.val() == "") {
            isValid = false;
            $('label[for="' + id + '"]').css('color', 'red');
            $(this).css("border", "1px solid red");
        } else {
            $('label[for="' + id + '"]').css('color', 'black');
            $(this).css("border", "1px solid #ced4da");
        }

    }); // each Function

    var price = $("#price").val().replace('.', '').replace(',', '.');
    if (price < 10.00) {
        isValid = false;
        $('label[for="price"]').css('color', 'red');
        $("#price").css("border", "1px solid red");
        $('label[for="price"]').text("Preço: (Mínimo R$10,00)*")
    } else {
        $('label[for="price"]').css('color', 'black');
        $("#price").css("border", "1px solid #ced4da");
        $('label[for="price"]').text("Preço")
    }

    if (isValid == false) {
        $("#addprod").attr('disabled', true);
    } else {
        $("#addprod").attr('disabled', false);
    }
}


function getFormCategory() {
    var category = $("#category_id").val();

    $.ajax({

        url: 'controller/product/formCategory.php/?getFormCategory=1',
        type: 'POST',
        data: 'category=' + category,
        dataType: 'html',
        success: function (data) {
            $("#formCategory").html(data);
            validaForm();
        },
        error: function () {
            alert('Não foi possivel buscar informações sobre a Categoria!');
        }
    });

}

$(document).ready(function () {
    $("#addprod").on('click', function () {
        formData = new FormData();


        $(".formCategory").each(function () {

            var element = $(this);
            var id = element.attr('id');
            var val = element.val();

            formData.append(id, val);

        }); // each Function
        formData.append("action", "addprodduct");

        var url = "functions.php";
        $.ajax({
            method: "POST",
            url: url,
            contentType: false,
            processData: false,
            dataType: 'json',
            data: formData,
            success: function (response) {
                if (response.codigo == 1) {
                    alert(response.mensagem);
                    console.log(response.log);
                    window.location.href = "home.php?pg=list-products";

                } else {

                    //console.log(response.erro);
                    alert(response.mensagem);

                    for (i = 0; i < response.erro.body.cause.length; i++) {
                        if (response.erro.body.cause[i].type == "error") {
                            console.log("Erro: " + response.erro.body.cause[i].message);
                            alert("Mensagem de Erro: " + response.erro.body.cause[i].message);
                        }
                    }

                    

                }
            },
            error: function () {
                alert("Erro, verifique os detalhes do erro no console do navegador em modo desenvolvedor(F12)");
                return false;
            }
        });
    });
})


function getSuggestion() {
    var title = $("#title").val();
    var url = "controller/product/selectCategory.php?suggestCategory=1";
    $.ajax({
        method: "POST",
        url: url,
        dataType: 'html',
        data: {
            "title": title
        },
        success: function (response) {
            $("#selectCategory").html(response);
            validaForm();
            getFormCategory();


        },
        error: function () {
            $("#selectCategory").html("");
        }
    });
}

// ****************************** LISTAR ANÚNCIOS - BRUNO R. BERNAL - 10/06/2022 *********************************
function listProducts(newOffset = null) {
    var name = $("#name").val();
    var status = $("#status").val();
    var itensPorPagina = $("#itensPorPagina").val();

    // Paginação
    if (newOffset != null) {
        newOffset = newOffset;
    } else {
        newOffset = 0;
    }

    var url = "controller/product/card-products.php?searchProduct=1&offset=" + newOffset;
    $.ajax({
        method: "POST",
        url: url,
        dataType: 'html',
        data: {
            "name": name,
            "status": status,
            "itensPorPagina": itensPorPagina
        },
        beforeSend: function () {
            $("#listProducts").html('<h4 class="text-center">Realizando Consulta...</h4>');
            $("#listProducts").css("opacity", 0.3);
        },
        success: function (resposta) {
            $("#listProducts").html(resposta);
            $("#listProducts").css("opacity", 1);



        },
        error: function () {
            $("#listProducts").html("");
            $("#listProducts").css("opacity", 1);
        }
    });
}
// *************************** FIM - LISTAR ANÚNCIOS - BRUNO R. BERNAL - 10/06/2022 ********************************

// ****************************** LISTAR INFRAÇÕES DO ANÚNCIO - BRUNO R. BERNAL - 20/06/2022 *********************************
function listInfractions(id_anuncio) {




    var url = "controller/product/modal-infractions.php?searchInfractions=1";
    $.ajax({
        method: "POST",
        url: url,
        dataType: 'html',
        data: {
            "id_anuncio": id_anuncio,
        },
        beforeSend: function () {
            $("#modal-content").html('');
        },
        success: function (resposta) {
            $("#modal-content").html(resposta);
        },
        error: function () {
            $("#modal-content").html("");
        }
    });
}
// ********************* FIM - LISTAR INFRAÇÕES DO ANÚNCIO - BRUNO R. BERNAL - 20/06/2022 ********************************

