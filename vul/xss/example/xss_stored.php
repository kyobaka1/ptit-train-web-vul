<?php
    $conn = connect_database();
    if(isset($_GET['submit'])){
        $dbo = connect_database();
        $title = $_GET['title'];
        $author = $_GET['author'];
        $query_check = $dbo->prepare("INSERT INTO xss_stored(title,author) VALUES (?,?)");
        $query_check->bind_param("ss",$title,$author);
        if($query_check->execute()){
            $thongbao = "Đăng bài thành công!";
        }
        else{
            $thongbao = "Đăng bài thất bại!";
        }
    }
    if(isset($_GET['clear'])){
        $query = $conn->query("DELETE FROM xss_stored");
    }

?>
<aside class="sidebar" xmlns="http://www.w3.org/1999/html">
    <div class="r-form">
        <h5>Đăng Bài Viết</h5>
        <form class="login" action="" method="get">
            <input type="hidden" name="page" value="xss_stored" />
            <input type="text" name="title" class="login-input" placeholder="Tên Bài Viết">
            <input type="text" name="author" class="login-input" placeholder="Người Viết">
            <input type="submit" value="Đăng Bài" name="submit" class="submit-btn">
        </form>
        <span style="color: red; margin-left: 10px"><?php if(isset($thongbao)) echo $thongbao; ?></span>
    </div>
    <div class="r-form">
        <h5>Xoá Toàn Bộ Bài Viết</h5>
        <form action="" method="get">
            <input type="hidden" name="page" value="xss_stored" />
            <input type="submit" value="Xoá Toàn Bộ Bài Viết" name="clear" class="submit-btn">
        </form>
    </div>
    <div class="r-form">
        <h5>Danh sách bài viết</h5>
        <table>
            <tr>
                <th>Tên Bài Viết:</th>
                <th>Người Viết</th>
            </tr>
        <?php
        $query = $conn->query("SELECT * FROM xss_stored");
        while($row = $query->fetch_assoc()){
        ?>
            <tr>
                <td><?php echo $row['title'] ?></td>
                <td><?php echo $row['author'] ?></td>
            </tr>
        <?php } ?>
        </table>
    </div>
</aside>
