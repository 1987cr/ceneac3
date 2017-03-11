$(document).ready(function() {

	// Select2
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


	// Datepicker
	$("#schedule-start_date").datepicker({
	 	language: 'es',
	 	format: 'yyyy-mm-dd',
	 	startDate: '0d'
	});
	$("#schedule-end_date").datepicker({
	 	language: 'es',
	 	format: 'yyyy-mm-dd',
	 	startDate: '0d'
	});

	$("#preregistered-preregister_date").datepicker({
	 	language: 'es',
	 	format: 'yyyy-mm-dd',
	 	startDate: '0d'
	});

	$("#payment-payment_date").datepicker({
	 	language: 'es',
	 	format: 'yyyy-mm-dd',
	 	startDate: '0d'
	});

	//Timepickers


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
})
