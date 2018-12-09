<script type='text/javascript'>
    (function($) {
        $(document).ready(function(){
            $('ul.tab-links li').click(function(){
                var tab_id = $(this).attr('data-tab');

                $('ul.tab-links li').removeClass('active');
                $('.settings-x').removeClass('active');


                $(this).addClass('active');
                $('#'+tab_id).addClass('active');
            })
        });
        $(document).ready(function(){
            $('ul.tab-links-info li').click(function(){
                var tab_id = $(this).attr('data-tab');

                $('ul.tab-links-info li').removeClass('active');
                $('.info-x').removeClass('active');

                $(this).addClass('active');
                $('#'+tab_id).addClass('active');
            })
        })
    })(jQuery);
</script>
<main class="main" role="main">
    <div class="content">
        <article id="post-fi/lfi" class="article article-type-post" itemscope="" itemtype="http://schema.org/BlogPosting">
            <div class="article-header">
                <h1 class="article-title" itemprop="name">
                    Thông Tin Cấu Hình - Tuỳ Chỉnh
                </h1>
            </div>
        </article>
        <div class="article-entry marked-body" itemprop="articleBody">
            <h2>Cấu Hình</h2>
            <div class="settings-container">
                <ul class="tab-links">
                    <li class="active" data-tab="tab1"><img src="public/images/database-plus.png" class="img-circle" style="width: 24px; height: 24px; margin-right: 5px" /><label> Cấu Hình CSDL</label></li>
                    <li data-tab="tab2" ><img src="public/images/account-convert.png" class="img-circle" style="width: 24px; height: 24px; margin-right: 5px" /><label>Cấu Hình Tài Khoản Root-Me</label></li>
                    <li data-tab="tab3" ><img src="public/images/star-circle.png" class="img-circle" style="width: 24px; height: 24px; margin-right: 5px" /><label> Reset CSDL</label></li>
                </ul>
                <div class="settings-x active" id="tab1">
                    <form method="get">
                        <input type="hidden" name="page" value="settings" />
                        <p class="title-settings">Tên Tài Khoản: </p><input type="text" name="db-user" value="<?php echo $GLOBALS['config']['db_user'] ?>" /></br>
                        <p class="title-settings">Mật Khẩu: </p><input type="text" name="db-password" value="<?php echo $GLOBALS['config']['db_pass'] ?>"/></br>
                        <p class="title-settings">Tên CSDL: </p><input type="text" name="db-name" value="<?php echo $GLOBALS['config']['db_name'] ?>" /></br>
                        <input style="width: 150px; padding: 10px;" type="submit" name="db-submit" value="Cập Nhật" class="btn-danger" />
                    </form>
                </div>
                <div class="settings-x" id="tab2">
                    <form method="get">
                        <input type="hidden" name="page" value="settings" />
                        <p class="title-settings">Tên Tài Khoản: </p><input type="text" name="name-root" value="<?php echo $GLOBALS['config']['user_root_me'] ?>" /></br>
                        <input style="width: 150px; padding: 10px;" type="submit" name="root-submit" value="Cập Nhật" class="btn-danger" />
                    </form>
                </div>
                <div class="settings-x" id="tab3">
                    <form method="get">
                        <input type="hidden" name="page" value="settings" />
                        <input style="width: 150px; padding: 10px;" type="submit" name="reset-csdl" value="Reset CSDL" class="btn-danger" />
                    </form>
                    <?php if(isset($_GET['reset-csdl'])){ reset_csdl();}  ?>
                </div>
            </div>
            <h2>Thông Tin</h2>
            <?php
            $query = "SELECT * FROM challenge_status";
            $conn = connect_database();
            $rs = $conn->query($query);
            ?>
        <div class="info-content" style="margin-top: 20px">
            <ul class="tab-links-info">
                <li class="active" data-tab="info1"><img src="public/images/information.png" class="img-circle" style="width: 24px; height: 24px" /><label>Tất cả</label></li>
                <li data-tab="info2"><img src="public/images/read.png" class="img-circle" style="width: 24px; height: 24px" /><label>LT - Đã Học</label></li>
                <li data-tab="info3" ><img src="public/images/unread.png" class="img-circle" style="width: 24px; height: 24px" /><label>LT - Chưa Học</label></li>
                <li data-tab="info4" ><img src="public/images/read.png" class="img-circle" style="width: 24px; height: 24px" /><label>TH - Làm Được</label></li>
                <li data-tab="info5" ><img src="public/images/unread.png" class="img-circle" style="width: 24px; height: 24px" /><label>TH - Chưa Được</label></li>
            </ul>
            <div class="info-x active" id="info1">
                <table class="table-light" id="info-table">
                    <thead><tr><th>Loại</th><th>Tên Bài</th><th>Trạng Thái</th></tr></thead>
                    <tbody>
                    <?php while($row = $rs->fetch_assoc()){ ?>
                        <tr>
                            <td><?php if($row['type_post'] == 0) echo 'Lý Thuyết'; else echo 'Thực Hành';  ?></td>
                            <td><?php echo $row['post_title'];  ?></td>
                            <td><?php if($row['status'] == 1) echo '<img src="public/images/check.png" style="height: 24px; width: 24px" />'; else echo '<img src="public/images/uncheck.png" style="height: 24px; width: 24px" />';  ?></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
            <div class="info-x " id="info2">
                <table class="table-light" id="info-table">
                    <thead><tr><th>Loại</th><th>Tên Bài</th><th>Trạng Thái</th></tr></thead>
                    <tbody>
                    <?php $rs = $conn->query($query); while($row = $rs->fetch_assoc()){ if($row['type_post'] == 0 && $row['status'] == 1){ ?>
                        <tr>
                            <td><?php if($row['type_post'] == 0) echo 'Lý Thuyết'; else echo 'Thực Hành';  ?></td>
                            <td><?php echo $row['post_title'];  ?></td>
                            <td><?php if($row['status'] == 1) echo '<img src="public/images/check.png" style="height: 24px; width: 24px" />'; else echo '<img src="public/images/uncheck.png" style="height: 24px; width: 24px" />';  ?></td>
                        </tr>
                    <?php }} ?>
                    </tbody>
                </table>
            </div>
            <div class="info-x " id="info3">
                <table class="table-light" id="info-table">
                    <thead><tr><th>Loại</th><th>Tên Bài</th><th>Trạng Thái</th></tr></thead>
                    <tbody>
                    <?php $rs = $conn->query($query); while($row = $rs->fetch_assoc()){ if($row['type_post'] == 0 && $row['status'] == 0){ ?>
                        <tr>
                            <td><?php if($row['type_post'] == 0) echo 'Lý Thuyết'; else echo 'Thực Hành';  ?></td>
                            <td><?php echo $row['post_title'];  ?></td>
                            <td><?php if($row['status'] == 1) echo '<img src="public/images/check.png" style="height: 24px; width: 24px" />'; else echo '<img src="public/images/uncheck.png" style="height: 24px; width: 24px" />';  ?></td>
                        </tr>
                    <?php }} ?>
                    </tbody>
                </table>
            </div>
            <div class="info-x " id="info4">
                <table class="table-light" id="info-table">
                    <thead><tr><th>Loại</th><th>Tên Bài</th><th>Trạng Thái</th></tr></thead>
                    <tbody>
                    <?php $rs = $conn->query($query); while($row = $rs->fetch_assoc()){ if($row['type_post'] == 1 && $row['status'] == 1){ ?>
                        <tr>
                            <td><?php if($row['type_post'] == 0) echo 'Lý Thuyết'; else echo 'Thực Hành';  ?></td>
                            <td><?php echo $row['post_title'];  ?></td>
                            <td><?php if($row['status'] == 1) echo '<img src="public/images/check.png" style="height: 24px; width: 24px" />'; else echo '<img src="public/images/uncheck.png" style="height: 24px; width: 24px" />';  ?></td>
                        </tr>
                    <?php }} ?>
                    </tbody>
                </table>
            </div>
            <div class="info-x" id="info5">
                <table class="table-light" id="info-table">
                    <thead><tr><th>Loại</th><th>Tên Bài</th><th>Trạng Thái</th></tr></thead>
                    <tbody>
                    <?php $rs = $conn->query($query); while($row = $rs->fetch_assoc()){ if($row['type_post'] == 1 && $row['status'] == 0){ ?>
                        <tr>
                            <td><?php if($row['type_post'] == 0) echo 'Lý Thuyết'; else echo 'Thực Hành';  ?></td>
                            <td><?php echo $row['post_title'];  ?></td>
                            <td><?php if($row['status'] == 1) echo '<img src="public/images/check.png" style="height: 24px; width: 24px" />'; else echo '<img src="public/images/uncheck.png" style="height: 24px; width: 24px" />';  ?></td>
                        </tr>
                    <?php }} ?>
                    </tbody>
                </table>
            </div>
        </div>
        </div>
    </div></div>
</main>