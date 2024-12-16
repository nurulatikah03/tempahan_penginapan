jQuery(document).ready(function () {
    $("#nd_booking_archive_form_date_range_from, #nd_booking_archive_form_date_range_to").on("change", function () {
        calculateTotal();
    });
    jQuery(function ($) {
        // Helper function to calculate the number of days between two dates
        function calculateNumberOfDays(fromDate, toDate) {
            const timeDiff = toDate - fromDate;
            return Math.ceil(timeDiff / (1000 * 60 * 60 * 24)); // Convert milliseconds to days
        }

        // Function to update the number of days input field
        function updateNumberOfDays() {
            const fromDate = $("#nd_booking_archive_form_date_range_from").datepicker("getDate");
            const toDate = $("#nd_booking_archive_form_date_range_to").datepicker("getDate");

            if (fromDate && toDate) {
                const days = calculateNumberOfDays(fromDate, toDate);
                $("#numberOfDays").val(days).trigger("change"); // Ensure change event is triggered
            } else {
                $("#numberOfDays").val("").trigger("change"); // Clear and trigger change event
            }
        }

        $("#nd_booking_archive_form_date_range_from, #nd_booking_archive_form_date_range_to").on("change", function () {
            updateNumberOfDays();
            calculateTotal(); // Directly call calculateTotal to ensure updates
        });

        // Initialize the "from" datepicker
        $("#nd_booking_archive_form_date_range_from").datepicker({
            defaultDate: "+0",
            minDate: 0,
            dateFormat: "dd/mm/yy",
            onSelect: function (selectedDate) {
                const selectedDateObj = $(this).datepicker("getDate");

                // Calculate the next day for the "to" datepicker
                const nextDay = new Date(selectedDateObj);
                nextDay.setDate(nextDay.getDate() + 1);

                // Update the "to" datepicker's minDate and set its value
                $("#nd_booking_archive_form_date_range_to").datepicker("option", "minDate", nextDay);
                $("#nd_booking_archive_form_date_range_to").datepicker("setDate", nextDay);

                // Update hidden fields and the number of days
                $("#date_from").val($.datepicker.formatDate("dd/mm/yy", selectedDateObj));
                $("#date_to").val($.datepicker.formatDate("dd/mm/yy", nextDay));
                updateNumberOfDays();
            }
        });

        // Initialize the "to" datepicker
        $("#nd_booking_archive_form_date_range_to").datepicker({
            defaultDate: "+1",
            minDate: "+1d",
            dateFormat: "dd/mm/yy",
            onSelect: function (selectedDate) {
                const selectedDateObj = $(this).datepicker("getDate");

                // Update the hidden field for "date_to" and the number of days
                $("#date_to").val($.datepicker.formatDate("dd/mm/yy", selectedDateObj));
                updateNumberOfDays();
            }
        });

        // Set default dates on page load
        const today = new Date();
        const tomorrow = new Date();
        tomorrow.setDate(today.getDate() + 1);

        $("#nd_booking_archive_form_date_range_from").datepicker("setDate", today);
        $("#nd_booking_archive_form_date_range_to").datepicker("setDate", tomorrow);

        // Initialize hidden fields and the number of days
        $("#date_from").val($.datepicker.formatDate("dd/mm/yy", today));
        $("#date_to").val($.datepicker.formatDate("dd/mm/yy", tomorrow));
        updateNumberOfDays();
    });
});
