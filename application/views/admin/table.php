<?php if(isset($errors))  echo 1 ; ?>
<?php $edit_id = $id ;?>
<div class="form_tables">
	<!-- start of the form -->
	<?php echo Form::open('admin/main/table/'.$edit_id,array('id'=>'form_table'));?>
		<!-- change user ID of A restaurant-->
    
    <div id="items-contain" class="ui-widget">
	<h1>Temp:</h1>
	
    <table id="users" class="ui-widget ui-widget-content">
		<thead>
            <tr class="ui-widget-header ">
            <?php foreach( $arr_input as $input): ?>
			    <th> <?php echo $input['title'];?> </th>
            <?php endforeach; ?>
		</thead>
		<tbody>
			<?php foreach( $all_items as $item): ?>
			    <tr> 
                <?php foreach( $arr_input as $input): ?>
	    		    <td> <?php echo $item->$input['col_name'];?> </td>
                <?php endforeach; ?>
                </tr>
            <?php endforeach; ?>
		</tbody>
	</table>
    <div class="clear"><br/></div>
    <button id="create_button">Create new <?php echo $id;?> </button>
    <?php echo Form::close();?>
</div>



