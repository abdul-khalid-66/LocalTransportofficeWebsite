$(document).ready(function () {
    $('#NumberoOfRecords').change(function () {
        var selectedValue = $(this).val();
        $.ajax({
            url: 'bethaTableAjax.php',
            method: 'POST',
            data: { limit: selectedValue },
            success: function (response) {

                var updatedLimit = response;
                console.log(updatedLimit);
            },
            error: function () {
                alert('An error occurred while processing your request.');
            }
        });
    });
});



// datatable jQuery
$(document).ready(function () {
    $("#example").DataTable();
});