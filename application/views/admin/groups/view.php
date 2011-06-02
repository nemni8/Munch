<div class="dialog">
	<!-- start of the form -->
        <?php echo "Group Name: ".$group->name. "</br>";?>
        <?php echo "Price: ".$group->price. "</br>";?>
        <?php echo "Rule: ".$group->rule. "</br>";?>
        <?php $default = ($group->basic_optional) ? "Optional" : "Basic" ;?>
        <?php echo "Basic/Optional: ".$default."</br>" ;?>
		<div class="clear" style="height: 12px;"></div>
        <?php $subs = $group->find_subs(); ?>
		<?php if(count($subs) > 0) :?>
			<h3>Subs Dishes in <?php echo $group->name;?> Group</h3>
			<ul>
				<?php foreach($subs as $sub) : ?>
					<li style=" margin-bottom: 12px;">
                    <?php echo $sub->name."        ,Price: ".$sub->price ;?>
					</li>
				<?php endforeach;?>
			</ul>
		<?php endif;?>
		<div class="clear"></div>
</div>

