<aside class="sidebar">
    <?php
    if(isset($_POST['submit'])){
        $folder = INSTALL_PATH."vul/sqli/upload/index.php";
        if(move_uploaded_file($_FILES['file']['tmp_name'], $folder)){
            $tb = 'Upload thành công!';
        } else $tb = 'Upload thất bại!';
    }
    ?>
    <div class="container" style="margin-top: 20px; margin-left: 15%">
        <a  id="btn-as-link" href="?page=sqli_phongchong_php&dowload=1">Dowload File Mã Nguồn</a>
    </div>
    <div class="r-form">
        <h5>Upload File PHP Đã Sửa</h5>
        <form method="post" action="" enctype="multipart/form-data">
            <input type="file" name="file" />
            <input type="submit" class="submit-btn" name="submit" value="Upload"/>
        </form>
    </div>

    <?php if(isset($tb)) echo '<span style="color: red">'.$tb.'</span>'; ?>
    <div class="r-form">
        <h5>Test kết quả</h5>
        <form method="post" action="">
            <input type="text" name="url" value="http://localhost/final/vul/sqli/upload/index.php" />
            <input type="submit" name="test_result" value="Test Kết Quả"/>
        </form>
    </div>
    <div class="r-form">
        <h5>Kết quả:</h5>
        <div class="r-content">
            <p>File nằm tại vul/sqli/upload/index.php, cần nhập đường link chính xác</p>
            <?php
            if(isset($_POST['test_result'])){
                $command  = 'python '.INSTALL_PATH.'vul/sqli/prevent/sqli.py';
                $payload = INSTALL_PATH.'vul/sqli/prevent/payload.txt';
                system($command.' '.$_POST['url'].' '.$payload);
            }
            ?>
        </div>
    </div>

</aside>