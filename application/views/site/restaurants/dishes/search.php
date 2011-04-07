	<div class="restaurants">
	<table class="ui-widget ui-widget-content">
		<thead>
			<tr class="ui-widget-header ">
			<?php foreach( $arr_input as $input): ?>
				<th> <?php echo $input['title'];?> </th>
			<?php endforeach; ?>
		</thead>
		<tbody>
			<?php foreach( $dishes as $dish): ?>
				<tr>
					<?php foreach( $arr_input as $input): ?>
						<td> <?php echo $dish->$input['col_name'];?> </td>
					<?php endforeach; ?>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>