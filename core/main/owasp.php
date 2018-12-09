<main class="main" role="main">
    <div class="content">
        <article id="post-old/top10owasp" class="article article-type-post" itemscope="" itemtype="http://schema.org/BlogPosting">
            <div class="article-header">
                <h1 class="article-title" itemprop="name">
                    Top 10 Application Security Risks
                </h1>
                <div class="article-meta"><a href="?page=<?php echo $parent; ?>"><span>Back To Home</span></a>
                    <?php if($src_youtube != ''){echo '<button id="introduce-btn"><img src="public/images/play-circle.png" class="img-circle img-rotate" style="height: 24px; width: 24px; margin-right: 5px" " />Hướng Dẫn</button>';} ?>
                </div>
            </div>
            <?php echo get_iframe_youtube($src_youtube); ?>
            <div class="article-entry marked-body" itemprop="articleBody">
                <h1 id="Gioi-thieu-ve-OWASP"><a href="#Gioi-thieu-ve-OWASP" class="headerlink" title="Giới thiệu về OWASP"></a>Giới thiệu về OWASP</h1>
                <p><strong>OWASP (Open Web Application Security Project)</strong> là tổ chức phi lợi nhuận chuyên môn cung cấp những ý kiến, thông tin lý thuyết thực tế về lỗ hổng an toàn trên phần mềm web.<br>Top 10 Web Application Security Risks được cập nhật hằng năm để cung cấp hướng dẫn cho nhà phát triển và nhân viên bảo mật về các lỗ hổng bảo mật nghiêm trọng nhất được tìm thấy trong các ứng dụng web.<br>Đó là 10 nguy cơ bảo mật ứng dụng rất nguy hiểm vì chúng cho phép kẻ tấn công phân tán phần mềm độc hại, ăn cắp dữ liệu hoặc hoàn toàn chiếm đoạt máy tính (máy chủ website) của bạn.</p>
                <h1 id="Top-10-Lo-Hong-Tren-Webisite-2017-new-updated"><a href="#Top-10-Lo-Hong-Tren-Webisite-2017-new-updated" class="headerlink" title="Top 10 Lỗ Hổng Trên Webisite 2017 (new updated)"></a>Top 10 Lỗ Hổng Trên Webisite 2017 (new updated)</h1>
                <h2 id="A1-Injection-Tiem-Chen"><a href="#A1-Injection-Tiem-Chen" class="headerlink" title="A1. Injection (Tiêm/Chèn)"></a>A1. Injection (Tiêm/Chèn)</h2>
                <p><img src="<?php echo PAGE_TO_ROOT ?>public/images/owasp/1.jpg" alt=""></p>
                <h3 id="Tong-quan"><a href="#Tong-quan" class="headerlink" title="Tổng quan"></a>Tổng quan</h3>
                <p>Các trang website không thể nào thiếu tương tác của người dùng, do đó các câu lệnh thường bị ảnh hưởng bởi các input của người dùng. Sau đó mới được gửi đến Interpreter để dịch và chạy.<br>Lỗ hổng xảy ra khi kẻ tấn công gửi thông tin không đáng tin cậy đến một Interpreter (thông dịch lệnh) mà vẫn được thực thi như một lệnh bình thường mà không có sự ngăn cấm thích hợp.<br>Nguyên lý và cách khai thác injection khá đơn giản nhưng hậu quả để lại vô cùng nghiêm trọng. Do đó, nó nằm ở vị trí A1 không hẳn là không có lý do.<br>Người phát triển nên sử dụng các tham số truy vấn (parameterized queries) khi code để phòng chống lỗ hổng injection.<br>Một số loại tấn công injection như:</p>
                <ul>
                    <li>SQL Injection</li>
                    <li>Command Injection</li>
                    <li>LDAP Injection</li>
                </ul>
                <h3 id="Vi-du"><a href="#Vi-du" class="headerlink" title="Ví dụ"></a>Ví dụ</h3>
                <p><strong>Kịch bản</strong>: Ứng dụng sử dụng thông tin không đáng tin cậy của người dùng để gán vào câu lệnh SQL sau:</p>
                <blockquote>
                    <p>$query = “SELECT * FROM users WHERE username=’$userid’ AND password=’$userpass’”;</p>
                </blockquote>
                <p>Kẻ tấn công,cung cấp:</p>
                <blockquote>
                    <p>$userid = admin’ or 1=1 – -</p>
                </blockquote>
                <p>Thì câu truy vấn sẽ trở thành:</p>
                <blockquote>
                    <p>SELECT * FROM users WHERE username=’admin’ or 1=1 – -‘ AND password=’$userpass’</p>
                </blockquote>
                <p>Dấu – - là dấu comment trong SQL, từ đó kẻ tấn công dễ dàng bypass quá trình đăng nhập sử dụng password của tài khoản admin.</p>
                <h2 id="A2-Broken-Authentication"><a href="#A2-Broken-Authentication" class="headerlink" title="A2. Broken Authentication"></a>A2. Broken Authentication</h2>
                <p><img src="<?php echo PAGE_TO_ROOT ?>public/images/owasp/2.jpg" alt=""></p>
                <h3 id="Tong-quan-1"><a href="#Tong-quan-1" class="headerlink" title="Tổng quan"></a>Tổng quan</h3>
                <p>Đó là sự <strong>sai lầm trong xác thực và quản lý phiên làm việc</strong><br>Việc cấu hình cho tài khoản và xác thực phiên làm việc của người dùng sai dẫn đến kẻ tấn công có thể lợi dụng và thực hiện các cuộc tấn công chiếm tài khoản của người dùng.<br>Một số các điểm yếu thường gặp:</p>
                <ul>
                    <li>Cho phép các cuộc tấn công tự động, như là <strong>cridential stuffing</strong>, khi mà kẻ tấn công có một dnah sách username và password hợp lệ.</li>
                    <li>Cho phép cuộc tấn công brute force hoặc các loại tấn công tự động (dò quét) khác.</li>
                    <li>Dùng mật khẩu yếu (như admin/admin) khi quản trị.</li>
                    <li>Dùng plain text, hoặc loại mã hoá, mã băm yếu.</li>
                </ul>
                <p><strong>Multi-factor authentication</strong> (Xác thực đa nhân số), như là FIDO hay ứng dụng chuyên dụng có thể làm giảm nguy cơ tài khoản bị xâm phạm.</p>
                <h3 id="Vi-du-1"><a href="#Vi-du-1" class="headerlink" title="Ví dụ"></a>Ví dụ</h3>
                <p>Tấn công brute force. Cứ bật tool lên và chạy thôi.</p>
                <h2 id="A3-Sensitive-Data-Exposure"><a href="#A3-Sensitive-Data-Exposure" class="headerlink" title="A3. Sensitive Data Exposure"></a>A3. Sensitive Data Exposure</h2>
                <p><img src="<?php echo PAGE_TO_ROOT ?>public/images/owasp/3.jpg" alt=""></p>
                <h3 id="Tong-quan-2"><a href="#Tong-quan-2" class="headerlink" title="Tổng quan"></a>Tổng quan</h3>
                <p>Đây là loại tấn công có sức ảnh hưởng lớn nhất trong vài năm qua. Còn lỗ hổng của nó khá là đơn giản:</p>
                <ul>
                    <li>Dùng plain text để trao đổi dữ liệu (không mã hoá).</li>
                    <li>Sử dụng thuật toán mã hoá quen thuộc, dễ tấn công.</li>
                    <li>Sử dụng mã băm phổ biến.</li>
                </ul>
                <p>Mã băm dễ bị tấn công bởi dạng từ điển, cũng khá nhiều năm từ khi họ thiết lập CSDL để tấn công mã băm. Nên dù có băm nhưng mật khẩu yếu thì vẫn suy ra được như thường.<br>Kẻ tấn công muốn khai thác có thể dễ dàng thực hiện Man-in-the-middle để lấy các thông tin.</p>
                <h3 id="Vi-du-2"><a href="#Vi-du-2" class="headerlink" title="Ví dụ"></a>Ví dụ</h3>
                <p>Một ngân hàng lưu trữ các thông tin của thẻ Credt card của khách hàng dưới dạng plain text trong CSDL. Thông qua SQL Injection, kẻ tấn công có được CSDL và có luôn thông tin này.</p>
                <h2 id="A4-XML-External-Entity"><a href="#A4-XML-External-Entity" class="headerlink" title="A4. XML External Entity"></a>A4. XML External Entity</h2>
                <p><img src="<?php echo PAGE_TO_ROOT ?>public/images/owasp/4.jpg" alt=""></p>
                <h3 id="Tong-quan-3"><a href="#Tong-quan-3" class="headerlink" title="Tổng quan"></a>Tổng quan</h3>
                <p>XML là một dạng ngôn ngữ đánh dấu được sử dụng ngày càng rộng rãi và có nhiều ưu điểm vượt trội.<br>Mặc định, khá nhiều ngôn ngữ (trình xử lý) XML cho phép sử dụng định dạng <strong>external entities</strong>,một URI bị bỏ qua và đánh giá trong quá trình xử lý XML.<br>Thông qua <strong>external entities</strong>, kẻ tấn công có thể khai thác nhiều loại tấn công như DOS, đọc file…</p>
                <p>Điểm yếu dễ bị khai thác XXE:</p>
                <ul>
                    <li>Cho phép tải lên XML, cung cấp XML từ nguồn không đáng tin cậy.</li>
                    <li>Hoặc cho phép thông tin không đáng tin cậy vào XML documents.</li>
                    <li>Hoặc cho nó vào quá trình XML Parser ra dữ liệu.</li>
                </ul>
                <h3 id="Vi-du-3"><a href="#Vi-du-3" class="headerlink" title="Ví dụ:"></a>Ví dụ:</h3>
                <blockquote>
                    <p>&lt;!ENTITY xxe SYSTEM “file:///etc/passwd” &gt;]&gt;</p>
                </blockquote>
                <p>Sử dụng entity để đọc file /etc/paswd</p>
                <h2 id="A5-Broken-Access-Control"><a href="#A5-Broken-Access-Control" class="headerlink" title="A5. Broken Access Control"></a>A5. Broken Access Control</h2>
                <p><img src="<?php echo PAGE_TO_ROOT ?>public/images/owasp/5.jpg" alt=""></p>
                <h3 id="Tong-quan-4"><a href="#Tong-quan-4" class="headerlink" title="Tổng quan"></a>Tổng quan</h3>
                <p>Do cấu hình không đúng cách hoặc quên giới hạn trong việc xác thực người dùng cho phép họ có thể truy cập đến những dữ liệu hoặc chức năng trái phép. Như là truy cập vào tài khoản người dùng khác để xem thông tin nhạy cảm hay sửa lại dữ liệu và quyền truy cập. </p>
                <p>Một số điểm yếu của ứng dụng dẫn đến lỗi này như là:</p>
                <ul>
                    <li>Bỏ qua kiểm soát truy cập bằng cách sửa lại URL.</li>
                    <li>Cho phép thay đổi khoá chính của mình thành của người khác.</li>
                    <li>Nâng cao đặc quyền. Cho phép user đăng nhập với tư cách admin.<br>…</li>
                </ul>
                <h3 id="Vi-du-4"><a href="#Vi-du-4" class="headerlink" title="Ví dụ"></a>Ví dụ</h3>
                <p>Trang admin.php nằm tại thư mục /admin lưu trữ các quyền quản trị của ứng dụng.<br>Nó được gọi qua thông qua controller, và kiểm tra quyền ở controller.<br>Nhưng hacker truy cập:</p>
                <blockquote>
                    <p><a href="http://victimsite.com/admin/admin.php?do=somthing" target="_blank" rel="noopener">http://victimsite.com/admin/admin.php?do=somthing</a></p>
                </blockquote>
                <p>Và gọi đến các function này thành công. Vì đoạn kiểm tra quyền không có nằm trong này.</p>
                <h2 id="A6-Security-Misconfiguration"><a href="#A6-Security-Misconfiguration" class="headerlink" title="A6. Security Misconfiguration"></a>A6. Security Misconfiguration</h2>
                <p><img src="<?php echo PAGE_TO_ROOT ?>public/images/owasp/6.jpg" alt=""></p>
                <h3 id="Tong-quan-5"><a href="#Tong-quan-5" class="headerlink" title="Tổng quan"></a>Tổng quan</h3>
                <p>Cấu hình sai có thể diễn ra ở bất kỳ lớp, ở đâu trong lớp ứng dụng bao gồm network serivce, platform, webserver, application server, database, framworks, custom code, storage… có thể gây ra hậu quả nghiêm trọng</p>
                <p>Kẻ tấn công sử dụng các công cụ để dò quét các cấu hình sai này rồi mở rộng tấn công từ đó.</p>
                <h3 id="Vi-du-5"><a href="#Vi-du-5" class="headerlink" title="Ví dụ"></a>Ví dụ</h3>
                <ul>
                    <li>Để username/password mặc định của hãng như admin/admin.</li>
                    <li>Enable một số tài khoản mặc định và mật khẩu không đổi.</li>
                    <li>Cài các phiên bản ứng dụng có lỗ hổng.</li>
                </ul>
                <h2 id="A7-Cross-Site-Scripting"><a href="#A7-Cross-Site-Scripting" class="headerlink" title="A7. Cross-Site Scripting"></a>A7. Cross-Site Scripting</h2>
                <p><img src="<?php echo PAGE_TO_ROOT ?>public/images/owasp/7.jpg" alt=""></p>
                <h3 id="Tong-quan-6"><a href="#Tong-quan-6" class="headerlink" title="Tổng quan"></a>Tổng quan</h3>
                <p>XSS đã từng xếp vị trí số 3 trong top 10 OWASP năm 2013 để đủ thể hiện sự nguy hiểm của nó.</p>
                <p>Cross-site scripting (XSS) cho phép kể tấn công khả năng chèn đoạn mã chạy ở phía client vào ứng dụng để thực hiện các hành vi trái phép như dowload mã độc, keylog, đánh cắp cookie…</p>
                <p>XSS hay thường sử dụng chung vs CSRF.</p>
                <h3 id="Vi-du-6"><a href="#Vi-du-6" class="headerlink" title="Ví dụ"></a>Ví dụ</h3>
                <blockquote>
                    <p><a href="http://victim.com?language=&lt;script&gt;alert('Hacked')&lt;/script" target="_blank" rel="noopener">http://victim.com?language=&lt;script&gt;alert('Hacked')&lt;/script</a>&gt;</p>
                </blockquote>
                <p>Sẽ hiển lên thông báo hacked ở cửa sổ trình duyệt client.</p>
                <h2 id="A8-Insecure-deserialization"><a href="#A8-Insecure-deserialization" class="headerlink" title="A8. Insecure deserialization"></a>A8. Insecure deserialization</h2>
                <p><img src="<?php echo PAGE_TO_ROOT ?>public/images/owasp/8.jpg" alt=""></p>
                <h3 id="Tong-quan-7"><a href="#Tong-quan-7" class="headerlink" title="Tổng quan"></a>Tổng quan</h3>
                <p>Lỗ hổng deserialization không an toàn cho phép kẻ tấn công có thể thực thi code trên ứng dụng từ xa, làm giả hoặc xoá đối tượng serialized, dẫn đến tấn công Injection và leo đặc quyền.</p>
                <p>Lỗ hổng này ảnh hưởng nghiêm trọng đối với các loại ngôn ngữ có cung cấp OOP vì khả năng của serialization mà cho phép chuyển đối từ đối tượng sang thông tin có thể lưu được và ngược lại.</p>
                <h2 id="A9-Using-Components-with-Known-Vulnerabilities"><a href="#A9-Using-Components-with-Known-Vulnerabilities" class="headerlink" title="A9. Using Components with Known Vulnerabilities"></a>A9. Using Components with Known Vulnerabilities</h2>
                <p><img src="<?php echo PAGE_TO_ROOT ?>public/images/owasp/9.jpg" alt=""></p>
                <h3 id="Tong-quan-8"><a href="#Tong-quan-8" class="headerlink" title="Tổng quan"></a>Tổng quan</h3>
                <p>Nhà phát triển thường xuyên không biết rằng open source và đối tượng bên thứ ba nào trên ứng dụng của họ, gây khó khăn cho quá trình nâng cấp thành phần khi có lỗ hổng được tìm ra.<br>Kẻ tấn công có thể tấn công 1 thành phần không an toàn từ đó chiếm toàn bộ server và đánh cắp dữ liệu nhạy cảm.</p>
                <h3 id="Vi-du-7"><a href="#Vi-du-7" class="headerlink" title="Ví dụ"></a>Ví dụ</h3>
                <p>Sử dụng wordpress phiên bản cũ 2017 thôi. Kẻ tấn công có hàng tá các CVE viết sẵn lỗi ra để dùng và tấn công website của bạn.</p>
                <h2 id="A10-Insufficient-Logging-and-Monitoring"><a href="#A10-Insufficient-Logging-and-Monitoring" class="headerlink" title="A10. Insufficient Logging and Monitoring"></a>A10. Insufficient Logging and Monitoring</h2>
                <p><img src="<?php echo PAGE_TO_ROOT ?>public/images/owasp/10.jpg" alt=""></p>
                <p>Thời gian để phát hiện lỗ hổng thường mất đến hàng tuần hay hàng tháng. Thiếu thốn về logging và tích hợp không hiệu quả với hệ thống phản hồi bảo mật cho phép kẻ tấn công tấn công tới hệ thống khác và duy trì các mối đe doạ liên tục.</p>
                <h1 id="Tai-Lieu-Phai-Doc"><a href="#Tai-Lieu-Phai-Doc" class="headerlink" title="Tài Liệu Phải Đọc"></a>Tài Liệu Phải Đọc</h1>
                <ul>
                    <li><strong>Tài liệu rất hay của OWASP nói về các lỗ hổng này, các bạn nên đọc kĩ và tìm hiểu nó</strong>:<br><a href="https://www.owasp.org/images/7/72/OWASP_Top_10-2017_%28en%29.pdf.pdf" target="_blank" rel="noopener">https://www.owasp.org/images/7/72/OWASP_Top_10-2017_%28en%29.pdf.pdf</a></li>
                </ul>
            </div>
            </div>
        </article>
        <section id="comments">
            <div id="vcomments"></div>
        </section>
    </div>
</main>