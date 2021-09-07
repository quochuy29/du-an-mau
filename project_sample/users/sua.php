<?php
session_start();
require_once "../lib/db.php";
require_once "../lib/common.php";
checkAuth();
$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : "";
$userId = isset($_GET['ma_kh']) ? $_GET['ma_kh']: 0;
$userIdErr = "";
if(is_numeric($userId) == true){
    $userIdErr = "Mã khách hàng hông phải kiểu số";
    header("location: " . BASE_URL_1 . "?msg=$userIdErr");
    die;
}
$connect = getDbConnect();
$getUserByIdQuery = "select * from users where ma_kh = '$userId' ";
$stmt = $connect->prepare($getUserByIdQuery);
$stmt->execute();
$user = $stmt->fetch();
// fetch => tìm ra bản ghi đầu tiên thỏa mãn câu sql => [ 'id' => xxx, 'name' => 'xxx' ]
// fetchAll => tìm ra tất cả các bản ghi thỏa mãn câu sql => [ [], [], [] ]
if(!$user){
    header("location: " . BASE_URL_1 . "?msg=User không tồn tại");
    die;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa thông tin</title>
    <link rel="stylesheet" href="css/layout_project.css">
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
            <img id="slideshow" width=1305 src="img_project/banner-iphon.jpg" alt="">
        </div>
        <main class="container-fluid">
            <h3 style="text-align:center;font-weight:bold;color: #26b4fe;font-size:30px;">Chỉnh sửa tài khoản</h3>
            <form action="<?= BASE_URL ?>users/luu-sua-tk.php?ma_kh=<?= $user['ma_kh'] ?>" method="POST"
                enctype="multipart/form-data" style="height:500px;">
                <div class="row" style=" margin-left: 450px;height:500px;">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Mã khách hàng</label>
                            <input type="text" name="ma_kh" value="<?= $user['ma_kh'] ?>" class="form-control">
                            <?php if(isset($_GET['ma_kherr'])):?>
                            <span class="text-danger" style="color:red;"><?= $_GET['ma_kherr'] ?></span>
                            <?php endif ?>
                        </div>
                        <div class="form-group">
                            <label for="">Họ và tên</label>
                            <input type="text" name="name" value="<?= $user['name'] ?>" class="form-control">
                            <?php if(isset($_GET['nameerr'])):?>
                            <span class="text-danger" style="color:red;"><?= $_GET['nameerr'] ?></span>
                            <?php endif ?>
                        </div>
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="text" name="email" value="<?= $user['email'] ?>" class="form-control">
                            <?php if(isset($_GET['emailerr'])):?>
                            <span class="text-danger" style="color:red;"><?= $_GET['emailerr'] ?></span>
                            <?php endif ?>
                        </div>
                        <div class="form-group">
                            <div class="row-1">
                                <div class="col-4 offset-4">
                                    <img width=70 src="<?= BASE_URL . $user['avatar'] ?>" class="img-fluid">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">Ảnh đại diện</label>
                                <input type="file" style="width:400px;" name="avatar" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end" style="position:relative;left:750px;bottom:50px;">
                    <button type="submit" class="btn btn-sm btn-info">Lưu</button>
                    &nbsp;
                    <a href="<?= BASE_URL_1 ?>" class="btn btn-sm btn-danger">Hủy</a>
                </div>
            </form>
        </main>
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
    'img_project/banner-iphon.jpg',
    'img_project/banner-opp.jpg',
    'img_project/banner-samsun.jpg',
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