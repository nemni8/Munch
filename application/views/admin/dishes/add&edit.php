<?php $edit_id = ($type == 'edit') ? $id : NULL;?>
<div class="dish">
	<!-- start of the form -->
	<?php echo Form::open('admin/dishes/create/'.$edit_id,array('id'=>'form_dish'));?>
		<!-- change user ID of A restaurant-->
		<?php foreach( $arr_input as $input): ?>
			<div>
				<?php echo Form::label($input['col_name'],$input['title']);?>
				<?php
					$default = ($type == 'edit') ? $dish->$input['col_name'] : NULL;
					echo Form::input($input['col_name'],$default);
				?>
			</div>
		<?php endforeach; ?>
		<?php $default = ($type == 'edit') ? (bool)$dish->active : TRUE; ?>
		<?php echo Form::label('active','Active Dish');?>
		<div class="clear"></div>
		<?php echo Form::label('yes','yes');?>
		<?php echo Form::radio('active',1, $default);?>
		<?php echo Form::label('no','no');?>
		<?php echo Form::radio('active',0 , ! $default);?>
		<div class="clear"></div>
		<?php $default = ($type == 'edit') ? $dish->restaurant_id : NULL; ?>
		<?php echo Form::label('restaurant_id','Restaurant');?>
		<?php echo Form::select('restaurant_id',$user->restaurants->find_all()->as_array('id','name')); ?>
		<div class="clear"></div>
		<?php echo Form::label('mdv','Dish Type');?>
		<?php $default = ($type == 'edit') ? $dish->mdv : NULL; ?>
		<?php  echo Form::select('mdv',Kohana::config ('global.mdv'),$default);?>
		<div class="clear"></div>
		<?php  echo Form::label('category_id','Dish Category');?>
		<?php  $default = ($type == 'edit') ? $dish->categories->find_all()->as_array() : array() ; ?>
		<?php  echo Form::select('category_id[]',
									DB::select('id','name')
										->from('categories')
										->where('model','=','dish')
										->execute()->as_array('id','name'),$default);?>
		<div class="clear"></div>
		<!-- end of the form -->
	<?php echo Form::close();?>
	<div class="dashed"></div>
	<?php if($type == 'edit') : ?>
		<?php
			$dish_ingred = ORM::factory('dishesingredient')->get_all_ingredients_in_dish($dish->id);
			if(count($dish_ingred) > 0) :
		?>
			<h3>ingredients in dish</h3>
			<ul>
				<?php foreach($dish_ingred as $ingred) : ?>
					<li>
						<div id="edit_ingred_in_dish_<?php echo $ingred->id;?>" style="display:inline-block;">
							<?php echo Request::factory('admin/dishes/editingredient/'.$ingred->id)->execute() ?>
						</div>
						<button onclick="edit_ingred_in_dish(<?php echo $ingred->id;?>)">edit</button>
					</li>
				<?php endforeach;?>
			</ul>
		<?php endif;?>
		<h3>add new ingredient</h3>
		<div id="add_ingred_in_dish" style="display:inline-block;">
			<?php echo Request::factory('admin/dishes/addingredient/'.$id)->execute() ?>
		</div>
		<button onclick="add_ingred_in_dish(<?php echo $id; ?>)">add</button>
	<?php endif; ?>
	<div class="dashed"></div>
	<?php if($type == 'edit') : ?>
		<h3>add new group</h3>
		<div id="add_group_in_dish" style="display:inline-block;">
			<?php echo Request::factory('admin/groups/add/'.$id)->execute() ?>
		</div>
		<div class="clear"></div>
		<button onclick="add_group_in_dish(<?php echo $id; ?>)">add group</button>
		<div class="dashed"></div>
		<?php
			$dish_group = ORM::factory('group')->get_all_groups_in_dish($dish->id);
			if(count($dish_group) > 0) :
		?>
		<h3>groups in dish</h3>
			<?php foreach($dish_group as $group) : ?>
					<div id="edit_group_in_dish_<?php echo $group->id;?>" style="display:inline-block;">
						<?php echo Request::factory('admin/groups/edit/'.$group->id)->execute() ?>
					</div>
					<div class="dashed"></div>
			<?php endforeach;?>
		<?php endif;?>
	<?php endif; ?>
</div>


