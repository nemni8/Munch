<?php ;?>

<table align="center">
    <tr>
        <td>
            <div class="dashboard_rest" align="center">
                <?php if (count($user_rest) > 0): ?>
                    <h2>Restaurants</h2>
                    <?php echo Request::factory('admin/main/table/restaurant')->execute() ?>
                <?php endif;?>
            </div>
        </td>
        <td></td>
        <td>
             <div>
                <?php if(!empty($is_supadmin)): ?>
                    <h2 align="center">Users</h2>
                    <?php echo Request::factory('admin/main/table/user')->execute() ?>
                <?php endif ; ?>

            </div>
        </td>
</tr>
<tr> <!-- second row -->
    <td>
        <div class="dashboard_rest" align="center">
                <h2>Ingredients</h2>
                <?php echo Request::factory('admin/main/table/ingredient')->execute() ?>
        </div>
    </td>
    <td></td>
    <td>
         <div>
            <?php if(!empty($is_supadmin)): ?>
                <h2 align="center">Categories</h2>
                <?php echo Request::factory('admin/main/table/category')->execute() ?>
            <?php endif ; ?>

        </div>
    </td>
</tr>

</table>


