jQuery(document).ready(function () {
  jQuery(function ($) {
      $("#nd_booking_archive_form_date_range_from").datepicker({
          defaultDate: "+1w",
          minDate: 0,
          altField: "#nd_booking_date_month_from",
          altFormat: "M",
          firstDay: 0,
          dateFormat: "dd/mm/yy",
          monthNames: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
          monthNamesShort: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
          dayNamesMin: ["SU", "MO", "TU", "WE", "TH", "FR", "SA"],
          nextText: "NEXT",
          prevText: "PREV",
          changeMonth: false,
          numberOfMonths: 1,
          onClose: function () {
              var minDate = $(this).datepicker("getDate");
              var newMin = new Date(minDate.setDate(minDate.getDate() + 1));
              $("#nd_booking_archive_form_date_range_to").datepicker("option", "minDate", newMin);

              // Update the selected dates dynamically
              var nd_booking_input_date_from = $("#nd_booking_archive_form_date_range_from").val();
              var nd_booking_input_date_to = $("#nd_booking_archive_form_date_range_to").val();
              $("#display-check-in").text(nd_booking_input_date_from || "N/A");
              $("#display-check-out").text(nd_booking_input_date_to || "N/A");
          }
      });

      $("#nd_booking_archive_form_date_range_to").datepicker({
          defaultDate: "+1w",
          minDate: "+1d",
          dateFormat: "dd/mm/yy",
          monthNames: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
          monthNamesShort: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
          dayNamesMin: ["SU", "MO", "TU", "WE", "TH", "FR", "SA"],
          nextText: "NEXT",
          prevText: "PREV",
          numberOfMonths: 1,
          onClose: function () {
              // Update the selected dates dynamically
              var nd_booking_input_date_from = $("#nd_booking_archive_form_date_range_from").val();
              var nd_booking_input_date_to = $("#nd_booking_archive_form_date_range_to").val();
              $("#display-check-in").text(nd_booking_input_date_from || "N/A");
              $("#display-check-out").text(nd_booking_input_date_to || "N/A");
          }
      });

      // Set default dates
      $("#nd_booking_archive_form_date_range_from").datepicker("setDate", "+0");
      $("#nd_booking_archive_form_date_range_to").datepicker("setDate", "+1");
  });
});
