<?php
session_start();
require_once "./lib/db.php";
require_once "./lib/common.php";
checkAuths();
$userId = isset($_GET['ma_kh']) ? $_GET['ma_kh']: "";
$userIdErr = "";
if(is_numeric($userId) == true){
    $userIdErr = "Mã khách hàng không phải kiểu số";
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
    <title>Document</title>
    <link rel="stylesheet" href="users/css/layout_project.css">
    <?php include_once "./_share/style.php" ?>
</head>

<body>
    <?php include_once "./_share/header.php" ?>
    <main class="container-fluid">
        <!-- Form tạo mới tk -->
        <h3>Chỉnh sửa tài khoản</h3>
        <form action="<?= BASE_URL ?>luu-sua-tk-user.php?ma_kh=<?=$user['ma_kh']?>" method="POST"
            enctype="multipart/form-data">
            <div class="row">
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
                        <label for="">Kích hoạt</label><br>
                        <label><input name="kich_hoat" value="1" <?php if($user['kich_hoat'] == 1): ?> checked
                                <?php endif ?> type="radio">Kích hoạt</label>
                        <label><input name="kich_hoat" value="0" <?php if($user['kich_hoat'] == 0): ?> checked
                                <?php endif ?> type="radio">Chưa kích hoạt</label>
                    </div>
                    <div class="col-md-6">
                        <div class="row-1">
                            <div class="col-4 offset-4">
                                <img width=70 src="<?= BASE_URL . $user['avatar'] ?>" class="img-fluid">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Ảnh đại diện</label>
                            <input type="file" name="avatar" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Vai trò</label><br>
                        <label><input name="vai_tro" value="1" <?php if($user['vai_tro'] == 1): ?> checked
                                <?php endif ?> type="radio">Nhân viên</label>
                        <label><input name="vai_tro" value="0" <?php if($user['vai_tro'] == 0): ?> checked
                                <?php endif ?> type="radio">Khách hàng</label>
                    </div>
                    <div class="form-group">
                        <label for="">Số điện thoại</label>
                        <input type="number" name="number_phone" value="<?= $user['number_phone'] ?>"
                            class="form-control"><br>
                        <?php if(isset($_GET['number_phoneerr'])):?>
                        <span class="text-danger" style="color:red;"><?= $_GET['number_phoneerr'] ?></span>
                        <?php endif ?>
                    </div>
                    <div class="form-group">
                        <label for="">Ngày sinh</label>
                        <input type="text" name="ngay_sinh" value="<?= $user['ngay_sinh'] ?>" class="form-control"><br>
                        <?php if(isset($_GET['ngay_sinherr'])):?>
                        <span class="text-danger" style="color:red;"><?= $_GET['ngay_sinherr'] ?></span>
                        <?php endif ?>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-end" style="height:100px;">
                <button type="submit" class="btn btn-sm btn-info"
                    style="position:relative;right:700px; height:35px;">Lưu</button>
                &nbsp;
                <a href="<?= BASE_URL_1 ?>" class="btn btn-sm btn-danger"
                    style="position:relative;right:700px;height:35px;">Hủy</a>
            </div>
        </form>
    </main>
</body>

</html>