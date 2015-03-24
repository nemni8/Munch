<?php $edit_id = ($type == 'edit') ? $id : NULL;?>
<div class="dialog">
	<?php echo Form::open('admin/users/create/'.$edit_id,array('id'=>'form_user'));?>
    <?php foreach( $arr_input as $input): //creating the form fields ?>
			<?php echo Form::label($input['col_name'],$input['title'],array('class'=>'regular'));?>
			
			<?php 
			if(isset($errors)): // checking if the form has been returned with errors
				if ($input['type']!='password'):
					$default =  $_POST[$input['col_name']] ;
				endif;
			else : // set the values to the fields accourding to the form type (add,edit)
				if ($input['type']!='password'):
					$default = ($type == 'edit') ? $user->$input['col_name'] : NULL;
				endif;
			endif;
			switch ($input['type']) {
				case 'text':
					echo Form::input($input['col_name'],$default,array('class'=>'regular'));
					break;
				case 'password':
					echo Form::password($input['col_name'],array('class'=>'regular'));
					break;


			}
			if (isset($errors[$input['col_name']])) :?>
				<div class="validate">
					<?php echo $errors[$input['col_name']];?>
				</div>
			<?php endif;?>
			<?php if (isset($errors['_external'][$input['col_name']])) :?>
				<div class="validate">
					<?php echo $errors['_external'][$input['col_name']];?>
				</div>
			<?php endif;?>
			<div class="clear" style="height: 12px;"></div>
		<?php endforeach; ?>
		<?php if ($is_admin): ?>
			<?php echo Form::label('user_role_admin','Admin User');?>
			<?php echo form::checkbox('user_role_admin', 1,$flag_admin,array('id'=>'checkadmin','onclick'=>'checkadminfunction()'));?>
			<div class="clear" style="height: 12px;"></div>
			<?php echo Form::label('user_role_supadmin','Super Admin User');?>
			<?php echo Form::checkbox('user_role_supadmin', 1,$flag_supadmin,array('id'=>'checksupadmin','onclick'=>'checksupadminfunction()'));?>
		<?php endif;?>
		<div class="clear" ></div>		
	<?php echo Form::close();?>
</div>







