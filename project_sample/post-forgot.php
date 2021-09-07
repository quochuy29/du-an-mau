<?php
session_start();
require_once "./lib/db.php";
require_once "./lib/common.php";
checkAuths();
$password = $_POST['password'];
$passwordErr = "";
// validate
$email = isset($_POST['email']) ? $_POST['email'] : "";
// ktra mk cũ có khớp với mk trong db hay không
$getUserById = "select * from users where email = $email";

$connect = getDbConnect();
$stmt = $connect->prepare($getUserById);
$stmt->execute();
$user = $stmt->fetch();
$removeWhiteSpacePassword = str_replace(" ", "", $password);
if(strlen($password) < 6 || (strlen($removeWhiteSpacePassword) != strlen($password))){
    $passwordErr = "Mật khẩu không thỏa mãn ";
}
// mã hóa mk mới
$passwordHash = password_hash($password, PASSWORD_DEFAULT);
// cập nhật tài khoản với mk = mk mới đã đc mã hóa
$updateUserPasswordQuery = "update users
                            set 
                                password = '$passwordHash'
                            where email = $email";
$stmt = $connect->prepare($updateUserPasswordQuery);
$stmt->execute();
// điều hướng website sang trang chủ
header('location: ' . BASE_URL_6 );

?>