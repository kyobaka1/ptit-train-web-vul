<main class="main" role="main">
    <div class="content">
        <article id="post-sql1" class="article article-type-post" itemscope="" itemtype="http://schema.org/BlogPosting">
            <div class="article-header">
                <h1 class="article-title" itemprop="name">
                    [SQLi] Cách phòng chống SQL Injection
                </h1>
                <div class="article-meta"><a href="?page=<?php echo $parent; ?>"><span>Back To Home</span></a>
                    <?php if($src_youtube != ''){echo '<button id="introduce-btn"><img src="public/images/play-circle.png" class="img-circle img-rotate" style="height: 24px; width: 24px; margin-right: 5px" " />Hướng Dẫn</button>';} ?>
                </div>
            </div>
            <?php echo get_iframe_youtube($src_youtube); ?>
            <div class="article-entry marked-body" itemprop="articleBody">
                <p>Phòng chống SQL Injection không khó. Nhưng điều quan trọng là phải toàn diện, bởi vì từ những sai sót nhỏ có thể dẫn đến hậu quả rất lớn.</p>
                <h1 id="Loc-du-lieu-tu-nguoi-dung"><a href="#Loc-du-lieu-tu-nguoi-dung" class="headerlink" title="Lọc dữ liệu từ người dùng"></a>Lọc dữ liệu từ người dùng</h1>
                <p><strong>Hacker</strong> cũng là người dùng website của chúng ta,thay vì tin tưởng họ <strong>hiền lành</strong> và <strong>đơn thuần</strong>. Thì ta nên ý thức được,website của chúng ta phục vụ cho <strong>hacker</strong>.<br>Điều đó sẽ khiến bạn luôn luôn trong sự cảnh giác cao nhất.<br>Hãy lọc dữ liệu từ người dùng với những cách như là:</p>
                <ul>
                    <li>Lọc các kí tự thoát truy vấn như nháy đơn, dấu hai chấm,dấu phẩy để họ không thể hoàn thành câu truy vấn.</li>
                    <li>Lọc theo các từ khoá như UNION, SELECT, ORDER BY.</li>
                    <li>Nếu là dữ liệu kiểu số,trước khi đưa vào câu lệnh SQL thì kiểm tra nó có phải kiểu số thật không?</li>
                    <li>Nếu là dữ liệu kiểu chuỗi, ta nên giới hạn độ dài cho chúng…</li>
                </ul>
                <p>Công việc này khá là phức tạp và dễ thiếu sót. Nhưng khi sử dụng các framework thì nhà phát triển đã làm hộ chúng ta,chỉ cần biết và sử dụng một cách hợp lý.</p>
                <h1 id="Khong-hien-thi-Exception-Error"><a href="#Khong-hien-thi-Exception-Error" class="headerlink" title="Không hiển thị Exception, Error"></a>Không hiển thị Exception, Error</h1>
                <p><strong>Hacker</strong> có thể sử dụng những thông báo lỗi để tìm kiếm thông tin về CSDL của chúng ta như:</p>
                <ul>
                    <li>Hệ quản trị CSDL. (Mỗi loại DB thường có cách thông báo lỗi khác nhau)</li>
                    <li>Biết được cấu trúc của câu lệnh SQL, để hoàn thành chúng theo ý muốn.</li>
                    <li>Đôi khi còn lấy được luôn thông tin từ CSDL (Như cast(‘string’ as int))</li>
                </ul>
                <h1 id="Phan-quyen-ro-rang-trong-CSDL"><a href="#Phan-quyen-ro-rang-trong-CSDL" class="headerlink" title="Phân quyền rõ ràng trong CSDL"></a>Phân quyền rõ ràng trong CSDL</h1>
                <p>Đây là công việc thiết yếu, tạo các user với các quyền khác nhau. Nếu kẻ tấn công có thể chiếm được một tài khoản cũng không thể nào đọc được các bảng khác nằm ngoài quyền của nó,giúp giảm thiểu thiết hại khi bị <strong>hacker</strong> xâm nhập thành công.</p>
                <h1 id="Viet-lai-duong-dan"><a href="#Viet-lai-duong-dan" class="headerlink" title="Viết lại đường dẫn"></a>Viết lại đường dẫn</h1>
                <p>Một cách khá hay để tăng độ bảo mật của website khỏi SQL Injection là viết lại đường dẫn.<br>Ví dụ:<br><a href="http://localhost/index.php?id=1" target="_blank" rel="noopener">http://localhost/index.php?id=1</a> =&gt; <a href="http://localhost/thongtin/1.html" target="_blank" rel="noopener">http://localhost/thongtin/1.html</a></p>
                <p>Khi đó,hacker sẽ không thể can thiệp vào các biến truyền vào và các công cụ tấn công cũng khó tiếp cận với website chúng ta.</p>
                <h1 id="Khong-de-du-lieu-duoi-dang-plain-text"><a href="#Khong-de-du-lieu-duoi-dang-plain-text" class="headerlink" title="Không để dữ liệu dưới dạng plain text"></a>Không để dữ liệu dưới dạng plain text</h1>
                <p>Nên dùng các hàm băm để mã hoá lại dữ liệu trước khi lưu vào DB để tránh lộ thông tin của người dùng.<br>Khi <strong>hacker</strong> lấy được password dưới dạng băm,chưa chắc đã lấy được tài khoản của người dùng.</p>
            </div>
        </article>
        <?php
        if(isset($_GET['change_status'])){
            if($_GET['change_status'] == 1){
                change_status($id_post);
            }
        }
        echo print_footer_status($id_post,$title);
        ?>
        <section id="comments">
            <div id="vcomments"></div>
        </section>
    </div>
</main>