$(document).ready(function () {
    $('#NumberoOfRecords').change(function () {
        var selectedValue = $(this).val();
        $.ajax({
            url: 'ContractorsTablesAjaxController.php',
            method: 'POST',
            data: { limit: selectedValue },
            success: function (response) {
                console.log(response);
                var updatedLimit = response;
                console.log(updatedLimit);
            },
            error: function () {
                alert('An error occurred while processing your request.');
            }
        });
    });
});

$(document).ready(function () {
    $("#example").DataTable();
});