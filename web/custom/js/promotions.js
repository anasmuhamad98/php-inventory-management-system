var managePromotionTable;

$(document).ready(function () {
	// top nav bar 
	$('#navPromo').addClass('active');

	// manage promotion table
	managePromotionTable = $("#managePromotionTable").DataTable({
		'ajax': 'php_action/fetchPromotion.php',
		'order': []
	});

	// submit promotion form function
	$("#createPromotionPackage").unbind('submit').bind('submit', function () {
		var form = $(this);

		$('.form-group').removeClass('has-error').removeClass('has-success');
		$('.text-danger').remove();

		var budgetPromotion = $("#budgetPromotion").val();
		var sortPromotion = $("#sortPromotion").val();

		if (budgetPromotion == "") {
			$("#budgetPromotion").after('<p class="text-danger">Budget field is required</p>');
			$('#budgetPromotion').closest('.form-group').addClass('has-error');
		} else {
			$('#budgetPromotion').closest('.form-group').addClass('has-success');
		}

		if (sortPromotion == "") {
			$("#sortPromotion").after('<p class="text-danger">Sort by field is required</p>');
			$('#sortPromotion').closest('.form-group').addClass('has-error');
		} else {
			$('#sortPromotion').closest('.form-group').addClass('has-success');
		}

		if (budgetPromotion && sortPromotion) {
			$.ajax({
				url: form.attr('action'),
				type: form.attr('method'),
				data: form.serialize(),
				dataType: 'json',
				success: function (response) {
					console.log(response);
					// reset button
					$("#createPromotionBtn").button('reset');
					$(".text-danger").remove();
					$('.form-group').removeClass('has-error').removeClass('has-success');

					if (response.success == true) {
						managePromotionTable.ajax.reload(null, false);

						// create order button
						$(".success-messages").html('<div class="alert alert-success">' +
							'<button type="button" class="close" data-dismiss="alert">&times;</button>' +
							'<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> ' + response.messages +
							'</div>');

						$(".success-messages").delay(500).show(10, function () {
							$(this).delay(3000).hide(10, function (){});
							
						}); // /.alert

						$("html, body, div.panel, div.pane-body").animate({ scrollTop: '0px' }, 100);
					} else {
						alert(response.messages);
					}
				} // /success
			}); // /ajax	
		} // if
		return false;
	}); // /submit promotiom form function

}); // document.ready fucntion


function removePromos(promoId = null) {
	if(promoId) {
		$('#removePromoId').remove();
		$.ajax({
			url: 'php_action/fetchSelectedPromos.php',
			type: 'post',
			data: {promoId : promoId},
			dataType: 'json',
			success:function(response) {
				$('.removePromotionFooter').after('<input type="hidden" name="removePromoId" id="removePromoId" value="'+response.promotion_id+'" /> ');

				// click on remove button to remove the brand
				$("#removePromotionBtn").unbind('click').bind('click', function() {
					// button loading
					$("#removePromotionBtn").button('loading');

					$.ajax({
						url: 'php_action/removePromotion.php',
						type: 'post',
						data: {promoId : promoId},
						dataType: 'json',
						success:function(response) {
							console.log(response);
							// button loading
							$("#removePromotionBtn").button('reset');
							if(response.success == true) {

								// hide the remove modal 
								$('#removePromoModal').modal('hide');

								// reload the brand table 
								managePromotionTable.ajax.reload(null, false);
								
								$('.remove-messages').html('<div class="alert alert-success">'+
			            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
			            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
			          '</div>');

			  	  			$(".alert-success").delay(500).show(10, function() {
										$(this).delay(3000).hide(10, function() {
											$(this).remove();
										});
									}); // /.alert
							} else{
								
							}
						} // /response messages
					}); // /ajax function to remove the brand

				}); // /click on remove button to remove the brand

			} // /success
		}); // /ajax

		$('.removePromotionFooter').after();
	} else {
		alert('error!! Refresh the page again');
	}
} // /remove brands function