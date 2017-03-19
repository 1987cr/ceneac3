// Debug Mode
var debug = true;

$(document).on('ready', function() {

	/* ------------------------------------- */ 
	/* .............. Select2 .............. */ 
	/* ------------------------------------- */

	$("#role-permisos").select2();
	$("#course-category_id").select2();
	$("#schedule-course_id").select2();
	$("#instructor-user_id").select2();
	$("#instructor-schedule_id").select2();
	$("#instructor-schedule_id").select2();
	$("#registered-user_id").select2();
	$("#registered-schedule_id").select2();
	$("#preregistered-user_id").select2();
	$("#preregistered-schedule_id").select2();
	$("#payment-preregister_id").select2();
	$("#payment-payment_type").select2();
	$("#interestlist-user_id").select2();
	$("#interestlist-course_id").select2();
	$("#postulate-schedule_id").select2();
	$("#postulate-user_id").select2();
	//$("#").select2();


	/* ------------------------------------- */ 
	/* ............ Date Picker ............ */ 
	/* ------------------------------------- */

	$("#schedule-start_date").datepicker({
		language: 'es',
		format: 'dd-mm-yyyy',
		startDate: '0d'
	});

	$("#schedule-end_date").datepicker({
		language: 'es',
		format: 'dd-mm-yyyy',
		startDate: '0d',
	});

	// $( "input[name='ScheduleSearch[start_date]']" ).datepicker({
	// 	language: 'es',
	// 	format: 'dd-mm-yyyy',
	// 	startDate: new Date('2015')
	// });

	// $( "input[name='ScheduleSearch[end_date]']" ).datepicker({
	// 	language: 'es',
	// 	format: 'dd-mm-yyyy',
	// 	startDate: new Date('2015')
	// });

	$("#preregistered-preregister_date").datepicker({
		language: 'es',
		format: 'dd-mm-yyyy',
		startDate: '0d'
	});

	$("#payment-payment_date").datepicker({
		language: 'es',
		format: 'dd-mm-yyyy',
		startDate: '0d'
	});

	/* ------------------------------------- */ 
	/* ............ Time Picker ............ */ 
	/* ------------------------------------- */

	$("#schedule-start_hour").timepicker({
		timeFormat: 'h:mm p',
		interval: 30,
		minTime: '10:00am',
		maxTime: '6:00pm',
		defaultTime: '10:00am',
		startTime: '10:00',
		dynamic: true,
		dropdown: true,
		scrollbar: true
	});

	$("#schedule-end_hour").timepicker({
		timeFormat: 'h:mm p',
		interval: 30,
		minTime: '10:00am',
		maxTime: '6:00pm',
		defaultTime: '10:00am',
		startTime: '10:00',
		dynamic: true,
		dropdown: true,
		scrollbar: true
	});

	/* ------------------------------------- */ 
	/* ................ Ajax ............... */ 
	/* ------------------------------------- */

	function ajaxPost(model, action, successCb, errorCb) {

		errorCb = typeof errorCb !== 'undefined' ?  errorCb : genericError;

		var selectedRowsId = $('#pjax').yiiGridView('getSelectedRows');

		if(!!selectedRowsId.length) {
			$.ajax({
				type: 'POST',
				url : '/web/' + model + '/' + action,
				data : {row_id: selectedRowsId},
				success : successCb,
				error: errorCb
			});
		} else {
			toastr["warning"]("No se seleccionaron elementos.");
		}
	}

	function successMultipleDelete(res) {
		!debug && $.pjax.reload({container:'#pjax'});

		var resArr = res.split(',');

		var errorsNo = resArr.filter(function(el){return el === 'error'}).length;
		var successNo = resArr.filter(function(el){return el === 'deleted'}).length;

		var successMsg = successNo > 1 ? ' elementos eliminados.' : ' elemento eliminado.';
		var errorMsg = (errorsNo > 1 ? ' errores' : ' error') + " de dependencia.";

		if(successNo > 0) toastr["success"](successNo + successMsg);
		if(errorsNo > 0) toastr["error"](errorsNo + errorMsg);
	}

	function genericError(e) {
		console.error(e.responseText);
		toastr["error"]("Error Interno del Servidor.");
	}

	/* ................. Course ................ */ 

	// Multiple Delete
	$('body').on('click','#CourseMultipleDelete', function(){
		ajaxPost('course','multiple-delete',successMultipleDelete);
	});

	/* ................ Category ............... */ 

	// Multiple Delete
	$('body').on('click','#CategoryMultipleDelete', function(){
		ajaxPost('category','multiple-delete',successMultipleDelete);
	});

	/* ............... Instructors .............. */ 

	// Multiple Delete
	$('body').on('click','#InstructorMultipleDelete', function(){
		ajaxPost('instructor','multiple-delete',successMultipleDelete);
	});

	/* ............... Postulados .............. */ 

	// Multiple Delete
	$('body').on('click','#PostulateMultipleDelete', function(){
		ajaxPost('postulate','multiple-delete',successMultipleDelete);
	});

	// Postularse
	$('body').on('click','#PostulateAprobar', function(){
		ajaxPost('postulate','aprobar-postulados', function(res) {
			toastr["success"]("Postulados Aprobados.");
		});
	});

	/* ................ Schedule ............... */ 
	
	// Multiple Delete
	$('body').on('click','#ScheduleMultipleDelete', function(){
		ajaxPost('schedule','multiple-delete',successMultipleDelete);
	});

	// Postularse
	$('body').on('click','#ScheduleMyButton2', function(){
		ajaxPost('schedule','postularse', function(res) {
			toastr["success"]("Postulado exitosamente.");
		});
	});

});

