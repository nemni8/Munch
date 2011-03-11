<?php $edit_id = ($type == 'edit') ? $id : NULL;?>
<div class="users">
	<?php echo Form::open('admin/users/add/'.$edit_id);?>
		<?php foreach( $arr_input as $input): ?>
			<div>
				<?php echo Form::label($input['col_name'],$input['title']);?>
				<?php
					$default = ($type == 'edit') ? $user->$input['col_name'] : NULL;
					if ($input['title'] == 'User Password')
						{
							$default = '';
						}

					echo Form::input($input['col_name'],$default);
				?>
			</div>
		<?php endforeach; ?>
		<?php if ($is_admin): ?>
			<?php echo Form::label('user_role_admin','Admin User');?>
			<?php echo form::checkbox('user_role_admin', 1,$flag_admin,array('id'=>'checkadmin','onclick' => 'admincheckbox()'));?>
			<div class="clear"></div>
			<?php echo Form::label('user_role_supadmin','Super Admin User');?>
			<?php echo Form::checkbox('user_role_supadmin', 1,$flag_supadmin,array('id'=>'checksupadmin','onclick' => 'supadmincheckbox()'));?>
		<?php endif;?>
		<div class="clear" ></div>
		<?php echo Form::submit('submit', $type)?>
	<?php echo Form::close();?>
</div>







