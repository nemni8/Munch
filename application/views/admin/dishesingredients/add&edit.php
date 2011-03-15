<?php $edit_id = ($type == 'edit ingredient') ? $id : NULL;?>
<div class="dish_ingredient">
	<!-- start of the form -->
	<?php echo Form::open('admin/dishes/createingredient/'.$edit_id,array('id'=>'form_dish_ingredient'));?>
		<!-- change user ID of A restaurant-->
            <?php echo Form::label('basic_optional','Basic Or Optional');?>
		    <?php $default = ($type == 'edit') ? $dishesingredient->basic_optional : NULL; ?>
		    <?php  echo Form::select('mdv',Kohana::config ('global.basic_optional'),$default);?>

		<div class="clear"></div>
		<!-- end of the form -->
		<?php echo Form::submit('submit', $type)?>
	<?php echo Form::close();?>
</div>
