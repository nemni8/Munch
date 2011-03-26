<?php $edit_id = ($type == 'edit') ? $id : NULL;?>
<div class="dialog">
	<!-- start of the form -->
	<?php echo Form::open('admin/dishes/createingredient/'.$edit_id,array('id'=>'form_dish_ingredient_'.$edit_id));?>
		<!-- choose ingred from all ingred list-->
		<?php $label = ($type == 'edit') ? '' : 'Choose ingredient' ;?>
		<?php echo Form::label('ingredient_id',$label);?>
		<?php
			$default = ($type == 'edit') ? $dishesingredient->ingredient_id : NULL;
			$attr = ($type == 'edit') ? array('disabled' => 'disabled') : array();
		?>
		<?php $list_of_ingred = ORM::factory('ingredient')->get_all_ingredients()->as_array('id','name');?>
		<?php  echo Form::select('ingredient_id',$list_of_ingred, $default,$attr);?>
		<?php if($type == 'add') : ?>
			<div class="clear" style="height: 12px;"></div>
		<?php endif;?>
		<!-- choose is basic ingred -->
		<?php echo Form::label('basic_optional','Basic/Optional');?>
		<?php $default = ($type == 'edit') ? $dishesingredient->basic_optional : NULL; ?>
		<?php  echo Form::select('basic_optional',Kohana::config ('global.basic_optional'),$default);?>
		<div class="clear" style="height: 12px"></div>
		<?php $default = ($type == 'edit') ? $dishesingredient->dish_id : $_SESSION['dish_id']; ?>
		<?php echo Form::input('dish_id',$default, array('type'=>'hidden')); ?>
		<!-- end of the form -->
	<?php echo Form::close();?>
</div>


