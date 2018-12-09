<main class="main has-sticky" role="main">
    <div class="content">
        <article id="post-sqli_tongquan" class="article article-type-post" itemscope="" itemtype="http://schema.org/BlogPosting">
            <div class="article-header">
                <h1 class="article-title" itemprop="name">
                    [SQLI] Giới thiệu về SQL Injection
                </h1>
                <div class="article-meta"><a href="?page=<?php echo $parent; ?>"><span>Back To Home</span></a>
                    <?php if($src_youtube != ''){echo '<button id="introduce-btn"><img src="public/images/play-circle.png" class="img-circle img-rotate" style="height: 24px; width: 24px; margin-right: 5px" " />Hướng Dẫn</button>';} ?>
                </div>
            </div>
            <?php echo get_iframe_youtube($src_youtube); ?>
            <div class="article-entry marked-body" itemprop="articleBody">
                <p>Một cuộc tấn công SQL Injection là việc <strong>thêm</strong> hoặc <strong>tiêm</strong> vào 1 câu lệnh SQL Query thông qua dữ liệu được nhập vào bởi người dùng để thực thi các hành động bất hợp pháp.</p>
                <h1 id="Tai-sao-lai-ton-tai-SQL-Injection"><a href="#Tai-sao-lai-ton-tai-SQL-Injection" class="headerlink" title="Tại sao lại tồn tại SQL Injection?"></a>Tại sao lại tồn tại SQL Injection?</h1>
                <p>Công việc của một website là phục vụ cho người dùng. Nên việc phải giao tiếp với người dùng là điều không thể tránh khỏi đối với một website động.<br>Dữ liệu của người dùng muốn làm việc,thường được lưu trữ trong CSDL (Database). Để lấy được những dữ liệu đó một cách chính xác và nhanh nhất,ta cần các tham số truyền vào để hoàn thành câu truy vấn.Ví dụ:<br>Người dùng muốn biết thông tin của sinh viên có tên là Đoàn Ngọc Vương.<br>Muốn truy vấn CSDL và tìm ra thông tin của sinhvien có tên là Đoàn Ngọc Vương</p>
                <blockquote>
                    <p>SELECT * FROM sinhvien WHERE name_sinhvien='Đoàn Ngọc Vương'</p>
                </blockquote>
                <p>Vậy nhà phát triển phải dựa vào thông tin người dùng cung cấp (trong ví dụ là tên), sau đó mới xây dựng nên câu truy vấn SQL hoàn chỉnh để gửi tới trình thông dịch của HQT CSDL (Hệ quản trị CSDL). Sau đó xử lý kết quả và trả lại cho người dùng.<br><strong>Hacker</strong> sẽ lợi dụng điều này, sẽ cung cấp các thông tin sai lệch để can thiệp vào câu truy vấn SQL để đạt được mục đích của mình.<br>Áp dụng cho ví dụ trên. Hacker sẽ nhập:</p>
                <blockquote>
                    <p>Đoàn Ngọc Vương'; DROP TABLE users; – - </p>
                </blockquote>
                <p>Câu truy vấn sẽ trở thành:</p>
                <blockquote>
                    <p>SELECT * FROM sinhvien WHERE name_sinhvien='Đoàn Ngọc Vương'; DROP TABLE users; – -‘</p>
                </blockquote>
                <p>Câu SQL này được thực thi đồng nghĩa với việc bảng users sẽ bị xoá.</p>
                <h2 id="Ket-luan"><a href="#Ket-luan" class="headerlink" title="Kết luận"></a>Kết luận</h2>
                <p>SQL Injection tồn tại bởi vì <strong>quá trình tương tác với người dùng</strong>. Nhà phát triển cần thông tin người dùng nhập vào để hoàn thành các câu lệnh SQL và kiểm soát chúng một cách không chặt chẽ. Dẫn đến, hacker có thể lợi dụng chèn vào các đoạn mã để sửa lại câu lệnh SQL thực thi theo ý của hắn.</p>
                <h1 id="Muc-Tieu-Cua-Cuoc-Tan-Cong-SQL-Injection"><a href="#Muc-Tieu-Cua-Cuoc-Tan-Cong-SQL-Injection" class="headerlink" title="Mục Tiêu Của Cuộc Tấn Công SQL Injection"></a>Mục Tiêu Của Cuộc Tấn Công SQL Injection</h1>
                <p>Một cuộc khai thác SQL Injection thành công có thể:</p>
                <ul>
                    <li>
                        <p>Đọc dữ liệu nhạy cảm từ CSDL.</p>
                        <ul>
                            <li>Như username/password, có thể là mật khẩu tài khoản ngân hàng…</li>
                        </ul>
                    </li>
                    <li>
                        <p>Thay đổi thông tin của CSDL (Thêm / Xoá / Sửa).</p>
                        <ul>
                            <li>Thêm user có quyền admin.</li>
                            <li>Thêm vào tài khoản của hắn 1 tỷ đồng..</li>
                        </ul>
                    </li>
                    <li>
                        <p>Thực hiện công việc quản trị của quản trị viên trên CSDL.</p>
                        <ul>
                            <li>Hacker backup lại dữ liệu, lấy nó rồi xoá toàn bộ dữ liệu trên CSDL, tống tiền?</li>
                        </ul>
                    </li>
                    <li>
                        <p>Đọc được nội dung của một số tệp hiện tại trên hệ thống tệp CSDL.</p>
                        <ul>
                            <li>Đọc các file mã nguồn, các file thiết lập config…</li>
                        </ul>
                    </li>
                    <li>
                        <p>Nguy hiểm hơn: Có thể dùng để đăng tải tệp mã độc để thực thi các câu lệnh trên hệ thống máy chủ (RCE).</p>
                        <ul>
                            <li>Một số CSDL (với một số phiên bản) cho phép ta dùng câu lệnh SQL để tạo ra 1 file mới tại địa chỉ xác định =&gt; Cực kỳ nguy hiểm.</li>
                        </ul>
                    </li>
                </ul>
                <h1 id="Cach-Hoat-Dong"><a href="#Cach-Hoat-Dong" class="headerlink" title="Cách Hoạt Động"></a>Cách Hoạt Động</h1>
                <p>Cách hoạt động của SQL Injection, nó đã chỉ rõ trong tên của nó rồi: <strong>Injection</strong><br>Bằng cách cố gắng <strong>tiêm</strong> (dịch tạm của Injection) vào các câu truy vấn SQL,để thay đổi cấu trúc của nó trước khi câu truy vấn được gửi đến cho trình thông dịch của HQT CSDL dịch để thực thi.</p>
                <h2 id="Vi-du"><a href="#Vi-du" class="headerlink" title="Ví dụ"></a>Ví dụ (Có thể thử ngay tại bên trái)</h2>
                <p>Để hiểu rõ hơn,cùng tìm hiểu thông qua ví dụ khi dùng SQL để vượt qua quá trình xác thực.<br>Ứng dụng để đăng nhập vào tài khoản người dùng dựa vào kiểm tra thông tin username và password có đúng không,như sau:</p>
                <blockquote>
                    <p>SELECT * FROM users WHERE username=INPUT_USER and password=INPUT_PASSWORD</p>
                </blockquote>
                <p>Ví dụ Bob nhập thông tin:</p>
                <blockquote>
                    <p>username=Bob<br>password=bob123</p>
                </blockquote>
                <p>Vậy câu truy vấn sẽ trở thành:</p>
                <blockquote>
                    <p>SELECT * FROM users WHERE username='Bob' AND password='bob123'</p>
                </blockquote>
                <p>Sau đó nếu câu truy vấn cho kết quả khác rỗng thì đăng nhập thành công (Tồn tại hàng trong bảng users mà username=’Bob’ và password=’bob123’).<br>Không có vấn đề gì xảy ra,cho đến khi hacker muốn tiếp cận và khai thác ứng dụng này.</p>
                <p>Hacker muốn đăng nhập vào tài khoản của Bob, nhưng không có mật khẩu. Hacker sử dụng SQL Injection</p>
                <blockquote>
                    <p>username=Bob' --# <br>password=whatever</p>
                </blockquote>
                <p>Câu lệnh SQL truy vấn sẽ trở thành:</p>
                <blockquote>
                    <p>SELECT * FROM users WHERE username='Bob' -- ' and password='whatever'   &lt;= Phần sau -- sẽ bị bỏ qua,vì xem như là comment.</p>
                </blockquote>
                <ul>
                    <li>Dấu -- là dấu comment phần code phía sau. Giống # hay // ở các ngôn ngữ khác.</li>
                </ul>
                <p>Vậy đoạn truy vấn thật sự chạy,chỉ còn:</p>
                <blockquote>
                    <p>SELECT * FROM users WHERE username='Bob'</p>
                </blockquote>
                <p>Kết quả trả của câu truy vấn là thông tin của Bob. =&gt; Khác rỗng<br><strong>Đăng nhập thành công.</strong></p>
                <p>Vậy hắn ta đã tấn công giả mạo thành công tài khoản của Bob rồi đấy.</p>
                <h1 id="Tham-Khao-Them"><a href="#Tham-Khao-Them" class="headerlink" title="Tham Khảo Thêm"></a>Tham Khảo Thêm</h1>
                <ul>
                    <li><a href="https://www.owasp.org/index.php/SQL_Injection" target="_blank" rel="noopener">OWASP SQL Injection</a></li>
                    <li><a href="https://en.wikipedia.org/wiki/SQL_injection" target="_blank" rel="noopener">Wikipedia</a></li>
                    <li><a href="https://www.hacksplaining.com/exercises/sql-injection/" target="_blank" rel="noopener">Hacksplaining Step by Step SQL Injection (Rất hay)</a></li>
                </ul>
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
    </div>
</main>