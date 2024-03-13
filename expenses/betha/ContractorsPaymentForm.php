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
<div class="container ">
    <div class="container mt-3"
        style="width: 70%; border: 1px solid rgb(36, 36, 36); padding: 40px; border-radius: 5px;box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
        <h3 class="text-end mb-5"> ٹھیکیدار سے وصولی کا فارم</h3>
        <form class="row g-3" action="ContractorsPaymentFormController.php" method="Post">
            <div class="col-6 text-end">
                <label for="dealerName" class="form-label">: ڈیلر کا کا نام</label>
                <?php
                $CrudOperation = new CrudOperation();
                $table = "contractors";
                $columns = '*';
                $result = $CrudOperation->readRecords($table, $columns, null, null, null, null, null,null,null);
                
                
                ?>
                <select id="dealerName" name="dealerName" class="form-select validation">
                    <option selected class="text-end" value="">ڈیلر کا انتخاب کریں۔</option>
                    <option class="text-end" value="بلال ">بلال </option>
                    <option class="text-end" value="نذیر">  نذیر</option>
                </select>
            </div>
            <div class="col-6 text-end">
                <label for="selectedContractorId" class="form-label ">: ٹھیکیدار کا نام</label>
                <?php
                
                if(isset($_GET['ContractorId'])){
                    $encryptedContractorId = $_GET['ContractorId'];
                    $contractorId = base64_decode($encryptedContractorId); 

                    $CrudOperation = new CrudOperation();
                    $table = "contractors";
                    $columns = '*';
                    $where = " pkContractorId = ".$contractorId;
                    $result = $CrudOperation->readRecords($table, $columns, $where, null, null, null, null,null,null);
                    ?>
                    <select id="selectedContractorId" name="selectedContractorId" class="form-select validation">
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
                    <?php
                }else{

                    $CrudOperation = new CrudOperation();
                    $table = "contractors";
                    $columns = '*';
                    $result = $CrudOperation->readRecords($table, $columns, null, null, null, null, null,null,null);
                    
                    ?>
                    <select id="selectedContractorId" name="selectedContractorId" class="form-select validation">
                        <option selected class="text-end" value="">ٹھیکیدار کو منتخب کریں۔</option>
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
                    <?php
                }
                ?>
                
            </div>
            <div class="row g-3">
                <div class="col-md-4 text-end">
                    <label for="selectedContractorNewAmount" class="form-label">: نیا حساب</label>
                    <input type="text" class="form-control text-end validation" id="selectedContractorNewAmount"
                        name="selectedContractorNewAmount" placeholder="نیا حساب" oninput="calculateResultOfContractor_PaymentAmount_OldAmount_NewAmount()">
                </div>
                <div class="col-md-4 text-end">
                    <label for="selectedContractorPaymentAmount" class="form-label"> : وصول </label>
                    <input type="text" class="form-control text-end validation" id="selectedContractorPaymentAmount"
                        name="selectedContractorPaymentAmount" placeholder=" رقم درج کریں" oninput="calculateResultOfContractor_PaymentAmount_OldAmount_NewAmount()">
                </div>
                <div class="col-md-4 text-end">

                    <label for="selectedContractorStoreAmount" class="form-label"> : پرانا حساب</label>
                    <input style='font-weight: bolder' type="text"
                        class="form-control text-end  selectedContractorStoreAmount " id="selectedContractorStoreAmount"
                        name="selectedContractorStoreAmount" value="0" oninput="calculateResultOfContractor_PaymentAmount_OldAmount_NewAmount()" readonly>
                    </select>
                </div>

                <div class=" col-md-12 text-end">
                    <label for="FormOfPayment" class="form-label"> : ادائیگی کی صورت میں ہوئی </label>
                </div>

                <div class=" col-md-3 text-end">
                    <input type="number" step="0.01" class="form-control text-center" id="selectedContractorFormOfPaymentDiseal"
                        name="selectedContractorFormOfPaymentDiseal" placeholder="ڈیزل">
                </div>
                <div class="col" style="text-align: center;font-weight: bolder;">
                    +
                </div>
                <div class="col-md-3 ">
                    <input type="number" step="0.01" class="form-control text-center " id="selectedContractorFormOfPaymentLoan"
                        name="selectedContractorFormOfPaymentLoan" placeholder="ادھار">
                </div>
                <div class="col" style="text-align: center;font-weight: bolder;">
                    +
                </div>
                <div class="col-md-4">
                    <input type="number" step="0.01" class="form-control text-center" id="selectedContractorFormOfPaymentCash"
                        name="selectedContractorFormOfPaymentCash" placeholder="نقد">
                </div>
                <div class="col-md-12 text-end">
                    <label for="selectedContractorDescription" class="text-end">کوئی تفصیل </label>
                    <textarea class="form-control text-end validation" dir="rtl" placeholder="کوئی تفصیل "
                        name="selectedContractorDescription" id="selectedContractorDescription"></textarea>
                </div>
                <div class="col-12 text-end">
                    <button type="submit" class="btn btn-primary" value="submitselectedContractorPayment" name="submitselectedContractorPayment">حساب میں جمع
                        کریں</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script src='<?php echo $rootDirectoryComponentsSelect ."assates/js/ContractorsPaymentFormAjax.js" ;?>'></script>


<?php

    $Footer = new Footer($rootDirectoryComponentsSelect);
    echo $Footer->getContent();
?>
<script>
    

</script>
<script>
    $(document).ready(function () {
        $("#example1").DataTable();
    });
</script>