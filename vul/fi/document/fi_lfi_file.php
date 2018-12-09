<main class="main" role="main">
    <div class="content">
        <article id="post-fi/lfi_file" class="article article-type-post" itemscope="" itemtype="http://schema.org/BlogPosting">
            <div class="article-header">
                <h1 class="article-title" itemprop="name">
                    Những File Có Thể Lợi Dụng Để LFI
                </h1>
                <div class="article-meta"><a href="?page=<?php echo $parent; ?>"><span>Back To Home</span></a>
               <?php if($src_youtube != ''){echo '<button id="introduce-btn"><img src="public/images/play-circle.png" class="img-circle img-rotate" style="height: 24px; width: 24px; margin-right: 5px" " />Hướng Dẫn</button>';} ?>
                </div>
            </div>
            <?php echo get_iframe_youtube($src_youtube); ?>
            <div class="article-entry marked-body" itemprop="articleBody">
                <h1 id="LFI-can-file-chua-ma-doc"><a href="#LFI-can-file-chua-ma-doc" class="headerlink" title="LFI cần file chứa mã độc."></a>LFI cần file chứa mã độc.</h1>
                <p>Trong nhiều trường hợp, ta không thể upload file có chứa đoạn script mã độc lên server được. Có thể do không có chức năng upload, hoặc có nhưng không thể lợi dụng.</p>
                <p>Vậy làm sao để chạy mã độc tuỳ ý bằng LFI được. Đó là lí do vì sao bài này mình sẽ giới thiệu với các bạn các bạn có thể lợi dụng để LFI.</p>
                <h2 id="Y-tuong"><a href="#Y-tuong" class="headerlink" title="Ý tưởng"></a>Ý tưởng</h2>
                <p>Đúng là ta không thể upload file lên, nhưng đâu có cấm chúng ta dùng các file mặc định của Apache hay PHP để ghi mã độc đâu phải không nào. Đó là những <strong>log file</strong>.</p>
                <p>Bởi mọi hoạt động của người dùng như request đến web server sẽ được lưu trong: <strong>access.log</strong><br>Nếu có lỗi thì sẽ được lưu trong: <strong>error.log</strong><br>Hoặc vô vàn những file ghi log khác, ta chỉ cần tạo những request có chứa đoạn mã độc ở những trường, thuộc tính mà log có ghi lại, rồi LFI đến file log đó là thành công.</p>
                <h1 id="Danh-sach-file-log"><a href="#Danh-sach-file-log" class="headerlink" title="Danh sách file log"></a>Danh sách file log</h1>
                <p>Dưới đây là một số cái file log mặc định mà server có thể ghi. <strong>Mặc định</strong> nhé.<br></p>
                <figure class="highlight bash">
                    <table>
                        <tbody>
                        <tr>
                            <td class="gutter">
                                <pre><span class="line">1</span><br><span class="line">2</span><br><span class="line">3</span><br><span class="line">4</span><br><span class="line">5</span><br><span class="line">6</span><br><span class="line">7</span><br><span class="line">8</span><br><span class="line">9</span><br><span class="line">10</span><br><span class="line">11</span><br><span class="line">12</span><br><span class="line">13</span><br><span class="line">14</span><br><span class="line">15</span><br><span class="line">16</span><br><span class="line">17</span><br><span class="line">18</span><br><span class="line">19</span><br><span class="line">20</span><br><span class="line">21</span><br><span class="line">22</span><br><span class="line">23</span><br><span class="line">24</span><br><span class="line">25</span><br><span class="line">26</span><br><span class="line">27</span><br><span class="line">28</span><br><span class="line">29</span><br><span class="line">30</span><br><span class="line">31</span><br><span class="line">32</span><br><span class="line">33</span><br><span class="line">34</span><br><span class="line">35</span><br><span class="line">36</span><br><span class="line">37</span><br><span class="line">38</span><br><span class="line">39</span><br><span class="line">40</span><br><span class="line">41</span><br></pre>
                            </td>
                            <td class="code">
                                <pre><span class="line">/etc/httpd/logs/access.log</span><br><span class="line">/etc/httpd/logs/access_log</span><br><span class="line">/etc/httpd/logs/error.log</span><br><span class="line">/etc/httpd/logs/error_log</span><br><span class="line">/opt/lampp/logs/access_log</span><br><span class="line">/opt/lampp/logs/error_log</span><br><span class="line">/usr/<span class="built_in">local</span>/apache/<span class="built_in">log</span></span><br><span class="line">/usr/<span class="built_in">local</span>/apache/logs</span><br><span class="line">/usr/<span class="built_in">local</span>/apache/logs/access.log</span><br><span class="line">/usr/<span class="built_in">local</span>/apache/logs/access_log</span><br><span class="line">/usr/<span class="built_in">local</span>/apache/logs/error.log</span><br><span class="line">/usr/<span class="built_in">local</span>/apache/logs/error_log</span><br><span class="line">/usr/<span class="built_in">local</span>/etc/httpd/logs/access_log</span><br><span class="line">/usr/<span class="built_in">local</span>/etc/httpd/logs/error_log</span><br><span class="line">/usr/<span class="built_in">local</span>/www/logs/thttpd_log</span><br><span class="line">/var/apache/logs/access_log</span><br><span class="line">/var/apache/logs/error_log</span><br><span class="line">/var/<span class="built_in">log</span>/apache/access.log</span><br><span class="line">/var/<span class="built_in">log</span>/apache/error.log</span><br><span class="line">/var/<span class="built_in">log</span>/apache-ssl/access.log</span><br><span class="line">/var/<span class="built_in">log</span>/apache-ssl/error.log</span><br><span class="line">/var/<span class="built_in">log</span>/httpd/access_log</span><br><span class="line">/var/<span class="built_in">log</span>/httpd/error_log</span><br><span class="line">/var/<span class="built_in">log</span>/httpsd/ssl.access_log</span><br><span class="line">/var/<span class="built_in">log</span>/httpsd/ssl_log</span><br><span class="line">/var/<span class="built_in">log</span>/thttpd_log</span><br><span class="line">/var/www/<span class="built_in">log</span>/access_log</span><br><span class="line">/var/www/<span class="built_in">log</span>/error_log</span><br><span class="line">/var/www/logs/access.log</span><br><span class="line">/var/www/logs/access_log</span><br><span class="line">/var/www/logs/error.log</span><br><span class="line">/var/www/logs/error_log</span><br><span class="line">C:\apache\logs\access.log</span><br><span class="line">C:\apache\logs\error.log</span><br><span class="line">C:\Program Files\Apache Group\Apache\logs\access.log</span><br><span class="line">C:\Program Files\Apache Group\Apache\logs\error.log</span><br><span class="line">C:\program files\wamp\apache2\logs</span><br><span class="line">C:\wamp\apache2\logs</span><br><span class="line">C:\wamp\logs</span><br><span class="line">C:\xampp\apache\logs\access.log</span><br><span class="line">C:\xampp\apache\logs\error.log</span><br></pre>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </figure>
                <p></p>
                <h1 id="Acess-log"><a href="#Acess-log" class="headerlink" title="Acess.log"></a>Acess.log</h1>
                <figure class="highlight plain">
                    <table>
                        <tbody>
                        <tr>
                            <td class="gutter">
                                <pre><span class="line">1</span><br></pre>
                            </td>
                            <td class="code">
                                <pre><span class="line">127.0.0.1 - - [25/Nov/2018:11:48:20 +0700] "GET /final/index.php?page=file_inclusion HTTP/1.1" 200 13119 "-" "Mozilla/5.0 (Windows NT 10.0; WOW64; rv:56.0) Gecko/20100101 Firefox/56.0"</span><br></pre>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </figure>
                <p>Định dạng của nó và những thông tin lưu vào như sau. Ta thấy nó lưu các thông tin như:</p>
                <ul>
                    <li>URL</li>
                    <li>User-agent</li>
                </ul>
                <p>Ta có thể chèn script vào 2 tham số này. Ví dụ:</p>
                <blockquote>
                    <p>User-agent = “ &lt;?php phpinfo(); “”</p>
                </blockquote>
                <p>Nếu bạn muốn dùng tham số URL, nhớ là nó sẽ bị URL encode, chèn sao cho encode mà vẫn ra script ấy nhé.</p>
                <p>Bằng cách requests đến với URL như vậy. Nó sẽ tự động ghi vào access.log.</p>
                <p>Sau đó,tìm đường link tới <strong>access.log</strong>, trường hợp của mình là như sau:</p>
                <blockquote>
                    <p>C:\xampp\apache\logs\access.log</p>
                </blockquote>
                <h2 id="Thanh-cong"><a href="#Thanh-cong" class="headerlink" title="Thành công"></a>Thành công</h2>
                <h1 id="Error-log"><a href="#Error-log" class="headerlink" title="Error.log"></a>Error.log</h1>
                <p>File này lưu những lỗi xảy ra trong quá trình xử lý, nên ta cứ làm cho nó sai là được. Mà nhớ là phải sai và thông tin lưu lại là đoạn script mã độc nhé.</p>
                <h2 id="Test"><a href="#Test" class="headerlink" title="Test"></a>Test</h2>
                <p>Nó cho include() đường dẫn, ta cứ nhập: <strong>&lt;?php phpinfo(); ?&gt;</strong></p>
                <p>Thì nó ghi lại:<br></p>
                <figure class="highlight bash">
                    <table>
                        <tbody>
                        <tr>
                            <td class="gutter">
                                <pre><span class="line">1</span><br></pre>
                            </td>
                            <td class="code">
                                <pre><span class="line">[Sun Nov 25 12:03:38.010685 2018] [php7:notice] [pid 1964:tid 1944] [client 127.0.0.1:3002] PHP Warning:  include(&amp;lt;?php phpinfo(); ?&amp;gt;): failed to open stream: No such file or directory <span class="keyword">in</span> C:\\xampp\\htdocs\\final\\vul\\<span class="keyword">fi</span>\\example\\fi_lfi_file.php on line 25</span><br></pre>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </figure>
                <p></p>
                <p>Nó html encode mất rồi. Các bạn thử ghi vào các trường khác cho nó lỗi xem nhé. :)))</p>
                <h1 id="Linux-proc-self"><a href="#Linux-proc-self" class="headerlink" title="Linux: /proc/self"></a>Linux: /proc/self</h1>
                <p>Đây là nơi lưu trữ thông tin của các tiến trình đang chạy trên Linux. Và khi PHP Script chạy thì tất nhiên nó cũng tạo ra 1 tiến trình và tiến trình đó có các thông tin được lưu tại:<br><strong>/proc/self/environ</strong></p>
                <figure class="highlight bash">
                    <table>
                        <tbody>
                        <tr>
                            <td class="gutter">
                                <pre><span class="line">1</span><br><span class="line">2</span><br><span class="line">3</span><br><span class="line">4</span><br><span class="line">5</span><br></pre>
                            </td>
                            <td class="code">
                                <pre><span class="line">PATH=/sbin:/usr/sbin:/bin:/usr/bin:/usr/X11R6/bin:/usr/bin:/bin</span><br><span class="line">SERVER_ADMIN=root@localhost</span><br><span class="line">...</span><br><span class="line">Mozilla/5.0 (Windows NT 10.0; WOW64; rv:56.0) Gecko/20100101 Firefox/56.0 HTTP_KEEP_ALIVE=300</span><br><span class="line">...</span><br></pre>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </figure>
                <p>Ta thấy nó có lưu thông tin User-Agent, ta dễ dàng inject code và dùng LFI để thực thi nó.</p>
                <h1 id="Linux-Mail"><a href="#Linux-Mail" class="headerlink" title="Linux: Mail"></a>Linux: Mail</h1>
                <p>Ngoài các file phía trên, ta còn có thể thông qua một dịch vụ có thể có của các web php,đó là gửi mail.<br>Khi ta gửi mail đến: <strong>apache@localhost</strong></p>
                <p>Thì nó sẽ được lưu tại địa chỉ /var/spool/mail/apache<br>Hoặc lưu tại nơi nó được config trong khi cài đặt, có thể là /var/mail/apache …</p>
                <p>Ta inject code vào Subject hoặc nội dung của tin nhắn rồi LFI ra cũng dễ dàng thành công!</p>
                <h1 id="Tim-hieu-them-va-su-dung-mot-cach-linh-hoat-nhe"><a href="#Tim-hieu-them-va-su-dung-mot-cach-linh-hoat-nhe" class="headerlink" title="Tìm hiểu thêm,và sử dụng một cách linh hoạt nhé!"></a>Tìm hiểu thêm,và sử dụng một cách linh hoạt nhé!</h1>
                <ul>
                    <li><strong> LFI </strong>: <a href="http://repository.root-me.org/Exploitation%20-%20Web/EN%20-%20Local%20File%20Inclusion.pdf" target="_blank" rel="noopener">http://repository.root-me.org/Exploitation%20-%20Web/EN%20-%20Local%20File%20Inclusion.pdf</a></li>
                </ul>
            </div>
        </article>
        <?php if(isset($_GET['change_status'])){
            if($_GET['change_status'] == 1){change_status($id_post);}}
        echo print_footer_status($id_post,$title);
        ?>
        <section id="comments">
            <div id="vcomments"></div>
        </section>
    </div>

</main>