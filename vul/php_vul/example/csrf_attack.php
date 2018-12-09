<?php
session_start();
$conn = connect_database();
$rs = $conn->query("SELECT * FROM csrf_account WHERE username='bob' AND password='bob123' LIMIT 1");
$row = $rs->fetch_assoc();
$taikhoan = $row['taikhoan'];
$_SESSION['name'] = $row['username'];

if(isset($_GET['submit'])){
    $dbo = connect_database();
    $content = $_GET['content'];
    $dbo = $conn->prepare("INSERT INTO csrf_message(message) VALUES(?)");
    $dbo->bind_param('s',$content);
    if($dbo->execute()){$thongbao = "Gửi tin nhắn thành công!";} else $thongbao="Gửi tin nhắn thất bại!";
}
if(isset($_GET['clear'])){
    $query = $conn->query("DELETE FROM csrf_message");
    $query = $conn->query("UPDATE csrf_account SET taikhoan=10000");
    header("Location: index.php?page=csrf_attack");
}
if(isset($_GET['donate']) && ($_GET['donate']) == 1){
    $taikhoan -= 100;
    $query = $conn->query("UPDATE csrf_account SET taikhoan=$taikhoan");
    $thongbao = 'Đã donate và mất 100$';
}
?>
<aside class="sidebar">
    <div class="r-form">
        <h5>Thông Tin Tài Khoản</h5>
        <div class="r-content">
            <p>Người dùng: <?php echo $_SESSION['name'];?></p>
            <p>Số dư:  <?php echo $taikhoan;?></p>
        </div>
    </div>
    <div class="r-form">
        <h5>Gửi Tin Nhắn</h5>
        <form class="login" action="" method="get">
            <input type="hidden" name="page" value="csrf_attack" />
            <input type="text" name="content" class="login-input" placeholder="Nội Dung Tin Nhắn">
            <input type="submit" value="Gửi" name="submit" class="submit-btn">
        </form>
    </div>
    <div style="margin-top: 30px">
        <a href="?page=csrf_attack&clear=1" id="btn-as-link">Xoá Dữ Liệu</a>
        <a href="?page=csrf_attack&donate=1" id="btn-as-link">Quyên Góp 100$</a>
        <h3 style="color: red"><?php if(isset($thongbao)) echo $thongbao; ?></h3>
    </div>
    <div class="r-form">
        <h5>Danh sách tin nhắn</h5>
        <table style="text-align: center">
            <tr><th>Nội Dung Tin Nhắn</th></tr>
            <?php
            $query = $conn->query("SELECT * FROM csrf_message");
            while($row = $query->fetch_assoc()){
                echo '<tr><td>'.$row['message'].'</td></tr>';
            } ?>
        </table>
    </div>
</aside>
