<?php $edit_id = ($type == 'edit') ? $id : NULL;?>
<div class="form_restaurant">
	<!-- start of the form -->
	<?php echo Form::open('admin/restaurants/create/'.$edit_id,array('id'=>'form_rest'));?>
		<!-- change user ID of A restaurant-->
    <?php $owner_id = ($type == 'edit') ? $rest->user_id : $edit_id;?>
		<?php if ($is_admin): ?>
			<?php echo Form::label('user_id','User Name');?>

			<?php  echo Form::select('user_id',$admins,$owner_id);?> <br/>

		<?php endif;?>
		<fieldset>
		<?php foreach( $arr_input as $input): //creating the form fields ?>
			<div>
				<?php echo Form::label($input['col_name'],$input['title']);
				if(isset($errors)): // checking if the form has been returned with errors
                    $default =  $_POST[$input['col_name']] ;
                    //$default = ( ! isset($errors[$input['col_name']])) ? $_POST[$input['col_name']] : NULL;

                else : // set the values to the fields accourding to the form type (add,edit)
                    $default = ($type == 'edit') ? $rest->$input['col_name'] : NULL;

                endif;
                switch ($input['type']) {
                    case 'text':
                        echo Form::input($input['col_name'],$default);
                        break;
                    case 'textarea':
                        echo Form::textarea($input['col_name'],$default);
                        break;
                    case 'numeric':
                        echo Form::select($input['col_name'],array(range(0,120)),$default);
                        break;

                }

                if (isset($errors[$input['col_name']])) :?>
                    <div>
                        <?php echo $errors[$input['col_name']];?>
                    </div><? endif;

                ?>
			</div>
		<?php endforeach; ?>
		</fieldset>
		<!-- choose kosher type from the global.kosher_level variable-->
		<?php echo Form::label('kosher_type','Kosher Type');?>
		<?php $default = ($type == 'edit') ? $rest->kosher_type : NULL; ?>
		<?php  echo Form::select('kosher_type',Kohana::config ('global.kosher_level'),$default);?>
		<div class="clear"></div>
		<!-- choose meat, dairy or parve kitchen from the global.kosher_level variable-->
		<?php echo Form::label('meat_dairy','Meat / Dairy');?>
		<?php $default = ($type == 'edit') ? $rest->meat_dairy : NULL; ?>
		<?php  echo Form::select('meat_dairy',Kohana::config ('global.meat_dairy'),$default);?>
		<div class="clear"></div>
		<?php if ($is_admin): ?>
			<?php  echo Form::label('category_id','Restaurant Category');?>
			<?php  $default = ($type == 'edit') ? $rest->categories->find_all()->as_array() : array() ; ?>
			<?php  echo Form::select('category_id[]',
										DB::select('id','name')
											->from('categories')
											->where('model','=','restaurant')
											->execute()->as_array('id','name'),$default);?>
            <div class="clear"></div>
            <?php  echo Form::label('active','Active');?>
            <?php $default = ($type == 'edit') ? $rest->active : NULL; ?>
            <?php  echo Form::select('active',Kohana::config ('global.active'),$default);?>
            <?php endif;?>
		<div class="clear"></div>
		<!-- end of the form -->
	<?php echo Form::close();?>
</div>



