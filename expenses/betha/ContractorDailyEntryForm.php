<?php
$rootDirectoryComponentsSelect = 'http://' . $_SERVER['HTTP_HOST'] . '/LocalTransportofficeWebsite/';

$rootDirectoryFileSelect = $_SERVER['DOCUMENT_ROOT'] . "/LocalTransportofficeWebsite/";
include_once $rootDirectoryFileSelect ."/components/components.php";
include_once $rootDirectoryFileSelect ."/includes/functions.php";

$Header = new Header($rootDirectoryComponentsSelect);
echo  $Header->getContent();

$Navbar = new Navbar($rootDirectoryComponentsSelect);
echo $Navbar->getContent();


    $status = isset($_GET['status']) ? $_GET['status'] : '';
    echo '<div class="message-container">';
    if ($status === 'success') {
        echo '<div class="success-message" id="successMessage">Data inserted successfully!</div>';
    }elseif($status === 'error'){
        echo '<div class="error-message" id="errorMessage">Error: Data not inserted.</div> ';
    }
    echo "</div>";
?>
<div class="container">


    <div class="container mt-3"
        style="width: 50%; border: 1px solid rgb(36, 36, 36); padding: 40px; border-radius: 5px;box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
        <h3 class="text-end mb-5"> ٹھیکیدار کے کھاتے کا حساب کا فارم</h3>
        <form class="row g-3" action="ContractorDailyEntryFormController.php" method="Post">
            <div class="col-12 text-end">
                <label for="thekidarSelection" class="form-label">: ٹھیکیدار کا نام</label>
                <?php
                $CrudOperation = new CrudOperation();
                $table = "contractors";
                $columns = '*';
                $result = $CrudOperation->readRecords($table, $columns, null, null, null, null, null,null);
                
            ?>
                <select id="selectedcontractor" name="selectedcontractorId" class="form-select">
                    <option selected class="text-end" value="NULL">ٹھیکیدار کو منتخب کریں۔</option>
                    <?php
                $selectedOption = '';
                    if (!empty($result)) {
                        foreach($result as $ContractorNameCnicSelection){
                            $ContractorNameSelection = $ContractorNameCnicSelection['name'];
                            $ContractorCnicSelection = $ContractorNameCnicSelection['cnic'];
                            $pkContractorId = $ContractorNameCnicSelection['pkContractorId']; 
                            ?>
                    <option class='text-end' value="<?php echo $pkContractorId; ?>">
                        <?php echo $ContractorNameSelection .' ( '. $ContractorCnicSelection .' ) '; ?>
                    </option>
                    <?php
                        }
                    } else {
                        echo "No records found";
                    }
                ?>
                </select>
            </div>

            <div class="row g-3">
                <div class="col-md-4 text-end">
                    <label for="siteSelection" class="form-label">: سائٹ</label>
                    <input type="text" class="form-control text-end" id="siteSelection" name="siteSelection"
                        placeholder="جگہ کا نام بتائیں">
                </div>
                <div class="col-md-4 text-end">
                    <label for="vehicleNumber" class="form-label"> : گاڑی نمبر</label>
                    <input type="text" class="form-control text-end" id="vehicleNumber" name="vehicleNumber"
                        placeholder=" نمبر درج کریں">
                </div>
                <div class="col-md-4 text-end">

                    <label for="Material" class="form-label"> : مواد کی قسم</label>
                    <select id="Material" name="Material" class="form-select">
                        <option selected class="text-end" value="NULL"> منتخب کریں۔</option>';
                        <option class="text-end pe-1" value="کرش">کرش</option>
                        <option class="text-end pe-1" value=" بجری">بجری</option>
                        <option class="text-end pe-1" value="ریت">ریت</option>
                        <option class="text-end pe-1" value=" دیگر">دیگر</option>

                    </select>
                </div>
                <div class=" col-md-4 text-end">
                    <label for="allowance" class="form-label"> : رقم</label>
                    <input type="number" class="form-control text-center" id="allowance" name="allowance">
                </div>
                <div class="col" style="text-align: center;">
                    <div style="margin-top: 40px;">=</div>
                </div>
                <div class="col-md-3 text-end">
                    <label for="NumberOfSankra" class="form-label">: ٹن/پیمائش</label>
                    <input type="number" class="form-control text-center" id="NumberOfSankra" value="0"
                        oninput="calculateResult();" name="NumberOfSankra" placeholder="گاڑی کی پیمائش درج کریں">
                </div>
                <div class="col-md-4 text-end">
                    <label for="ratePerSankra" class="form-label">: ریٹ</label>
                    <input type="number" class="form-control text-center" id="ratePerSankra" name="ratePerSankra"
                        value="0" placeholder="سینکڑا کی قیمت لکھیں" oninput="calculateResult();">
                </div>
                <div class="col-md-12 text-end">
                    <label for="description" class="text-end">کوئی تفصیل </label>
                    <textarea class="form-control text-end" dir="rtl" placeholder="کوئی تفصیل " name="description"
                        id="description"></textarea>
                </div>

                <div class="col-md-12 text-end">
                    <label for="selectedContractorStoreAmount" class="form-label"> : قل رقم</label>
                    <input style='font-size:30px;border:none' type="text"
                        class="form-control text-end selectedContractorStoreAmount" id="selectedContractorStoreAmount"
                        name="selectedContractorStoreAmount" value="" readonly>
                </div>

                <div class="col-12 text-end">
                    <button type="submit" class="btn btn-primary" name="submitcontractorkhata">حساب میں جمع
                        کریں</button>
                </div>
            </div>
        </form>
    </div>

    <h3 id="heading" class="text-end"></h3>

    <h1 class="text-end">تمام ٹھیکیدارو کی فہرست</h1>

    <table id="example1" class="table table-striped" style="width:100%">
        <thead>
            <tr style="background-color:black;color: azure;">
                <th style="color: azure;" class="text-end"> معلومات</th>
                <th style="color: azure;" class="text-end">ٹوٹل رقم</th>
                <th style="color: azure;" class="text-end">کل قیمت</th>
                <th style="color: azure;" class="text-end">ریٹ </th>
                <th style="color: azure;" class="text-end">ٹن/پیمائش</th>
                <th style="color: azure;" class="text-end">سائٹ</th>
                <th style="color: azure;" class="text-end">مواد کی قسم</th>
                <th style="color: azure;" class="text-end">گاڑی کا نمبر</th>
                <th class="remove" style="color: azure;" class="text-end">ٹھیکیدار</th>
                <th style="color: azure;" class="text-end">تفصیل</th>
                <th style="color: azure;" class="text-end">تاریخ</th>
                <th style="color: azure;" class="text-end">سیریل</th>
            </tr>
        </thead>
        <tbody>
            <?php

                $table = "contractors";
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

                $where = '(contractorspayments.fkContractorId, contractorspayments.createdOn) IN (
                    SELECT 
                        fkContractorId,
                        MAX(createdOn) AS maxCreatedOn
                    FROM 
                        contractorspayments
                    GROUP BY 
                        fkContractorId
                )
                ';
                $orderBy = " contractorspayments.createdOn DESC";
                $join = " JOIN contractorspayments ON Contractors.pkContractorId = contractorspayments.fkContractorId LEFT JOIN contractorkhata ON contractorkhata.fkContractorId = contractors.pkContractorId AND contractorkhata.pkContractorKhataId = contractorspayments.fkContractorKhataId ";
                $limit = null;
                $groupBy = null;


                $tableResult = $CrudOperation->readRecords($table, $columns, $where, null, $join , $limit, null,$groupBy,$orderBy);

                // echo "<pre>";
                // print_r($tableResult);
                // echo "</pre>";

                if (empty($tableResult)) {
                    echo'
                        <tr>
                            <td style="text-align: center;"> . </td>
                            <td style="text-align: center;"> . </td>
                            <td style="text-align: center;"> . </td>
                            <td style="text-align: center;"> . </td>
                            <td style="text-align: center;"> . </td>
                            <td style="text-align: center;"> No Record Found</td>
                            <td style="text-align: center;"> . </td>
                            <td style="text-align: center;"> . </td>
                            <td style="text-align: center;"> . </td>
                            <td style="text-align: center;"> . </td>
                            <td style="text-align: center;"> . </td>
                            <td style="text-align: center;"> . </td>
                        </tr>
                    ';
                    }else{
                    $pkContractorKhataId = 0;
                    foreach($tableResult as $value){
                    $pkContractorKhataId++;
                    $processDescription = (strlen($value['processDescription']) > 25) ? substr($value['processDescription'], 0, 30) . '...' : $value['processDescription'];
                    
                    $encryptedContractorId = base64_encode($value['pkContractorId']);
                    $url = 'ContractorsTablesController.php?ContractorId=' . urlencode($encryptedContractorId);
                    if($value['vehicleRegistrationNo'] != null AND $value['material'] != null AND $value['measurement'] != null){
                        echo '
                        <tr style="font-weight: bolder;">
                        <td id="contractorTotalAmount" class="text-end" >
                            <a class="btn btn-primary btn-sm" href="'. $url .'" role="button" aria-expanded="false" aria-controls="collapseExample">
                            دیکھیں 
                            </a>
                            </td>
                        <td id="" class="text-center" style="color:red">'. $value['remainingAmount'] .'</td>
                        <td id="" class="text-center" >'. $value['OldAmount'] .'</td>
                        <td id="" class="text-center" >'. $value['price'] .'</td>
                        <td id="" class="text-center" >'. $value['measurement'] .'</td>
                        <td id="" class="text-center" >'. $value['destinationAddress'] .'</td>
                        <td id="" class="text-center" >'. $value['material'] .'</td>
                        <td id="" class="text-center" >'. $value['vehicleRegistrationNo'] .'</td>
                        <td id="contractorContractorname" class="text-end">'. $value['name'] .'</td>
                        <td id="contractorProcessDescription" class="customTooltip text-end" >
                            <div class="customTooltip">' . $processDescription . '
                                <span class="tooltiptext">' . $value['processDescription'] . '</span>
                            </div>
                        </td>
                        <td id="contractorCreatedOn" class="text-end ">'. $value['createdOn'] .'</td>
                        <td id="contractorPkContractorKhataId" class="text-center">'. $pkContractorKhataId .'</td>
                    </tr>
                        ';
                    }else {

                        if($value['remainingAmount'] >= 0){
                            $color = "green";
                            $remainder ='ٹھیکیدار پر بقایا';
                        }else{
                            $color = "red";
                            $remainder ='ٹھیکیدار کے بقایا';
                        }
                        echo '
                        <tr  style="background-color:'. $color .';"font-weight: bolder;">

                        <td id="contractorTotalAmount" class="text-end" >
                            <a class="btn btn-primary btn-sm" href="'. $url .'" role="button" aria-expanded="false" aria-controls="collapseExample">
                            دیکھیں 
                            </a>
                        </td>
                            
                        <td id="" class="text-center" style="color:white">'. $value['remainingAmount'] .'</td>
                        <td id="" class="text-center"  style="color:white"><=</td>
                        <td id="" class="text-center" style="color:white">'. $remainder .'</td>
                        <td id="" class="text-center" style="color:white">'. $value['paymentAmount'] .'</td>
                        <td id="" class="text-center" style="color:white">وصول ہوئے</td>
                        <td id="" class="text-center" style="color:white">'. $value['OldAmount'] .'</td>
                        <td id="" class="text-center" style="color:white"> پرانا حساب </td>
                        <td id="contractorContractorname" style="color:white" class="text-end">'. $value['name'] .'</td>
                        <td id="" class="customTooltip text-end" >
                            <div class="customTooltip" style="color:white">' . $processDescription . '
                                <span class="tooltiptext" style="color:white">' . $value['processDescription'] . '</span>
                            </div>
                        </td>
                        <td id="contractorCreatedOn" class="text-end " style="color:white">'. $value['createdOn'] .'</td>
                        <td id="contractorPkContractorKhataId" class="text-center" style="color:white">'. $pkContractorKhataId .'</td>
                    </tr>';
                        
                        }
                    }
                }
                ?>
        </tbody>
        <tfoot style="background-color:black;color: azure;">
            <tr>
                <th style="color: azure;" class="text-end"> معلومات</th>
                <th style="color: azure;" class="text-end">ٹوٹل رقم</th>
                <th style="color: azure;" class="text-end">کل قیمت</th>
                <th style="color: azure;" class="text-end">ریٹ </th>
                <th style="color: azure;" class="text-end">ٹن/پیمائش</th>
                <th style="color: azure;" class="text-end">سائٹ</th>
                <th style="color: azure;" class="text-end">مواد کی قسم</th>
                <th style="color: azure;" class="text-end">گاڑی کا نمبر</th>
                <th class="remove" style="color: azure;" class="text-end">ٹھیکیدار</th>
                <th style="color: azure;" class="text-end">تفصیل</th>
                <th style="color: azure;" class="text-end">تاریخ</th>
                <th style="color: azure;" class="text-end">سیریل</th>
            </tr>
        </tfoot>
    </table>
    <!-- </div> -->


</div>

<script src='<?php echo $rootDirectoryComponentsSelect ."assates/js/main.js" ;?>'></script>
<script src='<?php echo $rootDirectoryComponentsSelect ."assates/js/ContractorDailyEntryFormJavaScript.js" ;?>'></script>
<script src='<?php echo $rootDirectoryComponentsSelect ."assates/js/ContractorsTablesAjax.js" ;?>'></script>
<script src='<?php echo $rootDirectoryComponentsSelect ."assates/js/ContractorDailyEntryFormAjax.js" ;?>'></script>


<?php

    $Footer = new Footer($rootDirectoryComponentsSelect);
    echo $Footer->getContent();
?>

<script>

    // new DataTable('#example1', {
    //     order: [[10, 'desc']]
    // });
</script>