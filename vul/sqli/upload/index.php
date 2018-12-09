<?php
require_once '../../../core/config/config.php'; // Ko được sửa
require_once '../../../core/include/db_functions.php'; // Ko được sửa
$conn = connect_database(); // Ko được sửa
if(isset($_POST['submit'])){ // Ko được sửa
    $username = $_POST['username']; // Ko được sửa
    $password = $_POST['password']; // Ko được sửa

    $sql_query = "SELECT * FROM sqli_users WHERE uname='$username' AND pass='$password'";
    $result = $conn->query($sql_query);
    if($result->num_rows > 0){
        $thongbao = 'Success!'; // Ko được sửa thông báo, có thể sửa hàm so sánh để in ra thông báo.
    }
    else{
        $thongbao = 'Fail!'; // Ko được sửa thông báo, ,có thể sửa hàm so sánh để in ra thông báo.
    }
    echo $thongbao;
}
$conn->close();
/*
 * Yêu cầu: Vẫn phải lấy dữ liệu từ bảng sqli_users, user Bob/bob123 phải đăng nhập được.
 * Không nên ăn gian, làm vậy cũng ko học được kiến thức gì cả.
 */
?>