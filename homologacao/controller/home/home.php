<?php
if(!isset($_SESSION)){
	session_start();
}
?>
<section class="home">
    <div class="home-container">
        <div class="flexbox">
            <div class="home-title home-box w100">
                <h2>Olá <b><?php echo $_SESSION[ 'name_user' ];?></b>, Seja Bem vindo(a)!</h2>
            </div><!--home-title-->
            <div class="home-categories home-box w100">
                <a href="?pg=listar-caixas" class="home-categorie-single">PDV</a>
                <a href="?pg=listar-categorias" class="home-categorie-single">Pedido - Mesa</a>
                <a href="?pg=listar-clientes" class="home-categorie-single">Pedido - Balcão</a>
                <a href="?pg=listar-comandas" class="home-categorie-single">Cadastro de Produtos</a>
                <a href="?pg=listar-empresas" class="home-categorie-single">Pedidos - Cozinha</a>
                
            </div><!--categories-->
        </div><!--flexbox-->
    </div><!--home-container-->
</section><!--home-->