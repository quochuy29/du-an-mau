<?php
require_once '../lib/db.php';
require_once "../lib/common.php";
// xử lý dữ liệu để tạo ra loại hàng trong csdl

// 1. Nhận dữ liệu từ request
$ten_loai = $_POST['ten_loai'];
$ten_loaiErr = "";

if($ten_loai == "" ){
    $ten_loaiErr = "Hãy nhập tên loại";
}
if($ten_loaiErr === "" && (strlen($ten_loai) < 3 || strlen($ten_loai) > 50)){
    $ten_loaiErr = "Độ dài họ và tên nằm trong khoảng 3 - 50 ký tự";
}
if($ten_loaiErr!= ""){
    header('location: ' . BASE_URL . "sectors/tao-loai-moi.php?ten$ten_loaierr=$ten_loaiErr");
    die;
}
// 4. Tạo câu query để insert data
$insertQuery = "insert into sectors
                    (ten_loai)
                values 
                    ('$ten_loai')";
                    // 5. Thực thi câu query với csdl
$connect = getDbConnect();
$stmt = $connect->prepare($insertQuery); // nạp câu sql query vào trong kết nối
$stmt->execute(); // thực thi lệnh với csdl
// 6. Điều hướng về trang danh sách
header("location: " . BASE_URL_4 . "?msg=Tạo mới loại hàng thành công");


?>