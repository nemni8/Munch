$(document).ready(function() {
	//rest dialog functions

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
				$.get('/munch/admin/restaurants/'+action+'/'+temp, function(data) {
					$("#form_dialog_rest").html(data);
				});
			},
			autoOpen: false,
			height: 600,
			width: 350,
            position: 'top',
			modal: true,
			buttons: {
				"Save Restaurant": function() {
					$temp = ($("#id_of_rest").val()!=0) ? $("#id_of_rest").val() : '';
                    $.ajax({
						type: 'post',
						dataType: 'html',
						url: '/munch/admin/restaurants/create/'+$temp,
						data: $("#form_rest").serialize(),
						success: function (response, status, xml) {
							$("#form_dialog_rest").html('').html(response);
							if($("#form_dialog_rest").html().length == 0){
								$("#form_dialog_rest").dialog( "close" );
                                $("#id_of_rest").val(0);
								window.location = "";
							}
						}
					});
				},
				Cancel: function() {
					$("#id_of_rest").val(0);
                    $( this ).dialog( "close" );
				}
			},
			close: function() {
                $("#id_of_rest").val(0);
			}
	});
	$("#add_restaurant_button").click(function() {
		$( "#form_dialog_rest" ).dialog( "open" );
	});
	$("#id_of_rest").change(function(){
		$( "#form_dialog_rest" ).dialog( "open" );});



    //user dialog functions
    $('#checksupadmin').click(function(){

		if ($('#checksupadmin:checked').val())
    		$('#checkadmin').attr('checked',true);
	});
	$('#checkadmin').click(function(){
		if ( ! $('#checkadmin:checked').val())
    		$('#checksupadmin').attr('checked',false);
	});

    $("#form_dialog_user").dialog({
			open: function(){
				if($("#id_of_user").val()>0){
					temp = $("#id_of_user").val();
					action = 'edit';
				}
				else{
					temp="";
					action = 'add';
				}
				$.get('/munch/admin/users/'+action+'/'+temp, function(data) {
                    $("#form_dialog_user").html(data);
				});
			},
			autoOpen: false,
			autoSize: true,
            position: 'top',
			modal: true,
			buttons: {
				"Save User": function() {
					$temp = ($("#id_of_user").val()!=0) ? $("#id_of_user").val() : '';
                    $.ajax({
						type: 'post',
						dataType: 'html',
						url: '/munch/admin/users/create/'+$temp,
						data: $("#form_user").serialize(),
						success: function (response, status, xml) {
                            $("#form_dialog_user").html('').html(response);
                            //the next row is a patch!!!
                            $("#form_dialog_user").dialog( "close" );
							if($("#form_dialog_user").html().length == 0){
                                $("#form_dialog_user").dialog( "close" );
                                $("#id_of_user").val(0);
								window.location = "";
							}
						}
					});
				},
				Cancel: function() {
					$("#id_of_user").val(0);
                    $( this ).dialog( "close" );
				}
			},
			close: function() {
                $("#id_of_user").val(0);
               
			}
	});
	$("#add_user_button").click(function() {
		$( "#form_dialog_user" ).dialog( "open" );
	});
	$("#id_of_user").change(function(){
		$( "#form_dialog_user" ).dialog( "open" );});

//try to autocomplete

});
function id_assigner(id,section){

    if (section=='rest'){
        $("#id_of_rest").val(id);
        $( "#form_dialog_rest" ).dialog( "open" );
    }
    if (section=="user"){
        $("#id_of_user").val(id);
        $( "#form_dialog_user" ).dialog( "open" );
    }

}
function checksupadminfunction() {
		if ($('#checksupadmin:checked').val())
    		$('#checkadmin').attr('checked',true);
}
function checkadminfunction() {
		if ( ! $('#checkadmin:checked').val())
    		$('#checksupadmin').attr('checked',false);
}

