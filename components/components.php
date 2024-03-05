<?php

class Component {
    protected $content;

    public function __construct() {
        $this->content = '';
    }

    public function getContent() {
        return $this->content;
    }
}


class Header Extends Component{
    private $headerBaseUrl;

    public function __construct($headerBaseUrl){
        $this->headerBaseUrl = $headerBaseUrl;

        parent::__construct();
        $this->content .= '<!doctype html>
        <html lang="en" dir="ltr">
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>Bootstrap demo</title>
            <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

            <link rel="preconnect" href="https://fonts.googleapis.com">
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
            <link href="https://fonts.googleapis.com/css2?family=Amiri:ital,wght@0,400;0,700;1,400;1,700&family=Lalezar&family=Noto+Nastaliq+Urdu:wght@400..700&display=swap"
                rel="stylesheet">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
                integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
            <link rel="stylesheet" href="'. $this->headerBaseUrl .'assates/css/style.css">
        </head>
        
        <body>';
    }
}

class Footer Extends Component{
    private $footerBaseUrl;
    public function __construct($footerBaseUrl = "url here"){
        parent::__construct();
        $this->footerBaseUrl = $footerBaseUrl;
        $this->content .= '        
            <div class="container">
                <footer class="row row-cols-1 row-cols-sm-2 row-cols-md-5 py-5 my-5 border-top">
                    <div class="col mb-3">
                        <p class="text-body-secondary"><img src="'. $this->footerBaseUrl .'assates/images/Logo_1.png" alt="" style="width: 80%; height: 40%;"></p>
                    </div>
                    <div class="col mb-3">
                    </div>
                    <div class="col mb-3">
                        <h5>Section</h5>
                        <ul class="nav flex-column">
                            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Home</a></li>
                            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Features</a></li>
                            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Pricing</a></li>
                            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">FAQs</a></li>
                            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">About</a></li>
                        </ul>
                    </div>
                    <div class="col mb-3">
                        <h5>Section</h5>
                        <ul class="nav flex-column">
                            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Home</a></li>
                            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Features</a></li>
                            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Pricing</a></li>
                            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">FAQs</a></li>
                            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">About</a></li>
                        </ul>
                    </div>
                    <div class="col mb-3">
                        <h5>Section</h5>
                        <ul class="nav flex-column">
                            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Home</a></li>
                            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Features</a></li>
                            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Pricing</a></li>
                            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">FAQs</a></li>
                            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">About</a></li>
                        </ul>
                    </div>
                </footer>
            </div>

            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
                crossorigin="anonymous"></script>
            </body>

            </html>
        ';
    }
}

class Navbar Extends Component{
    private $navbarBaseUrl; 
    
    public function __construct($navbarBaseUrl=""){
        $this->navbarBaseUrl = $navbarBaseUrl;
        parent::__construct();
        $this->content .= '        
        <nav class="navbar navbar-expand-lg bg-body-tertiary px-5 ">
            <div class="container-fluid">
                <a class="navbar-brand" href="#"><img src="'. $this->navbarBaseUrl .'assates/images/Logo_1.png" alt="" style="width: 50%; height: 50%;"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link disabled" aria-disabled="true">Contact</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>';
    }
}

class AdminSidebar Extends Component{
    public function __construct(){
        parent::__construct();
        $this->content .= "";
    }
}



?>