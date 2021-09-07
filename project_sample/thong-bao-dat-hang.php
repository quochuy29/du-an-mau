<?php
session_start();
require_once "./lib/db.php";
require_once "./lib/common.php";
checkAuth();
// lấy dữ liệu từ trên url => keyword
$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : "";

$ma_kh = $_SESSION['auth']['ma_kh'];
// query lấy danh sách user từ db

$getProductsQuery = "select * from users where ma_kh = '$ma_kh'";

$connect = getDbConnect();
$stmt = $connect->prepare($getProductsQuery);
$stmt->execute();
$products4 = $stmt->fetchAll();


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="layout_project.css">
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
    <link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
    <style>
    .full-body {
        width: 1305px;
        margin: auto;
    }
    </style>
</head>

<body>
    <div class="full-body">
        <div class="header">
            <div class="top">
                <div class="name-shop">
                    <a href="http://localhost/php1/project_sample/layout_project.php"><img src="img_project/ShopX.png"
                            alt=""></a>
                </div>
                <form action="search.php" method="get">
                    <div class="form-group row">
                        <label for="" class="col-sm-1 col-form-label" style="margin-top:40px;">Từ khóa</label>
                        <div class="col-sm-4" style="margin-top:30px;">
                            <input type="text" name="keyword" class="form-control" value="<?= $keyword ?>">
                        </div>
                    </div>
                </form>
                <div class="login" style="line-height:1;">
                    <?php
						if(isset($_SESSION['auth']) && !empty($_SESSION['auth'])) { ?>
                    <div class="log" style="width:50px;height:50px;position:relative;right:25px;top:30px;">
                        <?php foreach($products4 as $keys => $cursors): ?>
                        <a href=" javascript:;" class="nav-link">
                            <img style="border-radius:50%;" width=50 height=50
                                src="<?= BASE_URL . $cursors['avatar'] ?>" class="img-fluid" ?>
                        </a>
                        <?php endforeach ?>
                    </div>
                    <?php
                    } else { ?>
                    <img class="admin" src="img_project/admin.jpg" alt="">
                    <?php
                    }
                    ?>
                    <?php
						if(isset($_SESSION['auth']) && !empty($_SESSION['auth'])) { ?>
                    <div class="log" style="float:right;margin-right:90px;">
                        <a style="float:left;" href=" javascript:;" class="nav-link">
                            <?= $_SESSION['auth']['name'] ?>
                        </a>
                        <a style="float:right;margin-right:30px;position:relative;left:10px;" class=" nav-link"
                            href="<?= BASE_URL. "users/doi-mk.php"?>">Đổi mk</a>
                        <a style="float:right;position:relative;left:5px;" class=" nav-link"
                            href="<?= BASE_URL. "logout.php"?>">Đăng xuất</a>

                    </div>
                    <?php
                    } else { ?>
                    <a href="login.php">Đăng nhập</a> / <a href="users/tao-tk.php">Đăng ký</a>
                    <?php
                    }
                    ?>
                    <?php
						if($_SESSION['auth']['vai_tro']>0 && $_SESSION['auth']['vai_tro']>0) { ?>
                    <div class="log" style="float:right;margin-right:50px;position:relative;bottom:13px;">
                        <a href="tai-khoan.php">Quản trị</a>
                    </div>
                    <?php
                    }
                    ?>


                </div>
            </div>
            <img id="slideshow" width=1305 src="img_project/banner-iphone.jpg" alt="">
            <div class="product" style="display:grid;grid-template-columns: 1fr;">
                <img id="slideshows" width=700 height=700 style="margin-left:300px;" src="img_project/chan_trai.jpg"
                    alt="">
            </div>
        </div>
        <div class="footer" style="height:192px;margin-top:20px;">
            <div class="name-shop" style="margin-top:60px;">
                <img src="img_project/ShopX1.png" alt="">
            </div>
            <div class="contact">
                <div class="address">
                    <h2>Liên hệ</h2>
                    <p>Cao đẳng FPT Polytechnic</p>
                    <p>Tòa nhà FPT Polytechnic, Phố Trịnh Văn Bô, Nam Từ Liêm, Hà Nội</p>
                    <p>Số điện thoại : (024) 7300 1955</p>
                </div>
                <div class="support" style="text-transform: uppercase;">
                    <h2>Hỗ trợ</h2>
                    <p>Email hỗ trợ : Huypqph11301@fpt.edu.vn</p>
                    <p>Số điện thoại : (036) 5791 629</p>
                    <p>Facebook : Huy Phan</p>
                    <p>Zalo : Phan Quốc Huy</p>
                </div>
                <div class="copyright" style="text-transform: uppercase;">
                    <h2 style="margin-bottom:30px;">Đồng hành</h2>
                    <a class="ip" style="margin-right:10px;" href=""><img src="img_project/logoip.png" alt=""></a>
                    <a class="op" style="margin-right:10px;" href=""><img src="img_project/logoop.png" alt=""></a>
                    <a class="ss" href=""><img src="img_project/logoss.png" alt=""></a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
<script>
var arr = [
    'img_project/banner-iphone.jpg',
    'img_project/banner-oppo.jpg',
    'img_project/banner-samsung.jpg',
];
var index = 0;

function slideshows() {
    document.getElementById("slideshow").src = arr[index];
    index++;
    if (index == arr.length) {
        index = 0;
    }
    setTimeout("slideshows()", 2000);
}
slideshows();

var arr1 = [
    'img_project/chan-trai.jpg',
    'img_project/chan-pha.jpg',
];
var index1 = 0;

function slideshow() {
    document.getElementById("slideshows").src = arr1[index1];
    index1++;
    if (index1 == arr1.length) {
        index1 = 0;
    }
    setTimeout("slideshow()", 500);
}
slideshow();
</script>