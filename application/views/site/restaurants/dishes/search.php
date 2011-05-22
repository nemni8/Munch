<div class="rest_search tabel_search">
	<div class="order_ingred_con" style="margin:10px;">
		<div class="header_bg" align="center">
			<h2 style="margin:0">Search Result</h2>
		</div>
	</div>
	<div class="clear" style="height:10px"></div>
	<div align="center">
		<table class="ui-widget ui-widget-content" style="width:96%">
			<thead>
				<tr class="ui-widget-header ">
				<?php foreach( $arr_input as $input): ?>
					<th> <?php echo $input['title'];?> </th>
				<?php endforeach; ?>
				<th align="center">Price</th>
				<th align="center">Dish Type</th>
				<th align="center">Category</th>
				<th></th>
			</thead>
			<tbody>
				<?php foreach($dishes as $dish) : ?>
					<tr>
						<?php foreach( $arr_input as $input) : ?>
							<td> <?php echo $dish->$input['col_name'];?> </td>
						<?php endforeach; ?>
						<td align="center"><?php echo $dish->price;?></td>
						<td align="center"><?php $arr = Kohana::config ('global.mdv'); echo $arr[$dish->mdv]?></td>
						<td align="center"><?php echo ORM::factory('dish')->get_categories($dish->id);?></td>
						<td align="center"><?php echo html::anchor('/main/dishorder/'.$dish->id,'Add to Order');?></td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>