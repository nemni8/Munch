<?php if (count($user_rest) > 0): ?>
<h2>List Of My Restaurant</h2>
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
	<h2>You Don't Have Any Restaurant At our system </h2>
<?php endif;?>
<?php if(!empty($is_supadmin)): ?>

	<h2>List Of All Users</h2>

	<ul class="dashbord_user">
		<?php foreach($all_users as $user) { ?>
				<li><?php echo html::anchor('admin/users/add/'.$user->id,'edit '.$user->username); ?></li>
				<li><?php echo $user->email; ?></li>
		<?php } ?>
	</ul>
    <h2>List Of All Ingredients</h2>
    <table class="dashbord_ingredients" border="0">
		<?php foreach($all_ingredients as $ingredient) { ?>
            <tr>
            		<td><?php echo $ingredient->name?></td>
                    <td><?php echo html::anchor('admin/ingredients/add/'.$ingredient->id,'edit'); ?></td>
					<td><?php echo html::anchor('admin/ingredients/delete/'.$ingredient->id,'delete'); ?></td>
			</tr>
		<?php } ?>
	</table>
	<h2>List Of All Ingredients Categories</h2>
	<table class="dashbord_ingredient_categories" border="0">
		<?php foreach($all_ingredient_categories as $ingredient_category) { ?>
				<tr>
					<td><?php echo $ingredient_category->name?></td>
					<td><?php echo html::anchor('admin/categories/add/'.$ingredient_category->id,'edit'); ?></td>
					<td><?php echo html::anchor('admin/categories/delete/'.$ingredient_category->id,'delete'); ?></td>

				</tr>
		<?php } ?>

	</table>
	<h2>List Of All Restaurants Categories</h2>
	<table class="dashbord_ingredient_categories" border="0">
    <?php foreach($all_restaurant_categories as $restaurant_category) { ?>
        <tr>
            <td><?php echo $restaurant_category->name?></td>
            <td><?php echo html::anchor('admin/categories/add/'.$restaurant_category->id,'edit'); ?></td>
            <td><?php echo html::anchor('admin/categories/delete/'.$restaurant_category->id,'delete'); ?></td>

        </tr>

    <?php } ?>
    </table>


<?php endif;?>

<?php if (( empty($is_supadmin))and (! empty($is_admin))): ?>
    <h2>List Of All Ingredients Visible For <?php echo ' '.$username ?></h2>
            <table class="dashbord_ingredients" border="0">
            <?php foreach($all_ingredients as $ingredient) { ?>
                    <tr>
                    <td><?php echo '  '.$ingredient->name ?></td>
                    </tr>
            <?php } ?>
        </table>
<?php endif;?>
<div class="clear"></div>
<div id="dialog_form_restaurant" title="Create new restaurant">
	<?php  // echo Request::factory('admin/restaurants/add')->execute();?>
</div>
<div><?php echo Form::button('add_restaurant','Add Restaurant',array('id'=>'add_restaurant_button'));?></div>


