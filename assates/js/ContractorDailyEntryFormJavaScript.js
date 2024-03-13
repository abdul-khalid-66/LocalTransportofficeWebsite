
// GET ContractorData in Form and Table __DIR__ expenses/betha/ContractorDailyEntryForm.php

function calculateResult() {
    var NumberOfSankra = parseFloat(document.getElementById('NumberOfSankra').value) || 0;
    var ratePerSankra = parseFloat(document.getElementById('ratePerSankra').value) || 0;
    if (!isNaN(NumberOfSankra) && !isNaN(ratePerSankra)) {
        var calculatedRatePerSankraWithNumberOfSankra = NumberOfSankra * ratePerSankra;
        document.getElementById('allowance').value = calculatedRatePerSankraWithNumberOfSankra;
    }
}


document.addEventListener('DOMContentLoaded', function () {
    const successMessage = document.getElementById('successMessage');
    const errorMessage = document.getElementById('errorMessage');
    if (successMessage) {
        removeQueryString();
        setTimeout(function () {
            successMessage.style.display = 'none';
        }, 5000);
    } else if (errorMessage) {
        removeQueryString();
        setTimeout(function () {
            errorMessage.style.display = 'none';
        }, 5000);
    }
    function removeQueryString() {
        const urlWithoutQueryString = window.location.pathname + window.location.search.replace(/\?status=.*/, '');
        history.replaceState({}, document.title, urlWithoutQueryString);
    }
});





$(document).ready(function () {
    $('#selectedcontractor').change(function () {
        $(this).find('option[value="NULL"]').prop('disabled', true);
    });
});
