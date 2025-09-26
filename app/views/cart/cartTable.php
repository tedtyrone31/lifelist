<!-- <h2>🛒 Cart History</h2> -->

<?php if (!empty($carts)): ?>
    <?php foreach ($carts as $cart): ?>
        <div class="cart-item">
            <h4>
                <button class="toggle">+</button>
                <?= date('F j, Y l g:ia', strtotime($cart['cart_date'])) ?>
                ₱<?= number_format($cart['cart_total'], 2) ?>
            </h4>

            <div class="cart-details" hidden>
                <table border="1" class="c_table_type02 c_cart_table">
                    <thead>
                        <tr>
                            <th>
                                <span class="full">Items</span>
                                <span class="short">Itm</span>
                            </th>
                            <th>
                                 <span class="full">Tag</span>
                                <span class="short">tag</span>
                            </th>
                            <th>
                                <span class="full">Description</span>
                                <span class="short">Desc</span>
                            </th>
                            <th>
                                <span class="full">Quantity</span>
                                <span class="short">Qty</span>
                            </th>
                            <th>
                                <span class="full">Price</span>
                                <span class="short">₱</span>
                            </th>
                            <th>
                                <span class="full">Total</span>
                                <span class="short">Sum</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($cart['items'] as $item): ?>
                            <tr>
                                <td><?= htmlspecialchars($item['item_name']) ?></td>
                                <td>  <?= isset($tags[$item['tag']]) ? htmlspecialchars($tags[$item['tag']]) : htmlspecialchars($item['tag']) ?></td>
                                <td><?= htmlspecialchars($item['description']) ?></td>
                                <td><?= (int) $item['quantity'] ?></td>
                                <td><?= number_format($item['price'], 2) ?></td>
                                <td><?= number_format($item['total'], 2) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div><br>
    <?php endforeach; ?>
<?php else: ?>
    <p>No cart history found.</p>
<?php endif; ?>
