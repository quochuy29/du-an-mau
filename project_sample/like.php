<?php
session_start();
require_once "./lib/db.php";
require_once "./lib/common.php";
// lấy dữ liệu từ trên url => keyword
$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : "";

// query lấy danh sách user từ db
$getProductsQuery = "select * from products order by ma_hh desc limit 5,3 ";

$connect = getDbConnect();
$stmt = $connect->prepare($getProductsQuery);
$stmt->execute();
$products = $stmt->fetchAll();

$getProductsQuery = "select * from products order by ma_hh desc limit 0,3 ";

$connect = getDbConnect();
$stmt = $connect->prepare($getProductsQuery);
$stmt->execute();
$products1 = $stmt->fetchAll();

$getProductsQuery = "select count(*) from products";
$connect = getDbConnect();
$stmt = $connect->prepare($getProductsQuery);
$stmt->execute();
$products5 = $stmt->fetchColumn();

$getProductsQuery = "select * from products where luot_xem > 0 order by luot_xem desc limit 0, 10";
$connect = getDbConnect();
$stmt = $connect->prepare($getProductsQuery);
$stmt->execute();
$products6 = $stmt->fetchAll();

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
                            <input type="text" name="keyword" value="<?= $keyword ?>">
                        </div>
                    </div>
                </form>
                <div class="login" style="line-height:1;">
                    <?php
						if(isset($_SESSION['auth']) && !empty($_SESSION['auth'])) { ?>
                    <div class="log" style="width:50px;height:50px;position:relative;right:25px;top:30px;">
                        <?php
                        $ma_kh = $_SESSION['auth']['ma_kh'];
                        $getProductsQuery = "select * from users where ma_kh = '$ma_kh'";

                        $connect = getDbConnect();
                        $stmt = $connect->prepare($getProductsQuery);
                        $stmt->execute();
                        $products4 = $stmt->fetchAll();
                    ?>
                        <?php foreach($products4 as $keys => $cursors): ?>
                        <a href="<?= BASE_URL?>users/sua.php?ma_kh=<?= $cursors['ma_kh'] ?>" class="nav-link">
                            <img style="border-radius:50%;" width=50 height=50
                                src="<?= BASE_URL . $cursors['avatar'] ?>" class="img-fluid" ?>
                        </a>
                        <?php endforeach ?>
                    </div>
                    <?php
                    } else { ?>
                    <img style="position:relative;top:40px;" class="admin" src="img_project/admin.jpg" alt="">
                    <?php
                    }
                    ?>
                    <?php
						if(isset($_SESSION['auth']) && !empty($_SESSION['auth'])) { ?>
                    <div class="log" style="float:right;margin-right:90px;">
                        <a style="float:left;margin-left:30px;" href=" javascript:;" class="nav-link">
                            <?= $_SESSION['auth']['name'] ?>
                        </a>
                        <a style="float:right;margin-right:30px;position:relative;right:-10px;" class=" nav-link"
                            href="<?= BASE_URL. "users/doi-mk.php"?>">Đổi mk</a>
                        <a style="float:right;position:relative;right:-5px;" class=" nav-link"
                            href="<?= BASE_URL. "logout.php"?>">Đăng xuất</a>
                        <?php
						if($_SESSION['auth']['vai_tro']>0 && $_SESSION['auth']['vai_tro']>0) { ?>
                        <div class="log" style="float:right;position:relative;bottom:14px;left:35px;">
                            <a href="tai-khoan.php">Quản trị</a>
                        </div>
                        <?php
                    }
                    ?>
                    </div>
                    <?php
                    } else { ?>
                    <a style="position:relative;top:40px;left:10px;" href="login.php">Đăng nhập</a> <span
                        style="position:relative;top:40px;left:10px;">/</span> <a
                        style="position:relative;top:40px;left:10px;" href="users/tao-tk.php">Đăng ký</a>
                    <?php
                    }
                    ?>
                </div>
            </div>
            <img id="slideshow" width=1305 src="img_project/banner-iphone.jpg" alt="">
        </div>
        <div class="product">
            <div class="menu">
                <div class="category">
                    <h1>Danh mục</h1>
                </div>
                <div class="list" style="border: 1px solid white;">
                    <div class="pr1">
                        <a href="phone.php?tenloai=1">IPHONE</a>
                    </div>
                    <hr>
                    <div class="pr2">
                        <a href="phone.php?tenloai=4">SAMSUNG</a>
                    </div>
                    <hr>
                    <div class="pr3">
                        <a href="phone.php?tenloai=2">OPPO</a>
                    </div>
                </div>
                <div class="img-standee">
                    <img src="img_project/standee.jpg" alt="">
                </div>
            </div>
            <div class="list-product">
                <div class="row">
                    <?php foreach ($products6 as $keys => $cursors): ?>
                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4" style="margin-bottom:20px">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="border:1px solid #cdcdcd">
                            <a href="chi-tiet.php?ma_hh=<?= $cursors['ma_hh'] ?>&tenloai=<?= $cursors['tenloai'] ?>"><img
                                    style="margin-left:30px;" width=219 height=178
                                    src="<?= BASE_URL . $cursors['image'] ?>" class="img-fluid"></a>
                            <span
                                style=" position: absolute;top: 10px;right: 10px;width: 50px;height: 50px;text-align: center;padding: 1px 6px 1px 6px;cursor: pointer;font-size: 20px;font-weight: bold;color: #fff;background: #e11b1e;border: solid 1px #e11b1e;border-radius: 100px;line-height: 40px;;font-family:huyquoc"><?= $cursors['sale'] ?>%
                            </span>
                            <div class="grid-chain-bottom" style="text-align: center">
                                <div class="star-price">
                                    <span
                                        style="text-align:center;font-family: huy;line-height:0.8;font-size:18px;font-weight:bold;color: #646464;text-decoration: none;"><?= $cursors['name'] ?></span><br>
                                    <span
                                        style="text-align:center;font-family: huy;font-size:24px;font-weight:bold;color: #1B242F;"><?= number_format($cursors['don_gia'] - ($cursors['don_gia'] * ($cursors['sale'] / 100))) . "VNĐ" ?></span><br>
                                    <span
                                        style="text-decoration: line-through;color: #1DBAA5;font-weight: 700;font-size: 1.2em;"><?= number_format($cursors['don_gia']) ?>VNĐ</span><br>
                                    <a href="gio-hang.php?ma_hh=<?= $cursors['ma_hh'] ?>&tenloai=<?= $cursors['tenloai'] ?>"
                                        class="btn btn-primary">Thêm vào giỏ hàng</a>
                                    <div class="clearfix"> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach?>
                </div>
            </div>
        </div>
    </div>
    <div class="footer" style="height:192px;margin-top:20px;width:1305px;">
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
</script>