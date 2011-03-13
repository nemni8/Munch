<div id="navigation" class="ui-accordion-header ui-helper-reset ui-state-default ui-state-active">
	<ul id="menu">
		<li style="margin-left:10px;">
			<?php echo html::anchor('admin','Home Page');?>
		</li>
		<?php if (isset($_SESSION['auth_user_munch'])) : ?>
			<li>
				<span>|</span>
				<?php echo html::anchor('admin/users/add/'.$_SESSION['auth_user_munch']->id,'Edit my profile');?>
			</li>
		<?php endif; ?>
		<?php if ( ! empty($is_supadmin)): ?>
			<li>
				<span>|</span>
				<?php echo html::anchor('admin/users/add','Add user');?>
			</li>
			<li>
				<span>|</span>
				<a id="add_restaurant_button">Add restaurant</a>
			</li>
			<li>
				<span>|</span>
				<?php echo html::anchor('admin/categories/add','Add category');?>
			</li>
		<?php endif;?>
		<?php if ( ! empty($is_admin)): ?>
			<li>
				<span>|</span>
				<?php echo html::anchor('admin/ingredients/add','Add ingredient');?>
			</li>
		<?php endif;?>
	</ul>
</div>
