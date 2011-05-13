<?php
$empty=0;
$cartOutput = "";
$cartTotal = "";
$pp_checkout_btn = '';
$product_id_array = '';
if (!isset($_SESSION["cart_array"]) || count($_SESSION["cart_array"]) < 1) {
    $cartOutput = "<h2 align='center'>Your shopping cart is empty</h2>";
    $empty=1;
} else {
	$i = 0;
    foreach ($_SESSION["cart_array"] as $key=>$each_item) {
		$dishid= $each_item['dish_id'];
        $item_id = $key;
        $ordersdish=$key;
		$product_name=orm::factory('dish',$dishid)->name;
        $price = $each_item["price"];
		$pricetotal = $price * $each_item['quantity'];
		$cartTotal = $pricetotal + $cartTotal;
		setlocale(LC_MONETARY, "en_US");
		$x = $i + 1;
		$product_id_array .= "$item_id-".$each_item['quantity'].",";
		$cartOutput .= "<tr>";
		$cartOutput .= '<td><a href="/munch/main/dishorderedit/'. $item_id . '">' . $product_name . '</a><br /></td>';
		$cartOutput .= '<td>$' . $price . '</td>';
		$cartOutput .= '<td><form action="/munch/admin/orders/cart" method="post">
		<input name="quantity" type="text" value="' . $each_item['quantity'] . '" size="1" maxlength="2" />
		<input name="adjustBtn' . $item_id . '" type="submit" value="change" />
		<input name="item_to_adjust" type="hidden" value="' . $item_id . '" />
		</form></td>';
		$cartOutput .= '<td>$' . $pricetotal . '</td>';
		$cartOutput .= '<td><form action="/munch/admin/orders/cart" method="post"><input name="deleteBtn' . $item_id . '" type="submit" value="X" /><input name="index_to_remove" type="hidden" value="' . $i . '" /></form></td>';
		$cartOutput .= '</tr>';
		$i++;
    }
	setlocale(LC_MONETARY, "en_US");
	$total_price=$cartTotal;
    $cartTotal = "<div style='font-size:18px; margin-top:12px;' align='right'>Cart Total : ".$cartTotal." USD</div>";
}
?>
<div align="center" id="mainWrapper">
	<div id="pageContent">
		<div style="margin:24px; text-align:left;">
			<h1>Your Cart</h1>
			<?php if (!$empty): ?>
				<table width="100%" border="1" cellspacing="0" cellpadding="6">
					<tr>
						<td width="18%"><strong>Dish</strong></td>
						<td width="10%"><strong>Price</strong></td>
						<td width="9%"><strong>Quantity</strong></td>
						<td width="9%"><strong>Total</strong></td>
						<td width="9%"><strong>Remove</strong></td>
					</tr>
					<?php echo $cartOutput; ?>
				</table>
				<?php echo $cartTotal; ?>
				<form action="/munch/admin/orders/cart" method="post"><input name="emptycart" type="submit" value="Empty Cart" /></form>
				<?php echo html::anchor('/admin/orders/checkout','Checkout');?>
			<?php endif ;?>
			<?php if ($empty) echo $cartOutput;  ?>
		</div>
  	</div>
</div>

