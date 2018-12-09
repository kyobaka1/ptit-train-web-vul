<main class="main" role="main">
    <div class="content">
        <article id="post-xss/xss_stored" class="article article-type-post" itemscope="" itemtype="http://schema.org/BlogPosting">
            <div class="article-header">
                <h1 class="article-title" itemprop="name">
                    Stored XSS (Persistent XSS)
                </h1>
                <div class="article-meta"><a href="?page=<?php echo $parent; ?>"><span>Back To Home</span></a>
               <?php if($src_youtube != ''){echo '<button id="introduce-btn"><img src="public/images/play-circle.png" class="img-circle img-rotate" style="height: 24px; width: 24px; margin-right: 5px" " />Hướng Dẫn</button>';} ?>
                </div>
            </div>
            <?php echo get_iframe_youtube($src_youtube); ?>
            <div class="article-entry marked-body" itemprop="articleBody">
                <p>Là kiểu tấn công XSS <strong>nguy hiểm</strong> hơn so với Refleted XSS và có mức độ ảnh hưởng <strong>lớn nhất</strong>.</p>
                <h1 id="Stored-XSS-la-gi"><a href="#Stored-XSS-la-gi" class="headerlink" title="Stored XSS là gì?"></a>Stored XSS là gì?</h1>
                <p>Cuộc tấn công Stored XSS là một loại của XSS.<br>Nó được duy trì liên tục, do mã độc được lưu vào trong CSDL của server.<br>Ảnh hưởng đến tất cả những người dùng làm việc trên website có chứa mã độc (SELECT ra từ CSDL).<br>Stored XSS diễn ra khi thông tin người dùng cung cấp,được lưu trữ vào CSDL,file hoặc cấu trúc khác. Sau đó,dữ liệu này được gửi về cho client mà không thông qua quá trình xử lý đúng cách.<br>Nói chung, thay vì gửi mã độc cho từng người dùng thông qua URL như Reflected XSS. Stored XSS là lưu mã độc vào CSDL, từ đó lan truyền chúng ra những mục tiêu truy cập website có sử dụng thông tin có chứa mã độc đó.</p>
                <p><img src="http://localhost/stored-xss.png" alt="Mô hình XSS diễn ra"></p>
                <h1 id="Tai-sao-noi-Stored-XSS-nguy-hiem-hon-Reflected-XSS"><a href="#Tai-sao-noi-Stored-XSS-nguy-hiem-hon-Reflected-XSS" class="headerlink" title="Tại sao nói Stored XSS nguy hiểm hơn Reflected XSS?"></a>Tại sao nói Stored XSS nguy hiểm hơn Reflected XSS?</h1>
                <p><strong>Stored XSS</strong> là loại tấn công được xem là nguy hiểm nhất trong 3 loại XSS. Có những lý do sau:</p>
                <ul>
                    <li>Nếu dùng link URL như Reflected XSS,có thể victim chưa đăng nhập vào tài khoản của họ, nên việc lấy cookie chưa hẳn đã chiếm được session của nạn nhân. Còn Stored XSS thì khác, quá trình họ bị lấy đi cookie là do họ <strong>đang sử dụng</strong> trang web đó nên việc đăng nhập rồi là khả thi hơn.</li>
                    <li>Stored XSS có tầm ảnh hưởng rộng, nó diễn ra kể cả với những người có kiến thức về bảo mật (Ví nó chạy phần dưới và tự động load ra), chứ không phải thiếu kiến thức và click vào link có URL lạ như bên Reflected XSS. Đồng thời,nó có ảnh hưởng với tất cả mọi người có sử dụng trang web bị lỗi.</li>
                </ul>
                <h1 id="Cac-buoc-tan-cong-Stored-XSS"><a href="#Cac-buoc-tan-cong-Stored-XSS" class="headerlink" title="Các bước tấn công Stored XSS?"></a>Các bước tấn công Stored XSS?</h1>
                <h2 id="Buoc-1-Tim-loi"><a href="#Buoc-1-Tim-loi" class="headerlink" title="Bước 1: Tìm lỗi"></a>Bước 1: Tìm lỗi</h2>
                <p>Ta tập trung với các loại input của người dùng mà sẽ được dùng để lưu trữ vào CSDL. Đồng thời,nếu nhiều mục tiêu thì ta ưu tiên vào các nội dung được load ra sớm hơn.<br>Ví dụ như tiêu đề và nội dung của một trang diễn đàn đều bị XSS. Thì ta nên ưu tiên XSS vào tiêu đề. Vì ở homepage của diễn đàn,có lẽ họ chỉ load ra tiêu đề. Như vậy, mã độc XSS sẽ được load ra,chứ không cần phải vào đọc nội dung bài viết mới bị XSS.<br>Ta thử với các biến,xem chúng có bị XSS hay không,nếu thành công, ta chuyển sang bước 2.</p>
                <h2 id="Buoc-2-Cho-de-lay-cookie"><a href="#Buoc-2-Cho-de-lay-cookie" class="headerlink" title="Bước 2: Chờ để lấy cookie."></a>Bước 2: Chờ để lấy cookie.</h2>
                <p><strong>Mục tiêu:</strong> Sau khi xác định được lỗi XSS, ta cần dùng nó sẽ lấy những mục tiêu cần thiết như là <strong>cookie</strong>.<br>Các bước lấy cookie, mình đã trình bày ở bài trước.</p>
                <h2 id="Buoc-3-Thanh-cong"><a href="#Buoc-3-Thanh-cong" class="headerlink" title="Bước 3: Thành công."></a>Bước 3: Thành công.</h2>
                <p>Chờ họ đăng nhập,load page và cookie đã nằm ở file <strong>cookie.txt</strong> rồi đó.</p>
                <h1 id="Test"><a href="#Test" class="headerlink" title="Test"></a>Test</h1>
                <p>Thử đăng bài viết với payload:<br></p>
                <figure class="highlight php">
                    <table>
                        <tbody>
                        <tr>
                            <td class="gutter">
                                <pre><span class="line">1</span><br><span class="line">2</span><br></pre>
                            </td>
                            <td class="code">
                                <pre><span class="line">title = &lt;script&gt;alert(<span class="number">1</span>)&lt;/script&gt;Hello</span><br><span class="line">author = XSS</span><br></pre>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </figure>
                <p></p>
                <p>Khi load page,ta sẽ thực thi đoạn script.</p>
                <h2 id="Khong-nen-thu-luu-document-location-o-day-vi-tu-load-no-se-nhay-sang-trang-kia-Luc-day-phai-vao-database-xoa-nha"><a href="#Khong-nen-thu-luu-document-location-o-day-vi-tu-load-no-se-nhay-sang-trang-kia-Luc-day-phai-vao-database-xoa-nha" class="headerlink" title="Không nên thử lưu document.location ở đây,vì tự load nó sẽ nhảy sang trang kia. Lúc đấy phải vào database xoá nha."></a>Không nên thử lưu document.location ở đây,vì tự load nó sẽ nhảy sang trang kia. Lúc đấy phải vào database xoá nha.</h2>
                <h1 id="Tham-khao"><a href="#Tham-khao" class="headerlink" title="Tham khảo"></a>Tham khảo</h1>
                <ul>
                    <li><strong>ACUNETIX</strong>: <a href="https://www.acunetix.com/blog/articles/persistent-xss/" target="_blank" rel="noopener">https://www.acunetix.com/blog/articles/persistent-xss/</a></li>
                    <li><strong>Hacker 101:</strong> <a href="https://www.hacker101.com/vulnerabilities/stored_xss.html" target="_blank" rel="noopener">https://www.hacker101.com/vulnerabilities/stored_xss.html</a></li>
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
        <section id="comments">
            <div id="vcomments"></div>
        </section>
    </div>
</main>