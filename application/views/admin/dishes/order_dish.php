<div align="center"  class="order_left_div">
	<div class="header_bg" style="margin-top:10px;margin-right:10px">
		<div class="order_ingred_con" style="margin:10px;width:60%">
			<?php echo html::image('media/images/dish_icon.png', array('alt' => $dish->name,'class'=>'image'));?>
		</div>
	</div>
	<div style="margin-top:10px">
		<?php echo view::factory('site\orders\cart.php')
				->set('from_dish',1)->
				set('current_dish_id',$dish->id)
				->set('current_rest_id',$dish->restaurant->id); ?>
	</div>	
</div>
<div class="order_right_div">
    <?php $edit_id= ($type=='edit') ? '/'.$orderdish_id :NULL;?>
	<?php echo Form::open('main/dishordercreate/'.$dish->id.$edit_id,array('id'=>'form_dishorder'));?>
    <div class="paper_gray"><div class="header_bg"><h1 align="center" style="margin-top:0px;"><?php echo $dish->name ;?></h1></div></div>
	<?php if(strlen($dish->description) > 0) : ?>
		<div class="descrption_con">
			<p class ="description">
				<?php echo $dish->description ;?>
			</p>
		</div>
	<?php endif; ?>
	<div class="order_ingred_con">
		<div class="header_bg"><h3 align="center" style="margin-top:0px; color:white;">Ingredient</h3></div>
		<div class="inner_order_ingred">
			<h3 align="center">Basic</h3>
			<?php foreach($dish->ingredients->find_all() as $ingred) : ?>
				<?php if( ! $ingred->get_basic_optional_in_dish($dish->id)) : ?>
					<?php echo $ingred->name; ?>
					<?php if(strlen($ingred->description) > 0): ?>
					<span onclick="order_dish_toggle_item('ingred_<?php echo $ingred->id ;?>')" class="ui-icon ui-icon-info" style="display:inline-block;float:none; vertical-align:middle; cursor:pointer"></span>
					<p id="ingred_<?php echo $ingred->id ;?>" style="display:none" class ="description">
						<?php echo $ingred->description ;?>
					</p>
					<?php endif;?>
				<?php endif; ?>
				<div class="clear"></div>
			<?php endforeach;?>
		</div>
		<div class="inner_order_ingred">
			<h3 align="center">Optional</h3>
			<?php foreach($dish->ingredients->find_all() as $ingred) : ?>
			<?php $default = NULL ; ?>
					<?php if ($type=='edit'):;?>
						<?php $default = $dish->is_ingredient_in_order_dish($ingred->id,$orderdish_id) ?>
					<?php endif ; ?>
			<?php if($ingred->get_basic_optional_in_dish($dish->id)) : ?>
					<?php // Form::label('ingredient_'.$ingred->id,$ingred->name,array('class'=>'regular','style'=>'width:55%;display:inline-block;'));?>
					<!--div id="ingredient_radio_<?php echo $ingred->id?>" class="ingredient_radio">
						<?php //echo Form::radio('temp_radio_ingredient_'.$ingred->id,0 , ! $default,array('id'=>'ingredient_radio_'.$ingred->id.'1'));?>
						<?php //echo Form::label('ingredient_radio_'.$ingred->id.'1','no');?>
						<?php //echo Form::radio('temp_radio_ingredient_'.$ingred->id,1, $default,array('id'=>'ingredient_radio_'.$ingred->id.'2'));?>
						<?php //echo Form::label('ingredient_radio_'.$ingred->id.'2','yes');?>
					</div-->
					<?php echo Form::checkbox('ingredient_'.$ingred->id,$ingred->id,$default,array('class'=>'order_dish_ingredients'));?>
					<?php echo $ingred->name; ?>
					<?php if(strlen($ingred->description) > 0): ?>
						<span onclick="order_dish_toggle_item('ingred_<?php echo $ingred->id ;?>')" class="ui-icon ui-icon-info" style="display:inline-block;float:none; vertical-align:middle; cursor:pointer"></span>
						<p id="ingred_<?php echo $ingred->id ;?>" style="display:none" class ="description">
							<?php echo $ingred->description ;?>
						</p>
					<?php endif;?>
			<?php endif; ?>
			<div class="clear"></div>
			<?php endforeach;?>
		</div>
		<div class="clear"></div>
	</div>
	<div class="order_ingred_con">
		<div class="header_bg"><h3 align="center" style="margin-top:0px; color:white;">Groups</h3></div>
		<div class="inner_order_ingred">
			<h3 align="center">Basic</h3>
			<?php $group_basic_str = "" ; ?>
			<?php foreach($dish->groups->find_all() as $group) : ?>
				<?php if( ! $group->basic_optional): ?>
					<?php $group_basic_str = $group_basic_str."group_".$group->id.",";?>
					<?php echo $group->name.'<br/>';?>
					<ul id="group_<?php echo $group->id;?>" class="list_none">
						<?php foreach($group->subs->find_all() as $sub) : ?>
							<?php $default=NULL ; ?>
							<?php if ($type=='edit'):;?>
								<?php $default = $dish->is_sub_in_order_dish($sub->id,$orderdish_id) ?>
							<?php endif ; ?>
							<li>
								<?php echo Form::checkbox('group_'.$group->id.'_'.$sub->id,$sub->id,$default,array('class'=>'order_dish_groupssubs group_'.$group->id));?>
								<?php echo $sub->name; ?>
								<?php if(strlen($sub->description) > 0): ?>
									<span onclick="order_dish_toggle_item('ingred_<?php echo $sub->id ;?>')" class="ui-icon ui-icon-info" style="display:inline-block;float:none; vertical-align:middle; cursor:pointer"></span>
									<p id="ingred_<?php echo $sub->id ;?>" style="display:none" class ="description">
										<?php echo $sub->description ;?>
									</p>
								<?php endif;?>
							</li>
						<?php endforeach; ?>
					</ul>
					<div id="val_group_<?php echo $group->id;?>" class="description" style="display:none"></div>
				<?php echo form::input('group_'.$group->id.'_rule',$group->rule,array('id'=>'group_'.$group->id.'_rule','hidden'=>'hidden'));?>
				<?php endif; ?>
			<?php endforeach;?>
			<?php $group_basic_str = substr( $group_basic_str , 0 ,strlen($group_basic_str) - 1 );?>
			<?php echo form::input('group_basic_str',$group_basic_str,array('id'=>'group_basic_str','hidden'=>'hidden'));?>
		</div>
		<div class="inner_order_ingred">
			<h3 align="center">Optional</h3>
			<?php $group_optional_str = "" ; ?>
			<?php foreach($dish->groups->find_all() as $group) : ?>
				<?php if($group->basic_optional): ?>
					<?php $group_optional_str = $group_optional_str."group_".$group->id.",";?>
					<?php echo $group->name.'<br/>';?>
					<ul id="group_<?php echo $group->id;?>" class="list_none">
						<?php foreach($group->subs->find_all() as $sub) : ?>
							<?php $default=NULL ; ?>
							<?php if ($type=='edit'):;?>
								<?php $default = $dish->is_sub_in_order_dish($sub->id,$orderdish_id) ?>
							<?php endif ; ?>
							<li>
								<?php echo Form::checkbox('group_'.$group->id.'_'.$sub->id,$sub->id,$default,array('class'=>'order_dish_groupssubs group_'.$group->id));?>
								<?php echo $sub->name; ?>
								<?php if(strlen($sub->description) > 0): ?>
									<span onclick="order_dish_toggle_item('ingred_<?php echo $sub->id ;?>')" class="ui-icon ui-icon-info" style="display:inline-block;float:none; vertical-align:middle; cursor:pointer"></span>
									<p id="ingred_<?php echo $sub->id ;?>" style="display:none" class ="description">
										<?php echo $sub->description ;?>
									</p>
								<?php endif;?>
							</li>
						<?php endforeach; ?>
					</ul>
					<div id="val_group_<?php echo $group->id;?>" class="description" style="display:none"></div>
				<?php echo form::input('group_'.$group->id.'_rule',$group->rule,array('id'=>'group_'.$group->id.'_rule','hidden'=>'hidden'));?>
				<?php endif; ?>
				<div class="clear"></div>
			<?php endforeach;?>
		</div>
		<div class="clear"></div>
	</div>
	<div class="order_ingred_con">
		<div class="inner_order_ingred">
			<?php $group_optional_str = substr( $group_optional_str , 0 ,strlen($group_optional_str) - 1 );?>
    		<?php echo form::label('Comments') ;?>
			<?php echo form::textarea('comments',NULL,array('style'=>'width:95%')) ;?>
		</div>
		<div class="inner_order_ingred">
			<span><?php echo 'price: '.$dish->price;?> $ , </span>
			<?php $default = ($type=='edit') ?  $_SESSION['cart_array'][$orderdish_id]['quantity'] : 1  ; ?>
			<?php echo form::label('Quantity') ; ?>
			<?php echo Form::select('quantity',array(range(0,30)),$default) ;?>
			<div class="clear"></div>
			<div align="center" style="margin-top:20px">
				<?php echo Form::button(NULL,'Add dish To order',array('onClick'=>'add_dish_to_order()','id'=>'add_dish_to_order'));?>
			</div>	
		</div>
		<div class="clear"></div>
	</div>
	<?php echo form::input('group_optional_str',$group_optional_str,array('id'=>'group_optional_str','hidden'=>'hidden'));?>
	<?php echo Form::close();?>
</div>
<div class="clear"></div>
