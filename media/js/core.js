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
			width: "AUTO",
            resizable:false,
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
/*
    $('#checksupadmin').click(function(){

		if ($('#checksupadmin:checked').val())
    		$('#checkadmin').attr('checked',true);
	});
	$('#checkadmin').click(function(){
		if ( ! $('#checkadmin:checked').val())
    		$('#checksupadmin').attr('checked',false);
	});
*/

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

//form dialog functions

$("#form_dialog_ingredient").dialog({
        open: function(){
            if($("#id_of_ingredient").val()>0){
                temp = $("#id_of_ingredient").val();
                action = 'edit';
            }
            else{
                temp="";
                action = 'add';
            }
            $.get('/munch/admin/ingredients/'+action+'/'+temp, function(data) {
                $("#form_dialog_ingredient").html(data);
            });
        },
        autoOpen: false,
        autoSize: true,
        position: 'top',
        modal: true,
        buttons: {
            "Save Ingredient": function() {
                $temp = ($("#id_of_ingredient").val()!=0) ? $("#id_of_ingredient").val() : '';
                $.ajax({
                    type: 'post',
                    dataType: 'html',
                    url: '/munch/admin/ingredients/create/'+$temp,
                    data: $("#form_ingredient").serialize(),
                    success: function (response, status, xml) {
                        $("#form_dialog_ingredient").html('').html(response);

                        if($("#form_dialog_ingredient").html().length == 0){
                            $("#form_dialog_ingredient").dialog( "close" );
                            $("#id_of_ingredient").val(0);
                            window.location = "";
                        }
                    }
                });
            },
            Cancel: function() {
                $("#id_of_ingredient").val(0);
                $( this ).dialog( "close" );
            }
        },
        close: function() {
            $("#id_of_ingredient").val(0);

        }
});
$("#add_ingredient_button").click(function() {
    $( "#form_dialog_ingredient" ).dialog( "open" );
});
$("#id_of_ingredient").change(function(){
    $( "#form_dialog_ingredient" ).dialog( "open" );});


    //  category form dialog functions

    $("#form_dialog_category").dialog({
            open: function(){
                if($("#id_of_category").val()>0){
                    temp = $("#id_of_category").val();
                    action = 'edit';
                }
                else{
                    temp="";
                    action = 'add';
                }
                $.get('/munch/admin/categories/'+action+'/'+temp, function(data) {
                    $("#form_dialog_category").html(data);
                });
            },
            autoOpen: false,
            autoSize: true,
            position: 'top',
            modal: true,
            buttons: {
                "Save Category": function() {
                    $temp = ($("#id_of_category").val()!=0) ? $("#id_of_category").val() : '';
                    $.ajax({
                        type: 'post',
                        dataType: 'html',
                        url: '/munch/admin/categories/create/'+$temp,
                        data: $("#form_category").serialize(),
                        success: function (response, status, xml) {
                            $("#form_dialog_category").html('').html(response);

                            if($("#form_dialog_category").html().length == 0){
                                $("#form_dialog_category").dialog( "close" );
                                $("#id_of_category").val(0);
                                window.location = "";
                            }
                        }
                    });
                },
                Cancel: function() {
                    $("#id_of_category").val(0);
                    $( this ).dialog( "close" );
                }
            },
            close: function() {
                $("#id_of_category").val(0);

            }
    });
    $("#add_category_button").click(function() {
        $( "#form_dialog_category" ).dialog( "open" );
    });
    $("#id_of_category").change(function(){
        $( "#form_dialog_category" ).dialog( "open" );});

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


