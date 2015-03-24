$(document).ready(function() {
	$( "#form_dialog_delete" ).dialog({
		open: function (){
		},
		autoOpen:false,
		autoSize:true,
		resizable: false,
		height:140,
		modal: true,
		buttons: {
			"Delete": function() {
				$idfordelete =  $("#id_for_delete").val() ;
				$sourcetable=  $("#id_of_source").val() ;
				if (($idfordelete==0) || ($sourcetable==0))
					$( this ).dialog( "close" );
				$.ajax({
					type: 'post',
					dataType: 'html',
					url: '/munch/admin/'+$sourcetable+'/delete/'+$idfordelete,
					data: $("#form_rest").serialize(),
					success: function () {
						$( this ).dialog( "close" );
						$("#id_for_delete").val(0);
						$("#id_of_source").val(0);
						window.location = "";
					}
				})
			},
			Cancel: function() {
				$( this ).dialog( "close" );
			}
		}
	});


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
				$(".single_select").multiselect({
					height:80,
					multiple:false,
					header:"Select an Option",
					noneSelctedText:"Select an Option",
					selectedList:1
				});
				$("#rest_category").multiselect({
					height:80,
					selectedList:3,
					header:"Select an Option",
					noneSelctedText:"Select an Option"
				});
			});
		},
		autoOpen: false,
		height: 550,
		width:400,
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
						$(".single_select").multiselect({
							height:80,
							multiple:false,
							header:"Select an Option",
							noneSelctedText:"Select an Option",
							selectedList:1
						});
						$("#rest_category").multiselect({
							height:80,
							selectedList:3,
							header:"Select an Option",
							noneSelctedText:"Select an Option"
						});
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

		$( "#form_dialog_rest" ).dialog( "open" );
	});

	/*user dialog functions*/

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
		resizable:false,
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
				$(".single_select").multiselect({
					height:80,
					multiple:false,
					header:"Select an Option",
					noneSelctedText:"Select an Option",
					selectedList:1
				});
			});
		},
		autoOpen: false,
		autoSize:true,
		width:350,
		height:410,
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
						$(".single_select").multiselect({
							height:80,
							multiple:false,
							header:"Select an Option",
							noneSelctedText:"Select an Option",
							selectedList:1
						});
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

	/*dish form dialog*/
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
				$(".single_select").multiselect({
					height:110,
					multiple:false,
					header:"Select an Option",
					noneSelctedText:"Select an Option",
					selectedList:1
				});
				$("#dish_category").multiselect({
					height:110,
					selectedList:3
				});
				$("#active_radio").buttonset();
				$(".submit").button();
			});
		},
		autoOpen: false,
		height:550,
		width:400,
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
						$(".single_select").multiselect({
							height:110,
							multiple:false,
							header:"Select an Option",
							noneSelctedText:"Select an Option",
							selectedList:1
						});
						$("#dish_category").multiselect({
							height:110,
							selectedList:3
						});
						$("#active_radio").buttonset();
						$(".submit").button();
						
						if($("#form_dialog_dish").html().length == 0)
						{
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
	});
	$("#add_dish_button").click(function() {
		$( "#form_dialog_dish" ).dialog( "open" );
	});
	$("#id_of_dish").change(function(){
		$( "#form_dialog_dish" ).dialog( "open" );
	});
	

	/*ingredient form dialog*/
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
				$("#ingredient_category").multiselect({
							height:80,
							selectedList:3,
							header:"Select an Option",
							noneSelctedText:"Select an Option"
						});
			});
		},
		autoOpen: false,
		autoSize: true,
		position: 'top',
		width:400,
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
						$("#ingredient_category").multiselect({
							height:80,
							selectedList:3,
							header:"Select an Option",
							noneSelctedText:"Select an Option"
						});
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
		$( "#form_dialog_ingredient" ).dialog( "open" );
	});


	//  category form dialog functions

	
	
});

function id_assigner(id,section){

	if (section=='restaurant'){
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
	if (section=="ingredient"){
		$("#id_of_ingredient").val(id);
		$( "#form_dialog_ingredient" ).dialog( "open" );
	}
	if (section=="category"){
		$("#id_of_category").val(id);
		$( "#form_dialog_category" ).dialog( "open" );
	}

}
function delete_assigner(id,section) {
	$("#id_for_delete").val(id);
	if (section=='restaurant'){
		$("#id_of_source").val('restaurants');
	}
	if (section=="user"){
		$("#id_of_source").val('users');
	}
	if (section=="dish"){
		$("#id_of_source").val('dishes');
	}
	if (section=="ingredient"){
		$("#id_of_source").val('ingredients');
	}
	if (section=="category"){
		$("#id_of_source").val('categories');
	}
	$( "#form_dialog_delete" ).dialog('open');

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
				$(".single_select").multiselect({
					height:110,
					multiple:false,
					header:"Select an Option",
					noneSelctedText:"Select an Option",
					selectedList:1
				});
				$("#dish_category").multiselect({
					height:110,
					selectedList:3
				});
				$("#active_radio").buttonset();
				$(".submit").button();
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
				$(".single_select").multiselect({
					height:110,
					multiple:false,
					header:"Select an Option",
					noneSelctedText:"Select an Option",
					selectedList:1
				});
				$("#dish_category").multiselect({
					height:110,
					selectedList:3
				});
				$("#active_radio").buttonset();
				$(".submit").button();
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
				$(".single_select").multiselect({
					height:110,
					multiple:false,
					header:"Select an Option",
					noneSelctedText:"Select an Option",
					selectedList:1
				});
				$("#dish_category").multiselect({
					height:110,
					selectedList:3
				});
				$("#active_radio").buttonset();
				$(".submit").button();
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
				$(".single_select").multiselect({
					height:110,
					multiple:false,
					header:"Select an Option",
					noneSelctedText:"Select an Option",
					selectedList:1
				});
				$("#dish_category").multiselect({
					height:110,
					selectedList:3
				});
				$("#active_radio").buttonset();
				$(".submit").button();
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
				$(".single_select").multiselect({
					height:110,
					multiple:false,
					header:"Select an Option",
					noneSelctedText:"Select an Option",
					selectedList:1
				});
				$("#dish_category").multiselect({
					height:110,
					selectedList:3
				});
				$("#active_radio").buttonset();
				$(".submit").button();
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
				$(".single_select").multiselect({
					height:110,
					multiple:false,
					header:"Select an Option",
					noneSelctedText:"Select an Option",
					selectedList:1
				});
				$("#dish_category").multiselect({
					height:110,
					selectedList:3
				});
				$("#active_radio").buttonset();
				$(".submit").button();
			});
			alert('add completed');
		}
	});
}


