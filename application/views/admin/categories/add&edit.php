<?php $edit_id = ($type == 'edit') ? $id : NULL;?>
<div class="dialog">
	<!-- start of the form -->
	<?php echo Form::open('admin/categories/create/'.$edit_id,array('id'=>'form_category'));?>
		<!-- change user ID of A restaurant-->
    <?php foreach( $arr_input as $input): //creating the form fields ?>
				<?php echo Form::label($input['col_name'],$input['title'],array('class'=>'regular')) ?> 
				<?php
					if(isset($errors)): // checking if the form has been returned with errors
						$default =  $_POST[$input['col_name']] ;
					else : // set the values to the fields accourding to the form type (add,edit)
                    $default = ($type == 'edit') ? $input['col_name'] : NULL;
					endif;
					echo Form::input($input['col_name'],$default,array('class'=>'regular'));
					if (isset($errors[$input['col_name']])) :?>
						<div class="validate">
							<?php echo $errors[$input['col_name']];?>
						</div>
					<?php endif;?>
		<?php endforeach; ?>
		<!-- choose categories models from the global.categories_models variable-->
		<?php echo Form::label('model','Model Category',array('class'=>'regular'));?>
		<?php $default = ($type == 'edit') ? $category->model : NULL; ?>
		<?php  echo Form::select('model',Kohana::config ('global.categories_models'),$default,array('class'=>'single_select'));?>

		<div class="clear"></div>
		<!-- end of the form -->
	<?php echo Form::close();?>
</div>



