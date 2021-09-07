<?php
session_start();
require_once "./lib/db.php";
require_once "./lib/common.php";

// lấy dữ liệu từ trên url => keyword
$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : "";
$ma_hh = isset($_GET['ma_hh'])?$_GET['ma_hh']: -1;
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
    <title>Chi tiết sản phẩm</title>
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
                    <img src="img_project/stan.jpg" alt="">
                </div>
            </div>
            <div class="list-product">
                <div class="row">
                    <?php
                    if(!$products){?>
                    <h1>Không có kết quả : 404 NOT FOUND !</h1>
                    <?php }else{
                    foreach ($products as $keys => $cursor): ?>
                    <div class="single_grid">
                        <div class="grid images_3_of_2">
                            <ul id="etalage">
                                <li>
                                    <a href="#">
                                        <img style="margin-left:30px;" width=219 height=178
                                            src="<?= BASE_URL . $cursor['image'] ?>" class="img-fluid">
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
                                <a class="now-get get-cart-in"
                                    href="gio-hang.php?ma_hh=<?= $cursor['ma_hh'] ?>&tenloai=<?= $cursor['tenloai'] ?>"
                                    class="btn btn-primary">Thêm vào giỏ hàng</a>
                                <div class="clearfix"></div>
                                <img src="img_project/email.jpg" alt="">
                                <a class="now-get get-cart-in" href="send-email.php?ma_hh=<?= $cursor['ma_hh'] ?>"
                                    style="position:relative;top:40px;width:160.69px;">Hộp
                                    thư gửi ý
                                    kiến</a>
                            </div>
                            <p><?= $cursor['mo_ta'] ?></p>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                    <div class="toogle">
                        <h3 class="m_3">Chi tiết sản phẩm</h3>
                        <p class="m_text"><?= $cursor['mo_ta'] ?></p>
                        <div class="chia" style="display:grid;grid-template-columns: 492px 1fr;">
                            <div class="sub-cate" style="width: 100%;">
                                <div class=" top-nav rsidebar span_1_of_left"
                                    style="padding:15px;border: 0px solid #ddd;">
                                    <h3 style="text-align:center;">Sản phẩm liên quan</h3>
                                    <div class="row-9" style="height:277px;">
                                        <?php 
                                                foreach ($product as $keys => $cursors){
                                                ?>
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"
                                            style="border-bottom:1px solid #cdcdcd;padding: 20px 0px; border: 1px solid #ddd;">
                                            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                                <a
                                                    href="chi-tiet.php?ma_hh=<?= $cursors['ma_hh'] ?>&tenloai=<?= $cursors['tenloai'] ?>"><img
                                                        width=50 height=50 src="<?= BASE_URL . $cursors['image'] ?>"
                                                        class="img-fluid"></a>
                                            </div>
                                            <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9" style="padding-top:10px">
                                                <span style="margin-top:10px"><?= $cursors['name'] ?></span><br>
                                            </div>
                                        </div>
                                        <?php
                    
                                            } ?>
                                    </div>
                                </div>
                            </div>
                            <div class="cmt" style="margin-top:43px;">
                                <h3>Bình luận</h3>
                                <form action="comment.php?ma_hh=<?= $ma_hh?>&tenloai=<?= $tenloai?>" method="post">
                                    <textarea name="noi_dung" class="form-control" style="width: 90%;" rows="1"
                                        required="required"></textarea> <br>
                                    <button type="submit" name="comment" class="btn btn-danger">Bình luận</button>
                                </form>
                                <?php
                                    foreach ($comment as $key => $cursor): ?>
                                <span style="font-weight:bold;"><?= $cursor['ma_kh'] ?></span>
                                <span
                                    style="float:right;font-size:10px;margin-right:50px;"><?= $cursor['ngay_bl'] ?></span><br>
                                <span style="font-size:20px;color:gray;"><?= $cursor['noi_dung'] ?></span><br>
                                <?php
                                    if(isset($_SESSION['auth']) && !empty($_SESSION['auth']) && $_SESSION['auth']['vai_tro'] > 0){?>
                                <a style="margin-top:20px;" class="delete"
                                    href="<?= BASE_URL?>comment/xoa-cmt.php?ma_b=<?= $cursor['ma_b'] ?>&ma_hh=<?= $ma_hh ?>">
                                    Xóa
                                </a>
                                <?php
                                    } elseif(isset($_SESSION['auth']) && !empty($_SESSION['auth']) && $_SESSION['auth']['ma_kh'] == $cursor['ma_kh']) { ?>
                                <a style="margin-top:20px;" class="delete"
                                    href="<?= BASE_URL?>comment/xoa-cmt.php?ma_b=<?= $cursor['ma_b'] ?>&ma_hh=<?= $ma_hh ?>">
                                    Xóa
                                </a>
                                <?php
                                    }
                                ?>
                                <hr>
                                <?php endforeach?>
                            </div>
                        </div>
                    </div>
                    <?php endforeach?>
                    <?php }?>
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