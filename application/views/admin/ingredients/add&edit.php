<?php $edit_id = ($type == 'edit') ? $id : NULL;?>
<div class="ingredient">
	<!-- start of the form -->
	<?php echo Form::open('admin/ingredients/create/'.$edit_id,array('id'=>'form_ingredient'));?>
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
		<?php if($admin_level) : ?>
			<?php  echo Form::label('category_id','Ingredient Category');?>
			<?php  $default = ($type == 'edit') ? $ingredient->categories->find_all()->as_array() : array() ; ?>
			<?php  echo Form::select('category_id[]',
										DB::select('id','name')
											->from('categories')
											->where('model','=','ingredient')
											->execute()->as_array('id','name'),$default);
			?>
		<?php endif;?>
		<div class="clear"></div>
		<!-- end of the form -->
	<?php echo Form::close();?>
</div>




