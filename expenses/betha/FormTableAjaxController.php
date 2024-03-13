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

    $table = "Contractors";
    $columns = "contractorkhata.vehicleRegistrationNo ,contractorkhata.createdOn ,contractorkhata.destinationAddress ,contractorkhata.material ,contractorkhata.measurement ,contractorkhata.price ,contractorkhata.allowance ,contractorkhata.processDescription ,contractorkhata.fkContractorId ,contractorspayments.OldAmount ,contractorspayments.paymentAmount ,contractorspayments.cash ,contractorspayments.loan ,contractorspayments.diseal ,contractorspayments.newAmount ,contractorspayments.processDescription ,contractorspayments.dealer ";
    $where = " Contractors.pkContractorId = ". $pkContractorId;
    $join = "  pkContractorKhataId Desc";
    $join = "   join contractorkhata on contractorkhata.fkContractorId = Contractors.pkContractorId
                Join contractorspayments on contractorspayments.fkContractorId = Contractors.pkContractorId
                ";
    $orderBy = " contractorspayments.pkcontractorspaymentsId Desc";
    $limit = 1;
    $formResult = $CrudOperation->readRecords($table, $columns, $where, null, $join, $limit, null,null,$orderBy);


    
    $table = "contractorkhata";
    $columns = "*";
    $where = " fkContractorId = ". $pkContractorId;
    $orderBy = " pkContractorKhataId Desc";
    $join =  " Join contractors ON fkContractorId = pkContractorId ";
    $limit = null;
    $tableResult = $CrudOperation->readRecords($table, $columns, $where, null, $join, $limit, null,null,$orderBy);
    $pagination = $CrudOperation->pagination($table, $where, null, $limit);
    

    $response = array('table' => $tableResult, 'form' => $formResult , 'pagination' => $pagination);
    echo json_encode($response);
} else {
    echo json_encode("Invalid request.");
}

?>
