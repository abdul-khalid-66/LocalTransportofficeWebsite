
// GET Form and Table  __DIR__  expenses/betha/bethaForm.php 
$(document).ready(function () {
    $('#selectedcontractor').change(function () {
        var selectedContractorId = $(this).val();
        $.ajax({
            url: 'bethaLogic.php',
            method: 'POST',
            data: { selectedContractorId: selectedContractorId },
            dataType: 'json',
            success: function (response) {
                $('#table-container').html(response.table);
                $('#form-container').html(response.form);
            },
            error: function () {
                alert('An error occurred while processing your request.');
            }
        });
    });
});


// GET ContractorData in Form and Table __DIR__ expenses/betha/bethaForm.php 

function calculateResult() {
    var NumberOfSankra = parseFloat(document.getElementById('NumberOfSankra').value) || 0;
    var ratePerSankra = parseFloat(document.getElementById('ratePerSankra').value) || 0;
    if (!isNaN(NumberOfSankra) && !isNaN(ratePerSankra)) {
        var calculatedRatePerSankraWithNumberOfSankra = NumberOfSankra * ratePerSankra;
        document.getElementById('calculatedRateNumberOfTotalSankra').value = calculatedRatePerSankraWithNumberOfSankra;
    }
}