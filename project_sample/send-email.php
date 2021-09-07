<?php
session_start();
require_once "./lib/db.php";
require_once "./lib/common.php";
checkAuth();
$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : "";
$ma_hh = isset($_GET['ma_hh'])?$_GET['ma_hh']: -1;

$getProductsQuery = "select name from products where ma_hh = $ma_hh ";
$connect = getDbConnect();
$stmt = $connect->prepare($getProductsQuery);
$stmt->execute();
$products = $stmt->fetchColumn();

$ma_kh = $_SESSION['auth']['ma_kh'];

$getUsersQuery = "select email from users where ma_kh = '$ma_kh'";
$connect = getDbConnect();
$stmt = $connect->prepare($getUsersQuery);
$stmt->execute();
$user = $stmt->fetchColumn();

$getUsersQuery = "select name from users where ma_kh = '$ma_kh'";
$connect = getDbConnect();
$stmt = $connect->prepare($getUsersQuery);
$stmt->execute();
$users = $stmt->fetchColumn();

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
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
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
        <div class="login-account" style="height:650px;">
            <h3
                style=" text-align: center;font-weight: bold;font-size: 30px;font-family: Arial, Helvetica, sans-serif;color: #26b4fe;">
                Gửi ý kiến</h3>

            <h4 style="margin-left:550px;" class="sent-notification"></h4>
            <form id="myForm" enctype="multipart/form-data" style="margin-left:550px;margin-top:70px;">
                <div class="form-group" style=" margin-top: 10px;width:400px">
                    <label for="">Họ và tên</label>
                    <input type="text" id="name" value="<?= $users?>" class="form-control"><br>
                </div>
                <div class="form-group" style=" margin-top: 10px;width:400px">
                    <label>Email</label>
                    <input type="text" id="email" value="<?= $user?>" class="form-control"><br>
                </div>
                <div class="form-group" style=" margin-top: 10px;width:400px">
                    <label>Chủ đề</label>
                    <input type="text" id="subject" value="<?= $products?>" class="form-control"><br>
                </div>
                <div class="form-group" style=" margin-top: 10px;width:400px">
                    <label>Nội dung</label>
                    <textarea id="body" cols="55" rows="5" placeholder="Type Message"></textarea>
                </div>
                <button type="button" onclick="sendEmail()" value="Send An Email">Submit</button>
            </form>

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
</script>
<script src="http://code.jquery.com/jquery-3.3.1.min.js"></script>
<script type="text/javascript">
function sendEmail() {
    var name = $("#name");
    var email = $("#email");
    var subject = $("#subject");
    var body = $("#body");

    if (isNotEmpty(name) && isNotEmpty(email) && isNotEmpty(subject) && isNotEmpty(body)) {
        $.ajax({
            url: 'sendEmail.php',
            method: 'POST',
            dataType: 'json',
            data: {
                name: name.val(),
                email: email.val(),
                subject: subject.val(),
                body: body.val()
            },
            success: function(response) {
                $('#myForm')[0].reset();
                $('.sent-notification').text("Message Sent Successfully.");
            }
        });
    }
}

function isNotEmpty(caller) {
    if (caller.val() == "") {
        caller.css('border', '1px solid red');
        return false;
    } else
        caller.css('border', '');

    return true;
}
</script>