<?php

// All AJAX LOGIC Code 
header('Content-Type: application/json');

$rootDirectoryFileSelect = $_SERVER['DOCUMENT_ROOT'] . "/LocalTransportofficeWebsite/";
include_once $rootDirectoryFileSelect ."/includes/functions.php";
include_once $rootDirectoryFileSelect ."/components/components.php";


if (isset($_POST['selectedContractorId'])) {
    $pkContractorId = $_POST['selectedContractorId'];
    $selectedContractorName = $_POST['selectedContractorName'];
    $pkContractorId = $_POST['selectedContractorId'];
    $CrudOperation = new CrudOperation();

    
    // Get data by Contractorid from from dropdown 
    $table = "contractorkhata";
    $columns = " pkContractorKhataId , vehicleRegistrationNo , createdOn , destinationAddress , measurement	, price , allowance , totalAmount	, processDescription , fkContractorId";
    $where = " fkContractorId = ". $pkContractorId;
    $orderBy = " pkContractorKhataId	Desc";
    $limit = 1;
    $formResult = $CrudOperation->readRecords($table, $columns, $where, null, null, $limit, null,$orderBy);

    
    $table = "contractorkhata";
    $columns = "*";
    $where = " fkContractorId = ". $pkContractorId;
    $orderBy = " pkContractorKhataId Desc";
    $join =  " Join contractors ON fkContractorId = pkContractorId ";
    $limit = null;
    $tableResult = $CrudOperation->readRecords($table, $columns, $where, null, $join, $limit, null,$orderBy);
    $pagination = $CrudOperation->pagination($table, $where, null, $limit);
    

    $response = array('table' => $tableResult, 'form' => $formResult , 'pagination' => $pagination);
    echo json_encode($response);
} else {
    echo json_encode("Invalid request.");
}

?>
