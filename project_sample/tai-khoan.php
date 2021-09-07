<?php
session_start();
require_once "./lib/db.php";
require_once "./lib/common.php";
checkAuths();
// lấy dữ liệu từ trên url => keyword
$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : "";
$msg = isset($_GET['msg'])?$_GET['msg']:"";
// query lấy danh sách user từ db
$getUserQuery = "select * from users";

if($keyword !== ""){
    $getUserQuery .= " where name like '%$keyword%' or email like '%$keyword%' ";
}
$connect = getDbConnect();
$stmt = $connect->prepare($getUserQuery);
$stmt->execute();
$users = $stmt->fetchAll();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách tài khoản</title>
    <?php include_once "./_share/style.php" ?>
</head>

<body>
    <?php include_once "./_share/header.php" ?>
    <main class="container-fluid">
        <!-- Hiển thị danh sách users -->
        <div class="container">
            <br>
            <form action="" method="get">
                <div class="form-group row">
                    <label for="" class="col-sm-1 col-form-label">Từ khóa</label>
                    <div class="col-sm-4">
                        <input type="text" name="keyword" class="form-control" value="<?= $keyword ?>">
                    </div>
                </div>
            </form>
            <h1 style="text-align:center;color:red;"><?= $msg?></h1>
            <table class="table table-stripped">
                <thead>
                    <th>Mã khách hàng</th>
                    <th>Họ và tên</th>
                    <th>Hoạt động</th>
                    <th>Email</th>
                    <th>SĐT</th>
                    <th width="70">Ảnh</th>
                    <th>Vai trò</th>
                    <th>Ngày sinh</th>
                    <th>
                        <a href="<?= BASE_URL?>tao-tk-user.php" class="btn btn-sm btn-success">
                            Tạo mới
                        </a>
                    </th>
                </thead>
                <tbody>
                    <?php foreach ($users as $key => $cursor): ?>
                    <tr>
                        <td><?= $cursor['ma_kh'] ?></td>
                        <td><?= $cursor['name'] ?></td>
                        <td><?= ($cursor['kich_hoat'])?"kích hoạt":"chưa kích hoạt" ?></td>
                        <td><?= $cursor['email'] ?></td>
                        <td><?= $cursor['number_phone'] ?></td>
                        <td>
                            <img src="<?=$cursor['avatar'] ?>" class="img-fluid">
                        </td>
                        <td><?= ($cursor['vai_tro'])?"Nhân viên":"Khách hàng" ?></td>
                        <td>
                            <?= datetimeConvert($cursor['ngay_sinh'], "d/m/Y")?>
                        </td>
                        <td>
                            <a href="<?= BASE_URL?>sua.php?ma_kh=<?= $cursor['ma_kh'] ?>" class="btn btn-info btn-sm">
                                Sửa
                            </a>
                            <a onclick="return confirm('bạn có chắc muốn xóa tài khoản này?')"
                                href="<?= BASE_URL?>users/xoa.php?ma_kh=<?= $cursor['ma_kh'] ?>"
                                class="btn btn-danger btn-sm">
                                Xóa
                            </a>
                        </td>
                    </tr>
                    <?php endforeach?>
                </tbody>
            </table>
        </div>
    </main>
</body>

</html>