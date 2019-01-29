$(document).ready(function() {
	$('#error').html(" ");

	$('#form-add').submit(function(e){
		e.preventDefault();
		var fa = $(this);
		$('#form-add').find(':submit').attr("disabled", "disabled");
		$('#form-add').find(':submit').html("Menyimpan...");
		$.ajax({
			type: "POST",
			url: fa.attr('action'), 
			data: $("#form-add").serialize(),
			dataType: "json",  
			success: function(data){
				if (data.success == true) {
					window.location.href=base_url+data.redirect;
				}else if (data.error == true) {
					$('#form-add').find(':submit').attr("disabled", false);
					$('#form-add').find(':submit').html("Simpan");
					$.each(data.error_msg, function(key, value) {
						if (value) {
							console.log(value);
							$('#input-' + key).parents('.form-group').removeClass('has-success');
							$('#input-' + key).parents('.form-group').addClass('has-error has-danger');
							$('#input-' + key).parents('.form-group').find('#error').html(value);													
						}else{
								$('#input-' + key).parents('.form-group').addClass('has-success');
						}
						
					});
				}else if(data.wrong == true){
					$('#form-add').find(':submit').attr("disabled", false);
					$('#form-add').find(':submit').html("Simpan");
					$('#info').html(data.wrong_msg);			            	
				}	
			}
		});

	});
	$('#error').html(" ");
	$('#form-edit').submit(function(e){
		e.preventDefault();
		var fa = $(this);
		$('#form-edit').find(':submit').attr("disabled", "disabled");
		$('#form-edit').find(':submit').html("Menyimpan...");
		$.ajax({
			type: "POST",
			url: fa.attr('action'), 
			data: $("#form-edit").serialize(),
			dataType: "json",  
			success: function(data){
				if (data.success == true) {
					window.location.href=base_url+data.redirect;
				}else if (data.error == true) {
					$('#form-edit').find(':submit').attr("disabled", false);
					$('#form-edit').find(':submit').html("Simpan");
					$.each(data.error_msg, function(key, value) {
						if (value) {
							console.log(value);
							$('#edit-' + key).parents('.form-group').removeClass('has-success');
							$('#edit-' + key).parents('.form-group').addClass('has-error has-danger');
							$('#edit-' + key).parents('.form-group').find('#error').html(value);													
						}else{
								$('#edit-' + key).parents('.form-group').addClass('has-success');
						}
						
					});
				}else if(data.wrong == true){
					$('#form-edit').find(':submit').attr("disabled", false);
					$('#form-edit').find(':submit').html("Simpan");
					$('#info').html(data.wrong_msg);			            	
				}	
			}
		});

	});

	$('#form-add input').on('keyup', function () { 
		$(this).parents('.form-group').removeClass('has-error has-danger').addClass('has-success');		
		$(this).parents('.form-group').find('#error').html(" ");		
  	});

	$('#form-add textarea').on('keyup', function () { 
		$(this).parents('.form-group').removeClass('has-error has-danger').addClass('has-success');		
		$(this).parents('.form-group').find('#error').html(" ");		
  	});

	$('#form-add select').on('change', function () { 
		$(this).parents('.form-group').removeClass('has-error has-danger').addClass('has-success');		
		$(this).parents('.form-group').find('#error').html(" ");		
  	});

  	$('#form-edit input').on('keyup', function () { 
		$(this).parents('.form-group').removeClass('has-error has-danger').addClass('has-success');		
		$(this).parents('.form-group').find('#error').html(" ");		
  	});

  	$('#form-edit textarea').on('keyup', function () { 
		$(this).parents('.form-group').removeClass('has-error has-danger').addClass('has-success');		
		$(this).parents('.form-group').find('#error').html(" ");		
  	});

  	$('#form-edit select').on('change', function () { 
		$(this).parents('.form-group').removeClass('has-error has-danger').addClass('has-success');		
		$(this).parents('.form-group').find('#error').html(" ");		
  	});

});	