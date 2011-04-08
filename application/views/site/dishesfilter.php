	<div class="rest_search">
    <h2>Restaurants</h2>
        <?php echo Form::Label('Dish Name');?>
        <?php echo Form::input('Dish_name',NULL,array('id'=>'dish_name'));?>
        <?php echo Form::Label('Max Price');?>
        <?php echo Form::select('max_price',array(range(0,90)),NULL); ?>
        <?php echo Form::Label('Meat Or Dairy');?>
        <?php  echo Form::select('mdv',Kohana::config ('global.mdv'),NULL,array('class'=>'single_select'));?>

        <div>
                <?php echo Form::label('category') ;?>
            <?php  echo Form::select('dish_category',
                $categories->as_array('id','name'),NULL,array('id'=>'kitchen_type'));?>
        </div>
	</div>
    <div id='dish_container'></div>



