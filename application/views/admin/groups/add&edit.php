<?php $edit_id = ($type == 'edit') ? $id : NULL;?>
<div class="">
	<!-- start of the form -->
	<?php echo Form::open('admin/groups/create/'.$edit_id,array('id'=>'form_group_'.$edit_id));?>
		<?php echo Form::label('name','Group Name',array('class'=>'fix_size_lable'));?>
		<?php $default = ($type == 'edit') ? $group->name : NULL; ?>
		<?php echo Form::input('name',$default);?>
		<div class="clear" style="height: 12px;"></div>
		<?php echo Form::label('rule','Sub Dish Rule',array('class'=>'fix_size_lable'));?>
		<?php $default = ($type == 'edit') ? $group->rule : NULL; ?>
		<?php echo Form::input('rule',$default);?>
		<div class="clear" style="height: 12px;"></div>
		<?php echo Form::label('basic_optional','Basic Or Optional',array('class'=>'fix_size_lable'));?>
		<?php $default = ($type == 'edit') ? $group->basic_optional : NULL; ?>
		<?php echo Form::select('basic_optional',Kohana::config ('global.basic_optional'),$default);?>
		<div class="clear" style="height: 12px;"></div>
		<?php echo Form::label('basic_optional','Price',array('class'=>'fix_size_lable'));?>
		<?php $default = ($type == 'edit') ? $group->price : NULL; ?>
		<?php echo Form::input('price',$default);?>
		<div class="clear" style="height: 12px;"></div>
		<?php $default = ($type == 'edit') ? $group->dish_id : $dish_id; ?>
		<?php echo Form::input('dish_id',$default, array('type'=>'hidden')); ?>
		<?php if($edit_id > 0) : ?>
			<button class="submit" onclick="edit_group_in_dish(<?php echo $id?>)">edit group</button>
		<?php endif; ?>
	<?php echo Form::close();?>

	<?php if($type == 'edit') : ?>
		<?php
			$subs = ORM::factory('sub')->get_all_subs_in_group($id);
			if(count($subs) > 0) :
		?>
			<div class="dashed"></div>
			<h3>Subs Dishes in <?php echo $group->name;?> Group</h3>
			<ul>
				<?php foreach($subs as $sub) : ?>
					<li style=" margin-bottom: 12px;">
						<div id="edit_sub_in_group_<?php echo $sub->id;?>" style="display:inline-block;">
							<?php echo Request::factory('admin/groups/editsub/'.$sub->id)->execute() ?>
						</div>
						<button class="submit" onclick="edit_sub_in_group(<?php echo $sub->id;?>,<?php echo $sub->group_id;?>)">edit sub dish</button>
					</li>
				<?php endforeach;?>
			</ul>
			<div class="dashed"></div>
		<?php endif;?>
		<div class="clear"></div>
		<h3>Add new Sub Dish To <?php echo $group->name;?> Group</h3>
		<div id="add_group_in_dish" style="display:inline-block;">
			<?php echo Request::factory('admin/groups/addsub/'.$id)->execute() ?>
		</div>
		<button class="submit" onclick="add_sub_in_group(<?php echo $group->dish_id; ?>,<?php echo $group->id ;?> )">add sub dish</button>
		<div class="clear"></div>
	<?php endif; ?>
</div>

