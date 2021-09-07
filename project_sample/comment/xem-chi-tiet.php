<?php
 session_start();
 require_once "../lib/db.php";
 require_once "../lib/common.php";
$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : "";
                    
$ma_hh = $_GET['ma_hh'];

$getCommentQuery = "select * from comment ";

if($keyword !== ""){
    $getCommentQuery .= " where noi_dung like '%$keyword%' or ma_kh like '%$keyword%' ";
}
$connect = getDbConnect();
$stmt = $connect->prepare($getCommentQuery);
$stmt->execute();
$comment = $stmt->fetchAll();

$getCommentQuery ="select * from comment where id_hh = '$ma_hh'";

$connect = getDbConnect();
$stmt = $connect->prepare($getCommentQuery);
$stmt->execute();
$comments = $stmt->fetchAll();
if(!$comments){
    header("location: " . BASE_URL_8 . "?msg=Bình luận của hàng hóa này không tồn tại");
    die;
}

$getCommentQuery ="select * from products where ma_hh = '$ma_hh'";
$connect = getDbConnect();
$stmt = $connect->prepare($getCommentQuery);
$stmt->execute();
$products = $stmt->fetchAll();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách bình luận</title>
    <?php include_once "../_share/style.php" ?>
</head>

<body>
    <?php include_once "../_share/header.php" ?>
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
            <table class="table table-stripped">
                <thead>
                    <th>Mã sản phẩm</th>
                    <th>Ảnh sản phẩm</th>
                    <th>Nội dung</th>
                    <th>Ngày bình luận</th>
                    <th>Tác vụ</th>
                </thead>
                <tbody>
                    <?php
                    foreach($comments as $key => $cursor){
                        foreach($products as $key => $cursors){
                            ?>
                    <tr>
                        <td><?= $cursors['ma_hh'] ?></td>
                        <td><img width=50 height=50 src="<?= BASE_URL . $cursors['image'] ?>" class="img-fluid"></td>
                        <td><?= $cursor['noi_dung'] ?></td>
                        <td><?= $cursor['ngay_bl'] ?></td>
                        <td>
                            <a href="<?= BASE_URL?>comment/xoa.php?ma_b=<?= $cursor['ma_b'] ?>&ma_hh=<?= $ma_hh ?>"
                                class="btn btn-info btn-sm">
                                Xóa
                            </a>
                        </td>
                    </tr>
                    <?php
                        }
                    }
                ?>
                </tbody>
            </table>
        </div>
    </main>
</body>

</html>