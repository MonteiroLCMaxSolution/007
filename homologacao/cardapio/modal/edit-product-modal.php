<div class="product-modal flexbox" id="edit-product-modal">
    <div class="product-modal-img w50" style="background-image: url(../images/coca.jpg);"></div><!--product-modal-img-->
    <div class="product-modal-content w50">
        <div class="close-modal">
            <i class="fa-solid fa-xmark" onclick="closeEditProductModal()"></i>
        </div><!--close-modal-->
        <div class="product-modal-main">
            <div class="product-modal-infos">
                <div class="product-modal-title">
                    <h2>Coca-Cola 350ml</h3>
                </div><!--product-modal-title-->
                <div class="product-modal-price">
                    <h3>R$ 7,00</h3>
                </div><!--product-modal-price-->
            </div><!--product-modal-infos-->
            <div class="product-modal-quantity">
                <div class="product-modal-title-single">
                    <h2>Quantidade</h2>
                </div><!--product-modal-title-single-->
            <div class="product-modal-quantity-box flexbox">
                <div class="quantity-btn qnt-l" onclick="alterarQuantidade(-1, this, 'product1')" >-</div>
                        <input type="number" name="quantidade-produto" id="product1"  min="1" max="10" value="1" required>
                        <div class="quantity-btn qnt-r" onclick="alterarQuantidade(1, this, 'product1')" >+</div>
                </div><!--product-modal-quantity-box-->
            </div><!--product-modal-quantity-->
            <div class="product-modal-flavor">
                <div class="product-modal-title-single">
                    <h2>Sabores</h2>
                    <h3>Escolha até 1 sabor(es)</h3>
                </div><!--product-modal-title-single-->
                <div class="product-modal-flavor-box">
                    <label class="label-single">
                        <input type="checkbox" class="custom-check" name="" id="">
                        Original
                    </label><!--label-single-->
                    <label class="label-single">
                        <input type="checkbox" class="custom-check" name="" id="">
                        Zero
                    </label><!--label-single-->
                </div><!--product-modal-flavor-box-->
            </div><!--product-modal-flavor-->
            <div class="product-modal-complements">
                <div class="product-modal-title-single">
                    <h2>Complementos</h2>
                    <h3>Escolha até 2 complemento(s)</h3>
                </div><!--product-modal-title-single-->
                <div class="product-modal-complements-box">
                    <label class="label-single">
                        <input type="checkbox" class="custom-check" name="" id="">
                        Canudo - <b>R$ 1,00</b>
                    </label><!--label-single-->
                    <label class="label-single">
                        <input type="checkbox" class="custom-check" name="" id="">
                        Copo de plástico - <b>R$ 2,00</b>
                    </label><!--label-single-->
                </div><!--product-modal-complements-box-->
            </div><!--product-modal-complements-->
            <div class="product-modal-comments">
                <div class="product-modal-title-single">
                    <h2>Observações</h2>
                </div><!--product-modal-title-single-->
                <textarea name="" id="" placeholder="(Opcional)"></textarea>
            </div><!--product-modal-comments-->
        </div><!--product-modal-main-->
        <div class="product-modal-btn-box flexbox">
            <button>Remover item</button>
            <button>Alterar R$ 7,00</button>
        </div><!--product-modal-add-->
    </div><!--product-modal-content-->
</div><!--product-modal-->