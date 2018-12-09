<main class="main has-sticky" role="main">
    <div class="content">
        <article id="post-xss/xss_cookie_session" class="article article-type-post" itemscope="" itemtype="http://schema.org/BlogPosting">
            <div class="article-header">
                <h1 class="article-title" itemprop="name">
                    Cách chiếm session bằng cookie
                </h1>
                <div class="article-meta"><a href="?page=<?php echo $parent; ?>"><span>Back To Home</span></a>
               <?php if($src_youtube != ''){echo '<button id="introduce-btn"><img src="public/images/play-circle.png" class="img-circle img-rotate" style="height: 24px; width: 24px; margin-right: 5px" " />Hướng Dẫn</button>';} ?>
                </div>
            </div>
            <?php echo get_iframe_youtube($src_youtube); ?>
            <div class="article-entry marked-body" itemprop="articleBody">
                <p>Ở những bài trước,chúng ta đã học XSS và bảo rằng chiếm được <strong>cookie</strong> là chiếm được <strong>session</strong>.<br>Nhưng nhiều bạn vẫn chưa biết chiếm được bằng cách nào, nên mình sẽ hướng dẫn một số cách chiếm <strong>session</strong> cho các bạn.</p>
                <h1 id="Dung-extension-cua-Firefox"><a href="#Dung-extension-cua-Firefox" class="headerlink" title="Dùng extension của Firefox"></a>Dùng extension của Firefox</h1>
                <p>Một số công cụ của Firefox có thể chỉnh sửa cookie của một trang web như là:</p>
                <h2 id="HTTP-Header-http-livehttpheaders-mozdev-org"><a href="#HTTP-Header-http-livehttpheaders-mozdev-org" class="headerlink" title="HTTP Header: http://livehttpheaders.mozdev.org/"></a>HTTP Header: <a href="http://livehttpheaders.mozdev.org/" target="_blank" rel="noopener">http://livehttpheaders.mozdev.org/</a></h2>
                <p>Giúp bạn có thể bắt các gói tin gửi đi của trình duyệt Firefox (Không có chặn).<br>Nó chỉ có thể giúp gửi lại (Replay), chỉnh sửa lại trường <strong>Cookie</strong> với cookie đánh cắp để lấy session.</p>
                <h2 id="Cookie-Manager-https-addons-mozilla-org-en-US-firefox-addon-a-cookie-manager"><a href="#Cookie-Manager-https-addons-mozilla-org-en-US-firefox-addon-a-cookie-manager" class="headerlink" title="Cookie Manager: https://addons.mozilla.org/en-US/firefox/addon/a-cookie-manager/"></a>Cookie Manager: <a href="https://addons.mozilla.org/en-US/firefox/addon/a-cookie-manager/" target="_blank" rel="noopener">https://addons.mozilla.org/en-US/firefox/addon/a-cookie-manager/</a></h2>
                <p>Tự tìm hiểu cách sử dụng</p>
                <h2 id="F12"><a href="#F12" class="headerlink" title="F12"></a>F12</h2>
                <p>Trong mục Storage có trường <strong>Cookies</strong> để chọn và sửa lại.</p>
                <h1 id="Dung-Burp-Suite-Toi-Uu"><a href="#Dung-Burp-Suite-Toi-Uu" class="headerlink" title="Dùng Burp-Suite (Tối Ưu)"></a>Dùng Burp-Suite (Tối Ưu)</h1>
                <p>Burp-Suite là bộ công cụ không thể thiếu của người làm an toàn cho webisite, nó có thể cho phép bạn sửa lại gói tin request trước khi gửi đi.<br>Các bạn có thể dễ dàng dowload và cài đặt từ <strong>google.com</strong><br>Sau đó,request đến trang muốn thay đổi <strong>cookie</strong> và điều chỉnh trường <strong>Cookie: yourcookie*</strong><br>Sau đó gửi gói tin đến trang =&gt; Chiếm được session.</p>
                <h1 id="Dung-Python-Requests"><a href="#Dung-Python-Requests" class="headerlink" title="Dùng Python Requests"></a>Dùng Python Requests</h1>
                <p>Bằng cách thêm cấu trúc json <strong>mycookie</strong> vào gói tin request bằng: cookies=mycookie<br></p>
                <figure class="highlight python">
                    <table>
                        <tbody>
                        <tr>
                            <td class="gutter">
                                <pre><span class="line">1</span><br><span class="line">2</span><br><span class="line">3</span><br><span class="line">4</span><br><span class="line">5</span><br><span class="line">6</span><br><span class="line">7</span><br><span class="line">8</span><br><span class="line">9</span><br></pre>
                            </td>
                            <td class="code">
                                <pre><span class="line"><span class="keyword">import</span> requests</span><br><span class="line">URL = <span class="string">"http://challenge01.root-me.org/web-client/ch18/"</span></span><br><span class="line"><span class="keyword">print</span> <span class="string">"[+] Don't edit cookie!"</span></span><br><span class="line">rs1 = requests.get(URL).text</span><br><span class="line"><span class="keyword">print</span> rs1[rs1.index(<span class="string">"Status:"</span>):].split(<span class="string">"&lt;/span&gt;"</span>)[<span class="number">0</span>]</span><br><span class="line"><span class="keyword">print</span> <span class="string">"[+] Edit cookie!"</span></span><br><span class="line">mycookie = {<span class="string">"ADMIN_COOKIE"</span>:<span class="string">"NkI9qe4cdLIO2P7MIsWS8ofD6"</span>}</span><br><span class="line">rs2 = requests.get(URL,cookies=mycookie).text</span><br><span class="line"><span class="keyword">print</span> rs2[rs2.index(<span class="string">"Status:"</span>):].split(<span class="string">"&lt;/span&gt;"</span>)[<span class="number">0</span>]</span><br></pre>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </figure>
                <p></p>
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