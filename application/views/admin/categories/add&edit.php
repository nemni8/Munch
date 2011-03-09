<?php $edit_id = ($type == 'edit') ? $id : NULL;?>
<div class="categories">
	<!-- start of the form -->
	<?php echo Form::open('admin/categories/add/'.$edit_id);?>
		<!-- change user ID of A restaurant-->
		
		<?php foreach( $arr_input as $input): ?>
			<div>
				<?php echo Form::label($input['col_name'],$input['title']);?>
				<?php
					$default = ($type == 'edit') ? $category->$input['col_name'] : NULL;
					echo Form::input($input['col_name'],$default);
				?>
			</div>
		<?php endforeach; ?>
		<!-- choose categories models from the global.categories_models variable-->
		<?php echo Form::label('model','Model Category');?>
		<?php $default = ($type == 'edit') ? $category->model : NULL; ?>
		<?php  echo Form::select('model',Kohana::config ('global.categories_models'),$default);?>
		<div class="clear"></div>
		<!-- end of the form -->
		<?php echo Form::submit('submit', $type)?>
	<?php echo Form::close();?>
</div>



