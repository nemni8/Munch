<div class="dish_search">
	<?php echo Form::open(NULL,array('id'=>'dish_search_form'));?>
	<?php echo Form::Label('Dish Name');?>
	<?php echo Form::input('dish_name','',array('id'=>'dish_name','class'=>'dish_search_input'));?>
	<?php echo Form::Label('Max Price');?>
	<?php echo Form::select('max_price',array(range(0,90)),'',array('class'=>'dish_search_select')); ?>
	<?php echo Form::Label('Meat Or Dairy');?>
	<?php echo Form::select('mdv',Kohana::config ('global.mdv') ,'',array('class'=>'dish_search_select'));?>
	<?php echo Form::Label('Ingredient');?>
	<?php echo Form::input('auto_ingredient',NULL,array('class'=>'auto_ingredient dish_search_input')); ?>
	<div>
		<?php echo Form::label('category') ;?>
		<?php $arr_cat = array_merge($categories->as_array('id','name'));?>
		<?php echo Form::select('dish_category',$categories->as_array('id','name'),19,array('id'=>'kitchen_type' ,'class'=>'dish_search_select'));?>
	</div>
	<?php echo form::input('restaurant_id_dish_search',$rest_id,array('id'=>'restaurant_id_dish_search','hidden'=>'hidden'));?>
	<?php echo Form::close();?>
</div>
<div>
	<?php // echo view::factory('site\orders\my_order.php'); ?>
</div>
<div id='dish_container'>
	<?php echo Request::factory("admin/restaurants/dishsearch/".$rest_id)->execute(); ?>
</div>



