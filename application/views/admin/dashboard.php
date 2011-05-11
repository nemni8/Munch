<?php if (count($user_rest) > 0): ?>
	<div class="dashboard ui-state-active">
		<?php echo Request::factory('admin/main/table/restaurant')->execute() ?>
	</div>
<?php endif ; ?>
<?php if(!empty($is_supadmin)): ?>
	<div class="dashboard ui-state-active">
		<?php echo Request::factory('admin/main/table/user')->execute() ?>
	</div>
<?php endif ; ?>
<?php if(!empty($is_supadmin)) : ?>
	<div class="dashboard ui-state-active">
		<?php echo Request::factory('admin/main/table/ingredient')->execute() ?>
	</div>
<?php endif ; ?>
<?php if(!empty($is_supadmin)) : ?>
	<div class="dashboard ui-state-active">
		<?php echo Request::factory('admin/main/table/category')->execute() ?>
	</div>
	<div class="dashboard ui-state-active">
		<?php echo Request::factory('admin/main/table/group')->execute() ?>
	</div>
<?php endif ; ?>
<div class="dashboard ui-state-active">
	<?php echo Request::factory('admin/main/table/dish')->execute() ?>
</div>
<div class="clear"></div>


