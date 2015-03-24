<?php $edit_id = ($type == 'edit') ? $id : NULL;?>

<div class="dialog">
	<!-- start of the form -->
	<?php echo Form::open('admin/ingredients/create/'.$edit_id,array('id'=>'form_ingredient'));?>
		<?php foreach( $arr_input as $input): //creating the form fields ?>
			<?php if($input['title'] == 'Ingredient Description') : ?>
				<?php if($admin_level) : ?>
					<?php  echo Form::label('category_id','Ingredient Category');?><br />
					<?php  $default = ($type == 'edit') ? $ingredient->categories->find_all()->as_array() : array() ; ?>
					<?php  echo Form::select('category_id[]',
												DB::select('id','name')->from('categories')->where('model','=','ingredient')->execute()->as_array('id','name'),
												$default,array('id'=>'ingredient_category'));?>
				<?php endif;?>
			<?php endif;?>
				<?php echo Form::label($input['col_name'],$input['title'],array('class'=>'regular'));?> <?php
				if(isset($errors)): // checking if the form has been returned with errors
                    $default =  $_POST[$input['col_name']] ;
                    //$default = ( ! isset($errors[$input['col_name']])) ? $_POST[$input['col_name']] : NULL;

                else : // set the values to the fields accourding to the form type (add,edit)
                    $default = ($type == 'edit') ? $ingredient->$input['col_name'] : NULL;
                endif;
						switch ($input['type']) {
						case 'text':
							echo Form::input($input['col_name'],$default,array('class'=>'regular'));
							break;
						case 'textarea':
							echo Form::textarea($input['col_name'],$default,array('class'=>'regular'));
							break;
						case 'numeric':
							echo Form::select($input['col_name'],array(range(0,1000)),$default,array('class'=>'regular'));
							break;
					}
					
                if (isset($errors[$input['col_name']])) : ?>
                    <div class="validate">
                        <?php echo $errors[$input['col_name']];?>
                    </div><?php endif;?>
		<?php endforeach; ?>
		
		<div class="clear"></div>
		<!-- end of the form -->
		

	<?php echo Form::close();?>
</div>




