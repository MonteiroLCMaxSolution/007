var retorno = "";

function getSuggestion() {
    var title = $("#title").val();
    var url = "functions.php";
    $.ajax({
        method: "POST",
        url: url,
        async: false,
        cache: false,
        dataType: 'json',
        data: {
            "action": "getsuggestion",
            "title": title
        },
        success: function(response) {
            if (response.codigo == 1) {
                var category_id = response.category_id;
                var category_name = response.category_name;
                alert(response.mensagem);
                document.getElementById("code").value = category_id;
                document.getElementById("description").value = category_name;
            } else {
                alert(response.mensagem);
                console-log(response.erro);
                document.getElementById("code").value = "";
                document.getElementById("description").value = "";
            }

        },
        error: function() {
            alert("Erro, verifique os detalhes no console do navegador em modo desenvolvedor(F12)");
            document.getElementById("code").value = "";
            document.getElementById("description").value = "";
            return false;
        }
    });
}