<?php $edit_id = ($type == 'edit') ? $id : NULL;?>

<div class="dish_subdish">
	<?php echo Form::open('admin/dishes/creategroup/'.$edit_id,array('id'=>'form_dish_group'));?>
		<div class="clear"></div>
		<?php echo Form::label('group_id','Group');?>
		<?php $default  = NULL; ?>
		<?php  echo Form::select('group_id',
											DB::select('id','name')
											->from('groups')
											//->where('id' , '<>', $dish_id)
											->execute()->as_array('id','name'), $default);
		?>
		<?php echo Form::input('dish_id',$dish->id, array('type'=>'hidden')); ?>
	<?php echo Form::close();?>
</div>


