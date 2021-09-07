<?php
session_start();
require_once "./lib/common.php";
require_once "./lib/db.php";
checkAuths();
$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : "";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tạo tài khoản</title>
    <?php include_once "./_share/style.php" ?>
</head>

<body>
    <?php include_once "./_share/header.php" ?>
    <main class="container-fluid">
        <!-- Form tạo mới tk -->
        <h3>Tạo mới tài khoản</h3>
        <form action="<?= BASE_URL?>luu-tao-tk-user.php" method="POST" enctype="multipart/form-data">
            <div class="row">
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
                        <label for="">Hoạt động</label><br>
                        <label><input style="width:10px;height:auto;" name="kich_hoat" value="0" type="radio">Chưa
                            kích hoạt</label>
                        <label><input style="width:10px;height:auto;" name="kich_hoat" value="1" type="radio"
                                checked>Kích hoạt</label>
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
                        <input type="file" name="avatar" class="form-control">
                        <?php if(isset($_GET['avatarerr'])):?>
                        <span class="text-danger" style="color:red;"><?= $_GET['avatarerr'] ?></span>
                        <?php endif ?>
                    </div>
                    <div class="form-group" style=" margin-top: 10px;">
                        <label for="">Vai trò</label><br>
                        <label><input style="width:10px;height:auto;" name="vai_tro" value="1" type="radio" checked>Nhân
                            viên</label>
                        <label><input style="width:10px;height:auto;" name="vai_tro" value="0" type="radio">Khách
                            hàng</label>
                    </div>
                    <div class="form-group">
                        <label for="">Số điện thoại</label>
                        <input type="text" name="number_phone" class="form-control"><br>
                        <?php if(isset($_GET['number_phoneerr'])):?>
                        <span class="text-danger" style="color:red;"><?= $_GET['number_phoneerr'] ?></span>
                        <?php endif ?>
                    </div>
                    <div class="form-group">
                        <label for="">Ngày sinh</label>
                        <input type="text" name="ngay_sinh" class="form-control"><br>
                        <?php if(isset($_GET['ngay_sinherr'])):?>
                        <span class="text-danger" style="color:red;"><?= $_GET['ngay_sinherr'] ?></span>
                        <?php endif ?>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-sm btn-info">Lưu</button>
                &nbsp;
                <a href="<?= BASE_URL_5 ?>" class="btn btn-sm btn-danger">Hủy</a>
            </div>
        </form>
    </main>
</body>

</html>