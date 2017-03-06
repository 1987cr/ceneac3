$(document).ready(function() {

	// Select2
	$("#role-permisos").select2();
	$("#course-category_id").select2();
	$("#schedule-course_id").select2();
	//$("#").select2();
	//$("#").select2();
	//$("#").select2();
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