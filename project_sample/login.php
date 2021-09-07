<?php
session_start();
require_once "./lib/db.php";
require_once "./lib/common.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <?php include_once "./_share/style.php" ?>
    <style>
    .container-fluid {
        /* The image used */
        background-image: url("img_project/galaxy.jpg");

        min-height: 600px;

        /* Center and scale the image nicely */
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        position: relative;
    }

    label {
        color: #02AFFA;
    }
    </style>
</head>

<body>
    <main class="container-fluid">
        <!-- Hiển thị danh sách users -->
        <div class="container"
            style="position:relative;top:50px;background-color:#ffffff;height:400px;width:400px;opacity:0.7">
            <h1 style="text-align:center;color:#02AFFA;padding-top:20px;font-weight:bold;">Đăng nhập</h1>
            <div class="row">
                <div class="col-6 offset-3">
                    <form action="<?= BASE_URL ?>post-login.php" method="post">
                        <div class="form-group">
                            <label for="">Mã khách hàng</label>
                            <input type="text" class="form-control" name="ma_kh">
                            <?php if(isset($_GET['ma_kherr'])):?>
                            <span class="text-danger" style="color:red;"><?= $_GET['ma_kherr'] ?></span>
                            <?php endif ?>
                        </div>
                        <div class="form-group">
                            <label for="">Mật Khẩu</label>
                            <input type="password" class="form-control" name="password">
                            <?php if(isset($_GET['passworderr'])):?>
                            <span class="text-danger" style="color:red;"><?= $_GET['passworderr'] ?></span>
                            <?php endif ?>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-sm btn-info">Login</button>
                            <a href="<?= BASE_URL ?> " class="btn btn-sm btn-info">Hủy</a>
                            <a href="http://localhost/php1/project_sample/quen-mk.php" class="btn btn-sm btn-info"
                                style="position:relative;top:10px;">Quên
                                mật khẩu</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

</body>

</html>