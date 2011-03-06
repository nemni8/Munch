<?php if ( ! empty($is_supadmin)): ?>
	<?php echo html::anchor('admin/restaurants/add','add restaurant');?> |
	<?php echo html::anchor('admin/users/add','add user');?> |
<?php endif;?>
<?php echo html::anchor('admin/users/add/'.$_SESSION['auth_user_munch']->id,'Edit my profile');?>
<?php if (count($user_rest) > 0): ?>
<h1>List Of My Restaurant</h1>
<ul class="dashbord_rest">
	<?php foreach($user_rest as $rest) { ?>
			<li><?php echo html::anchor('admin/restaurants/add/'.$rest->id,'edit '.$rest->name); ?></li>
			<li><?php echo $rest->user_id; ?></li>
			<li><?php echo $rest->name; ?></li>
			<li><?php echo $rest->email; ?></li>
			<li><?php echo $rest->phone; ?></li>
	<?php } ?>
</ul>
<?php else : ?>
	<h1>You Don't Have Any Restaurant At our system </h1>
<?php endif;?>
<?php if ( ! empty($is_supadmin)): ?>
	<h1>List Of All Users</h1>
	<ul class="dashbord_rest">
		<?php foreach($all_users as $user) { ?>
				<li><?php echo html::anchor('admin/restaurants/add/'.$user->id,'edit '.$user->username); ?></li>
				<li><?php echo $user->email; ?></li>
		<?php } ?>
	</ul>	
<?php endif;?>
<div class="clear"></div>

