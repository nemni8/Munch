	<div class="rest_search">
    <h2>Restaurants</h2>
        <?php echo Form::Label('Restaurant Name');?>
        <?php echo Form::input('rest_name',NULL,array('id'=>'rest_name'));?>
        <?php echo Form::input('city_id',0,array('id'=>'city_id','type'=>'hidden'));?>
        <?php echo Form::Label('Min Order');?>
        <?php echo Form::select('min_order',array(range(0,60)),NULL); ?>
        <?php echo Form::Label('Delivery Cost');?>
        <?php echo Form::select('delivery_cost',array(range(0,20)),NULL); ?>
        <?php echo Form::Label('Delivery Time');?>
        <?php echo Form::select('delivery_time',array(range(0,60)),NULL); ?>
	    <?php $index=0; ?>
        <div>
            <?php foreach($kosher_options as $option): ?>
                <?php echo Form::label($option) ;?>
                <?php $default= ($index=='0') ? TRUE : FALSE  ;?>
                <?php echo Form::radio('kosher_level',$index,$default)    ;?>
                <?php $index++ ;?>
            <?php endforeach ; ?>
        </div>
        <div>
                <?php echo Form::label('Kitchen Type') ;?>
            <?php  echo Form::select('kitchen_type',
                $categories->as_array('id','name'),NULL,array('id'=>'kitchen_type'));?>
        </div>
	</div>
    <div id='rest_container'></div>



