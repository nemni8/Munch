<?php if (count($user_rest) > 0): ?>
	<div class="dashboard">	
		<h2>Restaurants</h2>
		<?php echo Request::factory('admin/main/table/restaurant')->execute() ?>
		<h2>Group</h2>
		<?php echo Request::factory('admin/main/table/group')->execute() ?>
	</div>
<?php endif ; ?>
<div class="dashboard">
	<h2>Dish</h2>
	<?php echo Request::factory('admin/main/table/dish')->execute() ?>
</div>

