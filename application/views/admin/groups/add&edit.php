<?php $edit_id = ($type == 'edit') ? $id : NULL;?>
<div class="dialog">
	<!-- start of the form -->
	<?php echo Form::open('admin/groups/create/'.$edit_id,array('id'=>'form_group'));?>
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
        <?php  echo Form::label('dish_id','Dishes who has this group');?><br />
        <?php  $default = ($type == 'edit')  ? $group->dishes->find_all()->as_array() : array() ; ?>
        <?php  echo Form::select('dish_id[]',
												DB::select('id','name')->from('dishes')->execute()->as_array('id','name'),
												$default,array('id'=>'dish_group'));?>
        <?php echo Form::close();?>
        <?php if($type=='edit'): ?>
        <h3>Add new Sub Dish</h3>
		<div id="add_group_in_dish" style="display:inline-block;">
			<?php echo Request::factory('admin/groups/addsub/'.$id)->execute() ?>
		</div>
		<button class="submit" onclick="add_sub_in_group(<?php echo $group->id ;?> )">add sub dish</button>
        <?php $subs=$group->subs->find_all(); ?>

		<?php if(count($subs) > 0) :?>
			<div class="dashed"></div>
			<h3>Subs Dishes in Group</h3>
			<ul>
				<?php foreach($subs as $sub) : ?>
					<li style=" margin-bottom: 12px;">
                    <?php echo $sub->name ;?>
                    <button class="submit" onclick="remove_sub_from_group(<?php echo $sub->id ;?>,<?php echo $group->id ;?> )">remove sub dish</button>
					</li>
				<?php endforeach;?>
			</ul>
			<div class="dashed"></div>
		<?php endif;?>
		<div class="clear"></div>
       <?php endif ;?>


</div>

