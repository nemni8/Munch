<?php $edit_id = ($type == 'edit') ? $id : NULL;?>
<div class="dialog">
	<!-- start of the form -->
	<?php echo Form::open('admin/restaurants/create/'.$edit_id,array('id'=>'form_rest'));?>
		<!-- change user ID of A restaurant-->
    <?php $owner_id = ($type == 'edit') ? $rest->user_id : $edit_id;?>
		<?php if ($is_admin): ?>
			<?php echo Form::label('user_id','User Name',array('class'=>'regular'));?>
			<?php  echo Form::select('user_id',$admins,$owner_id,array('class'=>'single_select'));?>
			<div class="clear" style="height: 12px"></div>
		<?php endif;?>
		<?php foreach( $arr_input as $input): //creating the form fields ?>
			<?php if($input['title'] == 'Street Num') : ?>
				<div class="clear" style="height: 12px"></div>
				<?php echo Form::label('kosher_type','Kosher Type',array('class'=>'regular'));?>
				<?php $default = ($type == 'edit') ? $rest->kosher_type : NULL; ?>
				<?php  echo Form::select('kosher_type',Kohana::config ('global.kosher_level'),$default,array('class'=>'single_select'));?>
				<div class="clear" style="height: 12px"></div>
				<!-- choose meat, dairy or parve kitchen from the global.kosher_level variable-->
				<?php echo Form::label('meat_dairy','Meat / Dairy',array('class'=>'regular'));?>
				<?php $default = ($type == 'edit') ? $rest->meat_dairy : NULL; ?>
				<?php  echo Form::select('meat_dairy',Kohana::config ('global.meat_dairy'),$default,array('class'=>'single_select'));?>
				<div class="clear" style="height: 12px"></div>
				<?php if ($is_admin): ?>
					<?php  echo Form::label('category_id','Restaurant Category',array('class'=>'regular'));?>
					<?php  $default = ($type == 'edit') ? $rest->categories->find_all()->as_array() : array() ; ?>
					<?php  echo Form::select('category_id[]',
												DB::select('id','name')
													->from('categories')
													->where('model','=','restaurant')
													->execute()->as_array('id','name'),$default,array('id'=>'rest_category'));?>
					<div class="clear" style="height: 12px"></div>
					<?php  echo Form::label('active','Active',array('class'=>'regular'));?>
					<?php $default = ($type == 'edit') ? $rest->active : NULL; ?>
					<?php  echo Form::select('active',Kohana::config ('global.active'),$default,array('class'=>'single_select'));?>
					<div class="clear" style="height: 12px"></div>
				<?php endif;?>
                <div class="clear" style="height: 12px"></div>
				<?php echo Form::label('city_name','City',array('class'=>'regular'));?>
				<?php $default = ($type == 'edit') ? orm::factory('city',$rest->city_id)->name : NULL; ?>
				<?php  echo Form::input('city_name',$default
                                         ,array('id'=>'city_name','class'=>'auto_city'));?>
                <div class="clear" style="height: 12px"></div>
                <?php if (isset($errors['city_id'])) :?>
						<div class="validate">
							<?php echo $errors['city_id'];?>
						</div>
                <?php endif;?>

				<?php echo Form::label('street_name','Street',array('class'=>'regular'));?>
				<?php $default = ($type == 'edit') ? orm::factory('street',$rest->street_id)->name : NULL; ?>
				<?php  echo Form::input('street_name',
												$default,array('id'=>'street_name','class'=>'auto_street'));?>
                <div class="clear" style="height: 12px"></div>
                <?php if (isset($errors['street_id'])) :?>
						<div class="validate">
							<?php echo $errors['street_id'];?>
						</div>
                <?php endif;?>

			<?php endif;?>
				<?php echo Form::label($input['col_name'],$input['title'],array('class'=>'regular',));
				if(isset($errors)): // checking if the form has been returned with errors
                    $default =  $_POST[$input['col_name']] ;
                    //$default = ( ! isset($errors[$input['col_name']])) ? $_POST[$input['col_name']] : NULL;

                else : // set the values to the fields accourding to the form type (add,edit)
                    $default = ($type == 'edit') ? $rest->$input['col_name'] : NULL;

                endif;
                switch ($input['type']) {
                    case 'text':
                        echo Form::input($input['col_name'],$default,array('class'=>'regular'));
                        break;
                    case 'textarea':
                        echo Form::textarea($input['col_name'],$default,array('class'=>'regular'));
                        break;
                    case 'numeric':
                        echo Form::select($input['col_name'],array(range(0,120)),$default,array('class'=>'regular'));
                        break;

                }
					?>
					<?php if (isset($errors[$input['col_name']])) :?>
						<div class="validate">
							<?php echo $errors[$input['col_name']];?>
						</div>
					<?php endif;?>
		<?php endforeach; ?>
		<div class="clear"></div>
		<!-- end of the form -->
	<?php echo Form::close();?>
</div>



