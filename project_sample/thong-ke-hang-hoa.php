<?php
session_start();
require_once "./lib/db.php";
require_once "./lib/common.php";
checkAuths();
// lấy dữ liệu từ trên url => keyword
$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : "";
// query lấy danh sách từ db
$getProductsQuery = "select distinct p.tenloai,
                         c.ten_loai as cate_loai
                         from products p join sectors c 
                         on p.tenloai = c.ma_loai ";

if($keyword !== ""){
    $getProductsQuery .= " where ten_loai like '%$keyword%' ";
}

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
            <table class="table table-stripped">
                <thead>
                    <th>Tên hàng hóa</th>
                    <th>Số lượng</th>
                    <th>Đơn giá cao nhất</th>
                    <th>Đơn giá thấp nhất</th>
                    <th>Đơn giá trung bình</th>
                </thead>
                <tbody>
                    <?php foreach ($products as $keys => $cursors ){
                        $tenloai = $cursors['tenloai'];
                    ?>
                    <?php 
                        $getProductsQuery = "select count(tenloai) from products where tenloai = $tenloai ";
                        
                        $connect = getDbConnect();
                        $stmt = $connect->prepare($getProductsQuery);
                        $stmt->execute();
                        $product3 = $stmt->fetchColumn();
                    ?>
                    <?php 
                        $getProductsQuery = "select max(don_gia) as min_gia from products where tenloai = $tenloai";
                        
                        $connect = getDbConnect();
                        $stmt = $connect->prepare($getProductsQuery);
                        $stmt->execute();
                        $product4 = $stmt->fetchColumn();
                    ?>
                    <?php 
                        $getProductsQuery = "select min(don_gia) as max_gia from products where tenloai = $tenloai";
                        
                        $connect = getDbConnect();
                        $stmt = $connect->prepare($getProductsQuery);
                        $stmt->execute();
                        $product5 = $stmt->fetchColumn();
                    ?>
                    <?php 
                        $getProductsQuery = "select avg(don_gia) as max_gia from products where tenloai = $tenloai";
                        
                        $connect = getDbConnect();
                        $stmt = $connect->prepare($getProductsQuery);
                        $stmt->execute();
                        $product6 = $stmt->fetchColumn();
                    ?>
                    <tr>
                        <td><?= $cursors['cate_loai'] ?></td>
                        <td><?= number_format($product3) ?></td>
                        <td><?= number_format($product4) ?></td>
                        <td><?= number_format($product5) ?></td>
                        <td><?= number_format(ceil($product6)) ?></td>
                    </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </main>
</body>

</html>