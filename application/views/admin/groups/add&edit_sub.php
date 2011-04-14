<?php $edit_id = ($type == 'edit') ? $id : NULL;?>
<div class="dish_subdish">
	<?php echo Form::open('admin/groups/createsub/'.$group->id,array('id'=>'form_group_sub_'.$group->id));?>
		<div class="clear"></div>
		<?php echo Form::label('sub_id','Sub Dish');?>
		<?php 
			$default = ($type == 'edit') ? $sub->sub_id : NULL;
				$attr = ($type == 'edit') ? array('disabled' => 'disabled') : array();
		?>
		
		<?php  echo Form::select('sub_id',
											DB::select('id','name')
											->from('dishes')
											->execute()->as_array('id','name'), $default);?>
        <div class="clear" style="height: 12px"></div>
        <?php echo Form::label('Price');?>
        <?php $default = ($type=='edit') ? $sub->price :NULL ;?>
        <?php echo Form::input('price',$default,array('id'=>'price')); ?>
		<?php echo Form::input('group_id',$group->id, array('type'=>'hidden')); ?>
	    <div class="clear" style="height: 12px"></div>
    <?php echo Form::close();?>
</div>


