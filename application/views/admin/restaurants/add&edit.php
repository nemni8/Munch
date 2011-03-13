<?php $edit_id = ($type == 'edit') ? $id : NULL;?>
<?php if(isset($errors))  echo 1 ; ?>
<div class="form_restaurant">
	<!-- start of the form -->
	<?php echo Form::open('admin/restaurants/create/'.$edit_id,array('id'=>'form_rest'));?>
		<!-- change user ID of A restaurant-->
    <?php $owner_id = ($type == 'edit') ? $rest->user_id : $edit_id;?>
		<?php if ($is_admin): ?>
			<?php echo Form::label('user_id','User Name');?>

			<?php  echo Form::select('user_id',$admins,$owner_id);?>

		<?php endif;?>
		<fieldset>
		<?php foreach( $arr_input as $input): ?>
			<div>
				<?php echo Form::label($input['col_name'],$input['title']);?>
				<?php
					$default = ($type == 'edit') ? $rest->$input['col_name'] : NULL;
					echo Form::input($input['col_name'],$default);
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



