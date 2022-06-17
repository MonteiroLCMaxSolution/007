<div class="cart-modal">
    <div class="close-modal">
        <i class="fa-solid fa-xmark" onclick="closeCartModal()"></i>
    </div><!--close-modal-->
    <div class="cart-modal-title">
        <h2>Carrinho <i class="fa-solid fa-cart-shopping"></i></h2>
    </div><!--cart-modal-title-->
    <div class="cart-modal-table">
        <table>
            <thead>
                <tr>
                    <th>Produto</th>
                    <th>Valor Unitário</th>
                    <th>Quantidade</th>
                    <th>Total</th>
                    <th>Editar</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Coca-cola 350ml</td>
                    <td>R$ 7,00</td>
                    <td>
                        <div class="cart-modal-quantity-box flexbox">
                            <div class="quantity-btn qnt-l" onclick="alterarQuantidade(-1, this, 'cart1')" >-</div>
                            <input type="number" name="quantidade-produto" id="cart1"  min="1" max="10" value="1" required>
                            <div class="quantity-btn qnt-r" onclick="alterarQuantidade(1, this, 'cart1')" >+</div>
                        </div><!--product-modal-quantity-box-->
                    </td>
                    <td>R$ 21,00</td>
                    <td><i class="fa-solid fa-pencil" onclick="openEditProductModal()"></i></td>
                </tr>
                <tr>
                    <td>Coca-cola 350ml</td>
                    <td>R$ 7,00</td>
                    <td>
                        <div class="cart-modal-quantity-box flexbox">
                            <div class="quantity-btn qnt-l" onclick="alterarQuantidade(-1, this, 'cart2')" >-</div>
                            <input type="number" name="quantidade-produto" id="cart2"  min="1" max="10" value="1" required>
                            <div class="quantity-btn qnt-r" onclick="alterarQuantidade(1, this, 'cart2')" >+</div>
                        </div><!--product-modal-quantity-box-->
                    </td>
                    <td>R$ 21,00</td>
                    <td><i class="fa-solid fa-pencil" onclick="openEditProductModal()"></i></td>
                </tr>
                <tr>
                    <td>Coca-cola 350ml</td>
                    <td>R$ 7,00</td>
                    <td>
                    <div class="cart-modal-quantity-box flexbox">
                        <div class="quantity-btn qnt-l" onclick="alterarQuantidade(-1, this, 'cart3')" >-</div>
                        <input type="number" name="quantidade-produto" id="cart3"  min="1" max="10" value="1" required>
                        <div class="quantity-btn qnt-r" onclick="alterarQuantidade(1, this, 'cart3')" >+</div>
                    </div><!--product-modal-quantity-box-->
                    </td>
                    <td>R$ 21,00</td>
                    <td><i class="fa-solid fa-pencil" onclick="openEditProductModal()"></i></td>
                </tr>
                <tr>
                    <td>Coca-cola 350ml</td>
                    <td>R$ 7,00</td>
                    <td>
                    <div class="cart-modal-quantity-box flexbox">
                        <div class="quantity-btn qnt-l" onclick="alterarQuantidade(-1, this, 'cart3')" >-</div>
                        <input type="number" name="quantidade-produto" id="cart3"  min="1" max="10" value="1" required>
                        <div class="quantity-btn qnt-r" onclick="alterarQuantidade(1, this, 'cart3')" >+</div>
                    </div><!--product-modal-quantity-box-->
                    </td>
                    <td>R$ 21,00</td>
                    <td><i class="fa-solid fa-pencil" onclick="openEditProductModal()"></i></td>
                </tr>
                <tr>
                    <td>Coca-cola 350ml</td>
                    <td>R$ 7,00</td>
                    <td>
                    <div class="cart-modal-quantity-box flexbox">
                        <div class="quantity-btn qnt-l" onclick="alterarQuantidade(-1, this, 'cart3')" >-</div>
                        <input type="number" name="quantidade-produto" id="cart3"  min="1" max="10" value="1" required>
                        <div class="quantity-btn qnt-r" onclick="alterarQuantidade(1, this, 'cart3')" >+</div>
                    </div><!--product-modal-quantity-box-->
                    </td>
                    <td>R$ 21,00</td>
                    <td><i class="fa-solid fa-pencil" onclick="openEditProductModal()"></i></td>
                </tr>
            </tbody>
        </table>
    </div><!--cart-modal-table-->
    <div class="cart-modal-total">
        <h2>Total: <b>R$ 23,00</b></h2>
    </div><!--cart-modal-total-->
    <div class="cart-modal-confirm">
        <a href="#" onclick="openConfirmModalForm()">Continuar Pedido</a>
    </div><!--cart-modal-confirm-->
</div><!--cart-modal-->