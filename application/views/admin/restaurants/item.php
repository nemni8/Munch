<div class="restaurant">
	<div><?php echo $rest->name ?></div>
	<div><?php echo $rest->email ?></div>
	<div><?php echo $rest->phone ?></div>
	<div><?php echo Debug::vars($rest_arr) ?></div>
	<div><?php echo html::anchor(Request::factory('admin')
			->uri(array('controller' => 'main', 'action' => 'logout')), 'Logout') ?></div>
	<div>
		<h1>Items</h1>
		<?php foreach($items as $item): ?>
			<div><?php echo $item->id.'#&nbsp;'.$item->name ?></div>
		<?php endforeach; ?>
	</div>
</div>