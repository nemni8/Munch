<div>
    <h1> Your Order</h1>
    <?php $cartOutput = ""; ?>
    <?php $cartTotal = ""; ?>
    <div>
        <table>
            <thead>
            <tr>
                <th> Dish</th>
                <th> Quantity</th>
                <th> Price</th>
            </tr>
            </thead>
    <?php foreach ($_SESSION["cart_array"] as $key=>$each_item): ?>
        <?php $dishid= $each_item['dish_id']; ?>
        <?php $item_id = $key;?>
        <?php $ordersdish=$key; ?>
        <?php $product_name=orm::factory('dish',$dishid)->name; ?>
        <?php $price = $each_item["price"]; ?>
		<?php $pricetotal = $price * $each_item['quantity']; ?>
		<?php $cartTotal = $pricetotal + $cartTotal; ?>
		<?php setlocale(LC_MONETARY, "en_US"); ?>
        <tr>
            <td>
                <table border="0" >
                    <tr><td><?php echo $product_name;?></td></tr>
                    <?php foreach ($each_item['ingredients'] as $key=>$ingredient): ?>
                        <?php $ingredient_name=orm::factory('ingredient',$ingredient['ingredient_id'])->name; ?>
                        <tr>
                            <td><?php echo $ingredient_name;?></td>
                            <?php if ($ingredient['price']>0): ?>
                                <td><?php echo $ingredient['price'];?>$ Extra</td>
                            <?php endif ;?>
                        </tr>
                    <?php endforeach ;?>
                    <?php foreach ($each_item['subs'] as $key=>$sub): ?>
                        <?php $sub_name=orm::factory('dish',$sub['sub_id'])->name; ?>
                        <tr>
                            <td><?php echo $sub_name;?></td>
                            <?php if ($ingredient['price']>0): ?>
                                <td><?php echo $ingredient['price'];?>$ Extra</td>
                            <?php endif ;?>
                        </tr>
                    <?php endforeach ;?>
                </table>
            </td>
            <td><?php echo $each_item['quantity'];?></td>
            <td><?php echo $pricetotal;?></td>
        </tr>
    <?php endforeach ;?>
    </table>
    <?
	setlocale(LC_MONETARY, "en_US");
    //$cartTotal = money_format("%10.2n", $cartTotal);
    //$cartTotal = "<div style='font-size:18px; margin-top:12px;' align='right'>Cart Total : ".$cartTotal." USD</div>";
    ?>
    <? $shipping='0' ;?>
    <? $shipping=orm::factory('restaurant',$_SESSION["cart_array"][0]['rest_id'])->delivery_cost ;?>
    <? $min_order=orm::factory('restaurant',$_SESSION["cart_array"][0]['rest_id'])->delivery_min ;?>
    <? $total_price=$shipping+$cartTotal ;?>
    <div style='font-size:18px; margin-top:12px;' align='Left'>Cart Total:<?php echo $cartTotal;?> $ </div>
    <div style='font-size:18px; margin-top:12px;' align='left'>Delivery Cost:<?php echo $shipping;?> $</div>
    <div style='font-size:18px; margin-top:12px;' align='left'> Total:<?php echo $total_price;?> $</div>
    <div class="clear"></div>
    <form action="/munch/admin/orders/cart" method="post"><input name="emptycart" type="submit" value="Empty Cart" /></form>
    <div class="clear"></div>
    <form action="/munch/admin/orders/checkout" method="post"><input name="checkout" type="submit" value="Checkout" /><input name="total_price" type="hidden" value=<?php echo $total_price ;?>  /></form>

    </div>
   <br />
  </div>
