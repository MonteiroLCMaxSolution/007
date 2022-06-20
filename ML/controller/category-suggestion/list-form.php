<div class="container" style="padding-top: 20px;">
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
            <div class="card" style="margin-top: 10px;">
                <h5 class="card-header">Sugestão de categorias</h5>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8 col-sm-12 col-xs-12">
                            <input type="text" class="form-control" placeholder="Informe um título detalhado" id="title">
                        </div>
                        <div class="col-md-4 col-sm-12 col-xs-12">
                            <button class="btn btn-primary" onclick="getSuggestion();">Buscar sugestão</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
            <div class="card" style="margin-top: 10px;" id="card-response">
                <div class="card-body" id="suggestions">
                    <div class="row">

                        <div class="input-group mb-4">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Código</span>
                            </div>
                            <input type="text" id="code" class="form-control" aria-label="Default" readonly>
                        </div>

                        <div class="input-group mb-8">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Descrição</span>
                            </div>
                            <input type="text" id="description" class="form-control" aria-label="Default" readonly>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>