<?php
require_once 'core/config/init.php';
if(isset($_POST['submit'])){
    $db_name = $_POST['db-name'];
    $db_user = $_POST['db-user'];
    $db_pass = $_POST['db-pass'];
    $root = $_POST['root-me-user'];
    # Save config
    re_config('user_root_me', $root);
    re_config('db_name',$db_name);
    re_config('db_user',$db_user);
    re_config('db_pass',$db_pass);
    re_config('install', '1');
    # Set database
    reset_csdl();

    # Go index.php
    header('Location: index.php');
}
?>
<!DOCTYPE html>
<html>
<body class="main-center" itemscope>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>INSTALL APP</title>
    <!-- Load CSS -->
    <link href="public/css/style.css"  rel="stylesheet" />
    <script src="public/jquery/jquery.min.js" type="text/javascript"></script>
    <style>
        body {background-image: url("public/images/hacker.jpg"); background-size: cover}
        .install-form {position: fixed; height: 600px; width: 40%; top:10%; left: 10%; background-color: rgba(255,255,255,0.5); padding: 20px}
        .install-form label {width: 250px; margin-left: 30px}
        .hi {color: #1a2433; text-align: center; font-weight: bold; color: darkred}
    </style>
</head>
<body>
    <div class="install-form">
        <h3 class="hi">ỨNG DỤNG ĐÀO TẠO LỖ HỔNG TRÊN ỨNG DỤNG WEB PTITHCM</h3>
        <div class="r-form">
            <h5>Thông tin</h5>
            <div class="r-content">
                <p><strong>Đề tài: </strong> Xây dựng ứng dụng phục vụ tìm hiểu và thực hành lỗ hổng website</p>
                <p><strong>Người thực hiện: </strong>Đoàn Ngọc Vương</p>
                <p><strong>GVHD: </strong>TS. Huỳnh Trọng Thưa</p>
            </div>
        </div>
        <div class="r-form">
            <h5>Cài Đặt Ứng Dụng</h5>
            <form method="post">
                <div><label>Tên Của CSDL: </label><input type="text" name="db-name" value="ptithcm_train" /></div>
                <div><label>Tên Người Dùng: </label><input type="text" name="db-user" value="root" /></div>
                <div><label>Mật Khẩu: </label><input type="text" name="db-pass" value="" /></div>
                <div><label>Tên Người Dùng Root-me: </label><input type="text" name="root-me-user" value="N14DCAT138" /></div>
                <input type="submit" value="Cài Đặt" name="submit" class="submit-btn" style="margin-left: 35%" />
            </form>
        </div>
    </div>
</body>
</html>