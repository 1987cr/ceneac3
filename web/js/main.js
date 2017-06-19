// Debug Mode
var debug = true;

/* ------------------------------------- */
/* ............... Helper ............... */
/* ------------------------------------- */

// Simula que la tecla enter ha sido presionada,
// hace submit al formulario.
var enterPressed = function(context) {
  var e = jQuery.Event("keydown");
  e.which = 13;
  e.keyCode = 13;
  $(context).trigger(e);
};

/* ------------------------------------- */
/* ................ Ajax ............... */
/* ------------------------------------- */

var ajaxPost = function(model, action, successCb, errorCb) {
  errorCb = typeof errorCb !== "undefined" ? errorCb : genericError;

  var selectedRowsId = $("#pjax").yiiGridView("getSelectedRows");

  if (!!selectedRowsId.length) {
    $.ajax({
      type: "POST",
      url: "/web/" + model + "/" + action,
      data: { row_id: selectedRowsId },
      success: successCb,
      error: errorCb
    });
  } else {
    toastr["warning"]("No se seleccionaron elementos.");
  }
};

var successMultipleDelete = function(res) {
  !debug && $.pjax.reload({ container: "#pjax" });

  var resArr = res.split(",");

  var errorsNo = resArr.filter(function(el) {
    return el === "error";
  }).length;
  var successNo = resArr.filter(function(el) {
    return el === "deleted";
  }).length;

  var successMsg = successNo > 1
    ? " elementos eliminados."
    : " elemento eliminado.";
  var errorMsg = (errorsNo > 1 ? " errores" : " error") + " de dependencia.";

  if (successNo > 0) toastr["success"](successNo + successMsg);
  if (errorsNo > 0) toastr["error"](errorsNo + errorMsg);
};

var genericError = function(e) {
  console.error(e.responseText);
  toastr["error"]("Error Interno del Servidor.");
};

/* ------------------------------------- */
/* .............. Select2 ............... */
/* ------------------------------------- */

var CREATE_SELECTS = [
  "#role-permisos",
  "#course-category_id",
  "#schedule-course_id",
  "#instructor-user_id",
  "#instructor-schedule_id",
  "#instructor-schedule_id",
  "#registered-user_id",
  "#registered-schedule_id",
  "#preregistered-user_id",
  "#preregistered-schedule_id",
  "#payment-preregister_id",
  "#payment-payment_type",
  "#interestlist-user_id",
  "#interestlist-course_id",
  "#postulate-schedule_id",
  "#postulate-user_id"
];

var SEARCH_SELECTS = ["#schedulesearch-course_id"];

var initSelect2 = function(selectors) {
  selectors.forEach(function(sel) {
    $(sel).select2();
  });
};

/* ------------------------------------- */
/* ............. Date Range ............. */
/* ------------------------------------- */

var SEARCH_DATE_RANGE = [
  "input[name='ScheduleSearch[start_date]']",
  "input[name='ScheduleSearch[end_date]']"
  // "input[name='PreregisteredSearch[preregister_date]']",
  // "input[name='InterestListSearch[start_date]']",
  // "input[name='PaymentSearch[payment_date]']",
];

var DATE_RANGE_CONFIG = {
  autoUpdateInput: false,
  startDate: moment().startOf("month"),
  endDate: moment(),
  showDropdowns: true,
  alwaysShowCalendars: true,
  opens: "center",
  ranges: {
    Hoy: [moment(), moment()],
    Ayer: [moment().subtract(1, "days"), moment().subtract(1, "days")],
    "Últimos 7 días": [moment().subtract(6, "days"), moment()],
    "Últimos 30 días": [moment().subtract(29, "days"), moment()],
    "Este mes": [moment().startOf("month"), moment().endOf("month")],
    "Mes pasado": [
      moment().subtract(1, "month").startOf("month"),
      moment().subtract(1, "month").endOf("month")
    ]
  },
  locale: {
    cancelLabel: "Limpiar",
    applyLabel: "Applicar",
    customRangeLabel: "Personalizado",
    daysOfWeek: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"],
    monthNames: [
      "Enero",
      "Febrero",
      "Marzo",
      "Abril",
      "Mayo",
      "Junio",
      "Julio",
      "Agosto",
      "Septiembre",
      "Octubre",
      "Noviembre",
      "Diciembre"
    ]
  }
};

// On Apply Callback
var onApplyDatepicker = function(ev, picker) {
  $(this).val(
    picker.startDate.format("DD-MM-YYYY") +
      " a " +
      picker.endDate.format("DD-MM-YYYY")
  );
  enterPressed(this);
};

// On Cancel Callback
var onCancelDatepicker = function(ev, picker) {
  $(this).val("");
  enterPressed(this);
};

var initDateRangePicker = function(selectors) {
  selectors.forEach(function(sel) {
    $(sel)
      .daterangepicker(DATE_RANGE_CONFIG)
      .on("apply.daterangepicker", onApplyDatepicker)
      .on("cancel.daterangepicker", onCancelDatepicker);
  });
};

/* ------------------------------------- */
/* ............ Date Picker ............. */
/* ------------------------------------- */

var DATE_PICKER_CONFIG = {
  language: "es",
  format: "dd-mm-yyyy",
  startDate: "0d"
};

var CREATE_DATE_PICKERS = [
  "#schedule-start_date",
  "#schedule-end_date",
  "#preregistered-preregister_date",
  "#payment-payment_date",
  "#interestlist-start_date"
];

var initDatePicker = function(selectors) {
  selectors.forEach(function(sel) {
    $(sel).datepicker(DATE_PICKER_CONFIG);
  });
};

/* ------------------------------------- */
/* ............ Time Picker ............. */
/* ------------------------------------- */

var TIME_PICKER_CONFIG = {
  timeFormat: "h:mm p",
  interval: 30,
  minTime: "10:00am",
  maxTime: "6:00pm",
  startTime: "10:00",
  dropdown: true,
  scrollbar: true
};

var CREATE_TIME_PICKERS = ["#schedule-start_hour", "#schedule-end_hour"];

var SEARCH_TIME_PICKERS = [
  "input[name='ScheduleSearch[start_hour]']",
  "input[name='ScheduleSearch[end_hour]']"
];

var initTimePicker = function(selectors) {
  selectors.forEach(function(sel) {
    $(sel).timepicker(TIME_PICKER_CONFIG);
  });
};

/* ------------------------------------- */
/* ................ Pjax ................ */
/* ------------------------------------- */

// Llamado después de actualizar un search
$(document).on("pjax:success", function() {
  initSelect2(SEARCH_SELECTS);
  initDateRangePicker(SEARCH_DATE_RANGE);
  initTimePicker(SEARCH_TIME_PICKERS);
});

/* ------------------------------------- */
/* ........... Document Ready ............ */
/* ------------------------------------- */

$(document).ready(function() {
  initSelect2(CREATE_SELECTS);
  initSelect2(SEARCH_SELECTS);

  initDateRangePicker(SEARCH_DATE_RANGE);

  initDatePicker(CREATE_DATE_PICKERS);

  initTimePicker(CREATE_TIME_PICKERS);
  initTimePicker(SEARCH_TIME_PICKERS);

  // TO-DO: Cambiar estos a date range, modificar SearchClass de cada uno para dividir la fecha
  // igual que el ScheduleSearch
  $("input[name='PreregisteredSearch[preregister_date]']").datepicker({
    language: "es",
    format: "dd-mm-yyyy",
    startDate: new Date("2015")
  });

  $("input[name='InterestListSearch[start_date]']").datepicker({
    language: "es",
    format: "dd-mm-yyyy",
    startDate: new Date("2015")
  });

  $("input[name='PaymentSearch[payment_date]']").datepicker({
    language: "es",
    format: "dd-mm-yyyy",
    startDate: new Date("2015")
  });

  /* ................. Backups ................ */

  // Create
  $("body").on("click", "#CreateBackup", function() {
    $.ajax({
      type: "POST",
      url: "/web/backup/backup",
      success: function() {
        toastr["success"]("Backup creado satisfactoriamente.");
      },
      error: genericError
    });
  });

  /* ................. Course ................ */

  // Multiple Delete
  $("body").on("click", "#CourseMultipleDelete", function() {
    ajaxPost("course", "multiple-delete", successMultipleDelete);
  });

  /* ................ Category ............... */

  // Multiple Delete
  $("body").on("click", "#CategoryMultipleDelete", function() {
    ajaxPost("category", "multiple-delete", successMultipleDelete);
  });

  /* ............. Interest List ............ */

  // Multiple Delete
  $("body").on("click", "#InterestedMultipleDelete", function() {
    ajaxPost("interest-list", "multiple-delete", successMultipleDelete);
  });

  /* ............... Instructors .............. */

  // Multiple Delete
  $("body").on("click", "#InstructorMultipleDelete", function() {
    ajaxPost("instructor", "multiple-delete", successMultipleDelete);
  });

  /* ................ Payment ............... */

  // Multiple Delete
  $("body").on("click", "#PaymentMultipleDelete", function() {
    ajaxPost("payment", "multiple-delete", successMultipleDelete);
  });

  /* ............... Postulados .............. */

  // Multiple Delete
  $("body").on("click", "#PostulateMultipleDelete", function() {
    ajaxPost("postulate", "multiple-delete", successMultipleDelete);
  });

  // Postularse
  $("body").on("click", "#PostulateAprobar", function() {
    ajaxPost("postulate", "aprobar-postulados", function(res) {
      !debug && $.pjax.reload({ container: "#pjax" });
      toastr["success"]("Postulados Aprobados.");
    });
  });

  /* ............. Pre-Registered ............ */

  // Multiple Delete
  $("body").on("click", "#PreregisteredMultipleDelete", function() {
    ajaxPost("preregistered", "multiple-delete", successMultipleDelete);
  });

  /* ............... Registered .............. */

  // Multiple Delete
  $("body").on("click", "#RegisteredMultipleDelete", function() {
    ajaxPost("registered", "multiple-delete", successMultipleDelete);
  });

  /* ................ Schedule ............... */

  // Multiple Delete
  $("body").on("click", "#ScheduleMultipleDelete", function() {
    ajaxPost("schedule", "multiple-delete", successMultipleDelete);
  });

  // Postularse
  $("body").on("click", "#ScheduleMyButton2", function() {
    ajaxPost("schedule", "postularse", function(res) {
      !debug && $.pjax.reload({ container: "#pjax" });
      toastr["success"]("Postulado exitosamente.");
    });
  });
});
