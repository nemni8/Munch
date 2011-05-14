<?php
$empty=0;
$cartOutput = "";
$cartTotal = "";
$pp_checkout_btn = '';
$product_id_array = '';
if($from_dish){
	$url = 'main/dishorder/'.$current_dish_id;
}
else{
	$url = 'main/dishes/'.$current_rest_id;
}
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
		$cartOutput .= '<td><a href="/munch/main/dishorderedit/'. $item_id . '">' .substr($product_name,0,12).'...'. '</a><br /></td>';
		$cartOutput .= '<td>$' . $price . '</td>';
		$cartOutput .= '<td><form action="/munch/admin/orders/cart" method="post">
		<input style="width:20%;margin-top: 2px;" name="quantity" type="text" value="' . $each_item['quantity'] . '" size="1" maxlength="2"/>
		<input class="adjustBtn" style="font-size:10px;width:70%" name="adjustBtn' . $item_id . '" type="submit" value="change" />
		<input name="item_to_adjust" type="hidden" value="' . $item_id . '" />
		<input name="current_url" type="hidden" value="'.$url.'"/>
		</form></td>';
		$cartOutput .= '<td>$' . $pricetotal . '</td>';
		$cartOutput .= '<td><form action="/munch/admin/orders/cart" method="post">
							<input class="adjustBtn" style="font-size:10px" name="deleteBtn' . $item_id . '" type="submit" value="X" />
							<input name="index_to_remove" type="hidden" value="' . $i . '" />
							<input name="current_url" type="hidden" value="'.$url.'"/>
							</form></td>';
		$cartOutput .= '</tr>';
		$i++;
    }
	setlocale(LC_MONETARY, "en_US");
	$total_price=$cartTotal;
    $cartTotal = "<div style='font-size:18px; margin:5px;display:inline-block' align='left'>Cart Total : ".$cartTotal." USD</div>";
}
?>
<div class="header_bg" style="margin-right:10px">
	<h1>Your Cart</h1>
	<?php if (!$empty): ?>
		<div class="paper_gray">
			<table class="chart_table" border="0" cellspacing="0" cellpadding="0">
				<tr class="chart_header">
					<th>Dish</th>
					<th>Price</th>
					<th>Quantity</th>
					<th colspan="2">Total</th>

				</tr>
				<?php echo $cartOutput; ?>
			</table>
		</div>
		<?php echo $cartTotal; ?>
		<form action="/munch/admin/orders/cart" method="post">
			<input name="emptycart" type="submit" value="Empty Cart" style="font-size:10px;width:85px" class="adjustBtn"/>
			<?php echo html::anchor('/admin/orders/checkout','End Order',array('class'=>'adjustBtn','style'=>'font-size:11px;width:85px'));?>
			<input name="current_url" type="hidden" value="<?php echo $url?>"/>
		</form>

	<?php endif ;?>
	<?php if ($empty) echo $cartOutput;  ?>
</div>






