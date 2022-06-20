<div class="container" style="padding-top: 20px;">
    <div class="row">

        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center">Listar Vendas</h3>
                </div>
                <div class="card-body">
                    <div class="row">

                        <div class="col-lg-8">
                            <label>Status</label>
                            <select class="form-control" id="status" name="status">
                                <option value="recent">Recentes</option>
                                <option value="archived">Arquivadas</option>
                            </select>
                        </div> <!-- /. col -->

                        <div class="col-lg-4 text-center">
                            </br>
                            <button type="button" class="btn btn-primary" onclick="listOrders()">Pesquisar</button>
                        </div> <!-- /. col -->

                    </div> <!-- /. row -->
                </div> <!-- /. card-body -->
            </div> <!-- /. card -->
        </div> <!-- /. col -->














        <div class="col-lg-12" style="margin-top: 15px">

            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#ID</th>
                        <th scope="col">Status</th>
                        <th scope="col">Valor</th>
                        <th scope="col">Taxa - ML</th>
                        <th scope="col">A Receber</th>
                        <th scope="col">Data da venda</th>
                        <th scope="col">+Detalhes</th>
                    </tr>
                </thead>
                <tbody id="listOrders">

                </tbody>
            </table>

        </div> <!-- /. col -->
    </div> <!-- /. row -->
</div> <!-- /. container -->