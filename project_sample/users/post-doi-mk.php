<?php
session_start();
require_once "../lib/db.php";
require_once "../lib/common.php";

checkAuth();
$old_password = $_POST['old_password'];
$password = $_POST['password'];
$passwordErr = "";
$cfpassword = $_POST['cfpassword'];
$cfpasswordErr = "";
// validate
$removeWhiteSpacePassword = str_replace(" ", "", $password);
if(strlen($password) < 6 || (strlen($removeWhiteSpacePassword) != strlen($password))){
    $passwordErr = "Mật khẩu không thỏa mãn ";
}

// giống với xác nhận mk
if($password != $cfpassword){
    $cfpasswordErr = "Mật khẩu và xác nhận mật khẩu không khớp";
}

if($passwordErr.$cfpasswordErr != ""){
    header('location: ' . BASE_URL . "users/doi-mk.php?ma_kherr=$ma_khErr&passworderr=$passwordErr&cfpassworderr=$cfpasswordErr");
    die;
}
$ma_kh = $_SESSION['auth']['ma_kh'];
// ktra mk cũ có khớp với mk trong db hay không
$getUserById = "select * from users where ma_kh = '$ma_kh'";

$connect = getDbConnect();
$stmt = $connect->prepare($getUserById);
$stmt->execute();
$user = $stmt->fetch();

if(!password_verify($old_password, $user['password'])){
    header('location: ' . BASE_URL . 'users/doi-mk.php?msg=Mật khẩu cũ không đúng');
    die;
}
// mã hóa mk mới
$passwordHash = password_hash($password, PASSWORD_DEFAULT);
// cập nhật tài khoản với mk = mk mới đã đc mã hóa
$updateUserPasswordQuery = "update users
                            set 
                                password = '$passwordHash'
                            where ma_kh = '$ma_kh'";
$stmt = $connect->prepare($updateUserPasswordQuery);
$stmt->execute();
// điều hướng website sang trang chủ
header('location: ' . BASE_URL_6 );





?>