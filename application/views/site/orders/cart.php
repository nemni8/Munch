
<?php
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//       Section 5  (render the cart for the user to view on the page)
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$empty=0;
$cartOutput = "";
$cartTotal = "";
$pp_checkout_btn = '';
$product_id_array = '';
if (!isset($_SESSION["cart_array"]) || count($_SESSION["cart_array"]) < 1) {
    $cartOutput = "<h2 align='center'>Your shopping cart is empty</h2>";
    $empty=1;
} else {
	// Start PayPal Checkout Button
	$pp_checkout_btn .= '<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
    <input type="hidden" name="cmd" value="_cart">
    <input type="hidden" name="upload" value="1">
    <input type="hidden" name="business" value="you@youremail.com">';
	// Start the For Each loop
	$i = 0;
    
    foreach ($_SESSION["cart_array"] as $key=>$each_item) {
		$dishid= $each_item['dish_id'];
        $item_id = $key;
        $ordersdish=$key;
		$product_name=orm::factory('dish',$dishid)->name;
        $price = $each_item["price"];
        //$details = '';
		$pricetotal = $price * $each_item['quantity'];
		$cartTotal = $pricetotal + $cartTotal;
		setlocale(LC_MONETARY, "en_US");
        //$pricetotal = money_format("%10.2n", $pricetotal);

		// Dynamic Checkout Btn Assembly
		$x = $i + 1;
		// Create the product array variable
		$product_id_array .= "$item_id-".$each_item['quantity'].",";
		// Dynamic table row assembly
		$cartOutput .= "<tr>";
		$cartOutput .= '<td><a href="/munch/main/dishorderedit/'. $item_id . '">' . $product_name . '</a><br /></td>';
		$cartOutput .= '<td>$' . $price . '</td>';
		$cartOutput .= '<td><form action="/munch/admin/orders/cart" method="post">
		<input name="quantity" type="text" value="' . $each_item['quantity'] . '" size="1" maxlength="2" />
		<input name="adjustBtn' . $item_id . '" type="submit" value="change" />
		<input name="item_to_adjust" type="hidden" value="' . $item_id . '" />
		</form></td>';
		//$cartOutput .= '<td>' . $each_item['quantity'] . '</td>';
		$cartOutput .= '<td>$' . $pricetotal . '</td>';
		$cartOutput .= '<td><form action="/munch/admin/orders/cart" method="post"><input name="deleteBtn' . $item_id . '" type="submit" value="X" /><input name="index_to_remove" type="hidden" value="' . $i . '" /></form></td>';
		$cartOutput .= '</tr>';
		$i++;
    }
	setlocale(LC_MONETARY, "en_US");
    //$cartTotal = money_format("%10.2n", $cartTotal);
	$total_price=$cartTotal;
    $cartTotal = "<div style='font-size:18px; margin-top:12px;' align='right'>Cart Total : ".$cartTotal." USD</div>";

}
?>

<html >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Your Cart</title>
</head>
<body>
<div align="center" id="mainWrapper">
  <div id="pageContent">
    <div style="margin:24px; text-align:left;">
    <h1>Your Cart</h1>
    <br />
    <?php if (!$empty): ?>
        <table width="100%" border="1" cellspacing="0" cellpadding="6">
          <tr>
            <td width="18%" bgcolor="#C5DFFA"><strong>Dish</strong></td>
            <td width="10%" bgcolor="#C5DFFA"><strong>Price</strong></td>
            <td width="9%" bgcolor="#C5DFFA"><strong>Quantity</strong></td>
            <td width="9%" bgcolor="#C5DFFA"><strong>Total</strong></td>
            <td width="9%" bgcolor="#C5DFFA"><strong>Remove</strong></td>
          </tr>

     <?php echo $cartOutput; ?>
     <!-- <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr> -->
    </table>
    <?php echo $cartTotal; ?>

    <br />
<br />
        <form action="/munch/admin/orders/cart" method="post"><input name="emptycart" type="submit" value="Empty Cart" /></form>
        <?php echo html::anchor('/admin/orders/checkout','Checkout');?>
        <?php // <form action="/munch/admin/orders/checkout" method="post"><input name="checkout" type="submit" value="Checkout" /><input name="total_price" type="hidden" value=<?php echo $total_price ;?>  /></form> ;?>
    <?php endif ;?>
    <?php if ($empty) echo $cartOutput;  ?>
    </div>
   <br />
  </div>
</div>
</body>
</html> 
