<div class="rest_search tabel_search">
	<div align="center"><h2 style="color:#62BBE8;margin:0">Search Result</h2></div>
	<div class="clear" style="height:10px"></div>
	<table class="ui-widget ui-widget-content">
		<thead>
			<tr class="ui-widget-header ">
			<?php foreach( $arr_input as $input): ?>
				<th> <?php echo $input['title'];?> </th>
			<?php endforeach; ?>
			<th>Kosher Level</th>
			<th>Payment Method</th>
			<th></th>
		</thead>
		<tbody>
			<?php foreach( $restaurants as $rest): ?>
				<tr>
					<?php foreach( $arr_input as $input): ?>
						<td align="center"> <?php echo $rest->$input['col_name'];?> </td>
					<?php endforeach; ?>
					<td align="center"><?php $arr =  Kohana::config ('global.kosher_level'); echo $arr[$rest->kosher_type];?></td>
					<td align="center"><?php $arr =  Kohana::config ('global.payment_method'); echo $arr[$rest->payment_method];?></td>
					<td><?php echo html::anchor('/main/dishes/'.$rest->id,html::image('media/images/menu32.png'),array('title'=>'Go To The Menu'));?></td>

				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>