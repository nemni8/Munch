<?php $edit_id = ($type == 'edit') ? $id : NULL;?>
<div class="">
	<!-- start of the form -->
	<?php echo Form::open('admin/groups/create/'.$edit_id,array('id'=>'form_group_'.$edit_id));?>
		<?php echo Form::label('name','Group Name',array('class'=>'fix_size_lable') );

            if(isset($errors['name'])): // checking if the form has been returned with errors
					$default =  $_POST['name'] ;
			else : // set the values to the fields accourding to the form type (add,edit)
					$default = ($type == 'edit') ?  $group->name : NULL ;
			endif;
        ?>
		<?php echo Form::input('name',$default);?>
        <?php
            if (isset($errors['name'])) :?>
				<div class="validate">
					<?php echo $errors['name'];?>
				</div>
			<?php endif;?>
        
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
        <?php  $default = (($type == 'edit') AND ($_SESSION['dish_id']==NULL)) ? $group->dishes->find_all()->as_array() : $dish_id ; ?>

        <?php if (( $type == 'edit') AND ($_SESSION['dish_id']==NULL)) :?>
            <?php  echo Form::select('dish_id[]',
												DB::select('id','name')->from('dishes')->execute()->as_array('id','name'),
												$default,array('id'=>'dish_category'));?>
        <?php else : ?>
            <?php echo Form::input('dish_id',$default, array('type'=>'hidden')); ?>
        <?php endif ;?>
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
			<h3>Subs Dishes in Group</h3>
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
		<h3>Add new Sub Dish</h3>
		<div id="add_group_in_dish" style="display:inline-block;">
			<?php echo Request::factory('admin/groups/addsub/'.$id)->execute() ?>
		</div>
		<button class="submit" onclick="add_sub_in_group(<?php echo $dish_id; ?>,<?php echo $group->id ;?> )">add sub dish</button>
		<div class="clear"></div>
	<?php endif; ?>
</div>

