function sendAnswer(question_id) {
    var answer_text = $("#question-" + question_id).val();
    var url = "functions.php";
    $.ajax({
        method: "POST",
        url: url,
        async: false,
        cache: false,
        data: {
            "action": "sendanswer",
            "question_id": question_id,
            "text": answer_text
        },
        success: function (data) {
            if (data.indexOf("Erro") > -1) {
                console.log(data);
                alert("Erro ao enviar resposta: Verifique os detalhes do erro no console do navegador em modo desenvolvedor(F12)");
            } else {
                console.log(data);
                alert("Resposta enviada com Sucesso!");
                location.reload();
            }
        },
        error: function (data) {
            alert("Erro, verifique os detalhes no console do navegador em modo desenvolvedor(F12)");
            console.log(data);
            return false;
        }
    });
}


// ****************************** LISTAR PERGUNTAS - BRUNO R. BERNAL - 10/06/2022 *********************************
function listQuestions() {
    var status = $("#status").val();

    var url = "controller/questions/card-questions.php";
    $.ajax({
        method: "POST",
        url: url,
        dataType: 'html',
        data: {
            "status": status
        },
        beforeSend: function(){
            $("#listQuestions").html('<h4 class="text-center">Realizando Consulta...</h4>');
            $("#listQuestions").css("opacity",0.3);
         },
        success: function(resposta) {
            $("#listQuestions").html(resposta);
            $("#listQuestions").css("opacity",1);



        },
        error: function() {
            $("#listQuestions").html("");
            $("#listQuestions").css("opacity",1);
        }
    });
}