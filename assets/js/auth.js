jQuery(document).on('click', '#login-btn', function(){
	login();
})

function login(){
	jQuery('#form-login').find('.form-error').hide();
	if (formValidate('#form-login')) {
		var data = formToArray('#form-login');
		post(data, "Auth/loginUser", responseLogin);
	}
}

function responseLogin(response){
	var r = eval(response);

	if (r['status'] === true) {
		window.location = base_url;
	}
	else{
		jQuery('#form-login').find('.form-error').html(r['msg']);
		jQuery('#form-login').find('.form-error').show();
	}
}