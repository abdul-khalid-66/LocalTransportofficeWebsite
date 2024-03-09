
// GET Form and Table  __DIR__  expenses/betha/ContractorFormController.php 
$(document).ready(function () {
    $('#selectedcontractor').change(function () {
        var selectedContractorId = $(this).val()


        if (selectedContractorId != "NULL") {

            var selectedContractorName = $('#selectedcontractor option:selected').text();
            var selectedContractorCnic = selectedContractorName.split(' ( ')[1].slice(0, -2);

            $.ajax({
                url: 'FormTableAjaxController.php',
                method: 'POST',
                data: {
                    selectedContractorId: selectedContractorId,
                    selectedContractorName: selectedContractorName,
                    selectedContractorCnic: selectedContractorCnic
                },
                dataType: 'json',
                success: function (response) {
                    // console.log("LLLLLLLLLLLLLLLLLLLLLlll")selectedContractorStoreAmount
                    console.log(response.form[0].totalAmount);
                    $('#table-container').html(response.table);
                    $('.selectedContractorStoreAmount').val(response.form[0].totalAmount);
                    $('#pagination-container').html(response.pagination);
                },
                error: function () {
                    alert('An error occurred while processing your request.');
                }
            });

        } else {
            $.ajax({
                url: 'FormTableAjaxController.php',
                method: 'POST',
                data: {
                    removeSelectedRecords: true
                },
                dataType: 'json',
                success: function (response) {
                    console.log(response);
                },
                error: function () {
                    alert('An error occurred while processing your request.');
                }
            });
        }
    });
});

// GET ContractorData in Form and Table __DIR__ expenses/betha/ContractorFormController.php

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



