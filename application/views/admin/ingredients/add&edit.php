<?php $edit_id = ($type == 'edit') ? $id : NULL;?>
<div class="ingredient">
	<!-- start of the form -->
	<?php echo Form::open('admin/ingredients/add/'.$edit_id);?>
		<!-- change user ID of A restaurant-->
		
		<?php foreach( $arr_input as $input): ?>
			<div>
				<?php echo Form::label($input['col_name'],$input['title']);?>
				<?php
					$default = ($type == 'edit') ? $ingredient->$input['col_name'] : NULL;
					echo Form::input($input['col_name'],$default);
				?>
			</div>
		<?php endforeach; ?>
		<!-- choose meat, dairy or parve kitchen from the global.kosher_level variable-->
		<?php echo Form::label('meat_dairy','Meat / Dairy');?>
		<?php $default = ($type == 'edit') ? $ingredient->mdv : NULL; ?>
		<?php  echo Form::select('mdv',Kohana::config ('global.meat_dairy'),$default);?>
		<div class="clear"></div>
		<!-- end of the form -->
		<?php echo Form::submit('submit', $type)?>
	<?php echo Form::close();?>
</div>



