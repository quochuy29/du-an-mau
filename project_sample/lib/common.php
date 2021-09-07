<?php
define("BASE_URL", "http://localhost/php1/project_sample/");
define("BASE_URL_1", "http://localhost/php1/project_sample/tai-khoan.php");
define("BASE_URL_4", "http://localhost/php1/project_sample/loai-hang.php");
define("BASE_URL_5", "http://localhost/php1/project_sample/san-pham.php");
define("BASE_URL_6", "http://localhost/php1/project_sample/layout_project.php");
define("BASE_URL_8", "http://localhost/php1/project_sample/coment.php");
define("BASE_URL_11", "http://localhost/php1/project_sample/don-hang.php");
define("BASE_URL_12", "http://localhost/php1/project_sample/thong-ke-hang-hoa.php");
define("BASE_URL_13", "http://localhost/php1/project_sample/don-hang.php");
define("BASE_URL_14", "http://localhost/php1/project_sample/thong-ke-don-dat-hang.php");
define("BASE_URL_15", "http://localhost/php1/project_sample/fogot.php");
define("BASE_URL_16", "http://localhost/php1/project_sample/login.php");

function datetimeConvert($datetimeData, $formatString = "d/m/Y"){
    $date = new DateTime($datetimeData);
    return $date->format($formatString);
}

function checkAuth(){
    if(!isset($_SESSION['auth']) || !$_SESSION['auth']){
        header('location: '.BASE_URL . 'login.php');
        die;
    }
}
function checkAuths(){
    if(!isset($_SESSION['auth']) || !$_SESSION['auth']){
        header('location: '.BASE_URL . 'login.php');
        die;
    }elseif($_SESSION['auth']['vai_tro']<1 && $_SESSION['auth']['vai_tro']<1) {
        header('location: '.BASE_URL . 'login.php');
        die;
    }
}
?>