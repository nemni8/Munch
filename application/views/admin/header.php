<div class="header">
	<h1>This Is The Header</h1>
	<?php echo html::anchor('admin','Home Page');?>
	<?php if ( ! empty($is_admin)): ?>
		<div>
			<?php echo html::anchor(Request::factory('admin')
			->uri(array('controller' => 'main', 'action' => 'logout')), 'Logout'); ?>
		</div>
		<div>
			<?php echo 'hello admin '.$username ?>
		</div>
		<?php if ( ! empty($is_supadmin)): ?>
			<div>
				<?php echo 'you are a super admin'?>
			</div>
		<?php endif;?>
	<?php endif; ?>
</div>
 
