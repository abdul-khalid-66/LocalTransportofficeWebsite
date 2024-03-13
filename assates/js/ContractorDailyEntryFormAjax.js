
// GET Form and Table  __DIR__  expenses/betha/ContractorDailyEntryForm.php 
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
                    console.log("response");
                    console.log(response);
                    if (response.form.length > 0) {
                        if (response.form[0].newAmount != null) {
                            $('.selectedContractorStoreAmount').val(response.form[0].newAmount);
                        } else {
                            $('.selectedContractorStoreAmount').val(0);

                        }
                    } else {
                        $('.selectedContractorStoreAmount').val(0);
                    }
                    if (response.table != null) {
                        $('#table-container').html(response.table);
                    } else {
                        $('#table-container').html("<h1>table not exist</h1>");
                    }
                    // $('#pagination-container').html(response.pagination);

                },
                error: function () {
                    alert('An error occurred while processing your request daily entry.');
                }
            });

        }
        else {
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



