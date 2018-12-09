<aside class="sidebar">
    <div class="r-form">
        <form class="login" action="" method="get">
            <h5>Thông Tin Khách Hàng</h5>
            <input type="hidden" name="page" value="xss_tongquan" />
            <input type="text" name="name" class="login-input" placeholder="Nhập Tên Của Bạn">
            <input type="submit" value="Xác Nhận" class="submit-btn">
        </form>
    </div>
    <div class="r-form">
        <h5>Kết quả</h5>
            <?php
            if(isset($_GET['name'])){
                echo "<p style='margin-left: 10px'>Xin chào ".$_GET['name']."</p>";
            }
            ?>
        </p>
    </div>
</aside>