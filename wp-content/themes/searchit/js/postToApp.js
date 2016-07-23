
// var $form = $('form.apply-form');
// $form.on('submit', function (event) {
// 	event.preventDefault();
// 	var $jobID = $form.find('input.job-id').val();
// 	if(!$jobID.length){
// 		$jobID = 0;
// 	}

// 	if(!$form.find('input.name').val() || !$form.find('input.email').val()){
// 		$form.append('<p>error!</p>');
// 	} else {
// 		$.ajax({
// 	        type: "POST",
// 			url: formAjax.ajaxurl, // our PHP handler file
// 			data : {
// 				action : 'post_to_app',
// 				name : $form.find('input.name').val(),
// 				email : $form.find('input.email').val(),
// 				address : $form.find('input.address').val(),
// 				phone : $form.find('input.phone').val(),
// 				gender : $form.find('input.gender').val(),
// 				jobid : $jobID,
// 				note : $form.find('textarea.message').val(),
// 				cv : $form.find('input.cv').val(),
// 			},
// 			success: function(data){
// 				console.log(data);
// 			}
// 		});
// 		return false;
// 	}
// });
