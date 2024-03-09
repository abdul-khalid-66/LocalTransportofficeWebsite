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
        <h3 class="text-end mb-5"> ٹھیکیدار کے وصولی کا فارم</h3>
        <form class="row g-3" action="bethaFormController.php" method="Post">
            <div class="col-6 text-end">
                <label for="thekidarSelection" class="form-label">: ڈیلر کا کا نام</label>
                <?php
                $CrudOperation = new CrudOperation();
                $table = "contractors";
                $columns = '*';
                $result = $CrudOperation->readRecords($table, $columns, null, null, null, null, null,null);
                ?>
                <select id="dealerId" name="dealerId" class="form-select">
                    <option selected class="text-end" value="NULL">ڈیلر کا انتخاب کریں۔</option>
                    <option class="text-end" value="1">ڈیلر کا 1۔</option>
                    <option class="text-end" value="2">ڈیلر کا 2۔</option>
                </select>
            </div>
            <div class="col-6 text-end">
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
                    <label for="siteSelection" class="form-label">: نیا حساب</label>
                    <input type="text" class="form-control text-end" id="siteSelection" name="siteSelection"
                        placeholder="نیا حساب">
                </div>
                <div class="col-md-4 text-end">
                    <label for="vehicleNumber" class="form-label"> : وصول </label>
                    <input type="text" class="form-control text-end" id="vehicleNumber" name="vehicleNumber"
                        placeholder=" رقم درج کریں">
                </div>
                <div class="col-md-4 text-end">

                    <label for="Material" class="form-label"> : پرانا حساب</label>
                    <input style='font-weight: bolder' type="text"
                        class="form-control text-end selectedContractorStoreAmount" id="selectedContractorStoreAmount"
                        name="selectedContractorStoreAmount" value="0" readonly>

                    </select>
                </div>

                <div class=" col-md-12 text-end">
                    <label for="allowance" class="form-label"> : ادائیگی کی صورت میں ہوئی </label>
                </div>

                <div class=" col-md-3 text-end">
                    <input type="number" class="form-control text-end" id="allowance" name="allowance"
                        placeholder="ڈیزل">
                </div>
                <div class="col" style="text-align: center;font-weight: bolder;">
                    +
                </div>
                <div class="col-md-3 ">
                    <input type="number" class="form-control text-end " id="NumberOfSankra" name="NumberOfSankra"
                        placeholder="ادھار">
                </div>
                <div class="col" style="text-align: center;font-weight: bolder;">
                    +
                </div>
                <div class="col-md-4 text-end">
                    <input type="number" class="form-control text-end" id="ratePerSankra" name="ratePerSankra"
                        placeholder="نقد" oninput="calculateResult();">
                </div>


                <div class="col-md-12 text-end">
                    <label for="description" class="text-end">کوئی تفصیل </label>
                    <textarea class="form-control text-end" dir="rtl" placeholder="کوئی تفصیل " name="description"
                        id="description"></textarea>
                </div>



                <div class="col-12 text-end">
                    <button type="submit" class="btn btn-primary" name="submitcontractorkhata">حساب میں جمع
                        کریں</button>
                </div>
            </div>
        </form>
    </div>

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