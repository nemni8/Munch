<?php
	$edit_id = $id ;
	$group = 0;
	$display = "";
	$extra_class = "";
	$num_group = ceil(sizeof($all_items)/5);
	$left_item = sizeof($all_items)%5;
?>
<h2>
	<?php echo ucwords($id);?>
</h2>
<div class="inner_nav">
	<ul  class="icons ui-widget ui-helper-clearfix">
		<li class="ui-state-default ui-corner-all">
			<span class="ui-icon ui-icon-arrowthick-1-w" onclick="toggle_item('down','<?php echo $id;?>',<?php echo $num_group;?>)"></span>
		</li>
		<li class="ui-state-default ui-corner-all">
			<span class="ui-icon ui-icon-arrowthick-1-e" onclick="toggle_item('up','<?php echo $id;?>',<?php echo $num_group;?>)"></span>
		</li>
	</ul>
</div>
<div class="tabel_dashboard">
	<table class="ui-widget ui-widget-content">
		<thead>
			<tr class="ui-widget-header ">
				<th>#</th>
			<?php foreach( $arr_input as $input): ?>
				<th> <?php echo $input['title'];?> </th>
			<?php endforeach; ?>
				<th> <?php echo '';?> </th>
				<?php if(( $is_supadmin) OR ($edit_id != 'restaurant')) :?>
					<th> <?php echo '';?> </th>
				<?php endif ;?>
		</thead>
		<tbody>
			<?php foreach( $all_items as $key =>$item) : ?>
				<?php if(($key % 5 == 0) ) $group++;?>
				<?php if(($key > 4) ) $display = 'display:none';?>
				<?php
					if($num_group == $group + 1 AND ( ($key % 5 ) + 1 > $left_item) AND $left_item !== 0) {
						$temp_gr = $group + 1;
						$extra_class = $id.$temp_gr;
					}
				?>
				<tr style="<?php echo $display?>" class="<?php echo $id?> <?php echo $id.$group?> <?php echo $extra_class;?>">
					<td style="width:20px;"><?php echo $key+1;?></td>
					<?php foreach( $arr_input as $input): ?>
						<td> <?php echo $item->$input['col_name']; ?> </td>
					<?php endforeach; ?>
					<td class="links">
						<a class="edit_link" onclick="id_assigner(<?php echo $item->id. ",'".$id,"'" ?>),true">
							<div align="middle"><?php echo html::image('media/images/edit.png',array('alt'=>'Edit','style'=>'')) ;?></div>
						</a>
					</td>
					<?php if(( $is_supadmin) OR ($edit_id != 'restaurant')) :?>
					<td class="links"><a class="delete_link" onclick="delete_assigner(<?php echo $item->id. ",'".$id,"'" ?>),true"><div align="middle"><?php echo html::image('media/images/delete.png',array('alt'=>'Edit','border'=>0)) ;?></div></a></td>
					<?php endif ;?>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
	<?php echo form::input('current'.$id,1,array('hidden'=>'hidden','id'=>'current'.$id,'type'=>'number'));?>
</div>	



