<?php $edit_id = ($type == 'edit') ? $id : NULL;?>

<div class="dialog">
	<?php echo Form::open('admin/dishes/creategroup/'.$dish->id,array('id'=>'form_dish_group_'));?>
		<div class="clear"></div>
		<?php echo Form::label('group_id','Group');?>
		<?php $default  = NULL; ?>
		<?php  echo Form::select('group_id',
											DB::select('id','name')
											->from('groups')
                                            ->where('user_id' , '=', $_SESSION['auth_user_munch']->id)
                                            ->or_where('user_id' , '=', 0)
											->execute()->as_array('id','name'), $default);
		?>
	<?php echo Form::close();?>
</div>


