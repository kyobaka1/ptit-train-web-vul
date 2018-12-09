<main class="main has-sticky" role="main">
    <div class="content">
        <article id="post-sql1" class="article article-type-post" itemscope="" itemtype="http://schema.org/BlogPosting">
            <div class="article-header">
                <h1 class="article-title" itemprop="name">
                    [SQLi] SQLi Error
                </h1>
                <div class="article-meta"><a href="?page=<?php echo $parent; ?>"><span>Back To Home</span></a>
                </div>
            </div>
            <div class="article-entry marked-body" itemprop="articleBody">
                <h1 id="Thu-Thach"><a href="#Thu-Thach" class="headerlink" title="Thử Thách"></a>Thử Thách</h1>
                <p>URL: <a href="https://www.root-me.org/en/Challenges/Web-Server/SQL-injection-Error" target="_blank" rel="noopener">https://www.root-me.org/en/Challenges/Web-Server/SQL-injection-Error</a></p>
                <h2 id="Tieu-de"><a href="#Tieu-de" class="headerlink" title="Tiêu đề"></a>Tiêu đề</h2>
                <p>Exploiting SQL error</p>
                <h2 id="Mo-ta"><a href="#Mo-ta" class="headerlink" title="Mô tả"></a>Mô tả</h2>
                <p>Retrieve administrator’s password.</p>
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
                <h2 id="Error-SQLi"><a href="#Error-SQLi" class="headerlink" title="Error SQLi"></a>Error SQLi</h2>
                <p>Xảy ra khi mà khi ta thử một số payload, thấy website trả lại cho chúng ta câu query sai chỗ nào, vì sao sai luôn.<br>Ta có thể dựa vào đó mà thực hiện một số công việc,như là :</p>
                <blockquote>
                    <p>cast(database() as int)</p>
                </blockquote>
                <p>Nó thông báo rằng không thể chuyển ‘tendabases’ sang dạng int. Thế thì lộ hết của người ta rồi còn gì nữa.<br>Các bạn có thể tìm kiếm trên mạng,hoặc đọc tài liệu:<br><a href="https://www.exploit-db.com/docs/english/37953-mysql-error-based-sql-injection-using-exp.pdf" target="_blank" rel="noopener">https://www.exploit-db.com/docs/english/37953-mysql-error-based-sql-injection-using-exp.pdf</a></p>
                <h2 id="Khai-thac"><a href="#Khai-thac" class="headerlink" title="Khai thác"></a>Khai thác</h2>
                <p>Vào website thấy chức năng login và contents, login chắc chỉ để lấy flag khi có user admin thôi.<br>Thấy có trường order =&gt; chắc là <strong>Order By Clause SQLi</strong><br>Bài này mình chỉ cho 1 payload của mình khi lấy flag,còn lại các bạn tự mày mò theo form này:</p>
                <blockquote>
                    <p>ASC, (select 1 where 1=cast((select+column_name+from+information_schema.columns limit 1 offset 31) as float))</p>
                </blockquote>
                <p>Hoặc cũng có nhiều cách hay, không nhất thiết phải làm theo kiểu này nhé.</p>
                </div></div>
        </article>
        <section id="comments">
            <div id="vcomments"></div>
        </section>
    </div>
</main>