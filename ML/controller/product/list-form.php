<div class="container" style="padding-top: 20px;">
    <div class="row">

        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center">Listar Anúncios</h3>
                </div>
                <div class="card-body">
                    <div class="row">

                        <div class="col-lg-4">
                            <label>Nome</label>
                            <input type="text" class="form-control" id="name">
                        </div> <!-- /. col -->

                        <div class="col-lg-4">
                            <label>Status</label>
                            <select class="form-control" id="status">
                                <option value="">Todos</option>
                                <option value="active">Ativo</option>
                                <option value="inactive">Inativo</option>
                                <option value="paused">Pausado</option>
                                <option value="closed">Fechado</option>
                            </select>
                        </div> <!-- /. col -->

                        <div class="col-lg-2">
                            <label>Itens por Página</label>
                            <select class="form-control" id="itensPorPagina">
                                <option value="15">15</option>
                                <option value="30">30</option>
                                <option value="45">45</option>
                                <option value="60">60</option>

                            </select>
                        </div> <!-- /. col -->

                        <div class="col-lg-2 text-center">
                            </br>
                            <button type="button" class="btn btn-primary" onclick="listProducts()">Pesquisar</button>
                        </div> <!-- /. col -->

                    </div> <!-- /. row -->
                </div> <!-- /. card-body -->
            </div> <!-- /. card -->
        </div> <!-- /. col -->

        <div class="col-lg-12" style="margin-top: 15px" id="listProducts">



        </div> <!-- /. col -->
    </div> <!-- /. row -->
</div> <!-- /. container -->