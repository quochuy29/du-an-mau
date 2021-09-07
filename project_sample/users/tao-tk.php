<?php
session_start();
require_once "../lib/common.php";
$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : "";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký thành viên</title>
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
                <div class="login">
                    <img class="admin" src="img_project/admin.jpg" alt="">
                    <a href="<?= BASE_URL_16?>">Đăng nhập</a> / <a href="">Đăng ký</a>
                </div>
            </div>
            <img id="slideshow" width=1290 src="img_project/banner-ip.jpg" alt="">
        </div>
        <main class="container-fluid">
            <h3
                style=" text-align: center;font-weight: bold;font-size: 30px;font-family: Arial, Helvetica, sans-serif;color: #26b4fe;">
                Tạo mới tài khoản</h3>
            <form action="http://localhost/php1/project_sample/users/luu-tao-tk.php" method="POST"
                enctype="multipart/form-data" style="height:650px;">
                <div class="row" style="text-align: left;margin-left: 450px;height:650px;">
                    <div class="col-md-6">
                        <div class="form-group" style=" margin-top: 10px;">
                            <label for="">Mã khách hàng</label>
                            <input type="text" name="ma_kh" class="form-control"><br>
                            <?php if(isset($_GET['ma_kherr'])):?>
                            <span class="text-danger" style="color:red;"><?= $_GET['ma_kherr'] ?></span>
                            <?php endif ?>
                        </div>
                        <div class="form-group" style=" margin-top: 10px;">
                            <label for="">Họ và tên</label>
                            <input type="text" name="name" class="form-control"><br>
                            <?php if(isset($_GET['nameerr'])):?>
                            <span class="text-danger" style="color:red;"><?= $_GET['nameerr'] ?></span>
                            <?php endif ?>
                        </div>
                        <div class="form-group" style=" margin-top: 10px;">
                            <label for="">Email</label>
                            <input type="text" name="email" class="form-control"><br>
                            <?php if(isset($_GET['emailerr'])):?>
                            <span class="text-danger" style="color:red;"><?= $_GET['emailerr'] ?></span>
                            <?php endif ?>
                        </div>
                        <div class="form-group" style=" margin-top: 10px;">
                            <label for="">Mật khẩu</label>
                            <input type="password" name="password" class="form-control"><br>
                            <?php if(isset($_GET['passworderr'])):?>
                            <span class="text-danger" style="color:red;"><?= $_GET['passworderr'] ?></span>
                            <?php endif ?>
                        </div>
                        <div class="form-group" style=" margin-top: 10px;">
                            <label for="">Xác nhận mật khẩu</label>
                            <input type="password" name="cfpassword" class="form-control">
                            <?php if(isset($_GET['cfpassworderr'])):?>
                            <span class="text-danger" style="color:red;"><?= $_GET['cfpassworderr'] ?></span>
                            <?php endif ?>
                        </div>
                        <div class="form-group">
                            <label for="">Ảnh đại diện</label>
                            <input type="file" name="avatar" class="form-control"><br>
                            <?php if(isset($_GET['avatarerr'])):?>
                            <span class="text-danger" style="color:red;"><?= $_GET['avatarerr'] ?></span>
                            <?php endif ?>
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