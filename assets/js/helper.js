jQuery(document).on('click', '.btn-search', function()
{
    var q = jQuery('#input-search').val();

    if (q.length > 0) {
        var loc = window.location.pathname.split('/');
        var state = false;

        if (loc.includes('search')) {
            window.location.replace(base_url + 'main/search?q=' + q);
        }
        else{
            window.open(base_url + 'main/search?q=' + q, '_blank');
        }
    }
    else{
        notification('Error!', 'Por favor escriba un valor válido', 'error');
    }
})

/**
 * [post description]
 * @author Nikollai Hernandez G <nikollaihernandez@gmail.com>
 * @param  {[type]}   data     [description]
 * @param  {Function} callback [description]
 * @return {[type]}            [description]
 */
	function post(data, path, callback, action = ''){
		var url = base_url + path;
		$.post(url,data,function(response)
		{ 
			callback(response, action); 
		}, 'json');
	}

/**
 * [formValidate description]
 * @author Nikollai Hernandez G <nikollaihernandez@gmail.com>
 * @param  {[type]} formId [description]
 * @return {[type]}        [description]
 */
	function formValidate(formId){
		var state = true;
		jQuery(formId + ' span.input-error').hide();
		jQuery(formId + ' input.input-error, ' + formId + ' select.input-error, ' + formId + ' textarea.input-error').removeClass('input-error');

		jQuery(formId + ' input.required, ' + formId + ' textarea.required').each(function(){
			if (jQuery(this).val() == '' || jQuery(this).val().length <= 0) {
				jQuery(this).parents('.form-group').find('span.input-error').show();
				jQuery(this).addClass('input-error');
				state = false;
			}
		})

		jQuery(formId + ' select.required').each(function(){
			if (jQuery(this).val() == '-1') {
				jQuery(this).parents('.form-group').find('span.input-error').show();
				jQuery(this).addClass('input-error');
				state = false;
			}
		})

		if (state == false) {
			scrollTo(formId + ' .input-error');
		}

		return state;
	}

/**
 * [formToArray description]
 * @author Nikollai Hernandez G <nikollaihernandez@gmail.com>
 * @param  {[type]} idForm [description]
 * @return {[type]}        [description]
 */
	function formToArray(idForm){
		var dataForm = '{';
		jQuery(idForm + ' input, '+idForm+' select, '+idForm+' textarea').each(function(e){
			var obj = jQuery(this);

			if (obj.attr('name').length > 0) {
				dataForm += '"'+obj.attr('name')+'":"'+obj.val()+'",';
				
			}
		})
		dataForm = dataForm.slice(0,-1); 
		dataForm += '}';
		return $.parseJSON(dataForm);
	} 


/**
 * [scrollTo description]
 * @author Nikollai Hernandez G <nikollaihernandez@gmail.com>
 * @param  {[type]} element  [description]
 * @param  {[type]} duration [description]
 * @return {[type]}          [description]
 */
	function scrollTo(element, duration = 500){
		jQuery('html, body').animate({
            scrollTop: jQuery(element).first().offset().top - 100
        }, duration);
	}


/**
 * [restartForm description]
 * @author Nikollai Hernandez G <nikollaihernandez@gmail.com>
 * @param  {[type]} form [description]
 * @return {[type]}      [description]
 */
	function restartForm(form){
		jQuery(form)[0].reset();
		jQuery(form + ' input, ' + form + ' textarea').val('');
		jQuery(form + ' select').val('-1');
		jQuery(form + ' .val-null').val('null');
		jQuery(form + ' .data-val').val(jQuery(form + ' .data-val').attr('data-val'));
		jQuery(form + ' span.input-error').hide();
		jQuery(form + ' input.input-error').removeClass('input-error');
	}

/**
 * [alertForm description]
 * @author Nikollai Hernandez G <nikollaihernandez@gmail.com>
 * @param  {[type]} form      [description]
 * @param  {[type]} className [description]
 * @param  {[type]} title     [description]
 * @param  {[type]} text      [description]
 * @return {[type]}           [description]
 */
	function alertForm(className, title, text){
		jQuery('.alert-form').removeClass('bg-danger');
		jQuery('.alert-form').removeClass('bg-info');
		jQuery('.alert-form').removeClass('bg-warning');
		jQuery('.alert-form').removeClass('bg-success');
		jQuery('.alert-form').addClass(className);
		jQuery('.alert-form strong').html(title);
		jQuery('.alert-form span').html(text);
		jQuery('.alert-form').show();
		scrollTo('.alert-form');
	}

/**
 * 
 * @param {*} vHead 
 * @param {*} vText 
 * @param {*} vIcon 
 * @param {*} vDuration 
 * @param {*} vPosition 
 */
	function notification(vHead, vText, vIcon, vDuration = 3000, vPosition = 'top-right')
	{
		$.toast({
			heading: vHead,
			text: vText,
			position: vPosition,
			loaderBg: '#fff',
			icon: vIcon,
			hideAfter: vDuration,
			stack: 1
		});
	}

// * =============== SYNC Functions =================
/**
 * 
 */
	function sync(){
		jQuery('#sync-preload').show();

		setTimeout(function(){
			post(false, 'main/sync', responseSync, false);
		},1000)
	}

/**
 * 
 * @param {*} response 
 */
	function responseSync(response){
		var data = eval(response);
		setTimeout(function(){
			jQuery('#sync-preload').hide();

			if (data['status'] === true) {
				notification('Exito!', data['msg'], 'info');
			}
			else{
				notification('Error!', data['msg'], 'info');
			}
		},1000)
	}

// * =============== END SYNC Functions =================

jQuery(document).ready(function(){
	jQuery(document).on('click', '.btn-group a', function(){
		var attr = $(this).attr('href');

		// For some browsers, `attr` is undefined; for others,
		// `attr` is false.  Check for both.
		if (typeof attr !== typeof undefined && attr !== false) {
		    window.location = jQuery(this).attr('href');
		}
	})

	jQuery(document).on('blur', '.required', function(){
		var val = jQuery(this).val();

		if (val.length > 0 && val != '-1') {
			jQuery(this).removeClass('input-error');
			jQuery(this).next('span').hide();
		}
	})

	jQuery(document).on('click', '.btn-sync', function(){
		swal({
			title: '¿Esta seguro?',
			text: 'Desea sincronizar toda la información en este momento',
			type: "warning",
			showCancelButton: !0,
			confirmButtonColor: "#DD6B55",
			cancelButtonColor: "#DD6B55",
			confirmButtonText: "Si, Continuar!",
			cancelButtonText: "No, Cancelar!",
			closeOnConfirm: true
		}, function(isConfirm){
			if(isConfirm) {
				sync();
			}
		})
	})

	// * Slide toggle to body cards
	jQuery(document).on('click', '.card .close-body-card', function(){
		if (jQuery(this).hasClass('fa-arrow-down')) {
			jQuery(this).removeClass('fa-arrow-down');
			jQuery(this).addClass('fa-arrow-up');
		}
		else{
			jQuery(this).addClass('fa-arrow-down');
			jQuery(this).removeClass('fa-arrow-up');
		}

		jQuery(this).parents('.card').find('.card-body').slideToggle();
	})

// ============= FORMATTER FORM MASK =============
	jQuery('.phone-mask').formatter({
		'pattern': '({{999}}) {{999}}-{{9999}}',
		'persistent': true
	});



// ================== PICKERS ====================
	jQuery('input.date-picker').daterangepicker({
		singleDatePicker: true,
		showDropdowns: true,
		format: 'YYYY-MM-DD'
	})

	jQuery('input.hour-picker').clockpicker({
		placement: 'bottom',
					align: 'left',
					autoclose: true,
					'default': 'now'
	})
})