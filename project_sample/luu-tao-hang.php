<?php
session_start();
require_once './lib/db.php';
require_once "./lib/common.php";
checkAuths();
// xử lý dữ liệu để tạo ra tk trong csdl
$ma_hh = $_GET['ma_hh'];
$ma_kh = $_GET['ma_kh'];
$tenloai = $_GET['tenloai'];
$gia = $_GET['gia'];
$image = $_GET['image'];
// 1. Nhận dữ liệu từ request
$ten_hh = $_POST['ten_hh'];

$dia_chi = $_POST['dia_chi'];
$dia_chiErr = "";

$so_luong = $_POST['so_luong'];
$so_luongErr = "";

$yeu_cau = $_POST['yeu_cau'];

// 2. Kiểm tra dữ liệu (validate)
// ktra rỗng
if($so_luong == ""){
    $so_luongErr = "Hãy nhập so_luong";
}
if($dia_chi == ""){
    $dia_chiErr = "Hãy nhập mã khách hàng";
}
if($dia_chiErr.$so_luongErr != ""){
    header('location: ' . BASE_URL . "gio-hang.php?dia_chierr=$dia_chiErr&so_luongerr=$so_luongErr");
    die;
}
// 4. Tạo câu query để insert data
$insertQuery = "insert into orders_products 
                    (ten_hh, ma_kh ,dia_chi, so_luong, yeu_cau, image, gia)
                values 
                    ('$ten_hh', '$ma_kh', '$dia_chi', '$so_luong', '$yeu_cau','$image','$gia')";
                    // 5. Thực thi câu query với csdl

$connect = getDbConnect();
$stmt = $connect->prepare($insertQuery); // nạp câu sql query vào trong kết nối
$stmt->execute(); // thực thi lệnh với csdl

// 6. Điều hướng về trang danh sách
header("location: http://localhost/php1/project_sample/thong-bao-dat-hang.php");


?>