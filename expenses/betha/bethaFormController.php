<?php

$rootDirectoryFileSelect = $_SERVER['DOCUMENT_ROOT'] . "/LocalTransportofficeWebsite/";
include_once $rootDirectoryFileSelect ."/includes/functions.php";


if($_SERVER["REQUEST_METHOD"] == "POST"){

print_r($_POST);

    
    $CrudOperation = new CrudOperation();   
    
    $vehicleRegistrationNo  = $_POST['vehicleNumber'];
    $material               = $_POST['Material'];
    $createdOn              = date('Y-m-d H:i:s');
    $destinationAddress     = $_POST['siteSelection'];
    $measurement            = $_POST['NumberOfSankra'];
    $price                  = $_POST['ratePerSankra'];
    $allowance              = $_POST['allowance'];
    $totalAmount            = $_POST['selectedContractorStoreAmount'];
    $processDescription     = " <h6>بقایا ($totalAmount) +  <br>  آج ($allowance) </h6>". $_POST['description'] ;
    $fkContractorId         = $_POST['selectedcontractorId'];

    if( $vehicleRegistrationNo != "" AND $createdOn != "" AND $destinationAddress != "" AND $measurement != "" AND $price != ""  AND $allowance != ""  AND $totalAmount != ""   AND $fkContractorId != ""){
        $tableName = 'contractorkhata';

        $totalAmount = $totalAmount + $allowance;
        $dataToInsert = array(
            'vehicleRegistrationNo' => $vehicleRegistrationNo,
            'createdOn'             => $createdOn,
            'destinationAddress'    => $destinationAddress,
            'measurement'           => $measurement,
            'price'                 => $price,
            'allowance'             => $allowance,
            'totalAmount'           => $totalAmount,
            'processDescription'    => $processDescription,
            'fkContractorId'        => $fkContractorId,
            'material'        => $material,
        );


        if($CrudOperation->createRecords($tableName , $dataToInsert)){
            header("Location: bethaForm.php?status=success");
            exit();
        } else {
            header("Location: bethaForm.php?status=error");
            exit();
        }

    }else{
        echo "Not working";
    }
    

  
}


?>














<!-- // $_POST['selectedcontractor'],
// $_POST['vehicleNumber'],
// $_POST['calculatedRateNumberOfTotalSankra'],
// $_POST['NumberOfSankra'] ,
// $_POST['ratePerSankra'] ,
// $_POST['submitcontractorkhata'], -->