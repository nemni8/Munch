<?php $edit_id = ($type == 'edit') ? $id : NULL;?>
<div class="ingredient_dish">
	<!-- start of the form -->
	<?php echo Form::open('admin/ingredients_dishes/add/'.$edit_id);?>
		<!-- change user ID of A restaurant-->



            <?php echo Form::label('basic_optional','Basic Or Optional');?>
		    <?php $default = ($type == 'edit') ? $ingredient_dish->basic_optional : NULL; ?>
		    <?php  echo Form::select('mdv',Kohana::config ('global.basic_optional'),$default);?>

		<div class="clear"></div>
		<!-- end of the form -->
		<?php echo Form::submit('submit', $type)?>
	<?php echo Form::close();?>
</div>
