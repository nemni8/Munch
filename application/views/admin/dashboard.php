<?php if (count($user_rest) > 0): ?>
	<div class="dashboard">	
		<h2>Restaurants</h2>
		<?php echo Request::factory('admin/main/table/restaurant')->execute() ?>
	</div>
<?php endif ; ?>
<?php if(!empty($is_supadmin)): ?>
	<div class="dashboard">
		<h2>Users</h2>
		<?php echo Request::factory('admin/main/table/user')->execute() ?>
	</div>
<?php endif ; ?>
<?php if(!empty($is_supadmin)) : ?>
	<div class="dashboard">
		<h2>Ingredients</h2>
		<?php echo Request::factory('admin/main/table/ingredient')->execute() ?>
	</div>
<?php endif ; ?>
<?php if(!empty($is_supadmin)) : ?>
	<div class="dashboard">
		<h2>Categories</h2>
		<?php echo Request::factory('admin/main/table/category')->execute() ?>
		<h2>Group</h2>
		<?php echo Request::factory('admin/main/table/group')->execute() ?>
	</div>
<?php endif ; ?>
<div class="dashboard">
	<h2>Dish</h2>
	<?php echo Request::factory('admin/main/table/dish')->execute() ?>
</div>
<div class="clear"></div>


