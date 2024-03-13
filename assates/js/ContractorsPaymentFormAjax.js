
// GET Form and Table  __DIR__  expenses/betha/ContractorDailyEntryForm.php 
$(document).ready(function () {


    function performAjax(selectedContractorId) {

        if (selectedContractorId != "NULL") {
            console.log("here work");

            var selectedContractorName = $('#selectedContractorId option:selected').text();
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
                    // response.form[0].newAmount;
                    // $('.selectedContractorOldAmount').val(response.form[0].newAmount);

                    if (response.form != null) {
                        if (response.form[0].newAmount != null) {
                            console.log(response.form[0].newAmount);
                            $('.selectedContractorStoreAmount').val(response.form[0].newAmount);
                        } else {
                            $('.selectedContractorStoreAmount').val(10);

                        }
                    } else {
                        $('.selectedContractorStoreAmount').val(0);
                    }
                },
                error: function () {
                    alert('An error occurred while processing your request payment.');
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
    }

    var selectedContractorId = $('#selectedContractorId').val();
    if (selectedContractorId != "") {
        // console.log("defalut");
        performAjax(selectedContractorId);
    }
    $('#selectedContractorId').change(function () {
        // console.log("on change");
        var selectedContractorId = $(this).val();
        performAjax(selectedContractorId);
    });
});

// GET ContractorData in Form and Table __DIR__ expenses/betha/ContractorDailyEntryForm.php
function calculateResultOfContractor_PaymentAmount_OldAmount_NewAmount() {
    var selectedContractorOldAmount = parseFloat(document.getElementById('selectedContractorOldAmount').value) || 0;
    var selectedContractorPaymentAmount = parseFloat(document.getElementById('selectedContractorPaymentAmount').value) || 0;
    if (!isNaN(selectedContractorOldAmount) && !isNaN(selectedContractorPaymentAmount)) {
        var selectedContractorNewAmount = selectedContractorOldAmount - selectedContractorPaymentAmount;
        document.getElementById("selectedContractorNewAmount").value = selectedContractorNewAmount;
    }
}

// handel empty filed validation
$(document).ready(function () {
    $('form').submit(function (event) {
        var formValid = true;

        $('.validation').each(function () {
            if ($(this).val() === '') {
                $(this).addClass('error-border');
                formValid = false;
            } else {
                $(this).removeClass('error-border');
            }
        });
        // If any Input is empty, prevent form submission
        if (!formValid) {
            event.preventDefault();
        }
    });

    // Add an event listener to remove the error class when the input changes
    $('.validation ').on('input', function () {
        if ($(this).val() !== '') {
            $(this).removeClass('error-border');
        }
    });
});

// error and success message 
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
    $('#selectedContractor').change(function () {
        $(this).find('option[value="NULL"]').prop('disabled', true);
    });
});



