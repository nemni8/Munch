<?php $edit_id = $id ;?>
<div class="form_tables">
	<!-- start of the form -->
	<?php echo Form::open('admin/main/table/'.$edit_id,array('id'=>'form_table'));?>
		<!-- change user ID of A restaurant-->
    
    <div id="items-contain" class="ui-widget">
    <table id="users" class="ui-widget ui-widget-content">
		<thead>
            <tr class="ui-widget-header ">
            <?php foreach( $arr_input as $input): ?>
			    <th> <?php echo $input['title'];?> </th>
            <?php endforeach; ?>
                <th> <?php echo '';?> </th>
                <th> <?php echo '';?> </th>
		</thead>
		<tbody>
			<?php foreach( $all_items as $item): ?>
			    <tr> 
                <?php foreach( $arr_input as $input): ?>
	    		    <td> <?php echo $item->$input['col_name'];?> </td>
                <?php endforeach; ?>
                    <td><a class="edit_link"   onclick="id_assigner(<?php echo $item->id. ",'".$id,"'" ?>),true"><div align="middle"><?php echo html::image('media/images/edit.png',array('alt'=>'Edit','border'=>0)) ;?></div></a></td>
                    <?php if(( $is_supadmin)||($edit_id!='restaurant')) :?>
                    <td><a class="delete_link"   onclick="delete_assigner(<?php echo $item->id. ",'".$id,"'" ?>),true"><div align="middle"><?php echo html::image('media/images/delete.png',array('alt'=>'Edit','border'=>0)) ;?></div></a></td>
                    <?php endif ;?>
                </tr>
            <?php endforeach; ?>
		</tbody>
	</table>
    <div class="clear"><br/></div>

    <?php echo Form::close();?>
</div>



