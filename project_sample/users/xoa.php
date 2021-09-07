<?php
session_start();
require_once '../lib/db.php';
require_once "../lib/common.php";
checkAuth();
//lấy id trên đường dẫn xuống
$userId = isset($_GET['ma_kh']) ? $_GET['ma_kh'] : -1;
$userIdErr = "";
if(is_numeric($userId) == true){
    $userIdErr = "Mã khách hàng hông phải kiểu số";
    header("location: " . BASE_URL_1 . "?msg=$userIdErr");
    die;
}
//kiểm tra xem id có tồn tại trong đó hay không
$connect = getDbConnect();
$getUserByIdQuery = "delete from users where ma_kh = '$userId' ";
$stmt = $connect->prepare($getUserByIdQuery);
$stmt->execute();
$users = $stmt->fetch();
if(!$users){
    header("location: ".BASE_URL_1."?msg=User không tồn tại");
    die;
}else{
    header("location: ".BASE_URL_1."?msg=Xóa tài khoản thành công");
}

?>