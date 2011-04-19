<div class="dishes">
	<table class="ui-widget ui-widget-content">
		<thead>
			<tr class="ui-widget-header ">
			<?php foreach( $arr_input as $input): ?>
				<th> <?php echo $input['title'];?> </th>
			<?php endforeach; ?>
			<th>Dish Type</th>
			<th></th>
		</thead>
		<tbody>
			<?php foreach($dishes as $dish) : ?>
				<tr>
					<?php foreach( $arr_input as $input) : ?>
						<td> <?php echo $dish->$input['col_name'];?> </td>
					<?php endforeach; ?>
					<td><?php $arr = Kohana::config ('global.mdv'); echo $arr[$dish->mdv]?></td>
					<td><?php echo html::anchor('/main/dishorder/'.$dish->id,'Add to Order');?></td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>