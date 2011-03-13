$(document).ready(function() {
	$('#checksupadmin').click(function(){

		if ($('#checksupadmin:checked').val())
    		$('#checkadmin').attr('checked',true);
	});
	$('#checkadmin').click(function(){
		if ( ! $('#checkadmin:checked').val())
    		$('#checksupadmin').attr('checked',false);
	});
	$("#form_dialog_rest").dialog({
			open: function(){
				if($("#id_of_rest").val()>0){
					temp = $("#id_of_rest").val();
					action = 'edit';
				}
				else{
					temp="";
					action = 'add';
				}
				$.get('admin/restaurants/'+action+'/'+temp, function(data) {
					$("#form_dialog_rest").html(data);
				});
			},
			autoOpen: false,
			height: 600,
			width: 350,
			modal: true,
			buttons: {
				"Save Restaurant": function() {
					$.ajax({
						type: 'post',
						dataType: 'html',
						url: 'restaurants/create/',
						data: $("#form_rest").serialize(),
						success: function (response, status, xml) {
							$("#form_dialog_rest").html('').html(response);
							if($("#form_dialog_rest").html().length == 0){
								$("#form_dialog_rest").dialog( "close" );
								window.location = "";
							}
						}
					});
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			},
			close: function() {
			}
	});
	$("#add_restaurant_button").click(function() {
		$( "#form_dialog_rest" ).dialog( "open" );
	});
	$("#id_of_rest").change(function(){
		$( "#form_dialog_rest" ).dialog( "open" );});

});
function id_assigner(id){
	$("#id_of_rest").val(id);
	$( "#form_dialog_rest" ).dialog( "open" );

}
