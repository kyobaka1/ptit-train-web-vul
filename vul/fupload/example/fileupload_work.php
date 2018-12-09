<aside class="sidebar">
    <div class="r-form">
        <h5>Chọn File Để Upload:</h5>
        <form class="login" method="post" enctype="multipart/form-data">
            <input type="file" name="fileToUpload" id="fileToUpload">
            <input type="submit" value="Upload" name="submit" class="submit-btn">
        </form>
    </div>
    <div class="r-form">
        <h5>Thông Tin File Đã Upload:</h5>
        <div class="r-content">
            <?php
            if(isset($_FILES['fileToUpload'])){
                echo '<p><b>Tên file:</b> '.$_FILES['fileToUpload']['name'].'</p>';
                echo '<p><b>Dung lượng:</b> '.$_FILES['fileToUpload']['size'].'</p>';
                echo '<p><b>MIME type:</b> '.$_FILES['fileToUpload']['type'].'</p>';
            }
            ?>
        </div>
    </div>

</aside>
