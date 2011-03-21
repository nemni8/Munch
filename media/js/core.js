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

    /*user dialog functions*/
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
		$( "#form_dialog_user" ).dialog( "open" );
	});

	/*category form dialog*/
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
				"Save User": function() {
					$temp = ($("#id_of_category").val()!=0) ? $("#id_of_category").val() : '';
                    $.ajax({
						type: 'post',
						dataType: 'html',
						url: '/munch/admin/categories/create/'+$temp,
						data: $("#form_category").serialize(),
						success: function (response, status, xml) {
                            $("#form_dialog_category").html('').html(response);
                            //the next row is a patch!!!
                            $("#form_dialog_category").dialog( "close" );
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
		$( "#form_dialog_category" ).dialog( "open" );
	});

	/*ingredient form dialog*/
	$("#form_dialog_dish").dialog({
			open: function(){
				if($("#id_of_dish").val()>0){
					temp = $("#id_of_dish").val();
					action = 'edit';
				}
				else{
					temp="";
					action = 'add';
				}
				$.get('/munch/admin/dishes/'+action+'/'+temp, function(data) {
                    $("#form_dialog_dish").html(data);
				});
			},
			autoOpen: false,
			autoSize: true,
			height: 600,
			width: 650,
            position: 'top',
			modal: true,
			buttons: {
				"Save Dish": function() {
					$temp = ($("#id_of_dish").val()!=0) ? $("#id_of_dish").val() : '';
                    $.ajax({
						type: 'post',
						dataType: 'html',
						url: '/munch/admin/dishes/create/'+$temp,
						data: $("#form_dish").serialize(),
						success: function (response, status, xml) {
                            $("#form_dialog_dish").html('').html(response);
							if($("#form_dialog_dish").html().length == 0){
                                $("#form_dialog_dish").dialog( "close" );
                                $("#id_of_dish").val(0);
								window.location = "";
							}
						}
					});
				},
				Cancel: function() {
					$("#id_of_dish").val(0);
                    $( this ).dialog( "close" );
				}
			},
			close: function() {
                $("#id_of_dish").val(0);
            }
    }


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

	$("#add_dish_button").click(function() {
		$( "#form_dialog_dish" ).dialog( "open" );
	});
	$("#id_of_dish").change(function(){
		$( "#form_dialog_dish" ).dialog( "open" );
	});

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
	if (section=="dish"){
        $("#id_of_dish").val(id);
        $( "#form_dialog_dish" ).dialog( "open" );
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
function edit_ingred_in_dish(id){
	$.ajax({
		type: 'post',
		dataType: 'html',
		url: '/munch/admin/dishes/createingredient/'+id,
		data: $("#form_dish_ingredient_"+id).serialize(),
		success: function (response, status, xml) {
			$.get('/munch/admin/dishes/editingredient/'+id, function(data) {
				$("#edit_ingred_in_dish_"+id).html(data);
			});
			alert('edit completed');
		}
	});

}
function add_ingred_in_dish(dish_id){
	$.ajax({
		type: 'post',
		dataType: 'html',
		url: '/munch/admin/dishes/createingredient/',
		data: $("#form_dish_ingredient_").serialize(),
		success: function (response, status, xml) {
			$.get('/munch/admin/dishes/edit/'+dish_id, function(data) {
				$("#form_dialog_dish").html(data);
			});
			alert('add completed');
		}
	});
}
function edit_group_in_dish(id){
	$.ajax({
		type: 'post',
		dataType: 'html',
		url: '/munch/admin/groups/create/'+id,
		data: $("#form_group_"+id).serialize(),
		success: function (response, status, xml) {
			$.get('/munch/admin/groups/edit/'+id, function(data) {
				$("#edit_group_in_dish_"+id).html(data);
			});
			alert('edit completed');
		}
	});

}
function add_group_in_dish(dish_id){
	$.ajax({
		type: 'post',
		dataType: 'html',
		url: '/munch/admin/groups/create/',
		data: $("#form_group_").serialize(),
		success: function (response, status, xml) {
			$.get('/munch/admin/dishes/edit/'+dish_id, function(data) {
				$("#form_dialog_dish").html(data);
			});
			alert('add completed');
		}
	});
}
function edit_sub_in_group(sub_id,group_id){
	$.ajax({
		type: 'post',
		dataType: 'html',
		url: '/munch/admin/groups/createsub/'+sub_id,
		data: $("#form_group_sub_"+group_id+"_"+sub_id).serialize(),
		success: function (response, status, xml) {
			$.get('/munch/admin/groups/editsub/'+sub_id, function(data) {
				$("#edit_sub_in_group_"+sub_id).html(data);
			});
			alert('edit completed');
		}
	});

}
function add_sub_in_group(dish_id,group_id){
	$.ajax({
		type: 'post',
		dataType: 'html',
		url: '/munch/admin/groups/createsub/',
		data: $("#form_group_sub_"+group_id+"_").serialize(),
		success: function (response, status, xml) {
			$.get('/munch/admin/dishes/edit/'+dish_id, function(data) {
				$("#form_dialog_dish").html(data);
			});
			alert('add completed');
		}
	});
}


