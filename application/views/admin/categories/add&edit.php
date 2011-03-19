<?php $edit_id = ($type == 'edit') ? $id : NULL;?>
<div class="form_category">
	<!-- start of the form -->
	<?php echo Form::open('admin/categories/create/'.$edit_id,array('id'=>'form_category'));?>
		<!-- change user ID of A restaurant-->
    <?php foreach( $arr_input as $input): //creating the form fields ?>
			<div>
				<?php echo Form::label($input['col_name'],$input['title']);
				if(isset($errors)): // checking if the form has been returned with errors
                    $default =  $_POST[$input['col_name']] ;
                    //$default = ( ! isset($errors[$input['col_name']])) ? $_POST[$input['col_name']] : NULL;

                else : // set the values to the fields accourding to the form type (add,edit)
                    $default = ($type == 'edit') ? $dish->$input['col_name'] : NULL;

                endif;
                echo Form::input($input['col_name'],$default);
                if (isset($errors[$input['col_name']])) :?>
                    <div>
                        <?php echo $errors[$input['col_name']];?>
                    </div><? endif;

                ?>
			</div>
		<?php endforeach; ?>
		<!-- choose categories models from the global.categories_models variable-->
		<?php echo Form::label('model','Model Category');?>
		<?php $default = ($type == 'edit') ? $category->model : NULL; ?>
		<?php  echo Form::select('model',Kohana::config ('global.categories_models'),$default);?>

		<div class="clear"></div>
		<!-- end of the form -->
	<?php echo Form::close();?>
</div>



