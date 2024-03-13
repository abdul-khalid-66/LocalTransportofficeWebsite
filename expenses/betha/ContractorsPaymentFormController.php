<?php

$rootDirectoryFileSelect = $_SERVER['DOCUMENT_ROOT'] . "/LocalTransportofficeWebsite/";
include_once $rootDirectoryFileSelect ."/includes/functions.php";
include_once $rootDirectoryFileSelect ."/components/components.php";

$CrudOperation = new CrudOperation();
if (isset($_POST['submitselectedContractorPayment']) AND $_POST['submitselectedContractorPayment'] = 'submitselectedContractorPayment') {
  
    $dealerName                             = ($_POST['dealerName']);
    $selectedContractorId                   = ($_POST['selectedContractorId']);
    $selectedContractorNewAmount            = ($_POST['selectedContractorNewAmount']); 
    $selectedContractorPaymentAmount        = ($_POST['selectedContractorPaymentAmount']); 
    $selectedContractorOldAmount            = ($_POST['selectedContractorStoreAmount']); 
    $selectedContractorFormOfPaymentDiseal  = ($_POST['selectedContractorFormOfPaymentDiseal']); 
    $selectedContractorFormOfPaymentLoan    = ($_POST['selectedContractorFormOfPaymentLoan']); 
    $selectedContractorFormOfPaymentCash    = ($_POST['selectedContractorFormOfPaymentCash']); 
    $selectedContractorDescription          = ($_POST['selectedContractorDescription']); 

    $createdOn              = date('Y-m-d H:i:s');
    if($dealerName != "" AND $selectedContractorId != "" AND $selectedContractorNewAmount != "" AND $selectedContractorPaymentAmount != "" AND $selectedContractorOldAmount != "")
    {
        


$tableContractorAccounts = 'contractorspayments';

$insertDataToContractorAccounts = array(
    'createdOn'             => 	$createdOn ,
    'OldAmount'             => 	$selectedContractorOldAmount  ,
    'paymentAmount'         => 	$selectedContractorPaymentAmount  ,
    'cash'                  => 	$selectedContractorFormOfPaymentCash  ,
    'loan'                  => 	$selectedContractorFormOfPaymentLoan  ,
    'diseal'                => 	$selectedContractorFormOfPaymentDiseal  ,
    'newAmount'             => 	$selectedContractorNewAmount  ,
    'processDescription'    => 	$selectedContractorDescription  ,
    'fkContractorId'        => 	$selectedContractorId  ,
    'dealer'                =>   $dealerName  
);



if($CrudOperation->createRecords($tableContractorAccounts , $insertDataToContractorAccounts)){
    header("Location: ContractorDailyEntryForm.php?status=success");
    exit();
}else{
    header("Location: ContractorDailyEntryForm.php?status=error");
    exit();
}











    }else{
        header("Location: ContractorsPaymentForm.php?status=error");
    }


} else {
    echo json_encode("Invalid request.");
}

?>

          