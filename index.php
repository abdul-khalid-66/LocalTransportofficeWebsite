<?php
$rootDirectoryComponentsSelect = 'http://' . $_SERVER['HTTP_HOST'] . '/LocalTransportofficeWebsite/';

$rootDirectoryFileSelect = $_SERVER['DOCUMENT_ROOT'] . "/LocalTransportofficeWebsite/";
include_once $rootDirectoryFileSelect ."/components/components.php";

$header = new Header($rootDirectoryComponentsSelect);
echo  $header->getContent();

$Navbar = new Navbar($rootDirectoryComponentsSelect);
echo  $Navbar->getContent();
?>

<section>
    <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active" data-bs-interval="10000">
                <img src="assates/images/work_img1.jpg" class="d-block w-100" height='350px' alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h1 class="amiri-bold" dir="ltr">ٹرانسپورٹ آفس</h1>
                    <p>Some representative placeholder content for the first slide.</p>
                </div>
            </div>
            <div class="carousel-item" data-bs-interval="10000">
                <img src="assates/images/work_img2.jpg" class="d-block w-100" height='350px' alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Second slide label</h5>
                    <p>Some representative placeholder content for the first slide.</p>
                </div>
            </div>
            <div class="carousel-item" data-bs-interval="10000">
                <img src="assates/images/work_img3.jpg" class="d-block w-100" height='350px' alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Third slide label</h5>
                    <p>Some representative placeholder content for the first slide.</p>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</section>



<!-- Cards show courses start -->

<div class=" m-5">
    <h1 class="amiri-bold" dir="ltr">سروس برائے کاروبار</h1>


    <div class="row row-cols-1 row-cols-md-3 g-4">
        <div class="col">
            <div class="card h-100">
                <div class="card-body">
                    <h2 class="card-title amiri-bold">بتہ</h2>
                    <p class="card-text">گاڑی کی بتہ تفصیلات یہاں دیکھیں</p>
                    <a href="expenses/betha/bethaForm.php">Explor</a>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">ڈیزل</h5>
                    <p class="card-text">ڈیزل کی بتہ تفصیلات یہاں دیکھیں</p>
                </div>
            </div>
        </div>


    </div>
</div>
<!-- Cards show courses end -->
<?php
$Footer = new Footer();
echo  $Footer->getContent();
?>