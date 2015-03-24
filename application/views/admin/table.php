<?php $edit_id = $id ;?>
<div class="tabel_dashboard">
	<table class="ui-widget ui-widget-content">
		<thead>
			<tr class="ui-widget-header ">
			<?php foreach( $arr_input as $input): ?>
				<th> <?php echo $input['title'];?> </th>
			<?php endforeach; ?>
				<th> <?php echo '';?> </th>
				<?php if(( $is_supadmin) OR ($edit_id != 'restaurant')) :?>
					<th> <?php echo '';?> </th>
				<?php endif ;?>
		</thead>
		<tbody>
			<?php foreach( $all_items as $item): ?>
				<tr> 
					<?php foreach( $arr_input as $input): ?>
						<td> <?php echo $item->$input['col_name'];?> </td>
					<?php endforeach; ?>
					<td><a class="edit_link" onclick="id_assigner(<?php echo $item->id. ",'".$id,"'" ?>),true"><div align="middle"><?php echo html::image('media/images/edit.png',array('alt'=>'Edit','border'=>0)) ;?></div></a></td>
					<?php if(( $is_supadmin) OR ($edit_id != 'restaurant')) :?>
					<td><a class="delete_link" onclick="delete_assigner(<?php echo $item->id. ",'".$id,"'" ?>),true"><div align="middle"><?php echo html::image('media/images/delete.png',array('alt'=>'Edit','border'=>0)) ;?></div></a></td>
					<?php endif ;?>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>	
<div class="clear"></div>



