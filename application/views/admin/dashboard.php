<?php if (count($user_rest) > 0): ?>
<h2>List Of My Restaurant</h2>
<ul class="dashboard_rest">
	<?php foreach($user_rest as $rest) { ?>
			<li>
				<a class="form_rest_links" onclick="id_assigner(<?php echo $rest->id. ",'rest'" ?>),true"><?php echo 'edit '.$rest->name?></a>
			</li>
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
	<h2>List Of All dishes</h2>
	<ul class="dashboard_dish">
		<?php foreach($all_dishes as $dish) { ?>
			<li>
				<a class="form_dish_links" onclick="id_assigner(<?php echo $dish->id. ",'dish'" ?>),true"><?php echo 'edit '.$dish->name?></a>
			</li>
		<?php } ?>
	</ul>

	<h2>List Of All Users</h2>

	<ul class="dashboard_user">
		<?php foreach($all_users as $user) { ?>
				<li>
                	<a class="form_user_links" onclick="id_assigner(<?php echo $user->id. ",'user'" ?>),true"><?php echo 'edit '.$user->username?></a>
                </li>
				<li><?php echo $user->email; ?></li>
		<?php } ?>
	</ul>
    <h2>List Of All Ingredients</h2>
    <table class="dashboard_ingredients" border="0">
		<?php foreach($all_ingredients as $ingredient) { ?>
            <tr>
            		<td><?php echo $ingredient->name?></td>
                    <td><?php echo html::anchor('admin/ingredients/edit/'.$ingredient->id,'edit'); ?></td>
					<td><?php echo html::anchor('admin/ingredients/delete/'.$ingredient->id,'delete'); ?></td>
			</tr>
		<?php } ?>
	</table>
	<h2>List Of All Ingredients Categories</h2>
	<table class="dashboard_ingredient_categories" border="0">
		<?php foreach($all_ingredient_categories as $ingredient_category) { ?>
				<tr>
					<td><?php echo $ingredient_category->name?></td>
					<td><?php echo html::anchor('admin/categories/edit/'.$ingredient_category->id,'edit'); ?></td>
					<td><?php echo html::anchor('admin/categories/delete/'.$ingredient_category->id,'delete'); ?></td>

				</tr>
		<?php } ?>

	</table>
	<h2>List Of All Restaurants Categories</h2>
	<table class="dashboard_ingredient_categories" border="0">
    <?php foreach($all_restaurant_categories as $restaurant_category) { ?>
        <tr>
            <td><?php echo $restaurant_category->name?></td>
            <td><?php echo html::anchor('admin/categories/edit/'.$restaurant_category->id,'edit'); ?></td>
            <td><?php echo html::anchor('admin/categories/delete/'.$restaurant_category->id,'delete'); ?></td>

        </tr>

    <?php } ?>
    </table>
    <h2>List Of All Dish Categories</h2>
	<table class="dashboard_dish_categories" border="0">
    <?php foreach($all_dish_categories as $dish_category) { ?>
        <tr>
            <td><?php echo $dish_category->name?></td>
            <td><?php echo html::anchor('admin/categories/edit/'.$dish_category->id,'edit'); ?></td>
            <td><?php echo html::anchor('admin/categories/delete/'.$dish_category->id,'delete'); ?></td>

        </tr>
    <?php } ?>
    </table>
<?php endif;?>
<?php if (( empty($is_supadmin))and (! empty($is_admin))) : ?>
    <h2>List Of All Ingredients Visible For <?php echo ' '.$username ?></h2>
            <table class="dashboard_ingredients" border="0">
            <?php foreach($all_ingredients as $ingredient) : ?>
                    <tr>
                    	<td><?php echo '  '.$ingredient->name ?></td>
                    </tr>
            <?php endforeach; ?>
        </table>
<?php endif;?>
<div class="clear"></div>



