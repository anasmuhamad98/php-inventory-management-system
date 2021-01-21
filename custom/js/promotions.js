var managePromotionTable;

$(document).ready(function() {
	// top nav bar 
	$('#navPromo').addClass('active');

	// manage promotion table
	managePromotionTable = $("#managePromotionTable").DataTable({
		'ajax': 'php_action/fetchPromotion.php',
		'order': []		
	});

}); // document.ready fucntion

TextDecoderStream;