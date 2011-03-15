<?php $edit_id = ($type == 'edit') ? $id : NULL;?>
<div class="dish">
	<!-- start of the form -->
	<?php echo Form::open('admin/dishes/create/'.$edit_id,array('id'=>'form_dish'));?>
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

            <?php echo Form::label('mdv','Dish Type');?>
		    <?php $default = ($type == 'edit') ? $dish->mdv : NULL; ?>
		    <?php  echo Form::select('mdv',Kohana::config ('global.mdv'),$default);?>
            <?php  echo Form::label('category_id','Dish Category');?>
			<?php  $default = ($type == 'edit') ? $dish->categories->find_all()->as_array() : array() ; ?>
			<?php  echo Form::select('category_id[]',
										DB::select('id','name')
											->from('categories')
											->where('model','=','dish')
											->execute()->as_array('id','name'),$default);?>

		<div class="clear"></div>
		<!-- end of the form -->
		<?php echo Form::submit('submit', $type)?>
	<?php echo Form::close();?>
    
</div>
