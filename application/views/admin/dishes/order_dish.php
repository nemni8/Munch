<div align="center"  class="order_left_div">
	<div class="border">
		<div class="dish_image">
			<div class="border">
				<?php echo html::image('media/images/dish_icon.png', array('alt' => $dish->name,'class'=>'image'));?>
			</div>
		</div>
	</div>
	<div class="dashed"></div>
	<div>
		<?php echo view::factory('site\orders\my_order.php'); ?>
	</div>	
</div>
<div class="order_right_div">
    <?php $edit_id= ($type=='edit') ? '/'.$ordersdish->id :NULL;?>
	<?php echo Form::open('main/dishordercreate/'.$dish->id.$edit_id,array('id'=>'form_dishorder'));?>
    <h1 align="center" style="margin-top:0px;"><?php echo $dish->name ;?></h1>
	<h3>dish description</h3>
	<p class ="description">
		<?php echo $dish->description ;?>
	</p>
	<span><?php echo 'price: '.$dish->price;?> NIS</span>
	<h3>basic ingredient in dish</h3>
	<div class="">
		<?php foreach($dish->ingredients->find_all() as $ingred) : ?>
			<?php if( ! $ingred->get_basic_optional_in_dish($dish->id)) : ?>
				<?php echo $ingred->name; ?>
				<p class ="description">
					<?php echo $ingred->description ;?>
				</p>
				<br/>
			<?php endif; ?>
		<?php endforeach;?>
	</div>
	<h3>optional ingredient in dish</h3>
	<div class="">
		<?php foreach($dish->ingredients->find_all() as $ingred) : ?>
		<?php $default = NULL ; ?>
                <?php if ($type=='edit'):;?>
                    <?php $default = $ordersdish->is_ingredient_in_order_dish($ingred->id) ?>
                <?php endif ; ?>
        <?php if($ingred->get_basic_optional_in_dish($dish->id)) : ?>
                <?php echo Form::checkbox('ingredient',$ingred->id,$default,array('class'=>'order_dish_ingredients'));?>
                <?php echo $ingred->name; ?>
				<p class ="description">
					<?php echo $ingred->description ;?>
				</p>
				<br/>
        <?php endif; ?>
		<?php endforeach;?>
	</div>
	<h3>basic groups in dish</h3>
	<?php $group_basic_str = "" ; ?>
	<?php foreach($dish->groups->find_all() as $group) : ?>
		<?php if( ! $group->basic_optional): ?>
			<?php $group_basic_str = $group_basic_str."group_".$group->id.",";?>
			<?php echo $group->name.'<br/>';?>
			<ul id="group_<?php echo $group->id;?>">
				<?php foreach($group->subs->find_all() as $sub) : ?>
                    <?php $default=NULL ; ?>
                    <?php if ($type=='edit'):;?>
                        <?php $default = $ordersdish->is_sub_in_order_dish($sub->id) ?>
                    <?php endif ; ?>
					<li>
						<?php echo Form::checkbox('group_'.$group->id,$sub->id,$default,array('class'=>'order_dish_groupssubs group_'.$group->id));?>
                        <?php echo $sub->name; ?>
					</li>
				<?php endforeach; ?>
			</ul>
			<div id="val_group_<?php echo $group->id;?>" class="description" style="display:none"></div>
		<?php echo form::input('group_'.$group->id.'_rule',$group->rule,array('id'=>'group_'.$group->id.'_rule','hidden'=>'hidden'));?>
		<?php endif; ?>
	<?php endforeach;?>
	<?php $group_basic_str = substr( $group_basic_str , 0 ,strlen($group_basic_str) - 1 );?>
	<?php echo form::input('group_basic_str',$group_basic_str,array('id'=>'group_basic_str','hidden'=>'hidden'));?>
	<h3>optional groups in dish</h3>
	<?php $group_optional_str = "" ; ?>
	<?php foreach($dish->groups->find_all() as $group) : ?>
		<?php if($group->basic_optional): ?>
			<?php $group_optional_str = $group_optional_str."group_".$group->id.",";?>
			<?php echo $group->name.'<br/>';?>
			<ul id="group_<?php echo $group->id;?>">
				<?php foreach($group->subs->find_all() as $sub) : ?>
                    <?php $default=NULL ; ?>
                    <?php if ($type=='edit'):;?>
                        <?php $default = $ordersdish->is_sub_in_order_dish($sub->id) ?>
                    <?php endif ; ?>
					<li>
                        <?php echo Form::checkbox('group_'.$group->id,$sub->id,$default,array('class'=>'order_dish_groupssubs group_'.$group->id));?>
						<?php echo $sub->name; ?>
					</li>
				<?php endforeach; ?>
			</ul>
			<div id="val_group_<?php echo $group->id;?>" class="description" style="display:none"></div>
		<?php echo form::input('group_'.$group->id.'_rule',$group->rule,array('id'=>'group_'.$group->id.'_rule','hidden'=>'hidden'));?>
		<?php endif; ?>
		<div class="clear"></div>
	<?php endforeach;?>
	<?php $group_optional_str = substr( $group_optional_str , 0 ,strlen($group_optional_str) - 1 );?>
    <?php $default = ($type=='edit') ?  $ordersdish->quantity : 1  ; ?>
    <?php echo form::label('Quantity') ; ?>
    <?php echo Form::select('quantity',array(range(0,30)),$default) ;?>
	<?php echo form::input('group_optional_str',$group_optional_str,array('id'=>'group_optional_str','hidden'=>'hidden'));?>
    <?php echo Form::close();?>
	<?php echo Form::button(NULL,'Add dish To order',array('onClick'=>'add_dish_to_order()'));?>
</div>
