<?php

$rootDirectoryFileSelect = $_SERVER['DOCUMENT_ROOT'] . "/LocalTransportofficeWebsite/";
include_once $rootDirectoryFileSelect . "/includes/functions.php";
if (isset($_POST['limit'])) {
    $limit = $_POST['limit'];
    echo $limit;
} else {
    echo "Invalid request.";
}

if (isset($_POST['limidt'])) {
    $limit = $_POST['limit'];
    echo $limit;
}
?>
