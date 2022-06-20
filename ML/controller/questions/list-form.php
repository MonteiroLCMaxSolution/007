<div class="container" style="padding-top: 20px;">
    <div class="row">

        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center">Listar Perguntas</h3>
                </div>
                <div class="card-body">
                    <div class="row">

                        <div class="col-lg-8">
                            <label>Status</label>
                            <select class="form-control" id="status" name="status">
                                <option value="UNANSWERED">Não Respondidas</option>
                                <option value="ANSWERED">Respondidas</option>
                            </select>
                        </div> <!-- /. col -->

                        <div class="col-lg-4 text-center">
                            </br>
                            <button type="button" class="btn btn-primary" onclick="listQuestions()">Pesquisar</button>
                        </div> <!-- /. col -->

                    </div> <!-- /. row -->
                </div> <!-- /. card-body -->
            </div> <!-- /. card -->
        </div> <!-- /. col -->

        <div class="col-lg-12" style="margin-top: 15px" id="listQuestions">



        </div> <!-- /. col -->
    </div> <!-- /. row -->
</div> <!-- /. container -->