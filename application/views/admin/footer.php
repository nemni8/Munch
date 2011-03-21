<div id="footer">
	<div id="inner_footer" class="ui-accordion-header ui-helper-reset ui-state-default ui-state-active">
		<h3 align="center">This Is The Footer</h3>
	</div>
	<div id="form_dialog_rest" title="Restaurant Details"></div>
    <div id="form_dialog_user" title="User Details"></div>
	<div id="form_dialog_category" title="Category Details"></div>
    <div id="form_dialog_ingredient" title="Ingredient Details"></div>
	<div id="form_dialog_dish" title="Dish Details"></div>
	<?php echo Form::input('id_of_rest',0,array('id'=>'id_of_rest','type'=>'hidden'));?>
    <?php echo Form::input('id_of_user',0,array('id'=>'id_of_user','type'=>'hidden'));?>
	<?php echo Form::input('id_of_category',0,array('id'=>'id_of_category','type'=>'hidden'));?>
    <?php echo Form::input('id_of_ingredient',0,array('id'=>'id_of_ingredient','type'=>'hidden'));?>
	<?php echo Form::input('id_of_dish',0,array('id'=>'id_of_dish','type'=>'hidden'));?>

</div>