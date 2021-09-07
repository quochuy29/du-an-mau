<?php
session_start();
require_once "./lib/db.php";
require_once "./lib/common.php";
$s = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyz", 6)), 0, 6);
use PHPMailer\PHPMailer\PHPMailer;
if(isset($_POST['submit'])){
    if(isset($_POST['email'])) {
        $email = $_POST['email'];

        require_once "PHPMailer/PHPMailer.php";
        require_once "PHPMailer/SMTP.php";
        require_once "PHPMailer/Exception.php";

        $mail = new PHPMailer();

        //SMTP Settings
        $mail->isSMTP();
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPAuth = true;
        $mail->Username = "phanquochuyqthm@gmail.com"; //enter you email address
        $mail->Password = 'Quochuy2001'; //enter you email password
        $mail->Port = 465;
        $mail->SMTPSecure = "ssl";

        //Email Settings
        $mail->isHTML(true);
        $mail->setFrom($email);
        $mail->addAddress("phanquochuyqthm@gmail.com"); //enter you email address
        $mail->Body = "Quên mật khẩu email : $email,http://localhost/php1/project_sample/fogot.php?email=$email&password=$s";

if ($mail->send()) {
$status = "success";
$response = "Email is sent!";
} else {
$status = "failed";
$response = "Something is wrong: <br><br>" . $mail->ErrorInfo;
}
header('location: http://localhost/php1/project_sample/quen-mk.php?msg=Gửi mail thành công');
}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quên mật khẩu</title>
    <?php include_once "./_share/style.php" ?>
    <style>
    .container-fluid {
        /* The image used */
        background-image: url("img_project/galaxy.jpg");
        min-height: 600px;
        /* Center and scale the image nicely */
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        position: relative;
    }

    label {
        color: #02AFFA;
    }
    </style>
</head>

<body>
    <main class="container-fluid">
        <!-- Hiển thị danh sách users -->
        <div class="container"
            style="position:relative;top:50px;background-color:#ffffff;height:300px;width:400px;opacity:0.7">
            <h1 style="text-align:center;color:#02AFFA;padding-top:20px;font-weight:bold;">Quên mật khẩu</h1>
            <div class="row">
                <h4 class="sent-notification"></h4>
                <div class="col-6 offset-3">
                    <form id="myForm" enctype="multipart/form-data" method="post">
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="text" class="form-control" id="email" name="email">
                        </div>
                        <div class="text-center">
                            <button type="submit" name="submit" class="btn btn-sm btn-info">Gửi</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

</body>

</html>