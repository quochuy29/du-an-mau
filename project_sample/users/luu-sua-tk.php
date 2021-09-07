<?php
session_start();
require_once '../lib/db.php';
require_once "../lib/common.php";
checkAuth();
// lấy id trên đường dẫn xuống
$userId = isset($_GET['ma_kh']) ? $_GET['ma_kh'] : -1;
// kiểm tra xem id có tồn tại trong db hay không 
$connect = getDbConnect();
$getUserByIdQuery = "select * from users where ma_kh = '$userId' ";
$stmt = $connect->prepare($getUserByIdQuery);
$stmt->execute();
$user = $stmt->fetch(); 

if(!$user){
    header("location: " . BASE_URL_1 . "?msg=user không tồn tại");
    die;
}
$name = trim($_POST['name']);
$nameErr = "";

$ma_kh = $_POST['ma_kh'];
$makhErr = "";

$email = $_POST['email'];
$emailErr = "";

$vai_tro = 1;
$avatar = $_FILES['avatar'];
$kich_hoat = 1;

// 2. Kiểm tra dữ liệu (validate)
// ktra rỗng
$patter = '/[!@#$%^&*(),.<>?:;"{}|]/';
$patt = "/['']/";
$pat = '/[[]/';
$pa = '/[]]/';
$patte = '/[^a-zA-ZÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ]/u';
if(strlen($name) == 0){
    $nameErr = "Hãy nhập họ và tên";
}elseif(!preg_match($patte,$name) || preg_match($patter,$name) || preg_match($patt,$name) || preg_match($pat,$name) || preg_match($pa,$name)){
    $nameErr = "Yêu cầu họ tên không có kí tự đặc biệt hoặc số";
}
// ktra số lượng ký tự
if($nameErr === "" && (strlen($name) < 4 || strlen($name) > 30)){
    $nameErr = "Độ dài họ và tên nằm trong khoảng 4 - 30 ký tự";
}
if($email == ""){
    $emailErr = "Hãy nhập email";
}elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    $emailErr = "Yêu cầu nhập đúng dạng email";
}
$ma_Kh = $_SESSION['auth']['ma_kh'];
if($ma_kh == ""){
    $ma_khErr = "Hãy nhập mã khách hàng";
}elseif($ma_kh == $ma_Kh){
    $ma_khErr = "Mã này đã có người sử dụng";
}
if($ma_khErr === "" && (strlen($ma_kh) < 4 || strlen($ma_kh) > 30)){
    $ma_khErr = "Độ dài mã khách hàng nằm trong khoảng 4 - 30 ký tự";
}
$path = $user['avatar'];
// 3.1 thực hiện lưu ảnh
if($avatar['size']<1500000 && $avatar['size']>0){
    $filename = uniqid() . "-" . $avatar["name"];
    move_uploaded_file($avatar["tmp_name"], '../publics/uploads/' . $filename);
    $path = 'publics/uploads/' . $filename;
    $expensions= array("jpeg","jpg","png");
    $file_ext = strtolower(end(explode('.',$_FILES['avatar']['name'])));
    if(in_array($file_ext,$expensions)=== false){
    $avatarErr = "Chỉ hỗ trợ upload file JPEG hoặc PNG.";
    }
}elseif($avatar['size'] == 0){
    $avatarErr = "Chưa chọn ảnh đại diện";
}else{
    $avatarErr = "Hình ảnh phải nhỏ hơn 1.5mb";
}
if($ma_khErr.$nameErr.$emailErr.$avatarErr != ""){
    header('location: ' . BASE_URL . "users/sua.php?ma_kherr=$ma_khErr&nameerr=$nameErr&emailerr=$emailErr&avatarerr=$avatarErr");
    die;
}

// 4. Tạo câu query để insert data
$updateUserSql = "update users 
                    set 
                        ma_kh = '$ma_kh',
                        name = '$name',
                        kich_hoat = '$kich_hoat',
                        email = '$email',
                        avatar = '$path',
                        vai_tro = '$vai_tro'
                  where ma_kh = '$userId' ";

$stmt = $connect->prepare($updateUserSql);
$stmt->execute();
header("location: " . BASE_URL_6 . "?msg=Cập nhật tài khoản thành công");

?>