<main class="main has-sticky" role="main">
    <div class="content">
        <article id="post-sqli_tancong_coban" class="article article-type-post" itemscope="" itemtype="http://schema.org/BlogPosting">
            <div class="article-header">
                <h1 class="article-title" itemprop="name">
                    [SQLI] Kỹ Thuật Tấn Công SQL Injection (Union Based SQLi)
                </h1>
                <div class="article-meta"><a href="?page=<?php echo $parent; ?>"><span>Back To Home</span></a>
                    <?php if($src_youtube != ''){echo '<button id="introduce-btn"><img src="public/images/play-circle.png" class="img-circle img-rotate" style="height: 24px; width: 24px; margin-right: 5px" " />Hướng Dẫn</button>';} ?>
                </div>
            </div>
            <?php echo get_iframe_youtube($src_youtube); ?>
            <div class="article-entry marked-body" itemprop="articleBody">
                <h1 id="Error-Based-Tan-cong-dua-cach-thu-loi"><a href="#Error-Based-Tan-cong-dua-cach-thu-loi" class="headerlink" title="Error Based (Tấn công dựa cách thử lỗi)"></a>Error Based (Tấn công dựa cách thử lỗi)</h1>
                <p>Dựa vào cơ chế báo lỗi của hệ quản trị CSDL MySQL để tiến hành khai thác một số thông tin như số cột.<br>Thường Error based chỉ là bước đệm cho các kỹ thuật tấn công khác.<br>Ví dụ rõ hơn sẽ nêu ở phần kỹ thuật sau để liền mạch.</p>
                <h1 id="Union-Query-Based-Tan-cong-dua-cau-lenh-UNION"><a href="#Union-Query-Based-Tan-cong-dua-cau-lenh-UNION" class="headerlink" title="Union Query Based (Tấn công dựa câu lệnh UNION)"></a>Union Query Based (Tấn công dựa câu lệnh UNION)</h1>
                <p><strong>UNION</strong> là câu lệnh SQL dùng để gộp các kết quả của hai câu mệnh đề <strong>SELECT</strong>.<br>Ví dụ:</p>
                <blockquote>
                    <p>SELECT 1,2 UNION SELECT 3,4 </p>
                </blockquote>
                <p>Kết quả trả về sẽ là 1,2,3,4. Là hợp kết quả của 2 câu SELECT.</p>
                <h3 id="Cac-buoc-tan-cong-nhu-sau"><a href="#Cac-buoc-tan-cong-nhu-sau" class="headerlink" title="Các bước tấn công như sau:"></a>Các bước tấn công như sau:</h3>
                <h3 id="Buoc-1-Kiem-tra"><a href="#Buoc-1-Kiem-tra" class="headerlink" title="Bước 1: Kiểm tra."></a>Bước 1: Kiểm tra.</h3>
                <p>Kiểm tra xem đối tượng tấn công bị có dính SQL Injection dạng UNION hay không?<br>Ví dụ với câu truy vấn:</p>
                <blockquote>
                    <p>SELECT * FROM product WHERE ID='$USER_INPUT_ID' </p>
                </blockquote>
                <p>•    Thử thêm dấu nháy ‘ hoặc “ kiểm tra xem có phá vỡ được cấu trúc câu truy vấn.<br>•    Thử với mã số ID sai, xem kết quả của câu truy vấn.<br>•    Thử với ID=1 OR TRUE rồi xem kết quả của câu truy vấn.<br>•    Thử với 1 UNION để xem có bị filter từ khoá UNION hay chưa?</p>
                <h3 id="Buoc-2-Tim-so-cot"><a href="#Buoc-2-Tim-so-cot" class="headerlink" title="Bước 2: Tìm số cột."></a>Bước 2: Tìm số cột.</h3>
                <p>Vì câu lệnh UNION chỉ cho phép nối kết quả hai mệnh đề SELECT có cùng số cột (column). Do đó, ta phải tìm kiếm số cột của câu truy vấn phía đầu tiên, trước khi nối UNION vào phía sau. Bằng cách sử dụng kỹ thuật <strong>Error based</strong>: ORDER BY + SỐ CỘT KIỂM THỬ<br><strong>ORDER BY</strong> là câu lệnh dùng để sắp xếp thứ tự tăng dần hoặc giảm dần, một cột hay nhiều cột trong SQL.<br>Câu truy vấn có ORDER BY thường như sau:</p>
                <blockquote>
                    <p>SELECT * FROM USERS ORDER BY 5 ASC -&gt; Sắp xếp tăng dần kết quả theo cột số 5.</p>
                </blockquote>
                <p>Vậy nếu kết quả chỉ có 4 cột,ta yêu cầu sắp xếp theo cột số 5 thì sẽ <strong>CÓ LỖI</strong>.<br>=&gt; Ý tưởng là ta sẽ thử lần lượt số cột, cho đến khi câu truy vấn cho kết quả sai. Vậy số cột đúng lớn nhất là số cột của câu truy vấn.</p>
                <p>Ví dụ câu truy vấn có 4 cột. Ta hãy thử như sau:</p>
                <blockquote>
                    <p>ID = 1 ORDER BY 3 # Sô cột 3 cho câu truy vấn đúng.</p>
                </blockquote>
                <p>Nếu kết quả vẫn hiển thị được bình thường thì có nghĩa </p>
                <blockquote>
                    <p>ID = 1 ORDER BY 5 #</p>
                </blockquote>
                <p>Kết quả hiển thị ra trang web bị lỗi do câu truy vấn sai. Chỉ có 4 cột, nhưng bắt sắp xếp theo cột thứ 5 (Không tồn tại cột 5).<br>Ta thử lại với 4. Nếu 4 vẫn cho truy vấn chính xác, vậy 4 chính là số cột ta cần tìm.<br><strong>Quy tắc</strong>: Số cột là số lớn nhất tạo truy vấn đúng.</p>
                <h3 id="Buoc-3-Noi-truy-van-tim-so-cot-duoc-hien-thi"><a href="#Buoc-3-Noi-truy-van-tim-so-cot-duoc-hien-thi" class="headerlink" title="Bước 3: Nối truy vấn, tìm số cột được hiển thị."></a>Bước 3: Nối truy vấn, tìm số cột được hiển thị.</h3>
                <p>Sau khi có câu truy vấn, ta sẽ thực hiện dùng UNION để nối ai câu truy vấn như sau:</p>
                <blockquote>
                    <p>-1' UNION SELECT 1,2,3,4 #</p>
                </blockquote>
                <p><strong>Tại sao phải dùng -1</strong>: Để kết quả của câu truy vấn đầu tiên là rỗng.<br><strong>Lưu ý</strong>: 1,2,3,4 chỉ sử dụng được trong MySQL vì nó có cơ chế tự động chuyển từ chữ sang số và ngược lại sao cho câu truy vấn chính xác. Còn với các hệ quản trị CSDL khác thì không được.<br>Tới đây, kết quả hiện lên màn hình sẽ là các con số tại nơi mà cột tương ứng được hiện ra trên website.</p>
                <h3 id="Buoc-4-Truy-van-du-lieu"><a href="#Buoc-4-Truy-van-du-lieu" class="headerlink" title="Bước 4: Truy vấn dữ liệu."></a>Bước 4: Truy vấn dữ liệu.</h3>
                <p>Ví dụ như ở bước 3, ta thấy cột 2 và cột 4 được hiển thị ra màn hình.<br>Thực hiện truy vấn lấy phiên bản hiện tại của hệ quản trị CSDL và tên CSDL như sau:</p>
                <blockquote>
                    <p>-1' UNION SELECT 1,(@@version),3,(database()) #</p>
                </blockquote>
                <h3 id="Thanh-cong"><a href="#Thanh-cong" class="headerlink" title="Thành công."></a>Thành công.</h3>
                <p>Một số lưu ý quan trọng đối với MySQL:</p>
                <ul>
                    <li>
                        <p>Nếu không biết tên bảng và tên cột, ta sử dụng bảng thông tin <strong>information_schema</strong>. Ví dụ:</p>
                        <ul>
                            <li>
                                <p>Tên bảng:</p>
                                <blockquote>
                                    <p>concat(table_name) FROM information_schema.tables WHERE table_schema = 'Tên của CSDL' #</p>
                                </blockquote>
                            </li>
                            <li>
                                <p>Tên cột của bảng product:</p>
                                <blockquote>
                                    <p>concat(column_name) FROM information_schema.columns WHERE table_name=product #</p>
                                </blockquote>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <p>Những ký tự #, – -, – # là đánh dấu phía sau là phần comment. Để tất cả đoạn truy vấn phía sau mất đi ý nghĩa.</p>
                    </li>
                    <li>Trong một vài trường hợp, ta cần chuyển trên bảng hoặc tên CSDL sang dạng hex rồi mới bỏ vào câu truy vấn.</li>
                </ul>
                <h1 id="Tham-Khao-Them"><a href="#Tham-Khao-Them" class="headerlink" title="Tham Khảo Thêm"></a>Tham Khảo Thêm</h1>
                <ul>
                    <li><a href="http://www.sqlinjection.net/union/" target="_blank" rel="noopener">SQL INJECTION UNION</a></li>
                    <li><a href="http://www.securityidiots.com/Web-Pentest/SQL-Injection/Basic-Union-Based-SQL-Injection.html" target="_blank" rel="noopener">SECURITY IDIOTS</a></li>
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