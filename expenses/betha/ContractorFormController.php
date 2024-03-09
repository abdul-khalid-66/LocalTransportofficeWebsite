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
    </div>

    <h3 id="heading" class="text-end"></h3>

    <!-- <div id="dataTable"></div> -->
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

            $table = "contractorkhata";
            $columns = "*";
            $where = ' (fkContractorId, createdOn) IN ( SELECT fkContractorId, MAX(createdOn) AS max_createdOn FROM
            contractorkhata GROUP BY fkContractorId )';
            $orderBy = " pkContractorKhataId Desc";
            $join = " Join contractors ON fkContractorId = pkContractorId ";
            $limit = null;
            $tableResult = $CrudOperation->readRecords($table, $columns, $where, null, $join , $limit, null,$orderBy);

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
                        <td id="contractorTotalAmount" class="text-end" >
                        <a class="btn btn-primary btn-sm" href="'. $url .'" role="button" aria-expanded="false" aria-controls="collapseExample">
                        دیکھیں 
                        </a>
                        </td>
                        <td id="contractorTotalAmount" class="text-end" >'. $value['totalAmount'] .'</td>
                        <td id="contractorAllowance" class="text-end" >'. $value['allowance'] .'</td>
                        <td id="contractorPrice" class="text-end" >'. $value['price'] .'</td>
                        <td id="contractorMeasurement" class="text-end" >'. $value['measurement'] .'</td>
                        <td id="contractorDestinationAddress" class="text-end" >'. $value['destinationAddress'] .'</td>
                        <td id="contractorMaterial" class="text-end" >'. $value['material'] .'</td>
                        <td id="contractorVehicleRegistrationNo" class="text-end" >'. $value['vehicleRegistrationNo'] .'</td>
                        <td id="contractorContractorname" class="text-end">'. $value['name'] .'</td>

                        <td id="contractorProcessDescription" class="customTooltip text-end" >
                            <div class="customTooltip">' . $processDescription . '
                                <span class="tooltiptext">' . $value['processDescription'] . '</span>
                            </div>
                        </td>
                        <td id="contractorCreatedOn" class="text-end ">'. $value['createdOn'] .'</td>
                        <td id="contractorPkContractorKhataId" class="text-end">'. $pkContractorKhataId .'</td>
                        </tr>
                        ';
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