<?php

$rootDirectoryFileSelect = $_SERVER['DOCUMENT_ROOT'] . "/LocalTransportofficeWebsite/";
include_once $rootDirectoryFileSelect ."/includes/functions.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){


    $CrudOperation = new CrudOperation();   
    
    $vehicleRegistrationNo  = $_POST['vehicleNumber'];
    $material               = $_POST['Material'];
    $createdOn              = date('Y-m-d H:i:s');
    $destinationAddress     = $_POST['siteSelection'];
    $measurement            = $_POST['NumberOfSankra'];
    $price                  = $_POST['ratePerSankra'];
    $allowance              = $_POST['allowance'];
    $oldAmount            = $_POST['selectedContractorStoreAmount'];
    $processDescription     = " <h6>بقایا ($oldAmount) +  <br>  آج ($allowance) </h6>". $_POST['description'] ;
    $fkContractorId         = $_POST['selectedcontractorId'];

    if( $vehicleRegistrationNo != "" AND $createdOn != "" AND $destinationAddress != "" AND $measurement != "" AND $price != ""  AND $allowance != ""  AND $oldAmount != ""   AND $fkContractorId != ""){
        $tableNamecontractordailyaccount = 'contractorkhata';

        $totalAmount = $oldAmount + $allowance;
        $dataToInsertcontractordailyaccount = array(
            'vehicleRegistrationNo' => $vehicleRegistrationNo,
            'createdOn'             => $createdOn,
            'destinationAddress'    => $destinationAddress,
            'measurement'           => $measurement,
            'price'                 => $price,
            'allowance'             => $allowance,
            'totalAmount'           => $totalAmount,
            'paymentAmount'         => 0,
            'processDescription'    => $processDescription,
            'fkContractorId'        => $fkContractorId,
            'material'              => $material
        );

        if($CrudOperation->createRecords($tableNamecontractordailyaccount , $dataToInsertcontractordailyaccount)){
            $lastInsertedId = $CrudOperation->getLastInsertId();

            $tableContractorAccounts = 'contractorspayments';
            $remainingAmount = $totalAmount - 0;

            $insertDataToContractorAccounts = array(
            'createdOn' => $createdOn  ,	
            'OldAmount' => $allowance  ,	
            'paymentAmount' => 0  ,	
            'cash' => 0,	
            'loan' => 0,	
            'diseal	' => 0,
            'newAmount' => $remainingAmount,	
            'processDescription	' => $processDescription ,
            'fkContractorId' => $fkContractorId  ,
            'fkContractorKhataId' =>  $lastInsertedId
            );
            
            if($CrudOperation->createRecords($tableContractorAccounts , $insertDataToContractorAccounts)){

                header("Location: ContractorDailyEntryForm.php?status=success");
                exit();
            }else{
                                
                header("Location: ContractorDailyEntryForm.php?status=error");
                exit();
            }
            
        } else {
            header("Location: ContractorDailyEntryForm.php?status=error");
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