<?php
session_start();
require_once "./lib/db.php";
require_once "./lib/common.php";
checkAuths();
// lấy dữ liệu từ trên url => keyword
$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : "";

$msg = isset($_GET['msg'])?$_GET['msg']:"";
$msc = isset($_GET['msc'])?$_GET['msc']:"";
if (!isset($_GET['page'])) {
	$product = 1;
} else {
	$product = $_GET['page'];
}
$data = 6;
$sql = "select count(*) from products";
$connect = getDbConnect();
$result = $connect->prepare($sql);
$result->execute();
$number = $result->fetchColumn();
$page = ceil($number / $data);
$tin = ($product - 1) * $data;
// query lấy danh sách từ db
$getProductsQuery = "select
                          p.*,
                          c.ten_loai as cate_loai
                    from products p 
                    join sectors c
                     on p.tenloai = c.ma_loai where name like '%$keyword%' or tenloai like '%$keyword%' order by c.ten_loai asc limit $tin,$data";

$connect = getDbConnect();
$stmt = $connect->prepare($getProductsQuery);
$stmt->execute();
$products = $stmt->fetchAll();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách products</title>
    <?php include_once "./_share/style.php" ?>
</head>

<body>
    <?php include_once "./_share/header.php" ?>
    <main class="container-fluid">
        <!-- Hiển thị danh sách products -->
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
            <h1 style="text-align:center;color:red;"><?= $msc?></h1>
            <table class="table table-stripped">
                <thead>
                    <th width="70">Mã hàng hóa</th>
                    <th>Tên hàng hóa</th>
                    <th>Đơn giá</th>
                    <th>Sale</th>
                    <th width="70">Ảnh</th>
                    <th>Tên loại</th>
                    <th>Hàng đặc biệt</th>
                    <th>Hàng ký gửi</th>
                    <th>Ngày nhập</th>
                    <th>Lượt xem</th>
                    <th>
                        <a href="<?= BASE_URL?>products/tao-sp.php" class="btn btn-sm btn-success">
                            Tạo mới
                        </a>
                    </th>
                </thead>
                <tbody>
                    <?php
			            foreach ($products as $keys => $cursors){
					?>
                    <tr>
                        <td><?= $cursors['ma_hh'] ?></td>
                        <td><?= $cursors['name'] ?></td>
                        <td><?= number_format($cursors['don_gia'])." ".'VNĐ' ?></td>
                        <td><?= $cursors['sale'] .'%' ?></td>
                        <td>
                            <img src="<?= BASE_URL . $cursors['image'] ?>" class="img-fluid">
                        </td>
                        <td><?= $cursors['cate_loai'] ?></td>
                        <td><?= ($cursors['hang_db'])?"Đặc biệt":"Bình thường" ?></td>
                        <td><?= ($cursors['ky_gui'])?"Ký gửi":"Hàng bán" ?></td>
                        <td>
                            <?= datetimeConvert($cursors['ngay_nhap'], "d/m/Y")?>
                        </td>
                        <td><?= $cursors['luot_xem'] ?></td>
                        <td>
                            <a href="<?= BASE_URL?>xem-chi-tiet-sp.php?ma_hh=<?= $cursors['ma_hh'] ?>"
                                class="btn btn-info btn-sm">
                                xem chi tiết
                        </td>
                    </tr>
                    <?php
			}
			?>
                </tbody>
            </table>
            <?php
	for ($t = 1; $t <= $page; $t++) { ?>
            <a class="btn btn-primary" href="san-pham.php?page=<?= $t ?>" role="button"><?= $t ?></a>
            <?php
	}
	?>
    </main>
</body>

</html>