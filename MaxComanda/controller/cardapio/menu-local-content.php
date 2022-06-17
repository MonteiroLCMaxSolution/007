<?php

$MenuModel = $_SERVER['DOCUMENT_ROOT'] . '/MaxComanda/model/menu/menu-model.php';
include_once($MenuModel);

ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);


?>

<script>
  $('.pushpin').each(function() {
    var $this = $(this);
    var $target = $('#' + $(this).attr('data-target'));
    $this.pushpin({
      top: $target.offset().top - 100
    });
  });

  $(document).ready(function() {
    $('.tooltipped').tooltip({
      inDuration: 350,
      position: 'left'
    });
  });

  $(window).scroll(function() {
    var scroll = $(window).scrollTop();
    if (scroll <= 500) {
      $("#btnTop").hide();
    } else {
      $("#btnTop").show();
    }
  });
</script>

<style>
  .info {
    margin-top: 64px
  }

  section {
    margin-bottom: 0
  }
</style>

<div id="header" class="block section scrollspy">
  <nav class="pushpin" data-target="header" style="background-color: <?php echo $color_header; ?>; padding-bottom: 10px">
    <div class="nav-wrapper">
      <div class="container">
        <a href="#" class="brand-logo center">
          <?php if (!empty($logo)) { ?>
            <img src="<?php echo $imgFolder; ?>/logo/<?php echo $logo; ?>" width="130px" height="68px">
          <?php } else { ?>
            <img src="../../../MaxComanda/uploads/logo/logo-header.png" width="130px">
          <?php } ?>
        </a>
      </div>
    </div>
  </nav>
  <section class="info">
    <h4 class="center">Bem-vindo(a)!</h4>
    <h5 class="center">Escolha uma Categoria ou veja todas as nossas ofertas abaixo!</h5>

    <div class="row">
      <?php
      $paramListCategory = 0;
      while ($paramListCategory < $numberCategory) { ?>
        <div class="col s12 m4 l3 center">
          <a class="waves-effect waves-light btn-large <?php echo $categoryColor[$paramListCategory]; ?>" style="margin: 3px; width: 100%" href="#<?php echo $categoryID[$paramListCategory]; ?>"><?php echo $categoryName[$paramListCategory]; ?></a>
        </div>

      <?php $paramListCategory++;
      } ?>


    </div> <!-- /.row -->

  </section>
</div>


<div id="promotion" class="block amber lighten-1">
  <nav class="pushpin" data-target="promotion">
    <div class="nav-wrapper amber darken-4">
      <div class="container center">
        <a href="#" style="font-size:35px">Promoções</a>
      </div>
    </div>
  </nav>
  <section>

  </section>
</div>



<?php
$paramCategory = 0;
while ($paramCategory < $numberCategory) {
  $color = explode(' ', $categoryColor[$paramCategory]);
  $nameCategory = $categoryName[$paramCategory];
  $colorCategory = $categoryColor[$paramCategory];
  $idCategory = $categoryID[$paramCategory];
?>

  <div id="<?php echo $idCategory; ?>" class="block <?php echo $color[0]; ?> lighten-1 section scrollspy">
    <nav class="pushpin" data-target="<?php echo $idCategory; ?>">
      <div class="nav-wrapper <?php echo $colorCategory; ?>">
        <div class="container center">
          <a href="#" style="font-size:35px"><?php echo $nameCategory; ?></a>
        </div>
      </div>
    </nav>
    <section>
      <?php
      $sqlListSubcategory = "SELECT id, name FROM subcategory WHERE category_id = :id";
      $sqlListSubcategory = $pdo->prepare($sqlListSubcategory);
      $sqlListSubcategory->bindValue('id', $idCategory);
      $sqlListSubcategory->execute();

      while ($listSubcategory = $sqlListSubcategory->fetch()) {
        $subcategoryName = $listSubcategory->name;
        $subcategoryID = $listSubcategory->id;
      ?>


        <div class="row">
          <div class=" col s12 m12 l12">
            <h5 class="center" style="font-size:25px"><b><i class="material-icons">label_important</i> <?php echo $subcategoryName; ?></b></h5>
          </div>

          <?php

          // --- LISTAR PRODUTOS ---
          $sqlListProduct = "SELECT a.id, a.name AS product_name, a.sale_value, a.defineStock, i.new_value AS value_promotion, a.fraction,

	IFNULL((SELECT h.img FROM product_img h
	
	WHERE h.id_product = a.id AND h.main_img = 'S'),'no_img') AS image, 
	
	(
		(SELECT IFNULL((SELECT SUM(e.quantity) FROM stock_adjustment e 
		WHERE e.uniqID = a.uniqID
		AND e.TYPE = 'Entrada'),0) AS 'Entradas')
		-
		(SELECT IFNULL((SELECT SUM(g.quantity) FROM stock_adjustment g 
		WHERE g.uniqID = a.uniqID
		AND g.TYPE = 'Saída'),0) AS 'Saídas')
		-
		(SELECT IFNULL((SELECT SUM(f.quantity) FROM order_items f 
		WHERE f.product_id = a.id ),0) AS 'Pedidos')
		
	) AS 'stock' 
	
	
	FROM product a
	
	LEFT JOIN promotion i ON i.product_id = a.id AND CAST(NOW() AS DATE) BETWEEN i.start_date AND i.end_date AND i.status = 'Ativo'
	
	WHERE a.subcategory_id = $subcategoryID 
	AND a.company_id = $idCompany
	AND a.status = 'Ativo' ";
          $sqlListProduct = $pdo->prepare($sqlListProduct);
          $sqlListProduct->execute();

          while ($listProduct = $sqlListProduct->fetch()) {
            $productID = $listProduct->id;
            $productName = $listProduct->product_name;
            $defineStock = $listProduct->defineStock;
            $fraction = $listProduct->fraction;
            $productImage = $listProduct->image;
            $stock = $listProduct->stock;

            if ($listProduct->value_promotion == "") {
              $productValue = 'R$' . number_format($listProduct->sale_value, 2, ',', '');
            } else {
              $productValue = 'R$' . number_format($listProduct->value_promotion, 2, ',', '');
            }

            if ($defineStock == 'S' && $stock < 1) {
              continue;
            } else if(($defineStock == 'N') || ($defineStock == 'S' && $stock > 0)) {



          ?>

              <div class="col s12 m6 l6">
                <div class="card hoverable" style="border-top: 3px solid <?php echo $color_header; ?>; height: 230px">
                  <div class="card-content">
                    <div class="row">

                      <div class="col s6 m6 l6 center">
                        <?php if ($productImage == "no_img") { ?>
                          <img src="../../../MaxComanda/uploads/no_image.png" style="height: 150px" class="responsive-img">
                        <?php } else { ?>
                          <img src="../../../<?php echo $directory; ?>/uploads/productImg/<?php echo $productImage; ?>" style="height: 150px" class="responsive-img">

                        <?php } ?>

                      </div> <!-- /.col -->

                      <div class="col s6 m6 l6">

                        <h6 class="center"><b><?php echo $productName; ?></b></h6>
                        <h6 class="center">A partir de <?php echo $productValue; ?></h6>
                        <a class="waves-effect waves-light btn-large <?php echo $colorCategory; ?>" style="margin: 3px; width: 100%">+Detalhes</a>


                      </div> <!-- /.col -->


                    </div> <!-- /.row -->
                  </div> <!-- /.card-content -->
                </div> <!-- /.card -->
              </div> <!-- /.col -->

          <?php }
          } ?>




        </div> <!-- /.row -->
      <?php } ?>
    </section>
  </div>


<?php $paramCategory++;
} ?>




<div class="fixed-action-btn" id="btnTop" hidden>
  <a class="btn-floating btn-large purple darken-4 tooltipped" data-tooltip="Voltar ao Topo" href="#header">
    <i class="large material-icons">arrow_drop_up</i>
  </a>
</div>