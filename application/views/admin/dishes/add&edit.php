<?php $edit_id = ($type == 'edit') ? $id : NULL;?>
<div class="dish">
	<!-- start of the form -->
	<?php echo Form::open('admin/dishes/add/'.$edit_id);?>
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
		
		<div class="clear"></div>
		<!-- end of the form -->
		<?php echo Form::submit('submit', $type)?>
	<?php echo Form::close();?>
</div>
