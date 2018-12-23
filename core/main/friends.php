<?php
$conn = connect_database();
if(isset($_POST['submit-2'])){
    $friend_root = $_POST['root-name'];
    $friend_name = $_POST['real-name'];
    $dbo = $conn->prepare("INSERT INTO friends_root(root_name,real_name,score) VALUES(?,?,0)");
    $dbo->bind_param('ss',$friend_root,$friend_name);
    $dbo->execute();
}
if(isset($_POST['submit-1'])){
    $fp = fopen($_FILES['file-friend']['tmp_name'], 'rb');
    while ( ($line = fgets($fp)) !== false) {
        $info = explode('-', $line);
        $dbo = $conn->prepare("INSERT INTO friends_root(root_name,real_name,score) VALUES(?,?,0)");
        $dbo->bind_param('ss', $info[0], $info[1]);
        $dbo->execute();
    }
}
$result = $conn->query("SELECT * FROM friends_root");
while($row=$result->fetch_assoc()){
    $score = get_score_by_name($row['root_name']);
    $id = $row['id'];
    $conn->query("UPDATE friends_root SET score=$score WHERE id=$id");
}
?>
<main class="main" role="main">
    <table id="info-table">
        <tr>
            <th>Rank</th>
            <th>Tên Tài Khoản</th>
            <th>Điểm</th>
            <th>Tên Người Dùng</th>
        </tr>
        <?php
        $rank = 1;
        $rs = $conn->query("SELECT * FROM friends_root ORDER BY score DESC");
        while($row = $rs->fetch_assoc()){ ?>
        <tr>
            <td><?php echo $rank; $rank +=1; ?></td>
            <td><?php echo $row['root_name']; ?></td>
            <td><?php echo $row['score']; ?></td>
            <td><?php echo $row['real_name']; ?></td>
        </tr>
            <?php
        }
        ?>
    </table>
</main>
<aside class="sidebar">
    <div class="r-form">
        <h5>THÊM BẠN BÈ BẰNG FILE:</h5>
        <div class="r-content">
            <form action="" method="post" enctype="multipart/form-data">
                <p>Mỗi thông tin về một bạn học nằm trên 1 dòng, file plain text dạng .txt, định dạng như sau: </p>
                <p>UsernameRootMe-NameOfUser </p><p>(Ví dụ: N14DCAT138-Đoàn Ngọc Vương)</p>
                <input type="file" name="file-friend" />
                <input type="submit" name="submit-1" class="submit-btn" value="Tải Tệp Tin"/></form></div>
    </div>
    <div class="r-form">
        <h5>Thêm Bạn Bè:</h5>
        <form action="" method="post">
            <input type="text" name="root-name" placeholder="Username Root-me" />
            <input type="text" name="real-name" placeholder="Tên Của Bạn" />
            <input type="submit" name="submit-2" class="submit-btn" value="Thêm Bạn Bè" />
        </form>
    </div>
</aside>