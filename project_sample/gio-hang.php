<?php
session_start();
require_once "./lib/db.php";
require_once "./lib/common.php";
checkAuth();
// lấy dữ liệu từ trên url => keyword
$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : "";
$ma_hh = $_GET['ma_hh'];

$ma_kh = $_SESSION['auth']['ma_kh'];
// query lấy danh sách user từ db
$getProductsQuery = "select * from products where ma_hh = $ma_hh ";
$connect = getDbConnect();
$stmt = $connect->prepare($getProductsQuery);
$stmt->execute();
$products = $stmt->fetchAll();

$tenloai = $_GET['tenloai'];

$getProductQuery = "select * from products where tenloai = $tenloai order by rand() limit 3,3";
$connect = getDbConnect();
$stmt = $connect->prepare($getProductQuery);
$stmt->execute();
$product = $stmt->fetchAll();

$getProductQuery = "select * from comments where ma_hh = $ma_hh order by ma_hh desc ";

$connect = getDbConnect();
$stmt = $connect->prepare($getProductQuery);
$stmt->execute();
$products1 = $stmt->fetchAll();

$getCommentQuery = "select * from comment where id_hh = $ma_hh ";

$connect = getDbConnect();
$stmt = $connect->prepare($getCommentQuery);
$stmt->execute();
$comment = $stmt->fetchAll();

$getProductsQuery = "select * from users where ma_kh = '$ma_kh'";

$connect = getDbConnect();
$stmt = $connect->prepare($getProductsQuery);
$stmt->execute();
$products4 = $stmt->fetchAll();

$getProductsQuery = "update products set luot_xem = luot_xem + 1 where ma_hh='$ma_hh'";

$connect = getDbConnect();
$stmt = $connect->prepare($getProductsQuery);
$stmt->execute();
$products5 = $stmt->fetchAll();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ hàng</title>
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
                            <input type="text" name="keyword" value="<?= $keyword ?>" style="border-radius: 5px;
    border: 1px solid gray;
    width: 250px;
    height: 35px;">
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
                        <img src="img_project/stan.jpg" alt="">
                    </div>
                </div>
                <div class="list-product">
                    <div class="row">
                        <?php foreach ($products as $keys => $cursor): ?>
                        <div class="single_grid">
                            <div class="grid images_3_of_2">
                                <ul id="etalage">
                                    <li>
                                        <a href="#">
                                            <img style="margin-left:30px;" width=219 height=178
                                                src="<?= BASE_URL . $cursor['image'] ?>" class="img-fluid" ?>
                                        </a>
                                    </li>
                                </ul>
                                <div class="clearfix"> </div>
                            </div>
                            <div class="desc1 span_3_of_2">
                                <h4><?= $cursor['name'] ?></h4>
                                <div class="cart-b">
                                    <div class="left-n ">
                                        <span
                                            style="text-align:center;font-family: huy;font-size:24px;font-weight:bold;color: #1B242F;"><?= number_format($cursor['don_gia'] - ($cursor['don_gia'] * ($cursor['sale'] / 100))) . "VNĐ" ?></span><br>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <form style="height:200px;"
                                    action="http://localhost/php1/project_sample/luu-tao-hang.php?ma_hh=<?= $cursor['ma_hh']?>&tenloai=<?= $cursor['tenloai']?>&image=<?= $cursor['image'] ?>&gia=<?= ($cursor['don_gia'] - ($cursor['don_gia'] * ($cursor['sale'] / 100))) ?>&ma_kh=<?= $ma_kh?>"
                                    method="POST" enctype="multipart/form-data">
                                    <div class="row" style="text-align: left;">
                                        <div class="col-md-6" style="width:100%;">
                                            <div class="form-group" style=" margin-top: 10px;">
                                                <label for="">Tên hàng hóa</label>
                                                <input type="text" name="ten_hh" value="<?= $cursor['name'] ?>"
                                                    class="form-control">
                                            </div>
                                            <div class="form-group" style=" margin-top: 10px;">
                                                <label for="">Số điện thoại</label>
                                                <input type="number" name="so_luong"
                                                    value="<?= $cursors['number_phone'] ?>" class="form-control">
                                            </div>
                                            <div class="form-group" style=" margin-top: 10px;">
                                                <label for="">Số lượng</label>
                                                <input type="number" name="so_luong" class="form-control">
                                            </div>
                                            <div class="form-group" style=" margin-top: 10px;">
                                                <label for="">Địa chỉ</label>
                                                <input type="text" name="dia_chi" class="form-control">
                                                <?php if(isset($_GET['dia_chierr'])):?>
                                                <span class="text-danger"
                                                    style="color:red;"><?= $_GET['dia_chierr'] ?></span>
                                                <?php endif ?>
                                            </div>

                                            <div class="form-group" style=" margin-top: 10px;">
                                                <label for="">Yêu cầu khác</label>
                                                <input type="text" name="yeu_cau" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="save">
                                        <button type="submit" class="save-1">Lưu</button>
                                        &nbsp;
                                        <a href="#" class="save-2">Hủy</a>
                                    </div>
                                </form>
                            </div>
                            <div class="clearfix"> </div>
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