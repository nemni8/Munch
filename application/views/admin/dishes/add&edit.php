<?php $edit_id = ($type == 'edit') ? $id : NULL;?>
<div class="dialog"> 
	<!-- start of the form -->
	<?php echo Form::open('admin/dishes/create/'.$edit_id,array('id'=>'form_dish'));?>
		<!-- change user ID of A restaurant-->
		<?php foreach( $arr_input as $input): ?>
			<div>
				<?php if($input['title'] == 'Description') : ?>
					<?php echo Form::label('size_unit','Size Unit',array('class'=>'regular'));?>
					<?php $default = ($type == 'edit') ? $dish->size_unit : NULL; ?>
					<?php  echo Form::select('size_unit',Kohana::config ('global.unit_arr'),$default,array('class'=>'single_select'));?>
					<div class="clear" style="height: 12px;"></div>
					<?php  echo Form::label('category_id','Dish Category',array('class'=>'regular','style'=>'margin-bottom:12px; width:95%; '));?>
					<?php  $default = ($type == 'edit') ? $dish->categories->find_all()->as_array() : array() ; ?>
					<?php  echo Form::select('category_id[]',
												DB::select('id','name')
													->from('categories')
													->where('model','=','dish')
													->execute()->as_array('id','name'),$default,array('id'=>'dish_category'));?>
					<div class="clear" style="height: 12px;"></div>
					<?php $default = ($type == 'edit') ? $dish->restaurant_id : NULL; ?>
					<?php echo Form::label('restaurant_id','Restaurant',array('class'=>'regular'));?>
					<?php $rest_arr = $user->restaurants->find_all()->as_array('id','name');?>
					<?php if($is_sup) : ?>
						<?php $rest_arr = ORM::factory('restaurant')->find_all()->as_array('id','name');?>
					<?php endif; ?>
					<?php echo Form::select('restaurant_id',$rest_arr,$default,array('class'=>'single_select')); ?>
					<div class="clear" style="height: 12px;"></div>
					<?php echo Form::label('mdv','Dish Type',array('class'=>'regular'));?>
					<?php $default = ($type == 'edit') ? $dish->mdv : NULL; ?>
					<?php  echo Form::select('mdv',Kohana::config ('global.mdv'),$default,array('class'=>'single_select'));?>
					<div class="clear" style="height: 12px;"></div>
					<?php $default = ($type == 'edit') ? (bool)$dish->active : TRUE; ?>
					<?php echo Form::label('active','Active Dish',array('class'=>'regular','style'=>'margin-top:12px; width:95%;'));?>
					<div id="active_radio">
						<?php echo Form::radio('active',1, $default,array('id'=>'active_radio1'));?>
						<?php echo Form::label('active_radio1','yes');?>
						<?php echo Form::radio('active',0 , ! $default,array('id'=>'active_radio2'));?>
						<?php echo Form::label('active_radio2','no');?>
					</div>	
					<div class="clear" style="height: 12px;"></div>					
				<?php endif;?>
					<?php echo Form::label($input['col_name'],$input['title'],array('class'=>'regular'));?>
					<?php
						$default = ($type == 'edit') ? $dish->$input['col_name'] : NULL;
						switch ($input['type']) {
						case 'text':
							echo Form::input($input['col_name'],$default,array('class'=>'regular'));
							break;
						case 'textarea':
							echo Form::textarea($input['col_name'],$default,array('class'=>'regular'));
							break;
						case 'numeric':
							echo Form::select($input['col_name'],array(range(0,1000)),$default,array('class'=>'regular'));
							break;
					}
					?>			
			</div>
		<?php endforeach; ?>
		<!-- end of the form -->
	<?php echo Form::close();?>
	
	<?php if($type == 'edit') : ?>
		<div class="dashed"></div>
		<?php
			$dish_ingred = ORM::factory('dishesingredient')->get_all_ingredients_in_dish($dish->id);
			if(count($dish_ingred) > 0) :?>
				<h3>Ingredients in Dish</h3>
				<ul>
					<?php foreach($dish_ingred as $ingred) : ?>
						<li style="margin-bottom: 12px;">
							<div id="edit_ingred_in_dish_<?php echo $ingred->id;?>">
								<?php echo Request::factory('admin/dishes/editingredient/'.$ingred->id)->execute() ?>
							</div>
							<button class="submit" onclick="edit_ingred_in_dish(<?php echo $ingred->id;?>)">edit</button>
						</li>
					<?php endforeach;?>
				</ul>
				<div class="dashed"></div>
			<?php endif;?>
			<h3>Add new Ingredient</h3>
		<div id="add_ingred_in_dish">
			<?php echo Request::factory('admin/dishes/addingredient/'.$id)->execute() ?>
			<div class="clear"></div>
			<button class="submit" onclick="add_ingred_in_dish(<?php echo $id; ?>)">add</button>
		</div>
		
	<?php endif; ?> 
	
	<?php if($type == 'edit') : ?>
		<div class="dashed"></div>
			<h3>Add new Group</h3>
		<div id="add_group_in_dish">
			<?php echo Request::factory('admin/groups/add/'.$id)->execute() ?>
			<div class="clear"></div>
		<button class="submit" onclick="add_group_in_dish(<?php echo $id; ?>)">add group</button>
		</div>
		
		<div class="dashed"></div>
		<?php
			$dish_group = ORM::factory('group')->get_all_groups_in_dish($dish->id);
			if(count($dish_group) > 0) :
		?>
		<h3>Groups in Dish</h3>
			<?php foreach($dish_group as $group) : ?>
					<div id="edit_group_in_dish_<?php echo $group->id;?>">
						<?php echo Request::factory('admin/groups/edit/'.$group->id)->execute() ?>
					</div>
					<div class="dashed"></div>
			<?php endforeach;?>
		<?php endif;?>
	<?php endif; ?>
</div>



