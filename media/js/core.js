function admincheckbox ($checkadmin) {
if (!document.getElementById('checkadmin').checked)
    document.getElementById('checksupadmin').checked=false;
};
function supadmincheckbox ($checkadmin) {
if (document.getElementById('checksupadmin').checked)
    document.getElementById('checkadmin').checked=true;
};
$(document).ready(function() {
	$("#submit_rest_form").button();
	$("#dialog_form_restaurant").dialog({
			autoOpen: false,
			height: 600,
			width: 550,
			modal: true,
			buttons: {
				"Create an account": function() {

				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			},
			close: function() {
				allFields.val( "" ).removeClass( "ui-state-error" );
			}
	});
	$("#add_restaurant_button").button()
			.click(function() {
				$( "#dialog_form_restaurant" ).dialog( "open" );
			});
});
