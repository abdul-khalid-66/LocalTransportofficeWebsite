<?php

if(isset($_GET['ContractorId'])){


$rootDirectoryComponentsSelect = 'http://' . $_SERVER['HTTP_HOST'] . '/LocalTransportofficeWebsite/';

$rootDirectoryFileSelect = $_SERVER['DOCUMENT_ROOT'] . "/LocalTransportofficeWebsite/";
include_once $rootDirectoryFileSelect ."/components/components.php";
include_once $rootDirectoryFileSelect ."/includes/functions.php";

$Header = new Header($rootDirectoryComponentsSelect);
echo  $Header->getContent();

$Navbar = new Navbar($rootDirectoryComponentsSelect);
echo $Navbar->getContent();

$CrudOperation = new CrudOperation();


    $encryptedContractorId = $_GET['ContractorId'];
    $contractorId = base64_decode($encryptedContractorId);    
    
    $table = "Contractors";
    $columns = "
    contractorkhata.vehicleRegistrationNo, 
     contractorkhata.destinationAddress,
     contractorkhata.material,
     contractorkhata.measurement,
     contractorkhata.price,
     contractorkhata.allowance,
     
     contractorkhata.fkContractorId,

     contractorspayments.createdOn,
     contractorspayments.processDescription,

     contractorspayments.OldAmount,
     contractorspayments.paymentAmount,
     contractorspayments.cash,
     contractorspayments.loan,
     contractorspayments.diseal,
     contractorspayments.newAmount as remainingAmount ,
     contractorspayments.processDescription AS paymentPremainingAmountrocessDescription,
     contractorspayments.dealer AS paymentDealer,

    Contractors.pkContractorId as pkContractorId,
    Contractors.name as name,
    Contractors.contactPerson as contactPerson,
    Contractors.cnic as cnic,
    Contractors.phoneNumber as phoneNumber,
    Contractors.address as address,
    Contractors.registrationDate as registrationDate,
    Contractors.otherDetails as otherDetails     

    ";
    
    $where =" contractorspayments.fkContractorId  =" . $contractorId;
    $orderBy = null;
    $join = "  JOIN contractorkhata ON Contractors.pkContractorId = contractorkhata.fkContractorId RIGHT JOIN contractorspayments ON Contractors.pkContractorId = contractorspayments.fkContractorId AND contractorkhata.pkContractorKhataId = contractorspayments.fkContractorKhataId ";
    $limit = null;




    $tableResult = $CrudOperation->readRecords($table, $columns,  $where, null, $join , $limit, null,null,$orderBy);

?>


<div class="container">
<button class="btn btn-primary btn-sm my-3" onclick="goBack()">Go Back</button>
</div>

<h1 class="text-center"> ٹھیکیدار<?php echo  '<span style="color:green">'.$tableResult[0]['name'].'</span>  <span style="color:green">  </span>';  ?> کی
    فہرست</h1>
<div class="container">
    <table id="example1" class="table table-striped" style="width:100%;font-weight: bolder;">
        <thead>
            <tr style="background-color:black;color: azure;">
                <th style="color: azure;" class="text-center">ٹوٹل رقم</th>
                <th style="color: azure;" class="text-center">کل قیمت</th>
                <th style="color: azure;" class="text-center">ریٹ </th>
                <th style="color: azure;" class="text-center">ٹن/پیمائش</th>
                <th style="color: azure;" class="text-center">سائٹ</th>
                <th style="color: azure;" class="text-center">مواد کی قسم</th>
                <th style="color: azure;" class="text-center">گاڑی کا نمبر</th>
                <th style="color: azure;" class="text-center">تفصیل</th>
                <th style="color: azure;" class="text-center">تاریخ</th>
                <th style="color: azure;" class="text-center">سیریل</th>
            </tr>
        </thead>
        <tbody>
            <?php

            if (empty($tableResult)) {
                    echo'
                        <tr>
                            <td style="text-align: center;"> </td>
                            <td style="text-align: center;"> </td>
                            <td style="text-align: center;"> </td>
                            <td style="text-align: center;"> </td>
                            <td style="text-align: center;"> </td>
                            <td style="text-align: center;"> No Record Found</td>
                            <td style="text-align: center;"> </td>
                            <td style="text-align: center;"> </td>
                            <td style="text-align: center;"> </td>
                            <td style="text-align: center;"> </td>
                            <td style="text-align: center;"> </td>
                        </tr>
                    ';
                    }else{
                    $pkContractorKhataId = 0;
                    foreach($tableResult as $value){
                    $pkContractorKhataId++;
                    $processDescription = (strlen($value['processDescription']) > 25) ? substr($value['processDescription'], 0, 30) . '...' : $value['processDescription'];
                    
                    $encryptedContractorId = base64_encode($value['pkContractorId']);
                    $url = 'ContractorsTablesController.php?ContractorId=' . urlencode($encryptedContractorId);
                    if($value['measurement'] != ''){
                        echo '
                        <tr>
                            
                            <td id="" class="text-center" style="color:red">'. $value['remainingAmount'] .'</td>
                            <td id="" class="text-center" >'. $value['OldAmount'] .'</td>
                            <td id="" class="text-center" >'. $value['price'] .'</td>
                            <td id="" class="text-center" >'. $value['measurement'] .'</td>
                            <td id="" class="text-center" >'. $value['destinationAddress'] .'</td>
                            <td id="" class="text-center" >'. $value['material'] .'</td>
                            <td id="" class="text-center" >'. $value['vehicleRegistrationNo'] .'</td>
                        
                            <td id="contractorProcessDescription" class="customTooltip text-end" >
                                <div class="customTooltip">' . $processDescription . '
                                    <span class="tooltiptext">' . $value['processDescription'] . '</span>
                                </div>
                            </td>
                            <td id="contractorCreatedOn" class="text-end ">'. $value['createdOn'] .'</td>
                            <td id="contractorPkContractorKhataId" class="text-center">'. $pkContractorKhataId .'</td>
                        </tr>
                            ';
                    }else{
                        if($value['remainingAmount'] >= 0){
                            $color = "green";
                        }else{
                            $color = "red";
                        }
                        echo '
                        <tr style="background-color:'. $color .';">
                            
                            <td id="" class="text-center" style="color:white">'. $value['remainingAmount'] .'</td>
                            <td id="" class="text-center"  style="color:white">=</td>
                            <td id="" class="text-center" style="color:white">ٹھیکیدار پر بقایا</td>
                            <td id="" class="text-center" style="color:white">'. $value['paymentAmount'] .'</td>
                            <td id="" class="text-center" style="color:white">وصول ہوئے</td>
                            <td id="" class="text-center" style="color:white">'. $value['OldAmount'] .'</td>
                            <td id="" class="text-center" style="color:white"> پرانا حساب </td>
                            <td id="" class="customTooltip text-end" >
                                <div class="customTooltip">' . $processDescription . '
                                    <span class="tooltiptext" style="color:white">' . $value['processDescription'] . '</span>
                                </div>
                            </td>
                            <td id="contractorCreatedOn" class="text-end " style="color:white">'. $value['createdOn'] .'</td>
                            <td id="contractorPkContractorKhataId" class="text-center" style="color:white">'. $pkContractorKhataId .'</td>
                        </tr>
                            ';

                    }
                    
                    }
                }
                ?>
        </tbody>
        <tfoot style="background-color:black;color: azure;">
            <tr>
                <th style="color: azure;" class="text-center">ٹوٹل رقم</th>
                <th style="color: azure;" class="text-center">کل قیمت</th>
                <th style="color: azure;" class="text-center">ریٹ </th>
                <th style="color: azure;" class="text-center">ٹن/پیمائش</th>
                <th style="color: azure;" class="text-center">سائٹ</th>
                <th style="color: azure;" class="text-center">مواد کی قسم</th>
                <th style="color: azure;" class="text-center">گاڑی کا نمبر</th>
                <th style="color: azure;" class="text-center">تفصیل</th>
                <th style="color: azure;" class="text-center">تاریخ</th>
                <th style="color: azure;" class="text-center">سیریل</th>
            </tr>
        </tfoot>
    </table>
    <!-- </div> -->
    

  
    <?php
    $url = 'ContractorsPaymentForm.php?ContractorId=' . urlencode($encryptedContractorId);
    echo' <a class="btn btn-primary btn-sm my-3" href="'. $url .'" role="button" aria-expanded="false" aria-controls="collapseExample">
    ٹھیکیدار کی ادائیگی کی فارم دیکھیں 
        </a>';
        ?>           
</div>


<script src='<?php echo $rootDirectoryComponentsSelect ."assates/js/main.js" ;?>'></script>
<script src='<?php echo $rootDirectoryComponentsSelect ."assates/js/bethaFormTableAjax.js" ;?>'></script>
<script src='<?php echo $rootDirectoryComponentsSelect ."assates/js/ContractorsTablesAjax.js" ;?>'></script>
<script src='<?php echo $rootDirectoryComponentsSelect ."assates/js/ContractorDailyEntryFormAjax.js" ;?>'></script>


<?php

    $Footer = new Footer($rootDirectoryComponentsSelect);
    echo $Footer->getContent();

}

?>

