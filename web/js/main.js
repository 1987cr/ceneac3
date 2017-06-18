// Debug Mode
var debug = true;
var start = moment().startOf("month");
var end = moment();

var DATE_RANGE_CONFIG = {
  autoUpdateInput: false,
  startDate: start,
  endDate: end,
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

// Simula que la tecla enter ha sido presionada,
// le hace submit al formulario.
var enterPressed = function(context) {
  var e = jQuery.Event("keydown");
  e.which = 13;
  e.keyCode = 13;
  $(context).trigger(e);
};

var onApplyDatepicker = function(ev, picker) {
  $(this).val(
    picker.startDate.format("DD-MM-YYYY") +
      " a " +
      picker.endDate.format("DD-MM-YYYY")
  );
  enterPressed(this);
};

var onCancelDatepicker = function(ev, picker) {
  $(this).val("");
  enterPressed(this);
};

$(document).ready(function() {
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

  /* ------------------------------------- */
  /* ............ Date Picker ............ */
  /* ------------------------------------- */

  $("#schedule-start_date").datepicker({
    language: "es",
    format: "dd-mm-yyyy",
    startDate: "0d"
  });

  $("#schedule-end_date").datepicker({
    language: "es",
    format: "dd-mm-yyyy",
    startDate: "0d"
  });

  $("input[name='ScheduleSearch[start_date]']")
    .daterangepicker(DATE_RANGE_CONFIG)
    .on("apply.daterangepicker", onApplyDatepicker)
    .on("cancel.daterangepicker", onCancelDatepicker);

  $("input[name='ScheduleSearch[end_date]']")
    .daterangepicker(DATE_RANGE_CONFIG)
    .on("apply.daterangepicker", onApplyDatepicker)
    .on("cancel.daterangepicker", onCancelDatepicker);

  $(document).on("pjax:success", function() {
    $("input[name='ScheduleSearch[start_date]']")
      .daterangepicker(DATE_RANGE_CONFIG)
      .on("apply.daterangepicker", onApplyDatepicker)
      .on("cancel.daterangepicker", onCancelDatepicker);

    $("input[name='ScheduleSearch[end_date]']")
      .daterangepicker(DATE_RANGE_CONFIG)
      .on("apply.daterangepicker", onApplyDatepicker)
      .on("cancel.daterangepicker", onCancelDatepicker);
  });

  $("input[name='PaymentSearch[payment_date]']").datepicker({
    language: "es",
    format: "dd-mm-yyyy",
    startDate: new Date("2015")
  });

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

  $("#preregistered-preregister_date").datepicker({
    language: "es",
    format: "dd-mm-yyyy",
    startDate: "0d"
  });

  $("#payment-payment_date").datepicker({
    language: "es",
    format: "dd-mm-yyyy",
    startDate: "0d"
  });

  $("#interestlist-start_date").datepicker({
    language: "es",
    format: "dd-mm-yyyy",
    startDate: "0d"
  });

  /* ------------------------------------- */
  /* ............ Time Picker ............ */
  /* ------------------------------------- */

  $("#schedule-start_hour").timepicker({
    timeFormat: "h:mm p",
    interval: 30,
    minTime: "10:00am",
    maxTime: "6:00pm",
    defaultTime: "10:00am",
    startTime: "10:00",
    dynamic: true,
    dropdown: true,
    scrollbar: true
  });

  $("#schedule-end_hour").timepicker({
    timeFormat: "h:mm p",
    interval: 30,
    minTime: "10:00am",
    maxTime: "6:00pm",
    defaultTime: "10:00am",
    startTime: "10:00",
    dynamic: true,
    dropdown: true,
    scrollbar: true
  });

  /* ------------------------------------- */
  /* ................ Ajax ............... */
  /* ------------------------------------- */

  function ajaxPost(model, action, successCb, errorCb) {
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
  }

  function successMultipleDelete(res) {
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
  }

  function genericError(e) {
    console.error(e.responseText);
    toastr["error"]("Error Interno del Servidor.");
  }

  /* ................. Backups ................ */

  // Multiple Delete
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
