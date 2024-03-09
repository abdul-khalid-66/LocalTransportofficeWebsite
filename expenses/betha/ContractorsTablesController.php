<?php

$rootDirectoryComponentsSelect = 'http://' . $_SERVER['HTTP_HOST'] . '/LocalTransportofficeWebsite/';

$rootDirectoryFileSelect = $_SERVER['DOCUMENT_ROOT'] . "/LocalTransportofficeWebsite/";
include_once $rootDirectoryFileSelect ."/components/components.php";
include_once $rootDirectoryFileSelect ."/includes/functions.php";

$Header = new Header($rootDirectoryComponentsSelect);
echo  $Header->getContent();

$Navbar = new Navbar($rootDirectoryComponentsSelect);
echo $Navbar->getContent();

$CrudOperation = new CrudOperation();

if($_GET['ContractorId']){

    $encryptedContractorId = $_GET['ContractorId'];
    $contractorId = base64_decode($encryptedContractorId);    
    
    $table = "contractorkhata";
    $columns = "*";
    $where = ' pkContractorId = '. $contractorId;
    $orderBy = " pkContractorKhataId Desc";
    $join = " Join contractors ON fkContractorId = pkContractorId ";
    $limit = null;
    $tableResult = $CrudOperation->readRecords($table, $columns, $where, null, $join , $limit, null,$orderBy);

}

?>


<div class="container">


    <!-- <div class="container mt-3"
        style="width: 50%; border: 1px solid rgb(36, 36, 36); padding: 40px; border-radius: 5px;box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
        <h3 class="text-end mb-5"> ٹھیکیدار کے کھاتے کا حساب کا فارم</h3>
        <form class="row g-3" action="bethaFormController.php" method="Post">
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
                        placeholder="گاڑی کا نمبر لکھیں">
                </div>
                <div class="col-md-4 text-end">

                    <label for="Material" class="form-label"> : مواد کی قسم</label>
                    <select id="Material" name="Material" class="form-select">
                        <option selected class="text-end" value="NULL">مواد کی قسم کو منتخب کریں۔</option>';
                        <option class="text-end pe-1" value="value">1</option>
                        <option class="text-end pe-1" value="value">2</option>
                        <option class="text-end pe-1" value="value">3</option>
                        <option class="text-end pe-1" value="value">4</option>
                    </select>
                </div>
                <div class=" col-md-4 text-end">
                    <label for="allowance" class="form-label"> : رقم</label>
                    <input type="number" class="form-control" id="allowance" name="allowance">
                </div>
                <div class="col" style="text-align: center;">
                    <div style="margin-top: 40px;">=</div>
                </div>
                <div class="col-md-3 text-end">
                    <label for="NumberOfSankra" class="form-label">: ٹن/پیمائش</label>
                    <input type="number" class="form-control" id="NumberOfSankra" value="0" oninput="calculateResult();"
                        name="NumberOfSankra" placeholder="گاڑی کی پیمائش درج کریں">
                </div>
                <div class="col-md-4 text-end">
                    <label for="ratePerSankra" class="form-label">: ریٹ</label>
                    <input type="number" class="form-control" id="ratePerSankra" name="ratePerSankra" value="0"
                        placeholder="سینکڑا کی قیمت لکھیں" oninput="calculateResult();">
                </div>
                <div class="col-md-12 text-end">
                    <label for="description" class="text-end">کوئی تفصیل </label>
                    <textarea class="form-control text-end" dir="rtl" placeholder="کوئی تفصیل " name="description"
                        id="description"></textarea>
                </div>

                <div class="col-md-12 text-end">
                    <label for="selectedContractorStoreAmount" class="form-label"> : قل رقم</label>
                    <input style='font-size:30px;border:none' type="text" class="form-control text-end selectedContractorStoreAmount" id="selectedContractorStoreAmount"
                        name="selectedContractorStoreAmount" value="" readonly>
                </div>

                <div class="col-12 text-end">
                    <button type="submit" class="btn btn-primary" name="submitcontractorkhata">حساب میں جمع
                        کریں</button>
                </div>
            </div>
        </form>
    </div> -->

</div>

<h1 class="text-center"> ٹھیکیدارو<?php echo  '<span style="color:green">'.$tableResult[0]['name'].'</span>';  ?> کی
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
                    
                    echo '
                    <tr>
                        
                        <td id="contractorTotalAmount" class="text-center" style="color:red">'. $value['totalAmount'] .'</td>
                        <td id="contractorAllowance" class="text-center" >'. $value['allowance'] .'</td>
                        <td id="contractorPrice" class="text-center" >'. $value['price'] .'</td>
                        <td id="contractorMeasurement" class="text-center" >'. $value['measurement'] .'</td>
                        <td id="contractorDestinationAddress" class="text-center" >'. $value['destinationAddress'] .'</td>
                        <td id="contractorMaterial" class="text-center" >'. $value['material'] .'</td>
                        <td id="contractorVehicleRegistrationNo" class="text-center" >'. $value['vehicleRegistrationNo'] .'</td>
                       
                        <td id="contractorProcessDescription" class="customTooltip text-end" >
                            <div class="customTooltip">' . $processDescription . '
                                <span class="tooltiptext">' . $value['processDescription'] . '</span>
                            </div>
                        </td>
                        <td id="contractorCreatedOn" class="text-end ">'. $value['createdOn'] .'</td>
                        <td id="contractorPkContractorKhataId" class="text-center">'. $pkContractorKhataId .'</td>
                        </tr>
                        ';
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


</div>


<script src='<?php echo $rootDirectoryComponentsSelect ."assates/js/bethaFormTableAjax.js" ;?>'></script>
<script src='<?php echo $rootDirectoryComponentsSelect ."assates/js/ContractorsTablesAjax.js" ;?>'></script>
<script src='<?php echo $rootDirectoryComponentsSelect ."assates/js/bethaFormAjax.js" ;?>'></script>


<?php

    $Footer = new Footer($rootDirectoryComponentsSelect);
    echo $Footer->getContent();
?>

<script>
    $(document).ready(function () {
        $("#example1").DataTable();
    });
</script>