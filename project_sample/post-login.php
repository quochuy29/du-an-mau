<?php
session_start();
require_once './lib/common.php';
require_once './lib/db.php';

$ma_kh = isset($_POST['ma_kh']) ? $_POST['ma_kh'] : "";
$ma_khErr = "";
$password = isset($_POST['password']) ? $_POST['password'] : "";
$passwordErr = "";
$vai_tro = isset($_POST['vai_tro']) ? $_POST['vai_tro'] : "";
$kich_hoat = isset($_POST['kich_hoat']) ? $_POST['kich_hoat'] : "";
// validate
// lấy user dựa vào email
$getUserByMakhQuery = "select * from users where ma_kh = '$ma_kh'";
$connect = getDbConnect();
$stmt = $connect->prepare($getUserByMakhQuery);
$stmt->execute();
$user = $stmt->fetch();
$ma_Kh = $user['ma_kh'];
// kiểm tra xem có user hay không
// nếu có thì so sánh mk nhập vào với mk trong db xem có khớp không
if($user && password_verify($password, $user['password'])){
    $_SESSION['auth'] = [
        'ma_kh' => $user['ma_kh'],
        'name' => $user['name'],
        'email' => $user['email'],
        'vai_tro' => $user['vai_tro']
    ];
    if($user['vai_tro'] < 1){
        if($user['kich_hoat'] < 1){
            header("location: " . BASE_URL . "login.php" . "?msg=chưa kích hoạt tài khoản");
            die;
        }else {
            header('location: ' . BASE_URL_6 . "?msg=đăng nhập thành công");
            die;
        }
    }else {
        header('location: ' . BASE_URL_1 . "?msg=đăng nhập thành công");
        die;
    }
}else{
    if($ma_kh != $ma_Kh){
        $ma_khErr = "Mã khách hàng không tồn tại ! ";
    }elseif($ma_kh == ""){
        $ma_khErr = "Nhập mã khách hàng ! ";
    }
    $passwordErr = "Mật khẩu không chính xác !";
    header("location: " . BASE_URL_3 . "login.php?passworderr=$passwordErr&ma_kherr=$ma_khErr");
    die;
}

?>