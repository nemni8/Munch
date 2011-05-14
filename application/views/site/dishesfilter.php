<div class="rest_search">
	<div align="center"><h2 style="color:#62BBE8;margin:0">Find A Dish In The Menu</h2></div>
	<div class="dashed"></div>
	<div class="clear" style="height:20px"></div>
	<?php echo Form::open(NULL,array('id'=>'dish_search_form'));?>
	<div style="width:46%;float:left;display:inline; padding-left:20px">
		<?php echo view::factory('site\orders\cart.php')
				->set('from_dish',0)
				->set('current_dish_id',0)
				->set('current_rest_id',$rest_id); ?>
	</div>
	<div style="width:48%;float:left;display:inline; padding-left:20px">
		<?php echo Form::Label('Dish Name');?>
		<?php echo Form::input('dish_name','',array('id'=>'dish_name','class'=>'dish_search_input '));?>
		<div class="clear" style="height:10px"></div>
		<?php echo Form::Label('Ingredient');?>
		<?php echo Form::input('auto_ingredient',NULL,array('class'=>'auto_ingredient dish_search_input')); ?>
		<div class="clear" style="height:10px"></div>
		<?php echo Form::Label('max_price','Max Price',array('class'=>'label_search_rest'));?>
		<?php echo Form::select('max_price',array_merge(array(''=>''),array(range(0,90))),NULL,array('class'=>'dish_search_select rest_search_select')); ?>
		<div class="clear" style="height:10px"></div>
		<?php echo Form::Label('mdv','Meat Or Dairy',array('class'=>'label_search_rest'));?>
		<?php echo Form::select('mdv',Kohana::config ('global.mdv') ,'',array('class'=>'dish_search_select rest_search_select'));?>
		<div class="clear" style="height:10px"></div>
		<?php echo Form::label('dish_category','category',array('class'=>'label_search_rest')) ;?>
		<?php $arr_cat = array_merge($categories->as_array('id','name'));?>
		<?php echo Form::select('dish_category',$categories->as_array('id','name'),19,array('id'=>'kitchen_type' ,'class'=>'dish_search_select rest_search_select'));?>
		<div class="clear" style="height:10px"></div>

	</div>

	<?php echo form::input('restaurant_id_dish_search',$rest_id,array('id'=>'restaurant_id_dish_search','hidden'=>'hidden'));?>
	<?php echo Form::close();?>
</div>
<div class="clear" style="height:10px"></div>
<div class="dashed"></div>
<div class="clear" style="height:20px"></div>
<div id='dish_container'>
	<?php echo Request::factory("admin/restaurants/dishsearch/".$rest_id)->execute(); ?>
</div>



