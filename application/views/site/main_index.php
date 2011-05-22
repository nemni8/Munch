<div class="rest_search">
	<div class="order_ingred_con" style="margin:10px;">
		<div class="header_bg" align="center">
			<h2 style="margin:0">Find A Restaurant</h2>
		</div>
	</div>
	<?php echo Form::open(NULL,array('id'=>'rest_search_form'));?>
	<div class="order_ingred_con" style="width:48%;float:left;display:inline;margin-right:2%;">
		<?php echo Form::Label('Restaurant Name');?>
		<?php echo Form::input('rest_name',NULL,array('id'=>'rest_name','class'=>'rest_search_input auto_restaurant'));?>
		<div class="clear" style="height:10px"></div>
		<?php $index=0; ?>
		<?php echo Form::Label('Payment Method');?>
		<div id="payment_rest_search_radio">
			<?php foreach($payment_method as $key =>$option): ?>
				<?php $key++;?>
				<?php $default= ($index=='0') ? TRUE : FALSE  ;?>
				<?php echo Form::radio('payment_method',$index,FALSE,array('id'=>'payment_rest_search_radio'.$key,'class'=>'rest_search_radio'))    ;?>
				<?php echo Form::label('payment_rest_search_radio'.$key,$option) ;?>
				<?php $index++ ;?>
			<?php endforeach ; ?>
		</div>
		<div class="clear" style="height:10px"></div>
		<?php $index=0; ?>
		<?php echo Form::Label('Kosher Level');?>
        <div id="kosher_rest_search_radio">
            <?php foreach($kosher_options as $key => $option): ?>
				<?php $key++;?>
                <?php $default= ($index=='0') ? TRUE : FALSE  ;?>
                <?php echo Form::radio('kosher_level',$index,FALSE,array('id'=>'kosher_rest_search_radio'.$key,'class'=>'rest_search_radio'))    ;?>
				<?php echo Form::label('kosher_rest_search_radio'.$key,$option) ;?>
                <?php $index++ ;?>
            <?php endforeach ; ?>
        </div>
	</div>
	<div class="order_ingred_con" style="width:44%;float:left;display:inline; padding-left:20px">
		<?php echo Form::input('city_id',0,array('id'=>'city_id','type'=>'hidden','class'=>'rest_search_input'));?>
		<?php echo Form::Label('min_order','Min Order',array('class'=>'label_search_rest'));?>
		<?php echo Form::select('min_order',array_merge(array(''=>''),array(range(0,100))),NULL,array('class'=>'rest_search_select rest_search_select')); ?>
		<div class="clear" style="height:18px"></div>
		<?php echo Form::Label('delivery_cost','Delivery Cost',array('class'=>'label_search_rest'));?>
		<?php echo Form::select('delivery_cost',array_merge(array(''=>''),array(range(0,50))),NULL,array('class'=>'rest_search_select rest_search_select')); ?>
		<div class="clear" style="height:18px"></div>
		<?php echo Form::Label('delivery_time','Delivery Time',array('class'=>'label_search_rest'));?>
		<?php echo Form::select('delivery_time',array_merge(array(''=>''),array(range(0,90))),NULL,array('class'=>'rest_search_select rest_search_select')); ?>
		<div class="clear" style="height:18px"></div>
		<?php echo Form::label('kitchen_type','Kitchen Type',array('class'=>'label_search_rest')) ;?>
		<?php echo Form::select('kitchen_type',$categories,20,array('id'=>'kitchen_type','class'=>'rest_search_select rest_search_select'));?>
		<div class="clear" style="height:6px"></div>
	</div>
	<?php echo Form::close();?>
</div>
<div class="clear" style="height:20px"></div>
<div id='rest_container'>
	<?php echo Request::factory("admin/restaurants/restaurantsearch")->execute(); ?>
</div>



