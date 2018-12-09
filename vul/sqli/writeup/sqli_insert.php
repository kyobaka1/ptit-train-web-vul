<main class="main has-sticky" role="main">
    <div class="content">
        <article id="post-sql1" class="article article-type-post" itemscope="">
            <div class="article-header">
                <h1 class="article-title" itemprop="name">
                    [SQLi] SQLi Insert
                </h1>
                <div class="article-meta"><a href="?page=<?php echo $parent; ?>"><span>Back To Home</span></a>
                </div>
            </div>
            <div class="article-entry marked-body" itemprop="articleBody">
                <h1 id="Thu-Thach"><a href="#Thu-Thach" class="headerlink" title="Thử Thách"></a>Thử Thách</h1>
                <p>URL: <a href="https://www.root-me.org/en/Challenges/Web-Server/SQL-injection-Error" target="_blank" rel="noopener">https://www.root-me.org/en/Challenges/Web-Server/SQL-injection-Error</a></p>
                <h2 id="Tieu-de"><a href="#Tieu-de" class="headerlink" title="Tiêu đề"></a>Tiêu đề</h2>
                <p>Request Insert: fun &amp; profit</p>
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
                <h2 id="Insert-Query-Injection"><a href="#Insert-Query-Injection" class="headerlink" title="Insert Query Injection"></a>Insert Query Injection</h2>
                <p>Đọc lại hướng dẫn ở bài trainning nhé.</p>
                <h2 id="Khai-thac"><a href="#Khai-thac" class="headerlink" title="Khai thác"></a>Khai thác</h2>
                <p>Có chức năng đăng kí và đăng nhập.<br>Ta đoán chức năng đăng ký sẽ có câu query như sau:</p>
                <blockquote>
                    <p>INSERT INTO users(username,password,email) VALUES('$ipus','$ippass','$ipmail');</p>
                </blockquote>
                <p>Như đã trình bày, nếu biến inject vào được là ipus hoặc ippass thì ta có thể control được, vào biến ipus:</p>
                <blockquote>
                    <p>username','password',(select flag from flag)) -- -</p>
                </blockquote>
                <p>Nhưng thử với challenge này thì không được, họ chỉ cho inject vào biến <strong>ipmail</strong>.<br>Thử kiểu như trên:</p>
                <blockquote>
                    <p>(select flag from flag)) --</p>
                </blockquote>
                <p>Nhưng không may,phía trước của biến <strong>$ipmail</strong> là dấu nháy đơn rồi.<br>Nếu ta để thêm nháy đơn vào để đóng thì nó lại không hiểu câu SELECT nữa.</p>
                <p>Nhưng bù lại, câu INSERT này có một vấn đề lớn,đó là tại <strong>VALUES</strong><br>Ta có thể truyền vào nhiều giá trị mà.<br>Nên payload sẽ $ipmail:</p>
                <blockquote>
                    <p>hihi'), ('overking','123',(SELECT flag From flag)) --</p>
                </blockquote>
                <p>Vì sao có bảng và cột flag thì các bạn làm dần dần nhé. Từ information.schema đó, nhưng ghi ra lại dài dòng.</p>
                </div></div>
        </article>
        <section id="comments">
            <div id="vcomments"></div>
        </section>
    </div>
</main>