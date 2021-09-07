<?php
session_start();
require_once './lib/db.php';
require_once "./lib/common.php";

if(!isset($_SESSION['auth']) || !$_SESSION['auth'] && isset($_POST['comment'])){
    echo "<script>
    alert('Vui lòng đăng nhập trước khi bình luận!')
    </script>";
    header('location: login.php');die;
}else{
    $id_hh = $_GET['ma_hh'];

    $tenloai = $_GET['tenloai'];

    $noi_dung = $_POST['noi_dung'];

    $ngay_bl = date_format(date_create(),'Y-m-d');

    $ma_kh = $_SESSION['auth']['ma_kh'];

    $insertQuery = "insert into comment 
                                (noi_dung,id_hh, 
                                    ma_kh, ngay_bl)
                           values 
                                ('$noi_dung','$id_hh',
                                    '$ma_kh', '$ngay_bl')";
    // 5. Thực thi câu query với csdl
$connect = getDbConnect();
$stmt = $connect->prepare($insertQuery); // nạp câu sql query vào trong kết nối
$stmt->execute(); // thực thi lệnh với csdl

// 6. Điều hướng về trang danh sách
header("location: http://localhost/php1/project_sample/chi-tiet.php?ma_hh=$id_hh&tenloai=$tenloai");
}
?>