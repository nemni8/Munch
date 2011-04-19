<div class="restaurants">
	<table class="ui-widget ui-widget-content">
		<thead>
			<tr class="ui-widget-header ">
			<?php foreach( $arr_input as $input): ?>
				<th> <?php echo $input['title'];?> </th>
			<?php endforeach; ?>
			<th></th>
		</thead>
		<tbody>
			<?php foreach( $restaurants as $rest): ?>
				<tr>
					<?php foreach( $arr_input as $input): ?>
						<td> <?php echo $rest->$input['col_name'];?> </td>
					<?php endforeach; ?>
					<td><?php echo html::anchor('/main/dishes/'.$rest->id,'menu');?></td>

				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>