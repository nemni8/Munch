<?php $edit_id = ($type == 'edit') ? $id : NULL;?>

<div class="dish_subdish">
	<?php echo Form::open('admin/groups/createsub/'.$edit_id,array('id'=>'form_group_sub_'.$group_id.'_'.$edit_id));?>
		<div class="clear"></div>
		<?php echo Form::label('sub_id','Sub Dish');?>
		<?php $default = ($type == 'edit') ? $sub->sub_id : NULL; ?>
		<?php  echo Form::select('sub_id',
											DB::select('id','name')
											->from('dishes')
											->where('id' , '<>', $dish_id)
											->execute()->as_array('id','name'), $default);
		?>
		<?php //echo Form::input('dish_id',$dish_id, array('type'=>'hidden')); ?>
		<?php echo Form::input('group_id',$group_id, array('type'=>'hidden')); ?>
	<?php echo Form::close();?>
</div>


