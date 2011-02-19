<div id="login">
	<h1>כניסה לאתר</h1>

	<?php echo form::open('admin/main/login', array('class' => 'recover')) ?>

		<?php include Kohana::find_file('views', 'blocks/errors') ?>
		<fieldset>
			<div class="line" style="width: 160px">
				<?php echo form::label('username', 'כתובת דוא"ל') ?>
				<?php echo form::input('username', isset($post['username']) ? $post['username'] : NULL, array('id'=>'username')) ?>
			</div>
			<div class="line" style="width: 160px">
				<?php echo form::label('password', 'סיסמא') ?>
				<?php echo form::password('password', isset($post['password']) ? $post['password'] : NULL, array('id'=>'password')) ?>
			</div>
			<div class="line">
				<?php echo form::checkbox('remember', 'TRUE', FALSE, array('id'=>'remember','class'=>'auto')) ?>
				<?php echo form::label('remember', 'זכור אותי') ?>
			</div>
			<div class="line controls">
				<?php echo form::button(NULL, 'כניסה למערכת', array('type' => 'submit', 'style' => 'width:110px;')) ?>
			</div>
		</fieldset>

	<?php echo form::close() ?>

</div>